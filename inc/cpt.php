<?php
/**
 * カスタム投稿タイプとタクソノミー。
 *
 * @package Izakaya
 */

declare(strict_types=1);

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * 編集可能なメニューとお知らせの投稿タイプを登録する。
 */
function theme_register_content_types(): void {
	$post_types = array(
		'drink' => array(
			'singular' => 'ドリンク',
			'plural'   => 'ドリンク',
			'icon'     => 'dashicons-coffee',
		),
		'food'  => array(
			'singular' => '料理',
			'plural'   => '料理',
			'icon'     => 'dashicons-food',
		),
		'news'  => array(
			'singular' => 'お知らせ',
			'plural'   => 'お知らせ',
			'icon'     => 'dashicons-megaphone',
		),
	);

	// 投稿タイプごとのラベルと表示設定をまとめて登録する。
	foreach ( $post_types as $slug => $labels ) {
		register_post_type(
			$slug,
			array(
				'labels'       => array(
					'name'          => $labels['plural'],
					'singular_name' => $labels['singular'],
					'add_new_item'  => $labels['singular'] . 'を追加',
					'edit_item'     => $labels['singular'] . 'を編集',
				),
				'public'       => true,
				'show_in_rest' => true,
				'has_archive'  => false,
				'menu_icon'    => $labels['icon'],
				'supports'     => array( 'title', 'editor', 'excerpt', 'thumbnail', 'page-attributes' ),
				'rewrite'      => array( 'slug' => $slug ),
			)
		);
	}

	// 投稿タイプごとに使うカテゴリーを登録する。
	theme_register_content_taxonomy( 'drink_category', 'drink', 'ドリンクカテゴリー' );
	theme_register_content_taxonomy( 'food_category', 'food', '料理カテゴリー' );
	theme_register_content_taxonomy( 'news_category', 'news', 'お知らせカテゴリー' );
}
add_action( 'init', 'theme_register_content_types' );

/**
 * 既存タームを上書きせずに、初期セクションタームを作成する。
 */
function theme_register_default_content_terms(): void {
	$terms = array(
		'drink_category' => array(
			'genshu' => '焼酎の原酒',
			'imo'    => '芋焼酎',
			'mugi'   => '麦焼酎',
			'kome'   => '米焼酎',
			'kokuto' => '黒糖焼酎',
			'other'  => 'その他のお酒',
		),
		'food_category'  => array(
			'charcoal' => '炭火焼き',
			'featured' => 'おすすめ',
			'other'    => 'その他',
		),
		'news_category'  => array(
			'instagram' => 'Instagram',
		),
	);

	// 初期状態で使うタームを、存在しないものだけ追加する。
	foreach ( $terms as $taxonomy => $taxonomy_terms ) {
		foreach ( $taxonomy_terms as $slug => $name ) {
			if ( ! term_exists( $slug, $taxonomy ) ) {
				wp_insert_term( $name, $taxonomy, array( 'slug' => $slug ) );
			}
		}
	}
}
add_action( 'init', 'theme_register_default_content_terms', 20 );

/**
 * 階層型のコンテンツ用タクソノミーを登録する。
 *
 * @param string $taxonomy タクソノミースラッグ。
 * @param string $post_type 投稿タイプスラッグ。
 * @param string $label 管理画面ラベル。
 */
function theme_register_content_taxonomy( string $taxonomy, string $post_type, string $label ): void {
	// 階層型タクソノミーとして、管理画面と REST API の両方で扱えるように登録する。
	register_taxonomy(
		$taxonomy,
		$post_type,
		array(
			'labels'            => array(
				'name'          => $label,
				'singular_name' => $label,
			),
			'public'            => true,
			'hierarchical'      => true,
			'show_admin_column' => true,
			'show_in_rest'      => true,
			'rewrite'           => array( 'slug' => $taxonomy ),
		)
	);
}
