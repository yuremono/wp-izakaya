<?php
/**
 * Info page content.
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
		<?php get_template_part( 'template-parts/info/hero' ); ?>
		<?php get_template_part( 'template-parts/info/overview-heading' ); ?>
		<?php get_template_part( 'template-parts/info/overview' ); ?>
		<?php get_template_part( 'template-parts/info/gallery' ); ?>
		<?php get_template_part( 'template-parts/info/access' ); ?>
		</main>
	</div>
