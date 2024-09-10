@extends('client.layouts.app')
@php
    use App\Models\ProductImage;
@endphp
@section('content')
    <div class="container my-4">
        <div class="container appCard my-4 border rounded blur-border">
            @if ($cartItems->isEmpty())
                <div class="text-center">
                    <h1>
                        <legend class="text-center fw-bold my-4">Quản lý giỏ hàng</legend>
                    </h1>
                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRd13XUAZxw6HVjjX4QJX9bjWd4tXmY1Uh4cQ&usqp=CAU"
                        alt="">
                    <p>Giỏ hàng của bạn đang trống. Hãy quay lại xem các sản phẩm nhé!</p>
                    <a class="btn btn-success my-4" href="{{ route('home') }}" role="button">Quay lại trang chủ</a>
                </div>
            @else
                <table class="table">
                    <legend class="text-center fw-bold">Quản lý giỏ hàng</legend>
                    <thead>
                        <tr>
                            <th scope="col">Chọn</th>
                            <th class="text-center align-middle" scope="col">Mã</th>
                            <th scope="col" class="text-center align-middle">Sản phẩm</th>
                            <th class="text-center align-middle" scope="col">Tên sản phẩm</th>
                            <th class="text-center align-middle" scope="col">Size</th>
                            <th class="text-center align-middle" scope="col">Đơn giá</th>
                            <th class="text-center align-middle" scope="col">Số lượng</th>
                            <th class="text-center align-middle" scope="col">Số tiền</th>
                            <th class="text-center align-middle" scope="col">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cartItems as $item)
                            @php
                                $productImage = ProductImage::where('product_id', $item->product_id)
                                    ->where('mainImage', 1)
                                    ->first();
                            @endphp
                            <tr>
                                <td style="height: 170px;"
                                    class="text-center align-middle d-flex justify-content-center align-items-center">
                                    <input style="padding: 9px;" class="form-check-input" type="checkbox"
                                        name="selectedPro[]" data-cart-id="{{ $item->id }}" value="">

                                </td>
                                <td class="text-center align-middle">{{ $item->product->code }}</td>
                                <td class="text-center align-middle">
                                    <img style="width: 150px; height: 150px" src="{{ $productImage->content }}"
                                        alt="">
                                </td>
                                <td class="text-center align-middle">{{ $item->product->name }}</td>
                                <td class="text-center align-middle">{{ $item->size->name }}</td>
                                <td class="text-center align-middle text-danger fw-bold">
                                    {{ number_format($item->unit_price, 0, ',', '.') }} đ</td>
                                <td class="text-center align-middle">
                                    <button type="button" class="btn btn-sm btn-outline-success decrease-quantity"
                                        data-id="{{ $item->id }}" data-price="{{ $item->unit_price }}"><i
                                            class="fa-solid fa-minus"></i></button>
                                    <span class="mx-2 quantity"
                                        data-quantity="{{ $item->quantity }}">{{ $item->quantity }}</span>
                                    <button type="button" class="btn btn-sm btn-outline-success increase-quantity"
                                        data-id="{{ $item->id }}" data-price="{{ $item->unit_price }}"><i
                                            class="fa-solid fa-plus"></i></button>
                                </td>
                                <td class="text-center align-middle text-danger fw-bold subtotal"
                                    data-subtotal="{{ $item->quantity * $item->unit_price }}">
                                    {{ number_format($item->quantity * $item->unit_price, 0, ',', '.') }} đ
                                </td>
                                <td class="text-center align-middle">
                                    <form action="{{ route('cart.remove', $item->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger" type="submit">Xóa</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
        <form action="{{ route('order.checkout') }}" method="POST">
            @csrf
            <div class="text-end mt-3">
                Tổng số tiền: <span id="totalPriceDisplay" class="price_real fw-bold text-danger">0 đ</span>
                @if (auth()->check())
                    <!-- Hiển thị nút "Mua hàng" khi người dùng đã đăng nhập -->
                    @csrf
                    <input type="hidden" name="selectedItems" id="selectedItems" value="">
                    <button name="confirmBuy" type="submit" class="btn btn-success p-3" id="buyButton">
                        <i class="fa-solid fa-cart-shopping mr-2 ml-0"></i>
                        Mua hàng
                    </button>
                @else
                    <!-- Hiển thị link đến trang đăng nhập khi người dùng chưa đăng nhập -->
                    <a href="{{ route('login') }}" type="button" class="btn btn-success p-3">
                        <i class="fa-solid fa-cart-shopping mr-2 ml-0"></i>
                        Vui lòng đăng nhập để mua hàng
                    </a>
                @endif
            </div>
        </form>


        <div class="container appCard my-4 border rounded blur-border">
            <div class="">
                <h3 class="title_event">
                    SẢN PHẨM MỚI
                </h3>
            </div>
            <div id="carouselAdidasIndicators" class="carousel slide">
                <div class="carousel-indicators">
                    @foreach ($adidasProducts->chunk(4) as $key => $chunk)
                        <button type="button" data-bs-target="#carouselAdidasIndicators"
                            data-bs-slide-to="{{ $key }}" class="{{ $key == 0 ? 'active' : '' }}"
                            aria-current="true" aria-label="Slide {{ $key + 1 }}"></button>
                    @endforeach
                </div>
                <div class="carousel-inner">
                    @foreach ($adidasProducts->chunk(4) as $key => $chunk)
                        <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                            <div class="row">
                                @foreach ($chunk as $product)
                                    <div class="col-xs-12 col-sm-4 col-md-3 p-3">
                                        <div class="w-90 productClass card position-relative blur-border">
                                            <div class="over-hidden">
                                                <img src="{{ $product->mainImage->content }}"
                                                    class="card-img-top product-img" alt="{{ $product->name }}">
                                            </div>
                                            @if ($product->event && $product->event->discount)
                                                <div class="discount-overlay">
                                                    -{{ $product->event->discount }}%
                                                </div>
                                            @endif
                                            <div class="card-body d-flex flex-column bg-dark text-white">
                                                <h6 style="color: #333" class="card-title text-center">
                                                    {{ $product->name }}
                                                </h6>
                                                <span class="d-block mb-2 text-des">
                                                    Mã sản phẩm: {{ $product->code }}
                                                </span>
                                                <div class="cdt-product-param text-des">
                                                    <span data-title="Loại Hàng"><i
                                                            class="fa-solid fa-cart-arrow-down"></i>
                                                        Like auth</span>
                                                </div>
                                                @if ($product->event && $product->event->discount)
                                                    @php
                                                        $discount = $product->event->discount;
                                                        $originalPrice = $product->price;
                                                        $fakePrice = $originalPrice * (1 + $discount / 100);
                                                    @endphp
                                                    <p class="flex card-text fw-bold text-des">
                                                        <span class="text-danger mr-6">
                                                            {{ number_format($originalPrice, 0, ',', '.') }} <i
                                                                class="fa-solid fa-dong-sign"></i>
                                                        </span>
                                                        <br>
                                                        <span class="text-decoration-line-through solid text-des">
                                                            {{ number_format($fakePrice, 0, ',', '.') }} <i
                                                                class="fa-solid fa-dong-sign"></i>
                                                        </span>
                                                    </p>
                                                @else
                                                    <p class="card-text fw-bold text-des">
                                                        {{ number_format($product->price, 0, ',', '.') }} <i
                                                            class="fa-solid fa-dong-sign"></i>
                                                    </p>
                                                @endif
                                                <a href="{{ route('product.show', $product->id) }}"
                                                    class="btn btn-light mt-auto">Xem chi tiết</a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
                <button class="carousel-control-prev ms-3" type="button" data-bs-target="#carouselAdidasIndicators"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon bg-dark rounded-5" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next me-3" type="button" data-bs-target="#carouselAdidasIndicators"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon bg-dark rounded-5" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>

        <div class="container appCard my-4 border rounded blur-border">
            <div class="">
                <h3 class="title_event">
                    TẤT CẢ SẢN PHẨM
                </h3>
            </div>
            <div id="carouselProductIndicators" class="carousel slide">
                <div class="carousel-indicators">
                    @foreach ($products->chunk(4) as $key => $chunk)
                        <button type="button" data-bs-target="#carouselProductIndicators"
                            data-bs-slide-to="{{ $key }}" class="{{ $key == 0 ? 'active' : '' }}"
                            aria-current="true" aria-label="Slide {{ $key + 1 }}"></button>
                    @endforeach
                </div>
                <div class="carousel-inner">
                    @foreach ($products->chunk(4) as $key => $chunk)
                        <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                            <div class="row">
                                @foreach ($chunk as $product)
                                    <div class="col-xs-12 col-sm-4 col-md-3 p-3">
                                        <div class="w-90 productClass card position-relative blur-border">
                                            <div class="over-hidden">
                                                <img src="{{ $product->mainImage->content }}"
                                                    class="card-img-top product-img" alt="{{ $product->name }}">
                                            </div>
                                            @if ($product->event && $product->event->discount)
                                                <div class="discount-overlay">
                                                    -{{ $product->event->discount }}%
                                                </div>
                                            @endif
                                            <div class="card-body d-flex flex-column bg-dark text-white">
                                                <h6 style="color: #333; text-overflow: ellipsis; overflow: hidden; white-space: nowrap;"
                                                    class="card-title text-center">
                                                    {{ $product->name }}
                                                </h6>
                                                <span class="d-block mb-2 text-des">
                                                    Mã sản phẩm: {{ $product->code }}
                                                </span>
                                                <div class="cdt-product-param text-des"><span data-title="Loại Hàng"><i
                                                            class="fa-solid fa-cart-arrow-down"></i> Like auth</span></div>
                                                @if ($product->event && $product->event->discount)
                                                    @php
                                                        $discount = $product->event->discount;
                                                        $originalPrice = $product->price;
                                                        $fakePrice = $originalPrice * (1 + $discount / 100);
                                                    @endphp
                                                    <p class="flex card-text fw-bold text-des">
                                                        <span class=" text-danger mr-6">
                                                            {{ number_format($originalPrice, 0, ',', '.') }} <i
                                                                class="fa-solid fa-dong-sign"></i>
                                                        </span>
                                                        <br>
                                                        <span class="text-decoration-line-through solid text-des">
                                                            {{ number_format($fakePrice, 0, ',', '.') }} <i
                                                                class="fa-solid fa-dong-sign"></i>
                                                        </span>
                                                    </p>
                                                @else
                                                    <p class="card-text fw-bold text-des">
                                                        {{ number_format($product->price, 0, ',', '.') }} <i
                                                            class="fa-solid fa-dong-sign"></i>
                                                    </p>
                                                @endif
                                                <a href="{{ route('product.show', $product->id) }}"
                                                    class="btn btn-light mt-auto">Xem chi tiết</a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
                <button class="carousel-control-prev ms-3" type="button" data-bs-target="#carouselProductIndicators"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon bg-dark rounded-5" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next me-3" type="button" data-bs-target="#carouselProductIndicators"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon bg-dark rounded-5" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
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

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const checkboxes = document.querySelectorAll('input[name="selectedPro[]"]');
            const totalPriceElement = document.getElementById('totalPriceDisplay');
            const increaseButtons = document.querySelectorAll('.increase-quantity');
            const decreaseButtons = document.querySelectorAll('.decrease-quantity');

            checkboxes.forEach(checkbox => {
                checkbox.addEventListener('change', calculateTotal);
            });

            increaseButtons.forEach(button => {
                button.addEventListener('click', function() {
                    updateQuantity(this, 1);
                });
            });

            decreaseButtons.forEach(button => {
                button.addEventListener('click', function() {
                    updateQuantity(this, -1);
                });
            });

            buyButton.addEventListener('click', function(event) {
                const selectedItems = Array.from(checkboxes)
                    .filter(checkbox => checkbox.checked)
                    .map(checkbox => checkbox.getAttribute('data-id'));


                // Cập nhật giá trị của trường ẩn với danh sách các sản phẩm đã chọn
                selectedItemsInput.value = JSON.stringify(selectedItems);
                console.log('Selected Items:', selectedItems); // Kiểm tra console

            });


            function calculateTotal() {
                let totalPrice = 0;

                checkboxes.forEach(checkbox => {
                    if (checkbox.checked) {
                        const itemSubtotal = parseFloat(checkbox.closest('tr').querySelector('.subtotal')
                            .getAttribute('data-subtotal').replaceAll(',', ''));
                        totalPrice += itemSubtotal;
                    }
                });

                totalPriceElement.textContent = totalPrice.toLocaleString('vi-VN', {
                    style: 'currency',
                    currency: 'VND'
                });
            }

            function updateQuantity(button, delta) {
                const id = button.getAttribute('data-id');
                const price = parseFloat(button.getAttribute('data-price').replaceAll(',', ''));
                const quantitySpan = button.parentElement.querySelector('.quantity');
                let quantity = parseInt(quantitySpan.getAttribute('data-quantity')) + delta;

                if (quantity < 1) quantity = 1; // Ensure quantity doesn't go below 1

                // Gửi yêu cầu AJAX để cập nhật số lượng
                fetch(`/cart/update-quantity`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                                'content')
                        },
                        body: JSON.stringify({
                            id: id,
                            increase: delta > 0
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            quantitySpan.setAttribute('data-quantity', quantity);
                            quantitySpan.textContent = quantity;

                            // Update the subtotal for this item
                            const subtotalElement = button.closest('tr').querySelector('.subtotal');
                            const subtotal = quantity * price;
                            subtotalElement.setAttribute('data-subtotal', subtotal);
                            subtotalElement.textContent = subtotal.toLocaleString('vi-VN', {
                                style: 'currency',
                                currency: 'VND'
                            });

                            calculateTotal();
                        } else {
                            console.error('Failed to update quantity');
                        }
                    })
                    .catch(error => console.error('Error:', error));
            }

        });
    </script>

    <script>
        document.getElementById('buyButton').addEventListener('click', function() {
            let selectedItems = [];

            document.querySelectorAll('input[name="selectedPro[]"]:checked').forEach(function(checkbox) {
                let itemData = {
                    cart_id: checkbox.getAttribute('data-cart-id'),
                };
                selectedItems.push(itemData);
            });

            document.getElementById('selectedItems').value = JSON.stringify(selectedItems);
        });
    </script>
@endsection
