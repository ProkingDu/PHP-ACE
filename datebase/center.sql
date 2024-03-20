-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- 主机： localhost
-- 生成日期： 2024-02-29 19:15:19
-- 服务器版本： 5.7.40-log
-- PHP 版本： 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 数据库： `center`
--

-- --------------------------------------------------------

--
-- 表的结构 `auth_list`
--

CREATE TABLE `auth_list` (
  `id` int(11) NOT NULL,
  `name` varchar(1000) DEFAULT NULL COMMENT '授权平台名称',
  `domain` varchar(1000) DEFAULT NULL COMMENT '授权域名',
  `auth_ip` json DEFAULT NULL COMMENT '授权IP，不限制为空。',
  `version` varchar(1000) DEFAULT '1.0.0' COMMENT '当前版本',
  `patch` varchar(1000) DEFAULT NULL COMMENT '补丁包目录，为空则公共',
  `sql_patch` varchar(1000) DEFAULT NULL COMMENT '数据库补丁目的，为空则为公共',
  `token` varchar(255) DEFAULT NULL COMMENT '请求token',
  `token_expire_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'token过期时间',
  `end_time` datetime DEFAULT NULL COMMENT '到期时间',
  `create_time` datetime DEFAULT NULL COMMENT '创建时间'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 转存表中的数据 `auth_list`
--

INSERT INTO `auth_list` (`id`, `name`, `domain`, `auth_ip`, `version`, `patch`, `sql_patch`, `token`, `token_expire_time`, `end_time`, `create_time`) VALUES
(1, 'test', 'test.cn', NULL, '1.0.0', NULL, NULL, NULL, '2024-02-29 17:57:26', NULL, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `system_setting`
--

CREATE TABLE `system_setting` (
  `id` int(11) NOT NULL,
  `type` varchar(55) DEFAULT NULL COMMENT '配置组',
  `name` varchar(255) DEFAULT NULL COMMENT '配置名',
  `key` varchar(255) DEFAULT NULL COMMENT '配置key',
  `value` longtext COMMENT '配置值',
  `status` int(10) DEFAULT NULL COMMENT '状态码',
  `create_time` datetime DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 转存表中的数据 `system_setting`
--

INSERT INTO `system_setting` (`id`, `type`, `name`, `key`, `value`, `status`, `create_time`) VALUES
(1, 'version', '最新版本号', 'latest_version', '1.0.0', 1, '2024-02-22 20:47:03'),
(2, 'version', '公共源码补丁路径', 'common_patch_path', '/patch/common/code', 1, '2024-02-22 20:47:03'),
(3, 'version', '公共数据库补丁路径', 'common_sql_patch_path', '/patch/common/sql', 1, '2024-02-22 20:47:03');

--
-- 转储表的索引
--

--
-- 表的索引 `auth_list`
--
ALTER TABLE `auth_list`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `system_setting`
--
ALTER TABLE `system_setting`
  ADD PRIMARY KEY (`id`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `auth_list`
--
ALTER TABLE `auth_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- 使用表AUTO_INCREMENT `system_setting`
--
ALTER TABLE `system_setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
