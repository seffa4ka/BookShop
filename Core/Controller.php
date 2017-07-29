<?php

namespace App\Core;

use App\Core\View;
use App\Core\SendEmail;
use Twig_Loader_Filesystem;
use Twig_Environment;

/**
 * Котнороллер.
 */
abstract class Controller
{
  /**
   * Имя дочернего класса.
   *
   * @var string 
   */
  protected $className;

  /**
   * Конструктор.
   */
  public function __construct()
  {
    $this->className = get_called_class();
  }

  /**
   * Получить страницу.
   *
   * @param string $fileName
   *  Имя файла.
   * @param array $params
   *  Параметры.
   * @return bool
   */
  protected function render(string $fileName, array $params = []): bool
  {
    $view = new View();
    foreach ($params as $param => $valu) {
      $view->$param = $valu;
    }

    $folder = mb_strtolower($this->className[16]) . substr($this->className, 17, -10);

    return $view->display($folder . '/' . $fileName . '.php');
  }

  /**
   * Редирект.
   *
   * @param string $path
   *  Путь.
   */
  protected function redirect(string $path)
  {
    header("Location: $path",TRUE,301);
    exit;
  }
  
  /**
   * Отображение страницы с помощью twig.
   *
   * @param string $fileName
   *   Имя файла.
   * @param array $params
   *   Параметры.
   * @return bool
   */
  protected function twig(string $fileName, array $params = []):bool
  {
    $loader = new Twig_Loader_Filesystem(ROOT . '/Views');
    $twig = new Twig_Environment($loader);
    $folder = mb_strtolower($this->className[16]) . substr($this->className, 17, -10);
    $template = $twig->loadTemplate($folder . '/' . $fileName . '.html.twig');
    echo $template->render($params);
    return TRUE;
  }

  /**
   * Отправить email.
   *
   * @param type $to
   * @param type $title
   * @param type $msg
   * @return boolean
   */
  protected function sendEmail($to, $title, $msg)
  {
    $email = new SendEmail();
    return $email->send($to, $title, $msg);
  }
}
