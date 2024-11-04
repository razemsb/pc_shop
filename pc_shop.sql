-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 01, 2024 at 07:09 PM
-- Server version: 5.7.24
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pc_shop`
--

-- --------------------------------------------------------

--
-- Table structure for table `catalog`
--

CREATE TABLE `catalog` (
  `ID` int(4) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Img` varchar(255) NOT NULL,
  `Price` int(20) NOT NULL,
  `Category` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `catalog`
--

INSERT INTO `catalog` (`ID`, `Name`, `Img`, `Price`, `Category`) VALUES
(6, 'Видеокарта', 'comp/video/video1.png', 56000, 'Видеокарта'),
(7, 'Видеокарта', 'comp/video/video2.png', 55000, 'Видеокарта'),
(8, 'Видеокарта', 'comp/video/video3.png', 47000, 'Видеокарта'),
(9, 'Видеокарта', 'comp/video/video4.png', 80000, 'Видеокарта'),
(10, 'Видеокарта', 'comp/video/video5.png', 65000, 'Видеокарта'),
(11, 'Процессор', 'comp/proc/cor.png', 40000, 'Процессор'),
(12, 'Процессор', 'comp/proc/cor2.jpg', 34000, 'Процессор'),
(13, 'Процессор', 'comp/proc/cor3.png', 50000, 'Процессор'),
(14, 'Процессор', 'comp/proc/cor4.png', 33000, 'Процессор'),
(15, 'Материнская плата', 'comp/mother/mot1.png', 10000, 'Материнская плата'),
(16, 'Материнская плата', 'comp/mother/mot2.png', 15000, 'Материнская плата'),
(17, 'Материнская плата', 'comp/mother/mot3.png', 20000, 'Материнская плата'),
(18, 'Материнская плата', 'comp/mother/mot4.png', 25000, 'Материнская плата'),
(19, 'Материнская плата', 'comp/mother/mot5.png', 9990, 'Материнская плата'),
(20, '8GB DDR4', 'comp/memory/mm1.png', 5000, 'Оперативная память'),
(21, '8GB DDR4', 'comp/memory/mm2.png', 5500, 'Оперативная память'),
(22, '16GB DDR4', 'comp/memory/mm3.png', 6500, 'Оперативная память'),
(23, '8GB DDR4', 'comp/memory/mm4.png', 4500, 'Оперативная память'),
(24, '4GB DDR3', 'comp/memory/mm5.png', 3500, 'Оперативная память'),
(25, '16GB DDR5', 'comp/memory/mm6.png', 7500, 'Оперативная память'),
(26, 'SSD', 'comp/ssd/ssd1.jpeg', 3500, 'SSD'),
(27, 'SSD', 'comp/ssd/ssd2.jpeg', 4000, 'SSD'),
(28, 'SSD', 'comp/ssd/ssd3.jpg', 5500, 'SSD'),
(29, 'SSD', 'comp/ssd/ssd4.jpg', 6600, 'SSD'),
(30, 'SSD', 'comp/ssd/ssd5.jpg', 6800, 'SSD'),
(31, 'SSD', 'comp/ssd/ssd6.png', 9000, 'SSD'),
(32, 'SSD', 'comp/ssd/ssd7.jpg', 10000, 'SSD'),
(33, 'SSD', 'comp/ssd/ssd8.jpg', 13000, 'SSD'),
(34, 'Корпус', 'comp/box/box1.png', 3500, 'Корпус'),
(35, 'Корпус', 'comp/box/box2.png', 5000, 'Корпус'),
(36, 'Корпус', 'comp/box/box3.png', 10000, 'Корпус'),
(37, 'Корпус', 'comp/box/box4.png', 11000, 'Корпус'),
(38, 'Корпус', 'comp/box/box5.png', 7000, 'Корпус'),
(39, 'Корпус', 'comp/box/box6.png', 13000, 'Корпус'),
(40, 'Корпус', 'comp/box/box7.png', 18000, 'Корпус'),
(41, 'Монитор - 60ГЦ', 'comp/monik/m1.png', 10000, 'Монитор'),
(42, 'Монитор - 144ГЦ', 'comp/monik/m2.png', 22000, 'Монитор'),
(43, 'Монитор - 60ГЦ', 'comp/monik/m3.png', 18000, 'Монитор'),
(44, 'Монитор - 60ГЦ', 'comp/monik/m4.png', 17000, 'Монитор'),
(45, 'Монитор - 60ГЦ', 'comp/monik/m5.png', 15000, 'Монитор'),
(46, 'Монитор - 144ГЦ', 'comp/monik/m6.png', 26000, 'Монитор'),
(47, 'Монитор - 244ГЦ', 'comp/monik/m7.png', 30000, 'Монитор'),
(48, 'Монитор - 144ГЦ', 'comp/monik/m8.png', 21000, 'Монитор'),
(49, 'Монитор - 144ГЦ', 'comp/monik/m9.png', 25000, 'Монитор'),
(50, 'Монитор - 60ГЦ', 'comp/monik/m10.png', 28000, 'Монитор'),
(56, 'Корпус', 'comp/box/box6.png', 13000, 'Корпус'),
(57, 'Корпус', 'comp/box/box7.png', 18000, 'Корпус'),
(58, 'Монитор - 60ГЦ', 'comp/monik/m1.png', 10000, 'Монитор'),
(59, 'Монитор - 144ГЦ', 'comp/monik/m2.png', 22000, 'Монитор'),
(60, 'Монитор - 60ГЦ', 'comp/monik/m3.png', 18000, 'Монитор');

-- --------------------------------------------------------

--
-- Table structure for table `pc`
--

CREATE TABLE `pc` (
  `ID` int(3) NOT NULL,
  `Name` varchar(10) NOT NULL,
  `Diss1` text NOT NULL,
  `Diss2` text NOT NULL,
  `Price` int(20) NOT NULL,
  `Img` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pc`
--

INSERT INTO `pc` (`ID`, `Name`, `Diss1`, `Diss2`, `Price`, `Img`) VALUES
(1, 'PC-1', 'NVIDIA GeForce RTX 4070 Ti, AMD Ryzen 7 5800X3D', '1 ТБ NVMe, 32 ГБ DDR4 3200 МГц', 200000, 'img/pcshop1.png'),
(2, 'PC-2', 'NVIDIA GeForce RTX 3060 Ti, AMD Ryzen 5 5600X', '1 ТБ NVMe, 16 ГБ DDR4 3200 МГц', 150000, 'img/pcshop2.png'),
(3, 'PC-3', 'NVIDIA GeForce RTX 4080 Ti, Intel Core i9-13900K', '2 ТБ NVMe, 32 ГБ DDR5 6000 МГц', 240000, 'img/pcshop3.png'),
(4, 'PC-4', 'NVIDIA GeForce RTX 4070, AMD Ryzen 7 5800X', '1 ТБ NVMe, 32 ГБ DDR4 3200 МГц', 199000, 'img/pcshop4.png'),
(5, 'PC-5', 'NVIDIA GeForce RTX 4090, AMD Ryzen 9 7900X', '2 ТБ NVMe, 32 ГБ DDR5 6000 МГц', 300000, 'img/pcshop5.png'),
(61, 'PC-6', 'NVIDIA GeForce RTX 3060, Intel Core i5-12400', '500 ГБ NVMe, 16 ГБ DDR4 3200 МГц', 120000, 'img/pcshop6.png'),
(62, 'PC-7', 'NVIDIA GeForce RTX 4070, AMD Ryzen 7 5800X', '1 ТБ NVMe, 32 ГБ DDR4 3200 МГц', 190000, 'img/pcshop7.png'),
(63, 'PC-8', 'NVIDIA GeForce RTX 3060 Ti, AMD Ryzen 5 5600X', '1 ТБ NVMe, 16 ГБ DDR4 3200 МГц', 150000, 'img/pcshop8.png'),
(64, 'PC-9', 'AMD Radeon RX 6700 XT, AMD Ryzen 5 5600X', '1 ТБ NVMe, 16 ГБ DDR4 3200 МГц', 150000, 'img/pcshop9.png'),
(65, 'PC-10', 'NVIDIA GeForce RTX 4090, AMD Ryzen 9 7950X', '2 ТБ NVMe, 64 ГБ DDR5 6000 МГц', 330000, 'img/pcshop10.png'),
(66, 'PC-11', 'NVIDIA GeForce RTX 4090, AMD Ryzen 9 7950X', '2 ТБ NVMe, 64 ГБ DDR5 6000 МГц', 400000, 'img/pcshop11.png'),
(67, 'PC-12', 'NVIDIA GeForce RTX 4090, AMD Ryzen 9 7950X', '2 ТБ NVMe, 64 ГБ DDR5 6000 МГц', 350000, 'img/pcshop12.png');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `ID` int(3) NOT NULL,
  `Login` varchar(40) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Email` varchar(40) NOT NULL,
  `is_admin` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`ID`, `Login`, `Password`, `Email`, `is_admin`) VALUES
(2, 'razemsb', '$2y$10$FTR6dY78SGjHbNAO4OFUmeliozRjxohrIJak7JZQhdu.I43G/7FOG', 'chlen@gmail.com', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `catalog`
--
ALTER TABLE `catalog`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `pc`
--
ALTER TABLE `pc`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `catalog`
--
ALTER TABLE `catalog`
  MODIFY `ID` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `pc`
--
ALTER TABLE `pc`
  MODIFY `ID` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
