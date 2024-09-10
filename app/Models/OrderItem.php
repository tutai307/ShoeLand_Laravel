<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Support\Str;

class OrderItem extends Model
{
    use HasUuids;

    protected $fillable = [
        'order_id',
        'product_id',
        'size_id',
        'quantity',
        'unit_price',
    ];

    protected $keyType = 'string'; // Định nghĩa kiểu của khóa chính là chuỗi
    public $incrementing = false; // UUID không phải là auto-increment

    protected static function booted()
    {
        static::creating(function ($model) {
            $model->id = (string) Str::uuid();
        });
    }

    // Define the relationship with Order
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    // Define the relationship with Product
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // Define the relationship with Size
    public function size()
    {
        return $this->belongsTo(Size::class);
    }
}
