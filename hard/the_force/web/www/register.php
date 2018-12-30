<?php
require_once "db.php";
$error = "";
if (isset($_POST['username']) && isset($_POST['password'])) {

  $username = $_POST['username'];
  $password = $_POST['password'];

  $filter = ['username' => $username];


  $query = new MongoDB\Driver\Query($filter);
  $find = $db->executeQuery('the_force.users', $query)->toArray();

  if (trim($username) == "") {
    $error = "Username can not be blank";
  }
  else if (count($find) >= 1) {
    $error = "Username already exists";
  }
  else {
      $bulk = new MongoDB\Driver\BulkWrite();
      $bulk->insert(
        ['username' => $username, 'password' => $password, 'admin' => 0]
      );
      $writeConcern = new MongoDB\Driver\WriteConcern(MongoDB\Driver\WriteConcern::MAJORITY, 100);
      $result = $db->executeBulkWrite('the_force.users', $bulk, $writeConcern);

      echo 'Hooray, you have an account. <a href="login.php">Login</a>';
      die();
  }
}
?>
<h1>Register</h1>
<form action="" method="post">
  <?php if ($error !== ''): ?>
    <div><?= $error; ?></div>
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
