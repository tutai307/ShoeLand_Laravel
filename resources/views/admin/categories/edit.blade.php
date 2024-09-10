<div class="modal fade" id="editCategoryModal{{ $category->id }}" tabindex="-1" aria-labelledby="editCategoryModalLabel{{ $category->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editCategoryModalLabel{{ $category->id }}">Chỉnh Sửa Danh Mục</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('admin.categories.update', $category->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="code{{ $category->id }}" class="form-label">Mã danh mục</label>
                        <input type="text" class="form-control" id="code{{ $category->id }}" name="code" value="{{ $category->code }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="name{{ $category->id }}" class="form-label">Tên danh mục</label>
                        <input type="text" class="form-control" id="name{{ $category->id }}" name="name" value="{{ $category->name }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="image{{ $category->id }}">Hình ảnh</label>
                        <input type="file" class="form-control" id="image{{ $category->id }}" name="image">
                    </div>
                    <div class="mb-3">
                        <label for="description{{ $category->id }}" class="form-label">Mô tả</label>
                        <textarea style="height: 100px" class="form-control" id="description{{ $category->id }}" name="description">{{ $category->description }}</textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    <button type="submit" class="btn btn-primary">Lưu</button>
                </div>
            </form>
        </div>
    </div>
</div>