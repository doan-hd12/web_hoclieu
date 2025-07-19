# Web Chia Sẻ Học Liệu

##  Giới thiệu dự án

**Web Chia Sẻ Học Liệu** là một ứng dụng web được phát triển nhằm cung cấp một nền tảng trực tuyến cho phép người dùng dễ dàng tải lên, tải xuống, tìm kiếm và quản lý các tài liệu học tập. Dự án này được xây dựng như một đồ án học tập, giúp củng cố kiến thức về phát triển ứng dụng web full-stack sử dụng framework Laravel.

##  Tính năng nổi bật

* **Quản lý tài liệu:**
    * Tải lên và tải xuống các loại tài liệu học tập (ví dụ: PDF, Word, PowerPoint, hình ảnh,...).
    * Phân loại tài liệu theo danh mục, chuyên ngành, hoặc môn học để dễ dàng tìm kiếm.
    * Xem thông tin chi tiết về tài liệu.
* **Hệ thống người dùng:**
    * Phân quyền đăng nhập;Đăng ký/Đăng nhập tài khoản an toàn, reset passwork.
    * Quản lý, cập nhật thông tin cá nhân.
    * Chức năng bình luận trên các tài liệu.
* **Tìm kiếm & Lọc:**
    * Tìm kiếm tài liệu theo từ khóa, tên, mô tả.
    * Lọc tài liệu theo danh mục, người tải lên.
* **Quản lý (Admin):**
    * Duyệt và quản lý tài liệu được tải lên.
    * Quản lý người dùng và quyền hạn người dùng.

##  Công nghệ sử dụng

* **Backend:**
    * PHP 8.1.3
    * Laravel Framework 10.48.29
    * MySQL (Database)
* **Frontend:**
    * HTML5
    * CSS3
    * JavaScript
    * Bootstrap 
* **Hệ thống quản lý phiên bản:** Git, GitHub

##  Hướng dẫn cài đặt và chạy dự án

Để chạy dự án này trên máy cục bộ của bạn, vui lòng làm theo các bước sau:

1.  **Clone Repository:**
    ```bash
    git clone [https://github.com/doan-hd12/web_hoclieu.git](https://github.com/doan-hd12/web_hoclieu.git)
    cd web_hoclieu
    ```

2.  **Cài đặt Composer Dependencies:**
    ```bash
    composer install
    ```

3.  **Tạo file `.env`:**
    Sao chép file `.env.example` và đổi tên thành `.env`.
    ```bash
    cp .env.example .env
    ```

4.  **Cấu hình Database:**
    Mở file `.env` và cập nhật thông tin kết nối database của bạn:
    ```dotenv
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=your_database_name # Thay bằng tên database của bạn
    DB_USERNAME=your_database_user # Thay bằng username database của bạn
    DB_PASSWORD=your_database_password # Thay bằng password database của bạn
    ```

5.  **Tạo Application Key:**
    ```bash
    php artisan key:generate
    ```

6.  **Chạy Migrations và Seeding (tùy chọn):**
    Để tạo cấu trúc bảng và thêm dữ liệu mẫu vào database:
    ```bash
    php artisan migrate --seed
    ```
   // trường hợp chạy: php artisan migrate không được thì có thể do lỗi phiên bản mysql; có thể tham khảo database file "web_hoclieu.sql" tại thư mục database

7.  **Chạy Laravel Server:**
    ```bash
    php artisan serve
    ```

8.  **Truy cập ứng dụng:**
    Mở trình duyệt và truy cập vào địa chỉ: `http://127.0.0.1:8000`



##  Tác giả

* **Hoàng Duy Đoàn**
    * GitHub: [https://github.com/doan-hd12](https://github.com/doan-hd12)
    * Email: doanhoang0304@gmail.com

##  Giấy phép

Dự án này được cấp phép theo Giấy phép MIT.
