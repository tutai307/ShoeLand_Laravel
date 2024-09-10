<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
class CustomAuthController extends Controller
{

    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Xử lý đăng ký người dùng
    public function register(Request $request)
    {
        $existEmail = User::where('username', $request->username)->first();
        if ($existEmail) {
            return back()->with(['msg'=>'Tên đăng nhập này đã có người sử dụng.','icon'=>'error']);
        }

        // Tạo người dùng mới
        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'password' => bcrypt($request->password),
        ]);

        return back()->with(['msg'=>'Đăng ký thành công.','icon'=>'success']);
    }

    // Xử lý đăng nhập
    public function login(Request $request)
    {
        // Tìm người dùng theo email
        $user = User::where('username', $request->username)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            // Đăng nhập
            Auth::login($user);
            $request->session()->regenerate();
            if($user->role === 'admin') return redirect()->route('admin.dashboard.index');
            else return redirect()->route('home');
        }
        // Nếu đăng nhập thất bại
        return back()->with(['msg'=>'Email hoặc mật khẩu không đúng.','icon'=>'error']);
    }


    // Xử lý đăng xuất
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login'); // Chuyển hướng về trang đăng nhập
    }
}
