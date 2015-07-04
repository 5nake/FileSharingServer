<?php
include('config.php');
include('./locales/'.LANGUAGE.".php");
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
			$response = TRANS_filenotfound;
			break;
		case 2:
			$response = TRANS_passrequired;
			break;
		case 3:
			$response = TRANS_passwrong;
			break;
		case 4:
			$response = TRANS_nodatareported;
			break;
	}
} else {
	$response = TRANS_nodatareported;
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