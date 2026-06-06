<?php
/**
 * Quests page content.
 *
 * @package Theme
 */

declare(strict_types=1);

if (!defined('ABSPATH')) {
        exit;
}
?>
<div id="contents_wrap">
        <div id="contents" class="clearfix">
                <div id="main" class="clearfix">
                        <div id="col_main">
                                <section>
                                        <?php get_template_part( 'template-parts/front/hero' ); ?>
                                        <?php get_template_part( 'template-parts/front/about' ); ?>
                                        <?php get_template_part( 'template-parts/front/introduction' ); ?>
                                        <?php get_template_part( 'template-parts/front/features' ); ?>
                                        <?php get_template_part( 'template-parts/front/education' ); ?>
                                        <?php get_template_part( 'template-parts/front/life' ); ?>
                                        <?php get_template_part( 'template-parts/front/enjoy' ); ?>
                                        <?php get_template_part( 'template-parts/front/social' ); ?>
                                </section>

                                <!-- #col_main -->
                        </div>
                        <!-- #main -->
                </div>
                <!-- #contents -->
        </div>
        <!-- #contents_wrap -->
</div>
