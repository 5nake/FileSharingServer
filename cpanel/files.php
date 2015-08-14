<!DOCTYPE html>
<html>
<head>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>


<style type="text/css">
    .email-panel{
    	margin: 20px;
    }
</style>

<script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
<script src="https://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
</head>
<body>
<div class="container">
<div class="email-panel">
 <div class="panel panel-default">
 <div class="panel-body">
<?php

include('../config.php');
include('../locales/'.LANGUAGE.'.php');
$db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_DATABASE);
if ($db->connect_errno) {
	$status[db] = "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
} else {
	$status[db] = "OK";
}


$allfiles = scandir('../files'); //Ordner "../files" auslesen
echo '<style> table, td, th { border: 1px solid black; } </style>';
echo '<table class="table">';
echo '<tr><th>'.TRANS_fileonserver.'</th><th>'.TRANS_fileindatabasecheck.'</th><th>'.TRANS_filename.'</th><th>'.TRANS_downloads.'</th><th>'.TRANS_link.'</th><th>'.TRANS_delete.'</th></tr>';
foreach ($allfiles as $file) { // Ausgabeschleife
	if($file != ".htaccess" and $file != "." and $file != ".." and $file != "SHARED FILES WILL BE IN HERE") {
		$checkfile = $db->query("SELECT * FROM `files` WHERE '".$file."' = uid;");
		$no_of_rows[checkfile] = mysqli_num_rows($checkfile);
		$result[checkfile] = mysqli_fetch_array($checkfile);
		echo '<tr>';
		echo '<th>'.$file.'</th>'; // Datei auf Server
		if($no_of_rows[checkfile] == "1") {
			echo '<th>'.TRANS_ok.'</th>'; // Datei auf Datenbank
			echo '<th>'.$result[checkfile][filename].'</th>'; // Dateiname
			echo '<th>'.$result[checkfile][downloads].'</th>'; // Downloads
			if($result[checkfile][auth] == "" or $result[checkfile][auth] = null) {
			echo '<th>'.DOMAIN.'/preparedl.php?file='.$result[checkfile][uid].'</th>'; // Link ohne Passwort
			} else {
				echo '<th>'.DOMAIN.'/preparedl-pass.php?file='.$result[checkfile][uid].'</th>'; // Link mit PW
			}
			echo '<th><a href="delete.php?file='.$result[checkfile][uid].'&method=fdb">'.TRANS_deletefile.'</a></th>'; // Delete file
		} else {
			echo '<th>'.TRANS_notok.'</th><th>/</th><th>/</th><th>/</th><th><a href="delete.php?file='.$file.'&method=f">'.TRANS_deletefile.'</a></th></td>';
		}
		echo '</td>';
		$editedfiles .= $file;
		
	}
};




echo '</td>';
echo '</table>';


$db->close();


?>
</div>
</div>
</div>
</div>
</body>
</html>