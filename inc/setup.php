<?php
/**
 * Theme setup.
 *
 * @package Theme
 */

declare(strict_types=1);

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Theme supports and menus.
 */
function theme_setup(): void {
	load_theme_textdomain( THEME_GETTEXT_DOMAIN, get_template_directory() . '/languages' );

	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support(
		'html5',
		array(
			'caption',
			'gallery',
			'script',
			'style',
		)
	);
}
add_action( 'after_setup_theme', 'theme_setup' );
