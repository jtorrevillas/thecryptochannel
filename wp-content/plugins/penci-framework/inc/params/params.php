<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

remove_action( 'admin_footer', 'vc_loop_include_templates',1 );
add_action( 'wp_ajax_vc_edit_form', 'penci_remove_shortcode_param_loop', 1 );
if ( ! function_exists( 'penci_remove_shortcode_param_loop' ) ) {
	function penci_remove_shortcode_param_loop() {
		global $vc_params_list;

		$key = array_search( 'loop', $vc_params_list );
		if ( $key !== false ) {
			unset( $vc_params_list[ $key ] );
		}

	}
}

// Constants for admin scripts.
define( 'PENCI_VC_PARAMS_URL', trailingslashit( plugins_url( 'params', dirname( __FILE__ ) ) ) );

// Load all params.
$dirs = glob( dirname( __FILE__ ) . '/*', GLOB_ONLYDIR );
foreach ( $dirs as $dir ) {
	// Load param callback functions.
	$param = basename( $dir );
	require_once "$dir/register.php";

	// Register param.

	if( 'loop' == $param ) {
		vc_add_shortcode_param( "$param", "penci_vc_param_$param" );
	}else{
		vc_add_shortcode_param( "penci_$param", "penci_vc_param_$param" );
	}

}

// Custom width 
$group_name = 'Custom width';
vc_add_params( 'vc_row',array(
	array(
		'type'       => 'dropdown',
		'heading'    => esc_html__( 'Choose with container', 'penci-framework' ),
		'param_name' => 'penci_el_width',
		'value'      => array(
			esc_html__( 'Full width', 'penci-framework' )                        => '',
			esc_html__( 'Container ( width: 1080px )', 'penci-framework' )       => 'width-1080',
			esc_html__( 'Container fluid ( width: 1400px )', 'penci-framework' ) => 'width-1400',
			esc_html__( 'Custom width', 'penci-framework' )                      => 'custom',
		),
		"group" => $group_name,
	),
	array(
		'type'       => 'penci_only_number',
		'heading'    => esc_html__( 'Custom width', 'penci-framework' ),
		'param_name' => 'penci_el_width_custom',
		'value'      => '1400',
		'min'        => 1,
		'max'        => 1920,
		'suffix'     => 'px',
		'dependency' => array( 'element' => 'penci_el_width', 'value' => array( 'custom' ) ),
		"group" => $group_name,
	),
	array(
		'type'       => 'dropdown',
		'heading'    => esc_html__( 'Choose position row', 'penci-framework' ),
		'param_name' => 'penci_el_pos',
		'value'      => array(
			esc_html__( 'Left', 'penci-framework' )   => 'left',
			esc_html__( 'Center', 'penci-framework' ) => 'center',
			esc_html__( 'Right', 'penci-framework' )  => 'right',
		),
		"group" => $group_name,
	)
) );