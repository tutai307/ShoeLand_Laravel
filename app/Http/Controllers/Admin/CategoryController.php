<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Str;
use PhpParser\Node\Stmt\Catch_;
use Illuminate\Support\Facades\Log;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $query = Category::query();

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('name', 'like', '%' . $search . '%')
                ->orWhere('code', 'like', '%' . $search . '%');
        }

        $perPage = $request->input('perPage', session('perPage', 5));
        session(['perPage' => $perPage]);

        // Sử dụng $query để phân trang
        $categories = $query->paginate($perPage);

        return view('admin.categories.index', compact('categories'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'description' => 'nullable|string',
        ]);

        $category = new Category();
        $category->id = (string) Str::uuid(); // Tạo UUID cho danh mục
        $category->code = $request->code;
        $category->name = $request->name;
        $category->description = $request->description;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('categories', 'public');
            $category->image = $imagePath;
        }

        $category->save();
        return redirect()->route('admin.categories.index')->with('msg', 'Danh mục đã được thêm mới thành công.');
    }

    public function update(Request $request, Category $category)
    {
        // Validate dữ liệu từ form
        $request->validate([
            'code' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'description' => 'nullable|string',
        ]);

        // Cập nhật danh mục
        $category = Category::find($category->id);
        $category->code = $request->code;
        $category->name = $request->name;
        $category->description = $request->description;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('categories', 'public');
            $category->image = $imagePath;
        }

        $category->save();
        return redirect()->route('admin.categories.index')->with('msg', 'Danh mục đã được cập nhật thành công.');
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('admin.categories.index')->with('msg', 'Danh mục đã được xóa thành công.');
    }
}
