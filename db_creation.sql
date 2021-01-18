-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema film_db
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema film_db
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `film_db` DEFAULT CHARACTER SET utf8 ;
USE `film_db` ;

-- -----------------------------------------------------
-- Table `film_db`.`production_company`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `film_db`.`production_company` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `film_db`.`film`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `film_db`.`film` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(256) NOT NULL,
  `release_date` DATE NOT NULL,
  `production_company_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_film_production_company_idx` (`production_company_id` ASC),
  CONSTRAINT `fk_film_production_company`
    FOREIGN KEY (`production_company_id`)
    REFERENCES `film_db`.`production_company` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `film_db`.`country`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `film_db`.`country` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(64) NULL,
  `countrycol` VARCHAR(45) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `film_db`.`actors`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `film_db`.`actors` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `first_name` VARCHAR(64) NULL,
  `last_name` VARCHAR(64) NULL,
  `actorscol` VARCHAR(45) NULL,
  `country_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_actors_country1_idx` (`country_id` ASC),
  CONSTRAINT `fk_actors_country1`
    FOREIGN KEY (`country_id`)
    REFERENCES `film_db`.`country` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `film_db`.`film_actors`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `film_db`.`film_actors` (
  `film_id` INT NOT NULL,
  `actors_id` INT NOT NULL,
  INDEX `fk_film_actors_film1_idx` (`film_id` ASC),
  INDEX `fk_film_actors_actors1_idx` (`actors_id` ASC),
  CONSTRAINT `fk_film_actors_film1`
    FOREIGN KEY (`film_id`)
    REFERENCES `film_db`.`film` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_film_actors_actors1`
    FOREIGN KEY (`actors_id`)
    REFERENCES `film_db`.`actors` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
