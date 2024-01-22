/*
  Warnings:

  - You are about to drop the column `services_payment_policy_list` on the `services_packages` table. All the data in the column will be lost.
  - You are about to drop the column `services_payment_policy_list` on the `services_packages_config` table. All the data in the column will be lost.
  - You are about to drop the `services_activate` table. If the table is not empty, all the data it contains will be lost.
  - You are about to drop the `services_payment_policy` table. If the table is not empty, all the data it contains will be lost.

*/
-- AlterTable
ALTER TABLE `services_packages` DROP COLUMN `services_payment_policy_list`;

-- AlterTable
ALTER TABLE `services_packages_config` DROP COLUMN `services_payment_policy_list`;

-- DropTable
DROP TABLE `services_activate`;

-- DropTable
DROP TABLE `services_payment_policy`;
