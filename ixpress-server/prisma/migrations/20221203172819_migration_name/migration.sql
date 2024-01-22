/*
  Warnings:

  - You are about to alter the column `position` on the `tbl_users_submenu` table. The data in that column could be lost. The data in that column will be cast from `VarChar(250)` to `Int`.

*/
-- AlterTable
ALTER TABLE `tbl_users_submenu` MODIFY `position` INTEGER NULL;
