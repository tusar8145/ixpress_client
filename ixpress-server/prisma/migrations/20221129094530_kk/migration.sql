/*
  Warnings:

  - You are about to drop the column `op_payment_type` on the `shipment` table. All the data in the column will be lost.
  - You are about to drop the column `op_priority` on the `shipment` table. All the data in the column will be lost.

*/
-- AlterTable
ALTER TABLE `shipment` DROP COLUMN `op_payment_type`,
    DROP COLUMN `op_priority`,
    ADD COLUMN `current_branch` VARCHAR(191) NULL,
    ADD COLUMN `i_payment_type_id` VARCHAR(191) NULL,
    ADD COLUMN `i_priority_id` VARCHAR(191) NULL,
    ADD COLUMN `re_tracking_code` VARCHAR(191) NULL,
    ADD COLUMN `recived_by` VARCHAR(191) NULL;
