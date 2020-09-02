<?php
/**
* Plugin Name: WP OAuth Client
* Plugin URI: 
* Description: A free solution in WordPress account authentication
* Version: 1.0
* Author: Kantraksel
* Author URI: 
* License: MIT
* License URI: 
*/

namespace OAuth2_Client;
require_once 'oauth_auth.php';

function OAuth_PluginInit() {
	add_action('init', 'OAuth2_Client\OAuth_Begin');
	add_action('init', 'OAuth2_Client\OAuth_Finish');
}

OAuth_PluginInit();
?>
