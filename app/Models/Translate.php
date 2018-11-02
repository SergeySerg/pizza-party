<?php
namespace App\Models;
use App;
use Illuminate\Database\Eloquent\Model;
use App\Models\Lang;
use Debugbar;

class Translate extends Model {

    public function getTranslate($field, $current_lang = null){
        if(!$current_lang){
            $current_lang = App::getLocale();
        }  
        //Debugbar::info($current_lang);
        $fields = json_decode($this->$field, true);
       
        if (is_string($fields)){ 
            $field = str_replace("'","",$fields);           
            return $field; 
        }
        if ($fields === FALSE) {            
            return $this->$field; 
        }
        return $this->getTranslateValue($fields, $current_lang);
    
    }

    public function getAttributeTranslate($key, $current_lang=null){
        //$current_lang='ua';
        //dd($current_lang);
        if(!$current_lang){
            $current_lang = App::getLocale();
            
        }
        Debugbar::info($current_lang);
        Debugbar::info($key);
        $articleArray =  $this->toArray();
        $attributes = json_decode($articleArray['attributes'], true);
        
        if(isset($attributes[$key]) AND $attributes[$key]) {
            
            $fields = $attributes[$key];
            if (is_string($fields) OR is_int($fields)){ 
                $attributes[$key] = str_replace("'","", $attributes[$key]);           
                return $attributes[$key]; 
            }
            if ($fields === null) {
                return $attributes[$key]; 
            }
            return $this->getTranslateValue($fields, $current_lang);
        }
        return false;
    }
    public function getTranslateValue($fields, $current_lang){
        $translate_value = '';
        foreach($fields as $key => $item){
            if($key == $current_lang){
                 $translate_value =  $fields[$key];
            }
        }
        return $translate_value;
    }
}