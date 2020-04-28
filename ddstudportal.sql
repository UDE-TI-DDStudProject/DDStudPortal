-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 28. Okt 2019 um 14:51
-- Server-Version: 10.4.6-MariaDB
-- PHP-Version: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `ddstudportal`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `student_selectedsubjects`
--

CREATE TABLE `student_selectedsubjects`
(
  `equivalence_id` int
(15) NOT NULL,
  `personalid` int
(11) NOT NULL,
`created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON
UPDATE CURRENT_TIMESTAMP,
   UNIQUE KEY `UNIQUE_ROW`
(`equivalence_id`, `personalid`)
) ENGINE
=InnoDB DEFAULT CHARSET=utf8;

--
-- Tabellenstruktur für Tabelle `countries`
--

CREATE TABLE `countries` (
  `country` varchar(50) DEFAULT NULL,
  `countryid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `countries`
--

INSERT INTO `countries` (`country`, `countryid`) VALUES
(NULL, 1),
('Afghanistan', 2),
('Åland Islands', 3),
('Albania', 4),
('Algeria', 5),
('American Samoa', 6),
('Andorra', 7),
('Angola', 8),
('Anguilla', 9),
('Antarctica', 10),
('Antigua And Barbuda', 11),
('Argentina', 12),
('Armenia', 13),
('Aruba', 14),
('Australia', 15),
('Austria', 16),
('Azerbaijan', 17),
('Bahamas', 18),
('Bahrain', 19),
('Bangladesh', 20),
('Barbados', 21),
('Belarus', 22),
('Belgium', 23),
('Belize', 24),
('Benin', 25),
('Bermuda', 26),
('Bhutan', 27),
('Bolivia', 28),
('Bosnia And Herzegovina', 29),
('Botswana', 30),
('Bouvet Island', 31),
('Brazil', 32),
('British Indian Ocean Territory', 33),
('Brunei Darussalam', 34),
('Bulgaria', 35),
('Burkina Faso', 36),
('Burundi', 37),
('Cambodia', 38),
('Cameroon', 39),
('Canada', 40),
('Cape Verde', 41),
('Cayman Islands', 42),
('Central African Republic', 43),
('Chad', 44),
('Chile', 45),
('China', 46),
('Christmas Island', 47),
('Cocos (Keeling) Islands', 48),
('Colombia', 49),
('Comoros', 50),
('Congo', 51),
('Congo, The Democratic Republic Of The', 52),
('Cook Islands', 53),
('Costa Rica', 54),
('Côte D\'ivoire', 55),
('Croatia', 56),
('Cuba', 57),
('Cyprus', 58),
('Czech Republic', 59),
('Denmark', 60),
('Djibouti', 61),
('Dominica', 62),
('Dominican Republic', 63),
('Ecuador', 64),
('Egypt', 65),
('El Salvador', 66),
('Equatorial Guinea', 67),
('Eritrea', 68),
('Estonia', 69),
('Ethiopia', 70),
('Falkland Islands (Malvinas)', 71),
('Faroe Islands', 72),
('Fiji', 73),
('Finland', 74),
('France', 75),
('French Guiana', 76),
('French Polynesia', 77),
('French Southern Territories', 78),
('Gabon', 79),
('Gambia', 80),
('Georgia', 81),
('Germany', 82),
('Ghana', 83),
('Gibraltar', 84),
('Greece', 85),
('Greenland', 86),
('Grenada', 87),
('Guadeloupe', 88),
('Guam', 89),
('Guatemala', 90),
('Guernsey', 91),
('Guinea', 92),
('Guinea-Bissau', 93),
('Guyana', 94),
('Haiti', 95),
('Heard Island And Mcdonald Islands', 96),
('Holy See (Vatican City State)', 97),
('Honduras', 98),
('Hong Kong', 99),
('Hungary', 100),
('Iceland', 101),
('India', 102),
('Indonesia', 103),
('Iran, Islamic Republic Of', 104),
('Iraq', 105),
('Ireland', 106),
('Isle Of Man', 107),
('Israel', 108),
('Italy', 109),
('Jamaica', 110),
('Japan', 111),
('Jersey', 112),
('Jordan', 113),
('Kazakhstan', 114),
('Kenya', 115),
('Kiribati', 116),
('Korea, Democratic People\'s Republic Of', 117),
('Korea, Republic Of', 118),
('Kuwait', 119),
('Kyrgyzstan', 120),
('Lao People\'s Democratic Republic', 121),
('Latvia', 122),
('Lebanon', 123),
('Lesotho', 124),
('Liberia', 125),
('Libyan Arab Jamahiriya', 126),
('Liechtenstein', 127),
('Lithuania', 128),
('Luxembourg', 129),
('Macao', 130),
('Macedonia, The Former Yugoslav Republic Of', 131),
('Madagascar', 132),
('Malawi', 133),
('Malaysia', 134),
('Maldives', 135),
('Mali', 136),
('Malta', 137),
('Marshall Islands', 138),
('Martinique', 139),
('Mauritania', 140),
('Mauritius', 141),
('Mayotte', 142),
('Mexico', 143),
('Micronesia, Federated States Of', 144),
('Moldova, Republic Of', 145),
('Monaco', 146),
('Mongolia', 147),
('Montenegro', 148),
('Montserrat', 149),
('Morocco', 150),
('Mozambique', 151),
('Myanmar', 152),
('Namibia', 153),
('Nauru', 154),
('Nepal', 155),
('Netherlands', 156),
('Netherlands Antilles', 157),
('New Caledonia', 158),
('New Zealand', 159),
('Nicaragua', 160),
('Niger', 161),
('Nigeria', 162),
('Niue', 163),
('Norfolk Island', 164),
('Northern Mariana Islands', 165),
('Norway', 166),
('Oman', 167),
('Pakistan', 168),
('Palau', 169),
('Palestinian Territory, Occupied', 170),
('Panama', 171),
('Papua New Guinea', 172),
('Paraguay', 173),
('Peru', 174),
('Philippines', 175),
('Pitcairn', 176),
('Poland', 177),
('Portugal', 178),
('Puerto Rico', 179),
('Qatar', 180),
('Réunion', 181),
('Romania', 182),
('Russian Federation', 183),
('Rwanda', 184),
('Saint Barthélemy', 185),
('Saint Helena', 186),
('Saint Kitts And Nevis', 187),
('Saint Lucia', 188),
('Saint Martin', 189),
('Saint Pierre And Miquelon', 190),
('Saint Vincent And The Grenadines', 191),
('Samoa', 192),
('San Marino', 193),
('Sao Tome And Principe', 194),
('Saudi Arabia', 195),
('Senegal', 196),
('Serbia', 197),
('Seychelles', 198),
('Sierra Leone', 199),
('Singapore', 200),
('Slovakia', 201),
('Slovenia', 202),
('Solomon Islands', 203),
('Somalia', 204),
('South Africa', 205),
('South Georgia And The South Sandwich Islands', 206),
('Spain', 207),
('Sri Lanka', 208),
('Sudan', 209),
('Suriname', 210),
('Svalbard And Jan Mayen', 211),
('Swaziland', 212),
('Sweden', 213),
('Switzerland', 214),
('Syrian Arab Republic', 215),
('Taiwan, Province Of China', 216),
('Tajikistan', 217),
('Tanzania, United Republic Of', 218),
('Thailand', 219),
('Timor-Leste', 220),
('Togo', 221),
('Tokelau', 222),
('Tonga', 223),
('Trinidad And Tobago', 224),
('Tunisia', 225),
('Turkey', 226),
('Turkmenistan', 227),
('Turks And Caicos Islands', 228),
('Tuvalu', 229),
('Uganda', 230),
('Ukraine', 231),
('United Arab Emirates', 232),
('United Kingdom', 233),
('United States', 234),
('United States Minor Outlying Islands', 235),
('Uruguay', 236),
('Uzbekistan', 237),
('Vanuatu', 238),
('Venezuela, Bolivarian Republic Of', 239),
('Viet Nam', 240),
('Virgin Islands, British', 241),
('Virgin Islands, U.S.', 242),
('Wallis And Futuna', 243),
('Western Sahara', 244),
('Yemen', 245),
('Zambia', 246),
('Zimbabwe', 247);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `courses`
--

CREATE TABLE `courses` (
  `course` varchar(50) DEFAULT NULL,
  `courseid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `courses`
--

INSERT INTO `courses` (`course`, `courseid`) VALUES
(NULL, 1),
('Computer Science and Communications Engineering', 2),
('Electrical and Electronic Engineering', 3),
('Mechanical Engineering', 4),
('Civil Engineering, Environmental', 5),
('Civil Engineering, Structural', 6),
('Computer Engineering', 7),
('Wirtschaftsingenieur', 8),
('Wirtschaftsingenieur/MBau', 9),
('Wirtschaftsingenieur/IT', 10),
('Wirtschaftsingenieur/Energy', 11),
('Metalurgy and Metal Forming', 12),
('Civil Engineering', 13),
('Computational Mechanics', 14),
('Automotive Engineering', 15),
('Industrial Engineering', 16),
('Elektro und Informationstechnik', 17),
('Nano Engineering', 18),
('Maschinenbau', 19),
('Wirtschaftsingenieur/ Automotive Engineering', 20),
('Automation and Control Engineering', 22),
('Technische Logistik', 23),
('The Electronic Information Engineering', 24),
('Hydraulic and Hydropower Engineering', 25),
('Electric Engineering and Its Automation', 26),
('Computer Science and Technology', 27),
('Communications Engineering', 28),
('Mechnical Design, Manufacturing and Automation', 29),
('Software Engineering', 30),
('Logistik Management', 31),
('Measur and Control Technology and Instrument', 32),
('Computer Engineering-INS', 33),
('Computer Engineering-ISV', 34),
('Embedded Systems Engineering', 35),
('Power Engineering', 36),
('Mechanical Engineering-GME', 37),
('Mechanical Engineering-MT', 38),
('Mechanical Engineering-PaL', 39),
('Management and Technology of Water and Waste Water', 40),
('Mechanical Engineering-EaEE', 41),
('Computer Engineering-SWE', 42),
('Computer Engineering-Com', 43),
('Business Administration', 44),
('Economies', 45),
('Betriebswirtschaftslehre', 46),
('Bauingenieurwesen', 47),
('Structural Engineering', 48),
('Elektronic Information Engineering', 49),
('International Economics and Trade', 51),
('Inorganic non-metallic Materials Engineering', 53),
('Metal Material and Forming Process', 54),
('English', 55),
('Modern East Asian Studies', 56),
('Biologie', 57);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `degrees`
--

CREATE TABLE `degrees` (
  `degree_id` int(1) NOT NULL,
  `degree_name` text DEFAULT NULL,
  `degree_abbreviation` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `degrees`
--

INSERT INTO `degrees` (`degree_id`, `degree_name`, `degree_abbreviation`) VALUES
(0, NULL, NULL),
(1, 'Bachelor of Science', 'B.Sc.'),
(2, 'Master of Science', 'M.Sc.');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `equivalence_status`
--

CREATE TABLE `equivalence_status` (
  `status_id` int(10) NOT NULL,
  `status` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `equivalence_status`
--

INSERT INTO `equivalence_status` (`status_id`, `status`) VALUES
(1, 'Pending'),
(2, 'Equivalent'),
(3, 'Declined');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `equivalent_subjects`
--

CREATE TABLE `equivalent_subjects` (
  `equivalence_id` int(15) NOT NULL,
  `home_subject_id` int(15) NOT NULL,
  `valid_home_courses` varchar(30) NOT NULL DEFAULT 'all',
  `foreign_subject_id` int(15) NOT NULL,
  `status_id` int(1) DEFAULT NULL,
  `signed_by_prof_id` int(15) DEFAULT NULL,
  `accepted at` date DEFAULT NULL,
  `proof_doc_num` varchar(30) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `equivalent_subjects`
--

INSERT INTO `equivalent_subjects` (`equivalence_id`, `home_subject_id`, `valid_home_courses`, `foreign_subject_id`, `status_id`, `signed_by_prof_id`, `accepted at`, `proof_doc_num`, `created_at`, `updated_at`) VALUES
(1, 1, 'all', 3, 2, 1, NULL, NULL, '2019-09-25 07:17:51', '2019-09-25 07:19:44'),
(2, 2, 'all', 4, 2, 2, NULL, NULL, '2019-09-25 07:18:31', '2019-09-25 07:19:44'),
(3, 5, 'all', 6, 3, NULL, NULL, NULL, '2019-09-26 13:20:27', '2019-09-26 13:20:27');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `home_address`
--

CREATE TABLE `home_address` (
  `idhome_address` int(11) NOT NULL,
  `studentid` int(11) DEFAULT NULL,
  `home_street` text DEFAULT NULL,
  `home_co` varchar(45) DEFAULT NULL,
  `home_zip` varchar(10) DEFAULT NULL,
  `home_city` varchar(45) DEFAULT NULL,
  `home_state` varchar(50) DEFAULT NULL,
  `home_country` varchar(45) DEFAULT NULL,
  `home_phone` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `home_address`
--

INSERT INTO `home_address` (`idhome_address`, `studentid`, `home_street`, `home_co`, `home_zip`, `home_city`, `home_state`, `home_country`, `home_phone`) VALUES
(4711, 2014, 'straÃŸe 1', NULL, 'zip2', 'city 3', 'state 4', 'Belarus', '011'),
(4712, 2015, 'StraÃŸe 1', NULL, 'PLZ12', 'Ort1', 'state2', 'Germany', '123123');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `priority`
--

CREATE TABLE `priority` (
  `studentid` int(10) NOT NULL,
  `first_uni` varchar(20) DEFAULT NULL,
  `second_uni` varchar(20) DEFAULT NULL,
  `third_uni` varchar(20) DEFAULT NULL,
  `noexams_firstuni` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `priority`
--

INSERT INTO `priority` (`studentid`, `first_uni`, `second_uni`, `third_uni`, `noexams_firstuni`) VALUES
(2014, '2', '', '', ''),
(2015, '2', '3', '5', '5');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `professors`
--

CREATE TABLE `professors` (
  `prof_id` int(100) NOT NULL,
  `prof_surname` varchar(40) DEFAULT 'NULL',
  `prof_firstname` varchar(40) DEFAULT NULL,
  `prof_title` varchar(15) DEFAULT 'NULL',
  `university_id` int(100) NOT NULL,
  `created at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `professors`
--

INSERT INTO `professors` (`prof_id`, `prof_surname`, `prof_firstname`, `prof_title`, `university_id`, `created at`) VALUES
(1, 'Schulz', 'Stephan', 'Prof. Dr.', 4, '2019-09-24 19:35:28'),
(2, 'Haep', 'Stefan', 'Dr.', 4, '2019-09-24 19:47:32'),
(3, 'Schramm', 'Dieter', 'Prof. Dr.', 4, '2019-09-26 13:16:30');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `student_new`
--

CREATE TABLE `student_new` (
  `personalid` int(11) NOT NULL,
  `surname` varchar(45) NOT NULL,
  `firstname` varchar(45) NOT NULL,
  `email` varchar(45) DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `nationality` varchar(50) DEFAULT NULL,
  `gender` varchar(6) DEFAULT NULL,
  `overall_status` varchar(15) NOT NULL,
  `religion` varchar(45) DEFAULT NULL,
  `intention` varchar(45) DEFAULT NULL,
  `status_exams` varchar(15) DEFAULT NULL,
  `status_thesis` varchar(20) DEFAULT NULL,
  `status_industrial` varchar(25) DEFAULT NULL,
  `industrial_comment` varchar(50) DEFAULT NULL,
  `starting_semester` decimal(5,1) DEFAULT NULL,
  `aa_applicantno` varchar(45) DEFAULT NULL,
  `first_contactdate` date DEFAULT NULL,
  `last_update` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `comment` text DEFAULT NULL,
  `group_name` varchar(45) DEFAULT NULL,
  `interested_date` date DEFAULT NULL,
  `applicant_date` date DEFAULT NULL,
  `student_date` date DEFAULT NULL,
  `alumni_date` date DEFAULT NULL,
  `dropout_date` date DEFAULT NULL,
  `created_when` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by` varchar(45) NOT NULL,
  `last_update_by` varchar(45) DEFAULT NULL,
  `salutation` varchar(2) DEFAULT NULL,
  `stst_semesteryear` varchar(7) DEFAULT NULL,
  `user_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `student_new`
--

INSERT INTO `student_new` (`personalid`, `surname`, `firstname`, `email`, `birthday`, `nationality`, `gender`, `overall_status`, `religion`, `intention`, `status_exams`, `status_thesis`, `status_industrial`, `industrial_comment`, `starting_semester`, `aa_applicantno`, `first_contactdate`, `last_update`, `comment`, `group_name`, `interested_date`, `applicant_date`, `student_date`, `alumni_date`, `dropout_date`, `created_when`, `created_by`, `last_update_by`, `salutation`, `stst_semesteryear`, `user_id`) VALUES
(2015, 'Mustermann', 'Max', 'Max@Mustermann.de', '2019-10-09', 'Germany', NULL, 'Interested', NULL, 'Exchange', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-10-09 11:51:02', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0000-00-00 00:00:00', '', NULL, 'Mr', NULL, 7);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `study_home`
--

CREATE TABLE `study_home` (
  `home_university` varchar(30) DEFAULT NULL,
  `home_matno` varchar(20) DEFAULT NULL,
  `home_degree` varchar(40) DEFAULT NULL,
  `home_course` varchar(40) DEFAULT NULL,
  `studentid` varchar(11) NOT NULL,
  `home_cgpa` varchar(3) DEFAULT NULL,
  `home_credits` varchar(3) DEFAULT NULL,
  `home_semester` varchar(2) DEFAULT NULL,
  `home_enrollment` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `study_home`
--

INSERT INTO `study_home` (`home_university`, `home_matno`, `home_degree`, `home_course`, `studentid`, `home_cgpa`, `home_credits`, `home_semester`, `home_enrollment`) VALUES
('4', '123', '1', '28', '2014', '1.4', '10', '2', '22/2019'),
('4', '55564', '1', '9', '2015', '1-5', '25', '2', '20/15');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `subjects`
--

CREATE TABLE `subjects` (
  `subject_id` int(5) NOT NULL,
  `university_id` int(11) NOT NULL,
  `degree_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `prof_id` int(11) NOT NULL,
  `subject_code` varchar(20) DEFAULT NULL,
  `subject_title` varchar(100) DEFAULT NULL,
  `subject_abbrev` varchar(5) DEFAULT NULL,
  `subject_credits` decimal(2,1) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `last_updated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `subjects`
--

INSERT INTO `subjects` (`subject_id`, `university_id`, `degree_id`, `course_id`, `prof_id`, `subject_code`, `subject_title`, `subject_abbrev`, `subject_credits`, `created_at`, `last_updated`) VALUES
(1, 4, 2, 1, 1, 'ZKB 40082', 'Verbrennungsmotoren', NULL, '4.0', '2019-09-24 19:27:39', '2019-09-25 16:49:54'),
(2, 4, 2, 1, 2, 'ZKB 40309', 'Air Pollution and Control', NULL, '4.0', '2019-09-24 19:49:56', '2019-09-25 16:50:28'),
(3, 2, 2, 0, 0, NULL, 'Energy Conversion Systems', NULL, '4.0', '2019-09-25 07:14:28', '2019-09-25 07:14:28'),
(4, 2, 2, 0, 0, NULL, 'Energy Recovery from waste and Biomass Fuels', '', '5.3', '2019-09-25 07:16:37', '2019-09-25 07:16:37'),
(5, 4, 2, 0, 3, NULL, 'objektorientiere Methoden der Modellbildung und Simulation (Wahlbereich)', NULL, '3.0', '2019-09-26 13:17:27', '2019-09-26 18:52:21'),
(6, 2, 0, 0, 0, NULL, 'Mathematical Methods for Engineering Research', NULL, NULL, '2019-09-26 13:19:18', '2019-09-26 13:19:18');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `university`
--

CREATE TABLE `university` (
  `location` varchar(60) DEFAULT NULL,
  `locationid` int(11) NOT NULL,
  `locationabr` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `university`
--

INSERT INTO `university` (`location`, `locationid`, `locationabr`) VALUES
(NULL, 1, NULL),
('Universiti Kebangsaan Malaysia', 2, 'UKM'),
('Universitas Indonesia', 3, 'UI'),
('Universität Duisburg-Essen', 4, 'UDE'),
('Nanyang Technological University Singapore', 5, 'NTU'),
('Zhegzhou University', 6, 'ZZU'),
('University Wuhan', 7, 'UW'),
('German University in Cairo', 8, 'GUC'),
('Institut Teknologi Bandung', 9, 'ITB'),
('SIAS International University (SIAS)', 10, 'SIAS'),
('Zhengzhou University of Light Industry', 11, 'ZZULI'),
('German Malaysian Institute', 12, 'GMI'),
('Riam Institute of Technology', 13, 'RIAMTEC'),
('Universiti Tenaga Nasional', 14, 'UNITEN');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `passwort` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `vorname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `nachname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Daten für Tabelle `users`
--

INSERT INTO `users` (`id`, `email`, `passwort`, `vorname`, `nachname`, `created_at`, `updated_at`) VALUES
(7, 'Max@Mustermann.de', '$2y$10$Cyd42eev4G9ePRdAdS7aDeShObxmOOFZBEGR59eqRSNVmfUW5jl2G', 'Max', 'Mustermann', '2019-10-09 11:49:11', NULL);

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`countryid`);

--
-- Indizes für die Tabelle `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`courseid`);

--
-- Indizes für die Tabelle `degrees`
--
ALTER TABLE `degrees`
  ADD PRIMARY KEY (`degree_id`);

--
-- Indizes für die Tabelle `equivalence_status`
--
ALTER TABLE `equivalence_status`
  ADD PRIMARY KEY (`status_id`);

--
-- Indizes für die Tabelle `equivalent_subjects`
--
ALTER TABLE `equivalent_subjects`
  ADD PRIMARY KEY (`equivalence_id`);

--
-- Indizes für die Tabelle `home_address`
--
ALTER TABLE `home_address`
  ADD PRIMARY KEY (`idhome_address`),
  ADD UNIQUE KEY `studentid_2` (`studentid`),
  ADD KEY `studentid` (`studentid`);

--
-- Indizes für die Tabelle `priority`
--
ALTER TABLE `priority`
  ADD PRIMARY KEY (`studentid`);

--
-- Indizes für die Tabelle `professors`
--
ALTER TABLE `professors`
  ADD PRIMARY KEY (`prof_id`);

--
-- Indizes für die Tabelle `student_new`
--
ALTER TABLE `student_new`
  ADD PRIMARY KEY (`personalid`);

--
-- Indizes für die Tabelle `study_home`
--
ALTER TABLE `study_home`
  ADD PRIMARY KEY (`studentid`),
  ADD UNIQUE KEY `studentid` (`studentid`),
  ADD KEY `university_studentid` (`studentid`),
  ADD KEY `home_universityid` (`home_university`),
  ADD KEY `home_courseid` (`home_course`),
  ADD KEY `home_degreeid` (`home_degree`);

--
-- Indizes für die Tabelle `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`subject_id`);

--
-- Indizes für die Tabelle `university`
--
ALTER TABLE `university`
  ADD PRIMARY KEY (`locationid`);

--
-- Indizes für die Tabelle `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `countries`
--
ALTER TABLE `countries`
  MODIFY `countryid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=248;

--
-- AUTO_INCREMENT für Tabelle `courses`
--
ALTER TABLE `courses`
  MODIFY `courseid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT für Tabelle `equivalence_status`
--
ALTER TABLE `equivalence_status`
  MODIFY `status_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT für Tabelle `equivalent_subjects`
--
ALTER TABLE `equivalent_subjects`
  MODIFY `equivalence_id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT für Tabelle `home_address`
--
ALTER TABLE `home_address`
  MODIFY `idhome_address` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4713;

--
-- AUTO_INCREMENT für Tabelle `professors`
--
ALTER TABLE `professors`
  MODIFY `prof_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT für Tabelle `student_new`
--
ALTER TABLE `student_new`
  MODIFY `personalid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2016;

--
-- AUTO_INCREMENT für Tabelle `subjects`
--
ALTER TABLE `subjects`
  MODIFY `subject_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT für Tabelle `university`
---- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3308
-- Generation Time: Apr 28, 2020 at 09:44 AM
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
-- Table structure for table `countries`
--

DROP TABLE IF EXISTS `countries`;
CREATE TABLE IF NOT EXISTS `countries` (
  `country` varchar(50) DEFAULT NULL,
  `countryid` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`countryid`)
) ENGINE=InnoDB AUTO_INCREMENT=248 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`country`, `countryid`) VALUES
(NULL, 1),
('Afghanistan', 2),
('Åland Islands', 3),
('Albania', 4),
('Algeria', 5),
('American Samoa', 6),
('Andorra', 7),
('Angola', 8),
('Anguilla', 9),
('Antarctica', 10),
('Antigua And Barbuda', 11),
('Argentina', 12),
('Armenia', 13),
('Aruba', 14),
('Australia', 15),
('Austria', 16),
('Azerbaijan', 17),
('Bahamas', 18),
('Bahrain', 19),
('Bangladesh', 20),
('Barbados', 21),
('Belarus', 22),
('Belgium', 23),
('Belize', 24),
('Benin', 25),
('Bermuda', 26),
('Bhutan', 27),
('Bolivia', 28),
('Bosnia And Herzegovina', 29),
('Botswana', 30),
('Bouvet Island', 31),
('Brazil', 32),
('British Indian Ocean Territory', 33),
('Brunei Darussalam', 34),
('Bulgaria', 35),
('Burkina Faso', 36),
('Burundi', 37),
('Cambodia', 38),
('Cameroon', 39),
('Canada', 40),
('Cape Verde', 41),
('Cayman Islands', 42),
('Central African Republic', 43),
('Chad', 44),
('Chile', 45),
('China', 46),
('Christmas Island', 47),
('Cocos (Keeling) Islands', 48),
('Colombia', 49),
('Comoros', 50),
('Congo', 51),
('Congo, The Democratic Republic Of The', 52),
('Cook Islands', 53),
('Costa Rica', 54),
('Côte D\'ivoire', 55),
('Croatia', 56),
('Cuba', 57),
('Cyprus', 58),
('Czech Republic', 59),
('Denmark', 60),
('Djibouti', 61),
('Dominica', 62),
('Dominican Republic', 63),
('Ecuador', 64),
('Egypt', 65),
('El Salvador', 66),
('Equatorial Guinea', 67),
('Eritrea', 68),
('Estonia', 69),
('Ethiopia', 70),
('Falkland Islands (Malvinas)', 71),
('Faroe Islands', 72),
('Fiji', 73),
('Finland', 74),
('France', 75),
('French Guiana', 76),
('French Polynesia', 77),
('French Southern Territories', 78),
('Gabon', 79),
('Gambia', 80),
('Georgia', 81),
('Germany', 82),
('Ghana', 83),
('Gibraltar', 84),
('Greece', 85),
('Greenland', 86),
('Grenada', 87),
('Guadeloupe', 88),
('Guam', 89),
('Guatemala', 90),
('Guernsey', 91),
('Guinea', 92),
('Guinea-Bissau', 93),
('Guyana', 94),
('Haiti', 95),
('Heard Island And Mcdonald Islands', 96),
('Holy See (Vatican City State)', 97),
('Honduras', 98),
('Hong Kong', 99),
('Hungary', 100),
('Iceland', 101),
('India', 102),
('Indonesia', 103),
('Iran, Islamic Republic Of', 104),
('Iraq', 105),
('Ireland', 106),
('Isle Of Man', 107),
('Israel', 108),
('Italy', 109),
('Jamaica', 110),
('Japan', 111),
('Jersey', 112),
('Jordan', 113),
('Kazakhstan', 114),
('Kenya', 115),
('Kiribati', 116),
('Korea, Democratic People\'s Republic Of', 117),
('Korea, Republic Of', 118),
('Kuwait', 119),
('Kyrgyzstan', 120),
('Lao People\'s Democratic Republic', 121),
('Latvia', 122),
('Lebanon', 123),
('Lesotho', 124),
('Liberia', 125),
('Libyan Arab Jamahiriya', 126),
('Liechtenstein', 127),
('Lithuania', 128),
('Luxembourg', 129),
('Macao', 130),
('Macedonia, The Former Yugoslav Republic Of', 131),
('Madagascar', 132),
('Malawi', 133),
('Malaysia', 134),
('Maldives', 135),
('Mali', 136),
('Malta', 137),
('Marshall Islands', 138),
('Martinique', 139),
('Mauritania', 140),
('Mauritius', 141),
('Mayotte', 142),
('Mexico', 143),
('Micronesia, Federated States Of', 144),
('Moldova, Republic Of', 145),
('Monaco', 146),
('Mongolia', 147),
('Montenegro', 148),
('Montserrat', 149),
('Morocco', 150),
('Mozambique', 151),
('Myanmar', 152),
('Namibia', 153),
('Nauru', 154),
('Nepal', 155),
('Netherlands', 156),
('Netherlands Antilles', 157),
('New Caledonia', 158),
('New Zealand', 159),
('Nicaragua', 160),
('Niger', 161),
('Nigeria', 162),
('Niue', 163),
('Norfolk Island', 164),
('Northern Mariana Islands', 165),
('Norway', 166),
('Oman', 167),
('Pakistan', 168),
('Palau', 169),
('Palestinian Territory, Occupied', 170),
('Panama', 171),
('Papua New Guinea', 172),
('Paraguay', 173),
('Peru', 174),
('Philippines', 175),
('Pitcairn', 176),
('Poland', 177),
('Portugal', 178),
('Puerto Rico', 179),
('Qatar', 180),
('Réunion', 181),
('Romania', 182),
('Russian Federation', 183),
('Rwanda', 184),
('Saint Barthélemy', 185),
('Saint Helena', 186),
('Saint Kitts And Nevis', 187),
('Saint Lucia', 188),
('Saint Martin', 189),
('Saint Pierre And Miquelon', 190),
('Saint Vincent And The Grenadines', 191),
('Samoa', 192),
('San Marino', 193),
('Sao Tome And Principe', 194),
('Saudi Arabia', 195),
('Senegal', 196),
('Serbia', 197),
('Seychelles', 198),
('Sierra Leone', 199),
('Singapore', 200),
('Slovakia', 201),
('Slovenia', 202),
('Solomon Islands', 203),
('Somalia', 204),
('South Africa', 205),
('South Georgia And The South Sandwich Islands', 206),
('Spain', 207),
('Sri Lanka', 208),
('Sudan', 209),
('Suriname', 210),
('Svalbard And Jan Mayen', 211),
('Swaziland', 212),
('Sweden', 213),
('Switzerland', 214),
('Syrian Arab Republic', 215),
('Taiwan, Province Of China', 216),
('Tajikistan', 217),
('Tanzania, United Republic Of', 218),
('Thailand', 219),
('Timor-Leste', 220),
('Togo', 221),
('Tokelau', 222),
('Tonga', 223),
('Trinidad And Tobago', 224),
('Tunisia', 225),
('Turkey', 226),
('Turkmenistan', 227),
('Turks And Caicos Islands', 228),
('Tuvalu', 229),
('Uganda', 230),
('Ukraine', 231),
('United Arab Emirates', 232),
('United Kingdom', 233),
('United States', 234),
('United States Minor Outlying Islands', 235),
('Uruguay', 236),
('Uzbekistan', 237),
('Vanuatu', 238),
('Venezuela, Bolivarian Republic Of', 239),
('Viet Nam', 240),
('Virgin Islands, British', 241),
('Virgin Islands, U.S.', 242),
('Wallis And Futuna', 243),
('Western Sahara', 244),
('Yemen', 245),
('Zambia', 246),
('Zimbabwe', 247);

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

DROP TABLE IF EXISTS `courses`;
CREATE TABLE IF NOT EXISTS `courses` (
  `course` varchar(50) DEFAULT NULL,
  `courseid` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`courseid`)
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`course`, `courseid`) VALUES
(NULL, 1),
('Computer Science and Communications Engineering', 2),
('Electrical and Electronic Engineering', 3),
('Mechanical Engineering', 4),
('Civil Engineering, Environmental', 5),
('Civil Engineering, Structural', 6),
('Computer Engineering', 7),
('Wirtschaftsingenieur', 8),
('Wirtschaftsingenieur/MBau', 9),
('Wirtschaftsingenieur/IT', 10),
('Wirtschaftsingenieur/Energy', 11),
('Metalurgy and Metal Forming', 12),
('Civil Engineering', 13),
('Computational Mechanics', 14),
('Automotive Engineering', 15),
('Industrial Engineering', 16),
('Elektro und Informationstechnik', 17),
('Nano Engineering', 18),
('Maschinenbau', 19),
('Wirtschaftsingenieur/ Automotive Engineering', 20),
('Automation and Control Engineering', 22),
('Technische Logistik', 23),
('The Electronic Information Engineering', 24),
('Hydraulic and Hydropower Engineering', 25),
('Electric Engineering and Its Automation', 26),
('Computer Science and Technology', 27),
('Communications Engineering', 28),
('Mechnical Design, Manufacturing and Automation', 29),
('Software Engineering', 30),
('Logistik Management', 31),
('Measur and Control Technology and Instrument', 32),
('Computer Engineering-INS', 33),
('Computer Engineering-ISV', 34),
('Embedded Systems Engineering', 35),
('Power Engineering', 36),
('Mechanical Engineering-GME', 37),
('Mechanical Engineering-MT', 38),
('Mechanical Engineering-PaL', 39),
('Management and Technology of Water and Waste Water', 40),
('Mechanical Engineering-EaEE', 41),
('Computer Engineering-SWE', 42),
('Computer Engineering-Com', 43),
('Business Administration', 44),
('Economies', 45),
('Betriebswirtschaftslehre', 46),
('Bauingenieurwesen', 47),
('Structural Engineering', 48),
('Elektronic Information Engineering', 49),
('International Economics and Trade', 51),
('Inorganic non-metallic Materials Engineering', 53),
('Metal Material and Forming Process', 54),
('English', 55),
('Modern East Asian Studies', 56),
('Biologie', 57);

-- --------------------------------------------------------

--
-- Table structure for table `degrees`
--

DROP TABLE IF EXISTS `degrees`;
CREATE TABLE IF NOT EXISTS `degrees` (
  `degree_id` int(1) NOT NULL,
  `degree_name` text,
  `degree_abbreviation` text,
  PRIMARY KEY (`degree_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `degrees`
--

INSERT INTO `degrees` (`degree_id`, `degree_name`, `degree_abbreviation`) VALUES
(0, NULL, NULL),
(1, 'Bachelor of Science', 'B.Sc.'),
(2, 'Master of Science', 'M.Sc.');

-- --------------------------------------------------------

--
-- Table structure for table `equivalence_status`
--

DROP TABLE IF EXISTS `equivalence_status`;
CREATE TABLE IF NOT EXISTS `equivalence_status` (
  `status_id` int(10) NOT NULL AUTO_INCREMENT,
  `status` varchar(15) NOT NULL,
  PRIMARY KEY (`status_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `equivalence_status`
--

INSERT INTO `equivalence_status` (`status_id`, `status`) VALUES
(1, 'Pending'),
(2, 'Equivalent'),
(3, 'Declined');

-- --------------------------------------------------------

--
-- Table structure for table `equivalent_subjects`
--

DROP TABLE IF EXISTS `equivalent_subjects`;
CREATE TABLE IF NOT EXISTS `equivalent_subjects` (
  `equivalence_id` int(15) NOT NULL AUTO_INCREMENT,
  `home_subject_id` int(15) NOT NULL,
  `valid_home_courses` varchar(30) NOT NULL DEFAULT 'all',
  `foreign_subject_id` int(15) NOT NULL,
  `status_id` int(1) DEFAULT NULL,
  `signed_by_prof_id` int(15) DEFAULT NULL,
  `accepted at` date DEFAULT NULL,
  `proof_doc_num` varchar(30) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`equivalence_id`)
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `equivalent_subjects`
--

INSERT INTO `equivalent_subjects` (`equivalence_id`, `home_subject_id`, `valid_home_courses`, `foreign_subject_id`, `status_id`, `signed_by_prof_id`, `accepted at`, `proof_doc_num`, `created_at`) VALUES
(1, 1, 'all', 3, 2, 1, NULL, NULL, '2019-09-25 07:17:51'),
(2, 2, 'all', 4, 2, 2, NULL, NULL, '2019-09-25 07:18:31'),
(3, 5, 'all', 6, 3, NULL, NULL, NULL, '2019-09-26 13:20:27'),
(4, 7, 'all', 61, 2, NULL, NULL, NULL, '2020-04-20 10:34:28'),
(5, 8, 'all', 62, 2, NULL, NULL, NULL, '2020-04-20 10:34:28'),
(6, 9, 'all', 63, 2, NULL, NULL, NULL, '2020-04-20 10:34:28'),
(7, 10, 'all', 64, 2, NULL, NULL, NULL, '2020-04-20 10:34:28'),
(8, 11, 'all', 65, 2, NULL, NULL, NULL, '2020-04-20 10:34:28'),
(9, 12, 'all', 65, 2, NULL, NULL, NULL, '2020-04-20 10:34:28'),
(10, 13, 'all', 66, 2, NULL, NULL, NULL, '2020-04-20 10:34:28'),
(11, 14, 'all', 67, 2, NULL, NULL, NULL, '2020-04-20 10:34:28'),
(12, 15, 'all', 67, 2, NULL, NULL, NULL, '2020-04-20 10:34:28'),
(13, 16, 'all', 68, 2, NULL, NULL, NULL, '2020-04-20 10:34:28'),
(14, 17, 'all', 69, 2, NULL, NULL, NULL, '2020-04-20 10:34:28'),
(15, 18, 'all', 69, 2, NULL, NULL, NULL, '2020-04-20 10:34:28'),
(16, 19, 'all', 70, 2, NULL, NULL, NULL, '2020-04-20 10:34:28'),
(17, 20, 'all', 70, 2, NULL, NULL, NULL, '2020-04-20 10:34:28'),
(18, 21, 'all', 71, 2, NULL, NULL, NULL, '2020-04-20 10:34:28'),
(19, 22, 'all', 72, 2, NULL, NULL, NULL, '2020-04-20 10:34:28'),
(20, 23, 'all', 73, 2, NULL, NULL, NULL, '2020-04-20 10:34:28'),
(21, 24, 'all', 74, 2, NULL, NULL, NULL, '2020-04-20 10:34:28'),
(22, 25, 'all', 75, 2, NULL, NULL, NULL, '2020-04-20 10:34:28'),
(23, 26, 'all', 76, 2, NULL, NULL, NULL, '2020-04-20 10:34:28'),
(24, 27, 'all', 77, 2, NULL, NULL, NULL, '2020-04-20 10:34:28'),
(25, 28, 'all', 78, 2, NULL, NULL, NULL, '2020-04-20 10:34:28'),
(26, 29, 'all', 79, 2, NULL, NULL, NULL, '2020-04-20 10:34:28'),
(27, 29, 'all', 83, 2, NULL, NULL, NULL, '2020-04-20 10:34:28'),
(28, 30, 'all', 80, 2, NULL, NULL, NULL, '2020-04-20 10:34:28'),
(29, 31, 'all', 75, 2, NULL, NULL, NULL, '2020-04-20 10:34:28'),
(30, 32, 'all', 81, 2, NULL, NULL, NULL, '2020-04-20 10:34:28'),
(31, 33, 'all', 82, 2, NULL, NULL, NULL, '2020-04-20 10:34:28'),
(32, 34, 'all', 84, 2, NULL, NULL, NULL, '2020-04-20 10:34:28'),
(33, 35, 'all', 85, 2, NULL, NULL, NULL, '2020-04-20 10:34:28'),
(34, 36, 'all', 86, 2, NULL, NULL, NULL, '2020-04-20 10:34:28'),
(35, 36, 'all', 88, 2, NULL, NULL, NULL, '2020-04-20 10:34:28'),
(36, 37, 'all', 87, 2, NULL, NULL, NULL, '2020-04-20 10:34:28'),
(37, 39, 'all', 89, 3, NULL, NULL, NULL, '2020-04-20 10:34:28'),
(38, 40, 'all', 90, 3, NULL, NULL, NULL, '2020-04-20 10:34:28'),
(39, 41, 'all', 90, 3, NULL, NULL, NULL, '2020-04-20 10:34:28'),
(40, 42, 'all', 91, 3, NULL, NULL, NULL, '2020-04-20 10:34:28'),
(41, 43, 'all', 91, 3, NULL, NULL, NULL, '2020-04-20 10:34:28'),
(42, 44, 'all', 92, 3, NULL, NULL, NULL, '2020-04-20 10:34:28'),
(43, 45, 'all', 93, 3, NULL, NULL, NULL, '2020-04-20 10:34:28'),
(44, 46, 'all', 93, 3, NULL, NULL, NULL, '2020-04-20 10:34:28'),
(45, 47, 'all', 94, 3, NULL, NULL, NULL, '2020-04-20 10:34:28'),
(46, 48, 'all', 95, 3, NULL, NULL, NULL, '2020-04-20 10:34:28');

-- --------------------------------------------------------

--
-- Table structure for table `home_address`
--

DROP TABLE IF EXISTS `home_address`;
CREATE TABLE IF NOT EXISTS `home_address` (
  `idhome_address` int(11) NOT NULL,
  `studentid` int(11) DEFAULT NULL,
  `home_street` text,
  `home_co` varchar(45) DEFAULT NULL,
  `home_zip` varchar(10) DEFAULT NULL,
  `home_city` varchar(45) DEFAULT NULL,
  `home_state` varchar(50) DEFAULT NULL,
  `home_country` varchar(45) DEFAULT NULL,
  `home_phone` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idhome_address`),
  UNIQUE KEY `studentid_2` (`studentid`),
  KEY `studentid` (`studentid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `home_address`
--

INSERT INTO `home_address` (`idhome_address`, `studentid`, `home_street`, `home_co`, `home_zip`, `home_city`, `home_state`, `home_country`, `home_phone`) VALUES
(0, 0, 'street 5', NULL, '41234', 'Duisburg', 'nrw', 'Germany', '12345667'),
(4711, 2014, 'straÃŸe 1', NULL, 'zip2', 'city 3', 'state 4', 'Belarus', '011'),
(4712, 2015, 'StraÃŸe 1', NULL, 'PLZ12', 'Ort1', 'state2', 'Germany', '123123');

-- --------------------------------------------------------

--
-- Table structure for table `priority`
--

DROP TABLE IF EXISTS `priority`;
CREATE TABLE IF NOT EXISTS `priority` (
  `studentid` int(10) NOT NULL,
  `first_uni` varchar(20) DEFAULT NULL,
  `second_uni` varchar(20) DEFAULT NULL,
  `third_uni` varchar(20) DEFAULT NULL,
  `noexams_firstuni` varchar(2) NOT NULL,
  PRIMARY KEY (`studentid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `priority`
--

INSERT INTO `priority` (`studentid`, `first_uni`, `second_uni`, `third_uni`, `noexams_firstuni`) VALUES
(0, '2', '3', '5', '0'),
(2014, '2', '', '', ''),
(2015, '2', '3', '5', '5');

-- --------------------------------------------------------

--
-- Table structure for table `professors`
--

DROP TABLE IF EXISTS `professors`;
CREATE TABLE IF NOT EXISTS `professors` (
  `prof_id` int(100) NOT NULL,
  `prof_surname` varchar(40) DEFAULT 'NULL',
  `prof_firstname` varchar(40) DEFAULT NULL,
  `prof_title` varchar(15) DEFAULT 'NULL',
  `university_id` int(100) NOT NULL,
  `created at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`prof_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `professors`
--

INSERT INTO `professors` (`prof_id`, `prof_surname`, `prof_firstname`, `prof_title`, `university_id`, `created at`) VALUES
(1, 'Schulz', 'Stephan', 'Prof. Dr.', 4, '2019-09-24 19:35:28'),
(2, 'Haep', 'Stefan', 'Dr.', 4, '2019-09-24 19:47:32'),
(3, 'Schramm', 'Dieter', 'Prof. Dr.', 4, '2019-09-26 13:16:30');

-- --------------------------------------------------------

--
-- Table structure for table `securitytokens`
--

DROP TABLE IF EXISTS `securitytokens`;
CREATE TABLE IF NOT EXISTS `securitytokens` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(10) NOT NULL,
  `identifier` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `securitytoken` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `securitytokens`
--

INSERT INTO `securitytokens` (`id`, `user_id`, `identifier`, `securitytoken`, `created_at`) VALUES
(1, 8, 'bdb3ef4165dd9dd39264da6b77df6eb3', '7dce590b6ab00bcf9fa7fb099686fd4b21550636', '2020-04-06 08:41:10'),
(2, 8, 'f5ac3563330f3e9908f61e011c582c4b', '1c4cf5422044f6866d7668c4331175eb8dd1a841', '2020-04-06 09:51:51'),
(3, 8, 'f95693359fb2e02f170d3fd69c9d2785', '97689bc7cb1b0652d957c04ddc6564e8866d5139', '2020-04-06 12:25:58'),
(4, 8, '6fdee045849443f6e64f31f4ef1d5008', 'd40959ec536db8b7f548c70156f26c1b0621f818', '2020-04-06 12:25:59'),
(5, 8, '4b34a756a02015268e916095eea2da16', '634ddcf4a67d5af50c11a5436d9bee620bb1a677', '2020-04-12 12:04:36'),
(6, 8, '9922a582dc92cfda05cedd752d1585b7', '3c236ba14152c20602f378e73b00833af680823e', '2020-04-18 13:13:18'),
(7, 8, 'b1e8f67fdea40dd90c71728bce60c839', 'b83f3f39693e8d57717fa8b3f04cf8335d914d17', '2020-04-19 13:11:00'),
(8, 8, '53f06df26ca1cb37dda8807be7b6aadd', '27739bce8f9768dfc7b36f76fb2f218b3e2c550b', '2020-04-20 08:31:24'),
(9, 8, 'ce56f00476b6faa22f92219cf26576e4', 'c6c45ad265b93e1eb3284ad80d79e907e610d45a', '2020-04-20 08:33:06');

-- --------------------------------------------------------

--
-- Table structure for table `student_new`
--

DROP TABLE IF EXISTS `student_new`;
CREATE TABLE IF NOT EXISTS `student_new` (
  `personalid` int(11) NOT NULL,
  `surname` varchar(45) NOT NULL,
  `firstname` varchar(45) NOT NULL,
  `email` varchar(45) DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `nationality` varchar(50) DEFAULT NULL,
  `gender` varchar(6) DEFAULT NULL,
  `overall_status` varchar(15) NOT NULL,
  `religion` varchar(45) DEFAULT NULL,
  `intention` varchar(45) DEFAULT NULL,
  `status_exams` varchar(15) DEFAULT NULL,
  `status_thesis` varchar(20) DEFAULT NULL,
  `status_industrial` varchar(25) DEFAULT NULL,
  `industrial_comment` varchar(50) DEFAULT NULL,
  `starting_semester` decimal(5,1) DEFAULT NULL,
  `aa_applicantno` varchar(45) DEFAULT NULL,
  `first_contactdate` date DEFAULT NULL,
  `last_update` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `comment` text,
  `group_name` varchar(45) DEFAULT NULL,
  `interested_date` date DEFAULT NULL,
  `applicant_date` date DEFAULT NULL,
  `student_date` date DEFAULT NULL,
  `alumni_date` date DEFAULT NULL,
  `dropout_date` date DEFAULT NULL,
  `created_when` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by` varchar(45) NOT NULL,
  `last_update_by` varchar(45) DEFAULT NULL,
  `salutation` varchar(2) DEFAULT NULL,
  `stst_semesteryear` varchar(7) DEFAULT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `successFactor` decimal(5,3) NOT NULL DEFAULT '0.000',
  PRIMARY KEY (`personalid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `student_new`
--

INSERT INTO `student_new` (`personalid`, `surname`, `firstname`, `email`, `birthday`, `nationality`, `gender`, `overall_status`, `religion`, `intention`, `status_exams`, `status_thesis`, `status_industrial`, `industrial_comment`, `starting_semester`, `aa_applicantno`, `first_contactdate`, `comment`, `group_name`, `interested_date`, `applicant_date`, `student_date`, `alumni_date`, `dropout_date`, `created_when`, `created_by`, `last_update_by`, `salutation`, `stst_semesteryear`, `user_id`, `created_at`, `successFactor`) VALUES
(0, 'chu', 'shet', 'shet.chu@stud.uni-due.de', '2020-04-15', 'Malaysia', NULL, 'Interested', NULL, 'Exchange', NULL, NULL, NULL, NULL, '2020.5', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0000-00-00 00:00:00', '', NULL, 'Ms', NULL, 8, '2020-04-20 14:03:53', '1.500'),
(2015, 'Mustermann', 'Max', 'Max@Mustermann.de', '2019-10-09', 'Germany', NULL, 'Interested', NULL, 'Exchange', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0000-00-00 00:00:00', '', NULL, 'Mr', NULL, 7, '2020-04-20 09:33:46', '0.000');

-- --------------------------------------------------------

--
-- Table structure for table `student_selectedsubjects`
--

DROP TABLE IF EXISTS `student_selectedsubjects`;
CREATE TABLE IF NOT EXISTS `student_selectedsubjects` (
  `equivalence_id` int(15) NOT NULL,
  `personalid` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  UNIQUE KEY `UNIQUE_ROW` (`equivalence_id`,`personalid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `student_selectedsubjects`
--

INSERT INTO `student_selectedsubjects` (`equivalence_id`, `personalid`, `created_at`) VALUES
(1, 0, '2020-04-20 16:17:56'),
(2, 0, '2020-04-20 16:17:56'),
(4, 0, '2020-04-20 16:17:56'),
(5, 0, '2020-04-20 16:17:56');

-- --------------------------------------------------------

--
-- Table structure for table `study_home`
--

DROP TABLE IF EXISTS `study_home`;
CREATE TABLE IF NOT EXISTS `study_home` (
  `home_university` varchar(30) DEFAULT NULL,
  `home_matno` varchar(20) DEFAULT NULL,
  `home_degree` varchar(40) DEFAULT NULL,
  `home_course` varchar(40) DEFAULT NULL,
  `studentid` varchar(11) NOT NULL,
  `home_cgpa` varchar(3) DEFAULT NULL,
  `home_credits` varchar(3) DEFAULT NULL,
  `home_semester` varchar(2) DEFAULT NULL,
  `home_enrollment` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`studentid`),
  UNIQUE KEY `studentid` (`studentid`),
  KEY `university_studentid` (`studentid`),
  KEY `home_universityid` (`home_university`),
  KEY `home_courseid` (`home_course`),
  KEY `home_degreeid` (`home_degree`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `study_home`
--

INSERT INTO `study_home` (`home_university`, `home_matno`, `home_degree`, `home_course`, `studentid`, `home_cgpa`, `home_credits`, `home_semester`, `home_enrollment`) VALUES
('4', '1234567', '1', '28', '0', '2.0', '120', '6', '07/2017'),
('4', '123', '1', '28', '2014', '1.4', '10', '2', '22/2019'),
('4', '55564', '1', '9', '2015', '1-5', '25', '2', '20/15');

--
-- Triggers `study_home`
--
DROP TRIGGER IF EXISTS `Calculate_SuccessFactor`;
DELIMITER $$
CREATE TRIGGER `Calculate_SuccessFactor` AFTER INSERT ON `study_home` FOR EACH ROW BEGIN
    	IF (NEW.home_semester > 1) THEN
        UPDATE student_new SET successFactor = 0.125 * NEW.home_credits / (NEW.home_cgpa * (NEW.home_semester - 1)) WHERE personalid = NEW.studentid;
        ELSE
        UPDATE student_new SET successFactor = 0 WHERE personalid = NEW.studentid;
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
  `studentid` int(11) NOT NULL,
  `foreign_university` int(11) DEFAULT NULL,
  `foreign_matno` varchar(20) DEFAULT NULL,
  `foreign_degree` int(11) DEFAULT NULL,
  `foreign_course` int(11) DEFAULT NULL,
  `foreign_num_planed_exams` int(1) DEFAULT NULL,
  PRIMARY KEY (`studentid`),
  UNIQUE KEY `studentid` (`studentid`),
  KEY `university_studentid` (`studentid`),
  KEY `host_universityid` (`foreign_university`),
  KEY `host_courseid` (`foreign_course`),
  KEY `host_degreeid` (`foreign_degree`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `study_host`
--

INSERT INTO `study_host` (`studentid`, `foreign_university`, `foreign_matno`, `foreign_degree`, `foreign_course`, `foreign_num_planed_exams`) VALUES
(0, NULL, NULL, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

DROP TABLE IF EXISTS `subjects`;
CREATE TABLE IF NOT EXISTS `subjects` (
  `subject_id` int(5) NOT NULL AUTO_INCREMENT,
  `university_id` int(11) NOT NULL,
  `degree_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `prof_id` int(11) NOT NULL,
  `subject_code` varchar(20) DEFAULT NULL,
  `subject_title` varchar(100) DEFAULT NULL,
  `subject_abbrev` varchar(5) DEFAULT NULL,
  `subject_credits` decimal(4,2) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`subject_id`)
) ENGINE=InnoDB AUTO_INCREMENT=195 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`subject_id`, `university_id`, `degree_id`, `course_id`, `prof_id`, `subject_code`, `subject_title`, `subject_abbrev`, `subject_credits`, `created_at`) VALUES
(1, 4, 2, 1, 1, 'ZKB 40082', 'Verbrennungsmotoren', NULL, '4.00', '2019-09-24 19:27:39'),
(2, 4, 2, 1, 2, 'ZKB 40309', 'Air Pollution and Control', NULL, '4.00', '2019-09-24 19:49:56'),
(3, 2, 2, 0, 0, NULL, 'Energy Conversion Systems', NULL, '4.00', '2019-09-25 07:14:28'),
(4, 2, 2, 0, 0, NULL, 'Energy Recovery from waste and Biomass Fuels', '', '5.30', '2019-09-25 07:16:37'),
(5, 4, 2, 0, 3, NULL, 'objektorientiere Methoden der Modellbildung und Simulation (Wahlbereich)', NULL, '3.00', '2019-09-26 13:17:27'),
(6, 2, 0, 0, 0, NULL, 'Mathematical Methods for Engineering Research', NULL, NULL, '2019-09-26 13:19:18'),
(7, 4, 1, 1, 0, NULL, 'Thermodynamics 1 -inklusive Praktikum-', NULL, '5.00', '2020-04-20 09:22:06'),
(8, 4, 1, 1, 0, NULL, 'Thermodynamics 2', NULL, '4.00', '2020-04-20 09:22:06'),
(9, 4, 1, 1, 0, NULL, 'Maschinenelemente 2/ Machine Elements 2', NULL, '3.00', '2020-04-20 09:22:06'),
(10, 4, 1, 1, 0, NULL, 'Baugruppenentwurf', NULL, '1.00', '2020-04-20 09:22:06'),
(11, 4, 1, 1, 0, NULL, 'Produktentwurf', NULL, '3.00', '2020-04-20 09:22:06'),
(12, 4, 1, 1, 0, NULL, 'Hausarbeit zum Produktentwurf', NULL, '2.00', '2020-04-20 09:22:06'),
(13, 4, 1, 1, 0, NULL, 'Numerische Methoden für Ingenieure', NULL, '5.00', '2020-04-20 09:22:06'),
(14, 4, 1, 1, 0, NULL, 'Regelungstechnik', NULL, '3.00', '2020-04-20 09:22:06'),
(15, 4, 1, 1, 0, NULL, 'Einführung in die Automatisierungstechnik', NULL, '5.00', '2020-04-20 09:22:06'),
(16, 4, 1, 1, 0, NULL, 'Systemdynamik', NULL, '2.00', '2020-04-20 09:22:06'),
(17, 4, 1, 1, 0, NULL, 'Messtechnik ', NULL, '4.00', '2020-04-20 09:22:06'),
(18, 4, 1, 1, 0, NULL, 'Introduction to Measurement Technology - inkluding Lab-', NULL, '5.00', '2020-04-20 09:22:06'),
(19, 4, 1, 1, 0, NULL, 'Fundamentals of Electrical Engineering 1', NULL, '5.00', '2020-04-20 09:22:06'),
(20, 4, 1, 1, 0, NULL, 'Grundlagen der Elektrotechnik 1', NULL, '7.00', '2020-04-20 09:22:06'),
(21, 4, 1, 1, 0, NULL, 'Struktur von Mikrorechnern (ohne Praktikum) ', NULL, '3.00', '2020-04-20 09:22:06'),
(22, 4, 1, 1, 0, NULL, 'Strukturdynamik', NULL, '4.00', '2020-04-20 09:22:06'),
(23, 4, 1, 1, 0, NULL, 'Automobile Wertschöpfungskette', NULL, '3.00', '2020-04-20 09:22:06'),
(24, 4, 1, 1, 0, NULL, 'Planung und Organisation', NULL, '4.00', '2020-04-20 09:22:06'),
(25, 4, 1, 1, 0, NULL, 'Produktionsmanagement', NULL, '4.00', '2020-04-20 09:22:06'),
(26, 4, 1, 1, 0, NULL, 'Project Management', NULL, '4.00', '2020-04-20 09:22:06'),
(27, 4, 1, 1, 0, NULL, 'Operating Systems and Computer Networks', NULL, '3.00', '2020-04-20 09:22:06'),
(28, 4, 1, 1, 0, NULL, 'Fluid Mechanics', NULL, '3.00', '2020-04-20 09:22:06'),
(29, 4, 1, 1, 0, NULL, 'Kunststofftechnik', NULL, '4.00', '2020-04-20 09:22:06'),
(30, 4, 1, 1, 0, NULL, 'Mathematics 3', NULL, '5.00', '2020-04-20 09:22:06'),
(31, 4, 1, 1, 0, NULL, 'Project Management', NULL, '3.00', '2020-04-20 09:22:06'),
(32, 4, 1, 1, 0, NULL, 'Fertigungslehre', NULL, '4.00', '2020-04-20 09:22:06'),
(33, 4, 1, 1, 0, NULL, 'Verbrennungslehre', NULL, '4.00', '2020-04-20 09:22:06'),
(34, 4, 1, 1, 0, NULL, 'Control Engineering (ohne Praktikum)', NULL, '3.00', '2020-04-20 09:22:06'),
(35, 4, 1, 1, 0, NULL, 'Electronic Devices', NULL, '3.00', '2020-04-20 09:22:06'),
(36, 4, 1, 1, 0, NULL, 'Sprach und Schlüsselkompetenz E1 Bereich', NULL, '2.00', '2020-04-20 09:22:06'),
(37, 4, 1, 1, 0, NULL, 'Sprach und Schlüsselkompetenz E3 Bereich', NULL, '2.00', '2020-04-20 09:22:06'),
(38, 4, 1, 1, 0, NULL, 'Bachelorarbeit', NULL, '0.00', '2020-04-20 09:22:06'),
(39, 4, 1, 1, 0, NULL, 'Technische Darstellung', NULL, '5.00', '2020-04-20 09:22:06'),
(40, 4, 1, 1, 0, NULL, 'Fundamentals of Electrical Engineering 2', NULL, '4.00', '2020-04-20 09:22:06'),
(41, 4, 1, 1, 0, NULL, 'Grundlagen der Elektrotechnik 2', NULL, '7.00', '2020-04-20 09:22:06'),
(42, 4, 1, 1, 0, NULL, 'Werkstoffkunde I1', NULL, '6.00', '2020-04-20 09:22:06'),
(43, 4, 1, 1, 0, NULL, 'Werkstofftechnik I', NULL, '5.00', '2020-04-20 09:22:06'),
(44, 4, 1, 1, 0, NULL, 'Mathematics 1', NULL, '6.00', '2020-04-20 09:22:06'),
(45, 4, 1, 1, 0, NULL, 'Rechnergestützter Bauteilentwurf', NULL, '4.00', '2020-04-20 09:22:06'),
(46, 4, 1, 1, 0, NULL, 'CAD', NULL, '2.00', '2020-04-20 09:22:06'),
(47, 4, 1, 1, 0, NULL, 'Logistik und Materialfluss', NULL, '4.00', '2020-04-20 09:22:06'),
(48, 4, 1, 1, 0, NULL, 'Electrical Machines', NULL, '4.00', '2020-04-20 09:22:06'),
(49, 4, 1, 1, 0, NULL, 'Fluid Mechanics', NULL, '3.00', '2020-04-20 09:22:06'),
(50, 4, 1, 1, 0, NULL, 'Projektarbeit', NULL, '0.00', '2020-04-20 09:22:06'),
(51, 4, 1, 1, 0, NULL, 'Elektrotechnik', NULL, '0.00', '2020-04-20 09:22:06'),
(52, 4, 1, 1, 0, NULL, 'Grundlagen des Marketing', NULL, '4.00', '2020-04-20 09:22:06'),
(53, 4, 1, 1, 0, NULL, 'Mobilkommunikationstechnik', NULL, '3.00', '2020-04-20 09:22:06'),
(54, 4, 1, 1, 0, NULL, 'Economics for Engineers', NULL, '2.00', '2020-04-20 09:22:06'),
(55, 4, 1, 1, 0, NULL, 'Theory of Linear Systems', NULL, '4.00', '2020-04-20 09:22:06'),
(56, 4, 1, 1, 0, NULL, 'Design Theory 3', NULL, '3.00', '2020-04-20 09:22:06'),
(57, 4, 1, 1, 0, NULL, 'Metallurgie', NULL, '4.00', '2020-04-20 09:22:06'),
(58, 4, 1, 1, 0, NULL, 'Moderne Produktionssysteme', NULL, '0.00', '2020-04-20 09:22:06'),
(59, 4, 1, 1, 0, NULL, 'Produktionstechnik', NULL, '0.00', '2020-04-20 09:22:06'),
(60, 4, 1, 1, 0, NULL, 'Technische Mechanik 1', NULL, '5.00', '2020-04-20 09:22:06'),
(61, 2, 1, 1, 0, NULL, 'Thermodynamics and Heat Transfer', NULL, '5.30', '2020-04-20 09:22:06'),
(62, 2, 1, 1, 0, NULL, 'Thermal System', NULL, '5.30', '2020-04-20 09:22:06'),
(63, 2, 1, 1, 0, NULL, 'Machine Components Design', NULL, '5.30', '2020-04-20 09:22:06'),
(64, 2, 1, 1, 0, NULL, 'Design Project', NULL, '5.30', '2020-04-20 09:22:06'),
(65, 2, 1, 1, 0, NULL, 'Product Design', NULL, '5.30', '2020-04-20 09:22:06'),
(66, 2, 1, 1, 0, NULL, 'Numerical Computations', NULL, '5.30', '2020-04-20 09:22:06'),
(67, 2, 1, 1, 0, NULL, 'Control System Design', NULL, '5.30', '2020-04-20 09:22:06'),
(68, 2, 1, 1, 0, NULL, 'Dynamics and Simulation Systems (including lab)', NULL, '5.30', '2020-04-20 09:22:06'),
(69, 2, 1, 1, 0, NULL, 'Measurement and Instrumentation', NULL, '5.30', '2020-04-20 09:22:06'),
(70, 2, 1, 1, 0, NULL, 'Electromagnetiv Fields and Waves', NULL, '5.70', '2020-04-20 09:22:06'),
(71, 2, 1, 1, 0, NULL, 'Microprozessor and Microcomputer (including lab)', NULL, '5.30', '2020-04-20 09:22:06'),
(72, 2, 1, 1, 0, NULL, 'Mechanical Vibration (no lab)', NULL, '5.30', '2020-04-20 09:22:06'),
(73, 2, 1, 1, 0, NULL, 'Management of Manufacturing Strategy', NULL, '5.30', '2020-04-20 09:22:06'),
(74, 2, 1, 1, 0, NULL, 'Engineering Economic and Entrepreneurship', NULL, '5.30', '2020-04-20 09:22:06'),
(75, 2, 1, 1, 0, NULL, 'Production Planing and Control', NULL, '5.30', '2020-04-20 09:22:06'),
(76, 2, 1, 1, 0, NULL, 'Engineering Management', NULL, '5.30', '2020-04-20 09:22:06'),
(77, 2, 1, 1, 0, NULL, 'Operating Systems', NULL, '5.30', '2020-04-20 09:22:06'),
(78, 2, 1, 1, 0, NULL, 'Fluid Mechanics', NULL, '5.30', '2020-04-20 09:22:06'),
(79, 2, 1, 1, 0, NULL, 'Mechanics of Composite Processing', NULL, '5.30', '2020-04-20 09:22:06'),
(80, 2, 1, 1, 0, NULL, 'Differential Equation', NULL, '5.30', '2020-04-20 09:22:06'),
(81, 2, 1, 1, 0, NULL, 'Manufacturing Processes', NULL, '5.30', '2020-04-20 09:22:06'),
(82, 2, 1, 1, 0, NULL, 'Combustions and Heat Systems', NULL, '4.00', '2020-04-20 09:22:06'),
(83, 2, 1, 1, 0, NULL, 'Polymer Processing', NULL, '4.00', '2020-04-20 09:22:06'),
(84, 2, 1, 1, 0, NULL, 'Control Engineering', NULL, '5.30', '2020-04-20 09:22:06'),
(85, 2, 1, 1, 0, NULL, 'Analogue Electronics', NULL, '5.30', '2020-04-20 09:22:06'),
(86, 2, 1, 1, 0, NULL, 'Language Course: English', NULL, '2.00', '2020-04-20 09:22:06'),
(87, 2, 1, 1, 0, NULL, 'Cultural Course', NULL, '2.00', '2020-04-20 09:22:06'),
(88, 2, 1, 1, 0, NULL, 'Language Course: Bahasa', NULL, '2.00', '2020-04-20 09:22:06'),
(89, 2, 1, 1, 0, NULL, 'Engineering Design Graphic', NULL, '5.30', '2020-04-20 09:22:06'),
(90, 2, 1, 1, 0, NULL, 'Circuit Theory 1', NULL, '5.70', '2020-04-20 09:22:06'),
(91, 2, 1, 1, 0, NULL, 'Material Science', NULL, '4.00', '2020-04-20 09:22:06'),
(92, 2, 1, 1, 0, NULL, 'Engineering Mathematics 1', NULL, '5.30', '2020-04-20 09:22:06'),
(93, 2, 1, 1, 0, NULL, 'CAD/CAM', NULL, '5.30', '2020-04-20 09:22:06'),
(94, 2, 1, 1, 0, NULL, 'Supply Chain Management', NULL, '0.00', '2020-04-20 09:22:06'),
(95, 2, 1, 1, 0, NULL, 'Machine and Electronics Power', NULL, '0.00', '2020-04-20 09:22:06'),
(96, 2, 1, 1, 0, NULL, 'Engineering Economics', NULL, '0.00', '2020-04-20 09:22:06'),
(97, 2, 1, 1, 0, NULL, 'Machine Components Design', NULL, '4.00', '2020-04-20 09:22:06'),
(98, 2, 1, 1, 0, NULL, 'Metal processing Theory', NULL, '4.00', '2020-04-20 09:22:06'),
(99, 2, 1, 1, 0, NULL, 'Current Manufacturing Systems', NULL, '0.00', '2020-04-20 09:22:06'),
(100, 2, 1, 1, 0, NULL, 'Production Tools', NULL, '0.00', '2020-04-20 09:22:06');

-- --------------------------------------------------------

--
-- Table structure for table `university`
--

DROP TABLE IF EXISTS `university`;
CREATE TABLE IF NOT EXISTS `university` (
  `location` varchar(60) DEFAULT NULL,
  `locationid` int(11) NOT NULL,
  `locationabr` text,
  PRIMARY KEY (`locationid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `university`
--

INSERT INTO `university` (`location`, `locationid`, `locationabr`) VALUES
(NULL, 1, NULL),
('Universiti Kebangsaan Malaysia', 2, 'UKM'),
('Universitas Indonesia', 3, 'UI'),
('Universität Duisburg-Essen', 4, 'UDE'),
('Nanyang Technological University Singapore', 5, 'NTU'),
('Zhegzhou University', 6, 'ZZU'),
('University Wuhan', 7, 'UW'),
('German University in Cairo', 8, 'GUC'),
('Institut Teknologi Bandung', 9, 'ITB'),
('SIAS International University (SIAS)', 10, 'SIAS'),
('Zhengzhou University of Light Industry', 11, 'ZZULI'),
('German Malaysian Institute', 12, 'GMI'),
('Riam Institute of Technology', 13, 'RIAMTEC'),
('Universiti Tenaga Nasional', 14, 'UNITEN');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `passwort` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `vorname` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `nachname` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `passwortcode` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `passwortcode_time` timestamp NULL DEFAULT NULL,
  `user_group` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `passwort`, `vorname`, `nachname`, `created_at`, `updated_at`, `passwortcode`, `passwortcode_time`, `user_group`) VALUES
(7, 'Max@Mustermann.de', '$2y$10$Cyd42eev4G9ePRdAdS7aDeShObxmOOFZBEGR59eqRSNVmfUW5jl2G', 'Max', 'Mustermann', '2019-10-09 11:49:11', NULL, NULL, NULL, NULL),
(8, 'shet.chu@stud.uni-due.de', '$2y$10$H4pp29r6tkZr3zEz/VoV3O106sr.3SeN7ji.sSnhoCq8kb4PaBlKK', 'shet lin', 'chu', '2020-04-06 08:40:56', NULL, NULL, NULL, NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

ALTER TABLE `university`
  MODIFY `locationid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT für Tabelle `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
