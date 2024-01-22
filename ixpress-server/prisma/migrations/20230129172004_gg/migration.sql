-- AlterTable
ALTER TABLE `wallet_transaction` ADD COLUMN `client_id` INTEGER NULL;

-- AddForeignKey
ALTER TABLE `wallet_transaction` ADD CONSTRAINT `wallet_transaction_client_id_fkey` FOREIGN KEY (`client_id`) REFERENCES `services_clients`(`services_clients_id`) ON DELETE SET NULL ON UPDATE CASCADE;
