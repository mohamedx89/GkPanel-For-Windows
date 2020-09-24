<?php

/**
 * @copyright 2014-2015 GKPanel Project (http://www.cybercore.tv/) 
 * GKPanel is a GPL fork of the XPanel Project whose original header follows:
 *
 * Generic template place holder class.
 * @package XPanelx
 * @subpackage dryden -> ui -> tpl
 * @version 1.0.0
 * @author HuyGK (huygk@cybercore.tv)
 * @copyright GKPanel Project (http://www.cybercore.tv/)
 * @link http://www.cybercore.tv/
 * @license GPL (http://www.gnu.org/licenses/gpl.html)
 */
class ui_tpl_csspath {

    public static function Template() {
        $user = ctrl_users::GetUserDetail();
        if (!fs_director::CheckForEmptyValue(fs_director::CheckForEmptyValue($user['usercss']))) {
            $retval = "etc/styles/" . ui_template::GetUserTemplate() . "/css/default.css";
        } else {
            $retval = "etc/styles/" . ui_template::GetUserTemplate() . "/css/" . $user['usercss'] . ".css";
        }
        return $retval;
    }

}

?>
