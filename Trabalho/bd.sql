-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 12-Jan-2020 às 23:23
-- Versão do servidor: 10.4.8-MariaDB
-- versão do PHP: 7.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `saw`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `categoria`
--

CREATE TABLE `categoria` (
  `id` int(11) NOT NULL,
  `categoria` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `categoria`
--

INSERT INTO `categoria` (`id`, `categoria`) VALUES
(1, 'Aventura'),
(2, 'Ação'),
(3, 'Horror'),
(4, 'Comédia'),
(10, 'Terror');

-- --------------------------------------------------------

--
-- Estrutura da tabela `filmes`
--

CREATE TABLE `filmes` (
  `id` int(11) NOT NULL,
  `titulo` varchar(250) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `tempo` int(11) NOT NULL,
  `data_lançamento` date NOT NULL,
  `estado` int(11) NOT NULL,
  `url` varchar(250) NOT NULL,
  `descricao` longtext NOT NULL,
  `preco` float NOT NULL,
  `img` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `filmes`
--

INSERT INTO `filmes` (`id`, `titulo`, `id_categoria`, `tempo`, `data_lançamento`, `estado`, `url`, `descricao`, `preco`, `img`) VALUES
(27, 'Assasino a preço fixo', 2, 120, '2020-01-15', 2, 'https://www.youtube.com/watch?v=Skpu5HaVkOc', 'Após os acontecimentos em Londres, Dom, Brian, Letty e o resto da equipe têm a chance de voltar para os Estados Unidos e recomeçar suas vidas. Mas a tranquilidade do grupo é destruída quando Deckard Shaw, um assassino profissional, quer vingança pelo acidente que deixou seu irmão em coma. Agora, a equipe tem de unir forças para deter um vilão novo e ainda mais perigoso. Dessa vez, não se trata apenas de uma questão de velocidade: a corrida é pela sobrevivência.', 12, '940ca1184d1f932d2e3b89de6c9622d5.png'),
(28, 'Velocidade Furiosa', 2, 90, '2020-01-23', 2, 'https://www.youtube.com/watch?v=PPfrmkBczd0', 'Após os acontecimentos em Londres, Dom, Brian, Letty e o resto da equipe têm a chance de voltar para os Estados Unidos e recomeçar suas vidas. Mas a tranquilidade do grupo é destruída quando Deckard Shaw, um assassino profissional, quer vingança pelo acidente que deixou seu irmão em coma. Agora, a equipe tem de unir forças para deter um vilão novo e ainda mais perigoso. Dessa vez, não se trata apenas de uma questão de velocidade: a corrida é pela sobrevivência.', 12, '9abe426ce9f8bd29cfe97b94623cf9fb.jpg'),
(29, 'OverDrive', 2, 12, '2020-01-24', 1, 'https://www.youtube.com/watch?v=TewuPuL6940', 'Fixe', 1, '42300a3758d7e37e7d6d306621768d96.jpg'),
(30, 'Mr Bean', 4, 120, '2020-01-25', 1, 'https://www.youtube.com/watch?v=Skpu5HaVkOc', 'Comedia', 345, 'ca2ec69c72b7f026b18f08dd3a0ac5b4.jpg');

-- --------------------------------------------------------

--
-- Estrutura da tabela `filmes_alugados`
--

CREATE TABLE `filmes_alugados` (
  `id_user` int(11) NOT NULL,
  `id_filme` int(11) NOT NULL,
  `data_fim` date NOT NULL,
  `data_inicio` date NOT NULL,
  `Preco` float NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `filmes_alugados`
--

INSERT INTO `filmes_alugados` (`id_user`, `id_filme`, `data_fim`, `data_inicio`, `Preco`, `id`) VALUES
(19, 27, '2020-01-19', '2020-01-12', 12, 47);

-- --------------------------------------------------------

--
-- Estrutura da tabela `filmes_entregues`
--

CREATE TABLE `filmes_entregues` (
  `id` int(11) NOT NULL,
  `id_filme` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `recu_pass`
--

CREATE TABLE `recu_pass` (
  `id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `token` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `recu_pass`
--

INSERT INTO `recu_pass` (`id`, `email`, `token`) VALUES
(8, 'hugoghilas@hotmail.com', 'e17bfa6f3d156c6e13de598d1e8adc3da255856cbdaee19ceb'),
(9, 'hugsaf2132@gmail.com', '06761ab1876f02f09c2be30c884851eb34bdcda0724e70b0a6'),
(10, 'hugoghilas@hotmail.com', '2c70b54b2a20e9ebac636301a0feec839f11004a49720faa11'),
(11, 'hugsaf2132@gmail.com', '0e73debd8a23030c8b821d7b33f9bd58378332c81b973d6b73'),
(12, 'hugsaf2132@gmail.com', '6df2e9d7778d403eee3848ac5362b56345a348a3abaeb26e9e'),
(13, 'hugsaf2132@gmail.com', '08f7f27bb84a749f18c31ad82f073a25a0e1183d24bfaacf96'),
(14, 'hugsaf2132@gmail.com', 'f54e6d8dcb1d44b2265cf8d89f7c3853004b8fe2ef636d801f'),
(15, 'hugoghilas@hotmail.com', 'e7077e9cafb0845af61c6bd292b5754e795a18405d458bb93e'),
(16, 'hugoghilas@hotmail.com', '4d365f85f4346d41affcb4b1557cd9f06fc85d74b4b4396457'),
(17, 'hugsaf2132@gmail.com', 'a3e327bf3a75132bf6275859681da94b6bc9a903ea32722290'),
(18, 'hugsaf2132@gmail.com', 'c4845492c8677dd08a74a5de892a7220a0adce35cb0258e035'),
(19, 'hugsaf2132@gmail.com', 'f3370ef99dc49e55d78d63b358af9563a1c9273c4a838b7913');

-- --------------------------------------------------------

--
-- Estrutura da tabela `reservas`
--

CREATE TABLE `reservas` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_filme` int(11) NOT NULL,
  `preco` float NOT NULL,
  `data_fim` date NOT NULL,
  `datareserva` date NOT NULL,
  `estado` int(11) NOT NULL COMMENT '0-Alugado, 1-Termindado O aluguer'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `reservas`
--

INSERT INTO `reservas` (`id`, `id_user`, `id_filme`, `preco`, `data_fim`, `datareserva`, `estado`) VALUES
(1, 19, 28, 12, '2020-01-19', '2020-01-12', 1),
(2, 19, 28, 12, '2020-01-19', '2020-01-12', 1),
(3, 19, 27, 12, '2020-01-19', '2020-01-12', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `apelido` varchar(50) NOT NULL,
  `email` varchar(70) NOT NULL,
  `codigo_postal` varchar(20) NOT NULL,
  `morada` varchar(60) NOT NULL,
  `password` varchar(255) NOT NULL,
  `img` varchar(255) NOT NULL,
  `tipo_utilizador` int(11) NOT NULL COMMENT '0-Cliente, 1-Admin,2-Funcionario',
  `id_active` int(2) NOT NULL COMMENT '1-Ativo;0-Inativo',
  `token` varchar(600) NOT NULL,
  `tent` int(11) NOT NULL,
  `passblock` int(11) NOT NULL COMMENT '1-Bloqueada,0-Desbloqueada'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`id`, `nome`, `apelido`, `email`, `codigo_postal`, `morada`, `password`, `img`, `tipo_utilizador`, `id_active`, `token`, `tent`, `passblock`) VALUES
(19, 'Hugo', 'Silva', 'hugsaf2132@gmail.com', 'Rua de Fervença', '4600-520', '$2y$10$1LKdqP6lab3nCm.qPV1E1uZXcziFDXYGNfvv3phqKjRz7ERXmLiwG', '3c2a33c2b168cd32b515120e72bcfccd.jpg', 1, 1, '8c9e7e5d90e9402fb724ac691a87c53c19d7271ba2eaae3b686254b20afbec64f183b7e4d059200b520423735b22029a0ead', 5, 0),
(21, 'Mariana', 'Faustino', 'hugoghilas@hotmail.com', 'Rua de Fervença', '4600-520', '$2y$10$sSGQaTH5mfQjLW1EVipEte2ZmEsQ.QlrFDCNcnqtBcZFA0HBPlHcq', '', 0, 1, '77197af08417812cc4712517a8c87f3819062990b2ce2555136771cc784dfb5a57b14048edd0f216052dbae179d993342a72', 5, 0);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `filmes`
--
ALTER TABLE `filmes`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `filmes_alugados`
--
ALTER TABLE `filmes_alugados`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `filmes_entregues`
--
ALTER TABLE `filmes_entregues`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `recu_pass`
--
ALTER TABLE `recu_pass`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `reservas`
--
ALTER TABLE `reservas`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `filmes`
--
ALTER TABLE `filmes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de tabela `filmes_alugados`
--
ALTER TABLE `filmes_alugados`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT de tabela `filmes_entregues`
--
ALTER TABLE `filmes_entregues`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de tabela `recu_pass`
--
ALTER TABLE `recu_pass`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de tabela `reservas`
--
ALTER TABLE `reservas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
