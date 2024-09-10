<!-- Modal Xóa Kích Thước Sản Phẩm -->
<div class="modal fade" id="deleteSizeModal{{ $product_size->size_id }}" tabindex="-1" aria-labelledby="deleteSizeModalLabel{{ $product_size->size_id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteSizeModalLabel{{ $product_size->size_id }}">Xóa Kích Thước Sản Phẩm</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Bạn có chắc chắn muốn xóa kích thước sản phẩm này không?
            </div>
            <div class="modal-footer">
                <form method="POST" action="{{ route('admin.product-sizes.destroy', ['product_id' => $product_size->product_id, 'size_id' => $product_size->size_id]) }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Xóa</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                </form>
            </div>
        </div>
    </div>
</div>
