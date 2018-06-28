
SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------

-- -----------------------------------------------------

-- -----------------------------------------------------
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `mydb` DEFAULT CHARACTER SET utf8 COLLATE = utf8_general_ci ;
USE `mydb` ;

-- -----------------------------------------------------
-- Table `mydb`.`usuarios`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`usuarios` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(45) NULL,
  `login` VARCHAR(45) NULL,
  `senha` VARCHAR(255) NULL,
  `dataNascimento` DATE NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `login_UNIQUE` (`login` ASC))
ENGINE = InnoDB;

 
-- -----------------------------------------------------
-- Table `mydb`.`gibis`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`gibis` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `titulo` VARCHAR(45) NULL,
  `editora` VARCHAR(45) NULL,
  `numero` INT NULL,
  `preco` DECIMAL(10,2) NULL,
  `quantidade` INT NULL,
  `usuarios_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_gibis_usuarios1_idx` (`usuarios_id` ASC),
  CONSTRAINT `fk_gibis_usuarios1`
    FOREIGN KEY (`usuarios_id`)
    REFERENCES `mydb`.`usuarios` (`id`)
    ON DELETE cascade
    ON UPDATE cascade)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`tags`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`tags` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `tags` VARCHAR(45) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`tags_has_gibis`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`tags_has_gibis` (
  `tags_id` INT NOT NULL,
  `gibis_id` INT NOT NULL,
  PRIMARY KEY (`tags_id`, `gibis_id`),
  INDEX `fk_tags_has_gibis_gibis1_idx` (`gibis_id` ASC),
  INDEX `fk_tags_has_gibis_tags1_idx` (`tags_id` ASC),
  CONSTRAINT `fk_tags_has_gibis_tags1`
    FOREIGN KEY (`tags_id`)
    REFERENCES `mydb`.`tags` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_tags_has_gibis_gibis1`
    FOREIGN KEY (`gibis_id`)
    REFERENCES `mydb`.`gibis` (`id`)
    ON DELETE cascade
    ON UPDATE cascade)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`comprar`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`comprar` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `data` DATE NULL,
  `usuarios_id` INT NOT NULL,
  `valorTotal` DECIMAL(10,2) NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_comprar_usuarios1_idx` (`usuarios_id` ASC),
  CONSTRAINT `fk_comprar_usuarios1`
    FOREIGN KEY (`usuarios_id`)
    REFERENCES `mydb`.`usuarios` (`id`)
    ON DELETE cascade
    ON UPDATE cascade)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`carrinho`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`carrinho` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `comprar_id` INT NOT NULL,
  `gibis_id` INT NOT NULL,
  `valorGibi` DECIMAL(10,2) NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_carrinho_comprar1_idx` (`comprar_id` ASC),
  INDEX `fk_carrinho_gibis1_idx` (`gibis_id` ASC),
  CONSTRAINT `fk_carrinho_comprar1`
    FOREIGN KEY (`comprar_id`)
    REFERENCES `mydb`.`comprar` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_carrinho_gibis1`
    FOREIGN KEY (`gibis_id`)
    REFERENCES `mydb`.`gibis` (`id`)
    ON DELETE cascade
    ON UPDATE cascade)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;