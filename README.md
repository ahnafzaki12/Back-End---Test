# 📗 README – TUGAS 2 (Backend – API Version)

```markdown
# Backend Technical Test – API Implementation  
Fullstack Developer Intern Test  
PT Aksamedia Mulia Digital  

## 👨‍💻 Author
Muhammad Ahnaf Zaki  

---

## 🧩 Tech Stack

- Laravel
- MySQL
- RESTful API
- Eloquent ORM
- Railway (Deployment)

---

## 🎯 Overview

Project ini merupakan implementasi Tugas 2 (Backend Only):

- API Login
- API Divisions
- API Employees (CRUD)
- API Logout
- Filtering & Pagination
- Request Validation
- Database Seeder

Semua endpoint mengikuti format response yang ditentukan dalam soal.

---

## 🔐 Authentication

### POST /login
Menghasilkan token autentikasi.

### POST /logout
Menghapus sesi autentikasi.

Endpoint selain login memerlukan autentikasi.

---

## 📊 API Endpoints

### 🔹 GET /divisions
- Filter by name
- Pagination
- Seeder dummy data

### 🔹 GET /employees
- Filter by name
- Filter by division
- Pagination

### 🔹 POST /employees
- Create new employee

### 🔹 PUT /employees/{uuid}
- Update employee

### 🔹 DELETE /employees/{uuid}
- Delete employee

---

## 📦 Installation

```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
php artisan serve
🌐 Live API
https://back-end-test-production-4bef.up.railway.app/

🧠 Architecture
UUID primary key

Eloquent Relationship (Employee → Division)

Request Validation

Resource formatting

Laravel Pagination
