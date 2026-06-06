<?php
/**
 * Front page.
 *
 * @package Theme
 */

declare(strict_types=1);

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
get_template_part( 'template-parts/site-header' );
get_template_part( 'template-parts/front-page-content' );
get_template_part( 'template-parts/site-footer' );
get_footer();
