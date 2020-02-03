SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

CREATE SCHEMA IF NOT EXISTS `bookstoredb` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci ;
USE `bookstoredb` ;

-- -----------------------------------------------------
-- Table `bookstoredb`.`users`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `bookstoredb`.`users` (
  `username` VARCHAR(80) NOT NULL ,
  `password` VARCHAR(300) NOT NULL ,
  PRIMARY KEY (`username`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bookstoredb`.`books`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `bookstoredb`.`books` (
  `ISBNno` VARCHAR(100) NOT NULL ,
  `Title` VARCHAR(200) NOT NULL ,
  `YearOfPublishing` MEDIUMTEXT NOT NULL ,
  `Price` DOUBLE NOT NULL ,
  `Medium` VARCHAR(50) NOT NULL ,
  `Image` VARCHAR(200) NULL ,
  PRIMARY KEY (`ISBNno`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bookstoredb`.`categories`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `bookstoredb`.`categories` (
  `name` VARCHAR(80) NOT NULL ,
  PRIMARY KEY (`name`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bookstoredb`.`authors`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `bookstoredb`.`authors` (
  `authorID` INT NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(80) NOT NULL ,
  `country` VARCHAR(45) NOT NULL ,
  PRIMARY KEY (`authorID`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bookstoredb`.`books_has_authors`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `bookstoredb`.`books_has_authors` (
  `book` VARCHAR(100) NOT NULL ,
  `author` INT NOT NULL ,
  PRIMARY KEY (`book`) ,
  INDEX `fk_books_has_authors_books_idx` (`book` ASC) ,
  INDEX `fk_books_has_authors_authors1_idx` (`author` ASC) ,
  CONSTRAINT `fk_books_has_authors_books`
    FOREIGN KEY (`book` )
    REFERENCES `bookstoredb`.`books` (`ISBNno` )
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_books_has_authors_authors1`
    FOREIGN KEY (`author` )
    REFERENCES `bookstoredb`.`authors` (`authorID` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bookstoredb`.`subcategories`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `bookstoredb`.`subcategories` (
  `name` VARCHAR(80) NOT NULL ,
  PRIMARY KEY (`name`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bookstoredb`.`book_has_categories`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `bookstoredb`.`book_has_categories` (
  `book` VARCHAR(100) NOT NULL ,
  `category` VARCHAR(80) NOT NULL ,
  `subcategory` VARCHAR(80) NOT NULL ,
  PRIMARY KEY (`book`) ,
  INDEX `fk_books_has_categories_categories1_idx` (`category` ASC) ,
  INDEX `fk_books_has_categories_books1_idx` (`book` ASC) ,
  INDEX `fk_books_has_categories_subcategories1_idx` (`subcategory` ASC) ,
  CONSTRAINT `fk_books_has_categories_books1`
    FOREIGN KEY (`book` )
    REFERENCES `bookstoredb`.`books` (`ISBNno` )
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_books_has_categories_categories1`
    FOREIGN KEY (`category` )
    REFERENCES `bookstoredb`.`categories` (`name` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_books_has_categories_subcategories1`
    FOREIGN KEY (`subcategory` )
    REFERENCES `bookstoredb`.`subcategories` (`name` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

USE `bookstoredb` ;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
