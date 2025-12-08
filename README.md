1. Yêu cầu hệ thống
Trước khi chạy dự án, cần cài đặt:
PHP ≥ 8.1
Composer
XAMPP (MySQL + Apache) https://www.apachefriends.org/download.html
Visual Studio Code
2. Tải mã nguồn
Clone từ GitHub hoặc copy thư mục dự án vào máy:
git clone https://github.com/tuandang1210/Web-b-n-qu-n-o-tr-c-tuy-n.git
3. Cài đặt dependency Laravel
Mở VS Code → Open Folder dự án → mở Terminal:
composer install
4. Tạo file môi trường .env
cp .env.example .env

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=qlbh1
DB_USERNAME=root
DB_PASSWORD=

SESSION_DRIVER=file

5. Tạo database & import dữ liệu
Đây là bước cần thực hiện trong phpMyAdmin
Mở XAMPP → Start Apache + MySQL
Truy cập
http://localhost/phpmyadmin
tạo database tên: qlbh1
Import file SQL của dự án

6. Generate App Key
Trong terminal:
php artisan key:generate

7. Chạy server Laravel
php artisan serve
Dự án chạy tại:
 http://127.0.0.1:8000

8. Tài khoản đăng nhập mẫu
Admin:
Username: admin
Password: 123456

Customer:
Username: tuandang
Password: 123456
