/*
  Warnings:

  - Made the column `branch_id` on table `tbl_users` required. This step will fail if there are existing NULL values in that column.

*/
-- AlterTable
ALTER TABLE `tbl_users` MODIFY `branch_id` INTEGER NOT NULL;
