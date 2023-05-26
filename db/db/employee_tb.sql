-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 13, 2023 at 10:16 AM
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
  `schedule_name` varchar(255) NOT NULL,
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
  `bank_number` varchar(255) NOT NULL,
  `emp_img_url` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employee_tb`
--

INSERT INTO `employee_tb` (`id`, `fname`, `lname`, `empid`, `address`, `contact`, `cstatus`, `gender`, `empdob`, `empsss`, `emptin`, `emppagibig`, `empphilhealth`, `empbranch`, `department_name`, `empposition`, `empbsalary`, `drate`, `approver`, `empdate_hired`, `emptranspo`, `empmeal`, `empinternet`, `schedule_name`, `empstart_date`, `empend_date`, `empaccess_id`, `username`, `role`, `email`, `password`, `cpassword`, `sss_amount`, `tin_amount`, `pagibig_amount`, `philhealth_amount`, `other_govern`, `govern_amount`, `other_allowance`, `allowance_amount`, `bank_name`, `bank_number`, `emp_img_url`) VALUES
(17, 'William', 'Bunn', 2, 'Caloocan City', '09923123341', 'Single', 'Male', '2005-03-29', '213', '12', '123', '123', 'Valenzeula', 'Software Departments', 'IT Sales Associate', '123', '123', 'Regis Legaspi', '2023-04-21', '123', '123', '132', 'Office Base II', '2023-03-23', '2023-03-22', '2', 'William', 'Employee', 'WilliamBBunn@armyspy.com', 'admin', 'admin', 3032, 303323, 30323, 303323, '', 0, '', 0, 'BDO', '32312', '64377cae2e262.jpg'),
(20, 'Joseph', 'Cutie', 35, 'Valenzuela', '0923923232', 'Single', 'Male', '', '123', '123', '123', '123', 'Valenzuela', 'Software Departments', 'Software Developer', '123', '123', 'Cyrus Machete', '', '12', '123', '123', 'Office Base', '2023-03-15', '2023-03-27', '35', 'Joseph', 'Employee', 'sample@sample', 'admin', 'admin', 30, 30, 30, 0, '', 0, '', 0, 'BDO', '12332123', 'img/64352a6bc5752.jpg'),
(25, 'Genikka', 'Bautista', 9, 'Caloocan', '12312313', 'Single', 'Male', '2005-04-01', '123', '123', '123', '123', 'gjfkgujh,', 'Software Departments', ' Developer', '123', '123', 'Regis Legaspi', '2023-03-31', '1231', '12312', '123123', 'Office Base', '', '', '9', 'Nikka', 'Employee', 'genikka@genikka', 'ugat', 'ugat', 30, 30, 30, 30, '', 0, '', 0, 'China Bank', '39232', '64376268e5f32.PNG'),
(30, 'Chester', 'Minoza ', 34, 'Caloocan City', '09923123341', 'Single', 'Male', '2005-03-31', '', '', '', '', 'Valenzuela', 'Software Departments', 'Admin Staff', '123', '123', 'Cyrus Machete', '2023-04-07', '123', '123', '123', 'Office Base', '', '', '34', 'Chester', 'Employee', 'chester@chester.com', 'Ugatin123', 'Ugatin123', 30, 30, 30, 0, '', 0, '', 0, 'China Bank', '123942', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `employee_tb`
--
ALTER TABLE `employee_tb`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `empid` (`empid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `employee_tb`
--
ALTER TABLE `employee_tb`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
