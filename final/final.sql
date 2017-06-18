-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
-- -----------------------------------------------------
-- Schema newspaper
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema newspaper
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `newspaper` DEFAULT CHARACTER SET utf8 ;
USE `newspaper` ;

-- -----------------------------------------------------
-- Table `newspaper`.`user`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `newspaper`.`user` ;

CREATE TABLE IF NOT EXISTS `newspaper`.`user` (
  `UserID` INT(11) NOT NULL AUTO_INCREMENT,
  `FirstName` VARCHAR(255) NULL DEFAULT NULL,
  `LastName` VARCHAR(255) NULL DEFAULT NULL,
  `Email` VARCHAR(255) NULL DEFAULT NULL,
  `Password` VARCHAR(45) NULL DEFAULT NULL,
  PRIMARY KEY (`UserID`),
  UNIQUE INDEX `userID_UNIQUE` (`UserID` ASC))
ENGINE = InnoDB
AUTO_INCREMENT = 4
DEFAULT CHARACTER SET = utf8
COMMENT = '	';


-- -----------------------------------------------------
-- Table `newspaper`.`article`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `newspaper`.`article` ;

CREATE TABLE IF NOT EXISTS `newspaper`.`article` (
  `ArticleID` INT(11) NOT NULL AUTO_INCREMENT,
  `Title` VARCHAR(255) NULL DEFAULT NULL,
  `Category` VARCHAR(45) NULL DEFAULT NULL,
  `UserID` INT(11) NULL DEFAULT NULL,
  `DatePost` DATETIME NULL DEFAULT NULL,
  `DateUpdate` TIMESTAMP NULL DEFAULT NULL,
  `Text` LONGTEXT NULL DEFAULT NULL,
  PRIMARY KEY (`ArticleID`),
  UNIQUE INDEX `ArticleID_UNIQUE` (`ArticleID` ASC),
  INDEX `AutorArticle_idx` (`UserID` ASC),
  CONSTRAINT `AutorArticle`
    FOREIGN KEY (`UserID`)
    REFERENCES `newspaper`.`user` (`UserID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COMMENT = '					';


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
