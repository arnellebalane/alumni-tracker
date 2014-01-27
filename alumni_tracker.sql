-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 27, 2014 at 06:06 AM
-- Server version: 5.5.8
-- PHP Version: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `alumni_tracker`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `user_id` int(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `user_id`) VALUES
(2, 47),
(3, 65);

-- --------------------------------------------------------

--
-- Table structure for table `comment_ge_courses`
--

CREATE TABLE IF NOT EXISTS `comment_ge_courses` (
  `comment_id` int(255) NOT NULL,
  `GE_course_id` int(255) NOT NULL,
  PRIMARY KEY (`comment_id`,`GE_course_id`),
  KEY `GE_course_id` (`GE_course_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comment_ge_courses`
--

INSERT INTO `comment_ge_courses` (`comment_id`, `GE_course_id`) VALUES
(3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `comment_majors`
--

CREATE TABLE IF NOT EXISTS `comment_majors` (
  `comment_id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`comment_id`,`name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comment_majors`
--

INSERT INTO `comment_majors` (`comment_id`, `name`) VALUES
(2, 'CMSC11'),
(2, 'CMSC123'),
(3, 'Math100'),
(3, 'Math17');

-- --------------------------------------------------------

--
-- Table structure for table `comment_major_courses`
--

CREATE TABLE IF NOT EXISTS `comment_major_courses` (
  `comment_id` int(255) NOT NULL,
  `major_course_id` int(255) NOT NULL,
  PRIMARY KEY (`comment_id`,`major_course_id`),
  KEY `major_course_id` (`major_course_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comment_major_courses`
--


-- --------------------------------------------------------

--
-- Table structure for table `comment_suggested_courses`
--

CREATE TABLE IF NOT EXISTS `comment_suggested_courses` (
  `comment_id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`comment_id`,`name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comment_suggested_courses`
--

INSERT INTO `comment_suggested_courses` (`comment_id`, `name`) VALUES
(2, ''),
(3, 'Math18');

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE IF NOT EXISTS `countries` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `name`) VALUES
(5, 'North Korea'),
(6, 'Vietnam'),
(10, 'US'),
(13, 'Japan'),
(14, 'South Korea'),
(15, 'Thailand'),
(18, 'Philippines'),
(21, 'Saudi Arabia');

-- --------------------------------------------------------

--
-- Table structure for table `educational_backgrounds`
--

CREATE TABLE IF NOT EXISTS `educational_backgrounds` (
  `user_id` int(255) NOT NULL,
  `student_number` varchar(255) DEFAULT NULL,
  `program_id` int(255) NOT NULL,
  `semester_graduated` int(255) DEFAULT NULL,
  `year_graduated` varchar(255) DEFAULT NULL,
  `honor_received` enum('none','summa cum laude','magna cum laude','cum laude') DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  KEY `program_id` (`program_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `educational_backgrounds`
--

INSERT INTO `educational_backgrounds` (`user_id`, `student_number`, `program_id`, `semester_graduated`, `year_graduated`, `honor_received`) VALUES
(46, '2011-37567', 2, 2, '0 - 0', 'none'),
(47, '2011-37568', 2, 2, '2013-2014', 'none'),
(50, '1111-11111', 2, 2, '2012-2013', 'summa cum laude'),
(65, '2012-12345', 11, 2, '2012-2013', 'none'),
(72, '1234-12345', 2, 1, '2013-2014', 'none');

-- --------------------------------------------------------

--
-- Table structure for table `employer_types`
--

CREATE TABLE IF NOT EXISTS `employer_types` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `employer_types`
--

INSERT INTO `employer_types` (`id`, `name`) VALUES
(2, 'Business Process Outsourcing (BPO) - Voice'),
(3, 'BPO - Non-Voice'),
(5, 'Academe'),
(6, 'Health'),
(7, 'TV Stations'),
(8, 'Radio Stations'),
(9, 'Newspaper Company'),
(10, 'Law Firm'),
(11, 'Government Agency'),
(13, 'Hospital'),
(17, 'IT Company'),
(18, 'Bank');

-- --------------------------------------------------------

--
-- Table structure for table `employment_details`
--

CREATE TABLE IF NOT EXISTS `employment_details` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `self_employed` tinyint(1) DEFAULT NULL,
  `business` varchar(255) DEFAULT NULL,
  `employer` varchar(255) DEFAULT NULL,
  `employer_type_id` int(255) DEFAULT NULL,
  `job_title` varchar(255) NOT NULL,
  `monthly_salary_id` int(255) DEFAULT NULL,
  `job_satisfaction` tinyint(1) DEFAULT NULL,
  `reason` text,
  `year_started` int(255) DEFAULT NULL,
  `year_ended` int(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `employer_type_id` (`employer_type_id`),
  KEY `monthly_salary_id` (`monthly_salary_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `employment_details`
--

INSERT INTO `employment_details` (`id`, `self_employed`, `business`, `employer`, `employer_type_id`, `job_title`, `monthly_salary_id`, `job_satisfaction`, `reason`, `year_started`, `year_ended`) VALUES
(1, 0, '', 'Azeus', 2, 'CEO', 8, 1, 'Mao lang', 2014, 100000),
(2, 0, '', 'Dana', 2, 'Teacher 1', 4, 0, 'Kapuy', 2011, 2013),
(3, 0, '', 'Dat', 3, 'Janitor', 4, 1, 'mao lang', 2014, 2014),
(9, 0, '', 'asdas', 2, 'dads', 2, 0, '', 2014, 2014),
(12, 1, 'Fisherman', '', 3, 'Fisherman', 2, 1, 'asdas', 2014, 100000),
(14, 1, 'asdas', '', 2, 'asdsadsa', 2, 1, '', 2014, 100000);

-- --------------------------------------------------------

--
-- Table structure for table `enumerator_programs`
--

CREATE TABLE IF NOT EXISTS `enumerator_programs` (
  `user_id` int(255) NOT NULL,
  `program_id` int(255) NOT NULL,
  PRIMARY KEY (`user_id`,`program_id`),
  KEY `program_id` (`program_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `enumerator_programs`
--

INSERT INTO `enumerator_programs` (`user_id`, `program_id`) VALUES
(69, 2),
(62, 5),
(69, 5),
(62, 6),
(62, 8),
(63, 8),
(69, 8),
(71, 8),
(62, 9),
(63, 11),
(71, 11);

-- --------------------------------------------------------

--
-- Table structure for table `enumerator_statistics`
--

CREATE TABLE IF NOT EXISTS `enumerator_statistics` (
  `user_id` int(255) NOT NULL,
  `statistics` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `enumerator_statistics`
--

INSERT INTO `enumerator_statistics` (`user_id`, `statistics`) VALUES
(62, 1),
(63, 1),
(69, 1),
(71, 0);

-- --------------------------------------------------------

--
-- Table structure for table `ge_courses`
--

CREATE TABLE IF NOT EXISTS `ge_courses` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `code` varchar(255) DEFAULT NULL,
  `description` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `ge_courses`
--

INSERT INTO `ge_courses` (`id`, `name`, `code`, `description`) VALUES
(1, 'Philippine Literature2', 'Lit 3', 'Introduction to Philippine Literature'),
(3, 'Biology', 'Bio 1', 'Introduction to Biology, a brief overview.');

-- --------------------------------------------------------

--
-- Table structure for table `major_courses`
--

CREATE TABLE IF NOT EXISTS `major_courses` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `code` varchar(255) DEFAULT NULL,
  `description` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `major_courses`
--

INSERT INTO `major_courses` (`id`, `name`, `code`, `description`) VALUES
(1, 'Introduction to Programming', 'CMSC 11', 'Brief overview of computer programming.'),
(2, 'Date Structure', 'CSMC 123', 'Data structures for computer programming.'),
(3, 'Introduction to Calculus', 'Math 100', 'Introduction to basic calculus.');

-- --------------------------------------------------------

--
-- Table structure for table `monthly_salaries`
--

CREATE TABLE IF NOT EXISTS `monthly_salaries` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `minimum` int(255) DEFAULT NULL,
  `maximum` int(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `monthly_salaries`
--

INSERT INTO `monthly_salaries` (`id`, `minimum`, `maximum`) VALUES
(2, NULL, 10000),
(3, 10001, 20000),
(4, 20001, 30000),
(5, 30001, 40000),
(6, 40001, 50000),
(7, 50001, 60000),
(8, 60001, 100000),
(9, 100001, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `params`
--

CREATE TABLE IF NOT EXISTS `params` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `key_name` varchar(255) NOT NULL,
  `value` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `params`
--

INSERT INTO `params` (`id`, `key_name`, `value`) VALUES
(3, 'start_submission', '2014-01-01'),
(4, 'end_submission', '2014-01-31'),
(5, 'submission', 'true'),
(6, 'cleaning', 'true'),
(7, 'start_cleaning', '2014-01-01'),
(8, 'end_cleaning', '2014-01-31');

-- --------------------------------------------------------

--
-- Table structure for table `personal_infos`
--

CREATE TABLE IF NOT EXISTS `personal_infos` (
  `user_id` int(255) NOT NULL,
  `firstname` varchar(255) DEFAULT NULL,
  `lastname` varchar(255) DEFAULT NULL,
  `gender` enum('male','female') DEFAULT NULL,
  `present_address` varchar(255) DEFAULT NULL,
  `present_country_id` int(255) DEFAULT NULL,
  `present_contact_number` varchar(255) DEFAULT NULL,
  `premanent_address` varchar(255) DEFAULT NULL,
  `permanent_contact_number` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  KEY `present_country_id` (`present_country_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `personal_infos`
--

INSERT INTO `personal_infos` (`user_id`, `firstname`, `lastname`, `gender`, `present_address`, `present_country_id`, `present_contact_number`, `premanent_address`, `permanent_contact_number`, `email`) VALUES
(46, 'Emmanuel', 'Lodovice', 'female', 'Lahug Cebu City Yeah', 21, '09228297070', 'Jampang Argao', '092293652940', 'name3anad@gmail.com'),
(47, 'Eman', 'Lod', 'female', 'Ceb', 18, '09228297070', 'Argao', '09229365294', 'name3anad@gmail.com'),
(50, 'Emmanuel', 'Lodovice', 'male', 'Cebu', 18, '09228297070', 'Argao', '09229365294', 'name1anad@gmail.com'),
(62, 'Paw', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'paw@gmail.com'),
(63, 'Eman', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'eman@gmail.com'),
(65, 'Nardox2', 'Serino', 'male', 'Cebu', 14, '09123178', 'Sequijor', '1231232', 'pass@gmail.com'),
(69, 'Dads', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'dads@gmail.com'),
(71, 'Ryan Ciriaco M. Dulaca', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'rmdulaca@up.edu.ph'),
(72, 'sadsadas', 'sadasdsa', 'female', 'sadasdsad', 18, 'sadasdsad', 'asdsadsa', 'sadasdas', 'sadsad@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `programs`
--

CREATE TABLE IF NOT EXISTS `programs` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `programs`
--

INSERT INTO `programs` (`id`, `name`) VALUES
(2, 'BS in Computer Science'),
(3, 'BS in Math/Math-Pure'),
(4, 'BS in Math/Math-Comp Sci'),
(5, 'BS in Biology'),
(6, 'BS in Management'),
(7, 'BA in Political Science'),
(8, 'BA in Psychology'),
(9, 'BA (Mass Communication)'),
(10, 'B of Fine Arts'),
(11, 'Certificate in Fine Arts');

-- --------------------------------------------------------

--
-- Table structure for table `social_networks`
--

CREATE TABLE IF NOT EXISTS `social_networks` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `social_networks`
--

INSERT INTO `social_networks` (`id`, `name`) VALUES
(2, 'Twitter'),
(3, 'Facebook');

-- --------------------------------------------------------

--
-- Table structure for table `syllabus`
--

CREATE TABLE IF NOT EXISTS `syllabus` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `program_id` int(255) NOT NULL,
  `year_first_used` int(255) NOT NULL,
  `year_last_used` int(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `program_id` (`program_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `syllabus`
--


-- --------------------------------------------------------

--
-- Table structure for table `syllabus_major_courses`
--

CREATE TABLE IF NOT EXISTS `syllabus_major_courses` (
  `syllabus_id` int(255) NOT NULL,
  `major_course_id` int(255) NOT NULL,
  PRIMARY KEY (`syllabus_id`,`major_course_id`),
  KEY `major_course_id` (`major_course_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `syllabus_major_courses`
--


-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_type` enum('super admin','admin','moderator','alumni') NOT NULL DEFAULT 'alumni',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `cleaned` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=73 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `user_type`, `created_at`, `cleaned`) VALUES
(46, '2011-37567', 'name_anad', 'alumni', '0000-00-00 00:00:00', 1),
(47, 'name_anad', 'name_anad', 'super admin', '0000-00-00 00:00:00', 0),
(50, '1111-11111', '123', 'alumni', '2014-01-21 23:14:22', 1),
(62, 'enumerator62', '9tpugH', 'moderator', '2014-01-22 01:06:10', 0),
(63, 'enumerator63', 'pAgYsD', 'moderator', '2014-01-22 01:06:49', 0),
(65, '2012-12345', 'hLg5tN', 'alumni', '2014-01-22 09:27:19', 1),
(69, 'enumerator690', 'R8w81O', 'moderator', '2014-01-22 12:41:47', 0),
(71, 'dat', 'name_anad', 'moderator', '2014-01-22 15:01:22', 0),
(72, '1234-12345', 'LZOCsA', 'alumni', '2014-01-23 22:48:43', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_employment_histories`
--

CREATE TABLE IF NOT EXISTS `user_employment_histories` (
  `user_id` int(255) NOT NULL,
  `employment_details_id` int(255) NOT NULL,
  `current_job` tinyint(1) DEFAULT NULL,
  `first_job` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`user_id`,`employment_details_id`),
  KEY `employment_details_id` (`employment_details_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_employment_histories`
--

INSERT INTO `user_employment_histories` (`user_id`, `employment_details_id`, `current_job`, `first_job`) VALUES
(46, 9, 1, 0),
(50, 1, 1, 0),
(50, 2, 0, 1),
(50, 3, 0, 0),
(65, 12, 1, 0),
(72, 14, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_social_networks`
--

CREATE TABLE IF NOT EXISTS `user_social_networks` (
  `user_id` int(255) NOT NULL,
  `social_network_id` int(255) NOT NULL,
  `account_name` varchar(255) NOT NULL,
  PRIMARY KEY (`user_id`,`social_network_id`),
  KEY `social_network_id` (`social_network_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_social_networks`
--

INSERT INTO `user_social_networks` (`user_id`, `social_network_id`, `account_name`) VALUES
(46, 2, ''),
(46, 3, 'EmmanuelLodovice'),
(50, 2, ''),
(50, 3, ''),
(65, 2, ''),
(65, 3, '@nardox');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `comment_ge_courses`
--
ALTER TABLE `comment_ge_courses`
  ADD CONSTRAINT `comment_ge_courses_ibfk_1` FOREIGN KEY (`comment_id`) REFERENCES `comments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comment_ge_courses_ibfk_2` FOREIGN KEY (`GE_course_id`) REFERENCES `ge_courses` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `comment_majors`
--
ALTER TABLE `comment_majors`
  ADD CONSTRAINT `comment_majors_ibfk_1` FOREIGN KEY (`comment_id`) REFERENCES `comments` (`id`);

--
-- Constraints for table `comment_major_courses`
--
ALTER TABLE `comment_major_courses`
  ADD CONSTRAINT `comment_major_courses_ibfk_1` FOREIGN KEY (`comment_id`) REFERENCES `comments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comment_major_courses_ibfk_2` FOREIGN KEY (`major_course_id`) REFERENCES `major_courses` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `comment_suggested_courses`
--
ALTER TABLE `comment_suggested_courses`
  ADD CONSTRAINT `comment_suggested_courses_ibfk_1` FOREIGN KEY (`comment_id`) REFERENCES `comments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `educational_backgrounds`
--
ALTER TABLE `educational_backgrounds`
  ADD CONSTRAINT `educational_backgrounds_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `educational_backgrounds_ibfk_2` FOREIGN KEY (`program_id`) REFERENCES `programs` (`id`);

--
-- Constraints for table `employment_details`
--
ALTER TABLE `employment_details`
  ADD CONSTRAINT `employment_details_ibfk_1` FOREIGN KEY (`employer_type_id`) REFERENCES `employer_types` (`id`),
  ADD CONSTRAINT `employment_details_ibfk_2` FOREIGN KEY (`monthly_salary_id`) REFERENCES `monthly_salaries` (`id`);

--
-- Constraints for table `enumerator_programs`
--
ALTER TABLE `enumerator_programs`
  ADD CONSTRAINT `enumerator_programs_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `enumerator_programs_ibfk_2` FOREIGN KEY (`program_id`) REFERENCES `programs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `enumerator_statistics`
--
ALTER TABLE `enumerator_statistics`
  ADD CONSTRAINT `enumerator_statistics_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `personal_infos`
--
ALTER TABLE `personal_infos`
  ADD CONSTRAINT `personal_infos_ibfk_1` FOREIGN KEY (`present_country_id`) REFERENCES `countries` (`id`),
  ADD CONSTRAINT `personal_infos_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `syllabus`
--
ALTER TABLE `syllabus`
  ADD CONSTRAINT `syllabus_ibfk_1` FOREIGN KEY (`program_id`) REFERENCES `programs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `syllabus_major_courses`
--
ALTER TABLE `syllabus_major_courses`
  ADD CONSTRAINT `syllabus_major_courses_ibfk_1` FOREIGN KEY (`syllabus_id`) REFERENCES `syllabus` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `syllabus_major_courses_ibfk_2` FOREIGN KEY (`major_course_id`) REFERENCES `major_courses` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_employment_histories`
--
ALTER TABLE `user_employment_histories`
  ADD CONSTRAINT `user_employment_histories_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_employment_histories_ibfk_2` FOREIGN KEY (`employment_details_id`) REFERENCES `employment_details` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_social_networks`
--
ALTER TABLE `user_social_networks`
  ADD CONSTRAINT `user_social_networks_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_social_networks_ibfk_2` FOREIGN KEY (`social_network_id`) REFERENCES `social_networks` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
