-- AddForeignKey
ALTER TABLE `wallet_transaction` ADD CONSTRAINT `wallet_transaction_marchant_id_fkey` FOREIGN KEY (`marchant_id`) REFERENCES `services_clients_branch`(`services_clients_branch_id`) ON DELETE RESTRICT ON UPDATE CASCADE;

-- AddForeignKey
ALTER TABLE `wallet_transaction` ADD CONSTRAINT `wallet_transaction_approved_by_fkey` FOREIGN KEY (`approved_by`) REFERENCES `tbl_users`(`userID`) ON DELETE SET NULL ON UPDATE CASCADE;
