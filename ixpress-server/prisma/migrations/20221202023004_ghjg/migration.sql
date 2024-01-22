/*
  Warnings:

  - You are about to drop the column `i_packaging_type` on the `shipment` table. All the data in the column will be lost.
  - You are about to drop the column `i_shipment_method` on the `shipment` table. All the data in the column will be lost.
  - You are about to drop the column `is_sms_send` on the `shipment` table. All the data in the column will be lost.
  - You are about to alter the column `qty` on the `shipment` table. The data in that column could be lost. The data in that column will be cast from `VarChar(191)` to `Int`.
  - You are about to alter the column `weight` on the `shipment` table. The data in that column could be lost. The data in that column will be cast from `VarChar(191)` to `Int`.
  - You are about to alter the column `current_branch` on the `shipment` table. The data in that column could be lost. The data in that column will be cast from `VarChar(191)` to `Int`.
  - You are about to alter the column `i_payment_type_id` on the `shipment` table. The data in that column could be lost. The data in that column will be cast from `VarChar(191)` to `Int`.
  - You are about to alter the column `i_priority_id` on the `shipment` table. The data in that column could be lost. The data in that column will be cast from `VarChar(191)` to `Int`.
  - You are about to alter the column `overwriting_cost` on the `shipment` table. The data in that column could be lost. The data in that column will be cast from `VarChar(191)` to `Int`.
  - You are about to alter the column `total_cost` on the `shipment` table. The data in that column could be lost. The data in that column will be cast from `VarChar(191)` to `Int`.

*/
-- AlterTable
ALTER TABLE `shipment` DROP COLUMN `i_packaging_type`,
    DROP COLUMN `i_shipment_method`,
    DROP COLUMN `is_sms_send`,
    ADD COLUMN `i_delivery_status_history` MEDIUMTEXT NULL,
    ADD COLUMN `i_delivery_status_id` INTEGER NULL,
    ADD COLUMN `i_packaging_type_id` INTEGER NULL,
    ADD COLUMN `i_shipment_method_id` INTEGER NULL,
    ADD COLUMN `i_unit_id` INTEGER NULL,
    MODIFY `qty` INTEGER NULL,
    MODIFY `weight` INTEGER NULL,
    MODIFY `i_tracking_status_history` MEDIUMTEXT NULL,
    MODIFY `current_branch` INTEGER NULL,
    MODIFY `i_payment_type_id` INTEGER NULL,
    MODIFY `i_priority_id` INTEGER NULL,
    MODIFY `overwriting_cost` INTEGER NULL,
    MODIFY `total_cost` INTEGER NULL;

-- CreateTable
CREATE TABLE `i_delivery_status` (
    `i_delivery_status_id` INTEGER NOT NULL AUTO_INCREMENT,
    `i_delivery_status` VARCHAR(255) NULL,
    `position` INTEGER NULL,
    `is_active` INTEGER NULL DEFAULT 1,
    `created` VARCHAR(40) NULL,
    `modified` VARCHAR(40) NULL,
    `creator` INTEGER NULL,
    `modifier` INTEGER NULL,

    PRIMARY KEY (`i_delivery_status_id`)
) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
