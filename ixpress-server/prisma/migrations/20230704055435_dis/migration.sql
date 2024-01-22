-- AlterTable
ALTER TABLE `wallet_transaction` ADD COLUMN `disbursed_trx` VARCHAR(191) NULL,
    ADD COLUMN `invoices` VARCHAR(191) NULL,
    ADD COLUMN `is_disbursed` INTEGER NULL DEFAULT 0;
