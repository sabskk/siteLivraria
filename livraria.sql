-- phpMyAdmin SQL Dump
-- version 3.4.9
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tempo de Geração: 19/05/2025 às 22h16min
-- Versão do Servidor: 5.5.20
-- Versão do PHP: 5.3.9

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Banco de Dados: `livraria`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `autor`
--

CREATE TABLE IF NOT EXISTS `autor` (
  `codigo` int(5) NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL,
  `pais` varchar(10) NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Extraindo dados da tabela `autor`
--

INSERT INTO `autor` (`codigo`, `nome`, `pais`) VALUES
(1, 'Antoine de Saint-ExupÃ©ry', 'FranÃ§a'),
(2, 'Neil Gaiman', 'Reino Unid'),
(3, 'Nita Prose', 'CanadÃ¡'),
(4, 'Stephen Chbosky', 'Estados Un'),
(5, 'Jean-Paul Sartre', 'FranÃ§a'),
(6, 'Pedro "Rezende" Posso', 'Brasil'),
(7, 'Felipe Neto', 'Brasil'),
(8, 'George Orwell', 'Reino Unid'),
(9, 'Miguel de Cervantes', 'Espanha');

-- --------------------------------------------------------

--
-- Estrutura da tabela `categoria`
--

CREATE TABLE IF NOT EXISTS `categoria` (
  `codigo` int(5) NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Extraindo dados da tabela `categoria`
--

INSERT INTO `categoria` (`codigo`, `nome`) VALUES
(1, 'Fantasia'),
(2, 'Terror'),
(3, 'MistÃ©rio'),
(4, 'FicÃ§Ã£o'),
(5, 'Filosofia'),
(6, 'FicÃ§Ã£o CientÃ­fica'),
(7, 'Literatura');

-- --------------------------------------------------------

--
-- Estrutura da tabela `editora`
--

CREATE TABLE IF NOT EXISTS `editora` (
  `codigo` int(5) NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Extraindo dados da tabela `editora`
--

INSERT INTO `editora` (`codigo`, `nome`) VALUES
(1, 'HarperCollins'),
(2, 'IntrÃ­nseca'),
(3, 'Rocco'),
(4, 'Vozes'),
(5, 'Suma'),
(6, 'Coquetel'),
(7, 'Companhia das Letras'),
(8, 'L&PM');

-- --------------------------------------------------------

--
-- Estrutura da tabela `livro`
--

CREATE TABLE IF NOT EXISTS `livro` (
  `codigo` int(5) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(150) NOT NULL,
  `nrpaginas` int(4) NOT NULL,
  `ano` int(4) NOT NULL,
  `codautor` int(5) NOT NULL,
  `codcategoria` int(5) NOT NULL,
  `codeditora` int(5) NOT NULL,
  `resenha` text NOT NULL,
  `preco` float(6,2) NOT NULL,
  `fotocapa1` varchar(100) NOT NULL,
  `fotocapa2` varchar(105) NOT NULL,
  PRIMARY KEY (`codigo`),
  KEY `codautor` (`codautor`),
  KEY `codcategoria` (`codcategoria`),
  KEY `codeditora` (`codeditora`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Extraindo dados da tabela `livro`
--

INSERT INTO `livro` (`codigo`, `titulo`, `nrpaginas`, `ano`, `codautor`, `codcategoria`, `codeditora`, `resenha`, `preco`, `fotocapa1`, `fotocapa2`) VALUES
(1, 'Coraline', 224, 2020, 2, 2, 2, 'Certas portas nÃ£o devem ser abertas. E Coraline descobre isso pouco tempo depois de chegar com os pais Ã  sua nova casa, um apartamento em um casarÃ£o antigo ocupado por vizinhos excÃªntricos e envolto por uma nÃ©voa insistente, um mundo de estranhezas e magia, o tipo de universo que apenas Neil Gaiman pode criar.  Ao abrir uma porta misteriosa na sala de casa, a menina se depara com um lugar macabro e fascinante. Ali, naquele outro mundo, seus outros pais sÃ£o criaturas muito pÃ¡lidas, com botÃµes negros no lugar dos olhos, sempre dispostos a lhe dar atenÃ§Ã£o, fazer suas comidas preferidas e mostrar os brinquedos mais divertidos. Coraline enfim se sente... em casa. Mas essa sensaÃ§Ã£o logo desaparece, quando ela descobre que o lugar guarda mistÃ©rios e perigos, e a menina se dÃ¡ conta de que voltar para sua verdadeira casa vai ser muito mais difÃ­cil â€• e assustador â€• do que imaginava.', 39.84, '40c7d26e3146886919525a10fc552ef2', 'ca8c34dc63185b943668c882ae3aae83'),
(2, 'O Pequeno PrÃ­ncipe', 96, 2018, 1, 1, 1, 'Nesta histÃ³ria que marcou geraÃ§Ãµes de leitores em todo o mundo, um piloto cai com seu aviÃ£o no deserto do Saara e encontra um pequeno prÃ­ncipe, que o leva a uma aventura filosÃ³fica e poÃ©tica atravÃ©s de planetas que encerram a solidÃ£o humana.  Um livro para todos os pÃºblicos, O pequeno prÃ­ncipe Ã© uma obra atemporal, com metÃ¡foras pertinentes e aprendizados sobre afeto, sonhos, esperanÃ§a e tudo aquilo que Ã© invisÃ­vel aos olhos. ', 15.33, '7bf399ed6266e437a5ffd937946e81ab', 'af4af750404b41daad68977e9ea2dedf'),
(3, 'A Camareira', 336, 2022, 3, 3, 2, 'Molly Gray tem dificuldade com interaÃ§Ãµes sociais. Aos 25 anos, a jovem muitas vezes entende errado as intenÃ§Ãµes das outras pessoas, e sua avÃ³ costumava interpretar o mundo para ela, criando regras simples segundo as quais a neta poderia viver.  Desde que a avÃ³ morreu, nove meses atrÃ¡s, Molly tem navegado sozinha pelas complexidades da vida. Sua Ãºnica alegria Ã© ainda poder se dedicar com prazer ao emprego e realizar um trabalho impecÃ¡vel. Camareira do sofisticado Hotel Regency Grand, tem um amor obsessivo por limpeza e organizaÃ§Ã£o, o que a torna a pessoa ideal para o cargo.  Certo dia, ao entrar na suÃ­te do infame e riquÃ­ssimo Charles Black, a vida organizada de Molly vira de cabeÃ§a para baixo: alÃ©m de encontrar os cÃ´modos em completa desordem, a jovem se depara com nada menos que o prÃ³prio Sr. Black morto na cama. Antes mesmo que entenda o que estÃ¡ acontecendo, no entanto, seu comportamento incomum levanta suspeitas da polÃ­cia, e a camareira, acostumada a passar despercebida, logo se vÃª presa em uma teia de mentiras e mal-entendidos que nÃ£o faz ideia de como desfazer. Felizmente para Molly, amigos que ela nunca soube que tinha se unem em busca de pistas sobre o que realmente aconteceu com o Sr. Black. Mas eles serÃ£o capazes de encontrar o assassino antes que seja tarde demais?', 32.25, '4ad39961feb645375dc7c4280fcad83b', '6f5e0dc56281aac73331cffc50c152be'),
(4, 'As Vantagens de Ser InvisÃ­vel', 288, 2021, 4, 4, 3, 'Manter-se Ã  margem oferece uma Ãºnica e passiva perspectiva. Mas, de uma hora para outra, sempre chega o momento de encarar a vida do centro dos holofotes.  Mais Ã­ntimas do que um diÃ¡rio, as cartas de Charlie sÃ£o estranhas e Ãºnicas, hilÃ¡rias e devastadoras. NÃ£o se sabe onde ele mora. NÃ£o se sabe para quem ele escreve. Tudo o que se conhece Ã© o mundo que ele compartilha com o leitor. Estar encurralado entre o desejo de viver sua vida e fugir dela o coloca num novo caminho atravÃ©s de um territÃ³rio inexplorado. Um mundo de primeiros encontros amorosos, dramas familiares e novos amigos. Um mundo de sexo, drogas e rockâ€™nâ€™roll, quando o que todo mundo quer Ã© aquela mÃºsica certa que provoca o impulso perfeito para se sentir infinito.', 35.00, '328b597ea074a92ec9cc28e431e51668', 'e36a166ca3abc732cd84caac2666d043'),
(5, 'Dois Mundos, Um HerÃ³i: Uma Aventura nÃ£o Oficial de Minecraft', 144, 2015, 6, 6, 5, 'Rezende, Ã© louco por videogames e se dedica a produzir vÃ­deos para a internet sobre seu jogo favorito: Minecraft. Um de seus maiores orgulhos Ã© o vilarejo virtual que construiu por lÃ¡. Rezende passa tanto tempo no computador que Ã© quase como se morasse em sua criaÃ§Ã£o. Mas e se um dia isso se tornasse possÃ­vel? Dois mundos, um herÃ³i Ã© uma aventura fantÃ¡stica que leva vocÃª para dentro do universo de Minecraft na companhia de RezendeEvil. O susto de acordar do outro lado da tela Ã© grande, mas a diversÃ£o Ã© ainda maior. Nesse mundo de pixels ele encontra todos os pequenos amigos que criou: inclusive uma versÃ£o de si mesmo. E quando um terrÃ­vel mal ameaÃ§a destruir o vilarejo, Rezende se torna a Ãºnica esperanÃ§a. Usando sua criatividade, nosso herÃ³i vai ter que enfrentar com as prÃ³prias mÃ£os os inimigos que estava acostumado a vencer com o teclado e o mouse.', 12.50, '2d17579cb6c2cb6c1db8792907190e65', 'c695a5459662f5d47566777a9301a4ef'),
(6, 'Felipe Neto: A TrajetÃ³ria de um dos maiores Youtubers do Brasil', 64, 2017, 7, 7, 6, '"Do anonimato ao sucesso, Felipe Neto batalhou, e muito, para conquistar toda a fama que tem hoje. A explosÃ£o do youtuber nÃ£o se deu do dia para a noite, ao contrÃ¡rio, exigiu muita dedicaÃ§Ã£o e amadurecimento ao longo de sua caminhada. Pela primeira vez, Felipe decidiu abrir a sua vida para os fÃ£s e topou contar toda a sua histÃ³ria por trÃ¡s das cÃ¢meras. Esta ediÃ§Ã£o traz a trajetÃ³ria e muitas curiosidades sobre um dos maiores influenciadores da internet, alÃ©m dos novos projetos, jogos, papertoys, carteirinha de fÃ£ e muitos pÃ´steres. Tudo isso em uma publicaÃ§Ã£o feita especialmente para milhÃµes de corujas espalhadas por todo o mundo! Vai perder esse rebuliÃ§o? Para ativar o suporte para leitor de tela, pressione Ctrl+Alt+Z Para saber mais sobre atalhos de teclado, pressione Ctrl+barra "', 24.90, '333c7ec37d7bc09bd44feabc51ef5f0d', '85d5bf75ab545e795a24cc9e31919599'),
(7, 'Existencialismo Ã© um Humanismo', 64, 2014, 5, 5, 4, 'O existencialismo Ã© um humanismo Ã© um texto circunstancial no percurso intelectual de Sartre. Ele antecede um novo ciclo em sua investigaÃ§Ã£o filosÃ³fica. As objeÃ§Ãµes Ã  sua obra, que ele procura inventariar nessa conferÃªncia, por mais confusas e hostis que sejam, provocarÃ£o novas questÃµes que serÃ£o tratadas mais tarde, apÃ³s um livre amadurecimento, testemunhado, entre outras coisas, por seus escritos pÃ³stumos.', 15.90, '18f647d32263eef8735459c9f1312805', '2088cb94dcb3fad9131c31fb6a968ac9'),
(8, 'A revoluÃ§Ã£o dos bichos: Um conto de fadas', 152, 2007, 8, 4, 7, 'Verdadeiro clÃ¡ssico moderno, concebido por um dos mais influentes escritores do sÃ©culo XX, A revoluÃ§Ã£o dos bichos Ã© uma fÃ¡bula sobre o poder. Narra a insurreiÃ§Ã£o dos animais de uma granja contra seus donos. Progressivamente, porÃ©m, a revoluÃ§Ã£o degenera numa tirania ainda mais opressiva que a dos humanos.', 34.90, '690ca6f3ae9240691ee99cd2206a589b', 'd8de26115160608ac34fd4369a0e791b'),
(9, 'Dom Quixote', 64, 2007, 9, 4, 8, 'De tanto ler antigos livros de cavalaria, o pacato Alonso Quijano perde o juÃ­zo e resolve levar a vida de um cavaleiro andante. Depois de equipar-se com a velha armadura herdada dos bisavÃ³s e de fazer-se ordenar por um estalajadeiro, transforma-se no mui afamado Dom Quixote de La Mancha. Na companhia do cavalo Rocinante e do fiel escudeiro Sancho PanÃ§a, sai mundo afora em busca de aventuras. Pelo caminho, o engenhoso fidalgo encontra uma caravana de beneditinos, uma procissÃ£o de penitentes e os famosos moinhos de vento - porÃ©m a sede de aventuras, agravada pela sandice, leva-o a ver bruxos, fantasmas e hordas de gigantes.', 59.90, 'e69bfdab3e3c22162fe157f5ba3b4b50', 'e738d62e763f38368599a60546b3a770'),
(10, '1984', 416, 2009, 8, 4, 7, 'Publicada originalmente em 1949, a distopia futurista 1984 Ã© um dos romances mais influentes do sÃ©culo XX, um inquestionÃ¡vel clÃ¡ssico moderno. LanÃ§ada poucos meses antes da morte do autor, Ã© uma obra magistral que ainda se impÃµe como uma poderosa reflexÃ£o ficcional sobre a essÃªncia nefasta de qualquer forma de poder totalitÃ¡rio.', 39.90, '39dd48a6a610ea5e8c29078b41a1570d', '037fc815b80bb4294a317132baf0f4f0');

--
-- Restrições para as tabelas dumpadas
--

--
-- Restrições para a tabela `livro`
--
ALTER TABLE `livro`
  ADD CONSTRAINT `livro_ibfk_1` FOREIGN KEY (`codautor`) REFERENCES `autor` (`codigo`),
  ADD CONSTRAINT `livro_ibfk_2` FOREIGN KEY (`codcategoria`) REFERENCES `categoria` (`codigo`),
  ADD CONSTRAINT `livro_ibfk_3` FOREIGN KEY (`codeditora`) REFERENCES `editora` (`codigo`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
