<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;
class Cart extends Model
{
    protected $fillable = [
        'id',
        'user_id',   // Thêm thuộc tính user_id vào đây
    ];
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';
    protected static function booted()
    {
        static::creating(function ($model) {
            $model->id = (string) Str::uuid();
        });
    }

    // Quan hệ với CartItem
    public function cartItems(): HasMany
    {
        return $this->hasMany(CartItem::class);
    }

    // Quan hệ với User
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
