<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Event;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $events = Event::all();
        $products = Product::with(['mainImage', 'event'])->get();
        // Controller: Lấy các sản phẩm của Adidas
        $adidasCategory = Category::where('name', 'Adidas')->first();
        $adidasProducts = $adidasCategory ? Product::where('category_id', $adidasCategory->id)->get() : collect();
        return view('client.home', compact('events', 'categories', 'products', 'adidasProducts'));
    }
}
