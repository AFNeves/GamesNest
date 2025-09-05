
# GamesNest

> A modern digital game store platform built with Laravel, PostgreSQL, and Vite.

![License](https://img.shields.io/github/license/AFNeves/GamesNest)
![Issues](https://img.shields.io/github/issues/AFNeves/GamesNest)

---

## Table of Contents

- [Features](#features)
- [Tech Stack](#tech-stack)
- [Setup & Usage Guide](#setup--usage-guide)
- [Asset Compilation](#asset-compilation)
- [Contribution](#contribution)
- [Testing](#testing)
- [License](#license)

---

## Features

- User authentication & roles
- Product catalog with categories
- Shopping cart & order management
- Reviews & ratings
- Admin dashboard
- Notifications
- RESTful API
- Responsive UI with Tailwind CSS

---

## Tech Stack

- **Backend:** Laravel (PHP 8.3+)
- **Database:** PostgreSQL (Dockerized)
- **Frontend:** Blade, Tailwind CSS, Vite, JavaScript
- **Other:** Composer, Docker, Node.js

---

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
git clone https://github.com/AFNeves/GamesNest.git
cd GamesNest
composer install
```


Copy the example environment file and generate an application key:

```bash
# If .env.example is missing, copy from a teammate or set up manually
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


---

## 6. Asset Compilation

Install Node dependencies and build assets:

```bash
npm install
npm run dev        # For development (hot reload)
npm run build      # For production build
```

To watch and build Tailwind CSS only:

```bash
npm run tailwind
```

---

## 7. Useful Commands

```bash
docker compose down       # Stop database containers
php artisan cache:clear   # Clear Laravel cache
php artisan route:clear   # Clear route cache
php artisan config:clear  # Clear config cache

---

## 8. Testing

Run all tests:

```bash
php artisan test
# or
./vendor/bin/phpunit
```

---

## 9. Contribution

1. Fork the repository
2. Create a new branch (`git checkout -b feature/your-feature`)
3. Commit your changes
4. Push to your branch and open a Pull Request

---

## License

This project is licensed under the MIT License. See the [LICENSE](LICENSE) file for details.
