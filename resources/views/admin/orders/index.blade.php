@extends('admin.layouts.app')

@section('title', 'Đơn Hàng')

@section('content')
    <div class="container my-4 appCard">
        <table class="table table-hover table-striped">
            <legend class="text-center my-4">
                <b>Quản lý Đơn Hàng</b>
            </legend>
            <div class="text-left d-flex justify-content-between align-items-center mb-3">
                <div>
                    <form method="GET" action="{{ route('admin.orders.index') }}">
                        <div class="input-group">
                            <input type="text" class="form-control" name="search" placeholder="Search..."
                                value="{{ request()->input('search') }}">
                            <button class="btn btn-outline-primary" type="submit">
                                <i class="fa-solid fa-magnifying-glass"></i>
                                Search
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <thead>
                <tr>
                    <th>STT</th>
                    <th>Mã</th>
                    <th>Số điện thoại</th>
                    <th>Địa chỉ</th>
                    <th>Phí giao hàng</th>
                    <th>Trạng thái</th>
                    <th>Xem chi tiết</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($orders as $index => $order)
                    <tr>
                        <td class="align-middle">{{ $orders->firstItem() + $index }}</td>
                        <td class="align-middle">{{ $order->code }}</td>
                        <td class="align-middle">{{ $order->receive_phone }}</td>
                        <td class="align-middle">{{ $order->receive_address }}</td>
                        <td class="align-middle">{{ number_format($order->delivery_cost, 0, ',', '.') }}</td>
                        <td class="align-middle">{{ $order->status->name }}</td>
                        <td class="align-middle">
                            <!-- Nút mở modal -->
                            <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                data-bs-target="#editOrderModal{{ $order->id }}">
                                <i class="fa-solid fa-pencil"></i>
                            </button>
                            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                data-bs-target="#infoOrderModal{{ $order->id }}">
                                <i class="fa-solid fa-inbox"></i>
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="infoOrderModal{{ $order->id }}" tabindex="-1"
                                aria-labelledby="infoOrderModalLabel{{ $order->id }}" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="infoOrderModalLabel{{ $order->id }}">Chi tiết
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

                                            <!-- Danh sách sản phẩm -->
                                            <h6>Danh sách sản phẩm:</h6>
                                            <ul>
                                                @php
                                                    $total = 0; // Biến tính tổng tiền sản phẩm
                                                @endphp
                                                @foreach ($order->items as $item)
                                                    <li>{{ $item->product->name }} - Số lượng: {{ $item->quantity }} -
                                                        Giá: {{ number_format($item->unit_price, 0, ',', '.') }} VND
                                                    </li>
                                                    @php
                                                        // Tính tổng tiền cho từng sản phẩm (số lượng * giá mỗi đơn vị)
                                                        $total += $item->quantity * $item->unit_price;
                                                    @endphp
                                                @endforeach
                                            </ul>
                                            <!-- Tính tổng tiền (cộng thêm phí vận chuyển) -->
                                            <p><strong>Tổng tiền:</strong>
                                                {{ number_format($total + $order->delivery_cost, 0, ',', '.') }} VND</p>

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
                    @include('admin.orders.edit')
                @empty
                    <tr>
                        <td class="align-middle" colspan="7" class="text-center">Chưa có Đơn Hàng nào.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <!-- Thêm phân trang -->
        <div class="d-flex justify-content-center mt-3">
            <div class="d-inline-flex p-2 bd-highlight">
                <label for="perPage" class="me-2">Hiển thị:</label>
            </div>
            <form method="GET" action="{{ route('admin.orders.index') }}" class="me-2">
                <select id="perPage" name="perPage" class="form-select" aria-label="Số mục trên trang"
                    onchange="this.form.submit()">
                    <option value="5" {{ request()->perPage == '5' ? 'selected' : '' }}>5</option>
                    <option value="10" {{ request()->perPage == '10' ? 'selected' : '' }}>10</option>
                    <option value="15" {{ request()->perPage == '15' ? 'selected' : '' }}>15</option>
                </select>
            </form>
            {{ $orders->links('vendor.pagination.bootstrap') }}
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        @if (session('msg'))
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.onmouseenter = Swal.stopTimer;
                    toast.onmouseleave = Swal.resumeTimer;
                }
            });
            Toast.fire({
                icon: 'success',
                title: '{{ session('msg') }}'
            });
        @endif
    </script>
@endsection
