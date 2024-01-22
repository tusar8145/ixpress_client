-- AlterTable
ALTER TABLE `tbl_users_userType` ADD COLUMN `is_all_branch` VARCHAR(2) NULL DEFAULT '0',
    ADD COLUMN `is_delivery_boy` VARCHAR(2) NULL DEFAULT '0',
    ADD COLUMN `is_marchant` VARCHAR(2) NULL DEFAULT '0',
    ADD COLUMN `is_pickup` VARCHAR(2) NULL DEFAULT '0',
    ADD COLUMN `is_quick_status` VARCHAR(2) NULL DEFAULT '0',
    ADD COLUMN `is_scan_pod` VARCHAR(2) NULL DEFAULT '0',
    ADD COLUMN `is_update_status` VARCHAR(2) NULL DEFAULT '0';
