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

		if ( is_page_template( 'page-templates/quests-service.php' ) ) {
			$classes[] = 'QuestsPageService';
		} else {
			$classes[] = 'QuestsPageTop';
			$classes[] = 'home';
		}

		return apply_filters( 'theme_quests_body_classes', $classes );
	}
}

if ( ! function_exists( 'theme_is_quests_view' ) ) {
	/**
	 * Whether the current request uses the quests design.
	 *
	 * @return bool
	 */
	function theme_is_quests_view(): bool {
		return is_front_page() || is_page_template( array( 'page-templates/quests-top.php', 'page-templates/quests-service.php' ) );
	}
}

if ( ! function_exists( 'theme_quests_meta' ) ) {
	/**
	 * Read a quests page custom field with a fallback.
	 *
	 * @param string $field_name Field name.
	 * @param mixed  $fallback   Fallback value.
	 * @return mixed
	 */
	function theme_quests_meta( string $field_name, $fallback = '' ) {
		$post_id = get_the_ID();
		if ( ! $post_id ) {
			return $fallback;
		}

		$value = function_exists( 'get_field' )
			? get_field( $field_name, $post_id )
			: get_post_meta( $post_id, $field_name, true );

		if ( function_exists( 'theme_acf_value_absent' ) && theme_acf_value_absent( $value ) ) {
			return $fallback;
		}

		return $value;
	}
}

if ( ! function_exists( 'theme_quests_text' ) ) {
	/**
	 * Echo escaped text for quests pages.
	 *
	 * @param string $field_name Field name.
	 * @param string $fallback   Fallback text.
	 */
	function theme_quests_text( string $field_name, string $fallback ): void {
		echo esc_html( (string) theme_quests_meta( $field_name, $fallback ) );
	}
}

if ( ! function_exists( 'theme_quests_lines' ) ) {
	/**
	 * Echo escaped multiline text with line breaks.
	 *
	 * @param string $field_name Field name.
	 * @param string $fallback   Fallback text.
	 */
	function theme_quests_lines( string $field_name, string $fallback ): void {
		echo nl2br( esc_html( (string) theme_quests_meta( $field_name, $fallback ) ) );
	}
}

if ( ! function_exists( 'theme_quests_allowed_html' ) ) {
	/**
	 * Allowed HTML for quests editable rich text.
	 *
	 * @return array<string, mixed>
	 */
	function theme_quests_allowed_html(): array {
		$allowed = wp_kses_allowed_html( 'post' );

		$allowed['table'] = array( 'class' => true );
		$allowed['tbody'] = array( 'class' => true );
		$allowed['tr']    = array( 'class' => true );
		$allowed['td']    = array(
			'class'   => true,
			'id'      => true,
			'colspan' => true,
			'rowspan' => true,
		);
		$allowed['span']  = array(
			'class' => true,
			'style' => true,
		);
		$allowed['br']    = array();

		return $allowed;
	}
}

if ( ! function_exists( 'theme_quests_rich' ) ) {
	/**
	 * Echo sanitized rich HTML for quests pages.
	 *
	 * @param string $field_name Field name.
	 * @param string $fallback   Fallback HTML.
	 */
	function theme_quests_rich( string $field_name, string $fallback ): void {
		echo wp_kses( (string) theme_quests_meta( $field_name, $fallback ), theme_quests_allowed_html() );
	}
}
