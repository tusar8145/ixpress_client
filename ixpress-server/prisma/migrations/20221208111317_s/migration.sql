/*
  Warnings:

  - A unique constraint covering the columns `[phone]` on the table `services_clients_general` will be added. If there are existing duplicate values, this will fail.

*/
-- CreateIndex
CREATE UNIQUE INDEX `services_clients_general_phone_key` ON `services_clients_general`(`phone`);
