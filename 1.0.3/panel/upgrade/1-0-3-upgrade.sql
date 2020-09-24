/*
 * @package XPanel 10.1.1 to GKPanel 1.0.3 Windows SQL Conversion Script
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

/* Update GKPanel Version */
USE `XPanel_core`;

/* Update the GKPanel database version number */
UPDATE `x_settings` SET `so_value_tx` = '1.0.3' WHERE `so_name_vc` = 'dbversion';

/** separate port setting for panel */
INSERT INTO `x_settings`(`so_name_vc`,`so_cleanname_vc`,`so_value_tx`,`so_defvalues_tx`,`so_desc_tx`,`so_module_vc`,`so_usereditable_en`) VALUES ('gkpanel_port','GKPanel Apache Port','80',NULL,'GKPanel Apache panel port','GKPanel Config','true');

/* Fix for changed translated text */
/* '' = ' (escaped) */
UPDATE  `x_translations` SET `tr_en_tx` = 'The A record contains an IPv4 address. Its target is an IPv4 address, e.g. ''192.168.1.1''.' WHERE `tr_en_tx` = 'The A record contains an IPv4 address. It''s target is an IPv4 address, e.g. ''192.168.1.1''.';
UPDATE  `x_translations` SET `tr_en_tx` = 'The AAAA record contains an IPv6 address. Its target is an IPv6 address, e.g. ''2607:fe90:2::1''.' WHERE `tr_en_tx` = 'The AAAA record contains an IPv6 address. It''s target is an IPv6 address, e.g. ''2607:fe90:2::1''.';
UPDATE  `x_translations` SET `tr_en_tx` = 'The CNAME record specifies the canonical name of a record. Its target is a fully qualified domain name, e.g. ''webserver-01.example.com''.' WHERE `tr_en_tx` = 'The CNAME record specifies the canonical name of a record. It''s target is a fully qualified domain name, e.g. ''webserver-01.example.com''.';
UPDATE  `x_translations` SET `tr_en_tx` = 'The MX record specifies a mail exchanger host for a domain. Each mail exchanger has a priority or preference that is a numeric value between 0 and 65535. Its target is a fully qualified domain name, e.g. ''mail.example.com''.' WHERE `tr_en_tx` = 'The MX record specifies a mail exchanger host for a domain. Each mail exchanger has a priority or preference that is a numeric value between 0 and 65535. It''s target is a fully qualified domain name, e.g. ''mail.example.com''.';
UPDATE  `x_translations` SET `tr_en_tx` = 'SRV records can be used to encode the location and port of services on a domain name. Its target is a fully qualified domain name, e.g. ''host.example.com''.' WHERE `tr_en_tx` = 'SRV records can be used to encode the location and port of services on a domain name. It''s target is a fully qualified domain name, e.g. ''host.example.com''.';
UPDATE  `x_translations` SET `tr_en_tx` = 'SPF records is used to store Sender Policy Framework details. Its target is a text string, e.g.<br>''v=spf1 a:192.168.1.1 include:example.com mx ptr -all'' (Click <a href="http://www.microsoft.com/mscorp/safety/content/technologies/senderid/wizard/" target="_blank">HERE</a> for the Microsoft SPF Wizard.)' WHERE `tr_en_tx` = 'SPF records is used to store Sender Policy Framework details. It''s target is a text string, e.g.<br>''v=spf1 a:192.168.1.1 include:example.com mx ptr -all'' (Click <a href="http://www.microsoft.com/mscorp/safety/content/technologies/senderid/wizard/" target="_blank">HERE</a> for the Microsoft SPF Wizard.)';
UPDATE  `x_translations` SET `tr_en_tx` = 'Nameserver record. Specifies nameservers for a domain. Its target is a fully qualified domain name, e.g. ''ns1.example.com''. The records should match what the domain name has registered with the internet root servers.' WHERE `tr_en_tx` = 'Nameserver record. Specifies nameservers for a domain. It''s target is a fully qualified domain name, e.g. ''ns1.example.com''. The records should match what the domain name has registered with the internet root servers.';

UPDATE `x_settings` SET `so_usereditable_en` = 'false' WHERE `so_name_vc` = 'module_icons_pr';

