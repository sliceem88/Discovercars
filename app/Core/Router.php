<?php

namespace App\Core;

use App\Controllers\Home;

class Router
{
    const CLASS_NAME = 1;
    const CLASS_METHOD = 2;

    /**
     * Trigger class and method based on URI
     *
     * @return void
     */
    public static function run()
    {
        $uri = explode('/', $_SERVER['REQUEST_URI']);
        $class = $uri[self::CLASS_NAME];
        $method = $uri[self::CLASS_METHOD] ?? '';
        $pathToClass = __DIR__ . "/../Controllers/$class" . '.php';

        if (file_exists($pathToClass)) {
            $className = "App\Controllers\\$class";
            $classInstance = new $className;

            if (method_exists($classInstance, $method)) {
                $classInstance->$method();
            } else {
                $classInstance->index();
            }
        } else {
            // Default Controller
            $classInstance = new Home;
            $classInstance->index();
        }
    }
}
