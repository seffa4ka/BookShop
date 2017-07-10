<?php

namespace App\Core;

use App\Core\Exeption\RouterExeption;

/**
 * Роутер.
 */
class Router
{
  /**
   * Маршруты.
   *
   * @var array
   */
  private static $routes;

  /**
   * Пройти по пути.
   *
   * @return mixed
   */
  public static function runOnPath()
  {
    $path = self::getPath();
    self::loadRoutes();

    if (isset(self::$routes)) {
      foreach (self::$routes as $loadPattern => $loadPath) {
        //TODO
        if (preg_match("~^$loadPattern$~", $path)) {
          $internalPath = preg_replace("~^$loadPattern$~", $loadPath, $path);
          $internalPathParts = explode('/', $internalPath);
          $controllerName = 'App\\Controllers\\' . ucfirst(array_shift($internalPathParts)) . 'Controller';
          $actionName = 'action' . ucfirst(array_shift($internalPathParts));
          return self::createObjectController($controllerName, $actionName, $internalPathParts);
        }
      }
    } else {
      throw new RouterExeption('Rules not found!');
    }
  }

  /**
   * Загрузить маршруты.
   */
  private static function loadRoutes()
  {
    $pathToFile = ROOT . '/config/routes.php';

    if (file_exists($pathToFile)) {
      $attachedFile = require_once $pathToFile;
      if (is_array($attachedFile)) {
        self::$routes = $attachedFile;
      } else {
        self::$routes = NULL;
      }
    } else {
      throw new RouterExeption('File not exist!');
    }
  }

  /**
   * Получить путь.
   *
   * @return string
   */
  private static function getPath(): string
  {
    $uri = $_SERVER['REQUEST_URI'];

    if (!empty($uri)) {
      return trim(parse_url($uri, PHP_URL_PATH), '/');
    }
  }

  /**
   * Создать объект;
   *
   * @param string $controllerName
   *   Имя контроллера.
   * @param string $actionName
   *   Имя действия.
   * @param array $attributes
   *   Атрибуты.
   */
  private static function createObjectController(string $controllerName, string $actionName, array $attributes)
  {
    if (class_exists($controllerName)) {
      $controller = new $controllerName();
      if (method_exists($controller, $actionName)) {
        return call_user_func_array(array($controller, $actionName), $attributes);
      } else {
        throw new RouterExeption('Method not found.');
      }
    } else {
      throw new RouterExeption('Class not found.');
    }
  }
}
