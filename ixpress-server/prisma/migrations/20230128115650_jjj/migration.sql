-- AlterTable
ALTER TABLE `pickup_tracking` ADD COLUMN `wallet_from_marchant` INTEGER NULL,
    ADD COLUMN `wallet_to_marchant` INTEGER NULL;

-- AlterTable
ALTER TABLE `services_clients_branch` ADD COLUMN `wallet` INTEGER NULL;

-- CreateTable
CREATE TABLE `wallet_transaction` (
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `transaction_id` VARCHAR(191) NULL,
    `amount` INTEGER NOT NULL,
    `key` VARCHAR(191) NULL,
    `method` VARCHAR(191) NULL,
    `account` VARCHAR(191) NULL,
    `marchant_id` INTEGER NOT NULL,
    `request_date` VARCHAR(191) NULL,
    `created` VARCHAR(191) NULL,
    `creator` INTEGER NOT NULL,
    `approved_by` INTEGER NULL,
    `approved_date` VARCHAR(191) NULL,

    PRIMARY KEY (`id`)
) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
