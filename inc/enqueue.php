<?php
/**
 * Front-end asset enqueue.
 *
 * @package Kanoo
 */

declare(strict_types=1);

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Return the page-specific stylesheet basename.
 */
function theme_page_stylesheet(): string {
	$pages = array( 'genshu', 'shochu', 'other', 'otsumami', 'insta', 'info' );

	foreach ( $pages as $page ) {
		if ( is_page_template( "page-templates/{$page}.php" ) ) {
			return "{$page}_html.css";
		}
	}

	return 'index_html.css';
}

/**
 * Enqueue front-end stylesheets and scripts.
 */
function theme_enqueue_assets(): void {
	if ( ! theme_is_custom_view() ) {
		return;
	}

	wp_enqueue_style(
		'theme-font-awesome',
		'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css',
		array(),
		'6.0.0'
	);
	wp_enqueue_style(
		'theme-line-awesome-all',
		'https://maxst.icons8.com/vue-static/landings/line-awesome/font-awesome-line-awesome/css/all.min.css',
		array(),
		'1.3.0'
	);
	wp_enqueue_style(
		'theme-line-awesome',
		'https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css',
		array( 'theme-line-awesome-all' ),
		'1.3.0'
	);
	wp_enqueue_style(
		'theme-magnific-popup',
		theme_source_uri( 'js/magnific-popup/magnific-popup.css' ),
		array(),
		theme_asset_version( 'assets/js/magnific-popup/magnific-popup.css' )
	);
	wp_enqueue_style(
		'theme-beer-slider',
		theme_source_uri( 'js/beerslider/BeerSlider.css' ),
		array( 'theme-magnific-popup' ),
		theme_asset_version( 'assets/js/beerslider/BeerSlider.css' )
	);
	wp_enqueue_style(
		'theme-slick-theme',
		theme_source_uri( 'js/slick/slick-theme.css' ),
		array( 'theme-beer-slider' ),
		theme_asset_version( 'assets/js/slick/slick-theme.css' )
	);
	wp_enqueue_style(
		'theme-slick',
		theme_source_uri( 'js/slick/slick.css' ),
		array( 'theme-slick-theme' ),
		theme_asset_version( 'assets/js/slick/slick.css' )
	);
	wp_enqueue_style(
		'theme-bxi',
		theme_source_uri( 'css/bxi.css' ),
		array( 'theme-slick' ),
		theme_asset_version( 'assets/css/bxi.css' )
	);

	$page_stylesheet = theme_page_stylesheet();
	wp_enqueue_style(
		'theme-page',
		theme_source_uri( 'css/' . $page_stylesheet ),
		array( 'theme-bxi' ),
		theme_asset_version( 'assets/css/' . $page_stylesheet )
	);
	wp_enqueue_style(
		'theme-common',
		theme_source_uri( 'css/common.css' ),
		array( 'theme-page' ),
		theme_asset_version( 'assets/css/common.css' )
	);
	wp_enqueue_style(
		'theme-common-style',
		theme_source_uri( 'css/common_style.css' ),
		array( 'theme-common' ),
		theme_asset_version( 'assets/css/common_style.css' )
	);
	wp_enqueue_style(
		'theme-static-style',
		theme_source_uri( 'css/style.css' ),
		array( 'theme-common-style' ),
		theme_asset_version( 'assets/css/style.css' )
	);

	wp_enqueue_script( 'jquery' );
	wp_add_inline_script( 'jquery', 'window.$ = window.jQuery;', 'after' );
	wp_enqueue_script(
		'theme-magnific-popup',
		theme_source_uri( 'js/magnific-popup/jquery.magnific-popup.min.js' ),
		array( 'jquery' ),
		theme_asset_version( 'assets/js/magnific-popup/jquery.magnific-popup.min.js' ),
		true
	);
	wp_enqueue_script(
		'theme-beer-slider',
		theme_source_uri( 'js/beerslider/BeerSlider.js' ),
		array(),
		theme_asset_version( 'assets/js/beerslider/BeerSlider.js' ),
		true
	);
	wp_enqueue_script(
		'theme-slick',
		theme_source_uri( 'js/slick/slick.min.js' ),
		array( 'jquery' ),
		theme_asset_version( 'assets/js/slick/slick.min.js' ),
		true
	);
	wp_enqueue_script(
		'theme-function',
		theme_source_uri( 'js/function.js' ),
		array( 'jquery', 'theme-magnific-popup', 'theme-slick' ),
		theme_asset_version( 'assets/js/function.js' ),
		true
	);
	wp_enqueue_script(
		'theme-bxi',
		theme_source_uri( 'js/bxi.js' ),
		array( 'jquery', 'theme-function' ),
		theme_asset_version( 'assets/js/bxi.js' ),
		true
	);
	wp_enqueue_script(
		'theme-flipsnap',
		theme_source_uri( 'js/flipsnap.min.js' ),
		array( 'theme-bxi' ),
		theme_asset_version( 'assets/js/flipsnap.min.js' ),
		true
	);
	wp_enqueue_script(
		'theme-viewport-extra',
		'https://cdn.jsdelivr.net/npm/viewport-extra@1.0.2/dist/viewport-extra.min.js',
		array( 'theme-flipsnap' ),
		'1.0.2',
		true
	);
}
add_action( 'wp_enqueue_scripts', 'theme_enqueue_assets' );
