# FileSharingServer

With this project, you can easily upload files to your PHP webserver (requires MySQL).

Features
=============

You can upload your files or let the server download them from URL.
The files can be password protected.



Installation
=============

Setting up databases
-------------

	
	CREATE TABLE IF NOT EXISTS `files` (
	  `id` int(11) NOT NULL AUTO_INCREMENT,
	  `uid` varchar(23) COLLATE utf8_unicode_ci NOT NULL,
	  `filename` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
	  `auth` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
	  `date` date NOT NULL,
	  `downloads` int(10) NOT NULL DEFAULT '0',
	  `last_download` date NOT NULL,
	  PRIMARY KEY (`id`),
	  UNIQUE KEY `id` (`id`),
	  UNIQUE KEY `uid` (`uid`)
	) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=9 ;

Run this SQL-Script on your MySQL server.

Uploading files to webserver
-------------

Upload all files to your webserver. Make sure that you change the config in config.php

That's all.
Contol panel is online at [yourdomain.example]/cpanel

Security
=============

Secure the /cpanel and the /files folder with a .htaccess and .htpasswd file (see http://htaccess-generator.com/).
The passwords of the sharings are hashed via sha512.

Language
=============

Available translations: en_EN, de_DE
(The translations are located in /locales)
You can send me translations. Upload them to your File Sharing Server and submit the link as an translation issue on this GitHub repository.

Miscellaneous
=============

You can use robots.txt for hiding the page in search engines.