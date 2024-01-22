/*
  Warnings:

  - You are about to drop the column `wallet_from_marchant` on the `pickup_tracking` table. All the data in the column will be lost.
  - You are about to drop the column `wallet_to_marchant` on the `pickup_tracking` table. All the data in the column will be lost.

*/
-- AlterTable
ALTER TABLE `pickup` ADD COLUMN `amount_from_wallet` INTEGER NULL,
    ADD COLUMN `amount_to_wallet` INTEGER NULL;

-- AlterTable
ALTER TABLE `pickup_tracking` DROP COLUMN `wallet_from_marchant`,
    DROP COLUMN `wallet_to_marchant`;
