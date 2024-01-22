/*
  Warnings:

  - You are about to drop the column `i_delivery_status_18` on the `pickup` table. All the data in the column will be lost.
  - You are about to drop the column `i_packaging_type_16` on the `pickup` table. All the data in the column will be lost.
  - You are about to drop the column `i_shipment_method_17` on the `pickup` table. All the data in the column will be lost.
  - You are about to drop the column `i_tracking_status_19` on the `pickup` table. All the data in the column will be lost.
  - A unique constraint covering the columns `[sender_ref_no_4]` on the table `pickup` will be added. If there are existing duplicate values, this will fail.
  - Added the required column `i_delivery_status_id_18` to the `pickup` table without a default value. This is not possible if the table is not empty.
  - Added the required column `i_packaging_type_id_16` to the `pickup` table without a default value. This is not possible if the table is not empty.
  - Added the required column `i_shipment_method_id_17` to the `pickup` table without a default value. This is not possible if the table is not empty.
  - Added the required column `i_tracking_status_id_19` to the `pickup` table without a default value. This is not possible if the table is not empty.
  - Made the column `i_product_type_id_2` on table `pickup` required. This step will fail if there are existing NULL values in that column.
  - Made the column `i_priority_id_3` on table `pickup` required. This step will fail if there are existing NULL values in that column.
  - Made the column `overwriting_cost_5` on table `pickup` required. This step will fail if there are existing NULL values in that column.
  - Made the column `total_cost_6` on table `pickup` required. This step will fail if there are existing NULL values in that column.
  - Made the column `collection_amount_7` on table `pickup` required. This step will fail if there are existing NULL values in that column.
  - Made the column `i_payment_type_8` on table `pickup` required. This step will fail if there are existing NULL values in that column.
  - Made the column `sender_category_1` on table `pickup` required. This step will fail if there are existing NULL values in that column.
  - Made the column `pickup_type_2` on table `pickup` required. This step will fail if there are existing NULL values in that column.
  - Made the column `pickup_date_3` on table `pickup` required. This step will fail if there are existing NULL values in that column.
  - Made the column `sender_ref_no_4` on table `pickup` required. This step will fail if there are existing NULL values in that column.
  - Made the column `recipient_category_14` on table `pickup` required. This step will fail if there are existing NULL values in that column.
  - Made the column `delivery_type_15` on table `pickup` required. This step will fail if there are existing NULL values in that column.
  - Made the column `creator` on table `pickup` required. This step will fail if there are existing NULL values in that column.
  - Made the column `created_branch_id` on table `pickup` required. This step will fail if there are existing NULL values in that column.
  - Made the column `current_branch_id` on table `pickup` required. This step will fail if there are existing NULL values in that column.

*/
-- AlterTable
ALTER TABLE `pickup` DROP COLUMN `i_delivery_status_18`,
    DROP COLUMN `i_packaging_type_16`,
    DROP COLUMN `i_shipment_method_17`,
    DROP COLUMN `i_tracking_status_19`,
    ADD COLUMN `i_delivery_status_id_18` INTEGER NOT NULL,
    ADD COLUMN `i_packaging_type_id_16` INTEGER NOT NULL,
    ADD COLUMN `i_shipment_method_id_17` INTEGER NOT NULL,
    ADD COLUMN `i_tracking_status_id_19` INTEGER NOT NULL,
    MODIFY `i_product_type_id_2` INTEGER NOT NULL,
    MODIFY `i_priority_id_3` INTEGER NOT NULL,
    MODIFY `overwriting_cost_5` VARCHAR(191) NOT NULL,
    MODIFY `total_cost_6` VARCHAR(191) NOT NULL,
    MODIFY `collection_amount_7` VARCHAR(191) NOT NULL,
    MODIFY `i_payment_type_8` INTEGER NOT NULL,
    MODIFY `sender_category_1` VARCHAR(191) NOT NULL,
    MODIFY `pickup_type_2` VARCHAR(191) NOT NULL,
    MODIFY `pickup_date_3` VARCHAR(191) NOT NULL,
    MODIFY `sender_ref_no_4` VARCHAR(191) NOT NULL,
    MODIFY `recipient_category_14` VARCHAR(191) NOT NULL,
    MODIFY `delivery_type_15` VARCHAR(191) NOT NULL,
    MODIFY `creator` INTEGER NOT NULL,
    MODIFY `created_branch_id` INTEGER NOT NULL,
    MODIFY `current_branch_id` INTEGER NOT NULL;

-- CreateIndex
CREATE UNIQUE INDEX `pickup_sender_ref_no_4_key` ON `pickup`(`sender_ref_no_4`);
