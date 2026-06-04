<?php
/**
 * Quests shared helpers.
 *
 * @package Theme
 */

declare( strict_types=1 );

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'theme_quests_source_uri' ) ) {
	/**
	 * Get a URI inside the copied quests asset tree.
	 *
	 * @param string $relative Relative path under assets/quests.
	 * @return string
	 */
	function theme_quests_source_uri( string $relative = '' ): string {
		$base = trailingslashit( get_theme_file_uri( 'assets/quests' ) );

		return $base . ltrim( $relative, '/' );
	}
}

if ( ! function_exists( 'theme_quests_body_classes' ) ) {
	/**
	 * Get body classes for quests pages.
	 *
	 * @return array<int, string>
	 */
	function theme_quests_body_classes(): array {
		$classes = array( 'QuestsPage' );

		if ( is_page_template( 'page-templates/page-quests-service.php' ) ) {
			$classes[] = 'QuestsPageService';
		} else {
			$classes[] = 'QuestsPageTop';
			$classes[] = 'home';
		}

		return apply_filters( 'theme_quests_body_classes', $classes );
	}
}
