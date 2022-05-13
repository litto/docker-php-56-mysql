-- phpMyAdmin SQL Dump
-- version 3.4.10.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 16, 2015 at 09:42 AM
-- Server version: 5.5.20
-- PHP Version: 5.3.10

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `uaedebtcollect`
--

-- --------------------------------------------------------

--
-- Table structure for table `cms_album`
--

CREATE TABLE IF NOT EXISTS `cms_album` (
  `album_id` int(70) NOT NULL AUTO_INCREMENT,
  `album_title` varchar(120) NOT NULL,
  `status` int(70) NOT NULL DEFAULT '1',
  PRIMARY KEY (`album_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

-- --------------------------------------------------------

--
-- Table structure for table `cms_alumini`
--

CREATE TABLE IF NOT EXISTS `cms_alumini` (
  `id` int(120) NOT NULL AUTO_INCREMENT,
  `photo` varchar(500) NOT NULL,
  `description` text NOT NULL,
  `status` int(120) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `cms_alumini`
--

INSERT INTO `cms_alumini` (`id`, `photo`, `description`, `status`) VALUES
(1, 'theatre-e68879a4136298270511094954.png', 'Imagename', 1),
(2, 'theatre-50c1f44e136298272311085725.jpg', 'Imagename', 1);

-- --------------------------------------------------------

--
-- Table structure for table `cms_auth`
--

CREATE TABLE IF NOT EXISTS `cms_auth` (
  `auth_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) COLLATE utf8_bin NOT NULL,
  `password` varchar(20) COLLATE utf8_bin NOT NULL,
  `pass_key` varchar(20) COLLATE utf8_bin NOT NULL,
  `email` varchar(120) COLLATE utf8_bin NOT NULL,
  `name` varchar(120) COLLATE utf8_bin NOT NULL,
  `date_create` datetime NOT NULL,
  `logo` varchar(500) COLLATE utf8_bin NOT NULL DEFAULT 'ortus-logo2.png',
  `ip` varchar(800) COLLATE utf8_bin NOT NULL,
  `browser` varchar(800) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`auth_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=2 ;

--
-- Dumping data for table `cms_auth`
--

INSERT INTO `cms_auth` (`auth_id`, `username`, `password`, `pass_key`, `email`, `name`, `date_create`, `logo`, `ip`, `browser`) VALUES
(1, 'admin', 'q6SY5LmuiH8=', '8234910', 'info@uaedebtcollection.com', 'admin', '2015-02-15 12:06:37', 'logo-4ef42b32141327469210187328.png', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/40.0.2214.111 Safari/537.36');

-- --------------------------------------------------------

--
-- Table structure for table `cms_banner`
--

CREATE TABLE IF NOT EXISTS `cms_banner` (
  `banner_id` int(120) NOT NULL AUTO_INCREMENT,
  `title` varchar(500) NOT NULL,
  `image` varchar(500) NOT NULL,
  `status` int(120) NOT NULL,
  PRIMARY KEY (`banner_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `cms_banner`
--

INSERT INTO `cms_banner` (`banner_id`, `title`, `image`, `status`) VALUES
(10, 'Banner-1', 'banner-aa78c3db142400420010872760.png', 1),
(11, 'Banner-2', 'banner-decc2e06142400420910311963.png', 1),
(12, 'Banner-3', 'banner-570320a4142400421910415333.png', 1);

-- --------------------------------------------------------

--
-- Table structure for table `cms_careers`
--

CREATE TABLE IF NOT EXISTS `cms_careers` (
  `career_id` int(70) NOT NULL AUTO_INCREMENT,
  `career_title` varchar(140) NOT NULL,
  `career_desc` text NOT NULL,
  `exp` varchar(500) NOT NULL,
  `location` varchar(500) NOT NULL,
  `jobdesc` text NOT NULL,
  `area` varchar(500) NOT NULL,
  `education` varchar(500) NOT NULL,
  `joiningtime` varchar(500) NOT NULL,
  `date_last` date NOT NULL,
  `status` int(70) NOT NULL,
  PRIMARY KEY (`career_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `cms_careers`
--

INSERT INTO `cms_careers` (`career_id`, `career_title`, `career_desc`, `exp`, `location`, `jobdesc`, `area`, `education`, `joiningtime`, `date_last`, `status`) VALUES
(3, 'Web programmer', 'We are looking for webprogramming  professionals of the peak talent for the roles of manager, executive, software profesionals, trainees, web designer and developer for our head office and branches in Dubai, Abu dhabi, Cochin, Trivandrum and Bangalore.', '1year', 'ernakulam', '<p>prefer to work in both shifts,advanced knowledge in php,javascript,ajax</p>', 'IT,WEB', 'BTECH', 'immedietely', '2012-07-25', 1),
(4, 'Marketing Executive', '<p><span>We are looking for IT, Telecome &amp; Marketing professionals of the peak talent for the roles of manager, executive, software profesionals, trainees, web designer and developer for our head office and branches in Dubai, Abu dhabi, Cochin, Trivandrum and Bangalore.</span></p>', 'Trainee & Exp.', 'Kerala', 'Excellent Communication & presentation skills is an added advantage.', 'IT/Web', 'PG / Diploma(Any)', 'Immediate', '2012-10-23', 1),
(5, 'WEb designer', 'We are looking for webprogramming  professionals of the peak talent for the roles of manager, executive, software profesionals, trainees, web designer and developer for our head office and branches in Dubai, Abu dhabi, Cochin, Trivandrum and Bangalore.', '1yr', 'Ekm', '<p>dcsdgsdgfg</p>', 'IT', 'Btech', 'immmediately', '2012-08-07', 1);

-- --------------------------------------------------------

--
-- Table structure for table `cms_clients`
--

CREATE TABLE IF NOT EXISTS `cms_clients` (
  `client_id` int(120) NOT NULL AUTO_INCREMENT,
  `client_name` varchar(500) NOT NULL,
  `client_logo` varchar(500) NOT NULL,
  `url` varchar(500) NOT NULL,
  `description` text NOT NULL,
  `status` int(120) NOT NULL,
  PRIMARY KEY (`client_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `cms_clients`
--

INSERT INTO `cms_clients` (`client_id`, `client_name`, `client_logo`, `url`, `description`, `status`) VALUES
(1, 'Chinmaya vidyalaya', 'banner-d90e5b66134450068010419858.jpg', 'www.cimttsr.org', '<p>Chinmaya Mission, worldwide, has a good reputation for running academic institutions of high standards. Chinmaya Mission Colleges and Vidyalayas are much sought after by the parents to have value based education for their children. Academic excellence coupled with value education makes Chinmaya institutions unique in its functioning. Highly qualified and dedicated band of workers of the Chinmaya Mission Trust sustains the steady growth of the institutions.litto</p>', 1),
(3, 'St.george', 'banner-54391c87134450484510024705.jpg', 'www.ortusinfosys.com', '<p>We believe advertising as the backbone of every product market; cementing this in mind we arrange to our clients all indoor and outdoor advertisements. Since we ensure these parameters such as attention, readability, visibility, message convenience and visual appeal, clients can rely on us for the successful completion of the advertisements.</p>', 1);

-- --------------------------------------------------------

--
-- Table structure for table `cms_contact`
--

CREATE TABLE IF NOT EXISTS `cms_contact` (
  `id` int(120) NOT NULL AUTO_INCREMENT,
  `company` varchar(500) NOT NULL,
  `contact_person` varchar(500) NOT NULL,
  `telephone` varchar(500) NOT NULL,
  `fax` varchar(500) NOT NULL,
  `email` varchar(500) NOT NULL,
  `mobile` varchar(500) NOT NULL,
  `zipcode` varchar(500) NOT NULL,
  `country` varchar(500) NOT NULL,
  `state` varchar(500) NOT NULL,
  `city` varchar(500) NOT NULL,
  `start_time` varchar(500) NOT NULL,
  `end_time` varchar(500) NOT NULL,
  `seo` text NOT NULL,
  `footer` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `cms_contact`
--

INSERT INTO `cms_contact` (`id`, `company`, `contact_person`, `telephone`, `fax`, `email`, `mobile`, `zipcode`, `country`, `state`, `city`, `start_time`, `end_time`, `seo`, `footer`) VALUES
(1, 'UAE Debt Collectors', 'demo', '+971553995821', '+971552585287', 'info@uaedebtcollection.com', '+971552585287', '2719', 'UAE', 'Dubai', 'Dubai', '09:00:00', '00:00:00', 'UAE DEBT COLLECTION|DEBT COLLECTION AGENCY | DUBAI|SHARJAH|ABUDHABI|AJMAN', '<p>&copy; proxymedia 2015</p>');

-- --------------------------------------------------------

--
-- Table structure for table `cms_debtdoc`
--

CREATE TABLE IF NOT EXISTS `cms_debtdoc` (
  `id` int(120) NOT NULL AUTO_INCREMENT,
  `enquiry_id` int(120) NOT NULL,
  `file` varchar(500) NOT NULL,
  `status` int(120) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Table structure for table `cms_debtenquirys`
--

CREATE TABLE IF NOT EXISTS `cms_debtenquirys` (
  `id` int(120) NOT NULL AUTO_INCREMENT,
  `name` varchar(500) NOT NULL,
  `designation` varchar(500) NOT NULL,
  `nationality` varchar(500) NOT NULL,
  `organization` varchar(500) NOT NULL,
  `mail` varchar(500) NOT NULL,
  `cell` varchar(500) NOT NULL,
  `location` varchar(500) NOT NULL,
  `postaladdress` varchar(500) NOT NULL,
  `fax` varchar(500) NOT NULL,
  `phone` varchar(500) NOT NULL,
  `service_type` text NOT NULL,
  `additional_info` text NOT NULL,
  `debtor_name` varchar(500) NOT NULL,
  `debtor_designation` varchar(500) NOT NULL,
  `debtor_nationality` varchar(500) NOT NULL,
  `debtor_organization` varchar(500) NOT NULL,
  `debtor_mail` varchar(500) NOT NULL,
  `debtor_cell` varchar(500) NOT NULL,
  `debtor_location` varchar(500) NOT NULL,
  `debtor_postaladdress` varchar(500) NOT NULL,
  `debtor_fax` varchar(500) NOT NULL,
  `debtor_phone` varchar(500) NOT NULL,
  `debtor_dueamount` varchar(500) NOT NULL,
  `debtor_currrency` varchar(500) NOT NULL,
  `checkreturn` int(120) NOT NULL,
  `inability` int(120) NOT NULL,
  `mailreturn` int(120) NOT NULL,
  `phonedisconnect` int(120) NOT NULL,
  `others` int(120) NOT NULL,
  `other_reason` text NOT NULL,
  `debtor_date_indebt` varchar(500) NOT NULL,
  `comments` text NOT NULL,
  `status` int(120) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

-- --------------------------------------------------------

--
-- Table structure for table `cms_facility`
--

CREATE TABLE IF NOT EXISTS `cms_facility` (
  `id` int(120) NOT NULL AUTO_INCREMENT,
  `photo` varchar(500) NOT NULL,
  `description` text NOT NULL,
  `status` int(120) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `cms_facility`
--

INSERT INTO `cms_facility` (`id`, `photo`, `description`, `status`) VALUES
(1, 'theatre-20754aeb136298222510783067.png', 'Imagename', 1),
(2, 'theatre-a4666cd9136298222511016127.png', 'Imagename', 1);

-- --------------------------------------------------------

--
-- Table structure for table `cms_faculty`
--

CREATE TABLE IF NOT EXISTS `cms_faculty` (
  `id` int(120) NOT NULL AUTO_INCREMENT,
  `photo` varchar(500) NOT NULL,
  `description` text NOT NULL,
  `status` int(120) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `cms_faculty`
--

INSERT INTO `cms_faculty` (`id`, `photo`, `description`, `status`) VALUES
(1, 'theatre-680390c5136298109410784555.png', 'raj', 1),
(2, 'theatre-48259990136298109410425979.png', 'valsa', 1);

-- --------------------------------------------------------

--
-- Table structure for table `cms_image`
--

CREATE TABLE IF NOT EXISTS `cms_image` (
  `image_id` int(70) NOT NULL AUTO_INCREMENT,
  `album_id` int(80) NOT NULL,
  `image_title` varchar(120) NOT NULL,
  `image_loc` varchar(200) NOT NULL,
  `status` int(70) NOT NULL DEFAULT '1',
  PRIMARY KEY (`image_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=61 ;

-- --------------------------------------------------------

--
-- Table structure for table `cms_media`
--

CREATE TABLE IF NOT EXISTS `cms_media` (
  `media_id` int(11) NOT NULL AUTO_INCREMENT,
  `published` tinyint(4) NOT NULL DEFAULT '0',
  `title` varchar(120) COLLATE utf8_bin NOT NULL,
  `file` varchar(180) COLLATE utf8_bin NOT NULL,
  `type` varchar(10) COLLATE utf8_bin NOT NULL,
  `date_update` datetime NOT NULL,
  `order` int(11) NOT NULL,
  `filesize` decimal(10,4) NOT NULL COMMENT 'Size-KB',
  `content` text COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`media_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=2 ;

--
-- Dumping data for table `cms_media`
--

INSERT INTO `cms_media` (`media_id`, `published`, `title`, `file`, `type`, `date_update`, `order`, `filesize`, `content`) VALUES
(1, 1, 'my doc', 'media-80a160ff134473040610983286.docx', 'docx', '2012-08-12 05:43:26', 1, '620.2010', '<p>great to see you</p>');

-- --------------------------------------------------------

--
-- Table structure for table `cms_news`
--

CREATE TABLE IF NOT EXISTS `cms_news` (
  `news_id` int(11) NOT NULL AUTO_INCREMENT,
  `featured` tinyint(4) NOT NULL DEFAULT '0',
  `archived` tinyint(4) NOT NULL DEFAULT '0',
  `published` tinyint(4) NOT NULL DEFAULT '0',
  `order` int(11) NOT NULL,
  `title` varchar(160) NOT NULL,
  `content` text NOT NULL,
  `image` varchar(500) NOT NULL,
  `date_update` datetime NOT NULL,
  PRIMARY KEY (`news_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `cms_news`
--

INSERT INTO `cms_news` (`news_id`, `featured`, `archived`, `published`, `order`, `title`, `content`, `image`, `date_update`) VALUES
(1, 0, 0, 1, 1, 'Lorem Ipsum is simply dummy text', '<p><span>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</span></p>', '', '2013-03-09 12:44:14'),
(2, 0, 0, 1, 2, 'Lorem Ipsum is simply dummy text of the printing', '<p><span>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</span></p>', '', '2013-03-09 12:44:34');

-- --------------------------------------------------------

--
-- Table structure for table `cms_newsletter`
--

CREATE TABLE IF NOT EXISTS `cms_newsletter` (
  `newsletter_id` int(120) NOT NULL AUTO_INCREMENT,
  `subject` varchar(500) NOT NULL,
  `content` text NOT NULL,
  `published` int(120) NOT NULL,
  `date_added` date NOT NULL,
  PRIMARY KEY (`newsletter_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `cms_newsletter`
--

INSERT INTO `cms_newsletter` (`newsletter_id`, `subject`, `content`, `published`, `date_added`) VALUES
(1, 'vbcn', '<p>fghjghkh kl</p>', 1, '2012-09-07'),
(6, 'hahaha', '<p>ahahahhahaahha</p>', 1, '2012-09-07');

-- --------------------------------------------------------

--
-- Table structure for table `cms_newsletter_sendinglist`
--

CREATE TABLE IF NOT EXISTS `cms_newsletter_sendinglist` (
  `id` int(120) NOT NULL AUTO_INCREMENT,
  `newsletter_id` int(120) DEFAULT NULL,
  `email` varchar(500) NOT NULL,
  `status` int(120) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `cms_newsletter_sendinglist`
--

INSERT INTO `cms_newsletter_sendinglist` (`id`, `newsletter_id`, `email`, `status`) VALUES
(1, 1, 'litto@axtecindia.com', 0),
(2, 6, 'litto@axtecindia.com', 0),
(3, 6, 'kirankrishnan@gmail.com', 0),
(4, 6, 'kiran@gmail.com', 0),
(5, 6, 'kull@gmail.com', 0),
(6, 6, 'masd@gmail.com', 0),
(7, 6, 'soosan@gmail.com', 0);

-- --------------------------------------------------------

--
-- Table structure for table `cms_pages`
--

CREATE TABLE IF NOT EXISTS `cms_pages` (
  `page_id` int(11) NOT NULL AUTO_INCREMENT,
  `order` int(11) NOT NULL,
  `level` tinyint(4) NOT NULL,
  `parent` int(11) NOT NULL,
  `position` varchar(20) COLLATE utf8_bin NOT NULL,
  `published` tinyint(4) NOT NULL,
  `default` tinyint(4) NOT NULL DEFAULT '0',
  `featured` tinyint(4) NOT NULL DEFAULT '0',
  `title` varchar(300) COLLATE utf8_bin NOT NULL,
  `page_title` varchar(250) COLLATE utf8_bin NOT NULL,
  `content` text COLLATE utf8_bin NOT NULL,
  `banner` varchar(200) COLLATE utf8_bin NOT NULL,
  `date_update` date NOT NULL,
  PRIMARY KEY (`page_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=6 ;

--
-- Dumping data for table `cms_pages`
--

INSERT INTO `cms_pages` (`page_id`, `order`, `level`, `parent`, `position`, `published`, `default`, `featured`, `title`, `page_title`, `content`, `banner`, `date_update`) VALUES
(1, 1, 1, 0, '', 1, 0, 0, 'Home', 'UAE Debt Collection', '<p>UAE Debt Collection, As we all know, in past days of financial disaster to world Economy, UAE Business Community also affects very badly Directly &amp; Indirectly from Local and International clients. Our online based company is associated with Law firms and and Debt Collection Agencies around the globe on Professional terms and conditions. Nowadays it&rsquo;s very hard to recover the full amount but it&rsquo;s easy to go for a barter deal if both are from a same country.</p>\r\n<p>We are not agreeing to recover interest amount because it can only be imposed by the Court. We have no rights to impose interest without any written acceptance from your debtor or a judgment from the court to pay.</p>\r\n<p>Debt Collection Service was introduced because of its need in UAE. UAE Debt Collectors Experienced from Europe and Gulf who open this website few years ago. We are an online connected network of Lawyers and Professional Debt Collectors all around UAE.</p>', 'page-0602940f14204478161091898.png', '2015-02-15'),
(2, 2, 1, 0, '', 1, 0, 0, 'About us', 'About us', '<p>Central focus is YOU!</p>\r\n<p>When you put your money on the line, you take a considerable surmountable risk. But great astounding success does not come without these risks. At UAE Debt Collection, we understand the sensitivity of your business and the nature of today&rsquo;s other structural businesses, and we provide a secure and sure debt collection solution to all your creditor&rsquo;s woe. we take great pride in informing you that we have been collecting bad debt from B2B firms since 1999.</p>\r\n<p>Our Associated members are internationally reputable law firms and law list publishers who encompass the enduring elements of this highly productive cycle of debt collections. Our attorneys follow the prescribed debt collection guidelines and abide by the consumer protection laws, and their usage of fair debt collection services provides us with a legal edge in over 200 countries, all with a different legal structure!</p>\r\n<p>As our client, you can be sure of the following things:</p>\r\n<p>Personalized recovery officer and service<br />Expert account handling by professionally experienced specialists<br />Consistent, step by step treatment with all your accounts<br />Tracking and monitoring performance for optimum results<br />World- wide expertise</p>\r\n<p>Be it contacting a debtor to pursuing a debt, UAE Debt Collections works with its clients, firmly believing as if it is our own money to recover. Contact us to ensure the safe and uncomplicated recovery of your debts by healthy means.</p>', 'page-9914464f141077972610271594.jpg', '2015-02-15'),
(3, 8, 1, 0, '', 1, 0, 0, 'Our Services', 'Our Services', '<p>A business is recognized by the reliability and dependability of the services it offers to its clients. These services form a barometer of future transactions, and are directly proportional to the foreseeable business the company is going to generate.</p>\r\n<p>In line of our work expertise: debt collection, these services are often regarded as seldom effective, tedious, and time consuming. UAE Debt Collections honors each and every client as a valuable asset to the company, without regarding the job as small or great. And combined with the efficiency of over 400 highly knowledgeable and experienced affiliated attorneys and various other reputable and dependable debt collection services agencies all over the key metropolitan localities, the process of debt collection services becomes exceedingly productive.</p>\r\n<p>UAE Debt Collections proudly provides services to its clients within 21 different industries. With such an expanded circle of influence, debt collection services become a novelty of invigorative ideas and imminent results to us, as we strive for the quickest and most beneficial solutions to the financial undertakings. Be it the recovery of money, or drawing up a settlement, a matter of the collection of medical or house insurance, or resolving a troublesome undertaking by filing a civil or criminal case, our employees are trained to meet whatever challenges they face during these debt collection services.</p>\r\n<p>UAE Debt Collections covers the following types of industries under our debt recovery systems:</p>\r\n<ul>\r\n<li>Normal Accounts Collection</li>\r\n<li>Stock/ Default Accounts Collection</li>\r\n<li>Disputed Amounts Collection</li>\r\n<li>Cheque Bounce/ Unpaid Invoices Collection</li>\r\n<li>To file a Criminal Case</li>\r\n<li>To file a Civil Case</li>\r\n<li>Unpaid Salaries</li>\r\n<li>Drafting of Credit Facility Letter</li>\r\n<li>Insurance Collection</li>\r\n<li>Construction and Maintenance Debts</li>\r\n<li>Mortgage Payment Collections</li>\r\n<li>Real Estate/ Installment Collection</li>\r\n<li>Real Estate Dispute Settlement</li>\r\n<li>Trade Debts</li>\r\n<li>Travel Debts</li>\r\n<li>Health Care Debts/ Legal Issues</li>\r\n<li>Medical Debt Collection Services</li>\r\n<li>Telecom</li>\r\n<li>Credit Card Debt</li>\r\n<li>Banks Collection</li>\r\n<li>Financial Settlements between Creditor and Debtor</li>\r\n</ul>\r\n<p>Contact us at UAE Debt Collections for resourceful, proficient and well- organized debt collection services in local and international businesses.</p>', 'page-0a54b19a141077971110398433.jpg', '2015-02-15'),
(4, 9, 1, 0, '', 1, 0, 0, 'How to Minimize Debt?', 'How to Minimize Debt?', '<p>Be Rational that a debt leads to Bad Debts and then leads a crash point to affect your cash in-flow and then finally Out-Flow.</p>\r\n<ul>\r\n<li>There should be Credit Management Department.</li>\r\n<li>Advance payment is particularly helpful when the deal amount is small.</li>\r\n<li>You can request a Percentage of Invoice Payment, for example 15 % to 20% for small amounts.</li>\r\n<li>Add a barter option also plus a Penalty amount on non-payment.</li>\r\n<li>Timely Act &ndash; Risk is a main Part of Business Deals. Better you go for Short time invoicing systems.</li>\r\n<li>Add an amount of 5% to 10% on date of payment, when not paid if it is written agreed.</li>\r\n<li>Work on a short period invoicing system.</li>\r\n<li>Polite language Reminder letters and calls if needed.</li>\r\n<li>Give an option to pay Early and offer discounts</li>\r\n</ul>', '', '2015-02-15');

-- --------------------------------------------------------

--
-- Table structure for table `cms_productattributes`
--

CREATE TABLE IF NOT EXISTS `cms_productattributes` (
  `id` int(120) NOT NULL AUTO_INCREMENT,
  `productid` int(120) NOT NULL,
  `name` varchar(500) NOT NULL,
  `description` text NOT NULL,
  `status` int(120) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `cms_productimages`
--

CREATE TABLE IF NOT EXISTS `cms_productimages` (
  `id` int(120) NOT NULL AUTO_INCREMENT,
  `product_id` int(120) NOT NULL,
  `imagename` varchar(500) NOT NULL,
  `imageloc` varchar(500) NOT NULL,
  `status` int(120) NOT NULL,
  `add_date` date NOT NULL,
  `ip` int(120) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `cms_products`
--

CREATE TABLE IF NOT EXISTS `cms_products` (
  `id` int(120) NOT NULL AUTO_INCREMENT,
  `name` varchar(500) NOT NULL,
  `price` float(120,2) NOT NULL,
  `product_img` varchar(500) NOT NULL,
  `description` text NOT NULL,
  `publish` int(120) NOT NULL,
  `add_date` date NOT NULL,
  `viewcount` int(120) NOT NULL,
  `ip` varchar(500) NOT NULL,
  `type` int(120) NOT NULL,
  `order` int(120) NOT NULL,
  `parent` int(120) NOT NULL,
  `level` int(120) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

-- --------------------------------------------------------

--
-- Table structure for table `cms_subscribers`
--

CREATE TABLE IF NOT EXISTS `cms_subscribers` (
  `subscriber_id` int(120) NOT NULL AUTO_INCREMENT,
  `email` varchar(500) NOT NULL,
  `published` int(120) NOT NULL,
  `subscribe_ip` varchar(500) NOT NULL,
  `unsubscribe_ip` varchar(500) NOT NULL,
  PRIMARY KEY (`subscriber_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `cms_subscribers`
--

INSERT INTO `cms_subscribers` (`subscriber_id`, `email`, `published`, `subscribe_ip`, `unsubscribe_ip`) VALUES
(1, 'litto@axtecindia.com', 1, '192.168.1.23', ''),
(2, 'kirankrishnan@gmail.com', 1, '::1', ''),
(3, 'kiran@gmail.com', 1, '::1', ''),
(4, 'kull@gmail.com', 1, '::1', ''),
(5, 'masd@gmail.com', 1, '::1', ''),
(6, 'soosan@gmail.com', 1, '::1', '');

-- --------------------------------------------------------

--
-- Table structure for table `cms_tableindex`
--

CREATE TABLE IF NOT EXISTS `cms_tableindex` (
  `id` int(120) NOT NULL AUTO_INCREMENT,
  `linkname` varchar(500) NOT NULL,
  `linkurl` varchar(500) NOT NULL,
  `status` int(120) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `cms_tableindex`
--

INSERT INTO `cms_tableindex` (`id`, `linkname`, `linkurl`, `status`) VALUES
(1, 'News', 'news-listing.php', 1),
(2, 'Media', 'media-listing.php', 1),
(3, 'Album', 'albumlisting.php', 1),
(4, 'Testimonials', 'testimonials.php', 1),
(5, 'Video', 'videolisting.php', 1),
(6, 'Career', 'career.php', 1),
(7, 'Jobrequests', 'appliedcareer.php', 1),
(8, 'Themes', 'themes.php', 1),
(9, 'Banners', 'bannerlisting.php', 1),
(10, 'Newsletter', 'newsletterlist.php', 1);

-- --------------------------------------------------------

--
-- Table structure for table `cms_testimony`
--

CREATE TABLE IF NOT EXISTS `cms_testimony` (
  `testimony_id` int(120) NOT NULL AUTO_INCREMENT,
  `name` varchar(500) NOT NULL,
  `content` text NOT NULL,
  `image` varchar(500) NOT NULL,
  `date_added` date NOT NULL,
  `published` int(120) NOT NULL,
  PRIMARY KEY (`testimony_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `cms_testimony`
--

INSERT INTO `cms_testimony` (`testimony_id`, `name`, `content`, `image`, `date_added`, `published`) VALUES
(3, 'Mr.jacobz', '<p><span>Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book</span></p>', 'testimony-d1ff1ec813629848641093298.jpg', '2013-03-11', 1),
(4, 'Mr.bill gates', '<p><span>Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book</span></p>', 'testimony-cca289d2136298487510672868.jpg', '2013-03-11', 1);

-- --------------------------------------------------------

--
-- Table structure for table `cms_themes`
--

CREATE TABLE IF NOT EXISTS `cms_themes` (
  `theme_id` int(120) NOT NULL AUTO_INCREMENT,
  `title` varchar(400) NOT NULL,
  `folder_name` varchar(500) NOT NULL,
  `default` int(120) NOT NULL,
  `published` int(120) NOT NULL,
  `thumbimage` varchar(500) NOT NULL,
  PRIMARY KEY (`theme_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=94 ;

-- --------------------------------------------------------

--
-- Table structure for table `cms_trade`
--

CREATE TABLE IF NOT EXISTS `cms_trade` (
  `id` int(120) NOT NULL AUTO_INCREMENT,
  `name` varchar(500) NOT NULL,
  `content` text NOT NULL,
  `image` varchar(500) NOT NULL,
  `date_added` date NOT NULL,
  `published` int(120) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `cms_trade`
--

INSERT INTO `cms_trade` (`id`, `name`, `content`, `image`, `date_added`, `published`) VALUES
(1, 'NCVT ITI DGE & T', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.', 'testimony-6abba5d813629800501106533.jpg', '2013-03-11', 1),
(2, 'KBCEE COURSE', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.', 'testimony-3b2acfe2136298011110999095.jpg', '2013-03-11', 1),
(3, 'ITES Courses', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.', 'testimony-8b3bac12136298015010555941.jpg', '2013-03-11', 1),
(4, 'RGEF-JSS-MHRD Courses', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.', 'testimony-7aee5d5d136298019110062598.jpg', '2013-03-11', 1);

-- --------------------------------------------------------

--
-- Table structure for table `cms_vacancy`
--

CREATE TABLE IF NOT EXISTS `cms_vacancy` (
  `id` int(120) NOT NULL AUTO_INCREMENT,
  `name` varchar(500) NOT NULL,
  `job` varchar(500) NOT NULL,
  `mail` varchar(500) NOT NULL,
  `resume` varchar(700) NOT NULL,
  `date_applied` date NOT NULL,
  `published` int(120) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `cms_vacancy`
--

INSERT INTO `cms_vacancy` (`id`, `name`, `job`, `mail`, `resume`, `date_applied`, `published`) VALUES
(17, 'litto', '3', 'littochackomp@gmail.com', '', '2012-07-27', 0),
(18, 'lino', '4', 'lino@gmail.com', 'resume-e0f19f64134338449910937610.jpg', '2012-07-27', 0);

-- --------------------------------------------------------

--
-- Table structure for table `cms_video`
--

CREATE TABLE IF NOT EXISTS `cms_video` (
  `video_id` int(90) NOT NULL AUTO_INCREMENT,
  `video_title` varchar(120) NOT NULL,
  `code_path` varchar(800) NOT NULL,
  `thumb` varchar(120) NOT NULL,
  `type` int(90) NOT NULL,
  `status` int(90) NOT NULL DEFAULT '1',
  PRIMARY KEY (`video_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `cms_video`
--

INSERT INTO `cms_video` (`video_id`, `video_title`, `code_path`, `thumb`, `type`, `status`) VALUES
(16, 'My video', 'banner-f410588e134498336010397424.flv', 'banner-56352739134498336010364122.jpg', 1, 1),
(17, 'Admin video', 'banner-172fd0d6134519673810799521.flv', 'banner-1c824be213451967381102238.jpg', 1, 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
