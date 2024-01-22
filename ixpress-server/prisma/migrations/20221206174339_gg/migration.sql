/*
  Warnings:

  - You are about to drop the column `i_zone_id` on the `services_packages_cost_config` table. All the data in the column will be lost.
  - You are about to drop the column `i_zone_id` on the `shipment` table. All the data in the column will be lost.
  - You are about to drop the `i_zone` table. If the table is not empty, all the data it contains will be lost.

*/
-- AlterTable
ALTER TABLE `services_packages_cost_config` DROP COLUMN `i_zone_id`,
    ADD COLUMN `zone_id` VARCHAR(191) NULL;

-- AlterTable
ALTER TABLE `shipment` DROP COLUMN `i_zone_id`,
    ADD COLUMN `zone_id` INTEGER NULL;

-- DropTable
DROP TABLE `i_zone`;

-- CreateTable
CREATE TABLE `zone` (
    `zone_id` INTEGER NOT NULL AUTO_INCREMENT,
    `zone` VARCHAR(255) NULL,
    `position` INTEGER NULL,
    `is_active` INTEGER NULL DEFAULT 1,
    `created` VARCHAR(40) NULL,
    `modified` VARCHAR(40) NULL,
    `creator` INTEGER NULL,
    `modifier` INTEGER NULL,

    PRIMARY KEY (`zone_id`)
) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
