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
            $table->text('desc');
            $table->string('SKU');

            // $table->foreignId('category_id')
            //       ->constrained('product_category')
            //       ->onUpdate('cascade')
            //       ->onDelete('cascade');

            // $table->foreignId('inventory_id')
            //       ->constrained('product_inventory')
            //       ->onUpdate('cascade')
            //       ->onDelete('cascade');

            $table->decimal('price');

            // $table->foreignId('discount_id')
            //       ->constrained('discount')
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
