# GamesNest

GamesNest is an online marketplace designed for gamers to easily and securely buy digital game keys for platforms like Steam, Epic Games, and Origin. With a clean, user-friendly interface, it simplifies the shopping experience by offering essential features like reviews, personalized recommendations, and secure payments. Tailored for both casual and advanced users, GamesNest prioritizes accessibility and efficiency, making it the go-to platform for hassle-free game purchases.

## Table of Contents

- [Features](#features)
- [Tech Stack](#tech-stack)
- [Setup & Usage Guide](#project-setup--usage-guide)
- [License](#license)

## Features

- User Authentication & Roles
- Product Catalog with Categories
- Shopping Cart & Order Management
- Reviews & Ratings
- Admin Dashboard
- Notifications
- RESTful API
- Responsive UI with Tailwind CSS

## Tech Stack

- **Backend:** Laravel (PHP 8.3+)
- **Database:** PostgreSQL (Dockerized)
- **Frontend:** Blade, Tailwind CSS, Vite, JavaScript
- **Other:** Composer, Docker, Node.js

## Project Setup & Usage Guide

### 1. Prerequisites

In order to run GamesNest locally, ensure you have the following installed:

- **PHP 8.3 or higher**
- **Composer 2.2 or higher**
- **Docker**
- **Node.js 18+ & npm** (required for asset compilation with Vite)

#### Recommended Environment

For the smoothest experience, we recommend using **Ubuntu 24.04 LTS** or newer, which provides up-to-date packages for all dependencies.

#### Installation Instructions

**On Linux:**

Update your package list and install the required tools:
```bash
sudo apt update
sudo apt install git composer php8.3 php8.3-mbstring php8.3-xml php8.3-pgsql php8.3-curl docker.io nodejs npm
```

**On macOS (using [Homebrew](https://brew.sh/)):**
```bash
brew install php@8.3 composer node npm docker
```

**On Windows (using [WSL](https://learn.microsoft.com/en-us/windows/wsl/install)):**

- Install **Ubuntu 24.04** or newer via WSL.
- Follow the Ubuntu installation steps above inside your WSL terminal.

> **Note:** Older Ubuntu versions may not provide the required PHP packages. Always use the latest LTS release for compatibility.

---

### 2. Installation

Clone the repository and install PHP dependencies:

```bash
git clone https://github.com/AFNeves/GamesNest.git
cd GamesNest
composer install
```

Copy the example environment file and generate a new application key:

```bash
cp .env.example .env
php artisan key:generate
```

- Make sure to update your `.env` file with the correct database and mail settings before proceeding.
- If you are running inside Docker, ensure containers are up before running artisan commands.

---
### 3. Start the Database

From the project root, launch the database containers:

```bash
docker compose up -d
```

The application will connect to the PostgreSQL database automatically using the credentials in your `.env` file.

> **Note:**  
> For most workflows, you do not need to interact directly with the database. However, if you want to inspect data, troubleshoot issues, or perform manual queries, you can use **pgAdmin** (included in the Docker setup):
>
>- Access pgAdmin at [http://localhost:4321](http://localhost:4321)
>    - **Host:** `postgres`
>    - **User:** `postgres`
>    - **Password:** `pg!password`

---

### 4. Seed the Database

Populate the database with sample data:

```bash
php artisan db:seed
```

You can now log in using the default administrator credentials below, or refer to the [Wiki PA page](https://github.com/AFNeves/GamesNest/wiki/PA#21-administrator-account) for additional test accounts.

**Default User Login:**
- **Username:** `AppleTree`
- **Password:** `1MoreThing...`

---

### 5. Run the Application

Start the Laravel development server:

```bash
php artisan serve
```

By default, the application will be accessible at:  
[http://localhost:8000](http://localhost:8000)

To stop the server, press `Ctrl+C` in your terminal.

---

## License

This project is licensed under the MIT License. See the [LICENSE](LICENSE) file for details.
