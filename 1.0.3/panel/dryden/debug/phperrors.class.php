<?php

/**
 * @copyright 2014-2015 GKPanel Project (http://www.cybercore.tv/) 
 * GKPanel is a GPL fork of the XPanel Project whose original header follows:
 *
 * Development class enables PHP error reporting for ease of development!
 * @package XPanelx
 * @subpackage dryden -> debug
 * @version 1.0.0
 * @author HuyGK (huygk@cybercore.tv)
 * @copyright GKPanel Project (http://www.cybercore.tv/)
 * @link http://www.cybercore.tv/
 * @license GPL (http://www.gnu.org/licenses/gpl.html)
 */
class debug_phperrors {

    /**
     * Sets PHP error reporting to ON and displays ALL errors if set to 'dev' otherwise will disable all errors.
     * @author HuyGK (huygk@cybercore.tv)
     * @param str $mode Either 'dev' or 'prod', is left blank 'prod' is used by default.
     */
    static function SetMode($mode = '') {
        if ($mode == 'dev') {
            error_reporting('E_ALL');
            ini_set('error_reporting', E_ALL);
        } else {
            error_reporting('E_NONE');
            ini_set('error_reporting', E_NONE);
        }
    }

}

?>
