<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Trang chính
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/home', [HomeController::class, 'home'])->name('home');

Route::get('/search', function () {
    return 'Tìm kiếm!';
})->name('search');

// Profile user
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Đăng nhập/đăng ký
require __DIR__.'/auth.php';


// ============================
// 📂 Tài liệu (Document)
// ============================
Route::middleware(['auth', 'check.blocked'])->group(function () {
    Route::get('/documents/create', [DocumentController::class, 'create'])->name('documents.create');
    Route::post('/documents/store', [DocumentController::class, 'store'])->name('documents.store');
    Route::post('/documents/{id}/comment', [DocumentController::class, 'addComment'])->name('documents.comment');
    Route::post('/documents/{document}/comments/{comment}/reply', [DocumentController::class, 'reply'])->name('documents.comment.reply');
    Route::get('/documents/download/{id}', [DocumentController::class, 'download'])->middleware('auth')->name('documents.download');

});

Route::get('/documents/index', [DocumentController::class, 'index'])->name('documents.index');
Route::get('/documents/show/{id}', [DocumentController::class, 'show'])->name('documents.show');
Route::get('/documents/detail/{id}', [DocumentController::class, 'detail'])->name('documents.detail');
Route::get('/tai-lieu/xem-truoc/{id}', [DocumentController::class, 'preview'])->name('documents.preview');

// ============================
// 👤 Tài khoản người dùng
// ============================
Route::middleware(['auth'])->group(function () {
    Route::get('/accountpanel', [AccountController::class, 'accountpanel'])->name('account');
    Route::post('/saveaccountinfo', [AccountController::class, 'saveaccountinfo'])->name('saveinfo');
    Route::get('/change-password', [AccountController::class, 'showChangePasswordForm'])->name('password.change');
    Route::post('/change-password', [AccountController::class, 'changePassword'])->name('password.update');
});

// ============================
// 🛠️ Quản trị viên (Admin)
// ============================
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    // Trang tổng quan admin
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
    Route::get('/index', [AdminController::class, 'index'])->name('index');


    // Thông tin quản trị viên
    Route::get('/profile', [AdminController::class, 'thong_tin'])->name('profile');
Route::post('/luu_thong_tin', [AdminController::class, 'luu_thong_tin'])->name('luu_thong_tin');
    // Đổi mật khẩu
    Route::get('/reset-password', [AdminController::class, 'show_reset_password'])->name('reset-password');
    Route::post('/reset-password', [AdminController::class, 'reset_password'])->name('update-password');

    // Quản lý người dùng
    Route::get('/users', [AdminController::class, 'admin_user'])->name('users');
    Route::post('/users/{id}/block', [AdminController::class, 'toggleBlock'])->name('users.block');

});
    // Quản lý tài liệu
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/documents', [AdminController::class, 'admin_document'])->name('admin.documents.index');
    Route::delete('/documents/{id}', [AdminController::class, 'destroy'])->name('admin.documents.destroy');
});




