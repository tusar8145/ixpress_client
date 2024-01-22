-- AddForeignKey
ALTER TABLE `pickup_tracking` ADD CONSTRAINT `pickup_tracking_pickup_id_fkey` FOREIGN KEY (`pickup_id`) REFERENCES `pickup`(`id`) ON DELETE RESTRICT ON UPDATE CASCADE;
