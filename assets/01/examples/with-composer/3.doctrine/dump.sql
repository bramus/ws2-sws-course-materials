-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 17, 2013 at 04:30 PM
-- Server version: 5.5.25
-- PHP Version: 5.4.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `todo`
--

DROP DATABASE IF EXISTS todo;
CREATE DATABASE todo DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE todo;

-- --------------------------------------------------------

--
-- Table structure for table `todolist`
--

CREATE TABLE `todolist` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `what` varchar(255) NOT NULL,
  `priority` enum('high','normal','low') NOT NULL,
  `added_on` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE utf8mb4_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `todolist`
--

INSERT INTO `todolist` (`id`, `user_id`, `what`, `priority`, `added_on`) VALUES
(1, 1, 'ksat tnegru yrev A', 'high', '2012-12-03 13:56:08'),
(2, 1, 'A normal priority task', 'normal', '2012-12-03 13:56:08'),
(3, 1, 'A low priority task', 'low', '2013-02-07 16:18:37'),
(4, 2, 'A very urgent task', 'high', '2012-12-19 13:56:08');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE utf8mb4_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(1, 'bramus', '$2y$10$3kDNd/rc2C9z6H9A7M0L..6BcAAH.uU8d5hu2e0NtggNOjHXygSbO'),
(2, 'rogier', '$2y$10$b9HQ05S1SBGdSBN2HPnxaePba2tHDJ2Mrm4mpumha0BlKAloSXK5a'),
(3, '💩', '$2y$10$9FwQp3zEVzvY5MYivJBk2eeAJhyRZD7ZV5rXTnr6MRFpDYAN/VPtW');