<?php

// Function to get the client ip address
function spmy_dpabadbot_get_client_ip() {
    $ipaddress = '';
    if ($_SERVER['HTTP_CLIENT_IP'])
        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
    else if($_SERVER['HTTP_X_FORWARDED_FOR'])
        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
    else if($_SERVER['HTTP_X_FORWARDED'])
        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
    else if($_SERVER['HTTP_FORWARDED_FOR'])
        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
    else if($_SERVER['HTTP_FORWARDED'])
        $ipaddress = $_SERVER['HTTP_FORWARDED'];
    else if($_SERVER['REMOTE_ADDR'])
        $ipaddress = $_SERVER['REMOTE_ADDR'];
    else
        $ipaddress = 'UNKNOWN';
 
    return $ipaddress;
}



function spmy_dpabadbot_addform(){
include('spmy_dpabadbot_form.php');
}


function spmy_dpabadbot_actions() {
 
//$spmy_dpabadbot_ip = spmy_dpabadbot_get_client_ip();

add_options_page("dpaBadBot", "DpaBadBotMenu", 'administrator', "dpaBadBot_Menu", "spmy_dpabadbot_addform"); 

}
 
 
