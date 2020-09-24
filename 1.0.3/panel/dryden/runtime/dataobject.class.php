<?php

/**
 * @copyright 2014-2015 GKPanel Project (http://www.cybercore.tv/) 
 * GKPanel is a GPL fork of the XPanel Project whose original header follows:
 *
 * Dataobject class a means to handle data arrays.
 * @package XPanelx
 * @subpackage dryden -> runtime
 * @version 1.0.0
 * @author HuyGK (huygk@cybercore.tv)
 * @copyright GKPanel Project (http://www.cybercore.tv/)
 * @link http://www.cybercore.tv/
 * @license GPL (http://www.gnu.org/licenses/gpl.html)
 */
class runtime_dataobject {

    /**
     * The associated array of which to store all dataobject entites in.
     * @var array
     */
    protected $object;

    function __construct() {
        $this->object = array();
    }

    /**
     * Used to 'push' an associated array on to the object's $object array.
     * @author HuyGK (huygk@cybercore.tv)
     * @param array $arr The associative array data to add to the object.
     * @return obj
     */
    private function array_push_associative(&$arr) {
        $args = func_get_args();
        foreach ($args as $arg) {
            if (is_array($arg)) {
                foreach ($arg as $key => $value) {
                    $arr[$key] = $value;
                    $this->object++;
                }
            } else {
                $arr[$arg] = "";
            }
        }
        return $this->object;
    }

    /**
     * Enables an easy to use key/value pushing to the data object.
     * @author HuyGK (huygk@cybercore.tv)
     * @param string $name The name of the key.
     * @param string $value The value of the key.
     */
    public function addItemValue($name, $value) {
        $this->array_push_associative($this->object, array("$name" => "$value"));
    }

    /**
     * Returns an associated array (data object)
     * @author HuyGK (huygk@cybercore.tv)
     * @return array The dataobject contents.
     */
    public function getDataObject() {
        return $this->object;
    }

    /**
     * Returns a named data object record value.
     * @author HuyGK (huygk@cybercore.tv)
     * @param string $name The name of the data record (key) to return from the current object.
     * @return string The value.
     */
    public function getDataRecord($name) {
        return $this->object[$name];
    }

}

?>
