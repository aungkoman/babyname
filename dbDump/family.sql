-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 28, 2020 at 09:45 AM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.2.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `family`
--

-- --------------------------------------------------------

--
-- Table structure for table `family`
--

CREATE TABLE `family` (
  `id` int(11) UNSIGNED NOT NULL,
  `dad` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mom` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `baby` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `birthdate` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `family`
--

INSERT INTO `family` (`id`, `dad`, `mom`, `baby`, `gender`, `birthdate`) VALUES
(1, 'shwe man', 'yin yin myint', 'aung ko man', 'male', 'sun'),
(2, 'shwe man', 'yin yin myint', 'hein myat noee', 'female', 'fri'),
(3, 'arkar myo', 'thazin soe hlaing', 'thaw zin myo', 'male', 'fri'),
(4, 'toe aung', 'win win than', 'phyo wai aung', 'male', 'thu'),
(5, 'toe aung', 'win win than', 'thin zu zan', 'female', 'fri'),
(6, 'hla myo', 'khin myint thwin', 'arkar myo', 'male', 'sun'),
(7, 'hla myo', 'khin myint thwin', 'thein than soe', 'male', 'sun'),
(8, 'hla myo', 'khin myint thwin', 'myo min zaw', 'male', 'sun'),
(34, 'ရွှေမန်း', 'ယဉ်ယဉ်မြင့်', 'အောင်ကိုမန်း', 'male', 'sun'),
(35, 'ရွှေမန်း', 'ယဉ်ယဉ်မြင့်', 'ဟိန်းမြတ်နိုး', 'female', 'fri'),
(36, 'လှမျိုး', 'ခင်မြင့်သွင်', 'အာကာမျိုး', 'male', 'sun'),
(37, 'လှမျိုး', 'ခင်မြင့်သွင်', 'သိန်းသန်းစိုး', 'male', 'fri'),
(38, 'လှမျိုး', 'ခင်မြင့်သွင်', 'မျိုးမင်းဇော်', 'male', 'thu'),
(39, 'တိုးအောင်', 'ဝင်းဝင်းသန်း', 'သင်းဇူဇန်', 'female', 'fri'),
(40, 'တိုးအောင်', 'ဝင်းဝင်းသန်း', 'ဖြိုးဝေအောင်', 'male', 'thu'),
(41, 'အာကာမျိုး', 'သဇင်စိုးလှိုင်', 'သော်ဇင်မျိုး', 'male', 'fri'),
(42, 'dad', 'mom', 'baby', 'male', 'sun'),
(43, 'dad', 'mom', 'babaygirl', 'female', 'mon');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `family`
--
ALTER TABLE `family`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `family`
--
ALTER TABLE `family`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
