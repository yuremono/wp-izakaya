<?php
/**
 * Genshu page content.
 *
 * @package Izakaya
 */

declare(strict_types=1);

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
	<div id="contents" >
		<main>
		<?php get_template_part( 'template-parts/genshu/hero' ); ?>
		<?php get_template_part( 'template-parts/genshu/introduction' ); ?>
		<?php get_template_part( 'template-parts/genshu/featured-heading' ); ?>
		<?php get_template_part( 'template-parts/genshu/featured-products' ); ?>
		<?php get_template_part( 'template-parts/genshu/product-list' ); ?>
		<?php get_template_part( 'template-parts/genshu/contact' ); ?>
		</main>
	</div>
