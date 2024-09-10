<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CartItem;
use App\Models\Category;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function checkout(Request $request)
    {

        $selectedItems = json_decode($request->input('selectedItems'), true);

        if (empty($selectedItems)) {
            return redirect()->back()->with('msg', 'Vui lòng chọn ít nhất một sản phẩm.');
        }

        // Lưu cart_id để sử dụng khi thanh toán thành công
        $cartIds = array_column($selectedItems, 'cart_id');

        // Lưu cart_id vào session hoặc database để xử lý sau khi thanh toán
        // session()->put('order_id', $order->id);
        session()->put('cart_ids', $cartIds);

        // Chuyển hướng đến trang thanh toán
        return redirect()->route('payment.index');
    }

    public function index()
    {
        $categories = Category::all();

        $cartIds = session('cart_ids');

        // Lấy các sản phẩm trong giỏ hàng từ CartItem
        $order_items = CartItem::whereIn('id', $cartIds)->get();

        $payments = Payment::all();
        // Truyền dữ liệu vào view
        return view('client.payments.index', compact('categories', 'order_items','payments'));
    }
}
