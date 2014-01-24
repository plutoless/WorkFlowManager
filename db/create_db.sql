DROP SCHEMA IF EXISTS workflowmanager; CREATE DATABASE workflowmanager  DEFAULT CHARACTER SET utf8  DEFAULT COLLATE utf8_general_ci;USE workflowmanager;  CREATE TABLE user(uid int NOT NULL AUTO_INCREMENT,username char(20) NOT NULL,passwd char(32) NOT NULL,firstname char(30),lastname char(30),email char(50),did char(50),CONSTRAINT pk_uid PRIMARY KEY (uid));CREATE TABLE message(mid int NOT NULL AUTO_INCREMENT,uid int NOT NULL,text char(140),attachment varchar(255),pos varchar(140),tstamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL,CONSTRAINT pk_omessage_mid PRIMARY KEY (mid),CONSTRAINT fk_omessage_uid FOREIGN KEY (uid) REFERENCES user(uid) ON DELETE CASCADE ON UPDATE CASCADE);