/*
  Warnings:

  - You are about to drop the column `others_charge` on the `shipment` table. All the data in the column will be lost.
  - You are about to drop the column `price` on the `shipment` table. All the data in the column will be lost.
  - You are about to drop the column `rate` on the `shipment` table. All the data in the column will be lost.
  - You are about to drop the column `service_charge` on the `shipment` table. All the data in the column will be lost.

*/
-- AlterTable
ALTER TABLE `shipment` DROP COLUMN `others_charge`,
    DROP COLUMN `price`,
    DROP COLUMN `rate`,
    DROP COLUMN `service_charge`,
    ADD COLUMN `overwriting_cost` VARCHAR(191) NULL,
    ADD COLUMN `total_cost` VARCHAR(191) NULL;
