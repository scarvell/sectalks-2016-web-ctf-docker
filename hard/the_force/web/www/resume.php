<?php
require 'main.php';

if (!isAdmin()) {
  echo "Resume uploader is offline to non-admins due to security concerns. ";
  exit;
}
else {
  echo '<h1>Upload resume</h1>';
  echo '
  * .docx files only
  <form action="upload.php" method="post" enctype="multipart/form-data">
    <input type="file" name="resume" />
    <p>
      <input type="submit" value="Upload" />
    </p>
  </form>';
}
?>
