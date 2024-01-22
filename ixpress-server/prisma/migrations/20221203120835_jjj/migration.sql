/*
  Warnings:

  - You are about to drop the column `i_shipment_method` on the `cost_packaging` table. All the data in the column will be lost.
  - You are about to drop the column `i_shipment_method` on the `cost_weight` table. All the data in the column will be lost.

*/
-- AlterTable
ALTER TABLE `cost_packaging` DROP COLUMN `i_shipment_method`,
    ADD COLUMN `i_shipment_method_id` VARCHAR(191) NULL;

-- AlterTable
ALTER TABLE `cost_weight` DROP COLUMN `i_shipment_method`,
    ADD COLUMN `i_shipment_method_id` VARCHAR(191) NULL;
