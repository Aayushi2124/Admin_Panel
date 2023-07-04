-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 04, 2023 at 08:56 PM
-- Server version: 8.0.33
-- PHP Version: 8.1.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `task2`
--

-- --------------------------------------------------------

--
-- Table structure for table `accesstype`
--

CREATE TABLE `accesstype` (
  `id` int NOT NULL,
  `access_type` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `accesstype`
--

INSERT INTO `accesstype` (`id`, `access_type`) VALUES
(1, 'Admin'),
(2, 'Teacher'),
(3, 'Student'),
(4, 'Librarian');

-- --------------------------------------------------------

--
-- Table structure for table `chapters`
--

CREATE TABLE `chapters` (
  `id` int NOT NULL,
  `chapter` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `chapters`
--

INSERT INTO `chapters` (`id`, `chapter`) VALUES
(1, 'Substractionm'),
(3, 'Addition'),
(4, 'Polymorphism');

-- --------------------------------------------------------

--
-- Table structure for table `chapter_subject`
--

CREATE TABLE `chapter_subject` (
  `id` int NOT NULL,
  `chapt_id` int NOT NULL,
  `sub_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `chapter_subject`
--

INSERT INTO `chapter_subject` (`id`, `chapt_id`, `sub_id`) VALUES
(1, 1, 2),
(2, 4, 2),
(3, 3, 1),
(4, 3, 2);

-- --------------------------------------------------------

--
-- Table structure for table `standards`
--

CREATE TABLE `standards` (
  `id` int NOT NULL,
  `std_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `standards`
--

INSERT INTO `standards` (`id`, `std_name`) VALUES
(1, '10'),
(2, '11'),
(3, '12'),
(4, '9');

-- --------------------------------------------------------

--
-- Table structure for table `student_std`
--

CREATE TABLE `student_std` (
  `id` int NOT NULL,
  `student_id` int NOT NULL,
  `std_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `student_std`
--

INSERT INTO `student_std` (`id`, `student_id`, `std_id`) VALUES
(1, 3, 1),
(2, 3, 3),
(3, 7, 4);

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `id` int NOT NULL,
  `subjects` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`id`, `subjects`) VALUES
(1, 'zcvb'),
(2, 'qwerty');

-- --------------------------------------------------------

--
-- Table structure for table `subject_std`
--

CREATE TABLE `subject_std` (
  `id` int NOT NULL,
  `sub_id` int NOT NULL,
  `std_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `subject_std`
--

INSERT INTO `subject_std` (`id`, `sub_id`, `std_id`) VALUES
(1, 1, 1),
(2, 2, 3),
(3, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `Id` int NOT NULL,
  `Full_Name` varchar(255) NOT NULL,
  `Email_ID` varchar(255) NOT NULL,
  `Contact_No` bigint NOT NULL,
  `Dob` date NOT NULL,
  `Password` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`Id`, `Full_Name`, `Email_ID`, `Contact_No`, `Dob`, `Password`, `image`) VALUES
(2, 'Aayushi', 'Aayushi@gmail.com', 8200103425, '2023-06-13', 'c20ad4d76fe97759aa27a0c99bff6710', '2_Aayushi.png'),
(3, 'Mann12', 'Mann@gmail.com', 1234567890, '2023-06-20', 'c20ad4d76fe97759aa27a0c99bff6710', '3_Mann12.png'),
(4, 'Vrunda', 'Vrunda@gmail.com', 3456789012, '2023-06-15', 'c20ad4d76fe97759aa27a0c99bff6710', ''),
(5, 'abc', 'abc@gmail.com', 3456789012, '2023-06-15', 'c20ad4d76fe97759aa27a0c99bff6710', ''),
(7, 'xyz', 'xyz@xyz.com', 8200103425, '2023-07-11', 'c20ad4d76fe97759aa27a0c99bff6710', '');

-- --------------------------------------------------------

--
-- Table structure for table `user_type`
--

CREATE TABLE `user_type` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `access_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user_type`
--

INSERT INTO `user_type` (`id`, `user_id`, `access_id`) VALUES
(1, 2, 2),
(3, 3, 3),
(4, 4, 1),
(5, 5, 4),
(7, 7, 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accesstype`
--
ALTER TABLE `accesstype`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chapters`
--
ALTER TABLE `chapters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chapter_subject`
--
ALTER TABLE `chapter_subject`
  ADD PRIMARY KEY (`id`),
  ADD KEY `chptsub_chptr_id` (`chapt_id`),
  ADD KEY `chptsub_sub_id` (`sub_id`);

--
-- Indexes for table `standards`
--
ALTER TABLE `standards`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student_std`
--
ALTER TABLE `student_std`
  ADD PRIMARY KEY (`id`),
  ADD KEY `studstd_stud_id` (`student_id`),
  ADD KEY `studstd_std_id` (`std_id`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subject_std`
--
ALTER TABLE `subject_std`
  ADD PRIMARY KEY (`id`),
  ADD KEY `substd_std_id` (`std_id`),
  ADD KEY `substd_sub_id` (`sub_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `user_type`
--
ALTER TABLE `user_type`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_type_ibfk_1` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accesstype`
--
ALTER TABLE `accesstype`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `chapters`
--
ALTER TABLE `chapters`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `chapter_subject`
--
ALTER TABLE `chapter_subject`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `standards`
--
ALTER TABLE `standards`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `student_std`
--
ALTER TABLE `student_std`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `subject_std`
--
ALTER TABLE `subject_std`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `Id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `user_type`
--
ALTER TABLE `user_type`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `chapter_subject`
--
ALTER TABLE `chapter_subject`
  ADD CONSTRAINT `chptsub_chptr_id` FOREIGN KEY (`chapt_id`) REFERENCES `chapters` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `chptsub_sub_id` FOREIGN KEY (`sub_id`) REFERENCES `subjects` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `student_std`
--
ALTER TABLE `student_std`
  ADD CONSTRAINT `studstd_std_id` FOREIGN KEY (`std_id`) REFERENCES `standards` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `studstd_stud_id` FOREIGN KEY (`student_id`) REFERENCES `user` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `subject_std`
--
ALTER TABLE `subject_std`
  ADD CONSTRAINT `substd_std_id` FOREIGN KEY (`std_id`) REFERENCES `standards` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `substd_sub_id` FOREIGN KEY (`sub_id`) REFERENCES `subjects` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_type`
--
ALTER TABLE `user_type`
  ADD CONSTRAINT `user_type_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
