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
	 * @param string $relative Relative path under assets.
	 * @return string
	 */
	function theme_quests_source_uri( string $relative = '' ): string {
		$base = trailingslashit( get_theme_file_uri( 'assets' ) );

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
		$post_id = theme_quests_content_post_id();
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

if ( ! function_exists( 'theme_quests_content_post_id' ) ) {
	/**
	 * Get the page ID used for quests editable fields.
	 *
	 * @return int
	 */
	function theme_quests_content_post_id(): int {
		$post_id = get_queried_object_id() ?: get_the_ID();

		return (int) $post_id;
	}
}

if ( ! function_exists( 'theme_quests_url' ) ) {
	/**
	 * Read a URL field with fallback.
	 *
	 * @param string $field_name Field name.
	 * @param string $fallback   Fallback URL.
	 * @return string
	 */
	function theme_quests_url( string $field_name, string $fallback = '' ): string {
		$url = (string) theme_quests_meta( $field_name, $fallback );

		return '' !== $url ? $url : $fallback;
	}
}

if ( ! function_exists( 'theme_quests_image_data' ) ) {
	/**
	 * Normalize an ACF image field to URL and alt text.
	 *
	 * @param string $field_name        Field name.
	 * @param string $fallback_relative Fallback asset path.
	 * @param string $fallback_alt      Fallback alt text.
	 * @param string $size              WordPress image size.
	 * @return array{url:string,alt:string}
	 */
	function theme_quests_image_data( string $field_name, string $fallback_relative, string $fallback_alt = '', string $size = 'full' ): array {
		$image = theme_quests_meta( $field_name, '' );
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

		if ( '' === $url ) {
			$url = theme_quests_source_uri( $fallback_relative );
		}

		if ( '' === $alt ) {
			$alt = $fallback_alt;
		}

		return array(
			'url' => $url,
			'alt' => $alt,
		);
	}
}

if ( ! function_exists( 'theme_quests_image' ) ) {
	/**
	 * Echo an image tag for quests editable images.
	 *
	 * @param string $field_name        Field name.
	 * @param string $fallback_relative Fallback asset path.
	 * @param string $fallback_alt      Fallback alt text.
	 * @param string $class             Optional class attribute.
	 */
	function theme_quests_image( string $field_name, string $fallback_relative, string $fallback_alt = '', string $class = '' ): void {
		$image = theme_quests_image_data( $field_name, $fallback_relative, $fallback_alt );
		?>
		<img src="<?php echo esc_url( $image['url'] ); ?>" alt="<?php echo esc_attr( $image['alt'] ); ?>"<?php echo '' !== $class ? ' class="' . esc_attr( $class ) . '"' : ''; ?>>
		<?php
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

if ( ! function_exists( 'theme_quests_table' ) ) {
	/**
	 * Echo a fixed-row table while preserving legacy HTML until new fields are saved.
	 *
	 * @param string                         $field_prefix Prefix for row field names.
	 * @param array<int, array{0:string,1:string}> $fallback_rows Default rows.
	 * @param string                         $legacy_field Legacy HTML field name.
	 */
	function theme_quests_table( string $field_prefix, array $fallback_rows, string $legacy_field ): void {
		$post_id        = theme_quests_content_post_id();
		$has_saved_rows = false;

		foreach ( array_keys( $fallback_rows ) as $index ) {
			$row_number = $index + 1;
			if (
				'' !== (string) get_post_meta( $post_id, "{$field_prefix}_{$row_number}_label", true ) ||
				'' !== (string) get_post_meta( $post_id, "{$field_prefix}_{$row_number}_value", true )
			) {
				$has_saved_rows = true;
				break;
			}
		}

		$legacy_value = (string) get_post_meta( $post_id, $legacy_field, true );
		if ( ! $has_saved_rows && '' !== $legacy_value ) {
			echo wp_kses( $legacy_value, theme_quests_allowed_html() );
			return;
		}

		?>
		<table>
			<?php foreach ( $fallback_rows as $index => $fallback_row ) : ?>
				<?php
				$row_number = $index + 1;
				$label      = (string) theme_quests_meta( "{$field_prefix}_{$row_number}_label", $fallback_row[0] );
				$value      = (string) theme_quests_meta( "{$field_prefix}_{$row_number}_value", $fallback_row[1] );
				if ( '' === $label && '' === $value ) {
					continue;
				}
				?>
				<tr>
					<td><div><?php echo esc_html( $label ); ?></div></td>
					<td><div><?php echo esc_html( $value ); ?></div></td>
				</tr>
			<?php endforeach; ?>
		</table>
		<?php
	}
}
