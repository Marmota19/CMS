-- MySQL Script generated by MySQL Workbench
-- 01/24/17 01:23:18
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema mcortes
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema mcortes
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `mcortes` DEFAULT CHARACTER SET utf8 ;
USE `mcortes` ;

-- -----------------------------------------------------
-- Table `mcortes`.`course`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mcortes`.`course` (
  `courseId` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(128) NOT NULL,
  `code` VARCHAR(45) NOT NULL,
  `teacher` VARCHAR(128) NULL DEFAULT NULL,
  `schedule` VARCHAR(128) NULL DEFAULT NULL,
  PRIMARY KEY (`courseId`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mcortes`.`methodology`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mcortes`.`methodology` (
  `methodologyId` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(128) NOT NULL,
  PRIMARY KEY (`methodologyId`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mcortes`.`projectType`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mcortes`.`projectType` (
  `projectTypeId` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(128) NOT NULL,
  PRIMARY KEY (`projectTypeId`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mcortes`.`project`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mcortes`.`project` (
  `projectId` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(128) NOT NULL,
  `summary` TEXT NULL DEFAULT NULL,
  `technology` TEXT NULL DEFAULT NULL,
  `methodologyId` INT NOT NULL,
  `projectTypeId` INT NOT NULL,
  `courseId` INT NOT NULL,
  `peopleAmount` INT NULL DEFAULT NULL,
  `role` VARCHAR(128) NULL DEFAULT NULL,
  PRIMARY KEY (`projectId`),
  INDEX `fk_project_methodology1_idx` (`methodologyId` ASC),
  INDEX `fk_project_projectType1_idx` (`projectTypeId` ASC),
  INDEX `fk_project_course1_idx` (`courseId` ASC),
  CONSTRAINT `fk_project_methodology1`
    FOREIGN KEY (`methodologyId`)
    REFERENCES `mcortes`.`methodology` (`methodologyId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_project_projectType1`
    FOREIGN KEY (`projectTypeId`)
    REFERENCES `mcortes`.`projectType` (`projectTypeId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_project_course1`
    FOREIGN KEY (`courseId`)
    REFERENCES `mcortes`.`course` (`courseId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mcortes`.`technology`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mcortes`.`technology` (
  `technologyId` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(128) NOT NULL,
  PRIMARY KEY (`technologyId`))
ENGINE = InnoDB;




-- -----------------------------------------------------
-- Table `mcortes`.`image`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mcortes`.`image` (
  `imageId` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(128) NOT NULL,
  `url` VARCHAR(256) NOT NULL,
  `projectId` INT NOT NULL,
  PRIMARY KEY (`imageId`),
  INDEX `fk_image_project1_idx` (`projectId` ASC),
  CONSTRAINT `fk_image_project1`
    FOREIGN KEY (`projectId`)
    REFERENCES `mcortes`.`project` (`projectId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
