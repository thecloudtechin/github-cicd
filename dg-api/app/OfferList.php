<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Model;
use Laravel\Lumen\Auth\Authorizable;

class OfferList extends Model 
{
   
    protected $fillable = [
        'id', 'offercategory_id', 'itemcategory_id', 'item_id', 'start_date', 'end_date', 'discount', 'banner', 'thumbnail', 'status', 'create_at'
    ];

    
}