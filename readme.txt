=== dpabadbotwp ===
Contributors: Dr. Peter Achutha
Tags: bad bot, hack, security, brute force login, block hackers, ddos attack
Requires at least: 3.9.1
Tested up to: 4.2.2
License URI: https://www.dpabadbot.com/wordpress-plugins/dpabadbotwp-helper-for-dpabadbot.php
Stable tag: 1.16  [20150706]


This plugin, dpaBadBotWP, automatically tells dpaBadBot, the firewall software, your current IP address and you will not be blocked from working on your WordPress site.

== Description ==
dpaBadBot is a php program that was developed to block hacker attacks on WordPress, Joomla, ... and other websites. Visit the website at https://www.dpabadbot.com for more details on dpaBadBot that blocks hackers, stops brute force login attempts and defends against ddos attacks. 

A little more about the dpaBadBot program (not the plugin) 
Firslty, you can lock up your WordPress site so that no one can login to your site. 
Secondly, this program will record every visitor and decide who should be allowed to access your website. It tries to block hackers, bad bots, scrappers, crawlers, spiders, ... It can block by IP address or by name of web crawler. 

This WordPress plugin, dpaBadBotWP was developed to tell dpaBadBot when you are working on your WordPress site and allowing you to carry on working by sending your IP address to dpaBadBot and thereby allow you unlimited access to your site. By its self this plugin will not be useful if you had not purchased dpaBadBot, the WordPress protection firewall software.

Note: If you are upgrading and the plugin has problems accessing files, DELETE this plugin and reinstall the plugin as all files names were changed to lower case.

It now stops automatic WordPress core updates so that the Bad Bot Exterminator, dpaBadBot, will not be erased.

Do visit our site https://www.dpabadbot.com/index.php for more information on the Bad Bot Exterminator

== Installation ==
1. Upload 'dpabadbotwp.zip' to the '/wp-content/plugins/' directory.
2. Activate the plugin through the 'Plugins' menu in WordPress.
3. Go to 'Settings > dpaBadBotWPMenu' and edit and save settings.

== Screenshots ==
1. Shows that only one field data needs to be entered and that is the directory where dpaBadBot is located. Also shows what IP addresses you have been using to access your WordPress site. screenshot-1.png



== Frequently Asked Questions ==
= What does this plugin do? =
dpaBadBot is a php program that protects your WordPress website form bad bots, brute force login attempts, hackers and ddos attacks. It does this by monitoring and tracking your website visitors and blocks the ip address of bad bots.

This plugin, dpaBadBotWP, sends your ip address to dpaBadBot php program and does not do anything else. Hence it is not useful if you have not installed dpaBadBot on your website. For more details of dpaBadBot please visit our website at https://www.dpabadbot.com




== Changelog ==
== 1.01 ==
Previous version forgot to check ip address when logged into WordPress control panel. This version corrects that. The moment you are logged in, your current IP address is sent to dpaBadBot.
== 1.02 ==
Added a better description of products offered by Software Propulsion with links to respective websites
== 1.03 ==
Changed all file names to lower case so that they will be compatible with all servers. If you are upgrading and the plugin has problems accessing files, DELETE this plugin and reinstall the plugin.
== 1.04 ==
dpaBadBot PHP program was upgraded to allow you to preview your edited posts. So this plugin had extra security feature added to work with these dpaBadBot upgrades. 
== 1.05 ==
Removed the check for logout as not a good idea. 
== 1.06 ==
Changed which ip address is saved. Only latest IP address is saved and all older one's are deleted.
== 1.07 ==
Added multiuser tracking. This version to be used with version 1.06 or later or the Bad Bot Exterminator.
== 1.08 ==
Stops automatic WordPress core updates by setting filter 'auto_update_core' to '__return_false'.
== 1.09 ==
Made the PHP code more compatible with the WordPress style by using the debug setting in wp-config.php
== 1.10 ==
Corrected some bugs. The directory name can now end with or without '/'.
== 1.11 ==
Undid some of the upgrades in 1.09 to make it less prone to spurios memory problems.
== 1.12 ==
Made some code more compatible with WordPress and checked if file existed.
== 1.13 ==
Found out that when you upgrade any plugin, WordPress will delete the existing plugin before downloading the upgrade version. Since this plugin saves all settings in the plugin directory all settings were lost upon upgrading. With version 1.13 a separate directory is created .../wp-contents/plugins/dpabadbotwpdata/ and all settings are saved in the altrnative sub-directory. Thus even after upgrading the original seetings are still available.

Changed all variable names to begin with $spmywp_.

== 1.14 ==
changed permission of .../wp-content/plugins/dpabadbotwpdata/ sub-directory to 0775 & stop recording visitors not logged in

== 1.15 ==
added display of memory in MB too.

== 1.16 ==
corrected the link to two other websites.

== Upgrade Notice ==
== 1.01 ==
Previous version forgot to check ip address when logged into WordPress control panel. This version corrects that. The moment you are logged in, your current IP address is sent to dpaBadBot.
== 1.02 ==
Added a better description of products offered by Software Propulsion with links to respective websites
== 1.03 ==
Changed all file names to lower case so that they will be compatible with all servers. If you are upgrading and the plugin has problems accessing files, DELETE this plugin and reinstall the plugin.
== 1.04 ==
dpaBadBot PHP program was upgraded to allow you to preview your edited posts. So this plugin had extra security feature added to work with these dpaBadBot upgrades
== 1.05 ==
Removed the check for logout as not a good idea. 
== 1.06 ==
Changed which ip address is saved. Only latest IP address is saved and all older one's are deleted.
== 1.07 ==
Added multiuser tracking.  This version to be used with version 1.06 or later or the Bad Bot Exterminator.
== 1.08 ==
Stops automatic WordPress core updates by setting filter 'auto_update_core' to '__return_false'.
== 1.09 ==
Made the PHP code more compatible with the WordPress style by using the debug setting in wp-config.php
== 1.10 ==
Corrected some bugs.  The directory name can now end with or without '/'.
== 1.11 ==
Undid some of the upgrades in 1.09 to make it less prone to spurios memory problems.
== 1.12 ==
Made some code more compatible with WordPress and checked if file existed.
== 1.13 ==
Found out that when you upgrade any plugin, WordPress will delete the existing plugin before downloading the upgrade version. Since this plugin saves all settings in the plugin directory all settings were lost upon upgrading. With version 1.13 a separate directory is created .../wp-contents/plugins/dpabadbotwpdata/ and all settings are saved in the altrnative sub-directory. Thus even after upgrading the original seetings are still available.

Changed all variable names to begin with $spmywp_.
== 1.14 ==
changed permission of .../wp-content/plugins/dpabadbotwpdata/ sub-directory to 0775 & stop recording visitors not logged in

== 1.15 ==
added display of memory in MB too.

== 1.16 ==
corrected the link to two other websites.
