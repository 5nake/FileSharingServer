<?php
if(isset($_REQUEST['file'])) {
	$uid = $_REQUEST['file'];
	include('../config.php');
	
	$db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_DATABASE);
	if ($db->connect_errno) {
		$status[db] = "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
	} else {
		$status[db] = "OK";
	}
	
	
	$query = "DELETE FROM `u328395420_dl`.`files` WHERE `files`.`uid` = '".$uid."';";
	
	if($db->query($query)) {
		$ausgabe .= "QUERY OK<br />\n";
		$delayqu = "0";
	} else {
		$ausgabe .= "QUERY NOT OK<br />\n";
		$delayqu = "3";
	}
	
	if(unlink("../files/".$uid)) {
		$ausgabe .= "UNLINK OK<br />\n";
		$delayul = "0";
	} else {
		$ausgabe .= "UNLINK NOT OK<br />\n";
		$delayul = "3";
	}
	
	$delay = ($delayqu + $delayul);
	$db->close();
}

?>
<!DOCTYPE html>
<html>
<body>
<h4><?php echo $ausgabe; ?></h4>
<meta http-equiv="refresh" content="<?php  echo $delay; ?>; URL=files.php">
</body>
</html>