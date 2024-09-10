<!-- Modal Xóa Hình Ảnh -->
<div class="modal fade" id="deleteImageModal{{ $image->id }}" tabindex="-1" aria-labelledby="deleteImageModalLabel{{ $image->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteImageModalLabel{{ $image->id }}">Xóa Hình Ảnh</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Bạn có chắc chắn muốn xóa hình ảnh này không?
            </div>
            <div class="modal-footer">
                <form method="POST" action="{{ route('admin.product-images.destroy', ['image_id' => $image->id]) }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Xóa</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                </form>
            </div>
        </div>
    </div>
</div>
