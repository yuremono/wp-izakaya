<?php
/**
 * Template Name: 店舗案内
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
get_template_part( 'template-parts/info-page-content' );
get_template_part( 'template-parts/site-footer' );
get_footer();
