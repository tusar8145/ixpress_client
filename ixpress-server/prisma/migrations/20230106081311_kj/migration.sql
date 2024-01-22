/*
  Warnings:

  - The primary key for the `pickup` table will be changed. If it partially fails, the table could be left without primary key constraint.
  - You are about to alter the column `id` on the `pickup` table. The data in that column could be lost. The data in that column will be cast from `UnsignedBigInt` to `Int`.
  - You are about to alter the column `customer_no` on the `pickup` table. The data in that column could be lost. The data in that column will be cast from `UnsignedBigInt` to `Int`.
  - You are about to alter the column `unique_upload_id` on the `pickup` table. The data in that column could be lost. The data in that column will be cast from `UnsignedBigInt` to `VarChar(191)`.

*/
-- AlterTable
ALTER TABLE `pickup` DROP PRIMARY KEY,
    MODIFY `id` INTEGER NOT NULL AUTO_INCREMENT,
    MODIFY `customer_no` INTEGER NULL,
    MODIFY `unique_upload_id` VARCHAR(191) NULL,
    ADD PRIMARY KEY (`id`);
