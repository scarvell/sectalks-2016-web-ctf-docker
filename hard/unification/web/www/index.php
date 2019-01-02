<?php
require('db.php');

if (isset($_POST['login'])) {

  $username = $_POST['username'];

  $query = "SELECT users.*, MAX(time) AS last_login FROM users LEFT JOIN logins ON logins.user=users.user WHERE users.user = '$username' GROUP BY user, pass, disabled";

  $res = @mysql_query($query) or die();
  if (@mysql_num_rows($res) == 0) {
    echo "<p>Bad login</p>";
  }
  else {
    $user = @mysql_fetch_assoc($res);

    if (md5(md5($_POST['password'])) !== $user['pass']) {
      echo "<p>Incorrect password</p>";
    }

    else if ($user['disabled'] == 1) {
          echo "<p>Account disabled</p>";
    }
    else {
      die("flag{dc9727e48965a4e4003b101857cea81feb673977}");
    }
  }
}

?>
<form action="" method="post">
  <input type="text" name="username" />
  <input type="password" name="password" />
  <input type="submit" name="login" value="login" />
</form>
