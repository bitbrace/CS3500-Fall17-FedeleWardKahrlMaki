<?php

/* 
    This code was violently ripped from the clutches of a stack overflow patron by
    the name of 'Fred -ii-'. It was modified to better suit our needs (reworked some mappings). Their original work can be found here: https://stackoverflow.com/questions/18070154/get-operating-system-info. 
    Please pay them homage by referrencing their work when asked. It is essentially 
    a mapping of information from the HTTP_USER_AGENT to usesful text.
*/

$user_agent = $_SERVER['HTTP_USER_AGENT'];

function getOS() { 

    global $user_agent;
    $os_platform    =   "Other";
    $os_array       =   array(
                            '/windows nt 10/i'      =>  'Windows',
                            '/windows nt 6.3/i'     =>  'Windows',
                            '/windows nt 6.2/i'     =>  'Windows',
                            '/windows nt 6.1/i'     =>  'Windows',
                            '/windows nt 6.0/i'     =>  'Windows',
                            '/windows nt 5.2/i'     =>  'Windows',
                            '/windows nt 5.1/i'     =>  'Windows',
                            '/windows xp/i'         =>  'Windows',
                            '/windows nt 5.0/i'     =>  'Windows',
                            '/windows me/i'         =>  'Windows',
                            '/win98/i'              =>  'Windows',
                            '/win95/i'              =>  'Windows',
                            '/win16/i'              =>  'Windows',
                            '/macintosh|mac os x/i' =>  'Mac',
                            '/mac_powerpc/i'        =>  'Mac',
                            '/linux/i'              =>  'Linux',
                            '/ubuntu/i'             =>  'Ubuntu',
                            '/iphone/i'             =>  'Mobile',
                            '/ipod/i'               =>  'Mobile',
                            '/ipad/i'               =>  'Mobile',
                            '/android/i'            =>  'Mobile',
                            '/blackberry/i'         =>  'Mobile',
                            '/webos/i'              =>  'Mobile'
                        );

    foreach ($os_array as $regex => $value) { 

        if (preg_match($regex, $user_agent)) {
            $os_platform    =   $value;
        }
    }  
    return $os_platform;
}

function getBrowser() {

    global $user_agent;
    $browser        =   "Other";
    $browser_array  =   array(
                            '/msie/i'       =>  'Internet Explorer',
                            '/firefox/i'    =>  'Firefox',
                            '/safari/i'     =>  'Safari',
                            '/chrome/i'     =>  'Chrome',
                            '/edge/i'       =>  'Internet Explorer',
                            '/opera/i'      =>  'Opera',
                            '/netscape/i'   =>  'Other',
                            '/maxthon/i'    =>  'Other',
                            '/konqueror/i'  =>  'Other',
                            '/mobile/i'     =>  'Other'
                        );

    foreach ($browser_array as $regex => $value) { 
        if (preg_match($regex, $user_agent)) {
            $browser    =   $value;
        }
    }
    return $browser;
}

function getIPAddr() {

    $temp = $_SERVER['REMOTE_ADDR'];

    if ($temp == '::1'){
        $temp = 'Local Server';
    }

    return $temp;
}

?>