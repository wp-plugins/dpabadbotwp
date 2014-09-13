<?php
defined('ABSPATH') or die("No script kiddies please!");
//include 'spmyfunctions.php';


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


if( $_POST[spmy_dpabadbot_setup] == 'Submit' ){
//echo '<br>Yes Submit detected';
if( isset( $_POST[spmy_dpabadbotsite] ) ) {
	$spmy_dpabadbot_sitenow = esc_url( trim( $_POST[spmy_dpabadbotsite] ) ); 
	$spmy_dpabadbot_sitenow =  rtrim( trim( $spmy_dpabadbot_sitenow ), '/'); 	
	$spmy_dpabadbot_sitenow = $spmy_dpabadbot_sitenow.'/';
	$spmy_dpabadbot_path = $spmy_dpabadbot_sitenow ;
	if( file_exists( $spmy_dpabadbot_sitenow ) ){
		$spmy_dpabadbot_nofile = '<span style="color:blue;">'.$spmy_dpabadbot_sitenow.'</span><span style="color:green;"> directory exists</span>';
		spmy_dpabadbot_write_file( $spmy_dpabadbot_setup_file, serialize( $spmy_dpabadbot_sitenow) );
		} else {
		$spmy_dpabadbot_nofile = '<span style="color:blue;">'.$spmy_dpabadbot_sitenow.'</span><span style="color:red;">   directory not found</span>';
	}
}
else {
//echo '<br>No ... No Submit detected';
}
} else {

//$spmy_dpabadbot_path = $installbase.'dpabadbot/';
}


$spmy_dpabadbot_maxlen = 25 ;
$spmy_dpabadbot_cl = strlen( $installbase ) ;
if ( $spmy_dpabadbot_cl > $spmy_dpabadbot_maxlen ){
$spmy_dpabadbot_maxlen = $spmy_dpabadbot_cl;
}
$spmy_dpabadbot_cl = strlen( $ppmy_filebase ) ;
if ( $spmy_dpabadbot_cl > $spmy_dpabadbot_maxlen ){
$spmy_dpabadbot_maxlen = $spmy_dpabadbot_cl;
}
$spmy_dpabadbot_maxlen = $spmy_dpabadbot_maxlen + 5;


?>
<div class="wrap">
<?php
$spmy_dpabadbot_ip = spmy_dpabadbot_get_client_ip();
echo '<br><span style="color:red;font-size:32px;font-style:normal;">Welcome to dpaBadBot<b>WP</b> Setup</span>';
echo '<p><span style="color:blue;font-size:16px;font-style:normal;">dpaBadBot is a php program that was developed to block hacker attacks on WordPress, Joomla, ... and other websites. Please visit our website at <a target="_blank" href="https://www.dpabadbot.com">https://www.dpabadbot.com</a> for more details on dpaBadBot that blocks hackers, stops brute force login attempts and defends against ddos attacks.</p>
<p><span style="color:blue;font-size:16px;font-style:normal;">This plugin, dpaBadBot<b>WP</b>, sets up the data file that holds your current IP address so that you will not be blocked from accessing your site. Whenever you are logged into WordPress, your current IP address is recorded so that dpaBadBot does not block your access to your site. If your IP address does not change each time you access the internet you can set, in dpaBadBot program, your IP address to be permanently allowed access.
<p><span style="color:blue;font-size:16px;font-style:normal;">By its self this plugin will not be useful if you had not purchased <a target="_blank" href="https://www.dpabadbot.com">dpaBadBot</a> or downloaded the <a href="https://www.dpabadbot.com/30daydlCU.php?pdtno=5" target="_blank">30 Day Trial version</a>.  </span></p>
<p><span style="color:darkblue;font-size:16px;font-style:normal;">If your not sure where dpaBadBot is located please run dpaBadBot and look at menu option <span style="color:brown;">Setup > Setup Blog Security or Blog Upgrade</span> for the directory pathname of dpaBadBot.</span></p>  ';
echo '<p><span style="color:blue;font-size:16px;font-style:normal;">Do Remember to go to dpaBadBot and Unlock WordPress and Stop Tracking Visitors before you upgrade WordPress. Upgrade WordPress then go to dpBadBot menu <span style="color:brown;">Setup > Setup Blog Security or Blog Upgrade</span> and save the new setup. Its just telling dpaBadBot that the login and index files were upgraded and need to be taken into account. </span></p>
';
?>
<br><br><br>
<h2><span style="color:blue;font-size:18px;font-style:normal;">Please confirm the location of Wordpress files & dpaBadBot</span></h2>
<form action="<? echo htmlspecialchars( $PHP_SELF ) ; ?>"  method="post">
<table>
<tr><td>Your Website is at: </td><td><input type="text" readonly size="<?php echo $spmy_dpabadbot_maxlen; ?>" name="spmy_dpawebsiteis" value="<?php echo $ppmy_filebase; ?>" ></td></tr>
<tr><td>Your Website files are at: </td><td><input type="text" readonly size="<?php echo $spmy_dpabadbot_maxlen; ?>" name="spmy_dpawebsiteat" value="<?php echo $installbase; ?>" ></td></tr>
<tr><td></td><td></td></tr>
<tr><td>Your dpaBadBot is at: </td><td><input type="text" size="<?php echo $spmy_dpabadbot_maxlen; ?>" name="spmy_dpabadbotsite" value="<?php echo $spmy_dpabadbot_path; ?>" ><?php echo $spmy_dpabadbot_nofile ; ?></td></tr>
<tr><td></td><td></td></tr>
<tr><td>Your IP Address is: </td><td><input type="text" size="<?php echo $spmy_dpabadbot_maxlen; ?>" name="spmy_dpawebsiteIP" value="<?php echo $spmy_dpabadbot_ip; ?>" ></td></tr>
</table>
<input type="submit" name="spmy_dpabadbot_setup" value="Submit" >
</form>

<br><br><br>

</div>
<?php


//check dpabadbot files exists
$spmy_dpabadbot_datadir = $spmy_dpabadbot_path.'data/';
$spmy_dpabadbot_ip_file = $spmy_dpabadbot_path.'data/wpipadd.txt';



//delete an existing blocked ip address
if( $_POST[spmy_dpabadbot_deleteip] == 'Delete Data' ){
clearstatcache();
if( file_exists( $spmy_dpabadbot_ip_file ) ){
	unlink( $spmy_dpabadbot_ip_file );
}
}


if( file_exists( $spmy_dpabadbot_datadir ) ){
//if( file_exists( $spmy_dpabadbot_datadir ) ){
	if( file_exists( $spmy_dpabadbot_ip_file ) ){ 
		$spmy_dpabadbot_ip_tmp = spmy_dpabadbot_read_file( $spmy_dpabadbot_ip_file );
		if( strlen( $spmy_dpabadbot_ip_tmp ) > 2 ){
			$spmy_dpabadbot_ip_addrs = unserialize( $spmy_dpabadbot_ip_tmp );
			}
		}
//	}
$spmy_dpabadbot_ip_addrs[$spmy_dpabadbot_ip] = $spmy_dpabadbot_ip;
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
<?php
$spmy_dpabadbot_i=0;
foreach( $spmy_dpabadbot_ip_addrs as $mykey => $myvalue){
		$spmy_dpabadbot_i++;
		echo '<tr><td>'.$spmy_dpabadbot_i.'</td><td>'.$spmy_dpabadbot_ip_addrs[$mykey].'</td></tr>';
}
?>
</table>
<input type="submit" name="spmy_dpabadbot_deleteip" value="Delete Data" >
</form>
<?php
}

} else {
echo '<br>Check your dpaBadBot directory exists. It should be http://www.mydomain.com/dpabadbot/ or something similar but ending with "/dpabadbot/". Please refer to dpaBadBot menu option <span style="color:brown;">Setup > Setup WordPress Security or WordPress Upgrade</span>';
}

?>

<br><br><br>
<?php
$spmy_plugins_url = plugins_url().'/dpabadbotwp';
?>
<h3>Other Products by Software Propulsion</h3>
<table width="800">
<tr><td style="color:blue;font-size:14px;font-style:normal;vertical-align:top;"><span style="color:red;">dpaContactUs</span> - Contact Form that makes life difficult for spammers. Multiple websites can share one email address.</td><td style="vertical-align:top;"><a target="_blank" href="http://www.dpacu.com"><img src="<?php echo $spmy_plugins_url.'/cufh30.png'; ?>" width="402" height="30"></a></td></tr>
<tr><td style="color:darkblue;font-size:14px;font-style:normal;vertical-align:top;"><span style="color:red;">dpaBadBot</span> - Very effective anti hacking software that blocks hackers, stop brute force login attemtps and defends against ddos attacks to protect your WordPress website</td><td style="vertical-align:top;"><a target="_blank" href="https://www.dpabadbot.com"><img src="<?php echo $spmy_plugins_url.'/bbbh30.png'; ?>" width="402" height="30"></a></td></tr>
<tr><td style="color:blue;font-size:14px;font-style:normal;vertical-align:top;"><span style="color:red;">xfcPHPCache</span> - Not for WordPress, Joomla or other blogs but for other php websites. PHP Caching Software</td><td style="vertical-align:top;"><a target="_blank" href="http://www.dpaxfc.com"><img src="<?php echo $spmy_plugins_url.'/xfch30.png'; ?>" width="402" height="30"></a></td></tr>
<tr><td style="color:darkblue;font-size:14px;font-style:normal;vertical-align:top;"><span style="color:red;">dpaImageCompression</span> - Image Compression. Compresses images you have saved on your websites.</td><td style="vertical-align:top;"><a target="_blank" href="http://www.dpaic.com"><img src="<?php echo $spmy_plugins_url.'/ich30.png'; ?>"  width="402" height="30"></a></td></tr>
<tr><td style="color:blue;font-size:14px;font-style:normal;vertical-align:top;"><span style="color:red;">Web Hosting Services</span> - from budget hosting to high performance sites.</td><td style="vertical-align:top;"><a target="_blank" href="http://www.peterpublishing.com"><img src="<?php echo $spmy_plugins_url.'/webhostingservicesh30.png'; ?>" width="405" height="30"></a></td></tr>
</table>









