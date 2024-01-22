/*
  Warnings:

  - You are about to drop the column `i_package_type` on the `shipment` table. All the data in the column will be lost.
  - You are about to drop the `i_package_type` table. If the table is not empty, all the data it contains will be lost.

*/
-- AlterTable
ALTER TABLE `shipment` DROP COLUMN `i_package_type`,
    ADD COLUMN `i_packaging_type` VARCHAR(191) NULL;

-- DropTable
DROP TABLE `i_package_type`;

-- CreateTable
CREATE TABLE `i_packaging_type` (
    `i_packaging_type_id` INTEGER NOT NULL AUTO_INCREMENT,
    `i_packaging_type` VARCHAR(255) NULL,
    `position` INTEGER NULL,
    `is_active` INTEGER NULL DEFAULT 1,
    `created` VARCHAR(40) NULL,
    `modified` VARCHAR(40) NULL,
    `creator` INTEGER NULL,
    `modifier` INTEGER NULL,

    PRIMARY KEY (`i_packaging_type_id`)
) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
