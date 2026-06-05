<?php
/**
 * Front-end asset enqueue.
 *
 * @package Theme
 */

declare(strict_types=1);

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Enqueue front-end stylesheet and scripts.
 */
function theme_enqueue_assets(): void {
	if ( theme_is_quests_view() ) {
		wp_enqueue_style(
			'theme-quests-yakuhanjp',
			'https://cdn.jsdelivr.net/npm/yakuhanjp@3.4.1/dist/css/yakuhanjp-narrow.min.css',
			array(),
			'3.4.1'
		);

			wp_enqueue_style(
				'theme-quests-line-awesome-all',
				'https://maxst.icons8.com/vue-static/landings/line-awesome/font-awesome-line-awesome/css/all.min.css',
				array(),
				'1.3.0'
			);

		wp_enqueue_style(
			'theme-quests-line-awesome',
			'https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css',
			array( 'theme-quests-line-awesome-all' ),
			'1.3.0'
		);

			wp_enqueue_style(
				'theme-quests-google-fonts',
				'https://fonts.googleapis.com/css2?family=Lato:wght@100;300;400;700;900&family=Sawarabi+Gothic&display=swap',
				array(),
				THEME_VERSION
			);
		wp_enqueue_style(
			'theme-quests-magnific-popup',
			get_template_directory_uri() . '/assets/quests/js/magnific-popup/magnific-popup.css',
			array(),
			theme_asset_version( 'assets/quests/js/magnific-popup/magnific-popup.css' )
		);

		wp_enqueue_style(
			'theme-quests-scroll-hint',
			get_template_directory_uri() . '/assets/quests/js/scroll-hint/scroll-hint.css',
			array( 'theme-quests-magnific-popup' ),
			theme_asset_version( 'assets/quests/js/scroll-hint/scroll-hint.css' )
		);

		wp_enqueue_style(
			'theme-quests-slick-theme',
			get_template_directory_uri() . '/assets/quests/js/slick/slick-theme.css',
			array( 'theme-quests-scroll-hint' ),
			theme_asset_version( 'assets/quests/js/slick/slick-theme.css' )
		);

		wp_enqueue_style(
			'theme-quests-slick',
			get_template_directory_uri() . '/assets/quests/js/slick/slick.css',
			array( 'theme-quests-slick-theme' ),
			theme_asset_version( 'assets/quests/js/slick/slick.css' )
		);

		wp_enqueue_style(
			'theme-quests-bxi',
			get_template_directory_uri() . '/assets/quests/css/bxi.css',
			array( 'theme-quests-slick' ),
			theme_asset_version( 'assets/quests/css/bxi.css' )
		);

		if ( is_front_page() || is_page_template( 'page-templates/quests-top.php' ) ) {
			wp_enqueue_style(
				'theme-quests-index',
				get_template_directory_uri() . '/assets/quests/css/index_html.css',
				array( 'theme-quests-bxi' ),
				theme_asset_version( 'assets/quests/css/index_html.css' )
			);
		}

		if ( is_page_template( 'page-templates/quests-service.php' ) ) {
			wp_enqueue_style(
				'theme-quests-service',
				get_template_directory_uri() . '/assets/quests/css/service_html.css',
				array( 'theme-quests-bxi' ),
				theme_asset_version( 'assets/quests/css/service_html.css' )
			);
		}

		wp_enqueue_style(
			'theme-quests-common',
			get_template_directory_uri() . '/assets/quests/css/common.css',
			array( is_page_template( 'page-templates/quests-service.php' ) ? 'theme-quests-service' : 'theme-quests-index' ),
			theme_asset_version( 'assets/quests/css/common.css' )
		);

		wp_enqueue_style(
			'theme-quests-common-style',
			get_template_directory_uri() . '/assets/quests/css/common_style.css',
			array( 'theme-quests-common' ),
			theme_asset_version( 'assets/quests/css/common_style.css' )
		);

		wp_enqueue_style(
			'theme-quests-style',
			get_template_directory_uri() . '/assets/quests/css/style.css',
			array( 'theme-quests-common-style' ),
			theme_asset_version( 'assets/quests/css/style.css' )
		);

		wp_enqueue_script( 'jquery' );
		wp_add_inline_script( 'jquery', 'window.$ = window.jQuery;', 'after' );

		wp_enqueue_script(
			'theme-quests-lenis',
			'https://cdn.jsdelivr.net/gh/studio-freight/lenis@1.0.25/bundled/lenis.min.js',
			array(),
			'1.0.25',
			true
		);

		wp_enqueue_script(
			'theme-quests-gsap',
			'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js',
			array(),
			'3.12.2',
			true
		);

		wp_enqueue_script(
			'theme-quests-gsap-scrolltrigger',
			'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js',
			array( 'theme-quests-gsap' ),
			'3.12.2',
			true
		);

		wp_enqueue_script(
			'theme-quests-slick',
			get_template_directory_uri() . '/assets/quests/js/slick/slick.min.js',
			array( 'jquery' ),
			theme_asset_version( 'assets/quests/js/slick/slick.min.js' ),
			true
		);

		wp_enqueue_script(
			'theme-quests-magnific-popup',
			get_template_directory_uri() . '/assets/quests/js/magnific-popup/jquery.magnific-popup.min.js',
			array( 'jquery' ),
			theme_asset_version( 'assets/quests/js/magnific-popup/jquery.magnific-popup.min.js' ),
			true
		);

		wp_enqueue_script(
			'theme-quests-scroll-hint',
			get_template_directory_uri() . '/assets/quests/js/scroll-hint/scroll-hint.min.js',
			array(),
			theme_asset_version( 'assets/quests/js/scroll-hint/scroll-hint.min.js' ),
			true
		);

		wp_enqueue_script(
			'theme-quests-flipsnap',
			get_template_directory_uri() . '/assets/quests/js/flipsnap.min.js',
			array(),
			theme_asset_version( 'assets/quests/js/flipsnap.min.js' ),
			true
		);

		wp_enqueue_script(
			'theme-quests-function',
			get_template_directory_uri() . '/assets/quests/js/function.js',
			array(
				'jquery',
				'theme-quests-lenis',
				'theme-quests-gsap',
				'theme-quests-gsap-scrolltrigger',
				'theme-quests-slick',
				'theme-quests-magnific-popup',
				'theme-quests-scroll-hint',
				'theme-quests-flipsnap',
			),
			theme_asset_version( 'assets/quests/js/function.js' ),
			true
		);

		wp_enqueue_script(
			'theme-quests-bxi',
			get_template_directory_uri() . '/assets/quests/js/bxi.js',
			array( 'jquery', 'theme-quests-function', 'theme-quests-flipsnap' ),
			theme_asset_version( 'assets/quests/js/bxi.js' ),
			true
		);
	}

}
add_action( 'wp_enqueue_scripts', 'theme_enqueue_assets' );
