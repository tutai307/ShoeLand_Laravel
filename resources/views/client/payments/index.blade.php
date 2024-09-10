@extends('client.layouts.app')
@php
    use App\Models\ProductImage;
@endphp
@section('content')
    <form action="{{ route('payment.handle') }}" method="POST">
        @csrf
        <div class="container">
            <div class="container appCard my-4 border rounded blur-border">
                <h4 class="text-center mb-4">Thông Tin Người Nhận</h4>
                <!-- Tên -->
                <div class="row">
                    <div class="mb-3 col">
                        <label for="name" class="form-label">Họ và Tên</label>
                        <input disabled type="text" value="{{ auth()->user()->name }}" class="form-control" id="name"
                            name="name">
                    </div>

                    <div class="mb-3 col">
                        <label for="shippingMethod" class="form-label">Phương thức vận chuyển</label>
                        <select class="form-select" id="shippingMethod" name="delivery" aria-label=".form-select"
                            onchange="updateTotalPayment()">
                            <option value="30000" selected>Thường (30,000 đ)</option>
                            <option value="50000">Nhanh (50,000 đ)</option>
                            <option value="100000">Hoả tốc (100,000 đ)</option>
                        </select>
                    </div>

                    <!-- Số Điện Thoại -->
                    <div class="mb-3 col">
                        <label for="phone" class="form-label">Số Điện Thoại</label>
                        <input type="tel" class="form-control" id="phone" name="phone" required>
                    </div>
                </div>

                <!-- Địa Chỉ -->
                <div class="mb-3">
                    <div class="row">
                        <label for="city">Địa chỉ</label>
                        <div class="col">
                            <select required name="province" class="form-select form-select mb-3" id="city"
                                aria-label=".form-select">
                                <option value="" selected>Chọn tỉnh thành</option>
                            </select>
                        </div>
                        <div class="col">
                            <select required name="district" class="form-select form-select mb-3" id="district"
                                aria-label=".form-select">
                                <option value="" selected>Chọn quận huyện</option>
                            </select>
                        </div>

                        <div class="col">
                            <select required name="ward" class="form-select form-select" id="ward"
                                aria-label=".form-select">
                                <option value="" selected>Chọn phường xã</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container appCard my-4 border rounded blur-border">
                <h4 class="text-center mb-4">Thông Tin Sản Phẩm</h3>
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="text-center align-middle" scope="col">Mã</th>
                                <th class="text-center align-middle" scope="col">Sản phẩm</th>
                                <th class="text-center align-middle" scope="col">Tên sản phẩm</th>
                                <th class="text-center align-middle" scope="col">Size</th>
                                <th class="text-center align-middle" scope="col">Đơn giá</th>
                                <th class="text-center align-middle" scope="col">Số lượng</th>
                                <th class="text-center align-middle" scope="col">Số tiền</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $totalAmount = 0;
                            @endphp
                            @foreach ($order_items as $item)
                                @php
                                    // Lấy thông tin sản phẩm từ item
                                    $product = $item->product;
                                    $size = $item->size;
                                    $unitPrice = $item->unit_price;
                                    $quantity = $item->quantity;
                                    $totalPrice = $unitPrice * $quantity;
                                    $totalAmount += $totalPrice;
                                    $productImage = ProductImage::where('product_id', $item->product_id)
                                        ->where('mainImage', 1)
                                        ->first();
                                @endphp
                                <tr>
                                    <td class="text-center align-middle">{{ $product->code }}</td>
                                    <td class="text-center align-middle">
                                        <img style="width: 100px; height: 100px;" src="{{ $productImage->content }}"
                                            alt="{{ $product->name }}">
                                    </td>
                                    <td class="text-center align-middle">{{ $product->name }}</td>
                                    <td class="text-center align-middle">{{ $size->name }}</td>
                                    <td class="text-center align-middle text-danger fw-bold">
                                        {{ number_format($unitPrice, 0, ',', '.') }} đ
                                    </td>
                                    <td class="text-center align-middle">{{ $quantity }}</td>
                                    <td class="text-center align-middle text-danger fw-bold">
                                        {{ number_format($totalPrice, 0, ',', '.') }} đ
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

            </div>

            <div class="container appCard my-4 border rounded blur-border">
                <h4 class="text-center mb-4">Thanh Toán</h3>

                    <div class="row">
                        <div class="mb-3 col">
                            Tổng tiền hàng: <span class="text-danger fw-bold"
                                id="totalAmountText">{{ number_format($totalAmount, 0, ',', '.') }} đ</span><br>
                            <span>Phí vận chuyển: <span class="text-danger fw-bold" id="shippingFee">0 đ</span></span><br>
                            <span>Tổng thanh toán: <span class="text-danger fw-bold" id="totalPayment"></span></span><br>

                            <!-- Thêm các trường ẩn -->
                            <input type="hidden" name="totalAmount" id="totalAmountInput" value="">
                        </div>

                        <div class="mb-3 col-4 d-grid gap-2">
                            @foreach ($payments as $index => $payment)
                                <button name="paymentMethod" value="{{ $payment->id }}" type="submit"
                                    class="btn {{ $index === 0 ? 'btn-danger' : ($index === 1 ? 'btn-warning' : 'btn-outline-success') }} ml-2">
                                    <i
                                        class="fa-solid {{ $index === 0 ? 'fa-building-columns' : ($index === 1 ? 'fa-qrcode' : 'fa-money-bill') }}"></i>
                                    {{ $payment->name }}
                                </button>
                            @endforeach
                            <a role="button" href="javascript:history.back()" class="btn ml-2 back-btn btn-outline-success">
                                <i class="fas fa-arrow-left"></i> Quay lại
                            </a>
                        </div>
                    </div>

            </div>
        </div>
    </form>
@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"></script>
    <script>
        var citis = document.getElementById("city");
        var districts = document.getElementById("district");
        var wards = document.getElementById("ward");

        var Parameter = {
            url: "https://raw.githubusercontent.com/kenzouno1/DiaGioiHanhChinhVN/master/data.json",
            method: "GET",
            responseType: "application/json",
        };
        var promise = axios(Parameter);
        promise.then(function(result) {
            renderCity(result.data);
        });

        function renderCity(data) {
            for (const x of data) {
                citis.options[citis.options.length] = new Option(x.Name, x.Name);
            }

            citis.onchange = function() {
                // Set the value of the hidden inpu

                district.length = 1;
                ward.length = 1;
                if (this.value != "") {
                    const result = data.filter(n => n.Name === this.value);

                    for (const k of result[0].Districts) {
                        district.options[district.options.length] = new Option(k.Name, k.Name);
                    }
                }
            };

            district.onchange = function() {
                // Set the value of the hidden input

                ward.length = 1;
                const dataCity = data.filter((n) => n.Name === citis.value);
                if (this.value != "") {
                    const dataWards = dataCity[0].Districts.filter(n => n.Name === this.value)[0].Wards;

                    for (const w of dataWards) {
                        wards.options[wards.options.length] = new Option(w.Name, w.Name);
                    }
                }
            };
        }
    </script>
    <script>
        function updateTotalPayment() {
            var totalAmount = {{ $totalAmount }};
            var shippingFee = parseInt(document.getElementById("shippingMethod").value);
            var totalPayment = totalAmount + shippingFee;

            // Hiển thị phí vận chuyển và tổng thanh toán
            document.getElementById("shippingFee").innerText = numberFormat(shippingFee) + ' đ';
            document.getElementById("totalPayment").innerText = numberFormat(totalPayment) + ' đ';

            // Cập nhật giá trị của totalAmountInput
            document.getElementById("totalAmountInput").value = totalAmount;
        }

        function numberFormat(number) {
            return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        }

        // Gọi hàm cập nhật tổng thanh toán khi trang được tải
        window.onload = updateTotalPayment;
    </script>
@endsection
