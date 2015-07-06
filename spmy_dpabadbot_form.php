<style type="text/css">
table.spmy_dpabadbot_table {  border:1px solid #901C1C; border-collapse: collapse; border-radius: 5px; box-shadow: 0px 0px 3px 1px rgba(0, 0, 0, 0.8); color:darkblue; font-family: Times Roman; font-size:14px; max-width:780px;}  
#table.spmy_dpabadbot_table td, th {
#    border: 2px solid gray;
#}

</style>
<?php
defined('ABSPATH') or die("No script kiddies please!");
//include 'spmyfunctions.php';
$spmywp_dpabadbot_nofile = '';

//check number of posts
$spmywp_dpaphpcache_post_count = wp_count_posts();
$iz = 0 ;
foreach ($spmywp_dpaphpcache_post_count as $key => $value) {
//	echo '<br>post count : '.$key.'  '.$value.'  ' ;
	$spmywp_dpaphpcache_post_nos[$key] = $value ;
	$iz++;
}	
unset( $spmywp_dpaphpcache_post_count ); //clear memory
//echo 'Total posts: '.$iz.' '; 


//$spmywp_dpabadbot_setup_file = $installbase.'wp-content/plugins/dpabadbotwp/setup.txt';
$spmywp_dpabadbot_setup_tmp = '';
$spmywp_dpabadbot_setup_sz = 0;

$spmywp_datadir = dirname(__FILE__) ;
$wppathstr = dirname(__FILE__) ; //initialise data so that it will not give trouble later
$spmywp_string_position = strripos( $spmywp_datadir , 'dpabadbotwp');
$spmywp_datadiralt = substr_replace( $spmywp_datadir , 'dpabadbotwpdata' , $spmywp_string_position  );

$spmywp_dpabadbot_setup_file = $spmywp_datadiralt .'/setup.txt';
$spmywp_dpabadbot_setup_fileORG = dirname(__FILE__) .'/setup.txt';
//$wppathstr = str_replace( 'wp-content/plugins/dpabadbotwp/setup.txt', '', $spmywp_dpabadbot_setup_file);
$spmywp_strpos = strripos( $spmywp_datadir, 'wp-content' );
if( $spmywp_strpos !== false ){
	$wppathstr = substr( $spmywp_datadir, 0, $spmywp_strpos  );
	}
if( !file_exists( $spmywp_datadiralt ) ){
mkdir( $spmywp_datadiralt );
if( file_exists( $spmywp_dpabadbot_setup_fileORG ) ){
	$spmywp_tempstr = spmy_bowpp_read_file( $spmywp_dpabadbot_setup_fileORG );
	spmy_bowpp_write_file( $spmywp_dpabadbot_setup_file, $spmywp_tempstr );
	}
}	
//echo '<br>alt dir: '.$spmywp_datadiralt.'  ';
$spmywp_datadiraltrtn = chmod($spmywp_datadiralt, 0775);
//if( $spmywp_datadiraltrtn == true ){
//echo '<br>success in changing permissions';
//} else {
//echo '<br>failed to change permissions';
//}


//echo '<br>datadir: '.$spmywp_datadir.'  ' ;	
//echo '<br>datadiralt: '.$spmywp_datadiralt.'  ' ;
//echo '<br>$spmywp_dpabadbot_setup_file: '.$spmywp_dpabadbot_setup_file.'  ' ;	
//echo '<br>$spmywp_dpabadbot_setup_fileORG: '.$spmywp_dpabadbot_setup_fileORG.'  ' ;


if( file_exists( $spmywp_dpabadbot_setup_file )){
$spmywp_dpabadbot_setup_tmp = spmy_dpabadbot_read_file( $spmywp_dpabadbot_setup_file );
$spmywp_dpabadbot_setup_data = unserialize( $spmywp_dpabadbot_setup_tmp );
$spmywp_dpabadbot_setup_sz = count( $spmywp_dpabadbot_setup_data );
}
if( strlen( $spmywp_dpabadbot_setup_tmp ) > 2 && $spmywp_dpabadbot_setup_sz > 0 ){
	$spmywp_dpabadbot_path = $spmywp_dpabadbot_setup_data[0];
	$spmywp_dpabadbot_GMThours = $spmywp_dpabadbot_setup_data[1]/3600;
//	echo '<br>set up file has data';
} else {
	$spmywp_dpabadbot_path = $wppathstr.'dpabadbot/';
	$spmywp_dpabadbot_setup_data[0] = $wppathstr.'dpababdot/';
	$spmywp_dpabadbot_GMThours = 0;
	$spmywp_dpabadbot_setup_data[1] = 0;
	$spmywp_dpabadbot_setup_data[2] = $spmywp_dpaphpcache_post_nos['publish'];	//number of published posts
	
}
spmy_dpabadbot_write_file( $spmywp_dpabadbot_setup_file, serialize( $spmywp_dpabadbot_setup_data ) );
//echo '<br>GMT is: '.$spmywp_dpabadbot_GMThours.' ';

if( isset( $_POST['spmy_dpabadbot_setup_MyData'] ) ){
if( $_POST['spmy_dpabadbot_setup_MyData'] == 'Submit' ){
unset($spmywp_dpabadbot_setup_data ) ;

//if( isset( $_POST[spmy_dpabadbotsite] ) ) {
	$spmywp_dpabadbot_sitenow = trim( $_POST['spmy_dpabadbotsite'] ) ; 
	$spmywp_dpabadbot_sitenow =  rtrim( trim( $spmywp_dpabadbot_sitenow ), '/'); 	
	$spmywp_dpabadbot_path_ford = $spmywp_dpabadbot_sitenow ;
	$spmywp_dpabadbot_sitenow = $spmywp_dpabadbot_sitenow.'/';
	$spmywp_dpabadbot_path = $spmywp_dpabadbot_sitenow ;
//	echo '<br> sitenow: '.$spmywp_dpabadbot_sitenow.'  ';
//	echo '<br>sitenow is: '.$spmywp_dpabadbot_sitenow.', path: '.$spmywp_dpabadbot_path.'  ';
	if( file_exists( $spmywp_dpabadbot_path_ford  ) ){
		$spmywp_dpabadbot_nofile = '<span style="color:blue;">'.$spmywp_dpabadbot_sitenow.'</span><span style="color:green;"> directory exists</span>';
		$spmywp_dpabadbot_setup_data[0] = $spmywp_dpabadbot_sitenow ;
		
		} else {
		$spmywp_dpabadbot_nofile = '<span style="color:blue;">'.$spmywp_dpabadbot_path.'</span><span style="color:red;">   directory not found</span>';
			}
//}
//if( isset( $_POST[spmy_dpabadbotGMT] ) ){
	if( isset( $_POST['spmy_dpabadbotGMT'] ) ) {
	$spmywp_dpabadbot_GMThours = 1*trim( $_POST['spmy_dpabadbotGMT'] );
	$spmywp_dpabadbot_setup_data[1] = 3600*$spmywp_dpabadbot_GMThours ;
	}
//	}

if( file_exists( $spmywp_dpabadbot_setup_file ) ){
	unlink( $spmywp_dpabadbot_setup_file );
	}
clearstatcache();	
spmy_dpabadbot_write_file( $spmywp_dpabadbot_setup_file, serialize( $spmywp_dpabadbot_setup_data ) );
} 
}


$spmywp_dpabadbot_maxlen = 25 ;
$spmywp_dpabadbot_cl = strlen( $wppathstr ) ;
if ( $spmywp_dpabadbot_cl > $spmywp_dpabadbot_maxlen ){
$spmywp_dpabadbot_maxlen = $spmywp_dpabadbot_cl;
}

$spmywp_dpabadbot_maxlen = $spmywp_dpabadbot_maxlen + 5;


?>
<div class="wrap">
<?php
$spmywp_dpabadbot_ip = spmy_dpabadbot_get_client_ip();
echo '<br><span style="color:red;font-size:24px;font-style:normal;">Welcome to dpaBadBot<b>WP</b> Setup (Version 1.16 [20150703]) </span>';
echo '<p><span style="color:blue;font-size:14px;font-style:normal;">dpaBadBot is a php program that was developed to block hacker attacks on WordPress, Joomla, ... and other websites. Please visit our website at <a target="_blank" href="https://www.dpabadbot.com">https://www.dpabadbot.com</a> for more details on dpaBadBot that blocks hackers, stops brute force login attempts and defends against ddos attacks.</span></p>
<p><span style="color:blue;font-size:14px;font-style:normal;">This plugin, dpaBadBot<b>WP</b>, sets up the data file that holds your current IP address so that you will not be blocked from accessing your site. Whenever you are logged into WordPress, your current IP address is recorded so that dpaBadBot does not block your access to your site.</span></p>
<p><span style="color:blue;font-size:14px;font-style:normal;">By its self this plugin will not be useful if you had not purchased <a target="_blank" href="https://www.dpabadbot.com">dpaBadBot</a>.</span></p>
<p><span style="color:darkblue;font-size:14px;font-style:normal;">If you are not sure where dpaBadBot is located please run dpaBadBot and look at menu option <span style="color:brown;">Setup > Setup Blog Security or Blog Upgrade</span> for the directory pathname of dpaBadBot.</span></p>  ';
/*
$spmywp_dpabadbot_sysmem = memory_get_usage(false ); 
$spmywp_dpabadbot_sysallmem = memory_get_usage(true ); 
$spmywp_dpabadbot_sysmemlimit = filter_var(ini_get("memory_limit"), FILTER_SANITIZE_NUMBER_INT)*1024*1024; //ini_get('memory_limit');
$spmywp_dpabadbot_sysmemlimitM  = ini_get("memory_limit") ;
$spmywp_dpabadbot_sysmempeak = memory_get_peak_usage ( true );
echo '<br><br><table><tr><td>memory used by PHP script: </td><td style="text-align:right">'.number_format($spmywp_dpabadbot_sysmem).' </td><td> Bytes </td></tr><tr><td>memory used allocated: </td><td style="text-align:right">'.number_format($spmywp_dpabadbot_sysallmem).' </td><td> Bytes </td></tr><tr><td>memory system limit: </td><td style="text-align:right">'.number_format($spmywp_dpabadbot_sysmemlimit).'</td><td> Bytes or '.$spmywp_dpabadbot_sysmemlimitM.' </td></tr><tr><td>memory system peak usage: </td><td style="text-align:right">'.number_format($spmywp_dpabadbot_sysmempeak).'</td><td> Bytes </td></tr></table>'	;
*/
$spmy_dpabadbot_sysmem = memory_get_usage(false );
$spmy_dpabadbot_sysmemM = $spmy_dpabadbot_sysmem /1048576 ;
$spmy_dpabadbot_sysallmem = memory_get_usage(true ); 
$spmy_dpabadbot_sysallmemM = $spmy_dpabadbot_sysallmem/1048576;
$spmy_dpabadbot_sysmemlimitM = ini_get("memory_limit") ;
$spmy_dpabadbot_sysmemlimit = filter_var($spmy_dpabadbot_sysmemlimitM, FILTER_SANITIZE_NUMBER_INT)*1024*1024; //ini_get('memory_limit');	
$spmy_dpabadbot_memallleft = $spmy_dpabadbot_sysallmem - $spmy_dpabadbot_sysmem ;
$spmy_dpabadbot_memallleftM = $spmy_dpabadbot_memallleft / 1048576;
$spmy_dpabadbot_mempeak = memory_get_peak_usage(true) ;
$spmy_dpabadbot_mempeakM = $spmy_dpabadbot_mempeak / 1048576;
?>
<h1>System Memory Status</h1>
<table class="spmy_dpabadbot_table">
<tr><td>memory used: </td><td style="text-align:right"><?php echo number_format($spmy_dpabadbot_sysmem);?> Bytes </td><td> or <?php echo number_format($spmy_dpabadbot_sysmemM, 2);?>MB</td></tr>
<tr><td>memory allocated: </td><td style="text-align:right"><?php echo number_format($spmy_dpabadbot_sysallmem);?> Bytes </td><td> or <?php echo number_format( $spmy_dpabadbot_sysallmemM, 2);?>MB</td></tr>
<tr><td>memory limit: </td><td style="text-align:right"><?php echo number_format($spmy_dpabadbot_sysmemlimit);?> Bytes </td><td> or <?php echo $spmy_dpabadbot_sysmemlimitM;?>B</td></tr><tr>
<td>memory allocated unused: </td><td style="text-align:right"><?php echo number_format($spmy_dpabadbot_memallleft);?> Bytes </td><td> or <?php echo number_format( $spmy_dpabadbot_memallleftM, 2 );?>MB</td></tr>
<tr><td>memory peak usage: </td><td style="text-align:right"><?php echo number_format($spmy_dpabadbot_mempeak);?> Bytes </td><td> or <?php echo number_format( $spmy_dpabadbot_mempeakM, 2 );?>MB</td></tr>
</table>
<br><br>

<table class="spmy_dpabadbot_table">
<tr><td>Total number of posts: </td><td><input type="text" readonly size="10" value="<?php echo $spmywp_dpaphpcache_post_nos['publish']; ?>" ></td></tr>
<tr><td>Your Website is at: </td><td><input type="text" readonly size="<?php echo $spmywp_dpabadbot_maxlen; ?>" name="spmy_dpawebsiteis" value="<?php echo $wppathstr; ?>" ></td></tr>
<tr><td>Your IP Address is: </td><td><input type="text" readonly size="<?php echo $spmywp_dpabadbot_maxlen; ?>" name="spmy_dpawebsiteIP" value="<?php echo $spmywp_dpabadbot_ip; ?>" ></td></tr>
</table>
<br><br>
<h2><span style="color:blue;font-size:18px;font-style:normal;">Please confirm the location of dpaBadBot & Time Zone</span></h2>

<form action="<? echo htmlspecialchars( $_SERVER['REQUEST_URI'] ) ; ?>"  method="post">
<table>
<tr><td>GMT/UTC Time zone (+/-hours): </td><td><input type="text" size="10" name="spmy_dpabadbotGMT" value="<?php echo $spmywp_dpabadbot_GMThours; ?>" > hours</td></tr>
<tr><td>Your dpaBadBot is at: </td><td><input type="text" size="<?php echo $spmywp_dpabadbot_maxlen; ?>" name="spmy_dpabadbotsite" value="<?php echo $spmywp_dpabadbot_path; ?>" ><?php echo $spmywp_dpabadbot_nofile ; ?></td></tr>
</table>
<input type="submit" name="spmy_dpabadbot_setup_MyData" value="Submit" >
</form>

</div>
<?php


//check dpabadbot files exists
$spmywp_dpabadbot_datadir = $spmywp_dpabadbot_path.'data/';
$spmywp_dpabadbot_ip_file = $spmywp_dpabadbot_path.'data/wpipadd.txt';
$spmywp_dpabadbot_posts_file = $spmywp_dpabadbot_path.'config/wpposts.txt';
//echo '<br>$spmywp_dpabadbot_datadir : '.$spmywp_dpabadbot_datadir.' ';
//echo '<br>$spmywp_dpabadbot_ip_file : '.$spmywp_dpabadbot_ip_file.' ';
//echo '<br>$spmywp_dpabadbot_posts_file : '.$spmywp_dpabadbot_posts_file.' ';

//delete an existing blocked ip address
if( isset( $_POST['spmy_dpabadbot_deleteip']  ) ){
if( $_POST['spmy_dpabadbot_deleteip'] == 'Delete Data' ){
clearstatcache();
if( file_exists( $spmywp_dpabadbot_ip_file ) ){
	unlink( $spmywp_dpabadbot_ip_file );
}
}
}


//echo '<br>path is : '.$spmywp_dpabadbot_path.' ';
if( $spmywp_dpabadbot_path != '' ){
$spmywp_dpabadbot_no_posts = $spmywp_dpaphpcache_post_nos['publish'];
spmy_dpabadbot_write_file( $spmywp_dpabadbot_posts_file, serialize( $spmywp_dpabadbot_no_posts ) );

if( file_exists( $spmywp_dpabadbot_datadir ) ){
//if( file_exists( $spmywp_dpabadbot_datadir ) ){
	if( file_exists( $spmywp_dpabadbot_ip_file ) ){ 
		$spmywp_dpabadbot_ip_tmp = spmy_dpabadbot_read_file( $spmywp_dpabadbot_ip_file );
		if( strlen( $spmywp_dpabadbot_ip_tmp ) > 2 ){
			$spmywp_dpabadbot_ip_addrs = unserialize( $spmywp_dpabadbot_ip_tmp );
			}
		}
//	}
$spmywp_dpabadbot_ip_addrs[$spmywp_dpabadbot_ip][0] = $spmywp_dpabadbot_ip;
$spmywp_dpabadbot_ip_addrs[$spmywp_dpabadbot_ip][1] = time();
spmy_dpabadbot_write_file( $spmywp_dpabadbot_ip_file, serialize( $spmywp_dpabadbot_ip_addrs) );

$spmywp_dpabadbot_ip_sz = count( $spmywp_dpabadbot_ip_addrs );
$spmywp_dpabadbot_ip_tmp = serialize( $spmywp_dpabadbot_ip_addrs );
if( $spmywp_dpabadbot_ip_sz > 0 && strlen( $spmywp_dpabadbot_ip_tmp ) > 2 ){
?>

<h2><span style="color:blue;font-size:18px;font-style:normal;">The IP Addresses you have used</span></h2>
<form action="<? echo htmlspecialchars( $_SERVER['REQUEST_URI'] ) ; ?>"  method="post">
<table border="1">
<th>Item</th>
<th>IP Address</th>
<th>Date</th>
<?php
$spmywp_dpabadbot_i=0;
foreach( $spmywp_dpabadbot_ip_addrs as $mykey => $myvalue){
		$spmywp_dpabadbot_i++;
		$spmywp_dpabadbot_tmp1 =  $spmywp_dpabadbot_ip_addrs[$mykey][1] + $spmywp_dpabadbot_setup_data[1]  ;
		echo '<tr><td>'.$spmywp_dpabadbot_i.'</td><td>'.$spmywp_dpabadbot_ip_addrs[$mykey][0].'</td><td>'.date( "Y/M/d l H:i:s", $spmywp_dpabadbot_tmp1 ).'</td></tr>';
}
?>
</table>
<input type="submit" name="spmy_dpabadbot_deleteip" value="Delete Data" >
</form>
<?php
}

} else {
echo '<span style="color:red;font-size:22px">Check your dpaBadBot directory exists</span><span style="color:blue;font-size:22px">. It should be home/www/mydomain.com/dpabadbot/ or something similar but ending with "/dpabadbot/". Please refer to dpaBadBot menu option</span> <span style="color:brown;font-size:22px">Setup > Setup Blog Security or Blog Upgrade</span>';
}
}

echo '<br><p><span style="color:darkblue;font-size:14px;font-style:normal;">If you intend to upgrade WordPress, do Remember to go to dpaBadBot and Unlock WordPress and Stop Tracking Visitors before you upgrade WordPress. Upgrade WordPress then go to dpBadBot menu <span style="color:brown;">Setup > Setup Blog Security or Blog Upgrade</span> and save the new setup. Its just telling dpaBadBot that the login and index files were upgraded and need to be taken into account. </span></p>
';
?>


<br><br>
<?php
$spmywp_dpabadbot_plugins_dir = plugins_url().'/dpabadbotwp';
?>
<h3>Other Products by Software Propulsion</h3>
<table width="800">
<tr><td style="color:darkblue;font-size:14px;font-style:normal;vertical-align:top;"><span style="color:red;">SuperFast Cache</span> - very fast cache for WordPress. SuperFast Cache is in 2 modules. The 1st is the Cache Controller, in superfastcahce - a WordPress Plugin & the 2nd is built into The Bad Bot Exterminator & Firewall Shield.</td><td style="vertical-align:top;"><a target="_blank" href="https://www.dpabadbot.com/wordpress-plugins/super-fast-cache-controller-and-php-accelerator-amazing-web-page-speed.php"><img src="<?php echo $spmywp_dpabadbot_plugins_dir.'/sfc30.png'; ?>" width="402" height="30"></a></td></tr>
<tr><td style="color:darkblue;font-size:14px;font-style:normal;vertical-align:top;"><span style="color:red;">The Bad Bot Exterminator & Firewall Shield</span> Very effective anti hacking software that blocks hackers, stop brute force login attemtps and defends against ddos attacks to protect your WordPress website</td><td style="vertical-align:top;"><a target="_blank" href="https://www.dpabadbot.com"><img src="<?php echo $spmywp_dpabadbot_plugins_dir.'/bbbh30.png'; ?>" width="402" height="30"></a></td></tr>
<tr><td style="color:blue;font-size:14px;font-style:normal;vertical-align:top;"><span style="color:red;">XFC a fast cache combined with an anti hacking firewall for php developers</span> - Not for WordPress, Joomla or other blogs but for other php websites. PHP Caching & Firewall Shield</td><td style="vertical-align:top;"><a target="_blank" href="http://www.xfcphpcache.com"><img src="<?php echo $spmywp_dpabadbot_plugins_dir.'/xfch30.png'; ?>" width="402" height="30"></a></td></tr>
<tr><td style="color:blue;font-size:14px;font-style:normal;vertical-align:top;"><span style="color:red;">Web Hosting Services</span> - from budget hosting to high performance sites.</td><td style="vertical-align:top;"><a target="_blank" href="http://www.peterpublishing.com"><img src="<?php echo $spmywp_dpabadbot_plugins_dir.'/webhostingservicesh30.png'; ?>" width="405" height="30"></a></td></tr>
<tr><td style="color:blue;font-size:14px;font-style:normal;vertical-align:top;"><span style="color:red;">dpaContactUs</span> - Contact Form that makes life difficult for spammers. Multiple websites can share one email address.</td><td style="vertical-align:top;"><a target="_blank" href="http://www.dpacontactus.com"><img src="<?php echo $spmywp_dpabadbot_plugins_dir.'/cufh30.png'; ?>" width="402" height="30"></a></td></tr>
</table>
<?php

//end of script

?>