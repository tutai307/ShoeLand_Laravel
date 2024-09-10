<!-- Modal Thêm Kích Thước Sản Phẩm -->
<div class="modal fade" id="createSizeModal" tabindex="-1" aria-labelledby="createSizeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createSizeModalLabel">Thêm Kích Thước Sản Phẩm</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('admin.product-sizes.store', ['product_id' => $product_id]) }}">
                    @csrf
                    <div class="mb-3">
                        <label for="size_id" class="form-label">Kích Thước</label>
                        <select class="form-select" id="size_id" name="size_id" required>
                            <option value="" disabled selected>Chọn kích thước</option>
                            @foreach ($sizes as $size)
                                <option value="{{ $size->id }}">{{ $size->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="quantity" class="form-label">Số Lượng</label>
                        <input type="number" class="form-control" id="quantity" name="quantity" min="1" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Thêm</button>
                </form>
            </div>
        </div>
    </div>
</div>
