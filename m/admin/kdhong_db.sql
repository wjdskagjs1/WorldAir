
--
-- Table structure for table `member`
--

DROP TABLE IF EXISTS `member`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `member` (
  `userid` char(15) NOT NULL,
  `password` char(15) NOT NULL,
  `nickname` char(10) NOT NULL,
  `email` char(80) NOT NULL,
  `introduce` text,
  `regist_day` char(20) DEFAULT NULL,
  `point` int(11) DEFAULT NULL,
  `privilege` tinyint(1) DEFAULT NULL,
  `ip` char(15) NOT NULL,
  PRIMARY KEY (`userid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `member`
--

LOCK TABLES `member` WRITE;
/*!40000 ALTER TABLE `member` DISABLE KEYS */;
INSERT INTO `member` VALUES ('admin','1','ê´€ë¦¬ìž','ì•”ê±°ë‚˜ì“°ì…ˆ','ê´€ë¦¬ìžê°€ ì™•ìž„','',999999,1,'127.0.0.1');
/*!40000 ALTER TABLE `member` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product`
--

DROP TABLE IF EXISTS `product`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product` (
  `num` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(12) NOT NULL,
  `price` int(11) DEFAULT NULL,
  `description` text,
  `thumbnail` char(40) DEFAULT NULL,
  `detail` char(40) DEFAULT NULL,
  `thumbnail_copied` char(30) DEFAULT NULL,
  `detail_copied` char(30) DEFAULT NULL,
  PRIMARY KEY (`num`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product`
--

LOCK TABLES `product` WRITE;
/*!40000 ALTER TABLE `product` DISABLE KEYS */;
INSERT INTO `product` VALUES (1,'1',1,'1','','','',''),(2,'2',2,'2','','','',''),(3,'3',3,'3','','','',''),(4,'4',4,'4','','','','');
/*!40000 ALTER TABLE `product` ENABLE KEYS */;
UNLOCK TABLES;