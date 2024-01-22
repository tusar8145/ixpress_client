-- CreateTable
CREATE TABLE `i_package_type` (
    `i_package_type_id` INTEGER NOT NULL AUTO_INCREMENT,
    `i_package_type` VARCHAR(255) NULL,
    `position` INTEGER NULL,
    `is_active` INTEGER NULL DEFAULT 1,
    `created` VARCHAR(40) NULL,
    `modified` VARCHAR(40) NULL,
    `creator` INTEGER NULL,
    `modifier` INTEGER NULL,

    PRIMARY KEY (`i_package_type_id`)
) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- CreateTable
CREATE TABLE `i_shipment_method` (
    `i_shipment_method_id` INTEGER NOT NULL AUTO_INCREMENT,
    `i_shipment_method` VARCHAR(255) NULL,
    `position` INTEGER NULL,
    `is_active` INTEGER NULL DEFAULT 1,
    `created` VARCHAR(40) NULL,
    `modified` VARCHAR(40) NULL,
    `creator` INTEGER NULL,
    `modifier` INTEGER NULL,

    PRIMARY KEY (`i_shipment_method_id`)
) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
