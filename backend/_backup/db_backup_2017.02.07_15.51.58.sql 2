-- -------------------------------------------
SET AUTOCOMMIT=0;
START TRANSACTION;
SET SQL_QUOTE_SHOW_CREATE = 1;
SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
-- -------------------------------------------
-- -------------------------------------------
-- START BACKUP
-- -------------------------------------------
-- -------------------------------------------
-- TABLE `auth_assignment`
-- -------------------------------------------
DROP TABLE IF EXISTS `auth_assignment`;
CREATE TABLE IF NOT EXISTS `auth_assignment` (
  `item_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`item_name`,`user_id`),
  CONSTRAINT `auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- -------------------------------------------
-- TABLE `auth_item`
-- -------------------------------------------
DROP TABLE IF EXISTS `auth_item`;
CREATE TABLE IF NOT EXISTS `auth_item` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `type` int(11) NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `rule_name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data` text COLLATE utf8_unicode_ci,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`),
  KEY `rule_name` (`rule_name`),
  KEY `idx-auth_item-type` (`type`),
  CONSTRAINT `auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- -------------------------------------------
-- TABLE `auth_item_child`
-- -------------------------------------------
DROP TABLE IF EXISTS `auth_item_child`;
CREATE TABLE IF NOT EXISTS `auth_item_child` (
  `parent` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `child` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`),
  CONSTRAINT `auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- -------------------------------------------
-- TABLE `auth_rule`
-- -------------------------------------------
DROP TABLE IF EXISTS `auth_rule`;
CREATE TABLE IF NOT EXISTS `auth_rule` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `data` text COLLATE utf8_unicode_ci,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- -------------------------------------------
-- TABLE `migration`
-- -------------------------------------------
DROP TABLE IF EXISTS `migration`;
CREATE TABLE IF NOT EXISTS `migration` (
  `version` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- -------------------------------------------
-- TABLE `tbl_audit`
-- -------------------------------------------
DROP TABLE IF EXISTS `tbl_audit`;
CREATE TABLE IF NOT EXISTS `tbl_audit` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `activity` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `module` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `action` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `maker` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `maker_time` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- -------------------------------------------
-- TABLE `tbl_cart`
-- -------------------------------------------
DROP TABLE IF EXISTS `tbl_cart`;
CREATE TABLE IF NOT EXISTS `tbl_cart` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `price` decimal(10,0) DEFAULT NULL,
  `qty` decimal(10,0) DEFAULT NULL,
  `total` decimal(10,0) DEFAULT NULL,
  `maker_id` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `maker_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx-tbl_cart-product_id` (`product_id`),
  CONSTRAINT `fk-tbl_cart-product_id` FOREIGN KEY (`product_id`) REFERENCES `tbl_product` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- -------------------------------------------
-- TABLE `tbl_cashbook`
-- -------------------------------------------
DROP TABLE IF EXISTS `tbl_cashbook`;
CREATE TABLE IF NOT EXISTS `tbl_cashbook` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `trn_dt` date NOT NULL,
  `amount` decimal(10,0) NOT NULL,
  `drcr_ind` char(1) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `maker_id` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `maker_time` datetime NOT NULL,
  `auth_status` char(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `checker_id` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `checker_time` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- -------------------------------------------
-- TABLE `tbl_category`
-- -------------------------------------------
DROP TABLE IF EXISTS `tbl_category`;
CREATE TABLE IF NOT EXISTS `tbl_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent` int(11) DEFAULT NULL,
  `title` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `maker_id` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `maker_time` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- -------------------------------------------
-- TABLE `tbl_inventory`
-- -------------------------------------------
DROP TABLE IF EXISTS `tbl_inventory`;
CREATE TABLE IF NOT EXISTS `tbl_inventory` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `buying_price` decimal(10,0) NOT NULL,
  `selling_price` decimal(10,0) NOT NULL,
  `qty` decimal(10,0) NOT NULL,
  `min_level` int(11) DEFAULT NULL,
  `last_updated` datetime DEFAULT NULL,
  `maker_id` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `maker_time` datetime NOT NULL,
  `auth_status` char(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `checker_id` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `checker_time` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `product_id` (`product_id`),
  KEY `idx-tbl_inventory-product_id` (`product_id`),
  CONSTRAINT `fk-tbl_inventory-product_id` FOREIGN KEY (`product_id`) REFERENCES `tbl_product` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- -------------------------------------------
-- TABLE `tbl_language`
-- -------------------------------------------
DROP TABLE IF EXISTS `tbl_language`;
CREATE TABLE IF NOT EXISTS `tbl_language` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `langugae_code` char(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `title` (`title`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- -------------------------------------------
-- TABLE `tbl_payment_method`
-- -------------------------------------------
DROP TABLE IF EXISTS `tbl_payment_method`;
CREATE TABLE IF NOT EXISTS `tbl_payment_method` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `method_name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- -------------------------------------------
-- TABLE `tbl_price_maintanance`
-- -------------------------------------------
DROP TABLE IF EXISTS `tbl_price_maintanance`;
CREATE TABLE IF NOT EXISTS `tbl_price_maintanance` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `price_type` int(11) NOT NULL,
  `old_price` decimal(10,0) NOT NULL,
  `new_price` decimal(10,0) NOT NULL,
  `reason` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `maker_id` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `maker_time` datetime NOT NULL,
  `auth_status` char(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `checker_id` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `checker_time` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idx-tbl_price_maintanance-product_id` (`product_id`),
  CONSTRAINT `fk-tbl_price_maintanance-product_id` FOREIGN KEY (`product_id`) REFERENCES `tbl_product` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- -------------------------------------------
-- TABLE `tbl_product`
-- -------------------------------------------
DROP TABLE IF EXISTS `tbl_product`;
CREATE TABLE IF NOT EXISTS `tbl_product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_code` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `barcode` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `product_name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `category` int(11) NOT NULL,
  `image` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `maker_id` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `maker_time` datetime NOT NULL,
  `auth_status` char(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `checker_id` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `checker_time` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `product_code` (`product_code`),
  UNIQUE KEY `barcode` (`barcode`),
  KEY `idx-tbl_product-category` (`category`),
  CONSTRAINT `fk-tbl_product-category` FOREIGN KEY (`category`) REFERENCES `tbl_category` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- -------------------------------------------
-- TABLE `tbl_product_attribute`
-- -------------------------------------------
DROP TABLE IF EXISTS `tbl_product_attribute`;
CREATE TABLE IF NOT EXISTS `tbl_product_attribute` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `attribute_name` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `quantity` decimal(10,0) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idx-tbl_product_attribute-product_id` (`product_id`),
  CONSTRAINT `fk-tbl_product_attribute-product_id` FOREIGN KEY (`product_id`) REFERENCES `tbl_product` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- -------------------------------------------
-- TABLE `tbl_product_return`
-- -------------------------------------------
DROP TABLE IF EXISTS `tbl_product_return`;
CREATE TABLE IF NOT EXISTS `tbl_product_return` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `trn_dt` date NOT NULL,
  `return_type` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `price` decimal(10,0) DEFAULT NULL,
  `qty` decimal(10,0) DEFAULT NULL,
  `total` decimal(10,0) DEFAULT NULL,
  `source_ref_no` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `maker_id` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `maker_time` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idx-tbl_product_return-product_id` (`product_id`),
  CONSTRAINT `fk-tbl_product_return-product_id` FOREIGN KEY (`product_id`) REFERENCES `tbl_product` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- -------------------------------------------
-- TABLE `tbl_purchase`
-- -------------------------------------------
DROP TABLE IF EXISTS `tbl_purchase`;
CREATE TABLE IF NOT EXISTS `tbl_purchase` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `qty` decimal(10,0) NOT NULL,
  `total` decimal(10,0) NOT NULL,
  `purchase_invoice_id` int(11) NOT NULL,
  `selling_price` decimal(10,0) DEFAULT NULL,
  `maker_id` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `maker_time` datetime NOT NULL,
  `auth_status` char(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `checker_id` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `checker_time` datetime NOT NULL,
  `status` int(11) DEFAULT NULL,
  `delete_stat` char(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx-tbl_purchase-product_id` (`product_id`),
  KEY `idx-tbl_purchase-purchase_invoice_id` (`purchase_invoice_id`),
  CONSTRAINT `fk-tbl_purchase-product_id` FOREIGN KEY (`product_id`) REFERENCES `tbl_product` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk-tbl_purchase-purchase_invoice_id` FOREIGN KEY (`purchase_invoice_id`) REFERENCES `tbl_purchase_invoice` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- -------------------------------------------
-- TABLE `tbl_purchase_cost`
-- -------------------------------------------
DROP TABLE IF EXISTS `tbl_purchase_cost`;
CREATE TABLE IF NOT EXISTS `tbl_purchase_cost` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `purchase_master_id` int(11) NOT NULL,
  `amount` decimal(10,0) NOT NULL,
  `description` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `maker_id` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `maker_time` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idx-tbl_purchase_cost-purchase_master_id` (`purchase_master_id`),
  CONSTRAINT `fk-tbl_purchase_cost-purchase_master_id` FOREIGN KEY (`purchase_master_id`) REFERENCES `tbl_purchase_master` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- -------------------------------------------
-- TABLE `tbl_purchase_invoice`
-- -------------------------------------------
DROP TABLE IF EXISTS `tbl_purchase_invoice`;
CREATE TABLE IF NOT EXISTS `tbl_purchase_invoice` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `invoice_number` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `purchase_date` date DEFAULT NULL,
  `supplier_id` int(11) NOT NULL,
  `purchase_master_id` int(11) NOT NULL,
  `total_purchase` decimal(10,0) DEFAULT NULL,
  `maker_id` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `maker_time` datetime NOT NULL,
  `checker_id` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `checker_time` datetime NOT NULL,
  `status` int(11) DEFAULT NULL,
  `delete_stat` char(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx-tbl_purchase_invoice-supplier_id` (`supplier_id`),
  KEY `idx-tbl_purchase_invoice-purchase_master_id` (`purchase_master_id`),
  CONSTRAINT `fk-tbl_purchase_invoice-purchase_master_id` FOREIGN KEY (`purchase_master_id`) REFERENCES `tbl_purchase_master` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk-tbl_purchase_invoice-supplier_id` FOREIGN KEY (`supplier_id`) REFERENCES `tbl_supplier` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- -------------------------------------------
-- TABLE `tbl_purchase_master`
-- -------------------------------------------
DROP TABLE IF EXISTS `tbl_purchase_master`;
CREATE TABLE IF NOT EXISTS `tbl_purchase_master` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `country` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `period` char(3) COLLATE utf8_unicode_ci NOT NULL,
  `financial_year` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `fcy_rate` decimal(10,0) DEFAULT NULL,
  `lcy_rate` decimal(10,0) DEFAULT NULL,
  `maker_id` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `maker_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- -------------------------------------------
-- TABLE `tbl_report`
-- -------------------------------------------
DROP TABLE IF EXISTS `tbl_report`;
CREATE TABLE IF NOT EXISTS `tbl_report` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `report_name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `module` int(11) DEFAULT NULL,
  `path` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx-tbl_report-module` (`module`),
  CONSTRAINT `fk-tbl_purchase_cost-module` FOREIGN KEY (`module`) REFERENCES `tbl_system_module` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- -------------------------------------------
-- TABLE `tbl_sales`
-- -------------------------------------------
DROP TABLE IF EXISTS `tbl_sales`;
CREATE TABLE IF NOT EXISTS `tbl_sales` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `trn_dt` date NOT NULL,
  `total_qty` decimal(10,0) NOT NULL,
  `total_amount` decimal(10,0) NOT NULL,
  `paid_amount` decimal(10,0) NOT NULL,
  `due_amount` decimal(10,0) NOT NULL,
  `payment_method` int(11) NOT NULL,
  `source_ref_number` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `notes` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `customer_name` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `maker_id` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `maker_time` datetime NOT NULL,
  `status` char(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- -------------------------------------------
-- TABLE `tbl_sales_item`
-- -------------------------------------------
DROP TABLE IF EXISTS `tbl_sales_item`;
CREATE TABLE IF NOT EXISTS `tbl_sales_item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sales_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `selling_price` decimal(10,0) DEFAULT NULL,
  `qty` decimal(10,0) DEFAULT NULL,
  `total` decimal(10,0) DEFAULT NULL,
  `maker_id` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `maker_time` datetime NOT NULL,
  `delete_stat` char(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx-tbl_sales_item-product_id` (`product_id`),
  KEY `idx-tbl_sales_item-sales_id` (`sales_id`),
  CONSTRAINT `fk-tbl_sales_item-product_id` FOREIGN KEY (`product_id`) REFERENCES `tbl_product` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk-tbl_sales_item-sales_id` FOREIGN KEY (`sales_id`) REFERENCES `tbl_sales` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- -------------------------------------------
-- TABLE `tbl_stock_adjustment`
-- -------------------------------------------
DROP TABLE IF EXISTS `tbl_stock_adjustment`;
CREATE TABLE IF NOT EXISTS `tbl_stock_adjustment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `adjust_type` int(11) NOT NULL,
  `qty` decimal(10,0) NOT NULL,
  `stock_change` decimal(10,0) NOT NULL,
  `amount` decimal(10,0) NOT NULL,
  `total_amount` int(11) NOT NULL,
  `description` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `maker_id` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `maker_time` datetime NOT NULL,
  `auth_status` char(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `checker_id` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `checker_time` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idx-tbl_stock_adjustment-product_id` (`product_id`),
  CONSTRAINT `fk-tbl_stock_adjustment-product_id` FOREIGN KEY (`product_id`) REFERENCES `tbl_product` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- -------------------------------------------
-- TABLE `tbl_supplier`
-- -------------------------------------------
DROP TABLE IF EXISTS `tbl_supplier`;
CREATE TABLE IF NOT EXISTS `tbl_supplier` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `supplier_name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone_number` varchar(13) COLLATE utf8_unicode_ci NOT NULL,
  `location` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- -------------------------------------------
-- TABLE `tbl_system_module`
-- -------------------------------------------
DROP TABLE IF EXISTS `tbl_system_module`;
CREATE TABLE IF NOT EXISTS `tbl_system_module` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `module_name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` char(1) COLLATE utf8_unicode_ci NOT NULL,
  `maker_id` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `maker_time` datetime NOT NULL,
  `auth_status` char(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `checker_id` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `checker_time` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- -------------------------------------------
-- TABLE `tbl_system_setup`
-- -------------------------------------------
DROP TABLE IF EXISTS `tbl_system_setup`;
CREATE TABLE IF NOT EXISTS `tbl_system_setup` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tax` decimal(10,0) DEFAULT NULL,
  `discount` decimal(10,0) DEFAULT NULL,
  `currency` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `shop_name` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `shop_category` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `maker_checker` char(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- -------------------------------------------
-- TABLE `tbl_transaction`
-- -------------------------------------------
DROP TABLE IF EXISTS `tbl_transaction`;
CREATE TABLE IF NOT EXISTS `tbl_transaction` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `trn_ref_no` int(11) NOT NULL,
  `trn_dt` date NOT NULL,
  `module` char(2) COLLATE utf8_unicode_ci NOT NULL,
  `drcr_ind` char(1) COLLATE utf8_unicode_ci NOT NULL,
  `account` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `period` varchar(3) COLLATE utf8_unicode_ci NOT NULL,
  `year` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `delete_stat` char(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `auth_status` char(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `trn_event` char(3) COLLATE utf8_unicode_ci DEFAULT NULL,
  `maker_id` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `maker_time` datetime NOT NULL,
  `checker_id` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `checker_time` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- -------------------------------------------
-- TABLE `user`
-- -------------------------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- -------------------------------------------
-- TABLE DATA auth_assignment
-- -------------------------------------------
-- -------------------------------------------
-- TABLE DATA auth_assignment
-- -------------------------------------------



-- -------------------------------------------
-- TABLE DATA auth_item
-- -------------------------------------------
-- -------------------------------------------
-- TABLE DATA auth_item
-- -------------------------------------------



-- -------------------------------------------
-- TABLE DATA auth_item_child
-- -------------------------------------------
-- -------------------------------------------
-- TABLE DATA auth_item_child
-- -------------------------------------------



-- -------------------------------------------
-- TABLE DATA auth_rule
-- -------------------------------------------
-- -------------------------------------------
-- TABLE DATA auth_rule
-- -------------------------------------------



-- -------------------------------------------
-- TABLE DATA migration
-- -------------------------------------------
INSERT INTO `migration` (`version`,`apply_time`) VALUES
('m000000_000000_base','1486369668');;;
INSERT INTO `migration` (`version`,`apply_time`) VALUES
('m130524_201442_init','1486369846');;;
INSERT INTO `migration` (`version`,`apply_time`) VALUES
('m140506_102106_rbac_init','1486369846');;;
INSERT INTO `migration` (`version`,`apply_time`) VALUES
('m170113_151537_create_tbl_payment_method_table','1486369846');;;
INSERT INTO `migration` (`version`,`apply_time`) VALUES
('m170113_155020_create_tbl_category_table','1486369846');;;
INSERT INTO `migration` (`version`,`apply_time`) VALUES
('m170113_155021_create_tbl_supplier_table','1486369846');;;
INSERT INTO `migration` (`version`,`apply_time`) VALUES
('m170113_155843_create_tbl_purchase_master_table','1486369846');;;
INSERT INTO `migration` (`version`,`apply_time`) VALUES
('m170113_155844_create_tbl_product_table','1486369846');;;
INSERT INTO `migration` (`version`,`apply_time`) VALUES
('m170113_155845_create_tbl_purchase_invoice_table','1486369847');;;
INSERT INTO `migration` (`version`,`apply_time`) VALUES
('m170113_155948_create_tbl_purchase_table','1486369847');;;
INSERT INTO `migration` (`version`,`apply_time`) VALUES
('m170113_160057_create_tbl_product_attribute_table','1486369847');;;
INSERT INTO `migration` (`version`,`apply_time`) VALUES
('m170113_160128_create_tbl_inventory_table','1486369847');;;
INSERT INTO `migration` (`version`,`apply_time`) VALUES
('m170113_160151_create_tbl_sales_table','1486369847');;;
INSERT INTO `migration` (`version`,`apply_time`) VALUES
('m170113_160236_create_tbl_cashbook_table','1486369847');;;
INSERT INTO `migration` (`version`,`apply_time`) VALUES
('m170113_160317_create_tbl_price_maintanance_table','1486369847');;;
INSERT INTO `migration` (`version`,`apply_time`) VALUES
('m170113_160359_create_tbl_stock_adjustment_table','1486369848');;;
INSERT INTO `migration` (`version`,`apply_time`) VALUES
('m170113_160441_create_tbl_transaction_table','1486369848');;;
INSERT INTO `migration` (`version`,`apply_time`) VALUES
('m170113_160533_create_tbl_system_module_table','1486369848');;;
INSERT INTO `migration` (`version`,`apply_time`) VALUES
('m170113_160549_create_tbl_system_setup_table','1486369848');;;
INSERT INTO `migration` (`version`,`apply_time`) VALUES
('m170115_104820_create_tbl_audit_table','1486369848');;;
INSERT INTO `migration` (`version`,`apply_time`) VALUES
('m170117_073342_create_tbl_language_table','1486369848');;;
INSERT INTO `migration` (`version`,`apply_time`) VALUES
('m170128_121225_create_tbl_sales_item_table','1486369848');;;
INSERT INTO `migration` (`version`,`apply_time`) VALUES
('m170130_113234_create_tbl_cart_table','1486369848');;;
INSERT INTO `migration` (`version`,`apply_time`) VALUES
('m170203_145721_create_tbl_product_return_table','1486369849');;;
INSERT INTO `migration` (`version`,`apply_time`) VALUES
('m170207_044510_create_tbl_purchase_cost_table','1486443245');;;
INSERT INTO `migration` (`version`,`apply_time`) VALUES
('m170207_102050_create_tbl_report_table','1486463053');;;
INSERT INTO `migration` (`version`,`apply_time`) VALUES
('m170207_111738_create_tbl_report_table','1486466330');;;
-- -------------------------------------------
-- TABLE DATA migration
-- -------------------------------------------



-- -------------------------------------------
-- TABLE DATA tbl_audit
-- -------------------------------------------
INSERT INTO `tbl_audit` (`id`,`activity`,`module`,`action`,`maker`,`maker_time`) VALUES
('1','New Category is created (Maziwa)','Category Details','create','admin','2017-02-07:00:15:16');;;
INSERT INTO `tbl_audit` (`id`,`activity`,`module`,`action`,`maker`,`maker_time`) VALUES
('2','New Category is created (Maziwa ya mtindi)','Category Details','create','admin','2017-02-07:00:15:48');;;
INSERT INTO `tbl_audit` (`id`,`activity`,`module`,`action`,`maker`,`maker_time`) VALUES
('3','New Product created','Product Details','create','admin','2017-02-07:00:16:49');;;
-- -------------------------------------------
-- TABLE DATA tbl_audit
-- -------------------------------------------



-- -------------------------------------------
-- TABLE DATA tbl_cart
-- -------------------------------------------
-- -------------------------------------------
-- TABLE DATA tbl_cart
-- -------------------------------------------



-- -------------------------------------------
-- TABLE DATA tbl_cashbook
-- -------------------------------------------
-- -------------------------------------------
-- TABLE DATA tbl_cashbook
-- -------------------------------------------



-- -------------------------------------------
-- TABLE DATA tbl_category
-- -------------------------------------------
INSERT INTO `tbl_category` (`id`,`parent`,`title`,`description`,`maker_id`,`maker_time`) VALUES
('1','','Maziwa','Maziwa','admin','2017-02-07 00:15:16');;;
INSERT INTO `tbl_category` (`id`,`parent`,`title`,`description`,`maker_id`,`maker_time`) VALUES
('2','1','Maziwa ya mtindi','Maziwa ya mtindi','admin','2017-02-07 00:15:48');;;
-- -------------------------------------------
-- TABLE DATA tbl_category
-- -------------------------------------------



-- -------------------------------------------
-- TABLE DATA tbl_inventory
-- -------------------------------------------
INSERT INTO `tbl_inventory` (`id`,`product_id`,`buying_price`,`selling_price`,`qty`,`min_level`,`last_updated`,`maker_id`,`maker_time`,`auth_status`,`checker_id`,`checker_time`) VALUES
('1','1','1200','1500','28','5','2017-02-07 10:23:20','admin','2017-02-07 09:46:02','A','admin','2017-02-07 10:23:20');;;
-- -------------------------------------------
-- TABLE DATA tbl_inventory
-- -------------------------------------------



-- -------------------------------------------
-- TABLE DATA tbl_language
-- -------------------------------------------
INSERT INTO `tbl_language` (`id`,`title`,`langugae_code`,`status`) VALUES
('1','English','en','default');;;
INSERT INTO `tbl_language` (`id`,`title`,`langugae_code`,`status`) VALUES
('2','Swahili','sw','active');;;
-- -------------------------------------------
-- TABLE DATA tbl_language
-- -------------------------------------------



-- -------------------------------------------
-- TABLE DATA tbl_payment_method
-- -------------------------------------------
INSERT INTO `tbl_payment_method` (`id`,`method_name`) VALUES
('1','Cash');;;
INSERT INTO `tbl_payment_method` (`id`,`method_name`) VALUES
('2','Credit');;;
-- -------------------------------------------
-- TABLE DATA tbl_payment_method
-- -------------------------------------------



-- -------------------------------------------
-- TABLE DATA tbl_price_maintanance
-- -------------------------------------------
-- -------------------------------------------
-- TABLE DATA tbl_price_maintanance
-- -------------------------------------------



-- -------------------------------------------
-- TABLE DATA tbl_product
-- -------------------------------------------
INSERT INTO `tbl_product` (`id`,`product_code`,`barcode`,`product_name`,`description`,`category`,`image`,`status`,`maker_id`,`maker_time`,`auth_status`,`checker_id`,`checker_time`) VALUES
('1','111','211','Tanga Mtindi','','2','','0','admin','2017-02-07 00:16:49','','','0000-00-00 00:00:00');;;
-- -------------------------------------------
-- TABLE DATA tbl_product
-- -------------------------------------------



-- -------------------------------------------
-- TABLE DATA tbl_product_attribute
-- -------------------------------------------
-- -------------------------------------------
-- TABLE DATA tbl_product_attribute
-- -------------------------------------------



-- -------------------------------------------
-- TABLE DATA tbl_product_return
-- -------------------------------------------
-- -------------------------------------------
-- TABLE DATA tbl_product_return
-- -------------------------------------------



-- -------------------------------------------
-- TABLE DATA tbl_purchase
-- -------------------------------------------
INSERT INTO `tbl_purchase` (`id`,`product_id`,`price`,`qty`,`total`,`purchase_invoice_id`,`selling_price`,`maker_id`,`maker_time`,`auth_status`,`checker_id`,`checker_time`,`status`,`delete_stat`) VALUES
('1','1','1200','30','36000','1','1500','admin','2017-02-07 09:46:02','A','admin','2017-02-07 10:23:20','1','');;;
-- -------------------------------------------
-- TABLE DATA tbl_purchase
-- -------------------------------------------



-- -------------------------------------------
-- TABLE DATA tbl_purchase_cost
-- -------------------------------------------
INSERT INTO `tbl_purchase_cost` (`id`,`purchase_master_id`,`amount`,`description`,`maker_id`,`maker_time`) VALUES
('1','1','10000','Usafirishaji','admin','2017-02-07 10:10:15');;;
INSERT INTO `tbl_purchase_cost` (`id`,`purchase_master_id`,`amount`,`description`,`maker_id`,`maker_time`) VALUES
('2','1','2000','Ushuru','admin','2017-02-07 10:10:33');;;
-- -------------------------------------------
-- TABLE DATA tbl_purchase_cost
-- -------------------------------------------



-- -------------------------------------------
-- TABLE DATA tbl_purchase_invoice
-- -------------------------------------------
INSERT INTO `tbl_purchase_invoice` (`id`,`invoice_number`,`purchase_date`,`supplier_id`,`purchase_master_id`,`total_purchase`,`maker_id`,`maker_time`,`checker_id`,`checker_time`,`status`,`delete_stat`) VALUES
('1','678','2017-01-07','3','1','','admin','2017-02-07 09:46:02','admin','2017-02-07 10:23:20','1','');;;
-- -------------------------------------------
-- TABLE DATA tbl_purchase_invoice
-- -------------------------------------------



-- -------------------------------------------
-- TABLE DATA tbl_purchase_master
-- -------------------------------------------
INSERT INTO `tbl_purchase_master` (`id`,`description`,`country`,`period`,`financial_year`,`fcy_rate`,`lcy_rate`,`maker_id`,`maker_time`) VALUES
('1','Manunuzi ya mwez wa kwanza','1','M01','FY2017','','','admin','2017-02-07 08:24:59');;;
-- -------------------------------------------
-- TABLE DATA tbl_purchase_master
-- -------------------------------------------



-- -------------------------------------------
-- TABLE DATA tbl_report
-- -------------------------------------------
INSERT INTO `tbl_report` (`id`,`report_name`,`module`,`path`,`status`) VALUES
('1','Today\'s sales report','1','','1');;;
-- -------------------------------------------
-- TABLE DATA tbl_report
-- -------------------------------------------



-- -------------------------------------------
-- TABLE DATA tbl_sales
-- -------------------------------------------
INSERT INTO `tbl_sales` (`id`,`trn_dt`,`total_qty`,`total_amount`,`paid_amount`,`due_amount`,`payment_method`,`source_ref_number`,`notes`,`customer_name`,`maker_id`,`maker_time`,`status`) VALUES
('1','2017-02-07','2','3000','3000','0','1','','paid','','admin','2017-02-07 12:46:44','P');;;
-- -------------------------------------------
-- TABLE DATA tbl_sales
-- -------------------------------------------



-- -------------------------------------------
-- TABLE DATA tbl_sales_item
-- -------------------------------------------
INSERT INTO `tbl_sales_item` (`id`,`sales_id`,`product_id`,`selling_price`,`qty`,`total`,`maker_id`,`maker_time`,`delete_stat`) VALUES
('1','1','1','1500','2','3000','admin','2017-02-07 12:46:44','');;;
-- -------------------------------------------
-- TABLE DATA tbl_sales_item
-- -------------------------------------------



-- -------------------------------------------
-- TABLE DATA tbl_stock_adjustment
-- -------------------------------------------
-- -------------------------------------------
-- TABLE DATA tbl_stock_adjustment
-- -------------------------------------------



-- -------------------------------------------
-- TABLE DATA tbl_supplier
-- -------------------------------------------
INSERT INTO `tbl_supplier` (`id`,`supplier_name`,`email`,`phone_number`,`location`) VALUES
('1','Golden Star','info@goldenstar.co.tz','0722832323','Dar es salaam');;;
INSERT INTO `tbl_supplier` (`id`,`supplier_name`,`email`,`phone_number`,`location`) VALUES
('2','Azam','sales@azam.co.tz','078645602','Dar es salaam');;;
INSERT INTO `tbl_supplier` (`id`,`supplier_name`,`email`,`phone_number`,`location`) VALUES
('3','Tanga Fresh','sales@tangafresh.co.tz','0722832398','Tanga');;;
-- -------------------------------------------
-- TABLE DATA tbl_supplier
-- -------------------------------------------



-- -------------------------------------------
-- TABLE DATA tbl_system_module
-- -------------------------------------------
INSERT INTO `tbl_system_module` (`id`,`module_name`,`description`,`status`,`maker_id`,`maker_time`,`auth_status`,`checker_id`,`checker_time`) VALUES
('1','Sales','Sales','1','','0000-00-00 00:00:00','','','0000-00-00 00:00:00');;;
INSERT INTO `tbl_system_module` (`id`,`module_name`,`description`,`status`,`maker_id`,`maker_time`,`auth_status`,`checker_id`,`checker_time`) VALUES
('2','Purchase','Purchases','1','','0000-00-00 00:00:00','','','0000-00-00 00:00:00');;;
INSERT INTO `tbl_system_module` (`id`,`module_name`,`description`,`status`,`maker_id`,`maker_time`,`auth_status`,`checker_id`,`checker_time`) VALUES
('3','Inventory','Inventory','1','','0000-00-00 00:00:00','','','0000-00-00 00:00:00');;;
INSERT INTO `tbl_system_module` (`id`,`module_name`,`description`,`status`,`maker_id`,`maker_time`,`auth_status`,`checker_id`,`checker_time`) VALUES
('4','Purchase periods','Purchase periods','1','','0000-00-00 00:00:00','','','0000-00-00 00:00:00');;;
INSERT INTO `tbl_system_module` (`id`,`module_name`,`description`,`status`,`maker_id`,`maker_time`,`auth_status`,`checker_id`,`checker_time`) VALUES
('5','Returns','Returns','1','','0000-00-00 00:00:00','','','0000-00-00 00:00:00');;;
INSERT INTO `tbl_system_module` (`id`,`module_name`,`description`,`status`,`maker_id`,`maker_time`,`auth_status`,`checker_id`,`checker_time`) VALUES
('6','Product Management','Product Management','1','','0000-00-00 00:00:00','','','0000-00-00 00:00:00');;;
INSERT INTO `tbl_system_module` (`id`,`module_name`,`description`,`status`,`maker_id`,`maker_time`,`auth_status`,`checker_id`,`checker_time`) VALUES
('7','Price Maintenance','Price Maintenance','1','','0000-00-00 00:00:00','','','0000-00-00 00:00:00');;;
INSERT INTO `tbl_system_module` (`id`,`module_name`,`description`,`status`,`maker_id`,`maker_time`,`auth_status`,`checker_id`,`checker_time`) VALUES
('8','Stock Adjustment','Stock Adjustment','1','','0000-00-00 00:00:00','','','0000-00-00 00:00:00');;;
-- -------------------------------------------
-- TABLE DATA tbl_system_module
-- -------------------------------------------



-- -------------------------------------------
-- TABLE DATA tbl_system_setup
-- -------------------------------------------
INSERT INTO `tbl_system_setup` (`id`,`tax`,`discount`,`currency`,`shop_name`,`shop_category`,`maker_checker`) VALUES
('1','18','6','TZS','','','Y');;;
-- -------------------------------------------
-- TABLE DATA tbl_system_setup
-- -------------------------------------------



-- -------------------------------------------
-- TABLE DATA tbl_transaction
-- -------------------------------------------
-- -------------------------------------------
-- TABLE DATA tbl_transaction
-- -------------------------------------------



-- -------------------------------------------
-- TABLE DATA user
-- -------------------------------------------
INSERT INTO `user` (`id`,`username`,`auth_key`,`password_hash`,`password_reset_token`,`email`,`status`,`created_at`,`updated_at`) VALUES
('2','admin','k5l93PNMUkirYcWiSIKH8BNw2BH0ZHk3','$2y$13$dqkvJvNJqky3MTx37ea/JOyMMjTlIXQ479gbsz.hlMxGdoJDDARly','','adolph.cm@gmail.com','10','1486370990','1486370990');;;
-- -------------------------------------------
-- TABLE DATA user
-- -------------------------------------------



-- -------------------------------------------
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
COMMIT;
-- -------------------------------------------
-- -------------------------------------------
-- END BACKUP
-- -------------------------------------------
