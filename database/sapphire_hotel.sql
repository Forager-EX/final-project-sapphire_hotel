-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 14, 2025 at 06:26 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sapphire_hotel`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `name` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(20) DEFAULT NULL,
  `mobile` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `name`, `email`, `password`, `mobile`) VALUES
(1, 'Trisha', 'trisha@gmail.com', 'admin123', '09363627414'),
(2, 'maristela', 'stelayebra@gmail.com', '123', '09457263984'),
(3, 'hsd', 'heidi@gmail.com', '1234', '09457263984'),
(4, 'Delia Portes', 'Delia@gmail.com', '12345', '09127374421'),
(5, 'Maristela Yebra', 'maristela@gmail.com', '123', '09363627414'),
(6, 'Venia', 'venia@gmail.com', '1234567', '09137687545');

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `full_name` varchar(100) NOT NULL,
  `booking_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `check_in` date DEFAULT NULL,
  `check_out` date DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `guest_num` int(5) NOT NULL,
  `room_type` varchar(50) NOT NULL,
  `room_rate` decimal(10,0) NOT NULL,
  `total_price` decimal(10,0) NOT NULL,
  `reservation_date` date NOT NULL DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`full_name`, `booking_id`, `user_id`, `check_in`, `check_out`, `status`, `guest_num`, `room_type`, `room_rate`, `total_price`, `reservation_date`) VALUES
('0', 10, 15, '2025-05-08', '2025-05-10', NULL, 2, 'deluxe', 0, 10000, '2025-05-13'),
('0', 11, 15, '2025-05-09', '2025-05-10', 'Pending', 2, 'deluxe', 0, 0, '2025-05-13'),
('0', 12, 15, '2025-05-09', '2025-05-16', 'Pending', 1, 'deluxe', 0, 0, '2025-05-13'),
('Maristela Yebra', 14, 15, '2025-05-09', '2025-05-17', 'Pending', 1, 'standard', 0, 0, '2025-05-13'),
('Maristela Yebra', 15, 15, '2025-05-09', '2025-05-10', 'Pending', 3, 'standard', 0, 0, '2025-05-13'),
('Adrie', 17, 15, '2025-05-13', '2025-05-16', 'Pending', 3, 'standard', 0, 0, '2025-05-13'),
('Adrie', 18, 15, '2025-05-14', '2025-05-15', 'Pending', 3, 'deluxe', 0, 50000, '2025-05-13'),
('Adrie', 19, 15, '2025-05-14', '2025-05-17', 'Pending', 3, 'exclusive', 0, 23000, '2025-05-13'),
('Stela', 20, 15, '2025-05-17', '2025-05-23', 'Pending', 4, 'deluxe', 0, 40000, '2025-05-13'),
('Venia S.', 22, 15, '2025-05-14', '2025-05-15', 'Pending', 3, 'deluxe', 4000, 4000, '2025-05-13'),
('Venia S.', 23, 15, '2025-05-16', '2025-05-31', 'Pending', 3, 'deluxe', 4000, 60000, '2025-05-13'),
('Venia S.', 24, 15, '2025-05-16', '2025-05-31', 'Pending', 5, 'deluxe', 4000, 60000, '2025-05-13'),
('Adrie', 25, 15, '2025-05-14', '2025-05-15', 'Pending', 3, 'standard', 3000, 3000, '2025-05-13'),
('Stela', 26, 15, '2025-05-13', '2025-05-14', 'Pending', 1, 'exclusive', 6000, 6000, '2025-05-13'),
('Stela', 27, 15, '2025-05-13', '2025-05-14', 'Confirmed', 1, 'deluxe', 6000, 6000, '2025-05-13'),
('April Guest 1', 28, 15, '2025-04-10', '2025-04-12', 'Confirmed', 2, 'standard', 3000, 6000, '2025-04-10'),
('April Guest 2', 29, 15, '2025-04-15', '2025-04-17', 'Confirmed', 1, 'deluxe', 5000, 10000, '2025-04-15'),
('April Guest 3', 30, 15, '2025-04-18', '2025-04-20', 'Pending', 2, 'exclusive', 8000, 16000, '2025-04-18'),
('April Guest 4', 31, 15, '2025-04-22', '2025-04-24', 'Pending', 3, 'standard', 3000, 9000, '2025-04-22'),
('April Guest 5', 32, 15, '2025-04-25', '2025-04-27', 'Confirmed', 2, 'deluxe', 5000, 10000, '2025-04-25'),
('Pia Biag', 33, 15, '2025-05-22', '2025-05-23', 'Confirmed', 3, 'exclusive', 6000, 6000, '2025-05-13'),
('Pia Biag', 34, 15, '2025-05-14', '2025-05-31', 'Confirmed', 1, 'deluxe', 4000, 68000, '2025-05-13'),
('Stela', 35, 15, '2025-05-14', '2025-05-15', 'Confirmed', 2, 'deluxe', 4000, 4000, '2025-05-14'),
('Stela', 36, 15, '2025-05-08', '2025-05-24', 'Confirmed', 1, 'standard', 3000, 48000, '2025-05-14');

--
-- Triggers `booking`
--
DELIMITER $$
CREATE TRIGGER `after_booking_insert` AFTER INSERT ON `booking` FOR EACH ROW BEGIN
    INSERT INTO notifications (user_id, title, message, type, name) 
    VALUES (
        NEW.user_id, 
        'New Booking Confirmation',
        CONCAT('New booking for ', NEW.full_name, '. Check-in: ', NEW.check_in, ', Check-out: ', NEW.check_out),
        'booking',
        NEW.full_name
    );
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `notification_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `type` enum('booking','general') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `name` varchar(100) NOT NULL,
  `room_type` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`notification_id`, `user_id`, `title`, `message`, `type`, `created_at`, `name`, `room_type`) VALUES
(1, 15, 'New Booking Confirmation', 'New booking for Pia Biag. Check-in: 2025-05-14, Check-out: 2025-05-31', 'booking', '2025-05-13 10:21:39', 'Pia Biag', NULL),
(2, 15, 'New Booking Confirmation', 'New booking for Stela. Check-in: 2025-05-14, Check-out: 2025-05-15', 'booking', '2025-05-14 04:58:29', 'Stela', NULL),
(3, 15, 'New Booking Confirmation', 'New booking for Stela. Check-in: 2025-05-08, Check-out: 2025-05-24', 'booking', '2025-05-14 14:51:45', 'Stela', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `payment_id` int(11) NOT NULL,
  `booking_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `payment_method` varchar(20) DEFAULT NULL,
  `amount` varchar(20) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

CREATE TABLE `room` (
  `room_id` int(11) NOT NULL,
  `booking_id` int(11) DEFAULT NULL,
  `room_type` varchar(20) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `price` varchar(20) DEFAULT NULL,
  `admin_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `room_id` int(11) NOT NULL,
  `room_type` varchar(255) NOT NULL,
  `status` enum('available','booked') NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `name` varchar(20) DEFAULT NULL,
  `email` varchar(20) DEFAULT NULL,
  `phone` varchar(11) DEFAULT NULL,
  `createdAt` date DEFAULT NULL,
  `password` varchar(55) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `name`, `email`, `phone`, `createdAt`, `password`) VALUES
(15, 'maristela', 'maristela123@gmail.c', NULL, '2025-05-06', '123'),
(17, 'John Doe', 'john.doe@example.com', '123-456-789', '2025-05-13', 'password123'),
(18, 'Jane Smith', 'jane.smith@example.c', '987-654-321', '2025-05-13', 'password456'),
(19, 'Alice Johnson', 'alice.johnson@exampl', '555-123-456', '2025-05-13', 'password789'),
(20, 'Bob Brown', 'bob.brown@example.co', '444-234-567', '2025-05-13', 'password101');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`booking_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`notification_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`payment_id`),
  ADD KEY `booking_id` (`booking_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`room_id`),
  ADD KEY `booking_id` (`booking_id`),
  ADD KEY `admin_id` (`admin_id`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`room_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `booking_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `notification_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `room`
--
ALTER TABLE `room`
  MODIFY `room_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `room_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `booking`
--
ALTER TABLE `booking`
  ADD CONSTRAINT `booking_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `payment_ibfk_1` FOREIGN KEY (`booking_id`) REFERENCES `booking` (`booking_id`),
  ADD CONSTRAINT `payment_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `room`
--
ALTER TABLE `room`
  ADD CONSTRAINT `room_ibfk_1` FOREIGN KEY (`booking_id`) REFERENCES `booking` (`booking_id`),
  ADD CONSTRAINT `room_ibfk_2` FOREIGN KEY (`admin_id`) REFERENCES `admin` (`admin_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
