<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Model;
use Laravel\Lumen\Auth\Authorizable;

class Driver extends Model implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'fname', 'lname', 'email', 'contact', 'pass', 'dob',
        'bloodgroup', 'postcode', 'baccountno', 'acholdername', 'ifsc',
         'rcownername', 'rgdrto', 'classofvehicle', 'manufacturer', 'vehicleno',
          'vehiclemodel', 'insurence', 'registration', 'licenseno', 'issuedate', 'expiredate',
           'lcertificate', 'certificatepermit','delivery_assign','pan','aadhar','status'

    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
    ];
}
