-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3308
-- Generation Time: Jun 19, 2020 at 08:46 AM
-- Server version: 8.0.18
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ddstudportal`
--

-- --------------------------------------------------------

--
-- Table structure for table `address`
--

DROP TABLE IF EXISTS `address`;
CREATE TABLE IF NOT EXISTS `address` (
  `address_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `street` varchar(255) NOT NULL,
  `zipcode` varchar(45) NOT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `country_id` int(10) UNSIGNED DEFAULT NULL,
  `phone_no` varchar(50) DEFAULT NULL,
  `additional` varchar(255) DEFAULT NULL,
  `student_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`address_id`),
  KEY `fk_address_country1_idx` (`country_id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `address`
--

INSERT INTO `address` (`address_id`, `street`, `zipcode`, `city`, `state`, `country_id`, `phone_no`, `additional`, `student_id`, `created_at`, `updated_at`) VALUES
(5, 'Falkstrasse 96', '47058', 'Duisburg', 'Deutschland (DEU)', 82, '017680749092', NULL, 12, '2020-05-18 14:45:29', NULL),
(12, 'test, 2', '12344', 'duisburg', 'North Rhine-Westphaliaa', 58, '+4912345679', NULL, 19, '2020-05-18 14:45:56', '2020-05-22 19:03:55'),
(19, 'test, 1', '12345', 'duisburg', 'North Rhine-Westphalia', 82, '+4912345678', NULL, 23, '2020-05-25 14:31:37', NULL),
(30, 'test, 1', '12345', 'duisburg', 'North Rhine-Westphalia', 82, '+4912345678', NULL, 12, '2020-06-16 19:35:37', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `application`
--

DROP TABLE IF EXISTS `application`;
CREATE TABLE IF NOT EXISTS `application` (
  `application_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `exchange_period_id` int(10) UNSIGNED DEFAULT NULL,
  `student_id` int(10) UNSIGNED DEFAULT NULL,
  `intention_id` int(10) UNSIGNED DEFAULT NULL,
  `applied_degree_id` int(10) UNSIGNED DEFAULT NULL,
  `success_factor` decimal(6,3) NOT NULL DEFAULT '0.000',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `home_address_id` int(11) UNSIGNED DEFAULT NULL,
  PRIMARY KEY (`application_id`),
  KEY `fk_application_student1_idx` (`student_id`),
  KEY `fk_application_intention1_idx` (`intention_id`),
  KEY `fk_application_degree1_idx` (`applied_degree_id`),
  KEY `fk_application_exchange_period1_idx` (`exchange_period_id`),
  KEY `fk_application_home_address_id` (`home_address_id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `application`
--

INSERT INTO `application` (`application_id`, `exchange_period_id`, `student_id`, `intention_id`, `applied_degree_id`, `success_factor`, `created_at`, `updated_at`, `home_address_id`) VALUES
(6, 1, 19, 2, 2, '1.107', '2020-05-18 14:45:56', '2020-05-18 18:36:41', 12),
(13, 1, 23, 2, 2, '7.688', '2020-05-25 14:31:37', '2020-06-16 12:27:01', 19),
(24, 1, 12, 1, 1, '7.688', '2020-06-16 19:35:37', '2020-06-16 19:35:37', 30);

-- --------------------------------------------------------

--
-- Table structure for table `applied_equivalence`
--

DROP TABLE IF EXISTS `applied_equivalence`;
CREATE TABLE IF NOT EXISTS `applied_equivalence` (
  `application_id` int(10) UNSIGNED NOT NULL,
  `equivalence_id` int(10) UNSIGNED NOT NULL,
  `application_status_id` int(10) UNSIGNED DEFAULT NULL,
  PRIMARY KEY (`application_id`,`equivalence_id`),
  KEY `fk_applied_equivalence_equivalent_subjects1_idx` (`equivalence_id`),
  KEY `fk_applied_equivalence_status` (`application_status_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `applied_equivalence`
--

INSERT INTO `applied_equivalence` (`application_id`, `equivalence_id`, `application_status_id`) VALUES
(24, 2, NULL),
(24, 48, NULL),
(24, 103, NULL),
(24, 104, NULL),
(24, 119, NULL),
(24, 120, NULL),
(24, 121, NULL),
(24, 125, NULL),
(24, 126, NULL),
(24, 134, NULL),
(24, 135, NULL),
(24, 136, NULL),
(24, 137, NULL),
(24, 138, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `country`
--

DROP TABLE IF EXISTS `country`;
CREATE TABLE IF NOT EXISTS `country` (
  `country_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  PRIMARY KEY (`country_id`),
  UNIQUE KEY `name_UNIQUE` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=248 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `country`
--

INSERT INTO `country` (`country_id`, `name`) VALUES
(1, NULL),
(2, 'Afghanistan'),
(3, 'Åland Islands'),
(4, 'Albania'),
(5, 'Algeria'),
(6, 'American Samoa'),
(7, 'Andorra'),
(8, 'Angola'),
(9, 'Anguilla'),
(10, 'Antarctica'),
(11, 'Antigua And Barbuda'),
(12, 'Argentina'),
(13, 'Armenia'),
(14, 'Aruba'),
(15, 'Australia'),
(16, 'Austria'),
(17, 'Azerbaijan'),
(18, 'Bahamas'),
(19, 'Bahrain'),
(20, 'Bangladesh'),
(21, 'Barbados'),
(22, 'Belarus'),
(23, 'Belgium'),
(24, 'Belize'),
(25, 'Benin'),
(26, 'Bermuda'),
(27, 'Bhutan'),
(28, 'Bolivia'),
(29, 'Bosnia And Herzegovina'),
(30, 'Botswana'),
(31, 'Bouvet Island'),
(32, 'Brazil'),
(33, 'British Indian Ocean Territory'),
(34, 'Brunei Darussalam'),
(35, 'Bulgaria'),
(36, 'Burkina Faso'),
(37, 'Burundi'),
(38, 'Cambodia'),
(39, 'Cameroon'),
(40, 'Canada'),
(41, 'Cape Verde'),
(42, 'Cayman Islands'),
(43, 'Central African Republic'),
(44, 'Chad'),
(45, 'Chile'),
(46, 'China'),
(47, 'Christmas Island'),
(48, 'Cocos (Keeling) Islands'),
(49, 'Colombia'),
(50, 'Comoros'),
(51, 'Congo'),
(52, 'Congo, The Democratic Republic Of The'),
(53, 'Cook Islands'),
(54, 'Costa Rica'),
(55, 'Côte D\'ivoire'),
(56, 'Croatia'),
(57, 'Cuba'),
(58, 'Cyprus'),
(59, 'Czech Republic'),
(60, 'Denmark'),
(61, 'Djibouti'),
(62, 'Dominica'),
(63, 'Dominican Republic'),
(64, 'Ecuador'),
(65, 'Egypt'),
(66, 'El Salvador'),
(67, 'Equatorial Guinea'),
(68, 'Eritrea'),
(69, 'Estonia'),
(70, 'Ethiopia'),
(71, 'Falkland Islands (Malvinas)'),
(72, 'Faroe Islands'),
(73, 'Fiji'),
(74, 'Finland'),
(75, 'France'),
(76, 'French Guiana'),
(77, 'French Polynesia'),
(78, 'French Southern Territories'),
(79, 'Gabon'),
(80, 'Gambia'),
(81, 'Georgia'),
(82, 'Germany'),
(83, 'Ghana'),
(84, 'Gibraltar'),
(85, 'Greece'),
(86, 'Greenland'),
(87, 'Grenada'),
(88, 'Guadeloupe'),
(89, 'Guam'),
(90, 'Guatemala'),
(91, 'Guernsey'),
(92, 'Guinea'),
(93, 'Guinea-Bissau'),
(94, 'Guyana'),
(95, 'Haiti'),
(96, 'Heard Island And Mcdonald Islands'),
(97, 'Holy See (Vatican City State)'),
(98, 'Honduras'),
(99, 'Hong Kong'),
(100, 'Hungary'),
(101, 'Iceland'),
(102, 'India'),
(103, 'Indonesia'),
(104, 'Iran, Islamic Republic Of'),
(105, 'Iraq'),
(106, 'Ireland'),
(107, 'Isle Of Man'),
(108, 'Israel'),
(109, 'Italy'),
(110, 'Jamaica'),
(111, 'Japan'),
(112, 'Jersey'),
(113, 'Jordan'),
(114, 'Kazakhstan'),
(115, 'Kenya'),
(116, 'Kiribati'),
(117, 'Korea, Democratic People\'s Republic Of'),
(118, 'Korea, Republic Of'),
(119, 'Kuwait'),
(120, 'Kyrgyzstan'),
(121, 'Lao People\'s Democratic Republic'),
(122, 'Latvia'),
(123, 'Lebanon'),
(124, 'Lesotho'),
(125, 'Liberia'),
(126, 'Libyan Arab Jamahiriya'),
(127, 'Liechtenstein'),
(128, 'Lithuania'),
(129, 'Luxembourg'),
(130, 'Macao'),
(131, 'Macedonia, The Former Yugoslav Republic Of'),
(132, 'Madagascar'),
(133, 'Malawi'),
(134, 'Malaysia'),
(135, 'Maldives'),
(136, 'Mali'),
(137, 'Malta'),
(138, 'Marshall Islands'),
(139, 'Martinique'),
(140, 'Mauritania'),
(141, 'Mauritius'),
(142, 'Mayotte'),
(143, 'Mexico'),
(144, 'Micronesia, Federated States Of'),
(145, 'Moldova, Republic Of'),
(146, 'Monaco'),
(147, 'Mongolia'),
(148, 'Montenegro'),
(149, 'Montserrat'),
(150, 'Morocco'),
(151, 'Mozambique'),
(152, 'Myanmar'),
(153, 'Namibia'),
(154, 'Nauru'),
(155, 'Nepal'),
(156, 'Netherlands'),
(157, 'Netherlands Antilles'),
(158, 'New Caledonia'),
(159, 'New Zealand'),
(160, 'Nicaragua'),
(161, 'Niger'),
(162, 'Nigeria'),
(163, 'Niue'),
(164, 'Norfolk Island'),
(165, 'Northern Mariana Islands'),
(166, 'Norway'),
(167, 'Oman'),
(168, 'Pakistan'),
(169, 'Palau'),
(170, 'Palestinian Territory, Occupied'),
(171, 'Panama'),
(172, 'Papua New Guinea'),
(173, 'Paraguay'),
(174, 'Peru'),
(175, 'Philippines'),
(176, 'Pitcairn'),
(177, 'Poland'),
(178, 'Portugal'),
(179, 'Puerto Rico'),
(180, 'Qatar'),
(181, 'Réunion'),
(182, 'Romania'),
(183, 'Russian Federation'),
(184, 'Rwanda'),
(185, 'Saint Barthélemy'),
(186, 'Saint Helena'),
(187, 'Saint Kitts And Nevis'),
(188, 'Saint Lucia'),
(189, 'Saint Martin'),
(190, 'Saint Pierre And Miquelon'),
(191, 'Saint Vincent And The Grenadines'),
(192, 'Samoa'),
(193, 'San Marino'),
(194, 'Sao Tome And Principe'),
(195, 'Saudi Arabia'),
(196, 'Senegal'),
(197, 'Serbia'),
(198, 'Seychelles'),
(199, 'Sierra Leone'),
(200, 'Singapore'),
(201, 'Slovakia'),
(202, 'Slovenia'),
(203, 'Solomon Islands'),
(204, 'Somalia'),
(205, 'South Africa'),
(206, 'South Georgia And The South Sandwich Islands'),
(207, 'Spain'),
(208, 'Sri Lanka'),
(209, 'Sudan'),
(210, 'Suriname'),
(211, 'Svalbard And Jan Mayen'),
(212, 'Swaziland'),
(213, 'Sweden'),
(214, 'Switzerland'),
(215, 'Syrian Arab Republic'),
(216, 'Taiwan, Province Of China'),
(217, 'Tajikistan'),
(218, 'Tanzania, United Republic Of'),
(219, 'Thailand'),
(220, 'Timor-Leste'),
(221, 'Togo'),
(222, 'Tokelau'),
(223, 'Tonga'),
(224, 'Trinidad And Tobago'),
(225, 'Tunisia'),
(226, 'Turkey'),
(227, 'Turkmenistan'),
(228, 'Turks And Caicos Islands'),
(229, 'Tuvalu'),
(230, 'Uganda'),
(231, 'Ukraine'),
(232, 'United Arab Emirates'),
(233, 'United Kingdom'),
(234, 'United States'),
(235, 'United States Minor Outlying Islands'),
(236, 'Uruguay'),
(237, 'Uzbekistan'),
(238, 'Vanuatu'),
(239, 'Venezuela, Bolivarian Republic Of'),
(240, 'Viet Nam'),
(241, 'Virgin Islands, British'),
(242, 'Virgin Islands, U.S.'),
(243, 'Wallis And Futuna'),
(244, 'Western Sahara'),
(245, 'Yemen'),
(246, 'Zambia'),
(247, 'Zimbabwe');

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

DROP TABLE IF EXISTS `course`;
CREATE TABLE IF NOT EXISTS `course` (
  `course_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  PRIMARY KEY (`course_id`)
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`course_id`, `name`) VALUES
(1, NULL),
(2, 'Computer Science and Communications Engineering'),
(3, 'Electrical and Electronic Engineering'),
(4, 'Mechanical Engineering'),
(5, 'Civil Engineering, Environmental'),
(6, 'Civil Engineering, Structural'),
(7, 'Computer Engineering'),
(8, 'Wirtschaftsingenieur'),
(9, 'Wirtschaftsingenieur/MBau'),
(10, 'Wirtschaftsingenieur/IT'),
(11, 'Wirtschaftsingenieur/Energy'),
(12, 'Metalurgy and Metal Forming'),
(13, 'Civil Engineering'),
(14, 'Computational Mechanics'),
(15, 'Automotive Engineering'),
(16, 'Industrial Engineering'),
(17, 'Elektro und Informationstechnik'),
(18, 'Nano Engineering'),
(19, 'Maschinenbau'),
(20, 'Wirtschaftsingenieur/ Automotive Engineering'),
(22, 'Automation and Control Engineering'),
(23, 'Technische Logistik'),
(24, 'The Electronic Information Engineering'),
(25, 'Hydraulic and Hydropower Engineering'),
(26, 'Electric Engineering and Its Automation'),
(27, 'Computer Science and Technology'),
(28, 'Communications Engineering'),
(29, 'Mechnical Design, Manufacturing and Automation'),
(30, 'Software Engineering'),
(31, 'Logistik Management'),
(32, 'Measur and Control Technology and Instrument'),
(33, 'Computer Engineering-INS'),
(34, 'Computer Engineering-ISV'),
(35, 'Embedded Systems Engineering'),
(36, 'Power Engineering'),
(37, 'Mechanical Engineering-GME'),
(38, 'Mechanical Engineering-MT'),
(39, 'Mechanical Engineering-PaL'),
(40, 'Management and Technology of Water and Waste Water'),
(41, 'Mechanical Engineering-EaEE'),
(42, 'Computer Engineering-SWE'),
(43, 'Computer Engineering-Com'),
(44, 'Business Administration'),
(45, 'Economies'),
(46, 'Betriebswirtschaftslehre'),
(47, 'Bauingenieurwesen'),
(48, 'Structural Engineering'),
(49, 'Elektronic Information Engineering'),
(51, 'International Economics and Trade'),
(53, 'Inorganic non-metallic Materials Engineering'),
(54, 'Metal Material and Forming Process'),
(55, 'English'),
(56, 'Modern East Asian Studies'),
(57, 'Biologie');

-- --------------------------------------------------------

--
-- Table structure for table `degree`
--

DROP TABLE IF EXISTS `degree`;
CREATE TABLE IF NOT EXISTS `degree` (
  `degree_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `abbreviation` varchar(45) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  PRIMARY KEY (`degree_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `degree`
--

INSERT INTO `degree` (`degree_id`, `name`, `abbreviation`) VALUES
(0, NULL, NULL),
(1, 'Bachelor of Science', 'B.Sc.'),
(2, 'Master of Science', 'M.Sc.');

-- --------------------------------------------------------

--
-- Table structure for table `equivalence_course`
--

DROP TABLE IF EXISTS `equivalence_course`;
CREATE TABLE IF NOT EXISTS `equivalence_course` (
  `equivalence_id` int(10) UNSIGNED NOT NULL,
  `course_id` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`equivalence_id`,`course_id`),
  KEY `fk_course_id` (`course_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `equivalence_course`
--

INSERT INTO `equivalence_course` (`equivalence_id`, `course_id`) VALUES
(99, 8),
(100, 8),
(101, 8),
(102, 15);

-- --------------------------------------------------------

--
-- Table structure for table `equivalent_subjects`
--

DROP TABLE IF EXISTS `equivalent_subjects`;
CREATE TABLE IF NOT EXISTS `equivalent_subjects` (
  `equivalence_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `home_subject_id` int(10) UNSIGNED NOT NULL,
  `foreign_subject_id` int(10) UNSIGNED NOT NULL,
  `status_id` int(10) UNSIGNED DEFAULT NULL,
  `signed_by_prof_id` int(10) UNSIGNED DEFAULT NULL,
  `accepted_at` datetime DEFAULT NULL,
  `prof_doc_num` varchar(45) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `created_by_user_id` int(10) UNSIGNED DEFAULT NULL,
  `updated_by_user_id` int(10) UNSIGNED DEFAULT NULL,
  `valid_degree_id` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`equivalence_id`),
  KEY `fk_equivalent_subjects_status1_idx` (`status_id`),
  KEY `fk_equivalent_subjects_user1_idx` (`created_by_user_id`),
  KEY `fk_equivalent_subjects_user2_idx` (`updated_by_user_id`),
  KEY `fk_equivalent_subjects_subject1_idx` (`home_subject_id`),
  KEY `fk_equivalent_subjects_subject2_idx` (`foreign_subject_id`),
  KEY `fk_equivalent_subjects_professor1_idx` (`signed_by_prof_id`),
  KEY `fk_valid_degree_id` (`valid_degree_id`)
) ENGINE=InnoDB AUTO_INCREMENT=142 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `equivalent_subjects`
--

INSERT INTO `equivalent_subjects` (`equivalence_id`, `home_subject_id`, `foreign_subject_id`, `status_id`, `signed_by_prof_id`, `accepted_at`, `prof_doc_num`, `created_at`, `updated_at`, `created_by_user_id`, `updated_by_user_id`, `valid_degree_id`) VALUES
(1, 1, 3, 2, 1, NULL, NULL, '2019-09-25 05:17:51', '2020-05-18 11:32:43', NULL, NULL, 2),
(2, 2, 4, 2, 2, NULL, NULL, '2019-09-25 05:18:31', '2020-05-18 11:32:43', NULL, NULL, 2),
(3, 5, 6, 3, NULL, NULL, NULL, '2019-09-26 11:20:27', '2020-05-18 11:32:43', NULL, NULL, 2),
(4, 7, 61, 2, NULL, NULL, NULL, '2020-04-20 08:34:28', '2020-05-18 11:32:43', NULL, NULL, 1),
(5, 8, 62, 2, NULL, NULL, NULL, '2020-04-20 08:34:28', '2020-05-18 11:32:43', NULL, NULL, 1),
(6, 9, 63, 2, NULL, NULL, NULL, '2020-04-20 08:34:28', '2020-05-18 11:32:43', NULL, NULL, 1),
(7, 10, 64, 2, NULL, NULL, NULL, '2020-04-20 08:34:28', '2020-05-18 11:32:43', NULL, NULL, 1),
(8, 11, 65, 2, NULL, NULL, NULL, '2020-04-20 08:34:28', '2020-05-18 11:32:43', NULL, NULL, 1),
(9, 12, 65, 2, NULL, NULL, NULL, '2020-04-20 08:34:28', '2020-05-18 11:32:43', NULL, NULL, 1),
(10, 13, 66, 2, NULL, NULL, NULL, '2020-04-20 08:34:28', '2020-05-18 11:32:43', NULL, NULL, 1),
(11, 14, 67, 2, NULL, NULL, NULL, '2020-04-20 08:34:28', '2020-05-18 11:32:43', NULL, NULL, 1),
(12, 15, 67, 2, NULL, NULL, NULL, '2020-04-20 08:34:28', '2020-05-18 11:32:43', NULL, NULL, 1),
(13, 16, 68, 2, NULL, NULL, NULL, '2020-04-20 08:34:28', '2020-05-18 11:32:43', NULL, NULL, 1),
(14, 17, 69, 2, NULL, NULL, NULL, '2020-04-20 08:34:28', '2020-05-18 11:32:43', NULL, NULL, 1),
(15, 18, 69, 2, NULL, NULL, NULL, '2020-04-20 08:34:28', '2020-05-18 11:32:43', NULL, NULL, 1),
(16, 19, 70, 2, NULL, NULL, NULL, '2020-04-20 08:34:28', '2020-05-18 11:32:43', NULL, NULL, 1),
(17, 20, 70, 2, NULL, NULL, NULL, '2020-04-20 08:34:28', '2020-05-18 11:32:43', NULL, NULL, 1),
(18, 21, 71, 2, NULL, NULL, NULL, '2020-04-20 08:34:28', '2020-05-18 11:32:43', NULL, NULL, 1),
(19, 22, 72, 2, NULL, NULL, NULL, '2020-04-20 08:34:28', '2020-05-18 11:32:43', NULL, NULL, 1),
(20, 23, 73, 2, NULL, NULL, NULL, '2020-04-20 08:34:28', '2020-05-18 11:32:43', NULL, NULL, 1),
(21, 24, 74, 2, NULL, NULL, NULL, '2020-04-20 08:34:28', '2020-05-18 11:32:43', NULL, NULL, 1),
(22, 25, 75, 2, NULL, NULL, NULL, '2020-04-20 08:34:28', '2020-05-18 11:32:43', NULL, NULL, 1),
(23, 26, 76, 2, NULL, NULL, NULL, '2020-04-20 08:34:28', '2020-05-18 11:32:43', NULL, NULL, 1),
(24, 27, 77, 2, NULL, NULL, NULL, '2020-04-20 08:34:28', '2020-05-18 11:32:43', NULL, NULL, 1),
(25, 28, 78, 2, NULL, NULL, NULL, '2020-04-20 08:34:28', '2020-05-18 11:32:43', NULL, NULL, 1),
(26, 29, 79, 2, NULL, NULL, NULL, '2020-04-20 08:34:28', '2020-05-18 11:32:43', NULL, NULL, 1),
(27, 29, 83, 2, NULL, NULL, NULL, '2020-04-20 08:34:28', '2020-05-18 11:32:43', NULL, NULL, 1),
(28, 30, 80, 2, NULL, NULL, NULL, '2020-04-20 08:34:28', '2020-05-18 11:32:43', NULL, NULL, 1),
(29, 31, 75, 2, NULL, NULL, NULL, '2020-04-20 08:34:28', '2020-05-18 11:32:43', NULL, NULL, 1),
(30, 32, 81, 2, NULL, NULL, NULL, '2020-04-20 08:34:28', '2020-05-18 11:32:43', NULL, NULL, 1),
(31, 33, 82, 2, NULL, NULL, NULL, '2020-04-20 08:34:28', '2020-05-18 11:32:43', NULL, NULL, 1),
(32, 34, 84, 2, NULL, NULL, NULL, '2020-04-20 08:34:28', '2020-05-18 11:32:43', NULL, NULL, 1),
(33, 35, 85, 2, NULL, NULL, NULL, '2020-04-20 08:34:28', '2020-05-18 11:32:43', NULL, NULL, 1),
(34, 36, 86, 2, NULL, NULL, NULL, '2020-04-20 08:34:28', '2020-05-18 11:32:43', NULL, NULL, 1),
(35, 36, 88, 2, NULL, NULL, NULL, '2020-04-20 08:34:28', '2020-05-18 11:32:43', NULL, NULL, 1),
(36, 37, 87, 2, NULL, NULL, NULL, '2020-04-20 08:34:28', '2020-05-18 11:32:43', NULL, NULL, 1),
(37, 39, 89, 3, NULL, NULL, NULL, '2020-04-20 08:34:28', '2020-05-18 11:32:43', NULL, NULL, 1),
(38, 40, 90, 3, NULL, NULL, NULL, '2020-04-20 08:34:28', '2020-05-18 11:32:43', NULL, NULL, 1),
(39, 41, 90, 3, NULL, NULL, NULL, '2020-04-20 08:34:28', '2020-05-18 11:32:43', NULL, NULL, 1),
(40, 42, 91, 3, NULL, NULL, NULL, '2020-04-20 08:34:28', '2020-05-18 11:32:43', NULL, NULL, 1),
(41, 43, 91, 3, NULL, NULL, NULL, '2020-04-20 08:34:28', '2020-05-18 11:32:43', NULL, NULL, 1),
(42, 44, 92, 3, NULL, NULL, NULL, '2020-04-20 08:34:28', '2020-05-18 11:32:43', NULL, NULL, 1),
(43, 45, 93, 3, NULL, NULL, NULL, '2020-04-20 08:34:28', '2020-05-18 11:32:43', NULL, NULL, 1),
(44, 46, 93, 3, NULL, NULL, NULL, '2020-04-20 08:34:28', '2020-05-18 11:32:43', NULL, NULL, 1),
(45, 47, 94, 3, NULL, NULL, NULL, '2020-04-20 08:34:28', '2020-05-18 11:32:43', NULL, NULL, 1),
(46, 48, 95, 3, NULL, NULL, NULL, '2020-04-20 08:34:28', '2020-05-18 11:32:43', NULL, NULL, 1),
(47, 101, 141, 2, NULL, NULL, NULL, '2020-06-03 14:25:55', NULL, NULL, NULL, 2),
(48, 102, 142, 2, NULL, NULL, NULL, '2020-06-03 14:25:55', NULL, NULL, NULL, 2),
(49, 103, 142, 2, NULL, NULL, NULL, '2020-06-03 14:25:55', NULL, NULL, NULL, 2),
(50, 104, 144, 2, NULL, NULL, NULL, '2020-06-03 14:25:55', NULL, NULL, NULL, 2),
(51, 105, 144, 2, NULL, NULL, NULL, '2020-06-03 14:25:55', NULL, NULL, NULL, 2),
(52, 106, 145, 2, NULL, NULL, NULL, '2020-06-03 14:25:55', NULL, NULL, NULL, 2),
(53, 107, 146, 2, NULL, NULL, NULL, '2020-06-03 14:25:55', NULL, NULL, NULL, 2),
(54, 108, 147, 2, NULL, NULL, NULL, '2020-06-03 14:25:55', NULL, NULL, NULL, 2),
(55, 109, 147, 2, NULL, NULL, NULL, '2020-06-03 14:25:55', NULL, NULL, NULL, 2),
(56, 110, 148, 2, NULL, NULL, NULL, '2020-06-03 14:25:55', NULL, NULL, NULL, 2),
(57, 111, 142, 2, NULL, NULL, NULL, '2020-06-03 14:25:55', NULL, NULL, NULL, 2),
(58, 112, 149, 2, NULL, NULL, NULL, '2020-06-03 14:25:55', NULL, NULL, NULL, 2),
(59, 1, 4, 2, NULL, NULL, NULL, '2020-06-03 14:25:55', NULL, NULL, NULL, 2),
(60, 113, 150, 2, NULL, NULL, NULL, '2020-06-03 14:25:55', NULL, NULL, NULL, 2),
(61, 36, 86, 2, NULL, NULL, NULL, '2020-06-03 14:25:55', NULL, NULL, NULL, 2),
(62, 36, 88, 2, NULL, NULL, NULL, '2020-06-03 14:25:55', NULL, NULL, NULL, 2),
(63, 37, 87, 2, NULL, NULL, NULL, '2020-06-03 14:25:55', NULL, NULL, NULL, 2),
(91, 125, 151, 2, NULL, NULL, NULL, '2020-06-03 14:43:16', NULL, NULL, NULL, 2),
(92, 126, 152, 2, NULL, NULL, NULL, '2020-06-03 14:43:16', NULL, NULL, NULL, 2),
(93, 169, 153, 2, NULL, NULL, NULL, '2020-06-03 14:43:16', NULL, NULL, NULL, 2),
(94, 127, 154, 2, NULL, NULL, NULL, '2020-06-03 14:43:16', NULL, NULL, NULL, 2),
(95, 128, 155, 2, NULL, NULL, NULL, '2020-06-03 14:43:16', NULL, NULL, NULL, 2),
(96, 129, 156, 2, NULL, NULL, NULL, '2020-06-03 14:43:16', NULL, NULL, NULL, 2),
(97, 130, 157, 2, NULL, NULL, NULL, '2020-06-03 14:43:16', NULL, NULL, NULL, 2),
(98, 131, 158, 2, NULL, NULL, NULL, '2020-06-03 14:43:16', NULL, NULL, NULL, 2),
(99, 133, 170, 2, NULL, NULL, NULL, '2020-06-03 14:43:16', NULL, NULL, NULL, 2),
(100, 134, 156, 2, NULL, NULL, NULL, '2020-06-03 14:43:16', NULL, NULL, NULL, 2),
(101, 135, 147, 2, NULL, NULL, NULL, '2020-06-03 14:43:16', NULL, NULL, NULL, 2),
(102, 139, 159, 2, NULL, NULL, NULL, '2020-06-03 14:43:16', NULL, NULL, NULL, 2),
(103, 136, 148, 2, NULL, NULL, NULL, '2020-06-03 14:43:16', NULL, NULL, NULL, 2),
(104, 137, 148, 2, NULL, NULL, NULL, '2020-06-03 14:43:16', NULL, NULL, NULL, 2),
(105, 138, 144, 2, NULL, NULL, NULL, '2020-06-03 14:43:16', NULL, NULL, NULL, 2),
(106, 5, 168, 3, NULL, NULL, NULL, '2020-06-03 14:43:16', NULL, NULL, NULL, 2),
(107, 114, 167, 3, NULL, NULL, NULL, '2020-06-03 14:43:16', NULL, NULL, NULL, 2),
(108, 115, 166, 3, NULL, NULL, NULL, '2020-06-03 14:43:16', NULL, NULL, NULL, 2),
(109, 116, 151, 3, NULL, NULL, NULL, '2020-06-03 14:43:16', NULL, NULL, NULL, 2),
(110, 117, 158, 3, NULL, NULL, NULL, '2020-06-03 14:43:16', NULL, NULL, NULL, 2),
(111, 118, 165, 3, NULL, NULL, NULL, '2020-06-03 14:43:16', NULL, NULL, NULL, 2),
(112, 119, 164, 3, NULL, NULL, NULL, '2020-06-03 14:43:16', NULL, NULL, NULL, 2),
(113, 120, 163, 3, NULL, NULL, NULL, '2020-06-03 14:43:16', NULL, NULL, NULL, 2),
(114, 121, 145, 3, NULL, NULL, NULL, '2020-06-03 14:43:16', NULL, NULL, NULL, 2),
(115, 122, 162, 3, NULL, NULL, NULL, '2020-06-03 14:43:16', NULL, NULL, NULL, 2),
(116, 123, 161, 3, NULL, NULL, NULL, '2020-06-03 14:43:16', NULL, NULL, NULL, 2),
(117, 124, 160, 3, NULL, NULL, NULL, '2020-06-03 14:43:16', NULL, NULL, NULL, 2),
(118, 14, 249, 2, NULL, NULL, NULL, '2020-06-14 20:12:38', NULL, NULL, NULL, 0),
(119, 29, 250, 2, NULL, NULL, NULL, '2020-06-14 20:12:38', NULL, NULL, NULL, 0),
(120, 15, 249, 2, NULL, NULL, NULL, '2020-06-14 20:12:38', NULL, NULL, NULL, 0),
(121, 26, 254, 2, NULL, NULL, NULL, '2020-06-14 20:12:38', NULL, NULL, NULL, 0),
(122, 36, 255, 2, NULL, NULL, NULL, '2020-06-14 20:12:38', NULL, NULL, NULL, 0),
(123, 36, 256, 2, NULL, NULL, NULL, '2020-06-14 20:12:38', NULL, NULL, NULL, 0),
(124, 37, 257, 2, NULL, NULL, NULL, '2020-06-14 20:12:38', NULL, NULL, NULL, 0),
(125, 26, 178, 2, NULL, NULL, NULL, '2020-06-14 20:18:08', NULL, NULL, NULL, 0),
(126, 14, 181, 2, NULL, NULL, NULL, '2020-06-14 20:18:08', NULL, NULL, NULL, 0),
(127, 22, 183, 2, NULL, NULL, NULL, '2020-06-14 20:18:08', NULL, NULL, NULL, 0),
(128, 36, 184, 2, NULL, NULL, NULL, '2020-06-14 20:18:08', NULL, NULL, NULL, 0),
(129, 36, 185, 2, NULL, NULL, NULL, '2020-06-14 20:18:08', NULL, NULL, NULL, 0),
(130, 37, 186, 2, NULL, NULL, NULL, '2020-06-14 20:18:08', NULL, NULL, NULL, 0),
(131, 36, 255, 2, NULL, NULL, NULL, '2020-06-14 20:21:29', NULL, NULL, NULL, 0),
(132, 36, 256, 2, NULL, NULL, NULL, '2020-06-14 20:21:29', NULL, NULL, NULL, 0),
(133, 37, 257, 2, NULL, NULL, NULL, '2020-06-14 20:21:29', NULL, NULL, NULL, 0),
(134, 290, 274, 2, NULL, NULL, NULL, '2020-06-14 20:23:48', NULL, NULL, NULL, 0),
(135, 290, 275, 2, NULL, NULL, NULL, '2020-06-14 20:23:48', NULL, NULL, NULL, 0),
(136, 2, 211, 2, NULL, NULL, NULL, '2020-06-14 20:27:10', NULL, NULL, NULL, 0),
(137, 2, 216, 2, NULL, NULL, NULL, '2020-06-14 20:27:10', NULL, NULL, NULL, 0),
(138, 290, 213, 2, NULL, NULL, NULL, '2020-06-14 20:27:10', NULL, NULL, NULL, 0),
(139, 36, 184, 2, NULL, NULL, NULL, '2020-06-14 20:27:10', NULL, NULL, NULL, 0),
(140, 36, 185, 2, NULL, NULL, NULL, '2020-06-14 20:27:10', NULL, NULL, NULL, 0),
(141, 37, 186, 2, NULL, NULL, NULL, '2020-06-14 20:27:10', NULL, NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `exchange`
--

DROP TABLE IF EXISTS `exchange`;
CREATE TABLE IF NOT EXISTS `exchange` (
  `exchange_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `application_id` int(10) UNSIGNED DEFAULT NULL,
  `foreign_address_id` int(10) UNSIGNED DEFAULT NULL,
  `foreign_uni_id` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`exchange_id`) USING BTREE,
  KEY `fk_exchange_application1_idx` (`application_id`),
  KEY `fk_exchange_address1_idx` (`foreign_address_id`),
  KEY `fk_foreign_uni_id` (`foreign_uni_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `exchange`
--

INSERT INTO `exchange` (`exchange_id`, `application_id`, `foreign_address_id`, `foreign_uni_id`) VALUES
(1, 24, NULL, 2);

-- --------------------------------------------------------

--
-- Table structure for table `exchanged_equivalence`
--

DROP TABLE IF EXISTS `exchanged_equivalence`;
CREATE TABLE IF NOT EXISTS `exchanged_equivalence` (
  `exchanged_id` int(10) UNSIGNED NOT NULL,
  `equivalence_id` int(10) UNSIGNED NOT NULL,
  `credits_received` decimal(6,2) UNSIGNED NOT NULL DEFAULT '0.00',
  `grade_received` decimal(6,2) UNSIGNED NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`exchanged_id`,`equivalence_id`),
  KEY `fk_exchanged_equivalence_equivalent_subjects1_idx` (`equivalence_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `exchange_checklist`
--

DROP TABLE IF EXISTS `exchange_checklist`;
CREATE TABLE IF NOT EXISTS `exchange_checklist` (
  `step_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `step_name` varchar(255) NOT NULL,
  `foreign_uni_id` int(10) UNSIGNED NOT NULL,
  `exchange_stage_id` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`step_id`),
  KEY `foreign_key_foreign_uni_id` (`foreign_uni_id`),
  KEY `foreign_key_exchange_stage_id` (`exchange_stage_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `exchange_checklist`
--

INSERT INTO `exchange_checklist` (`step_id`, `step_name`, `foreign_uni_id`, `exchange_stage_id`) VALUES
(1, 'Learning Agreement', 1, 1),
(2, 'Visa Application', 1, 1),
(3, 'Flight Booking', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `exchange_checklist_deadline`
--

DROP TABLE IF EXISTS `exchange_checklist_deadline`;
CREATE TABLE IF NOT EXISTS `exchange_checklist_deadline` (
  `step_id` int(10) UNSIGNED NOT NULL,
  `deadline` datetime DEFAULT NULL,
  `exchange_period_id` int(10) UNSIGNED NOT NULL,
  `beginn` datetime NOT NULL,
  PRIMARY KEY (`step_id`),
  KEY `foreign_key_exchange_period_id` (`exchange_period_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `exchange_checklist_deadline`
--

INSERT INTO `exchange_checklist_deadline` (`step_id`, `deadline`, `exchange_period_id`, `beginn`) VALUES
(1, '2020-07-01 23:59:59', 1, '2020-06-15 08:00:00'),
(2, '2020-08-01 23:59:59', 1, '2020-07-01 08:00:00'),
(3, '2020-08-15 23:59:59', 1, '2020-08-01 08:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `exchange_checklist_student`
--

DROP TABLE IF EXISTS `exchange_checklist_student`;
CREATE TABLE IF NOT EXISTS `exchange_checklist_student` (
  `exchange_id` int(10) UNSIGNED NOT NULL,
  `step_id` int(10) UNSIGNED NOT NULL,
  KEY `foreign_key_exchange_id` (`exchange_id`),
  KEY `foreign_key_checklist_step_id` (`step_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `exchange_checklist_student`
--

INSERT INTO `exchange_checklist_student` (`exchange_id`, `step_id`) VALUES
(1, 1),
(1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `exchange_period`
--

DROP TABLE IF EXISTS `exchange_period`;
CREATE TABLE IF NOT EXISTS `exchange_period` (
  `period_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `exchange_semester` varchar(255) NOT NULL,
  `semester_begin` date NOT NULL,
  `semester_end` date NOT NULL,
  `application_begin` datetime NOT NULL,
  `application_end` datetime NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_on` timestamp NOT NULL ON UPDATE CURRENT_TIMESTAMP,
  `min_success_factor` decimal(6,3) NOT NULL DEFAULT '0.000',
  PRIMARY KEY (`period_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `exchange_period`
--

INSERT INTO `exchange_period` (`period_id`, `exchange_semester`, `semester_begin`, `semester_end`, `application_begin`, `application_end`, `created_on`, `updated_on`, `min_success_factor`) VALUES
(1, 'WS20/21', '2020-10-01', '2021-03-30', '2020-05-01 00:00:00', '2020-07-01 18:00:00', '2020-05-14 17:14:03', '2020-06-02 09:25:32', '0.000');

-- --------------------------------------------------------

--
-- Table structure for table `exchange_stages`
--

DROP TABLE IF EXISTS `exchange_stages`;
CREATE TABLE IF NOT EXISTS `exchange_stages` (
  `stage_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `stage_name` varchar(255) NOT NULL,
  PRIMARY KEY (`stage_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `exchange_stages`
--

INSERT INTO `exchange_stages` (`stage_id`, `stage_name`) VALUES
(1, 'Before Departure'),
(2, 'Upon Arrival'),
(3, 'During Exchange'),
(4, 'After Exchange');

-- --------------------------------------------------------

--
-- Table structure for table `intention`
--

DROP TABLE IF EXISTS `intention`;
CREATE TABLE IF NOT EXISTS `intention` (
  `intention_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`intention_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `intention`
--

INSERT INTO `intention` (`intention_id`, `name`) VALUES
(1, 'Exchange'),
(2, 'Double Degree');

-- --------------------------------------------------------

--
-- Table structure for table `priority`
--

DROP TABLE IF EXISTS `priority`;
CREATE TABLE IF NOT EXISTS `priority` (
  `application_id` int(10) UNSIGNED NOT NULL,
  `first_uni_id` int(10) UNSIGNED NOT NULL,
  `second_uni_id` int(10) UNSIGNED DEFAULT NULL,
  `third_uni_id` int(10) UNSIGNED DEFAULT NULL,
  PRIMARY KEY (`application_id`),
  KEY `fk_priority_university1_idx` (`first_uni_id`),
  KEY `fk_priority_university2_idx` (`second_uni_id`),
  KEY `fk_priority_university3_idx` (`third_uni_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `priority`
--

INSERT INTO `priority` (`application_id`, `first_uni_id`, `second_uni_id`, `third_uni_id`) VALUES
(6, 2, 3, 4),
(13, 2, 3, 4),
(24, 2, 3, 5);

-- --------------------------------------------------------

--
-- Table structure for table `professor`
--

DROP TABLE IF EXISTS `professor`;
CREATE TABLE IF NOT EXISTS `professor` (
  `professor_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `prof_surname` varchar(255) NOT NULL,
  `prof_firstname` varchar(255) NOT NULL,
  `prof_title` varchar(45) DEFAULT NULL,
  `university_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`professor_id`),
  KEY `fk_professor_university1_idx` (`university_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `professor`
--

INSERT INTO `professor` (`professor_id`, `prof_surname`, `prof_firstname`, `prof_title`, `university_id`, `created_at`) VALUES
(1, 'Schulz', 'Stephan', 'Prof. Dr.', 4, '2019-09-24 17:35:28'),
(2, 'Haep', 'Stefan', 'Dr.', 4, '2019-09-24 17:47:32'),
(3, 'Schramm', 'Dieter', 'Prof. Dr.', 4, '2019-09-26 11:16:30');

-- --------------------------------------------------------

--
-- Table structure for table `reset_password`
--

DROP TABLE IF EXISTS `reset_password`;
CREATE TABLE IF NOT EXISTS `reset_password` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `password_code` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `reset_password`
--

INSERT INTO `reset_password` (`user_id`, `password_code`, `created_at`) VALUES
(1, '5d40bdf2872f5ef2a53648c8a33f3633062605d6', '2020-05-15 08:40:49');

-- --------------------------------------------------------

--
-- Table structure for table `reviewed_application`
--

DROP TABLE IF EXISTS `reviewed_application`;
CREATE TABLE IF NOT EXISTS `reviewed_application` (
  `application_id` int(10) UNSIGNED NOT NULL,
  `application_status_id` int(10) UNSIGNED NOT NULL,
  `reviewed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `reviewed_by_user_id` int(10) UNSIGNED NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `comment` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`application_id`),
  KEY `fk_reviewed_application_user1_idx` (`reviewed_by_user_id`),
  KEY `fk_reviewed_application_status1_idx` (`application_status_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `salutation`
--

DROP TABLE IF EXISTS `salutation`;
CREATE TABLE IF NOT EXISTS `salutation` (
  `salutation_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `nameEng` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`salutation_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `salutation`
--

INSERT INTO `salutation` (`salutation_id`, `name`, `nameEng`) VALUES
(1, 'Frau', 'Ms'),
(2, 'Herr', 'Mr');

-- --------------------------------------------------------

--
-- Table structure for table `securitytoken`
--

DROP TABLE IF EXISTS `securitytoken`;
CREATE TABLE IF NOT EXISTS `securitytoken` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(10) UNSIGNED NOT NULL,
  `identifier` varchar(255) NOT NULL,
  `securitytoken` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk_securitytoken_user1_idx` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `securitytoken`
--

INSERT INTO `securitytoken` (`id`, `user_id`, `identifier`, `securitytoken`, `created_at`) VALUES
(1, 1, '9b6f5835816bc9a6b766c7222d0213b9', '31947eab99fc7723fe5ae80697c5d6b888cf680d', '2020-05-14 16:23:44'),
(2, 1, '305a2749b6cb0dac8544e08b22d686e8', 'b76892747a12464380a4392048f52ef140873a16', '2020-05-15 08:44:47'),
(3, 1, 'e09c6e1b4752c2d4b542a5f3299803b4', '2eab45a72d705d4cc5d7a05179f29bd3182c703b', '2020-05-15 11:20:15'),
(4, 1, 'cb69a1df0e768bda20926f4b5bfb4126', 'edc40d9fcba01383ce1ea42de66e2b07abcbfaf4', '2020-05-15 16:29:46'),
(5, 1, '068178358d2e7db6375b6b4ba71c559e', '17d3f2378947dd4dc0c24e12bd457fa04be5c1ff', '2020-05-15 17:36:13'),
(6, 1, '2098fa9b137a3509fb1a8b705c62c907', 'fb3c3412d549e534cb952e68fed858113f2e589f', '2020-05-15 17:38:19'),
(7, 1, 'e1ae70019fa1c955f6b3659d6c8e6677', 'b02861a825685da8424711f5a6ab300984e262ff', '2020-05-15 17:47:12'),
(8, 1, '937881e3c08927dadc780cc31c5f5d81', '05c00e8ff04d8f89d7e6d05cae475d988a42fdef', '2020-05-16 22:37:49'),
(9, 1, '38a56595c48df8f7ab33ae2f302ce659', '369cbcd6cbdad0f9ce3c0152e8fc3732448e18aa', '2020-05-16 22:41:33'),
(10, 1, '9393e78290130f94e7661854a82ab728', 'd3d5cd5db4eff3fc61539d3fb0cf126c611c8528', '2020-05-17 11:32:17'),
(11, 1, '8591fb567e79dc1b55babfeb768ba7fb', 'aa885ac80f23d9273bfa64ac3c1ddb01f43a36d0', '2020-05-17 16:47:25'),
(12, 1, 'dcd904b4d522fbd1a137b4e09ebbc7e5', '75e55aae5933bdc813987c20813e28ba4c51dd76', '2020-05-18 07:36:29'),
(13, 1, '8ac5479b731256a244858661e88f01a4', '3b85711b17cf7ac9f2f45db19e029fd26a53e1fe', '2020-05-18 07:38:41'),
(14, 1, '8762d0ab5b65478e5ffd95e3bcaff9d8', 'cf0390a0c2e10562119092789f2ab4a5e72e6382', '2020-05-18 08:10:36'),
(15, 1, '4417d9c22998bab6a4185e751b418984', '3368406d9a46813a1ac2b0c93aa5e4866c1dbd8c', '2020-05-18 12:08:11'),
(16, 4, '0da65c3212d268d766411ab6e5840193', '030afa19540545b09644b5c199ad63315a1ceac9', '2020-05-18 13:54:15'),
(17, 1, '18078854543df961c007f235b5d6f440', '5d3bdce16ede88fbe784c4bedf476518af5c7fbb', '2020-05-22 19:05:52'),
(19, 1, '500e79948592a05c4d75cb74276760de', 'a56a16a8ffdf63886d6a886c9f225e7ad7d4c565', '2020-05-25 08:21:51'),
(20, 6, 'b51a8d2394869e378b71feda8598f0b2', '349ede2e154e718bdaabbdabcc3feafd3051d8b2', '2020-05-25 09:23:13'),
(21, 8, '834158731271c82bc271f99057742cac', 'b281b339eff27e331d98dee84dc2b2be3486790d', '2020-05-27 09:41:16'),
(22, 1, '8a1f3689176c7bcf95238a7154e8fb6c', 'dd234dfcccb6be3a200dfeaf298a753b9fef08b4', '2020-05-27 13:00:03'),
(23, 1, '2a3b61193286ea3d06e7ef5dfd359ca2', '7da46e7db4635ad40f6325652feb6b847f738476', '2020-06-02 10:42:26'),
(24, 1, '01956b106f36b68efb5a67a626540825', 'b9f4331caee08d8ae90749ea96b8f85ec95ae3f4', '2020-06-02 10:43:20'),
(25, 1, 'c7f97edb09b2492786a7a24088229051', '19dcc7704c3e817cba47d73a1de6c8ea617b61e3', '2020-06-02 11:23:36'),
(26, 1, '9a4828c6c46080759f411bb7f13d07a6', '877ffc15d5c88c036bd10d8ae336934ee84b7717', '2020-06-03 07:30:30'),
(27, 1, '9f582739aad28f74ca5be20b72039079', '458ea1f96e4ec0b1d4f5bc70a5815d8a6cda71d1', '2020-06-03 07:31:09'),
(28, 1, '25e73c9e9d37ed7d9fed5913082cf137', '4995eb42bce6dd6079e35513c3e669c30b0b3e13', '2020-06-03 19:17:35');

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

DROP TABLE IF EXISTS `status`;
CREATE TABLE IF NOT EXISTS `status` (
  `status_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`status_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`status_id`, `name`) VALUES
(1, 'Pending'),
(2, 'Approved'),
(3, 'Declined');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

DROP TABLE IF EXISTS `student`;
CREATE TABLE IF NOT EXISTS `student` (
  `student_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(10) UNSIGNED NOT NULL,
  `birthdate` date NOT NULL,
  `nationality_country_id` int(10) UNSIGNED NOT NULL,
  `home_address_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`student_id`) USING BTREE,
  KEY `fk_student_user1_idx` (`user_id`),
  KEY `fk_student_country1_idx` (`nationality_country_id`),
  KEY `fk_student_address1_idx` (`home_address_id`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`student_id`, `user_id`, `birthdate`, `nationality_country_id`, `home_address_id`, `created_at`, `updated_at`) VALUES
(12, 1, '2020-05-27', 21, 5, '2020-05-14 18:45:29', '0000-00-00 00:00:00'),
(19, 4, '2020-05-20', 102, 12, '2020-05-18 14:45:56', NULL),
(20, 1, '2020-05-27', 21, NULL, '2020-05-23 21:42:43', NULL),
(21, 1, '2020-05-27', 21, NULL, '2020-05-23 21:45:09', NULL),
(22, 1, '2020-05-27', 21, NULL, '2020-05-23 22:15:20', NULL),
(23, 6, '2020-05-28', 19, NULL, '2020-05-25 09:25:44', NULL),
(24, 6, '2020-05-28', 19, NULL, '2020-05-25 09:31:55', NULL),
(25, 6, '2020-05-28', 19, NULL, '2020-05-25 14:27:12', NULL),
(26, 6, '2020-05-28', 19, NULL, '2020-05-25 14:31:37', NULL),
(27, 8, '2020-05-30', 18, NULL, '2020-05-27 09:45:27', NULL),
(28, 1, '2020-05-27', 21, NULL, '2020-05-29 10:36:09', NULL),
(31, 1, '2020-05-27', 21, NULL, '2020-06-02 13:05:12', NULL),
(32, 1, '2020-05-27', 21, NULL, '2020-06-02 13:19:26', NULL),
(33, 1, '2020-05-27', 21, NULL, '2020-06-02 13:58:50', NULL),
(34, 1, '2020-05-27', 21, NULL, '2020-06-02 14:01:45', NULL),
(35, 1, '2020-05-27', 21, NULL, '2020-06-03 19:20:49', NULL),
(36, 1, '2020-06-27', 16, NULL, '2020-06-16 13:43:32', NULL),
(37, 1, '2020-06-19', 99, NULL, '2020-06-16 19:35:37', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `study_home`
--

DROP TABLE IF EXISTS `study_home`;
CREATE TABLE IF NOT EXISTS `study_home` (
  `application_id` int(10) UNSIGNED NOT NULL,
  `home_university_id` int(10) UNSIGNED DEFAULT NULL,
  `home_degree_id` int(10) UNSIGNED DEFAULT NULL,
  `home_course_id` int(10) UNSIGNED DEFAULT NULL,
  `home_matno` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `home_cgpa` decimal(5,3) UNSIGNED NOT NULL DEFAULT '0.000',
  `home_credits` decimal(10,3) UNSIGNED NOT NULL DEFAULT '0.000',
  `home_semester` int(10) UNSIGNED DEFAULT NULL,
  `home_enrollment_date` date DEFAULT NULL,
  PRIMARY KEY (`application_id`),
  KEY `fk_study_home_degree1_idx` (`home_degree_id`),
  KEY `fk_study_home_course1_idx` (`home_course_id`),
  KEY `fk_study_home_university1_idx` (`home_university_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `study_home`
--

INSERT INTO `study_home` (`application_id`, `home_university_id`, `home_degree_id`, `home_course_id`, `home_matno`, `home_cgpa`, `home_credits`, `home_semester`, `home_enrollment_date`) VALUES
(6, 12, 1, 47, '12347', '2.000', '124.000', 8, '2020-05-06'),
(13, 4, 1, 46, '12345', '1.000', '123.000', 3, '2020-05-27'),
(24, 4, 1, 42, '213456', '1.000', '123.000', 3, '2020-06-18');

--
-- Triggers `study_home`
--
DROP TRIGGER IF EXISTS `Calculate_SuccessFactor`;
DELIMITER $$
CREATE TRIGGER `Calculate_SuccessFactor` AFTER INSERT ON `study_home` FOR EACH ROW BEGIN
    	IF (NEW.home_semester > 1) THEN
        UPDATE application SET success_factor = 0.125 * NEW.home_credits / (NEW.home_cgpa * (NEW.home_semester - 1)) WHERE application_id = NEW.application_id;
        ELSE
        UPDATE application SET success_factor = 0 WHERE application_id = NEW.application_id;
    END IF;
END
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `update_successFactor`;
DELIMITER $$
CREATE TRIGGER `update_successFactor` AFTER UPDATE ON `study_home` FOR EACH ROW BEGIN
    	IF (NEW.home_semester > 1) THEN
        UPDATE application SET success_factor = 0.125 * NEW.home_credits / (NEW.home_cgpa * (NEW.home_semester - 1)) WHERE application_id = NEW.application_id;
        ELSE
        UPDATE application SET success_factor = 0 WHERE application_id = NEW.application_id;
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `study_host`
--

DROP TABLE IF EXISTS `study_host`;
CREATE TABLE IF NOT EXISTS `study_host` (
  `exchange_id` int(10) UNSIGNED NOT NULL,
  `foreign_uni_id` int(10) UNSIGNED DEFAULT NULL,
  `foreign_degree_id` int(10) UNSIGNED DEFAULT NULL,
  `foreign_course_id` int(10) UNSIGNED DEFAULT NULL,
  `foreign_num_planed_exams` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `foreign_matno` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`exchange_id`),
  KEY `fk_study_host_university1_idx` (`foreign_uni_id`),
  KEY `fk_study_host_degree1_idx` (`foreign_degree_id`),
  KEY `fk_study_host_course1_idx` (`foreign_course_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

DROP TABLE IF EXISTS `subject`;
CREATE TABLE IF NOT EXISTS `subject` (
  `subject_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `university_id` int(10) UNSIGNED DEFAULT NULL,
  `degree_id` int(10) UNSIGNED DEFAULT NULL,
  `course_id` int(10) UNSIGNED DEFAULT NULL,
  `prof_id` int(10) UNSIGNED DEFAULT NULL,
  `subject_code` varchar(45) DEFAULT NULL,
  `subject_title` varchar(255) NOT NULL,
  `subject_abbrev` varchar(45) DEFAULT NULL,
  `subject_credits` decimal(6,3) UNSIGNED DEFAULT '0.000',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`subject_id`),
  KEY `fk_subject_university1_idx` (`university_id`),
  KEY `fk_subject_degree1_idx` (`degree_id`),
  KEY `fk_subject_course1_idx` (`course_id`),
  KEY `fk_subject_professor1_idx` (`prof_id`)
) ENGINE=InnoDB AUTO_INCREMENT=291 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`subject_id`, `university_id`, `degree_id`, `course_id`, `prof_id`, `subject_code`, `subject_title`, `subject_abbrev`, `subject_credits`, `created_at`, `updated_at`) VALUES
(1, 4, 2, 1, 1, 'ZKB 40082', 'Verbrennungsmotoren', NULL, '4.000', '2019-09-24 17:27:39', '0000-00-00 00:00:00'),
(2, 4, 2, 1, 2, 'ZKB 40309', 'Air Pollution and Control', NULL, '4.000', '2019-09-24 17:49:56', '0000-00-00 00:00:00'),
(3, 2, 2, NULL, NULL, NULL, 'Energy Conversion Systems', NULL, '4.000', '2019-09-25 05:14:28', '2020-05-15 10:29:36'),
(4, 2, 2, NULL, NULL, NULL, 'Energy Recovery from waste and Biomass Fuels', '', '5.300', '2019-09-25 05:16:37', '2020-05-15 10:29:36'),
(5, 4, 2, NULL, 3, NULL, 'objektorientiere Methoden der Modellbildung und Simulation (Wahlbereich)', NULL, '3.000', '2019-09-26 11:17:27', '2020-05-15 10:29:36'),
(6, 2, 0, NULL, NULL, NULL, 'Mathematical Methods for Engineering Research', NULL, NULL, '2019-09-26 11:19:18', '2020-05-15 10:29:36'),
(7, 4, 1, 1, NULL, NULL, 'Thermodynamics 1 -inklusive Praktikum-', NULL, '5.000', '2020-04-20 07:22:06', '2020-05-15 10:29:36'),
(8, 4, 1, 1, NULL, NULL, 'Thermodynamics 2', NULL, '4.000', '2020-04-20 07:22:06', '2020-05-15 10:29:36'),
(9, 4, 1, 1, NULL, NULL, 'Maschinenelemente 2/ Machine Elements 2', NULL, '3.000', '2020-04-20 07:22:06', '2020-05-15 10:29:36'),
(10, 4, 1, 1, NULL, NULL, 'Baugruppenentwurf', NULL, '1.000', '2020-04-20 07:22:06', '2020-05-15 10:29:36'),
(11, 4, 1, 1, NULL, NULL, 'Produktentwurf', NULL, '3.000', '2020-04-20 07:22:06', '2020-05-15 10:29:36'),
(12, 4, 1, 1, NULL, NULL, 'Hausarbeit zum Produktentwurf', NULL, '2.000', '2020-04-20 07:22:06', '2020-05-15 10:29:36'),
(13, 4, 1, 1, NULL, NULL, 'Numerische Methoden für Ingenieure', NULL, '5.000', '2020-04-20 07:22:06', '2020-05-15 10:29:36'),
(14, 4, 1, 1, NULL, NULL, 'Regelungstechnik', NULL, '3.000', '2020-04-20 07:22:06', '2020-05-15 10:29:36'),
(15, 4, 1, 1, NULL, NULL, 'Einführung in die Automatisierungstechnik', NULL, '5.000', '2020-04-20 07:22:06', '2020-05-15 10:29:36'),
(16, 4, 1, 1, NULL, NULL, 'Systemdynamik', NULL, '2.000', '2020-04-20 07:22:06', '2020-05-15 10:29:36'),
(17, 4, 1, 1, NULL, NULL, 'Messtechnik ', NULL, '4.000', '2020-04-20 07:22:06', '2020-05-15 10:29:36'),
(18, 4, 1, 1, NULL, NULL, 'Introduction to Measurement Technology - inkluding Lab-', NULL, '5.000', '2020-04-20 07:22:06', '2020-05-15 10:29:36'),
(19, 4, 1, 1, NULL, NULL, 'Fundamentals of Electrical Engineering 1', NULL, '5.000', '2020-04-20 07:22:06', '2020-05-15 10:29:36'),
(20, 4, 1, 1, NULL, NULL, 'Grundlagen der Elektrotechnik 1', NULL, '7.000', '2020-04-20 07:22:06', '2020-05-15 10:29:36'),
(21, 4, 1, 1, NULL, NULL, 'Struktur von Mikrorechnern (ohne Praktikum) ', NULL, '3.000', '2020-04-20 07:22:06', '2020-05-15 10:29:36'),
(22, 4, 1, 1, NULL, NULL, 'Strukturdynamik', NULL, '4.000', '2020-04-20 07:22:06', '2020-05-15 10:29:36'),
(23, 4, 1, 1, NULL, NULL, 'Automobile Wertschöpfungskette', NULL, '3.000', '2020-04-20 07:22:06', '2020-05-15 10:29:36'),
(24, 4, 1, 1, NULL, NULL, 'Planung und Organisation', NULL, '4.000', '2020-04-20 07:22:06', '2020-05-15 10:29:36'),
(25, 4, 1, 1, NULL, NULL, 'Produktionsmanagement', NULL, '4.000', '2020-04-20 07:22:06', '2020-05-15 10:29:36'),
(26, 4, 1, 1, NULL, NULL, 'Project Management', NULL, '4.000', '2020-04-20 07:22:06', '2020-05-15 10:29:36'),
(27, 4, 1, 1, NULL, NULL, 'Operating Systems and Computer Networks', NULL, '3.000', '2020-04-20 07:22:06', '2020-05-15 10:29:36'),
(28, 4, 1, 1, NULL, NULL, 'Fluid Mechanics', NULL, '3.000', '2020-04-20 07:22:06', '2020-05-15 10:29:36'),
(29, 4, 1, 1, NULL, NULL, 'Kunststofftechnik', NULL, '4.000', '2020-04-20 07:22:06', '2020-05-15 10:29:36'),
(30, 4, 1, 1, NULL, NULL, 'Mathematics 3', NULL, '5.000', '2020-04-20 07:22:06', '2020-05-15 10:29:36'),
(31, 4, 1, 1, NULL, NULL, 'Project Management', NULL, '3.000', '2020-04-20 07:22:06', '2020-05-15 10:29:36'),
(32, 4, 1, 1, NULL, NULL, 'Fertigungslehre', NULL, '4.000', '2020-04-20 07:22:06', '2020-05-15 10:29:36'),
(33, 4, 1, 1, NULL, NULL, 'Verbrennungslehre', NULL, '4.000', '2020-04-20 07:22:06', '2020-05-15 10:29:36'),
(34, 4, 1, 1, NULL, NULL, 'Control Engineering (ohne Praktikum)', NULL, '3.000', '2020-04-20 07:22:06', '2020-05-15 10:29:36'),
(35, 4, 1, 1, NULL, NULL, 'Electronic Devices', NULL, '3.000', '2020-04-20 07:22:06', '2020-05-15 10:29:36'),
(36, 4, 0, 1, NULL, NULL, 'Sprach und Schlüsselkompetenz E1 Bereich', NULL, '2.000', '2020-04-20 07:22:06', '2020-06-03 14:07:40'),
(37, 4, 0, 1, NULL, NULL, 'Sprach und Schlüsselkompetenz E3 Bereich', NULL, '2.000', '2020-04-20 07:22:06', '2020-06-03 14:07:53'),
(38, 4, 1, 1, NULL, NULL, 'Bachelorarbeit', NULL, '0.000', '2020-04-20 07:22:06', '2020-05-15 10:29:36'),
(39, 4, 1, 1, NULL, NULL, 'Technische Darstellung', NULL, '5.000', '2020-04-20 07:22:06', '2020-05-15 10:29:36'),
(40, 4, 1, 1, NULL, NULL, 'Fundamentals of Electrical Engineering 2', NULL, '4.000', '2020-04-20 07:22:06', '2020-05-15 10:29:36'),
(41, 4, 1, 1, NULL, NULL, 'Grundlagen der Elektrotechnik 2', NULL, '7.000', '2020-04-20 07:22:06', '2020-05-15 10:29:36'),
(42, 4, 1, 1, NULL, NULL, 'Werkstoffkunde I1', NULL, '6.000', '2020-04-20 07:22:06', '2020-05-15 10:29:36'),
(43, 4, 1, 1, NULL, NULL, 'Werkstofftechnik I', NULL, '5.000', '2020-04-20 07:22:06', '2020-05-15 10:29:36'),
(44, 4, 1, 1, NULL, NULL, 'Mathematics 1', NULL, '6.000', '2020-04-20 07:22:06', '2020-05-15 10:29:36'),
(45, 4, 1, 1, NULL, NULL, 'Rechnergestützter Bauteilentwurf', NULL, '4.000', '2020-04-20 07:22:06', '2020-05-15 10:29:36'),
(46, 4, 1, 1, NULL, NULL, 'CAD', NULL, '2.000', '2020-04-20 07:22:06', '2020-05-15 10:29:36'),
(47, 4, 1, 1, NULL, NULL, 'Logistik und Materialfluss', NULL, '4.000', '2020-04-20 07:22:06', '2020-05-15 10:29:36'),
(48, 4, 1, 1, NULL, NULL, 'Electrical Machines', NULL, '4.000', '2020-04-20 07:22:06', '2020-05-15 10:29:36'),
(49, 4, 1, 1, NULL, NULL, 'Fluid Mechanics', NULL, '3.000', '2020-04-20 07:22:06', '2020-05-15 10:29:36'),
(50, 4, 1, 1, NULL, NULL, 'Projektarbeit', NULL, '0.000', '2020-04-20 07:22:06', '2020-05-15 10:29:36'),
(51, 4, 1, 1, NULL, NULL, 'Elektrotechnik', NULL, '0.000', '2020-04-20 07:22:06', '2020-05-15 10:29:36'),
(52, 4, 1, 1, NULL, NULL, 'Grundlagen des Marketing', NULL, '4.000', '2020-04-20 07:22:06', '2020-05-15 10:29:36'),
(53, 4, 1, 1, NULL, NULL, 'Mobilkommunikationstechnik', NULL, '3.000', '2020-04-20 07:22:06', '2020-05-15 10:29:36'),
(54, 4, 1, 1, NULL, NULL, 'Economics for Engineers', NULL, '2.000', '2020-04-20 07:22:06', '2020-05-15 10:29:36'),
(55, 4, 1, 1, NULL, NULL, 'Theory of Linear Systems', NULL, '4.000', '2020-04-20 07:22:06', '2020-05-15 10:29:36'),
(56, 4, 1, 1, NULL, NULL, 'Design Theory 3', NULL, '3.000', '2020-04-20 07:22:06', '2020-05-15 10:29:36'),
(57, 4, 1, 1, NULL, NULL, 'Metallurgie', NULL, '4.000', '2020-04-20 07:22:06', '2020-05-15 10:29:36'),
(58, 4, 1, 1, NULL, NULL, 'Moderne Produktionssysteme', NULL, '0.000', '2020-04-20 07:22:06', '2020-05-15 10:29:36'),
(59, 4, 1, 1, NULL, NULL, 'Produktionstechnik', NULL, '0.000', '2020-04-20 07:22:06', '2020-05-15 10:29:36'),
(60, 4, 1, 1, NULL, NULL, 'Technische Mechanik 1', NULL, '5.000', '2020-04-20 07:22:06', '2020-05-15 10:29:36'),
(61, 2, 1, 1, NULL, NULL, 'Thermodynamics and Heat Transfer', NULL, '5.300', '2020-04-20 07:22:06', '2020-05-15 10:29:36'),
(62, 2, 1, 1, NULL, NULL, 'Thermal System', NULL, '5.300', '2020-04-20 07:22:06', '2020-05-15 10:29:36'),
(63, 2, 1, 1, NULL, NULL, 'Machine Components Design', NULL, '5.300', '2020-04-20 07:22:06', '2020-05-15 10:29:36'),
(64, 2, 1, 1, NULL, NULL, 'Design Project', NULL, '5.300', '2020-04-20 07:22:06', '2020-05-15 10:29:36'),
(65, 2, 1, 1, NULL, NULL, 'Product Design', NULL, '5.300', '2020-04-20 07:22:06', '2020-05-15 10:29:36'),
(66, 2, 1, 1, NULL, NULL, 'Numerical Computations', NULL, '5.300', '2020-04-20 07:22:06', '2020-05-15 10:29:36'),
(67, 2, 1, 1, NULL, NULL, 'Control System Design', NULL, '5.300', '2020-04-20 07:22:06', '2020-05-15 10:29:36'),
(68, 2, 1, 1, NULL, NULL, 'Dynamics and Simulation Systems (including lab)', NULL, '5.300', '2020-04-20 07:22:06', '2020-05-15 10:29:36'),
(69, 2, 1, 1, NULL, NULL, 'Measurement and Instrumentation', NULL, '5.300', '2020-04-20 07:22:06', '2020-05-15 10:29:36'),
(70, 2, 1, 1, NULL, NULL, 'Electromagnetiv Fields and Waves', NULL, '5.700', '2020-04-20 07:22:06', '2020-05-15 10:29:36'),
(71, 2, 1, 1, NULL, NULL, 'Microprozessor and Microcomputer (including lab)', NULL, '5.300', '2020-04-20 07:22:06', '2020-05-15 10:29:36'),
(72, 2, 1, 1, NULL, NULL, 'Mechanical Vibration (no lab)', NULL, '5.300', '2020-04-20 07:22:06', '2020-05-15 10:29:36'),
(73, 2, 1, 1, NULL, NULL, 'Management of Manufacturing Strategy', NULL, '5.300', '2020-04-20 07:22:06', '2020-05-15 10:29:36'),
(74, 2, 1, 1, NULL, NULL, 'Engineering Economic and Entrepreneurship', NULL, '5.300', '2020-04-20 07:22:06', '2020-05-15 10:29:36'),
(75, 2, 1, 1, NULL, NULL, 'Production Planing and Control', NULL, '5.300', '2020-04-20 07:22:06', '2020-05-15 10:29:36'),
(76, 2, 1, 1, NULL, NULL, 'Engineering Management', NULL, '5.300', '2020-04-20 07:22:06', '2020-05-15 10:29:36'),
(77, 2, 1, 1, NULL, NULL, 'Operating Systems', NULL, '5.300', '2020-04-20 07:22:06', '2020-05-15 10:29:36'),
(78, 2, 1, 1, NULL, NULL, 'Fluid Mechanics', NULL, '5.300', '2020-04-20 07:22:06', '2020-05-15 10:29:36'),
(79, 2, 1, 1, NULL, NULL, 'Mechanics of Composite Processing', NULL, '5.300', '2020-04-20 07:22:06', '2020-05-15 10:29:36'),
(80, 2, 1, 1, NULL, NULL, 'Differential Equation', NULL, '5.300', '2020-04-20 07:22:06', '2020-05-15 10:29:36'),
(81, 2, 1, 1, NULL, NULL, 'Manufacturing Processes', NULL, '5.300', '2020-04-20 07:22:06', '2020-05-15 10:29:36'),
(82, 2, 1, 1, NULL, NULL, 'Combustions and Heat Systems', NULL, '4.000', '2020-04-20 07:22:06', '2020-05-15 10:29:36'),
(83, 2, 1, 1, NULL, NULL, 'Polymer Processing', NULL, '4.000', '2020-04-20 07:22:06', '2020-05-15 10:29:36'),
(84, 2, 1, 1, NULL, NULL, 'Control Engineering', NULL, '5.300', '2020-04-20 07:22:06', '2020-05-15 10:29:36'),
(85, 2, 1, 1, NULL, NULL, 'Analogue Electronics', NULL, '5.300', '2020-04-20 07:22:06', '2020-05-15 10:29:36'),
(86, 2, 1, 1, NULL, NULL, 'Language Course: English', NULL, '2.000', '2020-04-20 07:22:06', '2020-05-15 10:29:36'),
(87, 2, 1, 1, NULL, NULL, 'Cultural Course', NULL, '2.000', '2020-04-20 07:22:06', '2020-05-15 10:29:36'),
(88, 2, 1, 1, NULL, NULL, 'Language Course: Bahasa', NULL, '2.000', '2020-04-20 07:22:06', '2020-05-15 10:29:36'),
(89, 2, 1, 1, NULL, NULL, 'Engineering Design Graphic', NULL, '5.300', '2020-04-20 07:22:06', '2020-05-15 10:29:36'),
(90, 2, 1, 1, NULL, NULL, 'Circuit Theory 1', NULL, '5.700', '2020-04-20 07:22:06', '2020-05-15 10:29:36'),
(91, 2, 1, 1, NULL, NULL, 'Material Science', NULL, '4.000', '2020-04-20 07:22:06', '2020-05-15 10:29:36'),
(92, 2, 1, 1, NULL, NULL, 'Engineering Mathematics 1', NULL, '5.300', '2020-04-20 07:22:06', '2020-05-15 10:29:36'),
(93, 2, 1, 1, NULL, NULL, 'CAD/CAM', NULL, '5.300', '2020-04-20 07:22:06', '2020-05-15 10:29:36'),
(94, 2, 1, 1, NULL, NULL, 'Supply Chain Management', NULL, '0.000', '2020-04-20 07:22:06', '2020-05-15 10:29:36'),
(95, 2, 1, 1, NULL, NULL, 'Machine and Electronics Power', NULL, '0.000', '2020-04-20 07:22:06', '2020-05-15 10:29:36'),
(96, 2, 1, 1, NULL, NULL, 'Engineering Economics', NULL, '0.000', '2020-04-20 07:22:06', '2020-05-15 10:29:36'),
(97, 2, 1, 1, NULL, NULL, 'Machine Components Design', NULL, '4.000', '2020-04-20 07:22:06', '2020-05-15 10:29:36'),
(98, 2, 1, 1, NULL, NULL, 'Metal processing Theory', NULL, '4.000', '2020-04-20 07:22:06', '2020-05-15 10:29:36'),
(99, 2, 1, 1, NULL, NULL, 'Current Manufacturing Systems', NULL, '0.000', '2020-04-20 07:22:06', '2020-05-15 10:29:36'),
(100, 2, 1, 1, NULL, NULL, 'Production Tools', NULL, '0.000', '2020-04-20 07:22:06', '2020-05-15 10:29:36'),
(101, 4, 2, NULL, NULL, NULL, 'Mechanical and Biological Waste treatment', NULL, '4.000', '2020-06-03 13:39:54', NULL),
(102, 4, 2, NULL, NULL, NULL, 'Advanced sensors, applications, interfacing and signal processing', NULL, '4.000', '2020-06-03 13:42:59', NULL),
(103, 4, 2, NULL, NULL, NULL, 'Mess- und Prüftechnik', NULL, '4.000', '2020-06-03 13:42:59', NULL),
(104, 4, 2, NULL, NULL, NULL, 'Regenerative Energietechniken', NULL, '4.000', '2020-06-03 13:42:59', NULL),
(105, 4, 2, NULL, NULL, NULL, 'Die Methode der finiten Elemente', NULL, '4.000', '2020-06-03 13:42:59', NULL),
(106, 4, 2, NULL, NULL, NULL, 'Rapid and Virtual Prototyping', NULL, '4.000', '2020-06-03 13:42:59', NULL),
(107, 4, 2, NULL, NULL, NULL, 'Wertorientierte Steuerung', NULL, '4.000', '2020-06-03 13:42:59', NULL),
(108, 4, 2, NULL, NULL, NULL, 'Water Treatment', NULL, '4.000', '2020-06-03 13:42:59', NULL),
(109, 4, 2, NULL, NULL, NULL, 'Water Treatment 1', NULL, '4.000', '2020-06-03 13:42:59', NULL),
(110, 4, 2, NULL, NULL, NULL, 'Global Aspects of Environmental Protection', NULL, '4.000', '2020-06-03 13:42:59', NULL),
(111, 4, 2, NULL, NULL, NULL, 'Experimentelle Methoden in der Maschinen- und Prozessdiagnose ', NULL, '4.000', '2020-06-03 13:42:59', NULL),
(112, 4, 2, NULL, NULL, NULL, 'Test and Reliability', NULL, '4.000', '2020-06-03 13:42:59', NULL),
(113, 4, 2, NULL, NULL, NULL, 'Silizium - Halbleiterfertigung', NULL, '4.000', '2020-06-03 13:42:59', NULL),
(114, 4, 2, NULL, NULL, NULL, 'Betriebswirtschaftslehre', NULL, '4.000', '2020-06-03 14:00:13', NULL),
(115, 4, 2, NULL, NULL, NULL, 'Instrumentelle Bewegungsanalyse', NULL, '5.000', '2020-06-03 14:00:13', NULL),
(116, 4, 2, NULL, NULL, NULL, 'Internationale Organisationsstrukturen und Vernetzung', NULL, '0.000', '2020-06-03 14:00:13', NULL),
(117, 4, 2, NULL, NULL, NULL, 'Selbstführung, Mitarbeiterführung und Team- führung', NULL, '4.000', '2020-06-03 14:00:13', NULL),
(118, 4, 2, NULL, NULL, NULL, 'Kommunikationsnetze', NULL, '4.000', '2020-06-03 14:00:13', NULL),
(119, 4, 2, NULL, NULL, NULL, 'Leistungselektronik', NULL, '4.000', '2020-06-03 14:00:13', NULL),
(120, 4, 2, NULL, NULL, NULL, 'Technische Schadenskunde / Failure Analysis', NULL, '0.000', '2020-06-03 14:00:13', NULL),
(121, 4, 2, NULL, NULL, NULL, 'Design-to-Cost and Quality Management', NULL, '0.000', '2020-06-03 14:00:13', NULL),
(122, 4, 2, NULL, NULL, NULL, 'Absorption', NULL, '4.000', '2020-06-03 14:00:13', NULL),
(123, 4, 2, NULL, NULL, NULL, 'Numerics and Flow Simulation', NULL, '4.000', '2020-06-03 14:00:13', NULL),
(124, 4, 2, NULL, NULL, NULL, 'Strömungslehre 2', NULL, '4.000', '2020-06-03 14:00:13', NULL),
(125, 4, 2, NULL, NULL, NULL, 'International Economic Organization', NULL, '4.000', '2020-06-03 14:03:18', NULL),
(126, 4, 2, NULL, NULL, NULL, 'Econometrics for Master Students', NULL, '4.000', '2020-06-03 14:03:18', NULL),
(127, 4, 2, NULL, NULL, NULL, 'Internationale Finanzmärkte', NULL, '4.000', '2020-06-03 14:03:18', NULL),
(128, 4, 2, NULL, NULL, NULL, 'Empirische Forschungsmethoden', NULL, '4.000', '2020-06-03 14:03:18', NULL),
(129, 4, 2, NULL, NULL, NULL, 'Controlling', NULL, '4.000', '2020-06-03 14:03:18', NULL),
(130, 4, 2, NULL, NULL, NULL, 'Makroökonomie 2', NULL, '4.000', '2020-06-03 14:03:18', NULL),
(131, 4, 2, NULL, NULL, NULL, 'Steuerung der Mitarbeiterproduktivität ', NULL, '4.000', '2020-06-03 14:03:18', NULL),
(133, 4, 2, NULL, NULL, NULL, 'Mikroökonomie für interdisziplinäre Studiengänge', NULL, '4.000', '2020-06-03 14:03:18', NULL),
(134, 4, 2, NULL, NULL, NULL, 'Konzepte und Instrumente des Controllings', NULL, '4.000', '2020-06-03 14:03:18', NULL),
(135, 4, 2, NULL, NULL, NULL, 'Katalogfach \"Wasseraufbereitung\"', NULL, '4.000', '2020-06-03 14:03:18', NULL),
(136, 4, 2, NULL, NULL, NULL, 'Abfallwirtschaft 2 - Vertiefte Abfallwirtschaft', NULL, '6.000', '2020-06-03 14:03:18', NULL),
(137, 4, 2, NULL, NULL, NULL, 'Abfallwirtschaft 3 – Biologische Abfallbehandlung', NULL, '6.000', '2020-06-03 14:03:18', NULL),
(138, 4, 2, NULL, NULL, NULL, 'Lineare FEM oder Nichtlineare FEM ', NULL, '6.000', '2020-06-03 14:03:18', NULL),
(139, 4, 2, NULL, NULL, NULL, 'Projektmanagement', NULL, '4.000', '2020-06-03 14:05:52', NULL),
(141, 2, 2, NULL, NULL, NULL, 'Muncipal Solid Waste Management', NULL, '5.300', '2020-06-03 14:12:35', NULL),
(142, 2, 2, NULL, NULL, NULL, 'Advanced Instrumentation', NULL, '5.300', '2020-06-03 14:12:35', NULL),
(143, 2, 2, NULL, NULL, NULL, 'Combust System and Energy Recovery', NULL, '5.300', '2020-06-03 14:12:35', NULL),
(144, 2, 2, NULL, NULL, NULL, 'Engineering Computational Methods', NULL, '5.300', '2020-06-03 14:12:35', NULL),
(145, 2, 2, NULL, NULL, NULL, 'Mechanical Engineering Design', NULL, '5.300', '2020-06-03 14:12:35', NULL),
(146, 2, 2, NULL, NULL, NULL, 'Corporate Governance', NULL, '5.300', '2020-06-03 14:12:35', NULL),
(147, 2, 2, NULL, NULL, NULL, 'Sustainable water management and engineering', NULL, '5.300', '2020-06-03 14:12:35', NULL),
(148, 2, 2, NULL, NULL, NULL, 'Environment Management: Ecology, Audit and impact assesment', NULL, '5.300', '2020-06-03 14:12:35', NULL),
(149, 2, 2, NULL, NULL, NULL, 'Reliability and Test', NULL, '5.300', '2020-06-03 14:12:35', NULL),
(150, 2, 2, NULL, NULL, NULL, 'Micro/Nano Process Technology', NULL, '5.300', '2020-06-03 14:12:35', NULL),
(151, 2, 2, NULL, NULL, NULL, 'Political Economy of International Trade', NULL, '5.300', '2020-06-03 14:12:35', NULL),
(152, 2, 2, NULL, NULL, NULL, 'Econometric Methods', NULL, '5.300', '2020-06-03 14:12:35', NULL),
(153, 2, 2, NULL, NULL, NULL, 'Corporate Governance', NULL, '5.300', '2020-06-03 14:12:35', NULL),
(154, 2, 2, NULL, NULL, NULL, 'International Finance', NULL, '5.300', '2020-06-03 14:12:35', NULL),
(155, 2, 2, NULL, NULL, NULL, 'Research Methodology', NULL, '5.300', '2020-06-03 14:12:35', NULL),
(156, 2, 2, NULL, NULL, NULL, 'Management Accounting and Control', NULL, '5.300', '2020-06-03 14:12:35', NULL),
(157, 2, 2, NULL, NULL, NULL, 'Macroeconomics', NULL, '5.300', '2020-06-03 14:12:35', NULL),
(158, 2, 2, NULL, NULL, NULL, 'Human Resource Management(Malay)', NULL, '5.300', '2020-06-03 14:12:35', NULL),
(159, 2, 2, NULL, NULL, NULL, 'Engineering Projekt Management', NULL, '5.300', '2020-06-03 14:12:35', NULL),
(160, 2, 2, NULL, NULL, NULL, 'KKKM6114 Analytical Fluid Dynamics', NULL, '5.300', '2020-06-03 14:15:10', NULL),
(161, 2, 2, NULL, NULL, NULL, 'Computational Fluid Dynamics', NULL, '5.300', '2020-06-03 14:15:10', NULL),
(162, 2, 2, NULL, NULL, NULL, 'Pollution Control Equipment Design', NULL, '5.300', '2020-06-03 14:15:10', NULL),
(163, 2, 2, NULL, NULL, NULL, 'Material Failure Analysis', NULL, '5.300', '2020-06-03 14:15:10', NULL),
(164, 2, 2, NULL, NULL, NULL, 'Power Electronic', NULL, '5.300', '2020-06-03 14:15:10', NULL),
(165, 2, 2, NULL, NULL, NULL, 'Data Communication', NULL, '5.300', '2020-06-03 14:15:10', NULL),
(166, 2, 2, NULL, NULL, NULL, 'Instrumentation and Digital Control', NULL, '5.300', '2020-06-03 14:15:10', NULL),
(167, 2, 2, NULL, NULL, NULL, 'Engineering Ethic', NULL, '5.300', '2020-06-03 14:15:10', NULL),
(168, 2, 2, NULL, NULL, NULL, 'Mathematical Methods for Engineering Research', NULL, '5.300', '2020-06-03 14:15:10', NULL),
(169, 4, 2, NULL, NULL, NULL, 'Elective Course', NULL, '4.000', '2020-06-03 14:30:42', NULL),
(170, 2, 2, NULL, NULL, NULL, 'Microeconomics', NULL, '5.300', '2020-06-03 14:36:47', NULL),
(171, 5, 1, NULL, NULL, NULL, 'Thermodynamics', NULL, '5.250', '2020-06-08 15:01:43', NULL),
(172, 5, 1, NULL, NULL, NULL, 'Civil Engineering Drawing', NULL, '1.750', '2020-06-08 15:01:43', NULL),
(173, 5, 1, NULL, NULL, NULL, 'Operations Research', NULL, '5.250', '2020-06-08 15:01:43', NULL),
(174, 5, 1, NULL, NULL, NULL, 'Control Theory', NULL, '5.250', '2020-06-08 15:01:43', NULL),
(175, 5, 1, NULL, NULL, NULL, 'Human Resource Management', NULL, '5.250', '2020-06-08 15:01:43', NULL),
(176, 5, 1, NULL, NULL, NULL, 'Supply Chain and Logistics Management', NULL, '5.250', '2020-06-08 15:01:43', NULL),
(177, 5, 1, NULL, NULL, NULL, 'Strategic Management of Product Development', NULL, '5.250', '2020-06-08 15:01:43', NULL),
(178, 5, 1, NULL, NULL, NULL, 'Essentials of Project Management', NULL, '5.250', '2020-06-08 15:01:43', NULL),
(179, 5, 1, NULL, NULL, NULL, 'Absolute Basics for Career', NULL, '1.750', '2020-06-08 15:01:43', NULL),
(180, 5, 1, NULL, NULL, NULL, 'Engineering Design', NULL, '7.000', '2020-06-08 15:01:43', NULL),
(181, 5, 1, NULL, NULL, NULL, 'Modeling and Control', NULL, '5.250', '2020-06-08 15:01:43', NULL),
(182, 5, 1, NULL, NULL, NULL, 'Information Technology', NULL, '5.250', '2020-06-08 15:01:43', NULL),
(183, 5, 1, NULL, NULL, NULL, 'Solid Mechanics and vibrations', NULL, '5.250', '2020-06-08 15:01:43', NULL),
(184, 5, 0, NULL, NULL, NULL, 'Sprachkurs Bahasa', NULL, '5.250', '2020-06-08 15:01:43', NULL),
(185, 5, 0, NULL, NULL, NULL, 'Sprachkurs Englisch', NULL, '5.250', '2020-06-08 15:01:43', NULL),
(186, 5, 0, NULL, NULL, NULL, 'Cultural Course', NULL, '5.250', '2020-06-08 15:01:43', NULL),
(187, 5, 1, NULL, NULL, NULL, 'Mathematics 2', NULL, '5.250', '2020-06-08 15:01:43', NULL),
(188, 5, 1, NULL, NULL, NULL, 'Innovation and Technology Management', NULL, '5.250', '2020-06-08 15:01:43', NULL),
(189, 5, 1, NULL, NULL, NULL, 'Organizations and organizational\r\nChange', NULL, '5.250', '2020-06-08 15:01:43', NULL),
(190, 5, 1, NULL, NULL, NULL, 'Strategic Management', NULL, '7.000', '2020-06-08 15:01:43', NULL),
(191, 5, 1, NULL, NULL, NULL, 'Introduction to Electrical Circuits and Electronic Devices', NULL, '5.250', '2020-06-08 15:01:43', NULL),
(192, 5, 1, NULL, NULL, NULL, 'Product Design Engineering', NULL, '5.250', '2020-06-08 15:01:43', NULL),
(193, 5, 1, NULL, NULL, NULL, 'Management of Product Development', NULL, '5.250', '2020-06-08 15:01:43', NULL),
(194, 5, 1, NULL, NULL, NULL, 'Fundamental Engineering Materials', NULL, '5.250', '2020-06-08 15:01:43', NULL),
(195, 5, 1, NULL, NULL, NULL, 'Machine Element Design', NULL, '5.250', '2020-06-08 15:01:43', NULL),
(196, 5, 1, NULL, NULL, NULL, 'Mechanics of Materials', NULL, '5.250', '2020-06-08 15:01:43', NULL),
(197, 5, 1, NULL, NULL, NULL, 'Manufacturing Automation', NULL, '5.250', '2020-06-08 15:01:43', NULL),
(198, 5, 1, NULL, NULL, NULL, 'Dynamics & Control', NULL, '7.000', '2020-06-08 15:01:43', NULL),
(199, 5, 2, NULL, NULL, NULL, 'Planning & development of underground space in rock caverns', NULL, '5.250', '2020-06-08 15:16:22', NULL),
(200, 5, 2, NULL, NULL, NULL, 'Advanced concrete technology', NULL, '5.250', '2020-06-08 15:16:22', NULL),
(201, 5, 2, NULL, NULL, NULL, 'Soil behaviour & engineering properties', NULL, '5.250', '2020-06-08 15:16:22', NULL),
(202, 5, 2, NULL, NULL, NULL, 'Fatigue & fracture of steel structures', NULL, '5.250', '2020-06-08 15:16:22', NULL),
(203, 5, 2, NULL, NULL, NULL, 'Wastewater Treatment & Process Design', NULL, '7.000', '2020-06-08 15:16:22', NULL),
(204, 5, 2, NULL, NULL, NULL, 'Systems Simulation & Modeling', NULL, '5.250', '2020-06-08 15:16:22', NULL),
(205, 5, 2, NULL, NULL, NULL, 'Computational Intelligence: Methods and Applications', NULL, '5.250', '2020-06-08 15:16:22', NULL),
(206, 5, 2, NULL, NULL, NULL, 'Computational Fluid Dynamics', NULL, '7.000', '2020-06-08 15:16:22', NULL),
(207, 5, 2, NULL, NULL, NULL, 'Advanced Chemical Engineering Thermodynamics', NULL, '7.000', '2020-06-08 15:16:22', NULL),
(208, 5, 2, NULL, NULL, NULL, 'Nanotechnology and ist Applications', NULL, '7.000', '2020-06-08 15:16:22', NULL),
(209, 5, 2, NULL, NULL, NULL, 'Applied Econometrics', NULL, '5.250', '2020-06-08 15:16:22', NULL),
(210, 5, 2, NULL, NULL, NULL, 'Advanced Topics in Distributed Systems', NULL, '5.250', '2020-06-08 15:16:22', NULL),
(211, 5, 2, NULL, NULL, NULL, 'Air Quality Management', NULL, '7.000', '2020-06-08 15:16:22', NULL),
(212, 5, 2, NULL, NULL, NULL, 'Finite Element methods', NULL, '5.250', '2020-06-08 15:16:22', NULL),
(213, 5, 2, NULL, NULL, NULL, 'Quality Engineering', NULL, '5.250', '2020-06-08 15:16:22', NULL),
(214, 5, 2, NULL, NULL, NULL, 'Environmental earth systems science', NULL, '5.250', '2020-06-08 15:16:22', NULL),
(215, 5, 2, NULL, NULL, NULL, 'Water Quality Modeling', NULL, '5.250', '2020-06-08 15:16:22', NULL),
(216, 5, 2, NULL, NULL, NULL, 'Air Polution Control', NULL, '5.250', '2020-06-08 15:16:22', NULL),
(217, 5, 2, NULL, NULL, NULL, 'Manufacturing Control and Automation', NULL, '5.250', '2020-06-08 15:16:22', NULL),
(218, 5, 2, NULL, NULL, NULL, 'Human Computer Computer Interaction', NULL, '5.250', '2020-06-08 15:16:22', NULL),
(219, 5, 2, NULL, NULL, NULL, 'Information Visualisation', NULL, '5.250', '2020-06-08 15:16:22', NULL),
(220, 5, 2, NULL, NULL, NULL, 'Product Design & Development', NULL, '5.250', '2020-06-08 15:16:22', NULL),
(221, 5, 2, NULL, NULL, NULL, 'Advanced Manufacturing Processes', NULL, '5.250', '2020-06-08 15:16:22', NULL),
(222, 5, 2, NULL, NULL, NULL, 'Organisation of Knowledge', NULL, '5.250', '2020-06-08 15:16:22', NULL),
(223, 5, 2, NULL, NULL, NULL, 'Business Intelligence', NULL, '5.250', '2020-06-08 15:16:22', NULL),
(224, 5, 2, NULL, NULL, NULL, 'Management of Logistic Functions', NULL, '5.250', '2020-06-08 15:16:22', NULL),
(225, 5, 2, NULL, NULL, NULL, 'Fundamentals of Systems Engineering', NULL, '5.250', '2020-06-08 15:16:22', NULL),
(226, 5, 2, NULL, NULL, NULL, 'Systems & Project management', NULL, '5.250', '2020-06-08 15:16:22', NULL),
(227, 5, 2, NULL, NULL, NULL, 'ORGANISATIONAL LEADERSHIP', NULL, '5.250', '2020-06-08 15:16:22', NULL),
(228, 5, 2, NULL, NULL, NULL, 'Malay Language Level 1', NULL, '5.250', '2020-06-08 15:16:22', NULL),
(229, 5, 2, NULL, NULL, NULL, 'Soccer', NULL, '5.250', '2020-06-08 15:16:22', NULL),
(230, 5, 2, NULL, NULL, NULL, 'Advanced Mechanics of Materials', NULL, '5.250', '2020-06-08 15:16:22', NULL),
(231, 5, 2, NULL, NULL, NULL, 'Manufacturing & Service Operations Management', NULL, '5.250', '2020-06-08 15:16:22', NULL),
(232, 5, 2, NULL, NULL, NULL, 'Supply Chain & Logistics Management', NULL, '5.250', '2020-06-08 15:16:22', NULL),
(233, 5, 2, NULL, NULL, NULL, 'Statistical methods for transportation analysis', NULL, '0.000', '2020-06-08 15:16:22', NULL),
(234, 5, 2, NULL, NULL, NULL, 'Traffic impact & safty studies ', NULL, '0.000', '2020-06-08 15:16:22', NULL),
(235, 5, 2, NULL, NULL, NULL, 'Advanced Microeconomic Theory', NULL, '5.250', '2020-06-08 15:16:22', NULL),
(236, 5, 2, NULL, NULL, NULL, 'Distributed Multimedia Systems', NULL, '5.250', '2020-06-08 15:16:22', NULL),
(237, 5, 2, NULL, NULL, NULL, 'Quantitative Methods for llogistics Analysis', NULL, '5.250', '2020-06-08 15:16:22', NULL),
(238, 5, 2, NULL, NULL, NULL, 'Water Treatment & Process Design', NULL, '7.000', '2020-06-08 15:16:22', NULL),
(239, 5, 2, NULL, NULL, NULL, 'Project Management', NULL, '5.250', '2020-06-08 15:16:22', NULL),
(240, 5, 2, NULL, NULL, NULL, 'Project Financing', NULL, '5.250', '2020-06-08 15:16:22', NULL),
(241, 5, 2, NULL, NULL, NULL, 'International Construction and Marketing', NULL, '5.250', '2020-06-08 15:16:22', NULL),
(242, 5, 2, NULL, NULL, NULL, 'Wireless & Mobile Radio systems', NULL, '5.250', '2020-06-08 15:16:22', NULL),
(243, 5, 2, NULL, NULL, NULL, 'Computer Networks', NULL, '5.250', '2020-06-08 15:16:22', NULL),
(244, 5, 2, NULL, NULL, NULL, 'Process Control', NULL, '5.250', '2020-06-08 15:16:22', NULL),
(245, 5, 2, NULL, NULL, NULL, 'Computer Control Systems', NULL, '5.250', '2020-06-08 15:16:22', NULL),
(246, 5, 2, NULL, NULL, NULL, 'Neural & Fuzzy Systems', NULL, '5.250', '2020-06-08 15:16:22', NULL),
(247, 3, 1, NULL, NULL, NULL, 'Basic Physics 1', NULL, '5.600', '2020-06-08 15:30:24', NULL),
(248, 3, 1, NULL, NULL, NULL, 'Basic Physics 2', NULL, '5.600', '2020-06-08 15:30:24', NULL),
(249, 3, 1, NULL, NULL, NULL, 'Control System', NULL, '4.200', '2020-06-08 15:30:24', NULL),
(250, 3, 1, NULL, NULL, NULL, 'Polymer Technologies', NULL, '4.200', '2020-06-08 15:30:24', NULL),
(251, 3, 1, NULL, NULL, NULL, 'Electrical Power transmission and distribution', NULL, '4.200', '2020-06-08 15:30:24', NULL),
(252, 3, 1, NULL, NULL, NULL, 'Engineering Drawing', NULL, '2.800', '2020-06-08 15:30:24', NULL),
(253, 3, 1, NULL, NULL, NULL, 'Fluid mechanics', NULL, '4.200', '2020-06-08 15:30:24', NULL),
(254, 3, 1, NULL, NULL, NULL, 'Industrial Project Management', NULL, '2.800', '2020-06-08 15:30:24', NULL),
(255, 3, 0, NULL, NULL, NULL, 'Language Course: English', NULL, '2.000', '2020-06-08 15:30:24', NULL),
(256, 3, 0, NULL, NULL, NULL, 'Language Course: Bahasa', NULL, '2.000', '2020-06-08 15:30:24', NULL),
(257, 3, 0, NULL, NULL, NULL, 'Cultural Course', NULL, '2.000', '2020-06-08 15:30:24', NULL),
(258, 3, 1, NULL, NULL, NULL, 'Operations Research', NULL, '0.000', '2020-06-08 15:30:24', NULL),
(259, 3, 1, NULL, NULL, NULL, 'Transportation System', NULL, '0.000', '2020-06-08 15:30:24', NULL),
(260, 3, 1, NULL, NULL, NULL, 'Manufacturing System', NULL, '0.000', '2020-06-08 15:30:24', NULL),
(261, 3, 1, NULL, NULL, NULL, 'Industrial System Design', NULL, '8.400', '2020-06-08 15:30:24', NULL),
(262, 3, 1, NULL, NULL, NULL, 'System Dynamics', NULL, '4.200', '2020-06-08 15:30:24', NULL),
(263, 3, 1, NULL, NULL, NULL, 'New and Renewable Energy', NULL, '8.400', '2020-06-08 15:30:24', NULL),
(264, 3, 1, NULL, NULL, NULL, 'Fundamentals of Electrical Engineering', NULL, '0.000', '2020-06-08 15:30:24', NULL),
(265, 3, 1, NULL, NULL, NULL, 'Basic Thermodynamics', NULL, '0.000', '2020-06-08 15:30:24', NULL),
(266, 3, 1, NULL, NULL, NULL, 'Mechanics', NULL, '0.000', '2020-06-08 15:30:24', NULL),
(267, 3, 1, NULL, NULL, NULL, 'Mechanics of Materials(UI)', NULL, '0.000', '2020-06-08 15:31:40', NULL),
(268, 3, 1, NULL, NULL, NULL, 'Engineering Materials (MME)', NULL, '0.000', '2020-06-08 15:31:40', NULL),
(269, 3, 1, NULL, NULL, NULL, 'CAD VLSI', NULL, '0.000', '2020-06-08 15:31:40', NULL),
(270, 3, 2, NULL, NULL, NULL, 'Research and Computational Methods', NULL, '8.400', '2020-06-08 15:38:15', NULL),
(271, 3, 2, NULL, NULL, NULL, 'Kinetics and Phase Transformation', NULL, '8.400', '2020-06-08 15:38:15', NULL),
(272, 3, 2, NULL, NULL, NULL, 'Advanced Composites', NULL, '8.400', '2020-06-08 15:38:15', NULL),
(273, 3, 2, NULL, NULL, NULL, 'Mechanics of Materials', NULL, '8.400', '2020-06-08 15:38:15', NULL),
(274, 3, 2, NULL, NULL, NULL, 'Total Quality Management', NULL, '8.400', '2020-06-08 15:38:15', NULL),
(275, 3, 2, NULL, NULL, NULL, 'Industrial System Design', NULL, '8.400', '2020-06-08 15:38:15', NULL),
(276, 3, 2, NULL, NULL, NULL, 'Advanced Computer Architectures', NULL, '8.400', '2020-06-08 15:38:15', NULL),
(277, 3, 2, NULL, NULL, NULL, 'Industrial System Engineering', NULL, '8.400', '2020-06-08 15:38:15', NULL),
(278, 3, 2, NULL, NULL, NULL, 'Manufacturing Processes and System', NULL, '8.400', '2020-06-08 15:38:15', NULL),
(279, 3, 2, NULL, NULL, NULL, 'Electrical Power System Quality', NULL, '8.400', '2020-06-08 15:38:15', NULL),
(280, 3, 2, NULL, NULL, NULL, 'New and Renewable Energy', NULL, '8.400', '2020-06-08 15:38:15', NULL),
(281, 3, 2, NULL, NULL, NULL, 'Remote Sensing', NULL, '8.400', '2020-06-08 15:38:15', NULL),
(282, 3, 2, NULL, NULL, NULL, 'Industrial System Design', NULL, '8.400', '2020-06-08 15:38:15', NULL),
(283, 3, 2, NULL, NULL, NULL, 'Power generation Operation and Control', NULL, '8.400', '2020-06-08 15:38:15', NULL),
(284, 3, 2, NULL, NULL, NULL, 'Electrical Power System Planning', NULL, '8.400', '2020-06-08 15:38:15', NULL),
(285, 3, 2, NULL, NULL, NULL, 'Manufacturing Information System Management', NULL, '8.400', '2020-06-08 15:38:15', NULL),
(286, 3, 2, NULL, NULL, NULL, 'Human Capital Management', NULL, '8.400', '2020-06-08 15:38:15', NULL),
(287, 3, 2, NULL, NULL, NULL, 'Manufacturing System', NULL, '8.400', '2020-06-08 15:38:15', NULL),
(288, 3, 2, NULL, NULL, NULL, 'Technology Policy', NULL, '8.400', '2020-06-08 15:38:15', NULL),
(289, 3, 2, NULL, NULL, NULL, 'Service Engineering', NULL, '8.400', '2020-06-08 15:38:15', NULL),
(290, 4, NULL, NULL, NULL, NULL, 'Design to Cost und Qualitätsmanagement', NULL, '4.000', '2020-06-14 20:23:05', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `university`
--

DROP TABLE IF EXISTS `university`;
CREATE TABLE IF NOT EXISTS `university` (
  `university_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `abbreviation` varchar(45) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  PRIMARY KEY (`university_id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `university`
--

INSERT INTO `university` (`university_id`, `name`, `abbreviation`) VALUES
(1, NULL, NULL),
(2, 'Universiti Kebangsaan Malaysia', 'UKM'),
(3, 'Universitas Indonesia', 'UI'),
(4, 'Universität Duisburg-Essen', 'UDE'),
(5, 'Nanyang Technological University Singapore', 'NTU'),
(6, 'Zhegzhou University', 'ZZU'),
(7, 'University Wuhan', 'UW'),
(8, 'German University in Cairo', 'GUC'),
(9, 'Institut Teknologi Bandung', 'ITB'),
(10, 'SIAS International University (SIAS)', 'SIAS'),
(11, 'Zhengzhou University of Light Industry', 'ZZULI'),
(12, 'German Malaysian Institute', 'GMI'),
(13, 'Riam Institute of Technology', 'RIAMTEC'),
(14, 'Universiti Tenaga Nasional', 'UNITEN');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_group_id` int(10) UNSIGNED NOT NULL,
  `salutation_id` int(10) UNSIGNED NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`user_id`),
  KEY `fk_user_salutation_idx` (`salutation_id`),
  KEY `fk_user_user_group1_idx` (`user_group_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_group_id`, `salutation_id`, `firstname`, `lastname`, `email`, `password`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 'shet lin', 'chu', 'shet.chu@stud.uni-due.de', '$2y$10$yUSpoZKgqWr4d7YNz8T2I.jrsZ6nqmgUKTGI0MeI/RgDTuhTqmNfO', '2020-05-14 16:19:19', '2020-05-22 19:06:48'),
(4, 1, 2, 'John', 'Doe', 'john.doe@stud.uni-due.de', '$2y$10$WLzEVWR/AoZbd1hMcR1sAOwqpp..1raJSAQee6.aTlc1v.KsmFtiS', '2020-05-18 13:54:00', NULL),
(6, 1, 1, 'john', 'doe', 'test@test.de', '$2y$10$xY5oP4vqUg8SUgM6G/V/Y.Bh6yYxCUXNn2Ht/Ms9QpHbq26A0p3um', '2020-05-25 09:23:05', NULL),
(7, 1, 2, 'alex', 'schneider', 'test1@test.de', '$2y$10$bi9ZHa3SmAh0S6tviJDxXurz1ZoAmywwksx5LuFtBE2lv0DYDX6sa', '2020-05-27 09:31:48', NULL),
(8, 1, 2, 'Alex', 'Schneider', 'test2@test.de', '$2y$10$oi86zJkuPkvH7aVBzE36FupvPPb6qriM0fLnZsIpgD6i96xQXo9uC', '2020-05-27 09:40:58', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_group`
--

DROP TABLE IF EXISTS `user_group`;
CREATE TABLE IF NOT EXISTS `user_group` (
  `user_group_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`user_group_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_group`
--

INSERT INTO `user_group` (`user_group_id`, `name`) VALUES
(1, 'student'),
(2, 'admin');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `address`
--
ALTER TABLE `address`
  ADD CONSTRAINT `foreign_key_country_id` FOREIGN KEY (`country_id`) REFERENCES `country` (`country_id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `application`
--
ALTER TABLE `application`
  ADD CONSTRAINT `fk_application_degree1` FOREIGN KEY (`applied_degree_id`) REFERENCES `degree` (`degree_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_application_exchange_period1` FOREIGN KEY (`exchange_period_id`) REFERENCES `exchange_period` (`period_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_application_home_address_id` FOREIGN KEY (`home_address_id`) REFERENCES `address` (`address_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_application_intention1` FOREIGN KEY (`intention_id`) REFERENCES `intention` (`intention_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_application_student1` FOREIGN KEY (`student_id`) REFERENCES `student` (`student_id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `applied_equivalence`
--
ALTER TABLE `applied_equivalence`
  ADD CONSTRAINT `fk_applied_equivalence_equivalent_subjects1` FOREIGN KEY (`equivalence_id`) REFERENCES `equivalent_subjects` (`equivalence_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_applied_equivalence_status` FOREIGN KEY (`application_status_id`) REFERENCES `status` (`status_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_applied_equivalence_study_home1` FOREIGN KEY (`application_id`) REFERENCES `study_home` (`application_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `equivalence_course`
--
ALTER TABLE `equivalence_course`
  ADD CONSTRAINT `fk_course_id` FOREIGN KEY (`course_id`) REFERENCES `course` (`course_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_equivalence_id` FOREIGN KEY (`equivalence_id`) REFERENCES `equivalent_subjects` (`equivalence_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `equivalent_subjects`
--
ALTER TABLE `equivalent_subjects`
  ADD CONSTRAINT `fk_equivalent_subjects_professor1` FOREIGN KEY (`signed_by_prof_id`) REFERENCES `professor` (`professor_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_equivalent_subjects_status1` FOREIGN KEY (`status_id`) REFERENCES `status` (`status_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_equivalent_subjects_subject1` FOREIGN KEY (`home_subject_id`) REFERENCES `subject` (`subject_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_equivalent_subjects_subject2` FOREIGN KEY (`foreign_subject_id`) REFERENCES `subject` (`subject_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_equivalent_subjects_user1` FOREIGN KEY (`created_by_user_id`) REFERENCES `user` (`user_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_equivalent_subjects_user2` FOREIGN KEY (`updated_by_user_id`) REFERENCES `user` (`user_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_valid_degree_id` FOREIGN KEY (`valid_degree_id`) REFERENCES `degree` (`degree_id`) ON UPDATE CASCADE;

--
-- Constraints for table `exchange`
--
ALTER TABLE `exchange`
  ADD CONSTRAINT `fk_exchange_address1` FOREIGN KEY (`foreign_address_id`) REFERENCES `address` (`address_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_exchange_application1` FOREIGN KEY (`application_id`) REFERENCES `application` (`application_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_foreign_uni_id` FOREIGN KEY (`foreign_uni_id`) REFERENCES `university` (`university_id`) ON UPDATE CASCADE;

--
-- Constraints for table `exchanged_equivalence`
--
ALTER TABLE `exchanged_equivalence`
  ADD CONSTRAINT `fk_exchanged_equivalence_equivalent_subjects1` FOREIGN KEY (`equivalence_id`) REFERENCES `equivalent_subjects` (`equivalence_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_exchanged_equivalence_exchange1` FOREIGN KEY (`exchanged_id`) REFERENCES `exchange` (`exchange_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `exchange_checklist`
--
ALTER TABLE `exchange_checklist`
  ADD CONSTRAINT `foreign_key_exchange_stage_id` FOREIGN KEY (`exchange_stage_id`) REFERENCES `exchange_stages` (`stage_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `foreign_key_foreign_uni_id` FOREIGN KEY (`foreign_uni_id`) REFERENCES `university` (`university_id`) ON UPDATE CASCADE;

--
-- Constraints for table `exchange_checklist_deadline`
--
ALTER TABLE `exchange_checklist_deadline`
  ADD CONSTRAINT `foreign_key_exchange_period_id` FOREIGN KEY (`exchange_period_id`) REFERENCES `exchange_period` (`period_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `foreign_key_step_id` FOREIGN KEY (`step_id`) REFERENCES `exchange_checklist` (`step_id`) ON UPDATE CASCADE;

--
-- Constraints for table `exchange_checklist_student`
--
ALTER TABLE `exchange_checklist_student`
  ADD CONSTRAINT `foreign_key_checklist_step_id` FOREIGN KEY (`step_id`) REFERENCES `exchange_checklist` (`step_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `foreign_key_exchange_id` FOREIGN KEY (`exchange_id`) REFERENCES `exchange` (`exchange_id`) ON UPDATE CASCADE;

--
-- Constraints for table `priority`
--
ALTER TABLE `priority`
  ADD CONSTRAINT `fk_priority_application1` FOREIGN KEY (`application_id`) REFERENCES `application` (`application_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_priority_university1` FOREIGN KEY (`first_uni_id`) REFERENCES `university` (`university_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_priority_university2` FOREIGN KEY (`second_uni_id`) REFERENCES `university` (`university_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_priority_university3` FOREIGN KEY (`third_uni_id`) REFERENCES `university` (`university_id`) ON UPDATE CASCADE;

--
-- Constraints for table `professor`
--
ALTER TABLE `professor`
  ADD CONSTRAINT `fk_professor_university1` FOREIGN KEY (`university_id`) REFERENCES `university` (`university_id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `reset_password`
--
ALTER TABLE `reset_password`
  ADD CONSTRAINT `user_id_foreign_key` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `reviewed_application`
--
ALTER TABLE `reviewed_application`
  ADD CONSTRAINT `fk_reviewed_application_application1` FOREIGN KEY (`application_id`) REFERENCES `application` (`application_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_reviewed_application_status1` FOREIGN KEY (`application_status_id`) REFERENCES `status` (`status_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_reviewed_application_user1` FOREIGN KEY (`reviewed_by_user_id`) REFERENCES `user` (`user_id`) ON UPDATE CASCADE;

--
-- Constraints for table `securitytoken`
--
ALTER TABLE `securitytoken`
  ADD CONSTRAINT `fk_securitytoken_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `student`
--
ALTER TABLE `student`
  ADD CONSTRAINT `fk_student_address1` FOREIGN KEY (`home_address_id`) REFERENCES `address` (`address_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_student_country1` FOREIGN KEY (`nationality_country_id`) REFERENCES `country` (`country_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_student_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON UPDATE CASCADE;

--
-- Constraints for table `study_home`
--
ALTER TABLE `study_home`
  ADD CONSTRAINT `fk_study_home_application1` FOREIGN KEY (`application_id`) REFERENCES `application` (`application_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_study_home_course1` FOREIGN KEY (`home_course_id`) REFERENCES `course` (`course_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_study_home_degree1` FOREIGN KEY (`home_degree_id`) REFERENCES `degree` (`degree_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_study_home_university1` FOREIGN KEY (`home_university_id`) REFERENCES `university` (`university_id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `study_host`
--
ALTER TABLE `study_host`
  ADD CONSTRAINT `fk_study_host_course1` FOREIGN KEY (`foreign_course_id`) REFERENCES `course` (`course_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_study_host_degree1` FOREIGN KEY (`foreign_degree_id`) REFERENCES `degree` (`degree_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_study_host_exchange1` FOREIGN KEY (`exchange_id`) REFERENCES `exchange` (`exchange_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_study_host_university1` FOREIGN KEY (`foreign_uni_id`) REFERENCES `university` (`university_id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `subject`
--
ALTER TABLE `subject`
  ADD CONSTRAINT `fk_subject_course1` FOREIGN KEY (`course_id`) REFERENCES `course` (`course_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_subject_degree1` FOREIGN KEY (`degree_id`) REFERENCES `degree` (`degree_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_subject_prof1` FOREIGN KEY (`prof_id`) REFERENCES `professor` (`professor_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_subject_university1` FOREIGN KEY (`university_id`) REFERENCES `university` (`university_id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `fk_user_salutation` FOREIGN KEY (`salutation_id`) REFERENCES `salutation` (`salutation_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_user_user_group1` FOREIGN KEY (`user_group_id`) REFERENCES `user_group` (`user_group_id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
