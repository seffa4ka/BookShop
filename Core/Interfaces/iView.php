<?php

namespace App\Core\Interfaces;

/**
 * Интерфейс представления.
 */
interface iView
{
  /**
   * Сеттер.
   *
   * @param string $key
   * @param type $value
   */
  public function __set(string $key, $value);

  /**
   * Геттер.
   *
   * @param string $key
   * @return mixed
   */
  public function __get(string $key);

  /**
   * Вывод.
   *
   * @param string $template
   * @return boolean
   */
  public function display(string $template): bool;
}
