<?php
// users
if (php_sapi_name() != 'cli') {
    http_response_code(400);
    die();
}

require_once 'main.php';

$users = [
  array( "username" => "frank", "password" => "dfgsghjxcvbxcv", "admin" => "0" ),
  array( "username" => "dog", "password" => "sdfg64223^24566shgf", "admin" => "0" ),
  array( "username" => "luke", "password" => "xbyh354zdfy3561afghxdf", "admin" => "0" ),
  array( "username" => "ff5cff9048f6caad99ede20ff08976045b55419fc5624b887739816982d753c", "password" => "bvcsa*81892aKLVkjfAAAAyh654yughsy25621zdsfga", "admin" => "1" ),
  array( "username" => "john", "password" => "n%546vce56y2", "admin" => "0" ),
  array( "username" => "mark", "password" => "kljt24391mklhfaslkj12534896134", "admin" => "0" ),
  array( "username" => "matthew", "password" => "bzcku34586109l;U#*10=-1", "admin" => "0" ),
  array( "username" => "joe", "password" => "kljyASJK41896yjfdkakFDAHLSF", "admin" => "0" ),
  array( "username" => "daniel", "password" => "Ap1497ufklzRF!#jfslkzx*&#(knjl)", "admin" => "0" ),
  array( "username" => "bill", "password" => "glk;uu1jioCHZQWIhjlkf[a]", "admin" => "0" ),
  array( "username" => "george", "password" => "mQofpozsdu8961*)(@kvlz)", "admin" => "0" ),
  array( "username" => "ian", "password" => "vzxcagDSpoiy(&*yHJKASDFKJ)", "admin" => "0" ),
];

// Delete existing users
$bulk = new MongoDB\Driver\BulkWrite();
$writeConcern = new MongoDB\Driver\WriteConcern(MongoDB\Driver\WriteConcern::MAJORITY, 100);
$bulk->delete(array());
$db->executeBulkWrite('the_force.users', $bulk, $writeConcern);

// Create new users
for ($i = 0; $i < count($users); $i++) {
  $bulk = new MongoDB\Driver\BulkWrite();
  $bulk->insert(
    ['username' => $users[$i]['username'], 'password' => $users[$i]['password'], 'admin' => $users[$i]['admin']]
  );
  $result = $db->executeBulkWrite('the_force.users', $bulk, $writeConcern);
}

echo "Setup completed\n";
