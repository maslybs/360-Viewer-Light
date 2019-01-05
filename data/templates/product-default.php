<?php
/**
 * User: elanta https://codecanyon.net/user/elanta/portfolio
 * Date: 27.12.2018
 *
 * @package ELANTA_VIEWER/ProductTemplate
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

if ( empty( $marker['product_id'] ) ) {
	return;
}

if ( function_exists( 'wc_get_product' ) ) {
	$product = wc_get_product( $marker['product_id'] );
}
?>
<div class="psv-marker-product-wrap">

    <div class="psv-marker-product default">

        <h3 class="psv-marker-product-title">
			<?php echo esc_html( get_the_title( $marker['product_id'] ) ); ?>
        </h3>

        <div class="psv-marker-product-short">
			<?php echo wp_kses_post( apply_filters( 'widget_text_content', get_the_excerpt( $marker['product_id'] ) ) ); ?>
        </div>

		<?php if ( function_exists( 'wc_get_product' ) && is_object( $product ) ) : ?>
            <div class="psv-marker-product-price">
				<?php echo wp_kses_post( $product->get_price_html() ); ?>
            </div>
		<?php endif; ?>

    </div>
</div>
