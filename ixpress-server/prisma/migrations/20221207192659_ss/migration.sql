/*
  Warnings:

  - Added the required column `services_clients_branch` to the `services_clients_branch` table without a default value. This is not possible if the table is not empty.

*/
-- AlterTable
ALTER TABLE `services_clients_branch` ADD COLUMN `services_clients_branch` VARCHAR(191) NOT NULL;
