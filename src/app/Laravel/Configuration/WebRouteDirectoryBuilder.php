<?php

declare(strict_types=1);

namespace App\Laravel\Configuration;

final class WebRouteDirectoryBuilder
{
    private function __construct()
    {
    }

    public static function build(string $dir): array
    {
        $paths = self::buildDirectory($dir);
        return self::findRouteFile($paths);
    }

    private static function buildDirectory($dir): array
    {
        $result = [];
        $appRoot = scandir($dir);
        foreach ($appRoot as $item) {
            if ($item === '.' || $item === '..') {
                continue;
            }
            $preResult = $dir .$item . '/Infrastructure/Laravel/Route/';
            if (!is_dir($preResult)) {
                continue;
            }
            $result[] = $preResult;
        }
        return $result;
    }

    private static function findRouteFile(array $routes): array
    {
        foreach ($routes as $key => $route) {
            $appRoot = scandir($route);
            foreach ($appRoot as $item) {
                if ($item === '.' || $item === '..' || strtolower(substr($item, -4)) !== '.php') {
                    continue;
                }
                $routes[$key] .= $item;
            }
        }
        return $routes;
    }
}
