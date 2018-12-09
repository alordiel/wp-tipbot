<?php

// [wp-tipbot size="200" amount="0.5" receiver="alordiel" network="reddit" label="Tip me" labelpt="Thaaaanks" redirect="https://wp-tipbot.com/thank-you/"]
add_shortcode( 'wp-tipbot', 'wp_tipbot_shortcode' );
function wp_tipbot_shortcode( $atts ) {
	
	$a = shortcode_atts( array(
		'title' => esc_html__( 'WP TIPBOT', 'wp-tipbot' ),
		'amount' => '',
		'network' => '',
		'receiver' => '',
		'label' => '',
		'size' => '',
		'labelpt' => '',
		'redirect' => 'https://wp-tipbot.com/thank-you/',
	), $atts );

	$settings = get_option('wp_tipbot_settings', false);
	$settings = (	$settings != false) ? unserialize($settings) : [];

	$amount = !empty ($atts['amount']) ? $atts['amount'] : '';
	$size = !empty ($atts['size']) ? $atts['size'] : '';
	$receiver = !empty ($atts['receiver']) ? $atts['receiver'] : '';
	$network = !empty ($atts['network']) ? $atts['network'] : '';

	$label = (!empty($atts['label'])) ?  "label='{$atts['label']}'"  : '';
	$labelpt = (!empty($atts['labelpt'])) ? "labelpt='{$atts['labelpt']}'"  : '';
	$redirect = (!empty($atts['redirect'])) ? "redirect='{$atts['redirect']}'"  : '';

	$size = ( $size == '' && !empty($settings['size']) ) ? $settings['size'] : 250;
	$amount = ( $amount == '' && !empty($settings['amount']) ) ? $settings['amount'] : 1;
	$receiver = ( $receiver == '' && !empty($settings['receiver']) ) ? $settings['receiver'] : '';
	$network = ( $network == '' && !empty($settings['network']) ) ? $settings['network'] : 'twitter';
	
	$label = ( $label == '' && !empty($settings['label']) ) ?  "label='{$settings['label']}'" : '';
	$labelpt = ( $labelpt == '' && !empty($settings['labelpt']) ) ? "labelpt='{$settings['labelpt']}'" : '';
	$redirect = ( $redirect == '' && !empty($settings['redirect']) ) ? "redirect='{$settings['redirect']}'" : '';

	$output = "<div class='wp-tipbot-container'>
		<a
			amount='".$amount."'
			size='".$size."'
			to='".$receiver."'
			network='".$network."'
			href='https://www.xrptipbot.com'
			target='_blank' 
			$label 
			$labelpt 
			$redirect >
		</a>
	</div>
	<script async src='https://www.xrptipbot.com/static/donate/tipper.js' charset='utf-8'></script>";

	return $output;

}
