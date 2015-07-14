<?php

class Mail {
	
	public function sendmailpass($toname, $tomail, $filename, $link, $password) {
		include('../config.php');

		
		
		
		
		if($password != "" and isset($password)){
		$subject = TRANS_fileshared.": ".$filename;
		
		$input = TRANS_mailpass;
		$tobereplaced = array("[filename]", "[toname]", "[link]", "[password]", "[emailsender]");
		$replacements = array($filename, $toname, $link, $password, EMAILSENDER);
		
		$message = str_replace($tobereplaced, $replacements, $input);
		
		
		
		// für HTML-E-Mails muss der 'Content-type'-Header gesetzt werden
		$header  = 'MIME-Version: 1.0' . "\r\n";
		$header .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		
		// zusätzliche Header
		$header .= 'To: '.$toname.' <'.$tomail.'>'. "\r\n";
		$header .= 'From: '.EMAILSENDER.' <'.EMAILADRESS.'>' . "\r\n";
		
		// verschicke die E-Mail
		mail($to, $subject, $message, $header);
		}else {
			$this->sendmail($toname, $tomail, $filename, $link);
		}
				
	}
	
	public function sendmail($toname, $tomail, $filename, $link) {
		include('../config.php');
	
	
	
	
	
	
		$subject = TRANS_fileshared.": ".$filename;
	
		$input = TRANS_mailwithoutpass;
		$tobereplaced = array("[filename]", "[toname]", "[link]", "[emailsender]");
		$replacements = array($filename, $toname, $link, EMAILSENDER);
	
		$message = str_replace($tobereplaced, $replacements, $input);
	
	
	
		// für HTML-E-Mails muss der 'Content-type'-Header gesetzt werden
		$header  = 'MIME-Version: 1.0' . "\r\n";
		$header .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	
		// zusätzliche Header
		$header .= 'To: '.$toname.' <'.$tomail.'>'. "\r\n";
		$header .= 'From: '.EMAILSENDER.' <'.EMAILADRESS.'>' . "\r\n";
	
		// verschicke die E-Mail
		mail($to, $subject, $message, $header);
	
	
	}
	
}

?>