<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable=[
        'id',
        'name',
        'address',
        'phone',
        'sum',
        'short_description',
        'attributes',
        'imgs',
        'other',
        'priority',
        'date',
        'status',
        'created_at',
        'updated_at'
    

    ];
    public function scopegetOrders($query){
        $query->orderBy('created_at','desc');
                
    }
}
