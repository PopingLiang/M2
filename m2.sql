-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- 主機： localhost
-- 產生時間： 
-- 伺服器版本： 8.0.17
-- PHP 版本： 7.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `m2`
--

-- --------------------------------------------------------

--
-- 資料表結構 `account_info`
--

CREATE TABLE `account_info` (
  `id` int(11) NOT NULL,
  `account` varchar(100) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `gender` varchar(1) NOT NULL,
  `birth` date NOT NULL,
  `email` varchar(100) NOT NULL,
  `remark` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- 傾印資料表的資料 `account_info`
--

INSERT INTO `account_info` (`id`, `account`, `user_name`, `gender`, `birth`, `email`, `remark`) VALUES
(5, '111', '132', '0', '2023-03-02', '111@111111', '1111'),
(6, '222', '222', '1', '2023-03-10', '222@22222', '2222'),
(7, '111', '132', '0', '2023-03-02', '111@111111', '1111'),
(8, '222', '222', '1', '2023-03-10', '222@22222', '2222'),
(9, '111', '132', '0', '2023-03-02', '111@111111', '1111'),
(10, '222', '222', '1', '2023-03-10', '222@22222', '2222'),
(11, '111', '132', '0', '2023-03-02', '111@111111', '1111'),
(12, '222', '222', '1', '2023-03-10', '222@22222', '2222'),
(13, '111', '132', '0', '2023-03-02', '111@111111', '1111'),
(14, '222', '222', '1', '2023-03-10', '222@22222', '2222'),
(15, '111', '132', '0', '2023-03-02', '111@111111', '1111'),
(16, '222', '222', '1', '2023-03-10', '222@22222', '2222'),
(17, '111', '132', '0', '2023-03-02', '111@111111', '1111'),
(18, '222', '222', '1', '2023-03-10', '222@22222', '2222'),
(19, '111', '132', '0', '2023-03-02', '111@111111', '1111'),
(20, '222', '222', '1', '2023-03-10', '222@22222', '2222'),
(21, '561', 'ssss', '1', '2023-03-02', '123@3211234567', 'ttttt');

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `account_info`
--
ALTER TABLE `account_info`
  ADD PRIMARY KEY (`id`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `account_info`
--
ALTER TABLE `account_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
