/*
  Warnings:

  - You are about to drop the column `gateway` on the `shipment` table. All the data in the column will be lost.
  - You are about to drop the column `priority` on the `shipment` table. All the data in the column will be lost.
  - You are about to drop the column `services_clients` on the `shipment` table. All the data in the column will be lost.
  - You are about to drop the column `sms_send` on the `shipment` table. All the data in the column will be lost.
  - You are about to drop the column `track_status` on the `shipment` table. All the data in the column will be lost.
  - You are about to drop the column `tracking` on the `shipment` table. All the data in the column will be lost.

*/
-- AlterTable
ALTER TABLE `shipment` DROP COLUMN `gateway`,
    DROP COLUMN `priority`,
    DROP COLUMN `services_clients`,
    DROP COLUMN `sms_send`,
    DROP COLUMN `track_status`,
    DROP COLUMN `tracking`,
    ADD COLUMN `i_document_type_id` INTEGER NULL,
    ADD COLUMN `i_return_cause_id` INTEGER NULL,
    ADD COLUMN `i_sms_template_id` INTEGER NULL,
    ADD COLUMN `i_tracking_status_history` LONGTEXT NULL,
    ADD COLUMN `i_tracking_status_id` INTEGER NULL,
    ADD COLUMN `is_sms_send` VARCHAR(191) NULL,
    ADD COLUMN `is_track_web` VARCHAR(191) NULL,
    ADD COLUMN `op_payment_type` VARCHAR(191) NULL,
    ADD COLUMN `op_priority` VARCHAR(191) NULL,
    ADD COLUMN `services_clients_id` INTEGER NULL;
