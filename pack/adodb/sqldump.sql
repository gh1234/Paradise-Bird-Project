-- phpMyAdmin SQL Dump
-- version 3.2.0.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Erstellungszeit: 21. November 2009 um 14:03
-- Server Version: 5.1.37
-- PHP-Version: 5.3.0

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
  `pack` varchar(100) NOT NULL,
  `level` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Daten für Tabelle `perm`
--

INSERT INTO `perm` (`id`, `pack`, `level`) VALUES
(1, 'hello_world', 11);

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Daten für Tabelle `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `password_salt`, `group`) VALUES
(1, 'guest', 'faa2bd7b401dc9121596b48a379c57234482a6c5', '&=={=)-e%_-)$', 0);
