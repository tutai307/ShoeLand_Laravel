<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Mail\ConfirmEmailChange;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function viewInfo()
    {
        $categories = Category::all();
        $user = Auth::user();
        $orders = auth()->user()->orders;
        return view('client.users.index', compact('categories', 'user', 'orders'));
    }

    public function updateInfo(Request $request)
    {
        /** @var \App\Models\User $user **/
        $user = Auth::user();
        $newEmail = $request->email;

        // Cập nhật tên
        $user->name = $request->name;

        // Kiểm tra xem email mới đã tồn tại chưa
        $existingUser = User::where('email', $newEmail)->first();

        if ($existingUser && $existingUser->id !== $user->id) {
            return redirect()->back()->with('msg', 'Email đã được sử dụng. Vui lòng chọn email khác.');
        } else {
            // Gửi email xác nhận đến địa chỉ email mới nếu email thay đổi
            if ($user->email !== $newEmail) {
                $user->email = $newEmail;
                $user->email_verified_at = null; // Xóa trạng thái xác thực email

                // Gửi email xác nhận thay đổi địa chỉ email
                Mail::to($newEmail)->send(new ConfirmEmailChange($user, $newEmail));

                return redirect()->back()->with('msg', 'Cập nhật email thành công. Vui lòng kiểm tra email để xác nhận.');
            }
        }

        // Cập nhật mật khẩu nếu có mật khẩu mới
        if ($request->filled('new_password')) {
            // Kiểm tra mật khẩu hiện tại
            if (Hash::check($request->current_password, $user->password)) {
                $user->password = bcrypt($request->new_password);
            } else {
                return back()->with('error', 'Mật khẩu hiện tại không chính xác.');
            }
        }

        try {
            $user->save();
        } catch (\Exception $e) {
            return back()->with(['msg' => $e->getMessage()]);
        }

        return redirect()->back()->with('msg', 'Cập nhật thông tin thành công.');
    }


    public function confirmEmail($token)
    {
        /** @var \App\Models\User $user **/
        $user = Auth::user();

        if ($user->email_verification_token === $token) {
            // Cập nhật email mới
            $user->email = session('new_email');
            $user->email_verification_token = null;
            $user->save();

            return redirect()->route('profile')->with('msg', 'Email đã được xác nhận thành công.');
        }

        return redirect()->route('profile')->with('msg', 'Token không hợp lệ.');
    }
}
