# FileSharingServer

With this project, you can easily upload files to your PHP webserver (requires MySQL).

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
	  PRIMARY KEY (`id`),
	  UNIQUE KEY `id` (`id`),
	  UNIQUE KEY `uid` (`uid`)
	) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

Run this SQL-Script on your MySQL server.

Uploading files to webserver
-------------

Upload all files to your webserver. Make sure that you change the databases in download.php, cpanel/urlload.php and cpanel/upload.php. 

