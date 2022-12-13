/*
 Navicat Premium Data Transfer

 Source Server         : Opshnm.my.id
 Source Server Type    : MySQL
 Source Server Version : 50562
 Source Host           : 127.0.0.1:3306
 Source Schema         : opsmezzanine

 Target Server Type    : MySQL
 Target Server Version : 50562
 File Encoding         : 65001

 Date: 13/12/2022 13:03:34
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for active_stock
-- ----------------------------
DROP TABLE IF EXISTS `active_stock`;
CREATE TABLE `active_stock`  (
  `aisle` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `active_bin` int(255) NOT NULL,
  `total_stock` int(255) NOT NULL,
  PRIMARY KEY (`aisle`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for audit_picking_online
-- ----------------------------
DROP TABLE IF EXISTS `audit_picking_online`;
CREATE TABLE `audit_picking_online`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `box_code` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `store_id` varchar(4) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `store_name` varchar(50) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `article` varchar(16) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `checker` varchar(50) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `date_update` date NOT NULL,
  `time_update` time NOT NULL,
  `status` varchar(20) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_general_ci ROW_FORMAT = Compact;

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
) ENGINE = InnoDB AUTO_INCREMENT = 1013234 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

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
  `color_code` varchar(45) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL,
  `color_desc` varchar(45) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL,
  `season` varchar(45) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL,
  `quantity` int(45) NULL DEFAULT NULL,
  `user` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL,
  `date_created` varchar(45) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL,
  `date_updated` varchar(45) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 27382 CHARACTER SET = latin1 COLLATE = latin1_general_ci ROW_FORMAT = Compact;

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
  `line` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `date_created` date NULL DEFAULT NULL,
  `date_updated` date NULL DEFAULT NULL,
  `date_staging` date NULL DEFAULT NULL,
  `date_delivery` date NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `index_id`(`id`) USING BTREE,
  INDEX `index_store`(`store_code`) USING BTREE,
  INDEX `index_box`(`box_id`) USING BTREE,
  INDEX `index_line`(`line`) USING BTREE,
  INDEX `index_type`(`type`) USING BTREE,
  INDEX `index_concept`(`concept`) USING BTREE,
  INDEX `index_status`(`status`) USING BTREE,
  INDEX `index_user`(`users`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 196934 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for box_picking_online
-- ----------------------------
DROP TABLE IF EXISTS `box_picking_online`;
CREATE TABLE `box_picking_online`  (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `box_id` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `store_code` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `store_name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `type` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `concept` varchar(4) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `picked_qty` int(4) NULL DEFAULT NULL,
  `scan_qty` int(4) NULL DEFAULT NULL,
  `status` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `users` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `picking_date` date NULL DEFAULT NULL,
  `line` varchar(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `date_created` date NULL DEFAULT NULL,
  `date_delivery` date NULL DEFAULT NULL,
  `date_staging` date NULL DEFAULT NULL,
  `date_updated` date NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 13 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

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
  `date_created` datetime NULL DEFAULT NULL,
  `date_updated` datetime NULL DEFAULT NULL,
  `divisi` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `id_index`(`id`) USING BTREE,
  INDEX `article_index`(`article`(191)) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 708572 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Compact;

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
) ENGINE = InnoDB AUTO_INCREMENT = 39 CHARACTER SET = latin1 COLLATE = latin1_general_ci ROW_FORMAT = Compact;

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
) ENGINE = InnoDB AUTO_INCREMENT = 11833 CHARACTER SET = latin1 COLLATE = latin1_general_ci ROW_FORMAT = Compact;

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
) ENGINE = InnoDB AUTO_INCREMENT = 4573 CHARACTER SET = latin1 COLLATE = latin1_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for inbound_excess
-- ----------------------------
DROP TABLE IF EXISTS `inbound_excess`;
CREATE TABLE `inbound_excess`  (
  `sscc` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `pallet_id` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `users` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL,
  `date_update` date NULL DEFAULT NULL,
  `time_update` time NULL DEFAULT NULL
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for job_control_copy1
-- ----------------------------
DROP TABLE IF EXISTS `job_control_copy1`;
CREATE TABLE `job_control_copy1`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `creation_date` date NULL DEFAULT NULL,
  `store_id` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL,
  `concept` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL,
  `area` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL,
  `aisle` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL,
  `target_qty` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL,
  `picked_qty` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL,
  `user` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL,
  `status` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL,
  `date_created` datetime NULL DEFAULT NULL,
  `date_updated` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1627 CHARACTER SET = latin1 COLLATE = latin1_general_ci ROW_FORMAT = Compact;

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
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `id_index`(`id`) USING BTREE,
  UNIQUE INDEX `location_index`(`location`) USING BTREE,
  INDEX `area_index`(`area`) USING BTREE,
  INDEX `seq_index`(`sequence`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 188960 CHARACTER SET = latin1 COLLATE = latin1_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for master_article
-- ----------------------------
DROP TABLE IF EXISTS `master_article`;
CREATE TABLE `master_article`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `article` varchar(16) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `description` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `gtin` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `color_code` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `color_desc` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `size_code` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `size_desc` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `season` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `price` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `id_index`(`id`) USING BTREE,
  UNIQUE INDEX `gtin_index`(`gtin`) USING BTREE,
  INDEX `article_index`(`article`) USING BTREE,
  INDEX `season_index`(`season`) USING BTREE,
  INDEX `desc_index`(`description`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3646152 CHARACTER SET = latin1 COLLATE = latin1_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for master_article2222
-- ----------------------------
DROP TABLE IF EXISTS `master_article2222`;
CREATE TABLE `master_article2222`  (
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
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `id_index`(`id`) USING BTREE,
  INDEX `article_index`(`article`) USING BTREE,
  INDEX `gtin_index`(`gtin`) USING BTREE,
  INDEX `season_index`(`season`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2655529 CHARACTER SET = latin1 COLLATE = latin1_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for master_article_2
-- ----------------------------
DROP TABLE IF EXISTS `master_article_2`;
CREATE TABLE `master_article_2`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `article` varchar(16) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `description` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `gtin` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `color_code` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `color_desc` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `size_code` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `size_desc` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `season` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `price` decimal(10, 2) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `id_index`(`id`) USING BTREE,
  UNIQUE INDEX `gtin_index`(`gtin`) USING BTREE,
  INDEX `article_index`(`article`) USING BTREE,
  INDEX `season_index`(`season`) USING BTREE,
  INDEX `desc_index`(`description`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3646150 CHARACTER SET = latin1 COLLATE = latin1_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for mb51
-- ----------------------------
DROP TABLE IF EXISTS `mb51`;
CREATE TABLE `mb51`  (
  `id` int(11) NOT NULL,
  `article` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL,
  `reference` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL,
  `rcvsite` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL,
  `do_type` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL,
  `concept` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for oss_manual
-- ----------------------------
DROP TABLE IF EXISTS `oss_manual`;
CREATE TABLE `oss_manual`  (
  `date` date NULL DEFAULT NULL,
  `shipment` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL,
  `pallet_no` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL,
  `sscc` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `idw` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL,
  `order_no` int(11) NULL DEFAULT NULL,
  `item_in_ctn` int(11) NULL DEFAULT NULL,
  `no_of_ctn` int(11) NULL DEFAULT NULL,
  `ctn_no` int(11) NULL DEFAULT NULL,
  `checker` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL,
  `shift` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL,
  `status` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL,
  `date_updated` date NULL DEFAULT NULL,
  `time_updated` time NULL DEFAULT NULL,
  PRIMARY KEY (`sscc`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_general_ci ROW_FORMAT = Compact;

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
  `job_id` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL,
  `sequence` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `id_index`(`id`) USING BTREE,
  INDEX `status_index`(`status`) USING BTREE,
  INDEX `picker_index`(`picker`) USING BTREE,
  INDEX `store_index`(`store_id`) USING BTREE,
  INDEX `job_index`(`job_id`) USING BTREE,
  INDEX `creation_index`(`creation_date`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 170951 CHARACTER SET = latin1 COLLATE = latin1_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for print_label
-- ----------------------------
DROP TABLE IF EXISTS `print_label`;
CREATE TABLE `print_label`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `box_id` varchar(15) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `priority` varchar(20) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `store_code` varchar(10) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `store_name` varchar(50) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `user` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `date_created` date NOT NULL,
  `time_created` time NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = latin1 COLLATE = latin1_general_ci ROW_FORMAT = Compact;

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
) ENGINE = InnoDB AUTO_INCREMENT = 439639 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

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
) ENGINE = InnoDB AUTO_INCREMENT = 3517 CHARACTER SET = latin1 COLLATE = latin1_general_ci ROW_FORMAT = Compact;

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
  `line` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `users` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `picking_date` date NULL DEFAULT NULL,
  `date_delivery` date NULL DEFAULT NULL,
  `date_created` date NULL DEFAULT NULL,
  `date_updated` date NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 121336 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for stock_count
-- ----------------------------
DROP TABLE IF EXISTS `stock_count`;
CREATE TABLE `stock_count`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `location` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `scan` varchar(31) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `article` varchar(16) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `user` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `divisi` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `date_created` date NULL DEFAULT NULL,
  `time_created` time NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1272 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Compact;

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
) ENGINE = InnoDB AUTO_INCREMENT = 61 CHARACTER SET = latin1 COLLATE = latin1_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for transfer bin
-- ----------------------------
DROP TABLE IF EXISTS `transfer bin`;
CREATE TABLE `transfer bin`  (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `from_bin` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `ctn` varchar(4) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `to_bin` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `user` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `date_created` date NULL DEFAULT NULL,
  `date_updated` date NULL DEFAULT NULL,
  `time_updated` time NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 89 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for transfer_bin_piece
-- ----------------------------
DROP TABLE IF EXISTS `transfer_bin_piece`;
CREATE TABLE `transfer_bin_piece`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `source_location` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL,
  `article` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL,
  `description` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL,
  `destination_location` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL,
  `su` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL,
  `qty` int(11) NULL DEFAULT NULL,
  `actual` int(11) NULL DEFAULT NULL,
  `user` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL,
  `status` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL,
  `date_upload` date NULL DEFAULT NULL,
  `date_confirmation` date NULL DEFAULT NULL,
  `time_confirmation` time NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 29325 CHARACTER SET = latin1 COLLATE = latin1_general_ci ROW_FORMAT = Compact;

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
) ENGINE = InnoDB AUTO_INCREMENT = 294 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for userlevelpermissions
-- ----------------------------
DROP TABLE IF EXISTS `userlevelpermissions`;
CREATE TABLE `userlevelpermissions`  (
  `userlevelid` int(11) NOT NULL,
  `tablename` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `permission` int(11) NOT NULL,
  PRIMARY KEY (`userlevelid`, `tablename`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for userlevels
-- ----------------------------
DROP TABLE IF EXISTS `userlevels`;
CREATE TABLE `userlevels`  (
  `userlevelid` int(11) NOT NULL,
  `userlevelname` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`userlevelid`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for vas_validation
-- ----------------------------
DROP TABLE IF EXISTS `vas_validation`;
CREATE TABLE `vas_validation`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order` varchar(6) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL,
  `po` varchar(10) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL,
  `sap_art` varchar(16) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL,
  `sub_index` varchar(4) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL,
  `concept` varchar(2) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL,
  `season2` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL,
  `ctn` int(4) NULL DEFAULT NULL,
  `qty_oss` int(11) NULL DEFAULT NULL,
  `shipment` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL,
  `aju` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL,
  `snow` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL,
  `price_foto` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL,
  `remarks` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL,
  `actual_price` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL,
  `date_upload` date NULL DEFAULT NULL,
  `status` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL,
  `user` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL,
  `date_update` date NULL DEFAULT NULL,
  `time_update` time NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- View structure for article_description
-- ----------------------------
DROP VIEW IF EXISTS `article_description`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `article_description` AS select `master_article`.`article` AS `article`,`master_article`.`description` AS `description`,`master_article`.`color_code` AS `color_code`,`master_article`.`color_desc` AS `color_desc`,`master_article`.`size_desc` AS `size_desc`,`master_article`.`size_code` AS `size_code`,`master_article`.`season` AS `season` from `master_article` group by `master_article`.`article`,`master_article`.`description`,`master_article`.`color_code`,`master_article`.`color_desc`,`master_article`.`size_desc`,`master_article`.`size_code`,`master_article`.`season`;

-- ----------------------------
-- View structure for audit staging
-- ----------------------------
DROP VIEW IF EXISTS `audit staging`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `audit staging` AS select `staging`.`id` AS `id`,`staging`.`store_name` AS `store_name`,`staging`.`store_code` AS `store_code`,`staging`.`box_id` AS `box_id`,`staging`.`type` AS `type`,`staging`.`quantity` AS `quantity`,`staging`.`status` AS `status`,`staging`.`picking_date` AS `picking_date`,`staging`.`date_delivery` AS `date_delivery`,`staging`.`date_created` AS `date_created`,`staging`.`date_updated` AS `date_updated`,`staging`.`users` AS `users` from `staging`;

-- ----------------------------
-- View structure for audit_picking
-- ----------------------------
DROP VIEW IF EXISTS `audit_picking`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `audit_picking` AS select `box_picking`.`store_name` AS `store_name`,`box_picking`.`store_code` AS `store_code`,`box_picking`.`box_id` AS `box_id`,`box_picking`.`type` AS `type`,`box_picking`.`concept` AS `concept`,`box_picking`.`quantity` AS `quantity`,`box_picking`.`status` AS `status`,`box_picking`.`users` AS `users`,`box_picking`.`picking_date` AS `picking_date`,`box_picking`.`id` AS `id`,`box_picking`.`line` AS `line` from `box_picking`;

-- ----------------------------
-- View structure for bin_to_bin
-- ----------------------------
DROP VIEW IF EXISTS `bin_to_bin`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `bin_to_bin` AS select `transfer bin`.`id` AS `id`,`transfer bin`.`from_bin` AS `from_bin`,`transfer bin`.`ctn` AS `ctn`,`transfer bin`.`to_bin` AS `to_bin`,`transfer bin`.`time_updated` AS `time_updated`,`transfer bin`.`date_updated` AS `date_updated`,`transfer bin`.`date_created` AS `date_created` from `transfer bin`;

-- ----------------------------
-- View structure for bin_to_bin_piece
-- ----------------------------
DROP VIEW IF EXISTS `bin_to_bin_piece`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `bin_to_bin_piece` AS select `transfer_bin_piece`.`id` AS `id`,`transfer_bin_piece`.`date_upload` AS `date_upload`,`transfer_bin_piece`.`source_location` AS `source_location`,`transfer_bin_piece`.`article` AS `article`,`transfer_bin_piece`.`destination_location` AS `destination_location`,`transfer_bin_piece`.`su` AS `su`,`transfer_bin_piece`.`user` AS `user`,`transfer_bin_piece`.`date_confirmation` AS `date_confirmation`,`transfer_bin_piece`.`qty` AS `qty`,`transfer_bin_piece`.`actual` AS `actual`,`transfer_bin_piece`.`time_confirmation` AS `time_confirmation`,`transfer_bin_piece`.`status` AS `status`,`transfer_bin_piece`.`description` AS `description` from `transfer_bin_piece` where (isnull(`transfer_bin_piece`.`date_confirmation`) = 1);

-- ----------------------------
-- View structure for box_result
-- ----------------------------
DROP VIEW IF EXISTS `box_result`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `box_result` AS select `picking`.`confirmation_date` AS `confirmation_date`,`picking`.`box_code` AS `box_code`,`picking`.`store_id` AS `store_id`,sum(`picking`.`picked_qty`) AS `total`,`picking`.`picker` AS `picker` from `picking` where (`picking`.`status` = 'Done') group by `picking`.`confirmation_date`,`picking`.`box_code`,`picking`.`store_id`,`picking`.`picker` order by `picking`.`confirmation_date` desc;

-- ----------------------------
-- View structure for checking_vas
-- ----------------------------
DROP VIEW IF EXISTS `checking_vas`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `checking_vas` AS select `vas_validation`.`id` AS `id`,`vas_validation`.`order` AS `order`,`vas_validation`.`po` AS `po`,`vas_validation`.`sap_art` AS `sap_art`,`vas_validation`.`sub_index` AS `sub_index`,`vas_validation`.`concept` AS `concept`,`vas_validation`.`ctn` AS `ctn`,`vas_validation`.`qty_oss` AS `qty_oss`,`vas_validation`.`shipment` AS `shipment`,`vas_validation`.`aju` AS `aju`,`vas_validation`.`remarks` AS `remarks`,`vas_validation`.`price_foto` AS `price_foto`,`vas_validation`.`snow` AS `snow`,`vas_validation`.`date_upload` AS `date_upload`,`vas_validation`.`user` AS `user`,`vas_validation`.`status` AS `status`,`vas_validation`.`date_update` AS `date_update`,`vas_validation`.`time_update` AS `time_update`,`vas_validation`.`actual_price` AS `actual_price`,`vas_validation`.`season2` AS `season2` from `vas_validation` where (`vas_validation`.`status` = 'Done');

-- ----------------------------
-- View structure for check_box
-- ----------------------------
DROP VIEW IF EXISTS `check_box`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `check_box` AS select `picking`.`box_code` AS `box_code`,`picking`.`store_id` AS `store_id`,`picking`.`store_name` AS `store_name`,`picking`.`article` AS `article`,`picking`.`size_desc` AS `size_desc`,`picking`.`color_code` AS `color_code`,`picking`.`picked_qty` AS `picked_qty`,`picking`.`variance_qty` AS `variance_qty`,`picking`.`confirmation_date` AS `confirmation_date`,`picking`.`confirmation_time` AS `confirmation_time`,`picking`.`picker` AS `picker`,`picking`.`concept` AS `concept` from `picking` where (`picking`.`status` = 'Done');

-- ----------------------------
-- View structure for cycle_count_offline
-- ----------------------------
DROP VIEW IF EXISTS `cycle_count_offline`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `cycle_count_offline` AS select `cycle_count`.`id` AS `id`,`cycle_count`.`location` AS `location`,`cycle_count`.`scan` AS `scan`,`cycle_count`.`article` AS `article`,`cycle_count`.`user` AS `user`,`cycle_count`.`date_created` AS `date_created`,`cycle_count`.`date_updated` AS `date_updated`,`cycle_count`.`divisi` AS `divisi`,`cycle_count`.`su` AS `su` from `cycle_count`;

-- ----------------------------
-- View structure for data_extra_stock
-- ----------------------------
DROP VIEW IF EXISTS `data_extra_stock`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `data_extra_stock` AS select `extra_stock`.`id` AS `id`,`extra_stock`.`article` AS `article`,`extra_stock`.`location` AS `location`,`extra_stock`.`ctn` AS `ctn`,`extra_stock`.`quantity` AS `quantity`,`extra_stock`.`description` AS `description`,`extra_stock`.`size_desc` AS `size_desc`,`extra_stock`.`color_code` AS `color_code`,`extra_stock`.`color_desc` AS `color_desc`,`extra_stock`.`season` AS `season`,`extra_stock`.`no_box` AS `no_box`,`extra_stock`.`location_2nd` AS `location_2nd`,`extra_stock`.`date_created` AS `date_created`,`extra_stock`.`date_updated` AS `date_updated` from `extra_stock`;

-- ----------------------------
-- View structure for empty_box
-- ----------------------------
DROP VIEW IF EXISTS `empty_box`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `empty_box` AS select `disposition_location`.`id` AS `id`,`disposition_location`.`photo_before` AS `photo_before`,`disposition_location`.`photo_after` AS `photo_after`,`disposition_location`.`divisi` AS `divisi`,`disposition_location`.`status` AS `status`,`disposition_location`.`date_created` AS `date_created`,`disposition_location`.`date_updated` AS `date_updated`,`disposition_location`.`subject` AS `subject` from `disposition_location` where (`disposition_location`.`subject` = 'Empty Box');

-- ----------------------------
-- View structure for findingshortpick
-- ----------------------------
DROP VIEW IF EXISTS `findingshortpick`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `findingshortpick` AS select `finding_shortpick`.`id` AS `id`,`finding_shortpick`.`location` AS `location`,`finding_shortpick`.`article` AS `article`,`finding_shortpick`.`description` AS `description`,`finding_shortpick`.`target_quantity` AS `target_quantity`,`finding_shortpick`.`pick_quantity` AS `pick_quantity`,`finding_shortpick`.`shortpick` AS `shortpick`,`finding_shortpick`.`user` AS `user`,`finding_shortpick`.`area` AS `area`,`finding_shortpick`.`status` AS `status`,`finding_shortpick`.`date_upload` AS `date_upload`,`finding_shortpick`.`date_picking` AS `date_picking`,`finding_shortpick`.`total` AS `total`,`finding_shortpick`.`ctn` AS `ctn`,`finding_shortpick`.`excess` AS `excess`,`finding_shortpick`.`actual` AS `actual` from `finding_shortpick` where (`finding_shortpick`.`status` = 'Pending') order by `finding_shortpick`.`id`;

-- ----------------------------
-- View structure for monitor_audit_picking
-- ----------------------------
DROP VIEW IF EXISTS `monitor_audit_picking`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `monitor_audit_picking` AS select `box_picking`.`picking_date` AS `picking_date`,`box_picking`.`users` AS `users`,sum(if((`box_picking`.`status` = 'Unmatch'),1,0)) AS `Pending`,sum(if((`box_picking`.`status` = 'Match'),1,0)) AS `Done`,count(`box_picking`.`status`) AS `total` from `box_picking` group by `box_picking`.`picking_date`,`box_picking`.`users`;

-- ----------------------------
-- View structure for monitor_cycle_count
-- ----------------------------
DROP VIEW IF EXISTS `monitor_cycle_count`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `monitor_cycle_count` AS select `cycle_count`.`location` AS `Location`,if((length(`cycle_count`.`article`) = 16),left(`cycle_count`.`article`,10),left(`cycle_count`.`article`,9)) AS `Short Article`,count(`cycle_count`.`article`) AS `Total`,`cycle_count`.`user` AS `User`,cast(`cycle_count`.`date_created` as date) AS `Date Created` from `cycle_count` where ((`cycle_count`.`article` is not null) and (`cycle_count`.`divisi` = 'Online')) group by `cycle_count`.`location`,`cycle_count`.`user`,cast(`cycle_count`.`date_created` as date),if((length(`cycle_count`.`article`) = 16),left(`cycle_count`.`article`,10),left(`cycle_count`.`article`,9)),`cycle_count`.`divisi`;

-- ----------------------------
-- View structure for monitor_cycle_count_offline
-- ----------------------------
DROP VIEW IF EXISTS `monitor_cycle_count_offline`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `monitor_cycle_count_offline` AS select `cycle_count`.`location` AS `Location`,`cycle_count`.`su` AS `Ctn`,if((length(`cycle_count`.`article`) = 16),left(`cycle_count`.`article`,10),left(`cycle_count`.`article`,9)) AS `Short Article`,count(`cycle_count`.`article`) AS `Total`,`cycle_count`.`user` AS `User`,cast(`cycle_count`.`date_created` as date) AS `Date Created` from `cycle_count` where ((`cycle_count`.`article` is not null) and (`cycle_count`.`divisi` = 'Offline')) group by `cycle_count`.`location`,`cycle_count`.`user`,cast(`cycle_count`.`date_created` as date),if((length(`cycle_count`.`article`) = 16),left(`cycle_count`.`article`,10),left(`cycle_count`.`article`,9)),`cycle_count`.`divisi`,`cycle_count`.`su`;

-- ----------------------------
-- View structure for monitor_kpi
-- ----------------------------
DROP VIEW IF EXISTS `monitor_kpi`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `monitor_kpi` AS select `disposition_location`.`date_created` AS `Date`,'Disposition Location' AS `Subject`,`disposition_location`.`divisi` AS `Divisi`,sum(if((`disposition_location`.`status` = 'Pending'),1,0)) AS `Pending`,sum(if((`disposition_location`.`status` = 'Done'),1,0)) AS `Done`,count(`disposition_location`.`photo_before`) AS `Total` from `disposition_location` group by `disposition_location`.`date_created`,`disposition_location`.`divisi`;

-- ----------------------------
-- View structure for monitor_staging_delivered
-- ----------------------------
DROP VIEW IF EXISTS `monitor_staging_delivered`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `monitor_staging_delivered` AS select `staging`.`id` AS `id`,`staging`.`store_name` AS `store_name`,`staging`.`store_code` AS `store_code`,`staging`.`box_id` AS `box_id`,`staging`.`type` AS `type`,`staging`.`concept` AS `concept`,`staging`.`quantity` AS `quantity`,`staging`.`picking_date` AS `picking_date`,`staging`.`date_created` AS `date_created`,`staging`.`status` AS `status`,`staging`.`users` AS `users`,`staging`.`date_updated` AS `date_updated` from `staging` where (`staging`.`date_delivery` is not null);

-- ----------------------------
-- View structure for monitor_staging_on_staging
-- ----------------------------
DROP VIEW IF EXISTS `monitor_staging_on_staging`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `monitor_staging_on_staging` AS select `staging`.`id` AS `id`,`staging`.`store_name` AS `store_name`,`staging`.`store_code` AS `store_code`,`staging`.`box_id` AS `box_id`,`staging`.`type` AS `type`,`staging`.`concept` AS `concept`,`staging`.`quantity` AS `quantity`,`staging`.`picking_date` AS `picking_date`,`staging`.`date_created` AS `date_created`,`staging`.`status` AS `status`,`staging`.`users` AS `users`,`staging`.`date_updated` AS `date_updated`,`staging`.`line` AS `line` from `staging` where (isnull(`staging`.`date_delivery`) = 1);

-- ----------------------------
-- View structure for picking_pending
-- ----------------------------
DROP VIEW IF EXISTS `picking_pending`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `picking_pending` AS select `picking`.`id` AS `id`,`picking`.`po_no` AS `po_no`,`picking`.`to_no` AS `to_no`,`picking`.`to_order_item` AS `to_order_item`,`picking`.`to_priority` AS `to_priority`,`picking`.`to_priority_code` AS `to_priority_code`,`picking`.`source_storage_type` AS `source_storage_type`,`picking`.`source_storage_bin` AS `source_storage_bin`,`picking`.`carton_number` AS `carton_number`,`picking`.`creation_date` AS `creation_date`,`picking`.`gr_number` AS `gr_number`,`picking`.`gr_date` AS `gr_date`,`picking`.`delivery` AS `delivery`,`picking`.`store_id` AS `store_id`,`picking`.`store_name` AS `store_name`,`picking`.`article` AS `article`,`picking`.`size_code` AS `size_code`,`picking`.`size_desc` AS `size_desc`,`picking`.`color_code` AS `color_code`,`picking`.`color_desc` AS `color_desc`,`picking`.`concept` AS `concept`,`picking`.`target_qty` AS `target_qty`,`picking`.`picked_qty` AS `picked_qty`,`picking`.`variance_qty` AS `variance_qty`,`picking`.`confirmation_date` AS `confirmation_date`,`picking`.`confirmation_time` AS `confirmation_time`,`picking`.`box_code` AS `box_code`,`picking`.`box_type` AS `box_type`,`picking`.`picker` AS `picker`,`picking`.`status` AS `status`,`picking`.`remarks` AS `remarks`,`picking`.`aisle` AS `aisle`,`picking`.`area` AS `area`,`picking`.`aisle2` AS `aisle2`,`picking`.`store_id2` AS `store_id2`,`picking`.`close_totes` AS `close_totes`,`picking`.`job_id` AS `job_id`,`picking`.`sequence` AS `sequence` from `picking` where (`picking`.`status` = 'Pending');

-- ----------------------------
-- View structure for productivity_online
-- ----------------------------
DROP VIEW IF EXISTS `productivity_online`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `productivity_online` AS select `picking`.`confirmation_date` AS `picking_date`,`picking`.`picker` AS `picker`,count(`picking`.`source_storage_bin`) AS `total_bin`,sum(`picking`.`target_qty`) AS `total`,sum(`picking`.`picked_qty`) AS `picked`,sum(`picking`.`variance_qty`) AS `variance` from `picking` where (`picking`.`status` = 'Done') group by `picking`.`confirmation_date`,`picking`.`picker`;

-- ----------------------------
-- View structure for putaway_opening
-- ----------------------------
DROP VIEW IF EXISTS `putaway_opening`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `putaway_opening` AS select `box_picking`.`id` AS `id`,`box_picking`.`store_name` AS `store_name`,`box_picking`.`store_code` AS `store_code`,`box_picking`.`line` AS `line`,`box_picking`.`box_id` AS `box_id`,`box_picking`.`concept` AS `concept`,`box_picking`.`type` AS `type`,`box_picking`.`quantity` AS `quantity`,`box_picking`.`status` AS `status`,`box_picking`.`users` AS `users`,`box_picking`.`picking_date` AS `picking_date`,`box_picking`.`date_staging` AS `date_staging` from `box_picking` where (isnull(`box_picking`.`date_delivery`) = 1) order by `box_picking`.`line`,`box_picking`.`picking_date`,`box_picking`.`store_code`;

-- ----------------------------
-- View structure for putaway_staging
-- ----------------------------
DROP VIEW IF EXISTS `putaway_staging`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `putaway_staging` AS select `box_picking`.`id` AS `id`,`box_picking`.`store_name` AS `store_name`,`box_picking`.`store_code` AS `store_code`,`box_picking`.`line` AS `line`,`box_picking`.`box_id` AS `box_id`,`box_picking`.`concept` AS `concept`,`box_picking`.`type` AS `type`,`box_picking`.`quantity` AS `quantity`,`box_picking`.`status` AS `status`,`box_picking`.`users` AS `users`,`box_picking`.`picking_date` AS `picking_date`,`box_picking`.`date_staging` AS `date_staging` from `box_picking` where (isnull(`box_picking`.`date_delivery`) = 1) order by `box_picking`.`line`,`box_picking`.`picking_date`,`box_picking`.`store_code`;

-- ----------------------------
-- View structure for putaway_staging2
-- ----------------------------
DROP VIEW IF EXISTS `putaway_staging2`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `putaway_staging2` AS select `box_picking`.`id` AS `id`,`box_picking`.`store_name` AS `store_name`,`box_picking`.`store_code` AS `store_code`,`box_picking`.`line` AS `line`,`box_picking`.`box_id` AS `box_id`,`box_picking`.`concept` AS `concept`,`box_picking`.`type` AS `type`,`box_picking`.`quantity` AS `quantity`,`box_picking`.`status` AS `status`,`box_picking`.`users` AS `users`,`box_picking`.`picking_date` AS `picking_date`,`box_picking`.`date_staging` AS `date_staging` from `box_picking` where (isnull(`box_picking`.`date_delivery`) = 1) order by `box_picking`.`line`,`box_picking`.`picking_date`,`box_picking`.`store_code`;

-- ----------------------------
-- View structure for putaway_staging3
-- ----------------------------
DROP VIEW IF EXISTS `putaway_staging3`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `putaway_staging3` AS select `box_picking`.`id` AS `id`,`box_picking`.`store_name` AS `store_name`,`box_picking`.`store_code` AS `store_code`,`box_picking`.`line` AS `line`,`box_picking`.`box_id` AS `box_id`,`box_picking`.`concept` AS `concept`,`box_picking`.`type` AS `type`,`box_picking`.`quantity` AS `quantity`,`box_picking`.`status` AS `status`,`box_picking`.`users` AS `users`,`box_picking`.`picking_date` AS `picking_date`,`box_picking`.`date_staging` AS `date_staging` from `box_picking` where (isnull(`box_picking`.`date_delivery`) = 1) order by `box_picking`.`line`,`box_picking`.`picking_date`,`box_picking`.`store_code`;

-- ----------------------------
-- View structure for putaway_staging4
-- ----------------------------
DROP VIEW IF EXISTS `putaway_staging4`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `putaway_staging4` AS select `box_picking`.`id` AS `id`,`box_picking`.`store_name` AS `store_name`,`box_picking`.`store_code` AS `store_code`,`box_picking`.`line` AS `line`,`box_picking`.`box_id` AS `box_id`,`box_picking`.`concept` AS `concept`,`box_picking`.`type` AS `type`,`box_picking`.`quantity` AS `quantity`,`box_picking`.`status` AS `status`,`box_picking`.`users` AS `users`,`box_picking`.`picking_date` AS `picking_date`,`box_picking`.`date_staging` AS `date_staging` from `box_picking` where (isnull(`box_picking`.`date_delivery`) = 1) order by `box_picking`.`line`,`box_picking`.`picking_date`,`box_picking`.`store_code`;

-- ----------------------------
-- View structure for putaway_staging5
-- ----------------------------
DROP VIEW IF EXISTS `putaway_staging5`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `putaway_staging5` AS select `box_picking`.`id` AS `id`,`box_picking`.`store_name` AS `store_name`,`box_picking`.`store_code` AS `store_code`,`box_picking`.`line` AS `line`,`box_picking`.`box_id` AS `box_id`,`box_picking`.`concept` AS `concept`,`box_picking`.`type` AS `type`,`box_picking`.`quantity` AS `quantity`,`box_picking`.`status` AS `status`,`box_picking`.`users` AS `users`,`box_picking`.`picking_date` AS `picking_date`,`box_picking`.`date_staging` AS `date_staging` from `box_picking` where (isnull(`box_picking`.`date_delivery`) = 1) order by `box_picking`.`line`,`box_picking`.`picking_date`,`box_picking`.`store_code`;

-- ----------------------------
-- View structure for putaway_staging6
-- ----------------------------
DROP VIEW IF EXISTS `putaway_staging6`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `putaway_staging6` AS select `box_picking`.`id` AS `id`,`box_picking`.`store_name` AS `store_name`,`box_picking`.`store_code` AS `store_code`,`box_picking`.`line` AS `line`,`box_picking`.`box_id` AS `box_id`,`box_picking`.`concept` AS `concept`,`box_picking`.`type` AS `type`,`box_picking`.`quantity` AS `quantity`,`box_picking`.`status` AS `status`,`box_picking`.`users` AS `users`,`box_picking`.`picking_date` AS `picking_date`,`box_picking`.`date_staging` AS `date_staging` from `box_picking` where (isnull(`box_picking`.`date_delivery`) = 1) order by `box_picking`.`line`,`box_picking`.`picking_date`,`box_picking`.`store_code`;

-- ----------------------------
-- View structure for putaway_staging7
-- ----------------------------
DROP VIEW IF EXISTS `putaway_staging7`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `putaway_staging7` AS select `box_picking`.`id` AS `id`,`box_picking`.`store_name` AS `store_name`,`box_picking`.`store_code` AS `store_code`,`box_picking`.`line` AS `line`,`box_picking`.`box_id` AS `box_id`,`box_picking`.`concept` AS `concept`,`box_picking`.`type` AS `type`,`box_picking`.`quantity` AS `quantity`,`box_picking`.`status` AS `status`,`box_picking`.`users` AS `users`,`box_picking`.`picking_date` AS `picking_date`,`box_picking`.`date_staging` AS `date_staging` from `box_picking` where (isnull(`box_picking`.`date_delivery`) = 1) order by `box_picking`.`line`,`box_picking`.`picking_date`,`box_picking`.`store_code`;

-- ----------------------------
-- View structure for shortpick_by_area
-- ----------------------------
DROP VIEW IF EXISTS `shortpick_by_area`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `shortpick_by_area` AS select `locations`.`area` AS `area` from (`finding_shortpick` join `locations` on((`finding_shortpick`.`location` = `locations`.`location`))) where (`finding_shortpick`.`status` = 'Pending') group by `locations`.`area`;

-- ----------------------------
-- View structure for stock_count_monitor
-- ----------------------------
DROP VIEW IF EXISTS `stock_count_monitor`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `stock_count_monitor` AS select left(`stock_count`.`location`,2) AS `aisle`,count(distinct `stock_count`.`location`) AS `counted_location`,count(`stock_count`.`article`) AS `counted_pcs` from `stock_count` group by left(`stock_count`.`location`,2);

-- ----------------------------
-- View structure for summary_box_online
-- ----------------------------
DROP VIEW IF EXISTS `summary_box_online`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `summary_box_online` AS select high_priority sql_big_result sql_buffer_result `picking`.`box_code` AS `box_code`,`picking`.`store_id` AS `store_id`,`picking`.`store_name` AS `store_name`,sum(distinct `picking`.`picked_qty`) AS `picked_qty`,count(`audit_picking_online`.`box_code`) AS `scan_qty`,if(((sum(distinct `picking`.`picked_qty`) = count(`audit_picking_online`.`box_code`)) and (sum(distinct `picking`.`picked_qty`) > 0)),'Match','Unmatch') AS `result` from (`picking` left join `audit_picking_online` on((`picking`.`box_code` = `audit_picking_online`.`box_code`))) where ((`picking`.`box_code` is not null) and (`picking`.`confirmation_date` > '2022-11-01')) group by `picking`.`box_code`,`picking`.`store_id`,`picking`.`store_name`;

-- ----------------------------
-- View structure for summary_stock_count
-- ----------------------------
DROP VIEW IF EXISTS `summary_stock_count`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `summary_stock_count` AS select `stock_count`.`location` AS `Location`,`stock_count`.`article` AS `Article`,count(`stock_count`.`article`) AS `Total`,`stock_count`.`user` AS `User`,cast(`stock_count`.`date_created` as date) AS `Date Created` from `stock_count` where ((`stock_count`.`article` is not null) and (`stock_count`.`divisi` = 'Online')) group by `stock_count`.`location`,`stock_count`.`user`,`stock_count`.`article`,`stock_count`.`divisi`,`stock_count`.`date_created` order by `stock_count`.`location` desc,`stock_count`.`date_created` desc;

-- ----------------------------
-- Triggers structure for table picking
-- ----------------------------
DROP TRIGGER IF EXISTS `picking_before_insert`;
delimiter ;;
CREATE TRIGGER `picking_before_insert` BEFORE INSERT ON `picking` FOR EACH ROW BEGIN
SET NEW.aisle = LEFT(NEW.source_storage_bin,2);
SET NEW.aisle2 = CONCAT('''',LEFT(NEW.source_storage_bin,2),'''');
SET NEW.area = (SELECT area FROM `locations` WHERE `location` = NEW.source_storage_bin);
SET NEW.store_id2 = CONCAT('''',NEW.store_id,'''');
SET NEW.`status` = 'Pending';
SET NEW.`sequence` = (SELECT `sequence` FROM `locations` WHERE `location` = NEW.source_storage_bin);
END
;;
delimiter ;

SET FOREIGN_KEY_CHECKS = 1;
