-- AlterTable
ALTER TABLE `pickup_tracking` ADD COLUMN `created` VARCHAR(191) NULL,
    ADD COLUMN `creator` VARCHAR(191) NULL,
    ADD COLUMN `delivery_status` VARCHAR(191) NULL,
    ADD COLUMN `tracking_status` VARCHAR(191) NULL,
    MODIFY `time` VARCHAR(191) NULL,
    MODIFY `note` VARCHAR(191) NULL;
