<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cuisines extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'hotelid','name','status'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];
    protected $table = 'cuisines';
}