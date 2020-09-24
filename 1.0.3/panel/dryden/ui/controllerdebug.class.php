<?php

/**
 * @copyright 2014-2015 GKPanel Project (http://www.cybercore.tv/) 
 * GKPanel is a GPL fork of the XPanel Project whose original header follows:
 *
 * Class to display controller debugging in the template layer.
 * @package XPanelx
 * @subpackage dryden -> ui
 * @version 1.0.0
 * @author HuyGK (huygk@cybercore.tv)
 * @copyright GKPanel Project (http://www.cybercore.tv/)
 * @link http://www.cybercore.tv/
 * @license GPL (http://www.gnu.org/licenses/gpl.html)
 */
class ui_controllerdebug extends runtime_controller {

    /**
     * Template placeholder to display controller debug infomation.
     * @author HuyGK (huygk@cybercore.tv)
     * @global obj $controller The controller object.
     * @return string HTML output to display the controller debug infomation in a pretty way
     */
    static function Template() {
        global $controller;
        if ($controller->OutputControllerDebug()) {
            $controllerdebug = $controller->OutputControllerDebug();
            $retval = "<!-- BEGIN DEBUG -->
	<div class=\"zdebug\" id=\"zdebug\">" . $controllerdebug . "</div>
	<!-- END DEBUG -->";
            return $retval;
        }
    }

}

?>
