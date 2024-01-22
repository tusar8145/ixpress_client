-- AlterTable
ALTER TABLE `pickup` ADD COLUMN `otp` INTEGER NULL,
    ADD COLUMN `otp_verified` INTEGER NULL;

-- AlterTable
ALTER TABLE `services` ADD COLUMN `is_otp` INTEGER NULL DEFAULT 0;
