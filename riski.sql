/*
 Navicat Premium Data Transfer

 Source Server         : .alternator MariaDB
 Source Server Type    : MariaDB
 Source Server Version : 100803
 Source Host           : localhost:3307
 Source Schema         : riski

 Target Server Type    : MariaDB
 Target Server Version : 100803
 File Encoding         : 65001

 Date: 14/01/2023 16:50:55
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for data_admin
-- ----------------------------
DROP TABLE IF EXISTS `data_admin`;
CREATE TABLE `data_admin`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nip` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `nama` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `terakhir_login` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `created_at` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `updated_at` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `deleted_at` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of data_admin
-- ----------------------------
INSERT INTO `data_admin` VALUES (1, '123', 'dewa', NULL, 'dewa', NULL, NULL, NULL);

-- ----------------------------
-- Table structure for data_anggota_dprd
-- ----------------------------
DROP TABLE IF EXISTS `data_anggota_dprd`;
CREATE TABLE `data_anggota_dprd`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `jabatan` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `created_at` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `updated_at` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `deleted_at` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of data_anggota_dprd
-- ----------------------------
INSERT INTO `data_anggota_dprd` VALUES (1, 'Adela Dewangga Baskova', 'AAA', '2023-01-13 17:20:52', '2023-01-14 07:50:30', NULL);
INSERT INTO `data_anggota_dprd` VALUES (2, 'Dewangga Satria Aji', 'BBB', '2023-01-14 07:50:13', '2023-01-14 07:50:13', NULL);

-- ----------------------------
-- Table structure for data_perangkat_daerah
-- ----------------------------
DROP TABLE IF EXISTS `data_perangkat_daerah`;
CREATE TABLE `data_perangkat_daerah`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `jabatan` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `created_at` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `updated_at` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `deleted_at` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of data_perangkat_daerah
-- ----------------------------
INSERT INTO `data_perangkat_daerah` VALUES (1, 'Adela', 'AAA', '2023-01-14 08:55:02', '2023-01-14 08:55:02', NULL);
INSERT INTO `data_perangkat_daerah` VALUES (2, 'rt', 'rt', '2023-01-14 09:03:07', '2023-01-14 09:03:07', NULL);

-- ----------------------------
-- Table structure for data_rapat
-- ----------------------------
DROP TABLE IF EXISTS `data_rapat`;
CREATE TABLE `data_rapat`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `judul_rapat` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `tanggal_rapat` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `kuorum_st` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `deskripsi_rapat` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `waktu` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `stat_aktif` tinyint(1) NULL DEFAULT 0,
  `created_at` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `updated_at` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `deleted_at` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of data_rapat
-- ----------------------------
INSERT INTO `data_rapat` VALUES (1, 'UU 69', '2023-01-13', NULL, 'yayaya', '13.00', 0, '2023-01-14 07:15:05', '2023-01-14 08:38:34', NULL);
INSERT INTO `data_rapat` VALUES (2, 'UU 70', '2023-01-14', NULL, '55555', '13.00', 1, '2023-01-14 07:52:28', '2023-01-14 08:38:34', NULL);

-- ----------------------------
-- Table structure for data_umum
-- ----------------------------
DROP TABLE IF EXISTS `data_umum`;
CREATE TABLE `data_umum`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `status` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `email` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `created_at` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `updated_at` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `deleted_at` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of data_umum
-- ----------------------------
INSERT INTO `data_umum` VALUES (1, 'ert', NULL, NULL, '2023-01-14 08:54:42', '2023-01-14 08:54:42', NULL);
INSERT INTO `data_umum` VALUES (2, 'umum', NULL, NULL, '2023-01-14 09:01:50', '2023-01-14 09:01:50', NULL);
INSERT INTO `data_umum` VALUES (3, 'kapi', 'kapi', 'kapi', '2023-01-14 09:10:00', '2023-01-14 09:10:00', NULL);
INSERT INTO `data_umum` VALUES (4, 'saya', 'saya', 'saya', '2023-01-14 09:10:19', '2023-01-14 09:10:19', NULL);

-- ----------------------------
-- Table structure for list_peserta
-- ----------------------------
DROP TABLE IF EXISTS `list_peserta`;
CREATE TABLE `list_peserta`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `list_rapat_id` int(11) NOT NULL,
  `created_at` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `updated_at` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `deleted_at` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of list_peserta
-- ----------------------------
INSERT INTO `list_peserta` VALUES (1, 'dewa2', 2, NULL, '2023-01-11 14:36:39', NULL);
INSERT INTO `list_peserta` VALUES (2, 'aji', 2, '2023-01-11 14:35:16', '2023-01-11 14:37:14', '2023-01-11 14:37:14');

-- ----------------------------
-- Table structure for list_rapat
-- ----------------------------
DROP TABLE IF EXISTS `list_rapat`;
CREATE TABLE `list_rapat`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tgl` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `created_at` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `updated_at` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `deleted_at` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of list_rapat
-- ----------------------------
INSERT INTO `list_rapat` VALUES (1, '2023.09.10', NULL, '2023-01-11 13:39:29', '2023-01-11 13:39:29');
INSERT INTO `list_rapat` VALUES (2, '2022.22.22', '2023-01-11 13:39:36', '2023-01-11 13:39:46', NULL);
INSERT INTO `list_rapat` VALUES (3, '2023-01-12', '2023-01-14 07:00:23', '2023-01-14 07:00:23', NULL);

-- ----------------------------
-- Table structure for relasi_rapat
-- ----------------------------
DROP TABLE IF EXISTS `relasi_rapat`;
CREATE TABLE `relasi_rapat`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rapat_id` int(11) NOT NULL,
  `umum_id` int(11) NOT NULL,
  `perangkat_daerah_id` int(11) NOT NULL,
  `anggota_dprd_id` int(11) NOT NULL,
  `created_at` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `updated_at` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `deleted_at` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of relasi_rapat
-- ----------------------------
INSERT INTO `relasi_rapat` VALUES (1, 2, 1, 0, 0, '2023-01-14 08:54:42', '2023-01-14 08:54:42', NULL);
INSERT INTO `relasi_rapat` VALUES (2, 2, 2, 0, 0, '2023-01-14 09:01:50', '2023-01-14 09:01:50', NULL);
INSERT INTO `relasi_rapat` VALUES (3, 2, 0, 2, 0, '2023-01-14 09:03:07', '2023-01-14 09:03:07', NULL);
INSERT INTO `relasi_rapat` VALUES (4, 2, 0, 0, 2, '2023-01-14 09:03:27', '2023-01-14 09:03:27', NULL);
INSERT INTO `relasi_rapat` VALUES (5, 2, 3, 0, 0, '2023-01-14 09:10:00', '2023-01-14 09:10:00', NULL);
INSERT INTO `relasi_rapat` VALUES (6, 1, 4, 0, 0, '2023-01-14 09:10:19', '2023-01-14 09:10:19', NULL);

SET FOREIGN_KEY_CHECKS = 1;
