-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 25, 2024 at 10:15 PM
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
-- Database: `mishrajii_gym`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_users`
--

CREATE TABLE `admin_users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `dob` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_users`
--

INSERT INTO `admin_users` (`id`, `name`, `email`, `username`, `password`, `gender`, `dob`) VALUES
(1, 'Amit Mishra', 'akmmishra1510@gmail.com', 'akm', '$2y$10$iPYTtrDFNTSSujrl4JdZ2.K6b8ZhG5Gfp3xRmPQtJRqM6SOTwid2G', 'Male', '2024-08-28');

-- --------------------------------------------------------

--
-- Table structure for table `blogs`
--

CREATE TABLE `blogs` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `meta` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `card_text` text NOT NULL,
  `blog_content` text NOT NULL,
  `author_image` varchar(255) NOT NULL,
  `author_info` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `blogs`
--

INSERT INTO `blogs` (`id`, `title`, `meta`, `image`, `card_text`, `blog_content`, `author_image`, `author_info`) VALUES
(2, 'Going to the gym', '7 July 2023', 'logo-gym-removebg-preview.png', 'Praesent id ipsum pellentesque lectus dapibus condimentum curabitur eget risus quam. In hac', 'Praesent id ipsum pellentesque lectus dapibus condimentum curabitur eget risus quam. In hacPraesent id ipsum pellentesque lectus dapibus condimentum curabitur eget risus quam. In hacPraesent id ipsum pellentesque lectus dapibus condimentum curabitur eget risus quam. In hac', 'logo-gym.png', 'Jane Doe is a certified personal trainer and health enthusiast. She enjoys writing about fitness and helping others achieve their health goals'),
(3, 'Going to the gym', '7 July 2023', 'blog-1.jpg', 'Praesent id ipsum pellentesque lectus dapibus condimentum curabitur eget risus quam. In hac', 'Praesent id ipsum pellentesque lectus dapibus condimentum curabitur eget risus quam. In hacPraesent id ipsum pellentesque lectus dapibus condimentum curabitur eget risus quam. In hacPraesent id ipsum pellentesque lectus dapibus condimentum curabitur eget risus quam. In hac', 'blog-1.jpg', 'Jane Doe is a certified personal trainer and health enthusiast. She enjoys writing about fitness and helping others achieve their health goals'),
(4, 'Going to the gym', '7 July 2023', 'blog-2.jpg', 'Praesent id ipsum pellentesque lectus dapibus condimentum curabitur eget risus quam. In hac', 'Praesent id ipsum pellentesque lectus dapibus condimentum curabitur eget risus quam. In hacPraesent id ipsum pellentesque lectus dapibus condimentum curabitur eget risus quam. In hacPraesent id ipsum pellentesque lectus dapibus condimentum curabitur eget risus quam. In hac', 'blog-2.jpg', 'Jane Doe is a certified personal trainer and health enthusiast. She enjoys writing about fitness and helping others achieve their health goals'),
(5, 'Going to the gym', '7 July 2023', 'blog-3.jpg', 'Praesent id ipsum pellentesque lectus dapibus condimentum curabitur eget risus quam. In hac', 'Praesent id ipsum pellentesque lectus dapibus condimentum curabitur eget risus quam. In hacPraesent id ipsum pellentesque lectus dapibus condimentum curabitur eget risus quam. In hacPraesent id ipsum pellentesque lectus dapibus condimentum curabitur eget risus quam. In hac', 'blog-3.jpg', 'Jane Doe is a certified personal trainer and health enthusiast. She enjoys writing about fitness and helping others achieve their health goals');

-- --------------------------------------------------------

--
-- Table structure for table `gym_basic_plan`
--

CREATE TABLE `gym_basic_plan` (
  `id` int(100) NOT NULL,
  `price` varchar(100) NOT NULL,
  `months` varchar(100) NOT NULL,
  `selectservices` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `gym_basic_plan`
--

INSERT INTO `gym_basic_plan` (`id`, `price`, `months`, `selectservices`) VALUES
(1, '5003', '4 Months', 'Cardio + Power Lifting');

-- --------------------------------------------------------

--
-- Table structure for table `gym_premium_plan`
--

CREATE TABLE `gym_premium_plan` (
  `id` int(100) NOT NULL,
  `price` varchar(100) NOT NULL,
  `months` varchar(100) NOT NULL,
  `selectservices` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `gym_premium_plan`
--

INSERT INTO `gym_premium_plan` (`id`, `price`, `months`, `selectservices`) VALUES
(1, '12000', '4 Months', 'Cardio + Power Lifting + Crossfit');

-- --------------------------------------------------------

--
-- Table structure for table `gym_ultimate_plan`
--

CREATE TABLE `gym_ultimate_plan` (
  `id` int(100) NOT NULL,
  `price` varchar(100) NOT NULL,
  `months` varchar(100) NOT NULL,
  `selectservices` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `gym_ultimate_plan`
--

INSERT INTO `gym_ultimate_plan` (`id`, `price`, `months`, `selectservices`) VALUES
(1, '2000', '3 months', 'ALL Basic things');

-- --------------------------------------------------------

--
-- Table structure for table `membership_applications`
--

CREATE TABLE `membership_applications` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `membership_plan` enum('Basic','Ultimate','Professional') NOT NULL,
  `workout_time` enum('Morning','Afternoon','Evening') NOT NULL,
  `emergency_contact_phone` varchar(15) NOT NULL,
  `status` enum('Pending','Approved','Rejected') DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `membership_applications`
--

INSERT INTO `membership_applications` (`id`, `user_id`, `membership_plan`, `workout_time`, `emergency_contact_phone`, `status`) VALUES
(31, 13, 'Basic', 'Morning', '8765432989', 'Approved'),
(32, 15, 'Basic', 'Morning', '8765432989', 'Approved'),
(33, 17, 'Basic', 'Morning', '987654', 'Approved');

-- --------------------------------------------------------

--
-- Table structure for table `trainers`
--

CREATE TABLE `trainers` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `role` varchar(100) NOT NULL,
  `image` varchar(255) NOT NULL,
  `twitter_link` varchar(255) DEFAULT NULL,
  `facebook_link` varchar(255) DEFAULT NULL,
  `linkedin_link` varchar(255) DEFAULT NULL,
  `instagram_link` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `trainers`
--

INSERT INTO `trainers` (`id`, `name`, `role`, `image`, `twitter_link`, `facebook_link`, `linkedin_link`, `instagram_link`) VALUES
(3, 'Amit Mishra', 'Leg Breaker', 'uwp4287562.jpeg', 'https://www.google.com', 'https://www.google.com', 'https://www.googe.com', 'https://www.google.com');

-- --------------------------------------------------------

--
-- Table structure for table `userquery`
--

CREATE TABLE `userquery` (
  `id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `subject` varchar(100) NOT NULL,
  `message` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `userquery`
--

INSERT INTO `userquery` (`id`, `name`, `email`, `subject`, `message`) VALUES
(2, 'Adi', 'akmmishra1510@gmail.com', 'Toilet', '.');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `phone_number` varchar(15) DEFAULT NULL,
  `membership_status` varchar(20) DEFAULT 'not_approved'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fullname`, `username`, `email`, `password`, `gender`, `address`, `phone_number`, `membership_status`) VALUES
(13, 'Amit Mishra', 'amit', 'akmmishra1510@gmail.com', '$2y$10$rLTp5XFla6L72nj9aVhKE.9LEH5M0IEKIKYm.NouJK97unrgtWj06', 'Male', 'Vapi', '08733073469', 'approved'),
(15, 'Shubham Chaudhary', 'shub', 'shub1510@gmail.com', '$2y$10$6iRj2qoIjGmWcB19G7/Zq.JpsNkLwp/w/sEum54P2fVPsxxeUTXfC', 'Male', 'Vapi', '7777909218', 'approved'),
(16, 'Saku Jha', 'saku', 'saku@gmail.com', '$2y$10$pkIx58zgXHG5PS5mMzFGzu2ZiboL6MFuvvYpq4LRFqwDdY.UQxH1S', 'male', 'Vapi', '8733073468', 'not_approved'),
(17, 'Amit', 'kalu', 'kalu@gmail.com', '$2y$10$.DvkUW4XZbGxtrZyNItHJODn2UyQOINc7ALqyXGDG0smsAtyT/9mu', 'male', 'Vapi', '8733073468', 'approved');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_users`
--
ALTER TABLE `admin_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gym_basic_plan`
--
ALTER TABLE `gym_basic_plan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gym_premium_plan`
--
ALTER TABLE `gym_premium_plan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gym_ultimate_plan`
--
ALTER TABLE `gym_ultimate_plan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `membership_applications`
--
ALTER TABLE `membership_applications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `trainers`
--
ALTER TABLE `trainers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `userquery`
--
ALTER TABLE `userquery`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_users`
--
ALTER TABLE `admin_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `blogs`
--
ALTER TABLE `blogs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `gym_basic_plan`
--
ALTER TABLE `gym_basic_plan`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `gym_premium_plan`
--
ALTER TABLE `gym_premium_plan`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `gym_ultimate_plan`
--
ALTER TABLE `gym_ultimate_plan`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `membership_applications`
--
ALTER TABLE `membership_applications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `trainers`
--
ALTER TABLE `trainers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `userquery`
--
ALTER TABLE `userquery`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `membership_applications`
--
ALTER TABLE `membership_applications`
  ADD CONSTRAINT `membership_applications_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
