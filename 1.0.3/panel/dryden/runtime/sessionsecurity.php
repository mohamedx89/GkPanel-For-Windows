<?php
/* THIS CLASS IS STILL IN DEVELOPMENT AND IS UNTESTED WILL BE FININISHED OFF BY THE 15TH DECEMBER 2012*/


/**
 * Session security class.
 * @package XPanelx
 * @subpackage dryden -> runtime
 * @version 1.0.2
 * @author HuyGK (huygk@cybercore.tv)
 * @copyright GKPanel Project (http://www.cybercore.tv/)
 * @link http://www.cybercore.tv/
 * @license GPL (http://www.gnu.org/licenses/gpl.html)
 */
class runtime_sessionsecurity {
    
    // on login 
        //set 
            //ip session
            //user agent session 
            //cookie salt
            //zUser session
   
    /*****The below are generic function used more than once*****/
    /**
     * Regenerate the PHPSID  
     * @author HuyGK (huygk@cybercore.tv)
     * @return boolean.
     */
    public function sessionRegen(){
         if(session_regenerate_id()){
             return true;
         }else{
             return false;
         }
    }
    
    /**
     * Get users ip address 
     * @author HuyGK (huygk@cybercore.tv)
     * @return string The Clean IP.
     */
    public function findIP() {
        $ip = $_SERVER["REMOTE_ADDR"];
        return $ip;
    }
    /**
     * Get users details that are spefic for the individual user only
     * @author HuyGK (huygk@cybercore.tv)
     * @return string The data.
     */
    public function userSpeficData(){
        $ip = $_SESSION['ip'];
        $username = $_SESSION['zUser'];
        $userSalt = $_COOKIE['zUserSalt'];
        return $ip.$username.$userSalt;
    }
    
    
    /*****Here we are are gathering infomration and storing securty*****/
    /**
     * This function will set the users agent in a secure session and hashes
     * @author HuyGK (huygk@cybercore.tv)
     * @return boolean.
     */
    public function setUserAgent(){
        
        if($_SESSION['HTTP_USER_AGENT'] = sha1($_SERVER['HTTP_USER_AGENT'],$this->userSpeficData())){
            return true;
        }else{
            return false;
        }
    }
    
    /**
     * This function will set the users IP in a secure session and hashes
     * @author HuyGK (huygk@cybercore.tv)
     * @return boolean.
     */
    public function setUserIP(){
        
        if($_SESSION['ip'] = sha1($this->findIP(), $this->userSpeficData())){
            return true;
        }else{
            return false;
        }
    }
    
    /*****The below is returning the secure information*****/
    /**
     * This will return the secure session set version of the users agent
     * @author HuyGK (huygk@cybercore.tv)
     * @return string The data.
     */
    public function getSetUserAgent(){
        return $_SESSION['HTTP_USER_AGENT'];
    }
    
    /**
     * This will return the secure session set version of the users ip
     * @author HuyGK (huygk@cybercore.tv)
     * @return string The data.
     */
    public function getSetIP(){
        return $_SESSION['ip'];
    }
    
    
    /*****The below is retrieveing the current provided information*****/
    /**
     * This returns the current provied users agent via headers and THEN hashes
     * @author HuyGK (huygk@cybercore.tv)
     * @return string The data.
     */
    public function getProviedUserAgent(){
        return sha1($_SERVER['HTTP_USER_AGENT'], $this->userSpeficData());
    }
    
    /**
     * This returns the current provied users IP and THEN hashes
     * @author HuyGK (huygk@cybercore.tv)
     * @return string The data.
     */
    public function getProviedIP(){
        return sha1($this->findIP(), $this->userSpeficData());
    }
    
    
    
    /*****Below are function that check information and try to identy any tampering*****/
    /**
     * This checks wether the set user agent for the session is the same one as what is currently being provied
     * @author HuyGK (huygk@cybercore.tv)
     * @return boolean.
     */
    public function checkAgent(){
        $userSetAgent = $this->getSetUserAgent();
        $currentUserAgent = $this->getProviedUserAgent();
        
        if($userSetAgent == $currentUserAgent){
            return true;
        }else{
            return false;
        }
    }
    
    /**
     * This checks wether the set user ip for the session is the same one as what is currently being provied
     * @author HuyGK (huygk@cybercore.tv)
     * @return boolean.
     */
    public function checkIP(){
        $userSetIP = $this->getSetIP();
        $currentUserIP = $this->getProviedIP();
        
        if($userSetIP == $currentUserIP){
            return true;
        }else{
            return false;
        }
    }
    
    /**
     * This checks wheather the user is behind a proxy
     * @author HuyGK (huygk@cybercore.tv)
     * @return boolean
     */
    public function checkProxy(){
        if ($_SERVER['HTTP_X_FORWARDED_FOR']|| $_SERVER['HTTP_X_FORWARDED']|| $_SERVER['HTTP_FORWARDED_FOR']|| $_SERVER['HTTP_CLIENT_IP']|| $_SERVER['HTTP_VIA']|| in_array($_SERVER['REMOTE_PORT'], array(8080,80,6588,8000,3128,553,554))|| @fsockopen($_SERVER['REMOTE_ADDR'], 80, $errno, $errstr, 30)){
              return true;
        }else{
            return false;
        }
    }
    
    /*****Below is the heart of the class*****/
    /**
     * This checks wheather the session has been stolen or not
     * @author HuyGK (huygk@cybercore.tv)
     * @return boolean
     */
    public function antiSessionHijacking(){
        $checkIP = $this->checkIP();
        $checkUserAgent = $this->checkAgent();
        if(($checkIP == true) && ($checkUserAgent == true)){
            //Regenerate session id... The more it changes the less likly to get hacked!
            $this->sessionRegen();
            return true;
        }else{
            if(($this->checkProxy() == true) && ($checkUserAgent == false) && (isset($_COOKIE['zUserSalt']))){
                //proxies can cause fluxuations in the user agent header 
                return true;
            }else{
                $_SESSION['zpuid'] = null;
                unset($_COOKIE['zUserSalt']);
                session_destroy();
                return false;
            }
        }
    }
}
?>
