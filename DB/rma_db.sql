-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 24, 2020 at 01:40 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rma_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `befor_update`
--

CREATE TABLE `befor_update` (
  `jobs_id` int(4) NOT NULL,
  `job_number` varchar(65) NOT NULL DEFAULT '',
  `customer_name` varchar(65) NOT NULL DEFAULT '',
  `mobile_number` varchar(65) NOT NULL DEFAULT '',
  `lane_number` varchar(65) NOT NULL DEFAULT '',
  `address` varchar(65) NOT NULL DEFAULT '',
  `invoice_no` varchar(65) NOT NULL DEFAULT '',
  `invoice_date` varchar(65) NOT NULL DEFAULT '',
  `item_id` varchar(65) NOT NULL DEFAULT '',
  `item_description` text DEFAULT NULL,
  `serial_no` varchar(65) NOT NULL DEFAULT '',
  `tag_no` varchar(65) NOT NULL DEFAULT '',
  `warranty` varchar(65) NOT NULL DEFAULT '',
  `mark` varchar(65) DEFAULT NULL,
  `accessories_receiving` varchar(65) NOT NULL DEFAULT '',
  `customer_complaint` varchar(65) NOT NULL DEFAULT '',
  `others` varchar(65) NOT NULL DEFAULT '',
  `required_estimate` varchar(65) DEFAULT NULL,
  `inspection_chargers` varchar(65) NOT NULL DEFAULT '',
  `job_by` varchar(65) NOT NULL DEFAULT '',
  `job_date` varchar(65) NOT NULL DEFAULT '',
  `job_status` varchar(65) NOT NULL DEFAULT '',
  `now_job` varchar(65) NOT NULL DEFAULT '',
  `last_update_by` varchar(65) NOT NULL DEFAULT '',
  `last_update` varchar(65) NOT NULL DEFAULT '',
  `new_serial` varchar(65) NOT NULL DEFAULT '',
  `new_tag` varchar(65) NOT NULL DEFAULT '',
  `received_by` varchar(65) NOT NULL DEFAULT '',
  `received_update_date` varchar(65) NOT NULL DEFAULT '',
  `repair_chargers` varchar(65) NOT NULL DEFAULT '',
  `inform_date` varchar(65) NOT NULL DEFAULT '',
  `remark` varchar(65) NOT NULL DEFAULT '',
  `ready_by` varchar(65) NOT NULL DEFAULT '',
  `ready_date` varchar(65) NOT NULL DEFAULT '',
  `riceived_name` text NOT NULL,
  `riceived_nic` text NOT NULL,
  `dispatch_by` text NOT NULL,
  `dispatch_date` text NOT NULL,
  `date_of_issued` text NOT NULL,
  `issued_item_id` text NOT NULL,
  `send_estimate_date` text NOT NULL,
  `estimate_by` text NOT NULL,
  `rmanote_missing` text NOT NULL,
  `job_by_update` text DEFAULT NULL,
  `job_date_update` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `item_list`
--

CREATE TABLE `item_list` (
  `item_id` int(4) NOT NULL,
  `item_name` varchar(65) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `item_list`
--

INSERT INTO `item_list` (`item_id`, `item_name`) VALUES
(1, 'hdd'),
(2, 'Laptop');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `jobs_id` int(4) NOT NULL,
  `job_number` varchar(65) NOT NULL DEFAULT '',
  `customer_name` varchar(65) NOT NULL DEFAULT '',
  `mobile_number` varchar(65) NOT NULL DEFAULT '',
  `lane_number` varchar(65) NOT NULL DEFAULT '',
  `address` varchar(65) NOT NULL DEFAULT '',
  `invoice_no` varchar(65) NOT NULL DEFAULT '',
  `invoice_date` varchar(65) NOT NULL DEFAULT '',
  `item_id` varchar(65) NOT NULL DEFAULT '',
  `item_description` text DEFAULT NULL,
  `serial_no` varchar(65) NOT NULL DEFAULT '',
  `tag_no` varchar(65) NOT NULL DEFAULT '',
  `warranty` varchar(65) NOT NULL DEFAULT '',
  `mark` varchar(65) DEFAULT NULL,
  `accessories_receiving` varchar(65) NOT NULL DEFAULT '',
  `customer_complaint` varchar(65) NOT NULL DEFAULT '',
  `others` varchar(65) NOT NULL DEFAULT '',
  `required_estimate` varchar(65) DEFAULT NULL,
  `inspection_chargers` varchar(65) NOT NULL DEFAULT '',
  `job_by` varchar(65) NOT NULL DEFAULT '',
  `job_date` varchar(65) NOT NULL DEFAULT '',
  `job_status` varchar(65) NOT NULL DEFAULT '',
  `now_job` varchar(65) NOT NULL DEFAULT '',
  `last_update_by` varchar(65) NOT NULL DEFAULT '',
  `last_update` varchar(65) NOT NULL DEFAULT '',
  `new_serial` varchar(65) NOT NULL DEFAULT '',
  `new_tag` varchar(65) NOT NULL DEFAULT '',
  `received_by` varchar(65) NOT NULL DEFAULT '',
  `received_update_date` varchar(65) NOT NULL DEFAULT '',
  `repair_chargers` varchar(65) NOT NULL DEFAULT '',
  `inform_date` varchar(65) NOT NULL DEFAULT '',
  `remark` varchar(65) NOT NULL DEFAULT '',
  `ready_by` varchar(65) NOT NULL DEFAULT '',
  `ready_date` varchar(65) NOT NULL DEFAULT '',
  `riceived_name` text NOT NULL,
  `riceived_nic` text NOT NULL,
  `dispatch_by` text NOT NULL,
  `dispatch_date` text NOT NULL,
  `date_of_issued` text NOT NULL,
  `issued_item_id` text NOT NULL,
  `send_estimate_date` text NOT NULL,
  `estimate_by` text NOT NULL,
  `rmanote_missing` text NOT NULL,
  `job_by_update` text DEFAULT NULL,
  `job_date_update` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`jobs_id`, `job_number`, `customer_name`, `mobile_number`, `lane_number`, `address`, `invoice_no`, `invoice_date`, `item_id`, `item_description`, `serial_no`, `tag_no`, `warranty`, `mark`, `accessories_receiving`, `customer_complaint`, `others`, `required_estimate`, `inspection_chargers`, `job_by`, `job_date`, `job_status`, `now_job`, `last_update_by`, `last_update`, `new_serial`, `new_tag`, `received_by`, `received_update_date`, `repair_chargers`, `inform_date`, `remark`, `ready_by`, `ready_date`, `riceived_name`, `riceived_nic`, `dispatch_by`, `dispatch_date`, `date_of_issued`, `issued_item_id`, `send_estimate_date`, `estimate_by`, `rmanote_missing`, `job_by_update`, `job_date_update`) VALUES
(1, '00001', '256', '0769281189', '0769281189', 'sdfsdf', 'sdfsdf', '2020-07-09', '1', 'Seal Disk', '444', '44', '', NULL, '44', '44', '44', NULL, '350', '1', '2020-07-21 11:35:20 am', '6', 'Job Done', '', '', '-', '-', '', '', '2', '2020-07-21 11:40:08 am', 'ppp', '1', '2020-07-21 11:40:18 am', '-', '-', '1', '2020-07-24 09:13:13 am', '2020-07-24 09:12:57 am', '1', '', '', '', NULL, NULL),
(2, '00002', 'Indika', '0769281189', '0769281189', '10th Post Rajawaka Balangoda', '0725', '2020-07-21', '1', 'HDD Only', '588955482', '2222458', '1', NULL, 'asds', 'asdas', 'asda', NULL, '52', '1', '2020-07-21 11:36:53 am', '6', 'Job Done', '1', '2020-07-21 12:14:07 pm', 'llll', 'll', '1', '2020-07-21 12:14:07 pm', '0', '2020-07-21 04:54:38 pm', ']]]', '1', '2020-07-21 04:54:47 pm', '6', '6', '1', '2020-07-24 09:21:08 am', '2020-07-24 09:21:00 am', '1', '', '', '', NULL, NULL),
(3, '00003', '55', '5555555555', '5555555555', '555555555555555', '55555555555555555', '', '1', '5', '55555555555', '55555', '', NULL, '5', '55555555555555', '5555555555555', NULL, '350', '1', '2020-07-21 04:48:12 pm', '6', 'Job Done', '1', '2020-07-21 04:53:13 pm', 'kkkkk', 'kkkkk', '1', '2020-07-21 04:53:13 pm', '77', '2020-07-21 04:54:47 pm', 'ooooo', '1', '2020-07-21 04:55:03 pm', '455', '444', '1', '2020-07-24 10:13:59 am', '2020-07-24 10:13:51 am', '1', '', '', '', NULL, NULL),
(4, '00004', 'rrrrrrrrrr', '0000000000', '0000000000', 'rrrrrrrrrrrrrrrrrrrrr', 'rrrrr', '', '1', 'rrrrrrrrrrrrrrrrrrr', 'rrrrrrrrrrrrrr', '', '', NULL, 'r', 'rrrrrrrrrrr', 'rrrrrrrrr', NULL, '350', '1', '2020-07-21 04:48:18 pm', '6', 'Job Done', '1', '2020-07-21 04:54:27 pm', 'jjjjjjjjjjjjjjjjjj', 'jjjj', '1', '2020-07-21 04:54:27 pm', '0', '2020-07-24 10:16:56 am', 'jj', '1', '2020-07-24 10:17:01 am', 'llllll', 'll', '1', '2020-07-24 10:17:10 am', '2020-07-24 10:17:03 am', '1', '', '', '', NULL, NULL),
(5, '00005', 'tttttttttt', '0000000000', '0000000000', '0000000000000000', '00000000000000', '', '1', '0000000000', '000000', '', '', NULL, '0', '000000000000', '0000000000', NULL, '350', '1', '2020-07-21 04:56:53 pm', '6', 'Job Done', '1', '2020-07-21 04:57:43 pm', '5555555555555555555', '555', '1', '2020-07-21 04:57:43 pm', '0', '2020-07-24 10:42:24 am', 'lllll', '1', '2020-07-24 10:50:42 am', 'ff', 'fffffffff', '1', '2020-07-24 10:52:26 am', '2020-07-24 10:52:21 am', '1', '', '', '', NULL, NULL),
(6, '00006', 'vvvvvvvvv', '0769281189', '0769281189', 'fff', 'ff', '2020-07-21', '1', 'f', 'f', 'f', '1', NULL, 'f', 'f', 'ff', NULL, '0', '1', '2020-07-24 10:08:43 am', '6', 'Job Done', '1', '2020-07-24 10:52:18 am', 'ffffffffffff', 'fffffffffff', '1', '2020-07-24 10:52:18 am', '0', '2020-07-24 11:30:52 am', 'fff', '1', '2020-07-24 11:30:57 am', 'fff', 'fff', '1', '2020-07-24 11:31:06 am', '2020-07-24 11:31:00 am', '1', '', '', '', NULL, NULL),
(7, '00007', 'gvhghj', '0769281189', '0769281189', 'sdfgsdfg', '222', '2020-07-22', '1', 'wsss', 'ss', 'ss', '', NULL, 'ss', 'ss', 'ss', NULL, '350', '1', '2020-07-24 10:51:56 am', '6', 'Job Done', '1', '2020-07-24 11:32:19 am', 'llllllllllllllllll', 'llllllllllll', '1', '2020-07-24 11:32:19 am', '0', '2020-07-24 11:32:20 am', 'lllllllllll', '1', '2020-07-24 11:32:24 am', '77', '777', '1', '2020-07-24 11:32:42 am', '2020-07-24 11:32:27 am', '1', '', '', '', NULL, NULL),
(8, '00008', 'Indika', '0769281189', '0769281189', '10th Post Rajawaka,Balangoda', '12258', '2020-07-24', '1', 'HDD Only', '89958', '255698', '1', NULL, 'HD And Key bode only', 'not working HD', 'no ones', NULL, '0', '1', '2020-07-24 05:08:57 pm', '6', 'Job Done', '1', '2020-07-24 05:09:34 pm', 'ccccccccccccc', 'cccccccccc', '1', '2020-07-24 05:09:34 pm', '0', '2020-07-24 05:09:36 pm', 'ccccc', '1', '2020-07-24 05:09:41 pm', 'c', 'cccccccc', '1', '2020-07-24 05:09:50 pm', '2020-07-24 05:09:43 pm', '1', '', '', '', NULL, NULL),
(9, '00009', 'hhhhhhhhhh', '0769281189', '0769281189', 'ggg', 'g', '2020-07-29', '1', 'g', 'ggggggggggggg', 'gggggggggggggg', '1', NULL, 'g', 'gggggggggggg', 'gggggggg', NULL, '0', '1', '2020-07-24 11:31:49 am', '0', 'New Job', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL),
(10, '00010', 'cccccccccc', '0769281189', '0769281189', '0', '44', '2020-07-29', '1', 'c', 'ccccccccccc', 'cccccccccccccc', '', NULL, 'cccccc', 'cc', 'ccccccc', NULL, '350', '1', '2020-07-24 05:10:24 pm', '0', 'New Job', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `jobs_dispach`
--

CREATE TABLE `jobs_dispach` (
  `jobs_dispach_id` int(4) NOT NULL,
  `job_number` varchar(65) NOT NULL DEFAULT '',
  `dispach_by` text NOT NULL,
  `dispach_date` varchar(65) NOT NULL DEFAULT '',
  `total` varchar(65) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jobs_dispach`
--

INSERT INTO `jobs_dispach` (`jobs_dispach_id`, `job_number`, `dispach_by`, `dispach_date`, `total`) VALUES
(1, '00001', '1', '2020-07-24 09:13:13 am', '352'),
(2, '00002', '1', '2020-07-24 09:21:08 am', '52'),
(3, '00003', '1', '2020-07-24 10:14:00 am', '427'),
(4, '00004', '1', '2020-07-24 10:17:10 am', '350'),
(5, '00005', '1', '2020-07-24 10:42:37 am', '350'),
(6, '00005', '1', '2020-07-24 10:52:26 am', '350'),
(7, '00006', '1', '2020-07-24 11:31:07 am', '0'),
(8, '00007', '1', '2020-07-24 11:32:42 am', '350'),
(9, '00008', '1', '2020-07-24 05:09:50 pm', '0');

-- --------------------------------------------------------

--
-- Table structure for table `jobs_dispach_income`
--

CREATE TABLE `jobs_dispach_income` (
  `jobs_dispach_id` int(4) NOT NULL,
  `dispach_date` varchar(65) NOT NULL DEFAULT '',
  `invoice_income` text NOT NULL,
  `repair_recive` text NOT NULL,
  `total` varchar(65) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jobs_dispach_income`
--

INSERT INTO `jobs_dispach_income` (`jobs_dispach_id`, `dispach_date`, `invoice_income`, `repair_recive`, `total`) VALUES
(1, '2020-07-24', '352', '352', '1879');

-- --------------------------------------------------------

--
-- Table structure for table `permission`
--

CREATE TABLE `permission` (
  `permission_id` int(4) NOT NULL,
  `user_no` varchar(65) NOT NULL DEFAULT '',
  `add` varchar(65) DEFAULT NULL,
  `edit` varchar(65) DEFAULT NULL,
  `delet` varchar(65) DEFAULT NULL,
  `admin` varchar(65) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `permission`
--

INSERT INTO `permission` (`permission_id`, `user_no`, `add`, `edit`, `delet`, `admin`) VALUES
(22, '1', '1', '1', '1', '1'),
(30, '2', '1', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `repair_center`
--

CREATE TABLE `repair_center` (
  `repair_center_id` int(4) NOT NULL,
  `job_number` varchar(65) NOT NULL DEFAULT '',
  `send_item_description` text NOT NULL,
  `status` varchar(65) NOT NULL DEFAULT '',
  `done_by` varchar(65) NOT NULL DEFAULT '',
  `done_date` varchar(65) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `repair_center`
--

INSERT INTO `repair_center` (`repair_center_id`, `job_number`, `send_item_description`, `status`, `done_by`, `done_date`) VALUES
(1, '00001', '', '4', '1', '2020-07-21 11:35:20 am');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `roles_id` int(4) NOT NULL,
  `roles_details` text NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`roles_id`, `roles_details`) VALUES
(12, 'If the items are not collected within 30 days of completion the repair Super Unique IT Solutions, doesn\'t take responsibility about items'),
(13, 'Customer must be collected items.Super Unique IT solutions, Not Deliver to Customer'),
(14, 'Super Unique IT Solutions, No Responsibility for defect\'s or damages that occur after the repaired item\'s left our site');

-- --------------------------------------------------------

--
-- Table structure for table `shop_seting`
--

CREATE TABLE `shop_seting` (
  `shop_id` int(4) NOT NULL,
  `shop_name` varchar(65) NOT NULL DEFAULT '',
  `address_line_1` varchar(65) NOT NULL DEFAULT '',
  `address_line_2` varchar(65) NOT NULL DEFAULT '',
  `tp_no` varchar(65) NOT NULL DEFAULT '',
  `web_link` varchar(65) NOT NULL DEFAULT '',
  `logo` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `shop_seting`
--

INSERT INTO `shop_seting` (`shop_id`, `shop_name`, `address_line_1`, `address_line_2`, `tp_no`, `web_link`, `logo`) VALUES
(1, 'Super Unique IT Solutions', 'No:17, De Croos Road Road', 'Negombo', '031-222 81 50', 'www.superuniqueit.com', '20200622.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `sms_setting`
--

CREATE TABLE `sms_setting` (
  `id` int(4) NOT NULL,
  `src_name` varchar(65) NOT NULL DEFAULT '',
  `user_id` varchar(65) NOT NULL DEFAULT '',
  `password` varchar(65) NOT NULL DEFAULT '',
  `status` varchar(65) NOT NULL DEFAULT '',
  `newjob` text CHARACTER SET ascii NOT NULL,
  `doredy_job` text NOT NULL,
  `dispach_Job` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sms_setting`
--

INSERT INTO `sms_setting` (`id`, `src_name`, `user_id`, `password`, `status`, `newjob`, `doredy_job`, `dispach_Job`) VALUES
(1, 'eAdvertiser', 'eadvertiser', 'Ea23dvTs', '', 'mkg \"Job\" hoogoog and my complain is \"complaint\" for inspection  \"chargers\"', 'your job no \"Job\" is ready come and plese collect it total cost is \"chargers\" ', 'your job no \"Job\" is ready come and plese collect it total cost is \"chargers\"  \"received_name\" and NIC is  \"received_nic\"');

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `supplier_id` int(4) NOT NULL,
  `supplier_name` varchar(65) NOT NULL DEFAULT '',
  `supplier_address` varchar(65) NOT NULL DEFAULT '',
  `mobile_number` varchar(65) NOT NULL DEFAULT '',
  `lane_number` varchar(65) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`supplier_id`, `supplier_name`, `supplier_address`, `mobile_number`, `lane_number`) VALUES
(3, '01', 'gfghfgh', '0769281189', '0769281189'),
(4, 'Trident', 'no', '0000000000', '0115940501');

-- --------------------------------------------------------

--
-- Table structure for table `sup_send`
--

CREATE TABLE `sup_send` (
  `sup_id` int(4) NOT NULL,
  `job_number` varchar(65) NOT NULL DEFAULT '',
  `supplier_id` varchar(65) NOT NULL DEFAULT '',
  `send_item_description` text DEFAULT NULL,
  `chek_by` varchar(65) NOT NULL DEFAULT '',
  `chek_date` varchar(65) NOT NULL DEFAULT '',
  `sup_status` varchar(65) NOT NULL DEFAULT '',
  `supplier_send_update_by` varchar(65) NOT NULL DEFAULT '',
  `update_date` varchar(65) NOT NULL DEFAULT '',
  `supplier_note_no` varchar(65) NOT NULL DEFAULT '',
  `supplier_send_date_in_note` varchar(65) NOT NULL DEFAULT '',
  `note_update_by` varchar(65) NOT NULL DEFAULT '',
  `note_update_date` varchar(65) NOT NULL DEFAULT '',
  `sup_new_serial` varchar(65) NOT NULL DEFAULT '',
  `sup_new_tag` varchar(65) NOT NULL DEFAULT '',
  `sup_received_by` varchar(65) NOT NULL DEFAULT '',
  `sup_received_update_date` varchar(65) NOT NULL DEFAULT '',
  `received_date` varchar(65) NOT NULL DEFAULT '',
  `received_description` text DEFAULT NULL,
  `update_by` varchar(65) NOT NULL DEFAULT '',
  `supplier_send_date` text NOT NULL,
  `sup_dispatch_date` text NOT NULL,
  `sup_dispatch_by` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sup_send`
--

INSERT INTO `sup_send` (`sup_id`, `job_number`, `supplier_id`, `send_item_description`, `chek_by`, `chek_date`, `sup_status`, `supplier_send_update_by`, `update_date`, `supplier_note_no`, `supplier_send_date_in_note`, `note_update_by`, `note_update_date`, `sup_new_serial`, `sup_new_tag`, `sup_received_by`, `sup_received_update_date`, `received_date`, `received_description`, `update_by`, `supplier_send_date`, `sup_dispatch_date`, `sup_dispatch_by`) VALUES
(1, '00002', '3', 'kkk', '1', '2020-07-21 11:36:53 am', '6', '1', '2020-07-21 04:54:47 pm', 'gg', '2020-07-24', '1', '2020-07-21 12:12:19 pm', 'llll', 'll', '1', '2020-07-21 12:14:07 pm', '2020-07-28', 'lll', '1', '2020-07-21 12:05:17 pm', '2020-07-24 09:21:08 am', '1'),
(2, '00003', '3', 'jjj', '1', '2020-07-21 04:48:12 pm', '6', '1', '2020-07-21 04:55:03 pm', 'iiiiii', '2020-07-24', '1', '2020-07-21 04:52:29 pm', 'kkkkk', 'kkkkk', '1', '2020-07-21 04:53:13 pm', '2020-07-15', 'kkkkk', '1', '2020-07-21 04:52:10 pm', '2020-07-24 10:13:59 am', '1'),
(3, '00004', '3', 'llllllll', '1', '2020-07-21 04:48:18 pm', '6', '1', '2020-07-24 10:17:01 am', 'iiiiiii', '2020-07-21', '1', '2020-07-21 04:52:53 pm', 'jjjjjjjjjjjjjjjjjj', 'jjjj', '1', '2020-07-21 04:54:27 pm', '2020-07-22', 'jjjjjjjjjjjjjjjjjjj', '1', '2020-07-21 04:52:12 pm', '2020-07-24 10:17:10 am', '1'),
(4, '00005', '3', 'hhhhhh', '1', '2020-07-21 04:56:53 pm', '6', '1', '2020-07-24 10:50:42 am', 'rrrrrrrrr', '2020-07-24', '1', '2020-07-21 04:57:26 pm', '5555555555555555555', '555', '1', '2020-07-21 04:57:43 pm', '2020-07-16', '55555', '1', '2020-07-21 04:57:10 pm', '2020-07-24 10:52:26 am', '1'),
(5, '00006', '3', 'sssss', '1', '2020-07-24 10:08:43 am', '6', '1', '2020-07-24 11:30:57 am', 'ssss', '2020-07-24', '1', '2020-07-24 10:10:00 am', 'ffffffffffff', 'fffffffffff', '1', '2020-07-24 10:52:18 am', '2020-07-22', 'f', '1', '2020-07-24 10:08:47 am', '2020-07-24 11:31:06 am', '1'),
(6, '00007', '3', 'fffff', '1', '2020-07-24 10:51:56 am', '6', '1', '2020-07-24 11:32:24 am', 'fffff', '2020-07-22', '1', '2020-07-24 10:52:09 am', 'llllllllllllllllll', 'llllllllllll', '1', '2020-07-24 11:32:19 am', '2020-07-30', 'llll', '1', '2020-07-24 10:52:01 am', '2020-07-24 11:32:41 am', '1'),
(7, '00008', '3', 'ggggg', '1', '2020-07-24 05:08:57 pm', '6', '1', '2020-07-24 05:09:41 pm', 'ccccccc', '2020-07-24', '1', '2020-07-24 05:09:24 pm', 'ccccccccccccc', 'cccccccccc', '1', '2020-07-24 05:09:33 pm', '2020-07-23', 'c', '1', '2020-07-24 05:09:03 pm', '2020-07-24 05:09:50 pm', '1');

-- --------------------------------------------------------

--
-- Table structure for table `sys_users`
--

CREATE TABLE `sys_users` (
  `userid` int(4) NOT NULL,
  `user_no` int(11) NOT NULL,
  `uname` varchar(65) NOT NULL DEFAULT '',
  `upassword` varchar(65) NOT NULL DEFAULT '',
  `image` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sys_users`
--

INSERT INTO `sys_users` (`userid`, `user_no`, `uname`, `upassword`, `image`) VALUES
(28, 1, '1', 'c4ca4238a0b923820dcc509a6f75849b', '20200722.jpg'),
(36, 2, '2', 'c81e728d9d4c2f636f067f89cc14862c', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `befor_update`
--
ALTER TABLE `befor_update`
  ADD PRIMARY KEY (`jobs_id`);

--
-- Indexes for table `item_list`
--
ALTER TABLE `item_list`
  ADD PRIMARY KEY (`item_id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`jobs_id`);

--
-- Indexes for table `jobs_dispach`
--
ALTER TABLE `jobs_dispach`
  ADD PRIMARY KEY (`jobs_dispach_id`);

--
-- Indexes for table `jobs_dispach_income`
--
ALTER TABLE `jobs_dispach_income`
  ADD PRIMARY KEY (`jobs_dispach_id`);

--
-- Indexes for table `permission`
--
ALTER TABLE `permission`
  ADD PRIMARY KEY (`permission_id`);

--
-- Indexes for table `repair_center`
--
ALTER TABLE `repair_center`
  ADD PRIMARY KEY (`repair_center_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`roles_id`);

--
-- Indexes for table `shop_seting`
--
ALTER TABLE `shop_seting`
  ADD PRIMARY KEY (`shop_id`);

--
-- Indexes for table `sms_setting`
--
ALTER TABLE `sms_setting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`supplier_id`);

--
-- Indexes for table `sup_send`
--
ALTER TABLE `sup_send`
  ADD PRIMARY KEY (`sup_id`);

--
-- Indexes for table `sys_users`
--
ALTER TABLE `sys_users`
  ADD PRIMARY KEY (`userid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `befor_update`
--
ALTER TABLE `befor_update`
  MODIFY `jobs_id` int(4) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `item_list`
--
ALTER TABLE `item_list`
  MODIFY `item_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `jobs_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `jobs_dispach`
--
ALTER TABLE `jobs_dispach`
  MODIFY `jobs_dispach_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `jobs_dispach_income`
--
ALTER TABLE `jobs_dispach_income`
  MODIFY `jobs_dispach_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `permission`
--
ALTER TABLE `permission`
  MODIFY `permission_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `repair_center`
--
ALTER TABLE `repair_center`
  MODIFY `repair_center_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `roles_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `shop_seting`
--
ALTER TABLE `shop_seting`
  MODIFY `shop_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sms_setting`
--
ALTER TABLE `sms_setting`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `supplier_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `sup_send`
--
ALTER TABLE `sup_send`
  MODIFY `sup_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `sys_users`
--
ALTER TABLE `sys_users`
  MODIFY `userid` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
