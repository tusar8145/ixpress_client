/*
  Warnings:

  - You are about to drop the column `branch_id` on the `pickup` table. All the data in the column will be lost.

*/
-- AlterTable
ALTER TABLE `branch` ADD COLUMN `is_office` INTEGER NULL DEFAULT 0;

-- AlterTable
ALTER TABLE `pickup` DROP COLUMN `branch_id`,
    ADD COLUMN `creator_branch` INTEGER NULL;
