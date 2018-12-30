<?php
require_once 'core.php';

$errors = array();

$username = ""; // To display for form input

if (isset($_POST['username']) && isset($_POST['password'])) {
  $username = @mysql_real_escape_string($_POST['username']);
  $password = $_POST['password'];

  if ($password == '') array_push($errors, 'Your password can not be blank');
  if (trim($username) == '') array_push($errors, 'Username can not be empty');

  $result = @mysql_query("SELECT user_id FROM xss_users WHERE username = '$username'") or die(@mysql_error());
  if (@mysql_num_rows($result) >= 1) array_push($errors, 'Username is already in use');

  if (count($errors) == 0) {
    @mysql_query("INSERT INTO xss_users (username, password) VALUES ('$username', '" . hash('sha256', $password) . "')") or die(mysql_error());
    echo "<h3>Account created</h3>";
    echo "<a href=\"login.php\">Login here!</a>";
    die();
  }
}
?>
<h1>Create an Account</h1>
<form action="" method="post">
  <?php
    if (count($errors) > 0) {
      foreach ($errors as $error) {
        echo "<li>$error</li>";
      }
    }
  ?>
  <p>
    username:<br />
    <input type="text" name="username" value="<?= $username; ?>" placeholder=""/>
  </p>
  <p>
    password:<br />
    <input type="password" name="password" placeholder="" />
  </p>
  <p>
    <input type="submit" value="create account" /> or <a href="login.php">login</a>
  </p>
</form>
