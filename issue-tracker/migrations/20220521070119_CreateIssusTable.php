<?php

use Phpmig\Migration\Migration;

class CreateIssusTable extends Migration
{
    /**
     * Do the migration
     */
    public function up()
    {
        $sql = "
        CREATE TABLE `issues` (
            `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
            `title` VARCHAR(255) NOT NULL COLLATE 'utf8mb4_0900_ai_ci',
            `email` VARCHAR(255) NOT NULL COLLATE 'utf8mb4_0900_ai_ci',
            `name` VARCHAR(255) NOT NULL COLLATE 'utf8mb4_0900_ai_ci',
            `status` CHAR(50) NOT NULL DEFAULT '1' COLLATE 'utf8mb4_0900_ai_ci',
            `description` TEXT NULL DEFAULT NULL COLLATE 'utf8mb4_0900_ai_ci',
            `updated_by` INT(10) UNSIGNED NULL DEFAULT NULL,
            PRIMARY KEY (`id`) USING BTREE,
            INDEX `issues_user_fk` (`updated_by`) USING BTREE,
            CONSTRAINT `issues_user_fk` FOREIGN KEY (`updated_by`) REFERENCES `tracker`.`users` (`id`) ON UPDATE NO ACTION ON DELETE NO ACTION
        )
        COLLATE='utf8mb4_0900_ai_ci'
        ENGINE=InnoDB;
        ";
        $container = $this->getContainer();
        $container['db']->query($sql);
    }

    /**
     * Undo the migration
     */
    public function down()
    {
        $sql = "DROP TABLE IF EXISTS issues";
        $container = $this->getContainer();
        $container['db']->query($sql);
    }
}
