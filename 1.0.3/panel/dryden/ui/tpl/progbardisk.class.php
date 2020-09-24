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
class ui_tpl_progbardisk {

    public static function Template() {
        $currentuser = ctrl_users::GetUserDetail();
        $diskquota = $currentuser['diskquota'];
        $diskspace = ctrl_users::GetQuotaUsages('diskspace', $currentuser['userid']);

        if ($diskquota == 0) {
            return '<div class="progress progress-striped"><div class="progress-bar progress-bar-success" style="width: 0%"></div></div>';
        } else {
            if (fs_director::CheckForEmptyValue($diskspace)){
                $diskspace = 0;
            }
            $percent = round(($diskspace / $diskquota) * 100, 0);
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
