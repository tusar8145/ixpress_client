-- AlterTable
ALTER TABLE `zone_divisions` ADD COLUMN `zone_countries_id` INTEGER NULL;

-- CreateTable
CREATE TABLE `services_clients_branch` (
    `services_clients_branch_id` INTEGER NOT NULL AUTO_INCREMENT,
    `services_clients_id` INTEGER NULL,
    `services_clients` VARCHAR(120) NOT NULL DEFAULT '',
    `zone_countries_id` INTEGER NULL,
    `zone_districts_id` INTEGER NULL,
    `zone_divisions_id` INTEGER NULL,
    `zone_upazilas_id` INTEGER NULL,
    `is_active` INTEGER NULL DEFAULT 1,
    `created` VARCHAR(40) NULL,
    `modified` VARCHAR(40) NULL,
    `creator` INTEGER NULL,
    `modifier` INTEGER NULL,

    PRIMARY KEY (`services_clients_branch_id`)
) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
