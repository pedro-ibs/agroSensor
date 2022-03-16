USE agrosensor;

CREATE TABLE `user` (
	`id` 		INT		NOT NULL AUTO_INCREMENT,
	`nickname` 	VARCHAR(80)	NOT NULL,
	`password`	VARCHAR(80)	NOT NULL,
	`first_name`	VARCHAR(30)	NOT NULL,
	`last_name`	VARCHAR(30)	NOT NULL,
	`type`		VARCHAR(10)	NOT NULL DEFAULT 'normal',

	PRIMARY KEY (`id`),
	UNIQUE KEY `password` (`password`)
);


CREATE TABLE `sensor` (
	`id`		INT		NOT NULL AUTO_INCREMENT,
	`name`		VARCHAR(20)	NOT NULL,
	`description`	VARCHAR(200)	NOT NULL,
	`mac_address`	VARCHAR(30)	NOT NULL,
	`lat`		VARCHAR(30)	NOT NULL,
	`lng`		VARCHAR(30)	NOT NULL,
	`vcc`		FLOAT		DEFAULT 000.00,
	`vbat`		FLOAT		DEFAULT 000.00,
	`last_measures` DATETIME	NOT NULL,
	`status`	INT		NOT NULL DEFAULT 0,
	
	PRIMARY KEY (`id`),
	UNIQUE KEY `mac_address` (`mac_address`)
);

CREATE TABLE `measures` (
	`id`		INT 		NOT NULL AUTO_INCREMENT,
	`id_sensor`	INT		NOT NULL,
	`timestamp` 	DATETIME 	NOT NULL,
	`payload` 	VARCHAR(40) 	NOT NULL,
	`topic` 	VARCHAR(100) 	NOT NULL,

	FOREIGN KEY (`id_sensor`) REFERENCES `sensor`(`id`),
	PRIMARY KEY (`id`)
);

INSERT INTO agrosensor.user (nickname, password, first_name, last_name, `type`)
	VALUES('admin', '21232f297a57a5a743894a0e4a801fc3', 'admin', 'admin', 'master');





