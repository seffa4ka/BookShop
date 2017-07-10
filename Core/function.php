<?php

/**
 * Автозагрузка.
 */
spl_autoload_register(
    function ($class)
    {
      $classParts = explode('\\', $class);
      $classParts[0] = ROOT;
      $path = implode(DIRECTORY_SEPARATOR, $classParts) . '.php';
      if (file_exists($path)) {
        require $path;
      }
    }
);

/**
 * Функция для вывода удобочитаемой информации о переменной.
 */
function debug($data)
{
  echo '<pre>';
  print_r($data);
  echo '</pre>';
}
