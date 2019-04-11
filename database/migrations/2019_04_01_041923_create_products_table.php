<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('business_id')->unsigned();
            $table->string('product_name');
            $table->string('sku',127)->unique();
            $table->float('price')->nullable();
            $table->float('sale_price')->nullable();
            $table->string('category');
            $table->longText('description')->nullable();
            $table->longText('short_description')->nullable();
            $table->string('image');
            $table->string('gallery')->nullable();
            $table->string('seo_keywords')->nullable();
            $table->string('seo_title')->nullable();
            $table->longText('seo_description')->nullable();
            $table->enum('status', ['active', 'in-active']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
