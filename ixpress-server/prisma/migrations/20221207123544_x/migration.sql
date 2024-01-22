-- CreateTable
CREATE TABLE `branch_group` (
    `branch_group_id` INTEGER NOT NULL AUTO_INCREMENT,
    `branch_group` VARCHAR(200) NULL,
    `responsible_persion` VARCHAR(200) NULL,
    `position` INTEGER NULL,
    `is_active` INTEGER NULL DEFAULT 1,
    `created` VARCHAR(40) NULL,
    `modified` VARCHAR(40) NULL,
    `creator` INTEGER NULL,
    `modifier` INTEGER NULL,

    UNIQUE INDEX `branch_group_branch_group_key`(`branch_group`),
    PRIMARY KEY (`branch_group_id`)
) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
