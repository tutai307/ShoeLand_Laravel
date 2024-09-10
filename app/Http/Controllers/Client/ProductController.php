<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Event;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function show($product_id)
    {
        // Lấy thông tin sản phẩm
        $product = Product::findOrFail($product_id);

        // Lấy danh sách các danh mục
        $categories = Category::all();

        // Lấy các hình ảnh của sản phẩm
        $images = ProductImage::where('product_id', $product_id)
            ->orderBy('mainImage', 'desc') // Đảm bảo ảnh chính nằm đầu tiên
            ->get();

        // Tách ảnh chính và ảnh phụ
        $mainImage = $images->where('mainImage', 1)->first();
        $otherImages = $images->where('mainImage', 0);

        if ($product->event) {
            $endDate = Carbon::parse($product->event->end_date);
            $eventEndTimestamp = $endDate->timestamp; // UNIX timestamp
        }

        $events = Event::all();
        $user = Auth::user();
        $products = Product::with(['mainImage', 'event'])->get();
        // Controller: Lấy các sản phẩm của Adidas
        $adidasCategory = Category::where('name', 'Adidas')->first();
        $adidasProducts = $adidasCategory ? Product::where('category_id', $adidasCategory->id)->get() : collect();

        return view('client.products.productDetail', compact('categories', 'product', 'mainImage', 'otherImages','eventEndTimestamp','events', 'products', 'adidasProducts','user'));
    }
}
