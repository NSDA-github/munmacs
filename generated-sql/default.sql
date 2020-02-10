
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

-- ---------------------------------------------------------------------
-- countries
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `countries`;

CREATE TABLE `countries`
(
    `country_id` INTEGER NOT NULL AUTO_INCREMENT,
    `country_name` VARCHAR(60) NOT NULL,
    `available` TINYINT(1) DEFAULT 1 NOT NULL,
    `reserved` TINYINT(1) DEFAULT 0 NOT NULL,
    PRIMARY KEY (`country_id`),
    UNIQUE INDEX `country_name` (`country_name`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- registrant_roles
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `registrant_roles`;

CREATE TABLE `registrant_roles`
(
    `registrant_id` INTEGER NOT NULL,
    `role_id` INTEGER NOT NULL,
    PRIMARY KEY (`registrant_id`,`role_id`),
    INDEX `role_id` (`role_id`),
    CONSTRAINT `registrant_roles_ibfk_1`
        FOREIGN KEY (`registrant_id`)
        REFERENCES `registrants` (`registrant_id`),
    CONSTRAINT `registrant_roles_ibfk_2`
        FOREIGN KEY (`role_id`)
        REFERENCES `roles` (`role_id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- registrants
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `registrants`;

CREATE TABLE `registrants`
(
    `registrant_id` INTEGER NOT NULL AUTO_INCREMENT,
    `institution` VARCHAR(40) NOT NULL,
    `email` VARCHAR(40) NOT NULL,
    `name` VARCHAR(30) NOT NULL,
    `surname` VARCHAR(30) NOT NULL,
    `tel` VARCHAR(17) NOT NULL,
    `country` INTEGER NOT NULL,
    `country_reserved` INTEGER,
    `last_update` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`registrant_id`),
    UNIQUE INDEX `country` (`country`),
    INDEX `registrants_ibfi_2` (`country_reserved`),
    CONSTRAINT `registrants_ibfk_1`
        FOREIGN KEY (`country`)
        REFERENCES `countries` (`country_id`),
    CONSTRAINT `registrants_ibfk_2`
        FOREIGN KEY (`country_reserved`)
        REFERENCES `countries` (`country_id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- roles
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `roles`;

CREATE TABLE `roles`
(
    `role_id` INTEGER NOT NULL AUTO_INCREMENT,
    `role_name` VARCHAR(15) NOT NULL,
    PRIMARY KEY (`role_id`),
    UNIQUE INDEX `role_name` (`role_name`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- students
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `students`;

CREATE TABLE `students`
(
    `registrant_id` INTEGER NOT NULL,
    `grade` TINYINT(2),
    `gradeletter` CHAR,
    PRIMARY KEY (`registrant_id`),
    CONSTRAINT `students_ibfk_1`
        FOREIGN KEY (`registrant_id`)
        REFERENCES `registrants` (`registrant_id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- teachers
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `teachers`;

CREATE TABLE `teachers`
(
    `registrant_id` INTEGER NOT NULL,
    `subject` VARCHAR(40),
    PRIMARY KEY (`registrant_id`),
    CONSTRAINT `teachers_ibfk_1`
        FOREIGN KEY (`registrant_id`)
        REFERENCES `registrants` (`registrant_id`)
) ENGINE=InnoDB;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
