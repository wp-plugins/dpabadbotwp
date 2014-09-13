<?php
/**
 * Plugin Name: dpaBadBotWP
 * Plugin URI: https://www.dpabadbot.com/dpabadbotwp-wordpress-plugin-for-dpabadbot.php
 * Description: dpaBadtBotWP is a plugin to be used with dpaBadBot Shield php program. The dpaBadBotWP plugin sends dpaBadBot your IP address automatically, so that you will not be blocked. You need to purchase dpaBadBot separately or download the 30 Day Trial version before using this plugin dpaBadBotWP. dpaBatBot (not the plugin) can lock up WordPress so that no one can login - stops hackers from logging in and can track who are your visitors. By tracking visitors it blocks hackers, spiders, crawlers, scrappers, all of whom overload your server and hack your site. You can manually block by IP address and by spider name.
 * Version: 1.03
 * Author: Dr. Peter Achutha
 * Author URI: https://www.facebook.com/peter.achutha
 * License: 
 */


defined('ABSPATH') or die("No script kiddies please!");
include('spmy_dpabadbot_includes.php');
include('spmyfunctions.php');


//$ppmy_http = $_SERVER['HTTPS'] == 'on' ? 'https' : 'http'; // get the http(s) file path base
if(!empty($_SERVER["HTTPS"])){
  if($_SERVER["HTTPS"]!=="off") {
    $ppmy_http = 'https'; //https
  } else {
    $ppmy_http = 'http'; //http
	}
} else {
  $ppmy_http = 'http'; //http
  }
$ppmy_filename_is =  $ppmy_http .'://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
//get rid of the url parameters after ?
$ppmy_tmpfn = explode( '?', $ppmy_filename_is );
$ppmy_filesz = count( $ppmy_tmpfn );
$ppmy_filename_is = $ppmy_tmpfn[0] ;
//get rid of file name
$ppmy_tmpfn = explode( '/', $ppmy_filename_is );
$ppmy_filesz = count( $ppmy_tmpfn );
$ppmy_tmpfn[$ppmy_filesz - 1] = '';
$ppmy_filebase = implode( '/', $ppmy_tmpfn );
$ppmy_filesz = strlen( $ppmy_filebase );
if( $ppmy_filebase[ $ppmy_filesz - 1] != '/' ){
$ppmy_filebase = $ppmy_filebase.'/'; 
}

$installbase = $_SERVER['SCRIPT_FILENAME']; // get the installation directory path
//get rid of the url parameters after ?
$ppmy_tmpfn = explode( '?', $installbase );
$ppmy_filesz = count( $ppmy_tmpfn );
$installbase = $ppmy_tmpfn[0] ;
//get rid of file name
$ppmy_tmpfn = explode( '/', $installbase );
$ppmy_filesz = count( $ppmy_tmpfn );
$ppmy_tmpfn[$ppmy_filesz - 1] = '';
$installbase = implode( '/', $ppmy_tmpfn );
$ppmy_filesz = strlen( $installbase );
if( $installbase[ $ppmy_filesz - 1] != '/' ){
$installbase = $installbase.'/'; 
}
$t = explode( '/', $ppmy_filebase );
$tsz = count( $t );
unset( $t[ $tsz - 1] );
unset( $t[ $tsz - 2] );
$tsz = count( $t );
if( $t[ $tsz - 1] != '/' ){
$t[ $tsz - 1] = $t[ $tsz - 1].'/'; 
}
$ppmy_filebase = implode( '/', $t );

$t = explode( '/', $installbase );
$tsz = count( $t );
unset( $t[ $tsz - 1] );
unset( $t[ $tsz - 2] );
$tsz = count( $t );
if( $t[ $tsz - 1] != '/' ){
$t[ $tsz - 1] = $t[ $tsz - 1].'/'; 
}
$installbase = implode( '/', $t );

$spmy_dpabadbot_setup_file = $installbase.'wp-content/plugins/dpabadbotwp/setup.txt';
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