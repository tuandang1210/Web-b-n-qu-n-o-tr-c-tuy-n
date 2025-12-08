1. Yêu cầu hệ thống
Trước khi chạy dự án, cần cài đặt:
PHP ≥ 8.1
Composer
XAMPP (MySQL + Apache)
Visual Studio Code
2. Tải mã nguồn
Clone từ GitHub hoặc copy thư mục dự án vào máy:
git clone https://github.com/tuandang1210/Web-b-n-qu-n-o-tr-c-tuy-n.git
3. Cài đặt dependency Laravel
Mở VS Code → Open Folder dự án → mở Terminal:
composer install
4. Tạo file môi trường .env
cp .env.example .env

APP_NAME=Laravel
APP_ENV=local
APP_KEY=base64:Fg5rH3mMH5vaI1Z9il8Hzpe17+PwUlEdYne8bL8yOek=
APP_DEBUG=true
APP_URL=http://localhost

APP_LOCALE=en
APP_FALLBACK_LOCALE=en
APP_FAKER_LOCALE=en_US

APP_MAINTENANCE_DRIVER=file
# APP_MAINTENANCE_STORE=database

# PHP_CLI_SERVER_WORKERS=4

BCRYPT_ROUNDS=12

LOG_CHANNEL=stack
LOG_STACK=single
LOG_DEPRECATIONS_CHANNEL=null
LOG_LEVEL=debug

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=qlbh1
DB_USERNAME=root
DB_PASSWORD=

SESSION_DRIVER=file
SESSION_LIFETIME=120
SESSION_ENCRYPT=false
SESSION_PATH=/
SESSION_DOMAIN=127.0.0.1

BROADCAST_CONNECTION=log
FILESYSTEM_DISK=local
QUEUE_CONNECTION=database

CACHE_STORE=database
# CACHE_PREFIX=

MEMCACHED_HOST=127.0.0.1

REDIS_CLIENT=phpredis
REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

MAIL_MAILER=log
MAIL_SCHEME=null
MAIL_HOST=127.0.0.1
MAIL_PORT=2525
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_FROM_ADDRESS="hello@example.com"
MAIL_FROM_NAME="${APP_NAME}"

AWS_ACCESS_KEY_ID=
AWS_SECRET_ACCESS_KEY=
AWS_DEFAULT_REGION=us-east-1
AWS_BUCKET=
AWS_USE_PATH_STYLE_ENDPOINT=false

VITE_APP_NAME="${APP_NAME}"


5. Tạo database & import dữ liệu
Đây là bước cần thực hiện trong phpMyAdmin
Mở XAMPP → Start Apache + MySQL
Truy cập
http://localhost/phpmyadmin
tạo database tên: qlbh1
Import file SQL của dự án

6. Chạy server Laravel
php artisan serve
Dự án chạy tại:
 http://127.0.0.1:8000

7. Tài khoản đăng nhập mẫu (nếu có)
Admin:
Username: admin
Password: 123456

Customer:
Username: tuan
Password: 123456
