<?php
/**
 * Other page content.
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
		<?php get_template_part( 'template-parts/other/hero' ); ?>
		<?php get_template_part( 'template-parts/other/introduction' ); ?>
		<?php get_template_part( 'template-parts/other/product-list' ); ?>
		<?php get_template_part( 'template-parts/other/contact' ); ?>
		</main>
	</div>
