-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 29, 2023 at 06:03 AM
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
-- Table structure for table `actiontaken_tb`
--

CREATE TABLE `actiontaken_tb` (
  `col_ID` int(11) NOT NULL,
  `col_applyID` int(11) NOT NULL,
  `col_remarks` varchar(200) DEFAULT NULL,
  `col_status` varchar(30) NOT NULL,
  `_datetime` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `actiontaken_tb`
--

INSERT INTO `actiontaken_tb` (`col_ID`, `col_applyID`, `col_remarks`, `col_status`, `_datetime`) VALUES
(10, 114, 'SIGEN+ NA Nga', 'Approved', '2023-03-24 00:21:26'),
(11, 115, 'BEnte muna', 'Rejected', '2023-03-24 00:21:48'),
(12, 116, 'hahahahahhaha', 'Approved', '2023-03-24 00:22:51'),
(13, 117, 'hehe', 'Approved', '2023-03-29 12:01:39');

-- --------------------------------------------------------

--
-- Table structure for table `applyleave_tb`
--

CREATE TABLE `applyleave_tb` (
  `col_ID` int(11) NOT NULL,
  `col_req_emp` int(11) NOT NULL,
  `col_LeaveType` varchar(50) NOT NULL,
  `col_LeavePeriod` varchar(30) NOT NULL,
  `col_strDate` date NOT NULL,
  `col_endDate` date NOT NULL,
  `col_reason` varchar(1000) NOT NULL,
  `col_dt_action` datetime NOT NULL,
  `col_file` varchar(50) NOT NULL,
  `col_status` varchar(30) NOT NULL,
  `_datetime` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `applyleave_tb`
--

INSERT INTO `applyleave_tb` (`col_ID`, `col_req_emp`, `col_LeaveType`, `col_LeavePeriod`, `col_strDate`, `col_endDate`, `col_reason`, `col_dt_action`, `col_file`, `col_status`, `_datetime`) VALUES
(114, 123, 'Sick Leave', 'Full Day', '2023-03-24', '2023-03-25', 'leave reason', '2023-03-24 00:21:26', '4801-', 'Approved', '2023-03-23 23:45:17'),
(115, 321, 'Bereavement Leave', 'Second Half', '2023-03-24', '2023-03-24', 'KAsi lang', '2023-03-24 00:21:48', '5883-', 'Rejected', '2023-03-23 23:57:20'),
(116, 93121203, 'Sick Leave', 'Second Half', '2023-03-25', '2023-03-25', 'halallalalalal', '2023-03-24 00:22:51', '8875-', 'Approved', '2023-03-24 00:22:38'),
(117, 20, 'Vacation Leave', 'Full Day', '2023-03-30', '2023-03-31', 'hehe', '2023-03-29 12:01:39', '1926-', 'Approved', '2023-03-29 11:58:49');

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `id` int(11) NOT NULL,
  `status` varchar(255) NOT NULL,
  `empid` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL,
  `scheduled_time` time NOT NULL,
  `time_in` time NOT NULL,
  `time_out` time NOT NULL,
  `late` int(11) NOT NULL,
  `early_out` int(11) NOT NULL,
  `overtime` int(11) NOT NULL,
  `total_work` int(11) NOT NULL,
  `total_rest` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `attendances`
--

CREATE TABLE `attendances` (
  `id` int(11) NOT NULL,
  `status` varchar(255) NOT NULL,
  `empid` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL,
  `time_in` time NOT NULL,
  `time_out` time NOT NULL,
  `late` time NOT NULL,
  `early_out` time NOT NULL,
  `overtime` time NOT NULL,
  `total_work` time NOT NULL,
  `total_rest` time NOT NULL,
  `modified` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `attendances`
--

INSERT INTO `attendances` (`id`, `status`, `empid`, `name`, `date`, `time_in`, `time_out`, `late`, `early_out`, `overtime`, `total_work`, `total_rest`, `modified`) VALUES
(551, 'Present', '8', 'Gerard Martin', '2023/03/28', '10:00:00', '20:30:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2147483647),
(552, 'Present', '1', 'Juan Dela Cruz', '2023/03/28', '10:20:00', '20:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2147483647),
(553, 'Present', '2', 'William Bunn', '2023/03/28', '10:10:00', '20:30:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2147483647),
(554, 'Absent', '4', 'Chester Minoza', '2023/03/28', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2147483647);

-- --------------------------------------------------------

--
-- Table structure for table `attendance_tb`
--

CREATE TABLE `attendance_tb` (
  `id` int(11) NOT NULL,
  `status` varchar(255) NOT NULL,
  `empid` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL,
  `time_in` time NOT NULL,
  `time_out` time NOT NULL,
  `late` time NOT NULL,
  `early_out` time NOT NULL,
  `overtime` time NOT NULL,
  `total_work` time NOT NULL,
  `total_rest` time NOT NULL,
  `modified` int(11) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `attendance_tb`
--

INSERT INTO `attendance_tb` (`id`, `status`, `empid`, `name`, `date`, `time_in`, `time_out`, `late`, `early_out`, `overtime`, `total_work`, `total_rest`, `modified`, `timestamp`) VALUES
(73, 'Present', '8', 'Gerard Martin', '03/27/2023', '09:50:00', '18:30:00', '00:50:00', '00:00:00', '00:20:00', '07:40:00', '00:00:00', 0, '2023-03-28 06:35:33'),
(74, 'Present', '1', 'Juan Dela Cruz', '03/27/2023', '09:15:00', '18:00:00', '00:15:00', '00:00:00', '00:00:00', '07:45:00', '00:00:00', 0, '2023-03-28 06:35:33'),
(75, 'Present', '2', 'William Bunnses', '03/27/2023', '09:00:00', '18:30:00', '00:00:00', '00:00:00', '00:30:00', '08:30:00', '00:00:00', 0, '2023-03-28 06:35:33'),
(76, 'Absent', '4', 'Chester Minoza', '03/27/2023', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '08:00:00', 0, '2023-03-28 06:35:33');

-- --------------------------------------------------------

--
-- Table structure for table `branch_tb`
--

CREATE TABLE `branch_tb` (
  `id` int(11) NOT NULL,
  `branch_name` varchar(200) NOT NULL,
  `branch_address` varchar(200) NOT NULL,
  `zip_code` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `telephone` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `branch_tb`
--

INSERT INTO `branch_tb` (`id`, `branch_name`, `branch_address`, `zip_code`, `email`, `telephone`) VALUES
(4, 'Highminds', 'Cubao', '1480', 'Highminds@gmail.com', 975448521),
(5, 'Big Brew', 'Paso De Blas', '1450', 'Big@brew.com', 9097544073);

-- --------------------------------------------------------

--
-- Table structure for table `daily_time_records_tb`
--

CREATE TABLE `daily_time_records_tb` (
  `id` int(11) NOT NULL,
  `employee_id` varchar(255) NOT NULL,
  `name` varchar(100) NOT NULL,
  `department` varchar(100) NOT NULL,
  `schedule_type` varchar(100) NOT NULL,
  `time_entry` time NOT NULL,
  `time_out` time NOT NULL,
  `total_hours` int(11) NOT NULL,
  `tardiness` int(11) NOT NULL,
  `undertime` int(11) NOT NULL,
  `overtime` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `daily_time_records_tb`
--

INSERT INTO `daily_time_records_tb` (`id`, `employee_id`, `name`, `department`, `schedule_type`, `time_entry`, `time_out`, `total_hours`, `tardiness`, `undertime`, `overtime`) VALUES
(11, '100444145', 'Cyrus', 'Developer', 'Office', '09:00:00', '16:00:00', 6, 0, 3, 0),
(12, '100314524', 'Leila', 'Unknown', 'WFH', '09:00:00', '18:00:00', 8, 0, 0, 0),
(13, '100114525', 'Carol', 'IT Sales', 'Office', '11:00:00', '18:00:00', 6, 2, 0, 0),
(14, '10001', 'Joseph', 'Intern', 'Office', '09:00:00', '14:00:00', 4, 0, 5, 0),
(15, '100002', 'blinks', 'sales', 'hybrid', '11:00:00', '15:00:00', 3, 2, 8, 0),
(17, '100151', 'Nikka', 'it sales', 'office', '11:00:00', '18:00:00', 6, 2, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `department_tb`
--

CREATE TABLE `department_tb` (
  `id` int(11) NOT NULL,
  `department_name` varchar(255) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `department_tb`
--

INSERT INTO `department_tb` (`id`, `department_name`, `timestamp`) VALUES
(1, 'Admin Department', '2023-03-17 02:54:18'),
(2, 'Sales Department', '2023-03-17 02:54:30'),
(3, 'Software Department', '2023-03-17 02:54:53'),
(4, 'Hardware Department', '2023-03-17 02:54:53');

-- --------------------------------------------------------

--
-- Table structure for table `dept_tb`
--

CREATE TABLE `dept_tb` (
  `col_ID` int(11) NOT NULL,
  `col_deptname` varchar(50) NOT NULL,
  `_datetime` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dept_tb`
--

INSERT INTO `dept_tb` (`col_ID`, `col_deptname`, `_datetime`) VALUES
(69, 'Software Departments', '2023-03-18 10:37:52'),
(77, 'Sales Departments', '2023-03-18 22:57:08'),
(85, 'IT Department', '2023-03-29 11:34:40'),
(86, 'HR Department', '2023-03-29 11:40:48');

-- --------------------------------------------------------

--
-- Table structure for table `employee_tb`
--

CREATE TABLE `employee_tb` (
  `id` int(11) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `empid` int(11) NOT NULL,
  `address` varchar(255) NOT NULL,
  `contact` varchar(255) NOT NULL,
  `cstatus` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `empdob` varchar(255) NOT NULL,
  `empsss` varchar(255) NOT NULL,
  `emptin` varchar(255) NOT NULL,
  `emppagibig` varchar(255) NOT NULL,
  `empphilhealth` varchar(255) NOT NULL,
  `empbranch` varchar(255) NOT NULL,
  `department_name` varchar(255) NOT NULL,
  `empposition` varchar(255) NOT NULL,
  `empbsalary` varchar(255) NOT NULL,
  `drate` varchar(255) NOT NULL,
  `approver` varchar(255) NOT NULL,
  `empdate_hired` varchar(255) NOT NULL,
  `emptranspo` varchar(255) NOT NULL,
  `empmeal` varchar(255) NOT NULL,
  `empinternet` varchar(255) NOT NULL,
  `empschedule_type` varchar(255) NOT NULL,
  `empstart_date` varchar(255) NOT NULL,
  `empend_date` varchar(255) NOT NULL,
  `empaccess_id` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `cpassword` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employee_tb`
--

INSERT INTO `employee_tb` (`id`, `fname`, `lname`, `empid`, `address`, `contact`, `cstatus`, `gender`, `empdob`, `empsss`, `emptin`, `emppagibig`, `empphilhealth`, `empbranch`, `department_name`, `empposition`, `empbsalary`, `drate`, `approver`, `empdate_hired`, `emptranspo`, `empmeal`, `empinternet`, `empschedule_type`, `empstart_date`, `empend_date`, `empaccess_id`, `username`, `role`, `email`, `password`, `cpassword`) VALUES
(15, 'Gerard', 'Martin', 8, 'Valenzuela', '09999567189', 'Single', 'Male', '2023-03-05', '123', '123', '123', '123', 'Valenzeula', ' Software Department', 'Software Developer', '123', '123', 'Cyrus Machete', '2023-03-07', '213', '123', '123', 'Work From Home', '2023-02-28', '2023-03-17', '8', 'Gerard', 'Employee', 'gerard@gerard', 'ugat', 'ugat'),
(16, 'Juan', 'Dela Cruz', 1, 'Valenzuela', '923123123', 'Single', 'Male', '2023-03-02', '123', '12', '123', '123', 'Valenzeula', ' Sales Department', 'IT Sales Associate', '123', '123', 'Cyrus Machete', '2023-03-13', '123', '13', '123', 'Work From Home', '2023-03-03', '2023-03-10', '1', 'Juan', 'Employee', 'juandelacruz@gmail.com', 'ugat', 'ugat'),
(17, 'William', 'Bunn', 2, 'Caloocan City', '09923123341', 'Single', 'Male', '2023-02-27', '213', '12', '123', '123', 'Valenzeula', ' Hardware Department', 'IT Sales Associate', '123', '123', 'Regis Legaspi', '2023-02-09', '123', '123', '132', 'Office Base', '2023-03-23', '2023-03-22', '2', 'William', 'Employee', 'WilliamBBunn@armyspy.com', 'ugat', 'ugat'),
(18, 'Chester', 'Minoza', 4, 'Caloocan City', '09923123341', 'Single', 'Male', '2023-03-03', '123', '123', '123', '123', 'Valenzeula', ' Admin Department', 'Software Developer', '123', '123', 'Cyrus Machete', '2023-02-28', '213', '1234', '123', 'Office Base', '2023-03-03', '2023-03-10', '4', 'Chester', 'Employee', 'chester@chester', 'ugat', 'ugat'),
(19, 'Chester', 'Minoza', 69, 'Caloocan', '09231232', 'Single', 'Male', '2023-03-28', '123', '123', '123', '123', 'Caloocan', ' Software Department', 'Admin Staff', '123', '123', 'Cyrus Machete', '2023-03-08', '123', '123', '123', 'Work From Home', '2023-03-01', '2023-03-17', '69', 'Chesta', 'Employee', 'chester@chester', 'ugat', 'ugat'),
(20, 'Joseph', 'Cutie', 35, 'Valenzuela', '0923923232', 'Single', 'Male', '2023-03-29', '123', '123', '123', '123', 'Valenzuela', 'IT Department', 'Software Developer', '123', '123', 'Cyrus Machete', '2023-03-22', '12', '123', '123', 'Work From Home', '2023-03-15', '2023-03-27', '35', 'Joseph', 'Employee', 'sample@sample', 'ugat', 'ugat'),
(21, 'Krester', 'Pogi', 20, 'Valenzuela', '0912312312', 'Single', 'Male', '2023-03-08', '123', '123', '123', '123', 'Caloocan', 'HR Department', 'Admin Staff', '123', '123', 'Cyrus Machete', '2023-03-03', '123', '123', '123', 'Work From Home', '2023-03-15', '2023-03-23', '20', 'Krester', 'Employee', 'krester@sample', 'ugat', 'ugat');

-- --------------------------------------------------------

--
-- Table structure for table `empschedule_tb`
--

CREATE TABLE `empschedule_tb` (
  `id` int(11) NOT NULL,
  `empid` int(11) NOT NULL,
  `schedule_name` varchar(255) NOT NULL,
  `sched_from` varchar(255) NOT NULL,
  `sched_to` varchar(255) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `empschedule_tb`
--

INSERT INTO `empschedule_tb` (`id`, `empid`, `schedule_name`, `sched_from`, `sched_to`, `timestamp`) VALUES
(13, 8, ' Office Based', '2023-04-28', '2023-05-23', '2023-03-27 04:58:08');

-- --------------------------------------------------------

--
-- Table structure for table `emp_dtr_tb`
--

CREATE TABLE `emp_dtr_tb` (
  `id` int(11) NOT NULL,
  `emp_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `type` varchar(50) NOT NULL,
  `reason` varchar(500) NOT NULL,
  `upl_file` blob NOT NULL,
  `status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `emp_dtr_tb`
--

INSERT INTO `emp_dtr_tb` (`id`, `emp_id`, `date`, `time`, `type`, `reason`, `upl_file`, `status`) VALUES
(9, 8, '2023-03-25', '10:25:00', 'OUT', 'dasdasdsa', '', 'Approved'),
(10, 1, '2023-03-25', '23:56:00', 'IN', 'dsadsadasda', '', 'Approved');

-- --------------------------------------------------------

--
-- Table structure for table `leaveinfo_tb`
--

CREATE TABLE `leaveinfo_tb` (
  `col_ID` int(11) NOT NULL,
  `col_empID` int(11) NOT NULL,
  `col_vctionCrdt` float NOT NULL,
  `col_sickCrdt` float NOT NULL,
  `col_brvmntCrdt` float NOT NULL,
  `_dateTime` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `leaveinfo_tb`
--

INSERT INTO `leaveinfo_tb` (`col_ID`, `col_empID`, `col_vctionCrdt`, `col_sickCrdt`, `col_brvmntCrdt`, `_dateTime`) VALUES
(61, 321, 8, 10, 9, '2023-03-23 20:57:08'),
(62, 123, 2, 9, 0.5, '2023-03-23 20:57:14'),
(63, 93121203, 11.5, 7.5, 11.5, '2023-03-23 20:57:24'),
(64, 20, 9, 10, 10, '2023-03-29 11:54:48');

-- --------------------------------------------------------

--
-- Table structure for table `leavetype_tb`
--

CREATE TABLE `leavetype_tb` (
  `col_ID` int(11) NOT NULL,
  `col_Leave_name` varchar(50) NOT NULL,
  `_datetime` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `leavetype_tb`
--

INSERT INTO `leavetype_tb` (`col_ID`, `col_Leave_name`, `_datetime`) VALUES
(2, 'tryy', '2023-03-23 13:31:21'),
(3, 'Sick Leave', '2023-03-23 13:31:45'),
(4, 'Vacation Leave', '2023-03-23 13:31:53'),
(5, 'Bereavement Leave', '2023-03-23 13:31:59');

-- --------------------------------------------------------

--
-- Table structure for table `positionn_tb`
--

CREATE TABLE `positionn_tb` (
  `id` int(11) NOT NULL,
  `position` varchar(200) NOT NULL,
  `designation` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `positionn_tb`
--

INSERT INTO `positionn_tb` (`id`, `position`, `designation`) VALUES
(1, 'Technical ', '1'),
(2, 'H.R', ''),
(3, 'Developer', ''),
(4, 'Junior Web Developer', '');

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
(14, 'Office Based', 'Monday', '09:00', '18:00', NULL, 'Tuesday', '10:00', '20:00', NULL, 'Wednesday', '09:00', '09:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '30', '30', NULL, '2023-03-27 05:15:18');

-- --------------------------------------------------------

--
-- Table structure for table `users_tb`
--

CREATE TABLE `users_tb` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `userType` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users_tb`
--

INSERT INTO `users_tb` (`id`, `username`, `password`, `userType`) VALUES
(1, 'Gerard', 'admin', 'Admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `actiontaken_tb`
--
ALTER TABLE `actiontaken_tb`
  ADD PRIMARY KEY (`col_ID`);

--
-- Indexes for table `applyleave_tb`
--
ALTER TABLE `applyleave_tb`
  ADD PRIMARY KEY (`col_ID`);

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attendances`
--
ALTER TABLE `attendances`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attendance_tb`
--
ALTER TABLE `attendance_tb`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `branch_tb`
--
ALTER TABLE `branch_tb`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `daily_time_records_tb`
--
ALTER TABLE `daily_time_records_tb`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `department_tb`
--
ALTER TABLE `department_tb`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dept_tb`
--
ALTER TABLE `dept_tb`
  ADD PRIMARY KEY (`col_ID`);

--
-- Indexes for table `employee_tb`
--
ALTER TABLE `employee_tb`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `empid` (`empid`);

--
-- Indexes for table `empschedule_tb`
--
ALTER TABLE `empschedule_tb`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `emp_dtr_tb`
--
ALTER TABLE `emp_dtr_tb`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `leaveinfo_tb`
--
ALTER TABLE `leaveinfo_tb`
  ADD PRIMARY KEY (`col_ID`);

--
-- Indexes for table `leavetype_tb`
--
ALTER TABLE `leavetype_tb`
  ADD PRIMARY KEY (`col_ID`);

--
-- Indexes for table `positionn_tb`
--
ALTER TABLE `positionn_tb`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `schedule_tb`
--
ALTER TABLE `schedule_tb`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `schedule_name` (`schedule_name`);

--
-- Indexes for table `users_tb`
--
ALTER TABLE `users_tb`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `actiontaken_tb`
--
ALTER TABLE `actiontaken_tb`
  MODIFY `col_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `applyleave_tb`
--
ALTER TABLE `applyleave_tb`
  MODIFY `col_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=118;

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `attendances`
--
ALTER TABLE `attendances`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=555;

--
-- AUTO_INCREMENT for table `attendance_tb`
--
ALTER TABLE `attendance_tb`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT for table `branch_tb`
--
ALTER TABLE `branch_tb`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `daily_time_records_tb`
--
ALTER TABLE `daily_time_records_tb`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `department_tb`
--
ALTER TABLE `department_tb`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `dept_tb`
--
ALTER TABLE `dept_tb`
  MODIFY `col_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- AUTO_INCREMENT for table `employee_tb`
--
ALTER TABLE `employee_tb`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `empschedule_tb`
--
ALTER TABLE `empschedule_tb`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `emp_dtr_tb`
--
ALTER TABLE `emp_dtr_tb`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `leaveinfo_tb`
--
ALTER TABLE `leaveinfo_tb`
  MODIFY `col_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `leavetype_tb`
--
ALTER TABLE `leavetype_tb`
  MODIFY `col_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `positionn_tb`
--
ALTER TABLE `positionn_tb`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `schedule_tb`
--
ALTER TABLE `schedule_tb`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `users_tb`
--
ALTER TABLE `users_tb`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
