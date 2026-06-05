<?php
/**
 * Fallback template.
 *
 * @package Theme
 */

declare(strict_types=1);

if ( is_front_page() ) {
	require get_template_directory() . '/front-page.php';
	return;
}

get_header();
?>

<section class="archive wrap">
	<h1 class="archive_title"><?php echo esc_html( THEME_BRAND_DEFAULT ); ?></h1>
	<p class="archive_empty"><?php esc_html_e( 'ページが見つかりませんでした。メニューからお進みください。', THEME_GETTEXT_DOMAIN ); ?></p>
</section>

<?php
get_footer();
