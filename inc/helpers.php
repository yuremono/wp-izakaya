<?php
/**
 * テーマ共通の補助関数。
 *
 * @package Theme
 */

declare(strict_types=1);

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * テーマ内の相対パスを正規化する。
 *
 * @param string $relative_path 相対パス。
 * @return string
 */
function theme_normalize_relative_path( string $relative_path ): string {
	$path = trim( $relative_path );
	if ( '' === $path ) {
		return '';
	}

	return ltrim( str_replace( '\\', '/', $path ), '/' );
}

/**
 * ACF の値が未設定かどうかを判定する。
 *
 * @param mixed $value 生のフィールド値。
 * @return bool
 */
function theme_acf_value_absent( $value ): bool {
	if ( null === $value || '' === $value || false === $value ) {
		return true;
	}

	return is_array( $value ) && array() === $value;
}

/**
 * ファイル更新時刻を使ったキャッシュ回避用バージョンを返す。
 *
 * @param string $relative_path 相対資産パス。
 * @return string
 */
function theme_asset_version( string $relative_path ): string {
	$path = get_template_directory() . '/' . theme_normalize_relative_path( $relative_path );

	return file_exists( $path ) ? (string) filemtime( $path ) : THEME_VERSION;
}
