-- CreateTable
CREATE TABLE `services_clients_general` (
    `services_clients_general_id` INTEGER NOT NULL AUTO_INCREMENT,
    `services_clients_general` VARCHAR(120) NOT NULL DEFAULT '',
    `phone` VARCHAR(191) NOT NULL,
    `is_active` INTEGER NULL DEFAULT 1,
    `created` VARCHAR(40) NULL,
    `modified` VARCHAR(40) NULL,
    `creator` INTEGER NULL,
    `modifier` INTEGER NULL,

    PRIMARY KEY (`services_clients_general_id`)
) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- CreateTable
CREATE TABLE `services_clients_general_address` (
    `services_clients_general_id` INTEGER NULL,
    `services_clients_general_address_id` INTEGER NOT NULL AUTO_INCREMENT,
    `services_clients_general_address` VARCHAR(120) NOT NULL DEFAULT '',
    `zone_districts_id` VARCHAR(10) NULL,
    `zone_divisions_id` VARCHAR(10) NULL,
    `zone_upazilas_id` VARCHAR(10) NULL,
    `zone_countries_id` INTEGER NULL,
    `is_active` INTEGER NULL DEFAULT 1,
    `is_pickup` INTEGER NULL DEFAULT 1,
    `is_destination` INTEGER NULL DEFAULT 1,
    `created` VARCHAR(40) NULL,
    `modified` VARCHAR(40) NULL,
    `creator` INTEGER NULL,
    `modifier` INTEGER NULL,

    PRIMARY KEY (`services_clients_general_address_id`)
) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
