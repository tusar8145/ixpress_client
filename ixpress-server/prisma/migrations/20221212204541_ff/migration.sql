/*
  Warnings:

  - Made the column `services_id` on table `services_clients` required. This step will fail if there are existing NULL values in that column.

*/
-- AlterTable
ALTER TABLE `services_clients` MODIFY `services_id` VARCHAR(255) NOT NULL DEFAULT ' ';
