/*
 Navicat Premium Data Transfer

 Source Server         : conn-lns
 Source Server Type    : MySQL
 Source Server Version : 50723
 Source Host           : localhost:8889
 Source Schema         : ss_db

 Target Server Type    : MySQL
 Target Server Version : 50723
 File Encoding         : 65001

 Date: 08/08/2019 14:47:16
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for admin
-- ----------------------------
DROP TABLE IF EXISTS `admin`;
CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '管理员',
  `admin_name` varchar(255) DEFAULT NULL,
  `admin_pwd` varchar(255) DEFAULT NULL,
  `admin_phone` varchar(11) DEFAULT NULL,
  `admin_note` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`admin_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of admin
-- ----------------------------
BEGIN;
INSERT INTO `admin` VALUES (1, '李老板', '123456', '18888888888', NULL);
INSERT INTO `admin` VALUES (2, '王老板', '123456', '18888888888', NULL);
COMMIT;

-- ----------------------------
-- Table structure for car
-- ----------------------------
DROP TABLE IF EXISTS `car`;
CREATE TABLE `car` (
  `car_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '购物车',
  `client_id` int(11) DEFAULT NULL,
  `water_id` int(11) DEFAULT NULL,
  `car_num` int(11) DEFAULT NULL,
  `car_sum` float(11,1) DEFAULT NULL,
  `car_note` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`car_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of car
-- ----------------------------
BEGIN;
INSERT INTO `car` VALUES (2, 2, 17, 2, 40.0, NULL);
COMMIT;

-- ----------------------------
-- Table structure for client
-- ----------------------------
DROP TABLE IF EXISTS `client`;
CREATE TABLE `client` (
  `client_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '客户',
  `client_name` varchar(255) DEFAULT NULL,
  `client_pwd` varchar(18) DEFAULT NULL,
  `client_time` datetime DEFAULT NULL,
  `client_phone` varchar(11) DEFAULT NULL,
  `client_add` varchar(255) DEFAULT NULL,
  `client_note` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`client_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of client
-- ----------------------------
BEGIN;
INSERT INTO `client` VALUES (1, '王客户', '123456', '2019-04-11 14:47:05', '13899993239', '南宁青秀区B路222号', '');
INSERT INTO `client` VALUES (2, '李客户', '123456', '2019-04-16 22:50:05', '13899997832', '南宁西乡塘B路4号', NULL);
INSERT INTO `client` VALUES (3, '梁客户', '123456', '2019-04-16 23:20:00', '13899992342', '南宁高新区B路8号', NULL);
INSERT INTO `client` VALUES (4, '韦客户', '123456', '2019-04-16 23:51:22', '13899998739', '南宁兴宁区B路12号', NULL);
INSERT INTO `client` VALUES (5, '曹客户', '123456', '2019-04-16 23:41:22', '13899993452', '南宁青秀区B路121号', NULL);
INSERT INTO `client` VALUES (6, '金客户', '123456', '2019-04-26 23:51:22', '13899997648', '南宁西乡塘B路123号', NULL);
INSERT INTO `client` VALUES (7, '刘客户', '123456', '2019-04-16 13:51:22', '13899993453', '南宁青秀区B路132号', NULL);
INSERT INTO `client` VALUES (8, '马客户', '123456', '2019-04-19 00:34:23', '13899998774', '南宁西乡塘B路152号', NULL);
INSERT INTO `client` VALUES (9, '胡客户', '123456', '2019-04-16 00:51:22', '13899993323', '南宁青秀区B路182号', NULL);
INSERT INTO `client` VALUES (19, '翁客户', '123456', '2019-04-24 14:59:58', '13899993266', '南宁高新区B路82号', '');
INSERT INTO `client` VALUES (20, '蓝客户', '123456', '2019-04-26 02:53:24', '13899993243', '南宁园博园B路882号', '');
INSERT INTO `client` VALUES (22, '飞客户', '123456', '2019-04-26 02:54:59', '13899993665', '南宁青秀区B路230号', '');
COMMIT;

-- ----------------------------
-- Table structure for in_
-- ----------------------------
DROP TABLE IF EXISTS `in_`;
CREATE TABLE `in_` (
  `in_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '入库',
  `water_id` int(11) DEFAULT NULL,
  `in_time` datetime DEFAULT NULL,
  `in_num` int(11) DEFAULT NULL,
  `in_note` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`in_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of in_
-- ----------------------------
BEGIN;
INSERT INTO `in_` VALUES (1, 1, '2019-04-16 14:46:47', 100, NULL);
INSERT INTO `in_` VALUES (2, 2, '2019-04-18 11:25:16', 50, NULL);
INSERT INTO `in_` VALUES (3, 3, '2019-04-18 11:27:15', 200, NULL);
COMMIT;

-- ----------------------------
-- Table structure for out_
-- ----------------------------
DROP TABLE IF EXISTS `out_`;
CREATE TABLE `out_` (
  `out_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '出库',
  `client_id` int(11) DEFAULT NULL,
  `client_phone` varchar(11) DEFAULT NULL,
  `client_add` varchar(255) DEFAULT NULL,
  `staff_id` int(11) DEFAULT NULL,
  `water_id` int(11) DEFAULT NULL,
  `out_time` datetime DEFAULT NULL,
  `out_num` int(11) DEFAULT NULL,
  `out_sum` float(11,1) DEFAULT NULL,
  `out_ok` int(11) DEFAULT NULL COMMENT '默认0  送达1  付款2',
  `out_good` int(255) DEFAULT NULL COMMENT '无效0  有效1',
  `out_note` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`out_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of out_
-- ----------------------------
BEGIN;
INSERT INTO `out_` VALUES (1, 1, '13877224242', '南宁青秀区A路33号', 1, 1, '2019-04-16 14:46:00', 10, 250.0, 0, 1, NULL);
INSERT INTO `out_` VALUES (2, 2, '13877226532', '南宁西乡塘F路121号', 1, 2, '2019-04-17 11:27:41', 2, 40.0, 1, 0, NULL);
INSERT INTO `out_` VALUES (3, 1, '13877227424', '南宁江南区G路16号', 2, 3, '2019-04-17 11:33:01', 1, 25.0, 2, 1, NULL);
INSERT INTO `out_` VALUES (4, 3, '13877222123', '南宁兴宁区X路200号', 1, 1, '2019-04-17 11:33:51', 1, 25.0, 0, 0, NULL);
INSERT INTO `out_` VALUES (5, 3, '13877229087', '南宁青秀区A路193号', 3, 3, '2019-04-17 11:34:17', 2, 50.0, 1, 0, NULL);
INSERT INTO `out_` VALUES (7, 1, '13877224528', '南宁江南区G路28号', 1, 2, '2019-04-19 01:07:58', 1, 18.0, 2, 1, NULL);
INSERT INTO `out_` VALUES (8, 2, '13877221231', '南宁西乡塘F路32号', 0, 2, '2019-04-19 01:09:18', 2, 36.0, 0, 0, NULL);
INSERT INTO `out_` VALUES (9, 3, '13877228709', '南宁兴宁区X路98号', 2, 2, '2019-04-19 01:09:55', 4, 70.0, 2, 1, NULL);
INSERT INTO `out_` VALUES (10, 1, '13877225543', '南宁青秀区A路13号', 0, 1, '2019-04-19 01:10:41', 1, 25.0, 0, 0, NULL);
INSERT INTO `out_` VALUES (11, 1, '13877220293', '南宁江南区G路92号', 1, 4, '2019-04-19 01:29:44', 2, 50.0, 0, 1, NULL);
INSERT INTO `out_` VALUES (12, 4, '13877221031', '南宁兴宁区F路67号', 0, 10, '2019-04-19 01:29:44', 3, 33.0, 0, 1, NULL);
INSERT INTO `out_` VALUES (13, 5, '13877229443', '南宁青秀区X路112号', 0, 9, '2019-04-19 01:29:44', 2, 23.0, 0, 1, NULL);
INSERT INTO `out_` VALUES (14, 6, '13877220090', '南宁兴宁区G路38号', 0, 8, '2019-04-19 01:29:44', 1, 45.0, 0, 1, NULL);
INSERT INTO `out_` VALUES (15, 7, '13877227290', '南宁江南区X路23号', 0, 7, '2019-04-19 01:29:44', 2, 66.0, 0, 1, NULL);
INSERT INTO `out_` VALUES (16, 8, '13877220902', '南宁西乡塘A路54号', 1, 6, '2019-04-19 01:29:44', 3, 65.0, 2, 1, NULL);
INSERT INTO `out_` VALUES (17, 9, '13877229892', '南宁兴宁区F路76号', 0, 5, '2019-04-19 01:29:44', 4, 100.0, 0, 1, NULL);
INSERT INTO `out_` VALUES (18, 2, '13877220921', '南宁青秀区X路75号', 0, 1, '2019-04-22 23:08:02', 1, 25.0, 0, 1, '');
INSERT INTO `out_` VALUES (19, 1, '13877229208', '南宁西乡塘G路45号', 3, 3, '2019-04-22 23:11:17', 1, 25.0, 0, 1, '');
INSERT INTO `out_` VALUES (34, 1, '13899993239', '南宁青秀区B路222号', 1, 1, '2019-05-24 13:08:27', 1, 25.5, 2, 1, '');
INSERT INTO `out_` VALUES (35, 1, '13899993239', '南宁青秀区B路222号', 0, 1, '2019-05-24 15:39:13', 2, 51.0, 0, 0, '');
INSERT INTO `out_` VALUES (36, 1, '13899993239', '南宁青秀区B路222号', 1, 1, '2019-05-24 15:41:47', 1, 25.5, 0, 1, '');
COMMIT;

-- ----------------------------
-- Table structure for staff
-- ----------------------------
DROP TABLE IF EXISTS `staff`;
CREATE TABLE `staff` (
  `staff_id` int(11) NOT NULL COMMENT '配送员',
  `staff_name` varchar(255) DEFAULT NULL,
  `staff_pwd` varchar(255) DEFAULT NULL,
  `staff_time` datetime DEFAULT NULL,
  `staff_phone` varchar(255) DEFAULT NULL,
  `staff_add` varchar(255) DEFAULT NULL,
  `staff_note` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`staff_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of staff
-- ----------------------------
BEGIN;
INSERT INTO `staff` VALUES (1, '王配送', '123456', '2019-04-16 14:48:05', '13822227878', '广西南宁市A路55号', NULL);
INSERT INTO `staff` VALUES (2, '李配送', '123456', '2019-04-16 13:28:09', '13822228888', '广西南宁市A路50号', NULL);
INSERT INTO `staff` VALUES (3, '曹配送', '123456', '2019-04-16 15:42:15', '13822227777', '广西南宁市A路555号', NULL);
COMMIT;

-- ----------------------------
-- Table structure for supplier
-- ----------------------------
DROP TABLE IF EXISTS `supplier`;
CREATE TABLE `supplier` (
  `supplier_id` int(11) NOT NULL AUTO_INCREMENT,
  `supplier_name` varchar(255) DEFAULT NULL,
  `supplier_pwd` varchar(255) DEFAULT NULL,
  `supplier_time` datetime DEFAULT NULL,
  `supplier_phone` varchar(255) DEFAULT NULL,
  `supplier_add` varchar(255) DEFAULT NULL,
  `supplier_note` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`supplier_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of supplier
-- ----------------------------
BEGIN;
INSERT INTO `supplier` VALUES (1, '青青草原水厂', '123456', '2019-04-15 14:48:05', '13822223333', '广西南宁市青秀区A路32号', NULL);
INSERT INTO `supplier` VALUES (2, '小太阳水厂', '123456', '2019-04-15 10:18:15', '13822227421', '广西南宁市青秀区A路30号', NULL);
INSERT INTO `supplier` VALUES (3, '露露水厂', '123456', '2019-04-16 12:38:05', '13822227444', '广西南宁市青秀区A路130号13822227421', NULL);
COMMIT;

-- ----------------------------
-- Table structure for water
-- ----------------------------
DROP TABLE IF EXISTS `water`;
CREATE TABLE `water` (
  `water_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '桶装水',
  `water_name` varchar(255) DEFAULT NULL,
  `supplier_id` int(11) DEFAULT NULL,
  `water_text` varchar(255) DEFAULT NULL,
  `water_img` varchar(255) DEFAULT NULL,
  `water_size` float(11,1) DEFAULT NULL,
  `water_type` varchar(255) DEFAULT NULL,
  `water_pay` float(11,1) DEFAULT NULL,
  `water_pay2` float(11,1) DEFAULT NULL,
  `water_num` int(11) DEFAULT NULL,
  `water_note` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`water_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of water
-- ----------------------------
BEGIN;
INSERT INTO `water` VALUES (1, '大明山泉水', 3, '大明山泉水的简介描述，甘甜可口，老人小孩都喜欢', 'images/a/01.jpg', 20.0, '山泉水', 20.0, 25.5, 405, '在售');
INSERT INTO `water` VALUES (2, '哈哈纯净水', 1, '哈哈纯净水的简介描述，纯净干爽，非一般的感觉', 'images/a/02.jpg', 25.5, '纯净水', 15.0, 18.0, 204, '在售');
INSERT INTO `water` VALUES (3, '冰冰爽矿泉水', 2, '冰冰爽矿泉水的简介描述，特别适合夏天饮用', 'images/a/03.jpg', 25.0, '矿泉水', 20.0, 25.0, 202, '在售');
INSERT INTO `water` VALUES (4, '有点甜矿泉水', 2, '有点甜矿泉水的简介描述，香香甜甜，儿时的味道', 'images/a/04.jpg', 25.0, '矿泉水', NULL, 38.0, 62, '在售');
INSERT INTO `water` VALUES (5, '乐乐纯净水', 2, '乐乐纯净水的简介描述，老人小孩都喜欢，甘甜可口', 'images/a/05.jpg', 30.0, '纯净水', 12.0, 16.0, 99, '在售');
INSERT INTO `water` VALUES (6, 'babyQ婴儿水', 2, 'babyQ婴儿水的简介描述，纯净干爽，好喝', 'images/a/06.jpg', 12.8, '婴儿水', 35.0, 50.0, 2, '在售');
INSERT INTO `water` VALUES (7, '粉红猴婴儿水', 2, '粉红猴婴儿水的简介描述，特别适合夏天饮用', 'images/a/07.jpg', 10.0, '婴儿水', 33.0, 48.0, 117, '在售');
INSERT INTO `water` VALUES (8, '乐享纯净水', 1, '乐享纯净水的简介描述，老人小孩都喜欢，香香甜甜', 'images/a/08.jpg', 25.0, '', 10.0, 12.0, 500, '在售');
INSERT INTO `water` VALUES (9, '乐享矿泉水', 2, '乐享矿泉水的简介描述，纯净干爽，好喝', 'images/a/09.jpg', 25.0, '矿泉水', 15.0, 18.0, 500, '在售');
INSERT INTO `water` VALUES (10, '亲亲山泉水', 2, '亲亲山泉水的简介描述，特别适合夏天饮用', 'images/a/10.jpg', 20.0, '山泉水', 50.0, 60.0, 149, '在售');
INSERT INTO `water` VALUES (14, '月弯弯山泉水', 2, '月弯弯山泉水的简介描述，纯净干爽，好喝', 'images/a/11.jpg', 20.0, '山泉水', 65.0, 80.0, 50, '在售');
INSERT INTO `water` VALUES (15, '菲儿山泉水', 1, '菲儿山泉水的简介描述，香香甜甜，老人小孩都喜欢', 'images/a/12.jpg', 25.0, '山泉水', 55.0, 65.0, 100, '在售');
INSERT INTO `water` VALUES (16, '长白山矿泉水', 2, '长白山矿泉水的简介描述，纯净干爽，好喝', 'images/a/01.jpg', 25.0, '矿泉水', 25.0, 30.0, 100, '在售');
INSERT INTO `water` VALUES (17, '2333纯净水', 2, '2333纯净水的简介，特别适合夏天饮用', 'images/a/02.jpg', 10.0, '纯净水', 15.0, 20.0, 100, '在售');
INSERT INTO `water` VALUES (18, 'AABB纯净水', 2, 'AABB纯净水的简介描述，香香甜甜，老人小孩都喜欢', 'images/a/03.jpg', 25.0, '纯净水', 25.0, 33.0, 100, '在售');
INSERT INTO `water` VALUES (19, '皇家矿泉水', 2, '皇家矿泉水的简介描述，特别适合夏天饮用', 'images/a/04.jpg', 1.0, '矿泉水', 25.0, 35.0, 236, '在售');
INSERT INTO `water` VALUES (20, '小红花矿泉水', 3, '小红花矿泉水的简介描述，纯净干爽，好喝', 'images/a/05.jpg', 25.0, '矿泉水', 25.0, 30.0, 4, '下架');
COMMIT;

-- ----------------------------
-- View structure for out_view
-- ----------------------------
DROP VIEW IF EXISTS `out_view`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `out_view` AS select `out_`.`out_id` AS `out_id`,`client`.`client_name` AS `client_name`,`out_`.`client_phone` AS `client_phone`,`out_`.`client_add` AS `client_add`,`staff`.`staff_name` AS `staff_name`,`water`.`water_name` AS `water_name`,`out_`.`out_time` AS `out_time`,`out_`.`out_sum` AS `out_sum`,`out_`.`out_num` AS `out_num`,`out_`.`out_ok` AS `out_ok`,`out_`.`out_good` AS `out_good`,`out_`.`out_note` AS `out_note` from (((`out_` join `client`) join `staff`) join `water`) where ((`out_`.`client_id` = `client`.`client_id`) and (`out_`.`staff_id` = `staff`.`staff_id`) and (`out_`.`water_id` = `water`.`water_id`));

-- ----------------------------
-- View structure for top_client_view
-- ----------------------------
DROP VIEW IF EXISTS `top_client_view`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `top_client_view` AS select `client`.`client_id` AS `client_id`,`client`.`client_name` AS `client_name`,`out_`.`out_time` AS `out_time`,`out_`.`out_num` AS `out_num` from (`out_` join `client`) where (`out_`.`client_id` = `client`.`client_id`);

-- ----------------------------
-- View structure for top_staff_view
-- ----------------------------
DROP VIEW IF EXISTS `top_staff_view`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `top_staff_view` AS select `staff`.`staff_id` AS `staff_id`,`staff`.`staff_name` AS `staff_name`,`out_`.`out_time` AS `out_time`,`out_`.`out_num` AS `out_num` from (`out_` join `staff`) where (`out_`.`staff_id` = `staff`.`staff_id`);

-- ----------------------------
-- View structure for top_water2_view
-- ----------------------------
DROP VIEW IF EXISTS `top_water2_view`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `top_water2_view` AS select `water`.`water_id` AS `water_id`,`water`.`water_img` AS `water_img`,`water`.`water_name` AS `water_name`,`water`.`water_pay2` AS `water_pay2`,`water`.`water_size` AS `water_size`,`water`.`water_num` AS `water_num`,`water`.`water_text` AS `water_text`,`water`.`water_note` AS `water_note`,`out_`.`out_num` AS `out_num` from (`out_` join `water`) where (`out_`.`water_id` = `water`.`water_id`);

-- ----------------------------
-- View structure for top_water_view
-- ----------------------------
DROP VIEW IF EXISTS `top_water_view`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `top_water_view` AS select `water`.`water_id` AS `water_id`,`water`.`water_name` AS `water_name`,`out_`.`out_time` AS `out_time`,`out_`.`out_num` AS `out_num` from (`out_` join `water`) where (`out_`.`water_id` = `water`.`water_id`);

-- ----------------------------
-- View structure for water_so_view
-- ----------------------------
DROP VIEW IF EXISTS `water_so_view`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `water_so_view` AS select `water`.`water_id` AS `water_id`,`water`.`water_name` AS `water_name`,`water`.`supplier_id` AS `supplier_id`,`water`.`water_text` AS `water_text`,`water`.`water_img` AS `water_img`,`water`.`water_size` AS `water_size`,`water`.`water_type` AS `water_type`,`water`.`water_pay` AS `water_pay`,`water`.`water_pay2` AS `water_pay2`,`water`.`water_num` AS `water_num`,`water`.`water_note` AS `water_note`,`supplier`.`supplier_name` AS `supplier_name` from (`water` join `supplier`) where (`water`.`supplier_id` = `supplier`.`supplier_id`);

SET FOREIGN_KEY_CHECKS = 1;
