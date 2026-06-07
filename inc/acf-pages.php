<?php
/**
 * ACF フィールド登録。
 *
 * @package Izakaya
 */

declare(strict_types=1);

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * ACF が options page に対応している場合だけ共通設定ページを登録する。
 */
function theme_register_acf_options_page(): void {
	if ( ! function_exists( 'acf_add_options_page' ) ) {
		return;
	}

	// 管理画面の共通設定ページを追加する。
	acf_add_options_page(
		array(
			'page_title' => '店舗共通情報',
			'menu_title' => '店舗共通情報',
			'menu_slug'  => 'theme-shop-settings',
			'capability' => 'edit_theme_options',
			'redirect'   => false,
		)
	);
}
add_action( 'acf/init', 'theme_register_acf_options_page', 5 );

/**
 * 安定した ACF フィールド定義を組み立てる。
 *
 * @param string $key フィールドキーの末尾。
 * @param string $label 管理画面ラベル。
 * @param string $name メタキー名。
 * @param string $type ACF フィールド型。
 * @param array  $extra 追加設定。
 * @return array<string, mixed>
 */
function theme_acf_field( string $key, string $label, string $name, string $type = 'text', array $extra = array() ): array {
	return array_merge(
		array(
			'key'   => 'field_theme_' . $key,
			'label' => $label,
			'name'  => $name,
			'type'  => $type,
		),
		$extra
	);
}

/**
 * ページ別、共通、CPT のフィールドグループを登録する。
 */
function theme_register_acf_fields(): void {
	if ( ! function_exists( 'acf_add_local_field_group' ) ) {
		return;
	}

	// まず、店舗全体で使う共通設定を登録する。
	acf_add_local_field_group(
		array(
			'key'      => 'group_theme_shop_settings',
			'title'    => '店舗共通情報',
			'fields'   => array(
				theme_acf_field( 'shop_name', '店舗名', 'shop_name', 'text', array( 'default_value' => THEME_BRAND_DEFAULT ) ),
				theme_acf_field( 'shop_phone', '電話番号', 'shop_phone', 'text', array( 'default_value' => '000-0000-0000' ) ),
				theme_acf_field( 'shop_contact_url', 'お問い合わせURL', 'shop_contact_url', 'url', array( 'default_value' => '#' ) ),
				theme_acf_field( 'shop_postcode', '郵便番号', 'shop_postcode', 'text', array( 'default_value' => '〒000-0000' ) ),
				theme_acf_field(
					'shop_address',
					'所在地',
					'shop_address',
					'textarea',
					array(
						'rows'          => 2,
						'default_value' => '東京都何何区何々市何々町０−０−０',
					)
				),
				theme_acf_field(
					'shop_hours',
					'営業時間',
					'shop_hours',
					'textarea',
					array(
						'rows'          => 3,
						'default_value' => "火～土曜日17:00～2:00\n日曜日15:00～0:00",
					)
				),
				theme_acf_field( 'shop_closed', '定休日', 'shop_closed', 'text', array( 'default_value' => '月曜日' ) ),
				theme_acf_field( 'shop_map_embed_url', 'Google Map埋め込みURL', 'shop_map_embed_url', 'url' ),
				theme_acf_field( 'shop_instagram_url', 'Instagram URL', 'shop_instagram_url', 'url' ),
			),
			'location' => array(
				array(
					array(
						'param'    => 'options_page',
						'operator' => '==',
						'value'    => 'theme-shop-settings',
					),
				),
			),
		)
	);

	// 次に、ページテンプレートごとの編集項目をまとめて定義する。
	$page_groups = array(
		'front'    => array(
			'title'    => 'トップページ',
			'location' => array(
				'param' => 'page_type',
				'value' => 'front_page',
			),
		),
		'genshu'   => array(
			'title'    => '焼酎の原酒',
			'location' => array(
				'param' => 'page_template',
				'value' => 'page-templates/genshu.php',
			),
		),
		'shochu'   => array(
			'title'    => '本格焼酎',
			'location' => array(
				'param' => 'page_template',
				'value' => 'page-templates/shochu.php',
			),
		),
		'other'    => array(
			'title'    => 'その他のお酒',
			'location' => array(
				'param' => 'page_template',
				'value' => 'page-templates/other.php',
			),
		),
		'otsumami' => array(
			'title'    => 'おつまみ',
			'location' => array(
				'param' => 'page_template',
				'value' => 'page-templates/otsumami.php',
			),
		),
		'insta'    => array(
			'title'    => 'お知らせ',
			'location' => array(
				'param' => 'page_template',
				'value' => 'page-templates/insta.php',
			),
		),
		'info'     => array(
			'title'    => '店舗案内',
			'location' => array(
				'param' => 'page_template',
				'value' => 'page-templates/info.php',
			),
		),
	);

	foreach ( $page_groups as $slug => $group ) {
		// 各ページに共通する基本項目を組み立てる。
		$page_fields = array(
			theme_acf_field( $slug . '_eyebrow', '英字見出し', $slug . '_eyebrow' ),
			theme_acf_field( $slug . '_heading', '見出し', $slug . '_heading' ),
			theme_acf_field(
				$slug . '_lead',
				'導入文',
				$slug . '_lead',
				'wysiwyg',
				array(
					'tabs'         => 'visual',
					'toolbar'      => 'basic',
					'media_upload' => 0,
				)
			),
			theme_acf_field(
				$slug . '_hero_image',
				'メイン画像',
				$slug . '_hero_image',
				'image',
				array(
					'return_format' => 'id',
					'preview_size'  => 'medium',
				)
			),
			theme_acf_field( $slug . '_cta_label', '導線ラベル', $slug . '_cta_label' ),
			theme_acf_field( $slug . '_cta_url', '導線URL', $slug . '_cta_url', 'url' ),
			theme_acf_field( $slug . '_section_heading', '主要セクション見出し', $slug . '_section_heading' ),
			theme_acf_field(
				$slug . '_section_body',
				'主要セクション説明',
				$slug . '_section_body',
				'wysiwyg',
				array(
					'tabs'         => 'visual',
					'toolbar'      => 'basic',
					'media_upload' => 0,
				)
			),
			theme_acf_field(
				$slug . '_image_1',
				'補助画像1',
				$slug . '_image_1',
				'image',
				array(
					'return_format' => 'id',
					'preview_size'  => 'medium',
				)
			),
			theme_acf_field(
				$slug . '_image_2',
				'補助画像2',
				$slug . '_image_2',
				'image',
				array(
					'return_format' => 'id',
					'preview_size'  => 'medium',
				)
			),
		);

		// 焼酎ページだけ、カテゴリ別の追加項目を増やす。
		if ( 'shochu' === $slug ) {
			foreach ( array( 'imo', 'mugi', 'kome', 'kokuto', 'other' ) as $section ) {
				$page_fields[] = theme_acf_field( "shochu_{$section}_heading", strtoupper( $section ) . ' 見出し', "shochu_{$section}_heading" );
				$page_fields[] = theme_acf_field( "shochu_{$section}_body", strtoupper( $section ) . ' 説明', "shochu_{$section}_body", 'wysiwyg' );
				$page_fields[] = theme_acf_field( "shochu_{$section}_image_1", strtoupper( $section ) . ' 画像1', "shochu_{$section}_image_1", 'image', array( 'return_format' => 'id' ) );
				$page_fields[] = theme_acf_field( "shochu_{$section}_image_2", strtoupper( $section ) . ' 画像2', "shochu_{$section}_image_2", 'image', array( 'return_format' => 'id' ) );
			}
		}

		// トップページだけ、リンク導線用の項目を追加する。
		if ( 'front' === $slug ) {
			foreach ( array( 'other', 'otsumami' ) as $section ) {
				$page_fields[] = theme_acf_field( "front_{$section}_eyebrow", strtoupper( $section ) . ' 英字見出し', "front_{$section}_eyebrow" );
				$page_fields[] = theme_acf_field( "front_{$section}_heading", strtoupper( $section ) . ' 見出し', "front_{$section}_heading" );
				$page_fields[] = theme_acf_field( "front_{$section}_url", strtoupper( $section ) . ' URL', "front_{$section}_url", 'url' );
				$page_fields[] = theme_acf_field( "front_{$section}_image_1", strtoupper( $section ) . ' 画像1', "front_{$section}_image_1", 'image', array( 'return_format' => 'id' ) );
				$page_fields[] = theme_acf_field( "front_{$section}_image_2", strtoupper( $section ) . ' 画像2', "front_{$section}_image_2", 'image', array( 'return_format' => 'id' ) );
			}
		}

		// ページテンプレートごとの編集グループとして登録する。
		acf_add_local_field_group(
			array(
				'key'      => 'group_theme_page_' . $slug,
				'title'    => $group['title'] . ' 編集項目',
				'fields'   => $page_fields,
				'location' => array(
					array(
						array(
							'param'    => $group['location']['param'],
							'operator' => '==',
							'value'    => $group['location']['value'],
						),
					),
				),
			)
		);
	}

	// 最後に、投稿タイプごとの追加項目を登録する。
	$content_groups = array(
		'drink' => 'ドリンク詳細',
		'food'  => '料理詳細',
		'news'  => 'お知らせ詳細',
	);

	foreach ( $content_groups as $post_type => $title ) {
		// 全投稿タイプ共通の項目を作る。
		$fields = array(
			theme_acf_field( $post_type . '_external_url', '外部URL', $post_type . '_external_url', 'url' ),
		);
		if ( 'news' !== $post_type ) {
			// 価格とおすすめ表示は、お知らせ以外にだけ付ける。
			array_unshift(
				$fields,
				theme_acf_field( $post_type . '_price', '価格', $post_type . '_price' ),
				theme_acf_field( $post_type . '_featured', 'おすすめ表示', $post_type . '_featured', 'true_false' )
			);
		}

		// 投稿タイプ専用の編集グループとして登録する。
		acf_add_local_field_group(
			array(
				'key'      => 'group_theme_' . $post_type,
				'title'    => $title,
				'fields'   => $fields,
				'location' => array(
					array(
						array(
							'param'    => 'post_type',
							'operator' => '==',
							'value'    => $post_type,
						),
					),
				),
			)
		);
	}
}
add_action( 'acf/init', 'theme_register_acf_fields' );
