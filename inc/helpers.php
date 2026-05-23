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
 * ヘッダー／フッター等の表示名（投稿タイトルとは独立）。
 */
function theme_brand(): string {
	return (string) apply_filters( 'theme_brand', THEME_BRAND_DEFAULT );
}

/**
 * Front page ID for shared footer/header strings.
 */
function theme_front_page_id(): int {
	if ( (string) get_option( 'show_on_front' ) !== 'page' ) {
		return 0;
	}
	$pid = (int) get_option( 'page_on_front' );
	return $pid > 0 ? $pid : 0;
}

/**
 * ACF の値が「未設定」かどうか。
 *
 * @param mixed $value Raw field value.
 */
function theme_acf_value_absent( $value ): bool {
	if ( null === $value || '' === $value || false === $value ) {
		return true;
	}
	if ( is_array( $value ) && array() === $value ) {
		return true;
	}
	return false;
}

/**
 * フロント固定ページの ACF 用キー一覧（コーポレート用・レガシー alias）。
 *
 * @param string $canonical_name Canonical field name.
 * @return array<int, string>
 */
function theme_front_meta_field_keys( string $canonical_name ): array {
	static $legacy = array(
		'tagline'                => 'tagline',
		'hero_kicker'            => 'hero_kicker',
		'hero_title'             => 'hero_title',
		'hero_lead'              => 'hero_lead',
		'hero_image'             => 'hero_image',
		'services_heading'       => 'services_heading',
		'service_1_title'        => 'svc1_title',
		'service_1_body'         => 'svc1_body',
		'service_1_image'        => 'svc1_image',
		'service_2_title'        => 'svc2_title',
		'service_2_body'         => 'svc2_body',
		'service_2_image'        => 'svc2_image',
		'service_3_title'        => 'svc3_title',
		'service_3_body'         => 'svc3_body',
		'service_3_image'        => 'svc3_image',
		'highlight_show'         => 'highlight_show',
		'highlight_heading'      => 'highlight_heading',
		'highlight_body'         => 'highlight_body',
		'highlight_image'        => 'highlight_image',
		'footer_contact_show'    => 'footer_show',
		'footer_contact_heading' => 'footer_heading',
		'footer_contact_body'    => 'footer_body',
		'footer_phone'           => 'footer_phone',
		'footer_email'           => 'footer_email',
		'cta_strip_show'         => 'cta_secondary_show',
		'cta_strip_heading'      => 'cta_secondary_title',
		'cta_strip_body'         => 'cta_secondary_text',
		'cta_strip_button_label' => 'cta_secondary_btn_label',
		'cta_strip_button_url'   => 'cta_secondary_btn_url',
		'posts_count'            => 'news_preview_count',
	);

	$keys = array( $canonical_name );
	if ( isset( $legacy[ $canonical_name ] ) ) {
		$keys[] = $legacy[ $canonical_name ];
	}
	return $keys;
}

/**
 * 固定フロントページの ACF フィールドを読む（コーポレート用）。
 *
 * @param string $field_name Field name.
 * @param mixed  $fallback   Fallback when empty / missing front page.
 * @return mixed
 */
function theme_front_meta( string $field_name, $fallback = '' ) {
	$pid = theme_front_page_id();
	if ( ! $pid || ! function_exists( 'get_field' ) ) {
		return $fallback;
	}

	foreach ( theme_front_meta_field_keys( $field_name ) as $key ) {
		$value = get_field( $key, $pid );
		if ( ! theme_acf_value_absent( $value ) ) {
			return $value;
		}
	}

	return $fallback;
}

/**
 * ポートフォリオ TOP 用 ACF フィールドを読む。
 *
 * @param string $field_name Field name.
 * @param mixed  $fallback   Fallback when empty / missing front page.
 * @return mixed
 */
function theme_portfolio_meta( string $field_name, $fallback = '' ) {
	$pid = theme_front_page_id();
	if ( ! $pid ) {
		return $fallback;
	}

	$value = function_exists( 'get_field' )
		? get_field( $field_name, $pid )
		: get_post_meta( $pid, $field_name, true );

	if ( theme_acf_value_absent( $value ) ) {
		return $fallback;
	}

	return $value;
}

/**
 * 現在編集中の固定ページの ACF フィールドを読む（テンプレート専用グループ向け）。
 *
 * @param int    $post_id    Post ID.
 * @param string $field_name Field name.
 * @param mixed  $fallback   Fallback when empty or ACF inactive.
 * @return mixed
 */
function theme_page_meta( int $post_id, string $field_name, $fallback = '' ) {
	if ( $post_id < 1 || ! function_exists( 'get_field' ) ) {
		return $fallback;
	}
	$value = get_field( $field_name, $post_id );
	if ( theme_acf_value_absent( $value ) ) {
		return $fallback;
	}
	return $value;
}

/**
 * Resolve image field or theme asset fallback URL.
 *
 * @param mixed  $field    ACF image field value.
 * @param string $fallback Relative path under theme directory.
 */
function theme_image_url( $field, string $fallback ): string {
	if ( is_array( $field ) && ! empty( $field['url'] ) ) {
		return esc_url( (string) $field['url'] );
	}
	if ( is_int( $field ) && $field > 0 ) {
		$url = wp_get_attachment_image_url( $field, 'full' );
		if ( $url ) {
			return esc_url( $url );
		}
	}
	if ( is_string( $field ) && '' !== $field ) {
		if ( ctype_digit( $field ) ) {
			$url = wp_get_attachment_image_url( (int) $field, 'full' );
			if ( $url ) {
				return esc_url( $url );
			}
		}
		return esc_url( $field );
	}
	return esc_url( get_template_directory_uri() . '/' . ltrim( $fallback, '/' ) );
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

/**
 * Allowed HTML for portfolio rich text fields.
 *
 * @return array<string, array<string, bool>>
 */
function theme_portfolio_kses_allowed_html(): array {
	return array(
		'p'          => array( 'class' => true ),
		'br'         => array(),
		'b'          => array(),
		'strong'     => array(),
		'em'         => array(),
		'i'          => array(),
		'a'          => array(
			'href'   => true,
			'class'  => true,
			'target' => true,
			'rel'    => true,
		),
		'small'      => array( 'class' => true ),
		'span'       => array( 'class' => true ),
		'div'        => array( 'class' => true ),
		'h2'         => array( 'class' => true ),
		'h3'         => array( 'class' => true ),
		'h4'         => array( 'class' => true ),
		'h5'         => array( 'class' => true ),
		'h6'         => array( 'class' => true ),
		'ul'         => array( 'class' => true ),
		'ol'         => array( 'class' => true ),
		'li'         => array( 'class' => true ),
		'blockquote' => array( 'class' => true ),
		'code'       => array( 'class' => true ),
		'pre'        => array( 'class' => true ),
		'details'    => array(
			'class' => true,
			'open'  => true,
		),
		'summary'    => array( 'class' => true ),
		'dl'         => array( 'class' => true ),
		'dt'         => array( 'class' => true ),
		'dd'         => array( 'class' => true ),
		'article'    => array( 'class' => true ),
		'section'    => array(
			'class'      => true,
			'aria-label' => true,
		),
		'header'     => array( 'class' => true ),
		'button'     => array(
			'type'       => true,
			'class'      => true,
			'aria-label' => true,
		),
	);
}
