<?php
require_once 'header.php';
require_once 'flag.php';
$string = (isset($_POST['text'])) ? $_POST['text'] : '';

$find = (isset($_POST['find'])) ? $_POST['find'] : '//';
$replace = (isset($_POST['replace'])) ? $_POST['replace'] : '';

if(!$finalString = @preg_replace($find,$replace,$string)) {
  $finalString = str_replace($find, $replace, $string);
}

?>
<div class="row">
  <div class="page-header">
    <h3>Welcome to e! The most sophisticated web based find and replace tool</h3>
  </div>
<form action="" method="post" class="form-horizontal">
  <div class="form-group">
   <label for="inputPassword3" class="col-sm-2 control-label">Message:</label>
   <div class="col-sm-10">
     <textarea class="form-control" placeholder="Enter your phrase here" name="text" rows="10" cols="50"><?php echo htmlentities($string, ENT_QUOTES); ?></textarea>
   </div>
  </div>
  <div class="form-group">
   <label for="inputPassword3" class="col-sm-2 control-label">Find:</label>
   <div class="col-sm-4">
     <input type="text" class="form-control" name="find" placeholder="Find">
   </div>

   <label for="inputPassword3" class="col-sm-2 control-label">Replace:</label>
   <div class="col-sm-4">
     <input type="text" class="form-control" name="replace" placeholder="Replacement">
   </div>
  </div>
  <div class="form-group">
    <div class="col-sm-2"></div>
    <div class="col-sm-4">
      <input type="submit" class="btn btn-primary"/>
    </div>
  </div>
</form>
<hr />
<strong>Output:</strong>
<hr />
<pre>
<?php echo $finalString; ?>
</pre>
</div>
<?php
require_once 'footer.php';
?>
