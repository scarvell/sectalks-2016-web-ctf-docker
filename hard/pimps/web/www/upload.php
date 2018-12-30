<?php
include 'common.php';

if(isset($_POST['submit']) && isset($_FILES['image'])) {
    $fn = $_FILES['image']['tmp_name'];
    $ft = $_FILES['image']['type'];

    if(!is_uploaded_file($fn)) {
        fatal('uploaded file corrupted');
    }

    $array = array('image/png');
    if(!in_array($ft,$array)){
        fatal("Sorry, only PNG files are allowed.");
    }

    $imagekey = create_image_key();

    move_uploaded_file($fn, "uploads/$imagekey.png");

    header("Location: ?op=show&imagekey=$imagekey");

} else {
?>
<center>
<div class="article">
    <h2>Upload your own png file</h2>
    <form enctype="multipart/form-data" action="?op=upload" method="POST">
        <label for="image">Image file (max <?=MAX_IM_SIZE;?>x<?=MAX_IM_SIZE;?>): </label>
        <input type="file" id="image" name="image" />
        <br />
        <input type="submit" name="submit" value="Upload!" />
    </form>
</div>
</center>
<?php
}
?>
