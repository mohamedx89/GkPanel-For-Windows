<?php

/**
 * @copyright 2014-2015 GKPanel Project (http://www.cybercore.tv/) 
 * GKPanel is a GPL fork of the XPanel Project whose original header follows:
 *
 * A class to protect against LFI.
 * @package XPanelx
 * @subpackage dryden -> filesystem
 * @version 1.0.3
 * @author HuyGK (huygk@cybercore.tv)
 * @copyright GKPanel Project (http://www.cybercore.tv/)
 * @link http://www.cybercore.tv/
 * @license GPL (http://www.gnu.org/licenses/gpl.html)
 */
class fs_protector {

    /**
     * Returns a safe file system string (to stop reverse iteration of the file system by removing full-stops and slashes (file system seperators etc. in theory, jailing them.)
     * @author HuyGK (huygk@cybercore.tv) 
     * @param $foldername The single name of the folder.
     * @return string The sanitised module folder name. 
     */
    public static function SanitiseFolderName($foldername) {
        return str_replace(array('.', '/', '\\'), array('_', '_', '_'), $foldername);
    }

    /**
     * Checks module folder name from URL, checks with the database that a module is installed and therefore legit.
     * @author HuyGK (huygk@cybercore.tv) 
     * @return string The sanitised module folder name. 
     */
    public static function ModuleRequest() {
        global $zdbh;
        if (isset($_GET['m'])) {
            $module_folder = $_GET['m'];
        } elseif (isset($_GET['module'])) {
            $module_folder = $_GET['module'];
        } else {
            $module_folder = null;
        }
        $sqlString = "SELECT mo_folder_vc FROM x_modules WHERE mo_folder_vc = ':name'";
        $bindArray = array(':name' => $module_folder);
        $zdbh->bindQuery($sqlString, $bindArray);
        $result = $zdbh->returnRow();
        if ($result) {
            return $result['mo_folder_vc'];
        } else {
            return false;
        }
    }

}

?>
