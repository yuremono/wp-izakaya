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
	define( 'THEME_BRAND_DEFAULT', 'yuremono works' );
}

require_once get_template_directory() . '/inc/helpers.php';
require_once get_template_directory() . '/inc/fallback-menu.php';
require_once get_template_directory() . '/inc/phosphor-icons.php';
require_once get_template_directory() . '/inc/portfolio-defaults.php';
require_once get_template_directory() . '/inc/cpt.php';
require_once get_template_directory() . '/inc/front-page-data.php';
require_once get_template_directory() . '/inc/demo-content.php';
require_once get_template_directory() . '/inc/quests-static.php';
require_once get_template_directory() . '/inc/setup.php';
require_once get_template_directory() . '/inc/enqueue.php';
require_once get_template_directory() . '/inc/acf-portfolio-front.php';
require_once get_template_directory() . '/inc/acf-page-templates.php';
