<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Debugbar;
use Cookie;

class Article extends Translate {
    
    protected $fillable=[
        'category_id',
        'article_id',
        'title',
        'type',
        'subdomain',
        'short_description',
        'description',
        'attributes',
        'img',
        'imgs',
        'priority',
        'meta_description',
        'meta_keywords',
        'meta_title',
        'files',
        'public',
        'active',
        'date',
        'date_start',
        'date_finish',
        'article_id_2'
    ];
    //protected $dates = ['date_start', 'date_finish'];
    //protected $dateFormat = 'Y-m-d H:i:s';
    //protected $dates = ['created_at', 'updated_at', 'deleted_at', 'date', 'date_start', 'date_finish'];

    // public function getAttributeTranslate($key, $current_lang = null){
        
    //     return parent::getAttributeTranslate($key, $current_lang = null);
    // }
    public function category(){
        return $this->belongsTo('App\Models\Category');
    }

    public function article_parent(){
        return $this->belongsTo('App\Models\Article', 'article_id');
    }

    public function article_children(){        
        return $this->hasMany('App\Models\Article', 'article_id');
    }
    public function article_parent_price(){
        return $this->belongsTo('App\Models\Article', 'article_id_2');
    }

    public function article_children_price(){        
        return $this->belongsTo('App\Models\Article', 'article_id_2
        ');
    }
    /*public function getAttributes($key, $lang){
        if(isset($this->attributes)){
            $attributes = json_decode($this->attributes, true);
            if(is_array($attributes)){

            }
        }
    }*/

    public function getImages(){
        if (isset($this->imgs)){
            $imgs = json_decode($this->imgs, true);
            if(is_array($imgs)){
                foreach($imgs as $key => $img){
                    if(!is_array($img)){
                        $imgs[$key] = [
                            'min' => $img,
                            'full' => $img
                        ];
                    }
                }
            }
            //dd($imgs);
            return $imgs ?: [];
        }
        else{
            return [];
        }
    }    
    public function scopeactiveAndSortArticles($query){
        $query->where ('active',1)
              ->orderBy('priority','desc');
    }
    public function scopeactiveAndSortForDateArticles($query){
        $query->where ('active',1)
            ->orderBy('date_start');
    }
    public function scopeSortDateArticles($query){
        $query->latest('date')
            ->where ('active',1);
    }
    //Change format of date
    public function getDateAttribute($date){
        return Carbon::createFromFormat('Y-m-d H:i:s',$date)->toDateString();
    }
    // get Price
    public function getPrice($id, $parent_hotel_id){
        Debugbar::info('id====>' . $id);
        Debugbar::info('parent_hotel_id====>' . $parent_hotel_id);
        $article = $this;
        $date_start = trim(session()->get('date_start'));
        $date_finish = trim(session()->get('date_finish'));
        //dd($date_finish);
        Debugbar::info($date_start);
        Debugbar::info($date_finish);
        $days = $this->getCountDays($date_finish, $date_start);
        $base_article_price = $this->getArticleBasePrice($id, $parent_hotel_id);
        if(empty($date_start) && $date_start  || empty($date_finish)){
            //dd($this->getAttributeTranslate('base_price'));
            return $base_article_price;
            //return $val = $price->getAttributeTranslate('base_price');
        }else{
            //dd('qw');
            $date_start = date("Y-m-d 00:00:00", strtotime($date_start));
            $date_finish = date("Y-m-d 00:00:00", strtotime($date_finish));
            //dd($newDate);
            $seasons = $article::with('article_children')
                ->where(function ($query) use ($date_start, $parent_hotel_id) {
                    $query->where('article_id', $parent_hotel_id);

                    $query->where('date_start', '<=', $date_start);
                    $query->where('date_finish', '>=', $date_start);
                })
                ->orWhere(function ($query) use ($date_finish, $parent_hotel_id) {
                    $query->where('article_id', $parent_hotel_id);

                    $query->where('date_start', '<=', $date_finish);
                    $query->where('date_finish', '>=', $date_finish);
                })
                ->orWhere(function ($query) use ($date_start, $date_finish, $parent_hotel_id) {
                    $query->where('article_id', $parent_hotel_id);

                    $query->where('date_start', '>=', $date_start);
                    $query->where('date_finish', '<=', $date_finish);
                })
                ->activeAndSortForDateArticles()
                ->get()
                ->toArray();
                //dd($seasons);
            /* if dont search seasons */
            if(count($seasons) == 0){
                foreach($base_article_price as $key => $value){
                    $base_article_price[$key] = $value;
                }
                return $base_article_price;
            } 

            $price_property = $this->getDayPrice($seasons, $date_start, $date_finish, $id, $base_article_price);
            return $price_property;
        }
    }
    private function getArticleBasePrice($id, $parent_hotel_id){
        $base_season = $this::with('article_children')
                ->where('article_id', $parent_hotel_id)
                ->where('attributes->base_season', 1)
                ->get();

        $article_price = $base_season->map(function ($child_article) use ($id) {
			return $child_article
                ->article_children()				
                ->where('article_id_2', $id)
                ->activeAndSortArticles()
                ->first();
        })
        ->first();
        if($article_price){
            $attributes_price = json_decode($article_price->toArray()['attributes'], true);  
            return $attributes_price;
        }else{
            return [
                "base_price" => 0,
                'surchange' => 0,
                'solo_settle' => 0,
                'surchange_children' => 0

            ];
        }
        //->toArray();
        

    }
    private function getCountDays($date_finish, $date_start){
        $date2 = strtotime($date_finish);
        $date1 = strtotime($date_start);
        $days = ($date2-$date1)/(60*60*24);
        return $days;

    }
    private function getDayPrice($seasons, $date_start, $date_finish, $id, $base_article_price){
        $days = $this->getCountDays($date_finish, $date_start);
        $date_range_start = $date_start;
        $price_array = [];
        for($i = 1; $i <= $days; $i++){
            $max_base_price = 0;
            //Debugbar::info('Дата' . $date_range_start );
            foreach($seasons as $season){
                if(($season['date_start'] <= $date_range_start) && ($season['date_finish'] >= $date_range_start)){
                    foreach($season['article_children'] as $article_price){
                        if($article_price['article_id_2'] ==$id && $article_price['active'] == 1 ){
                            $current_attributes_price = json_decode($article_price['attributes'], true);
                            if($current_attributes_price['base_price'] >= $max_base_price){
                                $max_base_price = $current_attributes_price['base_price'];
                                $price_array[$i] = json_decode($article_price['attributes'], true);    
                            }
                        }
                    }
                }
            }
            // Add day for find range
            $date_range_start = date('Y-m-d H:i:s', strtotime($date_range_start .' +1 day'));

            // Write base price when dont find price fo this day
            if(!isset($price_array[$i])){
                $price_array[$i] = $base_article_price;    
            }
        }
        $result_price_arr = [];
        
        //Array with day price for property
        //dd($price_array);
        foreach($price_array as $day => $price_item){
            foreach($price_item as $key => $price){
                //dd($price[$key]);
                $result_price_arr[$key][] = intval($price); 
                //dd($result_price_arr);     
            }
        }
//dd($result_price_arr);
        $result = [];
        foreach($result_price_arr as $key => $v){
            $result[$key] = round(array_sum($v)/$days, 0, PHP_ROUND_HALF_UP);
        }

        Debugbar::info('==========================');
        //dd($result_price_arr);
        //dd($result);
        Debugbar::info($result);
        Debugbar::info('==========================');
        
        // $price_array conrain all price for day from date range
        return $result;
    }
}
