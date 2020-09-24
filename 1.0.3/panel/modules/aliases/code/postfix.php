<?php

/**
 * @copyright 2014-2015 GKPanel Project (http://www.cybercore.tv/) 
 * GKPanel is a GPL fork of the XPanel Project whose original header follows:
 *
 * GKPanel - A Cross-Platform Open-Source Web Hosting Control panel.
 * 
 * @package GKPanel
 * @version $Id$
 * @author HuyGK - huygk@cybercore.tv
 * @copyright (c) 2020 THN Group - http://www.cybercore.tv/
 * @license http://opensource.org/licenses/gpl-3.0.html GNU Public License v3
 *
 * This program (GKPanel) is free software: you can redistribute it and/or modify
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
 *
 */
$mailserver_db = ctrl_options::GetSystemOption('mailserver_db');
include('cnf/db.php');
$z_db_user = $user;
$z_db_pass = $pass;
try {
    $mail_db = new db_driver("mysql:host=" . $host . ";dbname=" . $mailserver_db . "", $z_db_user, $z_db_pass);
} catch (PDOException $e) {
    
}

// Deleting Postfix Alias
if (!fs_director::CheckForEmptyValue(self::$delete)) {
    //$result = $mail_db->query("SELECT address FROM alias WHERE address='" . $rowalias['al_address_vc'] . "'")->Fetch();

    $bindArray = NULL;
    $bindArray = array(':aliasname' => $rowalias['al_address_vc']);
    $sqlStatment = $mail_db->bindQuery("SELECT address FROM alias WHERE address=:aliasname", $bindArray);
    $result = $mail_db->returnRow();

    if ($result) {
        $sqlStatment = "DELETE FROM alias WHERE address=:address";
        $sql = $mail_db->prepare($sqlStatment);
        $sql->bindParam(':address', $rowalias['al_address_vc']);
        $sql->execute();
    }
}

// Adding Postfix Alias
if (!fs_director::CheckForEmptyValue(self::$create)) {
    //$result = $mail_db->query("SELECT address FROM alias WHERE address='" . $fulladdress . "'")->Fetch();

    $bindArray = NULL;
    $bindArray = array(':address' => $fulladdress);
    $sqlStatment = $mail_db->bindQuery("SELECT address FROM alias WHERE address=:address", $bindArray);
    $result = $mail_db->returnRow();

    if (!$result) {
        $sqlStatment2 = "INSERT INTO alias  (address,
										 	goto,
										 	domain,
											created,
										 	modified,
										 	active) VALUES (
										 	:fulladdress,
										 	:destination,
										 	:domain,
										 	NOW(),
										 	NOW(),
										 	'1')";
        $sql = $mail_db->prepare($sqlStatment2);
        $sql->bindParam(':domain', $domain);
        $sql->bindParam(':fulladdress', $fulladdress);
        $sql->bindParam(':destination', $destination);
        $sql->execute();
    }
}
?>