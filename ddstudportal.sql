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
--
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
