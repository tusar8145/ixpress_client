-- AddForeignKey
ALTER TABLE `pickup` ADD CONSTRAINT `pickup_created_branch_id_fkey` FOREIGN KEY (`created_branch_id`) REFERENCES `branch`(`branch_id`) ON DELETE RESTRICT ON UPDATE CASCADE;

-- AddForeignKey
ALTER TABLE `pickup` ADD CONSTRAINT `pickup_creator_fkey` FOREIGN KEY (`creator`) REFERENCES `tbl_users`(`userID`) ON DELETE RESTRICT ON UPDATE CASCADE;
