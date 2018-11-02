<?php
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Backend;
//use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
//use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\URL;
use App\Models\Article;
use App\Models\Category;
use App\Models\Lang;
use App\Models\Translate;
use App\Models\Text;
use App\Models\Setting;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\MessageBag;
use League\Flysystem\Config;

/*Function for get Setting content*/
if (! function_exists('getSetting')) {
    /**
     * Format text.
     *
     * @param  string  $value
     * @return string
     */
    function getSetting($value){        
        $setting = Setting::where('name',$value)->first();        
        if(isset($setting->description)){
            $setting_content = $setting->description;
            return $setting_content;
        }
        else{
            return $value;
        }
    }
}
/*Function for get Setting content*/
if (! function_exists('getCurentLang')) {
    /**
     * Format text.
     *
     * @param  string  $value
     * @return string
     */
    function getCurentLang($value){        
        $lang = Lang::where('lang',$value)->first();
        //dd($lang);        
        if(isset($lang->country)){
            $country = $lang->country;
            return $country;
        }
        else{
            return $value;
        }
    }
}
/*Function return id apartaments*/
if (! function_exists('getIdApart')) {
    /**
     * Format text.
     *
     * @param  string  $value
     * @return string
     */
    function getIdApart($type){
        //TODO::оптимізувати
        if($type === 'mark' OR $type === 'white_house' OR $type === 'dream_house'){
                //$room =  Category::with('articles')->getCategory('rooms')->first();
                $article = Article::with('article_children')->select('id')->where('type',$type)->first(); 
                $id = $article->article_children->where('article_id', $article->id)->where('category_id', 8)->pluck('id')->first();
                //dd($result);
                if(!$id) return false;
                //$id = $article->id;
            if($id){  
                return $id;
            }
        }
        return false;
    }
}

/*Function return id apartaments*/
if (! function_exists('setLangToRedirect')) {
    /**
     * Format text.
     *
     * @param  string  $value
     * @return string
     */
    function setLangToRedirect($currentLang){        
        if($currentLang === config('app.base_local')){            
            return '';            
        }else{
            return $currentLang;
        }
        
    }
}

