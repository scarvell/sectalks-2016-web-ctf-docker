<?php
ob_start();
include 'header.php';

if (!isset($_GET['p'])) {
  header("Location: ?p=home");
}
else {
  $f = @include_once($_GET['p'].'.php');
}
include 'footer.php';
?>
