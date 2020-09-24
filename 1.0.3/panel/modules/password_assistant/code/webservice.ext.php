<?php

/**
 * @copyright 2014-2015 GKPanel Project (http://www.cybercore.tv/) 
 * GKPanel is a GPL fork of the XPanel Project whose original header follows:
 *
 * @package XPanelx
 * @subpackage modules
 * @author HuyGK (huygk@cybercore.tv)
 * @copyright GKPanel Project (http://www.cybercore.tv/)
 * @link http://www.cybercore.tv/
 * @license GPL (http://www.gnu.org/licenses/gpl.html)
 */
class webservice extends ws_xmws {

    /**
     * Resets a user's GKPanel account password. Requires <uid> and <newpassword> tags.
     * @return type 
     */
    function ResetUserPassword() {
        $contenttags = $this->XMLDataToArray($this->wsdata);
        $dataobject = new runtime_dataobject();
        $dataobject->addItemValue('response', '');
        if (module_controller::UpdatePassword($contenttags['xmws']['content']['uid'], $contenttags['xmws']['content']['newpassword'])) {
            $dataobject->addItemValue('content', ws_xmws::NewXMLTag('uid', $contenttags['xmws']['content']['uid']) . ws_xmws::NewXMLTag('reset', 'true'));
        } else {
            $dataobject->addItemValue('content', ws_xmws::NewXMLTag('uid', $contenttags['xmws']['content']['uid']) . ws_xmws::NewXMLTag('reset', 'false'));
        }
        return $dataobject->getDataObject();
    }

}

?>
