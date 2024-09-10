<header>
    <div class="px-3 py-2 bg-dark text-white">
        <div class="container">
            <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
                <a href="/"
                    class="d-flex align-items-center my-2 my-lg-0 me-lg-auto text-white text-decoration-none">
                    <svg class="bi me-2" width="40" height="32" role="img" aria-label="Bootstrap">
                        <use xlink:href="#bootstrap"></use>
                    </svg>
                </a>

                <ul class="nav col-12 col-lg-auto my-2 justify-content-center my-md-0 text-small">
                    <li>
                        <a href="{{ route('admin.dashboard.index') }}"
                            class="nav-link text-white flex-column flex-center">
                            <i class="fa-solid fa-home mb-2"></i>
                            Home
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.categories.index') }}"
                            class="nav-link text-white flex-column flex-center">
                            <i class="fa-solid fa-sitemap text-white mb-2"></i>
                            Danh mục
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.products.index') }}"
                            class="nav-link text-white flex-column flex-center">
                            <i class="fa-solid fa-table  mb-2"></i>
                            Sản phẩm
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.orders.index') }}" class="nav-link text-white flex-column flex-center">
                            <i class="fa-solid fa-gauge-high text-white mb-2"></i>
                            Đơn hàng
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.users.index') }}" class="nav-link text-white flex-column flex-center">
                            <i class="fa-solid fa-user text-white mb-2"></i>
                            Người dùng
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.events.index') }}" class="nav-link text-white flex-column flex-center">
                            <i class="fa-solid fa-calendar-days text-white mb-2"></i>
                            Sự kiện
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.statuses.index') }}"
                            class="nav-link text-white flex-column flex-center">
                            <i class="fa-solid fa-toggle-off text-white mb-2"></i>
                            Trạng thái
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.sizes.index') }}" class="nav-link text-white flex-column flex-center">
                            <i class="fa-solid fa-ruler-horizontal text-white mb-2"></i>
                            Kích cỡ
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.payments.index') }}"
                            class="nav-link text-white flex-column flex-center">
                            <i class="fa-solid fa-money-check-dollar text-white mb-2"></i>
                            Thanh toán
                        </a>
                    </li>
                    <li class="nav-link text-white flex-column float-end">
                        <form action="{{ route('logout') }}" method="POST" class="m-0">
                            @csrf
                            <button type="submit" class="btn btn-primary">
                              <i class="fa-solid fa-right-from-bracket mr-2"></i> Đăng xuất</button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</header>
