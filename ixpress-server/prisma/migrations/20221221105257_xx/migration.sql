/*
  Warnings:

  - You are about to alter the column `creator` on the `tbl_users_token` table. The data in that column could be lost. The data in that column will be cast from `VarChar(191)` to `Int`.

*/
-- AlterTable
ALTER TABLE `tbl_users_token` MODIFY `creator` INTEGER NOT NULL;
