<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model {

    protected $fillable=[
        'type',
        'name',
        'phone'
    ];
    public function getDateAttribute($created_at){
        return Carbon::createFromFormat('Y-m-d H:i:s',$created_at)->toDateString();
    }

}
