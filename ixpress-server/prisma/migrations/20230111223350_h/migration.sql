-- AlterTable
ALTER TABLE `pickup` ADD COLUMN `delivery_boy_id` INTEGER NULL,
    ADD COLUMN `i_relation_id` INTEGER NULL,
    ADD COLUMN `i_return_cause_id` INTEGER NULL;

-- AddForeignKey
ALTER TABLE `pickup` ADD CONSTRAINT `pickup_delivery_boy_id_fkey` FOREIGN KEY (`delivery_boy_id`) REFERENCES `tbl_users`(`userID`) ON DELETE SET NULL ON UPDATE CASCADE;

-- AddForeignKey
ALTER TABLE `pickup` ADD CONSTRAINT `pickup_i_relation_id_fkey` FOREIGN KEY (`i_relation_id`) REFERENCES `i_relation`(`i_relation_id`) ON DELETE SET NULL ON UPDATE CASCADE;

-- AddForeignKey
ALTER TABLE `pickup` ADD CONSTRAINT `pickup_i_return_cause_id_fkey` FOREIGN KEY (`i_return_cause_id`) REFERENCES `i_return_cause`(`i_return_cause_id`) ON DELETE SET NULL ON UPDATE CASCADE;
