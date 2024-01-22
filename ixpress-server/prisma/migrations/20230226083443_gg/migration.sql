-- CreateTable
CREATE TABLE `services_clients_issues_reply` (
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `user_id` INTEGER NOT NULL,
    `issue_user_id` INTEGER NOT NULL,
    `reply` VARCHAR(191) NULL,
    `is_seen` INTEGER NULL DEFAULT 0,
    `is_active` INTEGER NULL DEFAULT 1,
    `created` VARCHAR(40) NULL,
    `modified` VARCHAR(40) NULL,
    `creator` INTEGER NULL,
    `modifier` INTEGER NULL,

    PRIMARY KEY (`id`)
) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
