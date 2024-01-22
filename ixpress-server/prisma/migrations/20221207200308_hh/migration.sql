/*
  Warnings:

  - You are about to drop the column `location` on the `branch` table. All the data in the column will be lost.
  - You are about to alter the column `address` on the `branch` table. The data in that column could be lost. The data in that column will be cast from `VarChar(200)` to `VarChar(191)`.

*/
-- AlterTable
ALTER TABLE `branch` DROP COLUMN `location`,
    ADD COLUMN `zone_countries_id` INTEGER NULL,
    ADD COLUMN `zone_districts_id` INTEGER NULL,
    ADD COLUMN `zone_divisions_id` INTEGER NULL,
    ADD COLUMN `zone_upazilas_id` INTEGER NULL,
    MODIFY `address` VARCHAR(191) NULL;

-- AlterTable
ALTER TABLE `services_clients_branch` ADD COLUMN `address` VARCHAR(191) NULL;
