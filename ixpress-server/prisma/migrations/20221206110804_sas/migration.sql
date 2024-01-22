/*
  Warnings:

  - You are about to drop the column `cost` on the `cost_packaging` table. All the data in the column will be lost.
  - You are about to drop the column `end_date` on the `cost_packaging` table. All the data in the column will be lost.
  - You are about to drop the column `i_priority_id` on the `cost_packaging` table. All the data in the column will be lost.
  - You are about to drop the column `i_shipment_method_id` on the `cost_packaging` table. All the data in the column will be lost.
  - You are about to drop the column `i_zone_id` on the `cost_packaging` table. All the data in the column will be lost.
  - You are about to drop the column `is_active` on the `cost_packaging` table. All the data in the column will be lost.
  - You are about to drop the column `services_clients_id` on the `cost_packaging` table. All the data in the column will be lost.
  - You are about to drop the column `services_id` on the `cost_packaging` table. All the data in the column will be lost.
  - You are about to drop the column `start_date` on the `cost_packaging` table. All the data in the column will be lost.

*/
-- AlterTable
ALTER TABLE `cost_packaging` DROP COLUMN `cost`,
    DROP COLUMN `end_date`,
    DROP COLUMN `i_priority_id`,
    DROP COLUMN `i_shipment_method_id`,
    DROP COLUMN `i_zone_id`,
    DROP COLUMN `is_active`,
    DROP COLUMN `services_clients_id`,
    DROP COLUMN `services_id`,
    DROP COLUMN `start_date`,
    ADD COLUMN `weight` DOUBLE NULL;
