/*
  Warnings:

  - A unique constraint covering the columns `[transaction_id]` on the table `wallet_transaction` will be added. If there are existing duplicate values, this will fail.

*/
-- CreateIndex
CREATE UNIQUE INDEX `wallet_transaction_transaction_id_key` ON `wallet_transaction`(`transaction_id`);

-- AddForeignKey
ALTER TABLE `pickup` ADD CONSTRAINT `pickup_charge_trxid_fkey` FOREIGN KEY (`charge_trxid`) REFERENCES `wallet_transaction`(`transaction_id`) ON DELETE SET NULL ON UPDATE CASCADE;

-- AddForeignKey
ALTER TABLE `pickup` ADD CONSTRAINT `pickup_collection_trxid_fkey` FOREIGN KEY (`collection_trxid`) REFERENCES `wallet_transaction`(`transaction_id`) ON DELETE SET NULL ON UPDATE CASCADE;
