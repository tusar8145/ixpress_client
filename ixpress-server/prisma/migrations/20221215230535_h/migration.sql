/*
  Warnings:

  - You are about to drop the column `creator_branch` on the `pickup` table. All the data in the column will be lost.
  - You are about to drop the column `current_branch` on the `pickup` table. All the data in the column will be lost.

*/
-- AlterTable
ALTER TABLE `pickup` DROP COLUMN `creator_branch`,
    DROP COLUMN `current_branch`,
    ADD COLUMN `created_branch_id` INTEGER NULL,
    ADD COLUMN `current_branch_id` INTEGER NULL;

-- AddForeignKey
ALTER TABLE `branch` ADD CONSTRAINT `branch_parent_branch_fkey` FOREIGN KEY (`parent_branch`) REFERENCES `branch`(`branch_id`) ON DELETE SET NULL ON UPDATE CASCADE;
