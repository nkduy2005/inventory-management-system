## Inventory Management System (Laravel API)
## Overview
- Inventory Management System is a warehouse management system designed for small stores. It helps manage stock levels efficiently and ensures data integrity when handling multiple concurrent requests.
## Features
-Admin
Manage employees: View employee list, Create new employee, Delete employee (if the employee has no related transactions), View employee details
Manage products: Create product, View product details, Update product, Delete product
View current inventory stock
View transaction history
-Staff
Import stock
Export stock
View current inventory stock
## Tech stack
-Laravel 12
-MYSQL
-Laravel Sanctum
-Scramble (API Documentation)
## Installation
- Download zip or clone project
- composer install
- copy .env.example .env
- php artisan key:generate
- php artisan migrate
- php artisan db:seed
- php artisan serve
- Access http://localhost:8000/docs/api

