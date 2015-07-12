<?php
include('../config.php');
include('../locales/'.LANGUAGE.'.php');
$link = "";
$debug[request-data] = $_POST;
if(isset($_POST['name']) and isset($_POST['link'])) {
	$urlok = false;
	$debug[setnameandlink] = "OK";
	$passlink = ".php";
	
	
	$name = $_POST['name'];
	$url = $_POST['link'];
	$pos1 = strpos($url, "http://");
	$pos2 = strpos($url, "https://");
	if($pos1 !== false) { 
		$urlok = true;
	}else if($pos2 !== false) { 
		$urlok = true; 
	}
	if($urlok != false) {
		$db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_DATABASE);
		
		if ($db->connect_errno) {
			echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
		}
		
		$uid = uniqid('', true);
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
			$queryok = true;
			$result = "Datei erfolgreich bearbeitet!";
			$link = "http://".DOMAIN."/preparedl".$passlink."?file=".$uid;
		} else {
			$debug[querystat] = "NOT OK";
			$result = "Dateierstellung fehlgeschlagen!";
			unlink('../files/'.$uid);
		} $debug[query] = $query;
		} else {
			$debug[fopen] = "NOT OK";
		}
		$db->close();
		
		if(isset($_POST['toname']) and $_POST['toname'] != "" and isset($_POST['email']) and $_POST['email'] != "") {
			if(($_POST['sendpw'] == "yes") and $queryok = true and (isset($_POST['toname']) and $_POST['toname'] != "" and isset($_POST['email']) and $_POST['email'] != "")) {
				require_once('mail.php');
				$mail = new Mail();
		
				$mail->sendmailpass($_POST['toname'], $_POST['email'], $name, $link, $_POST['pass']);
			}else if(($_POST['sendpw'] == "" or isset($_POST['sendpw']) == false) and $queryok = true and (isset($_POST['toname']) and $_POST['toname'] != "" and isset($_POST['email']) and $_POST['email'] != "")) {
				require_once('mail.php');
				$mail = new Mail();
				
				$mail->sendmail($_POST['toname'], $_POST['email'], $name, $link);
			}
		}
		} else {
			$result = "Die URL muss mit 'http://' oder mit 'https://' beginnen!";
		}
	
	
}
?>
<!DOCTYPE html>
<html>
<header>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
<script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
<script src="https://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

<style type="text/css">
    .email-panel{
    	margin: 50px;
    }
</style>
</header>
<body>
<div>
<form action="#" method="post">
 <div class="form-group">
 	<label for="name"><?php echo TRANS_filename;?></label>
 	<input type="text" class="form-control" id="name" name="name" placeholder="<?php echo TRANS_filename;?>">
 </div>
 <div class="form-group">
 	<label for="pass"><?php echo TRANS_passwordcanbeempty;?></label>
 	<input type="password" name="password" id="pass" class="form-control" placeholder="<?php echo TRANS_pass;?>">
 </div>
 <div class="form-group">
 	<label for="url"><?php echo TRANS_url;?></label>
 	<input id="url" type="text" name="link" class="form-control" placeholder="<?php echo TRANS_url;?>">
 </div>
 <div class="panel panel-default">
 <div class="panel-body">
 <p><?php echo TRANS_senddata.TRANS_notrequired;?></p>
 <div class="form-group">
    <label for="email"><?php echo TRANS_emailadress;?></label>
    <input type="email" class="form-control" id="email" name="email" placeholder="<?php echo (TRANS_emailadress);?>">
    </div>
<div class="form-group">
    <label for="emailname"><?php echo (TRANS_emailname);?></label>
    <input type="text" class="form-control" id="emailname" name="toname" placeholder="<?php echo (TRANS_emailname);?>">
</div>
<div class="checkbox">
    <label>
      <input type="checkbox" name="sendpw" value="yes"> <?php echo (TRANS_sendwithpassword);?>
    </label>
</div>
</div>
</div>
 <button type="submit" class="btn btn-default"><?php echo TRANS_submit;?></button>
</form>
</div>
<br/>
<h1><?php echo $result; ?></h1>
<h1><?php echo TRANS_link;?>: <?php echo $link; ?></h1>
</body>
</html>


