<!-- Modal for Editing Events -->
<div class="modal fade" id="editStatusModal{{ $status->id }}" tabindex="-1" aria-labelledby="editStatusModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editStatusModalLabel">Chỉnh Sửa trạng thái</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('admin.statuses.update', $status->id) }}" method="POST" id="editEventsForm" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="code" class="form-label">Mã trạng thái</label>
                        <input type="text" class="form-control" id="code" name="code" value="{{ $status->code }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">Tên trạng thái</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ $status->name }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Mô tả</label>
                        <textarea class="form-control" id="description" name="description">{{ $status->description }}</textarea>
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
