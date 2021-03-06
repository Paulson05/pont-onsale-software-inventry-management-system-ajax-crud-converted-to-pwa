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
            $table->bigIncrements('id');
            $table->integer('suppliers_id');
            $table->integer('unit_id');
            $table->integer('brand_id')->nullable();
            $table->integer('category_id')->nullable();
            $table->string('name');
            $table->string('photo')->nullable();
            $table->string('product_code')->nullable();
            $table->string('qr_code')->nullable();
            $table->longText('barcode')->nullable();
            $table->integer('quantity')->default('0');
            $table->integer('alert_stock')->default('100');
            $table->tinyInteger('status')->default('1');
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
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
