-- MySQL Script generated by MySQL Workbench
-- Sun Jan 14 17:50:11 2018
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema magenda
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `magenda` ;

-- -----------------------------------------------------
-- Schema magenda
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `magenda` DEFAULT CHARACTER SET utf8 ;
USE `magenda` ;

-- -----------------------------------------------------
-- Table `magenda`.`company`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `magenda`.`company` ;

CREATE TABLE IF NOT EXISTS `magenda`.`company` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL,
  `description` VARCHAR(255) NULL,
  `phonenumber` VARCHAR(12) NULL,
  PRIMARY KEY (`id`))
  ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `magenda`.`user`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `magenda`.`user` ;

CREATE TABLE IF NOT EXISTS `magenda`.`user` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `firstname` VARCHAR(45) NOT NULL,
  `lastname` VARCHAR(45) NOT NULL,
  `email` VARCHAR(320) NOT NULL,
  `password` VARCHAR(40) NOT NULL,
  `phonenumber` VARCHAR(12) NULL,
  `datebirth` DATE NULL,
  `city` TEXT NULL,
  `postalcode` VARCHAR(5) NULL,
  `company_id` INT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_user_company_idx` (`company_id` ASC),
  CONSTRAINT `fk_user_company`
  FOREIGN KEY (`company_id`)
  REFERENCES `magenda`.`company` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
  ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `magenda`.`profession`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `magenda`.`profession` ;

CREATE TABLE IF NOT EXISTS `magenda`.`profession` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NULL,
  PRIMARY KEY (`id`))
  ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `magenda`.`event`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `magenda`.`event` ;

CREATE TABLE IF NOT EXISTS `magenda`.`event` (
  `id` INT NOT NULL,
  `startdatetime` DATETIME NOT NULL,
  `enddatetime` DATETIME NOT NULL,
  `company_id` INT NOT NULL,
  `price` FLOAT NOT NULL,
  `user_id` INT NULL,
  `promotion` FLOAT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  INDEX `fk_event_company1_idx` (`company_id` ASC),
  INDEX `fk_event_user1_idx` (`user_id` ASC),
  CONSTRAINT `fk_event_company1`
  FOREIGN KEY (`company_id`)
  REFERENCES `magenda`.`company` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_event_user1`
  FOREIGN KEY (`user_id`)
  REFERENCES `magenda`.`user` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
  ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `magenda`.`company_has_profession`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `magenda`.`company_has_profession` ;

CREATE TABLE IF NOT EXISTS `magenda`.`company_has_profession` (
  `company_id` INT NOT NULL,
  `profession_id` INT NOT NULL,
  PRIMARY KEY (`company_id`, `profession_id`),
  INDEX `fk_company_has_profession_profession1_idx` (`profession_id` ASC),
  INDEX `fk_company_has_profession_company1_idx` (`company_id` ASC),
  CONSTRAINT `fk_company_has_profession_company1`
  FOREIGN KEY (`company_id`)
  REFERENCES `magenda`.`company` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_company_has_profession_profession1`
  FOREIGN KEY (`profession_id`)
  REFERENCES `magenda`.`profession` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
  ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `magenda`.`favory`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `magenda`.`favory` ;

CREATE TABLE IF NOT EXISTS `magenda`.`favory` (
  `user_id` INT NOT NULL,
  `company_id` INT NOT NULL,
  PRIMARY KEY (`user_id`, `company_id`),
  INDEX `fk_user_has_company_company1_idx` (`company_id` ASC),
  INDEX `fk_user_has_company_user1_idx` (`user_id` ASC),
  CONSTRAINT `fk_user_has_company_user1`
  FOREIGN KEY (`user_id`)
  REFERENCES `magenda`.`user` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_user_has_company_company1`
  FOREIGN KEY (`company_id`)
  REFERENCES `magenda`.`company` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
  ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;