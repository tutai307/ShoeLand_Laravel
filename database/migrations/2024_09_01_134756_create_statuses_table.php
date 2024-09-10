<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('statuses', function (Blueprint $table) {
            $table->uuid('id')->primary(); // Tạo cột id là UUID và là khóa chính
            $table->string('code')->unique(); // Mã code cho tình trạng đơn hàng, đảm bảo unique
            $table->string('name'); // Tên tình trạng
            $table->text('description')->nullable(); // Mô tả tình trạng, có thể để trống
            $table->timestamps(); // Tạo cột created_at và updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('statuses');
    }
};
