<?php
@session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

$secretAdminCookieVal = '7mjhjeu6d9dqtqg5m6pf6c24a1';

require_once 'db.php';

function isAuthed() {
  global $secretAdminCookieVal;
  if (!isset($_COOKIE['PHPSESSID'])) return false;
  return (isset($_SESSION['uid']) || $_COOKIE['PHPSESSID'] == $secretAdminCookieVal) ? true : false;
}

$isAdmin = (isset($_COOKIE['PHPSESSID']) && $_COOKIE['PHPSESSID'] == $secretAdminCookieVal) ? true : false;

if (!isAuthed()) {
  $userData = array("username" => "Guest");
}
else {
  if ($isAdmin) $_SESSION['uid'] = 1;
  $results = @mysql_query("SELECT user_id, username FROM xss_users WHERE user_id = '" . (int) $_SESSION['uid'] ."'") or die(mysql_error());
  $userData = @mysql_fetch_assoc($results);
}
 ?>
