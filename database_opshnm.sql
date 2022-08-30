/*
 Navicat Premium Data Transfer

 Source Server         : Local Server
 Source Server Type    : MySQL
 Source Server Version : 50733
 Source Host           : localhost:3306
 Source Schema         : opsmezzanine

 Target Server Type    : MySQL
 Target Server Version : 50733
 File Encoding         : 65001

 Date: 30/08/2022 12:41:59
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for audittrail
-- ----------------------------
DROP TABLE IF EXISTS `audittrail`;
CREATE TABLE `audittrail`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `datetime` datetime NOT NULL,
  `script` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `user` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `action` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `table` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `field` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `keyvalue` longtext CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `oldvalue` longtext CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `newvalue` longtext CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 30036 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for blank_count_sheet
-- ----------------------------
DROP TABLE IF EXISTS `blank_count_sheet`;
CREATE TABLE `blank_count_sheet`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `article` varchar(45) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL,
  `location` varchar(45) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL,
  `ctn` varchar(45) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL,
  `description` varchar(45) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL,
  `size_desc` varchar(45) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL,
  `color_desc` varchar(45) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL,
  `color_code` varchar(45) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL,
  `season` varchar(45) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL,
  `quantity` int(45) NULL DEFAULT NULL,
  `user` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL,
  `date_created` varchar(45) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL,
  `date_updated` varchar(45) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 61 CHARACTER SET = latin1 COLLATE = latin1_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for box_picking
-- ----------------------------
DROP TABLE IF EXISTS `box_picking`;
CREATE TABLE `box_picking`  (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `store_name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `store_code` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `box_id` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `type` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `concept` varchar(4) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `quantity` int(4) NULL DEFAULT NULL,
  `status` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `users` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `picking_date` date NULL DEFAULT NULL,
  `date_created` date NULL DEFAULT NULL,
  `date_delivery` date NULL DEFAULT NULL,
  `date_updated` date NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1228 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for cycle_count
-- ----------------------------
DROP TABLE IF EXISTS `cycle_count`;
CREATE TABLE `cycle_count`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `location` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `su` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `scan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `article` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `user` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `divisi` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `date_created` datetime NULL DEFAULT NULL,
  `date_updated` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 73 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for disposition_location
-- ----------------------------
DROP TABLE IF EXISTS `disposition_location`;
CREATE TABLE `disposition_location`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `photo_before` text CHARACTER SET latin1 COLLATE latin1_general_ci NULL,
  `photo_after` text CHARACTER SET latin1 COLLATE latin1_general_ci NULL,
  `subject` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL,
  `divisi` varchar(7) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL,
  `status` varchar(7) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL,
  `date_created` datetime NULL DEFAULT NULL,
  `date_updated` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = latin1 COLLATE = latin1_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for extra_stock
-- ----------------------------
DROP TABLE IF EXISTS `extra_stock`;
CREATE TABLE `extra_stock`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `article` varchar(45) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL,
  `location` varchar(45) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL,
  `description` varchar(45) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL,
  `size_desc` varchar(45) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL,
  `color_code` varchar(45) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL,
  `color_desc` varchar(45) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL,
  `ctn` varchar(45) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL,
  `season` varchar(45) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL,
  `quantity` int(45) NULL DEFAULT NULL,
  `no_box` varchar(45) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL,
  `location_2nd` varchar(45) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL,
  `date_created` date NULL DEFAULT NULL,
  `date_updated` date NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 19 CHARACTER SET = latin1 COLLATE = latin1_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for finding_shortpick
-- ----------------------------
DROP TABLE IF EXISTS `finding_shortpick`;
CREATE TABLE `finding_shortpick`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `location` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL,
  `ctn` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL,
  `article` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL,
  `description` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL,
  `avaiable` int(11) NULL DEFAULT NULL,
  `web` int(11) NULL DEFAULT NULL,
  `target_quantity` int(11) NULL DEFAULT NULL,
  `pick_quantity` int(11) NULL DEFAULT NULL,
  `actual` int(11) NULL DEFAULT NULL,
  `shortpick` int(11) NULL DEFAULT NULL,
  `excess` int(11) NULL DEFAULT NULL,
  `user` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL,
  `area` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT '',
  `status` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL,
  `date_shortpick` date NULL DEFAULT NULL,
  `date_upload` date NULL DEFAULT NULL,
  `date_picking` date NULL DEFAULT NULL,
  `time_picking` time NULL DEFAULT NULL,
  `total` varchar(11) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 401 CHARACTER SET = latin1 COLLATE = latin1_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for job_control
-- ----------------------------
DROP TABLE IF EXISTS `job_control`;
CREATE TABLE `job_control`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `job_category` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL,
  `aisle` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL,
  `user` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL,
  `status` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL,
  `date_created` datetime NULL DEFAULT NULL,
  `date_updated` datetime NULL DEFAULT NULL,
  `test` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL,
  `test2` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL,
  `test3` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL,
  `test4` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for job_control_copy1
-- ----------------------------
DROP TABLE IF EXISTS `job_control_copy1`;
CREATE TABLE `job_control_copy1`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `creation_date` date NULL DEFAULT NULL,
  `store_id` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL,
  `area` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL,
  `aisle` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL,
  `user` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL,
  `status` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL,
  `date_created` datetime NULL DEFAULT NULL,
  `date_updated` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 40 CHARACTER SET = latin1 COLLATE = latin1_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for locations
-- ----------------------------
DROP TABLE IF EXISTS `locations`;
CREATE TABLE `locations`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `location` varchar(25) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL,
  `area` varchar(25) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL,
  `sequence` varchar(15) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL,
  `divisi` varchar(10) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 188848 CHARACTER SET = latin1 COLLATE = latin1_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for master_article
-- ----------------------------
DROP TABLE IF EXISTS `master_article`;
CREATE TABLE `master_article`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `article` varchar(16) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL,
  `description` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL,
  `gtin` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL,
  `color_code` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL,
  `color_desc` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL,
  `size_code` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL,
  `size_desc` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL,
  `season` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL,
  `price` decimal(10, 2) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 591561 CHARACTER SET = latin1 COLLATE = latin1_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for master_article2
-- ----------------------------
DROP TABLE IF EXISTS `master_article2`;
CREATE TABLE `master_article2`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `article` varchar(16) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL,
  `description` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL,
  `gtin` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL,
  `color_code` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL,
  `color_desc` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL,
  `size_code` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL,
  `size_desc` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL,
  `season` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL,
  `price` decimal(10, 2) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1975906 CHARACTER SET = latin1 COLLATE = latin1_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for mb51
-- ----------------------------
DROP TABLE IF EXISTS `mb51`;
CREATE TABLE `mb51`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `article` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL,
  `quantity` int(4) NULL DEFAULT NULL,
  `reference` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL,
  `rcvsite` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL,
  `do_type` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL,
  `concept` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 191017 CHARACTER SET = latin1 COLLATE = latin1_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for picking
-- ----------------------------
DROP TABLE IF EXISTS `picking`;
CREATE TABLE `picking`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `po_no` varchar(45) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL,
  `to_no` varchar(45) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL,
  `to_order_item` varchar(11) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL,
  `to_priority` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL,
  `to_priority_code` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL,
  `source_storage_type` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL,
  `source_storage_bin` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL,
  `carton_number` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL,
  `creation_date` date NULL DEFAULT NULL,
  `gr_number` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL,
  `gr_date` date NULL DEFAULT NULL,
  `delivery` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL,
  `store_id` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL,
  `store_name` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL,
  `article` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL,
  `size_code` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL,
  `size_desc` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL,
  `color_code` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL,
  `color_desc` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL,
  `concept` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL,
  `target_qty` int(11) NULL DEFAULT NULL,
  `picked_qty` int(11) NULL DEFAULT NULL,
  `variance_qty` int(11) NULL DEFAULT NULL,
  `confirmation_date` date NULL DEFAULT NULL,
  `confirmation_time` time NULL DEFAULT NULL,
  `box_code` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL,
  `box_type` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL,
  `picker` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL,
  `status` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL,
  `remarks` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL,
  `aisle` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL,
  `area` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL,
  `aisle2` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL,
  `store_id2` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL,
  `close_totes` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 50 CHARACTER SET = latin1 COLLATE = latin1_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for print_label
-- ----------------------------
DROP TABLE IF EXISTS `print_label`;
CREATE TABLE `print_label`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `box_id` varchar(15) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL,
  `priority` varchar(20) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL,
  `store_code` varchar(10) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL,
  `store_name` varchar(50) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 59 CHARACTER SET = latin1 COLLATE = latin1_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for report_outbound
-- ----------------------------
DROP TABLE IF EXISTS `report_outbound`;
CREATE TABLE `report_outbound`  (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `box_id` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `date_delivery` date NULL DEFAULT NULL,
  `box_type` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `check_by` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `quantity` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `concept` varchar(5) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `store_code` varchar(4) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `store_name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `remark` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `no_delivery` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `truck_type` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `seal_no` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `truck_plate` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `transporter` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `no_hp` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `checker` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `admin` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `remarks_box` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `date_created` date NULL DEFAULT NULL,
  `date_updated` date NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5066 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for report_totes
-- ----------------------------
DROP TABLE IF EXISTS `report_totes`;
CREATE TABLE `report_totes`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `store_id` varchar(11) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL,
  `store_name` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL,
  `out` int(11) NULL DEFAULT NULL,
  `in` int(11) NULL DEFAULT NULL,
  `diff` int(11) NULL DEFAULT NULL,
  `remarks` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL,
  `date_out` date NULL DEFAULT NULL,
  `date_in` date NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = latin1 COLLATE = latin1_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for staging
-- ----------------------------
DROP TABLE IF EXISTS `staging`;
CREATE TABLE `staging`  (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `store_name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `store_code` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `box_id` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `type` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `concept` varchar(4) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `quantity` int(4) NULL DEFAULT NULL,
  `status` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `users` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `picking_date` date NULL DEFAULT NULL,
  `date_delivery` date NULL DEFAULT NULL,
  `date_created` date NULL DEFAULT NULL,
  `date_updated` date NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2024 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for store
-- ----------------------------
DROP TABLE IF EXISTS `store`;
CREATE TABLE `store`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `store_code` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL,
  `store_name` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL,
  `totes` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 61 CHARACTER SET = latin1 COLLATE = latin1_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for transfer bin
-- ----------------------------
DROP TABLE IF EXISTS `transfer bin`;
CREATE TABLE `transfer bin`  (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `From Bin` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `To Bin` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `date_created` date NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for transfer_bin_piece
-- ----------------------------
DROP TABLE IF EXISTS `transfer_bin_piece`;
CREATE TABLE `transfer_bin_piece`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `source_location` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL,
  `article` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL,
  `destination_location` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL,
  `su` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL,
  `user` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL,
  `date_upload` date NULL DEFAULT NULL,
  `date_confirmation` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1001 CHARACTER SET = latin1 COLLATE = latin1_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `email` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `ip_loggedin` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `userLevel` int(11) NULL DEFAULT NULL,
  `role` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `date_created` datetime NULL DEFAULT NULL,
  `date_updated` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 177 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- View structure for audit staging
-- ----------------------------
DROP VIEW IF EXISTS `audit staging`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `audit staging` AS select `staging`.`id` AS `id`,`staging`.`store_name` AS `store_name`,`staging`.`store_code` AS `store_code`,`staging`.`box_id` AS `box_id`,`staging`.`type` AS `type`,`staging`.`quantity` AS `quantity`,`staging`.`status` AS `status`,`staging`.`picking_date` AS `picking_date`,`staging`.`date_delivery` AS `date_delivery`,`staging`.`date_created` AS `date_created`,`staging`.`date_updated` AS `date_updated`,`staging`.`users` AS `users` from `staging`;

-- ----------------------------
-- View structure for audit_picking
-- ----------------------------
DROP VIEW IF EXISTS `audit_picking`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `audit_picking` AS SELECT box_picking.store_name AS store_name, box_picking.store_code AS store_code, box_picking.box_id AS box_id, box_picking.type AS type, box_picking.concept AS concept, box_picking.quantity AS quantity, box_picking.status AS status, box_picking.users AS users, box_picking.picking_date AS picking_date, box_picking.id AS id FROM box_picking ;

-- ----------------------------
-- View structure for bin to bin
-- ----------------------------
DROP VIEW IF EXISTS `bin to bin`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `bin to bin` AS select `transfer bin`.`From Bin` AS `From Bin`,`transfer bin`.`To Bin` AS `To Bin` from `transfer bin`;

-- ----------------------------
-- View structure for bin_to_bin_piece
-- ----------------------------
DROP VIEW IF EXISTS `bin_to_bin_piece`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `bin_to_bin_piece` AS SELECT transfer_bin_piece.id AS id, transfer_bin_piece.date_upload AS date_upload, transfer_bin_piece.source_location AS source_location, transfer_bin_piece.article AS article, transfer_bin_piece.destination_location AS destination_location, transfer_bin_piece.su AS su, transfer_bin_piece.user AS user, transfer_bin_piece.date_confirmation AS date_confirmation FROM transfer_bin_piece WHERE transfer_bin_piece.date_confirmation IS NULL ;

-- ----------------------------
-- View structure for box_result
-- ----------------------------
DROP VIEW IF EXISTS `box_result`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `box_result` AS SELECT picking.confirmation_date AS confirmation_date, picking.box_code AS box_code, picking.store_id AS store_id, Sum(picking.picked_qty) AS total, picking.picker FROM picking WHERE picking.status = 'Done' GROUP BY picking.confirmation_date, picking.box_code, picking.store_id, picking.picker ORDER BY picking.confirmation_date DESC ;

-- ----------------------------
-- View structure for cycle_count_offline
-- ----------------------------
DROP VIEW IF EXISTS `cycle_count_offline`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `cycle_count_offline` AS SELECT cycle_count.id AS id, cycle_count.location AS location, cycle_count.scan AS scan, cycle_count.article AS article, cycle_count.user AS user, cycle_count.date_created AS date_created, cycle_count.date_updated AS date_updated, cycle_count.divisi AS divisi, cycle_count.su AS su FROM cycle_count ORDER BY cycle_count.id DESC ;

-- ----------------------------
-- View structure for empty_box
-- ----------------------------
DROP VIEW IF EXISTS `empty_box`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `empty_box` AS SELECT disposition_location.id, disposition_location.photo_before, disposition_location.photo_after, disposition_location.divisi, disposition_location.status, disposition_location.date_created, disposition_location.date_updated, disposition_location.subject FROM disposition_location WHERE disposition_location.subject = 'Empty Box' ;

-- ----------------------------
-- View structure for findingshortpick
-- ----------------------------
DROP VIEW IF EXISTS `findingshortpick`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `findingshortpick` AS SELECT finding_shortpick.id AS id, finding_shortpick.location AS location, finding_shortpick.article AS article, finding_shortpick.description AS description, finding_shortpick.target_quantity AS target_quantity, finding_shortpick.pick_quantity AS pick_quantity, finding_shortpick.shortpick AS shortpick, finding_shortpick.user AS user, finding_shortpick.area AS area, finding_shortpick.status AS status, finding_shortpick.date_upload AS date_upload, finding_shortpick.date_picking AS date_picking, finding_shortpick.total AS total, finding_shortpick.ctn AS ctn, finding_shortpick.excess, finding_shortpick.actual FROM finding_shortpick WHERE finding_shortpick.status = 'Pending' ORDER BY finding_shortpick.id ;

-- ----------------------------
-- View structure for monitor_audit_picking
-- ----------------------------
DROP VIEW IF EXISTS `monitor_audit_picking`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `monitor_audit_picking` AS SELECT box_picking.picking_date AS picking_date, box_picking.users AS users, Sum(If((box_picking.status = 'Unmatch'), 1, 0)) AS Pending, Sum(If((box_picking.status = 'Match'), 1, 0)) AS Done, Count(box_picking.status) AS total FROM box_picking GROUP BY box_picking.picking_date, box_picking.users ;

-- ----------------------------
-- View structure for monitor_cycle_count
-- ----------------------------
DROP VIEW IF EXISTS `monitor_cycle_count`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `monitor_cycle_count` AS SELECT cycle_count.location AS Location, If((Length(cycle_count.article) = 16), Left(cycle_count.article, 10), Left(cycle_count.article, 9)) AS `Short Article`, Count(cycle_count.article) AS Total, cycle_count.user AS User, CAST(cycle_count.date_created AS date) AS `Date Created` FROM cycle_count WHERE cycle_count.article IS NOT NULL AND cycle_count.divisi = 'Online' GROUP BY cycle_count.location, cycle_count.user, CAST(cycle_count.date_created AS date), `Short Article`, cycle_count.divisi, cycle_count.id ORDER BY cycle_count.location DESC, cycle_count.id DESC ;

-- ----------------------------
-- View structure for monitor_cycle_count_offline
-- ----------------------------
DROP VIEW IF EXISTS `monitor_cycle_count_offline`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `monitor_cycle_count_offline` AS SELECT cycle_count.location AS Location, cycle_count.su AS Ctn, If((Length(cycle_count.article) = 16), Left(cycle_count.article, 10), Left(cycle_count.article, 9)) AS `Short Article`, Count(cycle_count.article) AS Total, cycle_count.user AS User, CAST(cycle_count.date_created AS date) AS `Date Created` FROM cycle_count WHERE cycle_count.article IS NOT NULL AND cycle_count.divisi = 'Offline' GROUP BY cycle_count.location, cycle_count.su, cycle_count.user, CAST(cycle_count.date_created AS date), `Short Article`, cycle_count.divisi, cycle_count.id ORDER BY cycle_count.location DESC, cycle_count.id DESC ;

-- ----------------------------
-- View structure for monitor_kpi
-- ----------------------------
DROP VIEW IF EXISTS `monitor_kpi`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `monitor_kpi` AS SELECT disposition_location.date_created AS Date, disposition_location.subject AS Subject, disposition_location.divisi AS Divisi, Sum(If((disposition_location.status = 'Pending'), 1, 0)) AS Pending, Sum(If((disposition_location.status = 'Done'), 1, 0)) AS Done, Count(disposition_location.photo_before) AS Total FROM disposition_location GROUP BY disposition_location.date_created, disposition_location.divisi, disposition_location.subject ;

-- ----------------------------
-- View structure for monitor_staging_delivered
-- ----------------------------
DROP VIEW IF EXISTS `monitor_staging_delivered`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `monitor_staging_delivered` AS SELECT staging.id, staging.store_name, staging.store_code, staging.box_id, staging.type, staging.concept, staging.quantity, staging.picking_date, staging.date_created, staging.status, staging.users, staging.date_updated FROM staging WHERE staging.date_delivery IS NOT NULL ;

-- ----------------------------
-- View structure for monitor_staging_on_staging
-- ----------------------------
DROP VIEW IF EXISTS `monitor_staging_on_staging`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `monitor_staging_on_staging` AS SELECT staging.id AS id, staging.store_name AS store_name, staging.store_code AS store_code, staging.box_id AS box_id, staging.type AS type, staging.concept AS concept, staging.quantity AS quantity, staging.picking_date AS picking_date, staging.date_created AS date_created, staging.status AS status, staging.users AS users, staging.date_updated AS date_updated FROM staging WHERE staging.date_delivery IS NULL ;

-- ----------------------------
-- View structure for picking_pending
-- ----------------------------
DROP VIEW IF EXISTS `picking_pending`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `picking_pending` AS SELECT picking.id AS id, picking.po_no AS po_no, picking.to_no AS to_no, picking.to_order_item AS to_order_item, picking.to_priority AS to_priority, picking.to_priority_code AS to_priority_code, picking.source_storage_type AS source_storage_type, picking.source_storage_bin AS source_storage_bin, picking.carton_number AS carton_number, picking.creation_date AS creation_date, picking.gr_number AS gr_number, picking.gr_date AS gr_date, picking.delivery AS delivery, picking.store_id AS store_id, picking.store_name AS store_name, picking.article AS article, picking.size_code AS size_code, picking.size_desc AS size_desc, picking.color_code AS color_code, picking.color_desc AS color_desc, picking.concept AS concept, picking.target_qty AS target_qty, picking.picked_qty AS picked_qty, picking.variance_qty AS variance_qty, picking.confirmation_date AS confirmation_date, picking.confirmation_time AS confirmation_time, picking.box_code AS box_code, picking.box_type AS box_type, picking.picker AS picker, picking.status AS status, picking.remarks AS remarks, picking.aisle AS aisle, picking.area AS area, picking.aisle2 AS aisle2, picking.store_id2 AS store_id2, picking.close_totes FROM picking WHERE picking.status = 'Pending' ;

-- ----------------------------
-- View structure for shortpick_by_area
-- ----------------------------
DROP VIEW IF EXISTS `shortpick_by_area`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `shortpick_by_area` AS SELECT locations.area AS area, Sum(finding_shortpick.shortpick) - Sum(finding_shortpick.pick_quantity)as total_shortpick FROM finding_shortpick JOIN locations ON finding_shortpick.location = locations.location GROUP BY locations.area ;

SET FOREIGN_KEY_CHECKS = 1;
