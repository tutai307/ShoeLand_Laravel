<!-- Modal for Editing Events -->
<div class="modal fade" id="editEventModal{{ $event->id }}" tabindex="-1" aria-labelledby="editEventModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editEventModalLabel">Chỉnh Sửa Sự Kiện</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('admin.events.update', $event->id) }}" method="POST" id="editEventsForm" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="code" class="form-label">Mã sự kiện</label>
                        <input type="text" class="form-control" id="code" name="code" value="{{ $event->code }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">Tên sự kiện</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ $event->name }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="discount" class="form-label">Giảm giá</label>
                        <input type="number" class="form-control" id="discount" name="discount" value="{{ $event->discount }}" required>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="start_date" class="form-label">Ngày bắt đầu sự kiện</label>
                            <input type="date" class="form-control" id="start_date" name="start_date" value="{{ \Carbon\Carbon::parse($event->start_date)->format('Y-m-d') }}" required>
                        </div>
                        <div class="col-md-6">
                            <label for="end_date" class="form-label">Ngày hết hạn sự kiện</label>
                            <input type="date" class="form-control" id="end_date" name="end_date" value="{{ \Carbon\Carbon::parse($event->end_date)->format('Y-m-d') }}" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="image">Hình ảnh</label>
                        <input type="file" class="form-control" id="image" name="image">
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Mô tả</label>
                        <textarea class="form-control" id="description" name="description">{{ $event->description }}</textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    <button type="submit" class="btn btn-primary">Lưu Thay Đổi</button>
                </div>
            </form>            
        </div>
    </div>
</div>
