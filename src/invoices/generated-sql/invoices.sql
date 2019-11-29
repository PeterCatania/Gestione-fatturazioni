
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

-- ---------------------------------------------------------------------
-- administrator
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `administrator`;

CREATE TABLE `administrator`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `username` VARCHAR(50) NOT NULL,
    `password` CHAR(64) NOT NULL,
    `email` VARCHAR(100) NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- city
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `city`;

CREATE TABLE `city`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(50) NOT NULL,
    `nap` INTEGER NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- client
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `client`;

CREATE TABLE `client`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(50) NOT NULL,
    `surname` VARCHAR(50) NOT NULL,
    `street` VARCHAR(100) NOT NULL,
    `house_no` VARCHAR(6) NOT NULL,
    `telephone` VARCHAR(16) NOT NULL,
    `email` VARCHAR(100) NOT NULL,
    `city_id` INTEGER NOT NULL,
    PRIMARY KEY (`id`),
    INDEX `client_fi_48ce03` (`city_id`),
    CONSTRAINT `client_fk_48ce03`
        FOREIGN KEY (`city_id`)
        REFERENCES `city` (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- client_company
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `client_company`;

CREATE TABLE `client_company`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(50) NOT NULL,
    `client_id` INTEGER NOT NULL,
    PRIMARY KEY (`id`),
    INDEX `client_company_fi_90166c` (`client_id`),
    CONSTRAINT `client_company_fk_90166c`
        FOREIGN KEY (`client_id`)
        REFERENCES `client` (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- company
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `company`;

CREATE TABLE `company`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(50) NOT NULL,
    `logo_path` VARCHAR(100) NOT NULL,
    `iban` VARCHAR(30) NOT NULL,
    `street` VARCHAR(100) NOT NULL,
    `house_no` VARCHAR(6) NOT NULL,
    `email` VARCHAR(100) NOT NULL,
    `site` VARCHAR(100) NOT NULL,
    `telefone` VARCHAR(16) NOT NULL,
    `city_id` INTEGER NOT NULL,
    PRIMARY KEY (`id`),
    INDEX `company_fi_48ce03` (`city_id`),
    CONSTRAINT `company_fk_48ce03`
        FOREIGN KEY (`city_id`)
        REFERENCES `city` (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- inserted
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `inserted`;

CREATE TABLE `inserted`
(
    `product_id` INTEGER NOT NULL,
    `invoice_id` INTEGER NOT NULL,
    `sell_date` DATE NOT NULL,
    `quantity` INTEGER NOT NULL,
    PRIMARY KEY (`product_id`,`invoice_id`),
    INDEX `inserted_fi_6b0388` (`invoice_id`),
    CONSTRAINT `inserted_fk_0f5ed8`
        FOREIGN KEY (`product_id`)
        REFERENCES `product` (`id`),
    CONSTRAINT `inserted_fk_6b0388`
        FOREIGN KEY (`invoice_id`)
        REFERENCES `invoice` (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- invoice
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `invoice`;

CREATE TABLE `invoice`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `print_no` INTEGER NOT NULL,
    `payment_date` DATE NOT NULL,
    `creation_date` DATE NOT NULL,
    `status` VARCHAR(7) NOT NULL,
    `callback` TINYINT NOT NULL,
    `client_id` INTEGER NOT NULL,
    `typology_id` INTEGER NOT NULL,
    PRIMARY KEY (`id`),
    INDEX `invoice_fi_90166c` (`client_id`),
    INDEX `invoice_fi_3ac5b3` (`typology_id`),
    CONSTRAINT `invoice_fk_90166c`
        FOREIGN KEY (`client_id`)
        REFERENCES `client` (`id`),
    CONSTRAINT `invoice_fk_3ac5b3`
        FOREIGN KEY (`typology_id`)
        REFERENCES `typology` (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- product
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `product`;

CREATE TABLE `product`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `description` VARCHAR(100) NOT NULL,
    `price` DECIMAL(19,2) NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- typology
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `typology`;

CREATE TABLE `typology`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(50) NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- user
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `username` VARCHAR(50) NOT NULL,
    `password` CHAR(64) NOT NULL,
    `email` VARCHAR(100) NOT NULL,
    `enabled` TINYINT NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
