-- phpMyAdmin SQL Dump
-- version 4.4.15.10
-- https://www.phpmyadmin.net
--
-- Host: db12.uni-duisburg-essen.de:3306
-- Generation Time: Dec 03, 2020 at 02:50 PM
-- Server version: 10.0.38-MariaDB-1~trusty-wsrep
-- PHP Version: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `smchnage_1`
--

-- --------------------------------------------------------

--
-- Table structure for table `address`
--

CREATE TABLE IF NOT EXISTS `address` (
  `address_id` int(10) unsigned NOT NULL,
  `street` varchar(255) NOT NULL,
  `zipcode` varchar(45) NOT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `country_id` int(10) unsigned DEFAULT NULL,
  `phone_no` varchar(50) DEFAULT NULL,
  `additional` varchar(255) DEFAULT NULL,
  `student_id` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=135 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `address`
--

INSERT INTO `address` (`address_id`, `street`, `zipcode`, `city`, `state`, `country_id`, `phone_no`, `additional`, `student_id`, `created_at`, `updated_at`) VALUES
(5, 'Falkstrasse 96', '47058', 'Duisburg', 'Deutschland (DEU)', 82, '017680749092', NULL, 12, '2020-05-18 14:45:29', NULL),
(12, 'test, 2', '12344', 'duisburg', 'North Rhine-Westphaliaa', 58, '+4912345679', NULL, 19, '2020-05-18 14:45:56', '2020-05-22 19:03:55'),
(19, 'test, 1', '12345', 'duisburg', 'North Rhine-Westphalia', 82, '+4912345678', NULL, 23, '2020-05-25 14:31:37', NULL),
(30, 'test, 1', '12345', 'duisburg', 'North Rhine-Westphalia', 82, '+4912345678', NULL, 12, '2020-06-16 19:35:37', NULL),
(31, 'test, 1', '12345', 'duisburg', 'North Rhine-Westphalia', 82, '+4912345678', NULL, 41, '2020-07-20 12:05:24', NULL),
(33, 'test, 1', '12345', 'duisburg', 'North Rhine-Westphalia', 82, '+4912345678', NULL, 43, '2020-07-20 14:17:10', NULL),
(37, 'street', 'zip', 'city', 'state', 82, '0123456789', NULL, 49, '2020-07-22 08:32:36', NULL),
(49, 'test, 1', '12345', 'duisburg', 'North Rhine-Westphalia', 82, '+4912345678', NULL, 69, '2020-07-23 19:17:53', NULL),
(65, 'street', 'zip', 'city', 'state', 82, '12345679', NULL, 61, '2020-08-27 09:17:59', NULL),
(73, 'test, 1', '12345', 'duisburg', 'North Rhine-Westphalia', 82, '+4912345678', NULL, 85, '2020-11-09 08:46:03', NULL),
(81, 'test, 1', '12345', 'duisburg', 'North Rhine-Westphalia', 82, '+4912345678', NULL, 85, '2020-11-09 08:57:31', NULL),
(113, 'test, 1', '12345', 'duisburg', 'North Rhine-Westphalia', 82, '+4912345678', NULL, 85, '2020-11-09 09:28:02', NULL),
(117, 'Street 1A', '474747', 'Duisburg', 'NRW', 82, '02033792707', NULL, 89, '2020-11-09 09:32:42', NULL),
(121, 'test, 1', '12345', 'duisburg', 'North Rhine-Westphalia', 82, '+4912345678', NULL, 93, '2020-11-09 11:01:51', NULL),
(125, 'test, 1', '47279', 'duisburg', 'North Rhine-Westphalia', 82, '+4912345678', NULL, 97, '2020-11-09 12:39:18', NULL),
(129, 'test, 1', '47279', 'duisburg', 'North Rhine-Westphalia', 82, '+4912345678', NULL, 101, '2020-11-09 12:41:44', NULL),
(133, 'test, 1', '47279', 'duisburg', 'North Rhine-Westphalia', 82, '+4912345678', NULL, 105, '2020-11-09 12:44:27', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `admin_list`
--

CREATE TABLE IF NOT EXISTS `admin_list` (
  `admin_email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin_list`
--

INSERT INTO `admin_list` (`admin_email`) VALUES
('admin@uni-due.de'),
('christopher.nagelmann@uni-due.de'),
('shet.chu@stud.uni-due.de'),
('stefan.werner@uni-due.de'),
('test@uni-due.de');

-- --------------------------------------------------------

--
-- Table structure for table `application`
--

CREATE TABLE IF NOT EXISTS `application` (
  `application_id` int(10) unsigned NOT NULL,
  `exchange_period_id` int(10) unsigned DEFAULT NULL,
  `student_id` int(10) unsigned DEFAULT NULL,
  `intention_id` int(10) unsigned DEFAULT NULL,
  `applied_degree_id` int(10) unsigned DEFAULT NULL,
  `success_factor` decimal(6,3) NOT NULL DEFAULT '0.000',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `home_address_id` int(11) unsigned DEFAULT NULL,
  `completed` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=129 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `application`
--

INSERT INTO `application` (`application_id`, `exchange_period_id`, `student_id`, `intention_id`, `applied_degree_id`, `success_factor`, `created_at`, `updated_at`, `home_address_id`, `completed`) VALUES
(6, 1, 19, 2, 2, 1.107, '2020-05-18 14:45:56', '2020-05-18 18:36:41', 12, 0),
(13, 1, 23, 2, 2, 7.688, '2020-05-25 14:31:37', '2020-06-16 12:27:01', 19, 0),
(43, 1, 69, 1, 1, 1.500, '2020-07-23 19:17:53', '2020-07-24 11:18:23', 49, 1),
(59, 1, 61, 1, 2, 3.309, '2020-08-27 09:17:59', '2020-08-27 09:26:22', 65, 1),
(107, 13, 85, 1, 1, 7.688, '2020-11-09 09:28:02', '2020-11-13 12:24:35', 113, 1),
(111, 13, 89, 1, 1, 1.630, '2020-11-09 09:32:42', '2020-11-09 09:40:36', 117, 1),
(115, 13, 93, 1, 1, 2.193, '2020-11-09 11:01:51', '2020-11-13 12:22:26', 121, 1),
(119, 13, 97, 1, 1, 1.724, '2020-11-09 12:39:18', '2020-11-13 12:26:30', 125, 1),
(123, 13, 101, 1, 1, 2.717, '2020-11-09 12:41:44', '2020-11-13 12:28:09', 129, 1),
(127, 13, 105, 1, 1, 0.534, '2020-11-09 12:44:27', '2020-11-13 13:51:11', 133, 1);

-- --------------------------------------------------------

--
-- Table structure for table `applied_equivalence`
--

CREATE TABLE IF NOT EXISTS `applied_equivalence` (
  `application_id` int(10) unsigned NOT NULL,
  `equivalence_id` int(10) unsigned NOT NULL,
  `application_status_id` int(10) unsigned DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `applied_equivalence`
--

INSERT INTO `applied_equivalence` (`application_id`, `equivalence_id`, `application_status_id`) VALUES
(111, 14, NULL),
(111, 15, NULL),
(111, 35, NULL),
(111, 121, NULL),
(111, 122, NULL),
(111, 125, NULL),
(111, 126, NULL),
(111, 145, NULL),
(115, 6, NULL),
(115, 27, NULL),
(115, 118, NULL),
(115, 119, NULL),
(115, 120, NULL),
(115, 121, NULL),
(115, 122, NULL),
(115, 123, NULL),
(115, 124, NULL),
(115, 125, NULL),
(115, 126, NULL),
(115, 127, NULL),
(115, 128, NULL),
(115, 129, NULL),
(115, 130, NULL),
(119, 118, NULL),
(119, 119, NULL),
(119, 120, NULL),
(119, 121, NULL),
(119, 122, NULL),
(119, 123, NULL),
(119, 124, NULL),
(119, 125, NULL),
(119, 126, NULL),
(119, 127, NULL),
(119, 128, NULL),
(119, 129, NULL),
(119, 130, NULL),
(123, 6, NULL),
(123, 15, NULL),
(123, 16, NULL),
(123, 17, NULL),
(123, 26, NULL),
(123, 27, NULL),
(123, 28, NULL),
(123, 118, NULL),
(123, 119, NULL),
(123, 120, NULL),
(123, 121, NULL),
(123, 122, NULL),
(123, 123, NULL),
(123, 124, NULL),
(123, 125, NULL),
(123, 126, NULL),
(123, 127, NULL),
(123, 128, NULL),
(123, 129, NULL),
(123, 130, NULL),
(127, 7, NULL),
(127, 9, NULL),
(127, 12, NULL),
(127, 16, NULL),
(127, 17, NULL),
(127, 20, NULL),
(127, 25, NULL),
(127, 30, NULL),
(127, 32, NULL),
(127, 33, NULL),
(127, 118, NULL),
(127, 119, NULL),
(127, 120, NULL),
(127, 121, NULL),
(127, 122, NULL),
(127, 123, NULL),
(127, 124, NULL),
(127, 125, NULL),
(127, 126, NULL),
(127, 127, NULL),
(127, 128, NULL),
(127, 129, NULL),
(127, 130, NULL),
(43, 7, 2),
(43, 20, 2),
(43, 32, 2),
(43, 119, 2),
(43, 120, 2),
(43, 121, 2),
(43, 125, 2),
(43, 128, 2),
(59, 2, 2),
(59, 96, 2),
(59, 134, 2),
(59, 135, 2),
(107, 7, 2),
(107, 20, 2),
(107, 119, 2),
(107, 120, 2),
(115, 7, 2),
(115, 9, 2),
(115, 14, 2),
(115, 15, 2),
(115, 16, 2),
(115, 17, 2),
(115, 20, 2),
(115, 26, 2),
(115, 28, 2),
(119, 4, 2),
(119, 5, 2),
(119, 6, 2),
(119, 11, 2),
(119, 13, 2),
(119, 27, 2),
(119, 31, 2),
(119, 34, 2),
(123, 25, 2);

-- --------------------------------------------------------

--
-- Table structure for table `country`
--

CREATE TABLE IF NOT EXISTS `country` (
  `country_id` int(10) unsigned NOT NULL,
  `name` varchar(255) DEFAULT NULL
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
(55, 'Côte D''ivoire'),
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
(117, 'Korea, Democratic People''s Republic Of'),
(118, 'Korea, Republic Of'),
(119, 'Kuwait'),
(120, 'Kyrgyzstan'),
(121, 'Lao People''s Democratic Republic'),
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

CREATE TABLE IF NOT EXISTS `course` (
  `course_id` int(10) unsigned NOT NULL,
  `name` varchar(255) DEFAULT NULL
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

CREATE TABLE IF NOT EXISTS `degree` (
  `degree_id` int(10) unsigned NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `abbreviation` varchar(45) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `degree`
--

INSERT INTO `degree` (`degree_id`, `name`, `abbreviation`) VALUES
(0, NULL, NULL),
(1, 'Bachelor of Science', 'B.Sc.'),
(2, 'Master of Science', 'M.Sc.');

-- --------------------------------------------------------

--
-- Table structure for table `email_activation`
--

CREATE TABLE IF NOT EXISTS `email_activation` (
  `user_id` int(10) unsigned NOT NULL,
  `activation_code` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `email_activation`
--

INSERT INTO `email_activation` (`user_id`, `activation_code`, `created_at`) VALUES
(17, 'febbab5be4f363cc5b32b83bf4c6f5fc291ae49b', '2020-07-14 21:50:16'),
(61, 'bc3816322f3526089a359d83122604e905b34973', '2020-11-02 09:25:57'),
(65, 'd8103003e9d93d3b599af74b1dbb5d146a022a97', '2020-11-02 09:27:13'),
(69, '1e221f7fc76bbb30f9e78a1a9f37292fbf726d05', '2020-11-02 09:30:23');

-- --------------------------------------------------------

--
-- Table structure for table `equivalence_course`
--

CREATE TABLE IF NOT EXISTS `equivalence_course` (
  `equivalence_id` int(10) unsigned NOT NULL,
  `course_id` int(10) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `equivalence_course`
--

INSERT INTO `equivalence_course` (`equivalence_id`, `course_id`) VALUES
(101, 8),
(102, 15);

-- --------------------------------------------------------

--
-- Table structure for table `equivalence_quota`
--

CREATE TABLE IF NOT EXISTS `equivalence_quota` (
  `equivalence_id` int(10) unsigned NOT NULL,
  `exchange_period_id` int(10) unsigned NOT NULL,
  `quota` int(10) unsigned DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `equivalence_quota`
--

INSERT INTO `equivalence_quota` (`equivalence_id`, `exchange_period_id`, `quota`) VALUES
(7, 1, 5),
(20, 1, 5),
(32, 1, 40),
(48, 1, 5),
(118, 1, 2),
(119, 1, 2),
(120, 1, 2),
(121, 1, 2),
(122, 1, 2),
(123, 1, 2),
(124, 1, 2),
(125, 1, 2),
(126, 1, 2),
(127, 1, 2),
(128, 1, 2),
(129, 1, 2),
(130, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `equivalent_subjects`
--

CREATE TABLE IF NOT EXISTS `equivalent_subjects` (
  `equivalence_id` int(10) unsigned NOT NULL,
  `home_subject_id` int(10) unsigned NOT NULL,
  `foreign_subject_id` int(10) unsigned NOT NULL,
  `status_id` int(10) unsigned DEFAULT NULL,
  `signed_by_prof_id` int(10) unsigned DEFAULT NULL,
  `accepted_at` datetime DEFAULT NULL,
  `prof_doc_num` varchar(45) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `created_by_user_id` int(10) unsigned DEFAULT NULL,
  `updated_by_user_id` int(10) unsigned DEFAULT NULL,
  `valid_degree_id` int(10) unsigned NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=147 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `equivalent_subjects`
--

INSERT INTO `equivalent_subjects` (`equivalence_id`, `home_subject_id`, `foreign_subject_id`, `status_id`, `signed_by_prof_id`, `accepted_at`, `prof_doc_num`, `created_at`, `updated_at`, `created_by_user_id`, `updated_by_user_id`, `valid_degree_id`) VALUES
(1, 1, 3, 2, 1, NULL, NULL, '2019-09-25 05:17:51', '2020-05-18 11:32:43', NULL, NULL, 2),
(2, 2, 4, 1, 2, NULL, NULL, '2019-09-25 05:18:31', '2020-10-26 13:35:26', NULL, NULL, 2),
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
(48, 102, 142, 2, NULL, NULL, NULL, '2020-06-03 14:25:55', '2020-08-31 11:43:58', NULL, NULL, 2),
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
(118, 14, 249, 2, NULL, NULL, NULL, '2020-06-14 20:12:38', NULL, NULL, NULL, 1),
(119, 29, 250, 2, NULL, NULL, NULL, '2020-06-14 20:12:38', NULL, NULL, NULL, 1),
(120, 15, 249, 2, NULL, NULL, NULL, '2020-06-14 20:12:38', NULL, NULL, NULL, 1),
(121, 26, 254, 2, NULL, NULL, NULL, '2020-06-14 20:12:38', NULL, NULL, NULL, 1),
(122, 36, 255, 2, NULL, NULL, NULL, '2020-06-14 20:12:38', NULL, NULL, NULL, 1),
(123, 36, 256, 2, NULL, NULL, NULL, '2020-06-14 20:12:38', NULL, NULL, NULL, 1),
(124, 37, 257, 2, NULL, NULL, NULL, '2020-06-14 20:12:38', NULL, NULL, NULL, 1),
(125, 26, 178, 2, NULL, NULL, NULL, '2020-06-14 20:18:08', NULL, NULL, NULL, 1),
(126, 14, 181, 2, NULL, NULL, NULL, '2020-06-14 20:18:08', NULL, NULL, NULL, 1),
(127, 22, 183, 2, NULL, NULL, NULL, '2020-06-14 20:18:08', NULL, NULL, NULL, 1),
(128, 36, 184, 2, NULL, NULL, NULL, '2020-06-14 20:18:08', NULL, NULL, NULL, 1),
(129, 36, 185, 2, NULL, NULL, NULL, '2020-06-14 20:18:08', NULL, NULL, NULL, 1),
(130, 37, 186, 2, NULL, NULL, NULL, '2020-06-14 20:18:08', NULL, NULL, NULL, 1),
(131, 36, 255, 2, NULL, NULL, NULL, '2020-06-14 20:21:29', NULL, NULL, NULL, 2),
(132, 36, 256, 2, NULL, NULL, NULL, '2020-06-14 20:21:29', NULL, NULL, NULL, 2),
(133, 37, 257, 2, NULL, NULL, NULL, '2020-06-14 20:21:29', NULL, NULL, NULL, 2),
(134, 290, 274, 2, NULL, NULL, NULL, '2020-06-14 20:23:48', NULL, NULL, NULL, 2),
(135, 290, 275, 2, NULL, NULL, NULL, '2020-06-14 20:23:48', NULL, NULL, NULL, 2),
(136, 2, 211, 2, NULL, NULL, NULL, '2020-06-14 20:27:10', NULL, NULL, NULL, 2),
(137, 2, 216, 2, NULL, NULL, NULL, '2020-06-14 20:27:10', NULL, NULL, NULL, 2),
(138, 290, 213, 2, NULL, NULL, NULL, '2020-06-14 20:27:10', NULL, NULL, NULL, 2),
(139, 36, 184, 2, NULL, NULL, NULL, '2020-06-14 20:27:10', NULL, NULL, NULL, 2),
(140, 36, 185, 2, NULL, NULL, NULL, '2020-06-14 20:27:10', NULL, NULL, NULL, 2),
(141, 37, 186, 2, NULL, NULL, NULL, '2020-06-14 20:27:10', NULL, NULL, NULL, 2),
(145, 136, 142, 1, NULL, NULL, NULL, '2020-11-03 13:53:25', NULL, NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `exchange`
--

CREATE TABLE IF NOT EXISTS `exchange` (
  `exchange_id` int(10) unsigned NOT NULL,
  `application_id` int(10) unsigned DEFAULT NULL,
  `foreign_address_id` int(10) unsigned DEFAULT NULL,
  `foreign_uni_id` int(10) unsigned NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=69 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `exchange`
--

INSERT INTO `exchange` (`exchange_id`, `application_id`, `foreign_address_id`, `foreign_uni_id`) VALUES
(43, 43, NULL, 2),
(47, NULL, NULL, 2),
(51, NULL, NULL, 2),
(55, 59, NULL, 2),
(59, 107, NULL, 2),
(63, 123, NULL, 2),
(65, 115, NULL, 2),
(67, 119, NULL, 2);

-- --------------------------------------------------------

--
-- Table structure for table `exchange_checklist`
--

CREATE TABLE IF NOT EXISTS `exchange_checklist` (
  `step_id` int(10) unsigned NOT NULL,
  `step_name` varchar(255) NOT NULL,
  `foreign_uni_id` int(10) unsigned NOT NULL,
  `exchange_stage_id` int(10) unsigned NOT NULL,
  `degree_id` int(10) unsigned NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `exchange_checklist`
--

INSERT INTO `exchange_checklist` (`step_id`, `step_name`, `foreign_uni_id`, `exchange_stage_id`, `degree_id`) VALUES
(1, 'Learning Agreement', 1, 1, 0),
(2, 'Visa Application', 1, 1, 0),
(3, 'Flight Booking', 1, 1, 0),
(11, 'Covid-Test', 1, 1, 0),
(27, 'Enrolment', 2, 2, 0),
(31, 'Apply for language course', 2, 2, 0);

-- --------------------------------------------------------

--
-- Table structure for table `exchange_checklist_deadline`
--

CREATE TABLE IF NOT EXISTS `exchange_checklist_deadline` (
  `step_id` int(10) unsigned NOT NULL,
  `deadline` datetime DEFAULT NULL,
  `exchange_period_id` int(10) unsigned NOT NULL,
  `beginn` datetime NOT NULL,
  `information` longtext
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `exchange_checklist_deadline`
--

INSERT INTO `exchange_checklist_deadline` (`step_id`, `deadline`, `exchange_period_id`, `beginn`, `information`) VALUES
(1, '2020-07-01 23:59:59', 1, '2020-06-15 00:00:00', 'Test 29'),
(1, '2020-12-11 10:48:00', 13, '2020-11-26 00:00:00', 'test'),
(2, '2020-08-01 23:59:59', 1, '2020-07-09 00:00:00', ''),
(2, '2020-12-11 10:48:00', 13, '2020-11-26 00:00:00', ''),
(3, '2020-08-15 23:59:59', 1, '2020-08-01 08:00:00', NULL),
(3, '2020-12-11 10:48:00', 13, '2020-11-26 00:00:00', ''),
(11, '2020-10-31 08:49:00', 1, '2020-10-30 00:00:00', NULL),
(11, '2020-12-11 10:48:00', 13, '2020-11-26 00:00:00', ''),
(27, '2020-10-29 09:13:00', 1, '2020-10-30 00:00:00', NULL),
(27, '2020-12-11 10:48:00', 13, '2020-11-26 00:00:00', ''),
(31, '2020-11-26 13:18:00', 1, '2020-11-11 00:00:00', 'test'),
(31, '2020-12-11 10:48:00', 13, '2020-11-26 00:00:00', '');

-- --------------------------------------------------------

--
-- Table structure for table `exchange_checklist_student`
--

CREATE TABLE IF NOT EXISTS `exchange_checklist_student` (
  `exchange_id` int(10) unsigned NOT NULL,
  `step_id` int(10) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `exchange_checklist_student`
--

INSERT INTO `exchange_checklist_student` (`exchange_id`, `step_id`) VALUES
(47, 1),
(59, 1),
(59, 2);

-- --------------------------------------------------------

--
-- Table structure for table `exchange_equivalence`
--

CREATE TABLE IF NOT EXISTS `exchange_equivalence` (
  `exchange_id` int(10) unsigned NOT NULL,
  `equivalence_id` int(10) unsigned NOT NULL,
  `credits_received` decimal(6,2) unsigned NOT NULL DEFAULT '0.00',
  `grade_received` decimal(6,2) unsigned NOT NULL DEFAULT '0.00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `exchange_equivalence`
--

INSERT INTO `exchange_equivalence` (`exchange_id`, `equivalence_id`, `credits_received`, `grade_received`) VALUES
(43, 7, 0.00, 0.00),
(43, 20, 0.00, 0.00),
(43, 32, 0.00, 0.00),
(43, 119, 0.00, 0.00),
(43, 120, 0.00, 0.00),
(43, 121, 0.00, 0.00),
(43, 125, 0.00, 0.00),
(43, 128, 0.00, 0.00),
(51, 51, 0.00, 0.00),
(51, 57, 0.00, 0.00),
(51, 91, 0.00, 0.00),
(51, 92, 0.00, 0.00),
(51, 96, 0.00, 0.00),
(51, 134, 0.00, 0.00),
(51, 135, 0.00, 0.00),
(55, 2, 0.00, 0.00),
(55, 96, 0.00, 0.00),
(55, 134, 0.00, 0.00),
(55, 135, 0.00, 0.00),
(59, 7, 0.00, 0.00),
(59, 20, 0.00, 0.00),
(59, 119, 0.00, 0.00),
(59, 120, 0.00, 0.00);

-- --------------------------------------------------------

--
-- Table structure for table `exchange_period`
--

CREATE TABLE IF NOT EXISTS `exchange_period` (
  `period_id` int(10) unsigned NOT NULL,
  `exchange_semester` varchar(255) NOT NULL,
  `semester_begin` date NOT NULL,
  `semester_end` date NOT NULL,
  `application_begin` datetime NOT NULL,
  `application_end` datetime NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_on` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `min_success_factor` decimal(6,3) NOT NULL DEFAULT '0.000'
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `exchange_period`
--

INSERT INTO `exchange_period` (`period_id`, `exchange_semester`, `semester_begin`, `semester_end`, `application_begin`, `application_end`, `created_on`, `updated_on`, `min_success_factor`) VALUES
(1, 'WS20/21', '2020-10-01', '2021-03-30', '2020-05-01 00:00:00', '2020-11-02 18:00:00', '2020-05-14 17:14:03', '2020-11-09 08:32:33', 0.000),
(13, 'SS2021', '2021-03-01', '2021-09-30', '2020-11-07 08:00:00', '2021-01-01 08:00:00', '2020-10-25 16:32:09', '2020-11-09 08:33:02', 1.000);

-- --------------------------------------------------------

--
-- Table structure for table `exchange_stages`
--

CREATE TABLE IF NOT EXISTS `exchange_stages` (
  `stage_id` int(10) unsigned NOT NULL,
  `stage_name` varchar(255) NOT NULL
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

CREATE TABLE IF NOT EXISTS `intention` (
  `intention_id` int(10) unsigned NOT NULL,
  `name` varchar(255) NOT NULL
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

CREATE TABLE IF NOT EXISTS `priority` (
  `application_id` int(10) unsigned NOT NULL,
  `first_uni_id` int(10) unsigned DEFAULT NULL,
  `second_uni_id` int(10) unsigned DEFAULT NULL,
  `third_uni_id` int(10) unsigned DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `priority`
--

INSERT INTO `priority` (`application_id`, `first_uni_id`, `second_uni_id`, `third_uni_id`) VALUES
(6, 2, 3, 4),
(13, 2, 3, 4),
(43, 2, 3, 5),
(59, 2, 3, NULL),
(107, 2, 3, NULL),
(111, 3, 2, 5),
(115, 2, 3, 5),
(119, 2, 3, 5),
(123, 2, 3, 5),
(127, 2, 3, 5);

-- --------------------------------------------------------

--
-- Table structure for table `professor`
--

CREATE TABLE IF NOT EXISTS `professor` (
  `professor_id` int(10) unsigned NOT NULL,
  `prof_surname` varchar(255) NOT NULL,
  `prof_firstname` varchar(255) NOT NULL,
  `prof_title` varchar(45) DEFAULT NULL,
  `university_id` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
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

CREATE TABLE IF NOT EXISTS `reset_password` (
  `user_id` int(10) unsigned NOT NULL,
  `password_code` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `reset_password`
--

INSERT INTO `reset_password` (`user_id`, `password_code`, `created_at`) VALUES
(53, '49d20e0e47775e4d9a6b1205bfd3a9801902ce72', '2020-07-23 13:51:10'),
(53, 'b6f7ba13a983a272cee35ef1c5bd814f6bf101e9', '2020-07-23 13:49:33'),
(53, 'd7b582619cf6f8d4c308a6a3ce1481e7078cff54', '2020-07-23 13:42:56'),
(53, 'e2250438d96270c6cbc99ba976d2ee21510a08b3', '2020-07-23 13:46:04'),
(57, '08b44aa7ab3e73379c0522c1a977774bdc943e91', '2020-07-23 14:34:53');

-- --------------------------------------------------------

--
-- Table structure for table `reviewed_application`
--

CREATE TABLE IF NOT EXISTS `reviewed_application` (
  `application_id` int(10) unsigned NOT NULL,
  `application_status_id` int(10) unsigned NOT NULL,
  `reviewed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `reviewed_by_user_id` int(10) unsigned NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `comment` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `reviewed_application`
--

INSERT INTO `reviewed_application` (`application_id`, `application_status_id`, `reviewed_at`, `reviewed_by_user_id`, `updated_at`, `comment`) VALUES
(6, 3, '2020-07-24 11:32:40', 35, '2020-08-06 07:38:31', NULL),
(13, 3, '2020-07-24 11:32:40', 35, '2020-08-06 07:38:31', NULL),
(43, 2, '2020-07-24 11:19:26', 35, '2020-08-06 07:32:07', NULL),
(59, 2, '2020-08-27 09:29:46', 35, NULL, 'sehr gute Aussichten! '),
(107, 2, '2020-11-09 09:41:55', 57, NULL, NULL),
(115, 2, '2020-11-13 11:38:47', 57, NULL, NULL),
(119, 2, '2020-11-13 11:38:47', 57, NULL, NULL),
(123, 2, '2020-11-13 11:38:47', 57, NULL, NULL),
(127, 3, '2020-11-13 11:38:47', 57, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `salutation`
--

CREATE TABLE IF NOT EXISTS `salutation` (
  `salutation_id` int(10) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `nameEng` varchar(255) DEFAULT NULL
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

CREATE TABLE IF NOT EXISTS `securitytoken` (
  `id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `identifier` varchar(255) NOT NULL,
  `securitytoken` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=425 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `securitytoken`
--

INSERT INTO `securitytoken` (`id`, `user_id`, `identifier`, `securitytoken`, `created_at`) VALUES
(16, 4, '0da65c3212d268d766411ab6e5840193', '030afa19540545b09644b5c199ad63315a1ceac9', '2020-05-18 13:54:15'),
(58, 11, 'fe2ef8fad203d0db017e08be2655d615', '4dd1512020d742ff4fdfed9cc11f29f0ab96a60d', '2020-07-13 06:09:59'),
(59, 11, 'fb8131db6fda2641d43d5747efcfe5a1', 'cc67c99e102e3a08a52d492fc1c3448bd70db63c', '2020-07-13 06:11:29'),
(60, 11, '727b071505a4176610c05231a5409bb9', '1044132c4e15a503934ec893451f900355565f76', '2020-07-13 08:28:53'),
(64, 11, '91ce8b9783ff0cfa6f4aa6b17cc6c85b', 'c75a70b01e1f0e17e242af067c9569a358282d32', '2020-07-20 13:14:28'),
(66, 11, '9affa9ad0215e6c3ed9a444c7ac7bde1', '9bab256363fbca67e03dcdc65c0f4a066dd3c24d', '2020-07-20 14:14:10'),
(68, 11, '2cd7c51c4ee76db2137746cee05b1d09', '13595bab863e144e80d08ae3f481627b2ce0a909', '2020-07-20 14:17:53'),
(93, 11, '646ce0353e3013d969a68215e2b3b324', '00a4bd053887159b2423a9cdc5e14fab7b67555b', '2020-07-22 08:30:35'),
(105, 11, '179dbd7c7e30b4425811e40aebe736c7', '572687f4ced3efc29bc44e62c8f64d41fea71f57', '2020-07-22 13:13:13'),
(117, 35, '7ba7b44e9ee0104000466cae75955f85', '6ca6839ddf3115a4fb0e4698ecaa7d0278d93e39', '2020-07-22 14:42:22'),
(121, 53, '996e12afad0793e64b9b6d3befbd96e5', '4610e85518aea8969fce98520e7038d1b9568131', '2020-07-23 13:27:15'),
(125, 11, 'cee1e5defdb852d39db6434e8fbdd827', '9c0a396d54bc0628fb1c5f9328098e7b32a09e9f', '2020-07-23 14:32:03'),
(129, 57, 'e54945b4a75f5d118c10e5252ed35276', '0bdf7f931cb074a1893003279a72604c02625c2b', '2020-07-23 14:35:59'),
(133, 57, 'f05712922d51c71d6ac55c95cfc8bed5', 'e73d8827df825fb2e11b0d164dec02c6e1b95946', '2020-07-23 14:40:40'),
(135, 57, 'a3755fb11179f1c0ecd49feea922a640', '1723b7532dbf5e375a0eded4d0fe176bc51eb4f0', '2020-07-23 14:40:56'),
(139, 57, '79df0e43bd282197298b33a394583eaa', 'f44c3e284758ef4f96bdd072e18ad562bbb34dbc', '2020-07-23 14:56:27'),
(143, 53, '23b9020e10679e9405ef252b63633aef', 'defec2dd118a1e773d5b94fb2378c353535b29fd', '2020-07-23 15:45:54'),
(147, 53, '676d2dbe8db23f1e3f1905d757428d69', 'b860b419d7d2773d43f5c50d85efe0576b297928', '2020-07-24 08:33:46'),
(151, 57, '489a730deb3c3ba2323b936583d057dd', '9dca6bb25a4cd8295c131f73a21c5998154ae86f', '2020-07-24 08:46:03'),
(155, 53, '4e34010189ca333e6e0af75b507c416c', '1583342a7e38fd78a9d68aca0c5d4bb3f913fe7a', '2020-07-24 08:55:39'),
(159, 57, 'e86fc160e00c9c511ed47f025f6eb136', '7b779a3d9f51f8f094284bde667d042073916d84', '2020-07-24 09:28:05'),
(163, 53, '779208cfb06b2ecf7c4a317dce164fa9', 'ba19aea77c74187ccab0528034e8d9d49765e7e7', '2020-07-24 11:18:12'),
(165, 57, '795ac1eb6865b9180378bb7ec3288789', '843e6622b9f376e214f559d1e3be46c8a32d7c65', '2020-07-24 11:18:47'),
(169, 37, 'd0de0e68628d0ed8f305cbce10b5d168', '44543f8e38eb688870cb104e98bd2ac45c98effd', '2020-07-30 08:20:20'),
(173, 35, '7cefeac08a310a348adb01e1e71e13a1', '593b56beefcaf05f2a0c2e511faae56a2964d34b', '2020-07-30 08:21:09'),
(177, 37, '069a675cfe74515e2a9f1ab44d478176', 'fbef27b0980c0a08d9eae3ea8d77672f5a97f019', '2020-07-30 08:58:03'),
(181, 57, 'c6346e9cf8b9e0a7a6250b5333d4e7c1', '80024c37bb309363968315e3e9331e8270643b58', '2020-07-30 10:58:04'),
(185, 37, 'bf2ab45aae98d66f0fa79131a6ee17e6', 'fbed648b10694bf6d6f2e7f69666d54f6db71e3b', '2020-08-06 07:18:23'),
(189, 35, 'c1f630d4c2cf868f28f385da2803a940', '29cb035435ba5cbacaaf24988dfe21a4588f66f6', '2020-08-06 07:21:58'),
(193, 37, '26057f5be9bd55c54b3286e5ad931852', '835367d817cbe1be2bc8d874d368f4408e96b4b5', '2020-08-06 07:24:43'),
(197, 35, '3f8ebbb577e13842b8054cc33d79ce9d', 'd549635985683dc9b3eff0c2b0e0cc71421fedf0', '2020-08-06 07:31:48'),
(201, 37, '9ca7efb31a2684a4c334a0b2e809be78', 'b1a4efd7400e1dd6c600957ee941f6669019a5a4', '2020-08-06 07:32:31'),
(205, 35, 'eb5b1575c93dca0449fb8e71838555e9', 'f029feff5249b3a86dcc557d52bf2dee6184c80c', '2020-08-06 07:36:33'),
(209, 37, '3193d019d3313f3720c112e507a60b72', '461c60e025a24adfa17fdd44f0a65495d97194dd', '2020-08-12 13:45:06'),
(213, 37, '200cbc1e03fcafb14f1561dd4c4dd31c', '6474f36e83f07f8fbd78e621fd89c716bdf1ac83', '2020-08-13 08:09:48'),
(217, 37, '19b0d294dd51c658381b0f611fc8ba68', '7850e1228dafa0d03abaf17811607f4eeef75658', '2020-08-13 08:11:28'),
(221, 35, 'ac772aa529d8420b684134779f2a3d13', '6b8b8dd80adfc4d8cb32de7c7b21baec496fbf37', '2020-08-13 08:28:14'),
(225, 37, '835374dcb5ce0523d7f70d9379e162a9', '9be0d1fa43d96ad2df88cdb12f47e80672758e11', '2020-08-13 08:44:10'),
(229, 53, '66f2adbe73158db1d183576d9c07f25a', '6c5c7e26d5fc09a30958be589f5b7e2a73c2a8c7', '2020-08-13 09:18:06'),
(233, 53, '92e8f0989ad1fa594e01513307eef297', 'd0fce18e7e25e37925a55f1719a55e8599440616', '2020-08-13 11:37:03'),
(237, 57, '3a193548773bcee2dba9666368fa9816', 'c2daae8d0cf1419a5024591ac5d40f8ab0a34282', '2020-08-13 12:01:34'),
(241, 37, '65bb7324163af62b588dbcc58acd4d4b', '6e36fc2ada0058ec3a7f160b7ca053deb6ff0d18', '2020-08-27 08:37:41'),
(245, 35, 'e0098265348b3342fe67f034b4b4a497', '7d348c33a3ca87497fdb91c6e4d85066fc9445b5', '2020-08-27 08:39:12'),
(249, 37, '6cd668f23ddc82fbd604ff1eea7bd821', 'd8dc54fd1e508db2207a1c4abb063f2b8511bb3d', '2020-08-27 09:13:34'),
(253, 35, 'a6b6e3c2a7a1444cb70fda8b4641472a', '53292412af0d18a7df7b072a920659814631455d', '2020-08-27 09:27:34'),
(257, 37, 'b9ccd9a8a9f767bc2c843c288a73bf02', '4e5e4e5065036dbdd59af26451dbfcbc2ee415bf', '2020-08-27 09:53:41'),
(261, 57, 'f5078cf946a980cd5614377f4dd7335d', 'cbd0e79d5b51a6a1076629c47f58f840f945517f', '2020-10-12 09:14:27'),
(265, 53, '2ba4ce6d05ec8a20178d19bf03e47193', '39527d2edf09601e62dfc2d07d5674146fc40cb2', '2020-11-02 09:21:25'),
(269, 57, '861b244276e721c838e1f2850cc4eedf', 'e1d00aaa57ec1cbfaf91eb7d83b8024d2fa33b6d', '2020-11-02 09:22:58'),
(277, 57, 'c8da9a2f0587a3d5038644f6eecd4562', '341ae3465dabc19d326eee6346107912f6d5fa4c', '2020-11-02 10:48:28'),
(281, 57, '859f295a9a9e3ab5ce95aa866375d353', '7c2a91b6685c6dde9b8b934476895512b8bce7bd', '2020-11-02 13:04:06'),
(285, 77, 'eabe4350fd5a3236be629904e0b372d6', '92d22257227c3a91ec85df2f255b9d5386bf227f', '2020-11-09 08:23:53'),
(289, 85, '1c973f963746fcd2f8eba1841344f27f', 'f72159a469fdb57d1f1d7a6f45c4a535d0a2cfe7', '2020-11-09 08:51:04'),
(293, 81, '41f451805df6541c1587caa2f67b440b', 'b699bc64b671d3c45beb28f99b560d077f6e0f5b', '2020-11-09 09:01:19'),
(297, 85, '1778b5167aa84cb632a3659648961353', '2512f38e6e25733742e43f1b6385ed9a32be9a1f', '2020-11-09 09:03:09'),
(301, 81, '3821266da179d1ada596d3c9160f6e07', '8cbb42a2a195e3eebd45c2519caafa5fcfdbd4f1', '2020-11-09 09:07:38'),
(305, 85, 'f3cea550815815392346cd029a8468b2', '86e5636548b03d690b1e47456b225054de0b5b56', '2020-11-09 09:08:18'),
(309, 81, '31d62bd9b3a5e4e3c03152b70705c679', '5ab7de7afb3e7044b0793e8b35d08d492100360a', '2020-11-09 09:26:26'),
(313, 81, '93ee9606ad7bc375a3edfadf3c8027b9', '46162e677fcc82c8e271269e001e709ca52db448', '2020-11-09 09:34:22'),
(317, 85, '468f2f86fc13cb42784b3f2e3dd9ce06', '24f5161145763e48c2743bb8df09b9a3ef659cc5', '2020-11-09 09:35:42'),
(319, 81, 'f5ee195d00ffef7edf321325925ea6dd', 'c63d523460089d8f96e776b6b41c686a14eaeb01', '2020-11-09 09:36:05'),
(323, 57, '147d82f3d217b02026b520166d5e2ea7', '386dd71d7718f357a9e5985fb8375faaee7b90e7', '2020-11-09 09:36:28'),
(325, 85, 'aad5d142a3ed85f580f7f928ec28d7b6', 'ddeded87742c35d9d92825a8ac2bac67a9da968a', '2020-11-09 09:37:14'),
(327, 81, '35fa9d53109d47222f5ff68c6a8ea35e', '9e7901bd1e84f3643c51a60d682f66e4c184c790', '2020-11-09 09:37:46'),
(331, 77, '39a18877b7499ce99c7282ae83e1535b', 'cdc65bd2f649830be94e9837f24875af337886e1', '2020-11-09 09:39:48'),
(333, 85, 'a213745c2c720dc615795626ab1a3bd4', 'dcb05a2d361278e0788e165ef1605f027334491b', '2020-11-09 09:39:59'),
(337, 81, 'd9b615c3a5102728c1d4f716ccab0154', '46c507a5f23dec8436e495dd747c44529f9786ae', '2020-11-09 09:41:19'),
(339, 57, '7d2728556ea8bc10295f5a21220bf403', 'c62c57d186016fcbed6367dffd89586fff64196f', '2020-11-09 09:41:28'),
(343, 77, '78ae903ac532b24c58a61e7e7a7d0f9d', '6be96b81bbc4451c087ede4d75728f83a8af5c76', '2020-11-09 09:42:34'),
(345, 57, '1721e6202404e0f56456b02324d72f57', '96418e7053b514aed7294c17bd63372e77f0efab', '2020-11-09 09:43:02'),
(349, 57, '1f6533e1b71a117ad03c866bccbfc97d', '635439a7502c05d61ebef5aa15305887f5d0f081', '2020-11-09 09:46:37'),
(353, 77, '4c1bcf8339e7df8f9abbbc66509f041f', '78b2a132bc1a5b4d2e27f1b1cf0b0802bbc17adf', '2020-11-09 09:49:18'),
(357, 85, '17dc59cec5febe6d28427510662e743c', '1623261e1b74fa1493d1f3a9a2ed4dd8f2fdb1f3', '2020-11-09 10:05:02'),
(361, 89, 'c61be0515f96196927a20fac4dd12213', '835ce400bfd2bed5040db85e95b537e441b66df6', '2020-11-09 10:58:02'),
(363, 89, '8385923e9fba3bd7ca3c9beea25abddb', 'bbe6585fda59d42b4471db6a790196b481d8469b', '2020-11-09 10:58:35'),
(367, 93, 'ebdc6e29ac5cf49c82d483b4add7477a', 'fbd1f1170f4e310e9046c46e7319ba1351699a7c', '2020-11-09 11:08:31'),
(371, 97, '050d09e13f692b2752f7067d5ce15fae', 'd77a9a4098aa35376d67181df973ba82ba96bc89', '2020-11-09 12:40:20'),
(375, 99, '8c5640a4deeff189f85c4c5c8ddedd7c', 'e6eb4dbc5c8a06066486685df6b616d7c684a326', '2020-11-09 12:43:12'),
(379, 89, '068b7300dbad34facf4ce24b59f688eb', 'be9eb543d66a227313f7915089d1c19a7db2e228', '2020-11-13 11:36:25'),
(383, 57, '57f231412b49b83307ac8287a49a3112', '93c29bfee657e1c506f6cf749ad6a979d07546e1', '2020-11-13 11:38:10'),
(387, 77, '1d13fb9f91f3946c55b52b8acc2581b2', '1fa469005f2c3b98a45af386c5ccf6ee0effb24d', '2020-11-13 12:22:55'),
(391, 93, '6d50d872e4fdbfba573fa8ed7d67c024', 'c21170809172f57ad3163ac61b5f1778e2903ce2', '2020-11-13 12:24:57'),
(395, 97, 'bf3b911755c8707b336f938820ed90b2', '2f726bd8d1d0539e8d37a6e0cfec277976f05cfb', '2020-11-13 12:26:43'),
(399, 99, 'b9ae568f6ebf607a6157aa94ab9d1bde', '3f0d41a6cf25da0b0577226eb8a4a159f32470ad', '2020-11-13 12:28:22'),
(403, 89, 'c6df8d0671dc8a127a4b318fa46c24d9', '1dbb2cef8f306342416efb301534b577b5751e18', '2020-11-16 08:43:57'),
(407, 89, 'e33690facf4d1d46db24f09e953d48b0', 'd8509828020ce84a33a911b1a888cd5f00b1a1b8', '2020-11-16 09:32:14'),
(411, 57, 'ea0154f7f48af0ed5d2768c7ffa46592', '7c2657e9ecd38058867757cca7d5e5ad55e66d12', '2020-11-24 22:29:59'),
(415, 57, 'cd46d4a370ea36976bad7ceb8c22c8bf', '4d20a5b44af5f20727e7364c2a1d155d269b6078', '2020-11-25 21:04:54'),
(419, 89, 'c10c66deac0374d1ad04058627762b2e', '4ff1c6931196228d200f6f5795dfff0a84d68bfd', '2020-11-30 08:19:45'),
(423, 89, 'f70ab9ead224cc9b5ac7d1ff65d416fa', 'd83be5e9a3b3767bf35b124419cf2ebd50c5d091', '2020-11-30 09:27:19');

-- --------------------------------------------------------

--
-- Table structure for table `simple_search`
--

CREATE TABLE IF NOT EXISTS `simple_search` (
  `query_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `matno` varchar(20) DEFAULT NULL,
  `pid` tinyint(1) DEFAULT NULL,
  `salutation` tinyint(1) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `birthday` tinyint(1) DEFAULT NULL,
  `nationality` tinyint(1) DEFAULT NULL,
  `home_address` tinyint(1) DEFAULT NULL,
  `abroad_address` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE IF NOT EXISTS `status` (
  `status_id` int(10) unsigned NOT NULL,
  `name` varchar(255) NOT NULL
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

CREATE TABLE IF NOT EXISTS `student` (
  `student_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  `nationality_country_id` int(10) unsigned DEFAULT NULL,
  `home_address_id` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `student_status_id` int(10) unsigned DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=107 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`student_id`, `user_id`, `birthdate`, `nationality_country_id`, `home_address_id`, `created_at`, `updated_at`, `student_status_id`) VALUES
(19, 4, '2020-05-20', 102, 12, '2020-05-18 14:45:56', NULL, 3),
(23, NULL, '2020-05-28', 19, NULL, '2020-05-25 09:25:44', NULL, 5),
(24, NULL, '2020-05-28', 19, NULL, '2020-05-25 09:31:55', NULL, NULL),
(25, NULL, '2020-05-28', 19, NULL, '2020-05-25 14:27:12', NULL, NULL),
(26, NULL, '2020-05-28', 19, NULL, '2020-05-25 14:31:37', NULL, NULL),
(27, NULL, '2020-05-30', 18, NULL, '2020-05-27 09:45:27', NULL, NULL),
(61, 37, '1993-11-20', 82, NULL, '2020-07-22 14:12:22', NULL, 1),
(69, 53, '2020-07-30', 16, NULL, '2020-07-23 13:25:20', NULL, 1),
(73, 53, '2020-07-30', 16, NULL, '2020-07-23 16:35:56', NULL, NULL),
(77, 53, '2020-07-30', 16, NULL, '2020-07-23 19:13:02', NULL, NULL),
(81, NULL, NULL, NULL, NULL, '2020-11-02 10:21:46', NULL, 1),
(85, 77, '2020-12-04', 14, NULL, '2020-11-09 08:23:36', NULL, 1),
(89, 85, '1962-05-06', 82, NULL, '2020-11-09 08:50:11', NULL, 1),
(93, 89, '1995-05-21', 134, NULL, '2020-11-09 10:54:50', NULL, 1),
(97, 93, '1996-01-22', 103, NULL, '2020-11-09 10:55:52', NULL, 1),
(101, 97, '1995-08-09', 134, NULL, '2020-11-09 10:57:01', NULL, 1),
(105, 99, '1997-06-01', 134, NULL, '2020-11-09 10:58:18', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `student_status`
--

CREATE TABLE IF NOT EXISTS `student_status` (
  `student_status_id` int(10) unsigned NOT NULL,
  `status_name` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `student_status`
--

INSERT INTO `student_status` (`student_status_id`, `status_name`) VALUES
(1, 'interested'),
(2, 'applicant'),
(3, 'active'),
(4, 'alumni'),
(5, 'dropout');

-- --------------------------------------------------------

--
-- Table structure for table `study_home`
--

CREATE TABLE IF NOT EXISTS `study_home` (
  `application_id` int(10) unsigned NOT NULL,
  `home_university_id` int(10) unsigned DEFAULT NULL,
  `home_degree_id` int(10) unsigned DEFAULT NULL,
  `home_course_id` int(10) unsigned DEFAULT NULL,
  `home_matno` varchar(20) DEFAULT NULL,
  `home_cgpa` decimal(5,3) unsigned NOT NULL DEFAULT '0.000',
  `home_credits` decimal(10,3) unsigned NOT NULL DEFAULT '0.000',
  `home_semester` int(10) unsigned DEFAULT NULL,
  `home_enrollment_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `study_home`
--

INSERT INTO `study_home` (`application_id`, `home_university_id`, `home_degree_id`, `home_course_id`, `home_matno`, `home_cgpa`, `home_credits`, `home_semester`, `home_enrollment_date`) VALUES
(6, 12, 1, 47, '12347', 2.000, 124.000, 8, '2020-05-06'),
(13, 4, 1, 46, '12345', 1.000, 123.000, 3, '2020-05-27'),
(43, 4, 1, 57, '123456', 4.000, 240.000, 6, '2020-07-30'),
(59, 4, 2, 10, '123456', 1.700, 90.000, 3, '2018-10-01'),
(107, 4, 1, 7, '123456', 1.000, 123.000, 3, '2020-11-27'),
(111, 4, 1, 3, '1234567', 2.300, 90.000, 4, '1984-10-01'),
(115, 4, 1, 7, '1234561', 1.900, 100.000, 4, '2018-10-01'),
(119, 4, 1, 13, '1234562', 2.900, 120.000, 4, '2018-10-01'),
(123, 4, 1, 4, '1234563', 2.300, 50.000, 2, '2019-10-01'),
(127, 4, 1, 13, '1234564', 3.900, 100.000, 7, '2018-10-01');

-- --------------------------------------------------------

--
-- Table structure for table `study_host`
--

CREATE TABLE IF NOT EXISTS `study_host` (
  `exchange_id` int(10) unsigned NOT NULL,
  `foreign_uni_id` int(10) unsigned DEFAULT NULL,
  `foreign_degree_id` int(10) unsigned DEFAULT NULL,
  `foreign_course_id` int(10) unsigned DEFAULT NULL,
  `foreign_num_planed_exams` int(10) unsigned NOT NULL DEFAULT '0',
  `foreign_matno` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE IF NOT EXISTS `subject` (
  `subject_id` int(10) unsigned NOT NULL,
  `university_id` int(10) unsigned DEFAULT NULL,
  `degree_id` int(10) unsigned DEFAULT NULL,
  `course_id` int(10) unsigned DEFAULT NULL,
  `prof_id` int(10) unsigned DEFAULT NULL,
  `subject_code` varchar(45) DEFAULT NULL,
  `subject_title` varchar(255) NOT NULL,
  `subject_abbrev` varchar(45) DEFAULT NULL,
  `subject_credits` decimal(6,3) unsigned DEFAULT '0.000',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=302 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`subject_id`, `university_id`, `degree_id`, `course_id`, `prof_id`, `subject_code`, `subject_title`, `subject_abbrev`, `subject_credits`, `created_at`, `updated_at`) VALUES
(1, 4, 2, 1, 1, 'ZKB 40082', 'Verbrennungsmotoren', NULL, 4.000, '2019-09-24 17:27:39', '0000-00-00 00:00:00'),
(2, 4, 2, 1, 2, 'ZKB 40309', 'Air Pollution and Control', NULL, 4.000, '2019-09-24 17:49:56', '0000-00-00 00:00:00'),
(3, 2, 2, NULL, NULL, NULL, 'Energy Conversion Systems', NULL, 4.000, '2019-09-25 05:14:28', '2020-05-15 10:29:36'),
(4, 2, 2, NULL, NULL, NULL, 'Energy Recovery from waste and Biomass Fuels', '', 5.300, '2019-09-25 05:16:37', '2020-05-15 10:29:36'),
(5, 4, 2, NULL, 3, NULL, 'objektorientiere Methoden der Modellbildung und Simulation (Wahlbereich)', NULL, 3.000, '2019-09-26 11:17:27', '2020-05-15 10:29:36'),
(6, 2, 0, NULL, NULL, NULL, 'Mathematical Methods for Engineering Research', NULL, NULL, '2019-09-26 11:19:18', '2020-05-15 10:29:36'),
(7, 4, 1, 1, NULL, NULL, 'Thermodynamics 1 -inklusive Praktikum-', NULL, 5.000, '2020-04-20 07:22:06', '2020-05-15 10:29:36'),
(8, 4, 1, 1, NULL, NULL, 'Thermodynamics 2', NULL, 4.000, '2020-04-20 07:22:06', '2020-05-15 10:29:36'),
(9, 4, 1, 1, NULL, NULL, 'Maschinenelemente 2/ Machine Elements 2', NULL, 3.000, '2020-04-20 07:22:06', '2020-05-15 10:29:36'),
(10, 4, 1, 1, NULL, NULL, 'Baugruppenentwurf', NULL, 1.000, '2020-04-20 07:22:06', '2020-05-15 10:29:36'),
(11, 4, 1, 1, NULL, NULL, 'Produktentwurf', NULL, 3.000, '2020-04-20 07:22:06', '2020-05-15 10:29:36'),
(12, 4, 1, 1, NULL, NULL, 'Hausarbeit zum Produktentwurf', NULL, 2.000, '2020-04-20 07:22:06', '2020-05-15 10:29:36'),
(13, 4, 1, 1, NULL, NULL, 'Numerische Methoden für Ingenieure', NULL, 5.000, '2020-04-20 07:22:06', '2020-05-15 10:29:36'),
(14, 4, 1, 1, NULL, NULL, 'Regelungstechnik', NULL, 3.000, '2020-04-20 07:22:06', '2020-05-15 10:29:36'),
(15, 4, 1, 1, NULL, NULL, 'Einführung in die Automatisierungstechnik', NULL, 5.000, '2020-04-20 07:22:06', '2020-05-15 10:29:36'),
(16, 4, 1, 1, NULL, NULL, 'Systemdynamik', NULL, 2.000, '2020-04-20 07:22:06', '2020-05-15 10:29:36'),
(17, 4, 1, 1, NULL, NULL, 'Messtechnik ', NULL, 4.000, '2020-04-20 07:22:06', '2020-05-15 10:29:36'),
(18, 4, 1, 1, NULL, NULL, 'Introduction to Measurement Technology - inkluding Lab-', NULL, 5.000, '2020-04-20 07:22:06', '2020-05-15 10:29:36'),
(19, 4, 1, 1, NULL, NULL, 'Fundamentals of Electrical Engineering 1', NULL, 5.000, '2020-04-20 07:22:06', '2020-05-15 10:29:36'),
(20, 4, 1, 1, NULL, NULL, 'Grundlagen der Elektrotechnik 1', NULL, 7.000, '2020-04-20 07:22:06', '2020-05-15 10:29:36'),
(21, 4, 1, 1, NULL, NULL, 'Struktur von Mikrorechnern (ohne Praktikum) ', NULL, 3.000, '2020-04-20 07:22:06', '2020-05-15 10:29:36'),
(22, 4, 1, 1, NULL, NULL, 'Strukturdynamik', NULL, 4.000, '2020-04-20 07:22:06', '2020-05-15 10:29:36'),
(23, 4, 1, 1, NULL, NULL, 'Automobile Wertschöpfungskette', NULL, 3.000, '2020-04-20 07:22:06', '2020-05-15 10:29:36'),
(24, 4, 1, 1, NULL, NULL, 'Planung und Organisation', NULL, 4.000, '2020-04-20 07:22:06', '2020-05-15 10:29:36'),
(25, 4, 1, 1, NULL, NULL, 'Produktionsmanagement', NULL, 4.000, '2020-04-20 07:22:06', '2020-05-15 10:29:36'),
(26, 4, 1, 1, NULL, NULL, 'Project Management', NULL, 4.000, '2020-04-20 07:22:06', '2020-05-15 10:29:36'),
(27, 4, 1, 1, NULL, NULL, 'Operating Systems and Computer Networks', NULL, 3.000, '2020-04-20 07:22:06', '2020-05-15 10:29:36'),
(28, 4, 1, 1, NULL, NULL, 'Fluid Mechanics', NULL, 3.000, '2020-04-20 07:22:06', '2020-05-15 10:29:36'),
(29, 4, 1, 1, NULL, NULL, 'Kunststofftechnik', NULL, 4.000, '2020-04-20 07:22:06', '2020-05-15 10:29:36'),
(30, 4, 1, 1, NULL, NULL, 'Mathematics 3', NULL, 5.000, '2020-04-20 07:22:06', '2020-05-15 10:29:36'),
(31, 4, 1, 1, NULL, NULL, 'Project Management', NULL, 3.000, '2020-04-20 07:22:06', '2020-05-15 10:29:36'),
(32, 4, 1, 1, NULL, NULL, 'Fertigungslehre', NULL, 4.000, '2020-04-20 07:22:06', '2020-05-15 10:29:36'),
(33, 4, 1, 1, NULL, NULL, 'Verbrennungslehre', NULL, 4.000, '2020-04-20 07:22:06', '2020-05-15 10:29:36'),
(34, 4, 1, 1, NULL, NULL, 'Control Engineering (ohne Praktikum)', NULL, 3.000, '2020-04-20 07:22:06', '2020-05-15 10:29:36'),
(35, 4, 1, 1, NULL, NULL, 'Electronic Devices', NULL, 3.000, '2020-04-20 07:22:06', '2020-05-15 10:29:36'),
(36, 4, 0, 1, NULL, NULL, 'Sprach und Schlüsselkompetenz E1 Bereich', NULL, 2.000, '2020-04-20 07:22:06', '2020-06-03 14:07:40'),
(37, 4, 0, 1, NULL, NULL, 'Sprach und Schlüsselkompetenz E3 Bereich', NULL, 2.000, '2020-04-20 07:22:06', '2020-06-03 14:07:53'),
(38, 4, 1, 1, NULL, NULL, 'Bachelorarbeit', NULL, 0.000, '2020-04-20 07:22:06', '2020-05-15 10:29:36'),
(39, 4, 1, 1, NULL, NULL, 'Technische Darstellung', NULL, 5.000, '2020-04-20 07:22:06', '2020-05-15 10:29:36'),
(40, 4, 1, 1, NULL, NULL, 'Fundamentals of Electrical Engineering 2', NULL, 4.000, '2020-04-20 07:22:06', '2020-05-15 10:29:36'),
(41, 4, 1, 1, NULL, NULL, 'Grundlagen der Elektrotechnik 2', NULL, 7.000, '2020-04-20 07:22:06', '2020-05-15 10:29:36'),
(42, 4, 1, 1, NULL, NULL, 'Werkstoffkunde I1', NULL, 6.000, '2020-04-20 07:22:06', '2020-05-15 10:29:36'),
(43, 4, 1, 1, NULL, NULL, 'Werkstofftechnik I', NULL, 5.000, '2020-04-20 07:22:06', '2020-05-15 10:29:36'),
(44, 4, 1, 1, NULL, NULL, 'Mathematics 1', NULL, 6.000, '2020-04-20 07:22:06', '2020-05-15 10:29:36'),
(45, 4, 1, 1, NULL, NULL, 'Rechnergestützter Bauteilentwurf', NULL, 4.000, '2020-04-20 07:22:06', '2020-05-15 10:29:36'),
(46, 4, 1, 1, NULL, NULL, 'CAD', NULL, 2.000, '2020-04-20 07:22:06', '2020-05-15 10:29:36'),
(47, 4, 1, 1, NULL, NULL, 'Logistik und Materialfluss', NULL, 4.000, '2020-04-20 07:22:06', '2020-05-15 10:29:36'),
(48, 4, 1, 1, NULL, NULL, 'Electrical Machines', NULL, 4.000, '2020-04-20 07:22:06', '2020-05-15 10:29:36'),
(49, 4, 1, 1, NULL, NULL, 'Fluid Mechanics', NULL, 3.000, '2020-04-20 07:22:06', '2020-05-15 10:29:36'),
(50, 4, 1, 1, NULL, NULL, 'Projektarbeit', NULL, 0.000, '2020-04-20 07:22:06', '2020-05-15 10:29:36'),
(51, 4, 1, 1, NULL, NULL, 'Elektrotechnik', NULL, 0.000, '2020-04-20 07:22:06', '2020-05-15 10:29:36'),
(52, 4, 1, 1, NULL, NULL, 'Grundlagen des Marketing', NULL, 4.000, '2020-04-20 07:22:06', '2020-05-15 10:29:36'),
(53, 4, 1, 1, NULL, NULL, 'Mobilkommunikationstechnik', NULL, 3.000, '2020-04-20 07:22:06', '2020-05-15 10:29:36'),
(54, 4, 1, 1, NULL, NULL, 'Economics for Engineers', NULL, 2.000, '2020-04-20 07:22:06', '2020-05-15 10:29:36'),
(55, 4, 1, 1, NULL, NULL, 'Theory of Linear Systems', NULL, 4.000, '2020-04-20 07:22:06', '2020-05-15 10:29:36'),
(56, 4, 1, 1, NULL, NULL, 'Design Theory 3', NULL, 3.000, '2020-04-20 07:22:06', '2020-05-15 10:29:36'),
(57, 4, 1, 1, NULL, NULL, 'Metallurgie', NULL, 4.000, '2020-04-20 07:22:06', '2020-05-15 10:29:36'),
(58, 4, 1, 1, NULL, NULL, 'Moderne Produktionssysteme', NULL, 0.000, '2020-04-20 07:22:06', '2020-05-15 10:29:36'),
(59, 4, 1, 1, NULL, NULL, 'Produktionstechnik', NULL, 0.000, '2020-04-20 07:22:06', '2020-05-15 10:29:36'),
(60, 4, 1, 1, NULL, NULL, 'Technische Mechanik 1', NULL, 5.000, '2020-04-20 07:22:06', '2020-05-15 10:29:36'),
(61, 2, 1, 1, NULL, NULL, 'Thermodynamics and Heat Transfer', NULL, 5.300, '2020-04-20 07:22:06', '2020-05-15 10:29:36'),
(62, 2, 1, 1, NULL, NULL, 'Thermal System', NULL, 5.300, '2020-04-20 07:22:06', '2020-05-15 10:29:36'),
(63, 2, 1, 1, NULL, NULL, 'Machine Components Design', NULL, 5.300, '2020-04-20 07:22:06', '2020-05-15 10:29:36'),
(64, 2, 1, 1, NULL, NULL, 'Design Project', NULL, 5.300, '2020-04-20 07:22:06', '2020-05-15 10:29:36'),
(65, 2, 1, 1, NULL, NULL, 'Product Design', NULL, 5.300, '2020-04-20 07:22:06', '2020-05-15 10:29:36'),
(66, 2, 1, 1, NULL, NULL, 'Numerical Computations', NULL, 5.300, '2020-04-20 07:22:06', '2020-05-15 10:29:36'),
(67, 2, 1, 1, NULL, NULL, 'Control System Design', NULL, 5.300, '2020-04-20 07:22:06', '2020-05-15 10:29:36'),
(68, 2, 1, 1, NULL, NULL, 'Dynamics and Simulation Systems (including lab)', NULL, 5.300, '2020-04-20 07:22:06', '2020-05-15 10:29:36'),
(69, 2, 1, 1, NULL, NULL, 'Measurement and Instrumentation', NULL, 5.300, '2020-04-20 07:22:06', '2020-05-15 10:29:36'),
(70, 2, 1, 1, NULL, NULL, 'Electromagnetiv Fields and Waves', NULL, 5.700, '2020-04-20 07:22:06', '2020-05-15 10:29:36'),
(71, 2, 1, 1, NULL, NULL, 'Microprozessor and Microcomputer (including lab)', NULL, 5.300, '2020-04-20 07:22:06', '2020-05-15 10:29:36'),
(72, 2, 1, 1, NULL, NULL, 'Mechanical Vibration (no lab)', NULL, 5.300, '2020-04-20 07:22:06', '2020-05-15 10:29:36'),
(73, 2, 1, 1, NULL, NULL, 'Management of Manufacturing Strategy', NULL, 5.300, '2020-04-20 07:22:06', '2020-05-15 10:29:36'),
(74, 2, 1, 1, NULL, NULL, 'Engineering Economic and Entrepreneurship', NULL, 5.300, '2020-04-20 07:22:06', '2020-05-15 10:29:36'),
(75, 2, 1, 1, NULL, NULL, 'Production Planing and Control', NULL, 5.300, '2020-04-20 07:22:06', '2020-05-15 10:29:36'),
(76, 2, 1, 1, NULL, NULL, 'Engineering Management', NULL, 5.300, '2020-04-20 07:22:06', '2020-05-15 10:29:36'),
(77, 2, 1, 1, NULL, NULL, 'Operating Systems', NULL, 5.300, '2020-04-20 07:22:06', '2020-05-15 10:29:36'),
(78, 2, 1, 1, NULL, NULL, 'Fluid Mechanics', NULL, 5.300, '2020-04-20 07:22:06', '2020-05-15 10:29:36'),
(79, 2, 1, 1, NULL, NULL, 'Mechanics of Composite Processing', NULL, 5.300, '2020-04-20 07:22:06', '2020-05-15 10:29:36'),
(80, 2, 1, 1, NULL, NULL, 'Differential Equation', NULL, 5.300, '2020-04-20 07:22:06', '2020-05-15 10:29:36'),
(81, 2, 1, 1, NULL, NULL, 'Manufacturing Processes', NULL, 5.300, '2020-04-20 07:22:06', '2020-05-15 10:29:36'),
(82, 2, 1, 1, NULL, NULL, 'Combustions and Heat Systems', NULL, 4.000, '2020-04-20 07:22:06', '2020-05-15 10:29:36'),
(83, 2, 1, 1, NULL, NULL, 'Polymer Processing', NULL, 4.000, '2020-04-20 07:22:06', '2020-05-15 10:29:36'),
(84, 2, 1, 1, NULL, NULL, 'Control Engineering', NULL, 5.300, '2020-04-20 07:22:06', '2020-05-15 10:29:36'),
(85, 2, 1, 1, NULL, NULL, 'Analogue Electronics', NULL, 5.300, '2020-04-20 07:22:06', '2020-05-15 10:29:36'),
(86, 2, 1, 1, NULL, NULL, 'Language Course: English', NULL, 2.000, '2020-04-20 07:22:06', '2020-05-15 10:29:36'),
(87, 2, 1, 1, NULL, NULL, 'Cultural Course', NULL, 2.000, '2020-04-20 07:22:06', '2020-05-15 10:29:36'),
(88, 2, 1, 1, NULL, NULL, 'Language Course: Bahasa', NULL, 2.000, '2020-04-20 07:22:06', '2020-05-15 10:29:36'),
(89, 2, 1, 1, NULL, NULL, 'Engineering Design Graphic', NULL, 5.300, '2020-04-20 07:22:06', '2020-05-15 10:29:36'),
(90, 2, 1, 1, NULL, NULL, 'Circuit Theory 1', NULL, 5.700, '2020-04-20 07:22:06', '2020-05-15 10:29:36'),
(91, 2, 1, 1, NULL, NULL, 'Material Science', NULL, 4.000, '2020-04-20 07:22:06', '2020-05-15 10:29:36'),
(92, 2, 1, 1, NULL, NULL, 'Engineering Mathematics 1', NULL, 5.300, '2020-04-20 07:22:06', '2020-05-15 10:29:36'),
(93, 2, 1, 1, NULL, NULL, 'CAD/CAM', NULL, 5.300, '2020-04-20 07:22:06', '2020-05-15 10:29:36'),
(94, 2, 1, 1, NULL, NULL, 'Supply Chain Management', NULL, 0.000, '2020-04-20 07:22:06', '2020-05-15 10:29:36'),
(95, 2, 1, 1, NULL, NULL, 'Machine and Electronics Power', NULL, 0.000, '2020-04-20 07:22:06', '2020-05-15 10:29:36'),
(96, 2, 1, 1, NULL, NULL, 'Engineering Economics', NULL, 0.000, '2020-04-20 07:22:06', '2020-05-15 10:29:36'),
(97, 2, 1, 1, NULL, NULL, 'Machine Components Design', NULL, 4.000, '2020-04-20 07:22:06', '2020-05-15 10:29:36'),
(98, 2, 1, 1, NULL, NULL, 'Metal processing Theory', NULL, 4.000, '2020-04-20 07:22:06', '2020-05-15 10:29:36'),
(99, 2, 1, 1, NULL, NULL, 'Current Manufacturing Systems', NULL, 0.000, '2020-04-20 07:22:06', '2020-05-15 10:29:36'),
(100, 2, 1, 1, NULL, NULL, 'Production Tools', NULL, 0.000, '2020-04-20 07:22:06', '2020-05-15 10:29:36'),
(101, 4, 2, NULL, NULL, NULL, 'Mechanical and Biological Waste treatment', NULL, 4.000, '2020-06-03 13:39:54', NULL),
(102, 4, 2, NULL, NULL, NULL, 'Advanced sensors, applications, interfacing and signal processing', NULL, 4.000, '2020-06-03 13:42:59', NULL),
(103, 4, 2, NULL, NULL, NULL, 'Mess- und Prüftechnik', NULL, 4.000, '2020-06-03 13:42:59', NULL),
(104, 4, 2, NULL, NULL, NULL, 'Regenerative Energietechniken', NULL, 4.000, '2020-06-03 13:42:59', NULL),
(105, 4, 2, NULL, NULL, NULL, 'Die Methode der finiten Elemente', NULL, 4.000, '2020-06-03 13:42:59', NULL),
(106, 4, 2, NULL, NULL, NULL, 'Rapid and Virtual Prototyping', NULL, 4.000, '2020-06-03 13:42:59', NULL),
(107, 4, 2, NULL, NULL, NULL, 'Wertorientierte Steuerung', NULL, 4.000, '2020-06-03 13:42:59', NULL),
(108, 4, 2, NULL, NULL, NULL, 'Water Treatment', NULL, 4.000, '2020-06-03 13:42:59', NULL),
(109, 4, 2, NULL, NULL, NULL, 'Water Treatment 1', NULL, 4.000, '2020-06-03 13:42:59', NULL),
(110, 4, 2, NULL, NULL, NULL, 'Global Aspects of Environmental Protection', NULL, 4.000, '2020-06-03 13:42:59', NULL),
(111, 4, 2, NULL, NULL, NULL, 'Experimentelle Methoden in der Maschinen- und Prozessdiagnose ', NULL, 4.000, '2020-06-03 13:42:59', NULL),
(112, 4, 2, NULL, NULL, NULL, 'Test and Reliability', NULL, 4.000, '2020-06-03 13:42:59', NULL),
(113, 4, 2, NULL, NULL, NULL, 'Silizium - Halbleiterfertigung', NULL, 4.000, '2020-06-03 13:42:59', NULL),
(114, 4, 2, NULL, NULL, NULL, 'Betriebswirtschaftslehre', NULL, 4.000, '2020-06-03 14:00:13', NULL),
(115, 4, 2, NULL, NULL, NULL, 'Instrumentelle Bewegungsanalyse', NULL, 5.000, '2020-06-03 14:00:13', NULL),
(116, 4, 2, NULL, NULL, NULL, 'Internationale Organisationsstrukturen und Vernetzung', NULL, 0.000, '2020-06-03 14:00:13', NULL),
(117, 4, 2, NULL, NULL, NULL, 'Selbstführung, Mitarbeiterführung und Team- führung', NULL, 4.000, '2020-06-03 14:00:13', NULL),
(118, 4, 2, NULL, NULL, NULL, 'Kommunikationsnetze', NULL, 4.000, '2020-06-03 14:00:13', NULL),
(119, 4, 2, NULL, NULL, NULL, 'Leistungselektronik', NULL, 4.000, '2020-06-03 14:00:13', NULL),
(120, 4, 2, NULL, NULL, NULL, 'Technische Schadenskunde / Failure Analysis', NULL, 0.000, '2020-06-03 14:00:13', NULL),
(121, 4, 2, NULL, NULL, NULL, 'Design-to-Cost and Quality Management', NULL, 0.000, '2020-06-03 14:00:13', NULL),
(122, 4, 2, NULL, NULL, NULL, 'Absorption', NULL, 4.000, '2020-06-03 14:00:13', NULL),
(123, 4, 2, NULL, NULL, NULL, 'Numerics and Flow Simulation', NULL, 4.000, '2020-06-03 14:00:13', NULL),
(124, 4, 2, NULL, NULL, NULL, 'Strömungslehre 2', NULL, 4.000, '2020-06-03 14:00:13', NULL),
(125, 4, 2, NULL, NULL, NULL, 'International Economic Organization', NULL, 4.000, '2020-06-03 14:03:18', NULL),
(126, 4, 2, NULL, NULL, NULL, 'Econometrics for Master Students', NULL, 4.000, '2020-06-03 14:03:18', NULL),
(127, 4, 2, NULL, NULL, NULL, 'Internationale Finanzmärkte', NULL, 4.000, '2020-06-03 14:03:18', NULL),
(128, 4, 2, NULL, NULL, NULL, 'Empirische Forschungsmethoden', NULL, 4.000, '2020-06-03 14:03:18', NULL),
(129, 4, 2, NULL, NULL, NULL, 'Controlling', NULL, 4.000, '2020-06-03 14:03:18', NULL),
(130, 4, 2, NULL, NULL, NULL, 'Makroökonomie 2', NULL, 4.000, '2020-06-03 14:03:18', NULL),
(131, 4, 2, NULL, NULL, NULL, 'Steuerung der Mitarbeiterproduktivität ', NULL, 4.000, '2020-06-03 14:03:18', NULL),
(133, 4, 2, NULL, NULL, NULL, 'Mikroökonomie für interdisziplinäre Studiengänge', NULL, 4.000, '2020-06-03 14:03:18', NULL),
(134, 4, 2, NULL, NULL, NULL, 'Konzepte und Instrumente des Controllings', NULL, 4.000, '2020-06-03 14:03:18', NULL),
(135, 4, 2, NULL, NULL, NULL, 'Katalogfach "Wasseraufbereitung"', NULL, 4.000, '2020-06-03 14:03:18', NULL),
(136, 4, 2, NULL, NULL, NULL, 'Abfallwirtschaft 2 - Vertiefte Abfallwirtschaft', NULL, 6.000, '2020-06-03 14:03:18', NULL),
(137, 4, 2, NULL, NULL, NULL, 'Abfallwirtschaft 3 – Biologische Abfallbehandlung', NULL, 6.000, '2020-06-03 14:03:18', NULL),
(138, 4, 2, NULL, NULL, NULL, 'Lineare FEM oder Nichtlineare FEM ', NULL, 6.000, '2020-06-03 14:03:18', NULL),
(139, 4, 2, NULL, NULL, NULL, 'Projektmanagement', NULL, 4.000, '2020-06-03 14:05:52', NULL),
(141, 2, 2, NULL, NULL, NULL, 'Muncipal Solid Waste Management', NULL, 5.300, '2020-06-03 14:12:35', NULL),
(142, 2, 2, NULL, NULL, NULL, 'Advanced Instrumentation', NULL, 5.300, '2020-06-03 14:12:35', NULL),
(143, 2, 2, NULL, NULL, NULL, 'Combust System and Energy Recovery', NULL, 5.300, '2020-06-03 14:12:35', NULL),
(144, 2, 2, NULL, NULL, NULL, 'Engineering Computational Methods', NULL, 5.300, '2020-06-03 14:12:35', NULL),
(145, 2, 2, NULL, NULL, NULL, 'Mechanical Engineering Design', NULL, 5.300, '2020-06-03 14:12:35', NULL),
(146, 2, 2, NULL, NULL, NULL, 'Corporate Governance', NULL, 5.300, '2020-06-03 14:12:35', NULL),
(147, 2, 2, NULL, NULL, NULL, 'Sustainable water management and engineering', NULL, 5.300, '2020-06-03 14:12:35', NULL),
(148, 2, 2, NULL, NULL, NULL, 'Environment Management: Ecology, Audit and impact assesment', NULL, 5.300, '2020-06-03 14:12:35', NULL),
(149, 2, 2, NULL, NULL, NULL, 'Reliability and Test', NULL, 5.300, '2020-06-03 14:12:35', NULL),
(150, 2, 2, NULL, NULL, NULL, 'Micro/Nano Process Technology', NULL, 5.300, '2020-06-03 14:12:35', NULL),
(151, 2, 2, NULL, NULL, NULL, 'Political Economy of International Trade', NULL, 5.300, '2020-06-03 14:12:35', NULL),
(152, 2, 2, NULL, NULL, NULL, 'Econometric Methods', NULL, 5.300, '2020-06-03 14:12:35', NULL),
(153, 2, 2, NULL, NULL, NULL, 'Corporate Governance', NULL, 5.300, '2020-06-03 14:12:35', NULL),
(154, 2, 2, NULL, NULL, NULL, 'International Finance', NULL, 5.300, '2020-06-03 14:12:35', NULL),
(155, 2, 2, NULL, NULL, NULL, 'Research Methodology', NULL, 5.300, '2020-06-03 14:12:35', NULL),
(156, 2, 2, NULL, NULL, NULL, 'Management Accounting and Control', NULL, 5.300, '2020-06-03 14:12:35', NULL),
(157, 2, 2, NULL, NULL, NULL, 'Macroeconomics', NULL, 5.300, '2020-06-03 14:12:35', NULL),
(158, 2, 2, NULL, NULL, NULL, 'Human Resource Management(Malay)', NULL, 5.300, '2020-06-03 14:12:35', NULL),
(159, 2, 2, NULL, NULL, NULL, 'Engineering Projekt Management', NULL, 5.300, '2020-06-03 14:12:35', NULL),
(160, 2, 2, NULL, NULL, NULL, 'KKKM6114 Analytical Fluid Dynamics', NULL, 5.300, '2020-06-03 14:15:10', NULL),
(161, 2, 2, NULL, NULL, NULL, 'Computational Fluid Dynamics', NULL, 5.300, '2020-06-03 14:15:10', NULL),
(162, 2, 2, NULL, NULL, NULL, 'Pollution Control Equipment Design', NULL, 5.300, '2020-06-03 14:15:10', NULL),
(163, 2, 2, NULL, NULL, NULL, 'Material Failure Analysis', NULL, 5.300, '2020-06-03 14:15:10', NULL),
(164, 2, 2, NULL, NULL, NULL, 'Power Electronic', NULL, 5.300, '2020-06-03 14:15:10', NULL),
(165, 2, 2, NULL, NULL, NULL, 'Data Communication', NULL, 5.300, '2020-06-03 14:15:10', NULL),
(166, 2, 2, NULL, NULL, NULL, 'Instrumentation and Digital Control', NULL, 5.300, '2020-06-03 14:15:10', NULL),
(167, 2, 2, NULL, NULL, NULL, 'Engineering Ethic', NULL, 5.300, '2020-06-03 14:15:10', NULL),
(168, 2, 2, NULL, NULL, NULL, 'Mathematical Methods for Engineering Research', NULL, 5.300, '2020-06-03 14:15:10', NULL),
(169, 4, 2, NULL, NULL, NULL, 'Elective Course', NULL, 4.000, '2020-06-03 14:30:42', NULL),
(170, 2, 2, NULL, NULL, NULL, 'Microeconomics', NULL, 5.300, '2020-06-03 14:36:47', NULL),
(171, 5, 1, NULL, NULL, NULL, 'Thermodynamics', NULL, 5.250, '2020-06-08 15:01:43', NULL),
(172, 5, 1, NULL, NULL, NULL, 'Civil Engineering Drawing', NULL, 1.750, '2020-06-08 15:01:43', NULL),
(173, 5, 1, NULL, NULL, NULL, 'Operations Research', NULL, 5.250, '2020-06-08 15:01:43', NULL),
(174, 5, 1, NULL, NULL, NULL, 'Control Theory', NULL, 5.250, '2020-06-08 15:01:43', NULL),
(175, 5, 1, NULL, NULL, NULL, 'Human Resource Management', NULL, 5.250, '2020-06-08 15:01:43', NULL),
(176, 5, 1, NULL, NULL, NULL, 'Supply Chain and Logistics Management', NULL, 5.250, '2020-06-08 15:01:43', NULL),
(177, 5, 1, NULL, NULL, NULL, 'Strategic Management of Product Development', NULL, 5.250, '2020-06-08 15:01:43', NULL),
(178, 5, 1, NULL, NULL, NULL, 'Essentials of Project Management', NULL, 5.250, '2020-06-08 15:01:43', NULL),
(179, 5, 1, NULL, NULL, NULL, 'Absolute Basics for Career', NULL, 1.750, '2020-06-08 15:01:43', NULL),
(180, 5, 1, NULL, NULL, NULL, 'Engineering Design', NULL, 7.000, '2020-06-08 15:01:43', NULL),
(181, 5, 1, NULL, NULL, NULL, 'Modeling and Control', NULL, 5.250, '2020-06-08 15:01:43', NULL),
(182, 5, 1, NULL, NULL, NULL, 'Information Technology', NULL, 5.250, '2020-06-08 15:01:43', NULL),
(183, 5, 1, NULL, NULL, NULL, 'Solid Mechanics and vibrations', NULL, 5.250, '2020-06-08 15:01:43', NULL),
(184, 5, 0, NULL, NULL, NULL, 'Sprachkurs Bahasa', NULL, 5.250, '2020-06-08 15:01:43', NULL),
(185, 5, 0, NULL, NULL, NULL, 'Sprachkurs Englisch', NULL, 5.250, '2020-06-08 15:01:43', NULL),
(186, 5, 0, NULL, NULL, NULL, 'Cultural Course', NULL, 5.250, '2020-06-08 15:01:43', NULL),
(187, 5, 1, NULL, NULL, NULL, 'Mathematics 2', NULL, 5.250, '2020-06-08 15:01:43', NULL),
(188, 5, 1, NULL, NULL, NULL, 'Innovation and Technology Management', NULL, 5.250, '2020-06-08 15:01:43', NULL),
(189, 5, 1, NULL, NULL, NULL, 'Organizations and organizational\r\nChange', NULL, 5.250, '2020-06-08 15:01:43', NULL),
(190, 5, 1, NULL, NULL, NULL, 'Strategic Management', NULL, 7.000, '2020-06-08 15:01:43', NULL),
(191, 5, 1, NULL, NULL, NULL, 'Introduction to Electrical Circuits and Electronic Devices', NULL, 5.250, '2020-06-08 15:01:43', NULL),
(192, 5, 1, NULL, NULL, NULL, 'Product Design Engineering', NULL, 5.250, '2020-06-08 15:01:43', NULL),
(193, 5, 1, NULL, NULL, NULL, 'Management of Product Development', NULL, 5.250, '2020-06-08 15:01:43', NULL),
(194, 5, 1, NULL, NULL, NULL, 'Fundamental Engineering Materials', NULL, 5.250, '2020-06-08 15:01:43', NULL),
(195, 5, 1, NULL, NULL, NULL, 'Machine Element Design', NULL, 5.250, '2020-06-08 15:01:43', NULL),
(196, 5, 1, NULL, NULL, NULL, 'Mechanics of Materials', NULL, 5.250, '2020-06-08 15:01:43', NULL),
(197, 5, 1, NULL, NULL, NULL, 'Manufacturing Automation', NULL, 5.250, '2020-06-08 15:01:43', NULL),
(198, 5, 1, NULL, NULL, NULL, 'Dynamics & Control', NULL, 7.000, '2020-06-08 15:01:43', NULL),
(199, 5, 2, NULL, NULL, NULL, 'Planning & development of underground space in rock caverns', NULL, 5.250, '2020-06-08 15:16:22', NULL),
(200, 5, 2, NULL, NULL, NULL, 'Advanced concrete technology', NULL, 5.250, '2020-06-08 15:16:22', NULL),
(201, 5, 2, NULL, NULL, NULL, 'Soil behaviour & engineering properties', NULL, 5.250, '2020-06-08 15:16:22', NULL),
(202, 5, 2, NULL, NULL, NULL, 'Fatigue & fracture of steel structures', NULL, 5.250, '2020-06-08 15:16:22', NULL),
(203, 5, 2, NULL, NULL, NULL, 'Wastewater Treatment & Process Design', NULL, 7.000, '2020-06-08 15:16:22', NULL),
(204, 5, 2, NULL, NULL, NULL, 'Systems Simulation & Modeling', NULL, 5.250, '2020-06-08 15:16:22', NULL),
(205, 5, 2, NULL, NULL, NULL, 'Computational Intelligence: Methods and Applications', NULL, 5.250, '2020-06-08 15:16:22', NULL),
(206, 5, 2, NULL, NULL, NULL, 'Computational Fluid Dynamics', NULL, 7.000, '2020-06-08 15:16:22', NULL),
(207, 5, 2, NULL, NULL, NULL, 'Advanced Chemical Engineering Thermodynamics', NULL, 7.000, '2020-06-08 15:16:22', NULL),
(208, 5, 2, NULL, NULL, NULL, 'Nanotechnology and ist Applications', NULL, 7.000, '2020-06-08 15:16:22', NULL),
(209, 5, 2, NULL, NULL, NULL, 'Applied Econometrics', NULL, 5.250, '2020-06-08 15:16:22', NULL),
(210, 5, 2, NULL, NULL, NULL, 'Advanced Topics in Distributed Systems', NULL, 5.250, '2020-06-08 15:16:22', NULL),
(211, 5, 2, NULL, NULL, NULL, 'Air Quality Management', NULL, 7.000, '2020-06-08 15:16:22', NULL),
(212, 5, 2, NULL, NULL, NULL, 'Finite Element methods', NULL, 5.250, '2020-06-08 15:16:22', NULL),
(213, 5, 2, NULL, NULL, NULL, 'Quality Engineering', NULL, 5.250, '2020-06-08 15:16:22', NULL),
(214, 5, 2, NULL, NULL, NULL, 'Environmental earth systems science', NULL, 5.250, '2020-06-08 15:16:22', NULL),
(215, 5, 2, NULL, NULL, NULL, 'Water Quality Modeling', NULL, 5.250, '2020-06-08 15:16:22', NULL),
(216, 5, 2, NULL, NULL, NULL, 'Air Polution Control', NULL, 5.250, '2020-06-08 15:16:22', NULL),
(217, 5, 2, NULL, NULL, NULL, 'Manufacturing Control and Automation', NULL, 5.250, '2020-06-08 15:16:22', NULL),
(218, 5, 2, NULL, NULL, NULL, 'Human Computer Computer Interaction', NULL, 5.250, '2020-06-08 15:16:22', NULL),
(219, 5, 2, NULL, NULL, NULL, 'Information Visualisation', NULL, 5.250, '2020-06-08 15:16:22', NULL),
(220, 5, 2, NULL, NULL, NULL, 'Product Design & Development', NULL, 5.250, '2020-06-08 15:16:22', NULL),
(221, 5, 2, NULL, NULL, NULL, 'Advanced Manufacturing Processes', NULL, 5.250, '2020-06-08 15:16:22', NULL),
(222, 5, 2, NULL, NULL, NULL, 'Organisation of Knowledge', NULL, 5.250, '2020-06-08 15:16:22', NULL),
(223, 5, 2, NULL, NULL, NULL, 'Business Intelligence', NULL, 5.250, '2020-06-08 15:16:22', NULL),
(224, 5, 2, NULL, NULL, NULL, 'Management of Logistic Functions', NULL, 5.250, '2020-06-08 15:16:22', NULL),
(225, 5, 2, NULL, NULL, NULL, 'Fundamentals of Systems Engineering', NULL, 5.250, '2020-06-08 15:16:22', NULL),
(226, 5, 2, NULL, NULL, NULL, 'Systems & Project management', NULL, 5.250, '2020-06-08 15:16:22', NULL),
(227, 5, 2, NULL, NULL, NULL, 'ORGANISATIONAL LEADERSHIP', NULL, 5.250, '2020-06-08 15:16:22', NULL),
(228, 5, 2, NULL, NULL, NULL, 'Malay Language Level 1', NULL, 5.250, '2020-06-08 15:16:22', NULL),
(229, 5, 2, NULL, NULL, NULL, 'Soccer', NULL, 5.250, '2020-06-08 15:16:22', NULL),
(230, 5, 2, NULL, NULL, NULL, 'Advanced Mechanics of Materials', NULL, 5.250, '2020-06-08 15:16:22', NULL),
(231, 5, 2, NULL, NULL, NULL, 'Manufacturing & Service Operations Management', NULL, 5.250, '2020-06-08 15:16:22', NULL),
(232, 5, 2, NULL, NULL, NULL, 'Supply Chain & Logistics Management', NULL, 5.250, '2020-06-08 15:16:22', NULL),
(233, 5, 2, NULL, NULL, NULL, 'Statistical methods for transportation analysis', NULL, 0.000, '2020-06-08 15:16:22', NULL),
(234, 5, 2, NULL, NULL, NULL, 'Traffic impact & safty studies ', NULL, 0.000, '2020-06-08 15:16:22', NULL),
(235, 5, 2, NULL, NULL, NULL, 'Advanced Microeconomic Theory', NULL, 5.250, '2020-06-08 15:16:22', NULL),
(236, 5, 2, NULL, NULL, NULL, 'Distributed Multimedia Systems', NULL, 5.250, '2020-06-08 15:16:22', NULL),
(237, 5, 2, NULL, NULL, NULL, 'Quantitative Methods for llogistics Analysis', NULL, 5.250, '2020-06-08 15:16:22', NULL),
(238, 5, 2, NULL, NULL, NULL, 'Water Treatment & Process Design', NULL, 7.000, '2020-06-08 15:16:22', NULL),
(239, 5, 2, NULL, NULL, NULL, 'Project Management', NULL, 5.250, '2020-06-08 15:16:22', NULL),
(240, 5, 2, NULL, NULL, NULL, 'Project Financing', NULL, 5.250, '2020-06-08 15:16:22', NULL),
(241, 5, 2, NULL, NULL, NULL, 'International Construction and Marketing', NULL, 5.250, '2020-06-08 15:16:22', NULL),
(242, 5, 2, NULL, NULL, NULL, 'Wireless & Mobile Radio systems', NULL, 5.250, '2020-06-08 15:16:22', NULL),
(243, 5, 2, NULL, NULL, NULL, 'Computer Networks', NULL, 5.250, '2020-06-08 15:16:22', NULL),
(244, 5, 2, NULL, NULL, NULL, 'Process Control', NULL, 5.250, '2020-06-08 15:16:22', NULL),
(245, 5, 2, NULL, NULL, NULL, 'Computer Control Systems', NULL, 5.250, '2020-06-08 15:16:22', NULL),
(246, 5, 2, NULL, NULL, NULL, 'Neural & Fuzzy Systems', NULL, 5.250, '2020-06-08 15:16:22', NULL),
(247, 3, 1, NULL, NULL, NULL, 'Basic Physics 1', NULL, 5.600, '2020-06-08 15:30:24', NULL),
(248, 3, 1, NULL, NULL, NULL, 'Basic Physics 2', NULL, 5.600, '2020-06-08 15:30:24', NULL),
(249, 3, 1, NULL, NULL, NULL, 'Control System', NULL, 4.200, '2020-06-08 15:30:24', NULL),
(250, 3, 1, NULL, NULL, NULL, 'Polymer Technologies', NULL, 4.200, '2020-06-08 15:30:24', NULL),
(251, 3, 1, NULL, NULL, NULL, 'Electrical Power transmission and distribution', NULL, 4.200, '2020-06-08 15:30:24', NULL),
(252, 3, 1, NULL, NULL, NULL, 'Engineering Drawing', NULL, 2.800, '2020-06-08 15:30:24', NULL),
(253, 3, 1, NULL, NULL, NULL, 'Fluid mechanics', NULL, 4.200, '2020-06-08 15:30:24', NULL),
(254, 3, 1, NULL, NULL, NULL, 'Industrial Project Management', NULL, 2.800, '2020-06-08 15:30:24', NULL),
(255, 3, 0, NULL, NULL, NULL, 'Language Course: English', NULL, 2.000, '2020-06-08 15:30:24', NULL),
(256, 3, 0, NULL, NULL, NULL, 'Language Course: Bahasa', NULL, 2.000, '2020-06-08 15:30:24', NULL),
(257, 3, 0, NULL, NULL, NULL, 'Cultural Course', NULL, 2.000, '2020-06-08 15:30:24', NULL),
(258, 3, 1, NULL, NULL, NULL, 'Operations Research', NULL, 0.000, '2020-06-08 15:30:24', NULL),
(259, 3, 1, NULL, NULL, NULL, 'Transportation System', NULL, 0.000, '2020-06-08 15:30:24', NULL),
(260, 3, 1, NULL, NULL, NULL, 'Manufacturing System', NULL, 0.000, '2020-06-08 15:30:24', NULL),
(261, 3, 1, NULL, NULL, NULL, 'Industrial System Design', NULL, 8.400, '2020-06-08 15:30:24', NULL),
(262, 3, 1, NULL, NULL, NULL, 'System Dynamics', NULL, 4.200, '2020-06-08 15:30:24', NULL),
(263, 3, 1, NULL, NULL, NULL, 'New and Renewable Energy', NULL, 8.400, '2020-06-08 15:30:24', NULL),
(264, 3, 1, NULL, NULL, NULL, 'Fundamentals of Electrical Engineering', NULL, 0.000, '2020-06-08 15:30:24', NULL),
(265, 3, 1, NULL, NULL, NULL, 'Basic Thermodynamics', NULL, 0.000, '2020-06-08 15:30:24', NULL),
(266, 3, 1, NULL, NULL, NULL, 'Mechanics', NULL, 0.000, '2020-06-08 15:30:24', NULL),
(267, 3, 1, NULL, NULL, NULL, 'Mechanics of Materials(UI)', NULL, 0.000, '2020-06-08 15:31:40', NULL),
(268, 3, 1, NULL, NULL, NULL, 'Engineering Materials (MME)', NULL, 0.000, '2020-06-08 15:31:40', NULL),
(269, 3, 1, NULL, NULL, NULL, 'CAD VLSI', NULL, 0.000, '2020-06-08 15:31:40', NULL),
(270, 3, 2, NULL, NULL, NULL, 'Research and Computational Methods', NULL, 8.400, '2020-06-08 15:38:15', NULL),
(271, 3, 2, NULL, NULL, NULL, 'Kinetics and Phase Transformation', NULL, 8.400, '2020-06-08 15:38:15', NULL),
(272, 3, 2, NULL, NULL, NULL, 'Advanced Composites', NULL, 8.400, '2020-06-08 15:38:15', NULL),
(273, 3, 2, NULL, NULL, NULL, 'Mechanics of Materials', NULL, 8.400, '2020-06-08 15:38:15', NULL),
(274, 3, 2, NULL, NULL, NULL, 'Total Quality Management', NULL, 8.400, '2020-06-08 15:38:15', NULL),
(275, 3, 2, NULL, NULL, NULL, 'Industrial System Design', NULL, 8.400, '2020-06-08 15:38:15', NULL),
(276, 3, 2, NULL, NULL, NULL, 'Advanced Computer Architectures', NULL, 8.400, '2020-06-08 15:38:15', NULL),
(277, 3, 2, NULL, NULL, NULL, 'Industrial System Engineering', NULL, 8.400, '2020-06-08 15:38:15', NULL),
(278, 3, 2, NULL, NULL, NULL, 'Manufacturing Processes and System', NULL, 8.400, '2020-06-08 15:38:15', NULL),
(279, 3, 2, NULL, NULL, NULL, 'Electrical Power System Quality', NULL, 8.400, '2020-06-08 15:38:15', NULL),
(280, 3, 2, NULL, NULL, NULL, 'New and Renewable Energy', NULL, 8.400, '2020-06-08 15:38:15', NULL),
(281, 3, 2, NULL, NULL, NULL, 'Remote Sensing', NULL, 8.400, '2020-06-08 15:38:15', NULL),
(282, 3, 2, NULL, NULL, NULL, 'Industrial System Design', NULL, 8.400, '2020-06-08 15:38:15', NULL),
(283, 3, 2, NULL, NULL, NULL, 'Power generation Operation and Control', NULL, 8.400, '2020-06-08 15:38:15', NULL),
(284, 3, 2, NULL, NULL, NULL, 'Electrical Power System Planning', NULL, 8.400, '2020-06-08 15:38:15', NULL),
(285, 3, 2, NULL, NULL, NULL, 'Manufacturing Information System Management', NULL, 8.400, '2020-06-08 15:38:15', NULL),
(286, 3, 2, NULL, NULL, NULL, 'Human Capital Management', NULL, 8.400, '2020-06-08 15:38:15', NULL),
(287, 3, 2, NULL, NULL, NULL, 'Manufacturing System', NULL, 8.400, '2020-06-08 15:38:15', NULL),
(288, 3, 2, NULL, NULL, NULL, 'Technology Policy', NULL, 8.400, '2020-06-08 15:38:15', NULL),
(289, 3, 2, NULL, NULL, NULL, 'Service Engineering', NULL, 8.400, '2020-06-08 15:38:15', NULL),
(290, 4, NULL, NULL, NULL, NULL, 'Design to Cost und Qualitätsmanagement', NULL, 4.000, '2020-06-14 20:23:05', NULL),
(301, 4, 1, NULL, NULL, '33333', 'test23', NULL, 2.000, '2020-07-29 09:04:08', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `university`
--

CREATE TABLE IF NOT EXISTS `university` (
  `university_id` int(10) unsigned NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `abbreviation` varchar(45) DEFAULT NULL
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

CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int(10) unsigned NOT NULL,
  `user_group_id` int(10) unsigned NOT NULL,
  `salutation_id` int(10) unsigned NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `activated` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=101 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_group_id`, `salutation_id`, `firstname`, `lastname`, `email`, `password`, `created_at`, `updated_at`, `activated`) VALUES
(4, 1, 2, 'John', 'Doe', 'john.doe@stud.uni-due.de', '$2y$10$WLzEVWR/AoZbd1hMcR1sAOwqpp..1raJSAQee6.aTlc1v.KsmFtiS', '2020-05-18 13:54:00', '2020-07-14 10:28:45', 1),
(11, 2, 1, 'admin', 'muster', 'admin@uni-due.de', '$2y$10$P4CF3tkGUaFAt0slaVL8duHEcMt9JiXO.vhQJo.xmD7kzuAm8uPHG', '2020-07-13 06:09:41', '2020-07-14 10:28:45', 1),
(35, 2, 2, 'Christopher', 'Nagelmann', 'christopher.nagelmann@uni-due.de', '$2y$10$vLRb0TZE3fjMivHFRUriIuCUKeztDH1LEAR/hokbSlay/YUp9i9Ya', '2020-07-22 14:11:04', NULL, 0),
(37, 1, 2, 'Christopher', 'Nagelmann', 'christopher.nagelmann@uni-due.de', '$2y$10$YC7ktVPRKfpIkt.l.oElYu8yAOHUkGPmjIoTkKvKCxE0C0gWHtGKu', '2020-07-22 14:11:55', '2020-07-22 14:12:22', 1),
(53, 1, 1, 'ShetLin', 'Chu', 'shet.chu@stud.uni-due.de', '$2y$10$UPPvMGvLmhp7XFscubx3J.lMclGs.O.JY.9RyOYxPzue1NxqX6.Ga', '2020-07-23 13:24:35', '2020-11-02 09:22:31', 1),
(57, 2, 1, 'ShetLin', 'Chu', 'shet.chu@stud.uni-due.de', '$2y$10$BKFPap.WSLrtNtG2TrSR0eexwtTQttxuqtkzRWHc9ybQwzOikkL2a', '2020-07-23 14:33:58', '2020-07-23 14:35:16', 1),
(77, 1, 1, 'Shet Lin', 'Chu', 'linshet4@gmail.com', '$2y$10$ZT3diRpqGZCxDWUhPQ/aT.h5v2vnZHQxpX4zF7LlIvPhOXNZ7AKvm', '2020-11-09 08:23:19', '2020-11-09 08:23:36', 1),
(81, 2, 2, 'Stefan', 'Werner', 'stefan.werner@uni-due.de', '$2y$10$tVqxFHqwzv0eowA0avGJqukH/NKcd1r7/5e2Vh7ZsYrj4/yQQC9W.', '2020-11-09 08:48:49', '2020-11-09 08:49:09', 1),
(85, 1, 2, 'Stefan', 'Werner', 'stefan.werner@uni-due.de', '$2y$10$mMUJvBbn3cKtDPwShgaOvOMkAl5/5AgvHGl5ByCTfc6o1aGXhUYEG', '2020-11-09 08:49:56', '2020-11-09 08:50:11', 1),
(89, 1, 1, 'Emily', 'Johnson', 'ddstud.student1@gmail.com', '$2y$10$hm1kx7PlWfgDV0nvDrvH0OZxL3faSwRT/edSeGzOsvAwqi594pg4i', '2020-11-09 10:54:24', '2020-11-09 10:54:50', 1),
(93, 1, 1, 'John', 'Leong', 'ddstud.student2@gmail.com', '$2y$10$vBPIdLKE0w3YTcQO83eN7ufl3aCdKthLk.yF5HddgpobPagrhNMum', '2020-11-09 10:55:37', '2020-11-09 10:55:52', 1),
(97, 1, 2, 'Joshua', 'Tan', 'ddstud.student3@gmail.com', '$2y$10$cJ86AilG1PXOzuL/BZrKH.AoIiSOdJ5u2bT8rrpCXopPvbXz1Je4.', '2020-11-09 10:56:43', '2020-11-09 10:57:01', 1),
(99, 1, 1, 'Elizabeth', 'Chong', 'ddstud.student4@gmail.com', '$2y$10$Ymnvv1Ibut7GweT8mio9kuca0rVYSnrMoKumzaMPwEaDuGWSRFmze', '2020-11-09 10:57:29', '2020-11-09 10:58:18', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_group`
--

CREATE TABLE IF NOT EXISTS `user_group` (
  `user_group_id` int(10) unsigned NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_group`
--

INSERT INTO `user_group` (`user_group_id`, `name`) VALUES
(1, 'student'),
(2, 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `address`
--
ALTER TABLE `address`
  ADD PRIMARY KEY (`address_id`),
  ADD KEY `fk_address_country1_idx` (`country_id`);

--
-- Indexes for table `admin_list`
--
ALTER TABLE `admin_list`
  ADD PRIMARY KEY (`admin_email`);

--
-- Indexes for table `application`
--
ALTER TABLE `application`
  ADD PRIMARY KEY (`application_id`),
  ADD KEY `fk_application_student1_idx` (`student_id`),
  ADD KEY `fk_application_intention1_idx` (`intention_id`),
  ADD KEY `fk_application_degree1_idx` (`applied_degree_id`),
  ADD KEY `fk_application_exchange_period1_idx` (`exchange_period_id`),
  ADD KEY `fk_application_home_address_id` (`home_address_id`);

--
-- Indexes for table `applied_equivalence`
--
ALTER TABLE `applied_equivalence`
  ADD PRIMARY KEY (`application_id`,`equivalence_id`),
  ADD KEY `fk_applied_equivalence_equivalent_subjects1_idx` (`equivalence_id`),
  ADD KEY `fk_applied_equivalence_status` (`application_status_id`);

--
-- Indexes for table `country`
--
ALTER TABLE `country`
  ADD PRIMARY KEY (`country_id`),
  ADD UNIQUE KEY `name_UNIQUE` (`name`);

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`course_id`);

--
-- Indexes for table `degree`
--
ALTER TABLE `degree`
  ADD PRIMARY KEY (`degree_id`);

--
-- Indexes for table `email_activation`
--
ALTER TABLE `email_activation`
  ADD PRIMARY KEY (`user_id`,`activation_code`);

--
-- Indexes for table `equivalence_course`
--
ALTER TABLE `equivalence_course`
  ADD PRIMARY KEY (`equivalence_id`,`course_id`),
  ADD KEY `fk_course_id` (`course_id`);

--
-- Indexes for table `equivalence_quota`
--
ALTER TABLE `equivalence_quota`
  ADD PRIMARY KEY (`equivalence_id`,`exchange_period_id`),
  ADD UNIQUE KEY `fk_equivalence_id_1` (`equivalence_id`),
  ADD KEY `fk_exchange_period_id` (`exchange_period_id`);

--
-- Indexes for table `equivalent_subjects`
--
ALTER TABLE `equivalent_subjects`
  ADD PRIMARY KEY (`equivalence_id`),
  ADD KEY `fk_equivalent_subjects_status1_idx` (`status_id`),
  ADD KEY `fk_equivalent_subjects_user1_idx` (`created_by_user_id`),
  ADD KEY `fk_equivalent_subjects_user2_idx` (`updated_by_user_id`),
  ADD KEY `fk_equivalent_subjects_subject1_idx` (`home_subject_id`),
  ADD KEY `fk_equivalent_subjects_subject2_idx` (`foreign_subject_id`),
  ADD KEY `fk_equivalent_subjects_professor1_idx` (`signed_by_prof_id`),
  ADD KEY `fk_valid_degree_id` (`valid_degree_id`);

--
-- Indexes for table `exchange`
--
ALTER TABLE `exchange`
  ADD PRIMARY KEY (`exchange_id`) USING BTREE,
  ADD KEY `fk_exchange_application1_idx` (`application_id`),
  ADD KEY `fk_exchange_address1_idx` (`foreign_address_id`),
  ADD KEY `fk_foreign_uni_id` (`foreign_uni_id`);

--
-- Indexes for table `exchange_checklist`
--
ALTER TABLE `exchange_checklist`
  ADD PRIMARY KEY (`step_id`),
  ADD KEY `foreign_key_foreign_uni_id` (`foreign_uni_id`),
  ADD KEY `foreign_key_exchange_stage_id` (`exchange_stage_id`),
  ADD KEY `foreign_key_degree_id` (`degree_id`) USING BTREE;

--
-- Indexes for table `exchange_checklist_deadline`
--
ALTER TABLE `exchange_checklist_deadline`
  ADD PRIMARY KEY (`step_id`,`exchange_period_id`),
  ADD KEY `foreign_key_exchange_period_id` (`exchange_period_id`);

--
-- Indexes for table `exchange_checklist_student`
--
ALTER TABLE `exchange_checklist_student`
  ADD KEY `foreign_key_checklist_step_id` (`step_id`),
  ADD KEY `foreign_key_exchange_id` (`exchange_id`);

--
-- Indexes for table `exchange_equivalence`
--
ALTER TABLE `exchange_equivalence`
  ADD PRIMARY KEY (`exchange_id`,`equivalence_id`),
  ADD KEY `fk_exchanged_equivalence_equivalent_subjects1_idx` (`equivalence_id`);

--
-- Indexes for table `exchange_period`
--
ALTER TABLE `exchange_period`
  ADD PRIMARY KEY (`period_id`);

--
-- Indexes for table `exchange_stages`
--
ALTER TABLE `exchange_stages`
  ADD PRIMARY KEY (`stage_id`);

--
-- Indexes for table `intention`
--
ALTER TABLE `intention`
  ADD PRIMARY KEY (`intention_id`);

--
-- Indexes for table `priority`
--
ALTER TABLE `priority`
  ADD PRIMARY KEY (`application_id`),
  ADD KEY `fk_priority_university1_idx` (`first_uni_id`),
  ADD KEY `fk_priority_university2_idx` (`second_uni_id`),
  ADD KEY `fk_priority_university3_idx` (`third_uni_id`);

--
-- Indexes for table `professor`
--
ALTER TABLE `professor`
  ADD PRIMARY KEY (`professor_id`),
  ADD KEY `fk_professor_university1_idx` (`university_id`);

--
-- Indexes for table `reset_password`
--
ALTER TABLE `reset_password`
  ADD PRIMARY KEY (`user_id`,`password_code`);

--
-- Indexes for table `reviewed_application`
--
ALTER TABLE `reviewed_application`
  ADD PRIMARY KEY (`application_id`),
  ADD KEY `fk_reviewed_application_user1_idx` (`reviewed_by_user_id`),
  ADD KEY `fk_reviewed_application_status1_idx` (`application_status_id`);

--
-- Indexes for table `salutation`
--
ALTER TABLE `salutation`
  ADD PRIMARY KEY (`salutation_id`);

--
-- Indexes for table `securitytoken`
--
ALTER TABLE `securitytoken`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_securitytoken_user1_idx` (`user_id`);

--
-- Indexes for table `simple_search`
--
ALTER TABLE `simple_search`
  ADD PRIMARY KEY (`query_id`),
  ADD KEY `fk_simple_search_user_id1_idx` (`user_id`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`status_id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`student_id`) USING BTREE,
  ADD KEY `fk_student_user1_idx` (`user_id`),
  ADD KEY `fk_student_country1_idx` (`nationality_country_id`),
  ADD KEY `fk_student_address1_idx` (`home_address_id`),
  ADD KEY `fk_student_student_status_id` (`student_status_id`);

--
-- Indexes for table `student_status`
--
ALTER TABLE `student_status`
  ADD PRIMARY KEY (`student_status_id`);

--
-- Indexes for table `study_home`
--
ALTER TABLE `study_home`
  ADD PRIMARY KEY (`application_id`),
  ADD KEY `fk_study_home_degree1_idx` (`home_degree_id`),
  ADD KEY `fk_study_home_course1_idx` (`home_course_id`),
  ADD KEY `fk_study_home_university1_idx` (`home_university_id`);

--
-- Indexes for table `study_host`
--
ALTER TABLE `study_host`
  ADD PRIMARY KEY (`exchange_id`),
  ADD KEY `fk_study_host_university1_idx` (`foreign_uni_id`),
  ADD KEY `fk_study_host_degree1_idx` (`foreign_degree_id`),
  ADD KEY `fk_study_host_course1_idx` (`foreign_course_id`);

--
-- Indexes for table `subject`
--
ALTER TABLE `subject`
  ADD PRIMARY KEY (`subject_id`),
  ADD KEY `fk_subject_university1_idx` (`university_id`),
  ADD KEY `fk_subject_degree1_idx` (`degree_id`),
  ADD KEY `fk_subject_course1_idx` (`course_id`),
  ADD KEY `fk_subject_professor1_idx` (`prof_id`);

--
-- Indexes for table `university`
--
ALTER TABLE `university`
  ADD PRIMARY KEY (`university_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `fk_user_salutation_idx` (`salutation_id`),
  ADD KEY `fk_user_user_group1_idx` (`user_group_id`);

--
-- Indexes for table `user_group`
--
ALTER TABLE `user_group`
  ADD PRIMARY KEY (`user_group_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `address`
--
ALTER TABLE `address`
  MODIFY `address_id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=135;
--
-- AUTO_INCREMENT for table `application`
--
ALTER TABLE `application`
  MODIFY `application_id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=129;
--
-- AUTO_INCREMENT for table `country`
--
ALTER TABLE `country`
  MODIFY `country_id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=248;
--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
  MODIFY `course_id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=58;
--
-- AUTO_INCREMENT for table `degree`
--
ALTER TABLE `degree`
  MODIFY `degree_id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `equivalent_subjects`
--
ALTER TABLE `equivalent_subjects`
  MODIFY `equivalence_id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=147;
--
-- AUTO_INCREMENT for table `exchange`
--
ALTER TABLE `exchange`
  MODIFY `exchange_id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=69;
--
-- AUTO_INCREMENT for table `exchange_checklist`
--
ALTER TABLE `exchange_checklist`
  MODIFY `step_id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=33;
--
-- AUTO_INCREMENT for table `exchange_period`
--
ALTER TABLE `exchange_period`
  MODIFY `period_id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `exchange_stages`
--
ALTER TABLE `exchange_stages`
  MODIFY `stage_id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `intention`
--
ALTER TABLE `intention`
  MODIFY `intention_id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `professor`
--
ALTER TABLE `professor`
  MODIFY `professor_id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `salutation`
--
ALTER TABLE `salutation`
  MODIFY `salutation_id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `securitytoken`
--
ALTER TABLE `securitytoken`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=425;
--
-- AUTO_INCREMENT for table `simple_search`
--
ALTER TABLE `simple_search`
  MODIFY `query_id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `status`
--
ALTER TABLE `status`
  MODIFY `status_id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `student_id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=107;
--
-- AUTO_INCREMENT for table `student_status`
--
ALTER TABLE `student_status`
  MODIFY `student_status_id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `subject`
--
ALTER TABLE `subject`
  MODIFY `subject_id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=302;
--
-- AUTO_INCREMENT for table `university`
--
ALTER TABLE `university`
  MODIFY `university_id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=101;
--
-- AUTO_INCREMENT for table `user_group`
--
ALTER TABLE `user_group`
  MODIFY `user_group_id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
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
-- Constraints for table `equivalence_quota`
--
ALTER TABLE `equivalence_quota`
  ADD CONSTRAINT `fk_equivalence_id_1` FOREIGN KEY (`equivalence_id`) REFERENCES `equivalent_subjects` (`equivalence_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_exchange_period_id` FOREIGN KEY (`exchange_period_id`) REFERENCES `exchange_period` (`period_id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
-- Constraints for table `exchange_checklist`
--
ALTER TABLE `exchange_checklist`
  ADD CONSTRAINT `foreign_key_degree_id` FOREIGN KEY (`degree_id`) REFERENCES `degree` (`degree_id`) ON UPDATE CASCADE,
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
  ADD CONSTRAINT `foreign_key_checklist_step_id` FOREIGN KEY (`step_id`) REFERENCES `exchange_checklist` (`step_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `foreign_key_exchange_id` FOREIGN KEY (`exchange_id`) REFERENCES `exchange` (`exchange_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `exchange_equivalence`
--
ALTER TABLE `exchange_equivalence`
  ADD CONSTRAINT `fk_exchanged_equivalence_equivalent_subjects1` FOREIGN KEY (`equivalence_id`) REFERENCES `equivalent_subjects` (`equivalence_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_exchanged_equivalence_exchange1` FOREIGN KEY (`exchange_id`) REFERENCES `exchange` (`exchange_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `priority`
--
ALTER TABLE `priority`
  ADD CONSTRAINT `fk_priority_application1` FOREIGN KEY (`application_id`) REFERENCES `application` (`application_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_priority_university1` FOREIGN KEY (`first_uni_id`) REFERENCES `university` (`university_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_priority_university2` FOREIGN KEY (`second_uni_id`) REFERENCES `university` (`university_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_priority_university3` FOREIGN KEY (`third_uni_id`) REFERENCES `university` (`university_id`) ON DELETE SET NULL ON UPDATE CASCADE;

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
  ADD CONSTRAINT `fk_reviewed_application_user1` FOREIGN KEY (`reviewed_by_user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `securitytoken`
--
ALTER TABLE `securitytoken`
  ADD CONSTRAINT `fk_securitytoken_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `simple_search`
--
ALTER TABLE `simple_search`
  ADD CONSTRAINT `fk_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `student`
--
ALTER TABLE `student`
  ADD CONSTRAINT `fk_student_address1` FOREIGN KEY (`home_address_id`) REFERENCES `address` (`address_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_student_country1` FOREIGN KEY (`nationality_country_id`) REFERENCES `country` (`country_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_student_student_status_id` FOREIGN KEY (`student_status_id`) REFERENCES `student_status` (`student_status_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_student_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE SET NULL;

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

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
