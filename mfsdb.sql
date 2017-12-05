-- phpMyAdmin SQL Dump
-- version 4.6.6
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 10, 2017 at 03:12 PM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mfsdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `adminID` int(11) NOT NULL,
  `adminLogin` varchar(255) NOT NULL,
  `adminHash` varchar(255) NOT NULL,
  `adminLoginDate` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

CREATE TABLE `articles` (
  `articleID` int(32) NOT NULL,
  `articleTitle` varchar(255) NOT NULL,
  `articleBy` varchar(55) NOT NULL,
  `articleCont` varchar(2500) NOT NULL,
  `articleTags` text NOT NULL,
  `articleDate` varchar(55) NOT NULL,
  `articleImg` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `articles`
--

INSERT INTO `articles` (`articleID`, `articleTitle`, `articleBy`, `articleCont`, `articleTags`, `articleDate`, `articleImg`) VALUES
(1, '12 Habbits of Most Successful People', 'Aleksandr Antonov', '1. Genuine people don’t try to make people like them. Genuine people are who they are. They know that some people will like them, and some won’t. And they’re OK with that. It’s not that they don’t care whether or not other people will like them but simply that they’re not going to let that get in the way of doing the right thing. They’re willing to make unpopular decisions and to take unpopular positions if that’s what needs to be done.\r\n\r\nSince genuine people aren’t desperate for attention, they don’t try to show off. They know that when they speak in a friendly, confident, and concise manner, people are much more attentive to and interested in what they have to say than if they try to show that they’re important. People catch on to your attitude quickly and are more attracted to the right attitude than what or how many people you know.\r\n\r\n2. They don’t pass judgment. Genuine people are open-minded, which makes them approachable and interesting to others. No one wants to have a conversation with someone who has already formed an opinion and is not willing to listen.\r\n\r\nHaving an open mind is crucial in the workplace, as approachability means access to new ideas and help. To eliminate preconceived notions and judgment, you need to see the world through other people’s eyes. This doesn’t require you to believe what they believe or condone their behavior; it simply means you quit passing judgment long enough to truly understand what makes them tick. Only then can you let them be who they are.\r\n\r\n3. They forge their own paths. Genuine people don’t derive their sense of pleasure and satisfaction from the opinions of others. This frees them up to follow their own internal compasses. They know who they are and don’t pretend to be anything else. Their direction comes from within, from their own principles and values. They do what they believe to be the right thing, and they’re not swayed by the fact that somebody might not like it.\r\n\r\n\r\n', 'Habits, Motivation, Test, Tags', '2017-03-22', 'img/event-placeholder.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `chapters`
--

CREATE TABLE `chapters` (
  `chapterID` int(11) NOT NULL,
  `chapterName` varchar(255) NOT NULL,
  `chapterAddress` varchar(255) NOT NULL,
  `chapterCity` varchar(50) NOT NULL,
  `chapterState` varchar(50) NOT NULL,
  `chapterZip` varchar(10) NOT NULL,
  `chapterDesc` varchar(650) NOT NULL,
  `chapterImg` varchar(255) NOT NULL,
  `chapterCreationDate` int(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `chapters`
--

INSERT INTO `chapters` (`chapterID`, `chapterName`, `chapterAddress`, `chapterCity`, `chapterState`, `chapterZip`, `chapterDesc`, `chapterImg`, `chapterCreationDate`) VALUES
(1, 'Denver Test Chapter', '123 Lorem ipsum Street Suite 100', 'Denver', 'CO', '80202', 'This is a Test Chapter to Test The Results.  Integer elementum, magna id euismod vulputate, ex felis aliquet metus, a iaculis turpis nulla et purus. Curabitur ut elementum est. Vestibulum est nulla, scelerisque ac odio et, tempor tincidunt turpis. Integer', 'img/networking.jpg', 0);

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `eventID` int(11) NOT NULL,
  `eventTitle` varchar(255) NOT NULL,
  `eventBy` varchar(50) NOT NULL,
  `eventCategory` varchar(50) NOT NULL,
  `eventDateStart` varchar(50) NOT NULL,
  `eventTimeStart` varchar(50) NOT NULL,
  `eventDateEnd` varchar(50) NOT NULL,
  `eventTimeEnd` varchar(50) NOT NULL,
  `oneDayEvent` tinyint(1) NOT NULL DEFAULT '0',
  `eventAddress` varchar(255) NOT NULL,
  `eventCity` varchar(255) NOT NULL,
  `eventState` varchar(255) NOT NULL,
  `eventZip` varchar(10) NOT NULL,
  `paidEvent` tinyint(1) NOT NULL DEFAULT '0',
  `eventTicketsLink` text NOT NULL,
  `eventPrice` float NOT NULL DEFAULT '0',
  `eventDesc` text NOT NULL,
  `eventTags` text NOT NULL,
  `eventImg` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`eventID`, `eventTitle`, `eventBy`, `eventCategory`, `eventDateStart`, `eventTimeStart`, `eventDateEnd`, `eventTimeEnd`, `oneDayEvent`, `eventAddress`, `eventCity`, `eventState`, `eventZip`, `paidEvent`, `eventTicketsLink`, `eventPrice`, `eventDesc`, `eventTags`, `eventImg`) VALUES
(18, 'First Added Event (10:00PM 9:00AM)', 'Broomfield Test Chapter', 'Other Event', '1490396400', '1490302800', '1490911200', '1490256000', 0, '1300 Adams St', 'Denver', 'CO', '80206', 1, 'http://sloanegalleryofart.com', 140, '<p>This is a Test Event</p>', 'Tag, Tag, Tag', '../events/1490302061_barb.jpg'),
(19, 'Event 35', 'Denver Test Chapter', 'Other Event', '01/01/70', '12:00am', '01/01/70', '12:00am', 0, '1300 Adams St', 'Denver', 'CO', '80206', 0, '', 0, '<p>Test Eveny</p>', 'Tag, Tag, Tag', '../events/1490307193_construct.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `prospects`
--

CREATE TABLE `prospects` (
  `prospectID` int(11) NOT NULL,
  `archived` varchar(5) NOT NULL DEFAULT 'no',
  `converted` varchar(5) NOT NULL DEFAULT 'no',
  `dateConverted` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `hash` varchar(255) NOT NULL,
  `groups` varchar(50) NOT NULL,
  `fName` varchar(255) NOT NULL,
  `lName` varchar(255) NOT NULL,
  `bio` varchar(255) DEFAULT NULL,
  `jTitle` varchar(50) NOT NULL,
  `linkedInLink` varchar(255) NOT NULL,
  `profPic` varchar(255) NOT NULL,
  `covPic` varchar(255) NOT NULL,
  `compName` varchar(255) NOT NULL,
  `compAddOne` varchar(255) NOT NULL,
  `compAddTwo` varchar(255) NOT NULL,
  `compCity` varchar(50) NOT NULL,
  `compState` varchar(50) NOT NULL,
  `compZip` varchar(10) NOT NULL,
  `compPhone` varchar(12) NOT NULL,
  `compEmail` varchar(255) NOT NULL,
  `compWeb` varchar(255) NOT NULL,
  `compLogo` varchar(255) NOT NULL,
  `industry` varchar(50) NOT NULL,
  `fsAplBussFocus` varchar(25) NOT NULL,
  `fsAplBussPosition` varchar(25) NOT NULL,
  `fsAplNetworkingBeneficial` varchar(25) NOT NULL,
  `fsAplReferralTurnarround` varchar(25) NOT NULL,
  `fsAplCompEmploy` varchar(25) NOT NULL,
  `fsAplYearsInIndustry` varchar(25) NOT NULL,
  `fsAplYearsSinceHsGraduation` varchar(25) NOT NULL,
  `fsAplYearsOfNetworking` varchar(25) NOT NULL,
  `fsAplUseLinkedIn` varchar(25) NOT NULL,
  `fsAplNetworkingAttendance` varchar(25) NOT NULL,
  `fsAplNetworkingParticipation` varchar(25) NOT NULL,
  `fsAplWaitForOpportunity` varchar(25) NOT NULL,
  `fsAplSeekOutCustomers` varchar(25) NOT NULL,
  `fsAplTrackBusiness` varchar(25) NOT NULL,
  `fsAplWorkHoursWeek` varchar(25) NOT NULL,
  `fsAplFieldVsClinets` varchar(25) NOT NULL,
  `fsAplOfficeVsDesk` varchar(25) NOT NULL,
  `fsAplTrackNetworking` tinyint(1) NOT NULL,
  `fsAplEducationCompleted` varchar(25) NOT NULL,
  `fsAplAge` int(11) NOT NULL,
  `fsAplAgreement` tinyint(1) NOT NULL,
  `gChamberCommerce` varchar(20) DEFAULT NULL,
  `gChamberLeadsGroup` varchar(20) DEFAULT NULL,
  `gMyChamber` varchar(20) DEFAULT NULL,
  `gBNI` varchar(20) DEFAULT NULL,
  `gLeTip` varchar(20) DEFAULT NULL,
  `gVistage` varchar(20) DEFAULT NULL,
  `gTab` varchar(20) DEFAULT NULL,
  `gStrategicConnections` varchar(20) DEFAULT NULL,
  `gOneBusinessConnection` varchar(20) DEFAULT NULL,
  `gFourBR` varchar(20) DEFAULT NULL,
  `gMyFirestorm` varchar(20) DEFAULT NULL,
  `gEntrepreneurs` varchar(20) DEFAULT NULL,
  `gTipClub` varchar(20) DEFAULT NULL,
  `gMeetup` varchar(20) DEFAULT NULL,
  `gIndependent` varchar(20) DEFAULT NULL,
  `gRotary` varchar(20) DEFAULT NULL,
  `gNone` varchar(20) DEFAULT NULL,
  `pgChamberCommerce` varchar(20) DEFAULT NULL,
  `pgChamberLeadsGroup` varchar(20) DEFAULT NULL,
  `pgMyChamber` varchar(20) DEFAULT NULL,
  `pgBNI` varchar(20) DEFAULT NULL,
  `pgLeTip` varchar(20) DEFAULT NULL,
  `pgVistage` varchar(20) DEFAULT NULL,
  `pgTab` varchar(20) DEFAULT NULL,
  `pgStrategicConnections` varchar(20) DEFAULT NULL,
  `pgOneBusinessConnection` varchar(20) DEFAULT NULL,
  `pgFourBR` varchar(20) DEFAULT NULL,
  `pgMyFirestorm` text,
  `pgEntrepreneurs` varchar(20) DEFAULT NULL,
  `pgTipClub` varchar(20) DEFAULT NULL,
  `pgMeetup` varchar(20) DEFAULT NULL,
  `pgIndependent` varchar(20) DEFAULT NULL,
  `pgRotary` varchar(20) DEFAULT NULL,
  `pgNone` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `prospects`
--

INSERT INTO `prospects` (`prospectID`, `archived`, `converted`, `dateConverted`, `email`, `hash`, `groups`, `fName`, `lName`, `bio`, `jTitle`, `linkedInLink`, `profPic`, `covPic`, `compName`, `compAddOne`, `compAddTwo`, `compCity`, `compState`, `compZip`, `compPhone`, `compEmail`, `compWeb`, `compLogo`, `industry`, `fsAplBussFocus`, `fsAplBussPosition`, `fsAplNetworkingBeneficial`, `fsAplReferralTurnarround`, `fsAplCompEmploy`, `fsAplYearsInIndustry`, `fsAplYearsSinceHsGraduation`, `fsAplYearsOfNetworking`, `fsAplUseLinkedIn`, `fsAplNetworkingAttendance`, `fsAplNetworkingParticipation`, `fsAplWaitForOpportunity`, `fsAplSeekOutCustomers`, `fsAplTrackBusiness`, `fsAplWorkHoursWeek`, `fsAplFieldVsClinets`, `fsAplOfficeVsDesk`, `fsAplTrackNetworking`, `fsAplEducationCompleted`, `fsAplAge`, `fsAplAgreement`, `gChamberCommerce`, `gChamberLeadsGroup`, `gMyChamber`, `gBNI`, `gLeTip`, `gVistage`, `gTab`, `gStrategicConnections`, `gOneBusinessConnection`, `gFourBR`, `gMyFirestorm`, `gEntrepreneurs`, `gTipClub`, `gMeetup`, `gIndependent`, `gRotary`, `gNone`, `pgChamberCommerce`, `pgChamberLeadsGroup`, `pgMyChamber`, `pgBNI`, `pgLeTip`, `pgVistage`, `pgTab`, `pgStrategicConnections`, `pgOneBusinessConnection`, `pgFourBR`, `pgMyFirestorm`, `pgEntrepreneurs`, `pgTipClub`, `pgMeetup`, `pgIndependent`, `pgRotary`, `pgNone`) VALUES
(23, 'no', 'yes', '1491598122', 'Test@Email.com', 'ddaf35a193617abacc417349ae20413112e6fa4e89a97ea20a9eeee64b55d39a2192992a274fc1a836ba3c23a3feebbd454d4423643ce80e2a9ac94fa54ca49f', 'Golden B2B Chapter', 'Aleksandr', 'Antonov', NULL, 'Web Developer', 'http://Linkedin.com', './prospectFiles/1491581571_testimonial-img1.jpg', './prospectFiles/1491581575_background1.jpg', 'Lasyte Solution', '123 Lorem Ipsum', 'Unit 100', 'chicago', 'IL', '908734', '1234567890', 'Info@lasyte.com', 'http://lasyte.com', './prospectFiles/1491581630_cwd-logo-2.png', 'Web Design', 'Business to Consumer', 'Solopreneur / Independent', 'Usually', '3 - 4 months', '6 - 10', '17', '3', '3', 'Usually', '2-3 times per month', 'Often', 'Usually', 'Always', 'Sometimes', '31 - 40', '25', '20', 1, 'High School Diploma', 0, 1, NULL, NULL, NULL, 'BNI', 'LeTip', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Tip Club', NULL, NULL, 'Rotary', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(25, 'no', 'yes', '1491599482', 'test', 'ee26b0dd4af7e749aa1a8ee3c10ae9923f618980772e473f8819a5d4940e0db27ac185f8a0e1d5f84f88bc887fd67b143732c304cc5fa9ad8e6f57f50028a8ff', 'Miami Beach', 'test', 'test', 'test\\n            ', 'test', 'test', './prospectFiles/1491591806_testimonial-img3.jpg', './prospectFiles/1491591816_slide.jpg', 'test', '123 Lorem Ipsum', 'test', 'chicago', 'IL', '908734', 'test', 'test', 'test', 'C:\\\\fakepath\\\\cwd-logo-2.png', 'Bookkeeping Service', 'Business to Business', 'Executive/CEO', 'Sometimes', '5 - 6 months', '11 - 20', '4', '4', '5', 'Sometimes', '2-3 times per month', 'Often', 'Often', 'Usually', 'Usually', '21 - 30', '20', '20', 1, 'Some College', 0, 1, NULL, NULL, NULL, NULL, 'LeTip', 'Vistage', 'TAB', NULL, NULL, '4 BR', NULL, 'Entrepreneurs Organi', 'Tip Club', 'A Meetup Group', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'LeTip', 'Vistage', NULL, NULL, NULL, '4 BR', NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sliders`
--

CREATE TABLE `sliders` (
  `slideID` int(11) NOT NULL,
  `slideImg` varchar(255) NOT NULL,
  `slideDesc` varchar(255) NOT NULL,
  `slideText` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sliders`
--

INSERT INTO `sliders` (`slideID`, `slideImg`, `slideDesc`, `slideText`) VALUES
(1, 'img/event-placeholder.jpg', 'This is slide image Description', 'Speed Networking'),
(2, '../sliders/1490801607_slide.jpg', 'adsf', 'adsfas');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userID` int(11) NOT NULL,
  `applicationID` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `hash` varchar(255) NOT NULL,
  `dateApproved` varchar(50) NOT NULL,
  `dateLastLogin` varchar(50) NOT NULL,
  `paymentStatus` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userID`, `applicationID`, `email`, `hash`, `dateApproved`, `dateLastLogin`, `paymentStatus`) VALUES
(5, 23, 'Test@Email.com', 'ddaf35a193617abacc417349ae20413112e6fa4e89a97ea20a9eeee64b55d39a2192992a274fc1a836ba3c23a3feebbd454d4423643ce80e2a9ac94fa54ca49f', '1491598122', '1491598122', 0),
(6, 25, 'test', 'ee26b0dd4af7e749aa1a8ee3c10ae9923f618980772e473f8819a5d4940e0db27ac185f8a0e1d5f84f88bc887fd67b143732c304cc5fa9ad8e6f57f50028a8ff', '1491599482', '1491599482', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`adminID`);

--
-- Indexes for table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`articleID`);

--
-- Indexes for table `chapters`
--
ALTER TABLE `chapters`
  ADD PRIMARY KEY (`chapterID`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`eventID`);

--
-- Indexes for table `prospects`
--
ALTER TABLE `prospects`
  ADD PRIMARY KEY (`prospectID`);

--
-- Indexes for table `sliders`
--
ALTER TABLE `sliders`
  ADD PRIMARY KEY (`slideID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `adminID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `articles`
--
ALTER TABLE `articles`
  MODIFY `articleID` int(32) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `chapters`
--
ALTER TABLE `chapters`
  MODIFY `chapterID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `eventID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `prospects`
--
ALTER TABLE `prospects`
  MODIFY `prospectID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `sliders`
--
ALTER TABLE `sliders`
  MODIFY `slideID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
