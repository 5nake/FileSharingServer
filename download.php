<?php

if(isset($_POST['file'])) {
	include('config.php');
	$pw = "";
	$status[filepost] = "OK";
	$db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_DATABASE);
	if ($db->connect_errno) {
		$status[db] = "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
	} else {
		$status[db] = "OK";
	}
	
	$uid = $_POST['file'];
	$checkfile = $db->query("SELECT * FROM `files` WHERE '".$uid."' = uid;");
	
	$no_of_rows[checkfile] = mysqli_num_rows($checkfile);
	$result[checkfile] = mysqli_fetch_array($checkfile);
	if($no_of_rows[checkfile] == "1") {
		$status[checkfile] = "OK";
		if($result[checkfile][auth] == "" or $result[checkfile][3] = null) {
			if(file_exists("./files/".$uid)) {
				$status[file] = "OK";
				$db->query("UPDATE `".DB_DATABASE."`.`files` SET `downloads` = '".($result[checkfile][downloads] + 1)."' WHERE `files`.`uid` ='".$uid."';");
				$db->query("UPDATE `".DB_DATABASE."`.`files` SET `last_download` = NOW() WHERE `files`.`uid` ='".$uid."';");
				getfile($uid, $result[checkfile][filename]);
				
			} else {
				$status[file] = "NOT OK";
				
				$ecode = "1";
				
				
			}
			
			
			$status[pw] = "NOT SET | OK";
			
			
		} else { $pw = "&pw=1"; 
			if(isset($_POST['password']) and $pass = hash('sha512', $_POST['password']) == $result[checkfile][auth]) {
			if(file_exists("./files/".$uid)) {
				$status[file] = "OK";
				$db->query("UPDATE `".DB_DATABASE."`.`files` SET `downloads` = '".($result[checkfile][downloads] + 1)."' WHERE `files`.`uid` ='".$uid."';");
				$db->query("UPDATE `".DB_DATABASE."`.`files` SET `last_download` = NOW() WHERE `files`.`uid` ='".$uid."';");
				getfile($uid, $result[checkfile][filename]);
				
			} else {
				
				$ecode = "1";
				
				
				$status[file] = "NOT OK";
			}
			$status[pw] = "OK";
			
			
		} else if($_POST['password'] == "" or $_POST['password'] == null) {
			$status[pw] = "NOT SET | NOT OK";
			
			$ecode = "2";
			
			
		} else {
			$status[pw] = "NOT OK";
			
			
			$ecode = "3";
			
		}}
	} else {
		$status[checkfile] = "NOT OK";
		
		$ecode = "1";
		
		
	}
	
	
	
} else {
	
	$ecode = "4";
	
	
	
}


function getfile($uid, $filename) {
	$filepath = "./files/".$uid;
	$finfo = finfo_open(FILEINFO_MIME_TYPE);
	$mimeType = finfo_file($finfo, $filepath);
	
	header('Content-type: '.$mimeType);
	header('Content-Disposition: attachment; filename="'.$filename.'"');
	
	readfile($filepath);
	
}

function htmloutput($pos) {
	if($pos == "start") {
		echo "
		<!DOCTYPE html>
		<html>
		<body>";
	} else if($pos == "end") {
		echo '
		<meta http-equiv="refresh" content="3; URL=/preparedl.php?file='.$_POST['file'].'">
		</body>
		</html>';
	} else if($pos == "end_pw") {
		echo '
		<meta http-equiv="refresh" content="3; URL=/preparedl-pass.php?file='.$_POST['file'].'">
		</body>
		</html>';
	}
}

if(isset($ecode)) {
	echo '<meta http-equiv="refresh" content="0; URL=/dlerror.php?file='.$_POST['file'].'&ecode='.$ecode.$pw.'">';
	
}
?>