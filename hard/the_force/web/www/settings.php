<?php
require_once 'main.php';
$error = $success = "";

$bulk = new MongoDB\Driver\BulkWrite();
$writeConcern = new MongoDB\Driver\WriteConcern(MongoDB\Driver\WriteConcern::MAJORITY, 100);

if (isset($_GET['pwd']) && isset($_POST['user']['password'])) {

  $password = $_POST['user']['password'];
  $password2 = $_POST['user']['confirmPass'];

  if (trim($password) == '') {
    $error = 'Your password can not be blank';
  }
  else if ($password !== $password2) {
    $error = "Your passwords don't match";
  }
  else {
    $bulk->update(['_id' => $userData->_id], ['$set' => ['password' => $password]], ['multi' => false, 'upsert' => false]);
    $db->executeBulkWrite('the_force.users', $bulk, $writeConcern);

    $success = "Your password has been changed.";
  }
}
else if (isset($_GET['settings']) && isset($_POST['user']['firstName']) && isset($_POST['user']['lastName'])) {
  $bulk->update(['_id' => $userData->_id], ['$set' => ['firstName' => $_POST['user']['firstName'], 'lastName' => $_POST['user']['lastName']]], ['multi' => false, 'upsert' => false]);
  $db->executeBulkWrite('the_force.users', $bulk, $writeConcern);
  $success = "Your settings have been updated";
}
?>
<h1>Settings</h1>
  <?php if ($error !== ''): ?>
    <?= $error; ?>
  <?php
  endif;
  if ($success !== ''):
  ?>
  <?= $success; ?>
<?php endif; ?>
<form action="?pwd" method="post">
  <fieldset>
    Password: <input type="password" name="user[password]" value="" />
  </fieldset>
  <fieldset>
    Confirm Password: <input type="password" name="user[confirmPass]" value="" />
  </fieldset>
  <fieldset>
    <button type="submit">Update</button>
  </fieldset>
</form>
<form action="?settings" method="post">
  <fieldset>
    Username: <?= h($userData->username); ?>
  </fieldset>
  <fieldset>
    First Name: <input type="text" name="user[firstName]" value="<?= h((isset($userData->firstName) ? $userData->firstName :  ''));?>" />
  </fieldset>
  <fieldset>
    Last Name: <input type="text" name="user[lastName]" value="<?= h((isset($userData->lastName) ? $userData->lastName :  ''));?>" />
  </fieldset>
  <fieldset>
    <button type="submit">Update</button>
  </fieldset>
</form>
<a href="index.php">back</a>
