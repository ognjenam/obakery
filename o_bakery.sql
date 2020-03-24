-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 21, 2020 at 07:12 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `o_bakery`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_ID` int(50) NOT NULL,
  `name` varchar(40) COLLATE utf8mb4_bin NOT NULL,
  `available` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_ID`, `name`, `available`) VALUES
(1, 'cupcakes', 1),
(2, 'pies', 1),
(3, 'donuts', 1),
(4, 'cookies', 1);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_ID` int(50) NOT NULL,
  `category_ID` int(50) NOT NULL,
  `name` varchar(40) COLLATE utf8mb4_bin NOT NULL,
  `price` decimal(4,2) NOT NULL,
  `image` varchar(100) COLLATE utf8mb4_bin NOT NULL,
  `info` varchar(100) COLLATE utf8mb4_bin NOT NULL,
  `available` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_ID`, `category_ID`, `name`, `price`, `image`, `info`, `available`) VALUES
(1, 4, 'bluebird', '4.69', 'cookies/bluebird.jpg', 'blueberry cream cheese frosting between two sugar cookies', 1),
(2, 4, 'birthday blast', '4.69', 'cookies/birthday_blast.jpg', 'birthday frosting between two cookies', 1),
(3, 4, 'cookie dough delight', '4.69', 'cookies/cookie_dough_delight.jpg', 'edible cookie dough between two chocolate chip cookies', 1),
(4, 4, 'white out', '4.69', 'cookies/white_out.jpg', 'vanilla buttercream frosting between two sugar cookies', 1),
(5, 1, 'milk chocolate', '3.45', 'cupcakes/milk_chocolate.jpg', 'chocolate cupcake with vanilla buttercream frosting and m&ms', 1),
(6, 1, 'mint chocolate bliss', '3.55', 'cupcakes/mint_chocolate_bliss.jpg', 'chocolate cupcake with peppermint buttercream frosting topped with after eight', 1),
(7, 1, 'vanilla chocolate', '3.30', 'cupcakes/vanilla_chocolate.jpg', 'vanilla cupcake with chocolate buttercream frosting\r\n', 1),
(8, 1, 'zesty lemon', '3.65', 'cupcakes/zesty_lemon.jpg', 'lemon cupcake with lemon buttercream frosting', 1),
(9, 1, 'bounty', '3.75', 'cupcakes/bounty.jpg', 'chocolate with coconut buttercream\r\nand snowflake frosting', 1),
(10, 1, 'lavender', '3.55', 'cupcakes/lavender.jpg', 'vanilla cupcake with a hint of lavender & lavender frosting', 1),
(11, 3, 'glazed', '1.99', 'donuts/glazed.jpg', 'caramel glazed donut topped with toasted coconut', 1),
(12, 3, 'cinnamon sugar', '3.79', 'donuts/cinnamon_sugar.jpg', 'the staple. no glaze, just a perfect blend of cinnamon and sugar', 1),
(13, 3, 'strawberry bismark', '2.79', 'donuts/strawberry_bismark.jpg', 'keeping it simple with a fresh strawberry infused glaze, and gleaming sprinkles.', 1),
(14, 3, 'strawberry glazed', '2.79', 'donuts/strawberry_glazed.jpg', 'classic strawberry flavor, filled with chocolate glaze ', 1),
(15, 3, 'vanilla sprinkled', '1.99', 'donuts/vanilla_sprinkled.jpg', 'you know this old friend. rainbow sprinkles and vanilla come together in perfect harmony', 1),
(16, 2, 'chocolate cream', '24.00', 'pies/chocolate_cream.jpg', 'with a cookie crust, silky chocolate pudding center and pillowy whipped cream topping', 1),
(17, 2, 'coconut cream', '22.00', 'pies/coconut_cream.jpg', 'filled with coconut custard and covered in whipped cream and heaps of toasted coconut', 1),
(18, 2, 'perfect pumpkin', '24.00', 'pies/perfect_pumpkin.jpg', 'tender, flaky crust and gently spiced pumpkin filling', 1),
(19, 2, 'lemon meringue', '26.00', 'pies/lemon_meringue.jpg', 'with a graham cracker crust and sweetened condensed milk filling', 1),
(20, 2, 'sweet potato', '22.00', 'pies/sweet_potato.jpg', 'fluffy and flavored with brown sugar and autumn spices', 1),
(21, 2, 'chocolate peanut butter', '24.00', 'pies/chocolate_peanut_butter.jpg', 'with a chocolate wafer crust, rich peanut butter filling, and silky chocolate ganache topping', 1);

-- --------------------------------------------------------

--
-- Table structure for table `product_user`
--

CREATE TABLE `product_user` (
  `product_user_ID` int(255) NOT NULL,
  `product_ID` int(255) NOT NULL,
  `user_ID` int(255) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `product_user`
--

INSERT INTO `product_user` (`product_user_ID`, `product_ID`, `user_ID`, `date`) VALUES
(5, 2, 1, '2020-02-16 21:07:15'),
(6, 2, 1, '2020-02-16 21:17:14');

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `role_ID` int(255) NOT NULL,
  `name` varchar(40) COLLATE utf8mb4_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`role_ID`, `name`) VALUES
(1, 'admin'),
(2, 'user');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_ID` int(255) NOT NULL,
  `role_ID` int(255) NOT NULL,
  `e_mail` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `register_date` datetime NOT NULL,
  `last_visit` datetime(6) NOT NULL,
  `active` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_ID`, `role_ID`, `e_mail`, `password`, `username`, `register_date`, `last_visit`, `active`) VALUES
(1, 1, 'obakery@gmail.com', '', 'itsogii', '2020-02-02 10:51:25', '2020-02-16 20:28:53.000000', 1);

-- --------------------------------------------------------

--
-- Table structure for table `visits`
--

CREATE TABLE `visits` (
  `visit_ID` int(255) NOT NULL,
  `number` bigint(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `visits`
--

INSERT INTO `visits` (`visit_ID`, `number`) VALUES
(1, 2742);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_ID`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_ID`),
  ADD KEY `category_ID` (`category_ID`);

--
-- Indexes for table `product_user`
--
ALTER TABLE `product_user`
  ADD PRIMARY KEY (`product_user_ID`),
  ADD KEY `product_ID` (`product_ID`),
  ADD KEY `user_ID` (`user_ID`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`role_ID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_ID`),
  ADD KEY `role_ID` (`role_ID`);

--
-- Indexes for table `visits`
--
ALTER TABLE `visits`
  ADD PRIMARY KEY (`visit_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_ID` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_ID` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `product_user`
--
ALTER TABLE `product_user`
  MODIFY `product_user_ID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `role_ID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_ID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `visits`
--
ALTER TABLE `visits`
  MODIFY `visit_ID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`category_ID`) REFERENCES `category` (`category_ID`);

--
-- Constraints for table `product_user`
--
ALTER TABLE `product_user`
  ADD CONSTRAINT `product_user_ibfk_1` FOREIGN KEY (`product_ID`) REFERENCES `product` (`product_ID`),
  ADD CONSTRAINT `product_user_ibfk_2` FOREIGN KEY (`user_ID`) REFERENCES `user` (`user_ID`);

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`role_ID`) REFERENCES `role` (`role_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
