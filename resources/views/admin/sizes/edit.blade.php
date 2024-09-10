<!-- Modal for Editing Sizes -->
@foreach ($sizes as $size)
    <div class="modal fade" id="editsizeModal{{ $size->id }}" tabindex="-1" aria-labelledby="editsizeModalLabel{{ $size->id }}" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editsizeModalLabel{{ $size->id }}">Chỉnh Sửa Kích Cỡ</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('admin.sizes.update', $size->id) }}" method="POST" id="editSizeForm{{ $size->id }}">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="code" class="form-label">Mã kích cỡ</label>
                            <input type="text" class="form-control" id="code" name="code" value="{{ $size->code }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">Tên kích cỡ</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ $size->name }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Mô tả</label>
                            <textarea class="form-control" id="description" name="description">{{ $size->description }}</textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                        <button type="submit" class="btn btn-primary">Cập nhật</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endforeach
