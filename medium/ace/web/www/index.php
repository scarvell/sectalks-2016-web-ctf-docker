<?php
// Thanks to bitcoinctf for donation of challenge
?><!doctype html>
<body>
<form method="get" action="">
Injection: <input type="text" name="injection" />
<br />
<input type="submit" />
</form>
<?php
//FIXME - clean up HTML ^
error_reporting(E_ALL);
ini_set('display_errors', 1);
if(
  isset($_GET['injection']) &&
  is_string($_GET['injection']) &&
  strlen($_GET['injection']) < 0xff
) {
  $connect = @mysql_connect('localhost','ctf','Jie2Roh8ohre3Ahn');
  if( $connect === FALSE ) {
    die('Cannot connect to db, I am broken.');
  }
  $queries = array(
    "SELECT 'success' FROM dual WHERE 0={$_GET['injection']}",
    "SELECT 'success' FROM dual WHERE '1'='{$_GET['injection']}'",
    "SELECT 'success' FROM dual WHERE \"2\"=\"{$_GET['injection']}\"",
  );
  $successCount = 0;
  foreach( $queries as $query ) {
    $result = @mysql_query($query);
    if( $result === FALSE ) {
      $color = 'red';
    }
    else {
      if( mysql_num_rows($result) === 0 ) {
        $color = 'pink';
      }
      else {
        //echo mysql_result($result, 0);
        $successCount++;
        $color = 'green';
      }
    }
    echo "<font color=\"$color\">";
    echo htmlentities($query, ENT_QUOTES);
    echo "</font><br />\n";
  }
  if( $successCount === count($queries) ) {
    echo '<p>flag{7eea7182c1b1d720a3afc73f4cce2d91372bf7b9}</p>';
  }
}
