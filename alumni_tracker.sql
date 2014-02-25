-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 26, 2014 at 07:20 AM
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


-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE IF NOT EXISTS `countries` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=428 ;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `name`) VALUES
(223, 'Afghanistan'),
(224, 'Albania'),
(225, 'Algeria'),
(226, 'Andorra'),
(227, 'Angola'),
(228, 'Antigua and Barbuda'),
(229, 'Argentina'),
(230, 'Armenia'),
(231, 'Aruba'),
(232, 'Australia'),
(233, 'Austria'),
(234, 'Azerbaijan'),
(235, 'Bahamas, The'),
(236, 'Bahrain'),
(237, 'Bangladesh'),
(238, 'Barbados'),
(239, 'Belarus'),
(240, 'Belgium'),
(241, 'Belize'),
(242, 'Benin'),
(243, 'Bhutan'),
(244, 'Bolivia'),
(245, 'Bosnia and Herzegovina'),
(246, 'Botswana'),
(247, 'Brazil'),
(248, 'Brunei'),
(249, 'Bulgaria'),
(250, 'Burkina Faso'),
(251, 'Burma'),
(252, 'Burundi'),
(253, 'Cambodia'),
(254, 'Cameroon'),
(255, 'Canada'),
(256, 'Cape Verde'),
(257, 'Central African Republic'),
(258, 'Chad'),
(259, 'Chile'),
(260, 'China'),
(261, 'Colombia'),
(262, 'Comoros'),
(263, 'Congo, Democratic Republic of the'),
(264, 'Congo, Republic of the'),
(265, 'Costa Rica'),
(266, 'Cote d''Ivoire'),
(267, 'Croatia'),
(268, 'Cuba'),
(269, 'Curacao'),
(270, 'Cyprus'),
(271, 'Czech Republic'),
(272, 'Denmark'),
(273, 'Djibouti'),
(274, 'Dominica'),
(275, 'Dominican Republic'),
(276, 'East Timor (see Timor-Leste)'),
(277, 'Ecuador'),
(278, 'Egypt'),
(279, 'El Salvador'),
(280, 'Equatorial Guinea'),
(281, 'Eritrea'),
(282, 'Estonia'),
(283, 'Ethiopia'),
(284, 'Fiji'),
(285, 'Finland'),
(286, 'France'),
(287, 'Gabon'),
(288, 'Gambia, The'),
(289, 'Georgia'),
(290, 'Germany'),
(291, 'Ghana'),
(292, 'Greece'),
(293, 'Grenada'),
(294, 'Guatemala'),
(295, 'Guinea'),
(296, 'Guinea-Bissau'),
(297, 'Guyana'),
(298, 'Haiti'),
(299, 'Holy See'),
(300, 'Honduras'),
(301, 'Hong Kong'),
(302, 'Hungary'),
(303, 'Iceland'),
(304, 'India'),
(305, 'Indonesia'),
(306, 'Iran'),
(307, 'Iraq'),
(308, 'Ireland'),
(309, 'Israel'),
(310, 'Italy'),
(311, 'Jamaica'),
(312, 'Japan'),
(313, 'Jordan'),
(314, 'Kazakhstan'),
(315, 'Kenya'),
(316, 'Kiribati'),
(317, 'Korea, North'),
(318, 'Korea, South'),
(319, 'Kosovo'),
(320, 'Kuwait'),
(321, 'Kyrgyzstan'),
(322, 'Laos'),
(323, 'Latvia'),
(324, 'Lebanon'),
(325, 'Lesotho'),
(326, 'Liberia'),
(327, 'Libya'),
(328, 'Liechtenstein'),
(329, 'Lithuania'),
(330, 'Luxembourg'),
(331, 'Macau'),
(332, 'Macedonia'),
(333, 'Madagascar'),
(334, 'Malawi'),
(335, 'Malaysia'),
(336, 'Maldives'),
(337, 'Mali'),
(338, 'Malta'),
(339, 'Marshall Islands'),
(340, 'Mauritania'),
(341, 'Mauritius'),
(342, 'Mexico'),
(343, 'Micronesia'),
(344, 'Moldova'),
(345, 'Monaco'),
(346, 'Mongolia'),
(347, 'Montenegro'),
(348, 'Morocco'),
(349, 'Mozambique'),
(350, 'Namibia'),
(351, 'Nauru'),
(352, 'Nepal'),
(353, 'Netherlands'),
(354, 'Netherlands Antilles'),
(355, 'New Zealand'),
(356, 'Nicaragua'),
(357, 'Niger'),
(358, 'Nigeria'),
(359, 'North Korea'),
(360, 'Norway'),
(361, 'Oman'),
(362, 'Pakistan'),
(363, 'Palau'),
(364, 'Palestinian Territories'),
(365, 'Panama'),
(366, 'Papua New Guinea'),
(367, 'Paraguay'),
(368, 'Peru'),
(369, 'Philippines'),
(370, 'Poland'),
(371, 'Portugal'),
(372, 'Qatar'),
(373, 'Romania'),
(374, 'Russia'),
(375, 'Rwanda'),
(376, 'Saint Kitts and Nevis'),
(377, 'Saint Lucia'),
(378, 'Saint Vincent and the Grenadines'),
(379, 'Samoa'),
(380, 'San Marino'),
(381, 'Sao Tome and Principe'),
(382, 'Saudi Arabia'),
(383, 'Senegal'),
(384, 'Serbia'),
(385, 'Seychelles'),
(386, 'Sierra Leone'),
(387, 'Singapore'),
(388, 'Sint Maarten'),
(389, 'Slovakia'),
(390, 'Slovenia'),
(391, 'Solomon Islands'),
(392, 'Somalia'),
(393, 'South Africa'),
(394, 'South Korea'),
(395, 'South Sudan'),
(396, 'Spain'),
(397, 'Sri Lanka'),
(398, 'Sudan'),
(399, 'Suriname'),
(400, 'Swaziland'),
(401, 'Sweden'),
(402, 'Switzerland'),
(403, 'Syria'),
(404, 'Taiwan'),
(405, 'Tajikistan'),
(406, 'Tanzania'),
(407, 'Thailand'),
(408, 'Timor-Leste'),
(409, 'Togo'),
(410, 'Tonga'),
(411, 'Trinidad and Tobago'),
(412, 'Tunisia'),
(413, 'Turkey'),
(414, 'Turkmenistan'),
(415, 'Tuvalu'),
(416, 'Uganda'),
(417, 'Ukraine'),
(418, 'United Arab Emirates'),
(419, 'United Kingdom'),
(420, 'Uruguay'),
(421, 'Uzbekistan'),
(422, 'Vanuatu'),
(423, 'Venezuela'),
(424, 'Vietnam'),
(425, 'Yemen'),
(426, 'Zambia'),
(427, 'Zimbabwe');

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
  `month_started` int(11) NOT NULL DEFAULT '1',
  `year_ended` int(255) DEFAULT NULL,
  `month_ended` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `employer_type_id` (`employer_type_id`),
  KEY `monthly_salary_id` (`monthly_salary_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=48 ;

--
-- Dumping data for table `employment_details`
--


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
-- Table structure for table `other_degree`
--

CREATE TABLE IF NOT EXISTS `other_degree` (
  `user_id` int(255) NOT NULL,
  `other_degree_id` int(255) NOT NULL AUTO_INCREMENT,
  `degree` varchar(255) NOT NULL,
  `school_taken` varchar(255) DEFAULT NULL,
  `year_finished` int(255) DEFAULT NULL,
  PRIMARY KEY (`other_degree_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `other_degree`
--


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
(4, 'end_submission', '2014-04-30'),
(5, 'submission', 'true'),
(6, 'cleaning', 'true'),
(7, 'start_cleaning', '2014-01-01'),
(8, 'end_cleaning', '2014-02-28');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=95 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `user_type`, `created_at`, `cleaned`) VALUES
(47, 'name_anad', 'name_anad', 'super admin', '0000-00-00 00:00:00', 0);

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
-- Constraints for table `other_degree`
--
ALTER TABLE `other_degree`
  ADD CONSTRAINT `other_degree_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
