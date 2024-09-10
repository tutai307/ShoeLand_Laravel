<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
class StatusController extends Controller
{
    public function index(Request $request)
    {
        $query = Status::query();

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('name', 'like', '%' . $search . '%')
                ->orWhere('code', 'like', '%' . $search . '%');
        }

        $perPage = $request->input('perPage', session('perPage', 5));
        session(['perPage' => $perPage]);

        // Thêm lệnh sắp xếp theo mã tăng dần
        $query->orderBy('code', 'asc');

        $statuses = $query->paginate($perPage);

        return view('admin.statuses.index', compact('statuses'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:50|unique:statuses,code',
            'description' => 'nullable|string',
        ]);

        $status = new Status();
        $status->id = (string) Str::uuid();
        $status->name = $request->input('name');
        $status->code = $request->input('code');
        $status->description = $request->input('description');

        $status->save();

        return redirect()->route('admin.statuses.index')->with('msg', 'Trạng thái đã được thêm thành công.');
    }

    public function update(Request $request, Status $status)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:50|unique:statuses,code,' . $status->id,
            'description' => 'nullable|string',
        ]);

        // Update the status with the validated data
        $status->name = $request->input('name');
        $status->code = $request->input('code');
        $status->description = $request->input('description');

        $status->save();

        // Redirect back to the statuss index with a success message
        return redirect()->route('admin.statuses.index')->with('msg', 'Trạng thái đã được cập nhật thành công.');
    }

    public function destroy(Status $status)
    {
        $status->delete();

        return redirect()->route('admin.statuses.index')->with('msg', 'Trạng thái đã được xóa thành công.');
    }
}
