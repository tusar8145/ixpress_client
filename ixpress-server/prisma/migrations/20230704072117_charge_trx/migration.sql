-- AlterTable
ALTER TABLE `pickup` ADD COLUMN `charge_trxid` INTEGER NULL,
    ADD COLUMN `collection_trxid` INTEGER NULL;
