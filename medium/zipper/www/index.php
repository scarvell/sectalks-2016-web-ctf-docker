<?php
error_reporting(-1);
ini_set('display_errors', 'On');
require_once 'header.php';

$success = false;
$badZip = false;

function gen_uuid() {
    return sprintf( '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
        mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ),
        mt_rand( 0, 0xffff ),
        mt_rand( 0, 0x0fff ) | 0x4000,
        mt_rand( 0, 0x3fff ) | 0x8000,
        mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff )
    );
}

function zipIsValid($path) {
  $zip = zip_open($path);
  if (is_resource($zip)) {
    zip_close($zip);
    return true;
  } else {
    return false;
  }
}


if(isset($_FILES['archive'])) {
  $dest = 'archives/'.gen_uuid();
  $zipFile = $_FILES['archive']['tmp_name'];
  mkdir($dest);
  if (zipIsValid($zipFile)) {
    exec("unzip $zipFile -d $dest");
		// TODO: recursive delete .htaccess
    if (file_exists("$dest/.htaccess")) {
      unlink("$dest/.htaccess");
    }
    $success = true;
  }
  else {
    $badZip = true;
  }
}
?>
<div class="row">
  <div class="page-header">
    <h3>Archive Extractor</h3>
  </div>
  <p>Got a zip file and stuck with out winzip?  No problem! We have you sorted.</p>
  <?php if ($success): ?>
    <div class="alert alert-success">
      <strong>Woo hoo!</strong> We've unzipped your files. You can view them <a href="<?php echo $dest;?>">here</a>
    </div>
  <?php endif; ?>
  <?php if ($badZip): ?>
    <div class="alert alert-danger">
      <strong>Error</strong> Bad zip file</a>
    </div>
  <?php endif; ?>
  <form action="" method="post" enctype="multipart/form-data" />
    <input type="file" name="archive" />
    <br />
    <input type="submit" value="Unzip!" class="btn btn-primary" />
  </form>
</div>
<?php
require_once 'footer.php';
?>
