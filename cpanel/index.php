<?php 
include('../config.php');
include('../locales/'.LANGUAGE.".php");
?>
<!DOCTYPE html>
<html>
<header>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
</header>
<body>
<h1><?php echo TRANS_administration ; ?></h1>

<a type="button" class="btn btn-default" href="files.php"><?php echo TRANS_viewfiles ;?></a><br /><br />
<a type="button" class="btn btn-default" href="upload.php"><?php echo TRANS_uploadfiles ;?></a>  |  
<a type="button" class="btn btn-default" href="urlload.php"><?php echo TRANS_importfilesfromurl ?></a><br />
</body>
</html>
