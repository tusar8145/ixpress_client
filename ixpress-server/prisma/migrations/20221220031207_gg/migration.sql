/*
  Warnings:

  - Made the column `creator` on table `pickup_tracking` required. This step will fail if there are existing NULL values in that column.

*/
-- AlterTable
ALTER TABLE `pickup_tracking` MODIFY `creator` INTEGER NOT NULL;

-- AddForeignKey
ALTER TABLE `pickup_tracking` ADD CONSTRAINT `pickup_tracking_creator_fkey` FOREIGN KEY (`creator`) REFERENCES `tbl_users`(`userID`) ON DELETE RESTRICT ON UPDATE CASCADE;
