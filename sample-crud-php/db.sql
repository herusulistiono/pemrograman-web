CREATE TABLE `mahasiswa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `npm` char(20) NOT NULL,
  `nama_lengkap` varchar(90) NOT NULL,
  `kelamin` enum('Laki-laki','Perempuan') NOT NULL,
  `no_hp` char(20) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `NPM` (`npm`)
) ENGINE=InnoDB