SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

DROP SCHEMA IF EXISTS `turismoxela` ;
CREATE SCHEMA IF NOT EXISTS `turismoxela` DEFAULT CHARACTER SET utf8 COLLATE utf8_bin ;
USE `turismoxela` ;

-- -----------------------------------------------------
-- Table `turismoxela`.`usuarios`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `turismoxela`.`usuarios` ;

CREATE TABLE IF NOT EXISTS `turismoxela`.`usuarios` (
  `idusuarios` INT NOT NULL AUTO_INCREMENT,
  `usuario_cuenta` VARCHAR(15) NULL,
  `usuario_nombre` VARCHAR(75) NULL,
  `nivel` ENUM('U','A') NULL DEFAULT 'U' COMMENT 'U=Usuario, A=Administrador',
  `clave` VARCHAR(50) NULL,
  PRIMARY KEY (`idusuarios`))
ENGINE = InnoDB;

CREATE UNIQUE INDEX `usuario_cuenta_UNIQUE` ON `turismoxela`.`usuarios` (`usuario_cuenta` ASC);


-- -----------------------------------------------------
-- Table `turismoxela`.`bitacora`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `turismoxela`.`bitacora` ;

CREATE TABLE IF NOT EXISTS `turismoxela`.`bitacora` (
  `idbitacora` INT NOT NULL AUTO_INCREMENT,
  `cuando` DATETIME NULL,
  `idusuarios` INT NULL,
  `operacion` ENUM('L','O','A','B','C') NULL COMMENT 'L=Login, O=Logout, A=Alta, B=Baja, C=Cambio\n',
  `dato` VARCHAR(512) NULL,
  PRIMARY KEY (`idbitacora`),
  CONSTRAINT `fk_bitacora_1`
    FOREIGN KEY (`idusuarios`)
    REFERENCES `turismoxela`.`usuarios` (`idusuarios`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE UNIQUE INDEX `cuando_UNIQUE` ON `turismoxela`.`bitacora` (`cuando` ASC);

CREATE INDEX `fk_bitacora_1_idx` ON `turismoxela`.`bitacora` (`idusuarios` ASC);


-- -----------------------------------------------------
-- Table `turismoxela`.`sitios`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `turismoxela`.`sitios` ;

CREATE TABLE IF NOT EXISTS `turismoxela`.`sitios` (
  `idsitios` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(50) NULL,
  `ubicacion` VARCHAR(60) NULL,
  `descripcion` VARCHAR(255) NULL,
  `historia` TEXT NULL,
  `coordenadas` VARCHAR(45) NULL,
  PRIMARY KEY (`idsitios`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `turismoxela`.`fotografias`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `turismoxela`.`fotografias` ;

CREATE TABLE IF NOT EXISTS `turismoxela`.`fotografias` (
  `idfotografias` INT NOT NULL AUTO_INCREMENT,
  `idsitios` INT NULL,
  `path` VARCHAR(45) NULL,
  `descripcion` VARCHAR(255) NULL,
  PRIMARY KEY (`idfotografias`),
  CONSTRAINT `fk_fotografias_1`
    FOREIGN KEY (`idsitios`)
    REFERENCES `turismoxela`.`sitios` (`idsitios`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `fk_fotografias_1_idx` ON `turismoxela`.`fotografias` (`idsitios` ASC);


-- -----------------------------------------------------
-- Table `turismoxela`.`noticias`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `turismoxela`.`noticias` ;

CREATE TABLE IF NOT EXISTS `turismoxela`.`noticias` (
  `idnoticias` INT NOT NULL AUTO_INCREMENT,
  `idusuarios` INT NULL,
  `fecha` DATE NULL,
  `titulo` VARCHAR(50) NULL,
  `contenido` TEXT NULL,
  `idfotografias` VARCHAR(20) NULL,
  `aprobado` TINYINT(1) NULL,
  PRIMARY KEY (`idnoticias`),
  CONSTRAINT `fk_noticias_1`
    FOREIGN KEY (`idusuarios`)
    REFERENCES `turismoxela`.`usuarios` (`idusuarios`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `fk_noticias_1_idx` ON `turismoxela`.`noticias` (`idusuarios` ASC);


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
