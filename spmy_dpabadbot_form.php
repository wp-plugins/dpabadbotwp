<?php
defined('ABSPATH') or die("No script kiddies please!");
//include 'spmyfunctions.php';
$spmy_dpabadbot_nofile = '';

//$spmy_dpabadbot_setup_file = $installbase.'wp-content/plugins/dpabadbotwp/setup.txt';
$spmy_dpabadbot_setup_file = dirname(__FILE__) .'/setup.txt';
$wppathstr = str_replace( 'wp-content/plugins/dpabadbotwp/setup.txt', '', $spmy_dpabadbot_setup_file);
$spmy_dpabadbot_setup_tmp = spmy_dpabadbot_read_file( $spmy_dpabadbot_setup_file );
$spmy_dpabadbot_setup_data = unserialize( $spmy_dpabadbot_setup_tmp );
$spmy_dpabadbot_setup_sz = count( $spmy_dpabadbot_setup_data );

if( strlen( $spmy_dpabadbot_setup_tmp ) > 2 && $spmy_dpabadbot_setup_sz > 0 ){
	$spmy_dpabadbot_path = $spmy_dpabadbot_setup_data[0];
	$spmy_dpabadbot_GMThours = $spmy_dpabadbot_setup_data[1]/3600;
//	echo '<br>set up file has data';
} else {
	$spmy_dpabadbot_path = $wppathstr.'dpabadbot/';
	$spmy_dpabadbot_setup_data[0] = $wppathstr.'dpababdot';
	$spmy_dpabadbot_GMThours = 0;
	$spmy_dpabadbot_setup_data[1] = 0;
}
spmy_dpabadbot_write_file( $spmy_dpabadbot_setup_file, serialize( $spmy_dpabadbot_setup_data ) );
//echo '<br>GMT is: '.$spmy_dpabadbot_GMThours.' ';

if( isset( $_POST['spmy_dpabadbot_setup_MyData'] ) ){
if( $_POST['spmy_dpabadbot_setup_MyData'] == 'Submit' ){
unset($spmy_dpabadbot_setup_data ) ;

//if( isset( $_POST[spmy_dpabadbotsite] ) ) {
	$spmy_dpabadbot_sitenow = trim( $_POST['spmy_dpabadbotsite'] ) ; 
	$spmy_dpabadbot_sitenow =  rtrim( trim( $spmy_dpabadbot_sitenow ), '/'); 	
	$spmy_dpabadbot_sitenow = $spmy_dpabadbot_sitenow.'/';
	$spmy_dpabadbot_path = $spmy_dpabadbot_sitenow ;
//	echo '<br> sitenow: '.$spmy_dpabadbot_sitenow.'  ';
//	echo '<br>sitenow is: '.$spmy_dpabadbot_sitenow.', path: '.$spmy_dpabadbot_path.'  ';
	if( file_exists( $spmy_dpabadbot_sitenow ) ){
		$spmy_dpabadbot_nofile = '<span style="color:blue;">'.$spmy_dpabadbot_sitenow.'</span><span style="color:green;"> directory exists</span>';
		$spmy_dpabadbot_setup_data[0] = $spmy_dpabadbot_sitenow ;
		
		} else {
		$spmy_dpabadbot_nofile = '<span style="color:blue;">'.$spmy_dpabadbot_sitenow.'</span><span style="color:red;">   directory not found</span>';
			}
//}
//if( isset( $_POST[spmy_dpabadbotGMT] ) ){
	if( isset( $_POST['spmy_dpabadbotGMT'] ) ) {
	$spmy_dpabadbot_GMThours = 1*trim( $_POST['spmy_dpabadbotGMT'] );
	$spmy_dpabadbot_setup_data[1] = 3600*$spmy_dpabadbot_GMThours ;
	}
//	}

if( file_exists( $spmy_dpabadbot_setup_file ) ){
	unlink( $spmy_dpabadbot_setup_file );
	}
clearstatcache();	
spmy_dpabadbot_write_file( $spmy_dpabadbot_setup_file, serialize( $spmy_dpabadbot_setup_data ) );
} 
}


$spmy_dpabadbot_maxlen = 25 ;
$spmy_dpabadbot_cl = strlen( $wppathstr ) ;
if ( $spmy_dpabadbot_cl > $spmy_dpabadbot_maxlen ){
$spmy_dpabadbot_maxlen = $spmy_dpabadbot_cl;
}

$spmy_dpabadbot_maxlen = $spmy_dpabadbot_maxlen + 5;


?>
<div class="wrap">
<?php
$spmy_dpabadbot_ip = spmy_dpabadbot_get_client_ip();
echo '<br><span style="color:red;font-size:24px;font-style:normal;">Welcome to dpaBadBot<b>WP</b> Setup (Version 1.09) </span>';
echo '<p><span style="color:blue;font-size:14px;font-style:normal;">dpaBadBot is a php program that was developed to block hacker attacks on WordPress, Joomla, ... and other websites. Please visit our website at <a target="_blank" href="https://www.dpabadbot.com">https://www.dpabadbot.com</a> for more details on dpaBadBot that blocks hackers, stops brute force login attempts and defends against ddos attacks.</p>
<p><span style="color:blue;font-size:14px;font-style:normal;">This plugin, dpaBadBot<b>WP</b>, sets up the data file that holds your current IP address so that you will not be blocked from accessing your site. Whenever you are logged into WordPress, your current IP address is recorded so that dpaBadBot does not block your access to your site. 
<p><span style="color:blue;font-size:14px;font-style:normal;">By its self this plugin will not be useful if you had not purchased <a target="_blank" href="https://www.dpabadbot.com">dpaBadBot</a> or downloaded the <a href="https://www.dpabadbot.com/30daydlCU.php?pdtno=5" target="_blank">30 Day Trial version</a>.  </span></p>
<p><span style="color:darkblue;font-size:14px;font-style:normal;">If you are not sure where dpaBadBot is located please run dpaBadBot and look at menu option <span style="color:brown;">Setup > Setup Blog Security or Blog Upgrade</span> for the directory pathname of dpaBadBot.</span></p>  ';

?>

<h2><span style="color:blue;font-size:18px;font-style:normal;">Please confirm the location of  dpaBadBot</span></h2>
<form action="<? echo htmlspecialchars( $PHP_SELF ) ; ?>"  method="post">
<table>
<tr><td>Your Website is at: </td><td><input type="text" readonly size="<?php echo $spmy_dpabadbot_maxlen; ?>" name="spmy_dpawebsiteis" value="<?php echo $wppathstr; ?>" ></td></tr>
<tr><td>Your IP Address is: </td><td><input type="text" readonly size="<?php echo $spmy_dpabadbot_maxlen; ?>" name="spmy_dpawebsiteIP" value="<?php echo $spmy_dpabadbot_ip; ?>" ></td></tr>
<tr><td></td><td></td></tr>
<tr><td>GMT/UTC Time zone (+/-hours): </td><td><input type="text" size="10" name="spmy_dpabadbotGMT" value="<?php echo $spmy_dpabadbot_GMThours; ?>" > hours</td></tr>
<tr><td>Your dpaBadBot is at: </td><td><input type="text" size="<?php echo $spmy_dpabadbot_maxlen; ?>" name="spmy_dpabadbotsite" value="<?php echo $spmy_dpabadbot_path; ?>" ><?php echo $spmy_dpabadbot_nofile ; ?></td></tr>
<tr><td></td><td></td></tr>

</table>
<input type="submit" name="spmy_dpabadbot_setup_MyData" value="Submit" >
</form>

</div>
<?php


//check dpabadbot files exists
$spmy_dpabadbot_datadir = $spmy_dpabadbot_path.'data/';
$spmy_dpabadbot_ip_file = $spmy_dpabadbot_path.'data/wpipadd.txt';

//delete an existing blocked ip address
if( isset( $_POST['spmy_dpabadbot_deleteip']  ) ){
if( $_POST['spmy_dpabadbot_deleteip'] == 'Delete Data' ){
clearstatcache();
if( file_exists( $spmy_dpabadbot_ip_file ) ){
	unlink( $spmy_dpabadbot_ip_file );
}
}
}


//echo '<br>path is : '.$spmy_dpabadbot_path.' ';
if( $spmy_dpabadbot_path != '' ){
if( file_exists( $spmy_dpabadbot_datadir ) ){
//if( file_exists( $spmy_dpabadbot_datadir ) ){
	if( file_exists( $spmy_dpabadbot_ip_file ) ){ 
		$spmy_dpabadbot_ip_tmp = spmy_dpabadbot_read_file( $spmy_dpabadbot_ip_file );
		if( strlen( $spmy_dpabadbot_ip_tmp ) > 2 ){
			$spmy_dpabadbot_ip_addrs = unserialize( $spmy_dpabadbot_ip_tmp );
			}
		}
//	}
$spmy_dpabadbot_ip_addrs[$spmy_dpabadbot_ip][0] = $spmy_dpabadbot_ip;
$spmy_dpabadbot_ip_addrs[$spmy_dpabadbot_ip][1] = time();
spmy_dpabadbot_write_file( $spmy_dpabadbot_ip_file, serialize( $spmy_dpabadbot_ip_addrs) );

$spmy_dpabadbot_ip_sz = count( $spmy_dpabadbot_ip_addrs );
$spmy_dpabadbot_ip_tmp = serialize( $spmy_dpabadbot_ip_addrs );
if( $spmy_dpabadbot_ip_sz > 0 && strlen( $spmy_dpabadbot_ip_tmp ) > 2 ){
?>

<h2><span style="color:blue;font-size:18px;font-style:normal;">The IP Addresses you have used</span></h2>
<form action="<? echo htmlspecialchars( $PHP_SELF ) ; ?>"  method="post">
<table border='1'>
<th>Item</th>
<th>IP Address</th>
<th>Date</th>
<?php
$spmy_dpabadbot_i=0;
foreach( $spmy_dpabadbot_ip_addrs as $mykey => $myvalue){
		$spmy_dpabadbot_i++;
		$spmy_dpabadbot_tmp1 =  $spmy_dpabadbot_ip_addrs[$mykey][1] + $spmy_dpabadbot_setup_data[1]  ;
		echo '<tr><td>'.$spmy_dpabadbot_i.'</td><td>'.$spmy_dpabadbot_ip_addrs[$mykey][0].'</td><td>'.date( "Y/M/d l H:i:s", $spmy_dpabadbot_tmp1 ).'</td></tr>';
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
$spmy_dpabadbot_plugins_dir = plugins_url().'/dpabadbotwp';
?>
<h3>Other Products by Software Propulsion</h3>
<table width="800">
<tr><td style="color:darkblue;font-size:14px;font-style:normal;vertical-align:top;"><span style="color:red;">dpaPHPCache</span> - SuperFast Cache for WordPress. SuperFast Cache is in 2 modules. The 1st is the Cache Controller, in dpaPHPCache - a WordPress Plugin & the 2nd is built into dpaBadBot, The Bad Bot Exterminator & Firewall Shield.</td><td style="vertical-align:top;"><a target="_blank" href="https://www.dpabadbot.com/amazingly-super-fast-wordpress-plugin-cache-controller-and-php-accelerator.php"><img src="<?php echo $spmy_dpabadbot_plugins_dir.'/sfc30.png'; ?>" width="402" height="30"></a></td></tr>
<tr><td style="color:blue;font-size:14px;font-style:normal;vertical-align:top;"><span style="color:red;">dpaContactUs</span> - Contact Form that makes life difficult for spammers. Multiple websites can share one email address.</td><td style="vertical-align:top;"><a target="_blank" href="http://www.dpacu.com"><img src="<?php echo $spmy_dpabadbot_plugins_dir.'/cufh30.png'; ?>" width="402" height="30"></a></td></tr>
<tr><td style="color:darkblue;font-size:14px;font-style:normal;vertical-align:top;"><span style="color:red;">dpaBadBot</span> - The Bad Bot Exterminator. Very effective anti hacking software that blocks hackers, stop brute force login attemtps and defends against ddos attacks to protect your WordPress website</td><td style="vertical-align:top;"><a target="_blank" href="https://www.dpabadbot.com"><img src="<?php echo $spmy_dpabadbot_plugins_dir.'/bbbh30.png'; ?>" width="402" height="30"></a></td></tr>
<tr><td style="color:blue;font-size:14px;font-style:normal;vertical-align:top;"><span style="color:red;">xfcPHPCache</span> - Not for WordPress, Joomla or other blogs but for other php websites. PHP Caching Software</td><td style="vertical-align:top;"><a target="_blank" href="http://www.dpaxfc.com"><img src="<?php echo $spmy_dpabadbot_plugins_dir.'/xfch30.png'; ?>" width="402" height="30"></a></td></tr>
<tr><td style="color:darkblue;font-size:14px;font-style:normal;vertical-align:top;"><span style="color:red;">dpaImageCompression</span> - Image Compression. Compresses images you have saved on your websites.</td><td style="vertical-align:top;"><a target="_blank" href="http://www.dpaic.com"><img src="<?php echo $spmy_dpabadbot_plugins_dir.'/ich30.png'; ?>"  width="402" height="30"></a></td></tr>
<tr><td style="color:blue;font-size:14px;font-style:normal;vertical-align:top;"><span style="color:red;">Web Hosting Services</span> - from budget hosting to high performance sites.</td><td style="vertical-align:top;"><a target="_blank" href="http://www.peterpublishing.com"><img src="<?php echo $spmy_dpabadbot_plugins_dir.'/webhostingservicesh30.png'; ?>" width="405" height="30"></a></td></tr>
</table>
