-- CreateTable
CREATE TABLE `services_packages` (
    `services_packages_id` INTEGER NOT NULL AUTO_INCREMENT,
    `services_packages` VARCHAR(191) NULL,
    `activate_date` VARCHAR(191) NULL,
    `expired_date` VARCHAR(191) NULL,
    `is_active` INTEGER NULL DEFAULT 1,
    `created` VARCHAR(40) NULL,
    `modified` VARCHAR(40) NULL,
    `creator` INTEGER NULL,
    `modifier` INTEGER NULL,

    PRIMARY KEY (`services_packages_id`)
) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
