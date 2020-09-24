<?php

/**
 * @copyright 2014-2015 GKPanel Project (http://www.cybercore.tv/) 
 * GKPanel is a GPL fork of the XPanel Project whose original header follows:
 *
 *
 * GKPanel - System Files Module, by HuyGK: www.cybercore.tv.
 *
 */
 
class module_controller {

    static function getDescription() {
			return ui_module::GetModuleDescription();
    }

	static function getModuleName() {
		$module_name = ui_module::GetModuleName();
        return $module_name;
    }

	static function getModuleIcon() {
		global $controller;
		$module_icon = "/modules/" . $controller->GetControllerRequest('URL', 'module') . "/assets/icon.png";
        return $module_icon;
    }
	static function getArrowUp() {
		global $controller;
		$arrow_up = "/modules/" . $controller->GetControllerRequest('URL', 'module') . "/assets/au.png";
        return $arrow_up;
    }
	static function getArrowDn() {
		global $controller;
		$arrow_dn = "/modules/" . $controller->GetControllerRequest('URL', 'module') . "/assets/ad.png";
        return $arrow_dn;
    }	
	
    static function getPhpini() {
        global $controller;
        $file = "C:\GKPanel\bin\php\php.ini";
        $Phpini = fs_filehandler::ReadFileContents($file); 
        return $Phpini;
    }
	static function getHttpd() {
        global $controller;
        $file = "C:\GKPanel\bin\apache\conf\httpd.conf";
        $Httpd = fs_filehandler::ReadFileContents($file); 
        return $Httpd;
    }
  	static function getVhost() {
        global $controller;
        $file = "C:\GKPanel\configs\apache\httpd-vhosts.conf";
        $Vhost = fs_filehandler::ReadFileContents($file); 
        return $Vhost;
    }
  
   
    static $statusDataWrite;
    static $functionRan;
    static $messageType;


    static function doPhpiniPost() {
        global $controller;
	    $data = $controller->GetControllerRequest('FORM', 'data');
        if(self::ExcutePhpiniPost($data)){
        return;
        }else{
        return;
        }
    }
    static function ExcutePhpiniPost($data){
        global $controller;
	    $file = "C:\GKPanel\bin\php\php.ini";
	    if(fs_filehandler::UpdateFile($file,0777,$data))
		{
        self::$statusDataWrite = "File updated";
        self::$functionRan= 1;
        self::$messageType= 'zannounceok';
        return true;
        }else{
        self::$statusDataWrite = "Faile d to update file";
        self::$functionRan= 1;
        self::$messageType = 'zannounceerror';
        return false;
        }
    }
	static function doHttpdPost() {
        global $controller;
	    $data = $controller->GetControllerRequest('FORM', 'data');
        if(self::ExcuteHttpdPost($data)){
        return;
        }else{
        return;
        }
    }
    static function ExcuteHttpdPost($data){
        global $controller;
	    $file = "C:\GKPanel\bin\apache\conf\httpd.conf";
	    if(fs_filehandler::UpdateFile($file,0777,$data))
		{
        self::$statusDataWrite = "File updated";
        self::$functionRan= 1;
        self::$messageType= 'zannounceok';
        return true;
        }else{
        self::$statusDataWrite = "Faile d to update file";
        self::$functionRan= 1;
        self::$messageType = 'zannounceerror';
        return false;
        }
    }	
    static function doVhostPost() {
        global $controller;
	    $data = $controller->GetControllerRequest('FORM', 'data');
        if(self::ExcuteVhostPost($data)){
        return;
        }else{
        return;
        }
    }
    static function ExcuteVhostPost($data){
        global $controller;
	    $file = "C:\GKPanel\configs\apache\httpd-vhosts.conf";
	    if(fs_filehandler::UpdateFile($file,0777,$data))
		{
        self::$statusDataWrite = "File updated";
        self::$functionRan= 1;
        self::$messageType= 'zannounceok';
        return true;
        }else{
        self::$statusDataWrite = "Faile d to update file";
        self::$functionRan= 1;
        self::$messageType = 'zannounceerror';
        return false;
        }
    }
    static function getResult() {
        if(self::$functionRan == 1){
        return ui_sysmessage::shout(ui_language::translate(self:: $statusDataWrite), self::$messageType);
        }
        return;
    }  
 
}
?>