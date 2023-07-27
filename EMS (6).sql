-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 04, 2023 at 10:37 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `EMS`
--

-- --------------------------------------------------------

--
-- Table structure for table `area_master`
--

CREATE TABLE `area_master` (
  `area_id` int(4) NOT NULL,
  `area` varchar(255) NOT NULL,
  `city_id` int(6) NOT NULL,
  `state_id` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `area_master`
--

INSERT INTO `area_master` (`area_id`, `area`, `city_id`, `state_id`) VALUES
(3, '121 Strosin Manor Apt. 120', 7, 5),
(4, '0941 Nayeli Camp', 2, 5),
(5, '29344 Ike Haven Apt. 089', 3, 5),
(6, '946 Steuber Course', 1, 2),
(20, 'Sector-1', 55, 13),
(21, 'Staduim', 54, 13),
(210, 'Satellite', 54, 13);

-- --------------------------------------------------------

--
-- Table structure for table `city_master`
--

CREATE TABLE `city_master` (
  `city_id` int(1) NOT NULL,
  `city` varchar(255) NOT NULL,
  `state_id` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `city_master`
--

INSERT INTO `city_master` (`city_id`, `city`, `state_id`) VALUES
(1, 'South Krystina', 5),
(2, 'Jillianberg', 2),
(3, 'West Jeanetteport', 2),
(7, 'Port Nina', 2),
(8, 'New Gracieton', 6),
(39, 'Jamnagar', 13),
(54, 'Ahmedabad', 13),
(55, 'Surat', 13);

-- --------------------------------------------------------

--
-- Table structure for table `college_master`
--

CREATE TABLE `college_master` (
  `clg_id` int(6) NOT NULL,
  `clg_name` varchar(255) NOT NULL,
  `uni_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `college_master`
--

INSERT INTO `college_master` (`clg_id`, `clg_name`, `uni_id`) VALUES
(1, 'LJ POLYTECHNIC', 1),
(3, 'LD ENGINEERING', 1),
(5, 'IIT BANGLORE', 8);

-- --------------------------------------------------------

--
-- Table structure for table `degree_master`
--

CREATE TABLE `degree_master` (
  `degree_id` int(2) NOT NULL,
  `degree_field` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `degree_master`
--

INSERT INTO `degree_master` (`degree_id`, `degree_field`) VALUES
(4, 'BSc'),
(53, 'BTech');

-- --------------------------------------------------------

--
-- Table structure for table `dept_master`
--

CREATE TABLE `dept_master` (
  `dept_id` int(6) NOT NULL,
  `dept_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dept_master`
--

INSERT INTO `dept_master` (`dept_id`, `dept_name`) VALUES
(125, 'Development'),
(32, 'Sales'),
(169, 'Support');

-- --------------------------------------------------------

--
-- Table structure for table `designation_master`
--

CREATE TABLE `designation_master` (
  `desi_id` int(6) NOT NULL,
  `desi_name` varchar(255) NOT NULL,
  `dept_id` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `designation_master`
--

INSERT INTO `designation_master` (`desi_id`, `desi_name`, `dept_id`) VALUES
(8, 'Sr Developer', 125),
(15, 'Sr Manager', 32),
(37, 'Jr Developer', 125);

-- --------------------------------------------------------

--
-- Table structure for table `doc`
--

CREATE TABLE `doc` (
  `degree_certi_doc` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `doc`
--

INSERT INTO `doc` (`degree_certi_doc`) VALUES
(''),
(''),
('file_name'),
('file_name'),
(''),
(''),
(''),
(''),
('CE6_NMA-P4,5,6,7.pdf'),
('CE6_NMA-P4,5,6,7.pdf'),
('3340705-DIPLOMA-WINTER-2020.pdf'),
('3340705-DIPLOMA-WINTER-2020.pdf'),
('3340705-DIPLOMA-WINTER-2020.pdf'),
('3340705-DIPLOMA-WINTER-2020.pdf'),
('3340705-DIPLOMA-WINTER-2020.pdf'),
('3340705-DIPLOMA-WINTER-2020.pdf'),
('3340705-DIPLOMA-WINTER-2020.pdf'),
('3340705-DIPLOMA-WINTER-2020.pdf'),
('3340705-DIPLOMA-WINTER-2020.pdf'),
('3340705-DIPLOMA-WINTER-2020.pdf'),
('3340705-DIPLOMA-WINTER-2020.pdf'),
('3340705-DIPLOMA-WINTER-2020.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `doc_type_master`
--

CREATE TABLE `doc_type_master` (
  `doc_type_id` int(2) NOT NULL,
  `doc_type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `issue`
--

CREATE TABLE `issue` (
  `issue_id` int(6) NOT NULL,
  `issue_desc` varchar(255) NOT NULL,
  `title` varchar(30) NOT NULL,
  `issue_date` date NOT NULL,
  `issue_status` tinyint(1) NOT NULL,
  `u_id` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `leave_balance`
--

CREATE TABLE `leave_balance` (
  `bal_id` int(6) NOT NULL,
  `lv_balance` float NOT NULL,
  `u_id` int(6) NOT NULL,
  `leave_type_id` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `leave_balance`
--

INSERT INTO `leave_balance` (`bal_id`, `lv_balance`, `u_id`, `leave_type_id`) VALUES
(1, 10, 339, 1),
(7, 9, 971, 1),
(8, 4, 805, 50),
(10, 4, 805, 50);

-- --------------------------------------------------------

--
-- Table structure for table `leave_type_master`
--

CREATE TABLE `leave_type_master` (
  `leave_type_id` int(6) NOT NULL,
  `leave_type` varchar(255) NOT NULL,
  `leave_short_form` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `leave_type_master`
--

INSERT INTO `leave_type_master` (`leave_type_id`, `leave_type`, `leave_short_form`) VALUES
(1, 'Paid Leave', 'PL'),
(29, 'Maternity Leave', 'ML'),
(50, 'Sick Leave', 'SL');

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `notify_id` int(6) NOT NULL,
  `Notification` varchar(255) NOT NULL,
  `u_id` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `role_master`
--

CREATE TABLE `role_master` (
  `role_id` int(6) NOT NULL,
  `role_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `role_master`
--

INSERT INTO `role_master` (`role_id`, `role_name`) VALUES
(1, 'Admin'),
(2, 'Employee'),
(0, 'HR');

-- --------------------------------------------------------

--
-- Table structure for table `state_master`
--

CREATE TABLE `state_master` (
  `state_id` int(1) NOT NULL,
  `state` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `state_master`
--

INSERT INTO `state_master` (`state_id`, `state`) VALUES
(2, 'California'),
(6, 'Connecticut'),
(9, 'Delaware'),
(13, 'Gujrat'),
(5, 'SouthCarolina');

-- --------------------------------------------------------

--
-- Table structure for table `training_master`
--

CREATE TABLE `training_master` (
  `t_id` int(6) NOT NULL,
  `t_meet_id` bigint(12) NOT NULL,
  `t_pass` varchar(255) NOT NULL,
  `t_duration` int(11) NOT NULL,
  `t_desc` varchar(255) NOT NULL,
  `t_datetime` datetime NOT NULL,
  `u_id` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `training_master`
--

INSERT INTO `training_master` (`t_id`, `t_meet_id`, `t_pass`, `t_duration`, `t_desc`, `t_datetime`, `u_id`) VALUES
(9, 83215591614, 'Admin123', 20, 'Training Session', '2023-03-25 22:45:00', 339),
(70, 84539240329, 'Admin123', 20, 'Training Session', '2023-03-11 10:28:00', 339),
(77, 83328559508, 'Admin123', 20, 'Training Session', '2023-03-25 22:45:00', 339);

-- --------------------------------------------------------

--
-- Table structure for table `uni_master`
--

CREATE TABLE `uni_master` (
  `uni_id` int(6) NOT NULL,
  `uni` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `uni_master`
--

INSERT INTO `uni_master` (`uni_id`, `uni`) VALUES
(6, 'Gls university'),
(1, 'GTU'),
(8, 'IIT'),
(3, 'Nirma university'),
(44, 'NSUT');

-- --------------------------------------------------------

--
-- Table structure for table `user_doc_master`
--

CREATE TABLE `user_doc_master` (
  `doc_id` int(11) NOT NULL,
  `Doc` varchar(255) NOT NULL,
  `doc_no` int(10) NOT NULL,
  `u_id` int(6) NOT NULL,
  `doc_type_id` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user_education`
--

CREATE TABLE `user_education` (
  `u_edu_id` int(6) NOT NULL,
  `degree_certi_doc` varchar(255) NOT NULL,
  `u_id` int(6) NOT NULL,
  `degree_id` int(6) NOT NULL,
  `uni_id` int(6) NOT NULL,
  `clg_id` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_education`
--

INSERT INTO `user_education` (`u_edu_id`, `degree_certi_doc`, `u_id`, `degree_id`, `uni_id`, `clg_id`) VALUES
(178, '', 89, 4, 1, 2),
(184, 'CE6_NMA-P8,9.pdf', 92, 4, 1, 2),
(252, 'CE6_NMA-P1,2,3.pdf', 126, 53, 1, 1),
(330, '', 165, 53, 1, 3),
(640, 'GTPL_MCAD_CHAP_1.pdf', 320, 53, 8, 5),
(678, '3340705-DIPLOMA-WINTER-2020.pdf', 339, 4, 8, 5),
(734, '', 367, 4, 1, 2),
(1562, '', 781, 4, 1, 3),
(1640, '', 820, 4, 1, 2),
(1694, '', 847, 4, 1, 1),
(1870, '', 935, 4, 8, 5);

-- --------------------------------------------------------

--
-- Table structure for table `user_leave`
--

CREATE TABLE `user_leave` (
  `leave_id` int(11) NOT NULL,
  `leave_type_id` int(11) NOT NULL,
  `u_id` int(11) NOT NULL,
  `ls_date` date NOT NULL,
  `le_date` date NOT NULL,
  `no_leave` int(11) NOT NULL,
  `leave_reason` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `rej_reason` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_leave`
--

INSERT INTO `user_leave` (`leave_id`, `leave_type_id`, `u_id`, `ls_date`, `le_date`, `no_leave`, `leave_reason`, `status`, `rej_reason`) VALUES
(40, 1, 805, '2023-03-01', '2023-03-15', 14, 'Meet in bali', 2, 'Company funds Transfered'),
(65, 50, 339, '2023-03-25', '2023-03-29', 4, 'Have a fever', 2, 'Provided Genuine Doctors Certi'),
(72, 50, 971, '2023-03-22', '2023-03-31', 9, 'I have a bad stomachache', 1, 'Work Pending'),
(80, 1, 971, '2023-03-01', '2023-03-08', 7, 'Meet in Pakistan', 1, 'Not valid country'),
(91, 1, 971, '2023-03-16', '2023-03-29', 13, 'I have company meeting in bali', 2, 'Your funds have been approved'),
(92, 1, 805, '2023-04-05', '2023-04-07', 2, 'Meet in indonesia', 3, 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `user_master`
--

CREATE TABLE `user_master` (
  `u_id` int(4) NOT NULL,
  `u_name` varchar(20) NOT NULL,
  `u_email` varchar(255) NOT NULL,
  `u_pass` varchar(255) NOT NULL,
  `u_contact` bigint(10) NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `u_doj` date NOT NULL,
  `u_dob` date NOT NULL,
  `state_id` int(6) NOT NULL,
  `city_id` int(6) NOT NULL,
  `area_id` int(6) NOT NULL,
  `role_id` int(6) NOT NULL,
  `desg_id` int(6) NOT NULL,
  `dept_id` int(6) NOT NULL,
  `gender` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_master`
--

INSERT INTO `user_master` (`u_id`, `u_name`, `u_email`, `u_pass`, `u_contact`, `is_active`, `u_doj`, `u_dob`, `state_id`, `city_id`, `area_id`, `role_id`, `desg_id`, `dept_id`, `gender`) VALUES
(92, 'Raxshit', 'xyz@gmail.com', 'Raxeat@2004', 8980022426, 0, '2023-03-23', '2005-03-10', 13, 54, 21, 0, 15, 32, 0),
(126, 'Kashish', 'kashish@gmail.com', 'Kashish@2004', 6353111111, 1, '2023-04-05', '2005-03-28', 13, 54, 21, 0, 8, 125, 1),
(165, 'Kalpesh', 'kalpesh@gmail.com', 'Sweta@2004', 9825412408, 0, '2023-03-24', '2004-10-22', 13, 55, 20, 1, 8, 125, 1),
(320, 'Admin', 'admin@gmail.com', 'Qwe@2004', 1256789034, 0, '2023-03-27', '2005-03-17', 13, 54, 21, 1, 8, 125, 1),
(339, 'Dhruvv', 'dhruvkalpeshthakkar@gmail.com', 'Dkt@2004', 8980022423, 0, '2023-03-02', '2010-07-09', 13, 54, 210, 2, 8, 125, 1),
(805, 'Dhrubesh', 'qwe@gmail.com', 'Qwee@2004', 9876543200, 0, '2023-03-12', '2005-03-03', 13, 54, 210, 2, 15, 32, 1),
(847, 'Dhrubesh', 'poi@gmail.com', 'Dp@20041', 8765432101, 1, '2023-03-23', '2005-03-23', 13, 55, 20, 1, 15, 32, 1),
(971, 'Dev', 'devmodi@gmail.com', 'Dev@2004', 1234567890, 0, '2023-03-13', '2005-03-03', 13, 54, 210, 2, 37, 125, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_professional_detail`
--

CREATE TABLE `user_professional_detail` (
  `prof_id` int(6) NOT NULL,
  `employer` varchar(255) NOT NULL,
  `prev_doj` date NOT NULL,
  `prev_dol` date NOT NULL,
  `salary` int(10) NOT NULL,
  `prev_designation` varchar(255) NOT NULL,
  `u_id` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_professional_detail`
--

INSERT INTO `user_professional_detail` (`prof_id`, `employer`, `prev_doj`, `prev_dol`, `salary`, `prev_designation`, `u_id`) VALUES
(617, 'infosys', '2023-02-28', '2023-03-03', 2000000, 'Sr Developer', 92),
(736, 'tcs', '2023-03-01', '2023-03-03', 2000000, 'Jr Developer', 339);

-- --------------------------------------------------------

--
-- Table structure for table `user_salary`
--

CREATE TABLE `user_salary` (
  `sal_id` int(6) NOT NULL,
  `m_salary` float NOT NULL,
  `y_salary` float NOT NULL,
  `work_days` float NOT NULL,
  `lv_days` float NOT NULL,
  `lwp` float NOT NULL,
  `tds` float NOT NULL,
  `pf` float NOT NULL,
  `pt` float NOT NULL,
  `net_payable_salary` float NOT NULL,
  `u_id` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_salary`
--

INSERT INTO `user_salary` (`sal_id`, `m_salary`, `y_salary`, `work_days`, `lv_days`, `lwp`, `tds`, `pf`, `pt`, `net_payable_salary`, `u_id`) VALUES
(2, 20000, 240000, 3, 2, 2, 2, 2, 2, 1, 339),
(3, 1000000, 12000000, 1, 1, 1, 1, 1, 1, 1, 126);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `area_master`
--
ALTER TABLE `area_master`
  ADD PRIMARY KEY (`area_id`),
  ADD KEY `city_id` (`city_id`),
  ADD KEY `state_id` (`state_id`);

--
-- Indexes for table `city_master`
--
ALTER TABLE `city_master`
  ADD PRIMARY KEY (`city_id`),
  ADD KEY `state_id` (`state_id`);

--
-- Indexes for table `college_master`
--
ALTER TABLE `college_master`
  ADD PRIMARY KEY (`clg_id`),
  ADD UNIQUE KEY `clg_name` (`clg_name`),
  ADD KEY `uni_id` (`uni_id`);

--
-- Indexes for table `degree_master`
--
ALTER TABLE `degree_master`
  ADD PRIMARY KEY (`degree_id`),
  ADD UNIQUE KEY `degree_field` (`degree_field`);

--
-- Indexes for table `dept_master`
--
ALTER TABLE `dept_master`
  ADD PRIMARY KEY (`dept_id`),
  ADD UNIQUE KEY `dept_name` (`dept_name`);

--
-- Indexes for table `designation_master`
--
ALTER TABLE `designation_master`
  ADD PRIMARY KEY (`desi_id`),
  ADD UNIQUE KEY `desi_name` (`desi_name`),
  ADD KEY `dept_id` (`dept_id`);

--
-- Indexes for table `doc_type_master`
--
ALTER TABLE `doc_type_master`
  ADD PRIMARY KEY (`doc_type_id`),
  ADD UNIQUE KEY `doc_type` (`doc_type`);

--
-- Indexes for table `issue`
--
ALTER TABLE `issue`
  ADD PRIMARY KEY (`issue_id`),
  ADD KEY `u_id` (`u_id`);

--
-- Indexes for table `leave_balance`
--
ALTER TABLE `leave_balance`
  ADD PRIMARY KEY (`bal_id`),
  ADD KEY `u_id` (`u_id`),
  ADD KEY `leave_type_id` (`leave_type_id`);

--
-- Indexes for table `leave_type_master`
--
ALTER TABLE `leave_type_master`
  ADD PRIMARY KEY (`leave_type_id`),
  ADD UNIQUE KEY `leave_type` (`leave_type`),
  ADD UNIQUE KEY `leave_short_form` (`leave_short_form`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`notify_id`),
  ADD KEY `u_id` (`u_id`);

--
-- Indexes for table `role_master`
--
ALTER TABLE `role_master`
  ADD PRIMARY KEY (`role_id`),
  ADD UNIQUE KEY `role_name` (`role_name`);

--
-- Indexes for table `state_master`
--
ALTER TABLE `state_master`
  ADD PRIMARY KEY (`state_id`),
  ADD UNIQUE KEY `state` (`state`);

--
-- Indexes for table `training_master`
--
ALTER TABLE `training_master`
  ADD PRIMARY KEY (`t_id`),
  ADD KEY `u_id` (`u_id`);

--
-- Indexes for table `uni_master`
--
ALTER TABLE `uni_master`
  ADD PRIMARY KEY (`uni_id`),
  ADD UNIQUE KEY `uni` (`uni`);

--
-- Indexes for table `user_doc_master`
--
ALTER TABLE `user_doc_master`
  ADD PRIMARY KEY (`doc_id`),
  ADD KEY `doc_type_id` (`doc_type_id`),
  ADD KEY `u_id` (`u_id`);

--
-- Indexes for table `user_education`
--
ALTER TABLE `user_education`
  ADD PRIMARY KEY (`u_edu_id`),
  ADD KEY `u_id` (`u_id`),
  ADD KEY `clg_id` (`clg_id`),
  ADD KEY `uni_id` (`uni_id`),
  ADD KEY `degree_id` (`degree_id`);

--
-- Indexes for table `user_leave`
--
ALTER TABLE `user_leave`
  ADD PRIMARY KEY (`leave_id`),
  ADD KEY `leave_type_id` (`leave_type_id`),
  ADD KEY `u_id` (`u_id`);

--
-- Indexes for table `user_master`
--
ALTER TABLE `user_master`
  ADD PRIMARY KEY (`u_id`),
  ADD KEY `area_id` (`area_id`),
  ADD KEY `city_id` (`city_id`),
  ADD KEY `dept_id` (`dept_id`),
  ADD KEY `desg_id` (`desg_id`),
  ADD KEY `role_id` (`role_id`),
  ADD KEY `state_id` (`state_id`);

--
-- Indexes for table `user_professional_detail`
--
ALTER TABLE `user_professional_detail`
  ADD PRIMARY KEY (`prof_id`),
  ADD KEY `u_id` (`u_id`);

--
-- Indexes for table `user_salary`
--
ALTER TABLE `user_salary`
  ADD PRIMARY KEY (`sal_id`),
  ADD KEY `u_id` (`u_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `leave_balance`
--
ALTER TABLE `leave_balance`
  MODIFY `bal_id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `user_leave`
--
ALTER TABLE `user_leave`
  MODIFY `leave_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;

--
-- AUTO_INCREMENT for table `user_salary`
--
ALTER TABLE `user_salary`
  MODIFY `sal_id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `area_master`
--
ALTER TABLE `area_master`
  ADD CONSTRAINT `area_master_ibfk_1` FOREIGN KEY (`city_id`) REFERENCES `city_master` (`city_id`),
  ADD CONSTRAINT `area_master_ibfk_2` FOREIGN KEY (`state_id`) REFERENCES `state_master` (`state_id`);

--
-- Constraints for table `city_master`
--
ALTER TABLE `city_master`
  ADD CONSTRAINT `city_master_ibfk_1` FOREIGN KEY (`state_id`) REFERENCES `state_master` (`state_id`);

--
-- Constraints for table `college_master`
--
ALTER TABLE `college_master`
  ADD CONSTRAINT `college_master_ibfk_1` FOREIGN KEY (`uni_id`) REFERENCES `uni_master` (`uni_id`);

--
-- Constraints for table `designation_master`
--
ALTER TABLE `designation_master`
  ADD CONSTRAINT `designation_master_ibfk_1` FOREIGN KEY (`dept_id`) REFERENCES `dept_master` (`dept_id`);

--
-- Constraints for table `leave_balance`
--
ALTER TABLE `leave_balance`
  ADD CONSTRAINT `leave_balance_ibfk_1` FOREIGN KEY (`leave_type_id`) REFERENCES `leave_type_master` (`leave_type_id`),
  ADD CONSTRAINT `leave_balance_ibfk_2` FOREIGN KEY (`u_id`) REFERENCES `user_master` (`u_id`);

--
-- Constraints for table `training_master`
--
ALTER TABLE `training_master`
  ADD CONSTRAINT `training_master_ibfk_1` FOREIGN KEY (`u_id`) REFERENCES `user_master` (`u_id`);

--
-- Constraints for table `user_leave`
--
ALTER TABLE `user_leave`
  ADD CONSTRAINT `user_leave_ibfk_1` FOREIGN KEY (`leave_type_id`) REFERENCES `leave_type_master` (`leave_type_id`),
  ADD CONSTRAINT `user_leave_ibfk_2` FOREIGN KEY (`u_id`) REFERENCES `user_master` (`u_id`);

--
-- Constraints for table `user_master`
--
ALTER TABLE `user_master`
  ADD CONSTRAINT `user_master_ibfk_1` FOREIGN KEY (`area_id`) REFERENCES `area_master` (`area_id`),
  ADD CONSTRAINT `user_master_ibfk_2` FOREIGN KEY (`city_id`) REFERENCES `city_master` (`city_id`),
  ADD CONSTRAINT `user_master_ibfk_3` FOREIGN KEY (`dept_id`) REFERENCES `dept_master` (`dept_id`),
  ADD CONSTRAINT `user_master_ibfk_4` FOREIGN KEY (`desg_id`) REFERENCES `designation_master` (`desi_id`),
  ADD CONSTRAINT `user_master_ibfk_5` FOREIGN KEY (`role_id`) REFERENCES `role_master` (`role_id`),
  ADD CONSTRAINT `user_master_ibfk_6` FOREIGN KEY (`state_id`) REFERENCES `state_master` (`state_id`);

--
-- Constraints for table `user_professional_detail`
--
ALTER TABLE `user_professional_detail`
  ADD CONSTRAINT `user_professional_detail_ibfk_1` FOREIGN KEY (`u_id`) REFERENCES `user_master` (`u_id`);

--
-- Constraints for table `user_salary`
--
ALTER TABLE `user_salary`
  ADD CONSTRAINT `user_salary_ibfk_1` FOREIGN KEY (`u_id`) REFERENCES `user_master` (`u_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
