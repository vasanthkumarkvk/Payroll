-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 26, 2025 at 01:24 PM
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
-- Database: `pay`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_login`
--

CREATE TABLE `admin_login` (
  `id` int(11) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_login`
--

INSERT INTO `admin_login` (`id`, `full_name`, `email`, `username`, `password`, `created_at`) VALUES
(6, 'keerthana', 'bdm@vsmglobaltechnologies.com', 'admin1', '$2y$10$tlTtj44FFMyfwLqRkjjmGOvnEhlP2xz/UjMp.GTJkg2.z2Megaw4a', '2024-10-22 04:43:37'),
(7, 'vsm global technologies', 'keerthanavsm@gmail.com', 'vsm', '$2y$10$EuhKgcjOD7YfNi8q2Q1m1eN.Mo50nelKiua2gwbU90GBAWMPNLo.e', '2024-12-05 11:10:13'),
(9, 'vsm global technologies', 'vsmglobaltechnologies@gmail.com', 'vsmglobaltechnologies', '$2y$10$GbLOrE2Un2DHZTWrtKFtOOwkQcDM/7Jsen/E5YfYqX2JPbl1zfgkC', '2025-02-14 09:34:44');

-- --------------------------------------------------------

--
-- Table structure for table `advance_salary`
--

CREATE TABLE `advance_salary` (
  `id` int(11) NOT NULL,
  `employee_name` varchar(255) NOT NULL,
  `advance_amount` varchar(225) DEFAULT '0',
  `emi_amount` decimal(10,2) DEFAULT 0.00,
  `employee_user_id` varchar(100) NOT NULL,
  `advance_date` date NOT NULL,
  `salary` varchar(225) NOT NULL,
  `advance_month` int(11) NOT NULL,
  `advance_year` int(11) NOT NULL,
  `remaining_emi` decimal(10,2) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `advance_salary`
--

INSERT INTO `advance_salary` (`id`, `employee_name`, `advance_amount`, `emi_amount`, `employee_user_id`, `advance_date`, `salary`, `advance_month`, `advance_year`, `remaining_emi`, `created_at`) VALUES
(37, 'john', '0', 0.00, 'VSM-22713F', '0000-00-00', '', 0, 0, NULL, '2025-01-02 09:02:31'),
(39, 'venkatesh shanmugam', '0', 0.00, 'VSM-1D9A57', '0000-00-00', '', 0, 0, NULL, '2025-01-20 06:07:37'),
(40, 'yuvarani', '0', 0.00, 'VSM-01F984', '0000-00-00', '', 0, 0, NULL, '2025-02-10 07:43:13'),
(41, 'Keerthana N', '0', 0.00, 'VSM-BC6C4F', '0000-00-00', '', 0, 0, NULL, '2025-02-13 07:36:15'),
(42, 'Veenabai S', '0', 0.00, 'VSM-C24AEE', '0000-00-00', '', 0, 0, NULL, '2025-02-17 12:48:28'),
(43, 'B.Ramesh', '0', 0.00, 'VSM-93ADCC', '0000-00-00', '', 0, 0, NULL, '2025-02-26 06:43:37'),
(45, 'Keerthana', '0', 0.00, 'VSM-BC6C4F', '0000-00-00', '', 0, 0, NULL, '2025-02-26 11:27:57');

-- --------------------------------------------------------

--
-- Table structure for table `approvals`
--

CREATE TABLE `approvals` (
  `request_id` int(11) NOT NULL,
  `employee_user_id` varchar(10) NOT NULL,
  `employee_name` varchar(100) NOT NULL,
  `request_type` varchar(50) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `submission_date` date NOT NULL,
  `status` enum('Pending','Approved','Denied') DEFAULT 'Pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `company_info`
--

CREATE TABLE `company_info` (
  `id` int(11) NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `company_address` text NOT NULL,
  `company_email` varchar(255) NOT NULL,
  `company_phone` varchar(20) NOT NULL,
  `company_website` varchar(255) DEFAULT NULL,
  `company_registration_number` varchar(255) DEFAULT NULL,
  `company_tin` varchar(255) DEFAULT NULL,
  `company_gstin` varchar(255) DEFAULT NULL,
  `bank_name` varchar(255) DEFAULT NULL,
  `bank_account_number` varchar(255) DEFAULT NULL,
  `ifsc_swift_code` varchar(255) DEFAULT NULL,
  `bank_branch` varchar(255) DEFAULT NULL,
  `payment_terms` text DEFAULT NULL,
  `currency` varchar(50) DEFAULT NULL,
  `total_employees` int(11) DEFAULT NULL,
  `active_employees` int(11) DEFAULT NULL,
  `employee_types` text DEFAULT NULL,
  `department_distribution` text DEFAULT NULL,
  `salary_cycle` varchar(50) DEFAULT NULL,
  `salary_components` text DEFAULT NULL,
  `deductions` text DEFAULT NULL,
  `bonus_incentive_policies` text DEFAULT NULL,
  `leave_attendance_policies` text DEFAULT NULL,
  `pf_account_number` varchar(255) DEFAULT NULL,
  `esi_number` varchar(255) DEFAULT NULL,
  `tax_registration` varchar(255) DEFAULT NULL,
  `epf_employer_rate` decimal(5,2) DEFAULT NULL,
  `esi_employer_rate` decimal(5,2) DEFAULT NULL,
  `tax_year_start` date DEFAULT NULL,
  `tax_year_end` date DEFAULT NULL,
  `corporate_tax_details` text DEFAULT NULL,
  `tax_filing_frequency` varchar(50) DEFAULT NULL,
  `employer_tax_contribution` text DEFAULT NULL,
  `working_hours_policy` text DEFAULT NULL,
  `overtime_policy` text DEFAULT NULL,
  `holidays_list` text DEFAULT NULL,
  `company_policy_docs` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `company_info`
--

INSERT INTO `company_info` (`id`, `company_name`, `company_address`, `company_email`, `company_phone`, `company_website`, `company_registration_number`, `company_tin`, `company_gstin`, `bank_name`, `bank_account_number`, `ifsc_swift_code`, `bank_branch`, `payment_terms`, `currency`, `total_employees`, `active_employees`, `employee_types`, `department_distribution`, `salary_cycle`, `salary_components`, `deductions`, `bonus_incentive_policies`, `leave_attendance_policies`, `pf_account_number`, `esi_number`, `tax_registration`, `epf_employer_rate`, `esi_employer_rate`, `tax_year_start`, `tax_year_end`, `corporate_tax_details`, `tax_filing_frequency`, `employer_tax_contribution`, `working_hours_policy`, `overtime_policy`, `holidays_list`, `company_policy_docs`) VALUES
(1, 'VSM Global Technologies', '5A, AGNI MAPLE, Pada Salai St, Nookampalayam, nagar, Perumbakkam, Chennai, Tamil Nadu 600130', ' info@vsmglobaltechnologies.com', '+91-97909 73187', 'https://vsmglobaltechnologies.com/', '-', '-', '-', '-', '-', '-', '-', '-', 'INR', 5, 5, 'Full-time, Part-time', '-', 'Monthly', '-', '-', 'Performance Incentives', '-', '-', '-', '-', 0.00, 0.00, '2024-04-01', '2025-03-31', '-', '-', '-', '9:30 to 6:00', 'null', 'New year ,\r\nPongal Festival ,\r\nMaattu pongal ,\r\nRepublic Day , \r\nGood Friday ,\r\nTamil newyear ,\r\nLabour Day ,\r\nId-Ul-Zuha(Bakrid) ,\r\nIndependence Day ,\r\nAyudha Pooja ,\r\nDiwali ,\r\nChristmas ', '../uploads/VSM Global Technologies- Company Policies & Guidelines.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `employee_details`
--

CREATE TABLE `employee_details` (
  `employee_id` int(11) NOT NULL,
  `employee_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `designation` varchar(100) DEFAULT NULL,
  `hire_date` date DEFAULT NULL,
  `department` varchar(100) DEFAULT NULL,
  `location` varchar(100) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `bank_name` varchar(100) DEFAULT NULL,
  `bank_branch` varchar(100) DEFAULT NULL,
  `ifce_number` varchar(20) DEFAULT NULL,
  `account_number` varchar(50) DEFAULT NULL,
  `account_type` enum('Savings','Current') DEFAULT 'Savings',
  `dob` date DEFAULT NULL,
  `gender` enum('Male','Female','Other') DEFAULT 'Other',
  `phone_number` varchar(15) NOT NULL,
  `document_path` varchar(255) DEFAULT NULL,
  `employee_type` enum('Permanent','Contract','Intern') DEFAULT 'Permanent',
  `qualification` varchar(100) DEFAULT NULL,
  `resigned_date` date DEFAULT NULL,
  `emergency_number` varchar(15) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `manual_salary`
--

CREATE TABLE `manual_salary` (
  `id` int(11) NOT NULL,
  `user_id` varchar(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `joining_date` date NOT NULL,
  `designation` varchar(255) NOT NULL,
  `resigned_date` date DEFAULT NULL,
  `month` int(11) NOT NULL,
  `year` int(11) NOT NULL,
  `gross` decimal(10,2) NOT NULL,
  `salary` decimal(10,2) NOT NULL,
  `incentive` decimal(10,2) NOT NULL DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `manual_salary`
--

INSERT INTO `manual_salary` (`id`, `user_id`, `email`, `name`, `joining_date`, `designation`, `resigned_date`, `month`, `year`, `gross`, `salary`, `incentive`) VALUES
(2, 'V0720227	', 'angalaeswari@vsmglobaltechnologies.com', 'Angalaeswari', '2022-07-04', 'It analyst', '2022-12-09', 8, 2022, 8000.00, 2000.00, 0.00),
(3, 'V0720227	', 'angalaeswari@vsmglobaltechnologies.com', 'Angalaeswari', '2022-07-04', 'It analyst', '2022-12-09', 9, 2022, 8000.00, 0.00, 0.00),
(4, 'V0720227	', 'angalaeswari@vsmglobaltechnologies.com', 'Angalaeswari', '2022-07-04', 'It analyst', '2022-12-09', 10, 2022, 8000.00, 5161.00, 0.00),
(5, 'V0720227	', 'angalaeswari@vsmglobaltechnologies.com', 'Angalaeswari', '2022-07-04', 'It analyst', '2022-12-09', 11, 2022, 8000.00, 7733.00, 0.00),
(6, 'V0720227	', 'angalaeswari@vsmglobaltechnologies.com', 'Angalaeswari', '2022-07-04', 'It analyst', '2022-12-09', 12, 2022, 8000.00, 2900.00, 0.00),
(7, 'V0220238', 'latha@vsmglobaltechnologies.com', 'Latha Gokulnath', '2023-02-01', 'Senior specialist', '2023-08-08', 2, 2023, 10000.00, 10750.00, 750.00),
(8, 'V0220238', 'latha@vsmglobaltechnologies.com', 'Latha Gokulnath', '2023-02-01', 'Senior specialist', '2023-08-08', 3, 2023, 10000.00, 10750.00, 750.00),
(9, 'V0220238', 'latha@vsmglobaltechnologies.com', 'Latha Gokulnath', '2023-02-01', 'Senior specialist', '2023-08-08', 4, 2023, 10000.00, 12250.00, 2250.00),
(10, 'V0220238', 'latha@vsmglobaltechnologies.com', 'Latha Gokulnath', '2023-02-01', 'Senior specialist', '2023-08-08', 5, 2023, 10000.00, 0.00, 0.00),
(11, 'V0220238', 'latha@vsmglobaltechnologies.com', 'Latha Gokulnath', '2023-02-01', 'Senior specialist', '2023-08-08', 6, 2023, 10000.00, 4700.00, 0.00),
(12, 'V0220238', 'latha@vsmglobaltechnologies.com', 'Latha Gokulnath', '2023-02-01', 'Senior specialist', '2023-08-08', 7, 2023, 10000.00, 10177.00, 177.00),
(13, 'V0220238', 'latha@vsmglobaltechnologies.com', 'Latha Gokulnath', '2023-02-01', 'Senior specialist', '2023-08-08', 8, 2023, 10000.00, 1613.00, 0.00),
(14, 'V0620239', 'suganya@vsmglobaltechnologies.com', 'Suganya', '2023-06-21', 'Business development management specialist', '2023-07-12', 6, 2023, 8000.00, 3200.00, 0.00),
(15, 'V06202315	', 'anitha@vsmglobaltechnologies.com', 'Anitha', '2023-06-08', 'Marketing Manager', '2023-07-08', 1, 2023, 18000.00, 13200.00, 0.00),
(16, 'V1020239	', 'muthulakshmi@vsmglobaltechnologies.com', 'Muthulakshmi', '2023-10-04', 'Developer', '2024-01-05', 10, 2023, 12000.00, 11613.00, 0.00),
(17, 'V1020239	', 'muthulakshmi@vsmglobaltechnologies.com', 'Muthulakshmi', '2023-10-04', 'Developer', '2024-01-05', 11, 2023, 12000.00, 5613.00, 0.00),
(18, 'V1020239	', 'muthulakshmi@vsmglobaltechnologies.com', 'Muthulakshmi', '2023-10-04', 'Developer', '2024-01-05', 12, 2023, 12000.00, 1160.00, 0.00),
(19, 'V08202310', 'jeyaeswarivivek@vsmglobaltechnologies.com', 'Jeya Eswari Vivek', '2023-08-17', 'Business development management specialist', '2024-02-05', 8, 2023, 9000.00, 7840.00, 0.00),
(20, 'V08202310', 'jeyaeswarivivek@vsmglobaltechnologies.com', 'Jeya Eswari Vivek', '2023-08-17', 'Business development management specialist', '2024-02-05', 9, 2023, 9000.00, 9000.00, 0.00),
(21, 'V08202310', 'jeyaeswarivivek@vsmglobaltechnologies.com', 'Jeya Eswari Vivek', '2023-08-17', 'Business development management specialist', '2024-02-05', 10, 2023, 9000.00, 8758.00, 0.00),
(22, 'V08202310', 'jeyaeswarivivek@vsmglobaltechnologies.com', 'Jeya Eswari Vivek', '2023-08-17', 'Business development management specialist', '2024-02-05', 11, 2023, 9000.00, 11000.00, 2000.00),
(23, 'V08202310', 'jeyaeswarivivek@vsmglobaltechnologies.com', 'Jeya Eswari Vivek', '2023-08-17', 'Business development management specialist', '2024-02-05', 12, 2023, 9000.00, 9419.00, 419.00),
(24, 'V08202310', 'jeyaeswarivivek@vsmglobaltechnologies.com', 'Jeya Eswari Vivek', '2023-08-17', 'Business development management specialist', '2024-02-05', 1, 2024, 9000.00, 9500.00, 500.00),
(25, 'V12202311', 'jeevitha@vsmglobaltechnologies.com', 'Jeevitha', '2023-12-01', 'Graphic Designer', '2024-06-29', 12, 2023, 15000.00, 10161.00, 0.00),
(26, 'V12202311', 'jeevitha@vsmglobaltechnologies.com', 'Jeevitha', '2023-12-01', 'Graphic Designer', '2024-06-29', 1, 2024, 15000.00, 11581.00, 0.00),
(27, 'V12202311', 'jeevitha@vsmglobaltechnologies.com', 'Jeevitha', '2023-12-01', 'Graphic Designer', '2024-06-29', 2, 2024, 15000.00, 13966.00, 0.00),
(28, 'V12202311', 'jeevitha@vsmglobaltechnologies.com', 'Jeevitha', '2023-12-01', 'Graphic Designer', '2024-06-29', 3, 2024, 15000.00, 16008.00, 1008.00),
(29, 'V12202311', 'jeevitha@vsmglobaltechnologies.com', 'Jeevitha', '2023-12-01', 'Graphic Designer', '2024-06-29', 4, 2024, 15000.00, 15000.00, 0.00),
(30, 'V12202311', 'jeevitha@vsmglobaltechnologies.com', 'Jeevitha', '2023-12-01', 'Graphic Designer', '2024-06-29', 5, 2024, 15000.00, 12581.00, 0.00),
(31, 'V12202311', 'jeevitha@vsmglobaltechnologies.com', 'Jeevitha', '2023-12-01', 'Graphic Designer', '2024-06-29', 6, 2024, 15000.00, 13000.00, 0.00),
(32, 'V01202412', 'ajaykumar@vsmglobaltechnologies.com', 'Ajay Kumar', '2024-01-06', 'Developer', '2024-06-01', 1, 2024, 9000.00, 4000.00, 0.00),
(33, 'V01202412', 'ajaykumar@vsmglobaltechnologies.com', 'Ajay Kumar', '2024-01-06', 'Developer', '2024-06-01', 2, 2024, 9000.00, 8378.00, 0.00),
(34, 'V01202412', 'ajaykumar@vsmglobaltechnologies.com', 'Ajay Kumar', '2024-01-06', 'Developer', '2024-06-01', 3, 2024, 9000.00, 7548.00, 0.00),
(35, 'V01202412', 'ajaykumar@vsmglobaltechnologies.com', 'Ajay Kumar', '2024-01-06', 'Developer', '2024-06-01', 4, 2024, 9000.00, 7500.00, 0.00),
(36, 'V01202412', 'ajaykumar@vsmglobaltechnologies.com', 'Ajay Kumar', '2024-01-06', 'Developer', '2024-06-01', 5, 2024, 9000.00, 6968.00, 0.00),
(37, 'V05202413', 'dhanalakshmi@vsmglobaltechnologies.com', 'Dhanalakshmi', '2024-05-01', 'contract-support', '0000-00-00', 5, 2024, 9000.00, 6300.00, 0.00),
(38, 'V05202413', 'dhanalakshmi@vsmglobaltechnologies.com', 'Dhanalakshmi', '2024-05-01', 'contract-support', '0000-00-00', 6, 2024, 9000.00, 4850.00, 0.00),
(39, 'V09202414', 'neenaps@vsmglobaltechnologies.com', 'Neena PS', '2024-09-01', 'contract- support', '0000-00-00', 9, 2024, 9000.00, 2200.00, 0.00);

-- --------------------------------------------------------

--
-- Table structure for table `manual_update`
--

CREATE TABLE `manual_update` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `manual_update`
--

INSERT INTO `manual_update` (`id`, `email`) VALUES
(1, 'angalaeswari@vsmglobaltechnologies.com'),
(2, 'latha@vsmglobaltechnologies.com'),
(4, 'suganya@vsmglobaltechnologies.com'),
(5, 'anitha@vsmglobaltechnologies.com'),
(6, 'muthulakshmi@vsmglobaltechnologies.com'),
(7, 'jeyaeswarivivek@vsmglobaltechnologies.com'),
(8, 'jeevitha@vsmglobaltechnologies.com'),
(9, 'ajaykumar@vsmglobaltechnologies.com'),
(10, 'dhanalakshmi@vsmglobaltechnologies.com'),
(11, 'neenaps@vsmglobaltechnologies.com');

-- --------------------------------------------------------

--
-- Table structure for table `releve_apply`
--

CREATE TABLE `releve_apply` (
  `id` int(11) NOT NULL,
  `user_id` varchar(225) NOT NULL,
  `name` varchar(255) NOT NULL,
  `join_date` varchar(225) NOT NULL,
  `apply_date` varchar(225) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `releve_apply`
--

INSERT INTO `releve_apply` (`id`, `user_id`, `name`, `join_date`, `apply_date`, `created_at`) VALUES
(17, 'VSM-22713F', 'Vasanthakumar K', '', '03-01-2025', '2025-01-03 11:22:28'),
(18, 'VSM-22713F', 'Vasanthakumar K', '', '03-01-2025', '2025-01-03 11:23:04'),
(19, 'VSM-22713F', 'Vasanthakumar K', '', '03-01-2025', '2025-01-03 11:41:29'),
(20, 'VSM-85BDF4', 'Brintha R', '', '18-01-2025', '2025-01-18 10:26:19');

-- --------------------------------------------------------

--
-- Table structure for table `run_payslip`
--

CREATE TABLE `run_payslip` (
  `id` int(11) NOT NULL,
  `employee_user_id` varchar(20) NOT NULL,
  `employee_name` varchar(255) NOT NULL,
  `gross_salary` decimal(10,2) NOT NULL,
  `total_compensation` decimal(10,2) DEFAULT NULL,
  `availability_days` int(11) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `designation` varchar(100) DEFAULT NULL,
  `pay_month` int(11) NOT NULL,
  `pay_year` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `hire_date` date DEFAULT NULL,
  `job_title` varchar(100) DEFAULT NULL,
  `department` varchar(100) DEFAULT NULL,
  `manager` varchar(100) DEFAULT NULL,
  `location` varchar(100) DEFAULT NULL,
  `salary` decimal(10,2) DEFAULT NULL,
  `annual_salary` decimal(10,2) DEFAULT NULL,
  `ifsc_number` varchar(20) DEFAULT NULL,
  `bank_name` varchar(100) DEFAULT NULL,
  `branch_name` varchar(100) DEFAULT NULL,
  `account_number` varchar(30) DEFAULT NULL,
  `account_type` varchar(20) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `gender` enum('Male','Female','Other') DEFAULT NULL,
  `phone_number` varchar(15) DEFAULT NULL,
  `bonus` decimal(10,2) DEFAULT NULL,
  `employee_type` varchar(50) NOT NULL DEFAULT 'Full-time',
  `qualifications` varchar(255) DEFAULT NULL,
  `resigned_date` date DEFAULT NULL,
  `degree_certificate` varchar(225) DEFAULT NULL,
  `experiance_certificate` varchar(225) DEFAULT NULL,
  `course_certificate` varchar(225) DEFAULT NULL,
  `advance_amount` varchar(225) DEFAULT NULL,
  `emi_amount` varchar(225) DEFAULT NULL,
  `advance_date` varchar(225) DEFAULT NULL,
  `conformation_process` varchar(225) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `run_payslip`
--

INSERT INTO `run_payslip` (`id`, `employee_user_id`, `employee_name`, `gross_salary`, `total_compensation`, `availability_days`, `email`, `designation`, `pay_month`, `pay_year`, `created_at`, `hire_date`, `job_title`, `department`, `manager`, `location`, `salary`, `annual_salary`, `ifsc_number`, `bank_name`, `branch_name`, `account_number`, `account_type`, `dob`, `gender`, `phone_number`, `bonus`, `employee_type`, `qualifications`, `resigned_date`, `degree_certificate`, `experiance_certificate`, `course_certificate`, `advance_amount`, `emi_amount`, `advance_date`, `conformation_process`) VALUES
(16, 'V0720227', 'Angalaeswari', 8000.00, NULL, NULL, 'angalaeswari@vsmglobaltechnologies.com', 'It analyst', 0, 0, '2024-11-05 11:24:23', '2022-07-04', NULL, 'it_operations', NULL, NULL, NULL, NULL, 'none', 'no', 'no', 'no', 'no', '1990-10-10', 'Female', 'no', NULL, 'Dismissed', 'no', '2022-12-09', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(17, 'V0220238', 'Latha Gokulnath', 10000.00, NULL, NULL, 'latha@vsmglobaltechnologies.com', 'Senior specialist', 0, 0, '2024-11-05 11:27:53', '2023-02-01', NULL, 'it_operations', NULL, NULL, NULL, NULL, 'no', 'no', 'no', 'no', 'no', '1990-10-10', 'Female', 'no', NULL, 'Dismissed', 'no', '2023-08-08', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(18, 'V0620239', 'Suganya', 8000.00, NULL, NULL, 'suganya@vsmglobaltechnologies.com', 'Business development management specialist', 0, 0, '2024-11-05 11:35:19', '2023-06-21', NULL, 'marketing & Sales', NULL, NULL, NULL, NULL, 'no', 'no', 'no', 'no', 'no', '1990-10-10', 'Female', 'no', NULL, 'Dismissed', 'no', '2023-07-12', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(19, 'V1020239', 'Muthulakshmi', 12000.00, NULL, NULL, 'muthulakshmi@vsmglobaltechnologies.com', 'Developer', 0, 0, '2024-11-05 11:40:10', '2023-10-04', NULL, 'development', NULL, NULL, NULL, NULL, 'no', 'no', 'no', 'no', 'no', '1990-10-10', 'Female', 'no', NULL, 'Dismissed', 'no', '2024-01-05', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(20, 'V08202310', 'Jeya Eswari Vivek', 9000.00, NULL, NULL, 'jeyaeswarivivek@vsmglobaltechnologies.com', 'Business development management specialist', 0, 0, '2024-11-05 11:42:49', '2023-08-17', NULL, 'research_development', NULL, NULL, NULL, NULL, 'no', 'no', 'no', '', '', '1990-10-10', 'Female', 'no', NULL, 'Dismissed', 'no', '2024-02-05', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(21, 'V12202311', 'Jeevitha', 15000.00, NULL, NULL, 'jeevitha@vsmglobaltechnologies.com', 'Graphic Designer', 0, 0, '2024-11-05 11:44:46', '2023-12-01', NULL, 'design', NULL, NULL, NULL, NULL, '', '', '', '', '', '1990-10-10', 'Female', 'no', NULL, 'Dismissed', 'no', '2024-06-29', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(22, 'V01202412', 'Ajay Kumar', 9000.00, NULL, NULL, 'ajaykumar@vsmglobaltechnologies.com', 'Developer', 0, 0, '2024-11-05 11:47:08', '2024-01-06', NULL, 'development', NULL, NULL, NULL, NULL, '', '', '', '', '', '0000-00-00', 'Male', 'no', NULL, 'Dismissed', '', '2024-06-05', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(23, 'V05202413', 'Dhanalakshmi', 9000.00, NULL, NULL, 'dhanalakshmi@vsmglobaltechnologies.com', 'contract-support', 0, 0, '2024-11-05 11:48:20', '2024-05-01', NULL, 'research_development', NULL, NULL, NULL, NULL, '', '', '', '', '', '0000-00-00', 'Female', 'no', NULL, 'Contract', '', '0000-00-00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(24, 'V09202414', 'Neena PS', 9000.00, NULL, NULL, 'neenaps@vsmglobaltechnologies.com', 'contract- support ', 0, 0, '2024-11-05 11:50:17', '2024-09-01', NULL, 'research_development', NULL, NULL, NULL, NULL, '', '', '', '', '', '0000-00-00', 'Female', 'no', NULL, 'Dismissed', '', '2024-10-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(25, 'V06202315', 'Anitha', 18000.00, NULL, NULL, 'anitha@vsmglobaltechnologies.com', 'Marketing Manager', 0, 0, '2024-11-05 11:52:51', '2023-06-08', NULL, 'marketing & Sales', NULL, NULL, NULL, NULL, '', '', '', '', '', '0000-00-00', 'Female', 'no', NULL, 'Dismissed', '', '2023-07-08', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(64, 'VSM-1D9A57', 'venkatesh shanmugam', 9000.00, NULL, NULL, 'venkateshseenu9047@gmail.com', NULL, 0, 0, '2025-01-20 06:07:37', NULL, NULL, NULL, NULL, '21th jeevanantham street chengam 606701', NULL, NULL, 'BARB0KKNAGA', 'BANK OF BARODA', NULL, '18850100022313', NULL, '2001-03-24', 'Male', '9080131768', NULL, 'Dismissed', NULL, NULL, 'uploads/1737353656_venkatesh-degree.jpg', 'uploads/1737353656_Venkat Exp letter.pdf', NULL, NULL, NULL, NULL, '1'),
(65, 'VSM-01F984', 'yuvarani', 9000.00, NULL, NULL, 'Yuvarani@vsmglobaltechnologies.com', NULL, 0, 0, '2025-02-10 07:43:13', NULL, NULL, NULL, NULL, 'No8, nesamani nagar, ambedkar street, perumpakkam, chennai, 605110.', NULL, NULL, '', '', NULL, '', NULL, '1996-06-02', 'Female', '7092519767', NULL, 'Full-time', NULL, NULL, 'uploads/1739442108_Degree UV.pdf', NULL, NULL, NULL, NULL, NULL, '1'),
(67, 'VSM-C24AEE', 'Veenabai S', 9000.00, NULL, NULL, 'veenabais2002@gmail.com', NULL, 0, 0, '2025-02-17 12:48:28', NULL, NULL, NULL, NULL, 'Jsk hostel, Sholinganallur, chennai, Tamilnadu', NULL, NULL, 'HDFC0001852', 'HDFC Bank', NULL, '50100724063768', NULL, '2002-08-28', 'Female', '6381165177', NULL, 'Full-time', NULL, NULL, 'uploads/1739796629_semester marksheet.pdf', NULL, NULL, NULL, NULL, NULL, '1'),
(68, 'VSM-93ADCC', 'B.Ramesh', 9000.00, NULL, NULL, 'ramesh.ramesh997@gmail.com', NULL, 0, 0, '2025-02-26 06:43:37', NULL, NULL, NULL, NULL, 'Plot no:- 5, VIGNESHWARA NAGAR, East Coast Rd, OMR, Sholinganallur, Chennai, Tamil Nadu 600119', NULL, NULL, 'ICIC0000073', 'ICICI', NULL, '007301582975', NULL, '1994-12-09', 'Male', '9701075876', NULL, 'Full-time', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(69, 'VSM-BC6C4F', 'Keerthana', 10000.00, 0.00, NULL, 'bdm@vsmglobaltechnologies.com', 'Front end Developer', 0, 0, '2025-02-26 11:27:57', '2025-02-25', NULL, 'Developer', 'Valarmathi', 'test', NULL, NULL, '00', '00', NULL, '00', NULL, '2001-02-06', 'Female', '8887876876', 0.00, 'Full-time', NULL, NULL, 'uploads/1740569300_Untitled design (76).png', 'uploads/1740569300_Untitled design (76).png', 'uploads/1740569300_Untitled design (76).png', NULL, NULL, NULL, '1');

-- --------------------------------------------------------

--
-- Table structure for table `salary_details`
--

CREATE TABLE `salary_details` (
  `id` int(11) NOT NULL,
  `employee_id` varchar(50) DEFAULT NULL,
  `month` varchar(20) DEFAULT NULL,
  `year` int(11) NOT NULL,
  `gross_salary` varchar(225) DEFAULT NULL,
  `advance_amount` int(11) DEFAULT NULL,
  `emi_amount` int(11) DEFAULT NULL,
  `total_days` int(11) DEFAULT NULL,
  `present_days` int(11) DEFAULT NULL,
  `absent_days` int(11) DEFAULT NULL,
  `net_salary` decimal(10,2) DEFAULT NULL,
  `payment_status` varchar(20) DEFAULT 'paid'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `salary_details`
--

INSERT INTO `salary_details` (`id`, `employee_id`, `month`, `year`, `gross_salary`, `advance_amount`, `emi_amount`, `total_days`, `present_days`, `absent_days`, `net_salary`, `payment_status`) VALUES
(163, 'VSM-BC6C4F', 'Jan', 2025, '0', 0, 0, 31, 28, 3, 0.00, 'paid'),
(164, 'VSM-BC6C4F', 'Feb', 2025, '0', 0, 0, 28, 20, 8, 7142.86, 'paid');

-- --------------------------------------------------------

--
-- Table structure for table `vsm01f984_salary`
--

CREATE TABLE `vsm01f984_salary` (
  `id` int(11) NOT NULL,
  `employee_id` varchar(255) NOT NULL,
  `month` varchar(50) NOT NULL,
  `year` int(11) NOT NULL,
  `gross_salary` varchar(225) NOT NULL,
  `advance_amount` decimal(10,2) NOT NULL,
  `emi_amount` decimal(10,2) NOT NULL,
  `total_days` int(11) NOT NULL,
  `present_days` int(11) NOT NULL,
  `absent_days` int(11) NOT NULL,
  `net_salary` decimal(10,2) NOT NULL,
  `payment_status` varchar(50) NOT NULL DEFAULT 'Paid'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `vsm1d9a57_salary`
--

CREATE TABLE `vsm1d9a57_salary` (
  `id` int(11) NOT NULL,
  `employee_id` varchar(255) NOT NULL,
  `month` varchar(50) NOT NULL,
  `year` int(11) NOT NULL,
  `gross_salary` varchar(225) NOT NULL,
  `advance_amount` decimal(10,2) NOT NULL,
  `emi_amount` decimal(10,2) NOT NULL,
  `total_days` int(11) NOT NULL,
  `present_days` int(11) NOT NULL,
  `absent_days` int(11) NOT NULL,
  `net_salary` decimal(10,2) NOT NULL,
  `payment_status` varchar(50) NOT NULL DEFAULT 'Paid'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `vsm93adcc_salary`
--

CREATE TABLE `vsm93adcc_salary` (
  `id` int(11) NOT NULL,
  `employee_id` varchar(255) NOT NULL,
  `month` varchar(50) NOT NULL,
  `year` int(11) NOT NULL,
  `gross_salary` varchar(225) NOT NULL,
  `advance_amount` decimal(10,2) NOT NULL,
  `emi_amount` decimal(10,2) NOT NULL,
  `total_days` int(11) NOT NULL,
  `present_days` int(11) NOT NULL,
  `absent_days` int(11) NOT NULL,
  `net_salary` decimal(10,2) NOT NULL,
  `payment_status` varchar(50) NOT NULL DEFAULT 'Paid'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `vsmbc6c4f_salary`
--

CREATE TABLE `vsmbc6c4f_salary` (
  `id` int(11) NOT NULL,
  `employee_id` varchar(255) NOT NULL,
  `month` varchar(50) NOT NULL,
  `year` int(11) NOT NULL,
  `gross_salary` varchar(225) NOT NULL,
  `advance_amount` decimal(10,2) NOT NULL,
  `emi_amount` decimal(10,2) NOT NULL,
  `total_days` int(11) NOT NULL,
  `present_days` int(11) NOT NULL,
  `absent_days` int(11) NOT NULL,
  `net_salary` decimal(10,2) NOT NULL,
  `payment_status` varchar(50) NOT NULL DEFAULT 'Paid'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vsmbc6c4f_salary`
--

INSERT INTO `vsmbc6c4f_salary` (`id`, `employee_id`, `month`, `year`, `gross_salary`, `advance_amount`, `emi_amount`, `total_days`, `present_days`, `absent_days`, `net_salary`, `payment_status`) VALUES
(2, 'VSM-BC6C4F', 'Jan', 2025, '0', 0.00, 0.00, 31, 28, 3, 0.00, 'Paid'),
(3, 'VSM-BC6C4F', 'Feb', 2025, '0', 0.00, 0.00, 28, 20, 8, 7142.86, 'Paid');

-- --------------------------------------------------------

--
-- Table structure for table `vsmc24aee_salary`
--

CREATE TABLE `vsmc24aee_salary` (
  `id` int(11) NOT NULL,
  `employee_id` varchar(255) NOT NULL,
  `month` varchar(50) NOT NULL,
  `year` int(11) NOT NULL,
  `gross_salary` varchar(225) NOT NULL,
  `advance_amount` decimal(10,2) NOT NULL,
  `emi_amount` decimal(10,2) NOT NULL,
  `total_days` int(11) NOT NULL,
  `present_days` int(11) NOT NULL,
  `absent_days` int(11) NOT NULL,
  `net_salary` decimal(10,2) NOT NULL,
  `payment_status` varchar(50) NOT NULL DEFAULT 'Paid'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_login`
--
ALTER TABLE `admin_login`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `advance_salary`
--
ALTER TABLE `advance_salary`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `approvals`
--
ALTER TABLE `approvals`
  ADD PRIMARY KEY (`request_id`);

--
-- Indexes for table `company_info`
--
ALTER TABLE `company_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employee_details`
--
ALTER TABLE `employee_details`
  ADD PRIMARY KEY (`employee_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `manual_salary`
--
ALTER TABLE `manual_salary`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `manual_update`
--
ALTER TABLE `manual_update`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `releve_apply`
--
ALTER TABLE `releve_apply`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `run_payslip`
--
ALTER TABLE `run_payslip`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `salary_details`
--
ALTER TABLE `salary_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vsm01f984_salary`
--
ALTER TABLE `vsm01f984_salary`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vsm1d9a57_salary`
--
ALTER TABLE `vsm1d9a57_salary`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vsm93adcc_salary`
--
ALTER TABLE `vsm93adcc_salary`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vsmbc6c4f_salary`
--
ALTER TABLE `vsmbc6c4f_salary`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vsmc24aee_salary`
--
ALTER TABLE `vsmc24aee_salary`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_login`
--
ALTER TABLE `admin_login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `advance_salary`
--
ALTER TABLE `advance_salary`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `approvals`
--
ALTER TABLE `approvals`
  MODIFY `request_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `company_info`
--
ALTER TABLE `company_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `employee_details`
--
ALTER TABLE `employee_details`
  MODIFY `employee_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `manual_salary`
--
ALTER TABLE `manual_salary`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `manual_update`
--
ALTER TABLE `manual_update`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `releve_apply`
--
ALTER TABLE `releve_apply`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `run_payslip`
--
ALTER TABLE `run_payslip`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `salary_details`
--
ALTER TABLE `salary_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=165;

--
-- AUTO_INCREMENT for table `vsm01f984_salary`
--
ALTER TABLE `vsm01f984_salary`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `vsm1d9a57_salary`
--
ALTER TABLE `vsm1d9a57_salary`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vsm93adcc_salary`
--
ALTER TABLE `vsm93adcc_salary`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `vsmbc6c4f_salary`
--
ALTER TABLE `vsmbc6c4f_salary`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `vsmc24aee_salary`
--
ALTER TABLE `vsmc24aee_salary`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
