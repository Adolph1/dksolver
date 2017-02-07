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
DROP TABLE IF EXISTS auth_assignment;
-- -------------------------------------------
-- -------------------------------------------
DROP TABLE IF EXISTS auth_item;
-- -------------------------------------------
-- -------------------------------------------
DROP TABLE IF EXISTS auth_item_child;
-- -------------------------------------------
-- -------------------------------------------
DROP TABLE IF EXISTS auth_rule;
-- -------------------------------------------
-- -------------------------------------------
DROP TABLE IF EXISTS migration;
-- -------------------------------------------
-- -------------------------------------------
DROP TABLE IF EXISTS tbl_audit;
-- -------------------------------------------
-- -------------------------------------------
DROP TABLE IF EXISTS tbl_cart;
-- -------------------------------------------
-- -------------------------------------------
DROP TABLE IF EXISTS tbl_cashbook;
-- -------------------------------------------
-- -------------------------------------------
DROP TABLE IF EXISTS tbl_category;
-- -------------------------------------------
-- -------------------------------------------
DROP TABLE IF EXISTS tbl_inventory;
-- -------------------------------------------
-- -------------------------------------------
DROP TABLE IF EXISTS tbl_language;
-- -------------------------------------------
-- -------------------------------------------
DROP TABLE IF EXISTS tbl_payment_method;
-- -------------------------------------------
-- -------------------------------------------
DROP TABLE IF EXISTS tbl_price_maintanance;
-- -------------------------------------------
-- -------------------------------------------
DROP TABLE IF EXISTS tbl_product;
-- -------------------------------------------
-- -------------------------------------------
DROP TABLE IF EXISTS tbl_product_attribute;
-- -------------------------------------------
-- -------------------------------------------
DROP TABLE IF EXISTS tbl_product_return;
-- -------------------------------------------
-- -------------------------------------------
DROP TABLE IF EXISTS tbl_purchase;
-- -------------------------------------------
-- -------------------------------------------
DROP TABLE IF EXISTS tbl_purchase_cost;
-- -------------------------------------------
-- -------------------------------------------
DROP TABLE IF EXISTS tbl_purchase_invoice;
-- -------------------------------------------
-- -------------------------------------------
DROP TABLE IF EXISTS tbl_purchase_master;
-- -------------------------------------------
-- -------------------------------------------
DROP TABLE IF EXISTS tbl_report;
-- -------------------------------------------
-- -------------------------------------------
DROP TABLE IF EXISTS tbl_sales;
-- -------------------------------------------
-- -------------------------------------------
DROP TABLE IF EXISTS tbl_sales_item;
-- -------------------------------------------
-- -------------------------------------------
DROP TABLE IF EXISTS tbl_stock_adjustment;
-- -------------------------------------------
-- -------------------------------------------
DROP TABLE IF EXISTS tbl_supplier;
-- -------------------------------------------
-- -------------------------------------------
DROP TABLE IF EXISTS tbl_system_module;
-- -------------------------------------------
-- -------------------------------------------
DROP TABLE IF EXISTS tbl_system_setup;
-- -------------------------------------------
-- -------------------------------------------
DROP TABLE IF EXISTS tbl_transaction;
-- -------------------------------------------
-- -------------------------------------------
DROP TABLE IF EXISTS user;
-- -------------------------------------------
-- -------------------------------------------
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
COMMIT;
-- -------------------------------------------
-- -------------------------------------------
-- END BACKUP
-- -------------------------------------------
