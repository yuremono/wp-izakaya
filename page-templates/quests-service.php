<?php
/**
 * Template Name: Quests Service
 * Template Post Type: page
 *
 * @package Theme
 */

declare( strict_types=1 );

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
get_template_part( 'template-parts/quests/site-header' );
get_template_part( 'template-parts/quests/service-page-content' );
get_template_part( 'template-parts/quests/site-footer' );
get_footer();
