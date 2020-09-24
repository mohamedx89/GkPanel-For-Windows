<?php

/**
 * @copyright 2014-2015 GKPanel Project (http://www.cybercore.tv/) 
 * GKPanel is a GPL fork of the XPanel Project whose original header follows:
 *
 * A search and retrieve/replace class.
 * @package XPanelx
 * @subpackage dryden -> runtime
 * @version 1.0.0
 * @author HuyGK (huygk@cybercore.tv)
 * @copyright GKPanel Project (http://www.cybercore.tv/)
 * @link http://www.cybercore.tv/
 * @license GPL (http://www.gnu.org/licenses/gpl.html)
 */
class runtime_haystack {

    /**
     * Get a value between two given strings.
     * @author HuyGK (huygk@cybercore.tv)
     * @param string $string The complete string on which to compute.
     * @param string $start The starting character or seqence of characters.
     * @param string $end The ending character or seqence of characters.
     * @return string The value of the string between the starting and ending character(s).
     */
    static function GetValueBetween($string, $start, $end) {
        $string = " " . $string;
        $ini = strpos($string, $start);
        if ($ini == 0)
            return "";
        $ini += strlen($start);
        $len = strpos($string, $end, $ini) - $ini;
        return substr($string, $ini, $len);
    }

}

?>
