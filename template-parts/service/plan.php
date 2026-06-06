<?php
/**
 * Quests plan section.
 *
 * @package Theme
 */

declare(strict_types=1);

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
                                        <div  class="clearfix difference ml0 c360">
                                                <article>
                                                        <h2><em><?php theme_quests_text('quests_service_plan_heading', 'PLAN'); ?></em>
                                                        </h2>
                                                        <div></div>
                                                </article>
                                        </div><!-- #c360 -->
                                        <div  class="clearfix c377">
                                                <div><?php theme_quests_text('quests_service_plan_time', '文字時間7：00～22：00'); ?>
                                                </div>
                                        </div><!-- #c377 -->
                                        <div  class="clearfix c372">
                                                <article>
                                                        <h3><?php theme_quests_text('quests_service_price_heading', '文字一覧'); ?>
                                                        </h3>
                                                        <div></div>
                                                </article>
                                        </div><!-- #c372 -->
                                        <div  class="tbl_normal  c370">
                                                <article>
                                                        <?php
                                                        theme_quests_table(
                                                                'quests_service_price',
                                                                array(
                                                                        array( '１チケット（7:00〜22:00） / １文字', '0,000円' ),
                                                                        array( '１Txt（9文字）', '00,000円' ),
                                                                        array( '文字同行（文字費・文字・文字費別）', '文字列' ),
                                                                ),
                                                                'quests_service_price_table'
                                                        );
                                                        ?>
                                                </article>
                                        </div><!-- #c370 -->
                                        <div  class="clearfix  c375">
                                                <div><?php theme_quests_text('quests_service_price_note', '※表示文字は税込です'); ?>
                                                </div>
                                        </div><!-- #c375 -->
                                        <div  class="clearfix  c373">
                                                <article>
                                                        <h3><?php theme_quests_text('quests_service_area_heading', '対応文字列'); ?>
                                                        </h3>
                                                        <div></div>
                                                </article>
                                        </div><!-- #c373 -->
                                        <div  class="tbl_normal  c374">
                                                <article>
                                                        <?php
                                                        theme_quests_table(
                                                                'quests_service_area',
                                                                array(
                                                                        array( '文字都', '文字' ),
                                                                        array( '文字文字', '文字' ),
                                                                        array( '文字県', '文字' ),
                                                                        array( '文字県', '文字' ),
                                                                ),
                                                                'quests_service_area_table'
                                                        );
                                                        ?>
                                                </article>
                                        </div><!-- #c374 -->
