-- AlterTable
ALTER TABLE `services_clients` ADD COLUMN `i_product_type_id` VARCHAR(450) NULL,
    ADD COLUMN `i_sms_template_id` VARCHAR(100) NULL,
    ADD COLUMN `services_provider_id` VARCHAR(100) NULL;
