<!-- Modal Chỉnh Sửa Kích Thước Sản Phẩm -->
<div class="modal fade" id="editSizeModal{{ $product_size->size_id }}" tabindex="-1" aria-labelledby="editSizeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editSizeModalLabel">Chỉnh Sửa Kích Thước Sản Phẩm</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('admin.product-sizes.update', ['product_id' => $product_size->product_id, 'size_id' => $product_size->size_id]) }}">
                    @csrf
                    @method('PUT') <!-- Xác định đây là yêu cầu PUT -->
                    <div class="mb-3">
                        <label for="size_id" class="form-label">Kích Thước: {{ $product_size->size->name }}</label>
                        <!-- Bạn có thể thêm thông tin kích thước ở đây nếu cần -->
                    </div>
                    <div class="mb-3">
                        <label for="quantity" class="form-label">Số Lượng</label>
                        <input type="number" class="form-control" id="quantity" name="quantity" value="{{ old('quantity', $product_size->quantity) }}" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Cập Nhật</button>
                </form>                
            </div>
        </div>
    </div>
</div>
