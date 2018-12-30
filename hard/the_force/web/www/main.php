<?php
@session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once 'db.php';

// Setup script to make sure we have data. There's probably a better way
// to do this in docker, but my docker-fu aint dat gud.
$filter = array();

$query = new MongoDB\Driver\Query($filter);
$find = $db->executeQuery('the_force.users', $query)->toArray();

// make sure this check is not occuring on CLI
if (count($find) == 0 && php_sapi_name() !== 'cli') {
  system("php setup.php > /dev/null");
}

$userData = ["admin" => "0"];

function isAuthed() {
  return (isset($_SESSION['userId']) ? true : false);
}


function requireAuth($redirect = true) {
  if (!isAuthed()) {
    if ($redirect) {
      header("Location: login.php");
    }
    else {
      die("<h3>You must be logged in to view this page</h3>");
    }
  }
  else {
    return;
  }
}

function isAdmin() {
  global $userData;
  if (!isAuthed()) return false;
  if (isset($userData->admin) && $userData->admin == 1) return true;
  return false;
}

if(isAuthed()) {
    $filter = array(
      '_id' => $_SESSION['userId']
    );

    $query = new MongoDB\Driver\Query($filter);
    $find = $db->executeQuery('the_force.users', $query)->toArray();
    if (count($find) == 0) {
        header("Location: logout.php");
        exit;
    }
    $userData = $find[0];

}

function h($str) {
  return htmlentities($str, ENT_QUOTES);
}

function showFlag() {
  echo "flag{22802bc148648e3185b409d1cd8a33fafa2ab786}";
}
