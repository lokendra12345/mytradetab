<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBusinessTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('business', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id')->unsigned();
            //$table->bigInteger('user_id')->unsigned();
            //$table->unsignedInteger('user_id');
            //$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('company_name');
            $table->string('company_logo')->nullable();
            $table->string('company_banner')->nullable();
            $table->longText('company_details')->nullable();
            $table->string('whatsapp_image')->nullable();
            $table->string('company_mobile');
            $table->string('company_email',127)->unique();
            $table->string('address_line1');
            $table->string('address_line2');
            $table->string('landmark');
            $table->string('city');
            $table->string('state');
            $table->string('country');
            $table->integer('zip_code');
            $table->integer('category');
            $table->integer('sub_category');
            $table->string('short_url')->nullable();
            $table->enum('business_type', ['exporter', 'manufacturer']);
            $table->enum('subscription_type', ['paid', 'free']);
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
        Schema::dropIfExists('business');
    }
}
