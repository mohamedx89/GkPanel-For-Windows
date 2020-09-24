<?php

/**
 * @copyright 2014-2015 GKPanel Project (http://www.cybercore.tv/) 
 * GKPanel is a GPL fork of the XPanel Project whose original header follows:
 *
 * Gatekeeper - A module for XPanelX to enable easy viewing and updating of the XMWS server key.
 * Developed by HuyGK (bobbyallen.uk@gmail.com) 
 */
class module_controller {

    /**
     * @var type 
     */
    static $updated = false;

    /**
     * Generate a new API key and add it to the database. 
     */
    static function doGenerate() {
        $new_random_key = sha1(rand() . ctrl_options::GetOption('server_ip'));
        ctrl_options::SetSystemOption('apikey', $new_random_key);
        self::$updated = true;
        return true;
    }

    static function getCurrentAPIKey() {
        return ctrl_options::GetOption('apikey');
    }

    static function getResult() {
        if (self::$updated) {
            return ui_sysmessage::shout(ui_language::translate("Your new XMWS API key has been generated and saved!"), "zannounceok");
        }
    }

    static function getModuleDesc() {
        $module_desc = ui_language::translate(ui_module::GetModuleDescription());
        return $module_desc;
    }

    static function getModuleName() {
        $module_name = ui_module::GetModuleName();
        return $module_name;
    }

    static function getModuleIcon() {
        global $controller;
        $module_icon = "./modules/" . $controller->GetControllerRequest('URL', 'module') . "/assets/icon.png";
        return $module_icon;
    }
}

?>