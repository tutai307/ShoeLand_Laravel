@extends('client.layouts.app')

@section('content')
<div class="container my-4">
    <!-- Search Results -->
    <div class="appCard container">
        @if(isset($products) && $products->count() > 0)
    <div class="row">
        <h4 class="col-12 mt-4">
            @if (request()->input('key') == "")
                Tất cả sản phẩm
            @else
                Kết quả tìm kiếm cho "{{ request()->input('key') }}"
            @endif
        </h4>        
        <h5 class="col-12 mt-4">Tìm kiếm được {{ $products->total()  }} sản phẩm:</h5>
        @foreach($products as $product)
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

    <!-- Pagination -->
    <div class="row">
        <div class="col-12 d-flex justify-content-center mt-4">
            {{ $products->appends(request()->input())->links('vendor.pagination.bootstrap') }}
        </div>
    </div>
    @else
    <div class="row">
        <div class="col-12">
            <h4>Không tìm thấy sản phẩm nào phù hợp với từ khóa "{{ request()->input('query') }}".</h4>
        </div>
    </div>
    @endif
    </div>
</div>
@endsection
