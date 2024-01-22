/*
  Warnings:

  - You are about to drop the `cost_addi_sms` table. If the table is not empty, all the data it contains will be lost.

*/
-- DropTable
DROP TABLE `cost_addi_sms`;

-- CreateTable
CREATE TABLE `i_sms_template_enable` (
    `i_sms_template_enable_id` INTEGER NOT NULL AUTO_INCREMENT,
    `i_sms_template_enable` VARCHAR(255) NULL,
    `position` INTEGER NULL,
    `is_active` INTEGER NULL DEFAULT 1,
    `services_id` VARCHAR(191) NULL,
    `services_clients_id` VARCHAR(191) NULL,
    `i_sms_template_id` VARCHAR(191) NULL,
    `created` VARCHAR(40) NULL,
    `modified` VARCHAR(40) NULL,
    `creator` INTEGER NULL,
    `modifier` INTEGER NULL,

    PRIMARY KEY (`i_sms_template_enable_id`)
) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
