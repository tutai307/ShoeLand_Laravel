<!DOCTYPE html>
<html>
<head>
    <title>Xác nhận thay đổi địa chỉ email</title>
</head>
<body>
    <h1>Chào {{ $user->name }}</h1>
    <p>Bạn đã yêu cầu thay đổi địa chỉ email của mình thành {{ $newEmail }}.</p>
    <p>Vui lòng nhấn vào liên kết dưới đây để xác nhận email mới:</p>
    <a href="{{ $verificationUrl }}">Xác nhận email mới</a>
    <p>Nếu bạn không yêu cầu thay đổi này, hãy bỏ qua email này.</p>
</body>
</html>
