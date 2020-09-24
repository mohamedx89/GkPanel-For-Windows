<?php

/**
 * @copyright 2014-2015 GKPanel Project (http://www.cybercore.tv/) 
 * GKPanel is a GPL fork of the XPanel Project whose original header follows:
 *
 *
 * GKPanel - Visitor Stats GKPanel plugin, written by HuyGK: www.cybercore.tv.
 *
 */
	echo fs_filehandler::NewLine() . "BEGIN VISITOR STATS" . fs_filehandler::NewLine();
		if (ui_module::CheckModuleEnabled('Visitor Stats')){
			GenerateVisitorStats();
		} else {
			echo "Visitor Stats Module DISABLED." . fs_filehandler::NewLine();
		}
	echo "END VISITOR STATS" . fs_filehandler::NewLine();

	function GenerateVisitorStats(){
		include('cnf/db.php');
		$z_db_user = $user;
		$z_db_pass = $pass;
		try {	
			$zdbh = new db_driver("mysql:host=localhost;dbname=" . $dbname . "", $z_db_user, $z_db_pass);
		} catch (PDOException $e) {

		}
        $sql = $zdbh->prepare("SELECT * FROM x_vhosts LEFT JOIN x_accounts ON x_vhosts.vh_acc_fk=x_accounts.ac_id_pk WHERE vh_deleted_ts IS NULL");
        $sql->execute();
		echo "Generating visitor stats html..." . fs_filehandler::NewLine();
        while ($rowvhost = $sql->fetch()) {
        	if (!file_exists(ctrl_options::GetOption('gkpanel_root') . "modules/visitor_stats/stats/" . $rowvhost['ac_user_vc'] . "")) {
            	@mkdir(ctrl_options::GetOption('gkpanel_root') . "modules/visitor_stats/stats/" . $rowvhost['ac_user_vc'] . "", 777, TRUE);
        	}
			if (sys_versions::ShowOSPlatformVersion() == "Windows"){
	        $runcommand = ctrl_options::GetOption('gkpanel_root') ."modules/visitor_stats/bin/visitors.exe -A -m 30 " .ctrl_options::GetOption('log_dir') . "domains/" . $rowvhost['ac_user_vc'] . "/" . $rowvhost['vh_name_vc'] . "-access.log -o html > " . ctrl_options::GetOption('gkpanel_root') . "modules/visitor_stats/stats/" . $rowvhost['ac_user_vc'] . "/" . $rowvhost['vh_name_vc'] . ".html";
			} else {
			chmod(ctrl_options::GetOption('gkpanel_root') ."modules/visitor_stats/bin/visitors", 4777);
			$runcommand = ctrl_options::GetOption('gkpanel_root') ."modules/visitor_stats/bin/visitors -A -m 30 " .ctrl_options::GetOption('log_dir') . "domains/" . $rowvhost['ac_user_vc'] . "/" . $rowvhost['vh_name_vc'] . "-access.log -o html > " . ctrl_options::GetOption('gkpanel_root') . "modules/visitor_stats/stats/" . $rowvhost['ac_user_vc'] . "/" . $rowvhost['vh_name_vc'] . ".html";
			}
			echo "Generating stats for: " . $rowvhost['ac_user_vc'] . "/" . $rowvhost['vh_name_vc'] . fs_filehandler::NewLine();
        	system($runcommand);
		}
	}
?>