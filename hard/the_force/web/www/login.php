<?php
require_once 'main.php';

$error = "";

if (isset($_POST['username']) && isset($_POST['password'])) {
  $username = $_POST['username'];
  $password = $_POST['password'];


  $filter = array(
      '$and' => array(
          ['username' => $username],
          ['password' => $password]
      )
  );

  $query = new MongoDB\Driver\Query($filter);
  $find = $db->executeQuery('the_force.users', $query)->toArray();

  if (count($find) == 0) {
    $error = "Incorrect username or password";
  }
  else {
    $_SESSION['userId'] = $find[0]->_id;
    header("Location: index.php");
  }
}
?>
<h1>Login</h1>
<form action="login.php" method="post">
  <?php if ($error !== ''): ?>
    <?= $error; ?>
  <?php endif; ?>
  <fieldset>
    Username: <input type="text" name="username" value="" />
  </fieldset>
  <fieldset>
    Password: <input type="password" name="password" value="" />
  </fieldset>
  <fieldset>
    <input type="submit" />
  </fieldset>
</form>
