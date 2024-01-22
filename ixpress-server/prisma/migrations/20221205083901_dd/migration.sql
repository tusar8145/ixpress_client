/*
  Warnings:

  - You are about to drop the column `services` on the `i_product_type` table. All the data in the column will be lost.

*/
-- AlterTable
ALTER TABLE `i_product_type` DROP COLUMN `services`,
    ADD COLUMN `services_id` VARCHAR(40) NULL;
