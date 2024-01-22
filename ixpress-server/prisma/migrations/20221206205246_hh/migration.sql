-- AlterTable
ALTER TABLE `services_clients` ADD COLUMN `services_packages_id` VARCHAR(100) NULL;

-- AlterTable
ALTER TABLE `services_packages_cost_config` ADD COLUMN `fixed_cost` DOUBLE NULL,
    ADD COLUMN `services_id` VARCHAR(191) NULL;
