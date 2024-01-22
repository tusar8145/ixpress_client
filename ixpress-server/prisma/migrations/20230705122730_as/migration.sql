-- AlterTable
ALTER TABLE `wallet_transaction` ADD COLUMN `branch` INTEGER NULL;

-- AddForeignKey
ALTER TABLE `wallet_transaction` ADD CONSTRAINT `wallet_transaction_branch_fkey` FOREIGN KEY (`branch`) REFERENCES `branch`(`branch_id`) ON DELETE SET NULL ON UPDATE CASCADE;
