-- AlterTable
ALTER TABLE `pickup_tracking` ADD COLUMN `pickup_reference_id` INTEGER NULL;

-- CreateTable
CREATE TABLE `pickup_reference` (
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `pickup_reference` VARCHAR(191) NOT NULL,
    `creator` VARCHAR(191) NULL,
    `created` VARCHAR(191) NULL,
    `branch_id` INTEGER NOT NULL,

    PRIMARY KEY (`id`)
) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
