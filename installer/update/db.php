<?php
//prepare for upgrade
$install_folder = $argv[1];
$temp_dir = $argv[2];
$temp_phpdir = str_replace("\\", "/", $temp_dir);
$your_full_name = $argv[3];
$your_email = $argv[4];
$your_fqdn = $argv[5];
$password_for_zadmin = $argv[6];
$install_phpdir = str_replace("\\", "/", $install_folder);
$install_slash = str_replace("\\", "\\\\", $install_folder);
$filename1 = 'C:/XPanel/panel/cnf/db.php';
$filename2 = 'C:/GKPanel/panel/cnf/db.php';
//update for XPanelx backup database and transfert file
if (file_exists($filename1)) {
//here command for backup XPanel db and check update to 10.1.1
include 'C:/XPanel/panel/cnf/db.php';
$version = exec("setso --show dbversion");
if ($version == "10.0.2") {
exec("C:\XPanel\bin\mysql\bin\mysql.exe -u root -p" . $pass . " < " . $temp_dir ."\XPanel_10-1-0_update.sql");
exec("C:\XPanel\bin\mysql\bin\mysql.exe -u root -p" . $pass . " < " . $temp_dir ."\roundcube_update.sql");
exec("C:\XPanel\bin\mysql\bin\mysql.exe -u root -p" . $pass . " < " . $temp_dir ."\XPanel-10-1-1_update.sql");
}
exec("C:\XPanel\bin\mysql\bin\mysql.exe -u root -p" . $pass . " < " . $temp_dir ."\update.sql");
// change database name command based on linux version line 777
// just remove proftpd and postfix et adding hmail 
exec("C:\XPanel\bin\mysql\bin\mysqldump.exe -u root -p" . $pass . " XPanel_core | C:\XPanel\bin\mysql\bin\mysql.exe -u root -p" . $pass . " -D gkpanel_core");
exec("C:\XPanel\bin\mysql\bin\mysqldump.exe -u root -p" . $pass . " XPanel_roundcube | C:\XPanel\bin\mysql\bin\mysql.exe -u root -p" . $pass . " -D gkpanel_roundcube");
exec("C:\XPanel\bin\mysql\bin\mysqldump.exe -u root -p" . $pass . " XPanel_hmail | C:\XPanel\bin\mysql\bin\mysql.exe -u root -p" . $pass . " -D gkpanel_hmail");
//drop old table
exec("C:\XPanel\bin\mysql\bin\mysql.exe -u root -p" . $pass . " -e \"DROP DATABASE 'XPanel_core';\"");
exec("C:\XPanel\bin\mysql\bin\mysql.exe -u root -p" . $pass . " -e \"DROP DATABASE 'XPanel_roundcube';\"");
exec("C:\XPanel\bin\mysql\bin\mysql.exe -u root -p" . $pass . " -e \"DROP DATABASE 'XPanel_hmail';\"");
exec("C:\XPanel\bin\mysql\bin\mysqldump.exe -u root -p" . $pass . " --all-databases > " . $install_folder . "\all_databases.sql");
if ($install_folder != "C:\XPanel") {
exec("rmdir " . $install_folder . "\hostdata /S /Q");
exec("move /Y c:\XPanel\hostdata " . $install_folder . "");
}
exec("mkdir " . $install_folder . "\bk");
exec("copy C:\XPanel\panel\cnf\db.php " . $install_folder . "\bk");
//update for GKPanel 1.0.0 for windows MarkDark version backup database and transfert file
} else if (file_exists($filename2)) {
// here command for update GKPanel for windows 1.0.0
include 'C:/GKPanel/panel/cnf/db.php';
exec("C:\XPanel\bin\mysql\bin\mysql.exe -u root -p" . $pass . " -e \" CREATE DATABASE XPanel_core;\"");
exec("C:\XPanel\bin\mysql\bin\mysql.exe -u root -p" . $pass . " -e \" CREATE DATABASE XPanel_hmail;\"");
exec("C:\XPanel\bin\mysql\bin\mysql.exe -u root -p" . $pass . " -e \" CREATE DATABASE XPanel_roundcube;\"");
exec("C:\XPanel\bin\mysql\bin\mysqldump.exe -u root -p" . $pass . " gkpanel_core | C:\XPanel\bin\mysql\bin\mysql.exe -u root -p" . $pass . " -D XPanel_core_core");
exec("C:\XPanel\bin\mysql\bin\mysqldump.exe -u root -p" . $pass . " gkpanel_hmail | C:\XPanel\bin\mysql\bin\mysql.exe -u root -p" . $pass . " -D XPanel_hmail");
exec("C:\XPanel\bin\mysql\bin\mysql.exe -u root -p" . $pass . " -e \" DROP DATABASE gkpanel_core;\"");
exec("C:\XPanel\bin\mysql\bin\mysql.exe -u root -p" . $pass . " -e \" DROP DATABASE gkpanel_hmail;\"");
exec("C:\XPanel\bin\mysql\bin\mysql.exe -u root -p" . $pass . " -e \" DROP DATABASE gkpanel_afterlogic;\"");
exec("C:\XPanel\bin\mysql\bin\mysql.exe -u root -p" . $pass . " -e \" CREATE DATABASE XPanel_roundcube;\"");    
exec("C:\XPanel\bin\mysql\bin\mysql.exe -u root -p" . $pass . " XPanel_roundcube < " . $temp_dir . "\XPanel_roundcube.sql");
exec("C:\GKPanel\bin\mysql\bin\mysql.exe -u root -p" . $pass . " < " . $temp_dir ."\update.sql");
// change database name command based on linux version line 777
// just remove proftpd and postfix et adding hmail 
// change database name command based on linux version line 777
// just remove proftpd and postfix et adding hmail 
exec("C:\XPanel\bin\mysql\bin\mysqldump.exe -u root -p" . $pass . " XPanel_core | C:\XPanel\bin\mysql\bin\mysql.exe -u root -p" . $pass . " -D gkpanel_core");
exec("C:\XPanel\bin\mysql\bin\mysqldump.exe -u root -p" . $pass . " XPanel_roundcube | C:\XPanel\bin\mysql\bin\mysql.exe -u root -p" . $pass . " -D gkpanel_roundcube");
exec("C:\XPanel\bin\mysql\bin\mysqldump.exe -u root -p" . $pass . " XPanel_hmail | C:\XPanel\bin\mysql\bin\mysql.exe -u root -p" . $pass . " -D gkpanel_hmail");
//drop old table
exec("C:\XPanel\bin\mysql\bin\mysql.exe -u root -p" . $pass . " -e \"DROP DATABASE 'XPanel_core';\"");
exec("C:\XPanel\bin\mysql\bin\mysql.exe -u root -p" . $pass . " -e \"DROP DATABASE 'XPanel_roundcube';\"");
exec("C:\XPanel\bin\mysql\bin\mysql.exe -u root -p" . $pass . " -e \"DROP DATABASE 'XPanel_hmail';\"");
exec("C:\XPanel\bin\mysql\bin\mysql.exe -u root -p" . $pass . " -e \"UPDATE gkpanel_core.x_accounts SET ac_user_vc = 'zadmin' WHERE x_accounts.ac_id_pk = 1;\"");
exec("C:\XPanel\bin\mysql\bin\mysqldump.exe -u root -p" . $pass . " --all-databases > " . $install_folder . "\all_databases.sql");
//drop old database
exec("C:\GKPanel\bin\mysql\bin\mysql.exe -u root -p" . $pass . " -e \"DROP DATABASE 'XPanel_core';\"");
exec("C:\GKPanel\bin\mysql\bin\mysql.exe -u root -p" . $pass . " -e \"DROP DATABASE 'XPanel_roundcube';\"");
exec("C:\GKPanel\bin\mysql\bin\mysql.exe -u root -p" . $pass . " -e \"DROP DATABASE 'XPanel_hmail';\"");
exec("C:\GKPanel\bin\mysql\bin\mysqldump.exe -u root -p" . $pass . " --all-databases > " . $install_folder . "\all_databases.sql");
if ($install_folder != "C:\GKPanel") {
exec("rmdir " . $install_folder . "\hostdata /S /Q");
exec("move /Y c:\GKPanel\www " . $install_folder . "");
exec("rename " . $install_folder . "\www " . $install_folder . "\hostdata");
exec("rename " . $install_folder . "\hostdata\admin " . $install_folder . "\hostdata\zadmin");
}
exec("mkdir " . $install_folder . "\bk");
exec("copy C:/GKPanel/panel/cnf/db.php " . $install_folder . "\bk");
}

