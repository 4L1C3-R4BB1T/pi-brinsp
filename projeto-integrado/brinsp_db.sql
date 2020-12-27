-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: 03-Dez-2019 às 13:40
-- Versão do servidor: 5.7.24
-- versão do PHP: 7.2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `brinsp_db`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `carousel`
--

DROP TABLE IF EXISTS `carousel`;
CREATE TABLE IF NOT EXISTS `carousel` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(150) NOT NULL,
  `imagem` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `carousel`
--

INSERT INTO `carousel` (`nome`, `imagem`) VALUES
('Banner 01', 'banner01.png'),
('Banner 02', 'banner02.png'),
('Banner 03', 'banner03.png');

-- --------------------------------------------------------

--
-- Estrutura da tabela `compra`
--

DROP TABLE IF EXISTS `compra`;
CREATE TABLE IF NOT EXISTS `compra` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `cpf` varchar(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `estado` varchar(40) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `cidade` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `rua` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `bairro` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `cep` varchar(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `telefone` varchar(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `pagamento` int(11) NOT NULL,
  `valor` int(11) NOT NULL,
  `id_prod` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `qtd_prod` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `compra`
--

INSERT INTO `compra` (`nome`, `cpf`, `estado`, `cidade`, `rua`, `bairro`, `cep`, `telefone`, `pagamento`, `valor`, `id_prod`, `qtd_prod`) VALUES
('Aruru', '111.111.111-11', 'Espírito Santo', 'Vitória', 'Rua ABC', 'Boa Vizinhança', '12345-678', '999999999', 1, 41, '4,3', '1,1');

-- --------------------------------------------------------

--
-- Estrutura da tabela `evento`
--

DROP TABLE IF EXISTS `evento`;
CREATE TABLE IF NOT EXISTS `evento` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `city` varchar(70) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `uf` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `usuario` int(11) NOT NULL,
  `nome` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `descricao` varchar(300) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `imagem` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `evento`
--

INSERT INTO `evento` (`city`, `uf`, `usuario`, `nome`, `descricao`, `imagem`) VALUES
('Cachoeiro de Itapemirim', 'Espírito Santo', 1, 'Nome do Evento', 'Descrição do Evento', 'evento01.png'),
('Cachoeiro de Itapemirim', 'Espírito Santo', 1, 'Nome do Evento', 'Descrição do Evento', 'evento02.png'),
('Cachoeiro de Itapemirim', 'Espírito Santo', 2, 'Nome do Evento', 'Descrição do Evento', 'evento03.png'),
('Cachoeiro de Itapemirim', 'Espírito Santo', 2, 'Nome do Evento', 'Descrição do Evento', 'evento04.png'),
('Cachoeiro de Itapemirim', 'Espírito Santo', 1, 'Nome do Evento', 'Descrição do Evento', 'evento05.png');

-- --------------------------------------------------------

--
-- Estrutura da tabela `graficas`
--

DROP TABLE IF EXISTS `graficas`;
CREATE TABLE IF NOT EXISTS `graficas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(60) NOT NULL,
  `fone` varchar(15) NOT NULL,
  `email` varchar(40) NOT NULL,
  `endereco` varchar(100) DEFAULT NULL,
  `imagem` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `graficas`
--

INSERT INTO `graficas` (`nome`, `fone`, `email`, `endereco`, `imagem`) VALUES
('Informatos Gráfica Express & Personalizados', '(28) 3521-8259', 'informatosxerox@gmail.com', 'Rua Bernardo Horta, nº 228, bairro guandu,\r\n29300-795 - Cachoeiro de Itapemirim', 'grafica01.png'),
('Gracal Gráfica e Editora', '(28) 3522-2784', 'arte@graficagracal.com.br', 'Av. Aristídes Campos - Gilberto Machado, Cachoeiro de Itapemirim - ES, 29302-600', 'grafica02.png'),
('Print Mark ', '(28) 3522-3710', 'email@gmail.com', 'Rua Mathias Souza, 29300-115 - Cachoeiro de Itapemirim', 'grafica03.png'),
('Gráfica A', '99666-6666', 'email@gmail.com', 'Rua ABC, nº X', 'grafica04.png'),
('Gráfica B', '99556-6565', 'email@gmail.com', 'Rua ABC, nº X', 'grafica05.png');

-- --------------------------------------------------------

--
-- Estrutura da tabela `mensagem`
--

DROP TABLE IF EXISTS `mensagem`;
CREATE TABLE IF NOT EXISTS `mensagem` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `remetente` int(11) NOT NULL,
  `destinatario` int(11) NOT NULL,
  `mensagem` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `data_envio` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `mensagem`
--

INSERT INTO `mensagem` (`remetente`, `destinatario`, `mensagem`, `data_envio`) VALUES
(2, 1, 'Olá, tudo bom?', '2020-11-04'),
(2, 1, 'oi', '2020-09-10'),
(1, 2, 'belos desenhos ^^', '2020-09-10'),
(3, 1, 'oi ^^ ', '2020-09-10'),
(3, 1, 'olá', '2020-03-10'),
(4, 2, 'olá ^^ ', '2019-09-10'),
(1, 2, 'aaaaaaaaaaa', '2019-09-10'),
(1, 2, ':P', '2019-09-10'),
(1, 3, 'oi', '2019-09-10'),
(1, 4, ':v', '2019-09-10'),
(2, 1, 'aaaaaaaaaa', '2019-09-10'),
(5, 2, 'teste', '2020-12-12'),
(2, 5, 'cade a M16????', '2020-12-12');

-- --------------------------------------------------------

--
-- Estrutura da tabela `pagamento`
--

DROP TABLE IF EXISTS `pagamento`;
CREATE TABLE IF NOT EXISTS `pagamento` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `pagamento`
--

INSERT INTO `pagamento` (`descricao`) VALUES
('Boleto'),
('Cartão de Crédito'),
('PayPal');

-- --------------------------------------------------------

--
-- Estrutura da tabela `pagina`
--

DROP TABLE IF EXISTS `pagina`;
CREATE TABLE IF NOT EXISTS `pagina` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `controller` varchar(50) NOT NULL,
  `metodo` varchar(50) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `description` varchar(200) NOT NULL,
  `author` varchar(100) NOT NULL,
  `tp_pagina_id` int(11) NOT NULL,
  `robots_id` int(11) NOT NULL,
  `data_criacao` datetime NOT NULL,
  `data_modificacao` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `pagina`
--

INSERT INTO `pagina` (`controller`, `metodo`, `nome`, `description`, `author`, `tp_pagina_id`, `robots_id`, `data_criacao`, `data_modificacao`) VALUES
('Auth', 'auth', 'Página Login', 'Exibe a página de login do projeto', 'LG', 1, 1, '2019-05-24 00:00:00', NULL),
('Auth', 'logout', 'Página Login', 'Exibe a página de login do projeto', 'LG', 1, 1, '2019-05-24 00:00:00', NULL),
('Cadastro', 'index', 'Página Cadastro', 'Exibe a página de cadastro do projeto', 'LG', 1, 1, '2019-05-24 00:00:00', NULL),
('Error404', 'index', 'Página de Erro', 'Exibe a página de erro do projeto', 'LG', 1, 1, '2019-05-24 00:00:00', NULL),
('Eventos', 'index', 'Página Eventos', 'Exibe a página de eventos do projeto', 'LG', 1, 1, '2019-05-24 00:00:00', NULL),
('Eventos', 'addEvento', 'Página Eventos', 'Exibe a página de eventos do projeto', 'LG', 1, 1, '2019-05-24 00:00:00', NULL),
('Eventos', 'addEventoVerPriv', 'Página Eventos', 'Exibe a página de eventos do projeto', 'LG', 1, 1, '2019-05-24 00:00:00', NULL),
('Faq', 'index', 'Página Faq', 'Exibe a página faq do projeto', 'LG', 1, 1, '2019-05-24 00:00:00', NULL),
('Galeria', 'index', 'Página Galeria', 'Exibe a página de posts do projeto', 'LG', 1, 1, '2019-05-24 00:00:00', NULL),
('Galeria', 'visualizar', 'Página Galeria', 'Exibe a página de posts do projeto', 'LG', 1, 1, '2019-05-24 00:00:00', NULL),
('Galeria', 'listarPorTipo', 'Página Galeria', 'Exibe a página de posts do projeto', 'LG', 1, 1, '2019-05-24 00:00:00', NULL),
('Galeria', 'addPost', 'Página Galeria', 'Exibe a página de posts do projeto', 'LG', 1, 1, '2019-05-24 00:00:00', NULL),
('Galeria', 'addPostVerPriv', 'Página Galeria', 'Exibe a página de posts do projeto', 'LG', 1, 1, '2019-05-24 00:00:00', NULL),
('Graficas', 'index', 'Página Gráficas', 'Exibe a página das gráficas do projeto', 'LG', 1, 1, '2019-05-24 00:00:00', NULL),
('Home', 'index', 'Página Home', 'Exibe a página inicial do projeto', 'LG', 1, 1, '2019-05-24 00:00:00', NULL),
('Home', 'pesquisa', 'Página Home', 'Exibe a página inicial do projeto', 'LG', 1, 1, '2019-05-24 00:00:00', NULL),
('Loja', 'index', 'Página Loja', 'Exibe a página de loja do projeto', 'LG', 1, 1, '2019-05-24 00:00:00', NULL),
('Loja', 'visualizar', 'Página Loja', 'Exibe a página de loja do projeto', 'LG', 1, 1, '2019-05-24 00:00:00', NULL),
('Loja', 'listarPorTipo', 'Página Loja', 'Exibe a página de loja do projeto', 'LG', 1, 1, '2019-05-24 00:00:00', NULL),
('Loja', 'indexCart', 'Página Carrinho', 'Exibe a página de carrinho do projeto', 'LG', 1, 1, '2019-05-24 00:00:00', NULL),
('Loja', 'addProd', 'Página Carrinho', 'Exibe a página de carrinho do projeto', 'LG', 1, 1, '2019-05-24 00:00:00', NULL),
('Loja', 'addProduto', 'Página Loja', 'Exibe a página de loja do projeto', 'LG', 1, 1, '2019-05-24 00:00:00', NULL),
('Loja', 'addProdVerPriv', 'Página Loja', 'Exibe a página de loja do projeto', 'LG', 1, 1, '2019-05-24 00:00:00', NULL),
('Loja', 'checkout', 'Página Checkout', 'Exibe a página de checkout do projeto', 'LG', 1, 1, '2019-05-24 00:00:00', NULL),
('Loja', 'delProd', 'Página Carrinho', 'Exibe a página de carrinho do projeto', 'LG', 1, 1, '2019-05-24 00:00:00', NULL),
('Loja', 'pesquisaPrecoPrazo', 'Página Checkout', 'Exibe a página de checkout do projeto', 'LG', 1, 1, '2019-05-24 00:00:00', NULL),
('QuemSomos', 'index', 'Página Quem Somos', 'Exibe a página quem somos do projeto', 'LG', 1, 1, '2019-05-24 00:00:00', NULL),
('User', 'visualizar', 'Página Usuário', 'Exibe a página de usuário do projeto', 'LG', 1, 1, '2019-05-24 00:00:00', NULL),
('User', 'upUserPriv', 'Página Usuário', 'Exibe a página de usuário do projeto', 'LG', 1, 1, '2019-05-24 00:00:00', NULL),
('User', 'upUserViewPriv', 'Página Usuário', 'Exibe a página de usuário do projeto', 'LG', 1, 1, '2019-05-24 00:00:00', NULL),
('User', 'upUser', 'Página Usuário', 'Exibe a página de usuário do projeto', 'LG', 1, 1, '2019-05-24 00:00:00', NULL),
('AdmEvento', 'index', 'Página Eventos', 'Exibe a página de eventos do projeto', 'LG', 2, 1, '2019-05-24 00:00:00', NULL),
('AdmEvento', 'delEvento', 'Página Eventos', 'Exibe a página de eventos do projeto', 'LG', 2, 1, '2019-05-24 00:00:00', NULL),
('AdmEvento', 'moreEvento', 'Página Eventos', 'Exibe a página de eventos do projeto', 'LG', 2, 1, '2019-05-24 00:00:00', NULL),
('AdmGrafica', 'index', 'Página Gráficas', 'Exibe a página das gráficas do projeto', 'LG', 2, 1, '2019-05-24 00:00:00', NULL),
('AdmGrafica', 'delGrafica', 'Página Gráficas', 'Exibe a página das gráficas do projeto', 'LG', 2, 1, '2019-05-24 00:00:00', NULL),
('AdmGrafica', 'moreGrafica', 'Página Gráficas', 'Exibe a página das gráficas do projeto', 'LG', 2, 1, '2019-05-24 00:00:00', NULL),
('AdmGrafica', 'addGrafica', 'Página Gráficas', 'Exibe a página das gráficas do projeto', 'LG', 2, 1, '2019-05-24 00:00:00', NULL),
('AdmHome', 'index', 'Página Home', 'Exibe a página principal do projeto', 'LG', 2, 1, '2019-05-24 00:00:00', NULL),
('AdmPost', 'index', 'Página Posts', 'Exibe a página de posts do projeto', 'LG', 2, 1, '2019-05-24 00:00:00', NULL),
('AdmPost', 'delPost', 'Página Posts', 'Exibe a página de posts do projeto', 'LG', 2, 1, '2019-05-24 00:00:00', NULL),
('AdmPost', 'morePost', 'Página Posts', 'Exibe a página de posts do projeto', 'LG', 2, 1, '2019-05-24 00:00:00', NULL),
('AdmProdutos', 'index', 'Página Produtos', 'Exibe a página de produtos do projeto', 'LG', 2, 1, '2019-05-24 00:00:00', NULL),
('AdmProdutos', 'delProduto', 'Página Produtos', 'Exibe a página de produtos do projeto', 'LG', 2, 1, '2019-05-24 00:00:00', NULL),
('AdmProdutos', 'moreProduto', 'Página Produtos', 'Exibe a página de produtos do projeto', 'LG', 2, 1, '2019-05-24 00:00:00', NULL),
('AdmUser', 'index', 'Página Usuários', 'Exibe a página de usuários do projeto', 'LG', 2, 1, '2019-05-24 00:00:00', NULL),
('AdmUser', 'delUser', 'Página Usuários', 'Exibe a página de usuários do projeto', 'LG', 2, 1, '2019-05-24 00:00:00', NULL),
('AdmUser', 'moreUser', 'Página Usuários', 'Exibe a página de usuários do projeto', 'LG', 2, 1, '2019-05-24 00:00:00', NULL),
('AdmUser', 'delPedido', 'Página Usuários', 'Exibe a página de usuários do projeto', 'LG', 2, 1, '2019-05-24 00:00:00', NULL),
('AdmUser', 'morePedido', 'Página Usuários', 'Exibe a página de usuários do projeto', 'LG', 2, 1, '2019-05-24 00:00:00', NULL),
('AdmUser', 'pedidos', 'Página Usuários', 'Exibe a página de usuários do projeto', 'LG', 2, 1, '2019-05-24 00:00:00', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `post`
--

DROP TABLE IF EXISTS `post`;
CREATE TABLE IF NOT EXISTS `post` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(50) NOT NULL,
  `descricao` varchar(200) NOT NULL,
  `imagem` varchar(100) NOT NULL,
  `usuario` int(11) NOT NULL,
  `tipo_arte` int(11) NOT NULL,
  `data_criacao` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `post`
--

INSERT INTO `post` (`titulo`, `descricao`, `imagem`, `usuario`, `tipo_arte`, `data_criacao`) VALUES
('Post 1', 'Descrição do Post', 'imagem01.jpg', 1, 1, '2019-05-17 00:05:45'),
('Post 2', 'Descrição do Post', 'imagem02.jpg', 1, 1, '2019-05-16 00:05:45'),
('Post 3', 'Descrição do Post', 'imagem03.jpg', 2, 4, '2019-05-18 00:05:45'),
('Post 4', 'Descrição do Post', 'imagem04.jpg', 1, 2, '2019-05-15 00:05:45'),
('Post 5', 'Descrição do Post', 'imagem05.jpg', 1, 4, '2019-05-19 00:05:45'),
('Post 6', 'Descrição do Post', 'imagem05.jpg', 2, 2, '2019-05-17 00:05:45'),
('Post 7', 'Descrição do Post', 'imagem01.jpg', 2, 1, '2019-02-17 00:05:45'),
('Post 8', 'Descrição do Post', 'imagem02.jpg', 1, 3, '2019-03-17 00:05:45'),
('Post 9', 'Descrição do Post', 'imagem03.jpg', 2, 3, '2019-02-17 00:05:45'),
('Post 10', 'Descrição do Post', 'imagem04.jpg', 2, 4, '2019-05-17 00:05:45'),
('Post 11', 'Descrição do Post', 'imagem05.jpg', 1, 3, '2019-02-14 00:05:45'),
('Post 12', 'Descrição do Post', 'imagem01.jpg', 2, 3, '2019-03-18 00:05:45'),
('Post 13', 'Descrição do Post', 'imagem02.jpg', 1, 2, '2019-01-17 00:05:45'),
('Post 14', 'Descrição do Post', 'imagem03.jpg', 1, 2, '2019-03-17 00:05:45'),
('Post 15', 'Descrição do Post', 'imagem04.jpg', 2, 2, '2019-02-17 00:05:45'),
('Post 16', 'Descrição do Post', 'imagem05.jpg', 2, 1, '2019-02-17 00:05:45'),
('Post 17', 'Descrição do Post', 'imagem05.jpg', 2, 4, '2019-02-17 00:05:45'),
('Post 18', 'Descrição do Post', 'imagem05.jpg', 2, 1, '2019-02-17 00:05:45'),
('Post 19', 'Descrição do Post', 'imagem03.jpg', 1, 3, '2019-03-17 00:05:45'),
('Post 20', 'Descrição do Post', 'imagem03.jpg', 1, 4, '2019-03-17 00:05:45');

-- --------------------------------------------------------

--
-- Estrutura da tabela `produto`
--

DROP TABLE IF EXISTS `produto`;
CREATE TABLE IF NOT EXISTS `produto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tipo_produto` int(11) NOT NULL,
  `tipo_arte` int(11) NOT NULL,
  `usuario` int(11) NOT NULL,
  `titulo` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `descricao` varchar(300) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `preco` float NOT NULL,
  `imagem` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `data_criacao` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `produto`
--

INSERT INTO `produto` (`tipo_produto`, `tipo_arte`, `usuario`, `titulo`, `descricao`, `preco`, `imagem`, `data_criacao`) VALUES
(1, 4, 1, 'Botton Love Live! Aqours', 'Botton Love Live! Aqours - Chika Takami<br/>\r\nTamanho: 5,5 x 5,5</br>\r\nMaterial: metal</br>\r\nSet Valentine\'s Day', 4, 'produto01.png', '2019-05-16'),
(2, 4, 2, 'Caneca Anime – Love Live!', 'Capacidade de 325ml</br>\r\nMedida: 10 x 8cm', 25, 'produto02.png', '2019-05-17'),
(1, 4, 2, 'Chaveiro estilo anime', 'Chaveiro de acrílico estilo anime frente e verso.', 10, 'produto03.png', '2019-05-18'),
(2, 4, 2, 'Chaveiro de acrílico Violet Evergarden', 'Chaveiro de acrílico Violet Evergarden frente e verso.', 10, 'produto04.png', '2019-05-18');

-- --------------------------------------------------------

--
-- Estrutura da tabela `quem_somos`
--

DROP TABLE IF EXISTS `quem_somos`;
CREATE TABLE IF NOT EXISTS `quem_somos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(250) NOT NULL,
  `descricao` text NOT NULL,
  `imagem` varchar(220) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `quem_somos`
--

INSERT INTO `quem_somos` (`titulo`, `descricao`, `imagem`) VALUES
('Sobre o Site', 'Bem vindo ao <b>brinsp</b>! O intuito do site é que você, artista iniciante - ou não - tenha um lugar especial onde possa interagir com outras pessoas, às vezes até mais experientes e assim crescer como artista, além de ter a oportunidade de mostrar ao mundo o que você sabe fazer de melhor: <b>ARTE</b>! Nunca desista do que você realmente gosta de fazer. Esperamos que goste do site e boa sorte.', 'pincel.png'),
('Fundadores', 'Olá, sou a Livia e cuido da parte \"física\" do site (programação e tal). Estou envolvida com arte desde criança mas só recentemente o meu interesse por essa área se tornou maior. Espero que goste do site!\r\n', 'fundadores.jpg'),
('Fundadores', 'Oi, sou a Jhennifer e cuido da publicidade e divulgação do site. Gosto bastante de assistir séries e ler livros. Espero que você tenha uma experiência agradável com o site!\r\n', 'aaaa.png');

-- --------------------------------------------------------

--
-- Estrutura da tabela `robots`
--

DROP TABLE IF EXISTS `robots`;
CREATE TABLE IF NOT EXISTS `robots` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(150) NOT NULL,
  `tipo` varchar(100) NOT NULL,
  `data_criacao` datetime NOT NULL,
  `data_modificacao` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `robots`
--

INSERT INTO `robots` (`nome`, `tipo`, `data_criacao`, `data_modificacao`) VALUES
('Indexar a página e seguir os links', 'index,follow', '2019-05-16 00:00:00', NULL),
('Não indexar a página, mas seguir os links', 'noindex,follow', '2019-05-16 00:00:00', NULL),
('Indexar a página, mas não seguir os links', 'index,nofollow', '2019-05-17 00:00:00', NULL),
('Não indexar a página e nem seguir os links', 'noindex,nofollow', '2019-05-17 00:00:00', NULL),
('Não exibir a versão em cache da página', 'noarchive', '2019-05-17 00:00:00', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tipo_arte`
--

DROP TABLE IF EXISTS `tipo_arte`;
CREATE TABLE IF NOT EXISTS `tipo_arte` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tipo_arte`
--

INSERT INTO `tipo_arte` (`descricao`) VALUES
('Tradicional'),
('Digital'),
('Artesanato'),
('Outros');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tipo_pagina`
--

DROP TABLE IF EXISTS `tipo_pagina`;
CREATE TABLE IF NOT EXISTS `tipo_pagina` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tipo` varchar(100) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `obs` varchar(150) NOT NULL,
  `ordem` int(11) NOT NULL,
  `data_criacao` datetime NOT NULL,
  `data_modificacao` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tipo_pagina`
--

INSERT INTO `tipo_pagina` (`tipo`, `nome`, `obs`, `ordem`, `data_criacao`, `data_modificacao`) VALUES
('site', 'Site principal', 'Site principal do projeto', 1, '2019-05-17 00:00:00', NULL),
('adm', 'Área administrativa', 'Área administrativa do projeto', 2, '2019-05-17 00:00:00', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tipo_produto`
--

DROP TABLE IF EXISTS `tipo_produto`;
CREATE TABLE IF NOT EXISTS `tipo_produto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tipo_produto`
--

INSERT INTO `tipo_produto` (`descricao`) VALUES
('Físico'),
('Digital');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

DROP TABLE IF EXISTS `usuario`;
CREATE TABLE IF NOT EXISTS `usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(30) NOT NULL,
  `email` varchar(60) NOT NULL,
  `senha` varchar(250) NOT NULL,
  `imagem` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `bio` varchar(400) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `data_criacao` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`nome`, `email`, `senha`, `imagem`, `bio`, `data_criacao`) VALUES
('abcde', 'avil5@gmail.com', '$2y$10$FcwtK0adwJ.2TMqt7SG/mefDhk8UfX7WYB2otND78/vFvrDNQgetG', 'desecnho.png', 'aaaaaaaaaaa', '2019-09-03 00:43:59'),
('BATATAFRITA', 'livia@gmail.com', '$2y$10$FcwtK0adwJ.2TMqt7SG/mefDhk8UfX7WYB2otND78/vFvrDNQgetG', 'mokkochi-finalizado.png', '~ Acredite no seu coração! Essa é a sua magia!', '2019-09-03 13:23:28'),
('Angel', 'amora@gmail.com', '$2y$10$xg5nWW2Gj9ndqD66v/1gG.wMLig1A9yd4Jz5qS7hm6/wvVt2dEGI6', 'guardia-busto.png', 'Olá ^^', '2019-10-02 00:45:12'),
('May', 'batata@gmail.com', '$2y$10$Y6PGX1Ze2qiF/dTUXtk9IeotTrt/XLKKaHvvxOO42JTHdmDV9QTkC', 'd.png', 'aaaaaaaaaaaaaaaaaaaaaaa', '2019-10-02 13:34:51'),
('M4A1', 'gf@gmail.com', '$2y$10$QxiEHDUU7f3TPBnTJ0R.NOiW5WoQA5iItuAawrgpBjamthqCrYNP.', '55-d.png', 'oi', '2019-10-28 18:28:30');


ALTER TABLE `compra` ADD CONSTRAINT `fk_compra_pagamento` FOREIGN KEY (`pagamento`) REFERENCES `pagamento` (`id`);

ALTER TABLE `evento` ADD CONSTRAINT `fk_evento_usuario` FOREIGN KEY (`usuario`) REFERENCES `usuario` (`id`);

ALTER TABLE `mensagem` ADD CONSTRAINT `fk_mensagem_remetente` FOREIGN KEY (`remetente`) REFERENCES `usuario` (`id`);
ALTER TABLE `mensagem` ADD CONSTRAINT `fk_mensagem_destinatario` FOREIGN KEY (`destinatario`) REFERENCES `usuario` (`id`);

ALTER TABLE `pagina` ADD CONSTRAINT `fk_pagina_tp_pagina` FOREIGN KEY (`tp_pagina_id`) REFERENCES `tipo_pagina` (`id`);
ALTER TABLE `pagina` ADD CONSTRAINT `fk_pagina_robots` FOREIGN KEY (`robots_id`) REFERENCES `robots` (`id`);

ALTER TABLE `post` ADD CONSTRAINT `fk_post_usuario` FOREIGN KEY (`usuario`) REFERENCES `usuario` (`id`);
ALTER TABLE `post` ADD CONSTRAINT `fk_post_tp_arte` FOREIGN KEY (`tipo_arte`) REFERENCES `tipo_arte` (`id`);

ALTER TABLE `produto` ADD CONSTRAINT `fk_produto_tp_produto` FOREIGN KEY (`tipo_produto`) REFERENCES `tipo_produto` (`id`);
ALTER TABLE `produto` ADD CONSTRAINT `fk_produto_tp_arte` FOREIGN KEY (`tipo_arte`) REFERENCES `tipo_arte` (`id`);
ALTER TABLE `produto` ADD CONSTRAINT `fk_produto_usuario` FOREIGN KEY (`usuario`) REFERENCES `usuario` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
