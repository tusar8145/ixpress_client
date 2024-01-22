/*
  Warnings:

  - You are about to drop the `services_packages_config` table. If the table is not empty, all the data it contains will be lost.

*/
-- DropTable
DROP TABLE `services_packages_config`;

-- CreateTable
CREATE TABLE `services_packages_cost_config` (
    `services_packages_cost_config_id` INTEGER NOT NULL AUTO_INCREMENT,
    `services_packages_id` VARCHAR(191) NULL,
    `i_zone_id` VARCHAR(191) NULL,
    `i_shipment_method_id` VARCHAR(191) NULL,
    `i_priority_id` VARCHAR(191) NULL,
    `first_kg` DOUBLE NULL,
    `additional_kg` DOUBLE NULL,
    `is_active` INTEGER NULL DEFAULT 1,
    `created` VARCHAR(40) NULL,
    `modified` VARCHAR(40) NULL,
    `creator` INTEGER NULL,
    `modifier` INTEGER NULL,

    PRIMARY KEY (`services_packages_cost_config_id`)
) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
