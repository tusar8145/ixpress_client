-- AddForeignKey
ALTER TABLE `services_clients_issues_reply` ADD CONSTRAINT `services_clients_issues_reply_user_id_fkey` FOREIGN KEY (`user_id`) REFERENCES `tbl_users`(`userID`) ON DELETE RESTRICT ON UPDATE CASCADE;
