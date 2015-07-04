<?php
echo '<!DOCTYPE html>
		<html>
		<body>';

include('../config.php');
include('../locales/'.LANGUAGE);
$db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_DATABASE);
if ($db->connect_errno) {
	$status[db] = "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
} else {
	$status[db] = "OK";
}


$allfiles = scandir('../files'); //Ordner "../files" auslesen
echo '<style> table, td, th { border: 1px solid black; } </style>';
echo '<table>';
echo '<tr><th>'.TRANS_fileonserver.'</th><th>'.TRANS_fileindatabasecheck.'</th><th>'.TRANS_filename.'</th><th>'.TRANS_downloads.'</th><th>'.TRANS_link.'</th><th>'.TRANS_delete.'</th></tr>';
foreach ($allfiles as $file) { // Ausgabeschleife
	if($file != ".htaccess" and $file != "." and $file != ".." and $file != "SHARED FILES WILL BE IN HERE") {
		$checkfile = $db->query("SELECT * FROM `files` WHERE '".$file."' = uid;");
		$no_of_rows[checkfile] = mysqli_num_rows($checkfile);
		$result[checkfile] = mysqli_fetch_array($checkfile);
		echo '<tr>';
		echo '<th>'.$file.'</th>'; // Datei auf Server
		if($no_of_rows[checkfile] = "1") {
			echo '<th>'.TRANS_ok.'</th>'; // Datei auf Datenbank
			echo '<th>'.$result[checkfile][filename].'</th>'; // Dateiname
			echo '<th>'.$result[checkfile][downloads].'</th>'; // Downloads
			if($result[checkfile][auth] == "" or $result[checkfile][auth] = null) {
			echo '<th>http://'.$_SERVER[SERVER_NAME].'/preparedl.php?file='.$result[checkfile][uid].'</th>'; // Link ohne Passwort
			} else {
				echo '<th>http://'.$_SERVER[SERVER_NAME].'/preparedl-pass.php?file='.$result[checkfile][uid].'</th>'; // Link mit PW
			}
			echo '<th><a href="delete.php?file='.$result[checkfile][uid].'">'.TRANS_deletefile.'</a></th>'; // Delete file
		}
		echo '</td>';
		
		
	}
};
echo '</table>';
echo '</body>
		</html>';
?>