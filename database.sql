-- MySQL dump 10.13  Distrib 8.0.39, for Win64 (x86_64)
--
-- Host: localhost    Database: zenpetsdb
-- ------------------------------------------------------
-- Server version	8.0.39

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `bookings`
--

DROP TABLE IF EXISTS `bookings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `bookings` (
  `id` int NOT NULL AUTO_INCREMENT,
  `drname` varchar(250) DEFAULT NULL,
  `username` varchar(250) DEFAULT NULL,
  `booking_date` varchar(20) DEFAULT NULL,
  `booking_time` varchar(10) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bookings`
--

LOCK TABLES `bookings` WRITE;
/*!40000 ALTER TABLE `bookings` DISABLE KEYS */;
INSERT INTO `bookings` VALUES (3,'Dr. Fluffington','omkar','25nov','9-10am','2024-11-07 12:38:27'),(5,'Dr. Pawsome','shubham','18nov','10-11am','2024-11-08 16:51:47');
/*!40000 ALTER TABLE `bookings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cart`
--

DROP TABLE IF EXISTS `cart`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cart` (
  `cart_id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(255) DEFAULT NULL,
  `cartlist` json DEFAULT NULL,
  PRIMARY KEY (`cart_id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cart`
--

LOCK TABLES `cart` WRITE;
/*!40000 ALTER TABLE `cart` DISABLE KEYS */;
INSERT INTO `cart` VALUES (31,'omkar','\"[{\\\"img\\\":\\\"./webimg/productimgs/mainproductimg/Pedigree Adult Dry Dog Food, Chicken & Vegetables Flavour, 10kg Pack img1.jpg\\\",\\\"name\\\":\\\"Pedigree Adult Dry Dog Food, Chicken & Vegetables Flavour, 10kg Pack\\\",\\\"price\\\":2031,\\\"category\\\":\\\"food\\\",\\\"quantity\\\":2,\\\"description\\\":\\\"Pedigree Chicken & Vegetables Adult Dry Dog Food is a wholesome meal, packed with essential nutrients vital to the healthy growth of your pet. \\\\n    \\\\n    The natural goodness of cereals, soybean, carrots, peas & milk blend into a tasty treat for your little one. \\\\n\\\\n    It assures healthier and a shinier coat, strong muscles, good digestive health, healthy bones and teeth, and a stronger immune system Pedigree Chicken & Vegetables Adult Dry Dog Food contains a special mix of fatty acids for healthy skin and coat. \\\\n\\\\n    The optimum ca:p quantitative relation and levels square measure for the sturdy teeth and bones. \\\\n\\\\n    Superior digestion ensures optimum digestion of nutrients. \\\\n\\\\n    Vitamins and minerals within the food square measure for sturdy system. \\\\n\\\\n    Proteins provide your dog with sturdy muscles. \\\\n\\\\n    The high-quality meat proteins help give the dog the energy he needs to enjoy a good game of fetch with his favorite ball.\\\\n\\\\n    Country of Origin: India\\\"},{\\\"img\\\":\\\"./webimg/productimgs/mainproductimg/Pedigree Complete & Balanced Food for Puppy & Adult Dogs, 100% Vegetarian, 1 Kg img1.jpg\\\",\\\"name\\\":\\\"Pedigree Complete & Balanced Food for Puppy & Adult Dogs, 100% Vegetarian, 1 Kg\\\",\\\"price\\\":9795,\\\"category\\\":\\\"food\\\",\\\"quantity\\\":2,\\\"description\\\":\\\"Pedigree provides complete and balanced dog food for puppies and adult dogs to ensure their healthy development. This Pedigree dry food for Puppies and Adult Dogs is 100% Vegetarian. It is a wholesome meal packed with essential nutrients vital to the growth and good health of your pet. The goodness of quality ingredients blends into a tasty and healthy diet for your little furry friend. This food, packed with delicious flavors of vegetables, can be fed to both puppies and adult dogs. Refer to the back of the pack for the feeding guidelines. When fed as per these guidelines, you will see the 5 Signs of Good Health in your pet. These signs include improved natural defense; strong muscles; healthy digestion; strong bones and teeth; and healthy skin and coat. At Pedigree, recipes are developed based on research from the Waltham Centre for Pet Nutrition. Every product from Pedigree meets the requirements laid down by NRC 2006 of the U.S. National Academy of Science. Give your furry companion healthy and lip-smacking mealtimes with Pedigree.\\\"}]\"');
/*!40000 ALTER TABLE `cart` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user` (
  `client_id` tinyint NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  PRIMARY KEY (`client_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'omkar','OM'),(2,'shubham','sh');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-11-23 14:51:11
