<?php
/**
 * Plugin Name: XRP TIP BOT for WordPress
 * Plugin URI: https://wp-tipbot.com
 * Description: Displays a XRP TIP BOT button with a widget or shortcode.
 * Author: alordiel
 * Author URI: https://timelinedev.com
 * Version: 1.0.7
 * License: GPLv2 or later
 * Domain Path: /languages
 */

if (!defined('ABSPATH')) {

  exit;

}

require_once( plugin_dir_path( __FILE__ ) . 'classes/class.widget.php' );
require_once( plugin_dir_path( __FILE__ ) . 'functions/shortcode.php' );


add_action( 'plugins_loaded', 'wp_tipbot_text_domain' );
function wp_tipbot_text_domain() {

  load_plugin_textdomain( 'wp-tipbot', FALSE, basename( dirname( __FILE__ ) ) . '/languages/' );

}

add_action( 'widgets_init', 'register_xrptipbot_widget' );
function register_xrptipbot_widget() {

  register_widget( 'WP_TIPBOT_Widget' );

}


add_action('admin_menu', 'ee_add_settings_page');
function ee_add_settings_page () {
    add_submenu_page( 'options-general.php', 
    __('WP TipBot','wp-tipbot'), 
    __('WP TipBot','wp-tipbot'), 
    'manage_options', 
    'wp-tipbot',
    'wp_tipbot_settings_page'); 
}


function wp_tipbot_settings_page () {
	?>

	<div style="width:80%; margin: 0 auto;">
		<img style="display: block;margin: 20px auto;" src="<?php echo plugins_url( 'assets/images/WP-TipBot-logo.png', __FILE__ ); ?>" alt="">
		<h1 style="text-align: center;margin: 20px 0;"><?php _e('WP TipBot Details','easyexam') ?></h1>
		<p><?php _e('Here is an example how to use the shortcode:','wp-tipbot') ?></p>
		<p><pre><code>[wp-tipbot size="250" amount="0.5" receiver="WpTipbot" network="twitter" label="Tip me" labelpt="Thaaaanks" redirect="https://wp-tipbot.com/thank-you/"]</code></pre></p>
		<p>
			And here are the shortcode attributes that you can change 
			<ul>
	    <li><strong>size</strong> - Width of Button in Px (Default 250, don't include the "px" string)</li>
	    <li><strong>amount</strong> - Tip amount of XRP</li>
	    <li><strong>receiver</strong> - Username at XRP Tip Bot</li>
	    <li><strong>network</strong> - The network you used to register at XRP Tip Bot (Use: "twitter", "reddit" or "discord")</li>
	    <li><strong>label</strong> - the text before tipping</li>
	    <li><strong>labelpt</strong> - the text after tipping</li>
	    <li><strong>redirect</strong> - to redirect the user to a page after sending you a tip (not requered)</li>
		  </ul>

		</p>
		<p>If you like our plugin, please consider sharing some tips with us ;)</p>

		<?php
		echo do_shortcode( '[wp-tipbot size="250" amount="0.5" receiver="WpTipbot" network="twitter" label="Tip me" labelpt="Thaaaanks" redirect="https://wp-tipbot.com/thank-you/"]' );
		?>
		
		<p>You can follow us on <a href="https://twitter.com/WpTipbot" target="_blank" rel="nofollow noopener"> twitter (@WpTipbot)</a> or check <a href="https://wp-tipbot.com" target="_blank" rel="nofollow noopener">our website</a>.</p>
	</div>

	<?php

}