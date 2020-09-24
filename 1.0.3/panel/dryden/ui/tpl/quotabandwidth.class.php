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
class ui_tpl_quotabandwidth {

    public static function Template() {
        $currentuser = ctrl_users::GetUserDetail();
        if ($currentuser['bandwidthquota'] == 0)
            $bandwidthquota = '<: Unlimited :>';
        else
            $bandwidthquota = fs_director::ShowHumanFileSize($currentuser['bandwidthquota']);
        return $bandwidthquota;
    }

}

?>
