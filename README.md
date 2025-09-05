# Project Setup & Usage Guide

## 1. Prerequisites

- **PHP 8.3+**
- **Composer 2.2+**
- **Docker** (for PostgreSQL & pgAdmin)
- **Node.js 18+ & npm** (if using Vite for assets)

---

## 2. Installation

Clone the repository and install dependencies:

```bash
git clone <repo-url>
cd <repo-folder>
composer install
```

Copy the example environment file and generate an application key:

```bash
cp .env.example .env
php artisan key:generate
```

Update your `.env` file with the following database settings:

```dotenv
DB_CONNECTION=pgsql
DB_HOST=postgres
DB_PORT=5432
DB_DATABASE=gamesnest
DB_USERNAME=postgres
DB_PASSWORD=pg!password
```

---

## 3. Start the Database

From the project root, launch the database containers:

```bash
docker compose up -d
```

Access pgAdmin at [http://localhost:4321](http://localhost:4321):

- **Host:** `postgres`
- **User:** `postgres`
- **Password:** `pg!password`

---

## 4. Seed the Database

Run the database seeder:

```bash
php artisan db:seed
```

_Default login:_  
**Email:** `admin@example.com`  
**Password:** `1234`

---

## 5. Run the Application

Start the Laravel development server:

```bash
php artisan serve
```

The app will be available at:  
👉 [http://localhost:8000](http://localhost:8000)

_Stop the server anytime with `Ctrl+C`._

---

## 6. Useful Commands

```bash
docker compose down       # Stop database containers
php artisan cache:clear   # Clear Laravel cache
php artisan route:clear   # Clear route cache
php artisan config:clear  # Clear config cache
```
