<?php
/**
 * Template Name: quests-service
 * Template Post Type: page
 *
 * @package Theme
 */

declare( strict_types=1 );

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header( 'quests' );
get_template_part( 'template-parts/quests/header' );
get_template_part( 'template-parts/quests/content', 'service' );
get_template_part( 'template-parts/quests/footer' );
get_footer( 'quests' );
