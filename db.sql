
CREATE TABLE IF NOT EXISTS `membres` (
  `id_membre` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `login` varchar(50) NOT NULL,
  `pass` varchar(50) NOT NULL,
  `actif` tinyint(1) NOT NULL,
  `estAdmin` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_membre`),
  UNIQUE KEY `login` (`login`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `messages` (
  `id_message` int(11) NOT NULL AUTO_INCREMENT,
  `sujet` varchar(200) NOT NULL,
  `corps` text NOT NULL,
  `id_expediteur` int(11) NOT NULL,
  `id_destinataire` int(11) NOT NULL,
  PRIMARY KEY (`id_message`),
  FOREIGN KEY(`id_expediteur`) REFERENCES `membres`(`id_membre`),
  FOREIGN KEY(`id_destinataire`) REFERENCES `membres`(`id_membre`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ;




INSERT INTO INSERT INTO `users` (`id_user`, `login`, `pass`, `actif`, `estAdmin`) VALUES
(1, 'admin', 'administrateur', 1, 1);




