-- AddForeignKey
ALTER TABLE `pickup_tracking` ADD CONSTRAINT `pickup_tracking_delivery_boy_id_fkey` FOREIGN KEY (`delivery_boy_id`) REFERENCES `tbl_users`(`userID`) ON DELETE SET NULL ON UPDATE CASCADE;

-- AddForeignKey
ALTER TABLE `pickup_tracking` ADD CONSTRAINT `pickup_tracking_i_relation_id_fkey` FOREIGN KEY (`i_relation_id`) REFERENCES `i_relation`(`i_relation_id`) ON DELETE SET NULL ON UPDATE CASCADE;

-- AddForeignKey
ALTER TABLE `pickup_tracking` ADD CONSTRAINT `pickup_tracking_i_return_cause_id_fkey` FOREIGN KEY (`i_return_cause_id`) REFERENCES `i_return_cause`(`i_return_cause_id`) ON DELETE SET NULL ON UPDATE CASCADE;
