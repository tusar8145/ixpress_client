/*
  Warnings:

  - You are about to drop the column `i_countries_id` on the `services_clients` table. All the data in the column will be lost.

*/
-- AlterTable
ALTER TABLE `services_clients` DROP COLUMN `i_countries_id`,
    ADD COLUMN `zone_countries_id` INTEGER NULL;
