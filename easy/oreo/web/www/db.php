<?php
$host = "localhost";
$user = "ctf";
$pass = "Jie2Roh8ohre3Ahn";
$db   = "ctf";

// Create connection
$connect = @mysql_connect($host, $user, $pass);
@mysql_select_db($db) or die("unable to find db.. I am broken.");

if( $connect === FALSE ) {
  die('Cannot connect to db, I am broken.');
}
?>
