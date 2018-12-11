<?php 

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

	$settings = get_option('wp_tipbot_settings', false);
	$settings = (	$settings != false) ? unserialize($settings) : [];

	if (!empty($_POST) && count($_POST) > 0) {

		if ( isset($_POST['size']) ){
			$settings['size'] = intval( $_POST['size'] );
		}

		if ( isset($_POST['amount']) ){
			$settings['amount'] = floatval( $_POST['amount'] );
		}

		if ( isset($_POST['receiver']) ){
			$settings['receiver'] = sanitize_text_field( $_POST['receiver'] );
		}

		if ( isset($_POST['network']) ){
			$settings['network'] = sanitize_text_field( $_POST['network'] );
		}

		if ( isset($_POST['label']) ){
			$settings['label'] = sanitize_text_field( $_POST['label'] );
		}

		if ( isset($_POST['labelpt']) ){
			$settings['labelpt'] = sanitize_text_field( $_POST['labelpt'] );
		}

		if ( isset($_POST['redirect']) ){
			$settings['redirect'] = sanitize_text_field( $_POST['redirect'] );
		}

		update_option( 'wp_tipbot_settings', serialize($settings) );

	}
	
	$size = !empty($settings['size']) ? $settings['size'] : 250;
	$amount = !empty($settings['amount']) ? $settings['amount'] : 1;
	$receiver = !empty($settings['receiver']) ? $settings['receiver'] : '';
	$network = !empty($settings['network']) ? $settings['network'] : 'twitter';
	$label = !empty($settings['label']) ? $settings['label'] : '';
	$labelpt = !empty($settings['labelpt']) ? $settings['labelpt'] : '';
	$redirect = !empty($settings['redirect']) ? $settings['redirect'] : '';

	?>

	<div class="tipbot-container">

		<img style="display: block;margin: 20px auto;" src="<?php echo plugins_url( '../assets/images/WP-TipBot-logo.png', __FILE__ ); ?>" alt="">
		<h1 style="text-align: center;margin: 20px 0;"><?php _e('WP TipBot Details','wp-tipbot') ?></h1>

		<ul class="tipbot-tabs">
			<li class="active" data-activate-tab='tipbot-settings'><?php _e('Main settings','wp-tipbot');?> </li>

			<?php if ($receiver != '' && $network != '') { ?>
				<li data-activate-tab='tipbot-balance'><?php _e('Balance','wp-tipbot');?> </li>
			<?php } ?>

			<li data-activate-tab='tipbot-help'><?php _e('Support','wp-tipbot');?> </li>
			<li data-activate-tab='tipbot-donations'><?php _e('Tips','wp-tipbot');?> </li>
		</ul>

		<div class="tab-member tipbot-settings active">
			<?php _e('Setting below will open a new tab in the current page with your XRPTIPBOT balance. Also you can use the shortcode as <code>[wp-tipbot]</code> without setting any') ?>
			<form name="form1" method="post" action="">
				<!-- Size -->
				<p>
					<label for="wp-tipbot-size"><?php esc_html_e( 'Button size:', 'wp-tipbot' ); ?></label>
					<input class="widefat" id="wp-tipbot-size" name="size" type="number" min="0" value="<?php echo esc_attr( $size ); ?>" style="width:150px;"/> px
				</p>
				
				<!-- Ammount -->
				<p>
					<label for="wp-tipbot-amount"><?php esc_html_e( 'Tips amount:', 'wp-tipbot' ); ?></label>
					<input class="widefat" id="wp-tipbot-amount" name="amount" type="text" value="<?php echo esc_attr($amount); ?>" step="0.1" style="width:150px;"/> XRP
				</p>
				
				<!-- Account type -->
				<p>
					<label style="min-width: 200px" for="wp-tipbot-network"><?php esc_html_e( 'Network:', 'wp-tipbot' ); ?></label>
					<select name="network" id="wp-tipbot-network"  style="width:250px;">
						<option <?php if ($network=="twitter") echo 'selected' ?> value="twitter">Twitter</option>
						<option <?php if ($network=="reddit") echo 'selected' ?> value="reddit">reddit</option>
						<option <?php if ($network=="discord") echo 'selected' ?> value="discord">Discord</option>
					</select>
				</p>

				<!-- Receiver -->
				<p>
					<label for="wp-tipbot-receiver"><?php esc_html_e( 'Receiver Username:', 'wp-tipbot' ); ?></label>
					<input class="widefat" id="wp-tipbot-receiver" name="receiver" type="text" value="<?php echo esc_attr($receiver); ?>"  style="width:250px;"/>
				</p>
				
				<!-- Button Label -->
				<p>
					<label style="min-width: 200px" for="wp-tipbot-label"><?php esc_html_e( 'Button label:', 'wp-tipbot' ); ?></label>
					<input class="widefat" id="wp-tipbot-label" name="label" type="text" value="<?php echo esc_attr($label); ?>"  style="width:250px;"/>
				</p>
				
				<!-- Thank you message -->
				<p>
					<label style="min-width: 200px" for="wp-tipbot-labelpt"><?php esc_html_e( 'Thank you message:', 'wp-tipbot' ); ?></label>
					<input  style="width:250px;" class="widefat" id="wp-tipbot-labelpt" name="labelpt" type="text" value="<?php echo esc_attr($labelpt); ?>"/>
				</p>

				<!-- Redirect Link -->
				<p>
					<label style="min-width: 200px" for="wp-tipbot-redirect"><?php esc_html_e( 'Redirect url:', 'wp-tipbot' ); ?></label>
					<input  style="width:250px;" class="widefat" id="wp-tipbot-redirect" name="redirect" type="text" value="<?php echo esc_attr($redirect); ?>"/>
				</p>
				<p class="submit">
					<input type="submit" name="submit" id="submit" class="button button-primary" value="<?php esc_html_e( 'Save Changes', 'wp-tipbot' ); ?>">
				</p>
			</form>
		</div>
		
		<?php if ($receiver != '' && $network != '') { ?>

			<div class="tab-member tipbot-balance">
				<iframe style="width: 100%; min-height: 500px;height: auto;" src="https://www.xrptipbot.com/u:<?php echo $receiver ?>/n:<?php echo $network ?>" frameborder="0"></iframe>
			</div>

		<?php } ?>

		<div class="tab-member tipbot-help">
			<h2><?php _e('How to use the shortcode?','easyexam') ?></h2>
				<p><?php _e('Here is an example how to it:','wp-tipbot') ?></p>
				<p><pre><code>[wp-tipbot size="250" amount="0.5" receiver="WpTipbot" network="twitter" label="Tip me" labelpt="Thaaaanks" redirect="https://wp-tipbot.com/thank-you/"]</code></pre></p>
				<p>
					<?php _e('And here are the shortcode attributes that you can change:','wp-tipbot'); ?>	
					<ul>
			    <li><strong>size</strong> - <?php _e('Width of Button in Px (Default 250, don\'t include the "px" string)','wp-tipbot'); ?></li>
			    <li><strong>amount</strong> - <?php _e('Tip amount of XRP','wp-tipbot'); ?></li>
			    <li><strong>receiver</strong> - <?php _e('Username at XRP Tip Bot','wp-tipbot'); ?></li>
			    <li><strong>network</strong> - <?php _e('The network you used to register at XRP Tip Bot (Use: "twitter", "reddit" or "discord")','wp-tipbot'); ?></li>
			    <li><strong>label</strong> - <?php _e('the text before tipping','wp-tipbot'); ?></li>
			    <li><strong>labelpt</strong> - <?php _e('the text after tipping','wp-tipbot'); ?></li>
			    <li><strong>redirect</strong> - <?php _e('to redirect the user to a page after sending you a tip (not requered)','wp-tipbot'); ?></li>
				  </ul>
				</p>
				<p><b><?php _e('Note:','wp-tipbot') ?></b> <?php _e('You can use the simplified version [wp-tipbot] when you have saved the settings from the previous tab. Those settings will be used by default if you are missing some of the attributes of the shortcode.','wp-tipbot') ?></p>
				<br>
				<p><?php echo sprintf(__('For bugs and other support questions - please use the <a href="%s">WordPress Support forum</a>.','wp-tipbot'),'https://wordpress.org/support/plugin/wp-tipbot'); ?></p>
		</div>

		<div class="tab-member tipbot-donations">
			<p>Do you find our plugin very useful for your website? Do you want to share your story with us about it? <br>We are opened for your case of use on our <a href="https://wp-tipbot.com/story">website</a>. Sharing your story with us is a win-win - we will post it on our blog and twitter and you will get some extra attention from the community. </p>

			<p>And if you like our plugin, please consider sharing some tips with us</p>

			<?php
			echo do_shortcode( '[wp-tipbot size="250" amount="0.5" receiver="WpTipbot" network="twitter" label="Tip me" labelpt="Thaaaanks" redirect="https://wp-tipbot.com/thank-you/"]' );
			?>
			
			<p>You can follow us on <a href="https://twitter.com/WpTipbot" target="_blank" rel="nofollow noopener"> twitter (@WpTipbot)</a> or check <a href="https://wp-tipbot.com" target="_blank" rel="nofollow noopener">our website</a>.</p>

		</div>
	</div>

	<script>

		jQuery( function($) {
			$('.tipbot-tabs li').on('click', function () {
				$('.tipbot-tabs li.active').removeClass('active');
				$('.tab-member.active').removeClass('active');
				$(this).addClass('active');
				let showTab = $(this).data('activate-tab');
				$('.'+showTab).addClass('active');
			});
		});

	</script>

	<style>
		.tipbot-container {
			width:80%;
			margin: 0 auto;
			font-size: 1rem;
		}
		p,label {
			font-size: 1rem;
		}
		.tipbot-settings label {
			display: inline-block;
			min-width: 200px;
		}
		.tipbot-tabs {
		  display: flex;
		  flex-wrap: wrap;
		  border-bottom: 1px solid #ccc;
		}

		.tipbot-tabs li {
		  border: 1px solid #ccc;
		  border-bottom: none;
		  margin: 10px 15px 0 9px;
		  padding: 5px 10px;
		  font-size: 1rem;
		  cursor: pointer;
		}
		.tipbot-tabs .active {
		    background: #fff;
		}
		.tab-member{
			display: none;
		}

		.tab-member.active{
			display: block;
		}
	</style>
	<?php

}