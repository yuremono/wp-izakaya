<?php
/**
 * Quests page ACF field groups.
 *
 * @package Theme
 */

declare(strict_types=1);

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register editable fields for Quests pages.
 */
function theme_register_acf_quests_page_groups(): void {
	if ( ! function_exists( 'acf_add_local_field_group' ) ) {
		return;
	}

	$text_domain = THEME_GETTEXT_DOMAIN;
	$field       = static function ( string $key, string $label, string $name, string $default_value, int $rows = 2 ) use ( $text_domain ): array {
		return array(
			'key'           => $key,
			'label'         => __( $label, $text_domain ),
			'name'          => $name,
			'type'          => $rows > 1 ? 'textarea' : 'text',
			'rows'          => $rows,
			'instructions'  => __( 'Quests ページ内の同名ブロックに表示されます。', $text_domain ),
			'default_value' => $default_value,
		);
	};
	$tab         = static function ( string $key, string $label ) use ( $text_domain ): array {
		return array(
			'key'   => $key,
			'label' => __( $label, $text_domain ),
			'name'  => '',
			'type'  => 'tab',
		);
	};
	$location    = static function ( string $template ): array {
		return array(
			array(
				array(
					'param'    => 'page_template',
					'operator' => '==',
					'value'    => $template,
				),
			),
		);
	};
	$top_location = array(
		array(
			array(
				'param'    => 'page_type',
				'operator' => '==',
				'value'    => 'front_page',
			),
		),
		array(
			array(
				'param'    => 'page_template',
				'operator' => '==',
				'value'    => 'page-templates/quests-top.php',
			),
		),
	);

	acf_add_local_field_group(
		array(
			'key'                   => 'group_pc_page_quests',
			'title'                 => __( 'Quests トップページ', $text_domain ),
			'fields'                => array(
				$tab( 'field_pc_quests_tab_main', 'メイン' ),
				$field( 'field_pc_quests_hero_title', 'ヒーロー見出し', 'quests_hero_title', "Samplexx\nLayout Text Dummyxx", 3 ),
				$field( 'field_pc_quests_about_copy', 'About 上部コピー', 'quests_about_copy', "Samplexx\nLayout Textxxxx", 3 ),
				$field( 'field_pc_quests_about_heading', 'About 見出し', 'quests_about_heading', '文字と「暮らす」', 1 ),
				$field( 'field_pc_quests_about_body', 'About 本文', 'quests_about_body', "ここには日本語の仮文章を配置しています。\n文字量と改行の見え方を保つため、同じ程度の長さで構成したダミーテキストです。\n実際の説明内容ではなく、画面上の余白や行間を確認するために、\n日本語のまま置き換えています。\n本文の密度が大きく変わらないよう、文の長さと折り返しを調整しています。", 8 ),
				$tab( 'field_pc_quests_tab_sections', '本文セクション' ),
				$field( 'field_pc_quests_intro_kicker', 'Introduction ラベル', 'quests_intro_kicker', 'Introduction', 1 ),
				$field( 'field_pc_quests_intro_heading', 'Introduction 見出し', 'quests_intro_heading', 'Hello! This is Sample Text.', 1 ),
				$field( 'field_pc_quests_intro_body', 'Introduction 本文', 'quests_intro_body', 'ここには、文字数の確認に使うための仮の文章を配置しています。意味を持たない説明文として、見た目の長さや行数が大きく変わらないように調整しています。', 4 ),
				$field( 'field_pc_quests_feature_u', 'Quests 強調ラベル', 'quests_feature_u', "Samplex\nTextxx", 2 ),
				$field( 'field_pc_quests_feature_heading', 'Quests 見出し', 'quests_feature_heading', 'Samplex-only', 1 ),
				$field( 'field_pc_quests_feature_body', 'Quests 本文', 'quests_feature_body', "「サンプル\nテキスト」は表示確認のために配置した仮の文章です。日本語の長さや改行の入り方を保ちながら、見た目を確認するためのダミーテキストとして構成しています。", 4 ),
				$tab( 'field_pc_quests_tab_cards', '下部カード' ),
				$field( 'field_pc_quests_education_kicker', 'Education 大見出しラベル', 'quests_education_kicker', 'Surround yourself with English！', 1 ),
				$field( 'field_pc_quests_education_heading', 'Education 大見出し', 'quests_education_heading', '日々の文字に文字を', 1 ),
				$field( 'field_pc_quests_education_card_kicker', 'Education カードラベル', 'quests_education_card_kicker', 'Education', 1 ),
				$field( 'field_pc_quests_education_card_heading', 'Education カード見出し', 'quests_education_card_heading', '文字文字', 1 ),
				$field( 'field_pc_quests_education_card_body', 'Education カード本文', 'quests_education_card_body', '仮の日本語テキストをここに配置しています。本文の量や折り返しを確認するための文章です。', 4 ),
				$field( 'field_pc_quests_life_1_kicker', 'LIFE 1 ラベル', 'quests_life_1_kicker', 'LIFE', 1 ),
				$field( 'field_pc_quests_life_1_heading', 'LIFE 1 見出し', 'quests_life_1_heading', '文字のある文字', 1 ),
				$field( 'field_pc_quests_life_1_body', 'LIFE 1 本文', 'quests_life_1_body', 'Sample text remains here for layout checking only. The sentence length is adjusted to keep the visual rhythm close to the original.', 4 ),
				$field( 'field_pc_quests_life_2_kicker', 'LIFE 2 ラベル', 'quests_life_2_kicker', 'LIFE', 1 ),
				$field( 'field_pc_quests_life_2_heading', 'LIFE 2 見出し', 'quests_life_2_heading', '文字のある文字', 1 ),
				$field( 'field_pc_quests_life_2_body', 'LIFE 2 本文', 'quests_life_2_body', 'Sample text remains here for layout checking only. The sentence length is adjusted to keep the visual rhythm close to the original.', 4 ),
				$field( 'field_pc_quests_enjoy_kicker', 'Enjoy ラベル', 'quests_enjoy_kicker', 'Enjoy', 1 ),
				$field( 'field_pc_quests_enjoy_heading', 'Enjoy 見出し', 'quests_enjoy_heading', '文字で遊ぶ', 1 ),
				$field( 'field_pc_quests_enjoy_body', 'Enjoy 本文', 'quests_enjoy_body', 'Sample text is placed here as a neutral placeholder. It keeps a similar amount of visible content while removing the original message.', 4 ),
				$field( 'field_pc_quests_closing_big', '下部大きいコピー', 'quests_closing_big', "Sample text for layout\nbalance in this area\nthat keeps the original\nline volume", 4 ),
				$field( 'field_pc_quests_closing_small', '下部小さいコピー（HTML可）', 'quests_closing_small', 'ここにも仮の文字列を<span>同じ量だけ置きます。</span>', 2 ),
			),
			'location'              => $top_location,
			'position'              => 'acf_after_title',
			'style'                 => 'default',
			'label_placement'       => 'top',
			'instruction_placement' => 'label',
			'active'                => true,
		)
	);

	acf_add_local_field_group(
		array(
			'key'                   => 'group_pc_page_quests_service',
			'title'                 => __( 'Quests サービスページ', $text_domain ),
			'fields'                => array(
				$tab( 'field_pc_quests_service_tab_main', 'メイン' ),
				$field( 'field_pc_quests_service_hero_label', 'ヒーロー英字', 'quests_service_hero_label', 'Service', 1 ),
				$field( 'field_pc_quests_service_hero_small', 'ヒーロー小見出し', 'quests_service_hero_small', '文字文字紹介', 1 ),
				$field( 'field_pc_quests_service_about_copy', 'About 上部コピー', 'quests_service_about_copy', "Let's speak English \nand immerse ourselves\nin the world of English", 3 ),
				$field( 'field_pc_quests_service_about_heading', 'About 見出し', 'quests_service_about_heading', '文字と「暮らす」', 1 ),
				$field( 'field_pc_quests_service_about_body', 'About 本文', 'quests_service_about_body', "これは表示確認用の仮文章です。\n文字数と改行の流れを保つために配置した日本語の文章で、\n実際の説明内容として読むことは想定していません。", 8 ),
				$tab( 'field_pc_quests_service_tab_points', '説明・ポイント' ),
				$field( 'field_pc_quests_service_intro_kicker', '説明ラベル', 'quests_service_intro_kicker', 'Samplex Textxx', 1 ),
				$field( 'field_pc_quests_service_intro_heading', '説明見出し', 'quests_service_intro_heading', 'とは', 1 ),
				$field( 'field_pc_quests_service_intro_body', '説明本文', 'quests_service_intro_body', "「サンプル\nテキスト」は表示確認用の仮文章です。文章量と改行位置が大きく変わらないように調整しています。", 3 ),
				$field( 'field_pc_quests_service_point_1_kicker', 'Point 1 ラベル', 'quests_service_point_1_kicker', 'point 1', 1 ),
				$field( 'field_pc_quests_service_point_1_heading', 'Point 1 見出し', 'quests_service_point_1_heading', '文字しか話さない環境', 1 ),
				$field( 'field_pc_quests_service_point_1_body', 'Point 1 本文', 'quests_service_point_1_body', 'ここには日本語のダミーテキストを配置しています。文章の長さ、行の折り返し、見出し下の余白を確認するための内容です。', 4 ),
				$field( 'field_pc_quests_service_point_2_kicker', 'Point 2 ラベル', 'quests_service_point_2_kicker', 'point 2', 1 ),
				$field( 'field_pc_quests_service_point_2_heading', 'Point 2 見出し', 'quests_service_point_2_heading', '文字文字以外の充実したカリキュラム', 1 ),
				$field( 'field_pc_quests_service_point_2_body', 'Point 2 本文', 'quests_service_point_2_body', 'Sample text is used here only to keep the visual length close to the original.', 4 ),
				$field( 'field_pc_quests_service_long_u', '長文ブロック強調ラベル', 'quests_service_long_u', "Samplex\nTextxx", 2 ),
				$field( 'field_pc_quests_service_long_heading', '長文ブロック見出し', 'quests_service_long_heading', 'アイウエオカキクケコとは？', 1 ),
				$field( 'field_pc_quests_service_long_body', '長文ブロック本文', 'quests_service_long_body', "ここには日本語の仮文章を配置し、行の高さと余白を確認します。\n\n対象や内容を示す実文ではなく、文字量を保つための文章です。", 8 ),
				$tab( 'field_pc_quests_service_tab_plan', '料金・エリア・フロー' ),
				$field( 'field_pc_quests_service_plan_heading', 'PLAN 見出し', 'quests_service_plan_heading', 'PLAN', 1 ),
				$field( 'field_pc_quests_service_plan_time', '時間表記', 'quests_service_plan_time', '文字時間7：00～22：00', 1 ),
				$field( 'field_pc_quests_service_price_heading', '料金表見出し', 'quests_service_price_heading', '文字一覧', 1 ),
				$field( 'field_pc_quests_service_price_table', '料金表 HTML', 'quests_service_price_table', '<table><tr><td><div><span style="font-size:0.9em;">１チケット（7:00〜22:00） / １文字</span></div></td><td><div>0,000円</div></td></tr><tr><td><div>１Txt（9文字）</div></td><td><div><span style="font-size:0.9em;">00,000円</span></div></td></tr></table>', 6 ),
				$field( 'field_pc_quests_service_price_note', '料金注記', 'quests_service_price_note', '※表示文字は税込です', 1 ),
				$field( 'field_pc_quests_service_area_heading', '対応エリア見出し', 'quests_service_area_heading', '対応文字列', 1 ),
				$field( 'field_pc_quests_service_area_table', '対応エリア表 HTML', 'quests_service_area_table', '<table><tr><td><div>文字都</div></td><td><div>文字</div></td></tr><tr><td><div>文字文字</div></td><td><div>文字</div></td></tr></table>', 6 ),
				$field( 'field_pc_quests_service_flow_kicker', 'Flow ラベル', 'quests_service_flow_kicker', 'Flow', 1 ),
				$field( 'field_pc_quests_service_flow_heading', 'Flow 見出し', 'quests_service_flow_heading', '文字までの流れ', 1 ),
				$field( 'field_pc_quests_service_flow_1', 'Flow 1', 'quests_service_flow_1', '文字文字文字30分', 1 ),
				$field( 'field_pc_quests_service_flow_2', 'Flow 2', 'quests_service_flow_2', 'テキストのご購入', 1 ),
				$field( 'field_pc_quests_service_flow_3', 'Flow 3', 'quests_service_flow_3', '次回ご文字の日程を選択', 1 ),
				$field( 'field_pc_quests_service_flow_4_heading', 'Flow 4 見出し', 'quests_service_flow_4_heading', 'テキストの選択', 1 ),
				$field( 'field_pc_quests_service_flow_4_body', 'Flow 4 本文', 'quests_service_flow_4_body', "テキスト何枚（何時間）、もしくは１TXT（９文字）かを選択\n※１日８文字までもしくは１Txtが選択できます", 3 ),
				$field( 'field_pc_quests_service_flow_5', 'Flow 5', 'quests_service_flow_5', 'ご文字を希望のテキストを選択する', 1 ),
				$field( 'field_pc_quests_service_flow_6_heading', 'Flow 6 見出し', 'quests_service_flow_6_heading', 'ご文字完了', 1 ),
				$field( 'field_pc_quests_service_flow_6_body', 'Flow 6 本文', 'quests_service_flow_6_body', '※文字・テキストは４８時間前まで', 2 ),
				$field( 'field_pc_quests_service_cta_heading', 'CTA 見出し', 'quests_service_cta_heading', "Let's sample layout\ntogether!", 2 ),
				$field( 'field_pc_quests_service_cta_label', 'CTA ラベル', 'quests_service_cta_label', 'Contact', 1 ),
			),
			'location'              => $location( 'page-templates/quests-service.php' ),
			'position'              => 'acf_after_title',
			'style'                 => 'default',
			'label_placement'       => 'top',
			'instruction_placement' => 'label',
			'active'                => true,
		)
	);
}
add_action( 'acf/init', 'theme_register_acf_quests_page_groups' );
