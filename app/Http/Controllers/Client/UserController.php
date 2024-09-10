<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function viewInfo()
    {
        $categories = Category::all();
        $user = Auth::user();
        $orders = auth()->user()->orders; 
        return view('client.users.index', compact('categories', 'user','orders'));
    }

    public function updateInfo(Request $request)
    {
        /** @var \App\Models\User $user **/
        $user = Auth::user();

        // Cập nhật thông tin người dùng
        $user->name = $request->name;
        $user->email = $request->email;

        // Cập nhật mật khẩu nếu có mật khẩu mới
        try {
            // Lưu các thay đổi
            $user->save();
        } catch (\Exception $e) {
            // Xử lý lỗi
            return back()->with(['msg' => $e->getMessage()]);
        }

        // Trả về thông báo thành công
        return redirect()->back()->with('msg', 'Cập nhật thông tin thành công.');
    }

}
