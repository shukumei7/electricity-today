-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: db:3306
-- Generation Time: Dec 15, 2023 at 08:43 PM
-- Server version: 5.7.44
-- PHP Version: 8.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `electricity_today`
--

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

CREATE TABLE `articles` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(50) NOT NULL,
  `author` varchar(1000) NOT NULL,
  `image` varchar(1000) NOT NULL,
  `content` text NOT NULL,
  `date_published` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `articles`
--

INSERT INTO `articles` (`id`, `title`, `slug`, `author`, `image`, `content`, `date_published`) VALUES
(2, 'A Primer on the Codes and Standards Governing Battery Safety and Compliance', 'a-primer-on-the-codes-and-standards-governing-batt', 'Jeff Donato', 'https://www.electricity-today.com/wp-content/uploads/magazine_may_june_2023_article_5.jpg', 'Batteries have greatly influenced the utility industry, and the evolution of battery chemistries has revolutionized their applications. With the emergence of new technologies and advancements in existing ones, standards committees and safety code writers are working to develop best practices and establish minimum safety guidelines.\r\n\r\nThese groups, comprised of volunteers from diverse industry segments, are actively involved in shaping the standards and model codes that govern battery usage and safety. Their efforts are aimed at keeping pace with the rapidly evolving landscape of battery technology and ensuring its safe and efficient implementation.\r\n\r\nBattery Applications\r\nBatteries are used in a variety of battery energy storage (BESS) applications. Below is a list of common utility market applications and how batteries are used to support operations:\r\n\r\nGrid Stabilization: A stronger grid is required to support increased power requirements and demand. More devices are becoming electrified, including automobiles, and are demanding more energy. Energy storage can help stabilize the grid by providing energy back to the grid when the demand rises and store energy when excess power is available.\r\n\r\nRenewable Energy: Renewable sources of energy (solar, wind) generate electricity intermittently, and their outputs fluctuate with weather conditions. Batteries will store excess energy during periods of high renewable generation and discharge the batteries when generation is low. As a system, this provides a more consistent and reliable source of energy.\r\n\r\nMicrogrids and Off-Grid Systems: Batteries help create micro grids that can operate independently from the main power grid. In remote areas together with renewable energies, batteries can provide electricity to communities without access to the central power grid.\r\n\r\nGrid Resilience and Backup Power: Batteries provide backup power during outages and emergencies. This includes substations that have powered switches, SCADA control systems and end users such as data centers, telecommunications companies, and other mission critical infrastructure for organizations.\r\n\r\nDemand Response: Batteries can be used where electricity consumers reduce their demand, following a request from their utility, during peak hours in exchange for incentives. This helps reduce peak loads while managing demand fluctuations and alleviating strain on the grid.\r\n\r\nPeak Shaving: Building owners can reduce their maximum hourly power requirement by knowing the load signature of the building and peak consumption intervals. Peak shaving lets these consumers use batteries to reduce electric charges from peak usage where price per kW is higher to off-peak usage where the price per kW is lower.\r\n\r\nElectric Vehicle Integration: As electric vehicles become more prevalent, their batteries can be used to store excess renewable energy and discharge it back to the grid during periods of high demand.', '2023-12-10 18:56:48'),
(3, 'Substation Focused on Environmental Design', 'substation-focused-on-environmental-design', 'www.inmr.com', 'https://www.electricity-today.com/wp-content/uploads/magazine_may_june_2023_article_4.jpg', 'One of the important trends in design of new overhead lines over the past 20 years has been development of structures and designs that are less obtrusive and more pleasing visually. Much the same process has also been going on at substations. For example, even 25 years ago, efforts had already been in place as far afield as Finland and Australia to build substations designed to facilitate acceptance by affected communities – either through aesthetic appearance, reduced scale or other factors. Indeed, more and more substations these days – especially those sited in urban centers or along well-traveled roads – are being designed to minimize adverse environmental and aesthetic impact.\r\nDuring the mid-1990s, TransGrid – the network operator in New South Wales (NSW), Australia – wanted to build a substation at the confluence of existing 330 kV and 132 kV lines. Located some 60 km west of Sydney, this pristine rural area is marked by hobby farms and historic towns – exactly the type of place where any proposed new air-insulated substation would likely be met with staunch resistance. But given the site’s high strategic value, engineers worked extra hard to find a design that would meet all criteria required for public acceptance, without resorting to costly GIS.\r\nAmong the measures in this regard was to go out at an early stage to involve local people and all relevant special interest groups. Various options were laid out even before a firm site had been selected. One of these included establishing a wildlife area with animal paths integrated into the station’s overall landscaping. More significantly, one of the most evident differences at Regentsville Substation versus a ‘compact’ station in densely populated regions is that the key goal here was to minimize height, not land surface. Unlike in places such as Europe where compact station design typically involves a small ‘footprint’ with relatively tall structures, land size was not the central issue here. Instead, the focus was on controlling height to best understate the station’s visual impact. One obvious example of this philosophy is the 330 kV entrance portal, which is unusually low compared to other TransGrid substations at this voltage. The 132 kV portal is also lower than conventional. Generally, there is a trade-off in height, with lower structures requiring the first to be located fairly close to the station. But here this was not a factor since the tower was already there. Helping make the low green-colored portals even less noticeable was use of low profile composite insulators, also utilized on the tower entering the substation.', '2023-12-13 02:48:39'),
(4, 'Why calibrate test equipment', 'why-calibrate-test-equipment', 'Randy Hurst', 'https://www.electricity-today.com/wp-content/uploads/magazine_jul_aug_2023_article_4.jpg', 'You’re serious about your electrical test instruments. You buy top brands, and you expect them to be accurate. You know some people send their digital instruments to a metrology lab for calibration, and you wonder why. After all, these are all electronic — there’s no meter movement to go out of balance. What do those calibration folks do, anyhow — just change the battery? These are valid concerns, especially since you can’t use your instrument while it’s out for calibration. But, let’s consider some other valid concerns. For example, what if an event rendered your instrument less accurate, or maybe even unsafe? What if you are working with tight tolerances, and accurate measurement is key to proper operation of expensive processes or safety systems? What if you are trending data for maintenance purposes, and two meters used for the same measurement significantly disagree?\r\n\r\nWHAT IS CALIBRATION?\r\nMany people do a field comparison check of two meters, and call them “calibrated” if they give the same reading. This isn’t calibration. It’s simply a field check. It can show you if there’s a problem, but it can’t show you which meter is right. If both meters are out of calibration by the same amount and in the same direction, it won’t show you anything. Nor will it show you any trending — you won’t know your instrument is headed for an “out of cal” condition.', '2023-12-13 03:49:54'),
(5, 'Distribution Transformer DGA – The Future of Monitoring Distribution Systems', 'distribution-transformer-dga-the-future-of-monitor', 'Leon White', 'https://www.electricity-today.com/wp-content/uploads/2-22.jpg', 'As distributed generation, electric vehicle load, and requirements for increased electricity reliability provide real-world challenges for electric utilities, asset managers must innovate to ensure their infrastructure is in good condition to deliver safe, reliable, and uninterrupted power to customers. \r\n\r\nDistribution systems have been designed to transfer power from large remote generators to customers via radial distribution networks.  This paper will discuss the progress that is being made in using new internet of things (IoT) innovations to provide real-time data from distribution assets so operators can understand the real-time health of their distribution equipment.\r\n\r\nThe primary purpose of an electricity distribution system is to provide reliable and low-cost power to the end user upon demand. In recent years, this has become an ever-increasing challenge for asset managers as the demand for power has increased and the loads and stress placed on transformers and other assets has equally increased.\r\n\r\nIt has been predicted that the global demand for energy will increase at a rate of about 5% compound annual growth rate (CAGR). To keep up with this growth and minimize the carbon footprint of generation sources, renewable wind and solar, have been rapidly deployed, sharing the majority of renewable energy capacity globally. However, these resources are highly unpredictable and create increased strain on an already stressed network of in-service transformers across the grid.\r\n\r\nIn 2022, a major US analytical laboratory estimated that 30% of today’s in-service transformers are aging prematurely, and of that group, 70% are not receiving any remedial action. When you couple these trends with recent supply chain issues, more intense and frequent natural disasters, lead times for replacement transformers increasing significantly (443% increase according to the Electricity Subsector Coordinating Council), and the decline in staff available to manage these assets, these factors have elevated the need for IoT innovations on in-service units to new heights. San Diego Gas & Electric recently estimated the cost to decarbonize and become net-zero by 2045 at $2.7 trillion.', '2023-12-15 19:15:07'),
(6, 'Hydrogen Monitoring in the Transformer Headspace Compared to Traditional In-Oil Monitoring', 'hydrogen-monitoring-in-the-transformer-headspace-c', 'Chris Rutledge', 'https://www.electricity-today.com/wp-content/uploads/1-24.jpg', 'Introduction\r\nThe utilization of online dissolved gas analysis monitoring has proven to be one of the most effective predictors of overall transformer health and condition. A wide range of monitoring systems are available, offering multiple cost/feature/benefit combinations.\r\n\r\nHydrogen Monitoring\r\nSingle or key gas monitoring relies on the use of a sensor for the detection of hydrogen levels either dissolved in the oil or accumulated in the gas space of a transformer. While hydrogen monitoring alone does not provide enough detail to perform any advanced analytics, it is very useful in the early detection of incipient faults. This is due to the manner which hydrogen generates when compared to the other hot metal gases.\r\n\r\nHydrogen begins generating at 150°C and continues to generate directly as the fault temperatures increases. This unique property makes hydrogen the best single indicator of not only excessive thermal conditions, but also dielectric faults occurring within a transformer. In addition, hydrogen gas is also a key indicator of both arcing and partial discharge conditions.\r\n\r\nHowever, there are many factors which must be taken into consideration when implementing hydrogen monitoring for condition assessment of a transformer. Perhaps the most critical of these factors is hydrogen’s solubility in oil. Due to hydrogen’s low solubility in mineral oil, ppm values of dissolved hydrogen may be greatly affected by the design of the transformer, as transformers with nitrogen preservation systems will result in hydrogen quickly migrating across the gas oil partition, causing approximately a 20:1 ratio of gas in the headspace versus that which is dissolved in oil.', '2023-12-15 19:25:23'),
(7, 'Grounding System Testing: Simplified Fall-Of-Potential And Step-And-Touch Voltage Testing', 'grounding-system-testing-simplified-fall-of-potent', 'Logan Merrill', 'https://www.electricity-today.com/wp-content/uploads/1-23-e1679528835630.jpg', 'Verifying the functionality and integrity of a grounding system is critical to maintaining a safe workspace. Unfortunately, the tests used to achieve this goal, as well as the standards used to assess them, have required a specialized skillset, often leaving these tests done improperly or not at all. Now, with the industry progressing toward guided testing, new solutions make it possible for these tests to be performed correctly and accurately with limited test-specific training. Ultimately, this makes the difficulty of testing a ground grid similar to that of testing a transformer or circuit breaker. This article explains the purpose and theory behind grounding system testing, as well as an explanation of how the test is performed.\r\n\r\nTheory\r\nDuring a ground fault, fault current circulates between the fault location and the substation source that is driving it. In order to establish a low-ohmic return path for the fault current, grounding systems are designed to allow a conductive low-ohmic connection between the soil and the neutral of the system where the fault is located.\r\n\r\nIn principle, a grounding system consists of conductive elements including wires, rods, etc. These elements have direct contact to soil and therefore allow a current to flow between the soil and the neutral. Each conductive element placed in the soil increases the surface area of the grounding system in contact with the earth and reduces the grounding system’s impedance. With each successive element added to the ground grid within a given area, the incremental benefit is reduced; however, it remains true that the more conductive elements in the soil, the better the grounding system is.\r\n\r\nFigure 1 illustrates the potential in the event of a ground fault at the tower of an overhead transmission line. The return current through soil causes a potential rise of the grounding system and the tower where the fault occurs when compared to reference ground (illustrated here as the flat green plain surrounding the ground grid and fault location). Following electromagnetic field theory, the result of such an event is two upward and downward cone-shaped potential rises, as depicted in Figure 1.\r\n\r\nPotential chart\r\n\r\nThe resulting potential rise, VG, is represented as the voltage between the grounding system and remote earth (a theoretical ground reference at an infinitely remote location, normally considered to be at zero potential). For testing purposes, remote earth is represented by the flat part around the grounding system’s potential rise, referred to as the reference ground. This zone is considered to be outside the area that is influenced by the grounding system.\r\n\r\nTo measure the connection between the grounding system and earth, ground impedance, ZG, is introduced:\r\n\r\n\r\n\r\nHigh ground impedance indicates a poor connection to reference earth. To reduce ground impedance, the grounding system must either be extended by additional conductive elements or repaired by replacing conductive elements that have deteriorated. This section explains how to determine the ground impedance.', '2023-12-15 20:21:51');

-- --------------------------------------------------------

--
-- Table structure for table `articles_categories`
--

CREATE TABLE `articles_categories` (
  `id` int(50) UNSIGNED NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `article_id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `articles_categories`
--

INSERT INTO `articles_categories` (`id`, `category_id`, `article_id`) VALUES
(1, 1, 2),
(2, 1, 3),
(3, 2, 4),
(6, 2, 7),
(4, 3, 5),
(5, 3, 6),
(7, 3, 7);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL,
  `slug` varchar(50) NOT NULL,
  `sort` tinyint(2) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `sort`) VALUES
(1, 'T&D Automation', 'td-automation', 0),
(2, 'Overhead TD', 'overhead-td', 0),
(3, 'News', 'news', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`);

--
-- Indexes for table `articles_categories`
--
ALTER TABLE `articles_categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `category_id` (`category_id`,`article_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`),
  ADD UNIQUE KEY `slug` (`slug`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `articles`
--
ALTER TABLE `articles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `articles_categories`
--
ALTER TABLE `articles_categories`
  MODIFY `id` int(50) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
