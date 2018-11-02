<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lang extends Translate {
    protected $fillable=[
        'lang',
        'country',
        'active',        
        'img',
        'priority'
    ];
    public function scopeactiveLangs($query){
        $query->where ('active',1)
                ->orderBy('priority','desc');
                
    }

}
