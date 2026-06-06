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
	add_theme_support( 'custom-logo' );
	add_theme_support(
		'html5',
		array(
			'caption',
			'gallery',
			'script',
			'style',
		)
	);

	register_nav_menus(
		array(
			'primary' => __( 'Primary Navigation', THEME_GETTEXT_DOMAIN ),
			'footer'  => __( 'Footer Navigation', THEME_GETTEXT_DOMAIN ),
		)
	);
}
add_action( 'after_setup_theme', 'theme_setup' );

/**
 * Show an admin notice when ACF is inactive.
 */
function theme_acf_admin_notice(): void {
	if ( function_exists( 'acf_add_local_field_group' ) || ! current_user_can( 'activate_plugins' ) ) {
		return;
	}
	?>
	<div class="notice notice-warning">
		<p><?php echo esc_html__( 'Advanced Custom Fields が有効化されていません。テーマの編集項目を利用するには ACF を有効化してください。', THEME_GETTEXT_DOMAIN ); ?></p>
	</div>
	<?php
}
add_action( 'admin_notices', 'theme_acf_admin_notice' );

/**
 * Fallback navigation used until a menu is assigned in the admin screen.
 */
function theme_primary_menu_fallback(): void {
	$items = array(
		array(
			'label' => 'Home',
			'url'   => home_url( '/' ),
		),
	);
	?>
	<ul>
		<?php foreach ( $items as $item ) : ?>
			<li><a href="<?php echo esc_url( $item['url'] ); ?>"><?php echo esc_html( $item['label'] ); ?></a></li>
		<?php endforeach; ?>
	</ul>
	<?php
}
