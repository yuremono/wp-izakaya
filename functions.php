<?php
/**
 * Theme bootstrap.
 *
 * @package Theme
 */

declare(strict_types=1);

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/** Translation text domain. */
define( 'THEME_GETTEXT_DOMAIN', 'site-theme' );

/** Cache-busting version for theme assets. */
define( 'THEME_VERSION', '1.0.0' );

if ( ! defined( 'THEME_BRAND_DEFAULT' ) ) {
	define( 'THEME_BRAND_DEFAULT', 'Quests' );
}

require_once get_template_directory() . '/inc/helpers.php';
require_once get_template_directory() . '/inc/quests-static.php';
require_once get_template_directory() . '/inc/setup.php';
require_once get_template_directory() . '/inc/enqueue.php';
require_once get_template_directory() . '/inc/acf-quests-pages.php';
