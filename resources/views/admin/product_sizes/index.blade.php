@extends('admin.layouts.app')

@section('title', 'Quản lý Kích Thước Sản Phẩm')

@section('content')
    <div class="container my-4 appCard">
        <legend class="text-center my-4">
            <b>Quản lý Kích Thước Sản Phẩm - {{ $product->name }}</b>
        </legend>

        <div class="text-left d-flex justify-content-between align-items-center mb-3">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createSizeModal">
                <i class="fa-solid fa-plus"></i>
                Thêm Kích Thước
            </button>
        </div>

        <table class="table table-hover table-striped">
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Mã Kích Thước</th>
                    <th>Tên Kích Thước</th>
                    <th>Số lượng</th>
                    <th>Hành Động</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($product_sizes as $index => $product_size)
                    <tr>
                        <td class="align-middle">{{ $product_sizes->firstItem() + $index }}</td>
                        <td class="align-middle">{{ $product_size->size->code }}</td>
                        <td class="align-middle">{{ $product_size->size->name }}</td>
                        <td class="align-middle">{{ $product_size->quantity }}</td>
                        <td class="align-middle">
                            <!-- Nút Sửa -->
                            <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                data-bs-target="#editSizeModal{{ $product_size->size_id }}">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </button>
                            <!-- Nút Xóa -->
                            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                data-bs-target="#deleteSizeModal{{ $product_size->size_id }}">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                    <!-- Modal Sửa -->
                    @include('admin.product_sizes.edit')
                    <!-- Modal Xóa -->
                    @include('admin.product_sizes.delete')
                @empty
                    <tr>
                        <td colspan="5" class="text-center">Không có kích thước nào.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <!-- Thêm phân trang -->
        <div class="d-flex justify-content-center mt-3">
            <div class="d-inline-flex p-2 bd-highlight">
                <label for="perPage" class="me-2">Hiển thị:</label>
            </div>
            <form method="GET" action="{{ route('admin.product-sizes.index', ['product_id'=> $product_id]) }}" class="me-2">
                <select id="perPage" name="perPage" class="form-select" aria-label="Số mục trên trang"
                    onchange="this.form.submit()">
                    <option value="5" {{ request()->perPage == '5' ? 'selected' : '' }}>5</option>
                    <option value="10" {{ request()->perPage == '10' ? 'selected' : '' }}>10</option>
                    <option value="15" {{ request()->perPage == '15' ? 'selected' : '' }}>15</option>
                </select>
            </form>
            {{ $product_sizes->links('vendor.pagination.bootstrap') }}
        </div>
    </div>

    {{-- Modal Thêm Kích Thước --}}
    @include('admin.product_sizes.create', ['product_id' => $product_id])
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
