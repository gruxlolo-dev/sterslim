# 🚀 Sterslim v1.0.0

**Sterslim** is a high-performance, lightweight PHP Starter Kit built on top of the Slim 4 Framework. It provides a modern, "Laravel-like" developer experience with a fraction of the weight, featuring an interactive CLI, automated Docker environment, and attribute-based routing.

[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)](https://opensource.org/licenses/MIT)
[![PHP Version](https://img.shields.io/badge/php-%5E8.2-blue.svg)](https://php.net)

---

## ✨ Key Features

- **💻 Sterslim CLI**: A powerful command-line tool for scaffolding and project management.
- **🛣️ Attribute Routing**: Define your routes directly in controllers using PHP 8 attributes.
- **🐳 Dockerized**: Production-ready Apache + PHP 8.2 setup with automated `.env` and `docker-compose.yml` generation.
- **🏗️ Smart Scaffolding**: Generate Controllers, Services, and Middlewares with one command.
- **🗄️ Eloquent ORM**: Full support for MySQL, MariaDB, PostgreSQL, and MongoDB.
- **🛡️ Secure by Default**: Hardened Apache configuration protecting your system files and serving only the `public/` directory.

---

## 📦 Installation

Create a new project using Composer:

```bash
composer create-project gruxlolo-dev/sterslim my-app
```

*Note: The interactive installer will start automatically to configure your database and Docker environment.*

---

## 🛠️ The Sterslim CLI

Manage your application with the built-in CLI tool:

| Command | Description |
| :--- | :--- |
| `php sterslim create module [Name]` | Generates Controller, Service, and Middleware. |
| `php sterslim create controller [Name]` | Generates a new API Controller. |
| `php sterslim create service [Name]` | Generates a new Service class. |
| `php sterslim create middleware [Name]` | Generates a new Middleware. |
| `php sterslim list routes` | Lists all discovered routes and endpoints. |
| `php sterslim install` | Re-runs the interactive installer. |

---

## 🚀 Usage Guide

### 1. Defining Routes
Stop hunting through routing files. Define routes directly where they belong:

```php
namespace App\Controllers;

use App\Attributes\Route;
use App\Middlewares\AuthMiddleware;

class UserController {
    #[Route(path: "/api/users", method: "GET", middleware: [AuthMiddleware::class])]
    public function index($request, $response) {
        // Your logic here
        return $response->withHeader('Content-Type', 'application/json');
    }
}
```

### 2. Layered Architecture
Generated modules follow a clean structure:
- **Controllers**: Handle HTTP requests and JSON responses.
- **Services**: Contain business logic and database interactions.
- **Middlewares**: Handle cross-cutting concerns (Auth, Validation, CORS).

### 3. Database & Docker
Start your development environment with a single command:

```bash
docker-compose up -d
```
Access your application at `http://localhost:8080`.

---

## 📂 Project Structure

```text
├── bootstrap/          # App initialization & DB setup
├── config/             # Configuration files
├── installer/          # Interactive setup scripts
├── public/             # Web server root (index.php, .htaccess)
├── src/
│   ├── Attributes/     # Custom PHP Attributes
│   ├── Controllers/    # API Controllers
│   ├── Middlewares/    # Application Middlewares
│   ├── Routing/        # Route Discovery Engine
│   └── Services/       # Business Logic / Services
└── sterslim            # Main CLI Tool
```

---

## 📜 License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

---
Developed with ❤️ by [gruxlolo-dev](https://github.com/gruxlolo-dev)
