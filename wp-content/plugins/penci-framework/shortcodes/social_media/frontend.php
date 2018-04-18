<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

if ( ! function_exists( 'penci_list_socail_media' ) ) {
	return;
}

$unique_id = 'penci_social_media__' . rand( 1000, 100000000 );

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );

$class = 'penci-social-media-shortcode';
$class .= $atts['_pos'] ? ' align-' . esc_attr( $atts['_pos'] ) : '';
$class .= $atts['_icon_style'] ? ' penci-social-media-sc-' . esc_attr( $atts['_icon_style'] ) : '';
$class .= $this->getExtraClass( $atts['class'] );
$class .= $this->getCSSAnimation( $atts['css_animation'] );

?>
<div id="<?php echo esc_attr( $unique_id ); ?>" class="<?php echo esc_attr( $class ); ?>">
	<div class="penci-social-media-inner">
		<?php penci_list_socail_media(); ?>
	</div>
	<?php
	$id_socail_media = '#' . $unique_id;
	$css_custom      = '';

	$css_icon = '';

	if ( $atts['_icon_width'] ) {
		$css_icon .= 'width:' . esc_attr( $atts['_icon_width'] ) . 'px; height: ' . esc_attr( $atts['_icon_width'] ) . 'px;';
	}

	if ( $atts['_icon_border_w'] ) {
		$css_icon .= 'border-width: ' . esc_attr( $atts['_icon_border_w'] ) . 'px;';

		$icon_width = intval( $atts['_icon_width'] ? $atts['_icon_width'] : 44 );

		$line_height = $icon_width - ( intval( $atts['_icon_border_w'] ) * 2 );

		$css_icon .= 'line-height: ' . $line_height . 'px;';
	}

	if ( $atts['font_size'] ) {
		$css_icon .= 'font-size: ' . esc_attr( $atts['font_size'] ) . ';';
	}

	if ( $atts['social_space'] ) {
		$css_icon .= 'margin-right: ' . esc_attr( $atts['social_space'] ) . ';';
	}

	if ( $atts['icon_color'] ) {
		$css_icon .= 'color: ' . esc_attr( $atts['icon_color'] ) . ';';
	}

	if ( $atts['icon_bgcolor'] ) {
		$css_icon .= 'background-color: ' . esc_attr( $atts['icon_bgcolor'] ) . ';';
	}

	if ( $atts['icon_border_color'] ) {
		$css_icon .= 'border-color: ' . esc_attr( $atts['icon_border_color'] ) . ';';
	}

	if ( $css_icon ) {
		$css_custom .= $id_socail_media . ' .social-media-item{ ' . $css_icon . ' }';
	}

	$css_icon_hover = '';

	if ( $atts['icon_hover_color'] ) {
		$css_icon_hover .= 'color: ' . esc_attr( $atts['icon_hover_color'] ) . ';';
	}

	if ( $atts['icon_hover_bgcolor'] ) {
		$css_icon_hover .= 'background-color: ' . esc_attr( $atts['icon_hover_bgcolor'] ) . ';';
	}

	if ( $atts['icon_hover_border_color'] ) {
		$css_icon_hover .= 'border-color: ' . esc_attr( $atts['icon_hover_border_color'] ) . ';';
	}

	if ( $css_icon_hover ) {
		$css_custom .= $id_socail_media . ' .social-media-item:hover{ ' . $css_icon_hover . ' }';
	}

	if ( $css_custom ) {
		echo '<style>';
		echo $css_custom;
		echo '</style>';
	}
	?>
</div>


