<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Model;
use Laravel\Lumen\Auth\Authorizable;

class OfferCategory extends Model 
{
   
    protected $fillable = [
        'id', 'name', 'hotel_id', 'status', 'created_at','based_on_total'
    ];

    
}