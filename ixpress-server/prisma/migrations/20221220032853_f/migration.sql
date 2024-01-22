-- AddForeignKey
ALTER TABLE `pickup` ADD CONSTRAINT `pickup_current_branch_id_fkey` FOREIGN KEY (`current_branch_id`) REFERENCES `branch`(`branch_id`) ON DELETE RESTRICT ON UPDATE CASCADE;
