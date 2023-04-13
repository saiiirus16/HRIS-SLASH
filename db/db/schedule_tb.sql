-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 13, 2023 at 10:17 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hris_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `schedule_tb`
--

CREATE TABLE `schedule_tb` (
  `id` int(11) NOT NULL,
  `schedule_name` varchar(255) NOT NULL,
  `monday` varchar(255) DEFAULT NULL,
  `mon_timein` varchar(255) DEFAULT NULL,
  `mon_timeout` varchar(255) DEFAULT NULL,
  `mon_wfh` varchar(255) DEFAULT NULL,
  `tuesday` varchar(255) DEFAULT NULL,
  `tues_timein` varchar(255) DEFAULT NULL,
  `tues_timeout` varchar(255) DEFAULT NULL,
  `tues_wfh` varchar(255) DEFAULT NULL,
  `wednesday` varchar(255) DEFAULT NULL,
  `wed_timein` varchar(255) DEFAULT NULL,
  `wed_timeout` varchar(255) DEFAULT NULL,
  `wed_wfh` varchar(255) DEFAULT NULL,
  `thursday` varchar(255) DEFAULT NULL,
  `thurs_timein` varchar(255) DEFAULT NULL,
  `thurs_timeout` varchar(255) DEFAULT NULL,
  `thurs_wfh` varchar(255) DEFAULT NULL,
  `friday` varchar(255) DEFAULT NULL,
  `fri_timein` varchar(255) DEFAULT NULL,
  `fri_timeout` varchar(255) DEFAULT NULL,
  `fri_wfh` varchar(255) DEFAULT NULL,
  `saturday` varchar(255) DEFAULT NULL,
  `sat_timein` varchar(255) DEFAULT NULL,
  `sat_timeout` varchar(255) DEFAULT NULL,
  `sat_wfh` varchar(255) DEFAULT NULL,
  `sunday` varchar(255) DEFAULT NULL,
  `sun_timein` varchar(255) DEFAULT NULL,
  `sun_timeout` varchar(255) DEFAULT NULL,
  `sun_wfh` varchar(255) DEFAULT NULL,
  `flexible` varchar(255) DEFAULT NULL,
  `grace_period` varchar(255) DEFAULT NULL,
  `sched_ot` varchar(255) DEFAULT NULL,
  `sched_holiday` varchar(255) DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `schedule_tb`
--

INSERT INTO `schedule_tb` (`id`, `schedule_name`, `monday`, `mon_timein`, `mon_timeout`, `mon_wfh`, `tuesday`, `tues_timein`, `tues_timeout`, `tues_wfh`, `wednesday`, `wed_timein`, `wed_timeout`, `wed_wfh`, `thursday`, `thurs_timein`, `thurs_timeout`, `thurs_wfh`, `friday`, `fri_timein`, `fri_timeout`, `fri_wfh`, `saturday`, `sat_timein`, `sat_timeout`, `sat_wfh`, `sunday`, `sun_timein`, `sun_timeout`, `sun_wfh`, `flexible`, `grace_period`, `sched_ot`, `sched_holiday`, `timestamp`) VALUES
(20, 'Work From Home', '', '09:00', '18:00', '', '', '10:00', '18:00', '', '', '09:00', '09:00', '', '', '22:00', '22:00', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '30', '', '', '2023-04-11 07:04:22'),
(22, 'Office Based II', 'Monday', '10:00', '19:00', NULL, 'Tuesday', '10:00', '19:00', NULL, 'Wednesday', '11:00', '11:00', NULL, 'Thursday', '10:00', '18:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-04-13 01:48:51'),
(23, 'Work Based III', 'Monday', '10:23', '22:23', 'WFH', 'Tuesday', '11:23', '22:23', '', 'Wednesday', '11:23', '11:23', 'WFH', 'Thursday', '11:24', '10:26', '', 'Friday', '11:24', '10:27', '', '', '', '', '', '', '', '', '', 'Flexible', '', '', 'Holiday Work', '2023-04-13 02:28:30');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `schedule_tb`
--
ALTER TABLE `schedule_tb`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `schedule_name` (`schedule_name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `schedule_tb`
--
ALTER TABLE `schedule_tb`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
