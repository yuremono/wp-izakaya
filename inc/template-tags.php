<?php
/**
 * テンプレートで再利用する補助関数群。
 *
 * @package Theme
 */

declare(strict_types=1);

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * テーマの assets ディレクトリ配下の URI を返す。
 *
 * @param string $relative 相対資産パス。
 * @return string
 */
function theme_source_uri( string $relative = '' ): string {
	return trailingslashit( get_theme_file_uri( 'assets' ) ) . ltrim( $relative, '/' );
}

/**
 * カスタムページテンプレート用の body class を返す。
 *
 * @return array<int, string>
 */
function theme_body_classes(): array {
	$classes = array( 'IzakayaPage' );
	$pages   = array( 'genshu', 'shochu', 'other', 'otsumami', 'insta', 'info' );

	foreach ( $pages as $page ) {
		if ( is_page_template( "page-templates/{$page}.php" ) ) {
			$classes[] = 'IzakayaPage' . ucfirst( $page );
			return apply_filters( 'theme_body_classes', $classes );
		}
	}

	$classes[] = 'IzakayaPageTop';
	return apply_filters( 'theme_body_classes', $classes );
}

/**
 * 現在のリクエストがカスタムテンプレートかどうかを判定する。
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
 * ACF の有無に依存せず、ページの編集値を返す。
 *
 * @param string $field_name フィールド名。
 * @param mixed  $fallback   フォールバック値。
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
 * URL フィールド値を返す。
 *
 * @param string $field_name フィールド名。
 * @param string $fallback フォールバック URL。
 * @return string
 */
function theme_url( string $field_name, string $fallback = '' ): string {
	$url = (string) theme_meta( $field_name, $fallback );

	return '' !== $url ? $url : $fallback;
}

/**
 * ACF の有無に依存せず、共通店舗設定を返す。
 *
 * @param string $field_name フィールド名。
 * @param mixed  $fallback フォールバック値。
 * @return mixed
 */
function theme_option( string $field_name, $fallback = '' ) {
	$value = function_exists( 'get_field' ) ? get_field( $field_name, 'option' ) : get_option( $field_name, '' );

	return theme_acf_value_absent( $value ) ? $fallback : $value;
}

/**
 * 共通店舗 URL を返す。
 *
 * @param string $field_name フィールド名。
 * @param string $fallback フォールバック URL。
 * @return string
 */
function theme_option_url( string $field_name, string $fallback = '' ): string {
	$value = (string) theme_option( $field_name, $fallback );

	return '' !== $value ? $value : $fallback;
}

/**
 * tel URI 用に電話番号を正規化する。
 *
 * @param string $phone 表示用電話番号。
 * @return string
 */
function theme_phone_uri( string $phone ): string {
	return 'tel:' . preg_replace( '/[^0-9+]/', '', $phone );
}

/**
 * 並び順を考慮したコンテンツ投稿を返す。
 *
 * @param string $post_type 登録済み投稿タイプ。
 * @param array  $args クエリ上書き。
 * @return array<int, WP_Post>
 */
function theme_get_content_posts( string $post_type, array $args = array() ): array {
	if ( ! in_array( $post_type, array( 'drink', 'food', 'news' ), true ) ) {
		return array();
	}

	$posts = get_posts(
		array_merge(
			array(
				'post_type'      => $post_type,
				'post_status'    => 'publish',
				'posts_per_page' => -1,
				'orderby'        => array(
					'menu_order' => 'ASC',
					'date'       => 'DESC',
				),
			),
			$args
		)
	);

	return is_array( $posts ) ? $posts : array();
}

/**
 * ACF が使える場合は ACF 経由で投稿メタを返す。
 *
 * @param int    $post_id 投稿 ID。
 * @param string $field_name フィールド名。
 * @param mixed  $fallback フォールバック値。
 * @return mixed
 */
function theme_content_meta( int $post_id, string $field_name, $fallback = '' ) {
	$value = function_exists( 'get_field' )
		? get_field( $field_name, $post_id )
		: get_post_meta( $post_id, $field_name, true );

	return theme_acf_value_absent( $value ) ? $fallback : $value;
}

/**
 * 指定タクソノミーの term に属するコンテンツ投稿を返す。
 *
 * @param string $post_type 登録済み投稿タイプ。
 * @param string $taxonomy 登録済みタクソノミー。
 * @param string $term_slug タームスラッグ。
 * @param array  $args クエリ上書き。
 * @return array<int, WP_Post>
 */
function theme_get_section_posts( string $post_type, string $taxonomy, string $term_slug, array $args = array() ): array {
	return theme_get_content_posts(
		$post_type,
		array_merge(
			array(
				// セクション判定はタクソノミー割り当てを正とする。
				// phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_tax_query
				'tax_query' => array(
					array(
						'taxonomy' => $taxonomy,
						'field'    => 'slug',
						'terms'    => $term_slug,
					),
				),
			),
			$args
		)
	);
}

/**
 * コンテンツ投稿の画像情報を返す。
 *
 * @param int    $post_id 投稿 ID。
 * @param string $fallback_relative 相対フォールバック資産パス。
 * @param string $size 画像サイズ。
 * @return array{url:string,alt:string}
 */
function theme_content_image_data( int $post_id, string $fallback_relative = '', string $size = 'large' ): array {
	$url = (string) get_the_post_thumbnail_url( $post_id, $size );
	$alt = (string) get_post_meta( get_post_thumbnail_id( $post_id ), '_wp_attachment_image_alt', true );

	if ( '' === $url && '' !== $fallback_relative ) {
		$url = theme_source_uri( $fallback_relative );
	}

	return array(
		'url' => $url,
		'alt' => '' !== $alt ? $alt : (string) get_the_title( $post_id ),
	);
}

/**
 * 既存の価格 / 名称リスト構造で CPT を描画する。
 *
 * @param array<int, WP_Post> $posts コンテンツ投稿。
 * @param string              $price_field 価格フィールド名。
 */
function theme_render_menu_posts( array $posts, string $price_field ): void {
	foreach ( $posts as $post ) {
		?>
		<dl>
			<dt><?php echo esc_html( (string) theme_content_meta( $post->ID, $price_field ) ); ?></dt>
			<dd><?php echo esc_html( get_the_title( $post ) ); ?><br></dd>
		</dl>
		<?php
	}
}

/**
 * 既存の feature card 構造で CPT を描画する。
 *
 * @param array<int, WP_Post> $posts コンテンツ投稿。
 * @param string              $price_field 価格フィールド名。
 */
function theme_render_feature_posts( array $posts, string $price_field ): void {
	foreach ( $posts as $post ) {
		$image = theme_content_image_data( $post->ID );
		?>
		<div class="box">
			<article>
				<?php if ( '' !== $image['url'] ) : ?>
					<img src="<?php echo esc_url( $image['url'] ); ?>" alt="<?php echo esc_attr( $image['alt'] ); ?>">
				<?php endif; ?>
				<h3><?php echo esc_html( get_the_title( $post ) ); ?></h3>
				<div>
					<?php echo wp_kses_post( apply_filters( 'the_content', $post->post_content ) ); ?>
					<p><?php echo esc_html( (string) theme_content_meta( $post->ID, $price_field ) ); ?></p>
				</div>
			</article>
		</div>
		<?php
	}
}

/**
 * 既存の SNS アイテム構造でお知らせ投稿を描画する。
 *
 * @param array<int, WP_Post> $posts お知らせ投稿。
 */
function theme_render_news_posts( array $posts ): void {
	foreach ( $posts as $post ) {
		$image = theme_content_image_data( $post->ID );
		$url   = (string) theme_content_meta( $post->ID, 'news_external_url', get_permalink( $post ) );
		?>
		<div>
			<div class="sns_photo">
				<a href="<?php echo esc_url( $url ); ?>" target="_blank" rel="noopener noreferrer">
					<?php if ( '' !== $image['url'] ) : ?>
						<img src="<?php echo esc_url( $image['url'] ); ?>" alt="<?php echo esc_attr( $image['alt'] ); ?>">
					<?php endif; ?>
				</a>
			</div>
			<div class="sns_text">
				<div class="sns_date"><?php echo esc_html( get_the_date( 'Y.m.d', $post ) ); ?></div>
				<div class="caption"><?php echo wp_kses_post( apply_filters( 'the_content', $post->post_content ) ); ?></div>
			</div>
		</div>
		<?php
	}
}

/**
 * 既存の section class を保ったまま焼酎カテゴリを動的描画する。
 *
 * @param string $term_slug カテゴリの term スラッグ。
 * @param string $section_class メイン section class。
 * @param string $menu_class メニュー section class。
 * @param string $fallback_heading 見出しのフォールバック。
 * @param string $fallback_body 本文 HTML のフォールバック。
 * @param string $fallback_image_1 1 枚目のフォールバック画像。
 * @param string $fallback_image_2 2 枚目のフォールバック画像。
 * @return bool 動的投稿を描画したかどうか。
 */
function theme_render_shochu_section( string $term_slug, string $section_class, string $menu_class, string $fallback_heading, string $fallback_body, string $fallback_image_1, string $fallback_image_2 ): bool {
	$posts = theme_get_section_posts( 'drink', 'drink_category', $term_slug );
	if ( ! $posts ) {
		return false;
	}
	?>
	<div class="fl50wide <?php echo esc_attr( $section_class ); ?>">
		<div class="clearfix">
			<article>
				<h2><?php theme_text( "shochu_{$term_slug}_heading", $fallback_heading ); ?></h2>
				<div><?php theme_rich( "shochu_{$term_slug}_body", $fallback_body ); ?></div>
			</article>
		</div>
		<div class="twopicR wrapGrid">
			<div class="box"><?php theme_image( "shochu_{$term_slug}_image_1", $fallback_image_1 ); ?><div></div></div>
			<div class="box"><?php theme_image( "shochu_{$term_slug}_image_2", $fallback_image_2 ); ?><div></div></div>
		</div>
	</div>
	<div class="fl50 mt20 gap3mi <?php echo esc_attr( $menu_class ); ?>">
		<div class="form_wrap dl_menu">
			<?php theme_render_menu_posts( $posts, 'drink_price' ); ?>
		</div>
	</div>
	<?php
	return true;
}

/**
 * デフォルトのサイトナビゲーションを描画する。
 *
 * @param array<string, mixed> $args WordPress のフォールバックコールバック引数。
 */
function theme_menu_fallback( array $args = array() ): void {
	$items = array(
		'ホーム'    => '/',
		'焼酎の原酒'  => '/genshu/',
		'本格焼酎'   => '/shochu/',
		'その他のお酒' => '/other/',
		'おつまみ'   => '/otsumami/',
		'お知らせ'   => '/insta/',
		'店舗案内'   => '/info/',
	);
	$class = isset( $args['menu_class'] ) ? (string) $args['menu_class'] : 'menu';
	?>
	<ul class="<?php echo esc_attr( $class ); ?>">
		<?php foreach ( $items as $label => $path ) : ?>
			<li><a href="<?php echo esc_url( home_url( $path ) ); ?>"><?php echo esc_html( $label ); ?></a></li>
		<?php endforeach; ?>
	</ul>
	<?php
}

/**
 * 編集可能な画像フィールドを正規化する。
 *
 * @param string $field_name フィールド名。
 * @param string $fallback_relative 相対フォールバック資産パス。
 * @param string $fallback_alt フォールバック代替テキスト。
 * @param string $size WordPress 画像サイズ。
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
 * 編集可能な画像を出力する。
 *
 * @param string $field_name フィールド名。
 * @param string $fallback_relative 相対フォールバック資産パス。
 * @param string $fallback_alt フォールバック代替テキスト。
 * @param string $css_class 任意の CSS class。
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
 * エスケープ済みテキストを出力する。
 *
 * @param string $field_name フィールド名。
 * @param string $fallback フォールバック文字列。
 */
function theme_text( string $field_name, string $fallback = '' ): void {
	echo esc_html( (string) theme_meta( $field_name, $fallback ) );
}

/**
 * エスケープ済みの複数行テキストを出力する。
 *
 * @param string $field_name フィールド名。
 * @param string $fallback フォールバック文字列。
 */
function theme_lines( string $field_name, string $fallback = '' ): void {
	echo nl2br( esc_html( (string) theme_meta( $field_name, $fallback ) ) );
}

/**
 * 編集可能なリッチテキストで許可する HTML を返す。
 *
 * @return array<string, mixed>
 */
function theme_allowed_html(): array {
	return wp_kses_allowed_html( 'post' );
}

/**
 * サニタイズしたリッチテキストを出力する。
 *
 * @param string $field_name フィールド名。
 * @param string $fallback フォールバック HTML。
 */
function theme_rich( string $field_name, string $fallback = '' ): void {
	echo wp_kses( (string) theme_meta( $field_name, $fallback ), theme_allowed_html() );
}
