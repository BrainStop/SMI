-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 04-Nov-2016 às 13:30
-- Versão do servidor: 10.1.10-MariaDB
-- PHP Version: 5.6.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `smi`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `auth-basic`
--

CREATE TABLE `auth-basic` (
  `id` int(11) NOT NULL,
  `name` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `valid` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `auth-basic`
--

INSERT INTO `auth-basic` (`id`, `name`, `password`, `email`, `valid`) VALUES
(79, 'Brain_Stop', 'segredos', 'g_oliveira7@hotmail.com', 1),
(80, 'dootstastic', 'spooky', 'vitinhavitor@hotmail.com', 1),
(82, 'nome', '123456', '123123@hotmail.com', 0),
(85, 'AdmiralBulldog', 'Alliance', 'a40692@alunos.isel.pt', 1),
(86, '123123', '321321', 'fakemail2@hotmail.com', 0),
(87, 'davidcamara21', 'telemovel', 'davidcamara21@hotmail.com', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `auth-challenge`
--

CREATE TABLE `auth-challenge` (
  `id` int(11) NOT NULL,
  `challenge` varchar(32) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `auth-challenge`
--

INSERT INTO `auth-challenge` (`id`, `challenge`) VALUES
(75, '1476889245'),
(76, '1476890458'),
(76, '1476890458'),
(77, '1476890578'),
(78, '1476890629'),
(79, '1476890812'),
(80, '1476974409'),
(81, '1478227179'),
(82, '1478229080'),
(83, '1478231290'),
(84, '1478231531'),
(85, '1478231798'),
(86, '1478240263'),
(87, '1478260463');

-- --------------------------------------------------------

--
-- Estrutura da tabela `auth-digest`
--

CREATE TABLE `auth-digest` (
  `id` int(11) NOT NULL,
  `name` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(64) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `auth-permissions`
--

CREATE TABLE `auth-permissions` (
  `role` int(11) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `auth-permissions`
--

INSERT INTO `auth-permissions` (`role`, `id`) VALUES
(1, 1),
(2, 2),
(1, 75);

-- --------------------------------------------------------

--
-- Estrutura da tabela `auth-roles`
--

CREATE TABLE `auth-roles` (
  `role` int(11) NOT NULL,
  `friendlyName` varchar(64) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `auth-roles`
--

INSERT INTO `auth-roles` (`role`, `friendlyName`) VALUES
(1, 'manager'),
(2, 'user'),
(3, 'guest');

-- --------------------------------------------------------

--
-- Estrutura da tabela `email-accounts`
--

CREATE TABLE `email-accounts` (
  `id` int(11) NOT NULL,
  `accountName` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `useSSL` tinyint(4) DEFAULT '0',
  `smtpServer` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `port` int(11) NOT NULL,
  `timeout` int(11) NOT NULL,
  `loginName` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `displayName` varchar(128) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `email-accounts`
--

INSERT INTO `email-accounts` (`id`, `accountName`, `useSSL`, `smtpServer`, `port`, `timeout`, `loginName`, `email`, `displayName`) VALUES
(4, 'wut', 0, 'smtp.gmail.com', 587, 30, 'chatosfogo@gmail.com', 'chatosfogo@gmail.com', 'GMail'),
(5, 'GMail', 1, 'smtp.gmail.com', 465, 30, 'chatosfogo@gmail.com', 'chatosfogo@gmail.com', 'GMailDisplay'),
(6, 'ISEL', 0, 'pod51014.outlook.com', 587, 30, 'A40692@alunos.isel.pt', 'A40692@alunos.isel.pt', 'A40692'),
(7, 'ISEL-2', 0, 'mail.isel.pt', 587, 30, 'd1371', 'd1371@deetc.isel.pt', 'Carlos Gonçalves');

-- --------------------------------------------------------

--
-- Estrutura da tabela `email-contacts`
--

CREATE TABLE `email-contacts` (
  `id` int(11) NOT NULL,
  `displayName` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(128) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `email-contacts`
--

INSERT INTO `email-contacts` (`id`, `displayName`, `email`) VALUES
(5, 'Hotmail', 'g_oliveira7@hotmail.com'),
(6, 'GMail', 'chatosfogo@gmail.com'),
(7, 'ISEL', 'a40692@alunos.isel.pt'),
(8, 'vitor |:]', 'vitinhavitor@hotmail.com');

-- --------------------------------------------------------

--
-- Estrutura da tabela `forms-counties`
--

CREATE TABLE `forms-counties` (
  `idDistrict` int(11) NOT NULL,
  `idCounty` int(11) NOT NULL,
  `nameCounty` varchar(128) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `forms-counties`
--

INSERT INTO `forms-counties` (`idDistrict`, `idCounty`, `nameCounty`) VALUES
(1, 1, 'Águeda'),
(1, 2, 'Albergaria-a-Velha'),
(1, 3, 'Anadia'),
(1, 4, 'Arouca'),
(1, 5, 'Aveiro'),
(1, 6, 'Castelo de Paiva'),
(1, 7, 'Espinho'),
(1, 8, 'Estarreja'),
(1, 9, 'Santa Maria da Feira'),
(1, 10, 'Ílhavo'),
(1, 11, 'Mealhada'),
(1, 12, 'Murtosa'),
(1, 13, 'Oliveira de Azeméis'),
(1, 14, 'Oliveira do Bairro'),
(1, 15, 'São João da Madeira'),
(1, 16, 'Ovar'),
(1, 17, 'Sever do Vouga'),
(1, 18, 'Vagos'),
(1, 19, 'Vale de Cambra'),
(11, 1, 'Alenquer'),
(11, 2, 'Arruda dos Vinhos'),
(11, 3, 'Azambuja'),
(11, 4, 'Cadaval'),
(11, 5, 'Cascais'),
(11, 6, 'Lisboa'),
(11, 7, 'Loures'),
(11, 8, 'Lourinhã'),
(11, 9, 'Mafra'),
(11, 10, 'Oeiras'),
(11, 11, 'Sintra'),
(11, 12, 'Sobral de Monte Agraço'),
(11, 13, 'Torres Vedras'),
(11, 14, 'Vila Franca de Xira'),
(11, 15, 'Amadora'),
(11, 16, 'Odivelas');

-- --------------------------------------------------------

--
-- Estrutura da tabela `forms-districts`
--

CREATE TABLE `forms-districts` (
  `idDistrict` int(11) NOT NULL,
  `nameDistrict` varchar(128) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `forms-districts`
--

INSERT INTO `forms-districts` (`idDistrict`, `nameDistrict`) VALUES
(1, 'Aveiro'),
(2, 'Beja'),
(3, 'Braga'),
(4, 'Bragança'),
(5, 'Castelo Branco'),
(6, 'Coimbra'),
(7, 'Évora'),
(8, 'Faro'),
(9, 'Guarda'),
(10, 'Leiria'),
(11, 'Lisboa'),
(12, 'Portalegre'),
(13, 'Porto'),
(14, 'Santarém'),
(15, 'Setubal'),
(16, 'Viana do Castelo'),
(17, 'Vila Real'),
(18, 'Viseu');

-- --------------------------------------------------------

--
-- Estrutura da tabela `forms-zips`
--

CREATE TABLE `forms-zips` (
  `idDistrict` int(11) NOT NULL,
  `idCounty` int(11) NOT NULL,
  `idLocation` int(11) NOT NULL,
  `nameLocation` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `postalCode` varchar(4) COLLATE utf8_unicode_ci NOT NULL,
  `postalCodeExtension` varchar(3) COLLATE utf8_unicode_ci NOT NULL,
  `postalCodeName` varchar(128) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `forms-zips`
--

INSERT INTO `forms-zips` (`idDistrict`, `idCounty`, `idLocation`, `nameLocation`, `postalCode`, `postalCodeExtension`, `postalCodeName`) VALUES
(1, 15, 1, 'São João da Madeira', '3700', '019', 'Rua Alão de Morais'),
(1, 15, 1, 'São João da Madeira', '3750', '071', 'Avenida do Brasil'),
(11, 6, 1, 'Lisboa', '1959', '007', 'Rua Conselheiro Emídio Navarro'),
(11, 6, 1, 'Lisboa', '1990', '231', 'Rossio dos Olivais');

-- --------------------------------------------------------

--
-- Estrutura da tabela `images-config`
--

CREATE TABLE `images-config` (
  `id` int(11) NOT NULL,
  `destination` varchar(1024) COLLATE utf8_unicode_ci NOT NULL,
  `maxFileSize` int(11) NOT NULL,
  `thumbType` varchar(8) COLLATE utf8_unicode_ci NOT NULL,
  `thumbWidth` int(11) NOT NULL,
  `thumbHeight` int(11) NOT NULL,
  `numColls` int(11) NOT NULL,
  `cellspacing` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `images-config`
--

INSERT INTO `images-config` (`id`, `destination`, `maxFileSize`, `thumbType`, `thumbWidth`, `thumbHeight`, `numColls`, `cellspacing`) VALUES
(1, 'C:\\Temp\\upload\\contents', 52428800, 'png', 80, 80, 3, 10),
(2, 'C:\\Temp\\upload\\contents\\comments', 52428800, 'png', 400, 400, -1, -1),
(3, 'C:\\Temp\\upload\\contents\\profile', 52428800, 'png', 80, 80, -1, -1),
(4, 'C:Temp\\upload\\contents\\subcomments', 52428800, 'png', 200, 200, -1, -1),
(5, 'C:Temp\\upload\\contents\\events', 52428800, 'png', 600, 600, -1, -1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `images-counters`
--

CREATE TABLE `images-counters` (
  `id` int(11) NOT NULL,
  `counterValue` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `images-counters`
--

INSERT INTO `images-counters` (`id`, `counterValue`) VALUES
(1, 14);

-- --------------------------------------------------------

--
-- Estrutura da tabela `images-details`
--

CREATE TABLE `images-details` (
  `id` int(11) NOT NULL,
  `fileName` varchar(1024) COLLATE utf8_unicode_ci NOT NULL,
  `mimeFileName` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `typeFileName` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  `imageFileName` varchar(1024) COLLATE utf8_unicode_ci NOT NULL,
  `imageMimeFileName` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `imageTypeFileName` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  `thumbFileName` varchar(1024) COLLATE utf8_unicode_ci NOT NULL,
  `thumbMimeFileName` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `thumbTypeFileName` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  `latitude` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `longitude` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(512) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `images-details`
--

INSERT INTO `images-details` (`id`, `fileName`, `mimeFileName`, `typeFileName`, `imageFileName`, `imageMimeFileName`, `imageTypeFileName`, `thumbFileName`, `thumbMimeFileName`, `thumbTypeFileName`, `latitude`, `longitude`, `title`, `description`) VALUES
(1, 'C:\\Temp\\upload\\contents\\nerd1.jpg', 'image', 'jpeg', 'C:\\Temp\\upload\\contents\\nerd1.jpg', 'image', 'jpeg', 'C:\\Temp\\upload\\contents\\thumbs\\nerd1.jpeg', 'image', 'jpeg', '', '', 'Video Teste', 'So para Testar isto'),
(2, 'C:\\Temp\\upload\\contents\\20150805_131152 - C+¦pia.jpg', 'image', 'jpeg', 'C:\\Temp\\upload\\contents\\20150805_131152 - C+¦pia.jpg', 'image', 'jpeg', 'C:\\Temp\\upload\\contents\\thumbs\\20150805_131152 - C+¦pia.jpeg', 'image', 'jpeg', '', '', 'dfasdfasfd', 'asdasda'),
(3, 'C:\\Temp\\upload\\contents\\lena_std.tif', 'image', 'tiff', 'C:\\Temp\\upload\\contents\\lena_std.tif', 'image', 'tiff', 'C:\\Temp\\upload\\contents\\thumbs\\lena_std.tiff', 'image', 'tiff', '', '', 'dfasdfasfd', 'asdasda');

-- --------------------------------------------------------

--
-- Estrutura da tabela `rss-comments`
--

CREATE TABLE `rss-comments` (
  `pubDate` date NOT NULL,
  `contents` varchar(2048) COLLATE utf8_unicode_ci NOT NULL,
  `idNew` int(11) NOT NULL,
  `idComment` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `rss-comments`
--

INSERT INTO `rss-comments` (`pubDate`, `contents`, `idNew`, `idComment`) VALUES
('2016-05-05', 'Escreva algo', 2, 4),
('2016-05-05', 'Sweguerino capuchino', 2, 5);

-- --------------------------------------------------------

--
-- Estrutura da tabela `rss-news`
--

CREATE TABLE `rss-news` (
  `title` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `author` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `link` varchar(512) COLLATE utf8_unicode_ci NOT NULL,
  `pubDate` date NOT NULL,
  `contents` varchar(2048) COLLATE utf8_unicode_ci NOT NULL,
  `idNew` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `rss-news`
--

INSERT INTO `rss-news` (`title`, `author`, `description`, `link`, `pubDate`, `contents`, `idNew`) VALUES
('Title', 'Carlos Conçalves', 'This is the description', '', '2016-04-21', 'An new example about RSS''s is available', 1),
('Titledasd', 'Carlos Conçalves', 'This is the description', '', '2016-04-21', 'An new example about RSS''s is available', 2),
('teste', 'Gonçalo Oliveira', 'Novo Post', '', '2016-05-03', 'ASdmASMDaSDMaSMDasmdasd', 3);

-- --------------------------------------------------------

--
-- Estrutura da tabela `trabfinal-category`
--

CREATE TABLE `trabfinal-category` (
  `idCategory` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `trabfinal-category`
--

INSERT INTO `trabfinal-category` (`idCategory`) VALUES
('Competitive'),
('Creative'),
('Funny'),
('General'),
('Guides');

-- --------------------------------------------------------

--
-- Estrutura da tabela `trabfinal-categorylink`
--

CREATE TABLE `trabfinal-categorylink` (
  `idCategory` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `idSubCategory` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `trabfinal-categorylink`
--

INSERT INTO `trabfinal-categorylink` (`idCategory`, `idSubCategory`) VALUES
('Competitive', 'Major Events'),
('Competitive', 'Minor Events'),
('Competitive', 'Monthly Events'),
('Competitive', 'Weekly Events'),
('Creative', 'Bizarre'),
('Creative', 'Fluff'),
('Creative', 'Handmade'),
('Creative', 'WorkShop'),
('Funny', 'Bizarre'),
('Funny', 'Fails'),
('Funny', 'Fluff'),
('General', 'Bugs'),
('General', 'Recruitment'),
('General', 'Requests'),
('Guides', 'Hero Specific'),
('Guides', 'Role Specific'),
('Guides', 'Tips n Tricks');

-- --------------------------------------------------------

--
-- Estrutura da tabela `trabfinal-comment`
--

CREATE TABLE `trabfinal-comment` (
  `idComment` int(11) NOT NULL,
  `contents` varchar(2048) COLLATE utf8_unicode_ci NOT NULL,
  `votes` int(11) NOT NULL DEFAULT '0',
  `dateComment` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `creator` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `trabfinal-comment`
--

INSERT INTO `trabfinal-comment` (`idComment`, `contents`, `votes`, `dateComment`, `creator`) VALUES
(4, 'jhdasjkdhka', 0, '2016-11-04 09:24:20', 79),
(5, 'adsasda', 0, '2016-11-04 10:42:42', 79),
(6, 'sdfsdf', 0, '2016-11-04 11:11:57', 79),
(7, 'fsdfsdf', 0, '2016-11-04 11:12:06', 79),
(8, 'dfsds', 0, '2016-11-04 11:12:10', 79);

-- --------------------------------------------------------

--
-- Estrutura da tabela `trabfinal-comment_comment`
--

CREATE TABLE `trabfinal-comment_comment` (
  `parentComment` int(11) NOT NULL,
  `childComment` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `trabfinal-comment_comment`
--

INSERT INTO `trabfinal-comment_comment` (`parentComment`, `childComment`) VALUES
(4, 7),
(4, 8),
(5, 6);

-- --------------------------------------------------------

--
-- Estrutura da tabela `trabfinal-comment_media`
--

CREATE TABLE `trabfinal-comment_media` (
  `idMedia` int(11) NOT NULL,
  `idComment` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `trabfinal-event`
--

CREATE TABLE `trabfinal-event` (
  `idEvent` int(11) NOT NULL,
  `title` varchar(140) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(2048) COLLATE utf8_unicode_ci NOT NULL,
  `votes` double NOT NULL DEFAULT '0',
  `pubDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `creator` int(11) NOT NULL,
  `idCategory` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `idSubCategory` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `trabfinal-event`
--

INSERT INTO `trabfinal-event` (`idEvent`, `title`, `description`, `votes`, `pubDate`, `creator`, `idCategory`, `idSubCategory`) VALUES
(22, 'When you try to stop!', 'Gaben too strong! :D', 0, '2016-10-31 19:32:35', 79, 'Funny', 'Fails'),
(24, 'asdfasdf', 'asdfasdf', 0, '2016-10-31 19:45:32', 79, 'Competitive', 'Major Events'),
(25, 'asdfasdf', 'asdfasdf', 0, '2016-10-31 19:45:55', 79, 'Competitive', 'Major Events'),
(26, 'asdfasdf', 'asdfasdf', 0, '2016-10-31 19:46:01', 79, 'Competitive', 'Major Events'),
(27, 'asdfasdf', 'asdfasdf', 0, '2016-10-31 19:51:59', 79, 'Competitive', 'Major Events'),
(28, 'asdfasdf', 'asdfasdf', 0, '2016-10-31 19:52:18', 79, 'Competitive', 'Major Events'),
(29, 'dfasdfsd', 'fsdfsdf', 0, '2016-10-31 19:52:41', 79, 'Competitive', 'Major Events'),
(30, 'sdfsdf', 'sdfsdfs', 0, '2016-10-31 19:53:31', 79, 'Competitive', 'Major Events'),
(31, 'sdfsdf', 'sdfsdfs', 0, '2016-10-31 19:54:00', 79, 'Competitive', 'Major Events'),
(32, '', 'asdasdasdad', 0, '2016-11-04 06:22:01', 79, 'Competitive', 'Minor Events'),
(33, 'Título', 'Descrição', 0, '2016-11-04 06:58:36', 79, 'Creative', 'Major Events'),
(34, 'Funny', '', 0, '2016-11-04 08:22:24', 79, 'Funny', 'Bizarre'),
(35, 'Funny', '', 0, '2016-11-04 08:22:25', 79, 'Funny', 'Bizarre'),
(36, 'Funny', '', 0, '2016-11-04 08:22:26', 79, 'Funny', 'Bizarre'),
(37, 'Funny', '', 0, '2016-11-04 08:22:26', 79, 'Funny', 'Bizarre'),
(38, 'Funny', '', 0, '2016-11-04 08:22:27', 79, 'Funny', 'Bizarre'),
(39, 'Funny', '', 0, '2016-11-04 08:22:27', 79, 'Funny', 'Bizarre'),
(40, 'Funny', '', 0, '2016-11-04 08:22:27', 79, 'Funny', 'Bizarre'),
(41, 'Funny', '', 0, '2016-11-04 08:22:27', 79, 'Funny', 'Bizarre'),
(42, 'Funny', '', 0, '2016-11-04 08:22:28', 79, 'Funny', 'Bizarre');

-- --------------------------------------------------------

--
-- Estrutura da tabela `trabfinal-event_comment`
--

CREATE TABLE `trabfinal-event_comment` (
  `idComment` int(11) NOT NULL,
  `idEvent` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `trabfinal-event_comment`
--

INSERT INTO `trabfinal-event_comment` (`idComment`, `idEvent`) VALUES
(4, 22),
(5, 22);

-- --------------------------------------------------------

--
-- Estrutura da tabela `trabfinal-event_media`
--

CREATE TABLE `trabfinal-event_media` (
  `idMedia` int(11) NOT NULL,
  `idEvent` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `trabfinal-event_media`
--

INSERT INTO `trabfinal-event_media` (`idMedia`, `idEvent`) VALUES
(172, 22),
(176, 24),
(177, 25),
(178, 26),
(179, 27),
(180, 28),
(181, 29),
(182, 30),
(183, 31),
(195, 32);

-- --------------------------------------------------------

--
-- Estrutura da tabela `trabfinal-media`
--

CREATE TABLE `trabfinal-media` (
  `idMedia` int(11) NOT NULL,
  `fileName` varchar(1024) COLLATE utf8_unicode_ci NOT NULL,
  `mimeFileName` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `typeFileName` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  `imageFileName` varchar(1024) COLLATE utf8_unicode_ci NOT NULL,
  `imageMimeFileName` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `imageTypeFileName` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  `thumbFileName` varchar(1024) COLLATE utf8_unicode_ci NOT NULL,
  `thumbMimeFileName` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `thumbTypeFileName` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  `latitude` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `longitude` varchar(32) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `trabfinal-media`
--

INSERT INTO `trabfinal-media` (`idMedia`, `fileName`, `mimeFileName`, `typeFileName`, `imageFileName`, `imageMimeFileName`, `imageTypeFileName`, `thumbFileName`, `thumbMimeFileName`, `thumbTypeFileName`, `latitude`, `longitude`) VALUES
(147, 'C:\\Temp\\upload\\contents\\profile\\doot.jpg', 'image', 'jpeg', 'C:\\Temp\\upload\\contents\\profile\\doot.jpg', 'image', 'jpeg', 'C:\\Temp\\upload\\contents\\profile\\thumbs\\doot.jpeg', 'image', 'jpeg', '', ''),
(165, 'C:Temp\\upload\\contents\\events\\417233[1].jpg', 'image', 'jpeg', 'C:Temp\\upload\\contents\\events\\417233[1].jpg', 'image', 'jpeg', 'C:Temp\\upload\\contents\\events\\thumbs\\417233[1].jpeg', 'image', 'jpeg', '', ''),
(170, 'C:Temp\\upload\\contents\\events\\417233[1].jpg', 'image', 'jpeg', 'C:Temp\\upload\\contents\\events\\417233[1].jpg', 'image', 'jpeg', 'C:Temp\\upload\\contents\\events\\thumbs\\417233[1].jpeg', 'image', 'jpeg', '', ''),
(172, 'C:Temp\\upload\\contents\\events\\2_t8w7ofXV8aNROo7d2sID2jYtuKkq3RANwRgIhOg7c[1].jpg', 'image', 'jpeg', 'C:Temp\\upload\\contents\\events\\2_t8w7ofXV8aNROo7d2sID2jYtuKkq3RANwRgIhOg7c[1].jpg', 'image', 'jpeg', 'C:Temp\\upload\\contents\\events\\thumbs\\2_t8w7ofXV8aNROo7d2sID2jYtuKkq3RANwRgIhOg7c[1].jpeg', 'image', 'jpeg', '', ''),
(173, 'C:Temp\\upload\\contents\\events\\c7511d555edf386f87fd25da4e2ffdcd35a892f47490fff0813dd73cd5b24996[1].jpg', 'image', 'jpeg', 'C:Temp\\upload\\contents\\events\\c7511d555edf386f87fd25da4e2ffdcd35a892f47490fff0813dd73cd5b24996[1].jpg', 'image', 'jpeg', 'C:Temp\\upload\\contents\\events\\thumbs\\c7511d555edf386f87fd25da4e2ffdcd35a892f47490fff0813dd73cd5b24996[1].jpeg', 'image', 'jpeg', '', ''),
(174, 'C:Temp\\upload\\contents\\events\\c7511d555edf386f87fd25da4e2ffdcd35a892f47490fff0813dd73cd5b24996[2].jpg', 'image', 'jpeg', 'C:Temp\\upload\\contents\\events\\c7511d555edf386f87fd25da4e2ffdcd35a892f47490fff0813dd73cd5b24996[2].jpg', 'image', 'jpeg', 'C:Temp\\upload\\contents\\events\\thumbs\\c7511d555edf386f87fd25da4e2ffdcd35a892f47490fff0813dd73cd5b24996[2].jpeg', 'image', 'jpeg', '', ''),
(176, 'C:Temp\\upload\\contents\\events\\mexfV8YN9ofoejlgWXJAjH7iWt0M0TUvAvqtE7afUDY[1].png', 'image', 'png', 'C:Temp\\upload\\contents\\events\\mexfV8YN9ofoejlgWXJAjH7iWt0M0TUvAvqtE7afUDY[1].png', 'image', 'png', 'C:Temp\\upload\\contents\\events\\thumbs\\mexfV8YN9ofoejlgWXJAjH7iWt0M0TUvAvqtE7afUDY[1].png', 'image', 'png', '', ''),
(177, 'C:Temp\\upload\\contents\\events\\mexfV8YN9ofoejlgWXJAjH7iWt0M0TUvAvqtE7afUDY[1].png', 'image', 'png', 'C:Temp\\upload\\contents\\events\\mexfV8YN9ofoejlgWXJAjH7iWt0M0TUvAvqtE7afUDY[1].png', 'image', 'png', 'C:Temp\\upload\\contents\\events\\thumbs\\mexfV8YN9ofoejlgWXJAjH7iWt0M0TUvAvqtE7afUDY[1].png', 'image', 'png', '', ''),
(178, 'C:Temp\\upload\\contents\\events\\mexfV8YN9ofoejlgWXJAjH7iWt0M0TUvAvqtE7afUDY[1].png', 'image', 'png', 'C:Temp\\upload\\contents\\events\\mexfV8YN9ofoejlgWXJAjH7iWt0M0TUvAvqtE7afUDY[1].png', 'image', 'png', 'C:Temp\\upload\\contents\\events\\thumbs\\mexfV8YN9ofoejlgWXJAjH7iWt0M0TUvAvqtE7afUDY[1].png', 'image', 'png', '', ''),
(179, 'C:Temp\\upload\\contents\\events\\mexfV8YN9ofoejlgWXJAjH7iWt0M0TUvAvqtE7afUDY[1].png', 'image', 'png', 'C:Temp\\upload\\contents\\events\\mexfV8YN9ofoejlgWXJAjH7iWt0M0TUvAvqtE7afUDY[1].png', 'image', 'png', 'C:Temp\\upload\\contents\\events\\thumbs\\mexfV8YN9ofoejlgWXJAjH7iWt0M0TUvAvqtE7afUDY[1].png', 'image', 'png', '', ''),
(180, 'C:Temp\\upload\\contents\\events\\mexfV8YN9ofoejlgWXJAjH7iWt0M0TUvAvqtE7afUDY[1].png', 'image', 'png', 'C:Temp\\upload\\contents\\events\\mexfV8YN9ofoejlgWXJAjH7iWt0M0TUvAvqtE7afUDY[1].png', 'image', 'png', 'C:Temp\\upload\\contents\\events\\thumbs\\mexfV8YN9ofoejlgWXJAjH7iWt0M0TUvAvqtE7afUDY[1].png', 'image', 'png', '', ''),
(181, 'C:Temp\\upload\\contents\\events\\2_t8w7ofXV8aNROo7d2sID2jYtuKkq3RANwRgIhOg7c[2].jpg', 'image', 'jpeg', 'C:Temp\\upload\\contents\\events\\2_t8w7ofXV8aNROo7d2sID2jYtuKkq3RANwRgIhOg7c[2].jpg', 'image', 'jpeg', 'C:Temp\\upload\\contents\\events\\thumbs\\2_t8w7ofXV8aNROo7d2sID2jYtuKkq3RANwRgIhOg7c[2].jpeg', 'image', 'jpeg', '', ''),
(182, 'C:Temp\\upload\\contents\\events\\c7511d555edf386f87fd25da4e2ffdcd35a892f47490fff0813dd73cd5b24996[1].jpg', 'image', 'jpeg', 'C:Temp\\upload\\contents\\events\\c7511d555edf386f87fd25da4e2ffdcd35a892f47490fff0813dd73cd5b24996[1].jpg', 'image', 'jpeg', 'C:Temp\\upload\\contents\\events\\thumbs\\c7511d555edf386f87fd25da4e2ffdcd35a892f47490fff0813dd73cd5b24996[1].jpeg', 'image', 'jpeg', '', ''),
(183, 'C:Temp\\upload\\contents\\events\\live-slow-die-whenever-26323-1920x1080.jpg', 'image', 'jpeg', 'C:Temp\\upload\\contents\\events\\live-slow-die-whenever-26323-1920x1080.jpg', 'image', 'jpeg', 'C:Temp\\upload\\contents\\events\\thumbs\\live-slow-die-whenever-26323-1920x1080.jpeg', 'image', 'jpeg', '', ''),
(184, 'C:\\Temp\\upload\\contents\\profile\\Cosmetic_icon_Alliance_HUD[1].png', 'image', 'png', 'C:\\Temp\\upload\\contents\\profile\\Cosmetic_icon_Alliance_HUD[1].png', 'image', 'png', 'C:\\Temp\\upload\\contents\\profile\\thumbs\\Cosmetic_icon_Alliance_HUD[1].png', 'image', 'png', '', ''),
(193, 'C:\\Temp\\upload\\contents\\profile\\48de7f661fd6582825946064ce0b79db_square_fullsize[1].png', 'image', 'png', 'C:\\Temp\\upload\\contents\\profile\\48de7f661fd6582825946064ce0b79db_square_fullsize[1].png', 'image', 'png', 'C:\\Temp\\upload\\contents\\profile\\thumbs\\48de7f661fd6582825946064ce0b79db_square_fullsize[1].png', 'image', 'png', '', ''),
(194, 'C:\\Temp\\upload\\contents\\profile\\48de7f661fd6582825946064ce0b79db_square_fullsize[2].png', 'image', 'png', 'C:\\Temp\\upload\\contents\\profile\\48de7f661fd6582825946064ce0b79db_square_fullsize[2].png', 'image', 'png', 'C:\\Temp\\upload\\contents\\profile\\thumbs\\48de7f661fd6582825946064ce0b79db_square_fullsize[2].png', 'image', 'png', '', ''),
(195, 'C:Temp\\upload\\contents\\events\\Cosmetic_icon_Alliance_HUD[2].png', 'image', 'png', 'C:Temp\\upload\\contents\\events\\Cosmetic_icon_Alliance_HUD[2].png', 'image', 'png', 'C:Temp\\upload\\contents\\events\\thumbs\\Cosmetic_icon_Alliance_HUD[2].png', 'image', 'png', '', ''),
(196, 'C:\\Temp\\upload\\contents\\profile\\David Horario.png', 'image', 'png', 'C:\\Temp\\upload\\contents\\profile\\David Horario.png', 'image', 'png', 'C:\\Temp\\upload\\contents\\profile\\thumbs\\David Horario.png', 'image', 'png', '', '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `trabfinal-notification`
--

CREATE TABLE `trabfinal-notification` (
  `idNotification` int(11) NOT NULL,
  `idEvent` int(11) NOT NULL,
  `idSubscription` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `trabfinal-notification`
--

INSERT INTO `trabfinal-notification` (`idNotification`, `idEvent`, `idSubscription`) VALUES
(3, 22, 5),
(6, 25, 3),
(8, 27, 3),
(9, 28, 3),
(10, 29, 3),
(11, 30, 3),
(12, 31, 3),
(13, 32, 3);

-- --------------------------------------------------------

--
-- Estrutura da tabela `trabfinal-permissions`
--

CREATE TABLE `trabfinal-permissions` (
  `user` int(11) NOT NULL,
  `role` varchar(12) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `trabfinal-permissions`
--

INSERT INTO `trabfinal-permissions` (`user`, `role`) VALUES
(79, '3'),
(80, '3'),
(81, '0'),
(82, '0'),
(83, '0'),
(84, '0'),
(85, '0'),
(86, '0'),
(87, '0');

-- --------------------------------------------------------

--
-- Estrutura da tabela `trabfinal-roles`
--

CREATE TABLE `trabfinal-roles` (
  `id` int(11) NOT NULL,
  `friendlyName` varchar(12) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `trabfinal-roles`
--

INSERT INTO `trabfinal-roles` (`id`, `friendlyName`) VALUES
(0, 'Guest'),
(1, 'User'),
(2, 'Supporter'),
(3, 'Admin');

-- --------------------------------------------------------

--
-- Estrutura da tabela `trabfinal-subcategory`
--

CREATE TABLE `trabfinal-subcategory` (
  `idSubCategory` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `trabfinal-subcategory`
--

INSERT INTO `trabfinal-subcategory` (`idSubCategory`) VALUES
('Bizarre'),
('Bugs'),
('Fails'),
('Fluff'),
('Handmade'),
('Hero Specific'),
('Major Events'),
('Minor Events'),
('Monthly Events'),
('Recruitment'),
('Requests'),
('Role Specific'),
('Tips n Tricks'),
('Weekly Events'),
('WorkShop');

-- --------------------------------------------------------

--
-- Estrutura da tabela `trabfinal-subscription`
--

CREATE TABLE `trabfinal-subscription` (
  `idSubscription` int(11) NOT NULL,
  `idSubscriber` int(11) NOT NULL,
  `idCategory` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `trabfinal-subscription`
--

INSERT INTO `trabfinal-subscription` (`idSubscription`, `idSubscriber`, `idCategory`) VALUES
(1, 80, 'Funny'),
(2, 80, 'Creative'),
(3, 79, 'Competitive'),
(4, 79, 'Creative'),
(5, 79, 'Funny'),
(6, 79, 'General'),
(7, 79, 'Guides');

-- --------------------------------------------------------

--
-- Estrutura da tabela `trabfinal-user_media`
--

CREATE TABLE `trabfinal-user_media` (
  `idMedia` int(11) NOT NULL,
  `idUser` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `trabfinal-user_media`
--

INSERT INTO `trabfinal-user_media` (`idMedia`, `idUser`) VALUES
(147, 80),
(184, 85),
(193, 79),
(194, 86),
(196, 87);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `auth-basic`
--
ALTER TABLE `auth-basic`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `auth-digest`
--
ALTER TABLE `auth-digest`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `auth-roles`
--
ALTER TABLE `auth-roles`
  ADD PRIMARY KEY (`role`);

--
-- Indexes for table `email-accounts`
--
ALTER TABLE `email-accounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `email-contacts`
--
ALTER TABLE `email-contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `images-config`
--
ALTER TABLE `images-config`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `images-counters`
--
ALTER TABLE `images-counters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `images-details`
--
ALTER TABLE `images-details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rss-comments`
--
ALTER TABLE `rss-comments`
  ADD PRIMARY KEY (`idComment`),
  ADD KEY `idNew` (`idNew`);

--
-- Indexes for table `rss-news`
--
ALTER TABLE `rss-news`
  ADD PRIMARY KEY (`idNew`);

--
-- Indexes for table `trabfinal-category`
--
ALTER TABLE `trabfinal-category`
  ADD PRIMARY KEY (`idCategory`);

--
-- Indexes for table `trabfinal-categorylink`
--
ALTER TABLE `trabfinal-categorylink`
  ADD PRIMARY KEY (`idCategory`,`idSubCategory`),
  ADD KEY `idSubCategory` (`idSubCategory`);

--
-- Indexes for table `trabfinal-comment`
--
ALTER TABLE `trabfinal-comment`
  ADD PRIMARY KEY (`idComment`),
  ADD KEY `creator` (`creator`);

--
-- Indexes for table `trabfinal-comment_comment`
--
ALTER TABLE `trabfinal-comment_comment`
  ADD PRIMARY KEY (`childComment`),
  ADD KEY `parentComment` (`parentComment`);

--
-- Indexes for table `trabfinal-comment_media`
--
ALTER TABLE `trabfinal-comment_media`
  ADD KEY `idMedia` (`idMedia`),
  ADD KEY `idComment` (`idComment`);

--
-- Indexes for table `trabfinal-event`
--
ALTER TABLE `trabfinal-event`
  ADD PRIMARY KEY (`idEvent`),
  ADD KEY `creator` (`creator`),
  ADD KEY `idCategory` (`idCategory`),
  ADD KEY `idSubCategory` (`idSubCategory`);

--
-- Indexes for table `trabfinal-event_comment`
--
ALTER TABLE `trabfinal-event_comment`
  ADD PRIMARY KEY (`idComment`),
  ADD KEY `idEvent` (`idEvent`);

--
-- Indexes for table `trabfinal-event_media`
--
ALTER TABLE `trabfinal-event_media`
  ADD KEY `idMedia` (`idMedia`),
  ADD KEY `idEvent` (`idEvent`);

--
-- Indexes for table `trabfinal-media`
--
ALTER TABLE `trabfinal-media`
  ADD PRIMARY KEY (`idMedia`);

--
-- Indexes for table `trabfinal-notification`
--
ALTER TABLE `trabfinal-notification`
  ADD PRIMARY KEY (`idNotification`),
  ADD KEY `idEvent` (`idEvent`),
  ADD KEY `idSubscription` (`idSubscription`);

--
-- Indexes for table `trabfinal-permissions`
--
ALTER TABLE `trabfinal-permissions`
  ADD PRIMARY KEY (`user`);

--
-- Indexes for table `trabfinal-roles`
--
ALTER TABLE `trabfinal-roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trabfinal-subcategory`
--
ALTER TABLE `trabfinal-subcategory`
  ADD PRIMARY KEY (`idSubCategory`);

--
-- Indexes for table `trabfinal-subscription`
--
ALTER TABLE `trabfinal-subscription`
  ADD PRIMARY KEY (`idSubscription`),
  ADD KEY `idSubscriber` (`idSubscriber`),
  ADD KEY `idCategory` (`idCategory`);

--
-- Indexes for table `trabfinal-user_media`
--
ALTER TABLE `trabfinal-user_media`
  ADD KEY `idMedia` (`idMedia`),
  ADD KEY `idUser` (`idUser`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `auth-basic`
--
ALTER TABLE `auth-basic`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;
--
-- AUTO_INCREMENT for table `auth-digest`
--
ALTER TABLE `auth-digest`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `email-accounts`
--
ALTER TABLE `email-accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `email-contacts`
--
ALTER TABLE `email-contacts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `images-config`
--
ALTER TABLE `images-config`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `images-counters`
--
ALTER TABLE `images-counters`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `images-details`
--
ALTER TABLE `images-details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `rss-comments`
--
ALTER TABLE `rss-comments`
  MODIFY `idComment` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `rss-news`
--
ALTER TABLE `rss-news`
  MODIFY `idNew` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `trabfinal-comment`
--
ALTER TABLE `trabfinal-comment`
  MODIFY `idComment` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `trabfinal-event`
--
ALTER TABLE `trabfinal-event`
  MODIFY `idEvent` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;
--
-- AUTO_INCREMENT for table `trabfinal-media`
--
ALTER TABLE `trabfinal-media`
  MODIFY `idMedia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=197;
--
-- AUTO_INCREMENT for table `trabfinal-notification`
--
ALTER TABLE `trabfinal-notification`
  MODIFY `idNotification` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `trabfinal-permissions`
--
ALTER TABLE `trabfinal-permissions`
  MODIFY `user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;
--
-- AUTO_INCREMENT for table `trabfinal-roles`
--
ALTER TABLE `trabfinal-roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `trabfinal-subscription`
--
ALTER TABLE `trabfinal-subscription`
  MODIFY `idSubscription` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `rss-comments`
--
ALTER TABLE `rss-comments`
  ADD CONSTRAINT `rss-comments_ibfk_1` FOREIGN KEY (`idNew`) REFERENCES `rss-news` (`idNew`) ON DELETE CASCADE;

--
-- Limitadores para a tabela `trabfinal-categorylink`
--
ALTER TABLE `trabfinal-categorylink`
  ADD CONSTRAINT `trabfinal-categorylink_ibfk_1` FOREIGN KEY (`idCategory`) REFERENCES `trabfinal-category` (`idCategory`) ON DELETE CASCADE,
  ADD CONSTRAINT `trabfinal-categorylink_ibfk_2` FOREIGN KEY (`idSubCategory`) REFERENCES `trabfinal-subcategory` (`idSubCategory`) ON DELETE CASCADE;

--
-- Limitadores para a tabela `trabfinal-comment`
--
ALTER TABLE `trabfinal-comment`
  ADD CONSTRAINT `trabfinal-comment_ibfk_1` FOREIGN KEY (`creator`) REFERENCES `auth-basic` (`id`) ON DELETE CASCADE;

--
-- Limitadores para a tabela `trabfinal-comment_comment`
--
ALTER TABLE `trabfinal-comment_comment`
  ADD CONSTRAINT `trabfinal-comment_comment_ibfk_1` FOREIGN KEY (`parentComment`) REFERENCES `trabfinal-comment` (`idComment`) ON DELETE CASCADE,
  ADD CONSTRAINT `trabfinal-comment_comment_ibfk_2` FOREIGN KEY (`childComment`) REFERENCES `trabfinal-comment` (`idComment`) ON DELETE CASCADE;

--
-- Limitadores para a tabela `trabfinal-comment_media`
--
ALTER TABLE `trabfinal-comment_media`
  ADD CONSTRAINT `trabfinal-comment_media_ibfk_1` FOREIGN KEY (`idMedia`) REFERENCES `trabfinal-media` (`idMedia`) ON DELETE CASCADE,
  ADD CONSTRAINT `trabfinal-comment_media_ibfk_2` FOREIGN KEY (`idComment`) REFERENCES `trabfinal-comment` (`idComment`) ON DELETE CASCADE;

--
-- Limitadores para a tabela `trabfinal-event`
--
ALTER TABLE `trabfinal-event`
  ADD CONSTRAINT `trabfinal-event_ibfk_1` FOREIGN KEY (`creator`) REFERENCES `auth-basic` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `trabfinal-event_ibfk_2` FOREIGN KEY (`idCategory`) REFERENCES `trabfinal-category` (`idCategory`) ON DELETE CASCADE,
  ADD CONSTRAINT `trabfinal-event_ibfk_3` FOREIGN KEY (`idSubCategory`) REFERENCES `trabfinal-subcategory` (`idSubCategory`) ON DELETE CASCADE;

--
-- Limitadores para a tabela `trabfinal-event_comment`
--
ALTER TABLE `trabfinal-event_comment`
  ADD CONSTRAINT `trabfinal-event_comment_ibfk_1` FOREIGN KEY (`idComment`) REFERENCES `trabfinal-comment` (`idComment`) ON DELETE CASCADE,
  ADD CONSTRAINT `trabfinal-event_comment_ibfk_2` FOREIGN KEY (`idEvent`) REFERENCES `trabfinal-event` (`idEvent`) ON DELETE CASCADE;

--
-- Limitadores para a tabela `trabfinal-event_media`
--
ALTER TABLE `trabfinal-event_media`
  ADD CONSTRAINT `trabfinal-event_media_ibfk_1` FOREIGN KEY (`idMedia`) REFERENCES `trabfinal-media` (`idMedia`) ON DELETE CASCADE,
  ADD CONSTRAINT `trabfinal-event_media_ibfk_2` FOREIGN KEY (`idEvent`) REFERENCES `trabfinal-event` (`idEvent`) ON DELETE CASCADE;

--
-- Limitadores para a tabela `trabfinal-notification`
--
ALTER TABLE `trabfinal-notification`
  ADD CONSTRAINT `trabfinal-notification_ibfk_1` FOREIGN KEY (`idEvent`) REFERENCES `trabfinal-event` (`idEvent`) ON DELETE CASCADE,
  ADD CONSTRAINT `trabfinal-notification_ibfk_2` FOREIGN KEY (`idSubscription`) REFERENCES `trabfinal-subscription` (`idSubscription`) ON DELETE CASCADE;

--
-- Limitadores para a tabela `trabfinal-subscription`
--
ALTER TABLE `trabfinal-subscription`
  ADD CONSTRAINT `trabfinal-subscription_ibfk_1` FOREIGN KEY (`idSubscriber`) REFERENCES `auth-basic` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `trabfinal-subscription_ibfk_2` FOREIGN KEY (`idCategory`) REFERENCES `trabfinal-category` (`idCategory`) ON DELETE CASCADE;

--
-- Limitadores para a tabela `trabfinal-user_media`
--
ALTER TABLE `trabfinal-user_media`
  ADD CONSTRAINT `trabfinal-user_media_ibfk_1` FOREIGN KEY (`idMedia`) REFERENCES `trabfinal-media` (`idMedia`) ON DELETE CASCADE,
  ADD CONSTRAINT `trabfinal-user_media_ibfk_2` FOREIGN KEY (`idUser`) REFERENCES `auth-basic` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
