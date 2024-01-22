/*
  Warnings:

  - A unique constraint covering the columns `[branch_code]` on the table `branch` will be added. If there are existing duplicate values, this will fail.

*/
-- CreateIndex
CREATE UNIQUE INDEX `branch_branch_code_key` ON `branch`(`branch_code`);
