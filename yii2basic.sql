-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2015-09-15 16:10:30
-- 服务器版本： 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `yii2basic`
--

-- --------------------------------------------------------

--
-- 表的结构 `survey`
--

CREATE TABLE IF NOT EXISTS `survey` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(10) NOT NULL,
  `age` int(100) NOT NULL,
  `sex` varchar(2) NOT NULL,
  `edu` varchar(5) NOT NULL,
  `info` text NOT NULL,
  `create_time` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- 表的结构 `test1`
--

CREATE TABLE IF NOT EXISTS `test1` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- 转存表中的数据 `test1`
--

INSERT INTO `test1` (`id`, `title`) VALUES
(1, 'title1title1title1title1title1'),
(3, 'title3'),
(4, 'title'),
(5, 'title'),
(6, 'USA'),
(7, ''),
(8, 'd'),
(9, 'dadsada@dasda.com'),
(10, 'dadsada@dasda.com'),
(11, 'dadsada@dasda.com');

-- --------------------------------------------------------

--
-- 表的结构 `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(20) NOT NULL,
  `authKey` varchar(100) NOT NULL,
  `accessToken` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=48 ;

--
-- 转存表中的数据 `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `email`, `authKey`, `accessToken`) VALUES
(32, 'admin8', 'e10adc3949ba59abbe56e057f20f883e', 'admin8@a.com', '', ''),
(33, 'gfdddgfgggff', 'e10adc3949ba59abbe56e057f20f883e', 'dadada@da.com', '', ''),
(43, 'kllghgsfdsfaads', 'e10adc3949ba59abbe56e057f20f883e', 'dadada@da.com', '', ''),
(46, 'sfghjdsfghjkj', 'e10adc3949ba59abbe56e057f20f883e', 'dadada@da.com', '', ''),
(47, 'dsadad', 'e10adc3949ba59abbe56e057f20f883e', 'dadada@da.com', '', '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
