/*
  Warnings:

  - Made the column `qty` on table `shipment` required. This step will fail if there are existing NULL values in that column.

*/
-- AlterTable
ALTER TABLE `shipment` MODIFY `qty` VARCHAR(191) NOT NULL;
