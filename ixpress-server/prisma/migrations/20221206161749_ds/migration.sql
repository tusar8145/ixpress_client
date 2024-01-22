/*
  Warnings:

  - You are about to drop the column `services_id` on the `i_sms_template_enable` table. All the data in the column will be lost.

*/
-- AlterTable
ALTER TABLE `i_sms_template_enable` DROP COLUMN `services_id`,
    ADD COLUMN `i_product_type_id` VARCHAR(191) NULL;
