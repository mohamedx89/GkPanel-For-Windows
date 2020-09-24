<?php

/**
 * @copyright 2014-2015 GKPanel Project (http://www.cybercore.tv/) 
 * GKPanel is a GPL fork of the XPanel Project whose original header follows:
 *
 * Generic template place holder class.
 * @package XPanelx
 * @subpackage dryden -> ui -> tpl
 * @version 1.1.0
 * @author HuyGK (huygk@cybercore.tv)
 * @copyright GKPanel Project (http://www.cybercore.tv/)
 * @link http://www.cybercore.tv/
 * @license GPL (http://www.gnu.org/licenses/gpl.html)
 */
class ui_tpl_progbarbandwidth {

    public static function Template() {
        $currentuser = ctrl_users::GetUserDetail();
        $bandwidthquota = $currentuser['bandwidthquota'];
        $bandwidth = ctrl_users::GetQuotaUsages('bandwidth', $currentuser['userid']);

        if ($bandwidthquota == 0) {
            return '<div class="progress progress-striped"><div class="progress-bar progress-bar-success" style="width: 0%"></div></div>';
        } else {
            if (fs_director::CheckForEmptyValue($bandwidth)){
                $bandwidth = 0;
            }
            $percent = round(($bandwidth / $bandwidthquota) * 100, 0);
            if($percent >= 75){
                $bar = 'danger';
            }else{
                $bar = 'success';
            }
            if($percent >= 10){
                $showpercent = $percent.'%';
            }else{
                $showpercent = '';
            }
            return '<div class="progress progress-striped"><div class="progress-bar progress-bar-'.$bar.'" style="width: ' . $percent . '%">' . $showpercent . '</div></div>';
        }
    }

}

?>
