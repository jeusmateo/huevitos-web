-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 29, 2024 at 07:40 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vivero`
--

-- --------------------------------------------------------

--
-- Table structure for table `arboles`
--

CREATE TABLE `arboles` (
  `id_arbol` int(11) NOT NULL,
  `nombre_cientifico` varchar(50) NOT NULL,
  `ruta_imagen` varchar(100) NOT NULL,
  `id_familia` int(11) NOT NULL,
  `nombre_comun` varchar(50) NOT NULL,
  `descripcion` text NOT NULL,
  `fruto` text NOT NULL,
  `floracion` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `arboles`
--

INSERT INTO `arboles` (`id_arbol`, `nombre_cientifico`, `ruta_imagen`, `id_familia`, `nombre_comun`, `descripcion`, `fruto`, `floracion`) VALUES
(1, 'Pouteria campechiana (Kunth) Baehni', '/images/test.jpg', 1, 'Kaniste’, guacume, mamey de Campeche', 'Árbol hasta de 27 metros de altura, con un tronco surcado, con la corona ancha y abierta. Hojas gruesamente membranáceas, oblanceoladas hasta obovadas, con un ápice obtuso y una base atenuada, con 11 pares de nervios laterales prominentes en el envés. Flores axilares o en nudos sin hojas, en fascículos con pocas flores o algunas veces solitarias, sépalos densamente seríceos, corola blanquecina, áspera, excediendo los sépalos.', 'amarillo, verde o café, un poco globoso, una a cuatro semillas largas, carnoso-amarillento, a menudo lechoso, dulce. ', 'Florece de marzo a mayo. Se reproduce por semilla.');

-- --------------------------------------------------------

--
-- Table structure for table `arboles_familia`
--

CREATE TABLE `arboles_familia` (
  `id_familia` int(11) NOT NULL,
  `nombre` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `arboles_familia`
--

INSERT INTO `arboles_familia` (`id_familia`, `nombre`) VALUES
(1, 'SAPOTACEAE');

-- --------------------------------------------------------

--
-- Table structure for table `arboles_usos`
--

CREATE TABLE `arboles_usos` (
  `id_uso` int(11) NOT NULL,
  `id_arbol` int(11) NOT NULL,
  `nombre` varchar(20) NOT NULL,
  `detalles` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `arboles_usos`
--

INSERT INTO `arboles_usos` (`id_uso`, `id_arbol`, `nombre`, `detalles`) VALUES
(1, 1, 'Comestible', 'Los frutos son consumidos crudos y tienen un sabor exótico, contienen azúcares, vitaminas y sales minerales.'),
(2, 1, 'Ornamental', 'Por su follaje para adornar jardines. Árbol recomendable para sombra.');

-- --------------------------------------------------------

--
-- Stand-in structure for view `arbol_descripcion`
-- (See below for the actual view)
--
CREATE TABLE `arbol_descripcion` (
`id_arbol` int(11)
,`familia` varchar(20)
,`ruta_imagen` varchar(100)
,`nombre_cientifico` varchar(50)
,`nombre_comun` varchar(50)
,`descripcion` text
,`fruto` text
,`floracion` text
,`uso` varchar(20)
,`uso_descripcion` text
);

-- --------------------------------------------------------

--
-- Table structure for table `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `usuario` varchar(10) NOT NULL,
  `contrasena` varchar(10) NOT NULL,
  `nombre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure for view `arbol_descripcion`
--
DROP TABLE IF EXISTS `arbol_descripcion`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `arbol_descripcion`  AS SELECT `a`.`id_arbol` AS `id_arbol`, `af`.`nombre` AS `familia`, `a`.`ruta_imagen` AS `ruta_imagen`, `a`.`nombre_cientifico` AS `nombre_cientifico`, `a`.`nombre_comun` AS `nombre_comun`, `a`.`descripcion` AS `descripcion`, `a`.`fruto` AS `fruto`, `a`.`floracion` AS `floracion`, `au`.`nombre` AS `uso`, `au`.`detalles` AS `uso_descripcion` FROM ((`arboles` `a` join `arboles_familia` `af`) join `arboles_usos` `au`) WHERE `a`.`id_familia` = `af`.`id_familia` AND `au`.`id_arbol` = `a`.`id_arbol` ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `arboles`
--
ALTER TABLE `arboles`
  ADD PRIMARY KEY (`id_arbol`),
  ADD KEY `id_familia` (`id_familia`);

--
-- Indexes for table `arboles_familia`
--
ALTER TABLE `arboles_familia`
  ADD PRIMARY KEY (`id_familia`);

--
-- Indexes for table `arboles_usos`
--
ALTER TABLE `arboles_usos`
  ADD PRIMARY KEY (`id_uso`),
  ADD KEY `id_arbol` (`id_arbol`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `arboles`
--
ALTER TABLE `arboles`
  MODIFY `id_arbol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `arboles_familia`
--
ALTER TABLE `arboles_familia`
  MODIFY `id_familia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `arboles_usos`
--
ALTER TABLE `arboles_usos`
  MODIFY `id_uso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `arboles`
--
ALTER TABLE `arboles`
  ADD CONSTRAINT `arboles_ibfk_1` FOREIGN KEY (`id_familia`) REFERENCES `arboles_familia` (`id_familia`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `arboles_usos`
--
ALTER TABLE `arboles_usos`
  ADD CONSTRAINT `arboles_usos_ibfk_1` FOREIGN KEY (`id_arbol`) REFERENCES `arboles` (`id_arbol`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
