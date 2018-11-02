<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
class Category extends Translate {

    public function articles(){
        return $this->hasMany('App\Models\Article');
    }

    public function category_parent()
    {
        return $this->belongsTo('App\Models\Category', 'parent_id');
    }

    public function category_children()
    {
        return $this->hasMany('App\Models\Category', 'parent_id');
    }

    protected $fillable = [
        'parent_id',
        'article_parent',
        'title',
        'link',
        'description',
        'short_description',
        'img',
        'imgs',
        'fields',
        'date',
        'url',
        'active',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'priority'
    ];

    /*function for checked fields in article edit file*/
    public function hasField($field_name){
        $fields = json_decode($this->fields);
        foreach($fields->base as $field){
            if($field == $field_name){
                return true;
            }
        }
        return false;
    }
    /*Change format of date*/
    public function getDateAttribute($date){
        return Carbon::createFromFormat('Y-m-d H:i:s',$date)->toDateString();
    }
    /*Get images from DB*/
    public function getCategoryImages(){
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
            return $imgs ?: [];
        }
        else{
            return [];
        }
    }
    public function scopegetCategory($query, $type){
        $query->select(
            'id',
            'parent_id',
            'article_parent',
            'title',
            'url',
            'link',
            'description',
            'short_description',      
            'active',
            'meta_title',
            'meta_description',
            'meta_keywords'    
        )
        ->where ('link', $type);
              
    }
    public function scopeactiveCategories($query){
        $query->where ('active',1);
    }
}

