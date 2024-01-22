-- AlterTable
ALTER TABLE `services_packages` ADD COLUMN `services_id` VARCHAR(191) NULL,
    MODIFY `services_clients_id` VARCHAR(420) NOT NULL DEFAULT '';
