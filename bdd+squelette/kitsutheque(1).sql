-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : lun. 27 mars 2023 à 08:16
-- Version du serveur : 5.7.36
-- Version de PHP : 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `kitsutheque`
--

-- --------------------------------------------------------

--
-- Structure de la table `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `slug` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `category`
--

INSERT INTO `category` (`id`, `name`, `slug`) VALUES
(1, 'Action', 'action'),
(2, 'Aventure', 'aventure'),
(3, 'Romance', 'romance'),
(4, 'Science-fiction', 'science-fiction'),
(5, 'Comédie', 'comedie'),
(6, 'Drame', 'drame'),
(7, 'Fantastique', 'fantastique'),
(8, 'Horreur', 'horreur'),
(9, 'Mystère', 'mystere'),
(10, 'School Life', 'school life'),
(11, 'Tranche de vie ', 'tranche de vie'),
(12, 'Sport', 'sport'),
(13, 'Surnaturel', 'surnaturel');

-- --------------------------------------------------------

--
-- Structure de la table `genre`
--

DROP TABLE IF EXISTS `genre`;
CREATE TABLE IF NOT EXISTS `genre` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `slug` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `genre`
--

INSERT INTO `genre` (`id`, `name`, `slug`) VALUES
(1, 'Shonen', 'shonen'),
(2, 'Shojo', 'shojo'),
(3, 'Seinen', 'seinen'),
(4, 'Josei', 'josei'),
(5, 'Kodomo', 'kodomo'),
(6, 'Mecha', 'mecha');

-- --------------------------------------------------------

--
-- Structure de la table `loan`
--

DROP TABLE IF EXISTS `loan`;
CREATE TABLE IF NOT EXISTS `loan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_manga` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `loan_date` date NOT NULL,
  `return_date` date DEFAULT NULL,
  `available` tinyint(1) NOT NULL,
  `reservation_loan` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `MANGA` (`id_manga`),
  KEY `USER` (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=63 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `loan`
--

INSERT INTO `loan` (`id`, `id_manga`, `id_user`, `loan_date`, `return_date`, `available`, `reservation_loan`) VALUES
(55, 65, 4, '2023-03-23', '2023-04-20', 1, NULL),
(56, 51, 4, '2023-03-23', '2023-04-20', 1, NULL),
(57, 40, 4, '2023-03-23', '2023-04-20', 1, NULL),
(59, 56, 4, '2023-03-23', '2023-03-01', 1, NULL),
(60, 53, 4, '2023-03-23', '2023-03-01', 1, NULL),
(61, 3, 4, '2023-03-23', '2023-03-01', 1, NULL),
(62, 55, 2, '2023-03-24', NULL, 1, '2023-03-25 01:29:40');

-- --------------------------------------------------------

--
-- Structure de la table `manga`
--

DROP TABLE IF EXISTS `manga`;
CREATE TABLE IF NOT EXISTS `manga` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_genre` int(11) NOT NULL,
  `id_public` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `volume` int(11) NOT NULL,
  `editor` varchar(50) NOT NULL,
  `published_at` date NOT NULL,
  `author` varchar(50) NOT NULL,
  `cover` varchar(150) NOT NULL,
  `extract` text NOT NULL,
  `bookshelf` varchar(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `GENRE` (`id_genre`),
  KEY `PUBLIC` (`id_public`)
) ENGINE=InnoDB AUTO_INCREMENT=67 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `manga`
--

INSERT INTO `manga` (`id`, `id_genre`, `id_public`, `title`, `volume`, `editor`, `published_at`, `author`, `cover`, `extract`, `bookshelf`) VALUES
(2, 1, 2, 'One Piece', 103, 'Glénat', '2022-12-07', 'Eiichirō Oda', 'one-piece-103.jpg', 'Sanji et Zoro ont enfin terminé leurs combats ! Seuls les empereurs résistent encore et donnent du fil à retordre à Luffy, Law et Kidd. C\'est alors que le capitaine des Chapeaux de Paille éveille son pouvoir, un exploit qui n\'avait pas été réalisé depuis le Siècle Manquant !', 'S2SH1'),
(3, 1, 2, 'One Piece', 102, 'Glénat', '2022-09-14', 'Eiichirō Oda', 'one-piece-102.jpg', 'Le roi des pirates, ce sera lui! Complètement rétabli, Luffy part de nouveau affronter Kaido! Quelle sera l\'issue de la bataille décisive entre ces deux incroyables adversaires ?! Pendant ce temps, en divers lieux de l\'île d\'Onigashima, les violents combats que mènent les camarades de Chapeau de paille contre les lieutenants de Kaido arrivent à leur terme. L\'arc du pays des Wa est à son apogée! Les aventures de Luffy à la poursuite du One Piece continuent!', 'S2SH1'),
(4, 1, 2, 'One Piece', 101, 'Glénat', '2022-05-04', 'Eiichirō Oda', 'one-piece-101.jpeg', 'Convaincus que Luffy va revenir sur le champ de bataille et vaincre Kaido, ses camarades poursuivent le combat contre les lieutenants de l\'équipage des cent bêtes ! Pendant ce temps, sur le dôme d\'Onigashima, Yamato tente de faire payer à son père tout ce qu\'il lui a fait subir !', 'S2SH1'),
(5, 1, 2, 'One Piece', 100, 'Glénat', '2021-12-08', 'Eiichirō Oda', 'one-piece-100.jpeg', 'Luffy et ses alliés défient Kaido et Big Mom au sommet du dôme où sont rassemblés les principaux acteurs de la bataille en cours ! Mais sont-ils seulement en mesure de vaincre ce duo surpuissant ?! Quel sort ce combat extrême réserve-t-il aux différents protagonistes ?!', 'S2SH1'),
(6, 1, 2, 'One Piece', 99, 'Glénat', '2021-09-15', 'Eiichirō Oda', 'one-piece-99.jpg', 'Tandis que ses camarades empêchent les lieutenants ennemis de le poursuivre, Luffy tente de rejoindre le sommet du dôme afin d\'y affronter Kaido! Maintenant que les acteurs sont en place, l\'affrontement final de la grande bataille d\'Onigashima peut enfin commencer... ', 'S2SH1'),
(7, 3, 1, 'Berserk', 1, ' Glénat', '2004-10-06', 'Kentarō Miura', 'berserk-1.jpg', 'Dans un monde médiéval et fantastique, erre un guerrier solitaire nommé Guts, décidé à être seul maître de son destin. Autrefois contraint par un pari perdu à rejoindre les Faucons, une troupe de mercenaires dirigés par Griffith, Guts fut acteur de nombreux combats sanglants et témoin de sombres intrigues politiques. Mais il réalisa soudain que la fatalité n\'existe pas et qu\'il pouvait reprendre sa liberté s\'il le désirait vraiment...', 'S1SE3'),
(8, 3, 1, 'Berserk', 2, ' Glénat', '2004-10-20', 'Kentarō Miura', 'berserk-2.jpg', 'Suite à l’altercation entre les hommes de main du Comte et Guts, notre héros et Puck l’elfe, trouvent refuge chez Vulgus, un ancien médecin. Cependant Zondarc, garde du Comte, a déjà retrouvé la trace du guerrier..', 'S1SE3'),
(9, 3, 1, 'Berserk', 3, ' Glénat', '2004-11-27', 'Kentarō Miura', 'berserk-3.jpg', 'Guts et Puck arrivent dans une ville où règne la terreur. Torturant ses citoyen, son seigneur est corrompu par le mal au point de se métamorphoser en monstre. Lors de leur affrontement, Guts est après tant d\'années sur le point de faire face aux God Hand. Pourquoi les poursuit-ils? Afin d\'éclaircir ce mystère, le récit prend un nouveau cours inattendu et retourne aux origines de Guts.', 'S1SE3'),
(10, 3, 1, 'Berserk', 4, 'Glénat', '2005-02-02', 'Kentarō Miura', 'berserk-4.jpg', 'Ayant poussé son premier cri sous la dépouille de sa mère, Guts est recueilli et élevé à la dure par Gambino, le chef d\'une troupe de mercenaires. Par delà la souffrance quotidienne, il devient le guerrier que l\'on connaît. Pour défier la méchanceté de Gambino, Guts développe sa technique de l\'épée et participe bellement à son premier siège en tant que mercenaire. Mais Gambino continue de le traiter durement. Dans la nuit, Donovan, un compagnon d\'arme de Gambino, attaque Guts!', 'S1SE3'),
(11, 3, 1, 'Berserk', 5, 'Glénat', '2005-02-23', 'Kentarō Miura', 'berserk-5.jpg', 'Du point de vue e Guts, Gambino, bien que cruel, était le premier humain à lui témoigner de l\'affection. Ayant tué ce dernier par erreur, il se retrouve seul au monde...', 'S1SE3'),
(12, 2, 2, 'Fruits Basket', 1, 'Delcourt', '2002-08-01', 'Takaya Natsuki', 'fruits-basket-1.jpg', 'Tohru, mignonne et courageuse lycéenne, vivait sous une tente dans les bois. Recueillie pour ses talents en matière de travaux ménagers par la famille de Yuki Sôma, un de ses camarades de classe, Tohru vit maintenant entourée de garçons dans une grande maison. Mais ce qu\'elle ignore, c\'est que la famille Sôma est victime d\'une malédiction secrête. Certains de ses membres se transforment, dans des circonstances particulières, en un des douzes animaux du zodiaque chinois ! Avec d\'aussi étranges personnages, la nouvelle vie de Tohru va lui réserver de nombreuses surprises.', 'S2SH2'),
(13, 2, 2, 'Fruits Basket', 2, 'Delcourt', '2002-10-18', 'Takaya Natsuki', 'fruits-basket-2.jpg', 'Tohru vit maintenant avec Yuki, Kyô et Shiguré Sôma, trois garçons qui ont la particularité de se transformer en l\'un des douze animaux du zodiaque chinois lorsqu\'une femme se jette dans leurs bras ou qu\'ils reçoivent un grand choc sur la tête. Un jour, à la fête culturelle du lycée, la jeune fille voit apparaître deux autres membres de cette famille mystérieuse. Mais ceux-ci sont beaucoup plus réservés sur l\'amitié qui unit la jeune fille à certaines des Sôma...', 'S2SH2'),
(14, 2, 2, 'Fruits Basket', 3, 'Delcourt', '2003-01-24', 'Takaya Natsuki', 'fruits-basket-3.jpg', 'Tohru vit à présent avec Yuri, Kyô et Shiguré Soma, trois garçons bien particuliers puisqu´ils se transforment bien malgré eux en l´un des douze animaux du zodiaque chinois. Au fil des jours, la jeune lycéenne intrépide fait connaissance avec le reste de cette bien étrange famille. Seulement les nouveaux membres ne sont pas aussi sociables que la jeune Tohru. Il lui faudra s´armer de courage et de ténacité pour pénétrer ces esprits farouches et en marge de la société.', 'S2SH2'),
(15, 2, 2, 'Fruits Basket', 4, 'Delcourt', '2003-03-15', 'Takaya Natsuki', 'fruits-basket-4.jpg', 'La vie au lycée s\'annonce tumultueuse : Momiji et Hatsuharu, deux autres garçons de la famille Sôma, rejoignent Tohru, Yuki et Kyô, qui ont réussi eux, à passer en deuxième année ! Mais lors de la fête de la rentrée, Akito, le chef de la famille Sôma, apparaît devant Tohru...', 'S2SH2'),
(16, 2, 2, 'Fruits Basket', 5, 'Delcourt', '2003-05-23', 'Takaya Natsuki', 'fruits-basket-5.jpg', 'A l\'initiative de Shiguré, Tohru a passé une semaine de vacances de printemps très agréable dans une des résidences secondaires de la famille Sôma, en compagnie de Yuki, Kyô et tous les autres. A la fin des vacances, un jour de pluie, Hatsuharu apparaît soudain, un gros paquet sous le bras... Que porte-t-il si précautionneusement ?', 'S2SH2'),
(17, 5, 3, 'Chi', 1, 'Glénat', '2010-11-17', 'Konami Kanata', 'chi-1.jpg', 'Que faire quand on est un mignon petit chaton et que d\'un coup, on se retrouve tout seul ?\r\nPleurer ? Ne rien faire ? Attendre ?\r\nNon, il y a plus drôle que ça : découvrir le monde !\r\nDu jardin public à la maison, des chaussures au vétérinaire, des balles rebondissantes aux plantes d\'appartement...\r\nLa vie de chat est pleine de joies et de surprises.\r\nEt avec Chi, elle l\'est encore plus.\r\nMiaaou...', 'S3KO5'),
(18, 5, 3, 'Chi', 2, 'Glénat', '2011-01-26', 'Konami Kanata', 'chi-2.jpg', 'Que faire quand on est un mignon petit chaton et que d\'un coup, on se retrouve tout seul ?\r\nPleurer ? Ne rien faire ? Attendre ?\r\nNon, il y a plus drôle que ça : découvrir le monde !\r\nDu jardin public à la maison, des chaussures au vétérinaire, des balles rebondissantes aux plantes d\'appartement...\r\nLa vie de chat est pleine de joies et de surprises.\r\nEt avec Chi, elle l\'est encore plus.\r\nMiaaou...', 'S3KO5'),
(19, 5, 3, 'Chi', 3, 'Glénat', '2011-03-16', 'Konami Kanata', 'chi-3.jpg', 'Que faire quand on est un mignon petit chaton et que d\'un coup, on se retrouve tout seul ?\r\nPleurer ? Ne rien faire ? Attendre ?\r\nNon, il y a plus drôle que ça : découvrir le monde !\r\nDu jardin public à la maison, des chaussures au vétérinaire, des balles rebondissantes aux plantes d\'appartement...\r\nLa vie de chat est pleine de joies et de surprises.\r\nEt avec Chi, elle l\'est encore plus.\r\nMiaaou...', 'S3KO5'),
(20, 5, 3, 'Chi', 4, 'Glénat', '2011-05-18', 'Konami Kanata', 'chi-4.jpg', 'Que faire quand on est un mignon petit chaton et que d\'un coup, on se retrouve tout seul ?\r\nPleurer ? Ne rien faire ? Attendre ?\r\nNon, il y a plus drôle que ça : découvrir le monde !\r\nDu jardin public à la maison, des chaussures au vétérinaire, des balles rebondissantes aux plantes d\'appartement...\r\nLa vie de chat est pleine de joies et de surprises.\r\nEt avec Chi, elle l\'est encore plus.\r\nMiaaou...', 'S3KO5'),
(21, 5, 3, 'Chi', 5, 'Glénat', '2011-07-20', 'Konami Kanata', 'chi-5.jpg', 'Que faire quand on est un mignon petit chaton et que d\'un coup, on se retrouve tout seul ?\r\nPleurer ? Ne rien faire ? Attendre ?\r\nNon, il y a plus drôle que ça : découvrir le monde !\r\nDu jardin public à la maison, des chaussures au vétérinaire, des balles rebondissantes aux plantes d\'appartement...\r\nLa vie de chat est pleine de joies et de surprises.\r\nEt avec Chi, elle l\'est encore plus.\r\nMiaaou...', 'S3KO5'),
(22, 1, 2, 'Death Note', 1, 'Kana', '2007-01-19', 'Tsugumi Ohba', 'death-note-1.jpg', 'Light Yagami ramasse un étrange carnet oublié dans la cour de son lycée. Selon les instructions du carnet, la personne dont le nom est écrit dans les pages du Death Note mourra dans les 40 secondes !! Quelques jours plus tard, Light fait la connaissance de l\'ancien propriétaire du carnet : Ryûk, un dieu de la mort ! Poussé par l\'ennui, il a fait entrer le carnet sur terre. Ryûk découvre alors que Light a déjà commencé à remplir son carnet...', 'S2SH1'),
(23, 1, 2, 'Death Note', 2, 'Kana', '2007-02-02', 'Tsugumi Ohba', 'death-note-2.jpg', 'Light entend bien imposer au monde sa vision de la Justice ! De nombreux criminels sont morts après que leurs noms aient été inscrits dans le Death Note ! Alerté par ces morts étranges, le FBI enquête au Japon. Light fait partie des suspects mais, grâce au Death Note, il parvient à se débarrasser des soupçons qui pèsent sur lui. Malgré cela, L, continue à suivre le jeune homme !', 'S2SH1'),
(24, 1, 2, 'Death Note', 3, 'Kana', '2007-04-06', 'Tsugumi Ohba', 'death-note-3.jpg', 'La résidence de Light est placée sous surveillance vidéo. L et Light se livrent un duel silencieux relayé par les caméras cachées dans la maison du jeune homme. Grâce à un habile stratagème, Light parvient à établir la preuve de son innocence. Cela n’empêche pas L d’avoir des soupçons de plus en plus forts et de passer à l’action. Parviendra-t-il à démasquer le mystérieux Kira ?!!', 'S2SH1'),
(25, 1, 2, 'Death Note', 4, 'Kana', '2007-06-01', 'Tsugumi Ohba', 'death-note-4.jpg', 'Un second Kira, dont les méthodes diffèrent de celles de Light, a fait son apparition. Au quartier général d’enquête, L contacte Light afin de lui demander sa collaboration. Ce dernier découvre alors le sens caché du message envoyé par l’autre Kira ! Light décide de préparer une rencontre… !!', 'S2SH1'),
(26, 1, 2, 'Death Note', 5, 'Kana', '2007-08-24', 'Tsugumi Ohba', 'death-note-5.jpg', 'La capture de Misa place Light dans une situation pour le moins difficile. Il demande alors à être emprisonné et annonce ensuite à Ryûk qu\'il renonce au Death Note ! Les meurtres cessent soudainement... avant de reprendre de plus belle !!\r\nQuel plan se cache derrière cette savante mise en scène...?', 'S2SH1'),
(27, 2, 2, 'Le garçon d\'à côté', 1, 'Pika', '2014-04-02', 'Robico', 'le-garcon-da-cote-1.jpg', 'Shizuku Mizutani ne s’intéresse qu’à ses résultats scolaires. Un jour, alors qu’elle se rend chez Haru Yoshida, un élève à la réputation de mauvais garçon, pour lui remettre des polycopiés de cours, celui-ci prend la décision unilatérale que Shizuku et lui seront amis. Mais en découvrant la naïveté de Haru, Shizuku va montrer quelques signes de gentillesse qui lui vaudront une déclaration d’amour inattendue ! Comment va évoluer la rencontre improbable d’une jeune fille au cœur de pierre avec un drôle de garçon ?', 'S2SH2'),
(28, 2, 2, 'Le garçon d\'à côté', 2, 'Pika', '2014-05-28', 'Robico', 'le-garcon-da-cote-2.jpg', 'Attirée par la pureté de Haru Yoshida, son voisin de table, Shizuku Mizutani tombe finalement amoureuse de lui. Mais, contre toute attente, ce dernier ne répond pas favorablement à sa déclaration ! Comment conquérir le coeur de ce garçon totalement imprévisible ? C’est la question à laquelle va devoir répondre Shizuku, qui ressent pour la première fois de sa vie des sentiments amoureux…', 'S2SH2'),
(29, 2, 2, 'Le garçon d\'à côté', 3, 'Pika', '2014-08-20', 'Robico', 'le-garcon-da-cote-3.jpg', 'Shizuku ne sait pas comment agir avec Haru Yoshida dont elle est tombée amoureuse et décide de lui fermer son cœur. En revanche, celui-ci, a clairement conscience de ce qu’il ressent pour elle grâce à Ôshima, une jeune fille qui ne cache pas son affection pour lui. Les deux intéressés ne sont plus du tout sur la même longueur d’onde. La situation pourrait-elle, néanmoins, évoluer ?', 'S2SH2'),
(30, 2, 2, 'Le garçon d\'à côté', 4, 'Pika', '2014-10-01', 'Robico', 'le-garcon-da-cote-4.jpg', 'Shizuku a mis de côté les sentiments qu’elle éprouvait envers Haru. Alors que les jours passent et que la relation reste tendue entre les deux voisins de table, la jeune fille a décidé de suivre les conseils de Yamaken et d’arrêter de fuir les problèmes et d’y faire face. Haru trouve de son côté que Yamaken en fait peut-être un peu trop vis-à-vis de Shizuku. A-t-il raison d’être aussi méfiant envers son ami d’enfance ?', 'S2SH2'),
(31, 2, 2, 'Le garçon d\'à côté', 5, 'Pika', '2014-12-03', 'Robico', 'le-garcon-da-cote-5.jpg', 'Alors qu’elle vient de prendre la résolution de changer afin de réussir à faire face aux autres, Shizuku déclare de nouveau sa flamme à son voisin de table, le garçon à problèmes Haru Yoshida. Mais, obnubilé par son ami Yamaken qui s’intéresse aussi à la jeune fille, il l’ignore totalement !! Bien que cela semble mal engagé pour ce couple, du côté de Natsume, l’amour pointe le bout de son nez…', 'S2SH2'),
(32, 3, 1, 'Tokyo Ghoul ', 1, 'Glénat', '2013-08-28', 'Sui Ishida', 'tokyo-ghoul-1.jpg', 'À Tokyo, sévissent des goules, monstres cannibales se dissimulant parmi les humains pour mieux s’en nourrir. Étudiant timide, Ken Kaneki est plus intéressé par la jolie fille qui partage ses goûts pour la lecture que par ces affaires sordides, jusqu’au jour où il se fait attaquer par l’une de ces fameuses créatures. Mortellement blessé, il survit grâce à la greffe des organes de son agresseur… Remis de son opération, il réalise peu à peu qu’il est devenu incapable de se nourrir comme avant et commence à ressentir un appétit suspect envers ses congénères. C’est le début d’une descente aux enfers pour Kaneki, devenu malgré lui un hybride mi-humain, mi-goule.', 'S1SE3'),
(33, 3, 1, 'Tokyo Ghoul ', 2, 'Glénat', '2013-11-06', 'Sui Ishida', 'tokyo-ghoul-2.jpg', 'Ken Kaneki voit sa vie lentement basculer après avoir reçu des organes de Goule lors d\'une transplantation. Ken tente d\'apaiser ce conflit intérieur en travaillant à l\'Antique, un café tenu par des Goules. Cependant, il est bientôt confronté aux inspecteurs de la brigade des Goules, surnommés \"colombes\". Ces ennemis mortels usent des moyens les plus retors afin de pourchasser sans répit ceux qu\'ils ont pour mission d\'éliminer !', 'S1SE3'),
(34, 3, 1, 'Tokyo Ghoul ', 3, 'Glénat', '2014-01-03', 'Sui Ishida', 'tokyo-ghoul-3.jpg', 'Hinami a vu les colombes ôter la vie de ses deux parents.\r\nKen et Toka décident de se rendre chez l ennemi, au quartier général du C.C.G., pour aider comme ils le peuvent leur jeune amie désespérée. Seulement, cette action risquée n est que le prélude d une série de tristes conséquences...', 'S1SE3'),
(35, 3, 1, 'Tokyo Ghoul ', 4, 'Glénat', '2014-03-05', 'Sui Ishida', 'tokyo-ghoul-4.jpg', 'Durant son combat contre un inspecteur du CCG., Ken réalise que son entrée dans le monde des goules a laissé sur lui une marque indélébile. Mais il lui faudra du temps avant de prendre pleinement conscience de ce que cela implique... Quant au café Antique , il reçoit la visite d une nouvelle goule, Shu Tsukiyama, dit le gourmet . Ce fervent gastronome en quête permanente de saveurs nouvelles semble intrigué par Ken et tente de se lier d amitié avec lui...', 'S1SE3'),
(36, 3, 1, 'Tokyo Ghoul ', 5, 'Glénat', '2014-05-07', 'Sui Ishida', 'tokyo-ghoul-5.jpg', 'Shu Tsukiyama, surnommé le Gourmet en raison de sa quête de saveurs nouvelles, s\'intéresse de près à Ken Kaneki et au fumet mystérieux qu il dégage. Bien que Ken se soit échappé de son premier traquenard, Shu ne renonce pas pour autant, et tend à Ken un nouveau piège. Ce dernier n\'a plus le choix, il doit affronter son prédateur dans un combat qui semble perdu d\'avance. Mais cette confrontation sera l\'étincelle qui réveillera une goule jusqu\'alors endormie...', 'S1SE3'),
(37, 5, 3, 'Doraemon', 1, 'Kana', '2006-09-26', 'Fujiko F. Fujio', 'doraemon-1.jpg', 'Nobita est un jeune garçon assez irresponsable, complètement gaffeur et maladroit. Il est, de plus, régulièrement grondé par sa mère et ses professeurs à cause des mauvais plans qu\'il imagine souvent.\r\nUn jour, pourtant, débarque dans sa vie un chat-robot venu du futur. Il se nomme DORAemon, porte toujours une clochette autour du cou et a la particularité d\'avoir des mains toutes rondes. DORAemon est en fait envoyé par le futur petit-fils de Nobita. Sa mission sur Terre : sauver Nobita de ses échecs successifs et donc sauver la famille de la déchéance. Il va donc devoir s\'atteler à faire évoluer Nobita dans le bon sens et, par là, infléchir le destin.\r\nInutile de préciser que cela ne sera pas de tout repos.\r\nHeureusement que DORAemon ne perd jamais sa mine joviale et n\'est jamais à court ni de gadgets ni de bonnes idées !', 'S3KO5'),
(38, 5, 3, 'Doraemon', 2, 'Kana', '2007-09-07', 'Fujiko F. Fujio', 'doraemon-2.jpg', 'Catastrophe ! Nobita n\'a pas étudié et deux contrôles sont prévus pour le lendemain !\r\nDORAemon lui vient en aide avec son \"rappel-pain\", une invention venue du futur.\r\nMieux qu\'un pense-bête, celui qui mange une tranche de ce pain posée sur un cahier se souvient du contenu des pages.\r\nNobita aura-t-il assez d\'appétit pour passer ses examens ?', 'S3KO5'),
(39, 5, 3, 'Doraemon', 3, 'Kana', '2007-11-02', 'Fujiko F. Fujio', 'doraemon-3.jpg', 'Dans la première histoire, le Lion masqué, le héro de manga préféré de Nobita, est en mauvaise posture ! Quel supplice pour Doraemon et Nobita qui ne peuvent pas se résoudre à patienter jusqu’à la prochaine publication. Doraemon décide de rendre visite à l’auteur de la série. Peine perdue, celui-ci est en panne d’inspiration. Doreamon se rend alors dans le futur pour lire la suite de l’histoire… !! Dans la foulée, nos deux compères testeront, entre autres, le \"calendrier modifiable\", \"l’appareil à mensonges\" ou \"la machine à échanger les mamans\"… autant de catastrophes en perspectives !', 'S3KO5'),
(40, 5, 3, 'Doraemon', 4, 'Kana', '2008-01-10', 'Fujiko F. Fujio', 'doraemon-4.jpg', 'Doraemon, un chat-robot venu du futur, a pour mission de sauver Nobita, un jeune garçon, d\'une terrible destinée et de l\'aider dans la vie de tous les jours : il l\'aide ainsi à dépenser ses économies, à découvrir le trésor caché de son ancêtre, à faire face à un appareil photo maudit, à une bouilloire enregistreuse, ou encore à affronter des adversaires venus eux aussi du futur...sélection jeunesse 2008 Festival International de la Bande Dessinée Angoulême.', 'S3KO5'),
(41, 5, 3, 'Doraemon', 5, 'Kana', '2008-03-21', 'Fujiko F. Fujio', 'doraemon-5.jpg', 'Nobita est encore à la traîne pour ses devoirs ! Doraemon lui propose de prendre des médicaments du futur afin d\'accélérer son rythme de travail. Nobita demande une démonstration à Doraemon.\r\nDécouvrez, entre autres, dans ce tome, la peinture de la pesanteur, qui permet de défier la gravité et qui se révèle très utile pour gagner de la place ! Le procédé de fabrication de la terre, un miroir qui fabrique une copie de ce qu\'il reflète et le marteau souvenir, pour ne citer qu\'eux, feront également vivre d\'étonnantes aventures à nos deux amis !!', 'S3KO5'),
(42, 4, 1, 'Nana', 1, 'Delcourt', '2002-10-11', 'Ai Yazawa', 'nana-1.jpg', 'Deux jeunes filles portant un prénom synonyme de bonheur vont, par leur propre volonté, mettre leur destin en marche. Voici deux histoires d\'amours et d\'émotions vécues en parallèle par ces deux jeunes filles portant le même prénom \"Nana\" !!', 'S1JO4'),
(43, 4, 1, 'Nana', 2, 'Delcourt', '2003-01-24', 'Ai Yazawa', 'nana-2.jpg', 'Dans un train à destination de Tokyo, nos deux Nana se rencontrent par hasard. Un peu plus tard, leurs chemins se croisent à nouveau, puis elles deviennent colocataires ! Voici l\'histoire débordant de rêves et d\'espoirs de deux jeunes filles, au prénom identique, qui \"montent\" à Tokyo.', 'S1JO4'),
(44, 4, 1, 'Nana', 3, 'Delcourt', '2003-03-17', 'Ai Yazawa', 'nana-3.jpg', 'L\'arrivée de Shin, un nouveau membre dans le groupe, ravive l\'enthousiasme et la passion de Nana Ôsaki pour la musique. Mais Nana Komatsu, Qui était montée à Tokyo pour devenir indépendante, doit faire face à la fermeture du magasin dans lequel elle travaille...', 'S1JO4'),
(45, 4, 1, 'Nana', 4, 'Delcourt', '2003-05-23', 'Ai Yazawa', 'nana-4.jpg', 'Au moment ou elle entend Shoji parler de Sachiko comme étant sa petite amie. Nana Komatsu découvre l\'existence de leur liaison et sombre dans un profond désespoir.\r\nDe son côté, Nana Osaki s\'apprête à donner son premier concert à Tokyo avec son groupe \"Blast\", auquel s\'est joint un nouveau membre...', 'S1JO4'),
(46, 4, 1, 'Nana', 5, 'Delcourt', '2003-07-15', 'Ai Yazawa', 'nana-5.jpg', 'Les deux Nana assistent au concert du groupe Trapnest. Une fois terminé Nana Osaki revoit Ren et tous deux réalisent combien ils s\'aiment encore. Influencée par la passion qui les anime, Nana Komatsu retourne en mode \"amour\", mais...', 'S1JO4'),
(47, 4, 1, 'A Silent Voice', 1, 'KI-OON', '2015-01-22', 'Yoshitoki Oima', 'silent-voice-1.jpg', 'Quand il était écolier, Ishida Shoya passait tout son temps à chasser l\'ennui avec ses deux inséparables amis Kazuki et Keisuke, alternant partie de jeux vidéo et défis stupide tels que sauter d\'un petit pont au-dessus du fleuve. Puis vint le jour où Nishiyama Shôko arriva dans sa classe, une fille atteinte de surdité. Curieux, il se mit à lui jouer des tours pour tester son niveau de surdité. Les simples farces du début devinrent de plus en plus virulentes quand les autres camarades commencèrent aussi à la discriminer pour son rythme plus lent que les autres en cours. Miyoko tenta de l\'aider au quotidien mais elle se fit à son exclure par ses camarades. Se faisant insulter, Shôko ne broncha pourtant pas, resta toujours souriante et tenta même de montrer de l\'affection à Shoya. Ce dernier la repoussa et l\'humilia.\r\nLe jour suivant, tout bascula pour Shoya quand le directeur vint faire part à sa classe de la plainte de la mère de Shôko pour le mauvais traitement que sa fille endurait. Les élèves dénoncèrent Shoya auprès de leur maître d\'école et nièrent leur propre implication dans quelque brimade à l\'encontre de Shôko. La mère de Shoya ayant été informée, présenta ses excuses directement auprès de celle de Shôko. Mais à l\'école, Shoya subit à son tour des brimades et même ses meilleurs amis le laissèrent tomber. Une fois, après s\'être fait battre, Shôko vint l\'aider mais Shoya la rejeta violement, la tenant pour responsable du dérapage de son quotidien et s\'énervant qu\'elle n\'eût jamais répliqué à la méchanceté des autres. La poussant à bout, Shôko et lui finirent par se bagarrer. Suite à cela, Shôko changea d\'école.\r\nAu collège et au lycée, la mauvaise réputation de Shoya le poursuivit, ce qui l\'isola des autres. À présent en terminale, il se projette dans l\'avenir et s\'imagine terminant clochard. Il décide de tout plaquer en revendant tout ce qui lui appartient pour laisser l\'argent à sa mère. Il part ensuite pour le lycée de Shôko où il la retrouve...', 'S1JO4'),
(48, 4, 1, 'A Silent Voice', 2, 'KI-OON', '2015-03-12', 'Yoshitoki Oima', 'silent-voice-2.jpg', 'Pour Shoya, devenu le nouveau souffre-douleur de sa classe, rien ne change après le départ de Shoko. Pire, le jeune garçon se rend compte qu\'elle faisait preuve de gentillesse à son égard et se sent d\'autant plus coupable ! Mis à l\'écart pendant toute sa scolarité, il ne parvient plus à se lier aux autres. Il se coupe du monde et finit par perdre toute envie de vivre.\r\nMais l\'adolescent n\'a jamais oublié la jeune sourde. Il prend donc la résolution de la retrouver pour lui présenter ses excuses avant de mettre fin à ses jours...', 'S1JO4'),
(49, 4, 1, 'A Silent Voice', 3, 'KI-OON', '2015-05-14', 'Yoshitoki Oima', 'silent-voice-3.jpg', 'Cinq ans après leur dernière rencontre, Shoya parvient à retrouver Shoko. À sa grande surprise, la jeune fille accepte de lui parler et ne semble pas lui en vouloir ! Les deux adolescents commencent à se rapprocher peu à peu, tandis que dans le même temps Shoya se lie d’amitié avec un garçon de sa classe, Tomohiro.\r\nDéterminé à changer pour rendre à Shoko le bonheur qu’il lui a volé, le lycéen décide d’affronter son passé en reprenant contact avec d’anciennes camarades de classe...', 'S1JO4'),
(50, 4, 1, 'A Silent Voice', 4, 'KI-OON', '2015-07-02', 'Yoshitoki Oima', 'silent-voice-4.jpg', 'Si les retrouvailles de Shoko et de Miyoko se passent à merveille, au grand soulagement de Shoya, les choses sont loin d’être aussi simples quand il tombe sur Naoka en pleine rue... Alors qu’il la ramène chez elle, l’adolescente repère la jeune malentendante dans une boutique, et le premier contact se révèle plutôt explosif !\r\nMais pour le lycéen aussi, les choses évoluent : sans s’en rendre compte, il se constitue peu à peu un petit cercle d’amis. Hélas, lorsque la timide Shoko tente de lui déclarer sa flamme à haute voix, c’est l’échec total...', 'S1JO4'),
(51, 4, 1, 'A Silent Voice', 5, 'KI-OON', '2015-10-08', 'Yoshitoki Oima', 'silent-voice-5.jpg', 'Miki et Naoka se sont incrustée dans l\'équipe de tournage du film de Tomohiro. Et tous se réunissent à l\'improviste chez Shoya pour la gestion des besoins du film. Shoya insiste pour inclure Shoko, la seule de la bande exclue. Ainsi, Shoya et Shoko ont une première mission: aller acheter du matériel. Satoshi les accompagne. Dehors, Satoshi vient en aide à un enfant brimé par ses camarades, chose qui l\'insupporte aujourd\'hui car il a lui-même subit des mauvais traitements des autres enfants quand il était petit.\r\nAprès ça, Shoya et Satoshi se rendent à l\'ancienne école de Shoya pour demander s\'ils pourront utiliser des locaux de l\'école pour tourner leur film. Monsieur Takeuchi reconnaît Shoya qu\'il a eu comme élève. Il se met à parler de Shoko comme une source de problème et de discorde par le passé, à cause des brimades contre elle et dit sue Shoya en a payé les frais. Satoshi sort de ses gonds et lui renverse de l\'eau dessus. Shoko allait se joindre à eux pour leur requête, qui est forcément refusée.\r\nPlus tard, Tomohiro et Shoya se bagarrent, Shoya estimant que Tomohiro lui en demande beaucoup trop pour son film, c\'est Shoko qui va les séparer et les calmer.\r\nAu lycée, Satoshi aborde à nouveau le sujet des brimades avec Shoya. Shoya se demande si Satoshi est courant pour ce qu\'il a fait à Shoko à l\'école primaire et av demander à Miki si elle lui en a parlé. Vexée au plus haut qu\'il la prenne pour une cafteuse, elle se met effectivement à tout déballer à Satoshi et des méchancetés de Shoya envers Shoko. Shoya lui rétorque qu\'elle aussi se moquait bien d\'elle. Plus tard, Naoka réunit tout le monde afin que chacun puisse régler ses comptes sur la période sombre du passé, mais cela se termine en dispute générale, ce qui chagrine Naoka qui pensait pouvoir aider Shoya en crevant l\'abcès pour de bon.\r\nShoya croit que tous se le détestent désormais et coupe les ponts. Il passe beaucoup de temps avec Shoko, pour qu\'elle ne pense pas être responsable de tout ça. Il va même participer à la fête d\'anniversaire surprise à la mère de Shoko et Yuzuru. Il se joint aux Nishiyama pour le festival d\'été. Dans la soirée, Shoko rentre plus tôt. Yuzuru qui dit vouloir photographier les feux d\'artifice envoie Shoya chercher à la maison son appareil qu\'elle a oublié. Quand Shoya arrive, il sauve Shoko d\'une tentative de suicide.', 'S1JO4'),
(52, 6, 1, 'Evangelion', 1, 'Glénat', '1998-02-04', 'Gainax', 'evangelion-1.jpg', 'An 2000. Un astéroïde frappa la Terre, provoquant un cataclysme sans précédent. Les humains qui survécurent construisirent une nouvelle ville, Tokyo-3, et s\'apprêtaient à vivre enfin en paix lorsque de mystérieuses créatures appelées \" Anges \" apparurent, semant la terreur et la destruction.\r\n\"Qui sont les Anges ? D\'où viennent-ils ? Ont-ils un lien avec l\'astéroïde ? Mystère ! Sauf pour le commandant de l\'organisation N.E.R.V. qui possède la seule arme capable de les repousser : les Evangelions, gigantesques machines de guerre humanoïdes. Mais lorsqu\'un nouvel Ange surgit, il manque encore l\'essentiel : un pilote...\"', 'S1ME6'),
(53, 6, 1, 'Evangelion', 2, 'Glénat', '1998-05-20', 'Gainax', 'evangelion-2.jpg', 'An 2000. Un astéroïde frappa la Terre, provoquant un cataclysme sans précédent. Les humains qui survécurent construisirent une nouvelle ville, Tokyo-3, et s\'apprêtaient à vivre enfin en paix lorsque de mystérieuses créatures appelées \" Anges \" apparurent, semant la terreur et la destruction.\r\nEnfin, la N.E.R.V. obtient ce qui faisait le plus défaut : un pilote. Grâce à son habileté et ses instincts, Shinji, aux commandes du robot de combat EVA-01, repousse un premier assaut. Mais, à peine la victoire fêtée, un nouvel Ange encore plus destructeur et toujours aussi mystérieux se présente aux portes de Tokyo-3...', 'S1ME6'),
(54, 6, 1, 'Evangelion', 3, 'Glénat', '1998-09-16', 'Gainax', 'evangelion-3.jpg', 'An 2000. Un astéroïde frappa la Terre, provoquant un cataclysme sans précédent. Les humains qui survécurent construisirent une nouvelle ville, Tokyo-3, et s\'apprêtaient à vivre enfin en paix lorsque de mystérieuses créatures appelées « Anges » apparurent, semant la terreur et la destruction. Pour repousser ces attaques, la N.E.R.V. a mis au point des robots de combat appelés « Evangelion ». Ces machines de guerre sont maintenant opérationnelles et servies par toute une équipe. Apparaissent inévitablement des dissensions au sein du groupe, qui constituent pour la N.E.R.V. un nouveau danger aussi redoutable que les « Anges » eux-mêmes Le retour du manga culte par excellence', 'S1ME6'),
(55, 6, 1, 'Evangelion', 4, 'Glénat', '1999-03-24', 'Gainax', 'evangelion-4.jpg', 'An 2000. Un astéroïde frappa la Terre, provoquant un cataclysme sans précédent. Les humains qui survécurent construisirent une nouvelle ville, Tokyo-3, et s\'apprêtaient à vivre enfin en paix lorsque de mystérieuses créatures appelées \" Anges \" apparurent, semant la terreur et la destruction.\r\nPour repousser ces attaques, la N.E.R.V. a fait appel à Shinji pour piloter le robot de combat EVA-01 en remplacement de Reï, blessée. La jeune fille se rétablit petit à petit ce qui lui permet de faire plus ample connaissance avec Shinji. Comment se fait-il qu\'ils soient les deux seuls capables de piloter les EVA ? Quel point commun les unit ? Peut-être le découvriront-ils quand ils devront additionner leurs forces au combat...', 'S1ME6'),
(56, 6, 1, 'Evangelion', 5, 'Glénat', '2000-06-21', 'Gainax', 'evangelion-5.jpg', 'An 2000. Un astéroïde frappa la Terre, provoquant un cataclysme sans précédent. Les humains qui survécurent construisirent une nouvelle ville, Tokyo-3, et s\'apprêtaient à vivre enfin en paix lorsque de mystérieuses créatures appelées « Anges » apparurent, semant la terreur et la destruction. Pour repousser ces attaques, la N.E.R.V. a mis au point des robots de combat appelés « Evangelion ». Ces machines de guerre sont maintenant opérationnelles et servies par toute une équipe. Apparaissent inévitablement des dissensions au sein du groupe, qui constituent pour la N.E.R.V. un nouveau danger aussi redoutable que les « Anges » eux-mêmes.', 'S1ME6'),
(62, 6, 2, 'Code Geass', 1, 'Tonkam', '2009-09-23', 'Gorō Taniguchi', 'code-geass-1.jpg', '2017, dans l\'Area 11, une colonie du Saint Empire de Britannia. Le jeune Lelouch Lamperouge se retrouve malgré lui pris au milieu d’une opération militaire et obtient le Geass, le pouvoir de soumettre quiconque à sa volonté. Héritier du trône britannien vivant sous le sceau du secret et nourrissant de la rancune envers son père, Lelouch va endosser le rôle de Zéro, un justicier Eleven qui veut détruire Britannia…', 'S2ME6'),
(63, 6, 2, 'Code Geass', 2, 'Tonkam', '2009-11-18', 'Gorō Taniguchi', 'code-geass-2.jpg', 'Le Prince Clovis a été assassiné ! Les autorités britanniennes devant maintenir un semblant de contrôle de la situation, ils décident de condamner Suzaku, un Eleven naturalisé britannien pour le meurtre du monarque. Lelouch, qui reconnaît son ami d’enfance décide d’intervenir, il est temps pour Zéro de révéler son existence aux yeux du monde !', 'S2ME6'),
(64, 6, 2, 'Code Geass', 3, 'Tonkam', '2010-01-06', 'Gorō Taniguchi', 'code-geass-3.jpg', 'L’attaque sur le port est un succès. Zero et l’Ordre des Chevaliers Noirs peuvent se féliciter de ce coup d’éclat qui expose aux grands jours leurs objectifs. Mais bientôt, Lelouch est confronté aux conséquences bien réelles de ses décisions : le père de Sheryl, simple ingénieur travaillant sur le port, est mort par la main de Zero…', 'S2ME6'),
(65, 6, 2, 'Code Geass', 4, 'Tonkam', '2010-03-31', 'Gorō Taniguchi', 'code-geass-4.jpg', 'Les événements se précipitent. Depuis la prise de pouvoir par Zero, les Chevaliers Noirs ont plus de moyens et leurs ambitions augmentent. Mais un grain de sable vient toujours gêner les plans de Lelouch : son ami Suzaku. Voilà que ce dernier est devenu un des Chevaliers de la Table Ronde, l’ordre le plus prestigieux de l’Armée britannienne.', 'S2ME6'),
(66, 6, 2, 'Code Geass', 5, 'Tonkam', '2010-05-12', 'Gorō Taniguchi', 'code-geass-5.jpg', 'Alors que le plan de Lelouch touche à son but, sa demi-soeur Euphemia, gouverneur de l’Area 11, décide contre toute attente de reformer le Japon et de rendre leurs droits aux Eleven ! Cette annonce bouleverse les prévisions de Lelouch qui décide finalement de se ranger à ses côtés… jusqu’au moment où un drame survient !', 'S2ME6');

-- --------------------------------------------------------

--
-- Structure de la table `manga_category`
--

DROP TABLE IF EXISTS `manga_category`;
CREATE TABLE IF NOT EXISTS `manga_category` (
  `id_manga` int(11) NOT NULL,
  `id_category` int(11) NOT NULL,
  KEY `MANGA` (`id_manga`),
  KEY `CATEGORY` (`id_category`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `manga_category`
--

INSERT INTO `manga_category` (`id_manga`, `id_category`) VALUES
(2, 2),
(3, 2),
(4, 2),
(5, 2),
(6, 2),
(2, 5),
(3, 5),
(4, 5),
(5, 5),
(6, 5),
(2, 6),
(3, 6),
(4, 6),
(5, 6),
(6, 6),
(7, 1),
(8, 1),
(9, 1),
(10, 1),
(11, 1),
(7, 2),
(8, 2),
(9, 2),
(10, 2),
(11, 2),
(7, 8),
(8, 8),
(9, 8),
(10, 8),
(11, 8),
(12, 3),
(13, 3),
(14, 3),
(15, 3),
(16, 3),
(12, 7),
(13, 7),
(14, 7),
(15, 7),
(16, 7),
(12, 6),
(13, 6),
(14, 6),
(15, 6),
(16, 6),
(12, 5),
(13, 5),
(14, 5),
(15, 5),
(16, 5),
(17, 5),
(18, 5),
(19, 5),
(20, 5),
(21, 5),
(17, 11),
(18, 11),
(19, 11),
(20, 11),
(21, 11),
(22, 7),
(22, 9),
(22, 13),
(23, 7),
(23, 9),
(23, 13),
(24, 7),
(24, 9),
(24, 13),
(25, 7),
(25, 9),
(25, 13),
(26, 7),
(26, 9),
(26, 13),
(27, 3),
(27, 5),
(27, 10),
(27, 11),
(28, 3),
(28, 5),
(28, 10),
(28, 11),
(29, 3),
(29, 5),
(29, 10),
(29, 11),
(30, 3),
(30, 5),
(30, 10),
(30, 11),
(31, 3),
(31, 5),
(31, 10),
(31, 11),
(32, 1),
(32, 6),
(32, 7),
(32, 8),
(33, 1),
(33, 6),
(33, 7),
(33, 8),
(34, 1),
(34, 6),
(34, 7),
(34, 8),
(35, 1),
(35, 6),
(35, 7),
(35, 8),
(36, 1),
(36, 6),
(36, 7),
(36, 8),
(37, 5),
(38, 5),
(39, 5),
(40, 5),
(41, 5),
(42, 3),
(42, 5),
(42, 6),
(42, 11),
(43, 3),
(43, 5),
(43, 6),
(43, 11),
(44, 3),
(44, 5),
(44, 6),
(44, 11),
(45, 3),
(45, 5),
(45, 6),
(45, 11),
(46, 3),
(46, 5),
(46, 6),
(46, 11),
(47, 3),
(47, 6),
(47, 11),
(48, 3),
(48, 6),
(48, 11),
(49, 3),
(49, 6),
(49, 11),
(50, 3),
(50, 6),
(50, 11),
(51, 3),
(51, 6),
(51, 11),
(52, 1),
(52, 4),
(52, 6),
(52, 9),
(53, 1),
(53, 4),
(53, 6),
(53, 9),
(54, 1),
(54, 4),
(54, 6),
(54, 9),
(55, 1),
(55, 4),
(55, 6),
(55, 9),
(56, 1),
(56, 4),
(56, 6),
(56, 9),
(62, 1),
(62, 4),
(63, 1),
(63, 4),
(64, 1),
(64, 4),
(65, 1),
(65, 4),
(66, 1),
(66, 4);

-- --------------------------------------------------------

--
-- Structure de la table `public`
--

DROP TABLE IF EXISTS `public`;
CREATE TABLE IF NOT EXISTS `public` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `slug` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `public`
--

INSERT INTO `public` (`id`, `name`, `slug`) VALUES
(1, 'Adulte', 'adulte'),
(2, 'Adolescent', 'adolescent'),
(3, 'Enfant', 'enfant');

-- --------------------------------------------------------

--
-- Structure de la table `suggestion`
--

DROP TABLE IF EXISTS `suggestion`;
CREATE TABLE IF NOT EXISTS `suggestion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(50) NOT NULL,
  `suggestion` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role` varchar(50) NOT NULL,
  `pseudo` varchar(30) NOT NULL,
  `password` varchar(150) NOT NULL,
  `mail` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `role`, `pseudo`, `password`, `mail`) VALUES
(1, 'admin', 'taysma', '$2y$10$W7gxK8Sfdx.5bV8OQJBMGOupwEM1hcefxBr4NmHtCcU0cpFayxdsK', 'walesca@gmail.com'),
(2, 'admin', 'bobas', '$2y$10$W7gxK8Sfdx.5bV8OQJBMGOupwEM1hcefxBr4NmHtCcU0cpFayxdsK', 'alex@gmail.com'),
(3, 'admin', 'hamidou', '$2y$10$W7gxK8Sfdx.5bV8OQJBMGOupwEM1hcefxBr4NmHtCcU0cpFayxdsK', 'hamidou@gmail.com'),
(4, 'reader', 'toto', '$2y$10$W7gxK8Sfdx.5bV8OQJBMGOupwEM1hcefxBr4NmHtCcU0cpFayxdsK', 'toto@gmail.com'),
(5, 'reader', 'tata', '$2y$10$W7gxK8Sfdx.5bV8OQJBMGOupwEM1hcefxBr4NmHtCcU0cpFayxdsK', 'tata@mail.com'),
(6, 'reader', 'titi', '$2y$10$npBGhyEPaxVMeE5kHHXFPO3AR0u4isgv3XbU9I9UajhFwe.IxX0vC', 'titi@gmail.com'),
(7, 'reader', 'bob', '$2y$10$W7gxK8Sfdx.5bV8OQJBMGOupwEM1hcefxBr4NmHtCcU0cpFayxdsK', 'bob@gmail.com');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `loan`
--
ALTER TABLE `loan`
  ADD CONSTRAINT `loan_ibfk_1` FOREIGN KEY (`id_manga`) REFERENCES `manga` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `loan_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `manga`
--
ALTER TABLE `manga`
  ADD CONSTRAINT `manga_ibfk_1` FOREIGN KEY (`id_public`) REFERENCES `public` (`id`),
  ADD CONSTRAINT `manga_ibfk_2` FOREIGN KEY (`id_genre`) REFERENCES `genre` (`id`);

--
-- Contraintes pour la table `manga_category`
--
ALTER TABLE `manga_category`
  ADD CONSTRAINT `manga_category_ibfk_1` FOREIGN KEY (`id_manga`) REFERENCES `manga` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `manga_category_ibfk_2` FOREIGN KEY (`id_category`) REFERENCES `category` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
