
CREATE TABLE IF NOT EXISTS `membres` (
  `id_membre` INTEGER PRIMARY KEY,
  `login` TEXT NOT NULL UNIQUE,
  `pass` TEXT NOT NULL,
  `actif` tinyint(1) NOT NULL,
  `estAdmin` tinyint(1) NOT NULL
);

CREATE TABLE `messages` (
  `id_message` INTEGER NOT NULL PRIMARY KEY,
  `date` datetime NOT NULL,
  `sujet` TEXT NOT NULL,
  `corps` TEXT NOT NULL,
  `id_expediteur` INTEGER NOT NULL,
  `id_destinataire` INTEGER NOT NULL,
  FOREIGN KEY(`id_expediteur`) REFERENCES `membres`(`id_membre`),
  FOREIGN KEY(`id_destinataire`) REFERENCES `membres`(`id_membre`)
);

INSERT INTO `membres` (`id_membre`, `login`, `pass`, `actif`, `estAdmin`) VALUES
(1, 'admin', 'administrateur', 1, 1);
