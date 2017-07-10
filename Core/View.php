<?php

namespace App\Core;

use App\Core\Interfaces\iView;
use App\Core\Exeption\ViewExeption;

/**
 * Представление.
 */
class View implements iView
{
  /**
   * Массив передаваемых параметров.
   *
   * @var array
   */
  protected $data = [];

  /**
   * Сеттер.
   *
   * @param string $key
   * @param mixed $value
   */
  public function __set(string $key, $value)
  {
    $this->data[$key] = $value;
  }

  /**
   * Геттер.
   *
   * @param string $key
   * @return mixed
   */
  public function __get(string $key)
  {
    return $this->data[$key];
  }

  /**
   * Загружает страницу в буфер и возвращает его.
   *
   * @param string $template
   * @return mixed
   */
  private function render(string $template)
  {
    $pathToFile = ROOT . '/Views/' . $template;

    foreach ($this->data as $key => $value) {
      $$key = $value;
    }

    if (file_exists($pathToFile)) {
      ob_start();
      include $pathToFile;
      $contents = ob_get_contents();
      ob_end_clean();
    } else {
      throw new ViewExeption('Template not found.');
    }

    return $contents;
  }

  /**
   * Вывод.
   *
   * @param string $template
   * @return boolean
   */
  public function display(string $template): bool
  {
    echo $this->render($template);
    return TRUE;
  }
}
