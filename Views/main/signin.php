<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Sign In</title>
</head>
<body>
  <?php
    if (isset($error)) {
      echo $error . '<br>';
    }
  ?>
  <form role="form" action="" method="POST">
    <div>
      <label for="inputUsername">Username</label>
      <input required type="text" id="inputUsername" placeholder="Enter Username" name="username">
    </div>
    <div>
      <label for="inputPassword">Password</label>
      <input required type="password" id="inputPassword" placeholder="Enter Password" name="password">
    </div>
    <button type="submit">Sign in</button>
  </form>
</body>
</html>
