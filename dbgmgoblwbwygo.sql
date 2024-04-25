-- phpMyAdmin SQL Dump
-- version 5.1.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 24, 2024 at 10:51 PM
-- Server version: 5.7.44-48-log
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbgmgoblwbwygo`
--
CREATE DATABASE IF NOT EXISTS `dbgmgoblwbwygo` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `dbgmgoblwbwygo`;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tools`
--

CREATE TABLE `tools` (
  `id` int(11) NOT NULL,
  `tool_name` varchar(20) NOT NULL,
  `description` varchar(255) NOT NULL,
  `availability` enum('available','in use') NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tools`
--

INSERT INTO `tools` (`id`, `tool_name`, `description`, `availability`, `image`) VALUES
(146, 'Mower', 'A solid black and red mower. Gas operated. Hold the red handle down to automate movement.', 'available', '6624131eca3a64.30064633.jpg'),
(148, 'Rake', 'A solid wooden rake with a metal head. Shows little signs of wear.', 'available', '66242c0111a9f3.22473905.jpg'),
(150, 'Saw', 'A metal saw with a blue and black handle. Completely clean.', 'available', '66242c900a33c9.71528287.jpg'),
(151, 'Chisel', 'A small chisel with a wooden handle.', 'available', '66242cbde85998.25537145.jpg'),
(153, 'Chainsaw', 'An orange chainsaw. Has seen some use, but in good condition.', 'available', '66258f22d22563.60070278.png'),
(154, 'Weedeater', 'A trusty weedeater. 49cc 2-stroke engine.', 'available', '66259a8f93e2d1.22967660.png'),
(158, 'Leaf Blower', 'An electric powered leaf blower with green accents. Lightweight. Perfect for one person to do hours of yardwork.', 'available', '6625be41378664.47093560.jpg'),
(160, 'Pressure Washer', 'An electric pressure washer. The handle has multiple settings allowing for more accurate control and spread.', 'available', '6625bfddb22063.12334293.jpg'),
(161, 'Table Saw', 'A large table with a saw built in. Designed for trimming small planks of wood.', 'available', '662965ac58f414.62658671.jpg'),
(162, 'Wheelbarrow', 'A green wheelbarrow that lifts from the back. Has a sturdy metal pole that keeps it from moving.', 'available', '662965d61bdf96.86865441.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tool_images`
--

CREATE TABLE `tool_images` (
  `image_id` int(11) NOT NULL,
  `tool_id` int(11) NOT NULL,
  `image_url` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` int(11) NOT NULL,
  `tool_id` int(11) NOT NULL,
  `borrower_id` int(11) NOT NULL,
  `lender_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `tool_id`, `borrower_id`, `lender_id`) VALUES
(20, 146, 6, 6),
(22, 148, 6, 6),
(24, 150, 6, 6),
(25, 151, 6, 6),
(27, 153, 20, 20),
(28, 154, 21, 21),
(32, 158, 6, 6),
(34, 160, 6, 6),
(35, 161, 13, 13),
(36, 162, 13, 13);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(100) NOT NULL,
  `is_admin` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `email`, `password`, `name`, `is_admin`) VALUES
(1, 'matthew', 'web289', 'matthew', 2),
(6, 'Matthew3dds@gmail.com', '22Ne$bittdaa', 'Matthew3dds@gmail.com', 0),
(13, 'Julie.lowman@allentate.com', 'Newjob21$', 'Julie Lowman ', 0),
(14, 'tara@aol.com', '1234%Abcd', 'Tara', 0),
(15, 'charlekwallin@abtech.edu', 'P@ssword12345', 'Charlie', 0),
(16, 'charleskwallin@abtech.edu', 'P@ssword12345', 'charliewallin', 0),
(17, 'charleskwallin@abtech.edu', 'P@ssword12345', 'charlie', 0),
(18, 'ugcclutch@gmail.com', '1234567Ray!', 'RaymieSegars', 0),
(19, 'admin@admin.com', 'admin', 'admin', 1),
(20, 'i_wickz@yahoo.com', 'ShiverNite1!', 'Richter', 0),
(21, 'tillerderek@gmail.com', 'Ttrstno1333$', 'dtiller', 0),
(22, 'tara@aol.com', '1234Let\'shaveathumbwar', 'tarab', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `tools`
--
ALTER TABLE `tools`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tool_images`
--
ALTER TABLE `tool_images`
  ADD PRIMARY KEY (`image_id`),
  ADD KEY `tool_id` (`tool_id`),
  ADD KEY `tool_id_2` (`tool_id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tool_id` (`tool_id`),
  ADD KEY `user_id_transaction_lender` (`lender_id`),
  ADD KEY `borrower_id` (`borrower_id`) USING BTREE;

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tools`
--
ALTER TABLE `tools`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=163;

--
-- AUTO_INCREMENT for table `tool_images`
--
ALTER TABLE `tool_images`
  MODIFY `image_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tool_images`
--
ALTER TABLE `tool_images`
  ADD CONSTRAINT `tool_id` FOREIGN KEY (`tool_id`) REFERENCES `tools` (`id`);

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `tool_id_transaction` FOREIGN KEY (`tool_id`) REFERENCES `tools` (`id`),
  ADD CONSTRAINT `user_id_transaction_borrower` FOREIGN KEY (`borrower_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `user_id_transaction_lender` FOREIGN KEY (`lender_id`) REFERENCES `users` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
