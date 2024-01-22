-- DropIndex
DROP INDEX `tbl_users_branch_id_fkey` ON `tbl_users`;

-- AlterTable
ALTER TABLE `services_clients_branch` ADD COLUMN `userID` INTEGER NULL;
