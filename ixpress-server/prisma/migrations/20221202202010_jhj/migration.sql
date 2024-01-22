-- CreateTable
CREATE TABLE `cost_weight` (
    `cost_weight_id` INTEGER NOT NULL AUTO_INCREMENT,
    `cost_weight` VARCHAR(255) NULL,
    `position` INTEGER NULL,
    `is_active` INTEGER NULL DEFAULT 1,
    `i_zone_id` VARCHAR(191) NULL,
    `i_priority_id` VARCHAR(191) NULL,
    `i_shipment_method` VARCHAR(191) NULL,
    `services_id` VARCHAR(191) NULL,
    `services_clients_id` VARCHAR(191) NULL,
    `first_kg` INTEGER NULL,
    `additional_kg` INTEGER NULL,
    `start_date` VARCHAR(191) NULL,
    `end_date` VARCHAR(191) NULL,
    `created` VARCHAR(40) NULL,
    `modified` VARCHAR(40) NULL,
    `creator` INTEGER NULL,
    `modifier` INTEGER NULL,

    PRIMARY KEY (`cost_weight_id`)
) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- CreateTable
CREATE TABLE `cost_packaging` (
    `cost_packaging_id` INTEGER NOT NULL AUTO_INCREMENT,
    `cost_packaging` VARCHAR(255) NULL,
    `position` INTEGER NULL,
    `is_active` INTEGER NULL DEFAULT 1,
    `i_zone_id` VARCHAR(191) NULL,
    `i_priority_id` VARCHAR(191) NULL,
    `i_shipment_method` VARCHAR(191) NULL,
    `services_id` VARCHAR(191) NULL,
    `services_clients_id` VARCHAR(191) NULL,
    `cost` INTEGER NULL,
    `is_multiply_cost` INTEGER NULL,
    `start_date` VARCHAR(191) NULL,
    `end_date` VARCHAR(191) NULL,
    `created` VARCHAR(40) NULL,
    `modified` VARCHAR(40) NULL,
    `creator` INTEGER NULL,
    `modifier` INTEGER NULL,

    PRIMARY KEY (`cost_packaging_id`)
) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- CreateTable
CREATE TABLE `cost_addi_sms` (
    `cost_addi_sms_id` INTEGER NOT NULL AUTO_INCREMENT,
    `cost_addi_sms` VARCHAR(255) NULL,
    `position` INTEGER NULL,
    `is_active` INTEGER NULL DEFAULT 1,
    `services_id` VARCHAR(191) NULL,
    `services_clients_id` VARCHAR(191) NULL,
    `cost` INTEGER NULL,
    `start_date` VARCHAR(191) NULL,
    `end_date` VARCHAR(191) NULL,
    `created` VARCHAR(40) NULL,
    `modified` VARCHAR(40) NULL,
    `creator` INTEGER NULL,
    `modifier` INTEGER NULL,

    PRIMARY KEY (`cost_addi_sms_id`)
) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- CreateTable
CREATE TABLE `cost_addi_track_web` (
    `cost_addi_track_web_id` INTEGER NOT NULL AUTO_INCREMENT,
    `cost_addi_track_web` VARCHAR(255) NULL,
    `position` INTEGER NULL,
    `is_active` INTEGER NULL DEFAULT 1,
    `services_id` VARCHAR(191) NULL,
    `services_clients_id` VARCHAR(191) NULL,
    `cost` INTEGER NULL,
    `start_date` VARCHAR(191) NULL,
    `end_date` VARCHAR(191) NULL,
    `created` VARCHAR(40) NULL,
    `modified` VARCHAR(40) NULL,
    `creator` INTEGER NULL,
    `modifier` INTEGER NULL,

    PRIMARY KEY (`cost_addi_track_web_id`)
) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- CreateTable
CREATE TABLE `i_zone` (
    `i_zone_id` INTEGER NOT NULL AUTO_INCREMENT,
    `i_zone` VARCHAR(255) NULL,
    `position` INTEGER NULL,
    `is_active` INTEGER NULL DEFAULT 1,
    `created` VARCHAR(40) NULL,
    `modified` VARCHAR(40) NULL,
    `creator` INTEGER NULL,
    `modifier` INTEGER NULL,

    PRIMARY KEY (`i_zone_id`)
) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
