<?php 
$form[uid] = $_REQUEST[file];
include('config.php');
include('./locales/'.LANGUAGE.'.php');
?>
<!DOCTYPE html>
<html>
<head>
<title><?php echo TRANS_file?></title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
<script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
<script src="https://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

<style type="text/css">
    .dl-panel{
    	margin: 20px;
    	position: center;
    }
    
</style>

<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
<div class="container">
<center>
<form action="download.php" method="post">
<div class="dl-panel">
 <div class="panel panel-default">
 <div class="panel-body">
  <div class="form-group">
    <label for="file"><?php echo TRANS_file ;?></label>
    <input type="text" class="form-control" name="file" id="file" readonly="" value="<?php echo $form[uid];?>">
  </div>
  <button type="submit" class="btn btn-default"><?php echo TRANS_startdownload ;?></button>
  </div>
  </div>
  </div>
</form>
</center>
</div>
</body>
</html>