-- DropForeignKey
ALTER TABLE `tbl_users` DROP FOREIGN KEY `tbl_users_branch_id_fkey`;

-- AlterTable
ALTER TABLE `tbl_users` MODIFY `branch_id` INTEGER NULL;
