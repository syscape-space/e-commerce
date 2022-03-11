<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->string('name');
            $table->string('image');
            $table->text('description');
            $table->decimal('price');
            $table->integer('categories_id');
            $table->integer('sub_categories_id');
            //create foreignKey for product table

            // $table->foreignId('category_id')
            //       ->constrained('Category')
            //       ->onUpdate('cascade')
            //       ->onDelete('cascade');

            // $table->foreignId('subCategory_id')
            //       ->constrained('SubCategory')
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
        Schema::dropIfExists('products');
    }
}
