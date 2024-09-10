<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->uuid('id')->primary(); // ID kiểu UUID
            $table->string('code')->unique(); // Mã đơn hàng
            $table->uuid('user_id'); // ID người dùng
            $table->uuid('status_id'); // ID trạng thái
            $table->string('receive_phone'); // Số điện thoại nhận hàng
            $table->string('receive_address'); // Địa chỉ nhận hàng
            $table->decimal('delivery_cost', 10, 2); // Phí vận chuyển
            $table->uuid('payment_id'); // ID phương thức thanh toán
            $table->text('description')->nullable(); // Mô tả đơn hàng
            $table->timestamps(); // Tạo trường created_at và updated_at

            // Thiết lập khóa ngoại (foreign key) nếu cần
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('status_id')->references('id')->on('statuses')->onDelete('cascade');
            $table->foreign('payment_id')->references('id')->on('payments')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}

