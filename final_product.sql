-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- ホスト: 127.0.0.1
-- 生成日時: 2021-04-28 17:58:09
-- サーバのバージョン： 10.4.17-MariaDB
-- PHP のバージョン: 8.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- データベース: `final_product`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `memo_table`
--

CREATE TABLE `memo_table` (
  `id` int(12) NOT NULL,
  `user_id` int(12) NOT NULL,
  `customer_name` varchar(128) NOT NULL,
  `interest` varchar(200) NOT NULL,
  `Dr` varchar(128) NOT NULL,
  `DH` varchar(128) NOT NULL,
  `other` varchar(300) NOT NULL,
  `maker` varchar(128) NOT NULL,
  `how_long` varchar(128) NOT NULL,
  `problem` varchar(200) NOT NULL,
  `point` varchar(200) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `is_deleted` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- テーブルのデータのダンプ `memo_table`
--

INSERT INTO `memo_table` (`id`, `user_id`, `customer_name`, `interest`, `Dr`, `DH`, `other`, `maker`, `how_long`, `problem`, `point`, `created_at`, `updated_at`, `is_deleted`) VALUES
(5, 3, 'ｙｙｙｙｙ', 'ｈｈｈｈ', '1人', '３人', '受付１人', 'どっかの', '５年', '', '', '2021-04-24 17:31:43', '2021-04-24 18:17:48', '0000-00-00 00:00:00'),
(6, 3, 'もりた歯科医院', '残業多いのどうにかしたい', '1人', '３人', '受付１人', 'どっかの', '５年', 'wwwwwwwww', '受付の業務改善', '2021-04-24 17:48:59', '2021-04-24 17:48:59', '0000-00-00 00:00:00'),
(7, 3, 'もりた歯科医院', '残業多いのどうにかしたい', '1人', '３人', '受付１人', 'どっかの', '５年', 'wwwwwwwwwwwwww', '受付の業務改善', '2021-04-24 17:49:30', '2021-04-24 17:49:30', '0000-00-00 00:00:00'),
(8, 3, 'もりた歯科医院', '残業多いのどうにかしたい', '1人', '３人', '受付１人', 'どっかの', '５年', 'khhhihuiuhi', '受付の業務改善', '2021-04-24 17:50:04', '2021-04-24 17:50:04', '0000-00-00 00:00:00'),
(9, 3, 'もりた歯科医院', '残業多いのどうにかしたい', '1人', '３人', '受付１人', 'どっかの', '５年', '残業どうにかならないか', '受付の業務改善', '2021-04-24 17:51:20', '2021-04-24 17:51:20', '0000-00-00 00:00:00'),
(10, 3, 'もりた歯科医院', '残業多いのどうにかしたい', '1人', '３人', '受付１人', 'どっかの', '５年', '残業どうにかならないか', '受付の業務改善', '2021-04-24 17:51:31', '2021-04-24 17:51:31', '0000-00-00 00:00:00'),
(11, 1, 'k', 'k', 'k', 'k', 'k', 'k', 'k', 'k', 'k', '2021-04-24 21:44:43', '2021-04-24 21:44:43', '0000-00-00 00:00:00'),
(12, 3, 'A歯科医院', 'ホームページ見て', '２', '３', '２', 'どっかの', '５年', 'あああああああああああああ', 'あああああああああああああ', '2021-04-24 23:22:28', '2021-04-24 23:22:28', '0000-00-00 00:00:00'),
(13, 3, 'もりた歯科医院', '残業多いのどうにかしたい', '1人', '', '', 'aa', 'aaa', 'aaa', 'aaaa', '2021-04-25 12:02:51', '2021-04-25 12:02:51', '0000-00-00 00:00:00'),
(14, 3, 'もりた歯科医院', '残業多いのどうにかしたい', '', '', '', '', '', 'a', 'a', '2021-04-27 22:50:09', '2021-04-27 22:50:09', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- テーブルの構造 `users_table`
--

CREATE TABLE `users_table` (
  `id` int(12) NOT NULL,
  `name` varchar(128) NOT NULL,
  `belongs` varchar(128) NOT NULL,
  `mail` varchar(128) NOT NULL,
  `password` varchar(128) NOT NULL,
  `is_admin` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `is_deleted` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- テーブルのデータのダンプ `users_table`
--

INSERT INTO `users_table` (`id`, `name`, `belongs`, `mail`, `password`, `is_admin`, `created_at`, `updated_at`, `is_deleted`) VALUES
(1, 'a', 'a', 'a', 'a', 0, '2021-04-21 21:22:20', '2021-04-21 21:22:20', 0),
(2, 'b', 'b', 'b', 'b', 0, '2021-04-21 21:22:33', '2021-04-21 21:22:33', 0),
(3, 'もりた', '九州', 'aa', 'aa', 0, '2021-04-21 22:43:00', '2021-04-21 22:43:00', 0),
(4, '管理者', '管理用', 'administrator', 'admin', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0);

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `memo_table`
--
ALTER TABLE `memo_table`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `users_table`
--
ALTER TABLE `users_table`
  ADD PRIMARY KEY (`id`);

--
-- ダンプしたテーブルの AUTO_INCREMENT
--

--
-- テーブルの AUTO_INCREMENT `memo_table`
--
ALTER TABLE `memo_table`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- テーブルの AUTO_INCREMENT `users_table`
--
ALTER TABLE `users_table`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
