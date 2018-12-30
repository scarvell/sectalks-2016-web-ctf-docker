<?php
$flag = "flag{ef9f6b80fd6bad2f152c03d91f588a8ae8670e68}";

$username = "admin";
$password = "fgj21348&^Yrkj12hsfdkjh";

if (isset($_POST['username']) && isset($_POST['password'])) {
  if (strcmp($username, $_POST['username']) == 0 && strcmp($password, $_POST['password']) == 0) {
	echo $flag;
  }
  else {
	echo "bad login";
  }
}
?>
<form action="" method="post">
  <p>
	<input type="text" name="username" placeholder="username" />
  </p>
  <p>
	<input type="password" name="password" placeholder="password" />
  </p>
  <p>
     <input type="submit" name="login" value="Login" />
  </p>
  <a href="index.txt">source</a>
</form>
