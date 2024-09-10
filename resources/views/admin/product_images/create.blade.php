<!-- Modal Thêm Hình Ảnh -->
<div class="modal fade" id="createImageModal" tabindex="-1" aria-labelledby="createImageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createImageModalLabel">Thêm Hình Ảnh</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('admin.product-images.store', ['product_id' => $product_id]) }}">
                    @csrf
                    <div class="mb-3">
                        <label for="content" class="form-label">Link Hình Ảnh</label>
                        <input type="text" class="form-control" id="content" name="content" required>
                    </div>
                    <div class="mb-3">
                        <label for="mainImage" class="form-check-label">Ảnh Chính</label>
                        <input type="hidden" name="mainImage" value="0">
                        <input type="checkbox" id="mainImage" name="mainImage" value="1" onclick="this.previousElementSibling.value=this.checked ? 1 : 0">
                    </div>
                    <button type="submit" class="btn btn-primary">Thêm</button>
                </form>                
            </div>
        </div>
    </div>
</div>
