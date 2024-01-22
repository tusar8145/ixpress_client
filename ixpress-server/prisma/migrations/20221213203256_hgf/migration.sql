/*
  Warnings:

  - You are about to alter the column `sender_category_1` on the `pickup` table. The data in that column could be lost. The data in that column will be cast from `VarChar(191)` to `Int`.
  - You are about to alter the column `pickup_type_2` on the `pickup` table. The data in that column could be lost. The data in that column will be cast from `VarChar(191)` to `Int`.
  - You are about to alter the column `pickup_date_3` on the `pickup` table. The data in that column could be lost. The data in that column will be cast from `VarChar(191)` to `Int`.
  - You are about to alter the column `sender_client_id_7` on the `pickup` table. The data in that column could be lost. The data in that column will be cast from `VarChar(191)` to `Int`.
  - You are about to alter the column `sender_client_branch_id_8` on the `pickup` table. The data in that column could be lost. The data in that column will be cast from `VarChar(191)` to `Int`.
  - You are about to alter the column `sender_country_id_10` on the `pickup` table. The data in that column could be lost. The data in that column will be cast from `VarChar(191)` to `Int`.
  - You are about to alter the column `sender_division_id_11` on the `pickup` table. The data in that column could be lost. The data in that column will be cast from `VarChar(191)` to `Int`.
  - You are about to alter the column `sender_district_id_12` on the `pickup` table. The data in that column could be lost. The data in that column will be cast from `VarChar(191)` to `Int`.
  - You are about to alter the column `sender_upazila_id_13` on the `pickup` table. The data in that column could be lost. The data in that column will be cast from `VarChar(191)` to `Int`.
  - You are about to alter the column `i_packaging_type_16` on the `pickup` table. The data in that column could be lost. The data in that column will be cast from `VarChar(191)` to `Int`.
  - You are about to alter the column `i_shipment_method_17` on the `pickup` table. The data in that column could be lost. The data in that column will be cast from `VarChar(191)` to `Int`.
  - You are about to alter the column `i_delivery_status_18` on the `pickup` table. The data in that column could be lost. The data in that column will be cast from `VarChar(191)` to `Int`.
  - You are about to alter the column `i_tracking_status_19` on the `pickup` table. The data in that column could be lost. The data in that column will be cast from `VarChar(191)` to `Int`.
  - You are about to alter the column `recipient_country_id_25` on the `pickup` table. The data in that column could be lost. The data in that column will be cast from `VarChar(191)` to `Int`.
  - You are about to alter the column `recipient_division_id_26` on the `pickup` table. The data in that column could be lost. The data in that column will be cast from `VarChar(191)` to `Int`.
  - You are about to alter the column `recipient_district_id_27` on the `pickup` table. The data in that column could be lost. The data in that column will be cast from `VarChar(191)` to `Int`.
  - You are about to alter the column `recipient_upazila_id_28` on the `pickup` table. The data in that column could be lost. The data in that column will be cast from `VarChar(191)` to `Int`.
  - You are about to alter the column `recipient_branch_id_29` on the `pickup` table. The data in that column could be lost. The data in that column will be cast from `VarChar(191)` to `Int`.

*/
-- AlterTable
ALTER TABLE `pickup` MODIFY `sender_category_1` INTEGER NULL,
    MODIFY `pickup_type_2` INTEGER NULL,
    MODIFY `pickup_date_3` INTEGER NULL,
    MODIFY `sender_client_id_7` INTEGER NULL,
    MODIFY `sender_client_branch_id_8` INTEGER NULL,
    MODIFY `sender_country_id_10` INTEGER NULL,
    MODIFY `sender_division_id_11` INTEGER NULL,
    MODIFY `sender_district_id_12` INTEGER NULL,
    MODIFY `sender_upazila_id_13` INTEGER NULL,
    MODIFY `i_packaging_type_16` INTEGER NULL,
    MODIFY `i_shipment_method_17` INTEGER NULL,
    MODIFY `i_delivery_status_18` INTEGER NULL,
    MODIFY `i_tracking_status_19` INTEGER NULL,
    MODIFY `recipient_country_id_25` INTEGER NULL,
    MODIFY `recipient_division_id_26` INTEGER NULL,
    MODIFY `recipient_district_id_27` INTEGER NULL,
    MODIFY `recipient_upazila_id_28` INTEGER NULL,
    MODIFY `recipient_branch_id_29` INTEGER NULL;
