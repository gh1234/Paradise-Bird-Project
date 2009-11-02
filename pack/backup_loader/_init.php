<?php
//TODO Permissions
if(!file_exists("pm/backup/full/" . $_GET['filename'] . '.zip'))
	die("404 - File not found");
header("Content-Disposition: backup; filename=\"backup.zip\""); // Dateiname
header("Content-Type: application/zip");
header("Content-Length: ".filesize("pm/backup/full/" . $_GET['filename'] . '.zip')); // Dateigröße
readfile("pm/backup/full/" . $_GET['filename'] . ".zip");