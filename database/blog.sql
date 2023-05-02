-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 02, 2023 at 01:15 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `blog`
--

-- --------------------------------------------------------

--
-- Table structure for table `article`
--

CREATE TABLE `article` (
  `idArticle` int NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` varchar(3500) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `createdAt` datetime NOT NULL,
  `categoryId` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `article`
--

INSERT INTO `article` (`idArticle`, `title`, `content`, `image`, `createdAt`, `categoryId`) VALUES
(1, 'Découvrez la ville de Marseille : une destination ensoleillée et culturelle\r\n\r\n', 'Marseille, deuxième plus grande ville de France, est une destination de choix pour ceux qui cherchent une expérience de voyage authentique et enrichissante. </br>\r\nAvec son riche patrimoine culturel, sa cuisine savoureuse et son climat ensoleillé, Marseille est une ville qui a beaucoup à offrir.', 'marseille.jpeg', '2023-02-23 08:30:31', 1),
(2, ' Les 5 expériences incontournables à vivre à Marrakech', 'Située au cœur du Maroc, Marrakech est une ville emblématique qui attire des voyageurs du monde entier. <br>\r\nConnue pour son patrimoine culturel et historique, sa cuisine exotique, ses souks colorés et ses paysages somptueux, Marrakech est une destination touristique à ne pas manquer. Dans cet article, nous allons découvrir les raisons pour lesquelles Marrakech est considérée comme un joyau marocain.\r\n<br>\r\nLa Médina de Marrakech, classée patrimoine mondial de l\'UNESCO, est une merveille architecturale qui témoigne de l\'histoire riche de la ville. Vous pourrez y découvrir des palais somptueux, des jardins luxuriants et des mosquées majestueuses. Le palais de la Bahia, par exemple, est un palais du XIXème siècle qui est célèbre pour son architecture et sa décoration somptueuse. La mosquée Koutoubia, quant à elle, est une mosquée du XIIème siècle qui est l\'emblème de Marrakech.\r\n\r\nLa cuisine marocaine est renommée pour sa saveur et son exotisme. À Marrakech, vous aurez l\'opportunité de goûter à une variété de plats traditionnels tels que le tajine, le couscous et les pastillas. Les épices telles que le cumin, le safran et le paprika sont largement utilisées pour donner aux plats une saveur unique. <br>\r\n\r\nLes souks de Marrakech sont un paradis pour les amateurs de shopping. Vous y trouverez des objets d\'artisanat, des tapis, des bijoux et des vêtements traditionnels. Les souks sont également une occasion de découvrir la culture marocaine et de rencontrer les artisans locaux.\r\n<br>\r\nMarrakech offre également une variété de paysages naturels à couper le souffle. Les montagnes de l\'Atlas, par exemple, offrent une vue panoramique sur la ville et les plaines environnantes. Les jardins Majorelle, quant à eux, sont un oasis de verdure dans la ville avec une variété de plantes exotiques et un magnifique bassin.\r\n<br>\r\nEnfin, l\'hospitalité et la gentillesse des Marocains sont légendaires. Les habitants de Marrakech sont chaleureux et accueillants, prêts à partager leur culture et leur histoire avec les visiteurs. Les riads, des maisons traditionnelles converties en hôtels, offrent une expérience unique de l\'hospitalité marocaine.\r\n<br>\r\n\r\nEn conclusion, Marrakech est une destination touristique unique qui offre une expérience inoubliable. Avec son patrimoine culturel, sa cuisine exotique, ses souks colorés et ses paysages somptueux, Marrakech est une ville qui mérite d\'être explorée. Alors, si vous cherchez une destination de voyage exotique et dépaysante, Marrakech est l\'endroit idéal.', 'marrakech.jpg', '2023-02-27 12:57:31', 1);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `idCategory` int NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`idCategory`, `name`) VALUES
(1, 'Voyage');

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `idComment` int NOT NULL,
  `createdAt` datetime NOT NULL,
  `nickname` varchar(255) NOT NULL,
  `content` varchar(255) NOT NULL,
  `articleId` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`idComment`, `createdAt`, `nickname`, `content`, `articleId`) VALUES
(1, '2023-02-27 12:04:07', 'sebastien', 'bjr', 1),
(2, '2023-02-27 13:20:58', 'Marseillais', 'Trop bien !', 1),
(3, '2023-02-27 13:45:33', 'Voyageur1', 'Marseille !', 1),
(4, '2023-02-28 15:28:18', 'Siam', 'Incroyable', 2);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `username` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `postal_code` varchar(10) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `firstname`, `lastname`, `email`, `password`, `country`, `address`, `postal_code`, `created_at`) VALUES
(1, 'Siaam13', 'Sebastien', 'Lapeyre', 'sebastien.lapeyre13@gmail.com', '$2y$10$iY1D6g4Yk.1QwuGt7sPkeuDUZdcbFgPS591RSJSt2p3n3ALVLw2lm', 'fr', '195 av du plan de campagne', '13170', '2023-04-30 09:54:26');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`idArticle`),
  ADD KEY `categoryId` (`categoryId`),
  ADD KEY `categoryId_2` (`categoryId`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`idCategory`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`idComment`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `article`
--
ALTER TABLE `article`
  MODIFY `idArticle` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `idCategory` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `idComment` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `article`
--
ALTER TABLE `article`
  ADD CONSTRAINT `article_ibfk_1` FOREIGN KEY (`categoryId`) REFERENCES `category` (`idCategory`) ON DELETE RESTRICT ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
