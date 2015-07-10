<?php
// Please use encoded HTML entitys (like &ouml; instead of ö). You can search on duchduckgo.com (just type in 'html [+ your character])

// Error messages
define(TRANS_filenotfound, "The file could not be found");
define(TRANS_passrequired, "A password is required");
define(TRANS_passwrong, "The password is wrong");
define(TRANS_nodatareported, "No data reported");

// Download form
define(TRANS_pass, "Password");
define(TRANS_file, "File");
define(TRANS_startdownload, "Start download");

// Control panel
// index
define(TRANS_administration, "Administration");
define(TRANS_viewfiles, "View files");
define(TRANS_uploadfiles, "Upload files");
define(TRANS_importfilesfromurl, "Import files from URL");

// upload / urlload
define(TRANS_uploadwassuccessful, "The upload was successful");
define(TRANS_uploadfailed, "The upload has failed");
define(TRANS_filesuccessfullycreated, "File successfully created");
define(TRANS_filecreationfailed, "Filecreation failed");
define(TRANS_filename, "Filename");
define(TRANS_passwordcanbeempty, "Password (may be empty)");
define(TRANS_url, "URL");
define(TRANS_submit, "Submit");
define(TRANS_link, "Link");
define(TRANS_uploadthisfile, "Upload this file");
define(TRANS_maxuploadlimitis, "The max. upload limit is ");
define(TRANS_fileshared, "Somebody has shared a file with you");

// files listing
define(TRANS_fileonserver, "File on server");
define(TRANS_fileindatabasecheck, "File in database (Check)");
define(TRANS_downloads, "Downloads");
define(TRANS_delete, "Delete");
define(TRANS_deletefile, "Delete file");
define(TRANS_ok, "OK");
define(TRANS_notok, "NOT OK");

// E-Mail
define(TRANS_senddata, "Send data via E-Mail");
define(TRANS_emailadress, "E-Mailadress");
define(TRANS_notrequired, " (not required) ");
define(TRANS_sendwithpassword, "Send with password");
define(TRANS_emailname, "Name of the recipient");
define(TRANS_mailpass, '
				<!DOCTYPE html>
				<html>
				<head>
					<title>'.TRANS_fileshared.'</title>
				</head>
				<body>
				<p><em>'.TRANS_hello.' [toname],</em></p>

				<p>The file [filename] was shared with you.</p>

				<table border="1" cellpadding="1" cellspacing="1" dir="ltr" style="width: 500px;">
					<tbody>
						<tr>
							<td>Filename</td>
							<td>Link</td>
							<td>Password</td>
						</tr>
						<tr>
							<td>[filename]</td>
							<td>[link]</td>
							<td>[password]</td>
						</tr>
					</tbody>
				</table>

				<p>&nbsp;</p>

				<p>[emailsender]</p>
				</body>
				</html>
				');
?>
