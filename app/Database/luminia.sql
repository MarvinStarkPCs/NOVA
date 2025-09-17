-- MySQL dump 10.13  Distrib 8.0.42, for Win64 (x86_64)
--
-- Host: localhost    Database: sistema_educativo
-- ------------------------------------------------------
-- Server version	8.0.42

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `asignaturas`
--

DROP TABLE IF EXISTS `asignaturas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `asignaturas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `asignaturas`
--

LOCK TABLES `asignaturas` WRITE;
/*!40000 ALTER TABLE `asignaturas` DISABLE KEYS */;
INSERT INTO `asignaturas` VALUES (11,'Matemáticas','2025-09-04 12:15:35','2025-09-04 12:15:35'),(12,'Español','2025-09-04 12:15:35','2025-09-04 12:15:35'),(13,'Ciencias Naturales','2025-09-04 12:15:35','2025-09-04 12:15:35'),(14,'Ciencias Sociales','2025-09-04 12:15:35','2025-09-04 12:15:35'),(15,'Inglés','2025-09-04 12:15:35','2025-09-04 12:15:35'),(16,'Educación Física','2025-09-04 12:15:35','2025-09-04 12:15:35'),(17,'Artes','2025-09-04 12:15:35','2025-09-04 12:15:35'),(18,'Tecnología','2025-09-04 12:15:35','2025-09-04 12:15:35'),(19,'Ética','2025-09-04 12:15:35','2025-09-04 12:15:35'),(20,'Religión','2025-09-04 12:15:35','2025-09-04 12:15:35');
/*!40000 ALTER TABLE `asignaturas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `configuration`
--

DROP TABLE IF EXISTS `configuration`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `configuration` (
  `id` int NOT NULL AUTO_INCREMENT,
  `config_key` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `config_value` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `config_key` (`config_key`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `configuration`
--

LOCK TABLES `configuration` WRITE;
/*!40000 ALTER TABLE `configuration` DISABLE KEYS */;
/*!40000 ALTER TABLE `configuration` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `grados`
--

DROP TABLE IF EXISTS `grados`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `grados` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `grados`
--

LOCK TABLES `grados` WRITE;
/*!40000 ALTER TABLE `grados` DISABLE KEYS */;
INSERT INTO `grados` VALUES (1,'Quinto','2025-09-04 12:15:35','2025-09-04 12:15:35'),(2,'Sexto','2025-09-04 12:15:35','2025-09-04 12:15:35'),(3,'Séptimo','2025-09-04 12:15:35','2025-09-04 12:15:35'),(4,'Octavo','2025-09-04 12:15:35','2025-09-04 12:15:35'),(5,'Noveno','2025-09-04 12:15:35','2025-09-04 12:15:35'),(6,'Décimo','2025-09-04 12:15:35','2025-09-04 12:15:35'),(7,'Once','2025-09-04 12:15:35','2025-09-04 12:15:35');
/*!40000 ALTER TABLE `grados` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `grupos`
--

DROP TABLE IF EXISTS `grupos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `grupos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `grado_id` int NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `grado_id` (`grado_id`),
  CONSTRAINT `grupos_ibfk_1` FOREIGN KEY (`grado_id`) REFERENCES `grados` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `grupos`
--

LOCK TABLES `grupos` WRITE;
/*!40000 ALTER TABLE `grupos` DISABLE KEYS */;
INSERT INTO `grupos` VALUES (2,'1',1,'2025-09-04 12:15:35','2025-09-04 12:15:35'),(3,'2',1,'2025-09-04 12:15:35','2025-09-04 12:15:35'),(4,'3',1,'2025-09-04 12:15:35','2025-09-04 12:15:35'),(5,'4',1,'2025-09-04 12:15:35','2025-09-04 12:15:35'),(6,'1',2,'2025-09-04 12:15:35','2025-09-04 12:15:35'),(7,'2',2,'2025-09-04 12:15:35','2025-09-04 12:15:35'),(8,'3',2,'2025-09-04 12:15:35','2025-09-04 12:15:35'),(9,'4',2,'2025-09-04 12:15:35','2025-09-04 12:15:35'),(10,'1',3,'2025-09-04 12:15:35','2025-09-04 12:15:35'),(11,'2',3,'2025-09-04 12:15:35','2025-09-04 12:15:35'),(12,'3',3,'2025-09-04 12:15:35','2025-09-04 12:15:35'),(13,'4',3,'2025-09-04 12:15:35','2025-09-04 12:15:35'),(14,'1',4,'2025-09-04 12:15:35','2025-09-04 12:15:35'),(15,'2',4,'2025-09-04 12:15:35','2025-09-04 12:15:35'),(16,'3',4,'2025-09-04 12:15:35','2025-09-04 12:15:35'),(17,'4',4,'2025-09-04 12:15:35','2025-09-04 12:15:35'),(18,'1',5,'2025-09-04 12:15:35','2025-09-04 12:15:35'),(19,'2',5,'2025-09-04 12:15:35','2025-09-04 12:15:35'),(20,'3',5,'2025-09-04 12:15:35','2025-09-04 12:15:35'),(21,'4',5,'2025-09-04 12:15:35','2025-09-04 12:15:35'),(22,'1',6,'2025-09-04 12:15:35','2025-09-04 12:15:35'),(23,'2',6,'2025-09-04 12:15:35','2025-09-04 12:15:35'),(24,'3',6,'2025-09-04 12:15:35','2025-09-04 12:15:35'),(25,'4',6,'2025-09-04 12:15:35','2025-09-04 12:15:35'),(26,'1',7,'2025-09-04 12:15:35','2025-09-04 12:15:35'),(27,'2',7,'2025-09-04 12:15:35','2025-09-04 12:15:35'),(28,'3',7,'2025-09-04 12:15:35','2025-09-04 12:15:35'),(29,'4',7,'2025-09-04 12:15:35','2025-09-04 12:15:35');
/*!40000 ALTER TABLE `grupos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jornadas`
--

DROP TABLE IF EXISTS `jornadas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jornadas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jornadas`
--

LOCK TABLES `jornadas` WRITE;
/*!40000 ALTER TABLE `jornadas` DISABLE KEYS */;
INSERT INTO `jornadas` VALUES (4,'Mañana','2025-09-04 12:15:35','2025-09-04 12:15:35'),(5,'Tarde','2025-09-04 12:15:35','2025-09-04 12:15:35');
/*!40000 ALTER TABLE `jornadas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lectura_preguntas`
--

DROP TABLE IF EXISTS `lectura_preguntas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `lectura_preguntas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `lectura_id` int NOT NULL,
  `pregunta_id` int NOT NULL,
  `fecha_lectura` datetime DEFAULT CURRENT_TIMESTAMP,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_lectura_preguntas` (`lectura_id`,`pregunta_id`),
  KEY `pregunta_id` (`pregunta_id`),
  CONSTRAINT `lectura_preguntas_ibfk_1` FOREIGN KEY (`lectura_id`) REFERENCES `lecturas` (`id`) ON DELETE CASCADE,
  CONSTRAINT `lectura_preguntas_ibfk_2` FOREIGN KEY (`pregunta_id`) REFERENCES `preguntas` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lectura_preguntas`
--

LOCK TABLES `lectura_preguntas` WRITE;
/*!40000 ALTER TABLE `lectura_preguntas` DISABLE KEYS */;
INSERT INTO `lectura_preguntas` VALUES (1,1,1,'2025-09-04 07:19:36','2025-09-04 07:19:36','2025-09-04 07:19:36'),(2,2,2,'2025-09-04 07:31:03','2025-09-04 07:31:03','2025-09-04 07:31:03'),(3,2,3,'2025-09-04 07:31:03','2025-09-04 07:31:03','2025-09-04 07:31:03'),(4,5,16,'2025-09-04 13:59:28','2025-09-04 13:59:28','2025-09-04 13:59:28'),(5,5,17,'2025-09-04 13:59:28','2025-09-04 13:59:28','2025-09-04 13:59:28'),(6,5,18,'2025-09-04 13:59:28','2025-09-04 13:59:28','2025-09-04 13:59:28'),(7,6,19,'2025-09-04 13:59:28','2025-09-04 13:59:28','2025-09-04 13:59:28'),(8,6,20,'2025-09-04 13:59:28','2025-09-04 13:59:28','2025-09-04 13:59:28'),(9,6,21,'2025-09-04 13:59:28','2025-09-04 13:59:28','2025-09-04 13:59:28'),(10,7,22,'2025-09-04 13:59:28','2025-09-04 13:59:28','2025-09-04 13:59:28'),(11,7,23,'2025-09-04 13:59:28','2025-09-04 13:59:28','2025-09-04 13:59:28'),(12,7,24,'2025-09-04 13:59:28','2025-09-04 13:59:28','2025-09-04 13:59:28'),(13,8,29,'2025-09-06 16:58:17','2025-09-06 16:58:17','2025-09-06 16:58:17'),(14,9,30,'2025-09-15 22:42:22','2025-09-15 22:42:22','2025-09-15 22:42:22'),(15,10,32,'2025-09-15 22:42:22','2025-09-15 22:42:22','2025-09-15 22:42:22');
/*!40000 ALTER TABLE `lectura_preguntas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lecturas`
--

DROP TABLE IF EXISTS `lecturas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `lecturas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `titulo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `contenido` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `prueba_id` int NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_lecturas_prueba` (`prueba_id`),
  CONSTRAINT `lecturas_ibfk_1` FOREIGN KEY (`prueba_id`) REFERENCES `pruebas` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lecturas`
--

LOCK TABLES `lecturas` WRITE;
/*!40000 ALTER TABLE `lecturas` DISABLE KEYS */;
INSERT INTO `lecturas` VALUES (1,'sergsergsersertgsret','sergeswrgergewrgewrg',1,'2025-09-04 07:19:36','2025-09-04 07:19:36'),(2,'asdfasdfasdf','1 aertyaqertgartgawerfg',2,'2025-09-04 07:31:03','2025-09-04 07:31:03'),(3,'El Valor de la Amistad','La amistad es uno de los valores más importantes en la vida de las personas. Un verdadero amigo es aquel que está presente tanto en los momentos felices como en los difíciles. La amistad se construye con confianza, respeto y sinceridad. Es importante saber elegir bien a nuestros amigos y ser nosotros mismos buenos amigos para los demás.',4,'2025-09-04 13:38:09','2025-09-04 13:38:09'),(4,'Los Planetas del Sistema Solar','El Sistema Solar está formado por ocho planetas que giran alrededor del Sol. Los planetas más cercanos al Sol son Mercurio, Venus, Tierra y Marte, conocidos como planetas rocosos. Los planetas más lejanos son Júpiter, Saturno, Urano y Neptuno, llamados gigantes gaseosos. Cada planeta tiene características únicas que los hacen especiales.',5,'2025-09-04 13:38:09','2025-09-04 13:38:09'),(5,'La Tierra: Nuestro Planeta Especial','La Tierra es el tercer planeta desde el Sol y es el único conocido que alberga vida. Tiene una atmósfera compuesta principalmente por nitrógeno y oxígeno, que protege la vida de la radiación solar dañina. La Tierra tiene un satélite natural llamado Luna, que influye en las mareas oceánicas. La temperatura promedio del planeta es de aproximadamente 15°C, lo que permite la existencia de agua en estado líquido.',3,'2025-09-04 13:59:28','2025-09-04 13:59:28'),(6,'Los Movimientos de la Tierra','La Tierra realiza dos movimientos principales: rotación y traslación. La rotación es el giro de la Tierra sobre su propio eje, lo que causa el día y la noche. Este movimiento dura aproximadamente 24 horas. La traslación es el movimiento de la Tierra alrededor del Sol, que dura 365 días y causa las estaciones del año. La inclinación del eje terrestre es lo que hace que tengamos primavera, verano, otoño e invierno.',3,'2025-09-04 13:59:28','2025-09-04 13:59:28'),(7,'Asteroides y Cometas','Además de los planetas, el Sistema Solar contiene otros cuerpos celestes como asteroides y cometas. Los asteroides son rocas espaciales que orbitan principalmente entre Marte y Júpiter, en una región llamada cinturón de asteroides. Los cometas son bolas de hielo y polvo que vienen de las regiones más frías del Sistema Solar. Cuando se acercan al Sol, desarrollan una cola brillante que podemos ver desde la Tierra.',3,'2025-09-04 13:59:28','2025-09-04 13:59:28'),(8,'zcvbzvbzxvb','zvcbzxvcbzvbzvb',8,'2025-09-06 16:58:17','2025-09-06 16:58:17'),(9,'srghdsfghsfghstg sgrh','sghsdfgh sdgfhfds ghdfg hsdfghsdghs',9,'2025-09-15 22:42:22','2025-09-15 22:42:22'),(10,'sedty sertyserfrgsdfhg','sdgfhsdfgsdfg sdfgdsfg gfhsdfg',9,'2025-09-15 22:42:22','2025-09-15 22:42:22');
/*!40000 ALTER TABLE `lecturas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `matriculas`
--

DROP TABLE IF EXISTS `matriculas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `matriculas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` bigint NOT NULL,
  `jornada_id` int NOT NULL,
  `grupo_id` int NOT NULL,
  `fecha_matricula` datetime DEFAULT CURRENT_TIMESTAMP,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `jornada_id` (`jornada_id`),
  KEY `idx_matriculas_user` (`user_id`),
  KEY `idx_matriculas_grupo` (`grupo_id`),
  CONSTRAINT `matriculas_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `matriculas_ibfk_2` FOREIGN KEY (`grupo_id`) REFERENCES `grupos` (`id`),
  CONSTRAINT `matriculas_ibfk_3` FOREIGN KEY (`jornada_id`) REFERENCES `jornadas` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `matriculas`
--

LOCK TABLES `matriculas` WRITE;
/*!40000 ALTER TABLE `matriculas` DISABLE KEYS */;
INSERT INTO `matriculas` VALUES (4,20,4,26,'2025-09-03 00:00:00','2025-09-04 07:18:40','2025-09-04 07:18:40'),(5,21,4,26,'2025-09-03 00:00:00','2025-09-04 20:08:50','2025-09-04 20:08:50'),(6,22,4,26,'2025-09-03 00:00:00','2025-09-04 20:08:50','2025-09-04 20:08:50'),(7,23,4,26,'2025-09-03 00:00:00','2025-09-04 20:08:50','2025-09-04 20:08:50'),(8,24,4,26,'2025-09-03 00:00:00','2025-09-04 20:08:50','2025-09-04 20:08:50'),(9,25,4,26,'2025-09-03 00:00:00','2025-09-04 20:08:50','2025-09-04 20:08:50'),(10,25,4,27,'2024-09-03 00:00:00','2025-09-07 06:56:37','2025-09-07 06:56:37'),(14,21,4,8,NULL,'2025-09-07 07:52:19','2025-09-07 07:52:19'),(15,22,4,8,NULL,'2025-09-07 07:52:19','2025-09-07 07:52:19'),(16,24,4,8,NULL,'2025-09-07 07:52:20','2025-09-07 07:52:20'),(17,23,4,12,'2025-09-05 00:00:00','2025-09-07 07:53:01','2025-09-07 07:53:01'),(18,24,4,12,'2025-09-05 00:00:00','2025-09-07 07:53:01','2025-09-07 07:53:01');
/*!40000 ALTER TABLE `matriculas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `preguntas`
--

DROP TABLE IF EXISTS `preguntas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `preguntas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `enunciado` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `opcion_a` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `opcion_b` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `opcion_c` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `opcion_d` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `opcion_correcta` char(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `justificacion` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `tipo` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT 'multiple_choice',
  `prueba_id` int NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_preguntas_prueba` (`prueba_id`),
  CONSTRAINT `preguntas_ibfk_1` FOREIGN KEY (`prueba_id`) REFERENCES `pruebas` (`id`) ON DELETE CASCADE,
  CONSTRAINT `preguntas_chk_1` CHECK ((`opcion_correcta` in (_utf8mb4'a',_utf8mb4'b',_utf8mb4'c',_utf8mb4'd')))
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `preguntas`
--

LOCK TABLES `preguntas` WRITE;
/*!40000 ALTER TABLE `preguntas` DISABLE KEYS */;
INSERT INTO `preguntas` VALUES (1,'ewrgwergewr','gwergwergwer','ergwergwerg','gwergewr','gwergwerg','b','wergwergewrgwergewrg','multiple_choice',1,'2025-09-04 07:19:36','2025-09-04 07:19:36'),(2,'wertewrtewrterwtwertwr','wertwertwertwer','tertwertwert','twertwertwert','wertwertwerter','b','twertwertwertewrtwerterwtertwerterterwt','multiple_choice',2,'2025-09-04 07:31:03','2025-09-04 07:31:03'),(3,'64wwtyeertter','tretretretretert','ertertertertre','tretret','tretertert','d','tretretretretttttttttttttttttrw','multiple_choice',2,'2025-09-04 07:31:03','2025-09-04 07:31:03'),(4,'2','setrysertysetys','esrtesrtesrt','etrgsertesart','sertsertsertesrterst','c','sertsertert','multiple_choice',2,'2025-09-04 07:31:03','2025-09-04 07:31:03'),(5,'3 thrhgtrhtrtt','tytytttyt','ytytytyt','yghghffgdhghfd','ghfdhgfdhgfdhgfdhgfdhgfd','b','hgfdhgfdghfdhgfdhgfd','multiple_choice',2,'2025-09-04 07:31:03','2025-09-04 07:31:03'),(6,'¿Cuál es el resultado de 2x + 5 = 13?','x = 3','x = 4','x = 5','x = 6','b','Al resolver: 2x = 13 - 5, entonces 2x = 8, por lo tanto x = 4','multiple_choice',3,'2025-09-04 13:38:09','2025-09-04 13:38:09'),(7,'Si a = 3 y b = 4, ¿cuál es el valor de a² + b²?','12','25','49','7','b','a² + b² = 3² + 4² = 9 + 16 = 25','multiple_choice',3,'2025-09-04 13:38:09','2025-09-04 13:38:09'),(8,'Según la lectura, ¿qué característica NO es propia de un verdadero amigo?','Estar presente en momentos difíciles','Ser sincero','Buscar solo su propio beneficio','Mostrar respeto','c','Un verdadero amigo no busca solo su propio beneficio, sino que también se preocupa por el bienestar de los demás','multiple_choice',4,'2025-09-04 13:38:09','2025-09-04 13:38:09'),(9,'¿Cuál es el sujeto en la oración \"Los estudiantes estudian matemáticas\"?','estudian','matemáticas','Los estudiantes','estudian matemáticas','c','El sujeto es quien realiza la acción del verbo, en este caso \"Los estudiantes\"','multiple_choice',4,'2025-09-04 13:38:09','2025-09-04 13:38:09'),(10,'¿Cuántos planetas conforman nuestro Sistema Solar?','7','8','9','10','b','Actualmente se reconocen 8 planetas en nuestro Sistema Solar','multiple_choice',5,'2025-09-04 13:38:09','2025-09-04 13:38:09'),(11,'¿Cuál es el planeta más grande del Sistema Solar?','Saturno','Neptuno','Júpiter','Urano','c','Júpiter es el planeta más grande del Sistema Solar','multiple_choice',5,'2025-09-04 13:38:09','2025-09-04 13:38:09'),(12,'¿En qué año Colombia obtuvo su independencia?','1810','1819','1820','1821','b','Colombia obtuvo su independencia el 7 de agosto de 1819 en la Batalla de Boyacá','multiple_choice',6,'2025-09-04 13:38:09','2025-09-04 13:38:09'),(13,'¿Quién fue el Libertador de Colombia?','Antonio Nariño','Simón Bolívar','Francisco de Paula Santander','Policarpa Salavarrieta','b','Simón Bolívar es conocido como el Libertador de Colombia y otros países sudamericanos','multiple_choice',6,'2025-09-04 13:38:09','2025-09-04 13:38:09'),(14,'What is the correct form of the verb \"to be\" for \"I\"?','am','is','are','be','a','The correct form is \"I am\"','multiple_choice',7,'2025-09-04 13:38:09','2025-09-04 13:38:09'),(15,'Choose the correct plural form of \"child\":','childs','children','childes','child','b','The plural of \"child\" is \"children\"','multiple_choice',7,'2025-09-04 13:38:09','2025-09-04 13:38:09'),(16,'¿Cuál es el satélite natural de la Tierra?','Sol','Luna','Venus','Marte','b','La Luna es el único satélite natural de la Tierra','multiple_choice',3,'2025-09-04 13:59:28','2025-09-04 13:59:28'),(17,'¿Qué gases componen principalmente la atmósfera terrestre?','Oxígeno y hidrógeno','Nitrógeno y oxígeno','Carbono y oxígeno','Helio y nitrógeno','b','La atmósfera terrestre está compuesta principalmente por nitrógeno (78%) y oxígeno (21%)','multiple_choice',3,'2025-09-04 13:59:28','2025-09-04 13:59:28'),(18,'¿Cuál es la temperatura promedio de la Tierra?','10°C','15°C','20°C','25°C','b','Según la lectura, la temperatura promedio del planeta es de aproximadamente 15°C','multiple_choice',3,'2025-09-04 13:59:28','2025-09-04 13:59:28'),(19,'¿Cuánto tiempo dura el movimiento de rotación de la Tierra?','12 horas','24 horas','365 días','30 días','b','La rotación de la Tierra sobre su propio eje dura aproximadamente 24 horas','multiple_choice',3,'2025-09-04 13:59:28','2025-09-04 13:59:28'),(20,'¿Qué movimiento de la Tierra causa las estaciones del año?','Rotación','Traslación','Inclinación','Revolución lunar','b','La traslación (movimiento alrededor del Sol) junto con la inclinación del eje terrestre causa las estaciones','multiple_choice',3,'2025-09-04 13:59:28','2025-09-04 13:59:28'),(21,'¿Cuánto tiempo dura el movimiento de traslación?','24 horas','30 días','365 días','12 meses','c','La traslación de la Tierra alrededor del Sol dura 365 días (un año)','multiple_choice',3,'2025-09-04 13:59:28','2025-09-04 13:59:28'),(22,'¿Dónde se encuentra principalmente el cinturón de asteroides?','Entre la Tierra y Marte','Entre Marte y Júpiter','Entre Júpiter y Saturno','Más allá de Neptuno','b','El cinturón de asteroides se encuentra principalmente entre Marte y Júpiter','multiple_choice',3,'2025-09-04 13:59:28','2025-09-04 13:59:28'),(23,'¿De qué están compuestos principalmente los cometas?','Solo roca','Solo gas','Hielo y polvo','Metal y roca','c','Los cometas son bolas de hielo y polvo que vienen de las regiones frías del Sistema Solar','multiple_choice',3,'2025-09-04 13:59:28','2025-09-04 13:59:28'),(24,'¿Qué desarrollan los cometas cuando se acercan al Sol?','Anillos','Una cola brillante','Más velocidad','Satélites','b','Cuando los cometas se acercan al Sol, desarrollan una cola brillante que podemos ver desde la Tierra','multiple_choice',3,'2025-09-04 13:59:28','2025-09-04 13:59:28'),(25,'¿Cuál es el planeta más cercano al Sol?','Venus','Mercurio','Tierra','Marte','b','Mercurio es el planeta más cercano al Sol','multiple_choice',3,'2025-09-04 13:59:28','2025-09-04 13:59:28'),(26,'¿Cuál de estos planetas tiene anillos visibles?','Tierra','Marte','Saturno','Venus','c','Saturno es famoso por sus anillos visibles, aunque otros planetas gigantes también los tienen','multiple_choice',3,'2025-09-04 13:59:28','2025-09-04 13:59:28'),(27,'¿Cuál es el planeta más frío del Sistema Solar?','Plutón','Neptuno','Urano','Júpiter','b','Neptuno es considerado el planeta más frío del Sistema Solar','multiple_choice',3,'2025-09-04 13:59:28','2025-09-04 13:59:28'),(28,'¿Qué estrella está en el centro de nuestro Sistema Solar?','La Luna','El Sol','Venus','Júpiter','b','El Sol es la estrella que está en el centro de nuestro Sistema Solar','multiple_choice',3,'2025-09-04 13:59:28','2025-09-04 13:59:28'),(29,'zxcbzxcv','cxvzxcv','SADFASDFASDFASDF','zxcvzx','cvzxcv','d','zxcvzxcvzxcvzxcvzxcs<fdasdfaSDF','multiple_choice',8,'2025-09-06 16:58:17','2025-09-06 16:58:17'),(30,'dfghdfghdfghdfg hdfgh dfgh','dfghdfgh dfgh','drtyudrtyrtydrty drt','dfghdfghdfg','hdfghgdfh','b','dfghdfg hdfghdsfghdfghdfgh','multiple_choice',9,'2025-09-15 22:42:22','2025-09-15 22:42:22'),(31,'sedfgsdfgsdb sdfg','sdfgsdfg','sdfgsdfg','sdfgsdf','gsdfgsdfg','b','sdfgsdfgds gf','multiple_choice',9,'2025-09-15 22:42:22','2025-09-15 22:42:22'),(32,'sdfgsdfg','sdfgsdfgsdfg','sdfgsdfgsdfg','sdfgsdfgsdf','g sdfgsdfg','c','sdfgsdfgsdfg','multiple_choice',9,'2025-09-15 22:42:22','2025-09-15 22:42:22');
/*!40000 ALTER TABLE `preguntas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `profesor_asignaturas`
--

DROP TABLE IF EXISTS `profesor_asignaturas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `profesor_asignaturas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `profesor_id` bigint NOT NULL,
  `asignatura_id` int NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_profesor_asignatura` (`profesor_id`,`asignatura_id`),
  KEY `asignatura_id` (`asignatura_id`),
  CONSTRAINT `profesor_asignaturas_ibfk_1` FOREIGN KEY (`profesor_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `profesor_asignaturas_ibfk_2` FOREIGN KEY (`asignatura_id`) REFERENCES `asignaturas` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `profesor_asignaturas`
--

LOCK TABLES `profesor_asignaturas` WRITE;
/*!40000 ALTER TABLE `profesor_asignaturas` DISABLE KEYS */;
INSERT INTO `profesor_asignaturas` VALUES (15,21,1,'2025-09-04 13:38:08','2025-09-04 13:38:08'),(16,22,2,'2025-09-04 13:38:08','2025-09-04 13:38:08'),(17,23,3,'2025-09-04 13:38:08','2025-09-04 13:38:08'),(18,24,4,'2025-09-04 13:38:08','2025-09-04 13:38:08'),(19,25,5,'2025-09-04 13:38:08','2025-09-04 13:38:08'),(43,26,13,'2025-09-17 18:38:47','2025-09-17 18:38:47'),(44,26,15,'2025-09-17 18:38:47','2025-09-17 18:38:47');
/*!40000 ALTER TABLE `profesor_asignaturas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `prueba_grupos`
--

DROP TABLE IF EXISTS `prueba_grupos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `prueba_grupos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `prueba_id` int NOT NULL,
  `grupo_id` int NOT NULL,
  `fecha_asignacion` datetime DEFAULT CURRENT_TIMESTAMP,
  `fecha_limite` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `grupo_id` (`grupo_id`),
  CONSTRAINT `prueba_grupos_ibfk_1` FOREIGN KEY (`prueba_id`) REFERENCES `pruebas` (`id`) ON DELETE CASCADE,
  CONSTRAINT `prueba_grupos_ibfk_2` FOREIGN KEY (`grupo_id`) REFERENCES `grupos` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `prueba_grupos`
--

LOCK TABLES `prueba_grupos` WRITE;
/*!40000 ALTER TABLE `prueba_grupos` DISABLE KEYS */;
INSERT INTO `prueba_grupos` VALUES (1,1,26,'2025-09-04 12:19:48','2025-09-12 04:59:00','2025-09-04 12:19:48','2025-09-05 15:47:55'),(2,2,26,'2025-09-04 12:31:58','2025-09-12 04:59:00','2025-09-04 12:31:58','2025-09-05 15:47:55'),(3,6,26,'2025-09-04 13:57:12','2025-09-12 04:59:00','2025-09-04 13:57:12','2025-09-05 15:47:55'),(4,3,26,'2025-09-04 14:01:30','2025-09-12 04:59:00','2025-09-04 14:01:30','2025-09-05 15:47:55'),(8,7,26,'2025-09-05 04:47:28','2025-09-12 04:59:00','2025-09-05 04:47:28','2025-09-05 15:47:55'),(9,7,17,'2025-09-05 04:54:04','2025-09-12 04:59:00','2025-09-05 04:54:04','2025-09-05 15:47:55'),(10,7,16,'2025-09-05 04:55:08','2025-09-12 04:59:00','2025-09-05 04:55:08','2025-09-05 15:47:55'),(11,7,25,'2025-09-05 04:56:08','2025-09-12 04:59:00','2025-09-05 04:56:08','2025-09-05 04:56:08'),(14,7,29,'2025-09-05 05:05:24','2025-09-05 05:05:24','2025-09-05 05:05:24','2025-09-05 05:12:33'),(15,8,26,'2025-09-06 21:58:30','2025-09-14 04:59:00','2025-09-06 21:58:30','2025-09-06 21:58:30'),(16,5,27,'2025-09-07 11:59:05','2025-09-15 04:59:00','2025-09-07 11:59:05','2025-09-07 11:59:05'),(17,9,26,'2025-09-16 03:43:12','2025-09-23 04:59:00','2025-09-16 03:43:12','2025-09-16 03:43:12'),(18,6,13,'2025-09-17 19:19:01','2025-09-25 04:59:00','2025-09-17 19:19:01','2025-09-17 19:19:01');
/*!40000 ALTER TABLE `prueba_grupos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pruebas`
--

DROP TABLE IF EXISTS `pruebas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pruebas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `profesor_id` bigint NOT NULL,
  `asignatura_id` int NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_pruebas_profesor` (`profesor_id`),
  KEY `idx_pruebas_asignatura` (`asignatura_id`),
  CONSTRAINT `pruebas_ibfk_1` FOREIGN KEY (`profesor_id`) REFERENCES `users` (`id`),
  CONSTRAINT `pruebas_ibfk_2` FOREIGN KEY (`asignatura_id`) REFERENCES `asignaturas` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pruebas`
--

LOCK TABLES `pruebas` WRITE;
/*!40000 ALTER TABLE `pruebas` DISABLE KEYS */;
INSERT INTO `pruebas` VALUES (1,'PRUEBA DE COMPRENSIÓN LECTORA Y PREGUNTAS SUELTAS','srtyhsetysetrgserg',19,12,'2025-09-04 07:19:36','2025-09-04 07:19:36'),(2,'PRUEBA DE COMPRENSIÓN LECTORA Y PREGUNTAS SUELTAS','eqwrtaewrtafd',19,12,'2025-09-04 07:31:03','2025-09-04 07:31:03'),(3,'Examen de Álgebra Básica','Evaluación de conceptos fundamentales de álgebra para grado séptimo',19,12,'2025-09-04 13:38:08','2025-09-04 13:56:53'),(4,'Comprensión Lectora y Gramática','Evaluación de comprensión de textos y conocimientos gramaticales',19,12,'2025-09-04 13:38:08','2025-09-04 13:56:53'),(5,'El Sistema Solar','Evaluación sobre planetas, estrellas y fenómenos astronómicos',19,12,'2025-09-04 13:38:08','2025-09-04 13:56:53'),(6,'Historia de Colombia','Evaluación sobre los períodos históricos más importantes de Colombia',19,12,'2025-09-04 13:38:09','2025-09-04 13:56:53'),(7,'Basic Grammar and Vocabulary','Test on fundamental English grammar rules and vocabulary',19,12,'2025-09-04 13:38:09','2025-09-04 13:56:53'),(8,'PRUEBA DE COMPRENSIÓN LECTORA Y PREGUNTAS SUELTAS','xnxcb',26,13,'2025-09-06 16:58:17','2025-09-06 16:58:17'),(9,'prueba daniel','prueba daniel',19,12,'2025-09-15 22:42:22','2025-09-15 22:42:22');
/*!40000 ALTER TABLE `pruebas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `respuestas`
--

DROP TABLE IF EXISTS `respuestas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `respuestas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `estudiante_id` bigint NOT NULL,
  `pregunta_id` int NOT NULL,
  `prueba_id` int NOT NULL,
  `opcion_elegida` char(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `respuesta_correcta` tinyint(1) NOT NULL DEFAULT '0',
  `fecha_respuesta` datetime DEFAULT CURRENT_TIMESTAMP,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_respuestas_estudiante` (`estudiante_id`),
  KEY `idx_respuestas_pregunta` (`pregunta_id`),
  KEY `respuestes_ibfk_3` (`prueba_id`),
  CONSTRAINT `respuestas_ibfk_1` FOREIGN KEY (`estudiante_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `respuestas_ibfk_2` FOREIGN KEY (`pregunta_id`) REFERENCES `preguntas` (`id`) ON DELETE CASCADE,
  CONSTRAINT `respuestas_chk_1` CHECK ((`opcion_elegida` in (_utf8mb4'a',_utf8mb4'b',_utf8mb4'c',_utf8mb4'd')))
) ENGINE=InnoDB AUTO_INCREMENT=130 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `respuestas`
--

LOCK TABLES `respuestas` WRITE;
/*!40000 ALTER TABLE `respuestas` DISABLE KEYS */;
INSERT INTO `respuestas` VALUES (21,20,1,1,'a',0,'2025-09-04 18:36:09','2025-09-04 13:36:09','2025-09-04 13:36:09'),(22,20,6,3,'b',0,'2025-09-04 19:54:29','2025-09-04 14:54:29','2025-09-04 14:54:29'),(23,20,7,3,'c',0,'2025-09-04 19:54:29','2025-09-04 14:54:29','2025-09-04 14:54:29'),(24,20,16,3,'b',0,'2025-09-04 19:54:29','2025-09-04 14:54:29','2025-09-04 14:54:29'),(25,20,17,3,'b',0,'2025-09-04 19:54:29','2025-09-04 14:54:29','2025-09-04 14:54:29'),(26,20,18,3,'b',0,'2025-09-04 19:54:29','2025-09-04 14:54:29','2025-09-04 14:54:29'),(27,20,19,3,'a',0,'2025-09-04 19:54:29','2025-09-04 14:54:29','2025-09-04 14:54:29'),(28,20,20,3,'b',0,'2025-09-04 19:54:29','2025-09-04 14:54:29','2025-09-04 14:54:29'),(29,20,21,3,'c',0,'2025-09-04 19:54:29','2025-09-04 14:54:29','2025-09-04 14:54:29'),(30,20,22,3,'c',0,'2025-09-04 19:54:29','2025-09-04 14:54:29','2025-09-04 14:54:29'),(31,20,23,3,'b',0,'2025-09-04 19:54:29','2025-09-04 14:54:29','2025-09-04 14:54:29'),(32,20,24,3,'c',0,'2025-09-04 19:54:29','2025-09-04 14:54:29','2025-09-04 14:54:29'),(33,20,25,3,'b',0,'2025-09-04 19:54:29','2025-09-04 14:54:29','2025-09-04 14:54:29'),(34,20,26,3,'b',0,'2025-09-04 19:54:29','2025-09-04 14:54:29','2025-09-04 14:54:29'),(35,20,27,3,'a',0,'2025-09-04 19:54:29','2025-09-04 14:54:29','2025-09-04 14:54:29'),(36,20,28,3,'c',0,'2025-09-04 19:54:29','2025-09-04 14:54:29','2025-09-04 14:54:29'),(37,20,12,6,'a',0,'2025-09-04 19:54:37','2025-09-04 14:54:37','2025-09-04 14:54:37'),(38,20,13,6,'b',0,'2025-09-04 19:54:37','2025-09-04 14:54:37','2025-09-04 14:54:37'),(39,20,2,2,'a',0,'2025-09-04 19:54:45','2025-09-04 14:54:45','2025-09-04 14:54:45'),(40,20,3,2,'a',0,'2025-09-04 19:54:45','2025-09-04 14:54:45','2025-09-04 14:54:45'),(41,20,4,2,'b',0,'2025-09-04 19:54:45','2025-09-04 14:54:45','2025-09-04 14:54:45'),(42,20,5,2,'c',0,'2025-09-04 19:54:45','2025-09-04 14:54:45','2025-09-04 14:54:45'),(43,23,12,6,'a',0,'2025-09-04 20:10:08','2025-09-04 15:10:08','2025-09-04 15:10:08'),(44,23,13,6,'b',0,'2025-09-04 20:10:08','2025-09-04 15:10:08','2025-09-04 15:10:08'),(45,23,6,3,'a',0,'2025-09-04 20:15:28','2025-09-04 15:15:28','2025-09-04 15:15:28'),(46,23,7,3,'b',0,'2025-09-04 20:15:28','2025-09-04 15:15:28','2025-09-04 15:15:28'),(47,23,16,3,'a',0,'2025-09-04 20:15:28','2025-09-04 15:15:28','2025-09-04 15:15:28'),(48,23,17,3,'b',0,'2025-09-04 20:15:28','2025-09-04 15:15:28','2025-09-04 15:15:28'),(49,23,18,3,'c',0,'2025-09-04 20:15:28','2025-09-04 15:15:28','2025-09-04 15:15:28'),(50,23,19,3,'c',0,'2025-09-04 20:15:28','2025-09-04 15:15:28','2025-09-04 15:15:28'),(51,23,20,3,'b',0,'2025-09-04 20:15:28','2025-09-04 15:15:28','2025-09-04 15:15:28'),(52,23,21,3,'b',0,'2025-09-04 20:15:28','2025-09-04 15:15:28','2025-09-04 15:15:28'),(53,23,22,3,'b',0,'2025-09-04 20:15:29','2025-09-04 15:15:29','2025-09-04 15:15:29'),(54,23,23,3,'b',0,'2025-09-04 20:15:29','2025-09-04 15:15:29','2025-09-04 15:15:29'),(55,23,24,3,'b',0,'2025-09-04 20:15:29','2025-09-04 15:15:29','2025-09-04 15:15:29'),(56,23,25,3,'a',0,'2025-09-04 20:15:29','2025-09-04 15:15:29','2025-09-04 15:15:29'),(57,23,26,3,'c',0,'2025-09-04 20:15:29','2025-09-04 15:15:29','2025-09-04 15:15:29'),(58,23,27,3,'a',0,'2025-09-04 20:15:29','2025-09-04 15:15:29','2025-09-04 15:15:29'),(59,23,28,3,'c',0,'2025-09-04 20:15:29','2025-09-04 15:15:29','2025-09-04 15:15:29'),(60,21,6,3,'c',0,'2025-09-05 04:19:17','2025-09-04 23:19:17','2025-09-04 23:19:17'),(61,21,7,3,'b',0,'2025-09-05 04:19:18','2025-09-04 23:19:18','2025-09-04 23:19:18'),(62,21,16,3,'a',0,'2025-09-05 04:19:18','2025-09-04 23:19:18','2025-09-04 23:19:18'),(63,21,17,3,'a',0,'2025-09-05 04:19:18','2025-09-04 23:19:18','2025-09-04 23:19:18'),(64,21,18,3,'a',0,'2025-09-05 04:19:18','2025-09-04 23:19:18','2025-09-04 23:19:18'),(65,21,19,3,'a',0,'2025-09-05 04:19:18','2025-09-04 23:19:18','2025-09-04 23:19:18'),(66,21,20,3,'b',0,'2025-09-05 04:19:18','2025-09-04 23:19:18','2025-09-04 23:19:18'),(67,21,21,3,'b',0,'2025-09-05 04:19:18','2025-09-04 23:19:18','2025-09-04 23:19:18'),(68,21,22,3,'a',0,'2025-09-05 04:19:18','2025-09-04 23:19:18','2025-09-04 23:19:18'),(69,21,23,3,'b',0,'2025-09-05 04:19:18','2025-09-04 23:19:18','2025-09-04 23:19:18'),(70,21,24,3,'b',0,'2025-09-05 04:19:18','2025-09-04 23:19:18','2025-09-04 23:19:18'),(71,21,25,3,'b',0,'2025-09-05 04:19:18','2025-09-04 23:19:18','2025-09-04 23:19:18'),(72,21,26,3,'b',0,'2025-09-05 04:19:18','2025-09-04 23:19:18','2025-09-04 23:19:18'),(73,21,27,3,'c',0,'2025-09-05 04:19:18','2025-09-04 23:19:18','2025-09-04 23:19:18'),(74,21,28,3,'c',0,'2025-09-05 04:19:18','2025-09-04 23:19:18','2025-09-04 23:19:18'),(75,21,2,2,'a',0,'2025-09-05 04:25:44','2025-09-04 23:25:44','2025-09-04 23:25:44'),(76,21,3,2,'a',0,'2025-09-05 04:25:44','2025-09-04 23:25:44','2025-09-04 23:25:44'),(77,21,4,2,'a',0,'2025-09-05 04:25:44','2025-09-04 23:25:44','2025-09-04 23:25:44'),(78,21,5,2,'b',0,'2025-09-05 04:25:44','2025-09-04 23:25:44','2025-09-04 23:25:44'),(79,21,12,6,'b',0,'2025-09-05 04:34:38','2025-09-04 23:34:38','2025-09-04 23:34:38'),(80,21,13,6,'a',0,'2025-09-05 04:34:38','2025-09-04 23:34:38','2025-09-04 23:34:38'),(81,21,1,1,'a',0,'2025-09-05 04:37:08','2025-09-04 23:37:08','2025-09-04 23:37:08'),(82,24,1,1,'b',0,'2025-09-05 04:39:25','2025-09-04 23:39:25','2025-09-04 23:39:25'),(83,24,6,3,'b',0,'2025-09-05 04:40:55','2025-09-04 23:40:55','2025-09-04 23:40:55'),(84,24,7,3,'a',0,'2025-09-05 04:40:55','2025-09-04 23:40:55','2025-09-04 23:40:55'),(85,24,16,3,'a',0,'2025-09-05 04:40:55','2025-09-04 23:40:55','2025-09-04 23:40:55'),(86,24,17,3,'c',0,'2025-09-05 04:40:55','2025-09-04 23:40:55','2025-09-04 23:40:55'),(87,24,18,3,'a',0,'2025-09-05 04:40:55','2025-09-04 23:40:55','2025-09-04 23:40:55'),(88,24,19,3,'c',0,'2025-09-05 04:40:55','2025-09-04 23:40:55','2025-09-04 23:40:55'),(89,24,20,3,'a',0,'2025-09-05 04:40:55','2025-09-04 23:40:55','2025-09-04 23:40:55'),(90,24,21,3,'b',0,'2025-09-05 04:40:55','2025-09-04 23:40:55','2025-09-04 23:40:55'),(91,24,22,3,'b',0,'2025-09-05 04:40:55','2025-09-04 23:40:55','2025-09-04 23:40:55'),(92,24,23,3,'b',0,'2025-09-05 04:40:55','2025-09-04 23:40:55','2025-09-04 23:40:55'),(93,24,24,3,'b',0,'2025-09-05 04:40:55','2025-09-04 23:40:55','2025-09-04 23:40:55'),(94,24,25,3,'b',0,'2025-09-05 04:40:56','2025-09-04 23:40:56','2025-09-04 23:40:56'),(95,24,26,3,'c',0,'2025-09-05 04:40:56','2025-09-04 23:40:56','2025-09-04 23:40:56'),(96,24,27,3,'b',0,'2025-09-05 04:40:56','2025-09-04 23:40:56','2025-09-04 23:40:56'),(97,24,28,3,'b',0,'2025-09-05 04:40:56','2025-09-04 23:40:56','2025-09-04 23:40:56'),(98,23,14,7,'c',0,'2025-09-05 13:02:51','2025-09-05 08:02:51','2025-09-05 08:02:51'),(99,23,15,7,'c',0,'2025-09-05 13:02:51','2025-09-05 08:02:51','2025-09-05 08:02:51'),(100,21,14,7,'b',0,'2025-09-05 16:10:18','2025-09-05 11:10:18','2025-09-05 11:10:18'),(101,21,15,7,'b',0,'2025-09-05 16:10:18','2025-09-05 11:10:18','2025-09-05 11:10:18'),(102,22,14,7,'a',0,'2025-09-06 17:03:48','2025-09-06 12:03:48','2025-09-06 12:03:48'),(103,22,15,7,'c',0,'2025-09-06 17:03:48','2025-09-06 12:03:48','2025-09-06 12:03:48'),(104,22,6,3,'c',0,'2025-09-06 17:04:43','2025-09-06 12:04:43','2025-09-06 12:04:43'),(105,22,7,3,'b',0,'2025-09-06 17:04:43','2025-09-06 12:04:43','2025-09-06 12:04:43'),(106,22,16,3,'c',0,'2025-09-06 17:04:43','2025-09-06 12:04:43','2025-09-06 12:04:43'),(107,22,17,3,'b',0,'2025-09-06 17:04:43','2025-09-06 12:04:43','2025-09-06 12:04:43'),(108,22,18,3,'c',0,'2025-09-06 17:04:43','2025-09-06 12:04:43','2025-09-06 12:04:43'),(109,22,19,3,'c',0,'2025-09-06 17:04:43','2025-09-06 12:04:43','2025-09-06 12:04:43'),(110,22,20,3,'c',0,'2025-09-06 17:04:43','2025-09-06 12:04:43','2025-09-06 12:04:43'),(111,22,21,3,'b',0,'2025-09-06 17:04:43','2025-09-06 12:04:43','2025-09-06 12:04:43'),(112,22,22,3,'b',0,'2025-09-06 17:04:43','2025-09-06 12:04:43','2025-09-06 12:04:43'),(113,22,23,3,'c',0,'2025-09-06 17:04:43','2025-09-06 12:04:43','2025-09-06 12:04:43'),(114,22,24,3,'b',0,'2025-09-06 17:04:43','2025-09-06 12:04:43','2025-09-06 12:04:43'),(115,22,25,3,'c',0,'2025-09-06 17:04:43','2025-09-06 12:04:43','2025-09-06 12:04:43'),(116,22,26,3,'c',0,'2025-09-06 17:04:43','2025-09-06 12:04:43','2025-09-06 12:04:43'),(117,22,27,3,'b',0,'2025-09-06 17:04:43','2025-09-06 12:04:43','2025-09-06 12:04:43'),(118,22,28,3,'b',0,'2025-09-06 17:04:43','2025-09-06 12:04:43','2025-09-06 12:04:43'),(119,20,29,8,'b',0,'2025-09-06 21:59:01','2025-09-06 16:59:01','2025-09-06 16:59:01'),(120,20,14,7,'b',0,'2025-09-06 22:00:50','2025-09-06 17:00:51','2025-09-06 17:00:51'),(121,20,15,7,'b',0,'2025-09-06 22:00:51','2025-09-06 17:00:51','2025-09-06 17:00:51'),(122,21,29,8,'b',0,'2025-09-06 22:03:56','2025-09-06 17:03:56','2025-09-06 17:03:56'),(123,24,29,8,'b',0,'2025-09-07 03:44:15','2025-09-06 22:44:15','2025-09-06 22:44:15'),(124,25,10,5,'b',0,'2025-09-07 12:11:34','2025-09-07 07:11:34','2025-09-07 07:11:34'),(125,25,11,5,'b',0,'2025-09-07 12:11:34','2025-09-07 07:11:34','2025-09-07 07:11:34'),(126,25,29,8,'b',0,'2025-09-07 12:13:33','2025-09-07 07:13:33','2025-09-07 07:13:33'),(127,20,30,9,'b',0,'2025-09-16 03:44:25','2025-09-15 22:44:25','2025-09-15 22:44:25'),(128,20,31,9,'b',0,'2025-09-16 03:44:25','2025-09-15 22:44:25','2025-09-15 22:44:25'),(129,20,32,9,'b',0,'2025-09-16 03:44:25','2025-09-15 22:44:25','2025-09-15 22:44:25');
/*!40000 ALTER TABLE `respuestas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `roles` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nombre` (`nombre`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'Profesor','2025-09-04 12:15:35','2025-09-04 12:15:35'),(2,'Estudiante','2025-09-04 12:15:35','2025-09-04 12:15:35'),(3,'Administrador','2025-09-04 12:15:35','2025-09-04 12:15:35');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `login` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` datetime DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `role_id` int NOT NULL,
  `documento` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `telefono` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `direccion` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `genero` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fecha_nacimiento` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT 'DATE',
  `estado` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `login` (`login`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `documento_UNIQUE` (`documento`),
  KEY `idx_users_role` (`role_id`),
  KEY `idx_users_email` (`email`),
  CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (18,'admin','Administrador','Sistema','admin@admin.com',NULL,'$2y$10$Ru/qQsCFJXh9LBqBh/rp7eOz8eKCw3HV5JIrBR4zJIvCV.tpvOxE6',NULL,'2025-09-04 12:15:35','2025-09-06 16:55:52',3,'',NULL,NULL,NULL,'DATE',NULL),(19,'marvinperez408','MARVIN','PEREZ','marvin.santos@soy.sena.edu.co',NULL,'$2y$10$Ru/qQsCFJXh9LBqBh/rp7eOz8eKCw3HV5JIrBR4zJIvCV.tpvOxE6',NULL,'2025-09-04 12:17:59','2025-09-05 16:07:27',1,'10000001','3132311084','KDX 286-300 AV CIRCUNVALAR','MASCULINO','2009-09-15','activo'),(20,'marvinperez810','MARVIN','PEREZ','mesp3127@gmail.com',NULL,'$2y$10$Ru/qQsCFJXh9LBqBh/rp7eOz8eKCw3HV5JIrBR4zJIvCV.tpvOxE6',NULL,'2025-09-04 12:18:40','2025-09-05 16:07:27',2,'10000002','3132311084','KDX 286-300 AV CIRCUNVALAR','FEMENINO','2025-09-04','activo'),(21,'prof_matematicas','María','González','maria.gonzalez@colegio.edu.co',NULL,'$2y$10$Ru/qQsCFJXh9LBqBh/rp7eOz8eKCw3HV5JIrBR4zJIvCV.tpvOxE6',NULL,'2025-09-04 13:38:08','2025-09-04 20:09:20',2,'12345678','3001234567','Calle 123 #45-67','Femenino','1985-05-15','Activo'),(22,'prof_espanol','Carlos','Rodríguez','carlos.rodriguez@colegio.edu.co',NULL,'$2y$10$XHmCSr3q7onZBC/au7IejOv/2S1GJlHmpzSRSZp8SVpf/eK8Votte',NULL,'2025-09-04 13:38:08','2025-09-06 12:05:25',2,'23456789','3002345678','Carrera 45 #12-34','Masculino','1980-08-20','Activo'),(23,'prof_ciencias','Ana','Martínez','ana.martinez@colegio.edu.co',NULL,'$2y$10$Ru/qQsCFJXh9LBqBh/rp7eOz8eKCw3HV5JIrBR4zJIvCV.tpvOxE6',NULL,'2025-09-04 13:38:08','2025-09-04 20:09:20',2,'34567890','3003456789','Avenida 68 #23-45','Femenino','1982-12-10','Activo'),(24,'prof_sociales','Luis','Pérez','luis.perez@colegio.edu.co',NULL,'$2y$10$Ru/qQsCFJXh9LBqBh/rp7eOz8eKCw3HV5JIrBR4zJIvCV.tpvOxE6',NULL,'2025-09-04 13:38:08','2025-09-04 20:09:20',2,'45678901','3004567890','Calle 50 #34-56','Masculino','1978-03-25','Activo'),(25,'prof_ingles','Patricia','López','patricia.lopez@colegio.edu.co',NULL,'$2y$10$Ru/qQsCFJXh9LBqBh/rp7eOz8eKCw3HV5JIrBR4zJIvCV.tpvOxE6',NULL,'2025-09-04 13:38:08','2025-09-04 20:09:20',2,'56789012','3005678901','Transversal 12 #67-89','Femenino','1983-07-18','Activo'),(26,'marvinperez211','Andre','Perez','marvin2.santos@soy.sena.edu.co',NULL,'$2y$10$jm1vGe/aobv4LfsCiFpDRO4oq/ad/D2CSEvgzP8NXpYhQ.8DNFAjK',NULL,'2025-09-06 21:57:15','2025-09-06 17:03:27',1,'10000003','3132311084','KDX 286-300 AV CIRCUNVALAR','MASCULINO','2025-09-24','activo');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-09-17 14:55:02
