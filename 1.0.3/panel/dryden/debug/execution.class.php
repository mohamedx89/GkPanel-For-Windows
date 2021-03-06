<?php

/**
 * @copyright 2014-2015 GKPanel Project (http://www.cybercore.tv/) 
 * GKPanel is a GPL fork of the XPanel Project whose original header follows:
 *
 * Provides controller/framework execution debug tools.
 * @package XPanelx
 * @subpackage dryden -> debug
 * @version 1.0.0
 * @author HuyGK (huygk@cybercore.tv)
 * @copyright GKPanel Project (http://www.cybercore.tv/)
 * @link http://www.cybercore.tv/
 * @license GPL (http://www.gnu.org/licenses/gpl.html)
 */
class debug_execution {

    /**
     * Displays the current script memory usage.
     * @author HuyGK (huygk@cybercore.tv)
     * @return string Human readable memory usage for of the script.
     */
    static function ScriptMemoryUsage() {
        $mem_usage = memory_get_usage(false);
        if ($mem_usage < 1024) {
            $retval = $mem_usage . " bytes";
        } elseif ($mem_usage < 1048576) {
            $retval = round($mem_usage / 1024, 2) . " KB";
        } else {
            $retval = round($mem_usage / 1048576, 2) . " MB";
        }
        return $retval;
    }

    /**
     * Gets a list of all the currently loaded classes.
     * @author HuyGK (huygk@cybercore.tv)
     * @return array List of the classes that are currently loaded.
     */
    static function GetLoadedClasses() {
        $classes_loaded = get_declared_classes();
        return $classes_loaded;
    }

    /**
     * Gets a list of all the SQL queries executed for this request.
     * @global db_driver $zdbh The ZPX database handle.
     * @author HuyGK (huygk@cybercore.tv)
     * @return array List of all executed SQL queries for this request.
     */
    static function GetSQLQueriesExecuted() {
        global $zdbh;
        return $zdbh->getExecutedQueries();
    }

}

?>
