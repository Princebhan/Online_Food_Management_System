-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 13, 2023 at 05:27 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `food`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `id` int(10) UNSIGNED NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`id`, `full_name`, `username`, `password`) VALUES
(1, 'prince bhandari', 'prince', '0192023a7bbd73250516f069df18b500'),
(11, 'hitesh', 'hitesh', '4653f3b6dc2547ef1d488aa67eca4f21'),
(16, 'admin', 'admin', '21232f297a57a5a743894a0e4a801fc3'),
(18, 'panth', 'panth', '93eec77308d3f193c7532b3820b63bb4');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

CREATE TABLE `tbl_category` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(100) NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `featured` varchar(10) NOT NULL,
  `active` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`id`, `title`, `image_name`, `featured`, `active`) VALUES
(13, 'Burgar', 'Food_Category_371.jpg', 'Yes', 'Yes'),
(15, 'pizza', 'Food_Category_126.jpg', 'Yes', 'Yes'),
(17, 'MOMO', 'Food_Category_620.jpg', 'Yes', 'Yes'),
(19, 'aalupuri', 'Food_Category_567.jpg', 'Yes', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_food`
--

CREATE TABLE `tbl_food` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `featured` varchar(10) NOT NULL,
  `active` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_food`
--

INSERT INTO `tbl_food` (`id`, `title`, `description`, `price`, `image_name`, `category_id`, `featured`, `active`) VALUES
(2, 'pizza', 'Testy', 300.00, 'Food-Name-5381.jpg', 13, 'Yes', 'Yes'),
(3, 'Burger', 'good', 200.00, 'Food-Name-9875.jpg', 13, 'Yes', 'Yes'),
(5, 'MOMOS', 'Liked ', 150.00, 'Food-Name-865.jpg', 17, 'Yes', 'Yes'),
(6, 'aalu_puri', 'oky', 40.00, 'Food-Name-2348.jpg', 19, 'No', 'Yes'),
(7, 'onion pizza', 'qqq', 120.00, 'Food-Name-7602.png', 15, 'No', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order`
--

CREATE TABLE `tbl_order` (
  `id` int(10) UNSIGNED NOT NULL,
  `food` varchar(150) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `qty` int(11) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `order_date` datetime NOT NULL,
  `status` varchar(50) NOT NULL,
  `customer_name` varchar(150) NOT NULL,
  `customer_contact` varchar(20) NOT NULL,
  `customer_email` varchar(150) NOT NULL,
  `customer_address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_order`
--

INSERT INTO `tbl_order` (`id`, `food`, `price`, `qty`, `total`, `order_date`, `status`, `customer_name`, `customer_contact`, `customer_email`, `customer_address`) VALUES
(3, 'MOMOS', 150.00, 1, 150.00, '2023-08-26 02:49:48', 'Delivered', 'chetna', '545', 'chetna22@gmail.com', 'surat'),
(4, 'MOMOS', 150.00, 10, 1500.00, '2023-08-26 02:51:00', 'Cancelled', 'Hem', '8484', 'chetu@gmail.com', 'Vapi'),
(5, 'pizza', 300.00, 1, 300.00, '2023-08-26 03:04:20', 'Delivered', 'Prince22', '65415', 'prince@gmail.com', 'surat'),
(6, 'aalu_puri', 40.00, 10, 400.00, '2023-08-26 03:49:00', 'Delivered', 'Ekta', '5849', 'admin@webdamn.com', 'c/904  sangini swaraj\r\njahangirpura adajan'),
(7, 'MOMOS', 150.00, 1, 150.00, '2023-08-28 09:18:37', 'Delivered', 'Heet', '654865', 'Heet@gmail.com', 'adajan'),
(8, 'MOMOS', 150.00, 3, 450.00, '2023-09-20 03:18:48', 'On Delivery', 'Ekta', '265956', 'p3@gmail.com', 'qwwewadsf'),
(9, 'Burger', 200.00, 2, 400.00, '2023-10-02 08:31:55', 'Delivered', 'chetna bhandari', '265956', 'chetu@gmail.com', 'jahabaojo');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `username` varchar(150) NOT NULL,
  `password` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`username`, `password`) VALUES
('baman', '8fde95f8c558f47347e135b979ab7aa1'),
('bhavik', '53acf5f531943514246a7ed92f496a7d'),
('chaman', 'a6531cbc7ef70060b60caa6da47cc0a2'),
('chetna', '461cb5495494f8d5292559a390f2b45f'),
('chor', '4ba674d85fbee92042e7d76e61145904'),
('dhas', '1511e8f54ee72a1b6b09e7184b9638fa'),
('dhru', '07fd042d474ab3bf5d3ba6e048d0517d'),
('dinesh', '9c9f1c65b1dc1f79498c9f09eb610e1a'),
('hem', '83368f29e6d092aacef9e4b10b0185ab'),
('mahesh', '49bb197bec17b7d20b2df6b1f3c3434a'),
('meet', 'df421bd994d485f5d58ce2445cf2ee0e'),
('mitesh', 'cdbe75eb932913e135ed90941f1b3789'),
('mono', '654db8a14a5f633b9ba85ec92dc51f7c'),
('p3', '202cb962ac59075b964b07152d234b70'),
('prince', 'prince'),
('princebhandari22@gmail.com', 'ad8b7319be5f63a99b6d927502c6d416'),
('princess', '8afa847f50a716e64932d995c8e7435a'),
('riyan', 'ba4e586503b7cb15e2b54b9729c066ed');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_category`
--
ALTER TABLE `tbl_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_food`
--
ALTER TABLE `tbl_food`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_order`
--
ALTER TABLE `tbl_order`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `tbl_food`
--
ALTER TABLE `tbl_food`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_order`
--
ALTER TABLE `tbl_order`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
