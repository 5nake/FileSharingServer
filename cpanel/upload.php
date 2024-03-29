<?php 
include('../config.php');
include('../locales/'.LANGUAGE.'.php');
$ausgabe = "";
if(isset($_FILES['userfile']['size']) and $_FILES['userfile']['size'] > 1) {
	$passlink = "";
	$uid = uniqid('', true);
	$debug[uid] = $uid;
	$uploaddir = '../files/';
	$uploadfile = $uploaddir . $uid;
	$name = $_FILES['userfile']['name'];
	$debug[name] = $name;
	$debug[uploadfile] = $uploadfile;
	
	$db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_DATABASE);
	if ($db->connect_errno) {
		echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
	}
	if ($_FILES['userfile']['size'] > 1 and $_FILES['userfile']['size'] < (MAXUPLOADSIZE + 1) and move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
		$ausgabe .= TRANS_uploadwassuccessful.". \n ";
		$uploadok = true;
	} else {
		echo TRANS_uploadfailed.". \n";
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
		$link = DOMAIN."/preparedl".$passlink.".php?file=".$uid;
		$ausgabe .= TRANS_filesuccessfullycreated.". \n";
		$queryok = true;
	} else {
		$ausgabe .= TRANS_filecreationfailed.". \n";
		unlink('../files/'.$uid);
	}
	
	if(($_POST['sendpw'] == "yes") and $uploadok = true and $queryok = true and (isset($_POST['toname']) and $_POST['toname'] != "" and isset($_POST['email']) and $_POST['email'] != "")) {
		require_once('mail.php');
		$mail = new Mail();
		
		$mail->sendmailpass($_POST['toname'], $_POST['email'], $name, $link, $_POST['pass']);
	}else if(($_POST['sendpw'] == "" or isset($_POST['sendpw']) == false) and $queryok = true and (isset($_POST['toname']) and $_POST['toname'] != "" and isset($_POST['email']) and $_POST['email'] != "")) {
				require_once('mail.php');
				$mail = new Mail();
				
				$mail->sendmail($_POST['toname'], $_POST['email'], $name, $link);
			}
	$db->close();
}




?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
<script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
<script src="https://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

<style type="text/css">
    .email-panel{
    	margin: 20px;
    }
    .container:{ 'body' };
</style>
</head>
<body>
<form enctype="multipart/form-data" action="#" method="POST">
    <!-- MAX_FILE_SIZE muss vor dem Dateiupload Input Feld stehen -->
    <input type="hidden" name="MAX_FILE_SIZE" value="<?php  echo (MAXUPLOADSIZE) ;?>" />
    <div class="form-group">
    	<label for="file"><?php echo TRANS_uploadthisfile;?></label>
    	<input type="file" id="file" name="userfile">
    <p class="help-block"><?php echo (TRANS_maxuploadlimitis); echo (MAXUPLOADSIZE)."bytes";?></p>
    </div>
    <div class="form-group">
    <label for="pass"><?php echo TRANS_pass;?></label>
    <input type="password" class="form-control" id="pass" name="pass" placeholder="<?php echo TRANS_pass;?>">
    </div>
     <div class="email-panel">
     <div class="panel panel-default">
 	<div class="panel-body">
 	<p><?php echo TRANS_senddata.TRANS_notrequired;?></p>
    <div class="form-group">
    <label for="email"><?php echo TRANS_emailadress;?></label>
    <span class="input-group-addon">@</span>
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
  	</div>
    <button type="submit" class="btn btn-default"><?php echo TRANS_submit;?></button>
</form>
<h1><?php echo $ausgabe; ?></h1>
<h1><?php echo (TRANS_link) ;?>: <?php echo $link; ?></h1>
</body>
</html>