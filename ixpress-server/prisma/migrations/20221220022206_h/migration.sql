/*
  Warnings:

  - Made the column `destination` on table `pickup_tracking` required. This step will fail if there are existing NULL values in that column.

*/
-- AlterTable
ALTER TABLE `pickup` ADD COLUMN `last_branch_id` INTEGER NULL;

-- AlterTable
ALTER TABLE `pickup_tracking` MODIFY `destination` INTEGER NOT NULL;

-- AddForeignKey
ALTER TABLE `pickup_tracking` ADD CONSTRAINT `pickup_tracking_i_delivery_status_id_18_fkey` FOREIGN KEY (`i_delivery_status_id_18`) REFERENCES `i_delivery_status`(`i_delivery_status_id`) ON DELETE RESTRICT ON UPDATE CASCADE;

-- AddForeignKey
ALTER TABLE `pickup_tracking` ADD CONSTRAINT `pickup_tracking_i_tracking_status_id_19_fkey` FOREIGN KEY (`i_tracking_status_id_19`) REFERENCES `i_tracking_status`(`i_tracking_status_id`) ON DELETE RESTRICT ON UPDATE CASCADE;

-- AddForeignKey
ALTER TABLE `pickup_tracking` ADD CONSTRAINT `pickup_tracking_destination_fkey` FOREIGN KEY (`destination`) REFERENCES `branch`(`branch_id`) ON DELETE RESTRICT ON UPDATE CASCADE;

-- AddForeignKey
ALTER TABLE `pickup_tracking` ADD CONSTRAINT `pickup_tracking_source_fkey` FOREIGN KEY (`source`) REFERENCES `branch`(`branch_id`) ON DELETE RESTRICT ON UPDATE CASCADE;
