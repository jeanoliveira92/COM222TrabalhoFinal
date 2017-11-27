-- MySQL dump 10.13  Distrib 5.7.20, for Linux (x86_64)
--
-- Host: localhost    Database: vinumweb
-- ------------------------------------------------------
-- Server version	5.7.20-0ubuntu0.16.04.1

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
-- Current Database: `vinumweb`
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `vinumweb` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `vinumweb`;

--
-- Table structure for table `avaliacao`
--

DROP TABLE IF EXISTS `avaliacao`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `avaliacao` (
  `ordem` int(11) NOT NULL AUTO_INCREMENT,
  `idvinho` int(11) NOT NULL,
  `idusuario` int(11) NOT NULL,
  `nota` float DEFAULT NULL,
  `opiniao` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`idvinho`,`idusuario`),
  UNIQUE KEY `ordem` (`ordem`),
  KEY `idusuario` (`idusuario`),
  CONSTRAINT `avaliacao_ibfk_1` FOREIGN KEY (`idvinho`) REFERENCES `vinho` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `avaliacao_ibfk_2` FOREIGN KEY (`idusuario`) REFERENCES `usuario` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `avaliacao`
--

LOCK TABLES `avaliacao` WRITE;
/*!40000 ALTER TABLE `avaliacao` DISABLE KEYS */;
/*!40000 ALTER TABLE `avaliacao` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER atualiza_avaliacao after INSERT ON avaliacao FOR EACH ROW
BEGIN
	DECLARE numav int(11);
	select numavaliacoes into numav from vinho where id=new.idvinho;
	IF(numav < 1) THEN
		UPDATE vinho SET avaliacao=new.nota where id=new.idvinho;
		UPDATE vinho SET numavaliacoes=1 where id=new.idvinho;
	ELSE
		update vinho set avaliacao = (avaliacao*numavaliacoes+new.nota)/(numavaliacoes+1) where id=new.idvinho;
		update vinho set numavaliacoes = (numavaliacoes+1) where id = new.idVinho;
	END IF;
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `harmonizacao`
--

DROP TABLE IF EXISTS `harmonizacao`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `harmonizacao` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idVinho` int(11) NOT NULL,
  `alimento` varchar(64) NOT NULL,
  PRIMARY KEY (`id`,`idVinho`),
  KEY `idVinho` (`idVinho`),
  CONSTRAINT `harmonizacao_ibfk_1` FOREIGN KEY (`idVinho`) REFERENCES `vinho` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `harmonizacao`
--

LOCK TABLES `harmonizacao` WRITE;
/*!40000 ALTER TABLE `harmonizacao` DISABLE KEYS */;
INSERT INTO `harmonizacao` VALUES (1,1,'queijo'),(2,1,'empada'),(3,1,'torta'),(4,1,'carpa'),(5,1,'lasanha'),(6,2,'peixe'),(7,2,'ostras');
/*!40000 ALTER TABLE `harmonizacao` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(64) NOT NULL,
  `email` varchar(64) NOT NULL,
  `senha` varchar(64) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` VALUES (1,'mateus','mateushtoledo@gmail.com','61355ef8ce053214312bdf57e2730b92285bf93dbe5357f5cd5245c446050ff5');
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vinho`
--

DROP TABLE IF EXISTS `vinho`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vinho` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rotulo` varchar(256) NOT NULL,
  `produtor` varchar(64) NOT NULL,
  `nome` varchar(64) NOT NULL,
  `regiao` varchar(32) NOT NULL,
  `paisorigem` varchar(32) NOT NULL,
  `avaliacao` float DEFAULT '0',
  `preco` float DEFAULT '0',
  `numavaliacoes` int(11) DEFAULT '0',
  `tipo` enum('vermelho','branco','espumante','rosa','sobremesa','porto') DEFAULT NULL,
  `tipouva` varchar(32) NOT NULL,
  `estilo` varchar(32) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vinho`
--

LOCK TABLES `vinho` WRITE;
/*!40000 ALTER TABLE `vinho` DISABLE KEYS */;
INSERT INTO `vinho` VALUES (1,'85e03d4219c1b25b5c83a1ce3025bad7.jpg','Blong vinhos','Dom serrano trade','Serra gaÃºcha','Brasil',3,135.5,0,'espumante','Cabernaut sauvignon','Forte'),(2,'494ab2d8625d422092f244bcebcb0199.png','LaÃ©rcio','WineTricks','Serra gaÃºcha','Brasil',3,200,0,'branco','Blong Grape','Extra seco');
/*!40000 ALTER TABLE `vinho` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vinhos_usuario`
--

DROP TABLE IF EXISTS `vinhos_usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vinhos_usuario` (
  `idvinho` int(11) NOT NULL,
  `idusuario` int(11) NOT NULL,
  PRIMARY KEY (`idvinho`,`idusuario`),
  KEY `idusuario` (`idusuario`),
  CONSTRAINT `vinhos_usuario_ibfk_1` FOREIGN KEY (`idvinho`) REFERENCES `vinho` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `vinhos_usuario_ibfk_2` FOREIGN KEY (`idusuario`) REFERENCES `usuario` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vinhos_usuario`
--

LOCK TABLES `vinhos_usuario` WRITE;
/*!40000 ALTER TABLE `vinhos_usuario` DISABLE KEYS */;
INSERT INTO `vinhos_usuario` VALUES (1,1),(2,1);
/*!40000 ALTER TABLE `vinhos_usuario` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-11-27 15:49:03
