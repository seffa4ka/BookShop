<?php

namespace App\Controllers;

use App\Core\Controller;

/**
 * Контроллер каталога.
 */
class CatalogController extends Controller
{
  /**
   * Корень каталога.
   */
  public function actionIndex()
  {
    //TODO
    return $this->render('index');
  }

  /**
   * Дугое.
   */
  public function actionOther()
  {
    //TODO
    return $this->render('index');
  }
}
