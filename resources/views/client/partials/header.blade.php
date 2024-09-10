<header class="text-bg-success bg-gradient sticky-top">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-4 d-flex justify-content-center justify-content-lg-start">
                <a href="/" class="d-flex align-items-center text-white text-decoration-none">
                    <img class="header__logo" style="height:70px; scale: 1.2;" src="{{ asset('storage/logo.svg') }}"
                        alt="logo">
                </a>
            </div>
            <div class="col-lg-5 d-flex justify-content-center">
                <div class="dropdown mr-3">
                    <button class="btn btn-outline-light dropdown-toggle" type="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        <i class="fa-solid fa-list mr-2"></i>
                        Danh mục
                    </button>
                    <ul class="dropdown-menu dropdown-menu-scrollable">
                        @foreach ($categories as $category)
                            <li>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <img width="30px" src="{{ asset('storage/' . $category->image) }}"
                                        alt="{{ $category->name }}" class="dropdown-item-image">
                                    <span class="ms-2">{{ $category->name }}</span>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <form class="d-flex" role="search" action="/search" method="GET">
                    <div class="input-group">
                        <input class="form-control" type="search" placeholder="Tìm kiếm sản phẩm..."
                            aria-label="Search" name="q">
                        <button class="btn btn-success" type="submit">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </button>
                    </div>
                </form>
            </div>
            <div class="col-lg-3 d-flex justify-content-end">             
                @if (Auth::check())
                <a href="{{ route('cart.view') }}" class="btn btn-outline-light me-2" data-bs-toggle="tooltip" data-bs-placement="bottom"
                    data-bs-custom-class="custom-tooltip" data-bs-title="Giỏ hàng">
                    <i class="fa-solid fa-cart-shopping"></i>
                </a>
                    <div class="dropdown">
                        <button class="btn btn-outline-light dropdown-toggle" type="button" id="userDropdown"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            {{ Auth::user()->name }}
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="userDropdown">
                            <li><a Thông class="dropdown-item" href="">Thông tin cá nhân</a></li>
                            <li><a class="dropdown-item" href="" >Đơn hàng</a></li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST" class="m-0">
                                    @csrf
                                    <button type="submit" class="dropdown-item">Đăng xuất</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                @else
                    <a href="{{ route('cart.view') }}" class="btn btn-outline-light me-2" data-bs-toggle="tooltip"
                        data-bs-placement="bottom" data-bs-custom-class="custom-tooltip" data-bs-title="Giỏ hàng">
                        <i class="fa-solid fa-cart-shopping"></i>
                    </a>
                    <a href="{{ route('login.custom') }}" class="btn btn-outline-light" data-bs-toggle="tooltip"
                        data-bs-placement="bottom" data-bs-custom-class="custom-tooltip" data-bs-title="Đăng nhập">
                        <i class="fa-solid fa-right-to-bracket"></i>
                    </a>
                @endif
            </div>
        </div>
    </div>
</header>

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let lastScrollTop = 0;
            const header = document.querySelector('header');

            window.addEventListener('scroll', function() {
                let currentScrollTop = window.pageYOffset || document.documentElement.scrollTop;

                if (currentScrollTop > lastScrollTop) {
                    header.classList.add('hide-header');
                } else {
                    header.classList.remove('hide-header');
                }

                lastScrollTop = currentScrollTop <= 0 ? 0 : currentScrollTop;
            });
        });
    </script>
    <script>
        const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
        const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl));
    </script>
@endsection
