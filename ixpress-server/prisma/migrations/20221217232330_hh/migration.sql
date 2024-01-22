-- AddForeignKey
ALTER TABLE `pickup` ADD CONSTRAINT `pickup_services_id_1_fkey` FOREIGN KEY (`services_id_1`) REFERENCES `services`(`services_id`) ON DELETE RESTRICT ON UPDATE CASCADE;
