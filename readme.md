# Laravel Blog

A simple blog for demonstration purpose. Based on Laravel 5.8

## Demo login info

user: test@test.test | password: password
user: admin@admin.admin | password: password  admin user

## Installation

```
git clone https://github.com/Nohaaa13/Simple_blog-.git
cd Simple_blog-
composer install
cp .env.example .env
write in env your db setting
php artisan key:generate
php artisan migrate
composer dump-autoload
php artisan db:seed
```
## API Endpoints

This projects exposes some API endpoints. You could request those endpoints with the `api_token` passed as query parameters, like this- `/api/posts?api_token=YOUR_API_KEY`. The API key could be obtained from `/api/auth/token` endpoint. Available endpoints are-

```
/api/auth/token  //?email=test@test.test&password=password

/api/users     // only accessible by admin
/api/posts
```







