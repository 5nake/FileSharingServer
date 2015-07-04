<?php

if(isset($_REQUEST['ecode'])) {
	$ecode = $_REQUEST['ecode'];
	$pw = $_REQUEST['pw'];
	if(isset($_REQUEST['pw'])) {
		$return_link = '<meta http-equiv="refresh" content="3; URL=/preparedl-pass.php?file='.$_REQUEST['file'].'">';
	} else {
		$return_link = '<meta http-equiv="refresh" content="3; URL=/preparedl.php?file='.$_REQUEST['file'].'">';
	}
	switch ($ecode) {
		case 1:
			$response = "Die Datei wurde nicht gefunden";
			break;
		case 2:
			$response = "Ein Passwort wird benötigt.";
			break;
		case 3:
			$response = "Das Passwort ist falsch";
			break;
		case 4:
			$response = "Keine Daten angegeben";
			break;
	}
} else {
	$response = "Keine Daten angegeben";
}

/* 1 = File not found.
 * 2 = No PW but PW required
 * 3 = PW wrong. 
 * 4 = No arguments provided
 */
?>
<!DOCTYPE html>
<html>
<body>
<h4><?php echo $response; ?></h4>
<?php echo $return_link; ?>
</body>
</html>