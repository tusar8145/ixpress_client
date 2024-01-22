-- DropForeignKey
ALTER TABLE `tbl_users` DROP FOREIGN KEY `tbl_users_branch_id_fkey`;

-- AlterTable
ALTER TABLE `tbl_users` MODIFY `branch_id` INTEGER NULL;

-- AddForeignKey
ALTER TABLE `tbl_users` ADD CONSTRAINT `tbl_users_branch_id_fkey` FOREIGN KEY (`branch_id`) REFERENCES `branch`(`branch_id`) ON DELETE SET NULL ON UPDATE CASCADE;
