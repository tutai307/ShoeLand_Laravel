@extends('admin.layouts.app')

@section('title', 'Người Dùng')

@section('content')
<div class="container my-4 appCard">
    <table class="table table-hover table-striped">
        <legend class="text-center my-4">
            <b>Quản lý Người Dùng</b>
        </legend>
        <div class="text-left d-flex justify-content-between align-items-center mb-3">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createsizeModal">
                <i class="fa-solid fa-plus"></i>
                Thêm Người Dùng
            </button>

            <div>
                <form method="GET" action="{{ route('admin.users.index') }}">
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
                <th>Tên đăng nhập</th>
                <th>Tên</th>
                <th>Email</th>
                <th>Vai trò</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($users as $index => $user)
                <tr>
                    <td class="align-middle">{{ $users->firstItem() + $index }}</td>
                    <td class="align-middle">{{ $user->username ? $user->username : "Đăng nhập Google" }}</td>           
                    <td class="align-middle">{{ $user->name }}</td>
                    <td class="align-middle">{{ $user->email ? $user->email : "Chưa có email" }}</td>           
                    <td class="align-middle">{{ $user->role }}</td>           
                    <td class="align-middle">
                        <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal"
                            data-bs-target="#editsizeModal{{ $user->id }}">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </button>
                        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                            data-bs-target="#deletesizeModal{{ $user->id }}">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td class="align-middle" colspan="7" class="text-center">Chưa có Người Dùng nào.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Thêm phân trang -->
    <div class="d-flex justify-content-center mt-3">
        <div class="d-inline-flex p-2 bd-highlight">
            <label for="perPage" class="me-2">Hiển thị:</label>
        </div>
        <form method="GET" action="{{ route('admin.users.index') }}" class="me-2">
            <select id="perPage" name="perPage" class="form-select" aria-label="Số mục trên trang"
                onchange="this.form.submit()">
                <option value="5" {{ request()->perPage == '5' ? 'selected' : '' }}>5</option>
                <option value="10" {{ request()->perPage == '10' ? 'selected' : '' }}>10</option>
                <option value="15" {{ request()->perPage == '15' ? 'selected' : '' }}>15</option>
            </select>
        </form>
        {{ $users->links('vendor.pagination.bootstrap') }}
    </div>
</div>
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
