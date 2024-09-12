<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class SearchingController extends Controller
{
    public function index(Request $request)
    {
        // Lấy từ khóa tìm kiếm từ request
        $key = $request->input('key');

        // Tìm kiếm sản phẩm theo tên hoặc mô tả
        $products = Product::where('name', 'like', '%' . $key . '%')
            ->orWhere('code', 'like', '%' . $key . '%')
            ->paginate(12); // Phân trang, mỗi trang hiển thị 12 sản phẩm
        $categories = Category::all();
        // Trả về view với danh sách sản phẩm tìm được
        return view('client.searchings.index', compact('products','categories'));
    }
}
