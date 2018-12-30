<?php
require_once 'main.php';

echo "<h1>The Force</h1><h3>This is not the lamp you're looking for..</h3>";

if (isAuthed()) {
  echo 'Hello Agent ' . $userData->username . '</br >';
  echo '<small>' . ((isset($userData->admin) && $userData->admin == 1) ? 'Administrator' : 'Member') . '</small>';
  echo '<li><a href="settings.php">Settings</a></li>';
  echo '<li><a href="resume.php">Resume uploader</a></li>';
  if (isAdmin()) {
    echo '<li><a href="ping.php">Ping</a></li>';
  }
  echo '<li><a href="logout.php">Logout</a></li>';
}
else {
  echo '<a href="login.php">Login</a> or <a href="register.php">Register</a>';
}
?>
