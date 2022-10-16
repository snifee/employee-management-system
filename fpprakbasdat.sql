-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 28, 2021 at 05:33 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fpprakbasdat`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `delete_in_absen` (`vur1` VARCHAR(8))  BEGIN
	DELETE FROM absen
    WHERE id_absen = vur1;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `delete_ketua` (IN `var` VARCHAR(20))  BEGIN
    IF EXISTS(SELECT * FROM ketua.id_pegawai=var) THEN
    	DELETE FROM ketua WHERE ketua.id_pegawai=var;
        END IF;
   	END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `filter_gaji1` (IN `mode` VARCHAR(5))  NO SQL
BEGIN
DECLARE rata INT;
SET rata=(SELECT AVG(tabelgajiuser.total) FROM tabelgajiuser);
	IF mode='1' THEN
    SELECT * FROM tabelgajiuser GROUP BY id_gaji HAVING AVG(tabelgajiuser.jumlah)>tabelgajiuser.total ORDER BY tabelgajiuser.total;
	ELSEIF mode='2' THEN
    SELECT * FROM tabelgajiuser GROUP BY id_gaji HAVING AVG(tabelgajiuser.jumlah)<tabelgajiuser.total ORDER BY tabelgajiuser.total;
    ELSE
    SELECT * FROM tabelgajiuser WHERE rata<tabelgajiuser.jumlah 
    UNION
     SELECT * FROM tabelgajiuser WHERE rata<tabelgajiuser.bonus ;
     END IF;
     END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `filter_gaji2` (`vv1` INT(12), `vv2` INT(12))  BEGIN
 SELECT * FROM tabelGajiUser WHERE (total BETWEEN vv1 AND vv2);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_emp_in_division` (IN `var1` VARCHAR(30), IN `mode` VARCHAR(50))  BEGIN
	IF mode='user' THEN
    	SELECT * FROM tabelpegawaiuser WHERE tabelpegawaiuser.nama_divisi=var1;
    ELSEIF mode='admin' THEN
    	SELECT * FROM tabelpegawaiadmin WHERE  tabelpegawaiadmin.nama_divisi=var1;
	END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_user_data` (IN `varid` VARCHAR(30))  BEGIN
	SELECT data_pegawai.*, divisi.nama_divisi,pegawai.jabatan,pegawai.status
    FROM data_pegawai, divisi, pegawai
    WHERE (pegawai.id_divisi = divisi.id_divisi AND data_pegawai.id_pegawai = 	 pegawai.id_pegawai) AND data_pegawai.id_pegawai = varid;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_to_absen` (IN `vi1` VARCHAR(8), IN `vi3` DATETIME)  BEGIN
	INSERT INTO absen(`id_pegawai`,`waktu`)
    VALUES (vi1, vi3);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_to_divisi` (`ve1` VARCHAR(3), `ve2` VARCHAR(20))  BEGIN
	INSERT INTO divisi(`id_divisi`,`nama_divisi`)
    VALUES (ve1, ve2);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_to_gaji` (IN `va1` VARCHAR(8), IN `va3` DATE, IN `va4` INT(12), IN `va5` INT(12))  BEGIN
	INSERT INTO gaji(`id_pegawai`,`tanggal`,`jumlah`,`bonus`)
    VALUES (va1, va3, va4, va5);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_to_pegawai` (IN `v1` VARCHAR(28), IN `v2` VARCHAR(50), IN `v3` VARCHAR(30), IN `v4` VARCHAR(20), IN `v5` VARCHAR(20))  BEGIN
	INSERT INTO pegawai(id_pegawai,nama,jabatan,id_divisi,status)
    VALUES (v1, v2, v3, v4,v5);
    IF v3='Kepala Divisi' THEN
    	IF NOT EXISTS(SELECT * FROM ketua.id_divisi=v4) THEN
        INSERT INTO ketua(ketua.id_pegawai,ketua.id_divisi) VALUES (v1,v4);
        END IF;
        END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `login_procedure` (IN `username` VARCHAR(20), IN `password` TEXT)  BEGIN
    	SELECT * FROM user WHERE user.username=username AND user.password=password;
    END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `search_procedure` (IN `keyword` VARCHAR(100), IN `tabel` VARCHAR(10))  BEGIN
    IF tabel='pegawai' THEN
    	SELECT * FROM tabelpegawaiuser WHERE id_pegawai LIKE CONCAT('%',keyword,'%') OR nama_pegawai LIKE CONCAT('%',keyword,'%') ORDER BY tabelpegawaiuser.id_pegawai;
    ELSEIF tabel='gaji' THEN
    	SELECT * FROM tabelgajiuser WHERE id_pegawai LIKE CONCAT('%',keyword,'%') OR nama_pegawai LIKE CONCAT('%',keyword,'%') ORDER BY tabelgajiuser.tanggal;
    ELSEIF tabel='absen' THEN
    	SELECT * FROM tabelabsenuser WHERE id_pegawai LIKE CONCAT('%',keyword,'%') OR nama LIKE CONCAT('%',keyword,'%') ORDER BY tabelabsenuser.waktu;
    ELSE
    	SELECT * FROM tabelpegawaiadmin WHERE id_pegawai LIKE CONCAT('%',keyword,'%') OR nama_pegawai LIKE CONCAT('%',keyword,'%') ORDER BY tabelpegawaiadmin.id_pegawai;
    END IF;
    END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `select_dataview_division` ()  NO SQL
BEGIN
	SELECT * FROM tabeldivisiinfo1;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `select_dataview_for_admin` (IN `data` VARCHAR(100))  BEGIN
    	IF data='pegawai' THEN
        	SELECT * FROM tabelpegawaiadmin;
        ELSEIF data='absen' THEN
        	SELECT * FROM tabelabsenuser ORDER BY tabelabsenuser.id_pegawai;
        ELSEIF data='gaji' THEN
        	SELECT * FROM tabelgajiuser ORDER BY tabelgajiuser.id_pegawai;
       	ELSE
        	SELECT 'DATA NOT FOUND';
        END IF;
	END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `select_dataview_for_user` (IN `data` VARCHAR(100), IN `data2` VARCHAR(100))  BEGIN
    	IF data='pegawai' THEN
        	SELECT * FROM tabelpegawaiuser;
        ELSEIF data='absen' THEN
        	SELECT * FROM tabelabsenuser WHERE id_pegawai=data2 ORDER BY tabelabsenuser.waktu;
        ELSEIF data='gaji' THEN
        	SELECT * FROM tabelgajiuser WHERE id_pegawai=data2 ORDER BY tabelgajiuser.tanggal;
       	ELSE
        	SELECT 'DATA NOT FOUND';
        END IF;
  	END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `update_data_pegawai_user` (IN `v1` VARCHAR(8), IN `v2` VARCHAR(20), IN `v3` VARCHAR(50), IN `v4` INT(2), IN `v5` VARCHAR(30), IN `v6` DATE, IN `v7` VARCHAR(25), IN `v8` VARCHAR(25), IN `v9` VARCHAR(50), IN `v10` VARCHAR(30), IN `v11` VARCHAR(12), IN `v12` VARCHAR(30))  BEGIN
	UPDATE data_pegawai
    SET 
    no_identitas=v2,
    nama_pegawai=v3,
    jenis_kelamin=v4,
    tempat_lahir=v5,
    tanggal_lahir=v6, 
    pendidikan=v7, 
    almamater=v8, 
    alamat=v9, 
    domisili=v10,
    telepon=v11, 
    email=v12
    WHERE  id_pegawai=v1;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `update_divisi` (IN `ver1` VARCHAR(3), IN `ver2` VARCHAR(20), IN `ver3` VARCHAR(20))  BEGIN
	UPDATE divisi
    SET `nama_divisi` = ver2
    WHERE id_divisi = ver1;
    IF ver3!='' THEN
    UPDATE pegawai
    SET pegawai.jabatan='Kepala Divisi' WHERE pegawai.id_pegawai=ver3 AND pegawai.id_divisi=ver1;
    END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `update_gaji` (`vari1` VARCHAR(8), `vari2` VARCHAR(8), `vari3` DATE, `vari4` INT(12), `vari5` INT(12))  BEGIN
	UPDATE gaji
    SET `tanggal`=vari3,`jumlah`=vari4,`bonus`=vari5
    WHERE id_gaji=vari2 AND id_pegawai=vari1 ;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `update_password` (IN `vir1` VARCHAR(8), IN `vir2` TEXT, IN `vir3` TEXT)  BEGIN
	DECLARE pass TEXT;
    SET pass = (SELECT user.password FROM user WHERE user.username=vir1);
    select pass;
    IF pass=vir2 THEN
	UPDATE user
    SET user.password = vir3
    WHERE user.username=vir1;
    END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `update_profile_emp_procedure` (IN `v1` VARCHAR(8), IN `v2` VARCHAR(20), IN `v3` VARCHAR(50), IN `v4` INT(2), IN `v5` VARCHAR(30), IN `v6` DATE, IN `v7` VARCHAR(25), IN `v8` VARCHAR(25), IN `v9` VARCHAR(50), IN `v10` VARCHAR(30), IN `v11` VARCHAR(12), IN `v12` VARCHAR(30), IN `vrb2` VARCHAR(3), IN `vrb3` VARCHAR(20))  BEGIN
	UPDATE data_pegawai
    SET 
    no_identitas=v2,
    nama_pegawai=v3,
    jenis_kelamin=v4,
    tempat_lahir=v5,
    tanggal_lahir=v6, 
    pendidikan=v7, 
    almamater=v8, 
    alamat=v9, 
    domisili=v10,
    telepon=v11, 
    email=v12
    WHERE  id_pegawai=v1;
    
 UPDATE pegawai
    SET id_divisi = vrb2, jabatan =vrb3
    WHERE id_pegawai = v1;

    IF vrb3='Kepala Divisi' THEN
    	IF NOT EXISTS(SELECT * FROM ketua WHERE ketua.id_divisi=vrb2) THEN
        INSERT INTO ketua(ketua.id_pegawai,ketua.id_divisi) VALUES (v1,vrb2);
        END IF;
        END IF;

END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `absen`
--

CREATE TABLE `absen` (
  `id_absen` int(11) NOT NULL,
  `id_pegawai` varchar(8) NOT NULL,
  `waktu` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `absen`
--

INSERT INTO `absen` (`id_absen`, `id_pegawai`, `waktu`) VALUES
(3, 'a10003', '2021-05-17 08:00:00'),
(4, 'a10004', '2021-05-17 08:00:00'),
(5, 'a10005', '2021-05-17 10:00:00'),
(6, 'a10006', '2021-05-17 08:00:00'),
(7, 'a10007', '2021-05-17 10:00:00'),
(8, 'a10008', '2021-05-17 08:00:00'),
(9, 'a10009', '2021-05-17 10:00:00'),
(10, 'a10010', '2021-05-17 08:00:00'),
(11, 'a10011', '2021-05-17 08:00:00'),
(12, 'a10012', '2021-05-17 08:00:00'),
(13, 'a10013', '2021-05-17 08:00:00'),
(14, 'a10014', '2021-05-17 08:00:00'),
(15, 'a10015', '2021-05-17 08:00:00'),
(16, 'a10016', '2021-05-17 10:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `data_pegawai`
--

CREATE TABLE `data_pegawai` (
  `id_pegawai` varchar(8) NOT NULL,
  `no_identitas` varchar(20) NOT NULL,
  `nama_pegawai` varchar(50) NOT NULL,
  `jenis_kelamin` int(2) NOT NULL,
  `tempat_lahir` varchar(30) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `pendidikan` varchar(25) NOT NULL,
  `almamater` varchar(25) NOT NULL,
  `alamat` varchar(50) NOT NULL,
  `domisili` varchar(30) NOT NULL,
  `telepon` varchar(12) NOT NULL,
  `email` varchar(30) NOT NULL,
  `foto` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `data_pegawai`
--

INSERT INTO `data_pegawai` (`id_pegawai`, `no_identitas`, `nama_pegawai`, `jenis_kelamin`, `tempat_lahir`, `tanggal_lahir`, `pendidikan`, `almamater`, `alamat`, `domisili`, `telepon`, `email`, `foto`) VALUES
('a10001', '000155', 'Roni Sudarmawan', 1, 'Singaraja', '2001-01-01', 'SMA', 'SMA 1 Singaraja', 'Perum Buleleng 1', 'Singaraja', '08123456789', 'roni@gmail.com', '/EMS/img/user/user_profile1.png'),
('a10002', '0002', 'Valerie Laurent', 0, 'Medan', '2001-01-02', 'SMA', 'SMA 1 Medan', 'Perum Medan 1', 'Medan', '08112345678', 'val@gmail.com', '/EMS/img/user/user_profile2.png'),
('a10003', '0003', 'Rasita Sitepu', 0, 'Medan', '2001-01-03', 'SMA', 'SMA 1 Medan', 'Perum Medan 2', 'Medan', '0813456789', 'rasita@gmail.com', '/EMS/img/user/user_profile2.png'),
('a10004', '0004', 'Tristan Tanaya', 1, 'Denpasar', '2001-01-04', 'SMA', 'SMA Santo Yosep', 'Perum Denpasar 1', 'Denpasar', '08145678912', 'tristan@gmail.com', '/EMS/img/user/user_profile1.png'),
('a10005', '00057', 'Arfal Razya', 1, 'Bangli', '2001-01-18', 'S3', 'Universitas Udayana', 'Perum Bangli 1', 'Bangli', '08166666666', 'ecakun@gmail.com', '/EMS/img/user/user_profile1.png'),
('a10006', '0006', 'Sinta Widya', 0, 'Gianyar', '2001-01-06', 'SMA', 'SMA 1 Gianyar', 'Perum Gianyar 1', 'Gianyar', '08192367463', 'sintaw@gmail.com', '/EMS/img/user/user_profile2.png'),
('a10007', '0007', 'Jonas Kuntoro', 1, 'Jakarta', '2001-01-07', 'S3', 'Universitas Udayana', 'Perum Jakarta 1', 'Jakarta', '08177777777', 'jonas@gmail.com', '/EMS/img/user/user_profile1.png'),
('a10008', '0008', 'Gede Maharta', 1, 'Jimbaran', '2001-01-08', 'SMA', 'SMA 1 Kuta', 'Perum Jimbaran 1', 'Jimbaran', '08198765432', 'maharta@gmail.com', '/EMS/img/user/user_profile1.png'),
('a10009', '0009', 'Richa Sani', 0, 'Denpasar', '2001-01-08', 'S3', 'Universitas Udayana', 'Perum Jimbaran 2', 'Jimbaran', '08999999999', 'richa@gmail.com', '/EMS/img/user/user_profile2.png'),
('a10010', '0010', 'Firman ', 1, 'Badung', '2001-01-10', 'SMK', 'SMK 1 Badung', 'Perum Nusa Dua', 'Nusa Dua', '08198278726', 'firemn@gmail.com', '/EMS/img/user/user_profile1.png'),
('a10011', '0011', 'Sugiana', 1, 'Denpasar', '2001-01-11', 'SMA', 'SMA 1 Denpasar', 'Perum Denpasar 2', 'Denpasar', '08176543782', 'sugi@gmail.com', '/EMS/img/user/user_profile1.png'),
('a10012', '0012', 'Brahmantara', 1, 'Karangasem', '2001-01-12', 'SMA', 'SMA 1 Karangasem', 'Perum Karangasem 1', 'Karangasem', '0816526163', 'bram@gmail.com', '/EMS/img/user/user_profile1.png'),
('a10013', '0013', 'Bhisma', 1, 'Singaraja', '2001-01-13', 'SMA', 'SMA 1 Singaraja', 'Perum Buleleng 2', 'Singaraja', '0887654567', 'bhisma@gmail.com', '/EMS/img/user/user_profile1.png'),
('a10014', '0014', 'Dana Putra', 1, 'Tuban', '2001-01-14', 'SMA', 'SMAK Soverdi', 'Perum Tuban 1', 'Badung', '081982782817', 'dana@gmail.com', '/EMS/img/user/user_profile1.png'),
('a10015', '0015', 'Puri Trisnantya', 0, 'Denpasar', '2001-01-15', 'SMA', 'SMA 1 Denpasar', 'Perum Denpasar 3', 'Denpasar', '08176543783', 'puri@gmail.com', '/EMS/img/user/user_profile2.png'),
('a10016', '0016', 'Alisya Putri', 0, 'Badung', '2001-01-16', 'S3', 'Universitas Udayana', 'Perum Jimbaran 3', 'Jimbaran', '081111111111', 'alisya@gmail.com', '/EMS/img/user/user_profile2.png'),
('a10022', '', 'Eren Yeager', 0, '', '0000-00-00', '', '', '', '', '', '', '/EMS/img/user/user_profile1.png'),
('a20001', '000089', 'orochimaru', 0, '', '0000-00-00', '', '', '', '', '', '', '/EMS/img/user/user_profile1.png'),
('m10001', '000579', 'Ecakun', 0, 'AS', '2021-05-26', 'S4 Teknik Nuklir ', 'NTU', 'Konoha road', 'Jepang', '0987645119', 'no@gmail.com', '/EMS/img/user/user_profile1.png'),
('m10006', '00057', 'Levi Ackerman', 0, 'AS', '2021-05-25', 'S3', 'NTU', 'Wall Maria', 'Paradis', '123456', 'no@gmail.com', '/EMS/img/user/user_profile1.png'),
('m10007', '00057', 'Ishigami Senku', 1, 'AS', '2021-05-02', 'S4 ', 'NTU', 'Konoha road', 'Jepang', '2323434', 'no@gmail.com', '/EMS/img/user/user_profile1.png'),
('s10001', '0001556', 'Kayaba Akihiko', 0, 'AS', '2021-05-25', 'S4 Teknik Nuklir ', 'NTS', 'Konoha road', 'Jepang', '123466444', 'no@gmail.com', '/EMS/img/user/user_profile1.png'),
('s10002', '', 'Yagami Light', 0, '', '0000-00-00', '', '', '', '', '', '', '/EMS/img/user/user_profile1.png'),
('s10008', '', 'Leonardo Watch', 0, '', '0000-00-00', '', '', '', '', '', '', '/EMS/img/user/user_profile1.png');

--
-- Triggers `data_pegawai`
--
DELIMITER $$
CREATE TRIGGER `update_pegawai` AFTER UPDATE ON `data_pegawai` FOR EACH ROW BEGIN
    	UPDATE pegawai SET pegawai.nama=new.nama_pegawai WHERE pegawai.id_pegawai=new.id_pegawai;
    END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `divisi`
--

CREATE TABLE `divisi` (
  `id_divisi` varchar(3) NOT NULL,
  `nama_divisi` varchar(150) NOT NULL,
  `ketua` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `divisi`
--

INSERT INTO `divisi` (`id_divisi`, `nama_divisi`, `ketua`) VALUES
('00', 'Secret Divisi', ''),
('A1', 'IT', ''),
('A2', 'Pemasaran', ''),
('A3', 'Human Resource', ''),
('A4', 'keuangan', ''),
('A5', 'Produksi', ''),
('B5', 'Pengembangan Bio-Weapon', ''),
('C3', 'Militer', ''),
('C4', 'Pengembangan Senjata', ''),
('C5', 'Pengembangan Vaksin ', ''),
('C86', 'Pengembangan Virus', '');

-- --------------------------------------------------------

--
-- Table structure for table `gaji`
--

CREATE TABLE `gaji` (
  `id_pegawai` varchar(8) NOT NULL,
  `id_gaji` int(8) NOT NULL,
  `tanggal` date NOT NULL,
  `jumlah` int(12) NOT NULL,
  `bonus` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `gaji`
--

INSERT INTO `gaji` (`id_pegawai`, `id_gaji`, `tanggal`, `jumlah`, `bonus`) VALUES
('a10001', 1, '2021-05-25', 6000000, 1000000),
('a10002', 2, '2021-05-25', 5000000, 1000000),
('a10003', 3, '2021-05-25', 5000000, 1000000),
('a10004', 4, '2021-05-25', 5000000, 1000000),
('a10005', 5, '2021-05-25', 10000000, 5000000),
('a10006', 6, '2021-05-25', 5000000, 1000000),
('a10007', 7, '2021-05-25', 10000000, 5000000),
('a10008', 8, '2021-05-25', 5000000, 1000000),
('a10009', 9, '2021-05-25', 10000000, 5000000),
('a10010', 10, '2021-05-25', 5000000, 1000000),
('a10011', 11, '2021-05-25', 5000000, 1000000),
('a10012', 12, '2021-05-25', 5000000, 1000000),
('a10013', 13, '2021-05-25', 5000000, 1000000),
('a10014', 14, '2021-05-25', 5000000, 1000000),
('a10015', 15, '2021-05-25', 5000000, 1000000),
('a10016', 16, '2021-05-25', 10000000, 5000000),
('a10005', 18, '2021-05-19', 20000000, 2000000),
('a10005', 20, '2021-05-19', 30000000, 40000000),
('s10001', 21, '2021-05-24', 1000000, 500000),
('s10001', 22, '2021-06-01', 10000000, 0);

-- --------------------------------------------------------

--
-- Table structure for table `ketua`
--

CREATE TABLE `ketua` (
  `id_pegawai` varchar(20) NOT NULL,
  `id_divisi` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ketua`
--

INSERT INTO `ketua` (`id_pegawai`, `id_divisi`) VALUES
('a10001', 'A5'),
('a10005', 'A1'),
('a10007', 'A2'),
('a10009', 'A3'),
('a10016', 'A4'),
('a10022', 'C3'),
('m10001', 'B5'),
('m10006', 'C5'),
('m10007', 'C86'),
('s10002', '00');

-- --------------------------------------------------------

--
-- Table structure for table `pegawai`
--

CREATE TABLE `pegawai` (
  `id_pegawai` varchar(8) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `id_divisi` varchar(3) NOT NULL,
  `jabatan` varchar(20) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pegawai`
--

INSERT INTO `pegawai` (`id_pegawai`, `nama`, `id_divisi`, `jabatan`, `status`) VALUES
('a10001', 'Roni Sudarmawan', 'A5', 'Kepala Divisi', 'AKTIF'),
('a10002', 'Valerie Laurent', 'A5', 'Karyawan', 'AKTIF'),
('a10003', 'Rasita Sitepu', 'A5', 'Karyawan', 'AKTIF'),
('a10004', 'Tristan Tanaya', 'A5', 'Karyawan', 'AKTIF'),
('a10005', 'Arfal Razya', 'A1', 'Kepala Divisi', 'AKTIF'),
('a10006', 'Sinta Widya', 'A1', 'Karyawan', 'AKTIF'),
('a10007', 'Jonas Kuntoro', 'A2', 'Kepala Divisi', 'AKTIF'),
('a10008', 'Gede Maharta', 'A2', 'Karyawan', 'AKTIF'),
('a10009', 'Richa Sani', 'A3', 'Kepala Divisi', 'AKTIF'),
('a10010', 'Firman', 'A3', 'Karyawan', 'AKTIF'),
('a10011', 'Sugiana', 'A3', 'Karyawan', 'AKTIF'),
('a10012', 'Brahmantara', 'A1', 'Karyawan', 'AKTIF'),
('a10013', 'Bhisma', 'A2', 'Karyawan', 'AKTIF'),
('a10014', 'Dana Putra', 'A4', 'Karyawan', 'AKTIF'),
('a10015', 'Puri Trisnantya', 'A4', 'Karyawan', 'AKTIF'),
('a10016', 'Alisya Putri', 'A4', 'Kepala Divisi', 'AKTIF'),
('a10022', 'Eren Yeager', 'C3', 'Kepala Divisi', 'AKTIF'),
('a20001', 'orochimaru', 'B5', 'Peneliti', 'AKTIF'),
('m10001', 'Ecakun', 'B5', 'Kepala Divisi', 'NONAKTIF'),
('m10006', 'Levi Ackerman', 'C5', 'Kepala Divisi', 'AKTIF'),
('m10007', 'Ishigami Senku', 'C86', 'Kepala Divisi', 'AKTIF'),
('s10001', 'Kayaba Akihiko', '00', 'Peneliti', 'AKTIF'),
('s10002', 'Yagami Light', '00', 'Kepala Divisi', 'AKTIF'),
('s10008', 'Leonardo Watch', '00', 'Karyawan', 'AKTIF');

--
-- Triggers `pegawai`
--
DELIMITER $$
CREATE TRIGGER `datapegawai_input_trig` AFTER INSERT ON `pegawai` FOR EACH ROW BEGIN
    	INSERT INTO data_pegawai(data_pegawai.id_pegawai,data_pegawai.nama_pegawai,data_pegawai.foto)
        	VALUES(new.id_pegawai,new.nama,'/EMS/img/user/user_profile1.png');
    END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `delete_ketua_trig` AFTER UPDATE ON `pegawai` FOR EACH ROW BEGIN
	IF old.jabatan='Kepala Divisi' AND new.jabatan!='Kepala Divisi' THEN
    DELETE FROM ketua WHERE ketua.id_pegawai=new.id_pegawai;
    END IF;
    END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `user_input_trig` AFTER INSERT ON `pegawai` FOR EACH ROW BEGIN
    	INSERT INTO user(user.username,user.password,user.level)
        	VALUES(new.id_pegawai,SHA1('1234567'),
                   CASE
                        WHEN new.id_divisi='A1' THEN 1
                        ELSE 2
                    END
                   );
    END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Stand-in structure for view `tabelabsenuser`
-- (See below for the actual view)
--
CREATE TABLE `tabelabsenuser` (
`id_pegawai` varchar(8)
,`id_absen` int(11)
,`nama` varchar(50)
,`waktu` datetime
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `tabeldivisiinfo1`
-- (See below for the actual view)
--
CREATE TABLE `tabeldivisiinfo1` (
`id_divisi` varchar(3)
,`nama_divisi` varchar(150)
,`jml_pegawai` bigint(21)
,`ketua` varchar(20)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `tabelgajiuser`
-- (See below for the actual view)
--
CREATE TABLE `tabelgajiuser` (
`id_pegawai` varchar(8)
,`id_gaji` int(8)
,`nama_pegawai` varchar(50)
,`tanggal` date
,`jumlah` int(12)
,`bonus` int(12)
,`pajak` decimal(15,2)
,`total` decimal(16,2)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `tabelpegawaiadmin`
-- (See below for the actual view)
--
CREATE TABLE `tabelpegawaiadmin` (
`id_pegawai` varchar(8)
,`no_identitas` varchar(20)
,`nama_pegawai` varchar(50)
,`jenis_kelamin` int(2)
,`tempat_lahir` varchar(30)
,`tanggal_lahir` date
,`pendidikan` varchar(25)
,`almamater` varchar(25)
,`alamat` varchar(50)
,`domisili` varchar(30)
,`telepon` varchar(12)
,`email` varchar(30)
,`foto` varchar(50)
,`nama_divisi` varchar(150)
,`jabatan` varchar(20)
,`status` varchar(50)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `tabelpegawaiuser`
-- (See below for the actual view)
--
CREATE TABLE `tabelpegawaiuser` (
`id_pegawai` varchar(8)
,`nama_pegawai` varchar(50)
,`nama_divisi` varchar(150)
,`jabatan` varchar(20)
,`telepon` varchar(12)
,`foto` varchar(50)
);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `username` varchar(20) NOT NULL,
  `password` text NOT NULL,
  `level` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`username`, `password`, `level`) VALUES
('a10001', '20eabe5d64b0e216796e834f52d61fd0b70332fc', 2),
('a10002', '20eabe5d64b0e216796e834f52d61fd0b70332fc', 2),
('a10003', '20eabe5d64b0e216796e834f52d61fd0b70332fc', 2),
('a10004', '20eabe5d64b0e216796e834f52d61fd0b70332fc', 2),
('a10005', 'f10e2821bbbea527ea02200352313bc059445190', 1),
('a10006', '20eabe5d64b0e216796e834f52d61fd0b70332fc', 1),
('a10007', '20eabe5d64b0e216796e834f52d61fd0b70332fc', 2),
('a10008', '20eabe5d64b0e216796e834f52d61fd0b70332fc', 2),
('a10009', '20eabe5d64b0e216796e834f52d61fd0b70332fc', 2),
('a10010', '20eabe5d64b0e216796e834f52d61fd0b70332fc', 2),
('a10011', '20eabe5d64b0e216796e834f52d61fd0b70332fc', 2),
('a10012', '20eabe5d64b0e216796e834f52d61fd0b70332fc', 1),
('a10013', '20eabe5d64b0e216796e834f52d61fd0b70332fc', 2),
('a10014', '20eabe5d64b0e216796e834f52d61fd0b70332fc', 2),
('a10015', '20eabe5d64b0e216796e834f52d61fd0b70332fc', 2),
('a10016', '20eabe5d64b0e216796e834f52d61fd0b70332fc', 2),
('a10022', '20eabe5d64b0e216796e834f52d61fd0b70332fc', 2),
('a20001', '20eabe5d64b0e216796e834f52d61fd0b70332fc', 2),
('m10001', '20eabe5d64b0e216796e834f52d61fd0b70332fc', 2),
('m10006', '20eabe5d64b0e216796e834f52d61fd0b70332fc', 2),
('m10007', '20eabe5d64b0e216796e834f52d61fd0b70332fc', 2),
('s10001', '20eabe5d64b0e216796e834f52d61fd0b70332fc', 2),
('s10002', '20eabe5d64b0e216796e834f52d61fd0b70332fc', 2),
('s10008', '20eabe5d64b0e216796e834f52d61fd0b70332fc', 2);

-- --------------------------------------------------------

--
-- Structure for view `tabelabsenuser`
--
DROP TABLE IF EXISTS `tabelabsenuser`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `tabelabsenuser`  AS SELECT `pegawai`.`id_pegawai` AS `id_pegawai`, `absen`.`id_absen` AS `id_absen`, `pegawai`.`nama` AS `nama`, `absen`.`waktu` AS `waktu` FROM (`absen` join `pegawai`) WHERE `pegawai`.`id_pegawai` = `absen`.`id_pegawai` ;

-- --------------------------------------------------------

--
-- Structure for view `tabeldivisiinfo1`
--
DROP TABLE IF EXISTS `tabeldivisiinfo1`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `tabeldivisiinfo1`  AS SELECT `divisi`.`id_divisi` AS `id_divisi`, `divisi`.`nama_divisi` AS `nama_divisi`, count(`pegawai`.`id_pegawai`) AS `jml_pegawai`, `ketua`.`id_pegawai` AS `ketua` FROM ((`divisi` left join `pegawai` on(`divisi`.`id_divisi` = `pegawai`.`id_divisi`)) left join `ketua` on(`divisi`.`id_divisi` = `ketua`.`id_divisi`)) GROUP BY `divisi`.`id_divisi` ;

-- --------------------------------------------------------

--
-- Structure for view `tabelgajiuser`
--
DROP TABLE IF EXISTS `tabelgajiuser`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `tabelgajiuser`  AS SELECT `data_pegawai`.`id_pegawai` AS `id_pegawai`, `gaji`.`id_gaji` AS `id_gaji`, `data_pegawai`.`nama_pegawai` AS `nama_pegawai`, `gaji`.`tanggal` AS `tanggal`, `gaji`.`jumlah` AS `jumlah`, `gaji`.`bonus` AS `bonus`, (`gaji`.`jumlah` + `gaji`.`bonus`) * 0.05 AS `pajak`, `gaji`.`jumlah`+ `gaji`.`bonus` - (`gaji`.`jumlah` + `gaji`.`bonus`) * 0.05 AS `total` FROM (`gaji` join `data_pegawai`) WHERE `gaji`.`id_pegawai` = `data_pegawai`.`id_pegawai` ;

-- --------------------------------------------------------

--
-- Structure for view `tabelpegawaiadmin`
--
DROP TABLE IF EXISTS `tabelpegawaiadmin`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `tabelpegawaiadmin`  AS SELECT `data_pegawai`.`id_pegawai` AS `id_pegawai`, `data_pegawai`.`no_identitas` AS `no_identitas`, `data_pegawai`.`nama_pegawai` AS `nama_pegawai`, `data_pegawai`.`jenis_kelamin` AS `jenis_kelamin`, `data_pegawai`.`tempat_lahir` AS `tempat_lahir`, `data_pegawai`.`tanggal_lahir` AS `tanggal_lahir`, `data_pegawai`.`pendidikan` AS `pendidikan`, `data_pegawai`.`almamater` AS `almamater`, `data_pegawai`.`alamat` AS `alamat`, `data_pegawai`.`domisili` AS `domisili`, `data_pegawai`.`telepon` AS `telepon`, `data_pegawai`.`email` AS `email`, `data_pegawai`.`foto` AS `foto`, `divisi`.`nama_divisi` AS `nama_divisi`, `pegawai`.`jabatan` AS `jabatan`, `pegawai`.`status` AS `status` FROM ((`data_pegawai` join `pegawai` on(`data_pegawai`.`id_pegawai` = `pegawai`.`id_pegawai`)) join `divisi` on(`pegawai`.`id_divisi` = `divisi`.`id_divisi`)) ;

-- --------------------------------------------------------

--
-- Structure for view `tabelpegawaiuser`
--
DROP TABLE IF EXISTS `tabelpegawaiuser`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `tabelpegawaiuser`  AS SELECT `data_pegawai`.`id_pegawai` AS `id_pegawai`, `pegawai`.`nama` AS `nama_pegawai`, `divisi`.`nama_divisi` AS `nama_divisi`, `pegawai`.`jabatan` AS `jabatan`, `data_pegawai`.`telepon` AS `telepon`, `data_pegawai`.`foto` AS `foto` FROM ((`data_pegawai` join `divisi`) join `pegawai`) WHERE `pegawai`.`id_divisi` = `divisi`.`id_divisi` AND `data_pegawai`.`id_pegawai` = `pegawai`.`id_pegawai` ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `absen`
--
ALTER TABLE `absen`
  ADD PRIMARY KEY (`id_absen`),
  ADD KEY `id_pegawai` (`id_pegawai`);

--
-- Indexes for table `data_pegawai`
--
ALTER TABLE `data_pegawai`
  ADD PRIMARY KEY (`id_pegawai`);

--
-- Indexes for table `divisi`
--
ALTER TABLE `divisi`
  ADD PRIMARY KEY (`id_divisi`),
  ADD KEY `ketua` (`ketua`);

--
-- Indexes for table `gaji`
--
ALTER TABLE `gaji`
  ADD PRIMARY KEY (`id_gaji`),
  ADD KEY `id_pegawai` (`id_pegawai`);

--
-- Indexes for table `ketua`
--
ALTER TABLE `ketua`
  ADD UNIQUE KEY `id_divisi` (`id_divisi`) USING BTREE,
  ADD KEY `id_pegawai` (`id_pegawai`);

--
-- Indexes for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD UNIQUE KEY `id_pegawai` (`id_pegawai`),
  ADD KEY `id_divisi` (`id_divisi`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `absen`
--
ALTER TABLE `absen`
  MODIFY `id_absen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `gaji`
--
ALTER TABLE `gaji`
  MODIFY `id_gaji` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `absen`
--
ALTER TABLE `absen`
  ADD CONSTRAINT `fk_absensi` FOREIGN KEY (`id_pegawai`) REFERENCES `pegawai` (`id_pegawai`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `data_pegawai`
--
ALTER TABLE `data_pegawai`
  ADD CONSTRAINT `data_pegawai_ibfk_1` FOREIGN KEY (`id_pegawai`) REFERENCES `pegawai` (`id_pegawai`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `gaji`
--
ALTER TABLE `gaji`
  ADD CONSTRAINT `gaji_ibfk_1` FOREIGN KEY (`id_pegawai`) REFERENCES `pegawai` (`id_pegawai`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ketua`
--
ALTER TABLE `ketua`
  ADD CONSTRAINT `ketua_ibfk_1` FOREIGN KEY (`id_pegawai`) REFERENCES `pegawai` (`id_pegawai`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ketua_ibfk_2` FOREIGN KEY (`id_divisi`) REFERENCES `divisi` (`id_divisi`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD CONSTRAINT `pegawai_ibfk_2` FOREIGN KEY (`id_divisi`) REFERENCES `divisi` (`id_divisi`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`username`) REFERENCES `pegawai` (`id_pegawai`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
