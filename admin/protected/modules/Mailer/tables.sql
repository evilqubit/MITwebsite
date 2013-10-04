--
-- Table structure for table `mail_message`
--

CREATE TABLE IF NOT EXISTS `mail_message` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `body` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `from` varchar(50) NOT NULL,
  `fromName` varchar(50) NOT NULL,
  `isHtml` tinyint(1) NOT NULL DEFAULT '0',
  `sendingTime` datetime NOT NULL,
  `referenceId` int(11) NOT NULL DEFAULT '0',
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  `cUserId` int(11) NOT NULL DEFAULT '0',
  `cTime` datetime NOT NULL,
  `cIpAddress` varchar(40) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

--
-- Table structure for table `mail_queue`
--

CREATE TABLE IF NOT EXISTS `mail_queue` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `to` varchar(50) NOT NULL,
  `toName` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `messageId` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `error` varchar(255) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  `cTime` datetime NOT NULL,
  `cIpAddress` varchar(40) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 ;