<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVendorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendors', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->string('email')->unique()->nullable();
            $table->string('phone_number')->nullable();
            $table->text('address')->nullable();
            $table->string('city')->nullable();
            $table->string('country')->nullable();
            $table->string('zipcode')->nullable();
            $table->integer('is_active')->default('0');
            $table->integer('created_by')->default('0');

            // add foreign key  from vendors table to users  and products tables 

            // $table->foreignId('product_id')
            //       ->constrained('Product')
            //       ->onUpdate('cascade')
            //       ->onDelete('cascade');

            // $table->foreignId('user_id')
            //       ->constrained('User')
            //       ->onUpdate('cascade')
            //       ->onDelete('cascade');


            $table->softDeletes();
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
        Schema::dropIfExists('vendors');
    }
}
