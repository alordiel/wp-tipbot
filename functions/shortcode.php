<?php

// [wp-tipbot size="200" amount="0.5" receiver="alordiel" network="reddit" label="Tip me" labelpt="Thaaaanks" redirect="https://wp-tipbot.com/thank-you/"]
add_shortcode( 'wp-tipbot', 'wp_tipbot_shortcode' );
function wp_tipbot_shortcode( $atts ) {
	
	$a = shortcode_atts( array(
		'title' => esc_html__( 'WP TIPBOT', 'wp-tipbot' ),
		'amount' => 1,
		'network' => 'twitter',
		'receiver' => '',
		'label' => '',
		'size' => '',
		'labelpt' => '',
		'redirect' => 'https://wp-tipbot.com/thank-you/',
	), $atts );

	$label = (!empty($atts['label'])) ?  "label='{$atts['label']}'"  : '';
	$labelpt = (!empty($atts['labelpt'])) ? "labelpt='{$atts['labelpt']}'"  : '';
	$redirect = (!empty($atts['redirect'])) ? "redirect='{$atts['redirect']}'"  : '';
	$output = "<div class='wp-tipbot-container'>
		<a
			amount='".$atts['amount']."'
			size='".$atts['size']."'
			to='".$atts['receiver']."'
			network='".$atts['network']."'
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
