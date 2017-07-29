<?php

namespace App\Core;

use App\Core\Exeption\SendEmailExeption;
use Swift_SmtpTransport;
use Swift_Mailer;
use Swift_Message;
use Swift_RfcComplianceException;

/**
 * Отправка email.
 */
class SendEmail
{
  private $smtpTransport;
  private $smtpPort;
  private $username;
  private $password;
  private $alias;

  /**
   * Конструктор.
   */
  public function __construct() {
    $config = $this->loadConfig();
    $this->smtpTransport = $config['smtpTransport'];
    $this->smtpPort = $config['smtpPort'];
    $this->username = $config['username'];
    $this->password = $config['password'];
    $this->alias = $config['alias'];
  }

  /**
   * Загрузить конфигурации.
   *
   * @return mixed
   * @throws SendEmailException
   */
  private static function loadConfig()
  {
    $pathToFile = ROOT . '/config/email.php';

    if (file_exists($pathToFile)) {
      $attachedFile = require_once $pathToFile;
      if (is_array($attachedFile)) {
        if (
              !empty($attachedFile['smtpTransport']) &&
              !empty($attachedFile['smtpPort']) &&
              !empty($attachedFile['username']) &&
              !empty($attachedFile['password']) &&
              !empty($attachedFile['alias'])
            )
        {
          return $attachedFile;
        } else {
          throw new SendEmailExeption('Bed config.');
        }
      }
    } else {
      throw new SendEmailExeption('File not exist.');
    }
  }

  /**
   * Отправить.
   *
   * @param string $to
   * @param string $title
   * @param string $msg
   * @return int
   */
  public function send(string $to, string $title, string $msg)
  {
    try {
      $transport = (new Swift_SmtpTransport($this->smtpTransport, $this->smtpPort))
        ->setUsername($this->username)
        ->setPassword($this->password)
      ;

      $mailer = new Swift_Mailer($transport);
      
      $message = (new Swift_Message($title))
        ->setFrom([$this->username => $this->alias])
        ->setTo([$to])
        ->setBody($msg)
      ;
      
      if ($mailer->send($message)) {
        return TRUE;
      }
    } catch (Swift_RfcComplianceException $ex) {
      //throw new SendEmailExeption($ex->getMessage());
    }

    return FALSE;
  }
}
