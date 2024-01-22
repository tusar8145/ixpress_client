/*
  Warnings:

  - You are about to drop the `i_countries` table. If the table is not empty, all the data it contains will be lost.

*/
-- DropTable
DROP TABLE `i_countries`;

-- CreateTable
CREATE TABLE `zone_countries` (
    `zone_countries_id` INTEGER NOT NULL AUTO_INCREMENT,
    `A2` VARCHAR(100) NULL,
    `A3` VARCHAR(100) NULL,
    `NUM` VARCHAR(100) NULL,
    `zone_countries` VARCHAR(111) NULL,
    `position` INTEGER NULL,
    `is_active` INTEGER NULL DEFAULT 1,
    `created` VARCHAR(40) NULL,
    `modified` VARCHAR(40) NULL,
    `creator` INTEGER NULL,
    `modifier` INTEGER NULL,

    PRIMARY KEY (`zone_countries_id`)
) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
