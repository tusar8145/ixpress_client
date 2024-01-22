/*
  Warnings:

  - You are about to drop the `tbl_users_userStatus` table. If the table is not empty, all the data it contains will be lost.
  - A unique constraint covering the columns `[services_packages]` on the table `services_packages` will be added. If there are existing duplicate values, this will fail.

*/
-- DropTable
DROP TABLE `tbl_users_userStatus`;

-- CreateIndex
CREATE UNIQUE INDEX `services_packages_services_packages_key` ON `services_packages`(`services_packages`);
