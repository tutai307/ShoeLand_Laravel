<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductSizesTable extends Migration
{
    public function up()
    {
        Schema::create('product_sizes', function (Blueprint $table) {
            $table->foreignId('product_id');
            $table->foreignId('size_id');
            $table->integer('quantity');

            // Khóa chính composite
            $table->primary(['product_id', 'size_id']);

            $table->timestamps();

            // Khóa ngoại cho bảng products
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');

            // Khóa ngoại cho bảng sizes
            $table->foreign('size_id')->references('id')->on('sizes')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('product_sizes');
    }
}
