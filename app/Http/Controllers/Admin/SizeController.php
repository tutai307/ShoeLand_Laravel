<?php

namespace App\Http\Controllers\Admin;

use App\Models\Size;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SizeController extends Controller
{
    public function index(Request $request)
    {
        $query = Size::query();

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('name', 'like', '%' . $search . '%')
                  ->orWhere('code', 'like', '%' . $search . '%');
        }

        $perPage = $request->input('perPage', session('perPage', 5));
        session(['perPage' => $perPage]);

        $sizes = $query->paginate($perPage);
        return view('admin.sizes.index', compact('sizes'));
    }
    public function create()
    {
        return view('admin.sizes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|unique:sizes',
            'name' => 'required',
        ]);

        Size::create($request->all());

        return redirect()->route('admin.sizes.index')->with('msg', 'Kích cỡ đã được thêm thành công.');
    }

    public function edit(Size $size)
    {
        return view('admin.sizes.edit', compact('size'));
    }

    public function update(Request $request, Size $size)
    {
        $request->validate([
            'code' => 'required|unique:sizes,code,' . $size->id,
            'name' => 'required',
        ]);

        $size->update($request->all());

        return redirect()->route('admin.sizes.index')->with('msg', 'Kích cỡ đã được cập nhật thành công.');
    }

    public function destroy(Size $size)
    {
        $size->delete();

        return redirect()->route('admin.sizes.index')->with('msg', 'Kích cỡ đã được xóa thành công.');
    }
}

