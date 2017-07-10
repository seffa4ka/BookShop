<?php

namespace App\Controllers;

use App\Core\Controller;

/**
 * Контроллер книги.
 */
class BookController extends Controller
{
  /**
   * Показать книгу.
   *
   * @param int $number
   * @return boolean
   */
  public function actionView(int $number)
  {
    //TODO
    return $this->render('info', [
        'number' => $number,
    ]);
  }
}
