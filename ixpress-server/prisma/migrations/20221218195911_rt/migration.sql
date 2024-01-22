/*
  Warnings:

  - You are about to drop the column `delivery_status` on the `pickup_tracking` table. All the data in the column will be lost.
  - You are about to drop the column `tracking_status` on the `pickup_tracking` table. All the data in the column will be lost.
  - You are about to drop the column `tracking_type` on the `pickup_tracking` table. All the data in the column will be lost.
  - Added the required column `action_type` to the `pickup_tracking` table without a default value. This is not possible if the table is not empty.

*/
-- AlterTable
ALTER TABLE `pickup_tracking` DROP COLUMN `delivery_status`,
    DROP COLUMN `tracking_status`,
    DROP COLUMN `tracking_type`,
    ADD COLUMN `action_type` VARCHAR(191) NOT NULL,
    ADD COLUMN `i_delivery_status_id_18` VARCHAR(191) NULL,
    ADD COLUMN `i_tracking_status_id_19` VARCHAR(191) NULL;
