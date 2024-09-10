<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\CartItem;
use App\Models\Category;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use App\Models\Product;
use App\Models\ProductSize;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    public function handle(Request $request)
    {
        $order = new Order();
        $payment_id = $request->paymentMethod;
        $payment_code = Payment::find($payment_id)->code;
        $today = date("Ymd");
        $rand = strtoupper(substr(uniqid(sha1(time())), 0, 4));
        $unique = $today . $rand;
        $order->code = $unique;
        $order->user_id = auth()->id();
        $order->status_id = '172e536d-61f8-4ecb-8d97-83e1e9c5fb5e';
        $order->receive_phone = $request->phone;
        $order->receive_address = $request->ward . ", " . $request->district . ", " . $request->province;
        $order->delivery_cost = $request->delivery;
        $order->payment_id = $request->paymentMethod;
        $order->save();
        session()->put('orderId', $order->id);
        if ($payment_code == "#ATM") {
            return $this->handleMoMoPayment($order, $request);
        } else {
            $products = Product::with(['mainImage', 'event'])->get();
            $categories = Category::all();
            $resultCode = $request->get('resultCode'); // Kết quả giao dịch
            $order_id = session('orderId');
            $cart_ids = session('cart_ids');
            foreach ($cart_ids as $cart_id) {
                // Tìm CartItem theo ID
                $cartItem = CartItem::find($cart_id);

                if ($cartItem) {
                    // Tìm bản ghi tồn kho từ bảng product_sizes bằng product_id và size_id
                    $productSize = DB::table('product_sizes')
                        ->where('product_id', $cartItem->product_id)
                        ->where('size_id', $cartItem->size_id)
                        ->first();

                    if ($productSize) {
                        // Kiểm tra nếu số lượng tồn kho hiện tại đủ để trừ
                        if ($productSize->quantity >= $cartItem->quantity) {
                            // Giảm số lượng tồn kho
                            DB::table('product_sizes')
                                ->where('product_id', $cartItem->product_id)
                                ->where('size_id', $cartItem->size_id)
                                ->decrement('quantity', $cartItem->quantity);
                        } else {
                            // Nếu số lượng tồn không đủ, có thể thông báo lỗi hoặc hủy đơn hàng
                            return redirect()->route('cart.view')->with('error', 'Số lượng sản phẩm không đủ trong kho.');
                        }
                    } else {
                        return redirect()->route('cart.view')->with('error', 'Sản phẩm không tồn tại hoặc hết hàng.');
                    }

                    // Thêm vào bảng order_items
                    $new_order_item = new OrderItem();
                    $new_order_item->order_id = $order_id;
                    $new_order_item->product_id = $cartItem->product_id;
                    $new_order_item->size_id = $cartItem->size_id;
                    $new_order_item->quantity = $cartItem->quantity;
                    $new_order_item->unit_price = $cartItem->unit_price;
                    $new_order_item->save();

                    // Xóa cart item sau khi thêm vào order_items
                    $cartItem->delete();
                }
            }
            return view('client.payments.thanks', compact('categories', 'products'));
        }
    }

    private function handleMoMoPayment($order, $request)
    {
        $endpoint = "https://test-payment.momo.vn/v2/gateway/api/create";

        $partnerCode = 'MOMOBKUN20180529';
        $accessKey = 'klm05TvNBzhg7h7j';
        $secretKey = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa';
        $orderInfo = "Thanh toán qua MoMo đơn hàng của ShoesLand";
        $amount = $_POST['totalAmount'] + $_POST['delivery'];
        $orderId = time() . "";
        $redirectUrl = route('payment.thanks', ['orderId' => $order->id]);
        $ipnUrl = route('payment.thanks', ['orderId' => $order->id]);
        $extraData = "";

        $partnerCode = $partnerCode;
        $accessKey = $accessKey;
        $serectkey = $secretKey;
        $orderId = $orderId; // Mã đơn hàng
        $orderInfo = $orderInfo;
        $amount = $amount;
        $ipnUrl = $ipnUrl;
        $redirectUrl = $redirectUrl;
        $extraData = "";

        $requestId = time() . "";
        $requestType = "payWithATM";
        $extraData = "";
        //before sign HMAC SHA256 signature
        $rawHash = "accessKey=" . $accessKey . "&amount=" . $amount . "&extraData=" . $extraData . "&ipnUrl=" . $ipnUrl . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo . "&partnerCode=" . $partnerCode . "&redirectUrl=" . $redirectUrl . "&requestId=" . $requestId . "&requestType=" . $requestType;
        $signature = hash_hmac("sha256", $rawHash, $serectkey);
        $data = array(
            'partnerCode' => $partnerCode,
            'partnerName' => "Test",
            "storeId" => "MomoTestStore",
            'requestId' => $requestId,
            'amount' => $amount,
            'orderId' => $orderId,
            'orderInfo' => $orderInfo,
            'redirectUrl' => $redirectUrl,
            'ipnUrl' => $ipnUrl,
            'lang' => 'vi',
            'extraData' => $extraData,
            'requestType' => $requestType,
            'signature' => $signature
        );

        // Gọi API MoMo
        $result = $this->execPostRequest($endpoint, json_encode($data));
        $jsonResult = json_decode($result, true);

        // Kiểm tra phản hồi từ MoMo
        if (isset($jsonResult['payUrl'])) {
            return redirect($jsonResult['payUrl']);
        } else {
            return redirect('cart.view')->with('error', 'Giao dịch bị huỷ bởi MoMo.');
        }
    }

    // Hàm thực hiện request POST
    private function execPostRequest($url, $data)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt(
            $ch,
            CURLOPT_HTTPHEADER,
            array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data)
            )
        );
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        //execute post
        $result = curl_exec($ch);
        //close connection
        curl_close($ch);
        return $result;
    }


    public function thanks(Request $request)
    {
        $products = Product::with(['mainImage', 'event'])->get();
        $categories = Category::all();
        $resultCode = $request->get('resultCode'); // Kết quả giao dịch
        $order_id = session('orderId');
        $cart_ids = session('cart_ids');

        if ($resultCode == '0') {
            // Giao dịch thành công
            foreach ($cart_ids as $cart_id) {
                // Tìm CartItem theo ID
                $cartItem = CartItem::find($cart_id);

                if ($cartItem) {
                    // Tìm bản ghi tồn kho từ bảng product_sizes bằng product_id và size_id
                    $productSize = DB::table('product_sizes')
                        ->where('product_id', $cartItem->product_id)
                        ->where('size_id', $cartItem->size_id)
                        ->first();

                    if ($productSize) {
                        // Kiểm tra nếu số lượng tồn kho hiện tại đủ để trừ
                        if ($productSize->quantity >= $cartItem->quantity) {
                            // Giảm số lượng tồn kho
                            DB::table('product_sizes')
                                ->where('product_id', $cartItem->product_id)
                                ->where('size_id', $cartItem->size_id)
                                ->decrement('quantity', $cartItem->quantity);
                        } else {
                            // Nếu số lượng tồn không đủ, có thể thông báo lỗi hoặc hủy đơn hàng
                            return redirect()->route('cart.view')->with('error', 'Số lượng sản phẩm không đủ trong kho.');
                        }
                    } else {
                        return redirect()->route('cart.view')->with('error', 'Sản phẩm không tồn tại hoặc hết hàng.');
                    }

                    // Thêm vào bảng order_items
                    $new_order_item = new OrderItem();
                    $new_order_item->order_id = $order_id;
                    $new_order_item->product_id = $cartItem->product_id;
                    $new_order_item->size_id = $cartItem->size_id;
                    $new_order_item->quantity = $cartItem->quantity;
                    $new_order_item->unit_price = $cartItem->unit_price;
                    $new_order_item->save();

                    // Xóa cart item sau khi thêm vào order_items
                    $cartItem->delete();
                }
            }

            return view('client.payments.thanks', compact('categories', 'products'));
        } else {
            // Giao dịch thất bại hoặc bị hủy
            $orderCancel = Order::find($order_id);
            $orderCancel->delete();
            return redirect()->route('cart.view')->with('msg', 'Đơn hàng bị huỷ bởi người dùng!');
        }
    }
}
