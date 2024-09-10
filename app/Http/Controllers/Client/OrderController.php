<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Mail\OrderInvoice;
use Illuminate\Http\Request;
use App\Models\CartItem;
use App\Models\Category;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

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
        return view('client.payments.index', compact('categories', 'order_items', 'payments'));
    }

    public function cancelUserOrder(Order $order)
    {
        // Kiểm tra nếu đơn hàng thuộc về người dùng đang đăng nhập
        if ($order->user_id !== auth()->id()) {
            return redirect()->route('orders.index')->with('msg', 'Bạn không có quyền hủy đơn hàng này.');
        }

        // Kiểm tra trạng thái đơn hàng để đảm bảo nó có thể bị hủy
        if ($order->status->name === 'Chờ xác nhận') {
            // Cập nhật trạng thái đơn hàng thành "Đã hủy"
            $order->status_id = "33c397a4-6523-4e4b-b011-b0a025b68f81";
            $order->save();

            // Thông báo thành công
            return redirect()->back()->with('msg', 'Đơn hàng của bạn đã được hủy thành công.');
        }

        // Thông báo lỗi nếu không thể hủy
        return redirect()->bsck()->with('msg', 'Không thể hủy đơn hàng.');
    }
}
