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

$query = "SELECT ticket_id FROM xss_tickets WHERE status = 'Unread'";

$results = @mysql_query($query) or die(@mysql_error());

if (@mysql_num_rows($results) >= 1) {
  while ($ticket = @mysql_fetch_assoc($results)) {
    system("/root/phantomjs /root/xss-auditor.js " . escapeshellarg($ticket['ticket_id']));
  }
}
?>
