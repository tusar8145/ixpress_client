-- CreateTable
CREATE TABLE `pickup_tracking` (
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `pickup_id` INTEGER NOT NULL,
    `tracking_type` VARCHAR(191) NOT NULL,
    `source` INTEGER NOT NULL,
    `destination` INTEGER NOT NULL,
    `date` VARCHAR(191) NOT NULL,
    `time` VARCHAR(191) NOT NULL,
    `note` VARCHAR(191) NOT NULL,

    PRIMARY KEY (`id`)
) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
