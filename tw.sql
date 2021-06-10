-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 10, 2021 at 10:05 AM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tw`
--

-- --------------------------------------------------------

--
-- Table structure for table `matches`
--

CREATE TABLE `matches` (
  `id` int(255) NOT NULL,
  `first_rat` varchar(255) NOT NULL,
  `second_rat` varchar(255) NOT NULL,
  `first_odds` float NOT NULL,
  `second_odds` float NOT NULL,
  `flag` int(2) NOT NULL,
  `date` date DEFAULT NULL,
  `time` time DEFAULT NULL,
  `rat_winner` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `matches`
--

INSERT INTO `matches` (`id`, `first_rat`, `second_rat`, `first_odds`, `second_odds`, `flag`, `date`, `time`, `rat_winner`) VALUES
(20, 'Zabini', 'Bolo', 1.4, 2.2, 1, '2021-06-10', '09:40:01', 'Bolo'),
(21, 'Medusa', 'Azela', 1.13, 3.25, 1, '2021-06-08', '11:29:00', 'Medusa'),
(22, 'Sandoval', 'Azela', 1.88, 2.34, 1, '2021-06-10', '09:30:00', 'Sandoval'),
(23, 'Yokohama', 'Sandoval', 2.08, 2.03, 0, '2021-06-14', '06:31:00', ''),
(24, 'Azela', 'Zabini', 2.03, 2.77, 1, '2021-06-08', '03:32:00', 'Zabini'),
(25, 'Medusa', 'Bolo', 1.32, 1.9, 1, '2021-06-07', '19:33:00', 'Bolo'),
(26, 'Medusa', 'Yokohama', 2.1, 1.4, 0, '2021-06-11', '03:48:00', ''),
(27, 'Bolo', 'Azela', 1.5, 1.8, 0, '2021-06-12', '19:48:00', '');

-- --------------------------------------------------------

--
-- Table structure for table `matches_tickets`
--

CREATE TABLE `matches_tickets` (
  `ticket_id` int(100) NOT NULL,
  `match_id` int(100) NOT NULL,
  `name_rat_winner` varchar(255) NOT NULL,
  `name_rat_betted` varchar(255) NOT NULL,
  `ended` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `matches_tickets`
--

INSERT INTO `matches_tickets` (`ticket_id`, `match_id`, `name_rat_winner`, `name_rat_betted`, `ended`) VALUES
(27, 22, 'Sandoval', 'Sandoval', 1);

-- --------------------------------------------------------

--
-- Table structure for table `rat`
--

CREATE TABLE `rat` (
  `id` int(10) NOT NULL,
  `rat_name` varchar(255) NOT NULL,
  `birthday` date NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `last_five_matches` varchar(6) DEFAULT NULL,
  `birth_place` varchar(255) NOT NULL,
  `gender` varchar(2) NOT NULL,
  `club` varchar(255) NOT NULL,
  `photo_link` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rat`
--

INSERT INTO `rat` (`id`, `rat_name`, `birthday`, `description`, `last_five_matches`, `birth_place`, `gender`, `club`, `photo_link`) VALUES
(11, 'Zabini', '2019-02-10', 'She\'s bright. She\'s is playful and can entertain herself for hours on end with random objects. She likes to talk at her toys.  Her favourite food is coriander and as a special treat, she likes to eat carrot as well.', 'WLL', 'Vienna', 'F', 'Barcelona', 'https://woodgreen.org.uk/image/image/image/V8Iw3SL87ubcIekoP1DmmhekPFXPNbBL5yB4JpVR.jpeg?w=800&h=422&fit=crop-center'),
(12, 'Yokohama', '2020-10-01', 'He\'s intelligent and is good at problem solving. He\'s barely ever plays.  His favourite food is broccoli.', NULL, 'Bangkok', 'M', 'Chilly Peppers', 'https://cdn.britannica.com/s:690x388,c:crop/57/192357-050-62E912BD/hamster-Syria-households-pet.jpg'),
(13, 'Azela', '2021-04-07', 'This aggressive gerbil is friendly toward her owner and will bite any stranger that comes near.  She\'s smart and very crafty. She\'s is extremely playful and can entertain herself for hours on end with a ball of paper.  Her favourite food is bok choy.', 'LWL', 'San Francisco', 'F', 'Brigade', 'https://www.saga.co.uk/contentlibrary/saga/publishing/verticals/home-and-garden/pets/facts_about_rats_238780573_768.jpg'),
(14, 'Sandoval', '2021-02-03', 'This docile gerbil is friendly toward his owner and is generally friendly towards other people but may bite without warning.  He\'s moderately smart and can be taught with some patience. He\'s isn\'t very playful. He\'s usually silent except when he needs som', 'LW', 'Baku', 'M', 'Foresta', 'https://media.timeout.com/images/105649078/750/422/image.jpg'),
(15, 'Medusa', '2019-12-30', 'This hostile hamster is friendly toward her owner and will bite any stranger that comes near.  She\'s aware and can be taught with some patience. She\'s is not very playful.  Her favourite food is romaine lettuce and as a special treat, she likes to eat pap', 'L', 'Beijing', 'F', 'Beijing Guoang', 'https://www.thesprucepets.com/thmb/y7EDeoYQKdWZUAK39SFD8Wvh_wA=/960x0/filters:no_upscale():max_bytes(150000):strip_icc():format(webp)/cute-white-rat-120691475-58a5f3ea5f9b58a3c9067915.jpg'),
(16, 'Bolo', '2019-01-10', 'This super-friendly hamster is loving towards his owner and loves to meet new people.  He\'s dopey and does not know any basic commands. He\'s loves to play and can entertain himself for hours on end with his food.  His favourite food is cucumber leaves and', 'WWW', 'Buenos Aires', 'M', 'Messi RC', 'https://images.pexels.com/photos/1010267/pexels-photo-1010267.jpeg?auto=compress&cs=tinysrgb&dpr=3&h=750&w=1260');

-- --------------------------------------------------------

--
-- Table structure for table `tickets`
--

CREATE TABLE `tickets` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `ref` int(100) NOT NULL,
  `money_betted` double NOT NULL,
  `total_money` int(255) NOT NULL,
  `total_elevation` int(255) NOT NULL,
  `total_matches` int(255) NOT NULL,
  `withdrawed` int(2) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tickets`
--

INSERT INTO `tickets` (`id`, `user_id`, `ref`, `money_betted`, `total_money`, `total_elevation`, `total_matches`, `withdrawed`) VALUES
(27, 11, 0, 24, 45, 2, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(255) UNSIGNED NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `second_name` varchar(255) NOT NULL,
  `country` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `age` int(2) NOT NULL,
  `nickname` varchar(255) NOT NULL,
  `role` varchar(10) NOT NULL,
  `money` double DEFAULT 0,
  `avatar_link` varchar(255) NOT NULL DEFAULT 'https://cdn3.vectorstock.com/i/thumb-large/50/42/funny-white-rat-with-a-hat-vector-29235042.jpg'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `second_name`, `country`, `email`, `password`, `age`, `nickname`, `role`, `money`, `avatar_link`) VALUES
(11, 'Logofatu', 'Ionut', 'Romania', 'asf@fs.com', '$2y$12$/Xu7MlreDJGSt8x1COHvi.PTKwYP/a3vRPxGasZav7ZzkGZLHdZX6', 32, 'logofatu', 'admin', 715, 'https://cdn3.vectorstock.com/i/thumb-large/50/42/funny-white-rat-with-a-hat-vector-29235042.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `matches`
--
ALTER TABLE `matches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rat`
--
ALTER TABLE `rat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `matches`
--
ALTER TABLE `matches`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `rat`
--
ALTER TABLE `rat`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `tickets`
--
ALTER TABLE `tickets`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(255) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
