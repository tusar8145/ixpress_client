/*
  Warnings:

  - A unique constraint covering the columns `[branch_group,branch_group_code]` on the table `branch_group` will be added. If there are existing duplicate values, this will fail.

*/
-- DropIndex
DROP INDEX `branch_group_branch_group_key` ON `branch_group`;

-- AlterTable
ALTER TABLE `branch_group` ADD COLUMN `branch_group_code` VARCHAR(200) NULL;

-- CreateIndex
CREATE UNIQUE INDEX `branch_group_branch_group_branch_group_code_key` ON `branch_group`(`branch_group`, `branch_group_code`);
