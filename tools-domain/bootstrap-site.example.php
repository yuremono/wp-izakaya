<?php
/**
 * Bootstrap a copied theme's WordPress site.
 *
 * Copy this repository first, then replace the values in `$config`.
 * Run with: WP_LOAD_PATH="/path/to/wp-load.php" php tools-domain/bootstrap-site.example.php
 *
 * @package Theme
 */

declare(strict_types=1);

$config = array(
	'theme_slug'  => '0606wp-izakaya',
	'menu_name'   => '鹿尾 ナビゲーション',
	'front_title' => 'ホーム',
	'front_slug'  => 'home',
	'pages'       => array(
		array( 'slug' => 'genshu', 'title' => '焼酎の原酒' ),
		array( 'slug' => 'shochu', 'title' => '本格焼酎' ),
		array( 'slug' => 'other', 'title' => 'その他のお酒' ),
		array( 'slug' => 'otsumami', 'title' => 'おつまみ' ),
		array( 'slug' => 'insta', 'title' => 'お知らせ' ),
		array( 'slug' => 'info', 'title' => '店舗案内' ),
	),
);

function theme_tools_expand_path( string $path ): string {
	$path = trim( $path );
	if ( str_starts_with( $path, '~' ) ) {
		$home = getenv( 'HOME' );
		return is_string( $home ) && '' !== $home ? $home . substr( $path, 1 ) : $path;
	}

	return $path;
}

function theme_tools_resolve_wp_load(): string {
	$env = getenv( 'WP_LOAD_PATH' );
	if ( is_string( $env ) && '' !== $env ) {
		return theme_tools_expand_path( $env );
	}

	$config_file = dirname( __DIR__ ) . '/tools/local-wp-load.path';
	if ( ! is_readable( $config_file ) ) {
		return '';
	}

	foreach ( preg_split( "/\r\n|\n|\r/", (string) file_get_contents( $config_file ) ) as $line ) {
		$line = trim( $line );
		if ( '' !== $line && ! str_starts_with( $line, '#' ) ) {
			return theme_tools_expand_path( $line );
		}
	}

	return '';
}

if ( ! defined( 'ABSPATH' ) ) {
	$wp_load = theme_tools_resolve_wp_load();
	if ( '' === $wp_load || ! is_readable( $wp_load ) ) {
		fwrite( STDERR, "wp-load.php が見つかりません。WP_LOAD_PATH または tools/local-wp-load.path を確認してください。\n" );
		exit( 1 );
	}

	require $wp_load;
}

require_once ABSPATH . 'wp-admin/includes/plugin.php';

wp_set_current_user( 1 );
switch_theme( $config['theme_slug'] );

if ( file_exists( WP_PLUGIN_DIR . '/advanced-custom-fields/acf.php' ) && ! is_plugin_active( 'advanced-custom-fields/acf.php' ) ) {
	activate_plugin( 'advanced-custom-fields/acf.php' );
}

function theme_tools_upsert_page( string $slug, string $title, string $template ): int {
	$page    = get_page_by_path( $slug, OBJECT, 'page' );
	$payload = array(
		'post_type'   => 'page',
		'post_status' => 'publish',
		'post_title'  => $title,
		'post_name'   => $slug,
	);

	if ( $page instanceof WP_Post ) {
		$payload['ID'] = $page->ID;
		$page_id       = wp_update_post( wp_slash( $payload ), true );
	} else {
		$page_id = wp_insert_post( wp_slash( $payload ), true );
	}

	if ( is_wp_error( $page_id ) || ! $page_id ) {
		fwrite( STDERR, "固定ページを作成できませんでした: {$title}\n" );
		exit( 1 );
	}

	update_post_meta( (int) $page_id, '_wp_page_template', $template );

	return (int) $page_id;
}

function theme_tools_sync_primary_menu( string $menu_name, array $pages ): int {
	$menu    = wp_get_nav_menu_object( $menu_name );
	$menu_id = $menu instanceof WP_Term ? (int) $menu->term_id : (int) wp_create_nav_menu( $menu_name );

	if ( ! $menu_id ) {
		fwrite( STDERR, "メニューを作成できませんでした: {$menu_name}\n" );
		exit( 1 );
	}

	foreach ( (array) wp_get_nav_menu_items( $menu_id ) as $item ) {
		if ( $item instanceof WP_Post ) {
			wp_delete_post( (int) $item->ID, true );
		}
	}

	wp_update_nav_menu_item(
		$menu_id,
		0,
		array(
			'menu-item-title'  => 'Home',
			'menu-item-url'    => home_url( '/' ),
			'menu-item-type'   => 'custom',
			'menu-item-status' => 'publish',
		)
	);
	foreach ( $pages as $page ) {
		wp_update_nav_menu_item(
			$menu_id,
			0,
			array(
				'menu-item-title'     => $page['title'],
				'menu-item-object-id' => $page['id'],
				'menu-item-object'    => 'page',
				'menu-item-type'      => 'post_type',
				'menu-item-status'    => 'publish',
			)
		);
	}

	$locations            = get_nav_menu_locations();
	$locations['primary'] = $menu_id;
	set_theme_mod( 'nav_menu_locations', $locations );

	return $menu_id;
}

$front_id = theme_tools_upsert_page( $config['front_slug'], $config['front_title'], 'page-templates/top.php' );
$pages    = array();
foreach ( $config['pages'] as $page ) {
	$page['id'] = theme_tools_upsert_page( $page['slug'], $page['title'], "page-templates/{$page['slug']}.php" );
	$pages[]    = $page;
}

update_option( 'show_on_front', 'page' );
update_option( 'page_on_front', $front_id );
$menu_id = theme_tools_sync_primary_menu( $config['menu_name'], $pages );
flush_rewrite_rules( false );

echo "OK: site bootstrapped.\n";
echo "front_id={$front_id}\n";
echo "menu_id={$menu_id}\n";
