<!-- Modal Chỉnh Sửa Hình Ảnh -->
<div class="modal fade" id="editImageModal{{ $image->id }}" tabindex="-1" aria-labelledby="editImageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editImageModalLabel">Chỉnh Sửa Hình Ảnh</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('admin.product-images.update', ['image_id' => $image->id]) }}">
                    @csrf
                    @method('PUT') <!-- Xác định đây là yêu cầu PUT -->
                    <div class="mb-3">
                        <label for="content" class="form-label">Link Hình Ảnh</label>
                        <input type="text" class="form-control" id="content" name="content" value="{{ old('content', $image->content) }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="mainImage" class="form-check-label">Ảnh Chính</label>
                        <!-- Hidden input to ensure a value is sent if checkbox is unchecked -->
                        <input type="hidden" name="mainImage" value="0">
                        <!-- Checkbox for "Ảnh Chính" -->
                        <input type="checkbox" id="mainImage" name="mainImage" value="1" {{ $image->mainImage ? 'checked' : '' }}>
                    </div>
                    <button type="submit" class="btn btn-primary">Cập Nhật</button>
                </form>                
            </div>
        </div>
    </div>
</div>
