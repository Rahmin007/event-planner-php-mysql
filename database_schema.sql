-- ============================================================
-- Event Planner Database Schema
-- Database: 370project
-- Run this entire file in phpMyAdmin or MySQL before using the app
-- ============================================================

CREATE DATABASE IF NOT EXISTS `370project`;
USE `370project`;

-- Users table (all accounts: planners and participants)
CREATE TABLE `users` (
  `username` VARCHAR(100) NOT NULL PRIMARY KEY,
  `password` VARCHAR(255) NOT NULL,
  `age`      INT NOT NULL,
  `role`     ENUM('planner', 'participant') NOT NULL
);

-- Planners (extra profile info for planner role)
CREATE TABLE `planners` (
  `username` VARCHAR(100) NOT NULL PRIMARY KEY,
  `phone`    VARCHAR(20) DEFAULT NULL,
  `email`    VARCHAR(100) DEFAULT NULL,
  FOREIGN KEY (`username`) REFERENCES `users`(`username`) ON DELETE CASCADE
);

-- Participants (extra profile info for participant role)
CREATE TABLE `participants` (
  `username` VARCHAR(100) NOT NULL PRIMARY KEY,
  `hobby`    VARCHAR(255) DEFAULT NULL,
  `allargy`  VARCHAR(255) DEFAULT NULL,
  FOREIGN KEY (`username`) REFERENCES `users`(`username`) ON DELETE CASCADE
);

-- Plans created by planners
CREATE TABLE `plan` (
  `planName` VARCHAR(150) NOT NULL PRIMARY KEY,
  `budget`   DECIMAL(10,2) DEFAULT 0,
  `spent`    DECIMAL(10,2) DEFAULT 0,
  `planner`  VARCHAR(100) NOT NULL,
  FOREIGN KEY (`planner`) REFERENCES `users`(`username`) ON DELETE CASCADE
);

-- Timetable entries for each plan
CREATE TABLE `time_tab` (
  `id`         INT AUTO_INCREMENT PRIMARY KEY,
  `planName`   VARCHAR(150) NOT NULL,
  `date_`      DATE NOT NULL,
  `start_time` TIME NOT NULL,
  `end_time`   TIME NOT NULL,
  `activity`   VARCHAR(255) NOT NULL,
  `location_`  VARCHAR(255) NOT NULL,
  FOREIGN KEY (`planName`) REFERENCES `plan`(`planName`) ON DELETE CASCADE
);

-- Notes attached to a plan
CREATE TABLE `notes` (
  `id`       INT AUTO_INCREMENT PRIMARY KEY,
  `note`     TEXT NOT NULL,
  `planName` VARCHAR(150) NOT NULL,
  FOREIGN KEY (`planName`) REFERENCES `plan`(`planName`) ON DELETE CASCADE
);

-- Many-to-many: participants involved in plans
CREATE TABLE `involved_in` (
  `planName` VARCHAR(150) NOT NULL,
  `username` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`planName`, `username`),
  FOREIGN KEY (`planName`) REFERENCES `plan`(`planName`) ON DELETE CASCADE,
  FOREIGN KEY (`username`) REFERENCES `users`(`username`) ON DELETE CASCADE
);
