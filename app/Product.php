<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Eloquent;

class Product extends Model
{
    //

     //

 	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'business_id', 'product_name', 'sku', 'price', 'sale_price', 'category', 'description', 'short_description', 'image', 'gallery', 'seo_keywords', 'seo_title', 'seo_description', 'status', 'created_at', 'updated_at'
    ];
}
