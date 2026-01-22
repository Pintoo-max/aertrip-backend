1. Project Overview
Employee & Department Management REST API built using Laravel 12.

--------------------------------
2. Tech Stack

PHP 8.2.12
Laravel 12
MySQL
PHPUnit

--------------------------------
3. Setup Instructions

git clone https://github.com/Pintoo-max/aertrip-backend.git
cd aertrip
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan db:seed ( department entry by factory )
php artisan serve

--------------------------------
4. Database Design (Explain relations)

Department → hasMany Employees

Employee → belongsTo Department

Employee → hasMany Contacts

Employee → hasMany Addresses

--------------------------------
5. API Documentation Link

Postman collection path

aertrip\docs\postman

6. Testing
php artisan test