<?php
/*
 * @package XPanel 10.1.1 to GKPanel 1.0.3 Windows Conversion Script
 * @version 1.0.0
 * @author HuyGK - huygk@cybercore.tv
 * @copyright (c) 2015 GKPanel Project - http://www.cybercore.tv/
 * @license http://opensource.org/licenses/gpl-3.0.html GNU Public License v3
 *
 * @copyright 2014-2015 GKPanel Project (http://www.cybercore.tv/) 
 * GKPanel is a GPL fork of the GKPanel Project whose original header follows:
 *
 * XPanel - A Cross-Platform Open-Source Web Hosting Control panel.
 *
 * @package XPanel
 * @version $Id$
 * @author HuyGK - huygk@cybercore.tv
 * @copyright (c) 2020 THN Group - http://www.cybercore.tv/
 * @license http://opensource.org/licenses/gpl-3.0.html GNU Public License v3
 *
 * This program (XPanel) is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */
 
echo "<h2>Running database conversions...</h2>";

// Get server's database info
include_once '../cnf/db.php';

// Connect to your MySQL database.
mysql_connect($host, $user, $pass);

// Import SQL updates
// Name of the SQL file to import
$filename = '1-0-3-upgrade.sql';

echo "<h3>Importing and upgrading database tables and columns.</h3>";

// Check if SQL file exists
if (file_exists($filename)) {
	// Database name
	$mysql_database = 'XPanel_core';
	
	// Connect to MySQL server
	mysql_connect($host, $user, $pass) or die('Error connecting to MySQL server: ' . mysql_error());
	// Select database
	mysql_select_db($mysql_database) or die('Error selecting MySQL database: ' . mysql_error());
	
	// Temporary variable, used to store current query
	$templine = '';
	// Read in entire file
	$lines = file($filename);
	// Loop through each line
	foreach ($lines as $line)
	{
	// Skip it if it's a comment
	if (substr($line, 0, 2) == '--' || $line == '')
		continue;
	
	// Add this line to the current segment
	$templine .= $line;
	// If it has a semicolon at the end, it's the end of the query
	if (substr(trim($line), -1, 1) == ';')
	{
		// Perform the query
		mysql_query($templine) or print('Error performing query \'<strong>' . $templine . '\': ' . mysql_error() . '<br /><br />');
		// Reset temp variable to empty
		$templine = '';
	}
	}
	 echo "Tables imported successfully.<br />";
} else {
    echo "SQL Upgrade SQL not found!<br />";
	exit;
}

// The find and replace strings.
// Convert domain URL
$find = "cybercore.tv";
$replace = "cybercore.tv";

echo "Replacing ".$find." with ".$replace."<br />";

$loop = mysql_query("
    SELECT
        concat('UPDATE ',table_schema,'.',table_name, ' SET ',column_name, '=replace(',column_name,', ''{$find}'', ''{$replace}'');') AS s
    FROM
        information_schema.columns
    WHERE
        table_schema = '{$dbname}'")
or die ('Cant loop through dbfields: ' . mysql_error());

while ($query = mysql_fetch_assoc($loop))
{
        mysql_query($query['s']);
}

// Convert XPanel to GKPanel
$find = "XPanel";
$replace = "GKPanel";

echo "Replacing ".$find." with ".$replace."<br />";

$loop = mysql_query("
    SELECT
        concat('UPDATE ',table_schema,'.',table_name, ' SET ',column_name, '=replace(',column_name,', ''{$find}'', ''{$replace}'');') AS s
    FROM
        information_schema.columns
    WHERE
        table_schema = '{$dbname}'")
or die ('Cant loop through dbfields: ' . mysql_error());

while ($query = mysql_fetch_assoc($loop))
{
        mysql_query($query['s']);
}

// Convert XPanel to GKPanel
$find = "XPanel";
$replace = "GKPanel";

echo "Replacing ".$find." with ".$replace."<br />";

$loop = mysql_query("
    SELECT
        concat('UPDATE ',table_schema,'.',table_name, ' SET ',column_name, '=replace(',column_name,', ''{$find}'', ''{$replace}'');') AS s
    FROM
        information_schema.columns
    WHERE
        table_schema = '{$dbname}'")
or die ('Cant loop through dbfields: ' . mysql_error());

while ($query = mysql_fetch_assoc($loop))
{
        mysql_query($query['s']);
}

// Convert XPanel to GKPanel
$find = "XPanel";
$replace = "GKPanel";

echo "Replacing ".$find." with ".$replace."<br />";

$loop = mysql_query("
    SELECT
        concat('UPDATE ',table_schema,'.',table_name, ' SET ',column_name, '=replace(',column_name,', ''{$find}'', ''{$replace}'');') AS s
    FROM
        information_schema.columns
    WHERE
        table_schema = '{$dbname}'")
or die ('Cant loop through dbfields: ' . mysql_error());

while ($query = mysql_fetch_assoc($loop))
{
        mysql_query($query['s']);
}

// Reverts/Clean up
echo "<h4>Doing some clean up...</h4>";

// folder path fix
echo "Reverting folder path: ";
$find = ":/GKPanel";
$replace = ":/XPanel";

echo "reverting ".$find." with ".$replace."<br />";

$loop = mysql_query("
    SELECT
        concat('UPDATE ',table_schema,'.',table_name, ' SET ',column_name, '=replace(',column_name,', ''{$find}'', ''{$replace}'');') AS s
    FROM
        information_schema.columns
    WHERE
        table_schema = '{$dbname}'")
or die ('Cant loop through dbfields: ' . mysql_error());

while ($query = mysql_fetch_assoc($loop))
{
        mysql_query($query['s']);
}

// old theme name fix
echo "Reverting theme name: ";
$find = "GKPanelx";
$replace = "XPanelx";

echo "reverting ".$find." with ".$replace."<br />";

$loop = mysql_query("
    SELECT
        concat('UPDATE ',table_schema,'.',table_name, ' SET ',column_name, '=replace(',column_name,', ''{$find}'', ''{$replace}'');') AS s
    FROM
        information_schema.columns
    WHERE
        table_schema = '{$dbname}'")
or die ('Cant loop through dbfields: ' . mysql_error());

while ($query = mysql_fetch_assoc($loop))
{
        mysql_query($query['s']);
}

// filezilla DB fix - remove if convert DB name to GKPanel
echo "Reverting filezilla entry: ";
$find = "gkpanel_filezilla";
$replace = "XPanel_filezilla";

echo "reverting ".$find." with ".$replace."<br />";

$loop = mysql_query("
    SELECT
        concat('UPDATE ',table_schema,'.',table_name, ' SET ',column_name, '=replace(',column_name,', ''{$find}'', ''{$replace}'');') AS s
    FROM
        information_schema.columns
    WHERE
        table_schema = '{$dbname}'")
or die ('Cant loop through dbfields: ' . mysql_error());

while ($query = mysql_fetch_assoc($loop))
{
        mysql_query($query['s']);
}

// hMailServer DB fix - remove if convert DB name to GKPanel
echo "Reverting hMailserver entry: ";
$find = "gkpanel_hmail";
$replace = "XPanel_hmail";

echo "reverting ".$find." with ".$replace."<br />";

$loop = mysql_query("
    SELECT
        concat('UPDATE ',table_schema,'.',table_name, ' SET ',column_name, '=replace(',column_name,', ''{$find}'', ''{$replace}'');') AS s
    FROM
        information_schema.columns
    WHERE
        table_schema = '{$dbname}'")
or die ('Cant loop through dbfields: ' . mysql_error());

while ($query = mysql_fetch_assoc($loop))
{
        mysql_query($query['s']);
}
echo "<h3>Finished database conversions...</h3>";



echo "<h2>Running file & folder conversions...</h2>";
// Remove files and folders function
function cleanup($dir) {
	if (is_dir($dir)) {
		$objects = scandir($dir);
		foreach ($objects as $object) {
			if ($object != "." && $object != "..") {
				if (filetype($dir."/".$object) == "dir") 
						cleanup($dir."/".$object); 
					else unlink   ($dir."/".$object);
				}
			}
		reset($objects);
		rmdir($dir);
	}
}

// remove old XPanel version class file
$DelFile = "../dryden/ui/tpl/XPanelversion.class.php";
echo "Removing file: ".$DelFile;
if (file_exists($DelFile)) {
	unlink($DelFile);
	}

// remove old XPanel.color file
$DelFile = "../etc/lib/pChart2/palettes/XPanel.color";
echo "Removing file: ".$DelFile;
if (file_exists($DelFile)) {
	unlink($DelFile);
	}

// remove old pCHart2 XPanel folder
$DelFile = "../etc/lib/pChart2/XPanel";
echo "Removing file: ".$DelFile;
if (file_exists($DelFile)) {
	cleanup($DelFile);
}

// remove old XPanelconfig module folder
$DelFile = "../modules/XPanelconfig";
echo "Removing file: ".$DelFile;
if (file_exists($DelFile)) {
	cleanup($DelFile);
}

echo "<h3>Finished file & folder conversions...</h3>";

// remove this upgrade folder and files
$DelFile = "../upgrade";
echo "Removing upgrade files and folder...<br />";
if (file_exists($DelFile)) {
	cleanup($DelFile);
}

echo "<p>Completed.</p>";
echo "Please verify that the upgrade folder has been removed. (c:/XPanel/panel/upgrade)";
?>