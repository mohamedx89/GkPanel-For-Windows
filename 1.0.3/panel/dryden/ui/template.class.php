<?php

/**
 * @copyright 2014-2015 GKPanel Project (http://www.cybercore.tv/) 
 * GKPanel is a GPL fork of the XPanel Project whose original header follows:
 *
 * Interface template selection class.
 * @package XPanelx
 * @subpackage dryden -> ui
 * @version 1.0.0
 * @author HuyGK (huygk@cybercore.tv)
 * @copyright GKPanel Project (http://www.cybercore.tv/)
 * @link http://www.cybercore.tv/
 * @license GPL (http://www.gnu.org/licenses/gpl.html)
 */
class ui_template {

    /**
     * Returns the name (folder name) of the template that should be used for the current user.
     * @author HuyGK (huygk@cybercore.tv)
     * @return string The template name.
     */
    static function GetUserTemplate() {
        $user = ctrl_users::GetUserDetail();
        if (fs_director::CheckForEmptyValue($user['usertheme'])) {
            # Lets use the reseller's theme they have setup!
            $reseller = ctrl_users::GetUserDetail($user['resellerid']);
            return $reseller['usertheme'];
        } else {
            return $user['usertheme'];
        }
    }

    /**
     * Lists all avaliable templates in the 'etc/styles/' folder.
     * @author HuyGK (huygk@cybercore.tv)
     * @return array 
     */
    static function ListAvaliableTemplates() {
        $allstyles = array();
        $handle = @opendir(ctrl_options::GetSystemOption('gkpanel_root') . "etc/styles");
        $chkdir = ctrl_options::GetSystemOption('gkpanel_root') . "etc/styles/";
        if ($handle) {
            while ($file = readdir($handle)) {
                if ($file != "." && $file != "..") {
                    if (is_dir($chkdir . $file)) {
                        array_push($allstyles, array('name' => $file));
                    }
                }
            }
            closedir($handle);
        }
        return $allstyles;
    }

    /**
     * Returns a list of all avaliable CSS styles for a given theme. If only a single CSS style then it will return false.
     * @author HuyGK (huygk@cybercore.tv)
     * @param string $template The template name (folder name) of which to check for extra CSS stlyes.
     * @return array List of avaliable CSS styles for this theme.
     */
    static function ListAvaliableCSS($template) {
        $allstyles = array();
        $handle = @opendir(ctrl_options::GetSystemOption('gkpanel_root') . "etc/styles/" . $template . "/css");
        $chkdir = ctrl_options::GetSystemOption('gkpanel_root') . "etc/styles/" . $template . "/css/";
        if ($handle) {
            while ($file = readdir($handle)) {
                if ($file != "." && $file != ".." && strtolower(substr($file, -4)) == ".css") {
                    if (is_file($chkdir . $file)) {
                        array_push($allstyles, array('name' => str_replace(".css", "", $file)));
                    }
                }
            }
            closedir($handle);
        }
        return $allstyles;
    }

}

?>
