<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query();

        if ($request->has('search')) {
            $search = $request->input('search');

            $query->where(function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%')
                    ->orWhere('email', 'like', '%' . $search . '%');
            });
        }

        $perPage = $request->input('perPage', session('perPage', 5));
        session(['perPage' => $perPage]);
        $users = $query->paginate($perPage);
        return view('admin.users.index', compact('users'));
    }

    public function store(Request $request)
    {
        // Xác thực dữ liệu
        $validated = $request->validate([
            'username' => 'required|string|max:255|unique:users,username',
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
            'role' => 'required|in:admin,client',
        ]);

        // Tạo người dùng mới
        User::create([
            'username' => $validated['username'],
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => $validated['role'],
        ]);

        // Trả về thông báo thành công
        return redirect()->back()->with('msg', 'Thêm người dùng thành công.');
    }


    public function update(Request $request, $id)
    {
        // Tìm người dùng theo ID
        $user = User::find($id);

        // Kiểm tra nếu người dùng không tồn tại
        if (!$user) {
            return redirect()->back()->with('msg', 'Người dùng không tồn tại.');
        }

        // Xác thực dữ liệu
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'role' => 'required|in:admin,client',
            'email' => 'nullable|email|unique:users,email,' . $user->id, // Email chỉ có thể thay đổi nếu chưa có
        ]);

        // Cập nhật tên người dùng
        $user->name = $validated['name'];

        // Nếu người dùng chưa có email và trong form có email mới thì cập nhật
        if (!$user->email && $request->filled('email')) {
            $user->email = $validated['email'];
        }

        // Cập nhật vai trò
        $user->role = $validated['role'];

        // Lưu thay đổi
        $user->save();

        // Trả về thông báo thành công
        return redirect()->back()->with('msg', 'Cập nhật người dùng thành công.');
    }

    public function destroy($id)
    {
        // Tìm người dùng theo ID
        $user = User::find($id);

        // Kiểm tra nếu người dùng không tồn tại
        if (!$user) {
            return redirect()->back()->with('msg', 'Người dùng không tồn tại.');
        }

        // Thực hiện xóa người dùng
        $user->delete();

        // Trả về thông báo thành công
        return redirect()->back()->with('msg', 'Xóa người dùng thành công.');
    }
}
