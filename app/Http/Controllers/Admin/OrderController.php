<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $query = Order::query();

        if ($request->has('search')) {
            $search = $request->input('search');
        
            $query->where(function($query) use ($search) {
                $query->where('receive_address', 'like', '%' . $search . '%')
                      ->orWhere('code', 'like', '%' . $search . '%')
                      ->orWhereHas('status', function($subQuery) use ($search) {
                          $subQuery->where('name', 'like', '%' . $search . '%');
                      });
            });
        }        

        $perPage = $request->input('perPage', session('perPage', 5));
        session(['perPage' => $perPage]);
        $orders = $query->paginate($perPage);
        return view('admin.orders.index', compact('orders'));
    }

    public function update(Request $request, $id)
    {
        // Tìm đơn hàng theo ID
        $order = Order::find($id);

        // Kiểm tra nếu đơn hàng không tồn tại
        if (!$order) {
            return redirect()->back()->with('msg', 'Đơn hàng không tồn tại.');
        }


        // Xác thực dữ liệu
        

        // Cập nhật địa chỉ giao hàng
        $order->receive_address = $request->receive_address;

        // Cập nhật phí giao hàng
        $order->delivery_cost = $request->delivery;

        // Cập nhật trạng thái
        $order->status_id =$request->status;
        // Lưu thay đổi
        $order->save();

        // Trả về thông báo thành công
        return redirect()->back()->with('msg', 'Cập nhật đơn hàng thành công.');
    }
}
