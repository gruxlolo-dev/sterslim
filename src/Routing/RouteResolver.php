<?php

namespace App\Routing;

use App\Attributes\Route;
use Slim\App;
use ReflectionClass;

class RouteResolver
{
    public static function resolve(App $app, string $basePath): void
    {
        $paths = [
            $basePath . '/Controllers',
            $basePath . '/Routes'
        ];

        foreach ($paths as $path) {
            if (!is_dir($path)) continue;

            $iterator = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($path));
            $files = new \RegexIterator($iterator, '/\.php$/');

            foreach ($files as $file) {
                $className = self::getClassNameFromFile($file->getPathname());
                if (!$className || !class_exists($className)) continue;

                $reflection = new ReflectionClass($className);
                foreach ($reflection->getMethods() as $method) {
                    foreach ($method->getAttributes(Route::class) as $attribute) {
                        $routeAttr = $attribute->newInstance();
                        $slimRoute = $app->map([$routeAttr->method], $routeAttr->path, [$className, $method->getName()]);
                        
                        if ($routeAttr->name) {
                            $slimRoute->setName($routeAttr->name);
                        }

                        foreach ($routeAttr->middleware as $middleware) {
                            if (class_exists($middleware)) {
                                $slimRoute->add(new $middleware());
                            }
                        }
                    }
                }
            }
        }
    }

    private static function getClassNameFromFile(string $filePath): ?string
    {
        $content = file_get_contents($filePath);
        if (preg_match('/namespace\s+(.+?);/', $content, $namespaceMatches) &&
            preg_match('/class\s+(.+?)\s+/', $content, $classMatches)) {
            return $namespaceMatches[1] . '\\' . $classMatches[1];
        }
        return null;
    }
}
