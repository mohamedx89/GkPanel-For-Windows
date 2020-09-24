/* prepare for upgrade */
UPDATE `XPanel_core`.`x_groups` SET `ug_notes_tx` = 'Resellers have the ability to manage, create and maintain user accounts within GKPanel.' WHERE `ug_id_pk` = '2';
UPDATE `XPanel_core`.`x_groups` SET `ug_notes_tx` = 'Users have basic access to GKPanel.' WHERE `ug_id_pk` = '3';
UPDATE `XPanel_core`.`x_groups` SET `ug_notes_tx` = 'The main administration group, this group allows access to all areas of GKPanel.' WHERE `ug_id_pk` = '1';

UPDATE `XPanel_core`.`x_modules` SET `mo_updateurl_tx` = NULL WHERE `mo_id_pk` = '46';
UPDATE `XPanel_core`.`x_modules` SET `mo_desc_tx` = 'Welcome to the Package Manager, using this module enables you to create and manage existing reseller packages on your GKPanel hosting account.' WHERE `mo_id_pk` = '20';
UPDATE `XPanel_core`.`x_modules` SET `mo_updateurl_tx` = NULL WHERE `mo_id_pk` = '47';
UPDATE `XPanel_core`.`x_modules` SET `mo_desc_tx` = 'Check to see if there are any available updates to your version of the GKPanel software.' WHERE `mo_id_pk` = '6';
UPDATE `XPanel_core`.`x_modules` SET `mo_desc_tx` = 'The backup manager module enables you to backup your entire hosting account including all your MySQL&reg; databases.' WHERE `mo_id_pk` = '12';
UPDATE `XPanel_core`.`x_modules` SET `mo_name_vc` = 'GKPanel Config', `mo_folder_vc` = 'GKPanelconfig', `mo_desc_tx` = 'Changes made here affect the entire GKPanel configuration, please double check everything before saving changes.' WHERE `mo_id_pk` = '4';
UPDATE `XPanel_core`.`x_modules` SET `mo_desc_tx` = 'MySQL&reg; databases are used by many PHP applications such as forums and ecommerce systems, below you can manage and create MySQL&reg; databases.' WHERE `mo_id_pk` = '24';
UPDATE `XPanel_core`.`x_modules` SET `mo_updatever_vc` = NULL, `mo_updateurl_tx` = NULL WHERE `mo_id_pk` = '42';
UPDATE `XPanel_core`.`x_modules` SET `mo_desc_tx` = 'MySQL&reg; Users allows you to add users and permissions to your MySQL&reg; databases.' WHERE `mo_id_pk` = '39';
UPDATE `XPanel_core`.`x_modules` SET `mo_name_vc` = 'GKPanel News', `mo_desc_tx` = 'Find out all the latest news and information from the GKPanel project.' WHERE `mo_id_pk` = '5';
UPDATE `XPanel_core`.`x_modules` SET `mo_desc_tx` = 'phpMyAdmin is a web based tool that enables you to manage your GKPanel MySQL databases via. the web.' WHERE `mo_id_pk` = '8';
DELETE FROM `XPanel_core`.`x_modules` WHERE `mo_id_pk` = '43';
INSERT INTO `XPanel_core`.`x_modules` (`mo_id_pk`, `mo_category_fk`, `mo_name_vc`, `mo_version_in`, `mo_folder_vc`, `mo_type_en`, `mo_desc_tx`, `mo_installed_ts`, `mo_enabled_en`, `mo_updatever_vc`, `mo_updateurl_tx`) VALUES('48', '3', 'Protected Directories', '200', 'protected_directories', 'user', 'Password protect your web applications and directories.', NULL, 'true', '', '');

INSERT INTO `XPanel_core`.`x_permissions` (`pe_id_pk`, `pe_group_fk`, `pe_module_fk`) VALUES('94', '3', '48');
INSERT INTO `XPanel_core`.`x_permissions` (`pe_id_pk`, `pe_group_fk`, `pe_module_fk`) VALUES('93', '2', '48');
INSERT INTO `XPanel_core`.`x_permissions` (`pe_id_pk`, `pe_group_fk`, `pe_module_fk`) VALUES('92', '1', '48');

UPDATE `XPanel_core`.`x_quotas` SET `qt_domains_in` = '-1', `qt_subdomains_in` = '-1', `qt_parkeddomains_in` = '-1', `qt_mailboxes_in` = '-1', `qt_fowarders_in` = '-1', `qt_distlists_in` = '-1', `qt_ftpaccounts_in` = '-1', `qt_mysql_in` = '-1', `qt_diskspace_bi` = '0', `qt_bandwidth_bi` = '0' WHERE `qt_id_pk` = '1';

/** Reloading the settings afresh for GKPanel as many have changed values or names */
TRUNCATE `XPanel_core`.`x_settings`;

INSERT  INTO XPanel_core.`x_settings`(`so_id_pk`,`so_name_vc`,`so_cleanname_vc`,`so_value_tx`,`so_defvalues_tx`,`so_desc_tx`,`so_module_vc`,`so_usereditable_en`) VALUES 
(6,'dbversion','GKPanel version','1.0.3',NULL,'Database Version','GKPanel Config','false'),
(7,'gkpanel_root','GKPanel root path','/etc/GKPanel/panel/',NULL,'GKPanel Web Root','GKPanel Config','true'),
(8,'module_icons_pr','Icons per Row','10',NULL,'Set the number of icons to display before beginning a new line.','GKPanel Config','false'),
(10,'gkpanel_df','Date Format','H:i jS M Y T',NULL,'Set the date format used by modules.','GKPanel Config','true'),
(13,'servicechk_to','Service Check Timeout','10',NULL,'Service Check Timeout','GKPanel Config','true'),
(14,'root_drive','Root Drive','/',NULL,'The root drive where GKPanel is installed.','GKPanel Config','true'),
(16,'php_exer','PHP executable','php',NULL,'PHP Executable','GKPanel Config','false'),
(17,'temp_dir','Temp Directory','/var/GKPanel/temp/',NULL,'Global temp directory.','GKPanel Config','true'),
(18,'news_url','GKPanel News API URL','http://api.cybercore.tv/latestnews.json',NULL,'GKPanel News URL','GKPanel Config','false'),
(19,'update_url','GKPanel Update API URL','http://api.cybercore.tv/latestversion.json',NULL,'GKPanel Update URL','GKPanel Config','false'),
(21,'server_ip','Server IP Address','',NULL,'If set this will use this manually entered server IP address which is the prefered method for use behind a firewall.','GKPanel Config','true'),
(22,'zip_exe','ZIP Exe','zip',NULL,'Path to the ZIP Executable','GKPanel Config','true'),
(24,'disable_hostsen','Disable auto HOSTS file entry','false','true|false','Disable Host Entries','GKPanel Config','false'),
(25,'latestzpversion','Cached version of latest GKPanel version','1.0.0',NULL,'This is used for caching the latest version of GKPanel.','GKPanel Config','false'),
(26,'logmode','Debug logging mode','db','db|file|email','The default mode to log all errors in.','GKPanel Config','true'),
(27,'logfile','GKPanel Log file','/var/GKPanel/logs/GKPanel.log',NULL,'If logging is set to "file" mode this is the path to the log file that is to be used by GKPanel.','GKPanel Config','true'),
(28,'apikey','XMWS API Key','ee8795c8c53bfdb3b2cc595186b68912',NULL,'The secret API key for the server.','GKPanel Config','false');

INSERT  INTO XPanel_core.`x_settings`(`so_id_pk`,`so_name_vc`,`so_cleanname_vc`,`so_value_tx`,`so_defvalues_tx`,`so_desc_tx`,`so_module_vc`,`so_usereditable_en`) VALUES 
(29,'email_from_address','From Address','GKPanel@localhost',NULL,'The email address to appear in the From field of emails sent by GKPanel.','GKPanel Config','true'),
(30,'email_from_name','From Name','GKPanel Server',NULL,'The name to appear in the From field of emails sent by GKPanel.','GKPanel Config','true'),
(31,'email_smtp','Use SMTP','false','true|false','Use SMTP server to send emails from. (true/false)','GKPanel Config','true'),
(32,'smtp_auth','Use AUTH','false','true|false','SMTP requires authentication. (true/false)','GKPanel Config','true'),
(33,'smtp_server','SMTP Server','',NULL,'The address of the SMTP server.','GKPanel Config','true'),
(34,'smtp_port','SMTP Port','465',NULL,'The port address of the SMTP server (usually 25)','GKPanel Config','true'),
(35,'smtp_username','SMTP User','',NULL,'Username for authentication on the SMTP server.','GKPanel Config','true'),
(36,'smtp_password','SMTP Pass','',NULL,'Password for authentication on the SMTP server.','GKPanel Config','true'),
(37,'smtp_secure','SMTP Auth method','false','false|ssl|tls','If specified will attempt to use encryption to connect to the server, if "false" this is disabled. Available options: false, ssl, tls','GKPanel Config','true'),
(38,'daemon_lastrun','Daemon timeing cache','0',NULL,'Timestamp of when the daemon last ran.',NULL,'false'),
(39,'daemon_dayrun','Daemon timeing cache','0',NULL,NULL,NULL,'false'),
(40,'daemon_weekrun','Daemon timeing cache','0',NULL,NULL,NULL,'false'),
(41,'daemon_monthrun','Daemon timeing cache','0',NULL,NULL,NULL,'false');

INSERT  INTO XPanel_core.`x_settings`(`so_id_pk`,`so_name_vc`,`so_cleanname_vc`,`so_value_tx`,`so_defvalues_tx`,`so_desc_tx`,`so_module_vc`,`so_usereditable_en`) VALUES 
(42,'purge_bu','Purge Backups','true','true|false','Delete client backups after allotted time has elapsed to help save diskspace (true/false)','Backup Config','true'),
(43,'purge_date','Purge Date','30',NULL,'Time in days backups are safe from being deleted. After days have elapsed, older backups will be deleted on Daemon Day Run','Backup Config','true'),
(44,'disk_bu','Disk Backups','true','true|false','Allow users to create and save backups of their home directories to disk. (true/false)','Backup Config','true'),
(45,'schedule_bu','Daily Backups','false','true|false','Make a daily backup of each clients data, including MySQL databases to their backup folder. Backups will still be created if Disk Backups are set to false. (true/false)','Backup Config','true'),
(46,'ftp_db','FTP Database','gkpanel_proftpd',NULL,'The name of the ftp server database','FTP Config','true'),
(47,'ftp_php','FTP PHP','proftpd.php',NULL,'Name of PHP to include when adding FTP data.','FTP Config','true'),
(48,'ftp_service','FTP Service Name','proftpd',NULL,'The name of the FTP service','FTP Config','true'),
(49,'ftp_service_root','FTP Service Root','/etc/init.d/',NULL,'The path to the service executable if applicable.','FTP Config','true');

INSERT INTO XPanel_core.`x_settings`(`so_id_pk`,`so_name_vc`,`so_cleanname_vc`,`so_value_tx`,`so_defvalues_tx`,`so_desc_tx`,`so_module_vc`,`so_usereditable_en`) VALUES 
(50,'ftp_config_file','FTP Config File','',NULL,'The path to the configuration file if applicable.','FTP Config','true'),
(51,'mailserver_db','Mailserver Database','gkpanel_postfix',NULL,'The name of the mail server database','Mail Config','true'),
(52,'hmailserver_et','Hmail Encryption Type','2',NULL,'Type of encryption uses for hMailServer passwords','Mail Config','false'),
(53,'max_mail_size','Max Mailbox Size','200',NULL,'Maximum size in megabytes allowed for mailboxes. Default = 200','Mail Config','true'),
(54,'mailserver_php','Mailserver PHP','postfix.php',NULL,'Name of PHP to include when adding mailbox data.','Mail Config','true'),
(55,'remove_orphan','Remove Orphans','true','true|false','When domains are deleted, also delete all mailboxes for that domain when the daemon runs. (true/false)','Mail Config','true'),
(56,'named_dir','Named Directory','/etc/GKPanel/configs/bind/etc/',NULL,'Path to the directory where named.conf is stored','DNS Config','true'),
(57,'named_conf','Named Config','named.conf',NULL,'Named configuration file','DNS Config','true'),
(58,'zone_dir','Zone Directory','/etc/GKPanel/configs/bind/zones/',NULL,'Path to where DNS zone files are stored','DNS Config','true'),
(59,'refresh_ttl','SOA Refesh TTL','21600',NULL,'Global refresh TTL.  Default = 21600 (6 hours)','DNS Config','true'),
(60,'retry_ttl','SOA Retry TTL','3600',NULL,'Global retry TTL. Default = 3600 (1 hour)','DNS Config','true'),
(61,'expire_ttl','SOA Expire TTL','86400',NULL,'Global expire TTL. Default = 86400 (1 day)','DNS Config','true'),
(62,'minimum_ttl','SOA Minimum TTL','86400',NULL,'Global minimum TTL. Default = 86400 (1 day)','DNS Config','true'),
(63,'custom_ip','Allow Custom IP','true','true|false','Allow users to change IP settings in A records. If set to false, IP is locked to server IP setting in GKPanel Config','DNS Config','true'),
(64,'bind_dir','Path to BIND Root','',NULL,'Path to the root directory where BIND is installed.','DNS Config','true'),
(65,'bind_service','BIND Service Name','',NULL,'Name of the BIND service','DNS Config','true'),
(66,'allow_xfer','Allow Zone Transfers','trusted-servers',NULL,'Setting to restrict zone transfers in setting: allow-transfer {}; Default = all','DNS Config','true'),
(67,'allowed_types','Allowed Record Types','A AAAA CNAME MX TXT SRV SPF NS',NULL,'Types of records allowed seperated by a space. Default = A AAAA CNAME MX TXT SRV SPF NS','DNS Config','true'),
(68,'bind_log','Bind Log','/var/GKPanel/logs/bind/bind.log',NULL,'Path and name of the Bind Log','DNS Config','true'),
(69,'hosted_dir','Vhosts Directory','/var/GKPanel/hostdata/',NULL,'Virtual host directory','Apache Config','true');

INSERT INTO XPanel_core.`x_settings`(`so_id_pk`,`so_name_vc`,`so_cleanname_vc`,`so_value_tx`,`so_defvalues_tx`,`so_desc_tx`,`so_module_vc`,`so_usereditable_en`) VALUES 
(70,'disable_hostsen','Disable HOSTS file entries','false','true|false','Disable host entries','Apache Config','true'),
(71,'apache_vhost','Apache VHOST Conf','/etc/GKPanel/configs/apache/httpd-vhosts.conf',NULL,'The full system path and filename of the Apache VHOST configuration name.','Apache Config','true'),
(72,'php_handler','PHP Handler','AddType application/x-httpd-php .php3 .php',NULL,'The PHP Handler.','Apache Config','false'),
(73,'cgi_handler','CGI Handler','ScriptAlias /cgi-bin/ "/_cgi-bin/"\r\n<location /cgi-bin>\r\nAddHandler cgi-script .cgi .pl\r\nOptions +ExecCGI -Indexes\r\n</location>',NULL,'The CGI Handler.','Apache Config','false'),
(74,'global_vhcustom','Global VHost Entry',NULL,NULL,'Extra directives for all apache vhosts.','Apache Config','true'),
(75,'static_dir','Static Pages Directory','/etc/GKPanel/panel/etc/static/',NULL,'The GKPanel static directory, used for storing welcome pages etc. etc.','Apache Config','true'),
(76,'parking_path','Vhost Parking Path','/etc/GKPanel/panel/etc/static/parking/',NULL,'The path to the parking website, this will be used by all clients.','Apache Config','true'),
(78,'shared_domains','Shared Domains','no-ip,dyndns,autono,zphub',NULL,'Domains entered here can be shared across multiple accounts. Seperate domains with , example: no-ip,dyndns','Apache Config','true'),
(79,'upload_temp_dir','Upload Temp Directory','/var/GKPanel/temp/',NULL,'The path to the Apache Upload directory (with trailing slash)','Apache Config','true'),
(80,'apache_port','Apache Port','80',NULL,'Apache service port','Apache Config','true'),
(81,'dir_index','Directory Indexes','DirectoryIndex index.html index.htm index.php index.asp index.aspx index.jsp index.jspa index.shtml index.shtm',NULL,'Directory Index','Apache Config','true'),
(82,'suhosin_value','Suhosin Value','php_admin_value suhosin.executor.func.blacklist "passthru, show_source, shell_exec, system, pcntl_exec, popen, pclose, proc_open, proc_nice, proc_terminate, proc_get_status, proc_close, leak, apache_child_terminate, posix_kill, posix_mkfifo, posix_setpgid, posix_setsid, posix_setuid, escapeshellcmd, escapeshellarg, exec"',NULL,'Suhosin configuration for virtual host  blacklisting commands','Apache Config','true');

INSERT INTO XPanel_core.`x_settings`(`so_id_pk`,`so_name_vc`,`so_cleanname_vc`,`so_value_tx`,`so_defvalues_tx`,`so_desc_tx`,`so_module_vc`,`so_usereditable_en`) VALUES 
(83,'openbase_seperator','Open Base Seperator',':',NULL,'Seperator flag used in open_base_directory setting','Apache Config','false'),
(84,'openbase_temp','Open Base Temp Directory','/var/GKPanel/temp/',NULL,'Temp directory used in open_base_directory setting','Apache Config','true'),
(85,'access_log_format','Access Log Format','combined','combined|common','Log format for the Apache access log','Apache Config','true'),
(86,'bandwidth_log_format','Bandwidth Log Format','common','combined|common','Log format for the Apache bandwidth log','Apache Config','true'),
(87,'global_zpcustom','Global GKPanel Entry',NULL,NULL,'Extra directives for GKPanel default vhost.','Apache Config','true'),
(88,'use_openbase','Use Open Base Dir','true','true|false','Enable openbase directory for all vhosts','Apache Config','true'),
(89,'use_suhosin','Use Suhosin','true','true|false','Enable Suhosin for all vhosts','Apache Config','true'),
(90,'gkpanel_domain','GKPanel Domain','GKPanel.ztest.com',NULL,'Domain that the control panel is installed under.','GKPanel Config','false'),
(91,'log_dir','Log Directory','/var/GKPanel/logs/',NULL,'Root path to directory log folders','GKPanel Config','true'),
(92,'apache_changed','Apache Changed','true','true|false','If set, Apache Config daemon hook will write the vhost config file changes.','Apache Config','false'),
(94,'apache_allow_disabled','Allow Disabled','true','true|false','Allow webhosts to remain active even if a user has been disabled.','Apache Config','true'),
(95,'apache_budir','VHost Backup Dir','/var/GKPanel/backups/',NULL,'Directory that vhost.conf backups are stored.','Apache Config','true'),
(96,'apache_purgebu','Purge Backups','true','true|false','Old backups are deleted after the date set in Puge Date','Apache Config','true'),
(97,'apache_purge_date','Purge Date','7',NULL,'Time in days that vhost backups are safe from deletion','Apache Config','true'),
(98,'apache_backup','VHost Backup','true','true|false','Backup vhost file before a new one is written','Apache Config','true'),
(99,'zsudo','zsudo path','/etc/GKPanel/panel/bin/zsudo',NULL,'Path to the zsudo binary used by Apache to run system commands.','GKPanel Config','true');

INSERT INTO XPanel_core.`x_settings`(`so_id_pk`,`so_name_vc`,`so_cleanname_vc`,`so_value_tx`,`so_defvalues_tx`,`so_desc_tx`,`so_module_vc`,`so_usereditable_en`) VALUES 
(100,'apache_restart','Apache Restart Cmd','reload',NULL,'Command line arguments used after the restart service request when reloading Apache.','Apache Config','true'),
(101,'httpd_exe','Apache Binary','',NULL,'Path to the Apache binary','Apache Config','true'),
(102,'apache_sn','Apache Service Name','',NULL,'Service name used to handle Apache service control','Apache Config','true'),
(103,'daemon_exer',NULL,'/etc/GKPanel/panel/bin/daemon.php',NULL,'Path to the GKPanel daemon','GKPanel Config','false'),
(104,'daemon_timing',NULL,'0 * * * *',NULL,'Cron time for when to run the GKPanel daemon','GKPanel Config','false'),
(105,'cron_file','Cron File','',NULL,'Path to the user cron file','Cron Config','true'),
(107,'mysqldump_exe','MySQL Dump','mysqldump',NULL,'Path to MySQL dump','GKPanel Config','false'),
(108,'dns_hasupdates','DNS Updated',NULL,NULL,NULL,NULL,'false'),
(109,'named_checkconf','Named CheckConfig','named-checkconf',NULL,'Path to named-checkconf bind utility.','DNS Config','true'),
(110,'named_checkzone','Named CheckZone','named-checkzone',NULL,'Path to named-checkzone bind utility.','DNS Config','true'),
(111,'named_compilezone','Named CompileZone','named-compilezone',NULL,'	Path to named-compilezone bind utility.','DNS Config','true'),
(112,'mailer_type','Mail method','mail','mail|smtp|sendmail','Method to use when sending emails out. (mail = PHP Mail())','GKPanel Config','true'),
(113,'daemon_run_interval','Number of seconds between each daemon execution','300',NULL,'The total number of seconds between each daemon run (default 300 = 5 mins)','GKPanel Config','false'),
(114,'debug_mode','GKPanel Debug Mode','prod','dev|prod','Whether or not to show PHP debug errors,warnings and notices','GKPanel Config','true'),
(115,'password_minlength','Min Password Length','6',NULL,'Minimum length required for new passwords','GKPanel Config','true'),
(116,'cron_reload_command','Cron Reload Command','crontab',NULL,'Crontab binary in Linux Only','Cron Config','true'),
(117,'cron_reload_path','Cron Reload Path','',NULL,'Cron reload path in Linux Only','Cron Config','true'),
(118,'cron_reload_flag','Cron Reload Flags','-u',NULL,'Cron reload command flags in Linux Only','Cron Config','true'),
(119,'cron_reload_user','Cron Reload User','',NULL,'Cron reload apache user in Linux','Cron Config','true'),
(120,'login_csfr','Remote Login Forms','false','false|true','Disables CSFR protection on the login form to enable remote login forms.','GKPanel Config','true'),
(121,'gkpanel_port','GKPanel Apache Port','80',NULL,'GKPanel Apache panel port (change will be pending until next daemon run)','GKPanel Config','true');


UPDATE `XPanel_core`.`x_translations` SET `tr_en_tx` = 'Check to see if there are any available updates to your version of the GKPanel software.', `tr_de_tx` = 'Prüfen Sie, ob es irgendwelche verfügbaren Aktualisierungen für Ihre Version des GKPanel Software.' WHERE `tr_id_pk` = '97';
UPDATE `XPanel_core`.`x_translations` SET `tr_en_tx` = 'GKPanel News', `tr_de_tx` = 'GKPanel Aktuelles' WHERE `tr_id_pk` = '72';
UPDATE `XPanel_core`.`x_translations` SET `tr_en_tx` = 'Welcome to the Package Manager, using this module enables you to create and manage existing reseller packages on your GKPanel hosting account.', `tr_de_tx` = 'Willkommen auf der Paket-Manager, mit diesem Modul ermöglicht Ihnen die Erstellung und Verwaltung von bestehenden Reseller-Pakete auf Ihrem GKPanel Hosting-Account.' WHERE `tr_id_pk` = '111';
UPDATE `XPanel_core`.`x_translations` SET `tr_en_tx` = 'Find out all the latest news and information from the GKPanel project.', `tr_de_tx` = 'Finden Sie heraus, alle Neuigkeiten und Informationen aus dem GKPanel Projekt.' WHERE `tr_id_pk` = '96';
UPDATE `XPanel_core`.`x_translations` SET `tr_en_tx` = 'phpMyAdmin is a web based tool that enables you to manage your GKPanel MySQL databases via. the web.', `tr_de_tx` = 'phpMyAdmin ist ein webbasiertes Tool, das Sie zu Ihrem GKPanel MySQL-Datenbanken via verwalten können. im Internet.' WHERE `tr_id_pk` = '99';
UPDATE `XPanel_core`.`x_translations` SET `tr_en_tx` = 'If you have found a bug with GKPanel you can report it here.', `tr_de_tx` = 'Did you mean: If you have found a bug with CPanel you can report it here.^M
Wenn Sie einen Fehler mit GKPanel gefunden haben, können Sie ihn hier melden.' WHERE `tr_id_pk` = '98';
UPDATE `XPanel_core`.`x_translations` SET `tr_en_tx` = 'GKPanel Config', `tr_de_tx` = 'Config GKPanel' WHERE `tr_id_pk` = '71';
UPDATE `XPanel_core`.`x_translations` SET `tr_en_tx` = 'The backup manager module enables you to backup your entire hosting account including all your MySQL&reg; databases.', `tr_de_tx` = 'Der Backup-Manager-Modul ermöglicht es Ihnen, Ihre gesamte Hosting-Account inklusive aller Ihrer MySQL &reg; Datenbank-Backup.' WHERE `tr_id_pk` = '103';

/* reset all users to new GKPanel theme */
UPDATE `XPanel_core`.`x_accounts` SET `ac_usertheme_vc` = 'gkpanel_Default';

ALTER TABLE `XPanel_roundcube`.`users` CHANGE `preferences` `preferences` longtext;

ALTER TABLE `XPanel_core`.`x_packages` DROP `pk_enablecgi_in`;


INSERT INTO `XPanel_core`.`x_permissions`(`pe_group_fk`,`pe_module_fk`) VALUES (1, (SELECT `mo_id_pk` FROM `XPanel_core`.`x_modules` WHERE `mo_folder_vc` = 'protected_directories' LIMIT 1));
INSERT INTO `XPanel_core`.`x_permissions`(`pe_group_fk`,`pe_module_fk`) VALUES (2, (SELECT `mo_id_pk` FROM `XPanel_core`.`x_modules` WHERE `mo_folder_vc` = 'protected_directories' LIMIT 1));
INSERT INTO `XPanel_core`.`x_permissions`(`pe_group_fk`,`pe_module_fk`) VALUES (3, (SELECT `mo_id_pk` FROM `XPanel_core`.`x_modules` WHERE `mo_folder_vc` = 'protected_directories' LIMIT 1));



ALTER TABLE `XPanel_core`.`x_accounts` 
COLLATE=utf8_general_ci;

ALTER TABLE `XPanel_core`.`x_aliases` 
COLLATE=utf8_general_ci;

ALTER TABLE `XPanel_core`.`x_bandwidth` 
  DROP PRIMARY KEY, 
  ADD PRIMARY KEY(`bd_id_pk`);

ALTER TABLE `XPanel_core`.`x_distlists` 
COLLATE=utf8_general_ci;

ALTER TABLE `XPanel_core`.`x_distlistusers` 
COLLATE=utf8_general_ci;

ALTER TABLE `XPanel_core`.`x_dns` 
  CHANGE COLUMN dn_target_vc dn_target_vc varchar(255) NULL, 
COLLATE=utf8_general_ci;

ALTER TABLE `XPanel_core`.`x_faqs` 
  DROP PRIMARY KEY, 
  ADD PRIMARY KEY(`fq_id_pk`), 
COLLATE=utf8_general_ci;

ALTER TABLE `XPanel_core`.`x_forwarders` 
COLLATE=utf8_general_ci;

ALTER TABLE `XPanel_core`.`x_ftpaccounts` 
  CHANGE COLUMN ft_user_vc ft_user_vc varchar(50) NULL;

ALTER TABLE `XPanel_core`.`x_logs` 
  DROP PRIMARY KEY, 
  ADD PRIMARY KEY(`lg_id_pk`), 
COLLATE=utf8_general_ci;

ALTER TABLE `XPanel_core`.`x_mailboxes` 
COLLATE=utf8_general_ci;

ALTER TABLE `XPanel_core`.`x_modcats` 
COLLATE=utf8_general_ci;

ALTER TABLE `XPanel_core`.`x_modules` 
COLLATE=utf8_general_ci;

ALTER TABLE `XPanel_core`.`x_packages`
/*not require for windows
windows use return error
#1091 - Can't DROP 'pk_enablecgi_in'; check that column/key exists
  DROP COLUMN pk_enablecgi_in,*/ 
  CHANGE COLUMN pk_created_ts pk_created_ts int(30) NULL, 
  CHANGE COLUMN pk_deleted_ts pk_deleted_ts int(30) NULL AFTER pk_created_ts;

ALTER TABLE `XPanel_core`.`x_permissions` 
  DROP PRIMARY KEY, 
  ADD PRIMARY KEY(`pe_id_pk`);

ALTER TABLE `XPanel_core`.`x_profiles` 
COLLATE=utf8_general_ci;

ALTER TABLE `XPanel_core`.`x_settings` 
COLLATE=utf8_general_ci;

ALTER TABLE `XPanel_core`.`x_translations` 
COLLATE=utf8_general_ci;

                                                                                    
/*not require for windows
windows use return error
#1060 - Duplicate column name 'vh_soaserial_vc'                                                                                     
ALTER TABLE `XPanel_core`.`x_vhosts` 
  ADD COLUMN vh_soaserial_vc char(10) NULL DEFAULT 'AAAAMMDDSS' AFTER vh_portforward_in;*/
DROP TABLE IF EXISTS `XPanel_core`.`x_htpasswd_file`;
                                                                                    
CREATE TABLE `XPanel_core`.`x_htpasswd_file` (
  `x_htpasswd_file_id` int(11) NOT NULL AUTO_INCREMENT,
  `x_htpasswd_file_target` varchar(255) NOT NULL,
  `x_htpasswd_file_message` varchar(255) NOT NULL,
  `x_htpasswd_file_created` int(11) NOT NULL,
  `x_htpasswd_file_deleted` int(11) DEFAULT NULL,
  `x_htpasswd_gkpanel_user_id` int(11) NOT NULL,
  PRIMARY KEY (`x_htpasswd_file_id`),
  UNIQUE KEY `x_htpasswd_file_target` (`x_htpasswd_file_target`),
  KEY `x_htpasswd_file_x_htpasswd_gkpanel_user_id_idx` (`x_htpasswd_gkpanel_user_id`)
) DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `XPanel_core`.`x_htpasswd_mapper`;                                                                                    
                                                                                    
CREATE TABLE `XPanel_core`.`x_htpasswd_mapper` (
  `x_htpasswd_mapper_id` int(11) NOT NULL AUTO_INCREMENT,
  `x_htpasswd_file_id` int(11) NOT NULL,
  `x_htpasswd_user_id` int(11) NOT NULL,
  PRIMARY KEY (`x_htpasswd_mapper_id`),
  KEY `x_htpasswd_mapper_x_htpasswd_file_id_idx` (`x_htpasswd_file_id`),
  KEY `x_htpasswd_mapper_x_htpasswd_user_id_idx` (`x_htpasswd_user_id`)
) DEFAULT CHARSET=utf8;
                                                                                    
DROP TABLE IF EXISTS `XPanel_core`.`x_htpasswd_user`;                                                                                    

CREATE TABLE `XPanel_core`.`x_htpasswd_user` (
  `x_htpasswd_user_id` int(11) NOT NULL AUTO_INCREMENT,
  `x_htpasswd_user_username` varchar(255) NOT NULL,
  `x_htpasswd_user_password` varchar(255) NOT NULL,
  `x_htpasswd_user_created` int(11) NOT NULL,
  `x_htpasswd_user_deleted` int(11) DEFAULT NULL,
  `x_htpasswd_gkpanel_user_id` int(11) NOT NULL,
  PRIMARY KEY (`x_htpasswd_user_id`),
  UNIQUE KEY `x_htpasswd_user_username` (`x_htpasswd_user_username`),
  UNIQUE KEY `x_htpasswd_user_password` (`x_htpasswd_user_password`)
) DEFAULT CHARSET=utf8;



CREATE DATABASE gkpanel_core;
CREATE DATABASE gkpanel_roundcube;
CREATE DATABASE gkpanel_hmail;
