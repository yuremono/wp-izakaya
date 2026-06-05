<?php
/**
 * Theme helper functions.
 *
 * @package Theme
 */

declare(strict_types=1);

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * ACF の値が未設定かどうか。
 *
 * @param mixed $value Raw field value.
 * @return bool
 */
function theme_acf_value_absent( $value ): bool {
	if ( null === $value || '' === $value || false === $value ) {
		return true;
	}

	return is_array( $value ) && array() === $value;
}

/**
 * Cache-busting version from file modification time.
 *
 * @param string $relative_path Relative asset path.
 * @return string
 */
function theme_asset_version( string $relative_path ): string {
	$path = get_template_directory() . '/' . ltrim( $relative_path, '/' );

	return file_exists( $path ) ? (string) filemtime( $path ) : THEME_VERSION;
}
