/*
  Warnings:

  - You are about to drop the `Profile` table. If the table is not empty, all the data it contains will be lost.
  - You are about to drop the `User` table. If the table is not empty, all the data it contains will be lost.
  - A unique constraint covering the columns `[branch_id]` on the table `tbl_users` will be added. If there are existing duplicate values, this will fail.
  - Made the column `branch_id` on table `tbl_users` required. This step will fail if there are existing NULL values in that column.

*/
-- DropForeignKey
ALTER TABLE `Profile` DROP FOREIGN KEY `Profile_userId_fkey`;

-- AlterTable
ALTER TABLE `tbl_users` MODIFY `branch_id` INTEGER NOT NULL;

-- DropTable
DROP TABLE `Profile`;

-- DropTable
DROP TABLE `User`;

-- CreateIndex
CREATE UNIQUE INDEX `tbl_users_branch_id_key` ON `tbl_users`(`branch_id`);

-- AddForeignKey
ALTER TABLE `tbl_users` ADD CONSTRAINT `tbl_users_branch_id_fkey` FOREIGN KEY (`branch_id`) REFERENCES `branch`(`branch_id`) ON DELETE RESTRICT ON UPDATE CASCADE;
