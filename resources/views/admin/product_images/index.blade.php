@extends('admin.layouts.app')

@section('title', 'Quản lý Hình Ảnh Sản Phẩm')

@section('content')
    <div class="container my-4 appCard">
        <legend class="text-center my-4">
            <b>Quản lý Hình Ảnh Sản Phẩm - {{ $product->name }}</b>
        </legend>
        <div class="text-left d-flex justify-content-between align-items-center mb-3">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createImageModal">
                <i class="fa-solid fa-plus"></i>
                Thêm Hình Ảnh
            </button>
        </div>

        <table class="table table-hover table-striped">
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Hình Ảnh</th>
                    <th>Ảnh Chính</th>
                    <th>Hành Động</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($productImages as $index => $image)
                    <tr>
                        <td class="align-middle">{{ $productImages->firstItem() + $index }}</td>
                        <td class="align-middle">
                            <img src="{{ $image->content }}" alt="Product Image" style="max-width: 100px;">
                        </td>
                        <td class="align-middle">
                            @if($image->mainImage)
                            <i class="fa-solid fa-check" style="color: #63E6BE;"></i>                           
                            @else                             
                            <i class="fa-solid fa-xmark" style="color: #ff000d;"></i>
                            @endif                          
                        </td>
                        <td class="align-middle">
                            <!-- Nút Sửa -->
                            <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                data-bs-target="#editImageModal{{ $image->id }}">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </button>
                            <!-- Nút Xóa -->
                            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                data-bs-target="#deleteImageModal{{ $image->id }}">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                    <!-- Modal Sửa -->
                    @include('admin.product_images.edit')
                    <!-- Modal Xóa -->
                    @include('admin.product_images.delete')
                @empty
                    <tr>
                        <td colspan="4" class="text-center">Không có hình ảnh nào.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <!-- Thêm phân trang -->
        <div class="d-flex justify-content-center mt-3">
            <div class="d-inline-flex p-2 bd-highlight">
                <label for="perPage" class="me-2">Hiển thị:</label>
            </div>
            <form method="GET" action="{{ route('admin.product-images.index', ['product_id'=> $product_id]) }}" class="me-2">
                <select id="perPage" name="perPage" class="form-select" aria-label="Số mục trên trang"
                    onchange="this.form.submit()">
                    <option value="5" {{ request()->perPage == '5' ? 'selected' : '' }}>5</option>
                    <option value="10" {{ request()->perPage == '10' ? 'selected' : '' }}>10</option>
                    <option value="15" {{ request()->perPage == '15' ? 'selected' : '' }}>15</option>
                </select>
            </form>
            {{ $productImages->links('vendor.pagination.bootstrap') }}
        </div>
    </div>

    {{-- Modal Thêm Hình Ảnh --}}
    @include('admin.product_images.create', ['product_id' => $product_id])
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
