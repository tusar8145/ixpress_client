/*
  Warnings:

  - You are about to alter the column `cost` on the `cost_addi_sms` table. The data in that column could be lost. The data in that column will be cast from `Int` to `Double`.
  - You are about to alter the column `cost` on the `cost_addi_track_web` table. The data in that column could be lost. The data in that column will be cast from `Int` to `Double`.
  - You are about to alter the column `cost` on the `cost_packaging` table. The data in that column could be lost. The data in that column will be cast from `Int` to `Double`.
  - You are about to alter the column `first_kg` on the `cost_weight` table. The data in that column could be lost. The data in that column will be cast from `Int` to `Double`.
  - You are about to alter the column `additional_kg` on the `cost_weight` table. The data in that column could be lost. The data in that column will be cast from `Int` to `Double`.

*/
-- AlterTable
ALTER TABLE `cost_addi_sms` MODIFY `cost` DOUBLE NULL;

-- AlterTable
ALTER TABLE `cost_addi_track_web` MODIFY `cost` DOUBLE NULL;

-- AlterTable
ALTER TABLE `cost_packaging` MODIFY `cost` DOUBLE NULL;

-- AlterTable
ALTER TABLE `cost_weight` MODIFY `first_kg` DOUBLE NULL,
    MODIFY `additional_kg` DOUBLE NULL;
