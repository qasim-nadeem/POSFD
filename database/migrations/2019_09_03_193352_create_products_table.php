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
            $table->string('name')->nullable();
            $table->integer('quantity')->nullable();
            $table->integer('price_per_unit')->nullable();
            $table->integer('purchase_price')->nullable();
            $table->string('code')->nullable();
            $table->integer('total_quantity');
            $table->string('manufacture_name')->nullable();
            $table->string('model_name')->nullable();
            $table->string('color')->nullable();
            $table->timestamps();
            $table->softDeletes();

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
