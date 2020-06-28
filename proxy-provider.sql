-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 10, 2020 at 12:36 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Database: `db_proxyproviders`
--

-- --------------------------------------------------------

--
-- Table structure for table `providers`
--

CREATE TABLE `providers` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `url` text DEFAULT NULL,
  `status` enum('1','0','','') DEFAULT '1',
  `last_update_date` timestamp NULL DEFAULT NULL,
  `last_attempt_date` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `providers`
--
ALTER TABLE `providers`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `providers`
--
ALTER TABLE `providers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;



-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 10, 2020 at 12:38 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Database: `db_proxyproviders`
--

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `provider_id` int(11) DEFAULT NULL,
  `request_time` timestamp NULL DEFAULT current_timestamp(),
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

INSERT INTO `providers` (`id`, `title`, `url`, `status`, `last_update_date`, `last_attempt_date`, `created_at`, `updated_at`) VALUES (NULL, 'XROXY Proxy Lists', 'http://www.xroxy.com', '1', NULL, NULL, current_timestamp(), NULL);


-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 19, 2020 at 02:42 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Database: `db_proxyproviders`
--

-- --------------------------------------------------------

--
-- Table structure for table `proxies`
--

CREATE TABLE `proxies` (
  `id` int(11) NOT NULL,
  `provider_id` int(11) NOT NULL,
  `ip` varchar(256) DEFAULT NULL,
  `port` int(11) DEFAULT NULL,
  `date_last_pub` timestamp NULL DEFAULT NULL,
  `last_found_date` timestamp NULL DEFAULT NULL,
  `first_found_date` timestamp NULL DEFAULT NULL,
  `last_fun_date` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `proxies`
--
ALTER TABLE `proxies`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `proxies`
--
ALTER TABLE `proxies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

ALTER TABLE `proxies` ADD `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP AFTER `last_fun_date`, ADD `updated_at` TIMESTAMP NULL DEFAULT NULL AFTER `created_at`;


ALTER TABLE `proxies` ADD `type` VARCHAR(256) NULL AFTER `port`;


ALTER TABLE `proxies` CHANGE `date_last_pub` `check_timestamp` TIMESTAMP NULL DEFAULT NULL;

INSERT INTO `providers` (`id`, `title`, `url`, `status`, `last_update_date`, `last_attempt_date`, `created_at`, `updated_at`) VALUES (NULL, 'Byteproxies List', 'https://byteproxies.com', '1', NULL, NULL, current_timestamp(), NULL);

INSERT INTO `providers` (`id`, `title`, `url`, `status`, `last_update_date`, `last_attempt_date`, `created_at`, `updated_at`) VALUES (NULL, 'Proxy11 List', 'https://proxy11.com', '1', NULL, NULL, current_timestamp(), NULL);

INSERT INTO `providers` (`id`, `title`, `url`, `status`, `last_update_date`, `last_attempt_date`, `created_at`, `updated_at`) VALUES (NULL, 'Pubproxies List', 'http://pubproxy.com/', '1', NULL, NULL, current_timestamp(), NULL);

-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 27, 2020 at 07:47 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Database: `db_proxyproviders`
--

-- --------------------------------------------------------

--
-- Table structure for table `testurls`
--

CREATE TABLE `testurls` (
  `id` int(11) NOT NULL,
  `testurl` text DEFAULT NULL,
  `ip` varchar(256) DEFAULT NULL,
  `port` varchar(256) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `success_time` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `testurls`
--
ALTER TABLE `testurls`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `testurls`
--
ALTER TABLE `testurls`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;


INSERT INTO `testurls` (`id`, `testurl`, `ip`, `port`, `status`, `success_time`, `created_at`, `updated_at`) VALUES (NULL, 'https://www.google.com/', NULL, NULL, NULL, NULL, current_timestamp(), NULL);
INSERT INTO `testurls` (`id`, `testurl`, `ip`, `port`, `status`, `success_time`, `created_at`, `updated_at`) VALUES (NULL, 'http://plasmadonor.net/', NULL, NULL, NULL, NULL, current_timestamp(), NULL), (NULL, 'https://www.w3schools.com/', NULL, NULL, NULL, NULL, current_timestamp(), NULL);
INSERT INTO `testurls` (`id`, `testurl`, `ip`, `port`, `status`, `success_time`, `created_at`, `updated_at`) VALUES (NULL, 'http://whatismyipaddress.com/', NULL, NULL, NULL, NULL, current_timestamp(), NULL);
UPDATE `testurls` SET `testurl` = 'http://www.google.com/' WHERE `testurls`.`id` = 1;

INSERT INTO `providers` (`id`, `title`, `url`, `status`, `last_update_date`, `last_attempt_date`, `created_at`, `updated_at`) VALUES (NULL, 'ROTATING PROXY', 'https://getproxylist.com/', '1', NULL, NULL, current_timestamp(), NULL);