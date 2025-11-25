-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 30, 2025 at 04:29 PM
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
-- Database: `cafeluntiandata`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_tbl`
--

CREATE TABLE `admin_tbl` (
  `Admin_ID` int(50) NOT NULL,
  `User_FName` varchar(255) NOT NULL,
  `User_LName` varchar(255) NOT NULL,
  `Email` varchar(55) NOT NULL,
  `Password` varchar(20) NOT NULL,
  `Contact_Num` varchar(20) NOT NULL,
  `Account_Created` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_tbl`
--

INSERT INTO `admin_tbl` (`Admin_ID`, `User_FName`, `User_LName`, `Email`, `Password`, `Contact_Num`, `Account_Created`) VALUES
(202502001, 'Jewel', 'Ordanza', 'jewel@gmail.com', '$2y$10$eSPPu.a8vbe3v', '09934129155', '2025-02-28'),
(202502002, 'Althea', 'Castro', 'althea@gmail.com', '1111', '09266521525', '2025-02-28'),
(202502003, 'Jewel Marie', 'Ordanza', '2120465@ub.edu.ph', '1212', '09551826420', '2025-02-28'),
(202502004, 'Shane', 'Keh', 'keh@gmail.com', 'shane', '09934129155', '2025-02-28'),
(202502005, 'Jewel Marie', 'Ordanza', 'jew@gmail.com', '1212', '09934129155', '2025-02-28'),
(202502006, 'Thea', 'Castro', 'theaa@gmail.com', '1234', '0927838167', '2025-02-28'),
(202503001, 'John', 'Doe', 'johndoe@gmail.com', '1212', '123456789', '2025-03-03');

-- --------------------------------------------------------

--
-- Table structure for table `customer_order_tbl`
--

CREATE TABLE `customer_order_tbl` (
  `Order_ID` int(11) NOT NULL,
  `Customer_Name` varchar(255) NOT NULL,
  `Contact` varchar(20) DEFAULT NULL,
  `Email` varchar(155) NOT NULL,
  `Order_Name` varchar(255) NOT NULL,
  `Price` int(11) NOT NULL,
  `Quantity` int(11) NOT NULL,
  `Room_Num` int(11) NOT NULL,
  `Mode_of_Service` varchar(255) NOT NULL,
  `Time` time NOT NULL,
  `Receipt` varchar(255) DEFAULT NULL,
  `Status` varchar(50) NOT NULL DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer_order_tbl`
--

INSERT INTO `customer_order_tbl` (`Order_ID`, `Customer_Name`, `Contact`, `Email`, `Order_Name`, `Price`, `Quantity`, `Room_Num`, `Mode_of_Service`, `Time`, `Receipt`, `Status`) VALUES
(202503001, 'Jewel Ordanza', '01234567895', 'jew@gmail.com', '', 0, 0, 201, 'Delivery', '13:03:00', 'uploads/202503001_aaa.jpg', 'Pending'),
(202503002, 'Shane Keh', '09586421452', 'shane@gmail.com', '', 0, 0, 222, 'Pickup', '13:04:00', 'uploads/202503002_aaa.jpg', 'Pending'),
(202503003, 'Althea Castro', '03265478995', 'Althea@gmail.com', '', 0, 0, 205, 'Pickup', '13:05:00', 'uploads/202503003_aaa.jpg', 'Pending'),
(202503004, 'test101', '09123456789', 'test@gmail.com', '', 0, 0, 5, 'Delivery', '16:13:00', 'uploads/202503004_a.png', 'Pending'),
(202503005, 'lois', '02314569874', 'Lois@gmail.com', '', 0, 0, 0, 'Pickup', '16:37:00', NULL, 'Pending'),
(202503006, 'thea', '09123456789', 'thea@gmail.com', '', 0, 0, 202, 'Delivery', '17:37:00', NULL, 'Pending'),
(202504001, 'Thea', '09876543212', 'thea@gmail.com', '', 0, 0, 0, 'Pickup', '12:42:00', NULL, 'pending'),
(202504002, 'Thea', '09876543212', 'althea@gmail.com', '', 0, 0, 206, 'Delivery', '12:44:00', NULL, 'pending'),
(202504003, 'Thea', '09876543212', 'asas@gmail.com', '', 0, 0, 0, 'Pickup', '14:50:00', NULL, 'pending'),
(202504004, 'asas', '1234', 'asas@gmail.com', '', 0, 0, 0, 'Pickup', '14:53:00', NULL, 'pending'),
(202504005, 'Thea', '09876543212', 'althea@gmail.com', '', 0, 0, 0, 'Pickup', '14:00:00', NULL, 'pending'),
(202504006, 'Thea', '09876543212', 'althea@gmail.com', '', 0, 0, 0, 'Pickup', '12:02:00', NULL, 'pending'),
(202504007, 'asas', '1234', 'asas@gmail.com', '', 0, 0, 0, 'Pickup', '15:17:00', NULL, 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `order_items_tbl`
--

CREATE TABLE `order_items_tbl` (
  `Item_ID` int(11) NOT NULL,
  `Order_ID` int(11) NOT NULL,
  `Item_Name` varchar(255) NOT NULL,
  `Quantity` int(11) NOT NULL,
  `Price` decimal(10,2) NOT NULL,
  `Subtotal` decimal(10,2) NOT NULL,
  `Created_At` timestamp NOT NULL DEFAULT current_timestamp(),
  `Add_Ons` text DEFAULT NULL,
  `Add_Ons_Price` decimal(10,2) DEFAULT NULL,
  `Status` varchar(50) NOT NULL DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_items_tbl`
--

INSERT INTO `order_items_tbl` (`Item_ID`, `Order_ID`, `Item_Name`, `Quantity`, `Price`, `Subtotal`, `Created_At`, `Add_Ons`, `Add_Ons_Price`, `Status`) VALUES
(6, 202503001, 'Americano', 1, 129.00, 129.00, '2025-03-13 17:03:30', NULL, NULL, 'Pending'),
(7, 202503002, 'Java Chip', 2, 149.00, 298.00, '2025-03-13 17:04:44', NULL, NULL, 'Pending'),
(8, 202503002, 'Dark Chocolate', 1, 129.00, 129.00, '2025-03-13 17:04:44', NULL, NULL, 'Pending'),
(9, 202503003, 'Cappuccino', 1, 99.00, 99.00, '2025-03-13 17:05:31', NULL, NULL, 'Pending'),
(10, 202503003, 'Salted Caramel', 2, 99.00, 198.00, '2025-03-13 17:05:31', NULL, NULL, 'Pending'),
(11, 202503004, 'Caramel', 1, 99.00, 99.00, '2025-03-13 17:13:56', NULL, NULL, 'Pending'),
(12, 202503004, 'Dirty Matcha', 2, 129.00, 258.00, '2025-03-13 17:13:56', NULL, NULL, 'Pending'),
(13, 202503005, 'Spanish Latte', 1, 99.00, 99.00, '2025-03-15 15:37:36', 'alcohol', 0.00, 'Pending'),
(14, 202503005, 'Cappuccino', 1, 99.00, 99.00, '2025-03-15 15:37:36', 'coffee', 0.00, 'Pending'),
(15, 202503006, 'Caramel Macchiato', 1, 99.00, 99.00, '2025-03-15 15:38:00', 'alcohol', 0.00, 'confirmed'),
(16, 202503006, 'Salted Caramel', 1, 99.00, 99.00, '2025-03-15 15:38:00', NULL, 0.00, 'confirmed'),
(17, 202504001, 'Caramel Macchiato', 1, 99.00, 99.00, '2025-04-30 13:43:44', NULL, 0.00, 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `table_reservation_tbl`
--

CREATE TABLE `table_reservation_tbl` (
  `Reservation_ID` int(11) NOT NULL,
  `Full_Name` varchar(255) NOT NULL,
  `Reservation_Date` date NOT NULL,
  `Reservation_Time` time NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Pax` int(11) NOT NULL,
  `Reservation_Created` datetime NOT NULL,
  `Status` varchar(50) NOT NULL DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `table_reservation_tbl`
--

INSERT INTO `table_reservation_tbl` (`Reservation_ID`, `Full_Name`, `Reservation_Date`, `Reservation_Time`, `Email`, `Pax`, `Reservation_Created`, `Status`) VALUES
(202502021, 'Jewel Ordanza', '2025-03-08', '13:00:00', 'jew@gmail.com', 5, '2025-02-28 13:52:11', 'confirmed'),
(202502022, 'Shane Keh', '2025-03-05', '10:00:00', 'shane@gmail.com', 5, '2025-02-28 13:52:44', 'confirmed'),
(202502023, 'Althea Lois Castro', '2025-04-01', '14:30:00', 'althea@gmail.com', 2, '2025-02-28 13:53:33', 'confirmed');

-- --------------------------------------------------------

--
-- Table structure for table `transactions_tbl`
--

CREATE TABLE `transactions_tbl` (
  `Transaction_ID` int(11) NOT NULL,
  `Order_ID` int(11) NOT NULL,
  `Order_Date` datetime NOT NULL,
  `Contact_Num` bigint(20) NOT NULL,
  `Amount` varchar(255) NOT NULL,
  `Receipt` int(11) NOT NULL,
  `Status` int(11) NOT NULL,
  `Payment_Date` datetime NOT NULL,
  `Customer_Name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transactions_tbl`
--

INSERT INTO `transactions_tbl` (`Transaction_ID`, `Order_ID`, `Order_Date`, `Contact_Num`, `Amount`, `Receipt`, `Status`, `Payment_Date`, `Customer_Name`) VALUES
(1, 202503006, '2025-04-30 21:40:12', 0, '248.00', 0, 0, '0000-00-00 00:00:00', 'thea');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_tbl`
--
ALTER TABLE `admin_tbl`
  ADD PRIMARY KEY (`Admin_ID`);

--
-- Indexes for table `customer_order_tbl`
--
ALTER TABLE `customer_order_tbl`
  ADD PRIMARY KEY (`Order_ID`);

--
-- Indexes for table `order_items_tbl`
--
ALTER TABLE `order_items_tbl`
  ADD PRIMARY KEY (`Item_ID`),
  ADD KEY `Order_ID` (`Order_ID`);

--
-- Indexes for table `table_reservation_tbl`
--
ALTER TABLE `table_reservation_tbl`
  ADD PRIMARY KEY (`Reservation_ID`);

--
-- Indexes for table `transactions_tbl`
--
ALTER TABLE `transactions_tbl`
  ADD PRIMARY KEY (`Transaction_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_tbl`
--
ALTER TABLE `admin_tbl`
  MODIFY `Admin_ID` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=202503002;

--
-- AUTO_INCREMENT for table `customer_order_tbl`
--
ALTER TABLE `customer_order_tbl`
  MODIFY `Order_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=202504008;

--
-- AUTO_INCREMENT for table `order_items_tbl`
--
ALTER TABLE `order_items_tbl`
  MODIFY `Item_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `table_reservation_tbl`
--
ALTER TABLE `table_reservation_tbl`
  MODIFY `Reservation_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=202502024;

--
-- AUTO_INCREMENT for table `transactions_tbl`
--
ALTER TABLE `transactions_tbl`
  MODIFY `Transaction_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `order_items_tbl`
--
ALTER TABLE `order_items_tbl`
  ADD CONSTRAINT `order_items_tbl_ibfk_1` FOREIGN KEY (`Order_ID`) REFERENCES `customer_order_tbl` (`Order_ID`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
