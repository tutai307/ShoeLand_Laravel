<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Thiagoprz\CompositeKey\HasCompositeKey;

class ProductSize extends Model
{
    use HasFactory;
    use HasCompositeKey;
    // Đặt tên bảng nếu không theo quy ước
    protected $table = 'product_sizes';

    // Chỉ định các thuộc tính có thể gán hàng loạt
    protected $fillable = [
        'product_id',
        'size_id',
        'quantity',
    ];

    // Khóa chính của bảng, khai báo với nhiều khóa chính
    protected $primaryKey = ['product_id', 'size_id'];
    
    public $incrementing = false;
    protected $keyType = 'string'; // Nếu bạn đang sử dụng UUID hoặc các kiểu khóa khác

    // Khai báo quan hệ với model Product
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    // Khai báo quan hệ với model Size
    public function size()
    {
        return $this->belongsTo(Size::class, 'size_id');
    }

    // Override phương thức `getKeyName` để xử lý nhiều khóa chính
    public function getKeyName()
    {
        return $this->primaryKey;
    }

    // Override phương thức `getKeyType` để xử lý nhiều khóa chính
    public function getKeyType()
    {
        return $this->keyType;
    }
}
