/*
  Warnings:

  - You are about to alter the column `recipient_client_branch_id_23` on the `pickup` table. The data in that column could be lost. The data in that column will be cast from `VarChar(191)` to `Int`.

*/
-- AlterTable
ALTER TABLE `pickup` MODIFY `recipient_client_branch_id_23` INTEGER NULL;
