@extends('admin.layouts.app')

@section('title', 'Sự kiện')

@section('content')
    <div class="container my-4 appCard">
        <table class="table table-hover table-striped">
            <legend class="text-center my-4">
                <b>Quản lý Sự Kiện</b>
            </legend>
            <div class="text-left d-flex justify-content-between align-items-center mb-3">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createEventModal">
                    <i class="fa-solid fa-plus"></i>
                    Thêm Sự Kiện
                </button>

                <div>
                    <form method="GET" action="{{ route('admin.events.index') }}">
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
                    <th>Ảnh</th>
                    <th>Giảm giá</th>
                    <th>Thời hạn</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($events as $index => $event)
                    <tr>
                        <td class="align-middle">{{ $events->firstItem() + $index }}</td>
                        <td class="align-middle">{{ $event->code }}</td>
                        <td class="align-middle">{{ $event->name }}</td>
                        <td class="align-middle">
                            @if ($event->image)
                                <img src="{{ asset('storage/' . $event->image) }}" alt="{{ $event->name }}" width="100">
                            @else
                                Không có ảnh
                            @endif
                        </td>
                        <td class="align-middle">{{ $event->discount }}%</td>
                        <td class="align-middle">
                            @if (\Carbon\Carbon::parse($event->end_date)->isFuture())
                                {{ \Carbon\Carbon::parse($event->end_date)->diffInDays() }} ngày nữa
                            @else
                                Hết hạn
                            @endif
                        </td>
                        <td class="align-middle">
                            <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                data-bs-target="#editEventModal{{ $event->id }}">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </button>
                            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                data-bs-target="#deleteEventModal{{ $event->id }}">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td class="align-middle" colspan="7" class="text-center">Chưa có sự kiện nào.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <!-- Thêm phân trang -->
        <div class="d-flex justify-content-center mt-3">
            <div class="d-inline-flex p-2 bd-highlight">
                <label for="perPage" class="me-2">Hiển thị:</label>
            </div>
            <form method="GET" action="{{ route('admin.events.index') }}" class="me-2">
                <select id="perPage" name="perPage" class="form-select" aria-label="Số mục trên trang"
                    onchange="this.form.submit()">
                    <option value="5" {{ request()->perPage == '5' ? 'selected' : '' }}>5</option>
                    <option value="10" {{ request()->perPage == '10' ? 'selected' : '' }}>10</option>
                    <option value="15" {{ request()->perPage == '15' ? 'selected' : '' }}>15</option>
                </select>
            </form>
            {{ $events->links('vendor.pagination.bootstrap') }}
        </div>
    </div>

    {{-- Modal create --}}
    @include('admin.events.create')

    {{-- Modal edit --}}
    @foreach ($events as $event)
        @include('admin.events.edit', ['event' => $event])
    @endforeach

    {{-- Modal delete --}}
    @foreach ($events as $event)
        @include('admin.events.delete', ['event' => $event])
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
