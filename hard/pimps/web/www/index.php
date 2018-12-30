<?php
error_reporting(0);
define('FROM_INDEX', 1);

$op = empty($_GET['op']) ? 'home' : $_GET['op'];
if(!is_string($op) || preg_match('/\.\./', $op))
    die('Try it again and I will kill you! I fucking hate hackers! Pandadmin.');
ob_start('ob_gzhandler');

function page_top($op) {
?><!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Panduploader :: <?= htmlentities(ucfirst($op)); ?></title>
</head>
<body>
	<div id="header">
		<center><a href="?op=home" class="logo"><img src="images/logo.png" alt=""></a></center>
	</div>
	<div id="body">
<?php
}

function fatal($msg) {
?><div class="article">
<h2>Error</h2>
<p><?=$msg;?></p>
</div><?php
exit(1);
}

function page_bottom() {
?>
    </div>
    <center>
	<div id="footer">
		<div>
			<p>
				<span>2016 &copy; 1337 Pandas Corporation.</span> All rights reserved.
			</p>
		</div>
	</div>
	</center>
</body>
</html><?php
ob_end_flush();
}

register_shutdown_function('page_bottom');

page_top($op);

if(!(include $op . '.php'))
    fatal('no such page');
?>
