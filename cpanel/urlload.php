<?php
$link = "Sichtbar nach Eingabe";
$debug[request-data] = $_POST;
if(isset($_POST['name']) and isset($_POST['link'])) {
	$debug[setnameandlink] = "OK";
	$passlink = ".php";
	include('../config.php');
	$db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_DATABASE);
	if ($db->connect_errno) {
		echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
	}
	$uid = uniqid('', true);
	$name = $_POST['name'];
	$url = $_POST['link'];
	if(file_put_contents('../files/'.$uid, fopen($url, 'r'))) {
		$debug[fopen] = "OK";
	if(isset($_POST['password']) and $_POST['password'] != "") {
		$debug[pw] = "SET | OK";
		
		$pass = hash('sha512', $_POST['password']);
		$passlink = "-pass.php";
		$query = "INSERT INTO files(uid, filename, auth, date) VALUES('$uid', '$name', '$pass', NOW());";
	} else {
		$debug[pw] = "NOT SET | OK";
		$query = "INSERT INTO files(uid, filename, date) VALUES('$uid', '$name', NOW());";
	}
	if($db->query($query)) {
		$debug[querystat] = "OK";
		$result = "Datei erfolgreich bearbeitet!";
		$link = "http://".$_SERVER[SERVER_NAME]."/preparedl".$passlink."?file=".$uid;
	} else {
		$debug[querystat] = "NOT OK";
		$result = "Dateierstellung fehlgeschlagen!";
		unlink('../files/'.$uid);
	} $debug[query] = $query;
	} else {
		$debug[fopen] = "NOT OK";
	}
}
?>
<!DOCTYPE html>
<html>
<header>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
</header>
<body>
<div>
<form action="#" method="post">
 <div class="form-group">
 <label for="name">Dateiname</label>
 <input type="text" class="form-control" id="name" name="name" placeholder="Dateiname">
 </div>
 <div class="form-group">
 <label for="pass">Passwort (kann auch leer gelassen werden)</label>
 <input type="password" name="password" id="pass" class="form-control" placeholder="Passwort">
 </div>
 <div class="form-group">
 <label for="url">URL</label>
 <input id="url" type="text" name="link" class="form-control" placeholder="URL">
 </div>
 <button type="submit" class="btn btn-default">Absenden</button>
</form>
</div>
<br/>
<p><?php echo $result; ?></p>
<p>Link: <?php echo $link; ?></p>
</body>
</html>


