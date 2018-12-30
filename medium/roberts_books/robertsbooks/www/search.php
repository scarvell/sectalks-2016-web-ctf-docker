<?php
header("Content-Type: application/json");

$con = mysqli_connect("localhost","ctf","Jie2Roh8ohre3Ahn","ctf");

// Check connection
if (mysqli_connect_errno()) {
  die("Failed to connect to MySQL: " . mysqli_connect_error());
}

$searchQuery  = $_POST['searchQuery'];
$verification = $_POST['verification'];

if(md5($searchQuery) !== $verification) {
  die("bad query");
}

$query = "SELECT * FROM books WHERE title LIKE '%$searchQuery%' OR author LIKE '%$searchQuery%' OR published = '$searchQuery'";

$qr = @mysqli_query($con, $query);
$results = array();

while($book = mysqli_fetch_assoc($qr)) {
  array_push($results, $book);
}

echo json_encode($results);
?>
