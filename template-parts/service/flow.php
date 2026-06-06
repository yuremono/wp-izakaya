<?php
/**
 * Quests flow section.
 *
 * @package Theme
 */

declare(strict_types=1);

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
                                        <div  class="clearfix em-inline c349">
                                                <article>
                                                        <h2><em><?php theme_quests_text('quests_service_flow_kicker', 'Flow'); ?></em><?php theme_quests_text('quests_service_flow_heading', '文字までの流れ'); ?>
                                                        </h2>
                                                        <div></div>
                                                </article>
                                        </div><!-- #c349 -->
                                        <div  class="fb_flow01 c376">
                                                <div class="box">
                                                        <div>
                                                                <h3><?php theme_quests_text('quests_service_flow_1', '文字文字文字30分'); ?>
                                                                </h3>
                                                        </div>
                                                </div>
                                                <div class="box">
                                                        <div>
                                                                <h3><?php theme_quests_text('quests_service_flow_2', 'テキストのご購入'); ?>
                                                                </h3>
                                                        </div>
                                                </div>
                                                <div class="box">
                                                        <div>
                                                                <h3><?php theme_quests_text('quests_service_flow_3', '次回ご文字の日程を選択'); ?>
                                                                </h3>
                                                        </div>
                                                </div>
                                                <div class="box">
                                                        <div>
                                                                <h3><?php theme_quests_text('quests_service_flow_4_heading', 'テキストの選択'); ?>
                                                                </h3>
                                                                <?php theme_quests_lines('quests_service_flow_4_body', "テキスト何枚（何時間）、もしくは１TXT（９文字）かを選択\n※１日８文字までもしくは１Txtが選択できます"); ?><br>
                                                        </div>
                                                </div>
                                                <div class="box">
                                                        <div>
                                                                <h3><?php theme_quests_text('quests_service_flow_5', 'ご文字を希望のテキストを選択する'); ?>
                                                                </h3>
                                                        </div>
                                                </div>
                                                <div class="box">
                                                        <div>
                                                                <h3><?php theme_quests_text('quests_service_flow_6_heading', 'ご文字完了'); ?>
                                                                </h3>
                                                                <?php theme_quests_lines('quests_service_flow_6_body', '※文字・テキストは４８時間前まで'); ?><br>
                                                        </div>
                                                </div>
                                        </div><!-- #c376 -->
                                        <div  class="clearfix it_bnr c357 c357">
                                                <a class="itext imgC"
                                                   href="<?php echo esc_url(theme_quests_url('quests_contact_url', home_url('/service/'))); ?>"
                                                   title="<?php echo esc_attr(theme_quests_meta('quests_service_cta_label', 'Contact')); ?>">
                                                        <?php theme_quests_image('quests_service_cta_image', 'images/home/mv01.jpg', 'サービス CTA イメージ', 'imgC'); ?>
                                                </a>
                                                <div><span
                                                              style='font-size:2em;'><?php theme_quests_lines('quests_service_cta_heading', "Let's sample layout\ntogether!"); ?></span><br />
                                                        <p class="tar" style='font-size:;'><i
                                                                   class="las la-arrow-right"></i><?php theme_quests_text('quests_service_cta_label', 'Contact'); ?>
                                                        </p>
                                                </div>
                                        </div><!-- #c357 -->
