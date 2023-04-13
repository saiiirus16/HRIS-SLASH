-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 13, 2023 at 11:27 AM
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
  `col_file` longblob NOT NULL,
  `col_status` varchar(30) NOT NULL,
  `_datetime` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `date` date NOT NULL,
  `time_in` time NOT NULL,
  `time_out` time NOT NULL,
  `late` time NOT NULL,
  `early_out` time NOT NULL,
  `overtime` time NOT NULL,
  `total_work` time NOT NULL,
  `total_rest` time NOT NULL,
  `modified` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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

-- --------------------------------------------------------

--
-- Table structure for table `department_tb`
--

CREATE TABLE `department_tb` (
  `id` int(11) NOT NULL,
  `department_name` varchar(255) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `dept_tb`
--

CREATE TABLE `dept_tb` (
  `col_ID` int(11) NOT NULL,
  `col_deptname` varchar(50) NOT NULL,
  `_datetime` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `empbranch` varchar(255) DEFAULT NULL,
  `department_name` varchar(255) DEFAULT NULL,
  `empposition` varchar(255) DEFAULT NULL,
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
  `cpassword` varchar(255) NOT NULL,
  `sss_amount` int(11) NOT NULL,
  `tin_amount` int(11) NOT NULL,
  `pagibig_amount` int(11) NOT NULL,
  `philhealth_amount` int(11) NOT NULL,
  `other_govern` varchar(255) NOT NULL,
  `govern_amount` int(11) NOT NULL,
  `other_allowance` varchar(255) NOT NULL,
  `allowance_amount` int(11) NOT NULL,
  `bank_name` varchar(255) NOT NULL,
  `bank_number` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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

-- --------------------------------------------------------

--
-- Table structure for table `leavetype_tb`
--

CREATE TABLE `leavetype_tb` (
  `col_ID` int(11) NOT NULL,
  `col_Leave_name` varchar(50) NOT NULL,
  `_datetime` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `positionn_tb`
--

CREATE TABLE `positionn_tb` (
  `id` int(11) NOT NULL,
  `position` varchar(200) NOT NULL,
  `designation` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `thurs_timein` time DEFAULT NULL,
  `thurs_timeout` time DEFAULT NULL,
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
  MODIFY `col_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `applyleave_tb`
--
ALTER TABLE `applyleave_tb`
  MODIFY `col_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `attendances`
--
ALTER TABLE `attendances`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `attendance_tb`
--
ALTER TABLE `attendance_tb`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `branch_tb`
--
ALTER TABLE `branch_tb`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `daily_time_records_tb`
--
ALTER TABLE `daily_time_records_tb`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `department_tb`
--
ALTER TABLE `department_tb`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `dept_tb`
--
ALTER TABLE `dept_tb`
  MODIFY `col_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `employee_tb`
--
ALTER TABLE `employee_tb`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `empschedule_tb`
--
ALTER TABLE `empschedule_tb`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `emp_dtr_tb`
--
ALTER TABLE `emp_dtr_tb`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `leaveinfo_tb`
--
ALTER TABLE `leaveinfo_tb`
  MODIFY `col_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `leavetype_tb`
--
ALTER TABLE `leavetype_tb`
  MODIFY `col_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `positionn_tb`
--
ALTER TABLE `positionn_tb`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `schedule_tb`
--
ALTER TABLE `schedule_tb`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users_tb`
--
ALTER TABLE `users_tb`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
