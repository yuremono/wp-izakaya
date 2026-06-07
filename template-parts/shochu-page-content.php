<?php
/**
 * Shochu page content.
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
		<?php get_template_part( 'template-parts/shochu/hero' ); ?>
		<?php get_template_part( 'template-parts/shochu/introduction' ); ?>
		<?php get_template_part( 'template-parts/shochu/category-nav' ); ?>
		<?php get_template_part( 'template-parts/shochu/imo' ); ?>
		<?php get_template_part( 'template-parts/shochu/mugi' ); ?>
		<?php get_template_part( 'template-parts/shochu/kome' ); ?>
		<?php get_template_part( 'template-parts/shochu/kokuto' ); ?>
		<?php get_template_part( 'template-parts/shochu/other' ); ?>
		<?php get_template_part( 'template-parts/shochu/contact' ); ?>
		</main>
	</div>
