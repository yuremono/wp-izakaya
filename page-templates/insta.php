<?php
/**
 * Template Name: お知らせ
 * Template Post Type: page
 *
 * @package Kanoo
 */

declare(strict_types=1);

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
get_template_part( 'template-parts/site-header' );
get_template_part( 'template-parts/insta-page-content' );
get_template_part( 'template-parts/site-footer' );
get_footer();
