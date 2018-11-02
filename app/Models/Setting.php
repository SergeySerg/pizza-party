<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Setting extends Translate {
    use SoftDeletes;

	protected $fillable = [
        "name",
        "title",
        "description"
    ];

    protected $dates = ['deleted_at'];

}
