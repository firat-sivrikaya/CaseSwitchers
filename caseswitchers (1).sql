-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Anamakine: localhost
-- Üretim Zamanı: 25 Ara 2017, 07:37:49
-- Sunucu sürümü: 10.1.28-MariaDB
-- PHP Sürümü: 7.1.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `caseswitchers`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `admin`
--

CREATE TABLE `admin` (
  `adminID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Tablo döküm verisi `admin`
--

INSERT INTO `admin` (`adminID`) VALUES
(6);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `bannedusers`
--

CREATE TABLE `bannedusers` (
  `banned_id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `category`
--

CREATE TABLE `category` (
  `ID` int(11) NOT NULL,
  `categoryname` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Tablo döküm verisi `category`
--

INSERT INTO `category` (`ID`, `categoryname`) VALUES
(3, 'cars'),
(4, 'cybersecurity'),
(5, 'Space');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `comment`
--

CREATE TABLE `comment` (
  `commentID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Tablo döküm verisi `comment`
--

INSERT INTO `comment` (`commentID`) VALUES
(85),
(86),
(87),
(88),
(89),
(90),
(91),
(92),
(93),
(94),
(97),
(98),
(99),
(100),
(101),
(102),
(103),
(104),
(105),
(106),
(109),
(111),
(112),
(113),
(116),
(117),
(118);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `entry`
--

CREATE TABLE `entry` (
  `entryID` int(11) NOT NULL,
  `creationdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `content` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Tablo döküm verisi `entry`
--

INSERT INTO `entry` (`entryID`, `creationdate`, `content`) VALUES
(23, '2017-12-20 18:39:55', 'this is the post'),
(81, '2017-12-21 00:48:31', 'the sub 2'),
(82, '2017-12-21 00:49:17', 'nana'),
(83, '2017-12-21 00:51:02', 'nana'),
(84, '2017-12-21 01:00:17', 'bok'),
(85, '2017-12-21 01:03:47', 'first comment'),
(86, '2017-12-21 01:04:01', 'first sub of firstcomment'),
(87, '2017-12-21 01:04:19', 'second sub of firstcomment'),
(88, '2017-12-21 01:04:37', 'lala'),
(89, '2017-12-21 01:04:49', 'hayda'),
(90, '2017-12-21 05:22:12', 'dene'),
(91, '2017-12-21 05:44:01', 'lutfen'),
(92, '2017-12-21 05:44:30', 'lutfen2'),
(93, '2017-12-21 08:13:31', 'huhu'),
(94, '2017-12-21 08:19:18', '??'),
(95, '2017-12-21 20:32:08', 'a post '),
(96, '2017-12-21 20:32:44', 'another post'),
(97, '2017-12-22 09:06:53', 'comment'),
(98, '2017-12-22 09:07:00', 'another one'),
(99, '2017-12-22 09:07:10', 'lalalal'),
(100, '2017-12-22 09:07:28', 'sa'),
(101, '2017-12-23 11:07:01', 'Test'),
(102, '2017-12-23 11:07:07', 'Test2'),
(103, '2017-12-23 11:11:57', 'test'),
(104, '2017-12-23 11:27:47', 'test'),
(105, '2017-12-23 11:27:51', 'test'),
(106, '2017-12-23 11:27:55', 'testttt'),
(108, '2017-12-23 12:30:28', 'Good news about tesla'),
(109, '2017-12-23 12:31:10', 'Really good!'),
(110, '2017-12-24 19:49:51', 'Amazing car'),
(111, '2017-12-24 19:50:05', 'Indeed it is'),
(112, '2017-12-24 22:20:03', 'nope'),
(113, '2017-12-25 05:35:52', 'Put your comment here'),
(114, '2017-12-25 05:49:48', 'ereeeen'),
(115, '2017-12-25 06:25:57', 'Heeeey'),
(116, '2017-12-25 06:26:06', 'It\'s happening!!!!'),
(117, '2017-12-25 06:26:16', 'It\'s not visible from my place.'),
(118, '2017-12-25 06:26:26', 'Oh I\'m sorry for you :/');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `favorites`
--

CREATE TABLE `favorites` (
  `e_id` int(11) NOT NULL,
  `u_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Tablo döküm verisi `favorites`
--

INSERT INTO `favorites` (`e_id`, `u_id`) VALUES
(96, 6),
(108, 7),
(109, 7),
(110, 6),
(112, 6),
(113, 6),
(115, 6),
(117, 6);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `messages`
--

CREATE TABLE `messages` (
  `sender_id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `content` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Tablo döküm verisi `messages`
--

INSERT INTO `messages` (`sender_id`, `receiver_id`, `timestamp`, `content`) VALUES
(6, 7, '2017-12-19 19:36:45', 'naber canim'),
(6, 7, '2017-12-19 19:50:35', 'bok'),
(6, 7, '2017-12-19 19:50:48', 'canÄ±m ordamÄ±sÄ±n'),
(6, 7, '2017-12-20 08:01:02', 'asdsa'),
(6, 12, '2017-12-19 22:49:24', 'HEYYO'),
(7, 6, '2017-12-19 14:43:08', 'long live donald trump!'),
(7, 6, '2017-12-19 18:14:01', 'yet another message'),
(7, 6, '2017-12-20 08:13:15', 'hleoeleloe'),
(7, 6, '2017-12-20 08:14:59', 'hleoeleloe'),
(7, 12, '2017-12-20 04:37:43', 'just an ordinary message'),
(12, 6, '2017-12-19 14:56:07', 'Hey eren how are you bro I have an interesting offer for you hell yeah ');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `owns`
--

CREATE TABLE `owns` (
  `e_id` int(11) NOT NULL,
  `u_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Tablo döküm verisi `owns`
--

INSERT INTO `owns` (`e_id`, `u_id`) VALUES
(23, 7),
(85, 12),
(86, 12),
(87, 12),
(88, 12),
(89, 12),
(90, 12),
(91, 12),
(92, 12),
(93, 6),
(94, 6),
(95, 6),
(96, 6),
(97, 6),
(98, 6),
(99, 6),
(100, 6),
(101, 6),
(102, 6),
(103, 7),
(104, 7),
(105, 7),
(106, 7),
(108, 7),
(109, 7),
(110, 6),
(111, 6),
(112, 7),
(113, 6),
(114, 6),
(115, 6),
(116, 6),
(117, 6),
(118, 6);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `post`
--

CREATE TABLE `post` (
  `postID` int(11) NOT NULL,
  `topicname` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Tablo döküm verisi `post`
--

INSERT INTO `post` (`postID`, `topicname`) VALUES
(23, 'hey post '),
(95, 'lalala'),
(96, 'another one'),
(108, 'Good news about tesla'),
(110, 'Audi A8 2018'),
(114, 'eren'),
(115, 'Meteor rain');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `postcategory`
--

CREATE TABLE `postcategory` (
  `p_id` int(11) NOT NULL,
  `c_id` int(11) NOT NULL,
  `s_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Tablo döküm verisi `postcategory`
--

INSERT INTO `postcategory` (`p_id`, `c_id`, `s_id`) VALUES
(23, 3, 3),
(95, 3, 4),
(96, 4, 4),
(108, 3, 3),
(110, 3, 5),
(114, 3, 3),
(115, 5, 6);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `postcomments`
--

CREATE TABLE `postcomments` (
  `p_id` int(11) NOT NULL,
  `c_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Tablo döküm verisi `postcomments`
--

INSERT INTO `postcomments` (`p_id`, `c_id`) VALUES
(23, 85),
(23, 88),
(23, 89),
(23, 90),
(95, 101),
(96, 97),
(108, 109),
(110, 111),
(115, 116),
(115, 118);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `rates`
--

CREATE TABLE `rates` (
  `e_id` int(11) NOT NULL,
  `u_id` int(11) NOT NULL,
  `rating` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Tablo döküm verisi `rates`
--

INSERT INTO `rates` (`e_id`, `u_id`, `rating`) VALUES
(23, 6, 1),
(23, 7, 1),
(85, 6, 1),
(85, 7, 1),
(86, 6, 1),
(87, 6, 1),
(89, 6, 1),
(90, 6, 1),
(91, 6, 1),
(91, 7, 1),
(91, 12, 1),
(92, 6, 1),
(92, 7, 1),
(93, 6, 1),
(95, 6, 1),
(96, 6, -1),
(96, 7, 1),
(97, 6, 1),
(97, 7, 1),
(98, 6, 1),
(98, 7, 1),
(99, 6, 1),
(100, 6, 1),
(101, 6, -1),
(102, 6, -1),
(104, 7, 1),
(105, 6, -1),
(106, 7, -1),
(108, 7, 1),
(109, 7, -1),
(110, 6, 1),
(111, 6, 1),
(111, 7, 1),
(112, 7, 1),
(115, 6, 1),
(116, 6, 1),
(118, 6, -1);

--
-- Tetikleyiciler `rates`
--
DELIMITER $$
CREATE TRIGGER `user_level_update` AFTER INSERT ON `rates` FOR EACH ROW UPDATE User u INNER JOIN (SELECT o.u_id, SUM(entryrating) as userrating
       FROM Owns o, (SELECT e_id, SUM(rating) as entryrating
                                FROM Rates GROUP BY e_id) t WHERE o.e_id = t.e_id GROUP BY o.u_id
  ORDER BY userrating DESC) t2 ON u.userID = t2.u_id
    SET userlevel = CASE
            WHEN userrating <=10 THEN 'Freshman'
            WHEN userrating > 10 AND userrating <=100 THEN 'Sophomore'
            WHEN userrating > 100 AND userrating <=500 THEN 'Junior'
            WHEN userrating > 500 AND userrating <=1000 THEN 'Senior'
            WHEN userrating > 1000 AND userrating <=200 THEN 'Post-Senior'
            WHEN userrating > 2000 AND userrating <=3000 THEN 'Code Enthusiast'
            WHEN userrating > 3000 AND userrating <=5000 THEN 'Code Expert'
            WHEN userrating > 5000 AND userrating <=10000 THEN 'Code Meister'
            WHEN userrating > 10000 AND userrating <=50000 THEN 'The Don of Codes'
            WHEN userrating > 50000 THEN 'Code God'
            END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `subcategory`
--

CREATE TABLE `subcategory` (
  `sub_id` int(11) NOT NULL,
  `c_id` int(11) NOT NULL,
  `subcategoryname` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Tablo döküm verisi `subcategory`
--

INSERT INTO `subcategory` (`sub_id`, `c_id`, `subcategoryname`) VALUES
(5, 3, 'Audi'),
(6, 5, 'Milkyway'),
(7, 4, 'Network penetration'),
(4, 4, 'pentest'),
(3, 3, 'tesla');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `subcomments`
--

CREATE TABLE `subcomments` (
  `comment_id` int(11) NOT NULL,
  `subcomment_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Tablo döküm verisi `subcomments`
--

INSERT INTO `subcomments` (`comment_id`, `subcomment_id`) VALUES
(85, 86),
(85, 87),
(86, 91),
(91, 92),
(92, 93),
(93, 94),
(97, 98),
(97, 100),
(98, 99),
(99, 105),
(99, 106),
(100, 104),
(101, 102),
(102, 103),
(111, 112),
(112, 113),
(116, 117);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `user`
--

CREATE TABLE `user` (
  `userID` int(11) NOT NULL,
  `username` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `surname` varchar(45) DEFAULT NULL,
  `email` varchar(45) NOT NULL,
  `userlevel` varchar(45) NOT NULL,
  `date_of_registration` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `avatarloc` varchar(45) DEFAULT NULL,
  `profile_info` tinytext
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Tablo döküm verisi `user`
--

INSERT INTO `user` (`userID`, `username`, `password`, `name`, `surname`, `email`, `userlevel`, `date_of_registration`, `avatarloc`, `profile_info`) VALUES
(6, 'eren', '123', 'Eren', 'Bilaloglu', 'eren96@gmail.com', 'Freshman', '2017-12-25 06:26:28', NULL, 'Eren'),
(7, 'firat', '123', 'Firat', 'Sivrikaya', 'firat@gmail.com', 'Freshman', '2017-12-24 21:31:27', '7.png', 'Heyyyy'),
(12, 'gulce', '123', 'gulce', 'karacal', 'gulce@bilkent.com', 'Sophomore', '2017-12-21 20:08:33', NULL, NULL);

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`adminID`),
  ADD UNIQUE KEY `ID_UNIQUE` (`adminID`);

--
-- Tablo için indeksler `bannedusers`
--
ALTER TABLE `bannedusers`
  ADD PRIMARY KEY (`banned_id`),
  ADD UNIQUE KEY `admin_id_UNIQUE` (`admin_id`),
  ADD KEY `admin_id_idx` (`admin_id`);

--
-- Tablo için indeksler `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `ID_UNIQUE` (`ID`),
  ADD UNIQUE KEY `categoryname_UNIQUE` (`categoryname`);

--
-- Tablo için indeksler `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`commentID`),
  ADD UNIQUE KEY `ID_UNIQUE` (`commentID`);

--
-- Tablo için indeksler `entry`
--
ALTER TABLE `entry`
  ADD PRIMARY KEY (`entryID`),
  ADD UNIQUE KEY `ID_UNIQUE` (`entryID`);

--
-- Tablo için indeksler `favorites`
--
ALTER TABLE `favorites`
  ADD PRIMARY KEY (`e_id`,`u_id`),
  ADD KEY `u_id_idx` (`u_id`);

--
-- Tablo için indeksler `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`sender_id`,`receiver_id`,`timestamp`),
  ADD KEY `receiver_id_idx` (`receiver_id`);

--
-- Tablo için indeksler `owns`
--
ALTER TABLE `owns`
  ADD PRIMARY KEY (`e_id`,`u_id`),
  ADD KEY `owns_u_id` (`u_id`);

--
-- Tablo için indeksler `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`postID`),
  ADD UNIQUE KEY `ID_UNIQUE` (`postID`);

--
-- Tablo için indeksler `postcategory`
--
ALTER TABLE `postcategory`
  ADD PRIMARY KEY (`p_id`,`c_id`,`s_id`),
  ADD KEY `pc_c_id` (`c_id`),
  ADD KEY `pc_s_id` (`s_id`);

--
-- Tablo için indeksler `postcomments`
--
ALTER TABLE `postcomments`
  ADD PRIMARY KEY (`p_id`,`c_id`),
  ADD UNIQUE KEY `c_id_UNIQUE` (`c_id`);

--
-- Tablo için indeksler `rates`
--
ALTER TABLE `rates`
  ADD PRIMARY KEY (`e_id`,`u_id`),
  ADD KEY `userID_idx` (`u_id`);

--
-- Tablo için indeksler `subcategory`
--
ALTER TABLE `subcategory`
  ADD PRIMARY KEY (`sub_id`,`c_id`),
  ADD UNIQUE KEY `sub_id_UNIQUE` (`sub_id`),
  ADD UNIQUE KEY `subcategoryname_UNIQUE` (`subcategoryname`),
  ADD KEY `c_id_idx` (`c_id`);

--
-- Tablo için indeksler `subcomments`
--
ALTER TABLE `subcomments`
  ADD PRIMARY KEY (`comment_id`,`subcomment_id`),
  ADD KEY `subcomment_id_idx` (`subcomment_id`);

--
-- Tablo için indeksler `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userID`),
  ADD UNIQUE KEY `username_UNIQUE` (`username`),
  ADD UNIQUE KEY `email_UNIQUE` (`email`),
  ADD UNIQUE KEY `ID_UNIQUE` (`userID`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `category`
--
ALTER TABLE `category`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Tablo için AUTO_INCREMENT değeri `entry`
--
ALTER TABLE `entry`
  MODIFY `entryID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=119;

--
-- Tablo için AUTO_INCREMENT değeri `subcategory`
--
ALTER TABLE `subcategory`
  MODIFY `sub_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Tablo için AUTO_INCREMENT değeri `user`
--
ALTER TABLE `user`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Dökümü yapılmış tablolar için kısıtlamalar
--

--
-- Tablo kısıtlamaları `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `adminID` FOREIGN KEY (`adminID`) REFERENCES `user` (`userID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Tablo kısıtlamaları `bannedusers`
--
ALTER TABLE `bannedusers`
  ADD CONSTRAINT `admin_id` FOREIGN KEY (`admin_id`) REFERENCES `user` (`userID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `banned_id` FOREIGN KEY (`banned_id`) REFERENCES `user` (`userID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Tablo kısıtlamaları `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `commentID` FOREIGN KEY (`commentID`) REFERENCES `entry` (`entryID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Tablo kısıtlamaları `favorites`
--
ALTER TABLE `favorites`
  ADD CONSTRAINT `e_id_fav` FOREIGN KEY (`e_id`) REFERENCES `entry` (`entryID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `user_id_fav` FOREIGN KEY (`u_id`) REFERENCES `user` (`userID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Tablo kısıtlamaları `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `receiver_id` FOREIGN KEY (`receiver_id`) REFERENCES `user` (`userID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `sender_id` FOREIGN KEY (`sender_id`) REFERENCES `user` (`userID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Tablo kısıtlamaları `owns`
--
ALTER TABLE `owns`
  ADD CONSTRAINT `owns_e_id` FOREIGN KEY (`e_id`) REFERENCES `entry` (`entryID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `owns_u_id` FOREIGN KEY (`u_id`) REFERENCES `user` (`userID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Tablo kısıtlamaları `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `ID` FOREIGN KEY (`postID`) REFERENCES `entry` (`entryID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Tablo kısıtlamaları `postcategory`
--
ALTER TABLE `postcategory`
  ADD CONSTRAINT `pc_c_id` FOREIGN KEY (`c_id`) REFERENCES `category` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `pc_p_id` FOREIGN KEY (`p_id`) REFERENCES `post` (`postID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `pc_s_id` FOREIGN KEY (`s_id`) REFERENCES `subcategory` (`sub_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Tablo kısıtlamaları `postcomments`
--
ALTER TABLE `postcomments`
  ADD CONSTRAINT `comment_post` FOREIGN KEY (`c_id`) REFERENCES `comment` (`commentID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `post_comment` FOREIGN KEY (`p_id`) REFERENCES `post` (`postID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Tablo kısıtlamaları `rates`
--
ALTER TABLE `rates`
  ADD CONSTRAINT `entryID` FOREIGN KEY (`e_id`) REFERENCES `entry` (`entryID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `userID` FOREIGN KEY (`u_id`) REFERENCES `user` (`userID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Tablo kısıtlamaları `subcategory`
--
ALTER TABLE `subcategory`
  ADD CONSTRAINT `c_id` FOREIGN KEY (`c_id`) REFERENCES `category` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Tablo kısıtlamaları `subcomments`
--
ALTER TABLE `subcomments`
  ADD CONSTRAINT `comment_id` FOREIGN KEY (`comment_id`) REFERENCES `comment` (`commentID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `subcomment_id` FOREIGN KEY (`subcomment_id`) REFERENCES `comment` (`commentID`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
