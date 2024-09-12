@extends('client.layouts.app')
@section('title', 'ShoeLand')

@section('content')
    <!-- Modal -->
    <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body text-center p-0">
                    <div class="modal-img-container">
                        <img id="modalImage" src="" alt="Selected image" class="img-fluid modal-img">
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Container --}}
    <div class="container my-4">
        <div class="appCard row mr-0 ml-0">
            <div class="p-0">
                <h4 class="title_event">THÔNG TIN SẢN PHẨM</h4>
            </div>
            <div class="col-4 detail_images">
                <div class="ecommerce-gallery" data-mdb-ecommerce-gallery-init data-mdb-zoom-effect="true"
                    data-mdb-auto-height="true">
                    <div class="row py-3 shadow-5">
                        <!-- Ảnh chính -->
                        <div class="col-12 mb-1">
                            <div class="lightbox" data-mdb-lightbox-init>
                                <img src="{{ $mainImage ? $mainImage->content : '' }}" alt="Gallery main image"
                                    class="ecommerce-gallery-main-img active w-100 br-10" data-bs-toggle="modal"
                                    data-bs-target="#imageModal"
                                    onclick="openModal('{{ $mainImage ? $mainImage->content : '' }}')" />
                            </div>
                        </div>

                        <!-- Ảnh phụ -->
                        @foreach ($otherImages as $image)
                            <div class="col-4 mt-1">
                                <img src="{{ $image->content }}" data-mdb-img="{{ $image->content }}"
                                    alt="Gallery image {{ $loop->index + 1 }}" class="w-100 br-10" data-bs-toggle="modal"
                                    data-bs-target="#imageModal" onclick="openModal('{{ $image->content }}')" />
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="col-5 detail_product">
                <div class="product_name">
                    <h4 class="product_code">
                        {{ $product->name }}
                    </h4>
                </div>

                <div class="product_rating">
                    <span class="review-no">4.8</span>
                    <span class="stars">
                        <i class="fa fa-star checked" style="color: #fe9727"></i>
                        <i class="fa fa-star checked" style="color: #fe9727"></i>
                        <i class="fa fa-star checked" style="color: #fe9727"></i>
                        <i class="fa fa-star checked" style="color: #fe9727"></i>
                    </span>
                    <div class="status fs-14 mt-3">
                        <span class="product_code fw-bold">
                            Mã sản phẩm:
                            <span class="fw-normal">
                                {{ $product->code }}
                            </span>
                        </span>
                        <div class="fw-bold">Tình trạng:
                            <span class="fw-normal" style="color: green;">Còn hàng</span>
                        </div>
                    </div>
                </div>

                @php
                    $check_end_date = $product->event->end_date >= now() ? 1 : 0;
                    $price = $product->price;
                    $discount = $product->event->discount ?? 0;
                    $eventName = $product->event->name ?? '';
                    use Carbon\Carbon;

                    $timeLeftFormatted = '';
                    if ($product->event) {
                        $endDate = Carbon::parse($product->event->end_date);
                        $timeLeft = $endDate->diffInSeconds(now());

                        if ($timeLeft > 0) {
                            $days = floor($timeLeft / 86400);
                            $hours = floor(($timeLeft % 86400) / 3600);
                            $minutes = floor(($timeLeft % 3600) / 60);
                            $seconds = $timeLeft % 60;

                            $timeLeftFormatted = "{$days} ngày {$hours} giờ {$minutes} phút {$seconds} giây";
                        }
                    }

                @endphp

                @if ($check_end_date == 1)
                    <div style="background: linear-gradient(100deg, rgb(146 0 9), rgb(212 6 6));"
                        class="product_price flex justify-between mt-3 p-3 border text-white br-10">
                        <div class="price mr-12">
                            <div class="current_price">
                                <span class="price fw-bold">
                                    Giá sale:
                                    <i style="color: #fdfd00" class="sale">{{ number_format($price, 0, ',', '.') }}
                                        VNĐ</i>
                                </span>
                            </div>
                            <div class="fake_price">
                                <span class="price fw-bold">
                                    Giá gốc:
                                    <i class="fake fw-normal text-decoration-line-through">{{ number_format($price * ($discount / 100) + $price, 0, ',', '.') }}
                                        VNĐ</i>
                                </span>
                            </div>
                            <div class="save">
                                <span class="price fw-bold">
                                    Tiết kiệm:
                                    <i style="color: #fdfd00"
                                        class="sale">{{ number_format($price * ($discount / 100) + $price - $price, 0, ',', '.') }}
                                        VNĐ</i>
                                </span>
                            </div>
                        </div>
                        <div style="font-size: 13px" class="event">
                            <div class="event_name">
                                <i class="fa-regular fa-clock"></i>
                                <span class="sale fw-bold">
                                    {{ $eventName }}
                                </span>
                            </div>
                            <div class="event_time">
                                <span id="timeLeft"></span>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="current_price">
                        <span class="price fw-bold">
                            Giá: 
                        </span>
                        <span class="sale">{{ number_format($price, 0, ',', '.') }} VNĐ</span>
                    </div>
                @endif

                <div class="product_gift mt-3">
                    <div class="gift_sale">
                        <i class="fa-solid fa-percent"></i>
                        <span class="gift-text">
                            <b>Mua càng nhiều, ưu đãi càng lớn</b><br>
                            <em style="font-size: 13px;">(Ưu đãi có thể kết thúc sớm)</em>
                        </span>
                    </div>
                    <div class="gift_list">
                        <span><i class="fa-solid fa-circle-check mr-3"></i>Freeship khi mua 2 đôi</span>
                        <br><span><i class="fa-solid fa-circle-check mr-3"></i>Tặng tất theo sản phẩm (Tùy đôi)</span>
                        <br><span><i class="fa-solid fa-circle-check mr-3"></i>Mua 5 đôi tặng 1 đôi</span>
                        <br>
                    </div>
                </div>

                <form action="{{ route('cart.add', ['product_id' => $product->id]) }}"
                    method="POST">
                    @csrf
                    <input type="hidden" name="product_id" id="product_id" value="{{ $product->id }}">
                    <!-- Chọn size -->
                    <div class="product_size mt-3">
                        <label for="size" class="fw-bold">Chọn Size:</label>
                        <div class="size-options mt-2">
                            @foreach ($product->sizes as $index => $size)
                                <button type="button"
                                    class="btn btn-outline-success mt-2 mr-1 size-button {{ $index === 0 ? 'active' : '' }}"
                                    data-size-id="{{ $size->id }}">{{ $size->name }}</button>
                            @endforeach
                            <input type="hidden" name="size" id="size"
                                value="{{ $product->sizes->first()->id }}">
                        </div>
                    </div>

                    <!-- Chọn số lượng -->
                    <div class="product_quantity mt-3 mb-3">
                        <label for="quantity" class="fw-bold">Số lượng:</label>
                        <div class="input-group mt-2" style="width: 120px;">
                            <button class="btn btn-success quantity-btn" type="button" id="decrease-quantity"><i class="fa-solid fa-minus"></i></button>
                            <input id="quantity" name="quantity" type="text" min="1" value="1" class="form-control text-center" readonly>
                            <button class="btn btn-success quantity-btn" type="button" id="increase-quantity"><i class="fa-solid fa-plus"></i></button>
                        </div>
                    </div>                    

                    <div class="d-grid gap-2 mb-5">
                        <button class="btn btn-success" type="submit"><i class="fa-solid fa-cart-shopping mr-2"></i>Thêm giỏ hàng</button>
                    </div>
                </form>
            </div>

            <div class="col-3 detail_contact">
                <div class="seller-info flex-center">
                    <a style="text-decoration: none;" href="#" class="">
                        <img height="44" width="44" alt="" class=""
                            src="{{ asset('storage/logo.svg') }}" style="width: 44px;">
                        <span>Shoes Land</span>
                        <div class="flex-center">
                            <span class="">
                                <img height="18" width="74" alt="" class=""
                                    src="{{ asset('storage/official.png') }}" 74px; height: 18px;>
                            </span>
                        </div>
                    </a>
                </div>
                <div class="row mt-4">
                    <div class="col benefit-item">
                        <img alt="compensation-icon" src="{{ asset('storage/security.png') }}" height="32"
                            width="32" class="entered lazyloaded">
                        <span>Hoàn tiền<br><b>100%</b><br>nếu không đúng hàng</span>
                    </div>
                    <div class="col benefit-item">
                        <img alt="compensation-icon" src="{{ asset('storage/like.png') }}" height="32"
                            width="32" class="entered lazyloaded">
                        <span>Nhận hàng<br>Kiểm tra hàng<br>Thoải mái</span>
                    </div>
                    <div class="col benefit-item">
                        <img alt="compensation-icon" src="{{ asset('storage/refund.png') }}" height="32"
                            width="32" class="entered lazyloaded">
                        <span>Đổi trả trong<br><b>3 ngày</b><br>nếu sp lỗi</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="appCard row mr-0 ml-0">
            <h4 class="title_event">THÔNG SỐ SẢN PHẨM</h4>
            <table class="table table-bordered br-10">
                <tbody>
                    <tr>
                        <th class="bg-light-gray text-dark" style="width: 230px;">Size</th>
                        <td>
                            @foreach ($product->sizes as $size)
                                <span>{{ $size->name }}</span>{{ !$loop->last ? ',' : '' }}
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th class="bg-light-gray text-dark" style="width: 230px;">Quà tặng</th>
                        <td>
                            Full box + tax + bill, Tặng tất
                        </td>
                    </tr>
                    <tr>
                        <th class="bg-light-gray text-dark" style="width: 230px;">Mô tả</th>
                        <td>
                            {{ $product->description }}
                        </td>
                    </tr>
                    <tr>
                        <th class="bg-light-gray text-dark" style="width: 230px;">Loại hàng</th>
                        <td>Siêu cấp</td>
                    </tr>
                    <tr>
                        <th class="bg-light-gray text-dark" style="width: 230px;">Thương hiệu</th>
                        <td>
                            {{ $product->category->name }}
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        

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
                                    <a href="{{ route('product.show', $product->id) }}" class="text-decoration-none text-reset">
                                        <div class="w-90 productClass card position-relative blur-border">
                                            <div class="over-hidden">
                                                <img src="{{ $product->mainImage->content ?? 'default_image.jpg' }}" class="card-img-top product-img" alt="{{ $product->name }}">
                                            </div>
                                
                                            @if ($product->event && $product->event->discount && \Carbon\Carbon::now()->lessThanOrEqualTo(\Carbon\Carbon::parse($product->event->end_date)))
                                                <div class="discount-overlay">
                                                    -{{ $product->event->discount }}%
                                                </div>
                                            @endif
                                
                                            <div class="card-body d-flex flex-column bg-dark text-white">
                                                <h6 style="color: #333" class="card-title text-center">{{ $product->name }}</h6>
                                                <span class="d-block mb-2 text-des">
                                                    Mã sản phẩm: {{ $product->code }}
                                                </span>
                                                <div class="cdt-product-param text-des">
                                                    <span data-title="Loại Hàng"><i class="fa-solid fa-cart-arrow-down"></i> Like auth</span>
                                                </div>
                                
                                                @if ($product->event && $product->event->discount && \Carbon\Carbon::now()->lessThanOrEqualTo(\Carbon\Carbon::parse($product->event->end_date)))
                                                    @php
                                                        $discount = $product->event->discount;
                                                        $originalPrice = $product->price;
                                                        $fakePrice = $originalPrice * (1 + $discount / 100);
                                                    @endphp
                                                    <p class="flex card-text fw-bold text-des">
                                                        <span class="text-danger mr-6">
                                                            {{ number_format($originalPrice, 0, ',', '.') }} <i class="fa-solid fa-dong-sign"></i>
                                                        </span>
                                                        <br>
                                                        <span class="text-decoration-line-through solid text-des">
                                                            {{ number_format($fakePrice, 0, ',', '.') }} <i class="fa-solid fa-dong-sign"></i>
                                                        </span>
                                                    </p>
                                                @else
                                                    <p class="card-text fw-bold text-des">
                                                        {{ number_format($product->price, 0, ',', '.') }} <i class="fa-solid fa-dong-sign"></i>
                                                    </p>
                                                @endif
                                            </div>
                                        </div>
                                    </a>
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
                                    <a href="{{ route('product.show', $product->id) }}" class="text-decoration-none text-reset">
                                        <div class="w-90 productClass card position-relative blur-border">
                                            <div class="over-hidden">
                                                <img src="{{ $product->mainImage->content ?? 'default_image.jpg' }}" class="card-img-top product-img" alt="{{ $product->name }}">
                                            </div>
                                
                                            @if ($product->event && $product->event->discount && \Carbon\Carbon::now()->lessThanOrEqualTo(\Carbon\Carbon::parse($product->event->end_date)))
                                                <div class="discount-overlay">
                                                    -{{ $product->event->discount }}%
                                                </div>
                                            @endif
                                
                                            <div class="card-body d-flex flex-column bg-dark text-white">
                                                <h6 style="color: #333" class="card-title text-center">{{ $product->name }}</h6>
                                                <span class="d-block mb-2 text-des">
                                                    Mã sản phẩm: {{ $product->code }}
                                                </span>
                                                <div class="cdt-product-param text-des">
                                                    <span data-title="Loại Hàng"><i class="fa-solid fa-cart-arrow-down"></i> Like auth</span>
                                                </div>
                                
                                                @if ($product->event && $product->event->discount && \Carbon\Carbon::now()->lessThanOrEqualTo(\Carbon\Carbon::parse($product->event->end_date)))
                                                    @php
                                                        $discount = $product->event->discount;
                                                        $originalPrice = $product->price;
                                                        $fakePrice = $originalPrice * (1 + $discount / 100);
                                                    @endphp
                                                    <p class="flex card-text fw-bold text-des">
                                                        <span class="text-danger mr-6">
                                                            {{ number_format($originalPrice, 0, ',', '.') }} <i class="fa-solid fa-dong-sign"></i>
                                                        </span>
                                                        <br>
                                                        <span class="text-decoration-line-through solid text-des">
                                                            {{ number_format($fakePrice, 0, ',', '.') }} <i class="fa-solid fa-dong-sign"></i>
                                                        </span>
                                                    </p>
                                                @else
                                                    <p class="card-text fw-bold text-des">
                                                        {{ number_format($product->price, 0, ',', '.') }} <i class="fa-solid fa-dong-sign"></i>
                                                    </p>
                                                @endif
                                            </div>
                                        </div>
                                    </a>
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
        function openModal(imageSrc) {
            document.getElementById('modalImage').src = imageSrc;
        }
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var eventEndTime = {{ $eventEndTimestamp ?? 'null' }};

            if (eventEndTime !== null) {
                var countdown = setInterval(function() {
                    var now = Math.floor(Date.now() / 1000);
                    var timeLeft = eventEndTime - now;

                    if (timeLeft <= 0) {
                        clearInterval(countdown);
                        document.getElementById("timeLeft").innerText = "Đã hết thời gian!";
                    } else {
                        var days = Math.floor(timeLeft / 86400);
                        var hours = Math.floor((timeLeft % 86400) / 3600);
                        var minutes = Math.floor((timeLeft % 3600) / 60);
                        var seconds = timeLeft % 60;

                        document.getElementById("timeLeft").innerText =
                            days + " ngày " + hours + " giờ " + minutes + " phút " + seconds + " giây";
                    }
                }, 1000);
            } else {
                document.getElementById("timeLeft").innerText = "Không có thời gian kết thúc sự kiện!";
            }
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Xử lý chọn size
            const sizeButtons = document.querySelectorAll('.size-button');
            const sizeInput = document.getElementById('size');

            sizeButtons.forEach(button => {
                button.addEventListener('click', function() {
                    // Loại bỏ lớp 'btn-success' khỏi tất cả các nút
                    sizeButtons.forEach(btn => btn.classList.remove('active'));
                    sizeButtons.forEach(btn => btn.classList.add('btn-outline-success'));
                    // Thêm lớp 'btn-success' vào nút được chọn
                    this.classList.add('active');
                    // Gán giá trị của size vào input hidden
                    sizeInput.value = this.getAttribute('data-size-id');
                });
            });

            if (sizeButtons.length > 0) {
                sizeInput.value = sizeButtons[0].dataset.sizeId;
            }

            // Xử lý tăng/giảm số lượng
            const quantityInput = document.getElementById('quantity');
            const decreaseButton = document.getElementById('decrease-quantity');
            const increaseButton = document.getElementById('increase-quantity');

            decreaseButton.addEventListener('click', function() {
                let currentValue = parseInt(quantityInput.value);
                if (currentValue > 1) {
                    quantityInput.value = currentValue - 1;
                }
            });

            increaseButton.addEventListener('click', function() {
                let currentValue = parseInt(quantityInput.value);
                quantityInput.value = currentValue + 1;
            });
        });
    </script>

@endsection
