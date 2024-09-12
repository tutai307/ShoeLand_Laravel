@extends('client.layouts.app')
@section('title', 'ShoeLand')
@section('content')
<div class="container my-4">
    <div class="container appCard my-4 border rounded blur-border text-center">
        <h4 class="pt-8">Đơn hàng của bạn đã được đặt thành công!</h4>
        <img src="https://anhdephd.vn/wp-content/uploads/2022/04/anh-dong-anime-3.gif" jsaction="" class="sFlh5c FyHeAf iPVvYb" style="max-width: 1280px; height: 300; margin: 0px; width: 353px;" alt="Ảnh Động Anime - Hình Gif Đẹp, Cute, Sinh Động, Thú Vị" jsname="kn3ccd" data-ilt="1725550465329">

        <p>Cảm ơn bạn đã tin tưởng chúng mình.</p>
        
        <div class="button-container pb-8">
            <a class="btn btn-success mr-2"><i class="fa-solid fa-house mr-2"></i>Trang chủ</a>
            <a class="btn btn-warning mr-2"><i class="fa-solid fa-list mr-2"></i>Xem đơn hàng</a>
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
    
        <!-- Button to view all products -->
        <div class="text-center mb-4">
            <a href="{{ route('searching.index', ['key' => '']) }}" class="btn btn-success">Xem tất cả</a>
        </div>
    </div>
</div>
@endsection