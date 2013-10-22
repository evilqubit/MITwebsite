CREATE DATABASE  IF NOT EXISTS `competition` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `competition`;
-- MySQL dump 10.13  Distrib 5.5.16, for Win32 (x86)
--
-- Host: 127.0.0.1    Database: competition
-- ------------------------------------------------------
-- Server version	5.5.20-log

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `newsletter_subscriber_group`
--

DROP TABLE IF EXISTS `newsletter_subscriber_group`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `newsletter_subscriber_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `subscriberId` int(11) NOT NULL,
  `groupId` smallint(6) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `newsletter_subscriber_group`
--

LOCK TABLES `newsletter_subscriber_group` WRITE;
/*!40000 ALTER TABLE `newsletter_subscriber_group` DISABLE KEYS */;
/*!40000 ALTER TABLE `newsletter_subscriber_group` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jury`
--

DROP TABLE IF EXISTS `jury`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jury` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `login` varchar(45) DEFAULT NULL,
  `pass` varchar(45) DEFAULT NULL,
  `lastAccess` datetime DEFAULT NULL,
  `lang` varchar(12) DEFAULT 'en',
  `active` tinyint(4) DEFAULT '1',
  `deleted` tinyint(4) DEFAULT '0',
  `ordering` int(11) DEFAULT NULL,
  `cIpAddress` varchar(45) DEFAULT NULL,
  `cTime` datetime DEFAULT NULL,
  `cUserId` int(11) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jury`
--

LOCK TABLES `jury` WRITE;
/*!40000 ALTER TABLE `jury` DISABLE KEYS */;
INSERT INTO `jury` VALUES (1,'jamil','jamil','202cb962ac59075b964b07152d234b70',NULL,'en',1,0,2,'127.0.0.1','2013-09-18 06:42:57',NULL,NULL),(2,'sad','asd',NULL,NULL,'en',1,0,2,'127.0.0.1','2013-09-18 06:49:41',NULL,'asd');
/*!40000 ALTER TABLE `jury` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `members`
--

DROP TABLE IF EXISTS `members`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `members` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `gender` varchar(100) NOT NULL,
  `birth` varchar(255) NOT NULL,
  `nationality` varchar(255) NOT NULL,
  `education` varchar(255) NOT NULL,
  `other_education` varchar(255) NOT NULL,
  `major` varchar(255) NOT NULL,
  `graduation_year` varchar(50) NOT NULL,
  `profectional_background` varchar(255) NOT NULL,
  `current_occupation` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `applicationId` int(11) NOT NULL,
  `active` tinyint(4) DEFAULT '1',
  `ordering` tinyint(4) DEFAULT NULL,
  `deleted` tinyint(4) DEFAULT '0',
  `cTime` timestamp NULL DEFAULT NULL,
  `cIpAddress` varchar(45) DEFAULT NULL,
  `cUserId` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_members_application1` (`applicationId`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `members`
--

LOCK TABLES `members` WRITE;
/*!40000 ALTER TABLE `members` DISABLE KEYS */;
INSERT INTO `members` VALUES (17,'jamil122xx','jamilff','female','12224','leb','phd','','majot','34','345','354eegdg','hadaf@aimstyle.com','343',6,1,NULL,0,NULL,NULL,NULL),(18,'bbbb','cxc','male','876876','hjghjg','Bachelor','','jj','6756','gfdgdf','fgfdhfdh','gfd@dasf.com','676',6,1,NULL,0,NULL,NULL,NULL),(19,'ghfh','fhfgh','female','56547','fhfgh','phd','','ghfg','5757','tutytruty','tuty','hfgh@ssfsd.com','757',6,0,NULL,0,'2013-09-19 17:39:50',NULL,NULL);
/*!40000 ALTER TABLE `members` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mail_queue`
--

DROP TABLE IF EXISTS `mail_queue`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mail_queue` (
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
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mail_queue`
--

LOCK TABLES `mail_queue` WRITE;
/*!40000 ALTER TABLE `mail_queue` DISABLE KEYS */;
/*!40000 ALTER TABLE `mail_queue` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mail_message`
--

DROP TABLE IF EXISTS `mail_message`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mail_message` (
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
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mail_message`
--

LOCK TABLES `mail_message` WRITE;
/*!40000 ALTER TABLE `mail_message` DISABLE KEYS */;
/*!40000 ALTER TABLE `mail_message` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `newsletter_group`
--

DROP TABLE IF EXISTS `newsletter_group`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `newsletter_group` (
  `id` smallint(6) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  `cTime` datetime NOT NULL,
  `cIpAddress` varchar(40) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `newsletter_group`
--

LOCK TABLES `newsletter_group` WRITE;
/*!40000 ALTER TABLE `newsletter_group` DISABLE KEYS */;
/*!40000 ALTER TABLE `newsletter_group` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `answers`
--

DROP TABLE IF EXISTS `answers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `answers` (
  `idanswers` int(11) NOT NULL AUTO_INCREMENT,
  `value` text,
  `questions_id` int(11) NOT NULL,
  `application_id` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`idanswers`),
  KEY `fk_answers_questions1` (`questions_id`),
  KEY `fk_answers_application1` (`application_id`),
  CONSTRAINT `fk_answers_application1` FOREIGN KEY (`application_id`) REFERENCES `application` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_answers_questions1` FOREIGN KEY (`questions_id`) REFERENCES `questions` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `answers`
--

LOCK TABLES `answers` WRITE;
/*!40000 ALTER TABLE `answers` DISABLE KEYS */;
INSERT INTO `answers` VALUES (1,'answer  of q1 app2',1,2);
/*!40000 ALTER TABLE `answers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jury_graded_answers`
--

DROP TABLE IF EXISTS `jury_graded_answers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jury_graded_answers` (
  `jury_id` int(11) NOT NULL,
  `answers_idanswers` int(11) NOT NULL,
  `grade` int(11) DEFAULT NULL,
  PRIMARY KEY (`jury_id`,`answers_idanswers`),
  KEY `fk_jury_has_answers_answers1` (`answers_idanswers`),
  KEY `fk_jury_has_answers_jury1` (`jury_id`),
  CONSTRAINT `fk_jury_has_answers_answers1` FOREIGN KEY (`answers_idanswers`) REFERENCES `answers` (`idanswers`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_jury_has_answers_jury1` FOREIGN KEY (`jury_id`) REFERENCES `jury` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jury_graded_answers`
--

LOCK TABLES `jury_graded_answers` WRITE;
/*!40000 ALTER TABLE `jury_graded_answers` DISABLE KEYS */;
/*!40000 ALTER TABLE `jury_graded_answers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jury_has_application`
--

DROP TABLE IF EXISTS `jury_has_application`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jury_has_application` (
  `jury_idjury` int(11) NOT NULL,
  `status` int(11) DEFAULT NULL,
  `grade` int(11) DEFAULT NULL,
  `submitedOn` datetime DEFAULT NULL,
  `decision` int(11) DEFAULT NULL,
  `application_id` bigint(20) DEFAULT NULL,
  `jury_has_applicationcol` varchar(45) NOT NULL,
  `comment` text,
  KEY `fk_jury_has_application_jury2` (`jury_idjury`),
  KEY `fk_jury_has_application_application1` (`application_id`),
  CONSTRAINT `fk_jury_has_application_application1` FOREIGN KEY (`application_id`) REFERENCES `application` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_jury_has_application_jury2` FOREIGN KEY (`jury_idjury`) REFERENCES `jury` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jury_has_application`
--

LOCK TABLES `jury_has_application` WRITE;
/*!40000 ALTER TABLE `jury_has_application` DISABLE KEYS */;
INSERT INTO `jury_has_application` VALUES (1,1,3,NULL,NULL,2,'',NULL),(1,1,NULL,NULL,NULL,3,'',NULL);
/*!40000 ALTER TABLE `jury_has_application` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `newsletter_history`
--

DROP TABLE IF EXISTS `newsletter_history`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `newsletter_history` (
  `id` mediumint(9) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `text` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `templateId` smallint(6) NOT NULL DEFAULT '0',
  `sendingTime` datetime NOT NULL,
  `cUserId` int(11) NOT NULL DEFAULT '0',
  `cTime` datetime NOT NULL,
  `cIpAddress` varchar(40) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `newsletter_history`
--

LOCK TABLES `newsletter_history` WRITE;
/*!40000 ALTER TABLE `newsletter_history` DISABLE KEYS */;
/*!40000 ALTER TABLE `newsletter_history` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `questions`
--

DROP TABLE IF EXISTS `questions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `questions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `qtitle_en` text,
  `qtitle_ar` text,
  `qtitle_fr` text,
  `types_idtypes` int(11) NOT NULL,
  `grade` int(11) DEFAULT '0',
  `active` tinyint(4) DEFAULT '1',
  `ordering` tinyint(4) DEFAULT NULL,
  `deleted` tinyint(4) DEFAULT '0',
  `cTime` timestamp NULL DEFAULT NULL,
  `cIpAddress` varchar(45) DEFAULT NULL,
  `cUserId` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_questions_types2` (`types_idtypes`),
  CONSTRAINT `fk_questions_types2` FOREIGN KEY (`types_idtypes`) REFERENCES `types` (`idtypes`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `questions`
--

LOCK TABLES `questions` WRITE;
/*!40000 ALTER TABLE `questions` DISABLE KEYS */;
INSERT INTO `questions` VALUES (1,'What is the added value of each team member of the Management Team? (Please make sure to mention the role of all team members)  \r\n\r\n	 \r\n		','ما هي القيمة المضافة لكل عضو في الفريق الاداري ؟ \r\nيجب الإشارة إلى دور جميع أعضاء الفريق','Quelle sera la valeur ajoutée de chaque membre de l’équipe? (N’oubliez pas de mentionner le rôle de tous les membres de l’équipe)\r\n',1,5,1,1,0,'2013-09-04 23:07:22',NULL,1),(2,'What is the name of your existing startup/company?  \r\n	\r\n','\r\nما هو إسم شركتك؟','	 \r\nQuel est le nom de votre entreprise? \r\n',1,0,1,2,0,'2013-09-04 23:07:35',NULL,NULL),(5,'sd','ds','ds',2,5,1,2,0,NULL,NULL,NULL);
/*!40000 ALTER TABLE `questions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `article`
--

DROP TABLE IF EXISTS `article`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `article` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  `img` varchar(255) DEFAULT NULL,
  `active` tinyint(4) DEFAULT '1',
  `ordering` tinyint(4) DEFAULT NULL,
  `deleted` tinyint(4) DEFAULT '0',
  `cTime` timestamp NULL DEFAULT NULL,
  `cIpAddress` varchar(45) DEFAULT NULL,
  `cUserId` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `article`
--

LOCK TABLES `article` WRITE;
/*!40000 ALTER TABLE `article` DISABLE KEYS */;
INSERT INTO `article` VALUES (1,'test','sdadsad','fbcove137947969440.jpg',1,1,0,'2013-09-18 04:48:14','127.0.0.1',NULL);
/*!40000 ALTER TABLE `article` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `industrysections`
--

DROP TABLE IF EXISTS `industrysections`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `industrysections` (
  `idindustrySections` int(11) NOT NULL COMMENT 'Under which industry does your business fall? 	\nتحت أي قطاع تقع شركتك؟\nA quelle industrie appartient votre projet?\n',
  `option_en` text,
  `option_ar` text,
  `option_fr` text,
  PRIMARY KEY (`idindustrySections`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `industrysections`
--

LOCK TABLES `industrysections` WRITE;
/*!40000 ALTER TABLE `industrysections` DISABLE KEYS */;
/*!40000 ALTER TABLE `industrysections` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pages`
--

DROP TABLE IF EXISTS `pages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `alias` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `content` text CHARACTER SET utf8 COLLATE utf8_bin,
  `meta_keywordds` tinytext CHARACTER SET utf8 COLLATE utf8_bin,
  `meta_description` tinytext CHARACTER SET utf8 COLLATE utf8_bin,
  `cTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `cIpAddress` varchar(255) NOT NULL,
  `cUserId` int(11) DEFAULT NULL,
  `lang` varchar(12) NOT NULL,
  `parentId` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=40 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pages`
--

LOCK TABLES `pages` WRITE;
/*!40000 ALTER TABLE `pages` DISABLE KEYS */;
INSERT INTO `pages` VALUES (1,'forum','MIT Enterprise Forum of the Pan Arab Region','                <div class=\"SubTitle\">MIT Enterprise Forum of the Pan Arab Region</div>\r\n                <div class=\"Title\">The MIT Enterprise Forum of the Pan Arab Region</div>\r\n                <div>Launched in Beirut in 2005, where a strong and active alumni community is concentrated, the MIT Enterprise Forum of the Pan Arab Region (Lebanon) is one of the 28 worldwide chapters of the MIT Enterprise Forum, global office. Though it is headquartered in Lebanon, the Pan Arab Region chapter serves the Middle East, North Africa and the Gulf.<br>\r\n                  <br>\r\n                  The MIT Enterprise Forum- Pan Arab has a proven record in promoting MIT-style entrepreneurship by organizing each year the MIT Enterprise Forum Arab Startup Competition www.mitarabcompetition.com, in partnership with Abdul Latif Jameel Community Initiatives, targeting 21 countries of the Arab region and bringing in more than 4,000 applications a year. The competition has trained over 900 entrepreneurs and has helped start more than 200 knowledge-based and technology-driven companies in Yemen, Jordan, Lebanon, Saudi Arabia, UAE, Tunisia and others. Other activities of the Forum include the recognition of top innovators in the region in partnership with MIT’s Technology Review, and the collaboration with the Kauffman Foundation to host locally Global Entrepreneurship Week\r\n\r\n					The MIT Enterprise Forum of the Pan Arab Region’s vision is to develop and nurture a culture of entrepreneurship across the Arab region, in view of becoming the most influential entrepreneurial network in the Arab world. This is done through building a platform for networking, knowledge sharing, showcasing, coaching and mentorship for entrepreneurs.\r\n				<br>\r\n                  <br>\r\n                </div>\r\n                <div class=\"Title\">Activities</div>\r\n                <div>Since its inception, the MIT Enterprise Forum of the Pan Arab Region:\r\n                  <ul class=\"Listing\">\r\n                    <li> Organizes the MIT Enterprise Forum Arab Startup Competition in partnership with Abdul Latif Jameel Community Initiatives, targeting 21 Arab countries and bringing in more than 4,000 applications every year. </li>\r\n                    <li> Has been providing networking opportunities to entrepreneurs to learn and hone their skills as well as establishing networking connections with other entities who share our passion for entrepreneurship.\r\n                      The networking activities are fostered through three key events:\r\n                      <ul class=\"Sublisting\">\r\n                        <li> a. Launching ceremony</li>\r\n                        <li> b. Entrepreneurship Workshop</li>\r\n                        <li> c. Final Award Ceremony</li>\r\n                      </ul>\r\n                      In view of ensuring a regional outreach, the MIT Enterprise Forum of the Pan Arab Region reaches out to three Arab countries each year. So far, these networking events have taken place in: Lebanon, KSA, UAE, Jordan, Egypt and tonisia. <br>\r\n                      Usually those events are attended by entrepreneurs, high-profile business people, angel investors, venture capitalists, financiers and other key players. </li>\r\n                    <li> Organized a “Dean’s Roundtable” on “Entrepreneurship Development: Trends and Prospects in the Arab Region”, targeting Deans of Business Schools in the Arab countries. The aim of the Roundtable is to generate a discussion on the state of entrepreneurship in the region, and how to improve the entrepreneurial ecosystem. </li>\r\n                  </ul>\r\n                </div>\r\n                <br>\r\n                <br>\r\n                <div class=\"Title\">Members of the Board</div>\r\n                <div>The MIT Enterprise Forum of the Pan Arab Region involves a Board whose members volunteer their time and services to promote entrepreneurship in the Arab region.</div>\r\n                 <ul class=\"Listing\">\r\n                    <li><b>Chair:</b> Hala Fadel</li>\r\n                    <li><b>Vice Chair:</b> Maha Yahya</li>\r\n                    <li><b>Secretary-General:</b> Salam Yamout</li>\r\n                    <li><b>Treasurer:</b> Ziad Younes</li>\r\n                    <li><b>Accountant:</b> Ziad Oueslati</li>\r\n                  </ul>\r\n				  <div>\r\n                  <br>\r\n                  <div><u><b>Hala FADEL</b></u></div>\r\n                  <br>\r\n				  <img src=\"images/hala.jpg\" class=\"imagey\">\r\n                  <div>Hala is chair of the MIT Enterprise Forum of the Pan-Arab region and has laid the efforts to organize the MIT Arab Business Plan competition, which is now in its fourth year. She is also a European Equity Fund Manager at Comgest. The Comgest group was created in 1986 and is based in Paris, Hong Kong, and Dublin. The Group has $13bn under management, all run for institutions under the form of segregated accounts or public mutual funds. Comgest is characterized by a tried and tested management style, focused exclusively on the investment in a limited number of quality growth listed companies.<br>\r\n                    <br>\r\n                    Prior to joining Comgest, Hala was an analyst and associate in mergers and acquisitions at Merrill Lynch in London.<br>\r\n                    <br>\r\n                    Hala has a Bachelor degree from HEC and holds an MBA from the MIT Sloan School of Management. At MIT, she participated in and was among the winners of the MIT &nbsp; &nbsp;$100K Business Plan Competition, following which she started a telecom software company in the Cambridge area, which she eventually sold.</div>\r\n                  <br>\r\n                  <div><u><b>Maha YAHYA</b></u></div>\r\n                  <br>\r\n				  <img src=\"images/maha.jpg\" class=\"imagey\">\r\n                  <div>A socio-urban specialist with two Ph.D’s in the social sciences and humanities and around 17 years of academic and professional experience.<br>\r\n                    <br>\r\n                    Prior to joining ESCWA, Maha worked as the director and principle author of the 2008 National Human Development Report at UNDP entitled Toward a Citizen’s State. She is also the founder and editor of the MIT Electronic Journal of Middle East Studies (MIT-EJMES). In addition to this, she worked as consultant on a rich variety of issues such as region wide social policy analysis, socio-urban evaluations, cultural heritage, poverty reduction, housing and community development, and post-conflict reconstruction in various countries including Lebanon, Pakistan, Saudi Arabia and Iran.<br>\r\n                    <br>\r\n                    Maha is a board member of several organizations including LCPS and is the author of Towards Integrated Social Development Policies in ESCWA Countries: A Conceptual Analysis (ESCWA) and the co-editor of Secular Publicities: Visual practices and the transformation of national publics in the Middle East and South Asia (University of Michigan, 2009). </div>\r\n                  <br>\r\n                  <div><u><b>Salam YAMOUT</b></u></div>\r\n				  <img src=\"images/salam.jpg\" class=\"imagey\">\r\n                  <br>\r\n                  <div>Holder of a M.S. in Electrical and Computer Engineering from the University of Arizona in 1987 and an MBA from the Ecole Supérieure des Affaires (ESA) in 2005, Salam started her career in the USA. Between 2000 and 2005, she consulted in Lebanon with both the private sector, public sector, and International Organizations on key national projects such as the National e-Commerce Project, National e-Strategy project, National ICT Standards project, national committee for follow up on WSIS.\r\n<br> <br>\r\nIn 2004, she joined Cisco Systems where she held the role of Program Manager for CSR. In 2010, she joined the Presidency of the Council of Ministers to become the National ICT Strategy Coordinator.\r\n<br> <br>\r\nSalam is the current Secretary-General of the MIT Enterprise Forum of the Pan Arab Region.  A social entrepreneur at heart, Salam co-founded several NGOs such as Women in IT, Lebanese Broadband Stakeholders Group, and the Lebanon Chapter of the Internet Society.  \r\n                    <br>\r\n				</div>\r\n                  <br>\r\n                  <div><u><b>Ziad YOUNES</b></u></div>\r\n				  <img src=\"images/ziady.jpg\" class=\"imagey\">\r\n                  <br>\r\n                  <div>Ziad is Deputy General Manager at Butec, a leading Lebanese and regional contracting company where he had actively participated in its internal restructuring and international development.<br>\r\n                    <br>\r\n                    Prior to joining Butec, Ziad had successfully launched two Lebanese SMEs,: BPM in the field of property management and Fermes St. Jacques in the agro-industry. Ziad has lectured for 3 years at the USJ University on Game Theory and its applications in Economics. <br>\r\n                    <br>\r\n                    Ziad holds an Engineering degree from Ecole Polytechnique in Paris, a DEA in Industrial Organization from the University of Paris IX - Dauphine, and a Master of Science in Technology and Policy from MIT.<br>\r\n                    <br>\r\n                    Ziad is the current Treasurer of the MIT Enterprise Forum for the Pan Arab Region (Lebanon).</div>\r\n                  <br>\r\n                  <div><u><b>Ziad OUESLATI</b></u></div>\r\n				  	  <img src=\"images/ziado.jpg\" class=\"imagey\">\r\n                  <br>\r\n                  <div>Ziad is a founding Partner of Tuninvest the first private equity fund management company in the Maghreb and one of the leading players in Sub-Saharan Africa through its affiliate AfricInvest.<br>\r\n                    <br>\r\n                    Ziad participated to the structuring and raising of several investment funds targeting the Maghreb and Sub-Saharan Africa totaling about US$ 500 million. He is a board member of several North African and sub-Saharan companies. He has structured a number of investments in Africa in several industrial and service sectors. He has also conducted on behalf of European financial institutions financial and strategic advisory work in the African continent.<br>\r\n                    <br>\r\n                    Between 1990 and 1994, Ziad was head of the Financial Institutions and Capital Markets Department at Citibank, Tunis. He is a graduate of the engineering college, Ecole Nationale Supérieure des Mines de Paris in Paris, France and holds a Master of Sciences in Technology and Policy from the Massachusetts Institute of Technology, Cambridge, MA, U.S. Mr. Oueslati is a founding member of the Tunisian and African Venture Capital Associations. He is also an Educational Counselor for undergraduates’ recruitment at MIT.</div>\r\n					<br>\r\n					\r\n					<br><br>\r\n					<div>\r\n					The MIT Enterprise Forum- Pan Arab team can be reached at:\r\n					<br><a href=\"mailto:info@mitarabcomeptition.com\">info@mitarabcomeptition.com</a>\r\n					<br>+961.1.612.500 ext. 5154; 5156\r\n<br>\r\n<br>\r\n</div>\r\n					\r\n					\r\n					\r\n	<!-- 		\r\n                </div><div class=\"Title\">Excutive Team</div>\r\n				<div>\r\n                \r\n\r\n				 \r\n<ul class=\"Listing\">\r\n                    <li><b>Program Manager:</b> Joelle Yazbeck</li>\r\n                    <li><b>Project Manager:</b> Sahar El Zaloua</li>\r\n                    <li><b>Project Coordinator:</b> Catherina Ballout</li>\r\n                    <li><b>Public Relations Manager:</b> Mira Adra </li>\r\n </ul>\r\n\r\n<br />\r\n<br />\r\n<div><u><b> Joelle YAZBECK </b></u></div>\r\n	<img src=\"images/Joelle.png\" class=\"imagey\"  width=\"90\"/>\r\n    <br/>\r\n    <div> Joelle is the Program Manager of the MIT Enterprise Forum – Pan Arab Region <br />\r\n    <a href=\"mailto:joelle@mitarabcompetition.com\">joelle@mitarabcompetition.com</a>\r\n    </div>\r\n    <br/>\r\n	\r\n    <div class=\"Clear\">&nbsp;</div>\r\n    \r\n    \r\n    <div><u><b> Sahar EL ZALOUA </b></u></div>\r\n    <img src=\"images/Sahar.png\" class=\"imagey\" width=\"90\" />\r\n    <br />\r\n    <div> Sahar  is the Project Manager  of the MIT Enterprise Forum – Pan Arab Region <br />\r\n    <a href=\"mailto:sahar@mitarabcompetition.com\">sahar@mitarabcompetition.com</a>\r\n    </div> <br/>\r\n\r\n     <div class=\"Clear\">&nbsp;</div>\r\n     \r\n     <div><u><b>Catherina BALLOUT</b></u></div>	\r\n     <img src=\"images/Catherina.png\" class=\"imagey\" width=\"90\" />\r\n     <br />\r\n     \r\n     <div> Catherina is the Project Coordinator  of the MIT Enterprise Forum – Pan Arab Region  <br />\r\n     <a href=\"mailto:catherina@mitarabcompetition.com\">catherina@mitarabcompetition.com</a>\r\n     </div><br />\r\n     \r\n     <div class=\"Clear\">&nbsp;</div>\r\n     \r\n     <div><u><b>Mira ADRA </b></u></div>	\r\n     <img src=\"images/Mira.png\" class=\"imagey\" width=\"90\" />\r\n     <br />\r\n     \r\n     <div> Mira is the Public Relations Manager of the MIT Enterprise Forum – Pan Arab Region <br />\r\n     <a href=\"mailto:mira@mitarabcompetition.com\">mira@mitarabcompetition.com</a>\r\n     </div>\r\n				\r\n				</div>\r\n				\r\n				\r\n				\r\n				-->\r\n				\r\n				\r\n				\r\n				\r\n              </div>\r\n\r\n            ','','','2013-10-21 02:53:25','127.0.0.1',0,'en',0),(2,'about','About the Competition','<div id=\"PageContent\">\r\n                              <div class=\"Title\"> The MIT Enterprise Forum Arab Startup Competition is done in partnership with Abdul Latif Jameel Community Initiatives </div>\r\n              This year\'s Competition follow a different format differentiating between entrepreneurs who have \r\n              <font color=\"#960027\">ideas</font> and those who own <font color=\"#960027\">startups</font>, hence the creation of 2 tracks \r\n              <br><br>\r\n              <ul class=\"Arrow\">\r\n              	<li><strong>	First Track:</strong> <font color=\"#960027\">Ideas</font> - For entrepreneurs with just ideas looking to take them to the next level </li>\r\n              	<li><strong>Startups+ </strong>- For <font color=\"#960027\">startups</font> with a product being sold and established businesses seeking growth</li>\r\n              </ul>\r\n              <br>\r\n              <br>\r\n             <div class=\"Title\">Eligibility Criteria for the Ideas track</div>\r\n              <ul class=\"Arrow\">\r\n            		<li>You can apply as an individual or part of a team provided that at least one member is an Arab national</li>\r\n								<li>	The business idea should be implemented in one of the Arab world countries </li>\r\n								<li>	Your idea can be in any sector (Creative industries, Construction/Engineering/ Education/ Environment/Food and Agro Business/Health and Healthcare/Entertainment/ICT/Services, etc.)</li>\r\n								<li><strong>No revenue generation; no prototype or prototype ready but never sold</strong></li>\r\n							</ul>\r\n							\r\n              <br>\r\n              <br>\r\n             <div class=\"Title\">Eligibility Criteria for the Startups+ track</div>\r\n              <ul class=\"Arrow\">\r\n            		<li>At least three team members (at least one of the members should be Arab national)</li>\r\n\r\n            		<li>The startup should be registered in one of the Arab world countries </li>\r\n\r\n            		<li>Your idea can be in any sector (Creative industries, Construction/Engineering/ Education/ Environment/Food and Agro Business/Health and Healthcare/Entertainment/ICT/Services, etc.)</li>\r\n\r\n            		<li><strong>Revenue generation; product being sold</strong></li> \r\n							</ul>\r\n							\r\n							<br><br>\r\n							<div class=\"Title\">The new Rolling Application System </div>\r\n              <ul class=\"Arrow\">\r\n								<li>	Website opens on October 9th and closes by the time the 50 semi-finalist teams are selected</li>\r\n								<li>	You are strongly encouraged to apply REAL EARLY to make the most out of the rolling process</li>\r\n								<li>	<strong>A higher chance to get selected if you apply early</strong></li> \r\n             </ul> \r\n             \r\n								<ul class=\"Listing\">\r\n									<li style=\"margin-left:50px;\">	We are looking for a total of 50 finalists for both tracks, so these slots get filled up quickly as we judge and qualify applicants especially that the judges evaluate applications as they come in, instead of waiting to review all applications concurrently</li>\r\n									<li style=\"margin-left:50px;\">		<strong>A Second Chance to Apply:</strong> With a rolling process, applications will be reviewed as soon as they are submitted. You are likely to hear back from us within 3 weeks (instead of the usual 3 months from previous years), giving you another chance to adjust your entries and reapply.</li>\r\n								</ul>\r\n             \r\n							<br><br>\r\n							<div class=\"Title\">\r\n             Selection Criteria</div>\r\n             \r\n              <ul class=\"Arrow\">\r\n								<li>		Innovation: Creativity and improvement of existing solutions and/or business processes with respect to current competitors or comparables. Within this definition, innovation does not necessarily mean technology.</li>\r\n								<li>	Scalability : A business idea should not be limited to a local market. At a minimum, a nationwide market should be targeted. Preferably, the business could easily be replicated regionally or globally as the company expands.</li>\r\n								<li>	Impact: This innovative business idea has the potential to become a landmark company in the region and make an impact on the region\'s economy or perceived competitiveness.</li>\r\n							</ul>\r\n							<br><br>\r\n							<div class=\"Title\">Grading Round 1</div> \r\n              <ul class=\"Arrow\">\r\n								<li>Judges evaluate applications as they come in</li>\r\n								<li>Each application will be reviewed by 3 judges based on innovation, scalability, and positive social impact. Applications receiving an average grade above 70/100 shall qualify to the next round</li>\r\n								</ul>\r\n\r\n								Semi-finalists will be automatically assigned a local coach to work closely with them in view of achieving the deliverables set for each track prior to attending the two-day training\r\n              \r\n							<br><br><br>\r\n              <div class=\"Title\">Deliverables for the Ideas Track </div>\r\n              <ul class=\"Arrow\">\r\n								<li>Developing a working prototype </li>\r\n								<li>Securing at least one client  </li>\r\n								<li>Forming a team and selecting board of advisors  </li>\r\n								<li>Submitting an executive summary  </li>\r\n								</ul>\r\n	<br><br>\r\n              <div class=\"Title\">Deliverables for the Startups+ Track </div>\r\n              <ul class=\"Arrow\">\r\n								<li>All of the above, plus </li>\r\n								<li>Submitting a 10-15 page business plan  </li>\r\n								<li>Getting ready to pitch for VCs </li>\r\n								</ul>\r\n\r\n							<br><br>\r\n\r\n              <div class=\"Title\">Workshop in Doha: April  23rd &amp; 24th, 2013  </div>\r\n              <br>\r\nFollowing ~4 months of preparations and working toward achieving common deliverables, the semi-finalists will sit for a two-day training covering topics such as business planning, sales, finance, marketing, elevator pitching, presentation skills, etc… \r\n\r\n							<br><br><br>\r\n              <div class=\"Title\">The 10 Finalists</div>\r\n\r\n              <ul class=\"Arrow\">\r\n								<li>At the workshop, round 2 judges will choose out 10 finalists teams out of the 50 and qualify them for the  final round of oral presentations </li>\r\n								<li>Entrepreneurs also get to rehearse their final pitches with consultants from Booz &amp; Co.  </li>\r\n								</ul>\r\n\r\n							<br><br>\r\n              <div class=\"Title\">Final  Round Oral Presentations: April 25 th, 2013</div>\r\n              <br>\r\nOn day 3 of the workshop, the participants from the ideas and startups tracks will have to pitch in front of a judging panel. Names of Final Jury will be announced in due time.\r\n \r\n\r\n							<br><br><br>\r\n              <div class=\"Title\">Prize Money</div><br>\r\n              Prize Money\r\n\r\nFour winning teams are then announced during a Final Award Ceremony on April 25 th, 2013\r\n \r\n              \r\n              \r\n            </div>',NULL,NULL,'2013-10-21 02:53:32','127.0.0.1',0,'en',0),(38,'Testimonials','Testimonials','<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &lt;ul class=\"Arrow\"&gt;<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &lt;li&gt;<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &lt;div&gt;“We are very lucky to participate in the Competition and to learn from the professionalism of the organizers, the wisdom of the jurors, and the talent of the other teams that were competing with us.”&lt;/div&gt;<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &lt;div class=\"Title\" align=\"right\"&gt;&lt;i&gt;Cherif Mostafa – PT Screen, Egypt&lt;/i&gt;&lt;/div&gt;<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &lt;div class=\"GreyText\" align=\"right\"&gt;&lt;i&gt;Winner of the MIT ABPC 10- 11&lt;/i&gt;&lt;/div&gt;<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &lt;/li&gt;<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &lt;li&gt;<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &lt;div&gt;“ Our mission is to benefit the Arabic user by taking the challenge to provide him/her with multiple applications that understand and interact with the Arabic language, in order to simplify the way the user interacts with Arabic electronic content.”&lt;/div&gt;<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &lt;div class=\"Title\" align=\"right\"&gt;&lt;i&gt;Houssam El Mahgoub – AlKhawarizmy Language Software, Egypt&lt;/i&gt;&lt;/div&gt;<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &lt;div class=\"GreyText\" align=\"right\"&gt;&lt;i&gt;1 &lt;sup&gt;st&lt;/sup&gt; Runner – up of the MIT ABPC 10- 11&lt;/i&gt;&lt;/div&gt;<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &lt;/li&gt;<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &lt;li&gt;<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &lt;div&gt;“It was a great experience for&amp;nbsp;us&amp;nbsp;to go through the competition phases and be one of the winning teams. That gave us confidence in our business plan and encouragement to turn our idea into a successful business.”&lt;/div&gt;<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &lt;div class=\"Title\" align=\"right\"&gt;&lt;i&gt;Rasha Ahmed – iNavigator, Egypt&lt;/i&gt;&lt;/div&gt;<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &lt;div class=\"GreyText\" align=\"right\"&gt;&lt;i&gt;2 &lt;sup&gt;st&lt;/sup&gt; Runner – up of the MIT ABPC 10- 11&lt;/i&gt;&lt;/div&gt;<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &lt;/li&gt;<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &lt;li&gt;<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &lt;div&gt;“Currently, two products are being developed: a non-invasive (bloodless) glucose monitoring device and intelligent mobile-based system for diabetes management.”&lt;/div&gt;<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &lt;div class=\"Title\" align=\"right\"&gt;&lt;i&gt;Mashhour Bani Amer – Diabetes Healthcare, Egypt&lt;/i&gt;&lt;/div&gt;<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &lt;div class=\"GreyText\" align=\"right\"&gt;&lt;i&gt;2 &lt;sup&gt;st,&lt;/sup&gt; Runner – up of the MIT ABPC 10- 11&lt;/i&gt;&lt;/div&gt;<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &lt;/li&gt;<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &lt;li&gt;<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &lt;div&gt;“It is one of the best Workshops I ever attended, It really gave me lots of new knowledge areas needed to know about, and overall, it exceeded my expectations I would like to thank all the MIT Enterprise Forum organizing team members, you were just amazing, you gave us support and knowledge that we will never forget, Thanks a million”&lt;/div&gt;<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &lt;div class=\"Title\" align=\"right\"&gt;&lt;i&gt;Ahmed Mostafa Ali – BasharSoft, Egypt&lt;/i&gt;&lt;/div&gt;<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &lt;div class=\"GreyText\" align=\"right\"&gt;&lt;i&gt;Semi - Finalist of the MIT ABPC ’10-11&lt;/i&gt;&lt;/div&gt;<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &lt;/li&gt;<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &lt;li&gt;<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &lt;div&gt;“Excellent, a learning experience that is worth every single moment. Excellent organization and excellent choice of speakers/coaches; I commend the organizers strongly”&lt;/div&gt;<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &lt;div class=\"Title\" align=\"right\"&gt;&lt;i&gt;Ziad Sankari - Cardio Diagnostics, Lebanon&lt;/i&gt;&lt;/div&gt;<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &lt;div class=\"GreyText\" align=\"right\"&gt;&lt;i&gt;Semi - Finalist of the MIT ABPC ’10-11&lt;/i&gt;&lt;/div&gt;<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &lt;/li&gt;<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &lt;li&gt;<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &lt;div&gt;“The programme surpassed my expectations. The overall structure was well thought through and at the end you felt the cohesiveness throughout the programme. Ken Morse, Tarek Kettaneh, David Standen, Mohammad Khawaja and the rest of the contributors were paradigm shifters for me. They managed to share a vast amount of knowledge and experience to the group in a clear and incisive manner. You left their sessions rearing to go. The MIT Enterprise Forum team of organisers were great and they went the extra mile to make it all happen. I can\'t emphasise this enough... Everything flowed seemlessly and when there were challenges they were flexible enough to take it in their stride. Personally I felt very priveladged to be selected to the programme, but as the programme unravelled that feeling increased especially that because of the high calibre of candidates I met there. I genuinly will feel happy to see any of the semi-finalists going to the top 3. My best wishes for future programmes. The region looks exciting from here.”&lt;/div&gt;<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &lt;div class=\"Title\" align=\"right\"&gt;&lt;i&gt;Mohammad Shaheen - Engage Educational Resources, Egypt&lt;/i&gt;&lt;/div&gt;<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &lt;div class=\"GreyText\" align=\"right\"&gt;&lt;i&gt;Semi - Finalist of the MIT ABPC ’10-11&lt;/i&gt;&lt;/div&gt;<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &lt;/li&gt;<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &lt;li&gt;<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &lt;div&gt;“The workshop was eye opening to us in terms of what is needed to bring an idea to life. A combination of friendly people, excellent mentors, fantastic teams, prompt communications and great connections added value to the workshop. As a project, it exceeded my expectations and was a success. Thank you.”&lt;/div&gt;<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &lt;div class=\"Title\" align=\"right\"&gt;&lt;i&gt;Zaid Tuffaha – TalebTech, Jordan&lt;/i&gt;&lt;/div&gt;<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &lt;div class=\"GreyText\" align=\"right\"&gt;&lt;i&gt;Semi - Finalist of the MIT ABPC ’10-11&lt;/i&gt;&lt;/div&gt;<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &lt;/li&gt;<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &lt;li&gt;<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &lt;div&gt;“This is the best place to go and apply to, even if you don’t win; this is because you practice and you gain experience. It is professional and protects the privacy of your business plan.”&lt;br&gt;<br>“The rehearsal was a huge added value to my experience, and Booz &amp;amp; Co. guided me on how to better answer questions..”&lt;/div&gt;<br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &lt;div class=\"Title\" align=\"right\"&gt;&lt;i&gt;Rana Shmaitelly- The Little Engineer, Lebanon&lt;/i&gt;&lt;/div&gt;<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &lt;div class=\"GreyText\" align=\"right\"&gt;&lt;i&gt;First Winner of the MIT ABPC ’09 -10 &lt;/i&gt;&lt;/div&gt;<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &lt;/li&gt;<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &lt;li&gt;<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &lt;div&gt;“There were two clear-cut ways the Competition helped in: first, it helped with PR, and second, it helped with providing finances.”&lt;/div&gt;<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &lt;div class=\"Title\" align=\"right\"&gt;&lt;i&gt;Husain Al-Mohssen- Syphir, KSA&lt;/i&gt;&lt;/div&gt;<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &lt;div class=\"GreyText\" align=\"right\"&gt;&lt;i&gt;First Winner of the MIT ABPC ’08–09&lt;/i&gt;&lt;/div&gt;<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &lt;/li&gt;<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &lt;li&gt;<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &lt;div&gt;“We were able to take what we learned from the MIT Arab Business Plan Competition to apply it towards another competition in the U.S. We were the winners of Startup Weekend San Francisco.”&lt;/div&gt;<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &lt;div class=\"Title\" align=\"right\"&gt;&lt;i&gt;AbdulAziz Ahmed Al-Sulaim- EnglEasy, KSA&lt;/i&gt;&lt;/div&gt;<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &lt;div class=\"GreyText\" align=\"right\"&gt;&lt;i&gt;Semi-Finalist of the MIT ABPC ’08-09&lt;/i&gt;&lt;/div&gt;<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &lt;/li&gt;<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &lt;li&gt;<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &lt;div&gt;“We were amazed by the brain power that was in the Competition.”&lt;/div&gt;<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &lt;div class=\"Title\" align=\"right\"&gt;&lt;i&gt;Aiman Said- 3eesho, KSA&lt;/i&gt;&lt;/div&gt;<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &lt;div class=\"GreyText\" align=\"right\"&gt;&lt;i&gt;Semi-Finalist of the MIT ABPC ’08 –09&lt;/i&gt;&lt;/div&gt;<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &lt;/li&gt;<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &lt;li&gt;<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &lt;div&gt;“The Competition gives you confidence, and since selling is about confidence, it helped in that sense. In addition, the Competition gave us good affirmation.”&lt;/div&gt;<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &lt;div class=\"Title\" align=\"right\"&gt;&lt;i&gt;Jonathan Giesen- Transterra Media, Egypt&lt;/i&gt;&lt;/div&gt;<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &lt;div class=\"GreyText\" align=\"right\"&gt;&lt;i&gt;Semi –Finalist of the MIT ABPC ’08-09&lt;/i&gt;&lt;/div&gt;<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &lt;/li&gt;<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &lt;li&gt;<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &lt;div&gt;“Going through the process of creating a concept helped me a lot and gave me the motivation to go ahead and start something.”&lt;/div&gt;<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &lt;div class=\"Title\" align=\"right\"&gt;&lt;i&gt;Ralph Khairallah- 365, Lebanon&lt;/i&gt;&lt;/div&gt;<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &lt;div class=\"GreyText\" align=\"right\"&gt;&lt;i&gt;Finalist of the MIT ABPC ’07-08&lt;/i&gt;&lt;/div&gt;<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &lt;/li&gt;<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &lt;li&gt;<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &lt;div&gt;“It was a chance to participate with entrepreneurs from across the region, and it was great exposure. The name MIT itself helps to get investors.”&lt;/div&gt;<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &lt;div class=\"Title\" align=\"right\"&gt;&lt;i&gt;Nazih Moufarrej- Business Experts, Lebanon&lt;/i&gt;&lt;/div&gt;<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &lt;div class=\"GreyText\" align=\"right\"&gt;&lt;i&gt;Semi-Finalist of the MIT ABPC ’07-08&lt;/i&gt;&lt;/div&gt;<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &lt;/li&gt;<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &lt;li&gt;<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &lt;div&gt;“We met some important people and got a lot of information about establishing a company and how we can differentiate ourselves. It helped improve our strategy.”&lt;/div&gt;<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &lt;div class=\"Title\" align=\"right\"&gt;&lt;i&gt;Ibrahim Qadada- DAR.ME, KSA&lt;/i&gt;&lt;/div&gt;<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &lt;div class=\"GreyText\" align=\"right\"&gt;&lt;i&gt;Semi-Finalist of the MIT ABPC ’07-08 &lt;/i&gt;&lt;/div&gt;<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &lt;/li&gt;<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &lt;li&gt;<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &lt;div&gt;“It was invaluable in giving us inspiration and information we needed. We were an aspiring startup, and even though we did not progress beyond the top 30, it was a unique experience. The networking events also allowed us to meet many new interesting people and inspired us to go ahead.”&lt;/div&gt;<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &lt;div class=\"Title\" align=\"right\"&gt;&lt;i&gt;Elie Waked – Alloyant, UAE&lt;/i&gt;&lt;/div&gt;<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &lt;div class=\"GreyText\" align=\"right\"&gt;&lt;i&gt;Semi- Finalist of the MIT ABPC ’07-08&lt;/i&gt;&lt;/div&gt;<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &lt;/li&gt;<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &lt;/ul&gt;<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <br>','','','2013-09-18 01:51:41','127.0.0.1',NULL,'en',0),(39,'tracks','MIT Tracks','<b>Add all info here<br></b>','','','2013-10-21 02:57:26','127.0.0.1',NULL,'en',0);
/*!40000 ALTER TABLE `pages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `types`
--

DROP TABLE IF EXISTS `types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `types` (
  `idtypes` int(11) NOT NULL,
  `display` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idtypes`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `types`
--

LOCK TABLES `types` WRITE;
/*!40000 ALTER TABLE `types` DISABLE KEYS */;
INSERT INTO `types` VALUES (1,'Idea'),(2,'Startup'),(3,'Growth');
/*!40000 ALTER TABLE `types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `password` char(40) NOT NULL,
  `email` varchar(255) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `learn` varchar(255) NOT NULL,
  `lang` varchar(100) NOT NULL,
  `applicationId` int(11) NOT NULL,
  `active` tinyint(4) DEFAULT '1',
  `deleted` tinyint(4) DEFAULT '0',
  `lastAccess` datetime DEFAULT NULL,
  PRIMARY KEY (`uid`),
  UNIQUE KEY `username` (`username`),
  KEY `fk_users_application1` (`applicationId`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'ahmad','010300ed4af61c9b98a0ce35f9284df91110a73c','','','','','','',0,1,0,NULL),(2,'admin1','010300ed4af61c9b98a0ce35f9284df91110a73c','dev.ahmadrahhal@gmail.com','sas','dsvdv','Lebanon','','fr',0,1,0,NULL),(3,'admin3','d8afc6d610a6424ff9c473762b2e22f1275f966b','dev.ahmadrahhal2@gmail.com','sas2','dsvdv2','Lebanon','','fr',0,1,0,NULL),(4,'admin4','9d5c1a2f83c2a618e189190d110be684fdc2178f','dev.ahmadrahhal24@gmail.com','sas2','dsvdv2','Lebanon','','en',3,1,0,NULL),(5,'admin','010300ed4af61c9b98a0ce35f9284df91110a73c','irahal@wise.net.lb','ahmad','raham','Lebanon','','fr',4,1,0,NULL),(6,'admin123','9d5c1a2f83c2a618e189190d110be684fdc2178f','dev.ahmadrahhal21@gmail.com','asd','axc','Morocco','','ar',5,1,0,NULL),(8,'jamil123','9123ee68e2227d5a2b0a1aa9b43b7268af79696d','dev.ahml@hotmail.com','jamil','abdulla','Lebanon','1','fr',6,1,0,NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `newsletter_history_group`
--

DROP TABLE IF EXISTS `newsletter_history_group`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `newsletter_history_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `newsletterId` mediumint(9) NOT NULL,
  `groupId` smallint(6) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `newsletter_history_group`
--

LOCK TABLES `newsletter_history_group` WRITE;
/*!40000 ALTER TABLE `newsletter_history_group` DISABLE KEYS */;
/*!40000 ALTER TABLE `newsletter_history_group` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `newsletter_subscriber`
--

DROP TABLE IF EXISTS `newsletter_subscriber`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `newsletter_subscriber` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(50) NOT NULL,
  `firstName` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `lastName` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `unsubscribed` tinyint(1) NOT NULL DEFAULT '0',
  `salt` varchar(10) NOT NULL,
  `unsubscriptionDate` datetime NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `source` tinyint(1) NOT NULL DEFAULT '0',
  `deleted` int(11) NOT NULL DEFAULT '0',
  `cUserId` int(11) NOT NULL DEFAULT '0',
  `cTime` datetime NOT NULL,
  `cIpAddress` varchar(40) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=95 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `newsletter_subscriber`
--

LOCK TABLES `newsletter_subscriber` WRITE;
/*!40000 ALTER TABLE `newsletter_subscriber` DISABLE KEYS */;
INSERT INTO `newsletter_subscriber` VALUES (94,'tet@me.com','ja','',0,'oixdrm0o4i','0000-00-00 00:00:00',1,1,1,0,'2013-09-18 07:37:44','127.0.0.1');
/*!40000 ALTER TABLE `newsletter_subscriber` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `application`
--

DROP TABLE IF EXISTS `application`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `application` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `companyName` varchar(255) DEFAULT NULL,
  `industrySection` int(11) DEFAULT NULL,
  `types_idtypes` int(11) NOT NULL,
  `country` varchar(45) DEFAULT NULL,
  `description` text,
  `lang` int(11) DEFAULT NULL,
  `active` tinyint(4) DEFAULT '1',
  `ordering` tinyint(4) DEFAULT NULL,
  `deleted` tinyint(4) DEFAULT '0',
  `cTime` timestamp NULL DEFAULT NULL,
  `cIpAddress` varchar(45) DEFAULT NULL,
  `cUserId` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_application_industrySections` (`industrySection`),
  KEY `fk_application_types1` (`types_idtypes`),
  CONSTRAINT `fk_application_types1` FOREIGN KEY (`types_idtypes`) REFERENCES `types` (`idtypes`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `application`
--

LOCK TABLES `application` WRITE;
/*!40000 ALTER TABLE `application` DISABLE KEYS */;
INSERT INTO `application` VALUES (2,'compa2',NULL,1,NULL,NULL,2,1,NULL,0,'2013-10-14 11:47:39',NULL,NULL),(3,'compa1 ',NULL,1,NULL,NULL,1,1,NULL,0,'2013-10-14 11:47:24',NULL,NULL),(4,NULL,NULL,1,NULL,NULL,0,1,NULL,0,NULL,NULL,NULL),(5,NULL,NULL,1,NULL,NULL,0,1,NULL,0,NULL,NULL,NULL),(6,NULL,NULL,1,NULL,NULL,0,1,NULL,0,NULL,NULL,NULL);
/*!40000 ALTER TABLE `application` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `newsletterissue`
--

DROP TABLE IF EXISTS `newsletterissue`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `newsletterissue` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(45) DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  `img` varchar(255) DEFAULT NULL,
  `active` tinyint(4) DEFAULT '1',
  `ordering` tinyint(4) DEFAULT NULL,
  `deleted` tinyint(4) DEFAULT '0',
  `cTime` timestamp NULL DEFAULT NULL,
  `cIpAddress` varchar(45) DEFAULT NULL,
  `cUserId` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `newsletterissue`
--

LOCK TABLES `newsletterissue` WRITE;
/*!40000 ALTER TABLE `newsletterissue` DISABLE KEYS */;
INSERT INTO `newsletterissue` VALUES (1,'fsdf','sdf','sdf',1,2,0,'2013-09-18 03:58:49','127.0.0.1',NULL);
/*!40000 ALTER TABLE `newsletterissue` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `newsletter_template`
--

DROP TABLE IF EXISTS `newsletter_template`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `newsletter_template` (
  `id` smallint(6) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `template` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `newsletter_template`
--

LOCK TABLES `newsletter_template` WRITE;
/*!40000 ALTER TABLE `newsletter_template` DISABLE KEYS */;
/*!40000 ALTER TABLE `newsletter_template` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2013-10-22  5:32:30
