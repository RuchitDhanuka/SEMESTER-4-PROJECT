CREATE DATABASE  IF NOT EXISTS `homehive` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `homehive`;
-- MySQL dump 10.13  Distrib 8.0.36, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: homehive
-- ------------------------------------------------------
-- Server version	8.3.0

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
-- Table structure for table `adminlogin`
--

DROP TABLE IF EXISTS `adminlogin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `adminlogin` (
  `admin_id` int NOT NULL,
  `admin_name` varchar(255) NOT NULL,
  `admin_username` varchar(255) NOT NULL,
  `admin_email` varchar(255) NOT NULL,
  `admin_password` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `last_login` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`admin_id`),
  UNIQUE KEY `admin_username` (`admin_username`),
  UNIQUE KEY `admin_email` (`admin_email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `adminlogin`
--

LOCK TABLES `adminlogin` WRITE;
/*!40000 ALTER TABLE `adminlogin` DISABLE KEYS */;
/*!40000 ALTER TABLE `adminlogin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cart`
--

DROP TABLE IF EXISTS `cart`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cart` (
  `cart_id` int NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `cart_code` int DEFAULT NULL,
  `cart_total` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `last_modified` timestamp NULL DEFAULT NULL,
  `status` varchar(255) NOT NULL,
  `address_id` int DEFAULT NULL,
  PRIMARY KEY (`cart_id`),
  UNIQUE KEY `cart_code` (`cart_code`),
  KEY `user_id` (`user_id`),
  KEY `address_id` (`address_id`),
  CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `userlogin` (`user_id`),
  CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`address_id`) REFERENCES `useraddress` (`address_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cart`
--

LOCK TABLES `cart` WRITE;
/*!40000 ALTER TABLE `cart` DISABLE KEYS */;
INSERT INTO `cart` VALUES (3,2,NULL,129,'2024-03-14 16:52:08','2024-03-14 16:52:58','inactive',3),(4,2,NULL,NULL,'2024-03-14 16:53:08',NULL,'active',NULL);
/*!40000 ALTER TABLE `cart` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cartitems`
--

DROP TABLE IF EXISTS `cartitems`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cartitems` (
  `cart_id` int NOT NULL,
  `item_id` int NOT NULL,
  `quantity` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  KEY `item_id` (`item_id`),
  KEY `cart_id` (`cart_id`),
  CONSTRAINT `cartitems_ibfk_2` FOREIGN KEY (`item_id`) REFERENCES `product` (`product_id`),
  CONSTRAINT `cartitems_ibfk_3` FOREIGN KEY (`cart_id`) REFERENCES `cart` (`cart_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cartitems`
--

LOCK TABLES `cartitems` WRITE;
/*!40000 ALTER TABLE `cartitems` DISABLE KEYS */;
INSERT INTO `cartitems` VALUES (3,17,1,'2024-03-14 16:52:58','return');
/*!40000 ALTER TABLE `cartitems` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `orders` (
  `order_id` int NOT NULL AUTO_INCREMENT,
  `cart_id` int NOT NULL,
  `user_id` int NOT NULL,
  `order_status` varchar(255) NOT NULL,
  `placed_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`order_id`),
  KEY `user_id` (`user_id`),
  KEY `cart_id` (`cart_id`),
  CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `userlogin` (`user_id`),
  CONSTRAINT `orders_ibfk_3` FOREIGN KEY (`cart_id`) REFERENCES `cart` (`cart_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
INSERT INTO `orders` VALUES (1,3,2,'orderedplaced','2024-03-14 16:53:08');
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `payment`
--

DROP TABLE IF EXISTS `payment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `payment` (
  `payment_id` int NOT NULL,
  `order_id` int NOT NULL,
  `payment_mode` varchar(255) NOT NULL,
  `amount` int NOT NULL,
  `payment_time` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`payment_id`),
  KEY `order_id` (`order_id`),
  CONSTRAINT `payment_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payment`
--

LOCK TABLES `payment` WRITE;
/*!40000 ALTER TABLE `payment` DISABLE KEYS */;
INSERT INTO `payment` VALUES (852355,1,'upi',129,'2024-03-14 16:53:08');
/*!40000 ALTER TABLE `payment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product`
--

DROP TABLE IF EXISTS `product`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `product` (
  `product_id` int NOT NULL,
  `category_id` int DEFAULT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_price` varchar(255) NOT NULL,
  `product_description` varchar(255) NOT NULL,
  `product_features` varchar(255) NOT NULL,
  `product_image_url` varchar(255) NOT NULL,
  PRIMARY KEY (`product_id`),
  KEY `category_id` (`category_id`),
  CONSTRAINT `product_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `productcategory` (`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product`
--

LOCK TABLES `product` WRITE;
/*!40000 ALTER TABLE `product` DISABLE KEYS */;
INSERT INTO `product` VALUES (1,1,'Modern Sofa Set','599','This sleek and comfortable sofa set is perfect for your living room.','Includes sofa, loveseat, and armchair. Upholstered in premium fabric material.','image_url_of_sofa_set'),(2,1,'Wooden Dining Table','349','Gather your family around this elegant dining table made from solid wood.','Seats up to six people. Sturdy construction with a classic design.','image_url_of_dining_table'),(3,1,'Sectional Corner Sofa','799','Maximize seating space with this versatile sectional corner sofa.','Adjustable headrests and armrests. Upholstered in leather material.','image_url_of_sectional_sofa'),(4,1,'Bedroom Dresser','249','Organize your clothes and accessories with this spacious bedroom dresser.','Multiple drawers with sleek handles. Constructed from durable wood materials.','image_url_of_bedroom_dresser'),(5,1,'Coffee Table Set','179','Complete your living room setup with this stylish coffee table set.','Includes a center table and two side tables. Made from high-quality wood.','image_url_of_coffee_table_set'),(6,1,'Accent Armchair','199','Add a pop of color and style to any room with this chic accent armchair.','Upholstered in soft fabric with a modern design. Sturdy wooden legs.','image_url_of_accent_armchair'),(7,1,'TV Stand Entertainment Center','299','Organize your entertainment essentials with this sleek TV stand.','Features shelving for media components and storage cabinets. Accommodates large TVs.','image_url_of_tv_stand'),(8,1,'Corner Bookshelf','129','Maximize space in your home office or living room with this corner bookshelf.','Five-tier design with open shelves. Constructed from sturdy engineered wood.','image_url_of_corner_bookshelf'),(9,1,'Platform Bed Frame','449','Enjoy a restful night\'s sleep on this stylish platform bed frame.','Minimalist design with a sturdy metal frame. Available in multiple sizes.','image_url_of_platform_bed_frame'),(10,1,'Lounge Chaise Chair','379','Relax in luxury with this elegant lounge chaise chair.','Curved design for ergonomic comfort. Upholstered in plush velvet material.','image_url_of_lounge_chaise_chair'),(11,1,'Wall-mounted Shelves','89','Organize and display your favorite decor items with these versatile wall-mounted shelves.','Set of three shelves in different sizes. Easy to install.','image_url_of_wall_mounted_shelves'),(12,1,'Desk and Chair Set','299','Create a productive workspace at home with this desk and chair set.','Desk features a spacious tabletop and storage drawers. Chair designed for comfort and support.','image_url_of_desk_and_chair_set'),(13,2,'Smart Refrigerator','899','Keep your food fresh and organized with this smart refrigerator featuring built-in Wi-Fi connectivity.','Large capacity with adjustable shelves and energy-efficient LED lighting.','image_url_of_smart_refrigerator'),(14,2,'Robotic Vacuum Cleaner','299','Make cleaning effortless with this robotic vacuum cleaner that navigates and cleans your floors automatically.','Programmable scheduling and multiple cleaning modes for customized cleaning.','image_url_of_robotic_vacuum_cleaner'),(15,2,'Smart Washing Machine','699','Simplify your laundry routine with this smart washing machine that offers advanced features and customizable cycles.','Large capacity with various wash programs and remote control functionality.','image_url_of_smart_washing_machine'),(16,2,'Smart Microwave Oven','179','Prepare meals quickly and easily with this smart microwave oven featuring intuitive controls and sensor cooking technology.','Multiple cooking presets and child lock function for safety.','image_url_of_smart_microwave_oven'),(17,2,'Wi-Fi Enabled Coffee Maker','129','Start your day right with a freshly brewed cup of coffee from this Wi-Fi enabled coffee maker.','Programmable brewing options and a built-in grinder for freshly ground coffee.','image_url_of_wifi_coffee_maker'),(18,2,'Smart Air Purifier','249','Improve indoor air quality and breathe easier with this smart air purifier featuring HEPA filtration and air quality monitoring.','Multiple fan speeds and customizable settings. Compatible with smart home systems.','image_url_of_smart_air_purifier'),(19,2,'Digital Smart Scale','49','Achieve your health goals with this digital smart scale that measures weight, body fat, and more.','Sleek and modern design with Bluetooth connectivity for tracking progress on your smartphone.','image_url_of_smart_scale'),(20,2,'Portable Blender','39','Blend smoothies and shakes on the go with this portable blender thats perfect for busy lifestyles.','Compact and lightweight design with a rechargeable battery. BPA-free materials for safety.','image_url_of_portable_blender'),(21,2,'Smart Thermostat','149','Control your homes temperature from anywhere with this smart thermostat featuring programmable scheduling and energy-saving features.','Compatible with most HVAC systems and voice assistants for hands-free control.','image_url_of_smart_thermostat'),(22,2,'Wireless Security Camera','79','Monitor your home or office remotely with this wireless security camera that streams HD video to your smartphone.','Motion detection alerts and night vision capabilities for round-the-clock surveillance.','image_url_of_security_camera'),(23,2,'Smart Doorbell','129','Enhance home security and convenience with this smart doorbell that lets you see and speak to visitors from your smartphone.','Built-in camera with motion detection and two-way audio communication.','image_url_of_smart_doorbell'),(24,2,'Smart Light Bulb Kit','99','Transform your homes lighting with these smart light bulbs that offer customizable colors and brightness levels.','Controlled via smartphone app or voice commands. Energy-efficient LED technology.','image_url_of_smart_light_bulbs'),(25,3,'Stainless Steel Blender','79','Blend smoothies, sauces, and more with ease using this powerful stainless steel blender.','Durable construction with multiple speed settings and easy-to-clean design.','image_url_of_stainless_steel_blender'),(26,3,'Electric Rice Cooker','49','Prepare perfect rice every time with this electric rice cooker featuring automatic cooking and keep-warm functions.','Non-stick inner pot with a removable lid for easy cleaning.','image_url_of_rice_cooker'),(27,3,'Digital Air Fryer','89','Enjoy healthier cooking with this digital air fryer that uses hot air circulation to fry food with little to no oil.','Adjustable temperature and timer settings with a large capacity basket.','image_url_of_air_fryer'),(28,3,'Countertop Blender','59','Create delicious smoothies, shakes, and soups with this versatile countertop blender.','Powerful motor and durable blades for efficient blending. Easy-to-use controls.','image_url_of_countertop_blender'),(29,3,'Electric Kettle','29','Boil water quickly and efficiently with this electric kettle featuring a sleek stainless steel design.','Automatic shut-off and boil-dry protection for safety. Cordless operation for easy serving.','image_url_of_electric_kettle'),(30,3,'Food Processor','99','Slice, chop, and shred ingredients with ease using this multifunctional food processor.','Multiple attachments for various food prep tasks. Large capacity bowl for big batches.','image_url_of_food_processor'),(31,3,'Toaster Oven','69','Bake, broil, and toast with precision using this compact and versatile toaster oven.','Adjustable temperature and timer settings with a removable crumb tray for easy cleaning.','image_url_of_toaster_oven'),(32,3,'Coffee Grinder','39','Grind coffee beans to your desired coarseness with this electric coffee grinder.','Stainless steel blades and a large capacity chamber for efficient grinding.','image_url_of_coffee_grinder'),(33,3,'Slow Cooker','49','Prepare flavorful meals with minimal effort using this programmable slow cooker.','Large capacity and customizable cooking settings. Removable stoneware pot for easy cleaning.','image_url_of_slow_cooker'),(34,3,'Hand Blender','39','Blend, puree, and whisk ingredients directly in the pot or bowl with this convenient hand blender.','Compact and lightweight design with multiple speed settings. Easy to clean and store.','image_url_of_hand_blender'),(35,3,'Juicer Extractor','89','Create fresh and nutritious juices at home with this powerful juicer extractor.','Wide chute for whole fruits and vegetables. Easy-to-clean design with dishwasher-safe parts.','image_url_of_juicer_extractor'),(36,3,'Electric Can Opener','19','Open cans effortlessly with this electric can opener featuring a sleek and compact design.','One-touch operation and automatic shut-off. Magnetic lid holder for safe disposal.','image_url_of_electric_can_opener');
/*!40000 ALTER TABLE `product` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `productcategory`
--

DROP TABLE IF EXISTS `productcategory`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `productcategory` (
  `category_id` int NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `category_description` varchar(255) NOT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `productcategory`
--

LOCK TABLES `productcategory` WRITE;
/*!40000 ALTER TABLE `productcategory` DISABLE KEYS */;
INSERT INTO `productcategory` VALUES (1,'Furniture','Explore our collection of stylish and durable furniture pieces for your home.'),(2,'Home Appliance','Discover our range of innovative home appliances to simplify your daily tasks.'),(3,'Kitchen Appliance','Browse through our selection of high-quality kitchen appliances to enhance your cooking experience.');
/*!40000 ALTER TABLE `productcategory` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `productinventory`
--

DROP TABLE IF EXISTS `productinventory`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `productinventory` (
  `product_id` int DEFAULT NULL,
  `product_quantity` int NOT NULL,
  `last_modified` timestamp NULL DEFAULT NULL,
  KEY `product_id` (`product_id`),
  CONSTRAINT `productinventory_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `productinventory`
--

LOCK TABLES `productinventory` WRITE;
/*!40000 ALTER TABLE `productinventory` DISABLE KEYS */;
INSERT INTO `productinventory` VALUES (1,50,'2024-03-14 16:16:24'),(2,30,'2024-03-14 16:16:24'),(3,25,'2024-03-14 16:16:24'),(4,40,'2024-03-14 16:16:24'),(5,35,'2024-03-14 16:16:24'),(6,20,'2024-03-14 16:16:24'),(7,25,'2024-03-14 16:16:24'),(8,30,'2024-03-14 16:16:24'),(9,15,'2024-03-14 16:16:24'),(10,20,'2024-03-14 16:16:24'),(11,40,'2024-03-14 16:16:24'),(12,25,'2024-03-14 16:16:24'),(13,20,'2024-03-14 16:16:35'),(14,15,'2024-03-14 16:16:35'),(15,18,'2024-03-14 16:16:35'),(16,25,'2024-03-14 16:16:35'),(17,30,'2024-03-14 16:16:35'),(18,22,'2024-03-14 16:16:35'),(19,35,'2024-03-14 16:16:35'),(20,40,'2024-03-14 16:16:35'),(21,20,'2024-03-14 16:16:35'),(22,28,'2024-03-14 16:16:35'),(23,25,'2024-03-14 16:16:35'),(24,15,'2024-03-14 16:16:35'),(25,25,'2024-03-14 16:16:43'),(26,18,'2024-03-14 16:16:43'),(27,30,'2024-03-14 16:16:43'),(28,22,'2024-03-14 16:16:43'),(29,35,'2024-03-14 16:16:43'),(30,20,'2024-03-14 16:16:43'),(31,28,'2024-03-14 16:16:43'),(32,30,'2024-03-14 16:16:43'),(33,15,'2024-03-14 16:16:43'),(34,20,'2024-03-14 16:16:43'),(35,40,'2024-03-14 16:16:43'),(36,25,'2024-03-14 16:16:43');
/*!40000 ALTER TABLE `productinventory` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `query`
--

DROP TABLE IF EXISTS `query`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `query` (
  `name` varchar(255) NOT NULL,
  `email_id` varchar(255) NOT NULL,
  `message` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `query`
--

LOCK TABLES `query` WRITE;
/*!40000 ALTER TABLE `query` DISABLE KEYS */;
/*!40000 ALTER TABLE `query` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `returnproduct`
--

DROP TABLE IF EXISTS `returnproduct`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `returnproduct` (
  `return_id` int NOT NULL AUTO_INCREMENT,
  `cart_id` int NOT NULL,
  `user_id` int NOT NULL,
  `refund_mode` varchar(255) NOT NULL,
  `upi_id` varchar(255) DEFAULT NULL,
  `return_date` timestamp NOT NULL,
  `amount` int NOT NULL,
  PRIMARY KEY (`return_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `returnproduct_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `userlogin` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `returnproduct`
--

LOCK TABLES `returnproduct` WRITE;
/*!40000 ALTER TABLE `returnproduct` DISABLE KEYS */;
INSERT INTO `returnproduct` VALUES (1,3,2,'wallet','','2024-03-14 16:53:17',129);
/*!40000 ALTER TABLE `returnproduct` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `useraddress`
--

DROP TABLE IF EXISTS `useraddress`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `useraddress` (
  `user_id` int NOT NULL,
  `address_line1` varchar(255) NOT NULL,
  `address_line2` varchar(255) DEFAULT NULL,
  `postal_code` int NOT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `address_id` int NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`address_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `useraddress_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `userlogin` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `useraddress`
--

LOCK TABLES `useraddress` WRITE;
/*!40000 ALTER TABLE `useraddress` DISABLE KEYS */;
INSERT INTO `useraddress` VALUES (2,'shantipara, Dibrugarh','1st floor,s.k.tibrewal building,pradeep sangha lane',786001,'DIBRUGARH','Assam','India',3);
/*!40000 ALTER TABLE `useraddress` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `userlogin`
--

DROP TABLE IF EXISTS `userlogin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `userlogin` (
  `user_id` int NOT NULL AUTO_INCREMENT,
  `user_name` varchar(255) NOT NULL,
  `user_username` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `last_login` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `user_username` (`user_username`),
  UNIQUE KEY `user_email` (`user_email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `userlogin`
--

LOCK TABLES `userlogin` WRITE;
/*!40000 ALTER TABLE `userlogin` DISABLE KEYS */;
INSERT INTO `userlogin` VALUES (2,'Ruchit','ruchit','ruchitdhanuka6@gmail.com','81rky97','2024-03-14 16:51:41','2024-03-14 16:52:08');
/*!40000 ALTER TABLE `userlogin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `userwallet`
--

DROP TABLE IF EXISTS `userwallet`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `userwallet` (
  `user_id` int NOT NULL,
  `balance` int NOT NULL,
  KEY `user_id` (`user_id`),
  CONSTRAINT `userwallet_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `userlogin` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `userwallet`
--

LOCK TABLES `userwallet` WRITE;
/*!40000 ALTER TABLE `userwallet` DISABLE KEYS */;
INSERT INTO `userwallet` VALUES (2,129);
/*!40000 ALTER TABLE `userwallet` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-03-14 22:29:55
