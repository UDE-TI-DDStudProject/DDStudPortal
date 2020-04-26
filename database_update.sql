-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3308
-- Generation Time: Apr 20, 2020 at 09:31 AM
-- Server version: 8.0.18
-- PHP Version: 7.3.12

SET SQL_MODE
= "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT
= 0;
START TRANSACTION;
SET time_zone
= "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ddstudportal`
--

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

DROP TABLE IF EXISTS `subjects`;
CREATE TABLE
IF NOT EXISTS `subjects`
(
  `subject_id` int
(5) NOT NULL AUTO_INCREMENT,
  `university_id` int
(11) NOT NULL,
  `degree_id` int
(11) NOT NULL,
  `course_id` int
(11) NOT NULL,
  `prof_id` int
(11) NOT NULL,
  `subject_code` varchar
(20) DEFAULT NULL,
  `subject_title` varchar
(100) DEFAULT NULL,
  `subject_abbrev` varchar
(5) DEFAULT NULL,
  `subject_credits` decimal
(4,2) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON
UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY
(`subject_id`)
) ENGINE=InnoDB AUTO_INCREMENT=195 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`
subject_id`,
`university_id
`, `degree_id`, `course_id`, `prof_id`, `subject_code`, `subject_title`, `subject_abbrev`, `subject_credits`, `created_at`) VALUES
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
(100, 2, 1, 1, 0, NULL, 'Production Tools', NULL, '0.00', '2020-04-20 09:22:06')
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;





-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3308
-- Generation Time: Apr 20, 2020 at 10:02 AM
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
(0, 'chu', 'shet', 'shet.chu@stud.uni-due.de', '2020-04-22', 'Malaysia', NULL, 'Interested', NULL, 'Exchange', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0000-00-00 00:00:00', '', NULL, 'Ms', NULL, 8, '2020-04-20 09:33:46', '0.000'),
(2015, 'Mustermann', 'Max', 'Max@Mustermann.de', '2019-10-09', 'Germany', NULL, 'Interested', NULL, 'Exchange', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0000-00-00 00:00:00', '', NULL, 'Mr', NULL, 7, '2020-04-20 09:33:46', '0.000');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;


-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3308
-- Generation Time: Apr 20, 2020 at 10:34 AM
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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;


/*Stud_Host*/

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