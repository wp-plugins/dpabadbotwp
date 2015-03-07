<?php
/**
 * Plugin Name: dpaBadBotWP
 * Plugin URI: https://www.dpabadbot.com/wordpress-plugins/dpabadbotwp-helper-for-dpabadbot.php
 * Description: dpaBadtBotWP is a plugin to be used with The Bad Bot Exterminator, dpaBadBot, firewall shield php program. The dpaBadBotWP plugin sends dpaBadBot your IP address automatically, so that you will not be blocked. You need to purchase dpaBadBot separately before using this plugin, dpaBadBotWP. dpaBatBot (not the plugin) can lock up WordPress so that no one can login - stops hackers from logging in and can track who are your visitors. By tracking visitors it blocks hackers, spiders, crawlers, scrappers, all of whom overload your server and hack your site. You can manually block by IP address and by spider or bad bot name. Add multiuser tracking of IP addresses. And for safety sake, this plugin stops WordPress automatic core updates.
 * Version: 1.12 [20150306]
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
 
//$spmy_dpabadbot_ip = spmy_dpabadbot_get_client_ip();

add_options_page("dpaBadBotWP", "DpaBadBotWPMenu", 'administrator', "dpaBadBotWP_Menu", "spmy_dpabadbot_addform"); 

}
 
function spmy_dpabadbot_post_numbers(){
clearstatcache();
$spmy_dpaphpcache_post_count = wp_count_posts();
foreach ($spmy_dpaphpcache_post_count as $key => $value) {
	$spmy_dpaphpcache_post_nos[$key] = $value ;
	}	
unset( $spmy_dpaphpcache_post_count ); //clear memory
//echo 'Total posts: '.$iz.' '; 
$spmy_dpabadbot_setup_file = dirname(__FILE__) .'/setup.txt';
$wppathstr = str_replace( 'wp-content/plugins/dpabadbotwp/setup.txt', '', $spmy_dpabadbot_setup_file);
$spmy_dpabadbot_setup_tmp = spmy_dpabadbot_read_file( $spmy_dpabadbot_setup_file );
$spmy_dpabadbot_setup_data = unserialize( $spmy_dpabadbot_setup_tmp );
$spmy_dpabadbot_setup_sz = count( $spmy_dpabadbot_setup_data );

if( strlen( $spmy_dpabadbot_setup_tmp ) > 2 && $spmy_dpabadbot_setup_sz > 0 ){
	if( $spmy_dpabadbot_setup_data[0] != '' ){
		$spmy_dpabadbot_path = $spmy_dpabadbot_setup_data[0];
		//$spmy_dpabadbot_GMThours = $spmy_dpabadbot_setup_data[1]/3600;
		//check dpabadbot files exists
		//$spmy_dpabadbot_datadir = $spmy_dpabadbot_path.'data/';
		//$spmy_dpabadbot_ip_file = $spmy_dpabadbot_path.'data/wpipadd.txt';
		$spmy_dpabadbot_posts_file = $spmy_dpabadbot_path.'config/wpposts.txt';
		//echo '<br>1. filename to open: '.$spmy_dpabadbot_posts_file.'  ' ;
		spmy_dpabadbot_write_file( $spmy_dpabadbot_posts_file, serialize( $spmy_dpaphpcache_post_nos['publish'] ) );
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



//$spmy_dpabadbot_setup_file = $installbase.'wp-content/plugins/dpabadbotwp/setup.txt';
$spmy_dpabadbot_setup_file = dirname(__FILE__) .'/setup.txt';
//echo ' <br>2. setup file : '.$spmy_dpabadbot_setup_file.'  ' ;
$spmy_dpabadbot_setup_tmp = spmy_dpabadbot_read_file( $spmy_dpabadbot_setup_file );
$spmy_dpabadbot_setup_data = unserialize( $spmy_dpabadbot_setup_tmp );
//echo '<br>3. [0] : '.$spmy_dpabadbot_setup_data.'  ';
$spmy_dpabadbot_setup_sz = count( $spmy_dpabadbot_setup_data );
if( strlen( $spmy_dpabadbot_setup_tmp ) > 2 && $spmy_dpabadbot_setup_sz > 0 ){
	$spmy_dpabadbot_path = $spmy_dpabadbot_setup_data[0];
//	echo '<br>set up file has data';
} else {
$spmy_dpabadbot_path = dirname(__FILE__);
}


//check dpabadbot files exists
$spmy_dpabadbot_datadir = $spmy_dpabadbot_path.'data/';
$spmy_dpabadbot_ip_file = $spmy_dpabadbot_path.'data/wpipadd.txt';


//declare the function
if( !function_exists( 'spmy_dpabadbot_deleteipadd' )){
function spmy_dpabadbot_deleteipadd(){
$spmy_dpabadbot_setup_file = dirname(__FILE__) .'/setup.txt';
$spmy_dpabadbot_setup_tmp = spmy_dpabadbot_read_file( $spmy_dpabadbot_setup_file );
$spmy_dpabadbot_setup_data = unserialize( $spmy_dpabadbot_setup_tmp );
$spmy_dpabadbot_setup_sz = count( $spmy_dpabadbot_setup_data );

if( strlen( $spmy_dpabadbot_setup_tmp ) > 2 && $spmy_dpabadbot_setup_sz > 0 ){
	$spmy_dpabadbot_path = $spmy_dpabadbot_setup_data[0];
	//check dpabadbot files exists
	$spmy_dpabadbot_datadir = $spmy_dpabadbot_path.'data/';
	$spmy_dpabadbot_ip_file = $spmy_dpabadbot_path.'data/wpipadd.txt';
	if( file_exists( $spmy_dpabadbot_datadir ) ){
		if( file_exists( $spmy_dpabadbot_ip_file ) ){ 
			$spmy_dpabadbot_ip_tmp = spmy_dpabadbot_read_file( $spmy_dpabadbot_ip_file ) ;
			if( strlen( $spmy_dpabadbot_ip_tmp ) > 6 ){//find all ip addresses older than 2 days and delete
			$spmy_dpabadbot_ip_addrs = unserialize( $spmy_dpabadbot_ip_tmp );
			$spmy_dpabadbot_ip_time = (time()- 86400) ;
			foreach( $spmy_dpabadbot_ip_addrs as $mykey => $myvalue){
				if( $spmy_dpabadbot_ip_addrs[$mykey][1] < $spmy_dpabadbot_ip_time ){
					unset( $spmy_dpabadbot_ip_addrs[$mykey] );
					}	
				}
			spmy_dpabadbot_write_file( $spmy_dpabadbot_ip_file, serialize( $spmy_dpabadbot_ip_addrs) );	
			}
	
			$spmy_dpabadbot_ip = spmy_dpabadbot_get_client_ip();	//get ip address
			$spmy_dpabadbot_ip_tmp = spmy_dpabadbot_read_file( $spmy_dpabadbot_ip_file );
			if( strlen( $spmy_dpabadbot_ip_tmp ) > 6 ){
				$spmy_dpabadbot_ip_addrs = unserialize( $spmy_dpabadbot_ip_tmp );
				}
				if( !isset( $spmy_dpabadbot_ip_addrs[$spmy_dpabadbot_ip] ) ){
				$spmy_dpabadbot_ip_addrs[$spmy_dpabadbot_ip][0] = $spmy_dpabadbot_ip ;
				$spmy_dpabadbot_ip_addrs[$spmy_dpabadbot_ip][1] = time() ;				
				spmy_dpabadbot_write_file( $spmy_dpabadbot_ip_file, serialize( $spmy_dpabadbot_ip_addrs) );
				}
				
			}

		}
	}
}
}



		
if ( is_admin() ){

	if( function_exists( 'spmy_dpabadbot_actions')) {
		add_action('admin_menu', 'spmy_dpabadbot_actions');	
		add_action( 'save_post', 'spmy_dpabadbot_post_numbers' );	//update & preview = /../../autosave
		add_action( 'post_updated', 'spmy_dpabadbot_post_numbers' ); //preview changes	& update posts	
		add_action( 'edit_post', 'spmy_dpabadbot_post_numbers' );	//preview changes
		add_action( 'publish_post', 'spmy_dpabadbot_post_numbers' );	//update post
	if( file_exists( $spmy_dpabadbot_datadir ) ){
		if( file_exists( $spmy_dpabadbot_ip_file ) ){ 
			$spmy_dpabadbot_ip_tmp = spmy_dpabadbot_read_file( $spmy_dpabadbot_ip_file );
			if( strlen( $spmy_dpabadbot_ip_tmp ) > 2 ){
				$spmy_dpabadbot_ip_addrs = unserialize( $spmy_dpabadbot_ip_tmp );
				}
			}
	$spmy_dpabadbot_ip = spmy_dpabadbot_get_client_ip();
	if( !isset( $spmy_dpabadbot_ip_addrs[$spmy_dpabadbot_ip])) {
	$spmy_dpabadbot_ip_addrs[$spmy_dpabadbot_ip][0] = $spmy_dpabadbot_ip;
	$spmy_dpabadbot_ip_addrs[$spmy_dpabadbot_ip][1] = time();
	spmy_dpabadbot_write_file( $spmy_dpabadbot_ip_file, serialize( $spmy_dpabadbot_ip_addrs) );
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