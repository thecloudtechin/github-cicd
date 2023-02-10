<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AddonMultiSelect extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'addoncatid','menuid','hotelid','count','add_on_desc','string'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];
    protected $table = 'addon_multi_select';
}