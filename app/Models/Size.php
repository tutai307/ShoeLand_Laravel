<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Size extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'code', 
        'name', 
        'description'
    ];

    protected $keyType = 'string';

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_sizes')->withPivot('quantity');
    }
}
