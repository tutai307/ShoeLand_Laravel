<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Order extends Model
{
    use HasUuids;

    protected $fillable = [
        'code',
        'user_id',
        'status_id',
        'receive_phone',
        'receive_address',
        'delivery_cost',
        'payment_id',
        'description',
    ];

    // Define the relationship with OrderItem
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    // Define the relationship with User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Define the relationship with Status
    public function status()
    {
        return $this->belongsTo(Status::class,'status_id');
    }
    public function payment()
    {
        return $this->belongsTo(Payment::class,'payment_id');
    }
}
