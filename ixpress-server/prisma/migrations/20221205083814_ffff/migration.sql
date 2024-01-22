-- CreateTable
CREATE TABLE `i_product_type` (
    `i_product_type_id` INTEGER NOT NULL AUTO_INCREMENT,
    `i_product_type` VARCHAR(255) NULL,
    `services` VARCHAR(40) NULL,
    `is_active` INTEGER NULL DEFAULT 1,
    `created` VARCHAR(40) NULL,
    `modified` VARCHAR(40) NULL,
    `creator` INTEGER NULL,
    `modifier` INTEGER NULL,

    PRIMARY KEY (`i_product_type_id`)
) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
