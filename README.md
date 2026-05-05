# 🚀 sterslim v1.1.0

Advanced Lightweight PHP Starter Kit with Docker, Apache, and Attribute-based Routing.

---

## 📦 Install

```bash
composer create-project gruxlolo-dev/sterslim my-app
```

The interactive installer will automatically start and guide you through the configuration.

---

## ⚙️ Features

- **Apache + PHP 8.2**: Optimized Docker setup.
- **Interactive Installer**: Auto-generates `.env` and `docker-compose.yml`.
- **Database Support**: MySQL, MariaDB, PostgreSQL, MongoDB.
- **Attribute-based Routing**: Modern routing using PHP 8 attributes.
- **Eloquent ORM**: Integrated via `illuminate/database`.
- **Secure**: Apache is configured to serve only the `public/` directory.

---

## 🛠️ Usage

### Creating Routes
Simply create a controller in `src/Controllers/` and use the `#[Route]` attribute:

```php
namespace App\Controllers;

use App\Attributes\Route;
use Psr\Http\Message\ResponseInterface as Response;

class ExampleController {
    #[Route(path: "/example", method: "GET")]
    public function index($request, $response) {
        $response->getBody()->write("It works!");
        return $response;
    }
}
```

### Starting Docker
```bash
docker-compose up -d
```
Your app will be available at `http://localhost:8080`.

---

## 📜 License
MIT
