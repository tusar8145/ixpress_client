-- AlterTable
ALTER TABLE `tbl_users_userType` ADD COLUMN `is_all_report_data` VARCHAR(2) NULL DEFAULT '0',
    ADD COLUMN `is_all_report_deli` VARCHAR(2) NULL DEFAULT '0',
    ADD COLUMN `is_all_report_ship` VARCHAR(2) NULL DEFAULT '0';
