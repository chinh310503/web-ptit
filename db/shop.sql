-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th12 23, 2024 lúc 09:49 AM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `shop`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `product_code` varchar(60) NOT NULL,
  `product_name` varchar(60) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `products_available` int(11) NOT NULL,
  `products_supplier` varchar(30) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Đang đổ dữ liệu cho bảng `products`
--

INSERT INTO `products` (`id`, `product_code`, `product_name`, `price`, `products_available`, `products_supplier`) VALUES
(1, 'P1', 'Cow Milk', 70.00, 35, 'NCC1'),
(2, 'P2', 'Coffee 500g', 315.00, 90, 'NCC2'),
(3, 'P3', 'Coffee 250g', 240.00, 100, 'NCC3'),
(4, 'P4', 'Milk coffee', 35.00, 74, 'NCC4'),
(5, 'P5', 'latte coffee', 55.00, 99, 'NCC5'),
(6, 'P6', 'Pudding ', 50.00, 0, 'NCC6'),
(7, 'P7', 'Black coffee', 45.00, 11, 'NCC7');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `total_purchase`
--

CREATE TABLE `total_purchase` (
  `purchase_id` int(11) NOT NULL,
  `purchase_date` timestamp NULL DEFAULT current_timestamp(),
  `purchase_total` int(11) NOT NULL,
  `user_id` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Đang đổ dữ liệu cho bảng `total_purchase`
--

INSERT INTO `total_purchase` (`purchase_id`, `purchase_date`, `purchase_total`, `user_id`) VALUES
(1, '2024-08-17 05:24:15', 76, 'employee1'),
(2, '2024-08-18 05:45:49', 457, 'employee1'),
(3, '2024-08-20 08:13:02', 39, 'employee1'),
(4, '2024-08-20 08:25:05', 543, 'employee1'),
(5, '2024-08-20 08:28:22', 410, 'employee2'),
(6, '2024-08-20 10:04:57', 474, 'employee3'),
(7, '2024-08-22 13:35:50', 1006, 'employee1'),
(8, '2024-08-22 13:57:37', 36, 'employee1'),
(9, '2024-09-06 16:50:31', 82, 'employee1'),
(10, '2024-09-07 05:53:14', 18, 'employee2'),
(11, '2024-09-07 06:21:25', 403, 'employee2'),
(12, '2024-09-07 06:46:48', 403, 'employee2'),
(13, '2024-09-07 07:13:16', 82, 'employee2'),
(14, '2024-09-07 08:11:36', 59, 'employee2'),
(15, '2024-09-07 09:10:25', 59, 'employee2'),
(16, '2024-09-25 05:07:54', 18, 'employee2'),
(17, '2024-10-18 07:56:44', 386, 'employee1'),
(18, '2024-10-18 07:48:57', 386, 'employee1'),
(19, '2024-10-18 07:53:18', 386, 'employee1'),
(119, '2024-11-14 13:24:50', 386, 'employee1'),
(122, '2024-11-14 14:20:18', 345, 'employee1');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `user_name` varchar(30) NOT NULL,
  `user_id` varchar(30) NOT NULL,
  `user_type` varchar(30) NOT NULL,
  `user_pass` varchar(30) NOT NULL,
  `user_address` varchar(120) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`user_name`, `user_id`, `user_type`, `user_pass`, `user_address`) VALUES
('employee3', 'employee3', 'employee', '1234', 'Nam Dinh, Viet Nam'),
('employee1', 'employee1', 'employee', '1234', 'Ha Nam, Viet Nam'),
('employee2', 'employee2', 'employee', '1234', 'Nam Dinh, Viet Nam'),
('admin', 'admin1', 'admin', '1234', 'Nam Dinh, Viet Nam');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `product_code` (`product_code`);

--
-- Chỉ mục cho bảng `total_purchase`
--
ALTER TABLE `total_purchase`
  ADD PRIMARY KEY (`purchase_id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT cho bảng `total_purchase`
--
ALTER TABLE `total_purchase`
  MODIFY `purchase_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=123;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
