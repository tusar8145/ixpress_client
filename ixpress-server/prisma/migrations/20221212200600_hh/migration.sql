/*
  Warnings:

  - You are about to drop the column `have_collection_amount` on the `i_payment_type` table. All the data in the column will be lost.

*/
-- AlterTable
ALTER TABLE `i_payment_type` DROP COLUMN `have_collection_amount`,
    ADD COLUMN `have_collection` INTEGER NULL DEFAULT 1;
