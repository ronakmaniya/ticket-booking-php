-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 22, 2024 at 06:53 PM
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
-- Database: `ticket_booking`
--

-- --------------------------------------------------------

--
-- Table structure for table `movies`
--

CREATE TABLE `movies` (
  `movie_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `synopsis` text DEFAULT NULL,
  `release_date` date DEFAULT NULL,
  `genre` varchar(100) DEFAULT NULL,
  `duration` int(11) DEFAULT NULL,
  `trailer_url` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `price` int(11) DEFAULT 100
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `movies`
--

INSERT INTO `movies` (`movie_id`, `title`, `synopsis`, `release_date`, `genre`, `duration`, `trailer_url`, `created_at`, `updated_at`, `price`) VALUES
(9, 'Yodha', NULL, '2024-03-15', 'Action,Thriller', 132, 'https://youtu.be/3AuB8RTfBJc?si=I9oyIBkXF9mhuHzl', '2024-04-27 09:42:28', '2024-04-27 09:42:28', 230),
(10, 'Godzill x Kong', NULL, '2024-03-29', 'Action,Sci-Fi,Thriller', 112, 'https://youtu.be/qqrpMRDuPfc?si=m9OYCtTDLsph51qw', '2024-04-27 09:45:14', '2024-04-27 09:45:14', 310),
(12, 'Kung Fu Panda 4', NULL, '2024-03-15', 'Action,Adventure,Animation,Comedy', 145, 'https://youtu.be/_inKs4eeHiI?si=FKulVUkLVDJWIg1D', '2024-04-27 09:50:51', '2024-05-09 04:49:10', 150),
(14, 'The Chronicles of Narnia', NULL, '2024-02-23', 'Action,Mystery', 184, 'https://youtu.be/usEkWtuNn-w?si=7TZr6EmVEtkOoNnO', '2024-04-27 09:54:52', '2024-05-09 02:03:05', 220),
(15, 'Deadpool', NULL, '2024-02-16', 'Comedy,Romance', 160, 'https://youtu.be/73_1biulkYk?si=ICNQoaftz_FUIcYw', '2024-04-27 09:58:48', '2024-05-09 01:54:17', 260),
(17, 'Red Notice', NULL, '2024-04-12', 'Action,Comedy', 145, 'https://youtu.be/Pj0wz7zu3Ms?si=ZE2b77hZSEQS2Bir', '2024-04-27 10:11:30', '2024-04-27 10:11:30', 220),
(20, 'Mission Impossible', NULL, '2024-05-15', 'Action,Adventu', 184, 'https://youtu.be/avz06PDqDbM?si=OGzMjiZChIutbxBt', '2024-05-06 06:11:13', '2024-05-06 06:11:13', 250),
(21, 'The Family Star', NULL, '2024-04-23', 'Comedy,Romance,Family', 152, 'https://youtu.be/xB7b3RzicUU?si=MTRI3SSCef9us4pD', '2024-05-09 02:04:55', '2024-05-09 02:04:55', 250),
(22, 'CREW', NULL, '2024-05-15', 'Comedy,Drama', 178, 'https://youtu.be/3uvfq4Cu8R8?si=ZVX8PNp7jGoeS9DU', '2024-05-09 02:14:50', '2024-05-09 02:14:50', 310);

-- --------------------------------------------------------

--
-- Table structure for table `movie_pictures`
--

CREATE TABLE `movie_pictures` (
  `picture_id` int(11) NOT NULL,
  `movie_id` int(11) DEFAULT NULL,
  `picture_url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `movie_pictures`
--

INSERT INTO `movie_pictures` (`picture_id`, `movie_id`, `picture_url`) VALUES
(14, 9, 'https://m.media-amazon.com/images/M/MV5BMmQwYTZmMzAtYjMxOS00ZmI3LTk2MzctODU3OWJjNTQ4MzNmXkEyXkFqcGdeQXVyMTQ3Mzk2MDg4._V1_.jpg'),
(15, 10, 'https://preview.redd.it/ya6zbdrdqkic1.jpeg?width=640&crop=smart&auto=webp&s=23d3ab0de9157b9e111260260a26c2ab7b0a4a5d'),
(17, 12, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSDUv_s4gyLrcX5ypC16VilHuFiI7r60IqeC0w64laLng&s'),
(19, 14, 'https://m.media-amazon.com/images/M/MV5BMTc0NTUwMTU5OV5BMl5BanBnXkFtZTcwNjAwNzQzMw@@._V1_.jpg'),
(20, 15, 'https://rukminim2.flixcart.com/image/850/1000/jqzitu80/poster/5/u/u/medium-deadpool-poster-for-room-office-300gsm-matte-paper-13-original-imafcvwau5fgtx7v.jpeg?q=20&crop=false'),
(22, 17, 'https://m.media-amazon.com/images/M/MV5BZmRjODgyMzEtMzIxYS00OWY2LTk4YjUtMGMzZjMzMTZiN2Q0XkEyXkFqcGdeQXVyMTkxNjUyNQ@@._V1_.jpg'),
(24, 20, 'https://pbs.twimg.com/media/FwVJKEuaIAADl_z.jpg:large'),
(25, 21, 'https://cdn.123telugu.com/content/wp-content/uploads/2023/11/family-star.jpg'),
(26, 22, 'https://m.media-amazon.com/images/M/MV5BZDY5NWFjOTctNTQ0ZC00OGM5LWJkMmItN2RjNGZhMmEwMGMyXkEyXkFqcGdeQXVyMTUzNTgzNzM0._V1_.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `ticket_booking`
--

CREATE TABLE `ticket_booking` (
  `id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `booking_date` date NOT NULL,
  `user_id` int(11) NOT NULL,
  `movie_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ticket_booking`
--

INSERT INTO `ticket_booking` (`id`, `qty`, `booking_date`, `user_id`, `movie_id`) VALUES
(1, 1, '2024-12-12', 3, 8),
(2, 4, '2024-06-06', 4, 12),
(3, 2, '2024-05-22', 4, 17),
(4, 2, '2024-06-03', 4, 15),
(6, 2, '2024-06-05', 4, 10),
(8, 5, '2024-06-23', 5, 12);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `Id` int(11) NOT NULL,
  `Name` varchar(255) DEFAULT NULL,
  `Email` varchar(255) DEFAULT NULL,
  `Password` varchar(255) DEFAULT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`Id`, `Name`, `Email`, `Password`, `is_admin`) VALUES
(1, 'admin', 'admin@gmail.com', 'admin', 1),
(2, 'user', 'user@gmail.com', 'user', 0),
(3, 'ronak', 'ronak@gmail.com', 'maniya@123', 0),
(4, 'shubham', 'shubham@gmail.com', 'vaghani@123', 0),
(5, 'mann', 'mann@gmail.com', 'patel@123', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `movies`
--
ALTER TABLE `movies`
  ADD PRIMARY KEY (`movie_id`);

--
-- Indexes for table `movie_pictures`
--
ALTER TABLE `movie_pictures`
  ADD PRIMARY KEY (`picture_id`),
  ADD KEY `movie_id` (`movie_id`);

--
-- Indexes for table `ticket_booking`
--
ALTER TABLE `ticket_booking`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_booking` (`user_id`,`booking_date`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `movies`
--
ALTER TABLE `movies`
  MODIFY `movie_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `movie_pictures`
--
ALTER TABLE `movie_pictures`
  MODIFY `picture_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `ticket_booking`
--
ALTER TABLE `ticket_booking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `movie_pictures`
--
ALTER TABLE `movie_pictures`
  ADD CONSTRAINT `movie_pictures_ibfk_1` FOREIGN KEY (`movie_id`) REFERENCES `movies` (`movie_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
