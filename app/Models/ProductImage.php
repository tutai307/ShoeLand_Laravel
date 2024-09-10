<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
class ProductImage extends Model
{
    protected $table = 'product_images';

    protected $fillable = [
        'id', 'product_id', 'content', 'mainImage',
    ];

    use HasUuids;

    protected $primaryKey = 'id';
    public $incrementing = false; 
    protected $keyType = 'string';

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
