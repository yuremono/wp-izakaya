<?php
/**
 * Otsumami page content.
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
		<?php get_template_part( 'template-parts/otsumami/hero' ); ?>
		<?php get_template_part( 'template-parts/otsumami/charcoal-introduction' ); ?>
		<?php get_template_part( 'template-parts/otsumami/charcoal-menu' ); ?>
		<?php get_template_part( 'template-parts/otsumami/featured-dishes' ); ?>
		<?php get_template_part( 'template-parts/otsumami/other-menu' ); ?>
		<?php get_template_part( 'template-parts/otsumami/contact' ); ?>
		</main>
	</div>
