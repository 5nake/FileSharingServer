<?php
// Please use encoded HTML entitys (like &ouml; instead of ö). You can search on duchduckgo.com (just type in 'html [+ your character])

// Error messages
define(TRANS_filenotfound, "Die Datei wurde nicht gefunden");
define(TRANS_passrequired, "Ein Passwort wird benötigt");
define(TRANS_passwrong, "Das Passwort ist falsch");
define(TRANS_nodatareported, "Keine Daten angegeben");

// Download form
define(TRANS_pass, "Passwort");
define(TRANS_file, "Datei");
define(TRANS_startdownload, "Download starten");

// Control panel
// index
define(TRANS_administration, "Administration");
define(TRANS_viewfiles, "Dateien anzeigen");
define(TRANS_uploadfiles, "Dateien hochladen");
define(TRANS_importfilesfromurl, "Dateien von URL importieren");

// upload / urlload
define(TRANS_uploadwassuccessful, "Der Upload war erfolgreich");
define(TRANS_uploadfailed, "Der Upload ist fehlgeschlagen");
define(TRANS_filesuccessfullycreated, "Datei erfolgreich erstellt");
define(TRANS_filecreationfailed, "Dateierstellung fehlgeschlagen");
define(TRANS_filename, "Dateiname");
define(TRANS_passwordcanbeempty, "Passwort (kann leer gelassen werden)");
define(TRANS_url, "URL");
define(TRANS_submit, "Absenden");
define(TRANS_link, "Link");
define(TRANS_uploadthisfile, "Diese Datei hochladen");
define(TRANS_maxuploadlimitis, "Das maximale Uploadlimit ist ");


// files listing
define(TRANS_fileonserver, "Datei auf Server");
define(TRANS_fileindatabasecheck, "Datei in Datenbank (Check)");
define(TRANS_downloads, "Downloads");
define(TRANS_delete, "L&ouml;schen");
define(TRANS_deletefile, "Datei L&ouml;schen");
define(TRANS_ok, "OK");
define(TRANS_notok, "NICHT OK");




// E-Mail
define(TRANS_fileshared, "Jemand hat mit dir eine Datei geteilt");
define(TRANS_senddata, "Daten per E-Mail schicken");
define(TRANS_emailadress, "E-Mailadresse");
define(TRANS_notrequired, " (nicht ben&ouml;tigt) ");
define(TRANS_sendwithpassword, "Mit Passwort senden");
define(TRANS_emailname, "Name des Empf&auml;ngers");
define(TRANS_hello, "Hallo");
define(TRANS_mailpass, '
				<!DOCTYPE html>
				<html>
				<head>
					<title>'.TRANS_fileshared.'</title>
				</head>
				<body>
				<p><em>'.TRANS_hello.' [toname],</em></p>
				
				<p>Die Datei [filename] wurde mit dir geteilt.</p>
				
				<table border="1" cellpadding="1" cellspacing="1" dir="ltr" style="width: 500px;">
					<tbody>
						<tr>
							<td>Dateiname</td>
							<td>Link</td>
							<td>Passwort</td>
						</tr>
						<tr>
							<td>[filename]</td>
							<td><a href="[link]">Hier klicken</a></td>
							<td>[password]</td>
						</tr>
					</tbody>
				</table>
				<p>Alternativ kannst du diesen Link verwenden: </p><br />
				<p>[link]</p>
				<p>&nbsp;</p>
				
				<p>[emailsender]</p>
				</body>
				</html>
				');

define(TRANS_mailwithoutpass, '
				<!DOCTYPE html>
				<html>
				<head>
					<title>'.TRANS_fileshared.'</title>
				</head>
				<body>
				<p><em>'.TRANS_hello.' [toname],</em></p>

				<p>Die Datei [filename] wurde mit dir geteilt.</p>

				<table border="1" cellpadding="1" cellspacing="1" dir="ltr" style="width: 500px;">
					<tbody>
						<tr>
							<td>Dateiname</td>
							<td>Link</td>
						</tr>
						<tr>
							<td>[filename]</td>
							<td><a href="[link]">Hier klicken</a></td>
						</tr>
					</tbody>
				</table>
				<p>Alternativ kannst du diesen Link verwenden: </p><br />
				<p>[link]</p>
				<p>&nbsp;</p>

				<p>[emailsender]</p>
				</body>
				</html>
				');
?>