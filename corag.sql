-- MySQL dump 10.13  Distrib 5.5.46, for debian-linux-gnu (x86_64)
--
-- Host: 127.0.0.1    Database: corag
-- ------------------------------------------------------
-- Server version	5.5.46-0ubuntu0.14.04.2

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
-- Table structure for table `departamentos`
--

DROP TABLE IF EXISTS `departamentos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `departamentos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) DEFAULT NULL,
  `sigla` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=60 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `departamentos`
--

LOCK TABLES `departamentos` WRITE;
/*!40000 ALTER TABLE `departamentos` DISABLE KEYS */;
INSERT INTO `departamentos` VALUES (1,'Acabamento Manual','ACMAN'),(2,'Acabamento Máquinas',NULL),(3,'Ascorag',NULL),(4,'Assessoria de Comunicação e Marketing','ASCOM'),(5,'Assessoria de Planejamento e Qualidade',NULL),(6,'Assessoria Jurídica',NULL),(7,'Arquivamento',NULL),(8,'Armazém Literário/Loja Centro',NULL),(9,'Auditoria Interna',NULL),(10,'CEI Assembleia',NULL),(11,'CEI CAFF',NULL),(12,'Compras',NULL),(13,'Contabilidade',NULL),(14,'Contratos',NULL),(15,'Coordenadoria Gráfica',NULL),(16,'Coordenadoria de Gestão com Pessoas',NULL),(17,'Sopa',NULL),(18,'Crédito e Cobrança(Financeira)',NULL),(19,'CTP',NULL),(20,'Diretoria Administrativa/Financeira',NULL),(21,'Diretoria Industrial',NULL),(22,'Expedição',NULL),(23,'Fardos/Resíduos',NULL),(24,'Faturamento',NULL),(25,'Gabinete da Presidência',NULL),(26,'GED',NULL),(27,'Gerência Administrativa',NULL),(28,'Gerência Comercial e Financeira',NULL),(29,'Gerência de Tecnologia da Informação',NULL),(30,'Gerência de Tecnologia da Segurança',NULL),(31,'Gerência do Diário Oficial',NULL),(32,'Gerência Industrial',NULL),(33,'Guarita',NULL),(34,'Impressão Digital',NULL),(35,'Impressão Rotativa',NULL),(36,'Infraestrutura Predial',NULL),(37,'Limpeza',NULL),(38,'Manutenção e Máquinas',NULL),(39,'Máteriais',NULL),(40,'OFF-SET',NULL),(41,'Patrimônio e Segurança',NULL),(42,'Pré-Impressão',NULL),(43,'Projeto Pescar',NULL),(44,'Protocolo',NULL),(45,'Publicações e Assinaturas',NULL),(46,'Publicações Técnicas',NULL),(47,'Recepção',NULL),(48,'Remessa',NULL),(49,'Segurança do Trabalho',NULL),(50,'Talão do Produtor',NULL),(51,'Tipografia',NULL),(52,'Transportes',NULL),(53,'Unidade de Impressão e Segurança',NULL),(54,'Vendas',NULL),(58,'aaaa','aaaa'),(59,'Assessoria da Diretoria Administrativa e de N','Ass.Adm.Neg');
/*!40000 ALTER TABLE `departamentos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `departamentoId` int(11) DEFAULT NULL,
  `nome` varchar(45) DEFAULT NULL,
  `foto` varchar(100) DEFAULT NULL,
  `dataNascimento` varchar(50) DEFAULT NULL,
  `status` char(1) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `salt` varchar(255) DEFAULT NULL,
  `admissao` varchar(45) DEFAULT NULL,
  `matricula` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_funcionarios_1_idx` (`departamentoId`),
  CONSTRAINT `fk_usuarios_1` FOREIGN KEY (`departamentoId`) REFERENCES `departamentos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (22,29,'Lucas Fernando Borges Rosa','','1983-02-03','0','lucas-fbr@hotmail.com','5d8dd26e821ec5e24688295dc76e85fe6fa1df71d8a2d93af09aa2d19d3d42852c41248bafb6005b89a7e8fa33c18ddec8fbd764a5d3c49f91878e8cd2eedb6d','ebspmxnfqfc4owg08kg8og8w8coc0ow',NULL,NULL),(29,12,'Isabel Ferreira','','1980-08-20','1','isabelfs@bol.com.br','f4624d8ec0a1a25f03685efd858cd869eff2cc3bd544cc39d3bcc806dd23ed15e8864ff9edff3eef6a8b946d09b3a0c0e27148ee5781fd26df8a8e176b4393d7','6swth8xcbqkogwww88s4g0ocg8ckc4o',NULL,NULL),(30,8,'Teste Silva','icone-de-usuario-do-sexo-masculino_17-810120247.jpg','1983-02-03','0','teste@silva.com','24839c55cd299a9cd88e155d5a6c6738065bdb2b3f11d4d8bfd9c9ca6087e94409c1e5d49482d17523e623b7f21dc4478b515fd1b8725986357f95b1c21ad8f4','8ihb5pnf0pkwsw884k4ow404wsckcws',NULL,NULL),(31,10,'sss','icone-de-usuario-do-sexo-masculino_17-810120247.jpg','0121-03-03','2','sss','7ada79fb345bc74ac90d87c3ff95f77f85afc6ae390947f58ec9d87da8df316e5975f5bf7116db227d216cb54fa310be3f438c42662b9cfe12a692515664e835','1qzwj054vkbosw84gcw4k4w84ckc4gk',NULL,NULL),(32,59,'Fernanda Duarte Mergel','Fernanda Duarte Mergel.jpg','1990-01-22','1','','0043e0f68d1a99447762cb2a87d43cd92d61f5e2f36356588bd3c6a29d3b31194e5dd5326c84142daa98d502c0026a62f1e16eb35759776eb577171f86e42ad4','k95t6j5kvnk44kc4kk00wgwcckc000s',NULL,NULL),(33,21,'Bruna Da Costa Sampaio','Bruna Da Costa Sampaio.jpg','1994-03-15','1','','f995d6d29bb068a3505b554536430af0106e24edaefc640fad3ac9e94a78c80178cc4f5dfc19e58d1ac4c830b112be2a152dfd6c39939ba5db34c5d310df8df7','pjeim4w6a40ok0gwkgowggs00080wwk',NULL,NULL),(34,10,'ssss','Airton Jose Paim Junior.jpg','1970-01-01','1','','f995d6d29bb068a3505b554536430af0106e24edaefc640fad3ac9e94a78c80178cc4f5dfc19e58d1ac4c830b112be2a152dfd6c39939ba5db34c5d310df8df7','8rl039z0vio8skgs4wgs4wok48og48o',NULL,NULL),(35,14,'João Teste','Andre Luiz Gama de Mello.jpg','1970-03-03','1','','f995d6d29bb068a3505b554536430af0106e24edaefc640fad3ac9e94a78c80178cc4f5dfc19e58d1ac4c830b112be2a152dfd6c39939ba5db34c5d310df8df7','62fxpu7eadwcgssgo00sg448wg8kg40','03/03/1993','123');
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-12-24 11:21:18
