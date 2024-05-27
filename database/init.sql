DROP DATABASE IF EXISTS `cmc_db`;
CREATE DATABASE `cmc_db`
    CHARACTER SET utf8
    COLLATE utf8_general_ci;
USE `cmc_db`;

CREATE TABLE `partner` (
   `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
   `name` VARCHAR(255) UNIQUE NOT NULL,
   `baseUrl` VARCHAR(255) NOT NULL
) ENGINE = InnoDB;

CREATE TABLE `job` (
    `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `reference` VARCHAR(255),
    `title` VARCHAR(255),
    `description` TEXT,
    `url` VARCHAR(255),
    `company_name` VARCHAR(255),
    `publication` DATETIME,
    `partner_id` INT(10) UNSIGNED NOT NULL,
    CONSTRAINT `fk_job_partner`
        FOREIGN KEY(`partner_id`) REFERENCES `partner`(`id`)
            ON DELETE CASCADE
) ENGINE = InnoDB;
