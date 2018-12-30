<?php
require 'main.php';
echo '<a href="ping.txt">this is an open source script</a>';
if (!isset($_GET['ip'])) {
  die('usage: /ping.php?ip=&lt;ip&gt;');
}

if ($_SERVER['REMOTE_ADDR'] !== "127.0.0.1") {
  die("hey! You're not 127.0.0.1! Go away hacker.");
}

$ip = $_GET['ip'];
if (!preg_match("/^\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}$/m", $ip)){
  die ("bad");
}
system('ping -c 1 ' . $ip);
?>
