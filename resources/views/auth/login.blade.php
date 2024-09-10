@extends('layouts.app')

@section('content')
    <!-- Các phần HTML khác -->
    <a href="{{ route('home') }}">
        <img src="{{ asset('storage/logo.svg') }}" alt=""
            style="width: 120px;position: absolute; top: 20px ; right: 10px">
    </a>

    <a href="{{ route('home') }}" class="p-2 bg-white"
        style="border-radius: 10px; position: absolute;top: 35px;left:10px;font-weight: bold;">
        <i class="fa-solid fa-circle-chevron-left"></i>
        Về trang chủ
    </a>
    <div class="ocean">
        <div class="wave"></div>
        <div class="wave"></div>
    </div>
    {{-- Form sign up --}}
    <div class="container_login" id="container_login">
        <div class="form-container_login sign-up-container_login">
            <form name="signUp" action="{{ route('register') }}" method="POST" onsubmit="return validateForm()">
                @csrf
                @method('POST')
                <h1>Đăng ký</h1>
                <label>
                    <input id="name" name="name" type="text" placeholder="Tên của bạn" required />
                </label>
                <label>
                    <input id="username" name="username" type="text" placeholder="Tên đăng nhập" required />
                </label>
                <label>
                    <input id="password" name="password" type="password" placeholder="Mật khẩu" required />
                </label>
                <label>
                    <input id="passwordConfirmation" name="passwordConfirmation" type="password"
                        placeholder="Xác nhận mật khẩu" required />
                </label>
                <button style="margin-top: 9px" name="signUp">Đăng ký</button>
            </form>

        </div>
        <div class="form-container_login sign-in-container_login">
            <form name="login" action="{{ route('login') }}" method="POST">
                @csrf
                <h1>Đăng nhập</h1>
                <div class="social-container_login">
                    <a href="" target="_blank" class="social"><i class="fab fa-facebook"></i></a>
                    <a href="{{ url('auth/google') }}" target="_blank" class="social"><i class="fab fa-google"></i></a>
                </div>
                <span> Hoặc đăng nhập bằng tài khoản sẵn có</span>
                <label>
                    <input required name="username" type="text" placeholder="Tên đăng nhập" />
                </label>
                <label>
                    <input required name="password" type="password" placeholder="Mật khẩu" />
                </label>
                <button name="login">Đăng nhập</button>
            </form>
        </div>
        <div class="overlay-container_login">
            <div class="overlay">
                <div class="overlay-panel overlay-left">
                    <h1>Đăng nhập</h1>
                    <p>Đăng nhập nếu bạn đã có sẵn tài khoản</p>
                    <button class="ghost mt-5" id="signIn">Đăng nhập</button>
                </div>
                <div class="overlay-panel overlay-right">
                    <h1>Đăng ký!</h1>
                    <p>Đăng ký tài khoản mới để khám phá nào... </p>
                    <button class="ghost" id="signUp">Đăng ký</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        // Hàm kiểm tra tên đăng nhập hợp lệ
        function validateUsername(username) {
            const minLength = 3;
            const maxLength = 20;
            const validUsernamePattern = /^[a-zA-Z0-9](?!.*[_.]{2})[a-zA-Z0-9._]{1,18}[a-zA-Z0-9]$/;

            if (username.length < minLength || username.length > maxLength) {
                Swal.fire({
                    icon: 'error',
                    title: 'Lỗi',
                    text: `Tên đăng nhập phải có độ dài từ ${minLength} đến ${maxLength} ký tự.`,
                });
                return false;
            }

            if (!validUsernamePattern.test(username)) {
                Swal.fire({
                    icon: 'error',
                    title: 'Lỗi',
                    text: 'Tên đăng nhập chỉ được chứa các ký tự chữ cái, chữ số, dấu gạch dưới (_), dấu chấm (.), ' +
                        'không bắt đầu hoặc kết thúc bằng dấu gạch dưới/dấu chấm, và không chứa hai dấu gạch dưới/dấu chấm liên tiếp.',
                });
                return false;
            }

            return true;
        }

        // Hàm kiểm tra mật khẩu hợp lệ
        function isValidPassword(password) {
            const minLength = 8;
            const hasUpperCase = /[A-Z]/.test(password);
            const hasLowerCase = /[a-z]/.test(password);
            const hasNumber = /[0-9]/.test(password);
            const hasSpecialChar = /[!@#$%^&*(),.?":{}|<>]/.test(password);

            if (password.length < minLength) {
                Swal.fire({
                    icon: 'error',
                    title: 'Lỗi',
                    text: 'Mật khẩu phải có ít nhất 8 ký tự.',
                });
                return false;
            }

            if (!hasUpperCase) {
                Swal.fire({
                    icon: 'error',
                    title: 'Lỗi',
                    text: 'Mật khẩu phải có ít nhất một chữ cái viết hoa.',
                });
                return false;
            }

            if (!hasLowerCase) {
                Swal.fire({
                    icon: 'error',
                    title: 'Lỗi',
                    text: 'Mật khẩu phải có ít nhất một chữ cái viết thường.',
                });
                return false;
            }

            if (!hasNumber) {
                Swal.fire({
                    icon: 'error',
                    title: 'Lỗi',
                    text: 'Mật khẩu phải có ít nhất một chữ số.',
                });
                return false;
            }

            if (!hasSpecialChar) {
                Swal.fire({
                    icon: 'error',
                    title: 'Lỗi',
                    text: 'Mật khẩu phải có ít nhất một ký tự đặc biệt (như !@#$%^&*).',
                });
                return false;
            }

            return true;
        }

        // Hàm kiểm tra toàn bộ biểu mẫu đăng ký
        function validateForm() {
            const name = document.getElementById('name').value;
            const username = document.getElementById('username').value;
            const password = document.getElementById('password').value;
            const passwordConfirmation = document.getElementById('passwordConfirmation').value;

            if (name === "") {
                Swal.fire({
                    icon: 'error',
                    title: 'Lỗi',
                    text: 'Tên không được để trống!',
                });
                return false;
            }

            if (!validateUsername(username)) {
                return false; // Hàm validateUsername sẽ hiển thị thông báo lỗi
            }

            if (!isValidPassword(password)) {
                return false; // Hàm isValidPassword sẽ hiển thị thông báo lỗi
            }

            if (password !== passwordConfirmation) {
                Swal.fire({
                    icon: 'error',
                    title: 'Lỗi',
                    text: 'Mật khẩu và xác nhận mật khẩu không khớp!',
                });
                return false;
            }

            return true;
        }

        // Hiển thị thông báo Toast khi có session msg
        @if (session('msg'))
            const Toast = Swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.onmouseenter = Swal.stopTimer;
                    toast.onmouseleave = Swal.resumeTimer;
                }
            });
            Toast.fire({
                icon: "{{ session('icon') }}",
                title: "{{ session('msg') }}"
            });
        @endif
    </script>
@endsection

