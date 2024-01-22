-- AddForeignKey
ALTER TABLE `pickup` ADD CONSTRAINT `pickup_i_product_type_id_2_fkey` FOREIGN KEY (`i_product_type_id_2`) REFERENCES `i_product_type`(`i_product_type_id`) ON DELETE RESTRICT ON UPDATE CASCADE;

-- AddForeignKey
ALTER TABLE `pickup` ADD CONSTRAINT `pickup_i_priority_id_3_fkey` FOREIGN KEY (`i_priority_id_3`) REFERENCES `i_priority`(`i_priority_id`) ON DELETE RESTRICT ON UPDATE CASCADE;

-- AddForeignKey
ALTER TABLE `pickup` ADD CONSTRAINT `pickup_i_payment_type_8_fkey` FOREIGN KEY (`i_payment_type_8`) REFERENCES `i_payment_type`(`i_payment_type_id`) ON DELETE RESTRICT ON UPDATE CASCADE;

-- AddForeignKey
ALTER TABLE `pickup` ADD CONSTRAINT `pickup_i_packaging_type_id_16_fkey` FOREIGN KEY (`i_packaging_type_id_16`) REFERENCES `i_packaging_type`(`i_packaging_type_id`) ON DELETE RESTRICT ON UPDATE CASCADE;

-- AddForeignKey
ALTER TABLE `pickup` ADD CONSTRAINT `pickup_i_shipment_method_id_17_fkey` FOREIGN KEY (`i_shipment_method_id_17`) REFERENCES `i_shipment_method`(`i_shipment_method_id`) ON DELETE RESTRICT ON UPDATE CASCADE;

-- AddForeignKey
ALTER TABLE `pickup` ADD CONSTRAINT `pickup_i_delivery_status_id_18_fkey` FOREIGN KEY (`i_delivery_status_id_18`) REFERENCES `i_delivery_status`(`i_delivery_status_id`) ON DELETE RESTRICT ON UPDATE CASCADE;

-- AddForeignKey
ALTER TABLE `pickup` ADD CONSTRAINT `pickup_i_tracking_status_id_19_fkey` FOREIGN KEY (`i_tracking_status_id_19`) REFERENCES `i_tracking_status`(`i_tracking_status_id`) ON DELETE RESTRICT ON UPDATE CASCADE;
