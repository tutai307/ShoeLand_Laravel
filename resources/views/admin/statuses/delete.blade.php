<!-- Modal for Deleting Event -->
<div class="modal fade" id="deleteStatusModal{{ $status->id }}" tabindex="-1" aria-labelledby="deleteStatusModalLabel{{ $status->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteStatusModalLabel{{ $status->id }}">Xóa Sự Kiện {{ $status->code }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('admin.statuses.destroy', $status->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-body">
                    Bạn có chắc chắn muốn xóa sự kiện này không?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    <button type="submit" class="btn btn-danger">Xoá</button>
                </div>
            </form>
        </div>
    </div>
</div>
