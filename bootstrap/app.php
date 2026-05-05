<?php

use Slim\Factory\AppFactory;
use Illuminate\Database\Capsule\Manager as Capsule;
use App\Routing\RouteResolver;
use Dotenv\Dotenv;

require __DIR__ . '/../vendor/autoload.php';

// Load Environment
if (file_exists(__DIR__ . '/../.env')) {
    $dotenv = Dotenv::createImmutable(__DIR__ . '/..');
    $dotenv->load();
}

// Database Configuration
$capsule = new Capsule;
$dbType = $_ENV['DB_TYPE'] ?? 'mysql';

$config = [
    'driver'    => $dbType,
    'host'      => $_ENV['DB_HOST'] ?? 'localhost',
    'database'  => $_ENV['DB_NAME'] ?? 'app',
    'username'  => $_ENV['DB_USER'] ?? 'user',
    'password'  => $_ENV['DB_PASS'] ?? 'secret',
    'charset'   => 'utf8',
    'collation' => 'utf8_unicode_ci',
    'prefix'    => '',
];

if ($dbType === 'mongodb') {
    // MongoDB configuration for Eloquent (requires mongodb/laravel-mongodb or manual setup)
    // For now, we provide the basic config structure
    $config['driver'] = 'mongodb';
}

$capsule->addConnection($config);
$capsule->setAsGlobal();
$capsule->bootEloquent();

$app = AppFactory::create();

// Register Attribute-based Routes
RouteResolver::resolve($app, __DIR__ . '/../src/Controllers');

// Fallback to manual routes if needed
if (file_exists(__DIR__ . '/../routes/web.php')) {
    (require __DIR__ . '/../routes/web.php')($app);
}

return $app;
