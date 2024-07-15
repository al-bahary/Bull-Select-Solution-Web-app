-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 14, 2024 at 02:05 PM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 7.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ohmsphp`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `adminid` int(10) NOT NULL,
  `adminname` varchar(25) NOT NULL,
  `loginid` varchar(25) NOT NULL,
  `password` varchar(25) NOT NULL,
  `status` varchar(10) NOT NULL,
  `usertype` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`adminid`, `adminname`, `loginid`, `password`, `status`, `usertype`) VALUES
(1, 'Joseph Spector', 'admin', 'Password@123', 'Active', '');

-- --------------------------------------------------------

--
-- Table structure for table `appointment`
--

CREATE TABLE `appointment` (
  `appointmentid` int(10) NOT NULL,
  `appointmenttype` varchar(25) NOT NULL,
  `patientid` int(10) NOT NULL,
  `appointmentdate` date NOT NULL,
  `appointmenttime` time NOT NULL,
  `doctorid` int(10) NOT NULL,
  `status` varchar(10) NOT NULL,
  `app_reason` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `appointment`
--

INSERT INTO `appointment` (`appointmentid`, `appointmenttype`, `patientid`, `appointmentdate`, `appointmenttime`, `doctorid`, `status`, `app_reason`) VALUES
(1, '	 ONLINE', 1, '2019-06-17', '03:00:00', 1, 'Approved', 'Fever'),
(2, '	 ONLINE', 3, '2021-06-25', '09:22:00', 2, 'Approved', 'this is a demo test'),
(4, '	 ONLINE', 5, '2021-06-24', '14:28:00', 5, 'Approved', 'demo demo demo'),
(5, '	 ONLINE', 6, '2021-06-24', '11:18:00', 7, 'Approved', 'Demo Test, Demo Reason!!'),
(6, 'ONLINE', 7, '2024-07-21', '11:30:00', 2, 'Pending', ''),
(7, 'ONLINE', 8, '2024-07-21', '11:30:00', 2, 'Pending', ''),
(8, 'ONLINE', 10, '2024-07-20', '11:18:00', 1, 'Pending', ''),
(9, 'ONLINE', 11, '2024-07-18', '12:20:00', 2, 'Pending', ''),
(10, '	 ONLINE', 0, '0000-00-00', '00:00:00', 0, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `billing`
--

CREATE TABLE `billing` (
  `billingid` int(10) NOT NULL,
  `patientid` int(10) NOT NULL,
  `appointmentid` int(10) NOT NULL,
  `billingdate` date NOT NULL,
  `billingtime` time NOT NULL,
  `discount` float(10,2) NOT NULL,
  `taxamount` float(10,2) NOT NULL,
  `discountreason` text NOT NULL,
  `discharge_time` time NOT NULL,
  `discharge_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `billing`
--

INSERT INTO `billing` (`billingid`, `patientid`, `appointmentid`, `billingdate`, `billingtime`, `discount`, `taxamount`, `discountreason`, `discharge_time`, `discharge_date`) VALUES
(1, 0, 0, '2019-06-15', '18:53:38', 0.00, 0.00, '', '00:00:00', '0000-00-00'),
(2, 1, 1, '2019-06-15', '19:56:20', 0.00, 0.00, '', '00:00:00', '0000-00-00'),
(3, 3, 2, '2021-06-24', '14:39:11', 0.00, 0.00, 'none , ', '07:56:26', '2021-06-24'),
(4, 5, 4, '2021-06-24', '18:48:00', 0.00, 0.00, 'none , ', '07:26:39', '2021-06-24'),
(5, 6, 5, '2021-06-24', '19:36:12', 0.00, 0.00, 'no discounts , ', '07:54:07', '2021-06-24');

-- --------------------------------------------------------

--
-- Table structure for table `billing_records`
--

CREATE TABLE `billing_records` (
  `billingservice_id` int(10) NOT NULL,
  `billingid` int(10) NOT NULL,
  `bill_type_id` int(10) NOT NULL COMMENT 'id of service charge or treatment charge',
  `bill_type` varchar(250) NOT NULL,
  `bill_amount` float(10,2) NOT NULL,
  `bill_date` date NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `billing_records`
--

INSERT INTO `billing_records` (`billingservice_id`, `billingid`, `bill_type_id`, `bill_type`, `bill_amount`, `bill_date`, `status`) VALUES
(1, 2, 1, 'Consultancy Charge', 45.00, '2019-06-15', 'Active'),
(2, 2, 20, 'Treatment', 300.00, '2019-06-15', 'Active'),
(3, 2, 1, 'Prescription Charge', 45.00, '2019-06-15', 'Active'),
(4, 3, 2, 'Consultancy Charge', 55.00, '2021-06-24', 'Active'),
(5, 3, 20, 'Treatment', 300.00, '2021-06-24', 'Active'),
(6, 4, 5, 'Consultancy Charge', 75.00, '2021-06-24', 'Active'),
(7, 4, 20, 'Treatment', 179.00, '2021-06-24', 'Active'),
(8, 4, 2, 'Prescription Charge', 55.00, '2021-06-24', 'Active'),
(9, 5, 7, 'Consultancy Charge', 995.00, '2021-06-24', 'Active'),
(10, 5, 33, 'Treatment', 4850.00, '2021-06-24', 'Active'),
(11, 5, 3, 'Prescription Charge', 231.00, '2021-06-24', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `bullcatalog`
--

CREATE TABLE `bullcatalog` (
  `id` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Description` text,
  `Status` enum('Active','Inactive') DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bullcatalog`
--

INSERT INTO `bullcatalog` (`id`, `Name`, `Description`, `Status`) VALUES
(1, 'Dairy Bulls', 'Dairy bulls are specifically bred for their genetic potential to improve milk production in dairy herds.', 'Active'),
(2, 'Beef Bulls', 'Beef bulls are bred to enhance meat production, focusing on traits that improve growth rate, feed efficiency, and carcass quality.', 'Active'),
(3, 'Dual-Purpose Bulls', 'Dual-purpose bulls are bred to balance both milk and meat production, making them suitable for farms that require both dairy and beef outputs.', 'Active'),
(4, 'Specialty Bulls', 'Specialty bulls are bred for unique or specific traits that set them apart from typical dairy and beef bulls.', 'Active'),
(6, 'dddddd', 'rrrrrrrrr', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `doctor`
--

CREATE TABLE `doctor` (
  `doctorid` int(10) NOT NULL,
  `doctorname` varchar(50) NOT NULL,
  `mobileno` varchar(15) NOT NULL,
  `loginid` varchar(25) NOT NULL,
  `password` varchar(25) NOT NULL,
  `status` varchar(10) NOT NULL,
  `education` varchar(25) NOT NULL,
  `experience` float(11,1) NOT NULL,
  `consultancy_charge` float(10,2) NOT NULL,
  `city` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `doctor`
--

INSERT INTO `doctor` (`doctorid`, `doctorname`, `mobileno`, `loginid`, `password`, `status`, `education`, `experience`, `consultancy_charge`, `city`) VALUES
(1, 'Carol Bosworth', '7002225650', 'carol', 'password', 'Active', 'Health Certificate', 7.0, 700.00, 'Kisumu'),
(2, 'Sirena S Rivera', '7023695696', 'rivera', 'password', 'Active', 'Pedigree Certificate', 4.0, 400.00, 'Nakuru'),
(3, 'Will Williams', '7014545470', 'wiliams', 'password', 'Active', 'Genetic Evaluation ', 7.0, 500.00, 'Eldoret'),
(4, 'Thomas Borkowski', '7025558690', 'thomas', 'password', 'Active', 'Health Certificate', 4.0, 155.00, 'Thika'),
(5, 'Jason Graham', '7854025410', 'jason', 'password', 'Active', 'Health Certificate', 5.0, 750.00, 'Nairobi'),
(6, 'Viola McRoy', '7410002540', 'viola', 'password', 'Active', 'Genetic Evaluation', 8.0, 420.00, 'Mombasa'),
(7, 'Logan Fletcher', '7012569990', 'logan', 'password', 'Active', 'Pedigree Certificate', 5.0, 995.00, 'Machacos'),
(8, 'Ben Bernier', '7012225470', 'ben', 'password', 'Active', 'Semen Quality', 3.0, 689.00, 'Baringo'),
(9, 'mercy', '7123456678', 'mercy', '11111111', 'Active', 'Health Certificate', 7.0, 800.00, 'nakuru');

-- --------------------------------------------------------

--
-- Table structure for table `doctor_timings`
--

CREATE TABLE `doctor_timings` (
  `doctor_timings_id` int(10) NOT NULL,
  `doctorid` int(10) NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `available_day` varchar(15) NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `doctor_timings`
--

INSERT INTO `doctor_timings` (`doctor_timings_id`, `doctorid`, `start_time`, `end_time`, `available_day`, `status`) VALUES
(17, 35, '09:30:00', '13:00:00', '', 'Active'),
(18, 36, '13:30:00', '17:00:00', '', 'Active'),
(19, 37, '14:00:00', '18:00:00', '', 'Active'),
(20, 38, '17:00:00', '21:00:00', '', 'Active'),
(21, 39, '13:00:00', '19:00:00', '', 'Active'),
(22, 40, '07:00:00', '11:00:00', '', 'Active'),
(23, 41, '13:30:00', '16:30:00', '', 'Active'),
(24, 42, '11:30:00', '14:30:00', '', 'Active'),
(25, 43, '12:30:00', '16:30:00', '', 'Active'),
(26, 44, '21:30:00', '12:30:00', '', 'Active'),
(27, 36, '01:03:00', '13:03:00', '', 'Active'),
(28, 61, '11:11:00', '19:07:00', '', 'Active'),
(29, 35, '11:11:00', '16:44:00', '', 'Active'),
(30, 35, '01:10:00', '16:11:00', '', 'Active'),
(31, 35, '01:02:00', '15:04:00', '2018-03-26', 'Active'),
(32, 35, '16:25:00', '01:00:00', '', 'Active'),
(33, 1, '18:00:00', '00:02:00', '', 'Active'),
(34, 2, '07:36:00', '15:37:00', '', 'Active'),
(35, 7, '09:24:00', '16:24:00', '', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `medicine`
--

CREATE TABLE `medicine` (
  `medicineid` int(10) NOT NULL,
  `medicinename` varchar(25) NOT NULL,
  `medicinecost` float(10,2) NOT NULL,
  `description` text NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `medicine`
--

INSERT INTO `medicine` (`medicineid`, `medicinename`, `medicinecost`, `description`, `status`) VALUES
(1, 'Vaccines', 300.00, 'For fever per day 1 pc', 'Active'),
(2, 'Antibiotics', 140.00, 'Clotrimazole is an antifungal, prescribed for local fungal infections', 'Active'),
(3, 'Antiparasitics', 2600.00, 'Prescribed for various skin infections such as jockitch and also for vaginal yeast infections', 'Active'),
(4, 'Hormonal Treatments', 600.00, 'Antifungal drug, prescribed for fungal infections of the skin mouth vagina and intestinal tract', 'Active'),
(5, 'Nutritional Supplements', 300.00, 'prevent your body from forming angiotensin', 'Active'),
(6, 'Probiotics and Prebiotics', 500.00, 'ARBs block the effects of angiotensin on your heart.', 'Active'),
(7, 'Specialized Treatments', 5900.00, 'may prescribe an anticoagulant to prevent heart attack, stroke, or other serious health problems', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `orderid` int(10) NOT NULL,
  `patientid` int(10) NOT NULL,
  `doctorid` int(10) NOT NULL,
  `prescriptionid` int(10) NOT NULL,
  `orderdate` date NOT NULL,
  `deliverydate` date NOT NULL,
  `address` text NOT NULL,
  `mobileno` varchar(15) NOT NULL,
  `note` text NOT NULL,
  `status` varchar(10) NOT NULL,
  `payment_type` varchar(20) NOT NULL,
  `card_no` varchar(20) NOT NULL,
  `cvv_no` varchar(5) NOT NULL,
  `expdate` date NOT NULL,
  `card_holder` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `patient`
--

CREATE TABLE `patient` (
  `patientid` int(10) NOT NULL,
  `patientname` varchar(50) NOT NULL,
  `admissiondate` date NOT NULL,
  `admissiontime` time NOT NULL,
  `address` varchar(250) NOT NULL,
  `mobileno` varchar(15) NOT NULL,
  `city` varchar(25) NOT NULL,
  `pincode` varchar(20) NOT NULL,
  `loginid` varchar(50) NOT NULL,
  `password` varchar(25) NOT NULL,
  `status` varchar(10) NOT NULL,
  `bull_id` int(11) DEFAULT NULL,
  `gender` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `patient`
--

INSERT INTO `patient` (`patientid`, `patientname`, `admissiondate`, `admissiontime`, `address`, `mobileno`, `city`, `pincode`, `loginid`, `password`, `status`, `bull_id`, `gender`) VALUES
(1, 'Johnny', '2019-06-15', '18:47:22', 'Dhanmondi', '2125798361', 'Dhaka', '1207', 'admin', '123456789', 'Active', NULL, 'Meat 	Qual'),
(3, 'Christine Moore', '2021-06-24', '14:38:04', '4327 Â Pride Avenue', '7012225690', 'Elmhurst', '63520', 'christine', 'password', 'Active', NULL, 'Milk Produ'),
(4, 'Demoname', '2021-06-24', '15:26:32', 'demo address', '7474747474', 'demo city', '', 'demo', 'password', 'Active', NULL, 'Adaptabili'),
(5, 'Thomas Walters', '2021-06-24', '18:44:22', '1723  Cinnamon Lane', '7023658800', 'San Antonio', '', 'thomas', 'password', 'Active', NULL, 'Meat 	Qual'),
(6, 'Eryn Carlos', '2021-06-24', '19:34:27', '2649 Wayside Lane', '7012225896', 'San Jose', '', 'carlos', 'password', 'Active', NULL, 'Adaptabili'),
(7, 'mercy', '2024-07-12', '08:28:38', 'thika', '0722116677', 'nakuru', '', 'me', '11111111', 'Active', NULL, 'Milk Produ'),
(8, 'mercy', '2024-07-12', '08:30:19', 'thika', '0722116677', 'nakuru', '', 'me', '11111111', 'Active', NULL, 'Adaptabili'),
(9, 'John Doe', '2024-07-12', '09:00:00', '123 Main St', '5551234567', 'Anytown', '12345', 'johndoe', 'password123', 'Active', 1, 'Meat 	Qual'),
(10, 'lyn', '2024-07-12', '09:18:13', 'nakuru', '7123456678', 'nakuru', '', 'lyn', '11221122', 'Active', NULL, 'Milk Produ'),
(11, 'johndoe', '2024-07-12', '09:20:38', 'nakuru', '7123456678', 'nakuru', '', 'password123', 'password123', 'Active', NULL, 'Milk Produ');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `paymentid` int(10) NOT NULL,
  `patientid` int(10) NOT NULL,
  `appointmentid` int(10) NOT NULL,
  `paiddate` date NOT NULL,
  `paidtime` time NOT NULL,
  `paidamount` float(10,2) NOT NULL,
  `status` varchar(10) NOT NULL,
  `cardholder` varchar(50) NOT NULL,
  `cardnumber` int(25) NOT NULL,
  `cvvno` int(5) NOT NULL,
  `expdate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`paymentid`, `patientid`, `appointmentid`, `paiddate`, `paidtime`, `paidamount`, `status`, `cardholder`, `cardnumber`, `cvvno`, `expdate`) VALUES
(1, 5, 4, '2021-06-24', '19:26:51', 324.45, 'Active', '', 0, 0, '0000-00-00'),
(2, 6, 5, '2021-06-24', '19:54:23', 6379.80, 'Active', '', 0, 0, '0000-00-00'),
(3, 3, 2, '2021-06-24', '19:56:33', 372.75, 'Active', '', 0, 0, '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `prescription`
--

CREATE TABLE `prescription` (
  `prescriptionid` int(10) NOT NULL,
  `treatment_records_id` int(10) NOT NULL,
  `doctorid` int(10) NOT NULL,
  `patientid` int(10) NOT NULL,
  `delivery_type` varchar(10) NOT NULL COMMENT 'Delivered through appointment or online order',
  `delivery_id` int(10) NOT NULL COMMENT 'appointmentid or orderid',
  `prescriptiondate` date NOT NULL,
  `status` varchar(10) NOT NULL,
  `appointmentid` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `prescription`
--

INSERT INTO `prescription` (`prescriptionid`, `treatment_records_id`, `doctorid`, `patientid`, `delivery_type`, `delivery_id`, `prescriptiondate`, `status`, `appointmentid`) VALUES
(1, 0, 1, 1, '', 0, '2019-06-17', 'Active', 1),
(2, 0, 5, 5, '', 0, '2021-06-25', 'Active', 4),
(3, 0, 7, 6, '', 0, '2021-06-25', 'Active', 5);

-- --------------------------------------------------------

--
-- Table structure for table `prescription_records`
--

CREATE TABLE `prescription_records` (
  `prescription_record_id` int(10) NOT NULL,
  `prescription_id` int(10) NOT NULL,
  `medicine_name` varchar(25) NOT NULL,
  `cost` float(10,2) NOT NULL,
  `unit` int(10) NOT NULL,
  `dosage` varchar(25) NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `prescription_records`
--

INSERT INTO `prescription_records` (`prescription_record_id`, `prescription_id`, `medicine_name`, `cost`, `unit`, `dosage`, `status`) VALUES
(1, 1, '1', 3.00, 15, '1-1-1', 'Active'),
(2, 2, '13', 55.00, 1, '0-1-1', 'Active'),
(3, 3, '9', 231.00, 1, '1-0-1', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `treatment`
--

CREATE TABLE `treatment` (
  `treatmentid` int(10) NOT NULL,
  `treatmenttype` varchar(25) NOT NULL,
  `treatment_cost` decimal(10,2) NOT NULL,
  `note` text NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `treatment`
--

INSERT INTO `treatment` (`treatmentid`, `treatmenttype`, `treatment_cost`, `note`, `status`) VALUES
(20, 'Reproductive Health Servi', '179.00', 'Test checks for levels of 10 different components of every major cell in your blood', 'Active'),
(21, 'Electrocardiogram', '70.00', 'Records the electrical activity of the heart', 'Active'),
(22, 'Echocardiogram', '1750.00', 'Provides an ultrasound picture that shows the structure of the heart chambers and surrounding areas, and it can show how well the heart is working.', 'Active'),
(23, 'Nuclear cardiology', '530.00', 'Nuclear imaging techniques use radioactive materials to study cardiovascular disorders and diseases in a noninvasive way.', 'Active'),
(24, 'Colposcopy', '318.00', 'Procedure to visually examine the cervix as well as the vagina and vulva using a colposcope.', 'Active'),
(25, 'Colporrhaphy', '5518.00', 'Surgical procedure in humans that repairs a defect in the wall of the vagina.', 'Active'),
(26, 'Spine Surgery', '97560.00', 'This entails opening the operative site with a long incision so the surgeon can view and access the spinal anatomy.', 'Active'),
(27, 'Trauma surgery', '25448.00', 'Surgical specialty that utilizes both operative and non-operative management to treat traumatic injuries, typically in an acute setting.', 'Active'),
(28, 'Diagnostic Tests', '989.00', 'May include MRI, CT, Bone Scan, Ultra sound, blood tests.', 'Active'),
(29, 'Chest XRay', '258.00', 'Projection radiograph of the chest used to diagnose conditions affecting the chest, its contents, and nearby structures.', 'Active'),
(30, 'Ultrasound of the Abdomen', '560.00', 'Noninvasive procedure used to assess the organs and structures within the abdomen.', 'Active'),
(31, 'Exercise Stress Test', '198.00', 'This test is good for evaluating chest pain to see if your heart is the cause.', 'Active'),
(32, 'Ultrasound of the Pelvis', '520.00', 'Noninvasive diagnostic exam that produces images that are used to assess organs and structures within the female pelvis.', 'Active'),
(33, 'Chemotherapy and Radiatio', '4850.00', 'Most common types of cancer treatment. They work by destroying these fast-growing cells.', 'Active'),
(34, 'Breeding Soundness Evalua', '250.00', 'Assessment of a bull\'s reproductive capabilities, including physical exam and semen analysis.', 'Active'),
(35, 'Semen Collection and Eval', '300.00', 'Collection and quality evaluation of semen samples for AI.', 'Active'),
(36, 'Estrus Synchronization', '150.00', 'Hormonal treatment to synchronize estrus cycles of cows.', 'Active'),
(37, 'Artificial Insemination', '100.00', 'Insemination of cows using collected and processed bull semen.', 'Active'),
(38, 'Vaccination Programs', '80.00', 'Regular vaccinations to protect against reproductive health diseases.', 'Active'),
(39, 'Parasite Control', '60.00', 'Routine deworming and external parasite control.', 'Active'),
(40, 'Nutritional Counseling', '120.00', 'Guidance on proper nutrition to support reproductive health.', 'Active'),
(41, 'Health Screening', '200.00', 'Regular health check-ups and screenings for reproductive performance.', 'Active'),
(42, 'Ultrasound Examinations', '350.00', 'Use of ultrasound to assess reproductive organs and detect abnormalities.', 'Active'),
(43, 'Genetic Testing', '500.00', 'DNA testing for parentage verification and genetic disorders.', 'Active'),
(44, 'Antibiotic Treatments', '50.00', 'Antibiotics to treat bacterial infections affecting reproductive health.', 'Active'),
(45, 'Hormonal Treatments', '70.00', 'Hormones for treating reproductive disorders and managing labor.', 'Active'),
(46, 'Anti-inflammatory Manage', '75.00', 'Use of NSAIDs and corticosteroids to manage inflammation and pain.', 'Active'),
(47, 'Reproductive Surgery', '3000.00', 'Procedures like testicular surgery and semen collection surgeries.', 'Active'),
(48, 'Emergency Surgery', '5000.00', 'Surgical interventions for acute conditions like torsion and injuries.', 'Active'),
(49, 'Hydration Therapy', '90.00', 'Administration of fluids and electrolytes to maintain hydration.', 'Active'),
(50, 'Nutritional Support', '110.00', 'Provision of high-quality feed and supplements for recovery.', 'Active'),
(51, 'Breeding Management Cons', '180.00', 'Expert advice on breeding strategies and herd management.', 'Active'),
(52, 'Health Management Plans', '220.00', 'Customized health management plans to enhance reproductive performance.', 'Active'),
(53, 'AI Training', '250.00', 'Training for personnel in artificial insemination techniques.', 'Active'),
(54, 'Health Management Worksho', '200.00', 'Educational programs on disease prevention and herd health.', 'Active'),
(55, 'Semen Analysis', '400.00', 'Laboratory analysis of semen samples to assess quality.', 'Active'),
(56, 'Disease Testing', '450.00', 'Laboratory testing for infectious diseases.', 'Active'),
(57, 'Breeding Records', '80.00', 'Maintenance of detailed breeding records.', 'Active'),
(58, 'Health Records', '90.00', 'Comprehensive health records for monitoring treatments.', 'Active'),
(59, 'Reproductive Health Servi', '179.00', 'Test checks for levels of 10 different components of every major cell in your blood', 'Active'),
(60, 'Electrocardiogram', '70.00', 'Records the electrical activity of the heart', 'Active'),
(61, 'Echocardiogram', '1750.00', 'Provides an ultrasound picture that shows the structure of the heart chambers and surrounding areas, and it can show how well the heart is working.', 'Active'),
(62, 'Nuclear cardiology', '530.00', 'Nuclear imaging techniques use radioactive materials to study cardiovascular disorders and diseases in a noninvasive way.', 'Active'),
(63, 'Colposcopy', '318.00', 'Procedure to visually examine the cervix as well as the vagina and vulva using a colposcope.', 'Active'),
(64, 'Colporrhaphy', '5518.00', 'Surgical procedure in humans that repairs a defect in the wall of the vagina.', 'Active'),
(65, 'Spine Surgery', '97560.00', 'This entails opening the operative site with a long incision so the surgeon can view and access the spinal anatomy.', 'Active'),
(66, 'Trauma surgery', '25448.00', 'Surgical specialty that utilizes both operative and non-operative management to treat traumatic injuries, typically in an acute setting.', 'Active'),
(67, 'Diagnostic Tests', '989.00', 'May include MRI, CT, Bone Scan, Ultra sound, blood tests.', 'Active'),
(68, 'Chest XRay', '258.00', 'Projection radiograph of the chest used to diagnose conditions affecting the chest, its contents, and nearby structures.', 'Active'),
(69, 'Ultrasound of the Abdomen', '560.00', 'Noninvasive procedure used to assess the organs and structures within the abdomen.', 'Active'),
(70, 'Exercise Stress Test', '198.00', 'This test is good for evaluating chest pain to see if your heart is the cause.', 'Active'),
(71, 'Ultrasound of the Pelvis', '520.00', 'Noninvasive diagnostic exam that produces images that are used to assess organs and structures within the female pelvis.', 'Active'),
(72, 'Chemotherapy and Radiatio', '4850.00', 'Most common types of cancer treatment. They work by destroying these fast-growing cells.', 'Active'),
(73, 'Breeding Soundness Evalua', '250.00', 'Assessment of a bull\'s reproductive capabilities, including physical exam and semen analysis.', 'Active'),
(74, 'Semen Collection and Eval', '300.00', 'Collection and quality evaluation of semen samples for AI.', 'Active'),
(75, 'Estrus Synchronization', '150.00', 'Hormonal treatment to synchronize estrus cycles of cows.', 'Active'),
(76, 'Artificial Insemination', '100.00', 'Insemination of cows using collected and processed bull semen.', 'Active'),
(77, 'Vaccination Programs', '80.00', 'Regular vaccinations to protect against reproductive health diseases.', 'Active'),
(78, 'Parasite Control', '60.00', 'Routine deworming and external parasite control.', 'Active'),
(79, 'Nutritional Counseling', '120.00', 'Guidance on proper nutrition to support reproductive health.', 'Active'),
(80, 'Health Screening', '200.00', 'Regular health check-ups and screenings for reproductive performance.', 'Active'),
(81, 'Ultrasound Examinations', '350.00', 'Use of ultrasound to assess reproductive organs and detect abnormalities.', 'Active'),
(82, 'Genetic Testing', '500.00', 'DNA testing for parentage verification and genetic disorders.', 'Active'),
(83, 'Antibiotic Treatments', '50.00', 'Antibiotics to treat bacterial infections affecting reproductive health.', 'Active'),
(84, 'Hormonal Treatments', '70.00', 'Hormones for treating reproductive disorders and managing labor.', 'Active'),
(85, 'Anti-inflammatory Managem', '75.00', 'Use of NSAIDs and corticosteroids to manage inflammation and pain.', 'Active'),
(86, 'Reproductive Surgery', '3000.00', 'Procedures like testicular surgery and semen collection surgeries.', 'Active'),
(87, 'Emergency Surgery', '5000.00', 'Surgical interventions for acute conditions like torsion and injuries.', 'Active'),
(88, 'Hydration Therapy', '90.00', 'Administration of fluids and electrolytes to maintain hydration.', 'Active'),
(89, 'Nutritional Support', '110.00', 'Provision of high-quality feed and supplements for recovery.', 'Active'),
(90, 'Breeding Management Consu', '180.00', 'Expert advice on breeding strategies and herd management.', 'Active'),
(91, 'Health Management Plans', '220.00', 'Customized health management plans to enhance reproductive performance.', 'Active'),
(92, 'AI Training', '250.00', 'Training for personnel in artificial insemination techniques.', 'Active'),
(93, 'Health Management Worksho', '200.00', 'Educational programs on disease prevention and herd health.', 'Active'),
(94, 'Semen Analysis', '400.00', 'Laboratory analysis of semen samples to assess quality.', 'Active'),
(95, 'Disease Testing', '450.00', 'Laboratory testing for infectious diseases.', 'Active'),
(96, 'Breeding Records', '80.00', 'Maintenance of detailed breeding records.', 'Active'),
(97, 'Health Records', '90.00', 'Comprehensive health records for monitoring treatments.', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `treatment_records`
--

CREATE TABLE `treatment_records` (
  `treatment_records_id` int(10) NOT NULL,
  `treatmentid` int(10) NOT NULL,
  `appointmentid` int(10) NOT NULL,
  `patientid` int(10) NOT NULL,
  `doctorid` int(10) NOT NULL,
  `treatment_description` text NOT NULL,
  `uploads` varchar(100) NOT NULL,
  `treatment_date` date NOT NULL,
  `treatment_time` time NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `treatment_records`
--

INSERT INTO `treatment_records` (`treatment_records_id`, `treatmentid`, `appointmentid`, `patientid`, `doctorid`, `treatment_description`, `uploads`, `treatment_date`, `treatment_time`, `status`) VALUES
(1, 20, 1, 1, 1, 'Fever \r\ntake paracitamol', '1746614148', '2019-06-15', '17:00:00', 'Active'),
(2, 20, 2, 3, 2, 'Demo Treatment Description...', '20245sample_image.jpg', '2021-06-24', '18:24:00', 'Active'),
(3, 20, 4, 5, 5, 'to study the morphology of blood and blood-forming tissues', '853sample_image.jpg', '2021-06-24', '16:40:00', 'Active'),
(4, 33, 5, 6, 7, 'based on small cell lung cancer', '25208sample_image.jpg', '2021-06-24', '15:22:00', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `userid` int(11) NOT NULL,
  `loginname` varchar(50) NOT NULL,
  `password` varchar(10) NOT NULL,
  `patientname` varchar(50) NOT NULL,
  `mobileno` varchar(15) NOT NULL,
  `email` varchar(50) NOT NULL,
  `createddateandtime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userid`, `loginname`, `password`, `patientname`, `mobileno`, `email`, `createddateandtime`) VALUES
(1, 'admin', 'admin', 'admin', '', '', '2017-12-14 11:21:45');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`adminid`),
  ADD UNIQUE KEY `adminname` (`adminname`);

--
-- Indexes for table `appointment`
--
ALTER TABLE `appointment`
  ADD PRIMARY KEY (`appointmentid`);

--
-- Indexes for table `billing`
--
ALTER TABLE `billing`
  ADD PRIMARY KEY (`billingid`);

--
-- Indexes for table `billing_records`
--
ALTER TABLE `billing_records`
  ADD PRIMARY KEY (`billingservice_id`);

--
-- Indexes for table `bullcatalog`
--
ALTER TABLE `bullcatalog`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doctor`
--
ALTER TABLE `doctor`
  ADD PRIMARY KEY (`doctorid`);

--
-- Indexes for table `doctor_timings`
--
ALTER TABLE `doctor_timings`
  ADD PRIMARY KEY (`doctor_timings_id`);

--
-- Indexes for table `medicine`
--
ALTER TABLE `medicine`
  ADD PRIMARY KEY (`medicineid`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`orderid`);

--
-- Indexes for table `patient`
--
ALTER TABLE `patient`
  ADD PRIMARY KEY (`patientid`),
  ADD KEY `loginid` (`loginid`),
  ADD KEY `fk_patient_bull` (`bull_id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`paymentid`);

--
-- Indexes for table `prescription`
--
ALTER TABLE `prescription`
  ADD PRIMARY KEY (`prescriptionid`);

--
-- Indexes for table `prescription_records`
--
ALTER TABLE `prescription_records`
  ADD PRIMARY KEY (`prescription_record_id`);

--
-- Indexes for table `treatment`
--
ALTER TABLE `treatment`
  ADD PRIMARY KEY (`treatmentid`);

--
-- Indexes for table `treatment_records`
--
ALTER TABLE `treatment_records`
  ADD PRIMARY KEY (`treatment_records_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `adminid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `appointment`
--
ALTER TABLE `appointment`
  MODIFY `appointmentid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `billing`
--
ALTER TABLE `billing`
  MODIFY `billingid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `billing_records`
--
ALTER TABLE `billing_records`
  MODIFY `billingservice_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `bullcatalog`
--
ALTER TABLE `bullcatalog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `doctor`
--
ALTER TABLE `doctor`
  MODIFY `doctorid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `doctor_timings`
--
ALTER TABLE `doctor_timings`
  MODIFY `doctor_timings_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
--
-- AUTO_INCREMENT for table `medicine`
--
ALTER TABLE `medicine`
  MODIFY `medicineid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `orderid` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `patient`
--
ALTER TABLE `patient`
  MODIFY `patientid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `paymentid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `prescription`
--
ALTER TABLE `prescription`
  MODIFY `prescriptionid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `prescription_records`
--
ALTER TABLE `prescription_records`
  MODIFY `prescription_record_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `treatment`
--
ALTER TABLE `treatment`
  MODIFY `treatmentid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98;
--
-- AUTO_INCREMENT for table `treatment_records`
--
ALTER TABLE `treatment_records`
  MODIFY `treatment_records_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `patient`
--
ALTER TABLE `patient`
  ADD CONSTRAINT `fk_patient_bull` FOREIGN KEY (`bull_id`) REFERENCES `bullcatalog` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
