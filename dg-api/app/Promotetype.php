<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Promotetype extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'hotelid','promote_title','promote_desc','cost','from_date','end_date','status'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];
    protected $table = 'promotetype';
}