-- phpMyAdmin SQL Dump
-- version 4.5.5.1
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Jeu 25 Mai 2017 à 18:15
-- Version du serveur :  5.7.11
-- Version de PHP :  7.0.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `travelmate`
--

-- --------------------------------------------------------

--
-- Structure de la table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `category`
--

INSERT INTO `category` (`id`, `name`) VALUES
(1, 'Roadtrip'),
(2, 'Pélerinage'),
(3, 'Tourisme'),
(4, 'Humanitaire'),
(5, 'Trek');

-- --------------------------------------------------------

--
-- Structure de la table `comment`
--

CREATE TABLE `comment` (
  `id` int(11) NOT NULL,
  `travel_id` int(11) NOT NULL,
  `content` longtext COLLATE utf8_unicode_ci NOT NULL,
  `creationDate` datetime NOT NULL,
  `updateDate` datetime DEFAULT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `comment`
--

INSERT INTO `comment` (`id`, `travel_id`, `content`, `creationDate`, `updateDate`, `user_id`) VALUES
(1, 3, 'Bien le bonjour Ellen !\r\nJe peux te tutoyer ? En tant que fan de la première heure (j\'ai adoré tes rôles dans Juno et Hard Candy), j\'aimerai bien t\'accompagner de part le monde !', '2017-05-25 17:46:40', NULL, 16),
(2, 4, 'Salut Manon !\r\nJ\'ai toujours rêvé de visiter l\'Extrême-Orient ? Je peux venir avec toi ? Dis oui, dis oui !', '2017-05-25 17:48:20', NULL, 16),
(3, 4, 'Mais bien sûr que tu peux :D ! Plus que 2 places !', '2017-05-25 17:49:04', NULL, 30),
(4, 2, 'Kurt ! Mon idole ! Emmène-moi au sommet à tes côtés !', '2017-05-25 17:50:53', NULL, 32),
(5, 5, 'Oh, de la bière et un vieux pote, nul doute possible je suis de la partie !', '2017-05-25 17:51:51', NULL, 30),
(6, 1, 'Nickel, un voyage en stop ! Viens avec moi je vais t\'apprendre les rouages de cette technique ;D !', '2017-05-25 17:53:23', NULL, 30),
(7, 3, 'J\'ai comme l\'impression que l\'on grille des étapes ?', '2017-05-25 17:54:21', NULL, 32),
(8, 1, 'Chouette ! Tu m\'enlèves une belle épine du pied :).', '2017-05-25 17:55:37', NULL, 16),
(9, 2, 'Je passe te chercher au Canada ? Tu vis bien là-bas non ?', '2017-05-25 17:56:58', NULL, 31);

-- --------------------------------------------------------

--
-- Structure de la table `country`
--

CREATE TABLE `country` (
  `id` int(11) NOT NULL,
  `code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `latitude` double NOT NULL,
  `longitude` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `country`
--

INSERT INTO `country` (`id`, `code`, `latitude`, `longitude`) VALUES
(1, 'AC', -7.938678, -14.354606),
(2, 'AD', 42.546245, 1.601554),
(3, 'AE', 23.424076, 53.847818),
(4, 'AF', 33.93911, 67.709953),
(5, 'AG', 17.060816, -61.796428),
(6, 'AI', 18.220554, -63.068615),
(7, 'AL', 41.153332, 20.168331),
(8, 'AM', 40.069099, 45.038189),
(9, 'AO', -11.202692, 17.873887),
(10, 'AQ', -75.250973, -0.071389),
(11, 'AR', -38.416097, -63.616672),
(12, 'AS', -14.270972, -170.132217),
(13, 'AT', 47.516231, 14.550072),
(14, 'AU', -25.274398, 133.775136),
(15, 'AW', 12.52111, -69.968338),
(16, 'AX', 60.355137, 19.90085),
(17, 'AZ', 40.143105, 47.576927),
(18, 'BA', 43.915886, 17.679076),
(19, 'BB', 13.193887, -59.543198),
(20, 'BD', 23.684994, 90.356331),
(21, 'BE', 50.503887, 4.469936),
(22, 'BF', 12.238333, -1.561593),
(23, 'BG', 42.733883, 25.48583),
(24, 'BH', 25.930414, 50.637772),
(25, 'BI', -3.373056, 29.918886),
(26, 'BJ', 9.30769, 2.315834),
(27, 'BL', 17.905249, -62.832995),
(28, 'BM', 32.321384, -64.75737),
(29, 'BN', 4.535277, 114.727669),
(30, 'BO', -16.290154, -63.588653),
(31, 'BQ', 12.198355, -68.239412),
(32, 'BR', -14.235004, -51.92528),
(33, 'BS', 25.03428, -77.39628),
(34, 'BT', 27.514162, 90.433601),
(35, 'BW', -22.328474, 24.684866),
(36, 'BY', 53.709807, 27.953389),
(37, 'BZ', 17.189877, -88.49765),
(38, 'CA', 56.130366, -106.346771),
(39, 'CC', -12.164165, 96.870956),
(40, 'CD', -4.038333, 21.758664),
(41, 'CF', 6.611111, 20.939444),
(42, 'CG', -0.228021, 15.827659),
(43, 'CH', 46.818188, 8.227512),
(44, 'CI', 7.539989, -5.54708),
(45, 'CK', -21.236736, -159.777671),
(46, 'CL', -35.675147, -71.542969),
(47, 'CM', 7.369722, 12.354722),
(48, 'CN', 35.86166, 104.195397),
(49, 'CO', 4.570868, -74.297333),
(50, 'CR', 9.748917, -83.753428),
(51, 'CU', 21.521757, -77.781167),
(52, 'CV', 16.002082, -24.013197),
(53, 'CW', 12.189345, -68.988831),
(54, 'CX', -10.447525, 105.690449),
(55, 'CY', 35.126413, 33.429859),
(56, 'CZ', 49.817492, 15.472962),
(57, 'DE', 51.165691, 10.451526),
(58, 'DG', 12.189345, -68.988831),
(59, 'DJ', 11.825138, 42.590275),
(60, 'DK', 56.26392, 9.501785),
(61, 'DM', 15.414999, -61.370976),
(62, 'DO', 18.735693, -70.162651),
(63, 'DZ', 28.033886, 1.659626),
(64, 'EA', 35.892845, -5.321283),
(65, 'EC', -1.831239, -78.183406),
(66, 'EE', 58.595272, 25.013607),
(67, 'EG', 26.820553, 30.802498),
(68, 'EH', 24.215527, -12.885834),
(69, 'ER', 15.179384, 39.782334),
(70, 'ES', 40.463667, -3.74922),
(71, 'ET', 9.145, 40.489673),
(72, 'FI', 61.92411, 25.748151),
(73, 'FJ', -16.578193, 179.414413),
(74, 'FK', -51.796253, -59.523613),
(75, 'FM', 7.425554, 150.550812),
(76, 'FO', 61.892635, -6.911806),
(77, 'FR', 46.227638, 2.213749),
(78, 'GA', -0.803689, 11.609444),
(79, 'GB', 55.378051, -3.435973),
(80, 'GD', 12.262776, -61.604171),
(81, 'GE', 42.315407, 43.356892),
(82, 'GF', 3.933889, -53.125782),
(83, 'GG', 49.465691, -2.585278),
(84, 'GH', 7.946527, -1.023194),
(85, 'GI', 36.137741, -5.345374),
(86, 'GL', 71.706936, -42.604303),
(87, 'GM', 13.443182, -15.310139),
(88, 'GN', 9.945587, -9.696645),
(89, 'GP', 16.995971, -62.067641),
(90, 'GQ', 1.650801, 10.267895),
(91, 'GR', 39.074208, 21.824312),
(92, 'GS', -54.429579, -36.587909),
(93, 'GT', 15.783471, -90.230759),
(94, 'GU', 13.444304, 144.793731),
(95, 'GW', 11.803749, -15.180413),
(96, 'GY', 4.860416, -58.93018),
(97, 'HK', 22.396428, 114.109497),
(98, 'HN', 15.199999, -86.241905),
(99, 'HR', 45.1, 15.2),
(100, 'HT', 18.971187, -72.285215),
(101, 'HU', 47.162494, 19.503304),
(102, 'IC', 29.284116, -16.617627),
(103, 'ID', -0.789275, 113.921327),
(104, 'IE', 53.41291, -8.24389),
(105, 'IL', 31.046051, 34.851612),
(106, 'IM', 54.236107, -4.548056),
(107, 'IN', 20.593684, 78.96288),
(108, 'IO', -6.343194, 71.876519),
(109, 'IQ', 33.223191, 43.679291),
(110, 'IR', 32.427908, 53.688046),
(111, 'IS', 64.963051, -19.020835),
(112, 'IT', 41.87194, 12.56738),
(113, 'JE', 49.214439, -2.13125),
(114, 'JM', 18.109581, -77.297508),
(115, 'JO', 30.585164, 36.238414),
(116, 'JP', 36.204824, 138.252924),
(117, 'KE', -0.023559, 37.906193),
(118, 'KG', 41.20438, 74.766098),
(119, 'KH', 12.565679, 104.990963),
(120, 'KI', -3.370417, -168.734039),
(121, 'KM', -11.875001, 43.872219),
(122, 'KN', 17.357822, -62.782998),
(123, 'KP', 40.339852, 127.510093),
(124, 'KR', 35.907757, 127.766922),
(125, 'KW', 29.31166, 47.481766),
(126, 'KY', 19.513469, -80.566956),
(127, 'KZ', 48.019573, 66.923684),
(128, 'LA', 19.85627, 102.495496),
(129, 'LB', 33.854721, 35.862285),
(130, 'LC', 13.909444, -60.978893),
(131, 'LI', 47.166, 9.555373),
(132, 'LK', 7.873054, 80.771797),
(133, 'LR', 6.428055, -9.429499),
(134, 'LS', -29.609988, 28.233608),
(135, 'LT', 55.169438, 23.881275),
(136, 'LU', 49.815273, 6.129583),
(137, 'LV', 56.879635, 24.603189),
(138, 'LY', 26.3351, 17.228331),
(139, 'MA', 31.791702, -7.09262),
(140, 'MC', 43.750298, 7.412841),
(141, 'MD', 47.411631, 28.369885),
(142, 'ME', 42.708678, 19.37439),
(143, 'MF', 18.098946, -63.054279),
(144, 'MG', -18.766947, 46.869107),
(145, 'MH', 7.131474, 171.184478),
(146, 'MK', 41.608635, 21.745275),
(147, 'ML', 17.570692, -3.996166),
(148, 'MM', 21.913965, 95.956223),
(149, 'MN', 46.862496, 103.846656),
(150, 'MO', 22.198745, 113.543873),
(151, 'MP', 17.33083, 145.38469),
(152, 'MQ', 14.641528, -61.024174),
(153, 'MR', 21.00789, -10.940835),
(154, 'MS', 16.742498, -62.187366),
(155, 'MT', 35.937496, 14.375416),
(156, 'MU', -20.348404, 57.552152),
(157, 'MV', 3.202778, 73.22068),
(158, 'MW', -13.254308, 34.301525),
(159, 'MX', 23.634501, -102.552784),
(160, 'MY', 4.210484, 101.975766),
(161, 'MZ', -18.665695, 35.529562),
(162, 'NA', -22.95764, 18.49041),
(163, 'NC', -20.904305, 165.618042),
(164, 'NE', 17.607789, 8.081666),
(165, 'NF', -29.040835, 167.954712),
(166, 'NG', 9.081999, 8.675277),
(167, 'NI', 12.865416, -85.207229),
(168, 'NL', 52.132633, 5.291266),
(169, 'NO', 60.472024, 8.468946),
(170, 'NP', 28.394857, 84.124008),
(171, 'NR', -0.522778, 166.931503),
(172, 'NU', -19.054445, -169.867233),
(173, 'NZ', -40.900557, 174.885971),
(174, 'OM', 21.512583, 55.923255),
(175, 'PA', 8.537981, -80.782127),
(176, 'PE', -9.189967, -75.015152),
(177, 'PF', -17.679742, -149.406843),
(178, 'PG', -6.314993, 143.95555),
(179, 'PH', 12.879721, 121.774017),
(180, 'PK', 30.375321, 69.345116),
(181, 'PL', 51.919438, 19.145136),
(182, 'PM', 46.941936, -56.27111),
(183, 'PN', -24.703615, -127.439308),
(184, 'PR', 18.220833, -66.590149),
(185, 'PS', 31.952162, 35.233154),
(186, 'PT', 39.399872, -8.224454),
(187, 'PW', 7.51498, 134.58252),
(188, 'PY', -23.442503, -58.443832),
(189, 'QA', 25.354826, 51.183884),
(190, 'RE', -21.115141, 55.536384),
(191, 'RO', 45.943161, 24.96676),
(192, 'RS', 44.016521, 21.005859),
(193, 'RU', 61.52401, 105.318756),
(194, 'RW', -1.940278, 29.873888),
(195, 'SA', 23.885942, 45.079162),
(196, 'SB', -9.64571, 160.156194),
(197, 'SC', -4.679574, 55.491977),
(198, 'SD', 12.862807, 30.217636),
(199, 'SE', 60.128161, 18.643501),
(200, 'SG', 1.352083, 103.819836),
(201, 'SH', -24.143474, -10.030696),
(202, 'SI', 46.151241, 14.995463),
(203, 'SJ', 77.553604, 23.670272),
(204, 'SK', 48.669026, 19.699024),
(205, 'SL', 8.460555, -11.779889),
(206, 'SM', 43.94236, 12.457777),
(207, 'SN', 14.497401, -14.452362),
(208, 'SO', 5.152149, 46.199616),
(209, 'SR', 3.919305, -56.027783),
(210, 'SS', 8.369284, 31.363194),
(211, 'ST', 0.18636, 6.613081),
(212, 'SV', 13.794185, -88.89653),
(213, 'SX', 18.050944, -63.054715),
(214, 'SY', 34.802075, 38.996815),
(215, 'SZ', -26.522503, 31.465866),
(216, 'TA', -37.097429, -12.278829),
(217, 'TC', 21.694025, -71.797928),
(218, 'TD', 15.454166, 18.732207),
(219, 'TF', -49.280366, 69.348557),
(220, 'TG', 8.619543, 0.824782),
(221, 'TH', 15.870032, 100.992541),
(222, 'TJ', 38.861034, 71.276093),
(223, 'TK', -8.967363, -171.855881),
(224, 'TL', -8.874217, 125.727539),
(225, 'TM', 38.969719, 59.556278),
(226, 'TN', 33.886917, 9.537499),
(227, 'TO', -21.178986, -175.198242),
(228, 'TR', 38.963745, 35.243322),
(229, 'TT', 10.691803, -61.222503),
(230, 'TV', -7.109535, 177.64933),
(231, 'TW', 23.69781, 120.960515),
(232, 'TZ', -6.369028, 34.888822),
(233, 'UA', 48.379433, 31.16558),
(234, 'UG', 1.373333, 32.290275),
(235, 'UM', -0.37435, -159.996719),
(236, 'US', 37.09024, -95.712891),
(237, 'UY', -32.522779, -55.765835),
(238, 'UZ', 41.377491, 64.585262),
(239, 'VA', 41.902916, 12.453389),
(240, 'VC', 12.984305, -61.287228),
(241, 'VE', 6.42375, -66.58973),
(242, 'VG', 18.420695, -64.639968),
(243, 'VI', 18.335765, -64.896335),
(244, 'VN', 14.058324, 108.277199),
(245, 'VU', -15.376706, 166.959158),
(246, 'WF', -13.768752, -177.156097),
(247, 'WS', -13.759029, -172.104629),
(248, 'XK', 42.602636, 20.902977),
(249, 'YE', 15.552727, 48.516388),
(250, 'YT', -12.8275, 45.166244),
(251, 'ZA', -30.559482, 22.937506),
(252, 'ZM', -13.133897, 27.849332),
(253, 'ZW', -19.015438, 29.154857);

-- --------------------------------------------------------

--
-- Structure de la table `message`
--

CREATE TABLE `message` (
  `id` int(11) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `content` longtext COLLATE utf8_unicode_ci NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `message`
--

INSERT INTO `message` (`id`, `sender_id`, `receiver_id`, `content`, `date`) VALUES
(1, 32, 31, 'Salut Kurt !', '2017-05-25 17:57:45'),
(2, 32, 31, 'Je viens de voir ton commentaire, oui j\'habite bien au Canada.', '2017-05-25 17:58:09'),
(3, 31, 32, 'Nickel, où ça exactement ?', '2017-05-25 18:08:58'),
(4, 32, 31, 'À Toronto ;)', '2017-05-25 18:10:22'),
(5, 31, 32, 'D\'accord, j\'arrive de suite !', '2017-05-25 18:10:40'),
(6, 32, 31, 'Merci bien Kurt !', '2017-05-25 18:10:50'),
(7, 30, 16, 'Salut Pierre !', '2017-05-25 18:11:50'),
(8, 16, 30, 'Coucou Manon :D', '2017-05-25 18:12:01'),
(9, 30, 16, 'Toujours partant pour la route de la bière ?', '2017-05-25 18:12:20'),
(10, 16, 30, 'Plus que jamais !', '2017-05-25 18:12:30'),
(11, 16, 30, 'Et toi toujours partante pour le tour de France en auto-stop ?', '2017-05-25 18:12:55'),
(12, 30, 16, 'Si tu savais !', '2017-05-25 18:13:05');

-- --------------------------------------------------------

--
-- Structure de la table `travel`
--

CREATE TABLE `travel` (
  `id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8_unicode_ci NOT NULL,
  `nb_mate` int(11) NOT NULL,
  `cost` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `type_duration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `creation_date` datetime NOT NULL,
  `update_date` datetime DEFAULT NULL,
  `countries` tinytext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:simple_array)',
  `nb_duration` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `travel`
--

INSERT INTO `travel` (`id`, `title`, `content`, `nb_mate`, `cost`, `start_date`, `type_duration`, `creation_date`, `update_date`, `countries`, `nb_duration`, `user_id`) VALUES
(1, 'Tour de France en auto-stop !', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce dapibus purus id fermentum venenatis. Integer nulla neque, mollis a iaculis quis, placerat ut turpis. Phasellus vitae cursus leo, vel volutpat leo. Mauris aliquam at ipsum ac tempor. Aenean velit lacus, pellentesque et odio et, aliquet tempus justo. Duis ac risus suscipit, gravida arcu quis, tempus ante. Nullam quis tempor sapien, sed vehicula diam. Aliquam suscipit condimentum mollis. Sed quis justo condimentum, scelerisque metus sit amet, ultrices est. Donec consectetur nisl id augue vulputate consectetur ac sed lacus. Vivamus et enim id sapien bibendum placerat. Phasellus ante magna, lacinia ac facilisis et, faucibus in nulla. Sed ornare ornare ligula in aliquam.\r\n\r\nMauris tempor turpis metus, id cursus orci sagittis in. Suspendisse consectetur dignissim erat sed placerat. Curabitur lacinia ultrices magna, eget semper augue. Nunc ex nulla, scelerisque at commodo sit amet, rhoncus vel est. Praesent hendrerit, orci quis molestie iaculis, diam orci iaculis justo, non posuere eros nulla in turpis. In mattis ligula commodo, ultricies ipsum nec, posuere felis. Suspendisse ultrices ornare metus, vel suscipit enim tincidunt in. Curabitur et massa ligula. Integer scelerisque varius nunc quis aliquet. Pellentesque sit amet neque rutrum, semper nunc in, aliquam massa. Nullam ullamcorper feugiat nisi quis egestas. Morbi finibus elementum lacus vitae rhoncus.\r\n\r\nNulla accumsan odio non velit finibus, vitae rutrum ante sollicitudin. Morbi pellentesque, velit et blandit tristique, lacus augue pretium metus, non sagittis purus purus vitae ex. Nullam euismod sollicitudin velit eu faucibus. Ut pellentesque aliquam commodo. Etiam a ante sit amet libero dictum ullamcorper vitae vitae risus. Sed consectetur nibh a lacus condimentum, ac condimentum dui elementum. Mauris in odio porttitor, posuere nulla at, euismod dolor. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Fusce mattis augue vel nibh sodales, non vulputate enim luctus. Aliquam volutpat lacus eu ligula porttitor facilisis. Aliquam sit amet ultricies tortor, quis lobortis risus. Donec tristique ullamcorper tortor, ut blandit justo. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Nam auctor nisi eu congue faucibus.\r\n\r\nProin rutrum neque id elementum egestas. Fusce ornare scelerisque feugiat. Suspendisse eget dui vitae est aliquet posuere id nec elit. Aenean vitae finibus mauris, vel tempor velit. Sed condimentum eu velit ultricies lobortis. Nam sit amet pellentesque mi. Morbi arcu est, volutpat in nibh non, blandit gravida erat. Nam tincidunt accumsan mattis. Nulla rutrum dapibus ex, id tempor odio ornare quis.\r\n\r\nNulla facilisi. Pellentesque et eleifend magna, at efficitur dolor. Phasellus non odio sed dolor consectetur facilisis. Sed est est, congue semper sem non, fringilla blandit nulla. Phasellus et orci vulputate sem dictum gravida eget id eros. Morbi sed maximus orci. Suspendisse molestie ligula sed odio consectetur varius in id massa. Mauris scelerisque gravida ultrices. Suspendisse egestas nisl fringilla nunc mollis, vitae blandit nunc convallis. Ut vel turpis scelerisque, finibus mi id, vestibulum elit. In hac habitasse platea dictumst. Nam non mattis metus. Vivamus quis volutpat magna. Aliquam tincidunt leo a urna tincidunt, consectetur placerat lacus pellentesque.', 1, 2, '2017-06-01', 'month', '2017-05-25 17:32:22', NULL, 'FR', 1, 16),
(2, 'En route vers la gloire !', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce dapibus purus id fermentum venenatis. Integer nulla neque, mollis a iaculis quis, placerat ut turpis. Phasellus vitae cursus leo, vel volutpat leo. Mauris aliquam at ipsum ac tempor. Aenean velit lacus, pellentesque et odio et, aliquet tempus justo. Duis ac risus suscipit, gravida arcu quis, tempus ante. Nullam quis tempor sapien, sed vehicula diam. Aliquam suscipit condimentum mollis. Sed quis justo condimentum, scelerisque metus sit amet, ultrices est. Donec consectetur nisl id augue vulputate consectetur ac sed lacus. Vivamus et enim id sapien bibendum placerat. Phasellus ante magna, lacinia ac facilisis et, faucibus in nulla. Sed ornare ornare ligula in aliquam.\r\n\r\nMauris tempor turpis metus, id cursus orci sagittis in. Suspendisse consectetur dignissim erat sed placerat. Curabitur lacinia ultrices magna, eget semper augue. Nunc ex nulla, scelerisque at commodo sit amet, rhoncus vel est. Praesent hendrerit, orci quis molestie iaculis, diam orci iaculis justo, non posuere eros nulla in turpis. In mattis ligula commodo, ultricies ipsum nec, posuere felis. Suspendisse ultrices ornare metus, vel suscipit enim tincidunt in. Curabitur et massa ligula. Integer scelerisque varius nunc quis aliquet. Pellentesque sit amet neque rutrum, semper nunc in, aliquam massa. Nullam ullamcorper feugiat nisi quis egestas. Morbi finibus elementum lacus vitae rhoncus.\r\n\r\nNulla accumsan odio non velit finibus, vitae rutrum ante sollicitudin. Morbi pellentesque, velit et blandit tristique, lacus augue pretium metus, non sagittis purus purus vitae ex. Nullam euismod sollicitudin velit eu faucibus. Ut pellentesque aliquam commodo. Etiam a ante sit amet libero dictum ullamcorper vitae vitae risus. Sed consectetur nibh a lacus condimentum, ac condimentum dui elementum. Mauris in odio porttitor, posuere nulla at, euismod dolor. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Fusce mattis augue vel nibh sodales, non vulputate enim luctus. Aliquam volutpat lacus eu ligula porttitor facilisis. Aliquam sit amet ultricies tortor, quis lobortis risus. Donec tristique ullamcorper tortor, ut blandit justo. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Nam auctor nisi eu congue faucibus.', 2, 4, '2017-07-16', 'year', '2017-05-25 17:34:05', NULL, 'AU,CA,US,FR,GB', 4, 31),
(3, 'À la rencontre de mes fans !', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce dapibus purus id fermentum venenatis. Integer nulla neque, mollis a iaculis quis, placerat ut turpis. Phasellus vitae cursus leo, vel volutpat leo. Mauris aliquam at ipsum ac tempor. Aenean velit lacus, pellentesque et odio et, aliquet tempus justo. Duis ac risus suscipit, gravida arcu quis, tempus ante. Nullam quis tempor sapien, sed vehicula diam. Aliquam suscipit condimentum mollis. Sed quis justo condimentum, scelerisque metus sit amet, ultrices est. Donec consectetur nisl id augue vulputate consectetur ac sed lacus. Vivamus et enim id sapien bibendum placerat. Phasellus ante magna, lacinia ac facilisis et, faucibus in nulla. Sed ornare ornare ligula in aliquam.\r\n\r\nMauris tempor turpis metus, id cursus orci sagittis in. Suspendisse consectetur dignissim erat sed placerat. Curabitur lacinia ultrices magna, eget semper augue. Nunc ex nulla, scelerisque at commodo sit amet, rhoncus vel est. Praesent hendrerit, orci quis molestie iaculis, diam orci iaculis justo, non posuere eros nulla in turpis. In mattis ligula commodo, ultricies ipsum nec, posuere felis. Suspendisse ultrices ornare metus, vel suscipit enim tincidunt in. Curabitur et massa ligula. Integer scelerisque varius nunc quis aliquet. Pellentesque sit amet neque rutrum, semper nunc in, aliquam massa. Nullam ullamcorper feugiat nisi quis egestas. Morbi finibus elementum lacus vitae rhoncus.\r\n\r\nNulla accumsan odio non velit finibus, vitae rutrum ante sollicitudin. Morbi pellentesque, velit et blandit tristique, lacus augue pretium metus, non sagittis purus purus vitae ex. Nullam euismod sollicitudin velit eu faucibus. Ut pellentesque aliquam commodo. Etiam a ante sit amet libero dictum ullamcorper vitae vitae risus. Sed consectetur nibh a lacus condimentum, ac condimentum dui elementum. Mauris in odio porttitor, posuere nulla at, euismod dolor. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Fusce mattis augue vel nibh sodales, non vulputate enim luctus. Aliquam volutpat lacus eu ligula porttitor facilisis. Aliquam sit amet ultricies tortor, quis lobortis risus. Donec tristique ullamcorper tortor, ut blandit justo. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Nam auctor nisi eu congue faucibus.\r\n\r\nProin rutrum neque id elementum egestas. Fusce ornare scelerisque feugiat. Suspendisse eget dui vitae est aliquet posuere id nec elit. Aenean vitae finibus mauris, vel tempor velit. Sed condimentum eu velit ultricies lobortis. Nam sit amet pellentesque mi. Morbi arcu est, volutpat in nibh non, blandit gravida erat. Nam tincidunt accumsan mattis. Nulla rutrum dapibus ex, id tempor odio ornare quis.', 1, 4, '2017-08-01', 'year', '2017-05-25 17:38:19', NULL, 'ZA,DE,AU,BE,CA,US,FI,FR,IE,LU,GB', 1, 32),
(4, 'Rendez-vous là où se lève le soleil !', 'Nulla accumsan odio non velit finibus, vitae rutrum ante sollicitudin. Morbi pellentesque, velit et blandit tristique, lacus augue pretium metus, non sagittis purus purus vitae ex. Nullam euismod sollicitudin velit eu faucibus. Ut pellentesque aliquam commodo. Etiam a ante sit amet libero dictum ullamcorper vitae vitae risus. Sed consectetur nibh a lacus condimentum, ac condimentum dui elementum. Mauris in odio porttitor, posuere nulla at, euismod dolor. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Fusce mattis augue vel nibh sodales, non vulputate enim luctus. Aliquam volutpat lacus eu ligula porttitor facilisis. Aliquam sit amet ultricies tortor, quis lobortis risus. Donec tristique ullamcorper tortor, ut blandit justo. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Nam auctor nisi eu congue faucibus.\r\n\r\nProin rutrum neque id elementum egestas. Fusce ornare scelerisque feugiat. Suspendisse eget dui vitae est aliquet posuere id nec elit. Aenean vitae finibus mauris, vel tempor velit. Sed condimentum eu velit ultricies lobortis. Nam sit amet pellentesque mi. Morbi arcu est, volutpat in nibh non, blandit gravida erat. Nam tincidunt accumsan mattis. Nulla rutrum dapibus ex, id tempor odio ornare quis.\r\n\r\nNulla facilisi. Pellentesque et eleifend magna, at efficitur dolor. Phasellus non odio sed dolor consectetur facilisis. Sed est est, congue semper sem non, fringilla blandit nulla. Phasellus et orci vulputate sem dictum gravida eget id eros. Morbi sed maximus orci. Suspendisse molestie ligula sed odio consectetur varius in id massa. Mauris scelerisque gravida ultrices. Suspendisse egestas nisl fringilla nunc mollis, vitae blandit nunc convallis. Ut vel turpis scelerisque, finibus mi id, vestibulum elit. In hac habitasse platea dictumst. Nam non mattis metus. Vivamus quis volutpat magna. Aliquam tincidunt leo a urna tincidunt, consectetur placerat lacus pellentesque.', 3, 3, '2017-06-26', 'month', '2017-05-25 17:40:22', NULL, 'CN,KP,KR,JP,VN', 2, 30),
(5, 'La route de la bière !', 'Mauris tempor turpis metus, id cursus orci sagittis in. Suspendisse consectetur dignissim erat sed placerat. Curabitur lacinia ultrices magna, eget semper augue. Nunc ex nulla, scelerisque at commodo sit amet, rhoncus vel est. Praesent hendrerit, orci quis molestie iaculis, diam orci iaculis justo, non posuere eros nulla in turpis. In mattis ligula commodo, ultricies ipsum nec, posuere felis. Suspendisse ultrices ornare metus, vel suscipit enim tincidunt in. Curabitur et massa ligula. Integer scelerisque varius nunc quis aliquet. Pellentesque sit amet neque rutrum, semper nunc in, aliquam massa. Nullam ullamcorper feugiat nisi quis egestas. Morbi finibus elementum lacus vitae rhoncus.\r\n\r\nNulla accumsan odio non velit finibus, vitae rutrum ante sollicitudin. Morbi pellentesque, velit et blandit tristique, lacus augue pretium metus, non sagittis purus purus vitae ex. Nullam euismod sollicitudin velit eu faucibus. Ut pellentesque aliquam commodo. Etiam a ante sit amet libero dictum ullamcorper vitae vitae risus. Sed consectetur nibh a lacus condimentum, ac condimentum dui elementum. Mauris in odio porttitor, posuere nulla at, euismod dolor. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Fusce mattis augue vel nibh sodales, non vulputate enim luctus. Aliquam volutpat lacus eu ligula porttitor facilisis. Aliquam sit amet ultricies tortor, quis lobortis risus. Donec tristique ullamcorper tortor, ut blandit justo. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Nam auctor nisi eu congue faucibus.\r\n\r\nProin rutrum neque id elementum egestas. Fusce ornare scelerisque feugiat. Suspendisse eget dui vitae est aliquet posuere id nec elit. Aenean vitae finibus mauris, vel tempor velit. Sed condimentum eu velit ultricies lobortis. Nam sit amet pellentesque mi. Morbi arcu est, volutpat in nibh non, blandit gravida erat. Nam tincidunt accumsan mattis. Nulla rutrum dapibus ex, id tempor odio ornare quis.', 1, 3, '2017-09-30', 'month', '2017-05-25 17:43:02', NULL, 'DE,AT,BE,DK,IE,LU,CZ,GB', 2, 16);

-- --------------------------------------------------------

--
-- Structure de la table `travel_category`
--

CREATE TABLE `travel_category` (
  `travel_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `travel_category`
--

INSERT INTO `travel_category` (`travel_id`, `category_id`) VALUES
(1, 1),
(1, 3),
(2, 2),
(2, 3),
(3, 1),
(3, 3),
(4, 1),
(4, 4),
(4, 5),
(5, 2);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `salt` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `roles` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  `username_canonical` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `email_canonical` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `confirmation_token` varchar(180) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password_requested_at` datetime DEFAULT NULL,
  `firstname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `lastname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `profile_picture_path` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `birth_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `salt`, `roles`, `username_canonical`, `email`, `email_canonical`, `enabled`, `last_login`, `confirmation_token`, `password_requested_at`, `firstname`, `lastname`, `profile_picture_path`, `birth_date`) VALUES
(16, 'admin', 'Q/8h79i4Vtvy3PxFndvlQEY+CzVqkm0vcF0jNMc3rFxmkn87wE2p0expuS07h2XfsWzE7Wh2E4DVZAFmI3fUew==', 'Ys20bY28nqXcRtbl8pcYiCYS/bCPLoGQRqldWDb0h8Y', 'a:1:{i:0;s:10:"ROLE_ADMIN";}', 'admin', 'lefevre.pierre.m.d@gmail.com', 'lefevre.pierre.m.d@gmail.com', 1, '2017-05-25 18:11:17', NULL, NULL, 'Pierre', 'Lefèvre', '029013100149220192358f131c346d59852927007.jpeg', '1995-06-03'),
(30, 'manon', '4DXDJjGWEyxAsqNoOrI0lAX21XOzmfHXnyDdE6gbIqgD3W+azXoE5ZHoFyxf6UFIY2rEGTJR3CSAOHbOvYbmmA==', 'kkp3/C2cl05sOV2Dc.bcq0g4DiRMS30v46QmvEcFDeY', 'a:1:{i:0;s:9:"ROLE_USER";}', 'manon', 'manon.thuleau@gmail.com', 'manon.thuleau@gmail.com', 1, '2017-05-25 18:11:29', NULL, NULL, 'Manon', 'Thuleau', '00956490014957255105926f5c6175a8376582326.jpeg', '1994-10-24'),
(31, 'kurt', '6zZIlFsC5O5Q7AqnF+5NGnZ2aasXTV1YpLSd5yYfge1GzLtkMmrtyWGItAwShU2Qoz5B5UcldyUpKhD4/fxiQQ==', '.hmKIcKJO2aCByHrW1D3ez.sx2k2GDvUoZmufbvVTxU', 'a:1:{i:0;s:9:"ROLE_USER";}', 'kurt', 'kurt.cobain@gmail.com', 'kurt.cobain@gmail.com', 1, '2017-05-25 17:55:54', NULL, NULL, 'Kurt', 'Cobain', '00530950014957256115926f62b0cf6e769093888.jpeg', '1967-02-20'),
(32, 'ellen', 'Y3W3nbFYnqK5b3XYfZHRFw5a0thfBeu/tISE/B1u3vVpRfcbNY6ekefXO+W2dvFZWXtMWEWNLqtzi06ZGR4Bmw==', 'jalgDG06k87fjj.vWhEuTmN.zGOv0z5LUZ.eOx7AndM', 'a:1:{i:0;s:9:"ROLE_USER";}', 'ellen', 'ellen.page@gmail.com', 'ellen.page@gmail.com', 1, '2017-05-25 17:57:27', NULL, NULL, 'Ellen', 'Page', '04377410014957261735926f85d6adf2325738713.jpeg', '1987-02-21');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_9474526CECAB15B3` (`travel_id`),
  ADD KEY `IDX_9474526CA76ED395` (`user_id`);

--
-- Index pour la table `country`
--
ALTER TABLE `country`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_5373C96677153098` (`code`);

--
-- Index pour la table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_B6BD307FF624B39D` (`sender_id`),
  ADD KEY `IDX_B6BD307FCD53EDB6` (`receiver_id`);

--
-- Index pour la table `travel`
--
ALTER TABLE `travel`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_2D0B6BCEA76ED395` (`user_id`);

--
-- Index pour la table `travel_category`
--
ALTER TABLE `travel_category`
  ADD PRIMARY KEY (`travel_id`,`category_id`),
  ADD KEY `IDX_6C3D7A84ECAB15B3` (`travel_id`),
  ADD KEY `IDX_6C3D7A8412469DE2` (`category_id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_8D93D64992FC23A8` (`username_canonical`),
  ADD UNIQUE KEY `UNIQ_8D93D649A0D96FBF` (`email_canonical`),
  ADD UNIQUE KEY `UNIQ_8D93D649C05FB297` (`confirmation_token`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT pour la table `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT pour la table `country`
--
ALTER TABLE `country`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=254;
--
-- AUTO_INCREMENT pour la table `message`
--
ALTER TABLE `message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT pour la table `travel`
--
ALTER TABLE `travel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `FK_9474526CA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `FK_9474526CECAB15B3` FOREIGN KEY (`travel_id`) REFERENCES `travel` (`id`);

--
-- Contraintes pour la table `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `FK_B6BD307FCD53EDB6` FOREIGN KEY (`receiver_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `FK_B6BD307FF624B39D` FOREIGN KEY (`sender_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `travel`
--
ALTER TABLE `travel`
  ADD CONSTRAINT `FK_2D0B6BCEA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `travel_category`
--
ALTER TABLE `travel_category`
  ADD CONSTRAINT `FK_6C3D7A8412469DE2` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_6C3D7A84ECAB15B3` FOREIGN KEY (`travel_id`) REFERENCES `travel` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
