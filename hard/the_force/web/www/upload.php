<?php
require_once 'main.php';

requireAuth();
if (!isAdmin()) return die("access denied - admin only");
if (isset($_FILES['resume'])) {
  $allowedExts = array("docx");

  $file       = $_FILES['resume']['tmp_name'];
  $filename   = $_FILES["resume"]["name"];
  $extension  = @end(explode(".", $filename));
  if (($_FILES["resume"]["type"] == "application/msword") || ($_FILES["resume"]["type"] == "application/vnd.openxmlformats-officedocument.wordprocessingml.document") && ($_FILES["resume"]["size"] < 20000000) && in_array($extension, $allowedExts))
   {
     if ($_FILES["resume"]["error"] > 0)
     {
        echo "Return Code: " . $_FILES["resume"]["error"] . "<br>";
     }
     else
     {
       // unzip our docx
       $filename = escapeshellarg($filename);
       if (strstr($filename, '..') || strstr($filename, '/')) {
         die("bad file name!");
       }

       exec("mkdir /tmp/" . $filename);
       exec("cp $file /tmp/file_" . $filename);
       exec("unzip -o /tmp/file_" . $filename . " -d /tmp/" . $filename);

       $xml = @simplexml_load_file("/tmp/" . str_replace("'", "", $filename) . "/word/document.xml", null,
         LIBXML_NOWARNING | LIBXML_NOERROR | LIBXML_DTDVALID | LIBXML_DTDLOAD | LIBXML_DTDATTR
       );
       $xml->registerXPathNamespace('w', 'http://schemas.microsoft.com/office/word/2003/wordml');
       $xml->registerXPathNamespace('aml', 'http://schemas.microsoft.com/aml/2001/core');

       $text = $xml->xpath('//w:t');

       if (!isset($text[0]) || $text[0] == '') {
         $text = ['(No Data Provided)'];
       }
       echo "Thank you <b>" . htmlentities($text[0], ENT_QUOTES) . "</b> We're processing your resume and someone will be in contact shortly.";
       exec("rm -rf /tmp/" . $filename); // I think this is needed due to issues

     }
   }
   else {
     echo "Bad file.";
   }

}
?>
