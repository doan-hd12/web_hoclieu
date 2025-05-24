   

    @extends('layouts.admin')

@section('title', 'Đổi mật khẩu')

@section('content')
<div class="container" style="max-width: 500px; margin-top: 50px;">
    <h3>Đổi mật khẩu</h3>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('password.update') }}">
        @csrf

        <div class="form-group">
            <label for="current_password">Mật khẩu hiện tại</label>
            <input id="current_password" type="password" name="current_password" class="form-control" required autofocus>
        </div>

        <div class="form-group">
            <label for="new_password">Mật khẩu mới</label>
            <input id="new_password" type="password" name="new_password" class="form-control" required minlength="6">
        </div>

        <div class="form-group">
            <label for="new_password_confirmation">Xác nhận mật khẩu mới</label>
            <input id="new_password_confirmation" type="password" name="new_password_confirmation" class="form-control" required minlength="6">
        </div>

        <button type="submit" class="btn btn-primary">Đổi mật khẩu</button>
    </form>
</div>
@endsection


