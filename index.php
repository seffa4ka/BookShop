<?php
//Показать ошибки.
ini_set('display_errors','On');

/**
 * Корневая директория проекта.
 */
define('ROOT', __DIR__);

require_once ROOT . '/Core/function.php';
require_once ROOT . '/vendor/autoload.php';

use App\Core\Router;

session_start();

try {
  if (!Router::runOnPath()) {
    //TODO
    header("HTTP/1.0 404 Not Found");
    $response = 'Page not found.';
    debug($response);
  }
} catch (Exception $ex) {
  //TODO
  debug($ex);
}
