<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'Quản trị hệ thống')</title>

  {{-- Bootstrap và Font Awesome --}}
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

  <style>
    body {
      background-color: rgb(176, 180, 182);
    }

    .navbar {
      font-weight: bold;
      margin-bottom: 0;
      background-color: #ffffff;
      box-shadow: 0 2px 4px rgba(0,0,0,0.05);
    }

    .sidebar {
      position: fixed;
      top: 0;
      bottom: 0;
      left: 0;
      width: 250px;
      padding-top: 56px;
      background-color: #333;
      color: white;
      box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
      z-index: 1000;
    }

    .sidebar .nav-link {
      color: white !important;
      padding: 10px 20px;
    }

    .sidebar .nav-link:hover,
    .sidebar .nav-link.active {
      background-color: #586a92;
      border-radius: 4px;
    }

    .content {
      margin-left: 250px;
      padding: 30px;
    }

    @media (max-width: 768px) {
      .sidebar {
        display: none;
      }

      .sidebar.show {
        display: block;
        position: absolute;
        background-color: #333;
        width: 100%;
        height: 100%;
        padding-top: 60px;
      }

      .content {
        margin-left: 0;
        padding: 15px;
      }

      .sidebar-toggle {
        display: block;
      }
    }

    .sidebar-toggle {
      display: none;
      position: absolute;
      top: 10px;
      left: 10px;
      background: none;
      border: none;
      color: #333;
      font-size: 24px;
      z-index: 1100;
    }

    .avatar-box {
      text-align: center;
      margin-bottom: 20px;
    }

    .avatar-box img {
      width: 50px;
      height: 50px;
      border-radius: 50%;
      object-fit: cover;
      border: 2px solid #ccc;
      transition: 0.3s ease;
    }

    .avatar-box img:hover {
      opacity: 0.85;
      box-shadow: 0 0 0 3px #2c7be5;
    }

    .avatar-box .name {
      margin-top: 10px;
      font-weight: 600;
      font-size: 0.75rem;
      color: #e4dede;
    }
  </style>
</head>
<body>

  <button class="sidebar-toggle" onclick="toggleSidebar()">
    <i class="fas fa-bars"></i>
  </button>

  {{-- Sidebar --}}
  <div class="sidebar" id="sidebar">
    <div class="avatar-box">
      <img src="{{ Auth::user()?->photo 
          ? asset('storage/profile/' . Auth::user()->photo) 
          : asset('images/andanh.jpg') }}" 
          alt="Ảnh đại diện">
      <div class="name"><em>Hi ~ {{ Auth::user()?->name ?? 'Khách' }}</em></div>
    </div>

    <ul class="nav flex-column">
      <li class="nav-item">
        <a class="nav-link {{ request()->is('admin/index') ? 'active' : '' }}" href="{{ url('/admin/index') }}">
          <i class="fas fa-tachometer-alt mr-2"></i> Dashboard
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link {{ request()->is('admin/users*') ? 'active' : '' }}" href="{{ url('/admin/users') }}">
          <i class="fas fa-users mr-2"></i> Quản lý người dùng
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link {{ request()->is('admin.documents.index*') ? 'active' : '' }}" href="{{ route('admin.documents.index') }}">
          <i class="fas fa-file-alt mr-2"></i> Quản lý tài liệu
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link {{ request()->is('admin/profile') ? 'active' : '' }}" href="{{ url('/admin/profile') }}">
          <i class="fas fa-user mr-2"></i> Thông tin tài khoản
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link {{ request()->is('admin/reset-password') ? 'active' : '' }}" href="{{ url('/admin/reset-password') }}">
          <i class="fas fa-key mr-2"></i> Đổi mật khẩu
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link {{ request()->is('home') ? 'active' : '' }}" href="{{ url('/home') }}">
          <i class=""></i> -->Quay lại trang web
        </a>
      </li>
    </ul>

    <form action="{{ route('logout') }}" method="POST" class="text-center mt-5">@csrf
      <button type="submit" style="background: none; border: none; color: white; cursor: pointer;">
        <i class="fas fa-sign-out-alt mr-2"></i> Đăng xuất
      </button>
    </form>
  </div>

  {{-- Nội dung chính --}}
  <main class="content">
    @yield('content')
  </main>

  {{-- Script --}}
  <script>
    function toggleSidebar() {
      const sidebar = document.getElementById('sidebar');
      sidebar.classList.toggle('show');
    }
  </script>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
