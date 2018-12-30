<?php
include 'common.php';

if(empty($_GET['imagekey'])) {
    header('Location: ?op=home');
    exit();
}

$imagekey = $_GET['imagekey'];
$im = load_image($imagekey);

$w = imagesx($im);
$h = imagesy($im);
if($w > MAX_IM_SIZE || $h > MAX_IM_SIZE)
    fatal("Invalid image dimensions.");

?>
<center>
<div class="article">
    <h2></h2>
    <p><img src="uploads/<?=$imagekey;?>.png" />
    <div>
        <a href="uploads/<?=$imagekey;?>.png">View saved image</a>
    </div>
</div>
</center>
