<?php
echo '<!DOCTYPE html>
		<html>
		<body>';

include('../config.php');
$db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_DATABASE);
if ($db->connect_errno) {
	$status[db] = "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
} else {
	$status[db] = "OK";
}


$alledateien = scandir('../files'); //Ordner "../files" auslesen
echo '<style> table, td, th { border: 1px solid black; } </style>';
echo '<table>';
echo '<tr><th>Datei auf Server</th><th>Datei auf Datenbank</th><th>Dateiname</th><th>Downloads</th><th>Link</th></tr>';
foreach ($alledateien as $datei) { // Ausgabeschleife
	if($datei != ".htaccess" and $datei != "." and $datei != "..") {
		$checkfile = $db->query("SELECT * FROM `files` WHERE '".$datei."' = uid;");
		$no_of_rows[checkfile] = mysqli_num_rows($checkfile);
		$result[checkfile] = mysqli_fetch_array($checkfile);
		echo '<tr>';
		echo '<th>'.$datei.'</th>'; // Datei auf Server
		if($no_of_rows[checkfile] = "1") {
			echo '<th>OK</th>'; // Datei auf Datenbank
			echo '<th>'.$result[checkfile][filename].'</th>'; // Dateiname
			echo '<th>'.$result[checkfile][downloads].'</th>'; // Downloads
			if($result[checkfile][auth] == "" or $result[checkfile][auth] = null) {
			echo '<th>http://'.$_SERVER[SERVER_NAME].'/preparedl.php?file='.$result[checkfile][uid].'</th>'; // Link ohne Passwort
			} else {
				echo '<th>http://'.$_SERVER[SERVER_NAME].'/preparedl-pass.php?file='.$result[checkfile][uid].'</th>'; // Link mit PW
			}
		}
		echo '</td>';
		// echo $datei."<br />"; //Ausgabe Einzeldatei
		
	}
};
echo '</table>';
echo '</body>
		</html>';
?>