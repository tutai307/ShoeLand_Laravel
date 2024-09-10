<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi tiết đơn hàng #{{ $order->code }}</title>
</head>

<body>
    <h2>Chi tiết đơn hàng #{{ $order->code }}</h2>
    <div>
        <p><strong>Mã đơn hàng:</strong> {{ $order->code }}</p>
        <p><strong>Ngày đặt hàng:</strong> {{ $order->created_at->format('d/m/Y H:i') }}</p>
    </div>
    <div>
        <p><strong>Người đặt:</strong> {{ $order->user->name }}</p>
        <p><strong>Phí vận chuyển:</strong> {{ number_format($order->delivery_cost, 0, ',', '.') }} VND</p>
    </div>
    <p><strong>Địa chỉ giao hàng:</strong> {{ $order->receive_address }}</p>

    <h3>Danh sách sản phẩm:</h3>
    <ul>
        @php
            $total = 0; // Biến tính tổng tiền sản phẩm
        @endphp
        @foreach ($order->items as $item)
            <li style="margin-bottom: 20px;">
                <!-- Thông tin sản phẩm -->
                <img src="{{ $item->product->mainImage->content ?? 'path/to/default/image.jpg' }}"
                    alt="{{ $item->product->name }}" class="img-thumbnail me-3" style="width: 100px; height: auto;">
                <p><strong>Tên sản phẩm:</strong> {{ $item->product->name }}</p>
                <p><strong>Số lượng:</strong> {{ $item->quantity }}</p>
                <p><strong>Giá:</strong> {{ number_format($item->unit_price, 0, ',', '.') }} VND</p>

                @php
                    // Tính tổng tiền cho từng sản phẩm
                    $total += $item->quantity * $item->unit_price;
                @endphp
            </li>
        @endforeach
    </ul>

    <!-- Tính tổng tiền (cộng thêm phí vận chuyển) -->
    <p><strong>Tổng tiền:</strong> {{ number_format($total + $order->delivery_cost, 0, ',', '.') }} VND</p>

    <!-- Hiển thị tình trạng đơn hàng -->
    <p><strong>Tình trạng đơn hàng:</strong> {{ $order->status->name }}</p>

    <!-- Hiển thị phương thức thanh toán -->
    <p><strong>Phương thức thanh toán:</strong> {{ $order->payment->name }}</p>
</body>

</html>
