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
    return $this->twig('index', [
      'title' => 'Book Shop',
      'data' => [
        '0' => [
          'title' => 'first',
          'text' => 'test text',
        ],
        '1' => [
          'title' => 'test',
          'text' => '',
        ],
        '2' => [
          'title' => 'title',
          'text' => 'text',
        ],
      ],
      'age' => date('Y'),
    ]);
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
          header('HTTP/1.0 400 Bad Request');
          die('Bad Request');
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
  
  /**
   * Тест Email.
   */
  public function actionSendEmail()
  {
    if (!isset($_SESSION['auth'])) {
      $this->redirect('/');
    }

    if ($_POST) {
      if (isset($_POST['to']) && isset($_POST['title']) && isset($_POST['msg'])) {
        return $this->render('send-email', ['success' => $this
          ->sendEmail(
            $_POST['to'],
            $_POST['title'],
            $_POST['msg']
        )]);
      } else {
        header('HTTP/1.0 400 Bad Request');
        die('Bad Request');
      }
    } else {
      return $this->render('send-email');
    }
  }
}
