/*
  Warnings:

  - You are about to drop the column `i_sms_template` on the `cost_addi_sms` table. All the data in the column will be lost.

*/
-- AlterTable
ALTER TABLE `cost_addi_sms` DROP COLUMN `i_sms_template`,
    ADD COLUMN `i_sms_template_id` VARCHAR(191) NULL;
