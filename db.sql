-- phpMyAdmin SQL Dump
-- version 3.2.2.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Erstellungszeit: 24. November 2009 um 19:06
-- Server Version: 5.1.37
-- PHP-Version: 5.2.10-2ubuntu6.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Datenbank: `pdbp`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `perm`
--

CREATE TABLE IF NOT EXISTS `perm` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type` int(11) NOT NULL,
  `bind_id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `value` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Daten für Tabelle `perm`
--

INSERT INTO `perm` (`id`, `type`, `bind_id`, `name`, `value`) VALUES
(1, 1, 7, 'NO_MAINTENANCE', 1),
(2, 2, 0, 'NO_MAINTENANCE', 0);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(200) NOT NULL,
  `password` varchar(50) NOT NULL,
  `password_salt` varchar(200) NOT NULL,
  `group` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Daten für Tabelle `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `password_salt`, `group`) VALUES
(1, 'guest', 'faa2bd7b401dc9121596b48a379c57234482a6c5', '&=={=)-e%_-)$', 0),
(7, 'test', 'd6999d2f8953a5869a077b114ceaa2b830f1c2fb', 'e&_&e={{e)=-=', 0);

