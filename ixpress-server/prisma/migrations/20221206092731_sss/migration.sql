/*
  Warnings:

  - A unique constraint covering the columns `[services_provider,services_provider_code]` on the table `services_provider` will be added. If there are existing duplicate values, this will fail.

*/
-- CreateIndex
CREATE UNIQUE INDEX `services_provider_services_provider_services_provider_code_key` ON `services_provider`(`services_provider`, `services_provider_code`);
