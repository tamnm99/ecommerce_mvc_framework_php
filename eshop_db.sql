-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th6 05, 2021 lúc 05:33 AM
-- Phiên bản máy phục vụ: 10.4.18-MariaDB
-- Phiên bản PHP: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `eshop_db`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_categories`
--

CREATE TABLE `tbl_categories` (
  `id` int(15) NOT NULL,
  `category_name` varchar(30) CHARACTER SET utf8 NOT NULL,
  `disabled` tinyint(1) NOT NULL DEFAULT 0,
  `parent` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `tbl_categories`
--

INSERT INTO `tbl_categories` (`id`, `category_name`, `disabled`, `parent`) VALUES
(1, 'Nữ', 0, 0),
(2, 'Nam', 0, 0),
(3, 'Trẻ Em', 0, 0),
(4, 'Trẻ Sơ Sinh', 0, 0),
(5, 'Áo Thun', 0, 1),
(6, 'Áo Polo', 0, 2),
(7, 'Quần Shorts', 0, 3);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_cities`
--

CREATE TABLE `tbl_cities` (
  `id` bigint(20) NOT NULL,
  `city` varchar(50) CHARACTER SET utf8 NOT NULL,
  `disabled` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `tbl_cities`
--

INSERT INTO `tbl_cities` (`id`, `city`, `disabled`) VALUES
(1, 'Hà Nội', 0),
(2, 'Hồ Chí Minh', 0),
(3, 'Bắc Giang', 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_districts`
--

CREATE TABLE `tbl_districts` (
  `id` int(11) NOT NULL,
  `parent` int(11) NOT NULL,
  `district` varchar(50) CHARACTER SET utf8 NOT NULL,
  `disabled` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `tbl_districts`
--

INSERT INTO `tbl_districts` (`id`, `parent`, `district`, `disabled`) VALUES
(1, 1, 'Thường Tín', 0),
(2, 2, 'Quận 1', 0),
(3, 1, 'Hà Đông', 0),
(4, 2, 'Quận 2', 0),
(5, 3, 'Lục Ngạn', 0),
(6, 3, 'Yên Dũng', 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_orders`
--

CREATE TABLE `tbl_orders` (
  `id` bigint(20) NOT NULL,
  `user_url_address` varchar(100) NOT NULL,
  `delivery_address` varchar(1024) DEFAULT NULL,
  `total` double NOT NULL DEFAULT 0,
  `city` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `district` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `zip` varchar(6) DEFAULT NULL,
  `tax` double DEFAULT 0,
  `shipping` double DEFAULT 0,
  `date` date NOT NULL,
  `session_id` varchar(30) NOT NULL,
  `phone_number` varchar(15) NOT NULL,
  `note` varchar(255) CHARACTER SET utf8 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `tbl_orders`
--

INSERT INTO `tbl_orders` (`id`, `user_url_address`, `delivery_address`, `total`, `city`, `district`, `zip`, `tax`, `shipping`, `date`, `session_id`, `phone_number`, `note`) VALUES
(1, 'svDMFE9wkM1ft5ylkL8lA2IGd0yP0oGWaCH1DeVCuKpqbfN1zq', '38 trần nhật duật hà đông', 998000, 'Hà Nội', 'Hà Đông', '1', 0, 0, '2021-06-04', 'mgpb9drfqrbn5gn3l4ksivu7d3', '1688489308', NULL),
(2, 'svDMFE9wkM1ft5ylkL8lA2IGd0yP0oGWaCH1DeVCuKpqbfN1zq', 'triều đông,tân minh,thường tín,hà nội', 598000, 'Hà Nội', 'Thường Tín', '113132', 0, 0, '2021-06-05', 'ftilvtpnqgsq0u4u1e6kfuo8tj', '123456789', NULL),
(6, 'svDMFE9wkM1ft5ylkL8lA2IGd0yP0oGWaCH1DeVCuKpqbfN1zq', 'triều đông,tân minh,thường tín,hà nội', 598000, 'Hà Nội', 'Thường Tín', '113132', 0, 0, '2021-06-05', 'ftilvtpnqgsq0u4u1e6kfuo8tj', '0388489308', 'take note');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_order_details`
--

CREATE TABLE `tbl_order_details` (
  `id` bigint(20) NOT NULL,
  `order_id` bigint(20) NOT NULL,
  `quantity` int(11) NOT NULL,
  `description` varchar(300) CHARACTER SET utf8 NOT NULL,
  `amount` double NOT NULL,
  `total` double NOT NULL,
  `product_id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `tbl_order_details`
--

INSERT INTO `tbl_order_details` (`id`, `order_id`, `quantity`, `description`, `amount`, `total`, `product_id`) VALUES
(1, 1, 2, 'NAM AIRism FLY FRONT POLO SHIRT', 499000, 998000, 3),
(2, 2, 2, 'NỮ DRY-EX CROPPED SLEEVELESS T-SHIRT', 299000, 598000, 2),
(3, 3, 2, 'NỮ DRY-EX CROPPED SLEEVELESS T-SHIRT', 299000, 598000, 2),
(4, 4, 2, 'NỮ DRY-EX CROPPED SLEEVELESS T-SHIRT', 299000, 598000, 2),
(5, 5, 2, 'NỮ DRY-EX CROPPED SLEEVELESS T-SHIRT', 299000, 598000, 2),
(6, 6, 2, 'NỮ DRY-EX CROPPED SLEEVELESS T-SHIRT', 299000, 598000, 2);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_products`
--

CREATE TABLE `tbl_products` (
  `id` int(15) NOT NULL,
  `user_url_address` varchar(60) NOT NULL,
  `description` varchar(300) CHARACTER SET utf8 NOT NULL,
  `category` int(15) NOT NULL,
  `price` float NOT NULL,
  `quantity` int(11) NOT NULL,
  `image` varchar(500) NOT NULL,
  `image2` varchar(500) DEFAULT NULL,
  `image3` varchar(500) DEFAULT NULL,
  `image4` varchar(500) DEFAULT NULL,
  `date` datetime NOT NULL,
  `slug` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `tbl_products`
--

INSERT INTO `tbl_products` (`id`, `user_url_address`, `description`, `category`, `price`, `quantity`, `image`, `image2`, `image3`, `image4`, `date`, `slug`) VALUES
(1, 'svDMFE9wkM1ft5ylkL8lA2IGd0yP0oGWaCH1DeVCuKpqbfN1zq', 'NỮ AIRism SEAMLESS V NECK LONG T-SHIRT', 5, 399000, 98, 'uploads/Gs0Y8YNv6MigOImMQYBwDnqyik5VNvXRDlfsLvfOf7Ki09IIVW8LksvJLhts.jpg', 'uploads/7Pc0nB1KtFGDg1THdZ88wzxzDfzno8d8JS7v971sMAeSeELwQJlJVixrvS39.jpg', 'uploads/4fp1gdNwNi5dWkCtTJkFBnHLUxXTVEWheYbQ3UecAqpdXf5p6qZxIc1VpYxQ.jpg', 'uploads/TrBJFSpVpItmSH4vPP7KdxeE6ghImYJ9TGm0JwwZTjH5NAQ2Jbg6CiP10m1w.jpg', '2021-06-04 14:30:49', 'nu-airism-seamless-v-neck-long-t-shirt'),
(2, 'svDMFE9wkM1ft5ylkL8lA2IGd0yP0oGWaCH1DeVCuKpqbfN1zq', 'NỮ DRY-EX CROPPED SLEEVELESS T-SHIRT', 5, 299000, 56, 'uploads/GKn8Jn4mCr90djSJbDq9LAgTnGcbSOAuuy1c1SOL2h1eYAhztYoNIMBmgons.jpg', 'uploads/A9SYRUpPNBzol7q1R0uqCLZ2LqtNJJhmeFnZxljI42o47VDJYygot5CDJlwY.jpg', 'uploads/pTO4aB9hSbJd432C4xLgSzhydlwKbnSq8mXTUbmYsjz3g6PJLI1vtcNVbH9i.jpg', 'uploads/1V9IY2HPwaGSYOhfmSFWTGX84QWqUZCwAtnLNY9hw19tXgU5BUSIBBoqS6yi.jpg', '2021-06-04 14:33:11', 'nu-dry-ex-cropped-sleeveless-t-shirt'),
(3, 'svDMFE9wkM1ft5ylkL8lA2IGd0yP0oGWaCH1DeVCuKpqbfN1zq', 'NAM AIRism FLY FRONT POLO SHIRT', 6, 499000, 45, 'uploads/PkGwvubVv812YJypoc2enZ5R5TXWNLNO1aqBpjGh7nQMRXOvnkTOiav8K3sN.jpg', 'uploads/As7oBn1vePaAi5Fr1zb3dWA2NE1OmY0JUYqOHflpb9a9MFqsGTwI0zrK1Yff.jpg', 'uploads/hdJio8iKMdfNsu8TnBNMQUjZYbwICqrf2EVVHVZZ8iPlaVVTqtzwyt5LYVBL.jpg', 'uploads/B1jzxCimsvLMNvEJ6yq1xsnzLSjUl5HVTErXrtoFVEWOa8Jn9WJ22z2bC1V3.jpg', '2021-06-04 14:36:44', 'nam-airism-fly-front-polo-shirt'),
(4, 'svDMFE9wkM1ft5ylkL8lA2IGd0yP0oGWaCH1DeVCuKpqbfN1zq', 'NAM DRY-EX SHORT SLEEVE POLO SHIRT', 6, 499000, 89, 'uploads/mfUAfoPVHC4nJbgbhU0bRvwdVdCM6gTrIxWT9NuTnq7m0QxfdCOAOQ7BRfAa.jpg', 'uploads/SMhvbvqJBfwj819U3yFcJGx7UFaC8aHqJvPYGlA96BDnhC9zJCmLfMYlIavG.jpg', 'uploads/UQ0tekcsLvjZZZDW0QuIT9IX86Tac1yuptcmv2c0x8wwp4fqzqAVsvRkZUfp.jpg', 'uploads/zzz0CxYSFbg8PtUUakBB7z0REvv6Yh3Q808ZjAiURMRdL7zGXDZtaM95fPEL.jpg', '2021-06-04 14:38:14', 'nam-dry-ex-short-sleeve-polo-shirt'),
(5, 'svDMFE9wkM1ft5ylkL8lA2IGd0yP0oGWaCH1DeVCuKpqbfN1zq', 'TRẺ EM Quần Short Denim', 7, 399000, 19, 'uploads/df51qd7RzwZjrktWTnwsuPz6Phq6CvtYDviT99LGqsvmCSzRUeOeN59bUdjK.jpg', 'uploads/6YvNZWaDShCsfJPhYSF4m2rNKa2y3LG3GfCpH71uhiw9cte7X3UoogN2ynEK.jpg', 'uploads/0p3782SvoN3mGRimhvhCWQQfR23kY4aVPTxYY79nFnZ65aMqAUogsuCbzt4S.jpg', '', '2021-06-04 14:40:15', 'tre-em-quan-short-denim'),
(6, 'svDMFE9wkM1ft5ylkL8lA2IGd0yP0oGWaCH1DeVCuKpqbfN1zq', 'TRẺ EM Quần Lửng DRY-EX', 7, 129000, 78, 'uploads/Tsd1oVgSQPdAECAGOaxnlVBuSQ8Llz3JAnYaitlYm12xqtIWP75qc07CZcks.jpg', 'uploads/bOlOszVcXZwjxsi5WZD7bFOt04ElWg25vZdfUHSoxtoCBoNBc05IYgjc0e9z.jpg', 'uploads/FJyWjCtYSG6YwEQ8eXEy0OrUGYFlKBuozsZyAVvWev0dvkSd3NNVR7ZKAedl.jpg', 'uploads/hgIhZos3wdKoc4FdhZUV7EU6vPPHZLotJRN6XOUAUSCt87qKDzeazwCa4wZA.jpg', '2021-06-04 14:41:39', 'tre-em-quan-lung-dry-ex');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_user`
--

CREATE TABLE `tbl_user` (
  `user_id` bigint(20) NOT NULL,
  `user_url_address` varchar(100) NOT NULL,
  `user_full_name` varchar(100) CHARACTER SET utf8 NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `user_password` varchar(100) NOT NULL,
  `user_rank` varchar(20) CHARACTER SET utf8 NOT NULL,
  `user_date_join` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `tbl_user`
--

INSERT INTO `tbl_user` (`user_id`, `user_url_address`, `user_full_name`, `user_email`, `user_password`, `user_rank`, `user_date_join`) VALUES
(1, 'svDMFE9wkM1ft5ylkL8lA2IGd0yP0oGWaCH1DeVCuKpqbfN1zq', 'nguyễn mạnh tâm', 'tamnm1999@gmail.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 'Admin', '2021-03-16 08:24:54'),
(2, 's5kCwVYWl6UpYoJ3ZM9IX25Rk1QSmTZUf5sDRcDpht9M8tx2RgpMrxduR', 'Nghiêm Thị Hương Ly', 'huonglynghiemthi@gmail.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 'Khách Hàng', '2021-03-16 09:22:06'),
(3, 'f8DizkEUBJmMx', 'Hoàng Đăng Khôi', 'khoihd@gmail.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 'Khách Hàng', '2021-06-04 14:16:36'),
(4, 'ux5sx889EgaoN53feD8mYFgQVnMr3yeDFkQ1QKTKLPRXT25jQvqYUaD', 'Nguyễn Minh Tuệ', 'tuenm@gmail.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 'Khách Hàng', '2021-06-04 14:17:04'),
(5, 'Oxzc', 'Nguyễn Thế Điềm', 'diemnt@gmail.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 'Khách Hàng', '2021-06-04 14:17:31');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `tbl_categories`
--
ALTER TABLE `tbl_categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_name` (`category_name`),
  ADD KEY `parent` (`parent`),
  ADD KEY `disabled` (`disabled`);

--
-- Chỉ mục cho bảng `tbl_cities`
--
ALTER TABLE `tbl_cities`
  ADD PRIMARY KEY (`id`),
  ADD KEY `disabled` (`disabled`);

--
-- Chỉ mục cho bảng `tbl_districts`
--
ALTER TABLE `tbl_districts`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tbl_orders`
--
ALTER TABLE `tbl_orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_url_address`),
  ADD KEY `date` (`date`),
  ADD KEY `user_url_address` (`user_url_address`),
  ADD KEY `session_id` (`session_id`);

--
-- Chỉ mục cho bảng `tbl_order_details`
--
ALTER TABLE `tbl_order_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `description` (`description`);

--
-- Chỉ mục cho bảng `tbl_products`
--
ALTER TABLE `tbl_products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `slag` (`slug`),
  ADD KEY `date` (`date`),
  ADD KEY `quantity` (`quantity`),
  ADD KEY `price` (`price`),
  ADD KEY `description` (`description`),
  ADD KEY `description_2` (`description`);

--
-- Chỉ mục cho bảng `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `user_url_address` (`user_url_address`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `user_email` (`user_email`),
  ADD KEY `user_rank` (`user_rank`),
  ADD KEY `user_date_join` (`user_date_join`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `tbl_categories`
--
ALTER TABLE `tbl_categories`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT cho bảng `tbl_cities`
--
ALTER TABLE `tbl_cities`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `tbl_districts`
--
ALTER TABLE `tbl_districts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `tbl_orders`
--
ALTER TABLE `tbl_orders`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `tbl_order_details`
--
ALTER TABLE `tbl_order_details`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `tbl_products`
--
ALTER TABLE `tbl_products`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `user_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
