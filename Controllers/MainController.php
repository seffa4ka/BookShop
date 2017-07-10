<?php

namespace App\Controllers;

use App\Core\Controller;

/**
 * Главный контроллер.
 */
class MainController extends Controller
{
  /**
   * Главная страница.
   *
   * @return boolean
   */
  public function actionIndex()
  {
    //TODO
    return $this->render('index');
  }

  /**
   * Вход.
   */
  public function actionSignin()
  {
    if (isset($_SESSION['auth'])) {
      $this->redirect('/');
    } else {
      //TODO
      if ($_POST) {
        if (isset($_POST['username']) && isset($_POST['password'])) {
          return $this->render('signin', $this->authentication($_POST['username'], $_POST['password']));
        } else {
          return $this->render('signin', [
              'error' => 'Invalid data.',
          ]);
        }
      } else {
        return $this->render('signin');
      }
    }
  }

  /**
   * Аутентификация.
   *
   * @param string $username
   *  Логин.
   * @param string $password
   *  Пароль.
   * @return array
   */
  private function authentication(string $username, string $password): array
  {
    //for the test
    $user = [
        'username' => 'administrator',
        'password' => 'root',
    ];
    if ($username == $user['username'] && $password == $user['password']) {
      $_SESSION['auth'] = $username;
      $this->redirect('/');
    } else {
      return [
          'error' => 'Invalid data. Try again.',
      ];
    }
  }

  /**
   * Выход.
   */
  public function actionSignout()
  {
    unset($_SESSION['auth']);
    $this->redirect('/');
  }
}
