-- CreateTable
CREATE TABLE `services_clients_issues` (
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `subject` VARCHAR(191) NULL,
    `issue` MEDIUMTEXT NULL,
    `reply` MEDIUMTEXT NULL,
    `is_seen` INTEGER NULL DEFAULT 0,
    `is_solved` INTEGER NULL DEFAULT 0,
    `client_id` INTEGER NULL,
    `creator` INTEGER NULL,
    `reply_by` INTEGER NULL,
    `created` VARCHAR(40) NULL,
    `replied` VARCHAR(40) NULL,

    PRIMARY KEY (`id`)
) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- AddForeignKey
ALTER TABLE `services_clients_issues` ADD CONSTRAINT `services_clients_issues_client_id_fkey` FOREIGN KEY (`client_id`) REFERENCES `services_clients`(`services_clients_id`) ON DELETE SET NULL ON UPDATE CASCADE;

-- AddForeignKey
ALTER TABLE `services_clients_issues` ADD CONSTRAINT `services_clients_issues_creator_fkey` FOREIGN KEY (`creator`) REFERENCES `tbl_users`(`userID`) ON DELETE SET NULL ON UPDATE CASCADE;

-- AddForeignKey
ALTER TABLE `services_clients_issues` ADD CONSTRAINT `services_clients_issues_reply_by_fkey` FOREIGN KEY (`reply_by`) REFERENCES `tbl_users`(`userID`) ON DELETE SET NULL ON UPDATE CASCADE;
