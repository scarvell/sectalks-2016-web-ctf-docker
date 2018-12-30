<?php
require_once 'core.php';
unset($_SESSION['uid']);
@session_regenerate_id();
header("Location: index.php");
?>
