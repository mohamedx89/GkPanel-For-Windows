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
     * Returns the status of all standard GKPanel hosting ports and the current server uptime.
     * @author HuyGK (huygk@cybercore.tv)
     * @return type 
     */
    function GetServiceStatus() {
        $response_xml = ws_xmws::NewXMLContentSection('portstatus', array(
                    'web' => (module_controller::getIsWebServerUp() == '' ? 0 : 1),
                    'ftp' => (module_controller::getIsFTPUp() == '' ? 0 : 1),
                    'pop3' => (module_controller::getIsPOP3Up() == '' ? 0 : 1),
                    'imap' => (module_controller::getIsIMAPUp() == '' ? 0 : 1),
                    'smtp' => (module_controller::getIsSMTPUp() == '' ? 0 : 1),
                    'mysql' => (module_controller::getIsMySQLUp() == '' ? 0 : 1),
                ));
        $response_xml .= ws_xmws::NewXMLTag('serveruptime', sys_monitoring::ServerUptime());

        $dataobject = new runtime_dataobject();
        $dataobject->addItemValue('response', '');
        $dataobject->addItemValue('content', $response_xml);

        return $dataobject->getDataObject();
    }

    function GetPortStatus() {
        $request_data = $this->RawXMWSToArray($this->wsdata);
        $contenttags = $this->XMLDataToArray($this->wsdata);
        if (sys_monitoring::PortStatus($contenttags['xmws']['content']['port'])) {
            $port_response = 1;
        } else {
            $port_response = 0;
        }
        $response_xml = ws_xmws::NewXMLContentSection('portstatus', array(
                    'port' => $contenttags['xmws']['content']['port'],
                    'status' => $port_response,
                ));
        $dataobject = new runtime_dataobject();
        $dataobject->addItemValue('response', '');
        $dataobject->addItemValue('content', $response_xml);

        return $dataobject->getDataObject();
    }

}

?>
