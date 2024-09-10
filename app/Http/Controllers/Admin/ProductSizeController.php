<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductSize;
use App\Models\Size; // Model cho kích thước sản phẩm
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductSizeController extends Controller
{
    // Hiển thị danh sách kích thước sản phẩm
    public function index(Request $request, $product_id)
    {
        $search = $request->input('search');
        $perPage = $request->input('perPage', 5);

        $query = ProductSize::query();

        if ($product_id) {
            $query->where('product_id', $product_id);
        }

        $product_sizes = $query->paginate($perPage);
        $sizes = Size::all();
        $product = Product::find($product_id);

        return view('admin.product_sizes.index', compact('sizes', 'product_sizes', 'product', 'product_id'));
    }

    // Tạo mới kích thước sản phẩm
    public function store(Request $request, $product_id)
    {
        $request->validate([
            'size_id' => 'required|exists:sizes,id', // Đảm bảo size_id tồn tại trong bảng sizes
            'quantity' => 'required|integer|min:0', // Đảm bảo quantity là số nguyên không âm
        ]);

        // Tạo mới ProductSize
        $productSize = new ProductSize();
        $productSize->product_id = $product_id;
        $productSize->size_id = $request->size_id;
        $productSize->quantity = $request->quantity;

        $productSize->save();

        return redirect()->route('admin.product-sizes.index', ['product_id' => $product_id])
            ->with('msg', 'Kích thước sản phẩm đã được thêm thành công.');
    }

    // Cập nhật thông tin kích thước sản phẩm
    public function update(Request $request, $product_id, $size_id)
    {
        $request->validate([
            'quantity' => 'required|integer|min:0',
        ]);
        // Tìm đối tượng ProductSize dựa trên product_id và size_id
        $productSize = ProductSize::where('product_id', $product_id)
            ->where('size_id', $size_id)
            ->firstOrFail();

        // Cập nhật số lượng
        $productSize->quantity = $request->input('quantity');
        $productSize->save();
        return redirect()->route('admin.product-sizes.index', ['product_id' => $product_id])->with('msg', 'Số lượng kích thước sản phẩm đã được cập nhật thành công.');
    }

    // Xóa kích thước sản phẩm
    public function destroy($product_id, $size_id)
    {
        $productSize = ProductSize::where('product_id', $product_id)
            ->where('size_id', $size_id)
            ->firstOrFail();
        $productSize->delete();

        return redirect()->route('admin.product-sizes.index', ['product_id' => $product_id])
            ->with('msg', 'Kích thước sản phẩm đã được xóa thành công.');
    }
}
