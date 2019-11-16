-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 14-07-2019 a las 18:39:13
-- Versión del servidor: 10.1.26-MariaDB
-- Versión de PHP: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `shareplus`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `admin_browser_graphics`
--

CREATE TABLE `admin_browser_graphics` (
  `Browser` varchar(25) NOT NULL,
  `Access` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `admin_device_graphics`
--

CREATE TABLE `admin_device_graphics` (
  `Device` varchar(25) NOT NULL,
  `Access` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `admin_graphics`
--

CREATE TABLE `admin_graphics` (
  `graphicsID` int(11) NOT NULL,
  `look` date NOT NULL,
  `Visits` int(11) NOT NULL,
  `click` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `chat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `admin_graphics_countries`
--

CREATE TABLE `admin_graphics_countries` (
  `Countries` varchar(255) NOT NULL,
  `Results` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `admin_graphic_visits_month`
--

CREATE TABLE `admin_graphic_visits_month` (
  `sessionIP` char(255) NOT NULL,
  `time` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `audio_download_list`
--

CREATE TABLE `audio_download_list` (
  `id` int(11) NOT NULL,
  `session` varchar(255) CHARACTER SET utf8 NOT NULL,
  `folders_id` varchar(255) CHARACTER SET utf8 NOT NULL,
  `file_name` varchar(500) CHARACTER SET utf8 NOT NULL,
  `time_erase` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `config`
--

CREATE TABLE `config` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `value` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `config`
--

INSERT INTO `config` (`id`, `name`, `value`) VALUES
(1, 'theme', 'default'),
(2, 'censored_words', ''),
(3, 'title', 'Shareplus - Videos'),
(4, 'name', 'Shareplus'),
(5, 'image', 'png'),
(6, 'email_web', 'chuy@gmail.com'),
(7, 'description', 'description script EWEW'),
(8, 'validation', 'off'),
(9, 'recaptcha', 'off'),
(10, 'recaptcha_key', ''),
(11, 'language', 'english'),
(12, 'terms_of_use', '1. Terms\r\n\r\nBy accessing SharePlus hereinafter referred to as a website, you agree to comply with these Terms and Conditions of Website Use, all applicable laws and regulations and agree that you are responsible for compliance with applicable local laws. If you do not agree with any of these terms, it is prohibited to use or access this site. The materials contained on this site are protected by the applicable laws of copyright and trademarks.\r\n\r\n2. Use License\r\n\r\nPermission is granted to temporarily download a copy of the materials (information or software) on the website for personal and non-commercial use. This is the granting of a license, not a transfer of title, and under this license you can not: \r\n\r\nmodify or copy the material; \r\n\r\nuse the material for any commercial purpose, or to show to the public (commercial or non-commercial); \r\n\r\nattempt to modify or reverse engineer the system included in the website; \r\n\r\nremove any copyright information or notes from the owner on the materials; or \r\n\r\ntransfer the material to another person or \"copy\" the material to another server. \r\n\r\nThis license will terminate automatically if you violate any of these restrictions and may be terminated by the website at any time. Upon completion of the viewing of these materials or upon completion of this license, you must destroy any downloaded material in your possession, either in electronic or printed format. \r\n\r\n3. Exemption from Liability\r\n\r\nA.The materials on the website are provided \"as is\". The website makes no warranties, express or implied, and hereby denies and denies all other warranties, including, without limitation, implied warranties or conditions of merchantability, fitness for a particular purpose, intellectual property infringement or other breach of rights. In addition, the website does not guarantee or make any representation with respect to the accuracy, probable results or reliability of the use of the materials on its Internet website or otherwise related to such materials or any site linked to this site. . \r\n\r\nB.We do not exercise or promote the infringement of copyright. All videos on YouTube are the copyright of their respective owners and any copyright infringement resulting from their transfer to other websites such as Facebook, will be the responsibility of the user who performs such action. We also do not store videos or other material on our servers, the links are cached and after 3 hours they are destroyed, even if the users have not made the download. \r\n\r\n4. Limitations\r\n\r\nIn no case shall the website or its suppliers be liable for any damages (including, without limitation, damages for loss of data or profits, or due to business interruption) arising from the use or inability to use the materials, even if the Website or an authorized representative of the website has been notified orally or in writing of the possibility of such damage. Because some jurisdictions do not allow limitations on implied warranties, or limitations of liability for consequential or incidental damages, these limitations may not apply to you. \r\n\r\n5. Reviews and Errata\r\n\r\nThe materials that appear on the website may include technical, typographical or photographic errors. The website does not guarantee that any of the materials on its website are accurate, complete or current. The website may make changes to the materials contained on its website at any time without prior notice. The website does not commit, however, to update the materials. \r\n\r\n6. Links\r\n\r\nThe website has not reviewed all the sites linked to its Internet website and is not responsible for the contents of such linked sites. The inclusion of any link does not imply endorsement by the website. The use of any linked website is at the risk of the user. \r\n\r\n7. Modifications to the Conditions of use of the Site\r\n\r\nThe website may revise these terms of use at any time without prior notice. By using this website, you are agreeing to be bound by the current version of these Terms and Conditions of Use. \r\n\r\n8. Law that governs us\r\n\r\nAny claim related to the website will be governed by the laws of the Republic of India without regard to its conflict of laws provisions. General terms and conditions applicable to the use of a website.\r\n					'),
(13, 'privacy_policy', 'Privacy Policy    What information do we collect and store?  We do not ask or store any type of user information   We use cookies?  We use cookies eventually but on SSL secure protocol.   Sell ​​or deliver information to third parties?  We do not sell or negotiate or transfer your personal identification to third parties. It does not include business partners that intervene in the operation of the website, or serve you, since these third parties have agreed to keep this information confidential. We will release your information when we believe it is appropriate to abide by the law, strengthen our policies, or protect our and others rights, property, or safety. However, visitor information is never provided to third parties for marketing, advertising or other uses.   Privacy Policies only on the Internet  These privacy policies apply only to the information collected on our website.   Your consent  By browsing and using the services of our website, you adhere to our privacy policy.   Changes to our Privacy Policies  If we make changes to our privacy policies, we will update those changes on this page.   Contact Us  If you have any questions about this privacy policy, please inform us using this form.'),
(14, 'help', ''),
(15, 'email', ''),
(16, 'facebook', ''),
(17, 'twitter', ''),
(18, 'yt_api', ''),
(19, 'seo_link', 'on'),
(20, 'comment_system', 'default'),
(21, 'ads_one', '&lt;img src=&quot;https://i.imgur.com/OcYS2Ju.jpg&quot;&gt;&lt;/img&gt;'),
(22, 'ads_two', '&lt;img src=&quot;https://i.imgur.com/OcYS2Ju.jpg&quot;&gt;&lt;/img&gt;'),
(23, 'Languages_panel', 'en'),
(24, 'email', 'user@mail.com'),
(25, 'password', 'e10adc3949ba59abbe56e057f20f883e'),
(26, 'smtp_host', ''),
(27, 'smtp_username', ''),
(28, 'smtp_password', ''),
(29, 'smtp_encryption', 'TLS'),
(30, 'smtp_port', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `platform_media`
--

CREATE TABLE `platform_media` (
  `id` int(11) NOT NULL,
  `key_plugin` varchar(11) NOT NULL,
  `platform` varchar(255) CHARACTER SET utf8 NOT NULL,
  `Data_Update` text CHARACTER SET utf8 NOT NULL,
  `version` varchar(255) NOT NULL,
  `Author` varchar(120) CHARACTER SET utf8 NOT NULL,
  `icon` text CHARACTER SET utf8 NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `url_line` text CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `report_link`
--

CREATE TABLE `report_link` (
  `id` int(11) NOT NULL,
  `report_link` varchar(1000) CHARACTER SET utf8 NOT NULL,
  `platform` varchar(50) NOT NULL,
  `time` int(11) NOT NULL,
  `ip_user` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `share_urls`
--

CREATE TABLE `share_urls` (
  `id` int(11) NOT NULL,
  `id_url` varchar(120) CHARACTER SET utf8 NOT NULL,
  `url` varchar(120) CHARACTER SET utf8 NOT NULL,
  `platform` varchar(11) NOT NULL,
  `IDuser` int(11) NOT NULL,
  `ip_user` varchar(120) CHARACTER SET utf8 NOT NULL,
  `views` varchar(11) NOT NULL,
  `time` varchar(11) NOT NULL,
  `facebook` tinyint(255) NOT NULL,
  `twitter` tinyint(255) NOT NULL,
  `whatsapp` tinyint(255) NOT NULL,
  `vk` tinyint(255) NOT NULL,
  `other` tinyint(255) NOT NULL,
  `downloads` tinyint(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user_data`
--

CREATE TABLE `user_data` (
  `userID` int(11) NOT NULL,
  `username` varchar(120) NOT NULL,
  `email` varchar(120) NOT NULL,
  `password` varchar(255) NOT NULL,
  `ip_user` varchar(11) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `locked` tinyint(1) NOT NULL DEFAULT '0',
  `time` varchar(120) NOT NULL,
  `key_login` varchar(255) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `user_data`
--

INSERT INTO `user_data` (`userID`, `username`, `email`, `password`, `ip_user`, `active`, `locked`, `time`, `key_login`) VALUES
(2, 'Scode', 'game123727@gmail.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', '201.153.64.', 1, 0, '1556644783', 'EoY8GAbnQKAxidk');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `audio_download_list`
--
ALTER TABLE `audio_download_list`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `config`
--
ALTER TABLE `config`
  ADD PRIMARY KEY (`id`),
  ADD KEY `name` (`name`),
  ADD KEY `value` (`value`(255));

--
-- Indices de la tabla `platform_media`
--
ALTER TABLE `platform_media`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `report_link`
--
ALTER TABLE `report_link`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `share_urls`
--
ALTER TABLE `share_urls`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `user_data`
--
ALTER TABLE `user_data`
  ADD PRIMARY KEY (`userID`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `audio_download_list`
--
ALTER TABLE `audio_download_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `config`
--
ALTER TABLE `config`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de la tabla `platform_media`
--
ALTER TABLE `platform_media`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `report_link`
--
ALTER TABLE `report_link`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `share_urls`
--
ALTER TABLE `share_urls`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `user_data`
--
ALTER TABLE `user_data`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
