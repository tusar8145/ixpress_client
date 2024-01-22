-- AlterTable
ALTER TABLE `tbl_users_userType` ADD COLUMN `is_billing_app_col` VARCHAR(2) NULL DEFAULT '0',
    ADD COLUMN `is_billing_app_dis` VARCHAR(2) NULL DEFAULT '0',
    ADD COLUMN `is_billing_dis` VARCHAR(2) NULL DEFAULT '0',
    ADD COLUMN `is_dashboard_account` VARCHAR(2) NULL DEFAULT '0',
    ADD COLUMN `is_dashboard_orders` VARCHAR(2) NULL DEFAULT '0',
    ADD COLUMN `is_quick_status_all` VARCHAR(2) NULL DEFAULT '0',
    ADD COLUMN `is_stock_branch` VARCHAR(2) NULL DEFAULT '0',
    ADD COLUMN `is_update_status_payment` VARCHAR(2) NULL DEFAULT '0',
    ADD COLUMN `is_update_status_update` VARCHAR(2) NULL DEFAULT '0';
