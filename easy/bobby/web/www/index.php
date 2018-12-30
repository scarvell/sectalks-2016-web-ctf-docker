<?php
error_reporting(0);
ini_set('display_errors', 0);

if (isset($_POST['username']) && isset($_POST['username'])) {
  $connect = mysql_connect('localhost','ctf','Jie2Roh8ohre3Ahn');
  mysql_select_db("ctf") or die("unable to find db.. I am broken.");

  if( $connect === FALSE ) {
    die('Cannot connect to db, I am broken.');
  }
  $username = $_POST['username'];
  $password = $_POST['password'];

  $query = "SELECT username FROM users WHERE username='$username' AND password = '$password'";
  $result = @mysql_query($query) or die(mysql_error());

  if( mysql_num_rows($result) === 0 ) {
    echo 'Bad login';
  }
  else {
    die('flag{9b305a0d8f1b11920e2f1807e9713e595841b35e}');
  }
}
?>
<h1>Login</h1>
<form action="" method="post">
  <input type="text" name="username" placeholder="username" />
  <input type="password" name="password" placeholder="password"/>
  <button type="submit">Login</button>
</form>
