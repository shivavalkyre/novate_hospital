/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 50724 (5.7.24)
 Source Host           : localhost:3306
 Source Schema         : db_hms

 Target Server Type    : MySQL
 Target Server Version : 50724 (5.7.24)
 File Encoding         : 65001

 Date: 19/10/2023 10:39:15
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for hms_fasilitas
-- ----------------------------
DROP TABLE IF EXISTS `hms_fasilitas`;
CREATE TABLE `hms_fasilitas`  (
  `FAS_ID` varchar(45) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `FAS_NAMA` varchar(45) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `FAS_LOKASI` varchar(45) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`FAS_ID`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of hms_fasilitas
-- ----------------------------
INSERT INTO `hms_fasilitas` VALUES ('20230927FAS0001', 'POLIKLINIK', 'Gedung A');
INSERT INTO `hms_fasilitas` VALUES ('20230928FAS0001', 'RUANG RAWAT INAP', 'Gedung B');
INSERT INTO `hms_fasilitas` VALUES ('20230928FAS0002', 'RUANG ICU', 'Gedung C');
INSERT INTO `hms_fasilitas` VALUES ('20230928FAS0003', 'KAMAR OPERASI', 'Gedung C');
INSERT INTO `hms_fasilitas` VALUES ('20230928FAS0004', 'RUANG MEDICAL CHECK UP', 'Gedung A');
INSERT INTO `hms_fasilitas` VALUES ('20230928FAS0005', 'FARMASI', 'Gedung D');
INSERT INTO `hms_fasilitas` VALUES ('20230928FAS0006', 'RUANG FISIOTERAPI', 'Gedung D');
INSERT INTO `hms_fasilitas` VALUES ('20230928FAS0007', 'LABORATORIUM', 'Gedung D');
INSERT INTO `hms_fasilitas` VALUES ('20230928FAS0008', 'RADIOLOGI', 'Gedung B');
INSERT INTO `hms_fasilitas` VALUES ('20231004FAS0001', 'KAMAR MANDI', 'Gedung F');

-- ----------------------------
-- Table structure for hms_jadwal
-- ----------------------------
DROP TABLE IF EXISTS `hms_jadwal`;
CREATE TABLE `hms_jadwal`  (
  `JAD_ID` varchar(45) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `FAS_ID` varchar(45) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `JAD_FAS_NAMA` varchar(45) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `JAD_JAM_MULAI` datetime NOT NULL,
  `JAD_JAM_SELESAI` datetime NOT NULL,
  PRIMARY KEY (`JAD_ID`) USING BTREE,
  INDEX `FK_1`(`FAS_ID`) USING BTREE,
  CONSTRAINT `FK_9` FOREIGN KEY (`FAS_ID`) REFERENCES `hms_fasilitas` (`FAS_ID`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of hms_jadwal
-- ----------------------------
INSERT INTO `hms_jadwal` VALUES ('20230928JAD0001', '20230927FAS0001', 'JADWAL POLIKLINIK', '2023-09-28 09:00:00', '2023-09-28 22:00:00');
INSERT INTO `hms_jadwal` VALUES ('20230928JAD0002', '20230928FAS0008', 'JADWAL RADIOLOGI', '2023-09-28 09:00:00', '2023-09-28 22:00:00');
INSERT INTO `hms_jadwal` VALUES ('20230928JAD0003', '20230927FAS0001', 'JADWAL POLIKLINIK', '2023-09-29 09:00:00', '2023-09-29 22:00:00');
INSERT INTO `hms_jadwal` VALUES ('20231004JAD0001', '20230927FAS0001', 'POLIKLINIK', '2023-10-04 12:29:08', '2023-10-04 12:29:08');

-- ----------------------------
-- Table structure for hms_jadwal_dtl
-- ----------------------------
DROP TABLE IF EXISTS `hms_jadwal_dtl`;
CREATE TABLE `hms_jadwal_dtl`  (
  `PAM_ID` varchar(45) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `JAD_ID` varchar(45) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `FAS_ID` varchar(45) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `JDT_NAMA` varchar(45) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `JDT_STATUS` varchar(45) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  INDEX `FK_1`(`PAM_ID`) USING BTREE,
  INDEX `FK_2`(`JAD_ID`) USING BTREE,
  INDEX `FK_3`(`FAS_ID`) USING BTREE,
  CONSTRAINT `FK_3` FOREIGN KEY (`PAM_ID`) REFERENCES `hms_paramedis` (`PAM_ID`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `FK_4` FOREIGN KEY (`JAD_ID`) REFERENCES `hms_jadwal` (`JAD_ID`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `FK_5` FOREIGN KEY (`FAS_ID`) REFERENCES `hms_fasilitas` (`FAS_ID`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of hms_jadwal_dtl
-- ----------------------------
INSERT INTO `hms_jadwal_dtl` VALUES ('20230928PAM0001', '20230928JAD0001', '20230927FAS0001', 'DOKTER GIGI', 'AKTIF');
INSERT INTO `hms_jadwal_dtl` VALUES ('20230928PAM0001', '20230928JAD0003', '20230927FAS0001', 'DOKTER GIGI', 'AKTIF');
INSERT INTO `hms_jadwal_dtl` VALUES ('20230928PAM0005', '20230928JAD0002', '20230928FAS0008', 'DOKTER RADIOLOGI', 'AKTIF');
INSERT INTO `hms_jadwal_dtl` VALUES ('20231004PAM0001', '20231004JAD0001', '20230927FAS0001', 'DOKTER KULIT', 'AKTIF');

-- ----------------------------
-- Table structure for hms_kunjungan
-- ----------------------------
DROP TABLE IF EXISTS `hms_kunjungan`;
CREATE TABLE `hms_kunjungan`  (
  `KUN_NO_ANTRI` varchar(45) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `KUN_TGL` datetime NOT NULL,
  `PAS_NO_REG` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `FAS_ID` varchar(45) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `JAD_ID` varchar(45) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`KUN_NO_ANTRI`) USING BTREE,
  INDEX `FK_1`(`PAS_NO_REG`) USING BTREE,
  INDEX `FK_2`(`FAS_ID`) USING BTREE,
  INDEX `FK_3`(`JAD_ID`) USING BTREE,
  CONSTRAINT `FK_1` FOREIGN KEY (`PAS_NO_REG`) REFERENCES `hms_pasien` (`PAS_NO_REG`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `FK_2` FOREIGN KEY (`FAS_ID`) REFERENCES `hms_fasilitas` (`FAS_ID`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `FK_8` FOREIGN KEY (`JAD_ID`) REFERENCES `hms_jadwal` (`JAD_ID`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of hms_kunjungan
-- ----------------------------
INSERT INTO `hms_kunjungan` VALUES ('20231004REG0001', '2023-10-04 05:48:07', '20230928REG0001', '20230927FAS0001', '20230928JAD0003');
INSERT INTO `hms_kunjungan` VALUES ('20231004REG0002', '2023-10-04 05:54:03', '20230928REG0001', '20230927FAS0001', '20230928JAD0003');
INSERT INTO `hms_kunjungan` VALUES ('20231004REG0003', '2023-10-04 12:33:34', '20231004REG0001', '20230927FAS0001', '20231004JAD0001');
INSERT INTO `hms_kunjungan` VALUES ('20231009REG0001', '2023-10-09 17:51:22', '20230928REG0001', '20230927FAS0001', '20230928JAD0001');

-- ----------------------------
-- Table structure for hms_paramedis
-- ----------------------------
DROP TABLE IF EXISTS `hms_paramedis`;
CREATE TABLE `hms_paramedis`  (
  `PAM_ID` varchar(45) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `PAM_NAMA` varchar(45) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `PAM_KATEGORI` varchar(45) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `PAM_KUALIFIKASI` varchar(45) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `PAM_MULAI_TUGAS` datetime NOT NULL,
  `PAM_STATUS` varchar(45) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`PAM_ID`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of hms_paramedis
-- ----------------------------
INSERT INTO `hms_paramedis` VALUES ('20230928PAM0001', 'JUNAIDI', 'DOKTER', 'DOKTER GIGI', '2023-09-28 14:14:19', 'AKTIF');
INSERT INTO `hms_paramedis` VALUES ('20230928PAM0002', 'RAHMAD', 'DOKTER', 'DOKTER OBGYN', '2023-09-28 14:13:44', 'AKTIF');
INSERT INTO `hms_paramedis` VALUES ('20230928PAM0003', 'BAMBANG HARSOYO', 'DOKTER', 'DOKTER ANAK', '2023-09-28 14:13:54', 'AKTIF');
INSERT INTO `hms_paramedis` VALUES ('20230928PAM0004', 'ANA SULISTIYANAH', 'DOKTER', 'DOKTER OBGYN', '2023-09-28 14:14:01', 'AKTIF');
INSERT INTO `hms_paramedis` VALUES ('20230928PAM0005', 'MAYA ESTIANTI', 'DOKTER', 'RADIOLOGI', '2023-09-28 15:00:18', 'AKTIF');
INSERT INTO `hms_paramedis` VALUES ('20231003PAM0006', 'DADANG', 'DOKTER', 'DOKTER ANAK', '2023-10-03 23:41:55', 'AKTIF');
INSERT INTO `hms_paramedis` VALUES ('20231004PAM0001', 'BOBON SANTOSO', 'DOKTER', 'DOKTER KULIT', '2023-10-04 12:28:41', 'AKTIF');

-- ----------------------------
-- Table structure for hms_pasien
-- ----------------------------
DROP TABLE IF EXISTS `hms_pasien`;
CREATE TABLE `hms_pasien`  (
  `PAS_NO_REG` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `PAS_NAMA_AWAL` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `PAS_NAMA_AKHIR` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `PAS_ALAMAT1` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `PAS_ALAMAT2` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `PAS_KOTA` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `PAS_PROVINSI` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `PAS_NEGARA` varchar(45) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`PAS_NO_REG`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of hms_pasien
-- ----------------------------
INSERT INTO `hms_pasien` VALUES ('20230928REG0001', 'SADAM', 'HUSEIN', 'S', 'M', 'S', 'M', 'S');
INSERT INTO `hms_pasien` VALUES ('20230928REG0002', 'BARRACK', 'OBAMA', 'U', 'A', 'A', 'I', 'A');
INSERT INTO `hms_pasien` VALUES ('20231004REG0001', 'JOKO', 'WIDODO', 'SURAKARTA', 'SOLO', 'SOLO', 'JAWA TENGAH', 'INDONESIA');

-- ----------------------------
-- Table structure for hms_rekam_medik
-- ----------------------------
DROP TABLE IF EXISTS `hms_rekam_medik`;
CREATE TABLE `hms_rekam_medik`  (
  `RMD_ID` varchar(45) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `PAS_NO_REG` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `RMD_PAS_NAMA` varchar(45) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `RMD_GOL_DARAH` varchar(45) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`RMD_ID`) USING BTREE,
  INDEX `FK_1`(`PAS_NO_REG`) USING BTREE,
  CONSTRAINT `FK_6` FOREIGN KEY (`PAS_NO_REG`) REFERENCES `hms_pasien` (`PAS_NO_REG`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of hms_rekam_medik
-- ----------------------------
INSERT INTO `hms_rekam_medik` VALUES ('20231004RMD0001', '20230928REG0001', 'A', 'A');
INSERT INTO `hms_rekam_medik` VALUES ('20231004RMD0002', '20230928REG0002', 'A', 'O');
INSERT INTO `hms_rekam_medik` VALUES ('20231004RMD0003', '20230928REG0001', 'S', 'AB');
INSERT INTO `hms_rekam_medik` VALUES ('20231004RMD0004', '20231004REG0001', 'JOKO', 'A');

-- ----------------------------
-- Table structure for hms_rmd_diagnosis
-- ----------------------------
DROP TABLE IF EXISTS `hms_rmd_diagnosis`;
CREATE TABLE `hms_rmd_diagnosis`  (
  `DIA_ID` varchar(45) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `DIA_TYPE` varchar(45) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `DIA_KETERANGAN` varchar(45) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `LYN_ID` varchar(45) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `USER_ID` varchar(45) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `NAMA_USER` varchar(45) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `PAM_ID` varchar(45) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`DIA_ID`) USING BTREE,
  INDEX `FK_1`(`LYN_ID`) USING BTREE,
  INDEX `FK_2`(`PAM_ID`) USING BTREE,
  CONSTRAINT `FK_14` FOREIGN KEY (`LYN_ID`) REFERENCES `hms_rmd_pelayanan` (`LYN_ID`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `FK_16` FOREIGN KEY (`PAM_ID`) REFERENCES `hms_paramedis` (`PAM_ID`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of hms_rmd_diagnosis
-- ----------------------------
INSERT INTO `hms_rmd_diagnosis` VALUES ('20231004DIA0001', 'A', 'A', '20231004LYN0001', 'A', 'A', '20230928PAM0001');
INSERT INTO `hms_rmd_diagnosis` VALUES ('20231004DIA0002', 'A', 'A', '20231004LYN0001', 'admin', 'admin', '20230928PAM0001');
INSERT INTO `hms_rmd_diagnosis` VALUES ('20231004DIA0003', 'A', 'PANU,KUDIS DAN KURAP', '20231004LYN0003', 'admin', 'admin', '20231004PAM0001');

-- ----------------------------
-- Table structure for hms_rmd_keluhan
-- ----------------------------
DROP TABLE IF EXISTS `hms_rmd_keluhan`;
CREATE TABLE `hms_rmd_keluhan`  (
  `KEL_ID` varchar(45) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `KEL_TYPE` varchar(45) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `KEL_KETERANGAN` varchar(45) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `LYN_ID` varchar(45) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `USER_ID` varchar(45) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `NAMA_USER` varchar(45) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `PAM_ID` varchar(45) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`KEL_ID`) USING BTREE,
  INDEX `FK_1`(`LYN_ID`) USING BTREE,
  INDEX `FK_2`(`PAM_ID`) USING BTREE,
  CONSTRAINT `FK_13_1` FOREIGN KEY (`LYN_ID`) REFERENCES `hms_rmd_pelayanan` (`LYN_ID`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `FK_17` FOREIGN KEY (`PAM_ID`) REFERENCES `hms_paramedis` (`PAM_ID`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of hms_rmd_keluhan
-- ----------------------------
INSERT INTO `hms_rmd_keluhan` VALUES ('20231004KEL0001', 'A', 'A', '20231004LYN0001', 'A', 'A', '20230928PAM0001');
INSERT INTO `hms_rmd_keluhan` VALUES ('20231004KEL0002', 'A', 'A', '20231004LYN0001', 'admin', 'admin', '20230928PAM0001');
INSERT INTO `hms_rmd_keluhan` VALUES ('20231004KEL0003', 'B', 'B', '20231004LYN0001', 'admin', 'admin', '20230928PAM0001');
INSERT INTO `hms_rmd_keluhan` VALUES ('20231004KEL0004', 'A', 'KULIT GATAL GATAL', '20231004LYN0003', 'admin', 'admin', '20231004PAM0001');

-- ----------------------------
-- Table structure for hms_rmd_pelayanan
-- ----------------------------
DROP TABLE IF EXISTS `hms_rmd_pelayanan`;
CREATE TABLE `hms_rmd_pelayanan`  (
  `LYN_ID` varchar(45) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `LYN_TANGGAL` datetime NOT NULL,
  `KUN_NO_ANTRI` varchar(45) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `RMD_ID` varchar(45) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`LYN_ID`) USING BTREE,
  INDEX `FK_1`(`KUN_NO_ANTRI`) USING BTREE,
  INDEX `FK_2`(`RMD_ID`) USING BTREE,
  CONSTRAINT `FK_12` FOREIGN KEY (`RMD_ID`) REFERENCES `hms_rekam_medik` (`RMD_ID`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `FK_12_1` FOREIGN KEY (`KUN_NO_ANTRI`) REFERENCES `hms_kunjungan` (`KUN_NO_ANTRI`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of hms_rmd_pelayanan
-- ----------------------------
INSERT INTO `hms_rmd_pelayanan` VALUES ('20231004LYN0001', '2023-10-04 06:12:36', '20231004REG0001', '20231004RMD0001');
INSERT INTO `hms_rmd_pelayanan` VALUES ('20231004LYN0002', '2023-10-04 11:49:41', '20231004REG0002', '20231004RMD0002');
INSERT INTO `hms_rmd_pelayanan` VALUES ('20231004LYN0003', '2023-10-04 12:34:30', '20231004REG0003', '20231004RMD0004');
INSERT INTO `hms_rmd_pelayanan` VALUES ('20231009LYN0001', '2023-10-09 17:51:50', '20231004REG0001', '20231004RMD0001');

-- ----------------------------
-- Table structure for hms_rmd_resep
-- ----------------------------
DROP TABLE IF EXISTS `hms_rmd_resep`;
CREATE TABLE `hms_rmd_resep`  (
  `RES_NO` varchar(45) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `RES_OBAT` varchar(45) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `RES_ATURAN_PAKAI` varchar(45) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `RES_DOSIS` varchar(45) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `RES_SATUAN` varchar(45) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `LYN_ID` varchar(45) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `PAM_ID` varchar(45) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`RES_NO`) USING BTREE,
  INDEX `FK_1`(`LYN_ID`) USING BTREE,
  INDEX `FK_2`(`PAM_ID`) USING BTREE,
  CONSTRAINT `FK_14_1` FOREIGN KEY (`LYN_ID`) REFERENCES `hms_rmd_pelayanan` (`LYN_ID`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `FK_15` FOREIGN KEY (`PAM_ID`) REFERENCES `hms_paramedis` (`PAM_ID`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of hms_rmd_resep
-- ----------------------------
INSERT INTO `hms_rmd_resep` VALUES ('20231004RES0001', 'A', '3x1 Setelah Makan', '1', 'PCS', '20231004LYN0001', '20230928PAM0001');
INSERT INTO `hms_rmd_resep` VALUES ('20231004RES0002', 'B', '2x1 Setelah Makan', '1', 'PCS', '20231004LYN0001', '20230928PAM0001');
INSERT INTO `hms_rmd_resep` VALUES ('20231004RES0003', 'C', '1x1 Sebelum Makan', '1', 'PCS', '20231004LYN0001', '20230928PAM0002');
INSERT INTO `hms_rmd_resep` VALUES ('20231004RES0004', 'KALPANAX', '3x1 Sebelum Makan', '1', 'BOTOL', '20231004LYN0003', '20231004PAM0001');

-- ----------------------------
-- Table structure for hms_rmd_tindakan
-- ----------------------------
DROP TABLE IF EXISTS `hms_rmd_tindakan`;
CREATE TABLE `hms_rmd_tindakan`  (
  `TIN_ID` varchar(45) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `TIN_TYPE` varchar(45) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `TIN_KETERANGAN` varchar(45) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `LYN_ID` varchar(45) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `PAM_ID` varchar(45) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`TIN_ID`) USING BTREE,
  INDEX `FK_1`(`LYN_ID`) USING BTREE,
  INDEX `FK_2`(`PAM_ID`) USING BTREE,
  CONSTRAINT `FK_13` FOREIGN KEY (`LYN_ID`) REFERENCES `hms_rmd_pelayanan` (`LYN_ID`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `FK_18` FOREIGN KEY (`PAM_ID`) REFERENCES `hms_paramedis` (`PAM_ID`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of hms_rmd_tindakan
-- ----------------------------
INSERT INTO `hms_rmd_tindakan` VALUES ('20231004TIN0001', 'A', 'A', '20231004LYN0001', '20230928PAM0001');
INSERT INTO `hms_rmd_tindakan` VALUES ('20231004TIN0002', 'B', 'B', '20231004LYN0001', '20230928PAM0002');
INSERT INTO `hms_rmd_tindakan` VALUES ('20231004TIN0003', 'A', 'AMPLAS KASAR', '20231004LYN0003', '20231004PAM0001');

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `level` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (1, 'Admin', '21232f297a57a5a743894a0e4a801fc3', 'Administrator');
INSERT INTO `users` VALUES (2, 'Petugas01', 'f14e84d5a12cd69c046fde1369af5844', 'Petugas');

-- ----------------------------
-- View structure for hms_diagnosis_view
-- ----------------------------
DROP VIEW IF EXISTS `hms_diagnosis_view`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `hms_diagnosis_view` AS SELECT
	hms_rmd_diagnosis.DIA_ID, 
	hms_rmd_diagnosis.DIA_TYPE, 
	hms_rmd_diagnosis.DIA_KETERANGAN, 
	hms_rmd_diagnosis.LYN_ID, 
	hms_rmd_diagnosis.USER_ID, 
	hms_rmd_diagnosis.NAMA_USER, 
	hms_rmd_diagnosis.PAM_ID, 
	hms_paramedis.PAM_NAMA
FROM
	hms_rmd_diagnosis
	INNER JOIN
	hms_paramedis
	ON 
		hms_rmd_diagnosis.PAM_ID = hms_paramedis.PAM_ID ;

-- ----------------------------
-- View structure for hms_jadwal_view
-- ----------------------------
DROP VIEW IF EXISTS `hms_jadwal_view`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `hms_jadwal_view` AS SELECT
	hms_jadwal.JAD_ID, 
	hms_jadwal.FAS_ID, 
	hms_fasilitas.FAS_NAMA, 
	hms_fasilitas.FAS_LOKASI, 
	hms_jadwal.JAD_FAS_NAMA, 
	hms_jadwal_dtl.JDT_NAMA, 
	hms_jadwal_dtl.JDT_STATUS, 
	hms_jadwal_dtl.PAM_ID, 
	hms_paramedis.PAM_NAMA, 
	hms_paramedis.PAM_KATEGORI, 
	hms_jadwal.JAD_JAM_MULAI, 
	hms_jadwal.JAD_JAM_SELESAI
FROM
	hms_jadwal
	LEFT JOIN
	hms_jadwal_dtl
	ON 
		hms_jadwal.JAD_ID = hms_jadwal_dtl.JAD_ID
	LEFT JOIN
	hms_fasilitas
	ON 
		hms_jadwal.FAS_ID = hms_fasilitas.FAS_ID AND
		hms_jadwal_dtl.FAS_ID = hms_fasilitas.FAS_ID
	LEFT JOIN
	hms_paramedis
	ON 
		hms_jadwal_dtl.PAM_ID = hms_paramedis.PAM_ID ;

-- ----------------------------
-- View structure for hms_keluhan_view
-- ----------------------------
DROP VIEW IF EXISTS `hms_keluhan_view`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `hms_keluhan_view` AS SELECT
	hms_rmd_keluhan.KEL_ID, 
	hms_rmd_keluhan.KEL_TYPE, 
	hms_rmd_keluhan.KEL_KETERANGAN, 
	hms_rmd_keluhan.LYN_ID, 
	hms_rmd_keluhan.USER_ID, 
	hms_rmd_keluhan.NAMA_USER, 
	hms_rmd_keluhan.PAM_ID, 
	hms_paramedis.PAM_NAMA
FROM
	hms_rmd_keluhan
	INNER JOIN
	hms_paramedis
	ON 
		hms_rmd_keluhan.PAM_ID = hms_paramedis.PAM_ID ;

-- ----------------------------
-- View structure for hms_kunjungan_view
-- ----------------------------
DROP VIEW IF EXISTS `hms_kunjungan_view`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `hms_kunjungan_view` AS SELECT
	hms_kunjungan.KUN_NO_ANTRI, 
	hms_kunjungan.KUN_TGL, 
	hms_kunjungan.PAS_NO_REG, 
	hms_pasien.PAS_NAMA_AWAL,
	hms_pasien.PAS_NAMA_AKHIR,
	hms_pasien.PAS_ALAMAT1, 
	hms_kunjungan.FAS_ID, 
	hms_jadwal_view.FAS_NAMA, 
	hms_jadwal_view.FAS_LOKASI, 
	hms_jadwal_view.JAD_FAS_NAMA, 
	hms_kunjungan.JAD_ID, 
	hms_jadwal_view.JDT_NAMA, 
	hms_jadwal_view.JDT_STATUS, 
	hms_jadwal_view.PAM_NAMA, 
	hms_jadwal_view.PAM_KATEGORI, 
	hms_jadwal_view.JAD_JAM_MULAI, 
	hms_jadwal_view.JAD_JAM_SELESAI
FROM
	hms_kunjungan
	INNER JOIN
	hms_pasien
	ON 
		hms_kunjungan.PAS_NO_REG = hms_pasien.PAS_NO_REG
	INNER JOIN
	hms_jadwal_view
	ON 
		hms_kunjungan.FAS_ID = hms_jadwal_view.FAS_ID AND
		hms_kunjungan.JAD_ID = hms_jadwal_view.JAD_ID ;

-- ----------------------------
-- View structure for hms_pelayanan_view
-- ----------------------------
DROP VIEW IF EXISTS `hms_pelayanan_view`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `hms_pelayanan_view` AS SELECT
	hms_rmd_pelayanan.LYN_ID, 
	hms_rmd_pelayanan.LYN_TANGGAL, 
	hms_kunjungan.KUN_TGL, 
	hms_rekam_medik.RMD_PAS_NAMA, 
	hms_rekam_medik.RMD_GOL_DARAH, 
	hms_rmd_pelayanan.KUN_NO_ANTRI, 
	hms_rmd_pelayanan.RMD_ID
FROM
	hms_rmd_pelayanan
	INNER JOIN
	hms_kunjungan
	ON 
		hms_rmd_pelayanan.KUN_NO_ANTRI = hms_kunjungan.KUN_NO_ANTRI
	INNER JOIN
	hms_rekam_medik
	ON 
		hms_rmd_pelayanan.RMD_ID = hms_rekam_medik.RMD_ID ;

-- ----------------------------
-- View structure for hms_resep_view
-- ----------------------------
DROP VIEW IF EXISTS `hms_resep_view`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `hms_resep_view` AS SELECT
	hms_rmd_resep.RES_NO, 
	hms_rmd_resep.RES_OBAT, 
	hms_rmd_resep.RES_ATURAN_PAKAI, 
	hms_rmd_resep.RES_DOSIS, 
	hms_rmd_resep.RES_SATUAN, 
	hms_rmd_resep.LYN_ID, 
	hms_rmd_resep.PAM_ID, 
	hms_paramedis.PAM_NAMA
FROM
	hms_rmd_resep
	INNER JOIN
	hms_paramedis
	ON 
		hms_rmd_resep.PAM_ID = hms_paramedis.PAM_ID ;

-- ----------------------------
-- View structure for hms_tindakan_view
-- ----------------------------
DROP VIEW IF EXISTS `hms_tindakan_view`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `hms_tindakan_view` AS SELECT
	hms_rmd_tindakan.TIN_ID, 
	hms_rmd_tindakan.TIN_TYPE, 
	hms_rmd_tindakan.TIN_KETERANGAN, 
	hms_rmd_tindakan.LYN_ID, 
	hms_rmd_tindakan.PAM_ID, 
	hms_paramedis.PAM_NAMA
FROM
	hms_rmd_tindakan
	INNER JOIN
	hms_paramedis
	ON 
		hms_rmd_tindakan.PAM_ID = hms_paramedis.PAM_ID ;

-- ----------------------------
-- View structure for lyn_rekam_medik_view
-- ----------------------------
DROP VIEW IF EXISTS `lyn_rekam_medik_view`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `lyn_rekam_medik_view` AS SELECT
	hms_rmd_pelayanan.LYN_ID, 
	hms_rmd_pelayanan.LYN_TANGGAL, 
	hms_rmd_pelayanan.KUN_NO_ANTRI, 
	hms_rmd_pelayanan.RMD_ID, 
	hms_rekam_medik.PAS_NO_REG, 
	hms_rekam_medik.RMD_PAS_NAMA, 
	hms_rekam_medik.RMD_GOL_DARAH, 
	hms_rmd_keluhan.KEL_TYPE, 
	hms_rmd_keluhan.KEL_KETERANGAN, 
	hms_rmd_keluhan.PAM_ID, 
	hms_rmd_diagnosis.DIA_TYPE, 
	hms_rmd_diagnosis.DIA_KETERANGAN, 
	hms_rmd_tindakan.TIN_TYPE, 
	hms_rmd_tindakan.TIN_KETERANGAN, 
	hms_rmd_resep.RES_NO, 
	hms_rmd_resep.RES_OBAT, 
	hms_rmd_resep.RES_ATURAN_PAKAI, 
	hms_rmd_resep.RES_DOSIS, 
	hms_rmd_resep.RES_SATUAN
FROM
	hms_rmd_pelayanan
	INNER JOIN
	hms_rekam_medik
	ON 
		hms_rmd_pelayanan.RMD_ID = hms_rekam_medik.RMD_ID
	INNER JOIN
	hms_rmd_keluhan
	ON 
		hms_rmd_pelayanan.LYN_ID = hms_rmd_keluhan.LYN_ID
	INNER JOIN
	hms_rmd_diagnosis
	ON 
		hms_rmd_pelayanan.LYN_ID = hms_rmd_diagnosis.LYN_ID
	INNER JOIN
	hms_rmd_tindakan
	ON 
		hms_rmd_pelayanan.LYN_ID = hms_rmd_tindakan.LYN_ID
	INNER JOIN
	hms_rmd_resep
	ON 
		hms_rmd_pelayanan.LYN_ID = hms_rmd_resep.LYN_ID ;

-- ----------------------------
-- Triggers structure for table hms_fasilitas
-- ----------------------------
DROP TRIGGER IF EXISTS `NoFas`;
delimiter ;;
CREATE TRIGGER `NoFas` BEFORE INSERT ON `hms_fasilitas` FOR EACH ROW begin
       if new.FAS_ID is null then
         set new.FAS_ID := (
SELECT 
CASE 
 WHEN (SELECT  MID((SELECT MAX(FAS_ID) from hms_fasilitas),1,8)) = (SELECT CONCAT(YEAR(CURRENT_DATE),IF(MONTH(CURRENT_DATE)<10,CONCAT("0",MONTH(CURRENT_DATE)),MONTH(CURRENT_DATE)),IF(DAY(CURRENT_DATE)<10,CONCAT("0",DAY(CURRENT_DATE)),DAY(CURRENT_DATE)))) THEN 
		/* "Sama, ambil no berikut" */
		(SELECT CONCAT(YEAR(CURRENT_DATE),IF(MONTH(CURRENT_DATE)<10,CONCAT("0",MONTH(CURRENT_DATE)),MONTH(CURRENT_DATE)),IF(DAY(CURRENT_DATE)<10,CONCAT("0",DAY(CURRENT_DATE)),DAY(CURRENT_DATE)),"FAS",(SELECT LPAD((SELECT CAST((SELECT  MID((SELECT MAX(FAS_ID) from hms_fasilitas),12,4) AS DT) AS SIGNED)+1 AS RES),4,0))) AS RES)
 ELSE 
		/*"Beda,nomor baru" */
		(SELECT CONCAT(YEAR(CURRENT_DATE),IF(MONTH(CURRENT_DATE)<10,CONCAT("0",MONTH(CURRENT_DATE)),MONTH(CURRENT_DATE)),IF(DAY(CURRENT_DATE)<10,CONCAT("0",DAY(CURRENT_DATE)),DAY(CURRENT_DATE)),"FAS","0001"))
END
AS RES
				 )
						;
			 end if;
			 
 end
;;
delimiter ;

-- ----------------------------
-- Triggers structure for table hms_jadwal
-- ----------------------------
DROP TRIGGER IF EXISTS `JJadId`;
delimiter ;;
CREATE TRIGGER `JJadId` BEFORE INSERT ON `hms_jadwal` FOR EACH ROW begin
       if new.JAD_ID is null then
         set new.JAD_ID := (
				 
				 				SELECT 
CASE 
 WHEN (SELECT  MID((SELECT MAX(JAD_ID) from hms_jadwal),1,8)) = (SELECT CONCAT(YEAR(CURRENT_DATE),IF(MONTH(CURRENT_DATE)<10,CONCAT("0",MONTH(CURRENT_DATE)),MONTH(CURRENT_DATE)),IF(DAY(CURRENT_DATE)<10,CONCAT("0",DAY(CURRENT_DATE)),DAY(CURRENT_DATE)))) THEN 
		/* "Sama, ambil no berikut" */
		(SELECT CONCAT(YEAR(CURRENT_DATE),IF(MONTH(CURRENT_DATE)<10,CONCAT("0",MONTH(CURRENT_DATE)),MONTH(CURRENT_DATE)),IF(DAY(CURRENT_DATE)<10,CONCAT("0",DAY(CURRENT_DATE)),DAY(CURRENT_DATE)),"JAD",(SELECT LPAD((SELECT CAST((SELECT  MID((SELECT MAX(JAD_ID) from hms_jadwal),12,4) AS DT) AS SIGNED)+1 AS RES),4,0))) AS RES)
 ELSE 
		/*"Beda,nomor baru" */
		(SELECT CONCAT(YEAR(CURRENT_DATE),IF(MONTH(CURRENT_DATE)<10,CONCAT("0",MONTH(CURRENT_DATE)),MONTH(CURRENT_DATE)),IF(DAY(CURRENT_DATE)<10,CONCAT("0",DAY(CURRENT_DATE)),DAY(CURRENT_DATE)),"JAD","0001"))
END
AS RES
				 
				 );
			  end if;
 end
;;
delimiter ;

-- ----------------------------
-- Triggers structure for table hms_kunjungan
-- ----------------------------
DROP TRIGGER IF EXISTS `No_Kun`;
delimiter ;;
CREATE TRIGGER `No_Kun` BEFORE INSERT ON `hms_kunjungan` FOR EACH ROW begin
       if new.KUN_NO_ANTRI is null then
         set new.KUN_NO_ANTRI := (
			SELECT 
CASE 
 WHEN (SELECT  MID((SELECT MAX(KUN_NO_ANTRI) from hms_kunjungan),1,8)) = (SELECT CONCAT(YEAR(CURRENT_DATE),IF(MONTH(CURRENT_DATE)<10,CONCAT("0",MONTH(CURRENT_DATE)),MONTH(CURRENT_DATE)),IF(DAY(CURRENT_DATE)<10,CONCAT("0",DAY(CURRENT_DATE)),DAY(CURRENT_DATE)))) THEN 
		/* "Sama, ambil no berikut" */
		(SELECT CONCAT(YEAR(CURRENT_DATE),IF(MONTH(CURRENT_DATE)<10,CONCAT("0",MONTH(CURRENT_DATE)),MONTH(CURRENT_DATE)),IF(DAY(CURRENT_DATE)<10,CONCAT("0",DAY(CURRENT_DATE)),DAY(CURRENT_DATE)),"REG",(SELECT LPAD((SELECT CAST((SELECT  MID((SELECT MAX(KUN_NO_ANTRI) from hms_kunjungan),12,4) AS DT) AS SIGNED)+1 AS RES),4,0))) AS RES)
 ELSE 
		/*"Beda,nomor baru" */
		(SELECT CONCAT(YEAR(CURRENT_DATE),IF(MONTH(CURRENT_DATE)<10,CONCAT("0",MONTH(CURRENT_DATE)),MONTH(CURRENT_DATE)),IF(DAY(CURRENT_DATE)<10,CONCAT("0",DAY(CURRENT_DATE)),DAY(CURRENT_DATE)),"REG","0001"))
END
AS RES
				 )
						;
			 end if;
			 
 end
;;
delimiter ;

-- ----------------------------
-- Triggers structure for table hms_paramedis
-- ----------------------------
DROP TRIGGER IF EXISTS `PamId`;
delimiter ;;
CREATE TRIGGER `PamId` BEFORE INSERT ON `hms_paramedis` FOR EACH ROW begin
       if new.PAM_ID is null then
         set new.PAM_ID := (
				 SELECT 
CASE 
 WHEN (SELECT  MID((SELECT MAX(PAM_ID) from hms_paramedis),1,8)) = (SELECT CONCAT(YEAR(CURRENT_DATE),IF(MONTH(CURRENT_DATE)<10,CONCAT("0",MONTH(CURRENT_DATE)),MONTH(CURRENT_DATE)),IF(DAY(CURRENT_DATE)<10,CONCAT("0",DAY(CURRENT_DATE)),DAY(CURRENT_DATE)))) THEN 
		/* "Sama, ambil no berikut" */
		(SELECT CONCAT(YEAR(CURRENT_DATE),IF(MONTH(CURRENT_DATE)<10,CONCAT("0",MONTH(CURRENT_DATE)),MONTH(CURRENT_DATE)),IF(DAY(CURRENT_DATE)<10,CONCAT("0",DAY(CURRENT_DATE)),DAY(CURRENT_DATE)),"PAM",(SELECT LPAD((SELECT CAST((SELECT  MID((SELECT MAX(PAM_ID) from hms_paramedis),12,4) AS DT) AS SIGNED)+1 AS RES),4,0))) AS RES)
 ELSE 
		/*"Beda,nomor baru" */
		(SELECT CONCAT(YEAR(CURRENT_DATE),IF(MONTH(CURRENT_DATE)<10,CONCAT("0",MONTH(CURRENT_DATE)),MONTH(CURRENT_DATE)),IF(DAY(CURRENT_DATE)<10,CONCAT("0",DAY(CURRENT_DATE)),DAY(CURRENT_DATE)),"PAM","0001"))
END
AS RES
				 
				 );
			  end if;
 end
;;
delimiter ;

-- ----------------------------
-- Triggers structure for table hms_pasien
-- ----------------------------
DROP TRIGGER IF EXISTS `REGNO`;
delimiter ;;
CREATE TRIGGER `REGNO` BEFORE INSERT ON `hms_pasien` FOR EACH ROW begin
       if new.PAS_NO_REG is null then
         set new.PAS_NO_REG := (
SELECT 
CASE 
 WHEN (SELECT  MID((SELECT MAX(PAS_NO_REG) from hms_pasien),1,8)) = (SELECT CONCAT(YEAR(CURRENT_DATE),IF(MONTH(CURRENT_DATE)<10,CONCAT("0",MONTH(CURRENT_DATE)),MONTH(CURRENT_DATE)),IF(DAY(CURRENT_DATE)<10,CONCAT("0",DAY(CURRENT_DATE)),DAY(CURRENT_DATE)))) THEN 
		/* "Sama, ambil no berikut" */
		(SELECT CONCAT(YEAR(CURRENT_DATE),IF(MONTH(CURRENT_DATE)<10,CONCAT("0",MONTH(CURRENT_DATE)),MONTH(CURRENT_DATE)),IF(DAY(CURRENT_DATE)<10,CONCAT("0",DAY(CURRENT_DATE)),DAY(CURRENT_DATE)),"REG",(SELECT LPAD((SELECT CAST((SELECT  MID((SELECT MAX(PAS_NO_REG) from hms_pasien),12,4) AS DT) AS SIGNED)+1 AS RES),4,0))) AS RES)
 ELSE 
		/*"Beda,nomor baru" */
		(SELECT CONCAT(YEAR(CURRENT_DATE),IF(MONTH(CURRENT_DATE)<10,CONCAT("0",MONTH(CURRENT_DATE)),MONTH(CURRENT_DATE)),IF(DAY(CURRENT_DATE)<10,CONCAT("0",DAY(CURRENT_DATE)),DAY(CURRENT_DATE)),"REG","0001"))
END
AS RES
				 );
			 end if;
			 
 end
;;
delimiter ;

-- ----------------------------
-- Triggers structure for table hms_rekam_medik
-- ----------------------------
DROP TRIGGER IF EXISTS `RMD_ID`;
delimiter ;;
CREATE TRIGGER `RMD_ID` BEFORE INSERT ON `hms_rekam_medik` FOR EACH ROW begin
       if new.RMD_ID is null then
         set new.RMD_ID := (
SELECT 
CASE 
 WHEN (SELECT  MID((SELECT MAX(RMD_ID) from hms_rekam_medik),1,8)) = (SELECT CONCAT(YEAR(CURRENT_DATE),IF(MONTH(CURRENT_DATE)<10,CONCAT("0",MONTH(CURRENT_DATE)),MONTH(CURRENT_DATE)),IF(DAY(CURRENT_DATE)<10,CONCAT("0",DAY(CURRENT_DATE)),DAY(CURRENT_DATE)))) THEN 
		/* "Sama, ambil no berikut" */
		(SELECT CONCAT(YEAR(CURRENT_DATE),IF(MONTH(CURRENT_DATE)<10,CONCAT("0",MONTH(CURRENT_DATE)),MONTH(CURRENT_DATE)),IF(DAY(CURRENT_DATE)<10,CONCAT("0",DAY(CURRENT_DATE)),DAY(CURRENT_DATE)),"RMD",(SELECT LPAD((SELECT CAST((SELECT  MID((SELECT MAX(RMD_ID) from hms_rekam_medik),12,4) AS DT) AS SIGNED)+1 AS RES),4,0))) AS RES)
 ELSE 
		/*"Beda,nomor baru" */
		(SELECT CONCAT(YEAR(CURRENT_DATE),IF(MONTH(CURRENT_DATE)<10,CONCAT("0",MONTH(CURRENT_DATE)),MONTH(CURRENT_DATE)),IF(DAY(CURRENT_DATE)<10,CONCAT("0",DAY(CURRENT_DATE)),DAY(CURRENT_DATE)),"RMD","0001"))
END
AS RES
				 );
			 end if;
			 
 end
;;
delimiter ;

-- ----------------------------
-- Triggers structure for table hms_rmd_diagnosis
-- ----------------------------
DROP TRIGGER IF EXISTS `DIA_ID`;
delimiter ;;
CREATE TRIGGER `DIA_ID` BEFORE INSERT ON `hms_rmd_diagnosis` FOR EACH ROW begin
       if new.DIA_ID is null then
         set new.DIA_ID := (
SELECT 
CASE 
 WHEN (SELECT  MID((SELECT MAX(DIA_ID) from hms_rmd_diagnosis),1,8)) = (SELECT CONCAT(YEAR(CURRENT_DATE),IF(MONTH(CURRENT_DATE)<10,CONCAT("0",MONTH(CURRENT_DATE)),MONTH(CURRENT_DATE)),IF(DAY(CURRENT_DATE)<10,CONCAT("0",DAY(CURRENT_DATE)),DAY(CURRENT_DATE)))) THEN 
		/* "Sama, ambil no berikut" */
		(SELECT CONCAT(YEAR(CURRENT_DATE),IF(MONTH(CURRENT_DATE)<10,CONCAT("0",MONTH(CURRENT_DATE)),MONTH(CURRENT_DATE)),IF(DAY(CURRENT_DATE)<10,CONCAT("0",DAY(CURRENT_DATE)),DAY(CURRENT_DATE)),"DIA",(SELECT LPAD((SELECT CAST((SELECT  MID((SELECT MAX(DIA_ID) from hms_rmd_diagnosis),12,4) AS DT) AS SIGNED)+1 AS RES),4,0))) AS RES)
 ELSE 
		/*"Beda,nomor baru" */
		(SELECT CONCAT(YEAR(CURRENT_DATE),IF(MONTH(CURRENT_DATE)<10,CONCAT("0",MONTH(CURRENT_DATE)),MONTH(CURRENT_DATE)),IF(DAY(CURRENT_DATE)<10,CONCAT("0",DAY(CURRENT_DATE)),DAY(CURRENT_DATE)),"DIA","0001"))
END
AS RES
				 );
			 end if;
			 
 end
;;
delimiter ;

-- ----------------------------
-- Triggers structure for table hms_rmd_keluhan
-- ----------------------------
DROP TRIGGER IF EXISTS `KELID`;
delimiter ;;
CREATE TRIGGER `KELID` BEFORE INSERT ON `hms_rmd_keluhan` FOR EACH ROW begin
       if new.KEL_ID is null then
         set new.KEL_ID := (
SELECT 
CASE 
 WHEN (SELECT  MID((SELECT MAX(KEL_ID) from hms_rmd_keluhan),1,8)) = (SELECT CONCAT(YEAR(CURRENT_DATE),IF(MONTH(CURRENT_DATE)<10,CONCAT("0",MONTH(CURRENT_DATE)),MONTH(CURRENT_DATE)),IF(DAY(CURRENT_DATE)<10,CONCAT("0",DAY(CURRENT_DATE)),DAY(CURRENT_DATE)))) THEN 
		/* "Sama, ambil no berikut" */
		(SELECT CONCAT(YEAR(CURRENT_DATE),IF(MONTH(CURRENT_DATE)<10,CONCAT("0",MONTH(CURRENT_DATE)),MONTH(CURRENT_DATE)),IF(DAY(CURRENT_DATE)<10,CONCAT("0",DAY(CURRENT_DATE)),DAY(CURRENT_DATE)),"KEL",(SELECT LPAD((SELECT CAST((SELECT  MID((SELECT MAX(KEL_ID) from hms_rmd_keluhan),12,4) AS DT) AS SIGNED)+1 AS RES),4,0))) AS RES)
 ELSE 
		/*"Beda,nomor baru" */
		(SELECT CONCAT(YEAR(CURRENT_DATE),IF(MONTH(CURRENT_DATE)<10,CONCAT("0",MONTH(CURRENT_DATE)),MONTH(CURRENT_DATE)),IF(DAY(CURRENT_DATE)<10,CONCAT("0",DAY(CURRENT_DATE)),DAY(CURRENT_DATE)),"KEL","0001"))
END
AS RES
				 );
			 end if;
			 
 end
;;
delimiter ;

-- ----------------------------
-- Triggers structure for table hms_rmd_pelayanan
-- ----------------------------
DROP TRIGGER IF EXISTS `LYN_ID`;
delimiter ;;
CREATE TRIGGER `LYN_ID` BEFORE INSERT ON `hms_rmd_pelayanan` FOR EACH ROW begin
       if new.LYN_ID is null then
         set new.LYN_ID := (
SELECT 
CASE 
 WHEN (SELECT  MID((SELECT MAX(LYN_ID) from hms_rmd_pelayanan),1,8)) = (SELECT CONCAT(YEAR(CURRENT_DATE),IF(MONTH(CURRENT_DATE)<10,CONCAT("0",MONTH(CURRENT_DATE)),MONTH(CURRENT_DATE)),IF(DAY(CURRENT_DATE)<10,CONCAT("0",DAY(CURRENT_DATE)),DAY(CURRENT_DATE)))) THEN 
		/* "Sama, ambil no berikut" */
		(SELECT CONCAT(YEAR(CURRENT_DATE),IF(MONTH(CURRENT_DATE)<10,CONCAT("0",MONTH(CURRENT_DATE)),MONTH(CURRENT_DATE)),IF(DAY(CURRENT_DATE)<10,CONCAT("0",DAY(CURRENT_DATE)),DAY(CURRENT_DATE)),"LYN",(SELECT LPAD((SELECT CAST((SELECT  MID((SELECT MAX(LYN_ID) from hms_rmd_pelayanan),12,4) AS DT) AS SIGNED)+1 AS RES),4,0))) AS RES)
 ELSE 
		/*"Beda,nomor baru" */
		(SELECT CONCAT(YEAR(CURRENT_DATE),IF(MONTH(CURRENT_DATE)<10,CONCAT("0",MONTH(CURRENT_DATE)),MONTH(CURRENT_DATE)),IF(DAY(CURRENT_DATE)<10,CONCAT("0",DAY(CURRENT_DATE)),DAY(CURRENT_DATE)),"LYN","0001"))
END
AS RES
				 );
			 end if;
			 
 end
;;
delimiter ;

-- ----------------------------
-- Triggers structure for table hms_rmd_resep
-- ----------------------------
DROP TRIGGER IF EXISTS `RES_NO`;
delimiter ;;
CREATE TRIGGER `RES_NO` BEFORE INSERT ON `hms_rmd_resep` FOR EACH ROW begin
       if new.RES_NO is null then
         set new.RES_NO := (
SELECT 
CASE 
 WHEN (SELECT  MID((SELECT MAX(RES_NO) from hms_rmd_resep),1,8)) = (SELECT CONCAT(YEAR(CURRENT_DATE),IF(MONTH(CURRENT_DATE)<10,CONCAT("0",MONTH(CURRENT_DATE)),MONTH(CURRENT_DATE)),IF(DAY(CURRENT_DATE)<10,CONCAT("0",DAY(CURRENT_DATE)),DAY(CURRENT_DATE)))) THEN 
		/* "Sama, ambil no berikut" */
		(SELECT CONCAT(YEAR(CURRENT_DATE),IF(MONTH(CURRENT_DATE)<10,CONCAT("0",MONTH(CURRENT_DATE)),MONTH(CURRENT_DATE)),IF(DAY(CURRENT_DATE)<10,CONCAT("0",DAY(CURRENT_DATE)),DAY(CURRENT_DATE)),"RES",(SELECT LPAD((SELECT CAST((SELECT  MID((SELECT MAX(RES_NO) from hms_rmd_resep),12,4) AS DT) AS SIGNED)+1 AS RES),4,0))) AS RES)
 ELSE 
		/*"Beda,nomor baru" */
		(SELECT CONCAT(YEAR(CURRENT_DATE),IF(MONTH(CURRENT_DATE)<10,CONCAT("0",MONTH(CURRENT_DATE)),MONTH(CURRENT_DATE)),IF(DAY(CURRENT_DATE)<10,CONCAT("0",DAY(CURRENT_DATE)),DAY(CURRENT_DATE)),"RES","0001"))
END
AS RES
				 );
			 end if;
			 
 end
;;
delimiter ;

-- ----------------------------
-- Triggers structure for table hms_rmd_tindakan
-- ----------------------------
DROP TRIGGER IF EXISTS `TIN_ID`;
delimiter ;;
CREATE TRIGGER `TIN_ID` BEFORE INSERT ON `hms_rmd_tindakan` FOR EACH ROW begin
       if new.TIN_ID is null then
         set new.TIN_ID := (
SELECT 
CASE 
 WHEN (SELECT  MID((SELECT MAX(TIN_ID) from hms_rmd_tindakan),1,8)) = (SELECT CONCAT(YEAR(CURRENT_DATE),IF(MONTH(CURRENT_DATE)<10,CONCAT("0",MONTH(CURRENT_DATE)),MONTH(CURRENT_DATE)),IF(DAY(CURRENT_DATE)<10,CONCAT("0",DAY(CURRENT_DATE)),DAY(CURRENT_DATE)))) THEN 
		/* "Sama, ambil no berikut" */
		(SELECT CONCAT(YEAR(CURRENT_DATE),IF(MONTH(CURRENT_DATE)<10,CONCAT("0",MONTH(CURRENT_DATE)),MONTH(CURRENT_DATE)),IF(DAY(CURRENT_DATE)<10,CONCAT("0",DAY(CURRENT_DATE)),DAY(CURRENT_DATE)),"TIN",(SELECT LPAD((SELECT CAST((SELECT  MID((SELECT MAX(TIN_ID) from hms_rmd_tindakan),12,4) AS DT) AS SIGNED)+1 AS RES),4,0))) AS RES)
 ELSE 
		/*"Beda,nomor baru" */
		(SELECT CONCAT(YEAR(CURRENT_DATE),IF(MONTH(CURRENT_DATE)<10,CONCAT("0",MONTH(CURRENT_DATE)),MONTH(CURRENT_DATE)),IF(DAY(CURRENT_DATE)<10,CONCAT("0",DAY(CURRENT_DATE)),DAY(CURRENT_DATE)),"TIN","0001"))
END
AS RES
				 );
			 end if;
			 
 end
;;
delimiter ;

SET FOREIGN_KEY_CHECKS = 1;
