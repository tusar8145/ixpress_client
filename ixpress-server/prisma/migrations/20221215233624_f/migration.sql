/*
  Warnings:

  - Made the column `services_id_1` on table `pickup` required. This step will fail if there are existing NULL values in that column.

*/
-- AlterTable
ALTER TABLE `pickup` MODIFY `services_id_1` INTEGER NOT NULL;
