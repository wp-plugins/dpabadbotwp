<?php
/**
 * Plugin Name: dpaBadBotWP
 * Plugin URI: https://www.dpabadbot.com/dpabadbotwp-wordpress-plugin-for-dpabadbot.php
 * Description: dpaBadtBotWP is a plugin to be used with dpaBadBot Shield php program. The dpaBadBotWP plugin sends dpaBadBot your IP address automatically, so that you will not be blocked. You need to purchase dpaBadBot separately or download the 30 Day Trial version before using this plugin, dpaBadBotWP. dpaBatBot (not the plugin) can lock up WordPress so that no one can login - stops hackers from logging in and can track who are your visitors. By tracking visitors it blocks hackers, spiders, crawlers, scrappers, all of whom overload your server and hack your site. You can manually block by IP address and by spider or bad bot name.
 * Version: 1.05
 * Author: Dr. Peter Achutha
 * Author URI: https://www.facebook.com/peter.achutha
 * License: 
 */

 
defined('ABSPATH') or die("No script kiddies please!");

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

add_options_page("dpaBadBotWP", "DpaBadBotWPMenu", 'administrator', "dpaBadBotWP_Menu", "spmy_dpabadbot_addform"); 

}
 
 

function spmy_dpabadbot_read_file( $f ){
$tmpstr = '';
if( file_exists( $f ) ){
	$fh = fopen( $f, 'r');
	$tmpstr = fread( $fh, filesize( $f ) );
	fclose( $fh );
	} else {
//	echo '<br>File Does Not Exists: '.$f.'<br> ';
	}
return( $tmpstr );
}

function spmy_dpabadbot_write_file( $f, $d ){
$fh = fopen( $f, 'w' );
fwrite( $fh, $d, strlen( $d ) );
fflush( $fh );
fclose( $fh );
}



//$spmy_dpabadbot_setup_file = $installbase.'wp-content/plugins/dpabadbotwp/setup.txt';
$spmy_dpabadbot_setup_file = dirname(__FILE__) .'/setup.txt';
$spmy_dpabadbot_setup_tmp = spmy_dpabadbot_read_file( $spmy_dpabadbot_setup_file );
$spmy_dpabadbot_setup_data = unserialize( $spmy_dpabadbot_setup_tmp );
$spmy_dpabadbot_setup_sz = count( $spmy_dpabadbot_setup_data );
if( strlen( $spmy_dpabadbot_setup_tmp ) > 2 && $spmy_dpabadbot_setup_sz > 0 ){
	$spmy_dpabadbot_path = $spmy_dpabadbot_setup_data;
//	echo '<br>set up file has data';
}


//check dpabadbot files exists
$spmy_dpabadbot_datadir = $spmy_dpabadbot_path.'data/';
$spmy_dpabadbot_ip_file = $spmy_dpabadbot_path.'data/wpipadd.txt';


//function spmy_dpabadbot_logout(){
//$spmy_dpabadbot_setup_file = dirname(__FILE__) .'/setup.txt';
//$spmy_dpabadbot_setup_tmp = spmy_dpabadbot_read_file( $spmy_dpabadbot_setup_file );
//$spmy_dpabadbot_setup_data = unserialize( $spmy_dpabadbot_setup_tmp );
//$spmy_dpabadbot_setup_sz = count( $spmy_dpabadbot_setup_data );
//if( strlen( $spmy_dpabadbot_setup_tmp ) > 2 && $spmy_dpabadbot_setup_sz > 0 ){
//	$spmy_dpabadbot_path = $spmy_dpabadbot_setup_data;
////	echo '<br>set up file has data';
//}


//check dpabadbot files exists
$spmy_dpabadbot_datadir = $spmy_dpabadbot_path.'data/';
$spmy_dpabadbot_ip_file = $spmy_dpabadbot_path.'data/wpipadd.txt';

//if( file_exists( $spmy_dpabadbot_ip_file )) {
//	unlink( $spmy_dpabadbot_ip_file );
//	}
////exit;
//}

//if( function_exists( 'spmy_dpabadbot_logout')) {
//		add_action('wp_logout', 'spmy_dpabadbot_logout');
//}		
		
		
if ( is_admin() ){

	if( function_exists( 'spmy_dpabadbot_actions')) {
		add_action('admin_menu', 'spmy_dpabadbot_actions');	
		
	if( file_exists( $spmy_dpabadbot_datadir ) ){
		if( file_exists( $spmy_dpabadbot_ip_file ) ){ 
			$spmy_dpabadbot_ip_tmp = spmy_dpabadbot_read_file( $spmy_dpabadbot_ip_file );
			if( strlen( $spmy_dpabadbot_ip_tmp ) > 2 ){
				$spmy_dpabadbot_ip_addrs = unserialize( $spmy_dpabadbot_ip_tmp );
				}
			}
	$spmy_dpabadbot_ip = spmy_dpabadbot_get_client_ip();
	$spmy_dpabadbot_ip_addrs[$spmy_dpabadbot_ip] = $spmy_dpabadbot_ip;
	spmy_dpabadbot_write_file( $spmy_dpabadbot_ip_file, serialize( $spmy_dpabadbot_ip_addrs) );
	}
	}
	
}



