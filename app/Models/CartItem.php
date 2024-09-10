<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;
class CartItem extends Model
{
    protected $fillable = [
        'product_id', // Thêm product_id vào đây
        'size_id',
        'quantity',
        'unit_price',
        'cart_id',
    ];
    protected static function booted()
    {
        static::creating(function ($model) {
            $model->id = (string) Str::uuid();
        });
    }
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    // Quan hệ với Cart
    public function cart(): BelongsTo
    {
        return $this->belongsTo(Cart::class);
    }

    // Quan hệ với Product
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    // Quan hệ với Size
    public function size(): BelongsTo
    {
        return $this->belongsTo(Size::class);
    }
}

