/*
  Warnings:

  - Made the column `i_delivery_status_id_18` on table `pickup_tracking` required. This step will fail if there are existing NULL values in that column.
  - Made the column `i_tracking_status_id_19` on table `pickup_tracking` required. This step will fail if there are existing NULL values in that column.

*/
-- AlterTable
ALTER TABLE `pickup_tracking` MODIFY `i_delivery_status_id_18` VARCHAR(191) NOT NULL,
    MODIFY `i_tracking_status_id_19` VARCHAR(191) NOT NULL;
