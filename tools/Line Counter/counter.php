<?php
/*
 * This file is part of Paradise-Bird-Project.

 * Paradise-Bird-Project is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.

 * Paradise-Bird-Project is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.

 * You should have received a copy of the GNU General Public License
 * along with Paradise-Bird-Project.  If not, see <http://www.gnu.org/licenses/>.
 */
/**
 * Just walks trough every file to count the number of lines in a project
 */
$filesCount = 0;
$dirsCount = 0;
$linesCount = 0;
$signsCount = 0;
$allowedext = array('php', 'html', 'tpl');
function walktrough($startdir){
	global $filesCount, $dirsCount, $linesCount, $signsCount, $allowedext;
	$startdir = preg_replace("!/$!", '', $startdir);
	$startdir .= '/';
	$dir = opendir($startdir);
	while($file = readdir($dir)){
		if($file == '.' || $file == '..')
			continue;
		if(is_file($startdir.$file)){
			$filesCount++;
			$ext = preg_replace("!.*\.!", '', $file);
			if(in_array($ext, $allowedext)){
				$file = fopen($startdir.$file, 'r');
				while(fgets($file, 1000000)){
					$linesCount++;
				}
				rewind($file);
				while(fgetc($file)){
					$signsCount++;
				}
				fclose($file);
			}
		} else {
			$dirsCount++;
			walktrough($startdir.$file);
		}
	}
	closedir($dir);
}
if(isset($_GET['startdir'])){
	$startdir = $_GET['startdir'];
} else {
	$startdir = '.';
}
if(!is_dir(($startdir)))
	die('Directory does not exist');
walktrough($startdir);
echo '<p>Files: ' . $filesCount . '</p>';
echo '<p>Dirs: ' . $dirsCount . '</p>';
echo '<p>Lines: ' . $linesCount . '</p>';
echo '<p>Signs: ' . $signsCount . '</p>';