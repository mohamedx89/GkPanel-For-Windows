<?php
/**
 * @copyright 2014-2015 GKPanel Project (http://www.cybercore.tv/) 
 * GKPanel is a GPL fork of the GKPanel Project whose original header follows:
 *
 * Hook created by HuyGK to obtain latest GKPanel version number and add it to the DB for querying (caching bascially!)
 * This script is handy for caching the latest version of GKPanel to reduce bandwidth from the server.
 * 
 */
echo fs_filehandler::NewLine() . "START GKPanel Updates hook" . fs_filehandler::NewLine();
echo "Checking for latest version of GKPanel..." . fs_filehandler::NewLine();
CheckGKPanelLatestVersion();
echo "END GKPanel Updates hook" . fs_filehandler::NewLine();
function CheckGKPanelLatestVersion() {
    // Grab the latest version of GKPanel from the GKPanel API servers and cache it into the database.
    $live_version = ws_generic::ReadURLRequestResult(ctrl_options::GetSystemOption('update_url'));
    if (!$live_version) {
        return false;
    }
        
    $versionnumber = ws_generic::JSONToArray($live_version);
# GKPanel API returns simple object not in an array like it was for GKPanel.
#    if(count($versionnumber) > 1) {
#        $currentVersionSetting = current($versionnumber);
#        $currentVersion = $currentVersionSetting['version'];
#    } else {
        $currentVersion = $versionnumber['version'];
#    }
    
    ctrl_options::SetSystemOption('latestzpversion', $currentVersion);
    return true;
}
?>