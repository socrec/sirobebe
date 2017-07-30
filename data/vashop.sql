/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50621
Source Host           : 127.0.0.1:3306
Source Database       : vashop

Target Server Type    : MYSQL
Target Server Version : 50621
File Encoding         : 65001

Date: 2017-07-30 21:09:56
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for customers
-- ----------------------------
DROP TABLE IF EXISTS `customers`;
CREATE TABLE `customers` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `facebook` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `ward` varchar(255) DEFAULT NULL,
  `district` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of customers
-- ----------------------------
INSERT INTO `customers` VALUES ('4', 'cự ssss', '0988.505.433	', 'https://www.facebook.com/profile.php?id=100010744830180', 'Nguyễn Thị Kim Hoàng Cán bộ đội TMTH Trại giam cây cầy Thạnh Hoà, Thạnh Bình, Tân Biên, Tây Ninh	', 'thạnh bình	', 'tân biên	', 'tây ninh	');
INSERT INTO `customers` VALUES ('5', '213123', '123', '123', '1232', '123231', '123231', '12');
INSERT INTO `customers` VALUES ('6', 'Nguyen Hai Dang', '0966682338', '', 'Phu Thi - Gia Lam', '123321', '132132', 'Hanoi');
INSERT INTO `customers` VALUES ('7', 'Dang Nguyen', '0966682234', '123', 'Ho Chi Minh', '123123', 'HCM', 'HCM');

-- ----------------------------
-- Table structure for migration
-- ----------------------------
DROP TABLE IF EXISTS `migration`;
CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of migration
-- ----------------------------
INSERT INTO `migration` VALUES ('m000000_000000_base', '1497089099');
INSERT INTO `migration` VALUES ('m130524_201442_init', '1497089102');
INSERT INTO `migration` VALUES ('m170610_101144_add_admin_user', '1497089683');

-- ----------------------------
-- Table structure for orders
-- ----------------------------
DROP TABLE IF EXISTS `orders`;
CREATE TABLE `orders` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `customer_id` bigint(20) DEFAULT NULL,
  `total` decimal(32,0) DEFAULT NULL,
  `shipping_fee` decimal(32,0) DEFAULT NULL,
  `memo` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of orders
-- ----------------------------
INSERT INTO `orders` VALUES ('1', '5', '123', '1', 'Test\r\netsv\r\nsd\r\nvsdv');
INSERT INTO `orders` VALUES ('2', '5', '213', '123', null);
INSERT INTO `orders` VALUES ('3', '5', '123123', '1', '23123213\r\n123123');
INSERT INTO `orders` VALUES ('4', '6', '123', '123', '123');
INSERT INTO `orders` VALUES ('5', '4', '10000', '12', '');
INSERT INTO `orders` VALUES ('6', '7', '90000', '9000', '90900');

-- ----------------------------
-- Table structure for order_product_sizes
-- ----------------------------
DROP TABLE IF EXISTS `order_product_sizes`;
CREATE TABLE `order_product_sizes` (
  `id` bigint(32) NOT NULL AUTO_INCREMENT,
  `product_size_id` bigint(32) DEFAULT NULL,
  `quantity` bigint(32) DEFAULT NULL,
  `sell_price` decimal(32,0) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of order_product_sizes
-- ----------------------------

-- ----------------------------
-- Table structure for products
-- ----------------------------
DROP TABLE IF EXISTS `products`;
CREATE TABLE `products` (
  `id` bigint(32) NOT NULL AUTO_INCREMENT,
  `title` varchar(300) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `from` varchar(300) DEFAULT NULL,
  `type` varchar(200) DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `style_id` bigint(32) DEFAULT NULL,
  `list_price` decimal(32,0) NOT NULL,
  `import_price` decimal(32,0) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of products
-- ----------------------------
INSERT INTO `products` VALUES ('12', 'Quần Đùi', '2017-07-29', 'Test', 'New', 'Boy', '2', '50000', '20000', null, null);

-- ----------------------------
-- Table structure for product_images
-- ----------------------------
DROP TABLE IF EXISTS `product_images`;
CREATE TABLE `product_images` (
  `id` bigint(32) NOT NULL AUTO_INCREMENT,
  `product_id` bigint(32) DEFAULT NULL,
  `path` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of product_images
-- ----------------------------
INSERT INTO `product_images` VALUES ('1', '11', 'uploads/18362253_1286389384802388_999885362_o.jpg');
INSERT INTO `product_images` VALUES ('2', '11', 'uploads/18620297_10155243979002141_7553569249730215790_n.jpg');
INSERT INTO `product_images` VALUES ('3', '11', 'uploads/19223025_1424556157611232_5372023399373301341_o.jpg');
INSERT INTO `product_images` VALUES ('4', '12', 'uploads/18620297_10155243979002141_7553569249730215790_n.jpg');
INSERT INTO `product_images` VALUES ('5', '12', 'uploads/19223025_1424556157611232_5372023399373301341_o.jpg');
INSERT INTO `product_images` VALUES ('6', '12', 'uploads/19576703_487693618229746_1627675532_o.jpg');
INSERT INTO `product_images` VALUES ('7', '12', 'uploads/597de71e1ad509498_412725365548758_2905611576649314797_n.jpg');

-- ----------------------------
-- Table structure for product_sizes
-- ----------------------------
DROP TABLE IF EXISTS `product_sizes`;
CREATE TABLE `product_sizes` (
  `id` bigint(32) NOT NULL AUTO_INCREMENT,
  `product_id` bigint(32) DEFAULT NULL,
  `size` int(10) DEFAULT NULL,
  `quantity` bigint(32) DEFAULT NULL,
  `min_weight` int(10) DEFAULT NULL,
  `max_weight` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of product_sizes
-- ----------------------------
INSERT INTO `product_sizes` VALUES ('1', '7', '1', '12', '12', '12');
INSERT INTO `product_sizes` VALUES ('2', '7', '2', '12', '12', '12');
INSERT INTO `product_sizes` VALUES ('3', '8', '1', '1', '1', '1');
INSERT INTO `product_sizes` VALUES ('4', '9', '1', '1', '1', '1');
INSERT INTO `product_sizes` VALUES ('5', '10', '1', '1', '1', '1');
INSERT INTO `product_sizes` VALUES ('6', '11', '1', '1', '1', '1');
INSERT INTO `product_sizes` VALUES ('7', '12', '3', '20', '12', '15');
INSERT INTO `product_sizes` VALUES ('8', '12', '2', '50', '7', '9');

-- ----------------------------
-- Table structure for styles
-- ----------------------------
DROP TABLE IF EXISTS `styles`;
CREATE TABLE `styles` (
  `id` bigint(32) NOT NULL AUTO_INCREMENT,
  `title` varchar(300) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of styles
-- ----------------------------
INSERT INTO `styles` VALUES ('1', 'đầm xòe');
INSERT INTO `styles` VALUES ('2', 'quần đùi');
INSERT INTO `styles` VALUES ('3', 'test');

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `password_reset_token` (`password_reset_token`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('1', 'admin', '', '$2y$13$R4270dvEAcrBsx90PrtQD./38rV2tFRsmqG3TztEIqrgu4R/X8kNy', null, '', '10', '1497089683', '1497089683');
