-- AddForeignKey
ALTER TABLE `wallet_transaction` ADD CONSTRAINT `wallet_transaction_creator_fkey` FOREIGN KEY (`creator`) REFERENCES `tbl_users`(`userID`) ON DELETE RESTRICT ON UPDATE CASCADE;
