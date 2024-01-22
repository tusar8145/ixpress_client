/*
  Warnings:

  - You are about to alter the column `creator` on the `pickup_tracking` table. The data in that column could be lost. The data in that column will be cast from `VarChar(191)` to `Int`.
  - You are about to alter the column `i_delivery_status_id_18` on the `pickup_tracking` table. The data in that column could be lost. The data in that column will be cast from `VarChar(191)` to `Int`.
  - You are about to alter the column `i_tracking_status_id_19` on the `pickup_tracking` table. The data in that column could be lost. The data in that column will be cast from `VarChar(191)` to `Int`.

*/
-- AlterTable
ALTER TABLE `pickup_tracking` MODIFY `creator` INTEGER NULL,
    MODIFY `pickup_reference_id` VARCHAR(191) NULL,
    MODIFY `i_delivery_status_id_18` INTEGER NOT NULL,
    MODIFY `i_tracking_status_id_19` INTEGER NOT NULL;
