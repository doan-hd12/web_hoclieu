@extends('layouts.admin')

@section('title', 'Thông tin cá nhân')

@section('content')
      @if ($errors->any())
    <div style='color:red;width:30%; margin:0 auto'>
        <div>
            {{ __('Whoops! Something went wrong.') }} <!-- Thông báo chung khi có lỗi -->
        </div>
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    @if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
    @endif

    <form method='post' action="{{ route('admin.luu_thong_tin') }}" enctype="multipart/form-data" class="form-wrapper">
    <h3>CẬP NHẬT THÔNG TIN</h3>
  
     <!--  -->
     <div class="avatar-box">
         <label for="photo" class="avatar-upload">
        <img src="{{ Auth::user()?->photo 
            ? asset('storage/profile/' . Auth::user()->photo) 
            : asset('images/andanh.jpg') }}" 
     alt="Ảnh đại diện" id="avatarPreview">
           <div class="name"><em>{{ Auth::user()?->name ?? 'Khách' }}</em></div>

        <input type="file" name="photo" id="photo" accept="image/*" style="display: none" onchange="previewAvatar(event)">
    </div>
    <div class="form-group-inline">
        <label>Tên đăng nhập</label>
        <input type='text' class='form-control' name='name' value="{{ $user->name }}">
    </div>

    <div class="form-group-inline">
        <label>Họ và tên</label>
        <input type='text' class='form-control' name='full_name' value="{{ $user->full_name }}">
    </div>

    <div class="form-group-inline">
        <label>Email</label>
        <input type='text' class='form-control' name='email' value="{{ $user->email }}">
    </div>


    <div class="form-group-inline">
        <label>Số điện thoại</label>
        <input type='text' class='form-control' name='phone' value="{{ $user->phone }}">
    </div>

   

    <input type='hidden' name='id' value='{{ $user->id }}'>


    {{ csrf_field() }}

    <div style="text-align: center;">
        <input type='submit' class='btn btn-primary mt-2' value='Lưu'>
    </div>
</form>

<style>
.form-wrapper {
    max-width: 500px;
    margin: 30px auto;
    background: #fff;
    padding: 20px 30px;
    border-radius: 8px;
    box-shadow: 0 4px 16px rgba(0, 0, 0, 0.15);
}

.form-wrapper h3 {
    text-align: center;
    color: #2c7be5;
    margin-bottom: 25px;
}

.avatar-box {
    text-align: center;
    margin-bottom: 20px;
    position: relative;
}

.avatar-box img {
    width: 100px;
    height: 100px;
    border-radius: 50%;
    object-fit: cover;
    border: 2px solid #ccc;
    cursor: pointer;
    transition: 0.3s ease;
}

.avatar-box img:hover {
    opacity: 0.85;
    box-shadow: 0 0 0 3px #2c7be5;
}

.avatar-box .name {
    margin-top: 1px;
    font-weight: 600;
    font-size: 1rem;
    color: #444;
}

.form-group-inline {
    display: flex;
    align-items: center;
    margin-bottom: 15px;
}

.form-group-inline label {
    width: 120px;
    margin-right: 5px;
    font-weight: 600;
    margin-bottom: 0;
    color: #333;
}

.form-group-inline input {
    flex: 1;
}
</style>




<script>
    // xử lý avatar
    function previewAvatar(event) {
        const input = event.target;
        const preview = document.getElementById('avatarPreview');

        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function (e) {
                preview.src = e.target.result;
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>

@endsection



