<?php
//Показать ошибки.
ini_set('display_errors','On');

/**
 * Корневая директория проекта.
 */
define('ROOT', __DIR__);

require_once ROOT . '/vendor/autoload.php';
require_once ROOT . '/Core/function.php';

use App\Core\Router;

session_start();

try {
  if (!Router::runOnPath()) {
    //TODO
    header("HTTP/1.0 404 Not Found");
    die('Page not found.');
  }
} catch (Exception $ex) {
  //TODO
  debug($ex);
}
