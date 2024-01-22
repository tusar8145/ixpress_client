/*
  Warnings:

  - You are about to drop the column `log2` on the `activitylog` table. All the data in the column will be lost.

*/
-- AlterTable
ALTER TABLE `activitylog` DROP COLUMN `log2`;

-- CreateTable
CREATE TABLE `shipment` (
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `services_clients_id` INTEGER NULL,
    `pickup_date` VARCHAR(100) NULL,

    PRIMARY KEY (`id`)
) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
