<?php
/**
 * Template Name: 焼酎の原酒
 * Template Post Type: page
 *
 * @package Izakaya
 */

declare(strict_types=1);

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


get_header();
get_template_part( 'template-parts/site-header' );
get_template_part( 'template-parts/genshu-page-content' );
get_template_part( 'template-parts/site-footer' );
get_footer();
