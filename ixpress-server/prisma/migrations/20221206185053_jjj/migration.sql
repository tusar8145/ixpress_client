/*
  Warnings:

  - You are about to drop the column `userStatus_` on the `tbl_users` table. All the data in the column will be lost.
  - The primary key for the `tbl_users_userStatus` table will be changed. If it partially fails, the table could be left without primary key constraint.
  - You are about to drop the column `created` on the `tbl_users_userStatus` table. All the data in the column will be lost.
  - You are about to drop the column `creator` on the `tbl_users_userStatus` table. All the data in the column will be lost.
  - You are about to drop the column `id` on the `tbl_users_userStatus` table. All the data in the column will be lost.
  - You are about to drop the column `is_key` on the `tbl_users_userStatus` table. All the data in the column will be lost.
  - You are about to drop the column `modified` on the `tbl_users_userStatus` table. All the data in the column will be lost.
  - You are about to drop the column `modifier` on the `tbl_users_userStatus` table. All the data in the column will be lost.
  - You are about to drop the column `permission` on the `tbl_users_userStatus` table. All the data in the column will be lost.
  - You are about to drop the column `userStatus` on the `tbl_users_userStatus` table. All the data in the column will be lost.
  - You are about to drop the column `userStatus_id` on the `tbl_users_userStatus` table. All the data in the column will be lost.
  - Added the required column `tbl_users_userStatus_id` to the `tbl_users_userStatus` table without a default value. This is not possible if the table is not empty.

*/
-- AlterTable
ALTER TABLE `tbl_users` DROP COLUMN `userStatus_`,
    ADD COLUMN `userStatus` VARCHAR(191) NULL;

-- AlterTable
ALTER TABLE `tbl_users_userStatus` DROP PRIMARY KEY,
    DROP COLUMN `created`,
    DROP COLUMN `creator`,
    DROP COLUMN `id`,
    DROP COLUMN `is_key`,
    DROP COLUMN `modified`,
    DROP COLUMN `modifier`,
    DROP COLUMN `permission`,
    DROP COLUMN `userStatus`,
    DROP COLUMN `userStatus_id`,
    ADD COLUMN `tbl_users_userStatus` VARCHAR(250) NULL,
    ADD COLUMN `tbl_users_userStatus_id` INTEGER NOT NULL AUTO_INCREMENT,
    ADD PRIMARY KEY (`tbl_users_userStatus_id`);
