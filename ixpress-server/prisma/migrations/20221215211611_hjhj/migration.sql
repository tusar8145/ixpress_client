/*
  Warnings:

  - You are about to drop the column `is_office` on the `branch` table. All the data in the column will be lost.
  - A unique constraint covering the columns `[branch_code,branch]` on the table `branch` will be added. If there are existing duplicate values, this will fail.

*/
-- DropIndex
DROP INDEX `branch_branch_code_key` ON `branch`;

-- AlterTable
ALTER TABLE `branch` DROP COLUMN `is_office`;

-- CreateIndex
CREATE UNIQUE INDEX `branch_branch_code_branch_key` ON `branch`(`branch_code`, `branch`);
