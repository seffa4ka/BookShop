<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Send email</title>
</head>
<body>
  <?php
    if (isset($success)) {
      if($success) {
        echo 'message sent';
      } else {
        echo 'error';
      }
    }
  ?>
  <form role="form" action="" method="POST">
    <div>
      <label for="inputTo">To</label>
      <input required type="text" id="inputTo" placeholder="Enter Email" name="to">
    </div>
    <div>
      <label for="inputTitle">Title</label>
      <input required type="text" id="inputTitle" placeholder="Enter Title" name="title">
    </div>
    <div>
      <textarea rows="10" cols="45" placeholder="Enter Message" name="msg"></textarea>
    </div>
    <button type="submit">Send</button>
  </form>
</body>
</html>
