-- CreateTable
CREATE TABLE `services_packages` (
    `services_packages_id` INTEGER NOT NULL AUTO_INCREMENT,
    `services_packages` VARCHAR(191) NULL,
    `services_provider_id` VARCHAR(191) NULL,
    `services_clients_id` VARCHAR(120) NOT NULL DEFAULT '',
    `activate_date` VARCHAR(100) NULL,
    `agreement_id` VARCHAR(100) NULL,
    `expired_date` VARCHAR(500) NULL,
    `position` INTEGER NULL,
    `is_active` INTEGER NULL DEFAULT 1,
    `created` VARCHAR(40) NULL,
    `modified` VARCHAR(40) NULL,
    `creator` INTEGER NULL,
    `modifier` INTEGER NULL,
    `services_payment_policy_list` VARCHAR(500) NULL,

    PRIMARY KEY (`services_packages_id`)
) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- CreateTable
CREATE TABLE `services_packages_config` (
    `services_packages_config_id` INTEGER NOT NULL AUTO_INCREMENT,
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
    `services_payment_policy_list` VARCHAR(500) NULL,

    PRIMARY KEY (`services_packages_config_id`)
) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
