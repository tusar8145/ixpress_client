/*
  Warnings:

  - You are about to drop the `i_sms_template_enable` table. If the table is not empty, all the data it contains will be lost.
  - You are about to drop the `services_packages` table. If the table is not empty, all the data it contains will be lost.

*/
-- AlterTable
ALTER TABLE `services_clients` ADD COLUMN `discount_percent` DOUBLE NULL;

-- DropTable
DROP TABLE `i_sms_template_enable`;

-- DropTable
DROP TABLE `services_packages`;
