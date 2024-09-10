<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Event;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::query();

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('name', 'like', '%' . $search . '%')
                ->orWhere('code', 'like', '%' . $search . '%');
        }

        $perPage = $request->input('perPage', session('perPage', 10));
        session(['perPage' => $perPage]);

        $products = $query->paginate($perPage)->appends([
            'search' => $request->input('search'),
            'perPage' => $perPage
        ]);
        $categories = Category::all();
        $events = Event::all();

        return view('admin.products.index', compact('products', 'categories', 'events'));
    }


    public function create()
    {
        $categories = Category::all();
        $events = Event::all();
        return view('admin.products.create', compact('categories', 'events'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|unique:products',
            'name' => 'required',
            'price' => 'required|numeric',
            'description' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
            'event_id' => 'nullable|exists:events,id',
        ]);

        $product = new Product();
        $product->id = (string) Str::uuid();
        $product->code = $request->input('code');
        $product->name = $request->input('name');
        $product->price = $request->input('price');
        $product->description = $request->input('description');
        $product->category_id = $request->input('category_id');
        $product->event_id = $request->input('event_id');
        $product->save();

        return redirect()->route('admin.products.index')->with('msg', 'Product created successfully!');
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        $events = Event::all();
        return view('admin.products.edit', compact('product', 'categories', 'events'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'code' => 'required|unique:products,code,' . $id,
            'name' => 'required',
            'price' => 'required|numeric',
            'description' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
            'event_id' => 'nullable|exists:events,id',
        ]);

        $product = Product::findOrFail($id);
        $product->code = $request->input('code');
        $product->name = $request->input('name');
        $product->price = $request->input('price');
        $product->description = $request->input('description');
        $product->category_id = $request->input('category_id');
        $product->event_id = $request->input('event_id');
        $product->save();

        return redirect()->route('admin.products.index')->with('msg', 'Product updated successfully!');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('admin.products.index')->with('msg', 'Sản phẩm được xoá thành công!');
    }
}
