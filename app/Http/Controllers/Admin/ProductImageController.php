<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductImageController extends Controller
{
    public function index(Request $request, $product_id)
    {
        $search = $request->input('search');
        $perPage = $request->input('perPage', 10);

        $query = ProductImage::query();

        if ($product_id) {
            $query->where('product_id', $product_id);
        }

        if ($search) {
            $query->whereHas('product', function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%");
            });
        }

        $productImages = $query->with('product')->paginate($perPage);

        $product = Product::find($product_id);

        return view('admin.product_images.index', compact('productImages', 'product', 'product_id'));
    }

    public function store(Request $request, $product_id)
    {
        $request->validate([
            'content' => 'required|url',
            'mainImage' => 'nullable|boolean',
        ]);

        // Tạo mới ProductImage
        $productImage = new ProductImage();
        $productImage->id = (string) Str::uuid();
        $productImage->product_id = $product_id;
        $productImage->content = $request->content;

        // Nếu ảnh mới là ảnh chính, cập nhật tất cả các ảnh hiện tại của sản phẩm này thành ảnh phụ
        if ($request->has('mainImage') && $request->input('mainImage') == '1') {
            // Cập nhật tất cả các ảnh hiện tại của sản phẩm thành ảnh phụ
            ProductImage::where('product_id', $product_id)->update(['mainImage' => 0]);
            $productImage->mainImage = 1; // Đánh dấu ảnh mới là ảnh chính
        } else {
            $productImage->mainImage = 0; // Đánh dấu ảnh mới là ảnh phụ
        }

        $productImage->save();

        return redirect()->route('admin.product-images.index', ['product_id' => $product_id])->with('msg', 'Ảnh đã được thêm thành công.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'content' => 'required|url',
            'mainImage' => 'nullable|boolean',
        ]);

        // Tìm hình ảnh hiện tại
        $productImage = ProductImage::findOrFail($id);

        // Lấy ID của sản phẩm
        $productId = $productImage->product_id;

        // Kiểm tra nếu ảnh hiện tại được đánh dấu là ảnh chính
        $isMainImage = $request->input('mainImage', 0);

        // Nếu ảnh này là ảnh chính, cập nhật tất cả các ảnh khác thành ảnh phụ
        if ($isMainImage) {
            // Cập nhật tất cả các ảnh khác của sản phẩm thành ảnh phụ
            ProductImage::where('product_id', $productId)
                ->where('id', '!=', $id)
                ->update(['mainImage' => false]);
        }

        // Cập nhật thông tin của hình ảnh hiện tại
        $productImage->content = $request->content;
        $productImage->mainImage = $isMainImage; // Chỉ cập nhật nếu có giá trị
        $productImage->save();

        return redirect()->route('admin.product-images.index', ['product_id' => $productId])
            ->with('msg', 'Ảnh đã được cập nhật thành công.');
    }



    public function destroy($image_id)
    {
        $productImage = ProductImage::find($image_id);
        $product_id = $productImage->product_id;
        $productImage->delete();
        return redirect()->route('admin.product-images.index', ['product_id' => $product_id])->with('msg', 'Ảnh đã được xóa thành công.');
    }
}
