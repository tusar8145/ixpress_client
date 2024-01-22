/*
  Warnings:

  - A unique constraint covering the columns `[userEmail]` on the table `tbl_users` will be added. If there are existing duplicate values, this will fail.
  - Made the column `userEmail` on table `tbl_users` required. This step will fail if there are existing NULL values in that column.

*/
-- AlterTable
ALTER TABLE `branch` ADD COLUMN `name` VARCHAR(191) NULL;

-- AlterTable
ALTER TABLE `tbl_users` MODIFY `userEmail` VARCHAR(255) NOT NULL;

-- CreateIndex
CREATE UNIQUE INDEX `user_email` ON `tbl_users`(`userEmail`);
