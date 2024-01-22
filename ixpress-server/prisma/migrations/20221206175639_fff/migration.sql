/*
  Warnings:

  - You are about to drop the column `i_vendor_id` on the `shipment` table. All the data in the column will be lost.
  - You are about to drop the `i_vendor` table. If the table is not empty, all the data it contains will be lost.

*/
-- AlterTable
ALTER TABLE `shipment` DROP COLUMN `i_vendor_id`,
    ADD COLUMN `branch_id` INTEGER NULL;

-- DropTable
DROP TABLE `i_vendor`;

-- CreateTable
CREATE TABLE `branch` (
    `branch_id` INTEGER NOT NULL AUTO_INCREMENT,
    `branch` VARCHAR(200) NULL,
    `logo` VARCHAR(150) NULL,
    `branch_code` VARCHAR(20) NULL,
    `web` VARCHAR(150) NULL,
    `address` VARCHAR(200) NULL,
    `location` VARCHAR(255) NULL,
    `phone` VARCHAR(200) NULL,
    `fax` VARCHAR(20) NULL,
    `email` VARCHAR(100) NULL,
    `officedays` TINYTEXT NULL,
    `office_stime` TINYTEXT NULL,
    `office_etime` TINYTEXT NULL,
    `cl` DECIMAL(2, 0) NULL,
    `sl` DECIMAL(2, 0) NULL,
    `published` ENUM('Yes', 'No') NULL,
    `position` INTEGER NULL,
    `is_active` INTEGER NULL DEFAULT 1,
    `created` VARCHAR(40) NULL,
    `modified` VARCHAR(40) NULL,
    `creator` INTEGER NULL,
    `modifier` INTEGER NULL,

    PRIMARY KEY (`branch_id`)
) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
