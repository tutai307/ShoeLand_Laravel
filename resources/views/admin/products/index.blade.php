@extends('admin.layouts.app')

@section('title', 'Sản phẩm')

@section('content')
    <div class="container my-4 appCard">
        <table class="table table-hover table-striped">
            <legend class="text-center my-4">
                <b>Quản lý Sản Phẩm</b>
            </legend>
            <div class="text-left d-flex justify-content-between align-items-center mb-3">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createProductModal">
                    <i class="fa-solid fa-plus"></i>
                    Thêm Sản Phẩm
                </button>

                <div>
                    <form method="GET" action="{{ route('admin.products.index') }}">
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
                    <th>Tên</th>
                    <th>Giá</th>
                    <th>Danh mục</th>
                    <th>Sự kiện</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $index => $product)
                    <tr>
                        <td class="align-middle">{{ $products->firstItem() + $index }}</td>
                        <td class="align-middle">{{ $product->code }}</td>
                        <td class="align-middle">{{ $product->name }}</td>
                        <td class="align-middle">{{ number_format($product->price) }} đ</td>
                        <td class="align-middle">{{ $product->category->name }}</td>
                        <td class="align-middle">{{ $product->event ? $product->event->name : 'Không có' }}</td>
                        <td class="align-middle">
                            <!-- Nút Quản Lý Ảnh -->
                            <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal"
                                data-bs-target="#viewImagesModal{{ $product->id }}">
                                <i class="fa-solid fa-images"></i>
                            </button>
                            <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal"
                                data-bs-target="#viewSizesModal{{ $product->id }}">
                                <i class="fa-solid fa-ruler"></i>
                            </button>
                            <!-- Nút Sửa và Xóa -->
                            <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                data-bs-target="#editProductModal{{ $product->id }}">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </button>
                            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                data-bs-target="#deleteProductModal{{ $product->id }}">
                                <i class="fa-solid fa-trash"></i>
                            </button>

                        </td>
                    </tr>

                    <!-- Modal Hiển Thị Ảnh -->
                    <div class="modal fade" id="viewImagesModal{{ $product->id }}" tabindex="-1"
                        aria-labelledby="viewImagesModalLabel{{ $product->id }}" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="viewImagesModalLabel{{ $product->id }}">Ảnh của Sản Phẩm
                                        {{ $product->name }}</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <!-- Danh sách hình ảnh -->
                                    <div id="imagesList{{ $product->id }}" class="d-flex flex-wrap gap-3">
                                        @php
                                            $images = \App\Models\ProductImage::where(
                                                'product_id',
                                                $product->id,
                                            )->get();
                                        @endphp
                                        @forelse ($images as $image)
                                            <div class="position-relative">
                                                <img src="{{ $image->content }}" alt="Product Image"
                                                    style="max-width: 100px; max-height: 100px; object-fit: cover;">
                                                @if ($image->mainImage)
                                                    <span class="position-absolute top-0 start-0 badge bg-success">Ảnh
                                                        Chính</span>
                                                @endif
                                            </div>
                                        @empty
                                            <p>Chưa có ảnh nào cho sản phẩm này.</p>
                                        @endforelse
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                                    <a href="{{ route('admin.product-images.index', ['product_id' => $product->id]) }}"
                                        class="btn btn-primary">
                                        Chỉnh sửa ảnh sản phẩm {{ $product->name }}
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Modal Hiển Thị Size -->
                    <div class="modal fade" id="viewSizesModal{{ $product->id }}" tabindex="-1"
                        aria-labelledby="viewSizesModalLabel{{ $product->id }}" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="viewSizesModalLabel{{ $product->id }}">Kích Thước của Sản
                                        Phẩm
                                        {{ $product->name }}</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <!-- Danh sách kích thước -->
                                    <div id="sizesList{{ $product->id }}" class="d-flex flex-wrap gap-3">
                                        @php
                                            $sizes = \App\Models\Size::whereHas('products', function ($query) use (
                                                $product,
                                            ) {
                                                $query->where('product_id', $product->id);
                                            })->get();
                                        @endphp
                                        @forelse ($sizes as $size)
                                            <div class="position-relative border p-3 rounded bg-light">
                                                <span>Kích thước: {{ $size->name }}</span>
                                                <span>Số lượng:
                                                    {{ \App\Models\ProductSize::where('product_id', $product->id)->where('size_id', $size->id)->value('quantity') }}
                                                </span>
                                            </div>
                                        @empty
                                            <p>Chưa có kích thước nào cho sản phẩm này.</p>
                                        @endforelse
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                                    <a href="{{ route('admin.product-sizes.index', ['product_id' => $product->id]) }}"
                                        class="btn btn-primary">
                                        Chỉnh sửa kích thước sản phẩm {{ $product->name }}
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </tbody>
        </table>

        <!-- Thêm phân trang -->
        <div class="d-flex justify-content-center mt-3">
            <div class="d-inline-flex p-2 bd-highlight">
                <label for="perPage" class="me-2">Hiển thị:</label>
            </div>
            <form method="GET" action="{{ route('admin.products.index') }}" class="me-2">
                <select id="perPage" name="perPage" class="form-select" aria-label="Số mục trên trang"
                    onchange="this.form.submit()">
                    <option value="5" {{ request()->perPage == '5' ? 'selected' : '' }}>5</option>
                    <option value="10" {{ request()->perPage == '10' ? 'selected' : '' }}>10</option>
                    <option value="15" {{ request()->perPage == '15' ? 'selected' : '' }}>15</option>
                </select>
            </form>
            <!-- Liên kết phân trang với Bootstrap -->
            {{ $products->appends(['search' => request()->input('search'), 'perPage' => request()->input('perPage')])->links('vendor.pagination.bootstrap') }}
        </div>
    </div>
    {{-- Modal create --}}
    @include('admin.products.create')

    {{-- Modal edit --}}
    @foreach ($products as $product)
        @include('admin.products.edit', ['product' => $product])
    @endforeach

    {{-- Modal delete --}}
    @foreach ($products as $product)
        @include('admin.products.delete', ['product' => $product])
    @endforeach
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
