<?php

echo 'Index page.';

if (isset($_SESSION['auth'])) {
  echo ' User: ' . $_SESSION['auth'] . '.';
}
