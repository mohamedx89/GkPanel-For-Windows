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
session_start();
if (isset($_SESSION['zpuid'])) {
    echo phpinfo();
} else {
    echo "<h1>Unauthorised request!</h1><p>You must be logged in before you are able to view PHP configuration on this server.</p>";
}
?>
