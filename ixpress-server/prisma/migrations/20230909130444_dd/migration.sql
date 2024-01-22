-- AlterTable
ALTER TABLE `tbl_users_userType` ADD COLUMN `is_billing` VARCHAR(2) NULL DEFAULT '0',
    ADD COLUMN `is_issue` VARCHAR(2) NULL DEFAULT '0';
