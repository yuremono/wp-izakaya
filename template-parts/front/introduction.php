<?php
/**
 * Quests introduction section.
 *
 * @package Theme
 */

declare(strict_types=1);

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
                                        <div  class="Intro wrapper100 c337">
                                                <div class="dis">
                                                </div><!-- #c337 -->
                                                <div  class="__v3 fb_para  op7 c349">
                                                        <div class="box">
                                                                <?php theme_quests_image('quests_intro_image', 'images/home/top01.jpg', 'Introduction イメージ'); ?>
                                                                <div></div>
                                                        </div>
                                                </div><!-- #c349 -->
                                                <div  class="clearfix Intro_h js-hide c340">
                                                        <article>
                                                                <h2><em><?php theme_quests_text('quests_intro_kicker', 'Introduction'); ?></em><?php theme_quests_text('quests_intro_heading', 'Hello! This is Sample Text.'); ?>
                                                                </h2>
                                                                <div>
                                                                        <div style='width: 720px;font-weight: bold;'>
                                                                                <?php theme_quests_lines('quests_intro_body', 'ここには、文字数の確認に使うための仮の文章を配置しています。意味を持たない説明文として、見た目の長さや行数が大きく変わらないように調整しています。読み物としての内容ではなく、余白や折り返し、段落の密度を確認するための日本語ダミーテキストです。表示位置や雰囲気を保つため、同じ程度の長さで構成しています。'); ?>
                                                                        </div>
                                                                </div>
                                                        </article>
                                                </div><!-- #c340 -->
                                                <div  class="clearfix mt0 difference Intro_h js-hide c348">
                                                        <div><a class="btn2 floatR" href="<?php echo esc_url( theme_quests_url( 'quests_contact_url', home_url( '/service/' ) ) ); ?>"><i
                                                                           class="las la-chevron-circle-right"></i></a>
                                                        </div>
                                                </div><!-- #c348 -->
                                                <div  class="dis c341">
                                                </div>
                                        </div><!-- #c341 -->
