CREATE OR REPLACE TABLE `Users` (
  `id` INTEGER NOT NULL AUTO_INCREMENT UNIQUE,
  `Firstname` VARCHAR(255) NOT NULL,
  `Lastname` VARCHAR(255) NOT NULL,
  `Email` VARCHAR(255) NOT NULL,
  `Password` VARCHAR(255) NOT NULL,
  `Info` TEXT,
  PRIMARY KEY(`id`)
);

CREATE INDEX `User_Index_Mail` 
ON `Users` (`Email`);

CREATE TABLE `Projects` (
  `id` INTEGER NOT NULL AUTO_INCREMENT UNIQUE,
  `Name` VARCHAR(255) NOT NULL,
  `Creator` INTEGER NOT NULL,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`Creator`) REFERENCES Users(`id`) ON DELETE CASCADE
);

CREATE TABLE `Tasks` (
  `id` INTEGER NOT NULL AUTO_INCREMENT UNIQUE,
  `Name` VARCHAR(255) NOT NULL,
  `Creation` DATE NOT NULL,
  `Due` DATE,
  `Recurrency` SMALLINT,
  `Done` BOOLEAN NOT NULL DEFAULT FALSE,
  `Notes` TEXT,
  `Project` INTEGER NOT NULL,
  PRIMARY KEY (`id`),
  FOREIGN KEY(`Project`) REFERENCES Projects(`id`) ON DELETE CASCADE
);

