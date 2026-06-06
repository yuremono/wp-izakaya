<?php
/**
 * Reusable template helpers.
 *
 * @package Theme
 */

declare(strict_types=1);

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Return a URI below the theme assets directory.
 *
 * @param string $relative Relative asset path.
 * @return string
 */
function theme_source_uri( string $relative = '' ): string {
	return trailingslashit( get_theme_file_uri( 'assets' ) ) . ltrim( $relative, '/' );
}

/**
 * Return body classes for the custom page templates.
 *
 * @return array<int, string>
 */
function theme_body_classes(): array {
	$classes = array( 'KanooPage' );
	$pages   = array( 'genshu', 'shochu', 'other', 'otsumami', 'insta', 'info' );

	foreach ( $pages as $page ) {
		if ( is_page_template( "page-templates/{$page}.php" ) ) {
			$classes[] = 'KanooPage' . ucfirst( $page );
			return apply_filters( 'theme_body_classes', $classes );
		}
	}

	$classes[] = 'KanooPageTop';
	return apply_filters( 'theme_body_classes', $classes );
}

/**
 * Determine whether the current request uses a custom template.
 *
 * @return bool
 */
function theme_is_custom_view(): bool {
	return is_front_page() || is_page_template(
		array(
			'page-templates/top.php',
			'page-templates/genshu.php',
			'page-templates/shochu.php',
			'page-templates/other.php',
			'page-templates/otsumami.php',
			'page-templates/insta.php',
			'page-templates/info.php',
		)
	);
}

/**
 * Return an editable page value with an ACF-independent fallback.
 *
 * @param string $field_name Field name.
 * @param mixed  $fallback   Fallback value.
 * @return mixed
 */
function theme_meta( string $field_name, $fallback = '' ) {
	$post_id = (int) get_queried_object_id();
	if ( ! $post_id ) {
		$post_id = (int) get_the_ID();
	}
	if ( ! $post_id ) {
		return $fallback;
	}

	$value = function_exists( 'get_field' )
		? get_field( $field_name, $post_id )
		: get_post_meta( $post_id, $field_name, true );

	return theme_acf_value_absent( $value ) ? $fallback : $value;
}

/**
 * Return a URL field value.
 *
 * @param string $field_name Field name.
 * @param string $fallback Fallback URL.
 * @return string
 */
function theme_url( string $field_name, string $fallback = '' ): string {
	$url = (string) theme_meta( $field_name, $fallback );

	return '' !== $url ? $url : $fallback;
}

/**
 * Normalize an editable image field.
 *
 * @param string $field_name Field name.
 * @param string $fallback_relative Relative fallback asset path.
 * @param string $fallback_alt Fallback alternative text.
 * @param string $size WordPress image size.
 * @return array{url:string,alt:string}
 */
function theme_image_data( string $field_name, string $fallback_relative = '', string $fallback_alt = '', string $size = 'full' ): array {
	$image = theme_meta( $field_name );
	$url   = '';
	$alt   = '';

	if ( is_array( $image ) ) {
		$attachment_id = ! empty( $image['ID'] ) ? (int) $image['ID'] : 0;
		$url           = $attachment_id ? (string) wp_get_attachment_image_url( $attachment_id, $size ) : (string) ( $image['url'] ?? '' );
		$alt           = (string) ( $image['alt'] ?? '' );
	} elseif ( is_numeric( $image ) ) {
		$attachment_id = (int) $image;
		$url           = (string) wp_get_attachment_image_url( $attachment_id, $size );
		$alt           = (string) get_post_meta( $attachment_id, '_wp_attachment_image_alt', true );
	} elseif ( is_string( $image ) ) {
		$url = $image;
	}

	if ( '' === $url && '' !== $fallback_relative ) {
		$url = theme_source_uri( $fallback_relative );
	}

	return array(
		'url' => $url,
		'alt' => '' !== $alt ? $alt : $fallback_alt,
	);
}

/**
 * Print an editable image.
 *
 * @param string $field_name Field name.
 * @param string $fallback_relative Relative fallback asset path.
 * @param string $fallback_alt Fallback alternative text.
 * @param string $css_class Optional CSS class.
 */
function theme_image( string $field_name, string $fallback_relative = '', string $fallback_alt = '', string $css_class = '' ): void {
	$image = theme_image_data( $field_name, $fallback_relative, $fallback_alt );
	if ( '' === $image['url'] ) {
		return;
	}
	?>
	<img src="<?php echo esc_url( $image['url'] ); ?>" alt="<?php echo esc_attr( $image['alt'] ); ?>"<?php echo '' !== $css_class ? ' class="' . esc_attr( $css_class ) . '"' : ''; ?>>
	<?php
}

/**
 * Print escaped text.
 *
 * @param string $field_name Field name.
 * @param string $fallback Fallback text.
 */
function theme_text( string $field_name, string $fallback = '' ): void {
	echo esc_html( (string) theme_meta( $field_name, $fallback ) );
}

/**
 * Print escaped multiline text.
 *
 * @param string $field_name Field name.
 * @param string $fallback Fallback text.
 */
function theme_lines( string $field_name, string $fallback = '' ): void {
	echo nl2br( esc_html( (string) theme_meta( $field_name, $fallback ) ) );
}

/**
 * Return HTML allowed in editable rich text.
 *
 * @return array<string, mixed>
 */
function theme_allowed_html(): array {
	return wp_kses_allowed_html( 'post' );
}

/**
 * Print sanitized rich text.
 *
 * @param string $field_name Field name.
 * @param string $fallback Fallback HTML.
 */
function theme_rich( string $field_name, string $fallback = '' ): void {
	echo wp_kses( (string) theme_meta( $field_name, $fallback ), theme_allowed_html() );
}
