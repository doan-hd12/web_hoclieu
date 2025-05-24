<header>
    <nav class="navbar navbar-expand-sm navbar-light navbar-banner ">
        <div class="container-fluid">
            <div class="container-fluid d-flex justify-content-between align-items-center">
                <div class="navbar-main">
                    {{-- Logo --}}
                    <a href="{{ route('home') }}" class="navbar-brand">
                        <img src="{{ asset('images/logo-web.jpg') }}" alt="Logo" class="logo-img">
                    </a>
            
                    {{-- Tìm kiếm --}}
                    <form action="{{ route('documents.index') }}" method="GET" class="search-form">
                        <div class="search-input-wrapper">
                            <input type="text" name="search" class="form-control search-icon-input" placeholder="Tìm kiếm tài liệu...">
                            <button type="submit" class="search-icon-button">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>
                    </form>
                    
            
                    {{-- Icon bóng đèn --}}
                   
                    <button class="bulb-btn" id="toggle-dark-mode" title="Chuyển chế độ sáng/tối">
                        <!-- Bóng đèn sáng -->
                        <svg id="bulb-light" xmlns="http://www.w3.org/2000/svg" fill="none"
                             viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" class="icon-bulb">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M12 2a7 7 0 017 7c0 3.9-3.5 6.3-3.5 6.3M9.6 21h4.8M9 17h6M12 6v.01" />
                        </svg>
                    
                        <!-- Bóng đèn tắt -->
                        <svg id="bulb-dark" xmlns="http://www.w3.org/2000/svg" fill="none"
                             viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" class="icon-bulb" style="display: none;">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M12 3a9 9 0 00-9 9 9 9 0 009 9v-4a5 5 0 005-5 5 5 0 00-5-5z" />
                        </svg>
                    </button>

            {{-- Auth buttons --}}
                <div class="auth-section">
                    @auth
                        <div class="dropdown">
                            <button class="btn btn-transparent dropdown-toggle" type="button" data-toggle="dropdown">
                                {{ Auth::user()->name }}
                            </button>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="{{ route('account') }}" >Thông tin</a>

                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    
                                     <button type="submit" class="dropdown-item">Đăng xuất</button>

                                </form>
                            </div>
                        </div>
                    @else
                        <a href="{{ route('login') }}">
                            <button class="btn btn-sm btn-transparent">Đăng nhập</button>
                        </a>
                        <a href="{{ route('register') }}">
                            <button class="btn btn-sm btn-transparent">Đăng ký</button>
                        </a>
                    @endauth
                </div>

                </div>
                                 
        </div>
    </nav>
    {{-- menu --}}
</header>
<nav id="mainMenu" class="navbar navbar-expand-lg navbar-light bg-white border-top border-bottom shadow-sm custom-menu">
    <div class="container-fluid">
        <a class="navbar-brand d-lg-none" href="#">Menu</a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#mainNavbar"
                aria-controls="mainNavbar" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-center" id="mainNavbar">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}">
                        <i class="fas fa-home mr-1"></i> Trang chủ
                    </a>
                </li>
                <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMajors" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-th-list mr-1"></i> Danh mục
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdownMajors">
                @foreach ($majorsWithStats as $major)
                    <a class="dropdown-item" href="{{ route('documents.show', $major->id) }}">
                        {{ $major->name }}
                    </a>
                @endforeach
            </div>
        </li>

                    
               
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('documents.create') }}">
                        <i class="fas fa-upload mr-1"></i> Upload
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-warning font-weight-bold" href="#">
                        <i class="fas fa-star mr-1"></i> Nâng cấp VIP
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/home">
                        <i class="fas fa-clock mr-1"></i> Mới cập nhật
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<style>
    /* phần menu */
    .custom-menu {
    font-weight: 500;
    background-color: rgba(255, 255, 255, 0.95);
    z-index: 1030; /* Đảm bảo nổi trên các phần khác */
}

.custom-menu .nav-link {
    color: #333;
    padding: 0.75rem 1.2rem;
    transition: background 0.3s, color 0.3s;
    display: flex;
    align-items: center;
}

.custom-menu .nav-link:hover {
    background-color: #f0f0f0;
    color: #007bff;
}

.custom-menu .nav-link i {
    margin-right: 6px;
}

/* Dark mode */
body.dark-mode .custom-menu {
    background-color: #1f1f1f;
    border-color: #444;
}

body.dark-mode .custom-menu .nav-link {
    color: #ddd;
}

body.dark-mode .custom-menu .nav-link:hover {
    background-color: #333;
    color: #ffcc00;
}

</style>

<style>
/* Navbar Banner */
.navbar-banner {
    background-color: rgba(240, 238, 245, 0.93);
    background-image: url('/images/banner.jpg');
    background-size: cover;
    background-position: center;
    height: 90px;
    font-weight: bold;
    position: relative;
}

/* Main content: logo - search - bulb */
.navbar-main {
    display: flex;
    align-items: center;
    gap: 40px;
    position: absolute;
    left: 50%;
    top: 50%;
    transform: translate(-50%, -50%);
}

/* Logo */
.logo-img {
    height: 40px;
}

/* Search Form */
.search-form {
    display: flex;
}

.search-input-wrapper {
    position: relative;
    width: 450px; /* ✅ chỉnh tăng kích thước tại đây */
}

.search-icon-input {
    width: 100%;
    padding-right: 40px;
    padding-left: 10px;
    border-radius: 0.25rem;
    border: none;
    height: 38px;
}

.search-icon-button {
    position: absolute;
    top: 50%;
    right: 8px;
    transform: translateY(-50%);
    background: transparent;
    border: none;
    color: #555;
    cursor: pointer;
    padding: 0;
}

/* Bulb icon */
.bulb-btn {
    color: orange;
    background: transparent;
    border: none;
    padding: 0;
}

.icon-bulb {
    width: 24px;
    height: 24px;
}

/* Auth */
.auth-section {
    display: flex;
    align-items: center;
}

.auth-section .btn {
    margin-left: 5px;
}
/* Dropdown nằm ngang sang phải */
.auth-section .dropdown-menu {
    z-index: 1050 !important;
    position: absolute !important;
    top: 0;
    left: 100%;
    transform: translateX(10px); /* đẩy nhẹ sang phải */
    display: none;
    max-width: 150px ;
    min-width: 110px; /* tuỳ chọn: đảm bảo đủ độ rộng */
    font-size: 0.85rem; /* làm chữ nhỏ lại */
    padding: 0rem 0;
    text-align: left;
}


/* Hiển thị dropdown khi có class show */
.auth-section .dropdown.show .dropdown-menu {
    display: block;
}
.auth-section .dropdown {
    position: relative;
}



</style>
<style>
    /* DARK MODE TOÀN GIAO DIỆN */
body.dark-mode {
    background-color: #121212;
    color: #e0e0e0;
}

/* Navbar dark */
body.dark-mode .navbar-banner {
    background-color: #1f1f1f;
    background-image: none;
}

/* Search */
body.dark-mode .search-icon-input {
    background-color: #2a2a2a;
    color: #fff;
}

body.dark-mode .search-icon-input::placeholder {
    color: #aaa;
}

body.dark-mode .search-icon-button {
    color: #ffcc00;
}

/* Bóng đèn đổi màu */
body.dark-mode .bulb-btn {
    color: #ffcc00;
}

/* Auth button */
body.dark-mode .auth-section .btn {
    background-color: #2f2f2f;
    color: #fff;
    border: 1px solid #555;
}

body.dark-mode .auth-section .dropdown-menu {
    background-color: #2a2a2a;
}

body.dark-mode .auth-section .dropdown-item {
    color: #eee;
}
.bulb-btn {
    background: transparent;
    border: none;
    cursor: pointer;
    padding: 0;
    transition: transform 0.3s ease;
}

.bulb-btn:hover {
    transform: scale(1.2);
}

.icon-bulb {
    width: 28px;
    height: 28px;
    color: orange;
    transition: color 0.3s ease;
}

body.dark-mode .icon-bulb {
    color: #ffcc00;
}


</style>
<style>
    /* xử lý auth botton */
    .btn-transparent {
    background-color: transparent;
    color: #007bff;
    border: 1px solid #007bff;
    padding: 0.375rem 0.75rem;
    border-radius: 0.25rem;
    transition: background-color 0.2s, color 0.2s, border-color 0.2s;
}

.btn-transparent:hover {
    background-color: rgba(0, 123, 255, 0.1);
    color: #0056b3;
    border-color: #0056b3;
}
body.dark-mode .btn-transparent {
    color: #ffcc00;
    border-color: #ffcc00;
}

body.dark-mode .btn-transparent:hover {
    background-color: rgba(255, 204, 0, 0.1);
    color: #ffd633;
    border-color: #ffd633;
}


</style>
{{-- xử lý bóng đèn --}}
<script>
    const bulbBtn = document.getElementById('toggle-dark-mode');
    const bulbLight = document.getElementById('bulb-light');
    const bulbDark = document.getElementById('bulb-dark');

    function updateBulbIcon(isDark) {
        if (isDark) {
            bulbLight.style.display = 'none';
            bulbDark.style.display = 'inline';
        } else {
            bulbLight.style.display = 'inline';
            bulbDark.style.display = 'none';
        }
    }

    bulbBtn.addEventListener('click', () => {
        const isDark = document.body.classList.toggle('dark-mode');
        localStorage.setItem('theme', isDark ? 'dark' : 'light');
        updateBulbIcon(isDark);
    });

    // Auto-load saved theme
    window.addEventListener('DOMContentLoaded', () => {
        const saved = localStorage.getItem('theme') === 'dark';
        if (saved) document.body.classList.add('dark-mode');
        updateBulbIcon(saved);
    });
</script>
<script>
    // xử lý phần cuộn menu
    const menu = document.getElementById("mainMenu");
    const headerHeight = document.querySelector("header").offsetHeight;

    window.addEventListener("scroll", function () {
        if (window.scrollY >= headerHeight) {
            menu.classList.add("fixed-top", "shadow");
        } else {
            menu.classList.remove("fixed-top", "shadow");
        }
    });
</script>

@if(Auth::check() && Auth::user()->is_blocked)
    <div class="alert alert-danger text-center">
        <strong>Tài khoản của bạn đang bị khóa.</strong> Một số chức năng sẽ bị hạn chế.
    </div>
@endif



 <!-- Bootstrap JS (for dropdown to work) -->
 
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

 <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
 <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>