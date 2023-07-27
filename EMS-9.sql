-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 03, 2023 at 12:47 PM
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
(1, 'Satellite', 1, 1),
(2, 'juhu', 2, 2);

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
(1, 'Ahmedabad', 1),
(2, 'mumbai', 2);

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
(1, 'L.J POLYTECHNIC', 1),
(2, 'private', 2);

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
(2, 'B.Com'),
(1, 'B.Tech');

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
(2, 'development'),
(1, 'Managment');

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
(1, 'Sr.Manager', 1),
(2, 'sr developer', 2);

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
(11, 10, 1, 3),
(12, 5, 2, 3),
(16, 10, 5, 3),
(17, 10, 5, 3);

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
(1, 'Maternity Leave', 'ML'),
(2, 'Unpaid Leave', 'UL'),
(3, 'Paid Leave', 'PL');

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `noti_id` int(6) NOT NULL,
  `notifications` varchar(255) NOT NULL,
  `u_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `notification`
--

INSERT INTO `notification` (`noti_id`, `notifications`, `u_id`) VALUES
(1, 'Holiday tomorrow', 1),
(12, 'deadline', 2),
(13, 'dealine for project zues tomorrow', 2);

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
(1, 'Gujrat'),
(2, 'maharashtra');

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
(1, 85022589653, 'Admin123', 20, 'Training Session', '2023-05-02 09:48:00', 2),
(3, 85161132887, 'Admin123', 30, 'Training Session', '2023-05-13 09:54:00', 2),
(4, 82455625472, 'Admin123', 40, 'Training Session', '2023-05-27 09:54:00', 2);

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
(1, 'GTU'),
(2, 'nirma');

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
(1, 'CE6_NMA-P13,14.pdf', 2, 1, 1, 1),
(4, '', 5, 1, 1, 1);

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
(94, 3, 2, '2023-05-01', '2023-05-03', 2, 'meet in bali', 2, 'funds accepted');

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
(1, 'Vaibhavi', 'vaibhavi@gmail.com', 'va@2004', 1234567890, 0, '2023-05-02', '2023-05-03', 1, 1, 1, 1, 1, 1, 1),
(2, 'Dhruvv', 'dhruvkalpeshthakkar@gmail.com', 'Dhruv@2004', 8980022422, 0, '2023-05-01', '2005-05-01', 1, 1, 1, 0, 1, 1, 1),
(5, 'Dhrubesh', 'dhruvesh@gmail.com', 'Dap@2004', 987654321, 0, '2023-12-31', '2004-12-31', 1, 1, 1, 2, 2, 2, 1);

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
(9, 'infosys', '2021-01-01', '2021-01-02', 200000, 'Sr Developer', 2);

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
(4, 10000, 120000, 1, 1, 1, 1, 1, 1, 115200, 2),
(7, 10000, 120000, 1, 1, 1, 1, 1, 1, 115200, 5);

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
  ADD PRIMARY KEY (`noti_id`),
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
-- Indexes for table `user_education`
--
ALTER TABLE `user_education`
  ADD PRIMARY KEY (`u_edu_id`),
  ADD KEY `user_education_ibfk_1` (`degree_id`),
  ADD KEY `user_education_ibfk_2` (`clg_id`),
  ADD KEY `user_education_ibfk_3` (`uni_id`),
  ADD KEY `user_education_ibfk_4` (`u_id`);

--
-- Indexes for table `user_leave`
--
ALTER TABLE `user_leave`
  ADD PRIMARY KEY (`leave_id`),
  ADD KEY `user_leave_ibfk_1` (`leave_type_id`),
  ADD KEY `user_leave_ibfk_2` (`u_id`);

--
-- Indexes for table `user_master`
--
ALTER TABLE `user_master`
  ADD PRIMARY KEY (`u_id`),
  ADD KEY `state_id` (`state_id`),
  ADD KEY `area_id` (`area_id`),
  ADD KEY `city_id` (`city_id`),
  ADD KEY `dept_id` (`dept_id`),
  ADD KEY `desg_id` (`desg_id`),
  ADD KEY `role_id` (`role_id`);

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
  ADD KEY `user_salary_ibfk_1` (`u_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `area_master`
--
ALTER TABLE `area_master`
  MODIFY `area_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `city_master`
--
ALTER TABLE `city_master`
  MODIFY `city_id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `college_master`
--
ALTER TABLE `college_master`
  MODIFY `clg_id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `degree_master`
--
ALTER TABLE `degree_master`
  MODIFY `degree_id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `dept_master`
--
ALTER TABLE `dept_master`
  MODIFY `dept_id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `designation_master`
--
ALTER TABLE `designation_master`
  MODIFY `desi_id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `issue`
--
ALTER TABLE `issue`
  MODIFY `issue_id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `leave_balance`
--
ALTER TABLE `leave_balance`
  MODIFY `bal_id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `leave_type_master`
--
ALTER TABLE `leave_type_master`
  MODIFY `leave_type_id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `noti_id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `state_master`
--
ALTER TABLE `state_master`
  MODIFY `state_id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `training_master`
--
ALTER TABLE `training_master`
  MODIFY `t_id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `uni_master`
--
ALTER TABLE `uni_master`
  MODIFY `uni_id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user_education`
--
ALTER TABLE `user_education`
  MODIFY `u_edu_id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user_leave`
--
ALTER TABLE `user_leave`
  MODIFY `leave_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;

--
-- AUTO_INCREMENT for table `user_master`
--
ALTER TABLE `user_master`
  MODIFY `u_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user_professional_detail`
--
ALTER TABLE `user_professional_detail`
  MODIFY `prof_id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `user_salary`
--
ALTER TABLE `user_salary`
  MODIFY `sal_id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

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
-- Constraints for table `issue`
--
ALTER TABLE `issue`
  ADD CONSTRAINT `issue_ibfk_1` FOREIGN KEY (`u_id`) REFERENCES `user_master` (`u_id`);

--
-- Constraints for table `leave_balance`
--
ALTER TABLE `leave_balance`
  ADD CONSTRAINT `leave_balance_ibfk_1` FOREIGN KEY (`leave_type_id`) REFERENCES `leave_type_master` (`leave_type_id`);

--
-- Constraints for table `notification`
--
ALTER TABLE `notification`
  ADD CONSTRAINT `notification_ibfk_1` FOREIGN KEY (`u_id`) REFERENCES `user_master` (`u_id`);

--
-- Constraints for table `training_master`
--
ALTER TABLE `training_master`
  ADD CONSTRAINT `training_master_ibfk_1` FOREIGN KEY (`u_id`) REFERENCES `user_master` (`u_id`);

--
-- Constraints for table `user_education`
--
ALTER TABLE `user_education`
  ADD CONSTRAINT `user_education_ibfk_1` FOREIGN KEY (`degree_id`) REFERENCES `degree_master` (`degree_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_education_ibfk_2` FOREIGN KEY (`clg_id`) REFERENCES `college_master` (`clg_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_education_ibfk_3` FOREIGN KEY (`uni_id`) REFERENCES `uni_master` (`uni_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_education_ibfk_4` FOREIGN KEY (`u_id`) REFERENCES `user_master` (`u_id`) ON DELETE CASCADE;

--
-- Constraints for table `user_leave`
--
ALTER TABLE `user_leave`
  ADD CONSTRAINT `user_leave_ibfk_1` FOREIGN KEY (`leave_type_id`) REFERENCES `leave_type_master` (`leave_type_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_leave_ibfk_2` FOREIGN KEY (`u_id`) REFERENCES `user_master` (`u_id`) ON DELETE CASCADE;

--
-- Constraints for table `user_master`
--
ALTER TABLE `user_master`
  ADD CONSTRAINT `user_master_ibfk_1` FOREIGN KEY (`state_id`) REFERENCES `state_master` (`state_id`),
  ADD CONSTRAINT `user_master_ibfk_2` FOREIGN KEY (`area_id`) REFERENCES `area_master` (`area_id`),
  ADD CONSTRAINT `user_master_ibfk_3` FOREIGN KEY (`city_id`) REFERENCES `city_master` (`city_id`),
  ADD CONSTRAINT `user_master_ibfk_4` FOREIGN KEY (`dept_id`) REFERENCES `dept_master` (`dept_id`),
  ADD CONSTRAINT `user_master_ibfk_5` FOREIGN KEY (`desg_id`) REFERENCES `designation_master` (`desi_id`),
  ADD CONSTRAINT `user_master_ibfk_6` FOREIGN KEY (`role_id`) REFERENCES `role_master` (`role_id`);

--
-- Constraints for table `user_professional_detail`
--
ALTER TABLE `user_professional_detail`
  ADD CONSTRAINT `user_professional_detail_ibfk_1` FOREIGN KEY (`u_id`) REFERENCES `user_master` (`u_id`);

--
-- Constraints for table `user_salary`
--
ALTER TABLE `user_salary`
  ADD CONSTRAINT `user_salary_ibfk_1` FOREIGN KEY (`u_id`) REFERENCES `user_master` (`u_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
