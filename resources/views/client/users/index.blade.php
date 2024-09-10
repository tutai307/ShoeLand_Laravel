@extends('client.layouts.app')

@section('content')
    <div class="container">
        <div class="container my-4 appCard">
            <table class="table table-hover table-striped">
                <legend class="text-center my-4">
                    <b>Đơn Hàng Đã Đặt</b>
                </legend>

                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Mã Đơn Hàng</th>
                        <th>Ngày Đặt Hàng</th>
                        <th>Trạng Thái</th>
                        <th>Tổng Tiền</th>
                        <th>Chi Tiết</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    @php
                        $count = 0;
                    @endphp
                    @forelse ($orders as $index => $order)
                        @php
                            $count++;
                        @endphp
                        <tr>
                            <td class="align-middle">{{ $count }}</td>
                            <td class="align-middle">{{ $order->code }}</td>
                            <td class="align-middle">{{ $order->created_at->format('d/m/Y H:i') }}</td>
                            <td class="align-middle">{{ $order->status->name }}</td>
                            <td class="align-middle">
                                {{ number_format(
                                    $order->items->sum(function ($item) {
                                        return $item->quantity * $item->unit_price;
                                    }) + $order->delivery_cost,
                                    0,
                                    ',',
                                    '.',
                                ) }}
                                VND
                            </td>
                            <td class="align-middle">
                                <!-- Nút mở modal -->
                                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#infoOrderModal{{ $order->id }}">
                                    Xem
                                </button>
                                <!-- Nút huỷ đơn hàng -->
                                @if ($order->status->name === 'Chờ xác nhận')
                                    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#cancelOrderModal{{ $order->id }}">
                                        Huỷ
                                    </button>
                                @else
                                    <button type="button" class="btn btn-danger btn-sm" disabled>
                                        Huỷ
                                    </button>
                                @endif

                                <button type="button" class="btn btn-info btn-sm" onclick="event.preventDefault(); document.getElementById('sendBillForm{{ $order->id }}').submit();">
                                    Gửi hóa đơn
                                </button>
                                
                                <form id="sendBillForm{{ $order->id }}" action="{{ route('orders.sendMail', $order->id) }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                                

                                <!-- Modal Huỷ Đơn Hàng -->
                                <div class="modal fade" id="cancelOrderModal{{ $order->id }}" tabindex="-1"
                                    aria-labelledby="cancelOrderModalLabel{{ $order->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="cancelOrderModalLabel{{ $order->id }}">Xác
                                                    Nhận
                                                    Huỷ Đơn Hàng</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Bạn có chắc chắn muốn hủy đơn hàng #{{ $order->code }}? Điều này sẽ không
                                                thể
                                                hoàn tác.
                                            </div>
                                            <div class="modal-footer">
                                                <form action="{{ route('orders.cancel', $order->id) }}" method="POST">
                                                    @csrf
                                                    @method('POST')
                                                    <button type="submit" class="btn btn-danger">Huỷ Đơn Hàng</button>
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Đóng</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <!-- Modal -->
                                <div class="modal fade" id="infoOrderModal{{ $order->id }}" tabindex="-1"
                                    aria-labelledby="infoOrderModalLabel{{ $order->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="infoOrderModalLabel{{ $order->id }}">Chi
                                                    tiết
                                                    đơn hàng #{{ $order->code }}</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <p class="col"><strong>Mã đơn hàng:</strong> {{ $order->code }}</p>
                                                    <p class="col"><strong>Ngày đặt hàng:</strong>
                                                        {{ $order->created_at->format('d/m/Y H:i') }}</p>
                                                </div>
                                                <div class="row">
                                                    <p class="col"><strong>Người đặt:</strong>
                                                        {{ $order->user->name }}</p>
                                                    <p class="col"><strong>Phí vận chuyển:</strong>
                                                        {{ number_format($order->delivery_cost, 0, ',', '.') }} VND</p>
                                                </div>
                                                <p><strong>Địa chỉ giao hàng:</strong> {{ $order->receive_address }}</p>

                                                <h6>Danh sách sản phẩm:</h6>
                                                <ul>
                                                    @php
                                                        $total = 0; // Biến tính tổng tiền sản phẩm
                                                    @endphp
                                                    @foreach ($order->items as $item)
                                                        <li class="d-flex align-items-center mb-3">
                                                            <!-- Hình ảnh sản phẩm -->
                                                            <img src="{{ $item->product->mainImage->content ?? 'path/to/default/image.jpg' }}"
                                                                alt="{{ $item->product->name }}" class="img-thumbnail me-3"
                                                                style="width: 100px; height: auto;">

                                                            <!-- Thông tin sản phẩm -->
                                                            <div>
                                                                <p class="mb-1"><strong>Tên sản phẩm:</strong>
                                                                    {{ $item->product->name }}</p>
                                                                <p class="mb-1"><strong>Số lượng:</strong>
                                                                    {{ $item->quantity }}</p>
                                                                <p class="mb-1"><strong>Giá:</strong>
                                                                    {{ number_format($item->unit_price, 0, ',', '.') }} VND
                                                                </p>
                                                            </div>

                                                            @php
                                                                // Tính tổng tiền cho từng sản phẩm (số lượng * giá mỗi đơn vị)
                                                                $total += $item->quantity * $item->unit_price;
                                                            @endphp
                                                        </li>
                                                    @endforeach
                                                </ul>

                                                <!-- Tính tổng tiền (cộng thêm phí vận chuyển) -->
                                                <p><strong>Tổng tiền:</strong>
                                                    {{ number_format($total + $order->delivery_cost, 0, ',', '.') }} VND
                                                </p>

                                                <!-- Hiển thị tình trạng đơn hàng -->
                                                <p><strong>Tình trạng đơn hàng:</strong>
                                                    {{ $order->status->name }}
                                                </p>

                                                <!-- Hiển thị phương thức thanh toán -->
                                                <p><strong>Phương thức thanh toán:</strong>
                                                    {{ $order->payment->name }}
                                                </p>

                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Đóng</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td class="align-middle" colspan="6" class="text-center">Chưa có Đơn Hàng nào.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <!-- Thêm phân trang -->

        </div>
        <div class="container appCard my-4 border rounded blur-border">
            <legend class="text-center fw-bold my-4">Thông Tin Cá Nhân</legend>
            <form id="updateForm" action="{{ route('info.update') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Tên</label>
                    <input type="text" class="form-control" id="name" name="name"
                        value="{{ $user->name }}" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email"
                        value="{{ $user->email }}" required>
                </div>

                <!-- Thêm trường mật khẩu hiện tại -->
                <div class="mb-3">
                    <label for="current_password" class="form-label">Mật Khẩu Hiện Tại</label>
                    <input type="password" class="form-control" id="current_password" name="current_password">
                </div>

                <!-- Thêm trường mật khẩu mới -->
                <div class="mb-3">
                    <label for="new_password" class="form-label">Mật Khẩu Mới</label>
                    <input type="password" class="form-control" id="new_password" name="new_password">
                </div>

                <!-- Thêm trường xác nhận mật khẩu -->
                <div class="mb-3">
                    <label for="confirm_password" class="form-label">Xác Nhận Mật Khẩu Mới</label>
                    <input type="password" class="form-control" id="confirm_password" name="confirm_password">
                </div>

                <button type="submit" class="btn btn-primary my-4">Lưu Thay Đổi</button>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('updateForm');
            form.addEventListener('submit', function(event) {
                let isValid = true;
                const currentPassword = document.getElementById('current_password').value;
                const newPassword = document.getElementById('new_password').value;
                const confirmPassword = document.getElementById('confirm_password').value;
                const passwordError = document.createElement('div');
                passwordError.classList.add('text-danger');

                // Remove any previous error messages
                const existingError = document.querySelector('.text-danger');
                if (existingError) {
                    existingError.remove();
                }

                // Validate password fields if new password is provided
                if (newPassword || confirmPassword) {
                    if (!currentPassword) {
                        isValid = false;
                        form.insertAdjacentHTML('beforeend',
                            '<div class="text-danger">Mật khẩu hiện tại là bắt buộc khi thay đổi mật khẩu mới.</div>'
                        );
                    }
                    if (newPassword && newPassword.length < 8) {
                        isValid = false;
                        form.insertAdjacentHTML('beforeend',
                            '<div class="text-danger">Mật khẩu mới phải có ít nhất 8 ký tự.</div>');
                    }
                    if (newPassword !== confirmPassword) {
                        isValid = false;
                        form.insertAdjacentHTML('beforeend',
                            '<div class="text-danger">Xác nhận mật khẩu không khớp.</div>');
                    }
                }

                if (!isValid) {
                    event.preventDefault(); // Prevent form submission
                }
            });
        });

        @if (session('msg'))
            const Toast = Swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.onmouseenter = Swal.stopTimer;
                    toast.onmouseleave = Swal.resumeTimer;
                }
            });
            Toast.fire({
                icon: "success",
                title: "{{ session('msg') }}"
            });
        @endif
    </script>
@endsection
