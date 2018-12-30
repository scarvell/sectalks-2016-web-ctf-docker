<?php
require_once 'core.php';

$badLogin = false;

if (isset($_POST['username']) && isset($_POST['username'])) {

    $username = @mysql_real_escape_string($_POST['username']);
    $password = hash('sha256', $_POST['password']);

    $results = @mysql_query("SELECT user_id FROM xss_users WHERE username = '$username' AND password = '$password'") or die(mysql_error());

    if (@mysql_num_rows($results) == 0) {
      $badLogin = true;
    }
    else {
      $user = @mysql_fetch_assoc($results);
      $_SESSION['uid'] = $user['user_id'];
      header("Location: index.php");
      exit;
    }
}
?>
<h1>Login</h1>
<form action="" method="post">
  <?php
  if ($badLogin):
    echo '<h3>Incorrect username and/or password</h3>';
  endif;
  ?>
  <p>
    username:<br />
    <input type="text" name="username" />
  </p>
  <p>
    password:
    <br />
    <input type="password" name="password" />
  </p>
  <p>
    <input type="submit" value="Login">
  </p>
</form>
