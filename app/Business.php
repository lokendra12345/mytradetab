<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Eloquent;

class Business extends Model
{
    //

 	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'business';
    protected $fillable = [
        'user_id', 'company_name', 'company_logo', 'company_banner', 'company_details', 'whatsapp_image', 'company_mobile', 'company_email', 'address_line1', 'address_line2', 'landmark', 'city', 'state', 'country', 'zip_code', 'category', 'sub_category', 'short_url', 'business_type', 'subscription_type', 'created_at', 'updated_at'
    ];


    public function user()
     {
         return $this->belongsTo('App\User');
     }
}
