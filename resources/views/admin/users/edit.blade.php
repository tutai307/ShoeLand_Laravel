<!-- Modal for Editing users -->
<div class="modal fade" id="editUserModal{{ $user->id }}" tabindex="-1"
    aria-labelledby="editUserModalLabel{{ $user->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editUserModalLabel{{ $user->id }}">Chỉnh Sửa Người Dùng</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('admin.users.update', $user->id) }}" method="POST"
                id="editUserForm{{ $user->id }}">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="username{{ $user->id }}" class="form-label">Tên Đăng Nhập</label>
                        <input disabled type="text" class="form-control" id="username{{ $user->id }}"
                            name="username" value="{{ $user->username ?? 'Đăng nhập Google' }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="name{{ $user->id }}" class="form-label">Tên Người Dùng</label>
                        <input type="text" class="form-control" id="name{{ $user->id }}" name="name"
                            value="{{ $user->name }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="email{{ $user->id }}" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email{{ $user->id }}" name="email"
                            value="{{ $user->email }}" {{ $user->email ? 'disabled' : '' }}>
                    </div>
                    <div class="mb-3">
                        <label for="role{{ $user->id }}" class="form-label">Vai Trò</label>
                        <select class="form-select" id="role{{ $user->id }}" name="role">
                            <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                            <option value="client" {{ $user->role == 'client' ? 'selected' : '' }}>Client</option>
                        </select>
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
