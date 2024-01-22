/*
  Warnings:

  - You are about to alter the column `services_id_1` on the `pickup` table. The data in that column could be lost. The data in that column will be cast from `VarChar(191)` to `Int`.
  - You are about to alter the column `i_product_type_id_2` on the `pickup` table. The data in that column could be lost. The data in that column will be cast from `VarChar(191)` to `Int`.
  - You are about to alter the column `i_priority_id_3` on the `pickup` table. The data in that column could be lost. The data in that column will be cast from `VarChar(191)` to `Int`.
  - You are about to alter the column `i_payment_type_8` on the `pickup` table. The data in that column could be lost. The data in that column will be cast from `VarChar(191)` to `Int`.

*/
-- AlterTable
ALTER TABLE `pickup` MODIFY `services_id_1` INTEGER NULL,
    MODIFY `i_product_type_id_2` INTEGER NULL,
    MODIFY `i_priority_id_3` INTEGER NULL,
    MODIFY `i_payment_type_8` INTEGER NULL;
