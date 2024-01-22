-- AlterTable
ALTER TABLE `pickup` ADD COLUMN `cod_cost_percent` INTEGER NULL DEFAULT 0,
    ADD COLUMN `collection_amount` INTEGER NULL DEFAULT 0,
    ADD COLUMN `delivery_cost_amount` INTEGER NULL DEFAULT 0,
    ADD COLUMN `return_cost_amount` INTEGER NULL DEFAULT 0;
