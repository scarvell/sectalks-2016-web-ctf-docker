<?php
if (!isset($_COOKIE['auth'])) {
  setcookie("auth", sha1("false"));
  header("Location: index.php");
  exit;
}

if ($_COOKIE['auth'] == sha1("true")){
  echo "flag{1981b5f52764f2ff929084319e5677f59312abaa}";
}
else {
  http_response_code(403);
}
?>
