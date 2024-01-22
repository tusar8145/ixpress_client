-- CreateTable
CREATE TABLE `activitylog` (
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `types` VARCHAR(100) NULL,
    `device` VARCHAR(500) NULL,
    `ip` VARCHAR(500) NULL,
    `location` VARCHAR(500) NULL,
    `browser` VARCHAR(500) NULL,
    `log` VARCHAR(250) NULL,
    `userID` INTEGER NULL,

    PRIMARY KEY (`id`)
) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- CreateTable
CREATE TABLE `email_addresses` (
    `email_addresses_id` INTEGER NOT NULL AUTO_INCREMENT,
    `email_addresses` VARCHAR(250) NULL,
    `password` VARCHAR(250) NULL,
    `is_key` VARCHAR(250) NULL DEFAULT '1',
    `created_by` VARCHAR(250) NULL,
    `approved_by` VARCHAR(250) NULL,
    `created` VARCHAR(250) NULL,
    `modified` VARCHAR(500) NULL,
    `creator` VARCHAR(250) NULL,
    `modifier` VARCHAR(100) NULL,
    `setFrom` VARCHAR(250) NULL,
    `replyTo` VARCHAR(500) NULL,
    `title` VARCHAR(500) NULL,

    PRIMARY KEY (`email_addresses_id`)
) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- CreateTable
CREATE TABLE `email_outbox` (
    `email_outbox_id` INTEGER NOT NULL AUTO_INCREMENT,
    `email_outbox` VARCHAR(250) NOT NULL,
    `email_outbox_types` VARCHAR(250) NULL,
    `position` VARCHAR(250) NULL,
    `email_from` VARCHAR(250) NULL,
    `email_to` VARCHAR(250) NULL,
    `published_on` VARCHAR(250) NULL,
    `closed_on` VARCHAR(250) NULL,
    `details` LONGTEXT NULL,
    `files` LONGTEXT NULL,
    `is_key` VARCHAR(250) NULL DEFAULT '1',
    `is_editable` INTEGER NULL DEFAULT 1,
    `email_documents_status` VARCHAR(250) NULL,
    `created` VARCHAR(250) NULL,
    `modified` VARCHAR(500) NULL,
    `modifier` VARCHAR(100) NULL,
    `creator` VARCHAR(250) NULL,
    `accessable` VARCHAR(250) NULL,
    `email_addresses_id` INTEGER NULL,

    PRIMARY KEY (`email_outbox_id`)
) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- CreateTable
CREATE TABLE `i_countries` (
    `i_countries_id` INTEGER NOT NULL AUTO_INCREMENT,
    `A2` VARCHAR(100) NULL,
    `A3` VARCHAR(100) NULL,
    `NUM` VARCHAR(100) NULL,
    `i_countries` VARCHAR(111) NULL,
    `position` INTEGER NULL,
    `is_active` INTEGER NULL DEFAULT 1,
    `created` VARCHAR(40) NULL,
    `modified` VARCHAR(40) NULL,
    `creator` INTEGER NULL,
    `modifier` INTEGER NULL,

    PRIMARY KEY (`i_countries_id`)
) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- CreateTable
CREATE TABLE `i_document_type` (
    `i_document_type_id` INTEGER NOT NULL AUTO_INCREMENT,
    `i_document_type` VARCHAR(255) NULL,
    `sms_send` ENUM('Yes', 'No') NULL DEFAULT 'No',
    `is_sms_send` INTEGER NOT NULL DEFAULT 0,
    `is_active` INTEGER NULL DEFAULT 1,
    `created` VARCHAR(40) NULL,
    `modified` VARCHAR(40) NULL,
    `creator` INTEGER NULL,
    `modifier` INTEGER NULL,

    PRIMARY KEY (`i_document_type_id`)
) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- CreateTable
CREATE TABLE `i_gateway` (
    `i_gateway_id` INTEGER NOT NULL AUTO_INCREMENT,
    `i_gateway` VARCHAR(150) NULL,
    `trackurl` VARCHAR(255) NULL,
    `status` ENUM('Yes', 'No') NULL DEFAULT 'Yes',
    `position` INTEGER NULL,
    `is_active` INTEGER NULL DEFAULT 1,
    `created` VARCHAR(40) NULL,
    `modified` VARCHAR(40) NULL,
    `creator` INTEGER NULL,
    `modifier` INTEGER NULL,

    PRIMARY KEY (`i_gateway_id`)
) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- CreateTable
CREATE TABLE `i_oc_country` (
    `i_oc_country_id` INTEGER NOT NULL AUTO_INCREMENT,
    `i_oc_country` VARCHAR(128) NOT NULL,
    `iso_code_2` VARCHAR(2) NULL,
    `iso_code_3` VARCHAR(3) NULL,
    `address_format` TEXT NULL,
    `postcode_required` BOOLEAN NULL,
    `status` BOOLEAN NOT NULL DEFAULT true,
    `zone` VARCHAR(2) NULL,
    `tnt_zone` VARCHAR(2) NULL,
    `tnt_surcharge` INTEGER NULL DEFAULT 1,
    `position` INTEGER NULL,
    `is_active` INTEGER NULL DEFAULT 1,
    `created` VARCHAR(40) NULL,
    `modified` VARCHAR(40) NULL,
    `creator` INTEGER NULL,
    `modifier` INTEGER NULL,

    PRIMARY KEY (`i_oc_country_id`)
) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- CreateTable
CREATE TABLE `i_relation` (
    `i_relation_id` INTEGER NOT NULL AUTO_INCREMENT,
    `i_relation` VARCHAR(150) NULL,
    `short_name` VARCHAR(100) NULL,
    `position` INTEGER NULL,
    `is_active` INTEGER NULL DEFAULT 1,
    `created` VARCHAR(40) NULL,
    `modified` VARCHAR(40) NULL,
    `creator` INTEGER NULL,
    `modifier` INTEGER NULL,

    PRIMARY KEY (`i_relation_id`)
) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- CreateTable
CREATE TABLE `i_return_cause` (
    `i_return_cause_id` INTEGER NOT NULL AUTO_INCREMENT,
    `i_return_cause` VARCHAR(255) NULL,
    `position` INTEGER NULL,
    `is_active` INTEGER NULL DEFAULT 1,
    `created` VARCHAR(40) NULL,
    `modified` VARCHAR(40) NULL,
    `creator` INTEGER NULL,
    `modifier` INTEGER NULL,

    PRIMARY KEY (`i_return_cause_id`)
) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- CreateTable
CREATE TABLE `i_sms_template` (
    `i_sms_template_id` INTEGER NOT NULL AUTO_INCREMENT,
    `i_sms_template` VARCHAR(255) NULL,
    `message` TEXT NULL,
    `step` VARCHAR(100) NULL,
    `published` ENUM('Yes', 'No') NULL DEFAULT 'Yes',
    `position` INTEGER NULL,
    `is_active` INTEGER NULL DEFAULT 1,
    `created` VARCHAR(40) NULL,
    `modified` VARCHAR(40) NULL,
    `creator` INTEGER NULL,
    `modifier` INTEGER NULL,

    PRIMARY KEY (`i_sms_template_id`)
) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- CreateTable
CREATE TABLE `i_tracking_status` (
    `i_tracking_status_id` INTEGER NOT NULL AUTO_INCREMENT,
    `i_tracking_status` VARCHAR(255) NULL,
    `position` INTEGER NULL,
    `is_active` INTEGER NULL DEFAULT 1,
    `created` VARCHAR(40) NULL,
    `modified` VARCHAR(40) NULL,
    `creator` INTEGER NULL,
    `modifier` INTEGER NULL,

    PRIMARY KEY (`i_tracking_status_id`)
) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- CreateTable
CREATE TABLE `i_unit` (
    `i_unit_id` INTEGER NOT NULL AUTO_INCREMENT,
    `i_unit` VARCHAR(255) NULL,
    `position` INTEGER NULL,
    `is_active` INTEGER NULL DEFAULT 1,
    `created` VARCHAR(40) NULL,
    `modified` VARCHAR(40) NULL,
    `creator` INTEGER NULL,
    `modifier` INTEGER NULL,

    PRIMARY KEY (`i_unit_id`)
) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- CreateTable
CREATE TABLE `i_vendor` (
    `i_vendor_id` INTEGER NOT NULL AUTO_INCREMENT,
    `i_vendor` VARCHAR(200) NULL,
    `logo` VARCHAR(150) NULL,
    `branch_code` VARCHAR(20) NULL,
    `web` VARCHAR(150) NULL,
    `address` VARCHAR(200) NULL,
    `location` VARCHAR(255) NULL,
    `phone` VARCHAR(200) NULL,
    `fax` VARCHAR(20) NULL,
    `email` VARCHAR(100) NULL,
    `officedays` TINYTEXT NULL,
    `office_stime` TINYTEXT NULL,
    `office_etime` TINYTEXT NULL,
    `cl` DECIMAL(2, 0) NULL,
    `sl` DECIMAL(2, 0) NULL,
    `published` ENUM('Yes', 'No') NULL,
    `position` INTEGER NULL,
    `is_active` INTEGER NULL DEFAULT 1,
    `created` VARCHAR(40) NULL,
    `modified` VARCHAR(40) NULL,
    `creator` INTEGER NULL,
    `modifier` INTEGER NULL,

    PRIMARY KEY (`i_vendor_id`)
) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- CreateTable
CREATE TABLE `pod` (
    `hwb_no` BIGINT NOT NULL AUTO_INCREMENT,
    `mbw_no` VARCHAR(20) NOT NULL,
    `ref_no` VARCHAR(45) NULL,
    `client_id` VARCHAR(50) NOT NULL,
    `sh_name` VARCHAR(200) NOT NULL,
    `sh_company` VARCHAR(200) NULL,
    `sh_dept` VARCHAR(200) NULL,
    `sh_address` VARCHAR(255) NOT NULL,
    `sh_city` VARCHAR(50) NOT NULL,
    `sh_post_code` VARCHAR(20) NOT NULL,
    `sh_country` VARCHAR(50) NOT NULL,
    `sh_cell_no` VARCHAR(20) NOT NULL,
    `re_name` VARCHAR(200) NOT NULL,
    `re_company` VARCHAR(200) NULL,
    `re_address` VARCHAR(255) NOT NULL,
    `re_city` VARCHAR(50) NOT NULL,
    `re_post_code` VARCHAR(20) NOT NULL,
    `re_country` VARCHAR(50) NOT NULL,
    `re_cell_no` VARCHAR(20) NOT NULL,
    `re_customer_no` VARCHAR(30) NULL,
    `pick_date` DATE NOT NULL,
    `tracking` LONGTEXT NOT NULL,
    `status` ENUM('Picked up', 'In Transit', 'Delivered', 'On Hold', 'Landed', 'Delayed', 'Transfer Branch', 'CN-Book', 'Return', 'Not Received') NOT NULL DEFAULT 'Picked up',
    `return_cause` VARCHAR(100) NULL,
    `return_reason` TEXT NULL,
    `comments` LONGTEXT NOT NULL,
    `date_added` DATETIME(0) NOT NULL,
    `document_type` VARCHAR(255) NULL,
    `pod_type` ENUM('General', 'Corporate', 'International') NULL DEFAULT 'General',
    `payment_type` ENUM('Prepaid', 'COD', 'To Pay', 'Cash', 'Credit') NULL,
    `remarkes` VARCHAR(255) NULL,
    `weight` VARCHAR(50) NULL,
    `qty` INTEGER NULL DEFAULT 0,
    `dimension` VARCHAR(100) NULL,
    `rate` FLOAT NULL DEFAULT 0.00,
    `service_charge` FLOAT NULL DEFAULT 0.00,
    `others_charge` FLOAT NULL DEFAULT 0.00,
    `price` FLOAT NULL DEFAULT 0.00,
    `user_id` INTEGER NULL,
    `modified_date` DATETIME(0) NULL,
    `last_user` INTEGER NULL,
    `ip` VARCHAR(20) NULL,
    `branch_code` VARCHAR(20) NULL,
    `swiching_log` LONGTEXT NULL,
    `current_branch` VARCHAR(20) NULL,
    `recived_by` VARCHAR(150) NULL,
    `recived_date` DATETIME(0) NULL,
    `relation` VARCHAR(100) NULL,
    `identification` VARCHAR(200) NULL,
    `scan_file` VARCHAR(255) NULL,
    `priority` ENUM('General', 'Security') NULL DEFAULT 'General',
    `sp_id` VARCHAR(30) NULL,
    `sms_send` VARCHAR(200) NULL,
    `track_status` ENUM('Yes', 'No') NOT NULL DEFAULT 'No',
    `gateway` VARCHAR(50) NULL,
    `gateway_trackid` VARCHAR(50) NULL,

    INDEX `client_id`(`client_id`),
    INDEX `mbw_no`(`mbw_no`),
    INDEX `ref_no`(`ref_no`),
    PRIMARY KEY (`hwb_no`)
) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- CreateTable
CREATE TABLE `services` (
    `services_id` INTEGER NOT NULL AUTO_INCREMENT,
    `services` VARCHAR(255) NULL,
    `position` INTEGER NULL,
    `is_active` INTEGER NULL DEFAULT 1,
    `created` VARCHAR(40) NULL,
    `modified` VARCHAR(40) NULL,
    `creator` INTEGER NULL,
    `modifier` INTEGER NULL,

    PRIMARY KEY (`services_id`)
) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- CreateTable
CREATE TABLE `services_activate` (
    `services_activate_id` INTEGER NOT NULL AUTO_INCREMENT,
    `services_activate` VARCHAR(250) NOT NULL,
    `services_payment_policy` VARCHAR(500) NULL,
    `services_clients_id` VARCHAR(700) NULL,
    `activate_date` VARCHAR(100) NULL,
    `agreement_id` VARCHAR(100) NULL,
    `expired_date` VARCHAR(500) NULL,
    `position` INTEGER NULL,
    `is_active` INTEGER NULL DEFAULT 1,
    `created` VARCHAR(40) NULL,
    `modified` VARCHAR(40) NULL,
    `creator` INTEGER NULL,
    `modifier` INTEGER NULL,
    `services_payment_policy_list` VARCHAR(500) NULL,

    UNIQUE INDEX `services_activate`(`services_activate`),
    PRIMARY KEY (`services_activate_id`)
) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- CreateTable
CREATE TABLE `services_clients` (
    `services_clients_id` INTEGER NOT NULL AUTO_INCREMENT,
    `clientsid` VARCHAR(50) NULL,
    `services_clients` VARCHAR(120) NOT NULL DEFAULT '',
    `branch` VARCHAR(150) NULL,
    `address` VARCHAR(255) NOT NULL DEFAULT '',
    `city` VARCHAR(50) NULL,
    `state` VARCHAR(32) NOT NULL DEFAULT '',
    `post_code` VARCHAR(32) NULL,
    `country` VARCHAR(100) NULL,
    `phone` VARCHAR(50) NULL,
    `email` VARCHAR(150) NULL,
    `contact_person` VARCHAR(150) NULL,
    `cp_department` VARCHAR(150) NULL,
    `cp_designation` VARCHAR(150) NULL,
    `cp_phone` VARCHAR(100) NULL,
    `cp_email` VARCHAR(150) NULL,
    `published` ENUM('Yes', 'No') NOT NULL DEFAULT 'Yes',
    `create_date` DATETIME(0) NULL,
    `sms_option` ENUM('Yes', 'No') NULL DEFAULT 'No',
    `sms_number` VARCHAR(20) NULL,
    `api_id` VARCHAR(100) NULL,
    `api_enable` ENUM('Yes', 'No') NULL,
    `api_for_web` VARCHAR(150) NULL,
    `is_active` INTEGER NULL DEFAULT 1,
    `created` VARCHAR(40) NULL,
    `modified` VARCHAR(40) NULL,
    `creator` INTEGER NULL,
    `modifier` INTEGER NULL,
    `services_category_id` VARCHAR(450) NULL,
    `zone_districts_id` VARCHAR(10) NULL,
    `zone_divisions_id` VARCHAR(10) NULL,
    `zone_upazilas_id` VARCHAR(10) NULL,
    `i_countries_id` INTEGER NULL,
    `services_clients_type_id` INTEGER NULL,
    `services_id` VARCHAR(250) NULL,

    PRIMARY KEY (`services_clients_id`)
) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- CreateTable
CREATE TABLE `services_clients_type` (
    `services_clients_type_id` INTEGER NOT NULL AUTO_INCREMENT,
    `services_clients_type` VARCHAR(255) NULL,
    `is_active` INTEGER NULL DEFAULT 1,
    `created` VARCHAR(40) NULL,
    `modified` VARCHAR(40) NULL,
    `creator` INTEGER NULL,
    `modifier` INTEGER NULL,

    PRIMARY KEY (`services_clients_type_id`)
) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- CreateTable
CREATE TABLE `services_payment_policy` (
    `services_payment_policy_id` INTEGER NOT NULL AUTO_INCREMENT,
    `services_payment_policy` VARCHAR(150) NULL,
    `amount` VARCHAR(100) NULL,
    `i_unit_id` VARCHAR(20) NULL,
    `policy_code` VARCHAR(100) NULL,
    `services_provider_id` VARCHAR(100) NULL,
    `configuration` VARCHAR(500) NULL,
    `position` INTEGER NULL,
    `is_active` INTEGER NULL DEFAULT 1,
    `created` VARCHAR(40) NULL,
    `modified` VARCHAR(40) NULL,
    `creator` INTEGER NULL,
    `modifier` INTEGER NULL,
    `services_clients_id` VARCHAR(250) NULL,

    UNIQUE INDEX `policy_code`(`policy_code`),
    PRIMARY KEY (`services_payment_policy_id`)
) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- CreateTable
CREATE TABLE `services_provider` (
    `services_provider_id` INTEGER NOT NULL AUTO_INCREMENT,
    `services_id` INTEGER NULL,
    `services_provider` VARCHAR(255) NULL,
    `details` LONGTEXT NULL,
    `position` INTEGER NULL,
    `is_active` INTEGER NULL DEFAULT 1,
    `created` VARCHAR(40) NULL,
    `modified` VARCHAR(40) NULL,
    `creator` INTEGER NULL,
    `modifier` INTEGER NULL,

    PRIMARY KEY (`services_provider_id`)
) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- CreateTable
CREATE TABLE `settings` (
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `setting` VARCHAR(1000) NULL,
    `value` MEDIUMTEXT NULL,
    `image` VARCHAR(250) NULL,
    `is_key` INTEGER NULL DEFAULT 1,
    `modified` VARCHAR(500) NULL,
    `creator` VARCHAR(250) NULL,
    `modifier` VARCHAR(100) NULL,
    `created` VARCHAR(1000) NULL,

    PRIMARY KEY (`id`)
) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- CreateTable
CREATE TABLE `settings_tools` (
    `settings_tools_id` INTEGER NOT NULL AUTO_INCREMENT,
    `settings_tools` VARCHAR(250) NULL,
    `link` VARCHAR(500) NULL,
    `details` VARCHAR(250) NULL DEFAULT '0',
    `modified` VARCHAR(500) NULL,
    `creator` VARCHAR(250) NULL,
    `modifier` VARCHAR(100) NULL,
    `created` VARCHAR(250) NULL,
    `logo` VARCHAR(250) NULL,
    `is_active` INTEGER NOT NULL DEFAULT 1,
    `is_key` INTEGER NOT NULL DEFAULT 1,

    PRIMARY KEY (`settings_tools_id`)
) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- CreateTable
CREATE TABLE `tbl_users` (
    `userID` INTEGER NOT NULL AUTO_INCREMENT,
    `userName` VARCHAR(255) NULL,
    `access_client` VARCHAR(100) NULL,
    `branch_code` VARCHAR(20) NULL,
    `userPass` VARCHAR(200) NULL,
    `firstName` VARCHAR(255) NULL,
    `lastName` VARCHAR(50) NULL,
    `address` VARCHAR(255) NULL,
    `userEmail` VARCHAR(255) NULL,
    `userPhone` VARCHAR(15) NULL,
    `mobile` VARCHAR(100) NULL,
    `userType` INTEGER NULL,
    `create_date` INTEGER NULL,
    `userStatus_` ENUM('Y', 'N') NULL DEFAULT 'N',
    `is_key` INTEGER NULL DEFAULT 0,
    `tokenCode` VARCHAR(100) NULL,
    `image` VARCHAR(250) NULL DEFAULT 'default.png',
    `modified` VARCHAR(500) NULL,
    `creator` VARCHAR(250) NULL,
    `modifier` VARCHAR(100) NULL,
    `created` VARCHAR(250) NULL,
    `tender_books` VARCHAR(250) NULL,

    UNIQUE INDEX `user_name`(`userName`),
    PRIMARY KEY (`userID`)
) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- CreateTable
CREATE TABLE `tbl_users_groups` (
    `groups_id` INTEGER NOT NULL AUTO_INCREMENT,
    `groups` VARCHAR(250) NULL,
    `position` VARCHAR(250) NULL,
    `is_key` VARCHAR(250) NULL DEFAULT '1',
    `created` VARCHAR(250) NULL,
    `modified` VARCHAR(500) NULL,
    `creator` VARCHAR(250) NULL,
    `modifier` VARCHAR(100) NULL,

    PRIMARY KEY (`groups_id`)
) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- CreateTable
CREATE TABLE `tbl_users_notification` (
    `notification_id` INTEGER NOT NULL AUTO_INCREMENT,
    `userID` VARCHAR(250) NULL,
    `forUser` VARCHAR(250) NULL,
    `message` VARCHAR(1000) NULL,
    `is_key` VARCHAR(250) NULL DEFAULT '1',
    `created` VARCHAR(250) NULL,
    `modified` VARCHAR(500) NULL,
    `creator` VARCHAR(250) NULL,
    `modifier` VARCHAR(100) NULL,

    PRIMARY KEY (`notification_id`)
) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- CreateTable
CREATE TABLE `tbl_users_permission` (
    `tbl_users_permission_id` INTEGER NOT NULL AUTO_INCREMENT,
    `userType` VARCHAR(250) NULL,
    `tables` VARCHAR(250) NULL,
    `alls` VARCHAR(250) NULL DEFAULT '0',
    `updates` VARCHAR(250) NULL DEFAULT '0',
    `inserts` VARCHAR(250) NULL DEFAULT '0',
    `deletes` VARCHAR(250) NULL DEFAULT '0',
    `view` VARCHAR(250) NULL,
    `created` VARCHAR(250) NULL,
    `modified` VARCHAR(500) NULL,
    `creator` VARCHAR(250) NULL,
    `modifier` VARCHAR(100) NULL,

    PRIMARY KEY (`tbl_users_permission_id`)
) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- CreateTable
CREATE TABLE `tbl_users_subgroups` (
    `subgroups_id` INTEGER NOT NULL AUTO_INCREMENT,
    `subgroups` VARCHAR(250) NULL,
    `position` VARCHAR(250) NULL,
    `is_key` VARCHAR(250) NULL DEFAULT '1',
    `icon` VARCHAR(2000) NULL,
    `created` VARCHAR(250) NULL,
    `modified` VARCHAR(500) NULL,
    `creator` VARCHAR(250) NULL,
    `modifier` VARCHAR(100) NULL,
    `groups` VARCHAR(250) NULL,

    PRIMARY KEY (`subgroups_id`)
) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- CreateTable
CREATE TABLE `tbl_users_submenu` (
    `submenu_id` INTEGER NOT NULL AUTO_INCREMENT,
    `mainmenu` VARCHAR(250) NULL,
    `submenu` VARCHAR(2500) NULL,
    `tables` VARCHAR(250) NULL,
    `is_key` VARCHAR(250) NULL DEFAULT '1',
    `is_operational` INTEGER NULL DEFAULT 1,
    `created` VARCHAR(250) NULL,
    `modified` VARCHAR(500) NULL,
    `creator` VARCHAR(250) NULL,
    `modifier` VARCHAR(100) NULL,
    `groups_id` VARCHAR(250) NULL,
    `subgroups` VARCHAR(250) NULL,
    `function_name` VARCHAR(250) NULL,
    `capital` VARCHAR(250) NULL,
    `small` VARCHAR(250) NULL,
    `position` VARCHAR(250) NULL,
    `icon` VARCHAR(1000) NULL,

    PRIMARY KEY (`submenu_id`)
) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- CreateTable
CREATE TABLE `tbl_users_userStatus` (
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `userStatus_id` VARCHAR(250) NULL,
    `userStatus` VARCHAR(250) NULL,
    `permission` VARCHAR(1000) NULL,
    `is_key` VARCHAR(250) NULL DEFAULT '1',
    `created` VARCHAR(250) NULL,
    `modified` VARCHAR(500) NULL,
    `creator` VARCHAR(250) NULL,
    `modifier` VARCHAR(100) NULL,

    PRIMARY KEY (`id`)
) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- CreateTable
CREATE TABLE `tbl_users_userType` (
    `userType_id` INTEGER NOT NULL AUTO_INCREMENT,
    `userType` VARCHAR(250) NULL,
    `permission` VARCHAR(1000) NULL,
    `is_key` VARCHAR(250) NULL DEFAULT '1',
    `created` VARCHAR(250) NULL,
    `modified` VARCHAR(500) NULL,
    `creator` VARCHAR(250) NULL,
    `modifier` VARCHAR(100) NULL,

    PRIMARY KEY (`userType_id`)
) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- CreateTable
CREATE TABLE `tiny_template` (
    `tiny_template_id` INTEGER NOT NULL AUTO_INCREMENT,
    `tiny_template` VARCHAR(250) NULL,
    `description` VARCHAR(500) NULL,
    `content` LONGTEXT NULL,
    `position` VARCHAR(250) NULL,
    `is_key` VARCHAR(250) NULL DEFAULT '1',
    `created_by` VARCHAR(250) NULL,
    `approved_by` VARCHAR(250) NULL,
    `created` VARCHAR(250) NULL,
    `modified` VARCHAR(500) NULL,
    `creator` VARCHAR(250) NULL,
    `modifier` VARCHAR(100) NULL,

    PRIMARY KEY (`tiny_template_id`)
) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- CreateTable
CREATE TABLE `zone_districts` (
    `zone_districts_id` INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
    `zone_divisions_id` INTEGER UNSIGNED NOT NULL,
    `zone_districts` VARCHAR(30) NOT NULL,
    `zone_districts_bn` VARCHAR(50) NULL,
    `lat` DOUBLE NULL,
    `lon` DOUBLE NULL,
    `website` VARCHAR(100) NULL,
    `created_at` TIMESTAMP(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0),
    `updated_at` TIMESTAMP(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0),
    `position` INTEGER NULL,
    `is_active` INTEGER NULL DEFAULT 1,
    `created` VARCHAR(40) NULL,
    `modified` VARCHAR(40) NULL,
    `creator` INTEGER NULL,
    `modifier` INTEGER NULL,

    PRIMARY KEY (`zone_districts_id`)
) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- CreateTable
CREATE TABLE `zone_divisions` (
    `zone_divisions_id` INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
    `zone_divisions` VARCHAR(30) NOT NULL,
    `zone_divisions_bn` VARCHAR(50) NOT NULL,
    `created_at` TIMESTAMP(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0),
    `updated_at` TIMESTAMP(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0),
    `position` INTEGER NULL,
    `is_active` INTEGER NULL DEFAULT 1,
    `created` VARCHAR(40) NULL,
    `modified` VARCHAR(40) NULL,
    `creator` INTEGER NULL,
    `modifier` INTEGER NULL,

    PRIMARY KEY (`zone_divisions_id`)
) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- CreateTable
CREATE TABLE `zone_upazilas` (
    `zone_upazilas_id` INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
    `zone_districts_id` INTEGER UNSIGNED NOT NULL,
    `zone_upazilas` VARCHAR(30) NOT NULL,
    `zone_upazilas_bn` VARCHAR(50) NULL,
    `created_at` TIMESTAMP(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0),
    `updated_at` TIMESTAMP(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0),
    `position` INTEGER NULL,
    `is_active` INTEGER NULL DEFAULT 1,
    `created` VARCHAR(40) NULL,
    `modified` VARCHAR(40) NULL,
    `creator` INTEGER NULL,
    `modifier` INTEGER NULL,

    PRIMARY KEY (`zone_upazilas_id`)
) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
