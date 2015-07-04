<?php 
$form[uid] = $_REQUEST[file];
?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</head>
<body>
<form action="download.php" method="post">
  <div class="form-group">
    <label for="file">Datei</label>
    <input type="text" class="form-control" name="file" id="file" readonly="" value="<?php echo $form[uid];?>">
  </div>
  <button type="submit" class="btn btn-default">Dowload starten</button>
</form>
</body>
</html>