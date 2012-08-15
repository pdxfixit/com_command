CREATE TABLE IF NOT EXISTS `#__command_sites` (
`id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY
,`title` varchar(255) NOT NULL
,`url` varchar(255) NOT NULL
,`updates` text COMMENT 'JSON'
,`published` tinyint(1) NOT NULL
,`lastupdated` datetime NOT NULL COMMENT 'When were updates last performed on the site'
,`updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
, PRIMARY KEY (`id`)
) ENGINE=MYISAM DEFAULT CHARSET=utf8;
