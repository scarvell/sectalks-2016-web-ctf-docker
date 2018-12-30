<?php
@session_start();
unset($_SESSION['userId']);
header("Location: index.php");
