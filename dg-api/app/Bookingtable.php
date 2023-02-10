<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Model;
use Laravel\Lumen\Auth\Authorizable;
use Tymon\JWTAuth\Contracts\JWTSubject;
class Bookingtable extends Model 
{
    

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'hotel_id', 'bookingid', 'tableNo', 'title', 'fname', 'lname', 'phonenumber', 'email', 'created_date', 'updated_date',
        'created_datetime', 'updated_datetime', 'time', 'timing', 'person', 'location', 'bookingtime', 'table_type', 'status', 'user_id'
    ];

    


}
