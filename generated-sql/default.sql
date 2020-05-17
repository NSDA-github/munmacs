
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

-- ---------------------------------------------------------------------
-- admin
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `admin`;

CREATE TABLE `admin`
(
    `admin_id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
    `username` VARCHAR(50) NOT NULL,
    `password` VARCHAR(255) NOT NULL,
    `access_level` tinyint(2) unsigned DEFAULT 1 NOT NULL,
    PRIMARY KEY (`admin_id`),
    UNIQUE INDEX `username` (`username`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- country
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `country`;

CREATE TABLE `country`
(
    `country_id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
    `country_name` VARCHAR(90) NOT NULL,
    PRIMARY KEY (`country_id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- occupation
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `occupation`;

CREATE TABLE `occupation`
(
    `occupation_id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
    `occupation_name` VARCHAR(15) NOT NULL,
    PRIMARY KEY (`occupation_id`),
    UNIQUE INDEX `occupation_name` (`occupation_name`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- registrant
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `registrant`;

CREATE TABLE `registrant`
(
    `registrant_id` smallint(4) unsigned NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(50) NOT NULL,
    `surname` VARCHAR(50) NOT NULL,
    `email` VARCHAR(80) NOT NULL,
    `phone` VARCHAR(12) NOT NULL,
    `discord` VARCHAR(255),
    `institution` VARCHAR(255) NOT NULL,
    PRIMARY KEY (`registrant_id`),
    INDEX `surname` (`surname`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- registrant_event
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `registrant_event`;

CREATE TABLE `registrant_event`
(
    `registrant_id` smallint(4) unsigned NOT NULL,
    `topic_id` tinyint(3) unsigned NOT NULL,
    `country_id` tinyint(3) unsigned NOT NULL,
    `country_desired` tinyint(3) unsigned,
    `registration_time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `approved` TINYINT(1) DEFAULT 0 NOT NULL,
    `approved_time` DATETIME,
    `local` TINYINT(1),
    `has_attended` TINYINT(1),
    PRIMARY KEY (`registrant_id`),
    UNIQUE INDEX `topic_id` (`topic_id`, `country_id`),
    INDEX `country_id` (`country_id`),
    INDEX `country_desired` (`country_desired`),
    CONSTRAINT `registrant_event_ibfk_1`
        FOREIGN KEY (`country_id`)
        REFERENCES `country` (`country_id`),
    CONSTRAINT `registrant_event_ibfk_2`
        FOREIGN KEY (`registrant_id`)
        REFERENCES `registrant` (`registrant_id`),
    CONSTRAINT `registrant_event_ibfk_3`
        FOREIGN KEY (`topic_id`)
        REFERENCES `topic` (`topic_id`),
    CONSTRAINT `registrant_event_ibfk_4`
        FOREIGN KEY (`country_desired`)
        REFERENCES `country` (`country_id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- registrant_occupation
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `registrant_occupation`;

CREATE TABLE `registrant_occupation`
(
    `registrant_id` smallint(4) unsigned NOT NULL,
    `occupation_id` tinyint(3) unsigned NOT NULL,
    PRIMARY KEY (`registrant_id`),
    INDEX `occupation_id` (`occupation_id`),
    CONSTRAINT `registrant_occupation_ibfk_1`
        FOREIGN KEY (`registrant_id`)
        REFERENCES `registrant` (`registrant_id`),
    CONSTRAINT `registrant_occupation_ibfk_2`
        FOREIGN KEY (`occupation_id`)
        REFERENCES `occupation` (`occupation_id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- registrant_school_student
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `registrant_school_student`;

CREATE TABLE `registrant_school_student`
(
    `registrant_id` smallint(4) unsigned NOT NULL,
    `grade` TINYINT(2),
    `grade_letter` CHAR,
    PRIMARY KEY (`registrant_id`),
    CONSTRAINT `registrant_school_student_ibfk_1`
        FOREIGN KEY (`registrant_id`)
        REFERENCES `registrant` (`registrant_id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- registrant_student
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `registrant_student`;

CREATE TABLE `registrant_student`
(
    `registrant_id` smallint(4) unsigned NOT NULL,
    `major_name` VARCHAR(40),
    PRIMARY KEY (`registrant_id`),
    CONSTRAINT `registrant_student_ibfk_1`
        FOREIGN KEY (`registrant_id`)
        REFERENCES `registrant` (`registrant_id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- registrant_teacher
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `registrant_teacher`;

CREATE TABLE `registrant_teacher`
(
    `registrant_id` smallint(4) unsigned NOT NULL,
    `subject` VARCHAR(40),
    PRIMARY KEY (`registrant_id`),
    CONSTRAINT `registrant_teacher_ibfk_1`
        FOREIGN KEY (`registrant_id`)
        REFERENCES `registrant` (`registrant_id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- topic
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `topic`;

CREATE TABLE `topic`
(
    `topic_id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
    `topic_name` VARCHAR(50) NOT NULL,
    `max_participants` smallint(4) unsigned NOT NULL,
    `close_date` DATE NOT NULL,
    PRIMARY KEY (`topic_id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- topic_country
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `topic_country`;

CREATE TABLE `topic_country`
(
    `topic_id` tinyint(3) unsigned NOT NULL,
    `country_id` tinyint(3) unsigned NOT NULL,
    `available` TINYINT(1) DEFAULT 1 NOT NULL,
    `reserved` smallint(4) unsigned DEFAULT 0 NOT NULL,
    PRIMARY KEY (`topic_id`,`country_id`),
    INDEX `country_id` (`country_id`),
    INDEX `reserved` (`reserved`),
    CONSTRAINT `topic_country_ibfk_1`
        FOREIGN KEY (`topic_id`)
        REFERENCES `topic` (`topic_id`),
    CONSTRAINT `topic_country_ibfk_2`
        FOREIGN KEY (`country_id`)
        REFERENCES `country` (`country_id`)
) ENGINE=InnoDB;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
