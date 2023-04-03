-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
-- -----------------------------------------------------
-- Schema workforce-register
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema workforce-register
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `workforce-register` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci ;
USE `workforce-register` ;

-- -----------------------------------------------------
-- Table `workforce-register`.`departments`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `workforce-register`.`departments` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 10
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


-- -----------------------------------------------------
-- Table `workforce-register`.`positions`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `workforce-register`.`positions` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) NOT NULL,
  `description` VARCHAR(4000) NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 8
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


-- -----------------------------------------------------
-- Table `workforce-register`.`workers`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `workforce-register`.`workers` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `pos_id` INT NOT NULL,
  `dep_id` INT NOT NULL,
  `name` VARCHAR(255) NOT NULL,
  `grosswage` INT NULL DEFAULT 0,
  `taxid` VARCHAR(10) NOT NULL,
  `socsecnum` VARCHAR(9) NOT NULL,
  `bankaccnum` VARCHAR(255) NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  INDEX `pos_id` (`pos_id` ASC) VISIBLE,
  INDEX `dep_id` (`dep_id` ASC) VISIBLE,
  CONSTRAINT `workers_ibfk_1`
    FOREIGN KEY (`pos_id`)
    REFERENCES `workforce-register`.`positions` (`id`),
  CONSTRAINT `workers_ibfk_2`
    FOREIGN KEY (`dep_id`)
    REFERENCES `workforce-register`.`departments` (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

