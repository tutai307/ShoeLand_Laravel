@extends('admin.layouts.app')

@section('title', 'Thanh Toán')

@section('content')
    <div class="container my-4 appCard">
        <table class="table table-hover table-striped">
            <legend class="text-center my-4">
                <b>Quản lý Thanh Toán</b>
            </legend>
            <div class="text-left d-flex justify-content-between align-items-center mb-3">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createPaymentModal">
                    <i class="fa-solid fa-plus"></i>
                    Thêm Thanh Toán
                </button>

                <div>
                    <form method="GET" action="{{ route('admin.payments.index') }}">
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
                    <th class="text-center align-middle">STT</th>
                    <th class="text-center align-middle">Mã</th>
                    <th class="text-center align-middle">Tên Thanh Toán</th>
                    <th class="text-center align-middle">Mô tả</th>
                    <th class="text-center align-middle">Hành động</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($payments as $index => $payment)
                    <tr>
                        <td class="text-center align-middle">{{ $payments->firstItem() + $index }}</td>
                        <td class="text-center align-middle">{{ $payment->code }}</td>
                        <td class="text-center align-middle">{{ $payment->name }}</td>
                        <td style="max-width: 400px" class="text-center align-middle">{{ $payment->description }}</td>
                        <td class="text-center align-middle">
                            <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                data-bs-target="#editPaymentModal{{ $payment->id }}">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </button>
                            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                data-bs-target="#deletePaymentModal{{ $payment->id }}">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td class="text-center align-middle" colspan="7" class="text-center">Chưa có Thanh Toán nào.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <!-- Thêm phân trang -->
        <div class="d-flex justify-content-center mt-3">
            <div class="d-inline-flex p-2 bd-highlight">
                <label for="perPage" class="me-2">Hiển thị:</label>
            </div>
            <form method="GET" action="{{ route('admin.payments.index') }}" class="me-2">
                <select id="perPage" name="perPage" class="form-select" aria-label="Số mục trên trang"
                    onchange="this.form.submit()">
                    <option value="5" {{ request()->perPage == '5' ? 'selected' : '' }}>5</option>
                    <option value="10" {{ request()->perPage == '10' ? 'selected' : '' }}>10</option>
                    <option value="15" {{ request()->perPage == '15' ? 'selected' : '' }}>15</option>
                </select>
            </form>
            {{ $payments->links('vendor.pagination.bootstrap') }}
        </div>
    </div>

    {{-- Modal create --}}
    @include('admin.payments.create')

    {{-- Modal edit --}}
    @foreach ($payments as $payment)
        @include('admin.payments.edit', ['payment' => $payment])
    @endforeach

    {{-- Modal delete --}}
    @foreach ($payments as $payment)
        @include('admin.payments.delete', ['payment' => $payment])
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
