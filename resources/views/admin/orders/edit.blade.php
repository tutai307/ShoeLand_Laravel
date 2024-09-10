<!-- Modal for Editing orders -->
@php
    use App\Models\Status;
    $statuses = Status::all();
@endphp
@foreach ($orders as $order)
    <div class="modal fade" id="editOrderModal{{ $order->id }}" tabindex="-1"
        aria-labelledby="editOrderModalLabel{{ $order->id }}" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editOrderModalLabel{{ $order->id }}">Chỉnh Sửa Đơn Hàng</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('admin.orders.update', $order->id) }}" method="POST"
                    id="editOrderForm{{ $order->id }}">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="code" class="form-label">Mã Đơn Hàng</label>
                            <input disabled type="text" class="form-control" id="code" name="code"
                                value="{{ $order->code }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">Địa chỉ giao hàng</label>
                            <input type="text" class="form-control" id="name" name="receive_address"
                                value="{{ $order->receive_address }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">Trạng thái</label>
                            <select class="form-select" id="status" name="status">
                                <option selected value="{{ $order->status_id }}">
                                    {{ $order->status->name }}
                                </option>

                                @foreach ($statuses as $status)
                                    @if ($status->id != $order->status_id)
                                        <!-- Không hiển thị lại trạng thái hiện tại -->
                                        <option value="{{ $status->id }}">{{ $status->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Loại giao hàng</label>
                            @php
                                if ($order->delivery_cost == 30000) {
                                    $delivery_name = 'Thường (30,000 đ)';
                                } elseif ($order->delivery_cost == 50000) {
                                    $delivery_name = 'Nhanh (50,000 đ)';
                                } else {
                                    $delivery_name = 'Hoả tốc (100,000 đ)';
                                }
                            @endphp

                            <select class="form-select" id="shippingMethod" name="delivery">
                                <option selected value="{{ $order->delivery_cost }}">
                                    {{ $delivery_name }}
                                </option>

                                @if ($order->delivery_cost != 30000)
                                    <option value="30000">Thường (30,000 đ)</option>
                                @endif

                                @if ($order->delivery_cost != 50000)
                                    <option value="50000">Nhanh (50,000 đ)</option>
                                @endif

                                @if ($order->delivery_cost != 100000)
                                    <option value="100000">Hoả tốc (100,000 đ)</option>
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                        <button type="submit" class="btn btn-primary">Cập nhật</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endforeach
