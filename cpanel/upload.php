<?php 
$ausgabe = "";
if(isset($_FILES['userfile']['size'])) {
	$passlink = "";
	$uid = uniqid('', true);
	$debug[uid] = $uid;
	$uploaddir = '../files/';
	$uploadfile = $uploaddir . $uid;
	$name = $_FILES['userfile']['name'];
	$debug[name] = $name;
	$debug[uploadfile] = $uploadfile;
	include('../config.php');
	$db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_DATABASE);
	if ($db->connect_errno) {
		echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
	}
	if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
		$ausgabe .= "Datei ist valide und wurde erfolgreich hochgeladen.\n ";
	} else {
		echo "Upload fehlgeschlagen\n";
	}
	if(isset($_POST['pass'])) {
		$pass = hash('sha512', $_POST['pass']);
		$passlink = "-pass";
		$query = "INSERT INTO files(uid, filename, auth, date) VALUES('$uid', '$name', '$pass', NOW());";
	} else {
		$query = "INSERT INTO files(uid, filename, date) VALUES('$uid', '$name', NOW());";
		
	}
	$debug[query] = $query;
	if($db->query($query)) {
		$link = "http://".$_SERVER[SERVER_NAME]."/preparedl".$passlink.".php?file=".$uid;
		$ausgabe .= "Datei erfolgreich bearbeitet! ";
	} else {
		$ausgabe .= "Dateierstellung fehlgeschlagen! ";
		unlink('../files/'.$uid);
	}
}




?>
<!DOCTYPE html>
<html>
<body>
<form enctype="multipart/form-data" action="#" method="POST">
    <!-- MAX_FILE_SIZE muss vor dem Dateiupload Input Feld stehen -->
    <input type="hidden" name="MAX_FILE_SIZE" value="100000000" />
    <!-- Der Name des Input Felds bestimmt den Namen im $_FILES Array -->
    Diese Datei hochladen: <input name="userfile" type="file" />
    <p>Passwort: <input type="text" name="pass" /></p>
    <input type="submit" value="Upload starten!" />
</form>
<h1><?php echo $ausgabe; ?></h1>
<h1>Link: <?php echo $link; ?></h1>
</body>
</html>