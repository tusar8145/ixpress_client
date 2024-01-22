/*
  Warnings:

  - Made the column `branch_id` on table `tbl_users` required. This step will fail if there are existing NULL values in that column.

*/
-- DropForeignKey
ALTER TABLE `tbl_users` DROP FOREIGN KEY `tbl_users_branch_id_fkey`;

-- AlterTable
ALTER TABLE `tbl_users` MODIFY `branch_id` INTEGER NOT NULL;

-- AddForeignKey
ALTER TABLE `tbl_users` ADD CONSTRAINT `tbl_users_branch_id_fkey` FOREIGN KEY (`branch_id`) REFERENCES `branch`(`branch_id`) ON DELETE RESTRICT ON UPDATE CASCADE;
