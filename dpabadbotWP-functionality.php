<?php
/**
 * Plugin Name: dpaBadBotWP
 * Plugin URI: https://www.dpabadbot.com/wordpress-plugins/dpabadbotwp-helper-for-dpabadbot.php
 * Description: dpaBadtBotWP is a plugin to be used with The Bad Bot Exterminator, dpaBadBot, firewall shield php program. The dpaBadBotWP plugin sends dpaBadBot your IP address automatically, so that you will not be blocked. You need to purchase dpaBadBot separately before using this plugin, dpaBadBotWP. dpaBatBot (not the plugin) can lock up WordPress so that no one can login - stops hackers from logging in and can track who are your visitors. By tracking visitors it blocks hackers, spiders, crawlers, scrappers, all of whom overload your server and hack your site. You can manually block by IP address and by spider or bad bot name. Add multiuser tracking of IP addresses. And for safety sake, this plugin stops WordPress automatic core updates. Had problems with the upper and lower case file names. Please delete older versions before uploading this version.
 * Version: 1.15 [20150623]
 * Author: Dr. Peter Achutha
 * Author URI: https://www.facebook.com/peter.achutha
 * License: 
 */

 
defined('ABSPATH') or die("No script kiddies please!");

// Function to get the client ip address
function spmy_dpabadbot_get_client_ip() {
    $ipaddress = '';
    $ipaddress = getenv('REMOTE_ADDR');
	if( $ipaddress == '' ){	
		$ipaddress = getenv('HTTP_CLIENT_IP');
		if( $ipaddress == '' ){	
			$ipaddress = getenv('HTTP_FORWARDED_FOR');
			if( $ipaddress == '' ){	
				$ipaddress = getenv('HTTP_FORWARDED');
				if( $ipaddress == '' ){	
				$ipaddress = getenv('HTTP_X_FORWARDED');
				if( $ipaddress == '' ){	
					$ipaddress = getenv('HTTP_X_FORWARDED_FOR');
					}
					else { 
						$ipaddress = 'UNKNOWN';
						}
				}
			}
		}
	}
 return( trim( $ipaddress ) );
}



function spmy_dpabadbot_addform(){
include('spmy_dpabadbot_form.php');
}


function spmy_dpabadbot_actions() {
 
//$spmywp_dpabadbot_ip = spmy_dpabadbot_get_client_ip();

add_options_page("dpaBadBotWP", "DpaBadBotWPMenu", 'administrator', "dpaBadBotWP_Menu", "spmy_dpabadbot_addform"); 

}
 
function spmy_dpabadbot_post_numbers(){
clearstatcache();
$spmywp_dpaphpcache_post_count = wp_count_posts();
foreach ($spmywp_dpaphpcache_post_count as $key => $value) {
	$spmywp_dpaphpcache_post_nos[$key] = $value ;
	}	
unset( $spmywp_dpaphpcache_post_count ); //clear memory
//echo 'Total posts: '.$iz.' '; 
$spmywp_datadir = dirname(__FILE__) ;
$wppathstr = dirname(__FILE__) ; //initialise data so that it will not give trouble later
$spmywp_string_position = strripos( $spmywp_datadir , 'dpabadbotwp');
$spmywp_datadiralt = substr_replace( $spmywp_datadir , 'dpabadbotwpdata' , $spmywp_string_position  );

$spmywp_dpabadbot_setup_file = $spmywp_datadiralt .'/setup.txt';
//$wppathstr = str_replace( 'wp-content/plugins/dpabadbotwp/setup.txt', '', $spmywp_dpabadbot_setup_file);
$spmywp_strpos = strripos( $spmywp_datadir, 'wp-content' );
if( $spmywp_strpos !== false ){
	$wppathstr = substr( $spmywp_datadir, 0, $spmywp_strpos  );
	}
//echo '<br>functionality $wppathstr: '.$wppathstr.'  ';
$spmywp_dpabadbot_setup_tmp = spmy_dpabadbot_read_file( $spmywp_dpabadbot_setup_file );
$spmywp_dpabadbot_setup_data = unserialize( $spmywp_dpabadbot_setup_tmp );
$spmywp_dpabadbot_setup_sz = count( $spmywp_dpabadbot_setup_data );

if( strlen( $spmywp_dpabadbot_setup_tmp ) > 2 && $spmywp_dpabadbot_setup_sz > 0 ){
	if( $spmywp_dpabadbot_setup_data[0] != '' ){
		$spmywp_dpabadbot_path = $spmywp_dpabadbot_setup_data[0];
		//$spmywp_dpabadbot_GMThours = $spmywp_dpabadbot_setup_data[1]/3600;
		//check dpabadbot files exists
		//$spmywp_dpabadbot_datadir = $spmywp_dpabadbot_path.'data/';
		//$spmywp_dpabadbot_ip_file = $spmywp_dpabadbot_path.'data/wpipadd.txt';
		$spmywp_dpabadbot_posts_file = $spmywp_dpabadbot_path.'config/wpposts.txt';
		//echo '<br>1. filename to open: '.$spmywp_dpabadbot_posts_file.'  ' ;
		spmy_dpabadbot_write_file( $spmywp_dpabadbot_posts_file, serialize( $spmywp_dpaphpcache_post_nos['publish'] ) );
		}
	}

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

function spmy_dpabadbot_append_file( $f, $d ){
$fh = fopen( $f, 'a' );
fwrite( $fh, $d, strlen( $d ) );
fflush( $fh );
fclose( $fh );
}

$spmywp_datadirp = dirname(__FILE__) ;
$spmywp_string_positionp = strripos( $spmywp_datadirp , 'wp-content');
$spmywp_datadiraltp = substr_replace( $spmywp_datadirp , 'wp-includes' , $spmywp_string_positionp  );
$spmywp_dpabadbot_pluggable_file = $spmywp_datadiraltp .'/pluggable.php';
$spmywp_dpabadbot_pluggable_fileup = $spmywp_datadiraltp .'/update.php';
//echo '<br>$spmywp_dpabadbot_pluggable_file: '.$spmywp_dpabadbot_pluggable_file.'  ';
include_once( $spmywp_dpabadbot_pluggable_fileup ); //include this one first as it is called in pluggable.php
include_once( $spmywp_dpabadbot_pluggable_file );




//$spmywp_dpabadbot_setup_file = $installbase.'wp-content/plugins/dpabadbotwp/setup.txt';

$spmywp_datadir = dirname(__FILE__) ;
$wppathstr = dirname(__FILE__) ; //initialise data so that it will not give trouble later
$spmywp_string_position = strripos( $spmywp_datadir , 'dpabadbotwp');
$spmywp_datadiralt = substr_replace( $spmywp_datadir , 'dpabadbotwpdata' , $spmywp_string_position  );
$spmywp_dpabadbot_setup_file = $spmywp_datadiralt .'/setup.txt';
$spmywp_dpabadbot_monitor_file = $spmywp_datadiralt .'/monitor.txt';


//echo ' <br>2. setup file : '.$spmywp_dpabadbot_setup_file.'  ' ;
$spmywp_dpabadbot_setup_tmp = spmy_dpabadbot_read_file( $spmywp_dpabadbot_setup_file );
$spmywp_dpabadbot_setup_data = unserialize( $spmywp_dpabadbot_setup_tmp );
//echo '<br>3. [0] : '.$spmywp_dpabadbot_setup_data[0].'  & [1] : '.$spmywp_dpabadbot_setup_data[1].'  ';
$spmywp_dpabadbot_setup_sz = count( $spmywp_dpabadbot_setup_data );
if( strlen( $spmywp_dpabadbot_setup_tmp ) > 2 && $spmywp_dpabadbot_setup_sz > 0 ){
	$spmywp_dpabadbot_path = $spmywp_dpabadbot_setup_data[0];
	//echo '<br>set up file has data';
} else {
$spmywp_dpabadbot_path = $spmywp_datadiralt; //wrong path but atleast it is set to a value
}


//check dpabadbot files exists
$spmywp_dpabadbot_datadir = $spmywp_dpabadbot_path.'data/';
$spmywp_dpabadbot_ip_file = $spmywp_dpabadbot_path.'data/wpipadd.txt';


//declare the function
if( !function_exists( 'spmy_dpabadbot_deleteipadd' )){
function spmy_dpabadbot_deleteipadd(){

$spmywp_datadir = dirname(__FILE__) ;
$spmywp_string_position = strripos( $spmywp_datadir , 'dpabadbotwp');
$spmywp_datadiralt = substr_replace( $spmywp_datadir , 'dpabadbotwpdata' , $spmywp_string_position  );

$spmywp_dpabadbot_setup_file = $spmywp_datadiralt .'/setup.txt';
$spmywp_dpabadbot_setup_tmp = spmy_dpabadbot_read_file( $spmywp_dpabadbot_setup_file );
$spmywp_dpabadbot_setup_data = unserialize( $spmywp_dpabadbot_setup_tmp );
$spmywp_dpabadbot_setup_sz = count( $spmywp_dpabadbot_setup_data );

if( strlen( $spmywp_dpabadbot_setup_tmp ) > 2 && $spmywp_dpabadbot_setup_sz > 0 ){
	$spmywp_dpabadbot_path = $spmywp_dpabadbot_setup_data[0];
	//check dpabadbot files exists
	$spmywp_dpabadbot_datadir = $spmywp_dpabadbot_path.'data/';
	$spmywp_dpabadbot_ip_file = $spmywp_dpabadbot_path.'data/wpipadd.txt';
	if( file_exists( $spmywp_dpabadbot_datadir ) ){
		if( file_exists( $spmywp_dpabadbot_ip_file ) ){ 
			$spmywp_dpabadbot_ip_tmp = spmy_dpabadbot_read_file( $spmywp_dpabadbot_ip_file ) ;
			if( strlen( $spmywp_dpabadbot_ip_tmp ) > 6 ){//find all ip addresses older than 2 days and delete
			$spmywp_dpabadbot_ip_addrs = unserialize( $spmywp_dpabadbot_ip_tmp );
			$spmywp_dpabadbot_ip_time = (time()- 86400) ;
			foreach( $spmywp_dpabadbot_ip_addrs as $mykey => $myvalue){
				if( $spmywp_dpabadbot_ip_addrs[$mykey][1] < $spmywp_dpabadbot_ip_time ){
					unset( $spmywp_dpabadbot_ip_addrs[$mykey] );
					}	
				}
			spmy_dpabadbot_write_file( $spmywp_dpabadbot_ip_file, serialize( $spmywp_dpabadbot_ip_addrs) );	
			}
	
			$spmywp_dpabadbot_ip = spmy_dpabadbot_get_client_ip();	//get ip address
			$spmywp_dpabadbot_ip_tmp = spmy_dpabadbot_read_file( $spmywp_dpabadbot_ip_file );
			if( strlen( $spmywp_dpabadbot_ip_tmp ) > 6 ){
				$spmywp_dpabadbot_ip_addrs = unserialize( $spmywp_dpabadbot_ip_tmp );
				}
				if( !isset( $spmywp_dpabadbot_ip_addrs[$spmywp_dpabadbot_ip] ) ){
				$spmywp_dpabadbot_ip_addrs[$spmywp_dpabadbot_ip][0] = $spmywp_dpabadbot_ip ;
				$spmywp_dpabadbot_ip_addrs[$spmywp_dpabadbot_ip][1] = time() ;				
				spmy_dpabadbot_write_file( $spmywp_dpabadbot_ip_file, serialize( $spmywp_dpabadbot_ip_addrs) );
				}
				
			}

		}
	}
}
}

//	$spmywp_dpabadbot_ip = spmy_dpabadbot_get_client_ip();
//	$spmywp_dpabadbot_tempstr = $spmywp_dpabadbot_ip.', ';
//	$spmywp_dpabadbot_temptime = time();
//	$spmywp_dpabadbot_tempstr = $spmywp_dpabadbot_tempstr.$spmywp_dpabadbot_temptime.', ';
//	$spmywp_dpabadbot_tempstr = $spmywp_dpabadbot_tempstr.date("Y M j D H:i:s", $spmywp_dpabadbot_temptime).', ';
//	$spmywp_dpabadbot_tempstr = $spmywp_dpabadbot_tempstr.getenv('REQUEST_URI').', ';
//	$spmywp_dpabadbot_tempstru = trim( getenv('HTTP_USER_AGENT') );
//	if( $spmywp_dpabadbot_tempstru == '' ){
//	$spmywp_dpabadbot_tempstru = 'BLANK' ;
//	}
//	$spmywp_dpabadbot_tempstr = $spmywp_dpabadbot_tempstr.$spmywp_dpabadbot_tempstru.', ';
//	$spmywp_dpabadbot_tempstre = trim( getenv('HTTP_REFERER'));
//	if( $spmywp_dpabadbot_tempstre == '' ){
//	$spmywp_dpabadbot_tempstre = 'BLANK' ;
//	}
//	$spmywp_dpabadbot_tempstr = $spmywp_dpabadbot_tempstr.$spmywp_dpabadbot_tempstre."\n";	
//	spmy_dpabadbot_append_file( $spmywp_dpabadbot_monitor_file, $spmywp_dpabadbot_tempstr );
		
if ( is_admin() ){

	if( function_exists( 'spmy_dpabadbot_actions')) {
		add_action('admin_menu', 'spmy_dpabadbot_actions');	
		add_action( 'save_post', 'spmy_dpabadbot_post_numbers' );	//update & preview = /../../autosave
		add_action( 'post_updated', 'spmy_dpabadbot_post_numbers' ); //preview changes	& update posts	
		add_action( 'edit_post', 'spmy_dpabadbot_post_numbers' );	//preview changes
		add_action( 'publish_post', 'spmy_dpabadbot_post_numbers' );	//update post
	if( file_exists( $spmywp_dpabadbot_datadir ) ){
		if( file_exists( $spmywp_dpabadbot_ip_file ) ){ 
			$spmywp_dpabadbot_ip_tmp = spmy_dpabadbot_read_file( $spmywp_dpabadbot_ip_file );
			if( strlen( $spmywp_dpabadbot_ip_tmp ) > 2 ){
				$spmywp_dpabadbot_ip_addrs = unserialize( $spmywp_dpabadbot_ip_tmp );
				}
			}
	$spmywp_dpabadbot_ip = spmy_dpabadbot_get_client_ip();
//	$spmywp_dpabadbot_tempstr = $spmywp_dpabadbot_ip.', ';
//	$spmywp_dpabadbot_temptime = time();
//	$spmywp_dpabadbot_tempstr = $spmywp_dpabadbot_tempstr.$spmywp_dpabadbot_temptime.', ';
//	$spmywp_dpabadbot_tempstr = $spmywp_dpabadbot_tempstr.date("Y M j D H:i:s", $spmywp_dpabadbot_temptime).', ';
//	$spmywp_dpabadbot_tempstr = $spmywp_dpabadbot_tempstr.getenv('REQUEST_URI').', ';
//	$spmywp_dpabadbot_tempstr = $spmywp_dpabadbot_tempstr.getenv('HTTP_USER_AGENT').', ';
//	$spmywp_dpabadbot_tempstr = $spmywp_dpabadbot_tempstr.getenv('HTTP_REFERER')."\n";	
//	spmy_dpabadbot_append_file( $spmywp_dpabadbot_monitor_file, $spmywp_dpabadbot_tempstr );
	if( is_user_logged_in() ){ //check if user is logged in otherwise everyone who access wp-admin.php will be recorded - 20150409-1145
		if( !isset( $spmywp_dpabadbot_ip_addrs[$spmywp_dpabadbot_ip])) {
			$spmywp_dpabadbot_ip_addrs[$spmywp_dpabadbot_ip][0] = $spmywp_dpabadbot_ip;
			$spmywp_dpabadbot_ip_addrs[$spmywp_dpabadbot_ip][1] = time();
			spmy_dpabadbot_write_file( $spmywp_dpabadbot_ip_file, serialize( $spmywp_dpabadbot_ip_addrs) );
			}
	}
	}
	}
//	if( function_exists( 'spmy_dpabadbot_deleteipadd')) {
//		echo '<br><span style="color:red;font-size:24px;">function delete ip add action to logout</span>';
//		add_action('wp_logout', 'spmy_dpabadbot_deleteipadd', 5); //this aaction does not work
//		}
	if( function_exists( 'spmy_dpabadbot_deleteipadd')) {
		spmy_dpabadbot_deleteipadd();
		}
}

add_filter( 'auto_update_core', '__return_false' );
	
//	if ( is_admin() ){

//	}	
?>