<?php
/**
 * Quests page content.
 *
 * @package Theme
 */

declare(strict_types=1);

if ( ! defined( 'ABSPATH' ) ) {
		exit;
}
?>
<div id="contents_wrap">
		<div id="contents" class="clearfix">
				<div id="main" class="clearfix">
						<div id="col_main">
								<section>
										<div id="c324" class="clearfix bg_slide">
												<ul>
														<li>
																<img src="<?php echo esc_url( theme_quests_source_uri( 'images/home/mv02.jpg' ) ); ?>" alt="">
														</li>
												</ul>
										</div><!-- #c324 -->
										<div id="c322" class="clearfix mv_it  js-hide mt0">
												<div>
														<h1 style="font-size:1em;">
																<span><?php theme_quests_text( 'quests_service_hero_label', 'Service' ); ?></span><small><?php theme_quests_text( 'quests_service_hero_small', '文字文字紹介' ); ?></small></h1>
												</div>
										</div><!-- #c322 -->
										<div id="c344" class="pan1 __center">
												<pan></pan>
										</div><!-- #c344 -->
										<div id="c351" class="About bg100 mt0">
												<div class="dis">
												</div><!-- #c351 -->
												<div id="c352" class="clearfix mv_it02  js-hide">
														<div><span style="font-size:1em;"><?php theme_quests_lines( 'quests_service_about_copy', "Let's speak English \nand immerse ourselves\nin the world of English" ); ?></span></div>
												</div><!-- #c352 -->
												<div id="c353" class="clearfix About_tx">
														<div>
																<h2 class="h1FZ"><?php theme_quests_text( 'quests_service_about_heading', '文字と「暮らす」' ); ?></h2><br />
																<span style='margin-top:0em;'><?php theme_quests_lines( 'quests_service_about_body', "これは表示確認用の仮文章です。\n文字数と改行の流れを保つために配置した日本語の文章で、\n実際の説明内容として読むことは想定していません。\n余白、行間、段落の見え方を確認するため、\n近い長さの文を並べています。\n画面内での密度が大きく変わらないよう、\n日本語のままダミーの内容に差し替えています。\nここでは意味よりもレイアウト確認を優先します。\n「仮の文章をここに配置しています」\n「同じ程度の長さになるよう調整しています」\n「本文の見た目だけを確認するための文字列です」\nSample Textは説明本文ではありません。\n表示確認のための仮の文言を配置し、全体の分量を\n元の構成に近づけています。" ); ?></span>
														</div>
												</div><!-- #c353 -->
												<div id="c354" class="dis">
												</div>
										</div><!-- #c354 -->
										<div id="c266" class="mtB15 Education bg100 child1680  bg_fix">
												<div class="bg_half" style="background:var(--bk80)"></div>
												<div class="dis">
												</div><!-- #c266 -->
												<div id="c299" class="clearfix difference ml0 em-inline">
														<article>
																<h2><em><?php theme_quests_text( 'quests_service_intro_kicker', 'Samplex Textxx' ); ?></em><?php theme_quests_text( 'quests_service_intro_heading', 'とは' ); ?></h2>
																<div><?php theme_quests_lines( 'quests_service_intro_body', "「サンプル\nテキスト」は表示確認用の仮文章です。文章量と改行位置が大きく変わらないように調整し、内容としての意味を持たせず、見た目のバランスだけを確認できるようにしています。" ); ?>
																</div>
														</article>
												</div><!-- #c299 -->
												<div id="c326" class="clearfix txR txwh em-itaric">
														<article>
																<h3><em><?php theme_quests_text( 'quests_service_point_1_kicker', 'point 1' ); ?></em><?php theme_quests_text( 'quests_service_point_1_heading', '文字しか話さない環境' ); ?></h3>
																<div><?php theme_quests_lines( 'quests_service_point_1_body', 'ここには日本語のダミーテキストを配置しています。文章の長さ、行の折り返し、見出し下の余白を確認するための内容です。実際のサービス説明ではなく、画面上の密度を保つために、同程度の分量で構成しています。必要以上に意味を持たせず、読み物ではない仮文として扱えるようにしています。' ); ?>
																</div>
														</article>
												</div><!-- #c326 -->
												<div id="c268" class="dis">
												</div>
										</div><!-- #c268 -->
										<div id="c327" class="Education bg100 child1680 bg_fix">
												<div class="bg_half __left" style="background:var(--wh80)"></div>
												<div class="dis">
												</div><!-- #c327 -->
												<div id="c329" class="clearfix txL mt0 Germany em-itaric">
														<article>
																<h3><em><?php theme_quests_text( 'quests_service_point_2_kicker', 'point 2' ); ?></em><?php theme_quests_text( 'quests_service_point_2_heading', '文字文字以外の充実したカリキュラム' ); ?></h3>
																<div><?php theme_quests_lines( 'quests_service_point_2_body', "Sample\ntext is used here only to keep the visual length close to the original. The surrounding Japanese portion is also generic placeholder wording, so this block can be checked without leaving the original message in place." ); ?>
																</div>
														</article>
												</div><!-- #c329 -->
												<div id="c364" class="dis">
												</div>
										</div><!-- #c364 -->
										<div id="c378" class="LongText Quests wrapper100 in1680">

												<div id="c381" class="clearfix mtB15 Quests_h js-hide H-center">
														<article>
																<h2><u style="font-size:1em;"><?php theme_quests_lines( 'quests_service_long_u', "Samplex\nTextxx" ); ?></u><?php theme_quests_text( 'quests_service_long_heading', 'アイウエオカキクケコとは？' ); ?></h2>
																<div>
																		<div class="mgi-auto"
																			style='width: 720px;font-weight: bold;'>
																				<br />
																				<span style='font-size:1.0em;'>
																						<?php theme_quests_lines( 'quests_service_long_body', "ここには日本語の仮文章を配置し、行の高さと余白を確認します。\n\n対象や内容を示す実文ではなく、文字量を保つための文章です。\n\n段落の見え方が大きく変わらないよう、同程度の長さで調整しています。\n\n（仮として）\n・日本語の仮文を通じて表示の密度を確認\n・見た目の分量を保つためのサンプルテキスト！\n・意味を持たない文章を並べて、折り返しを確認します！\n\nここに続く文章もダミーです。元の説明文が残らないようにしながら、表示のまとまりが崩れない程度の文字量で構成しています。\n最後の行も確認用の日本語テキストとして配置しています" ); ?></span><br />
																		</div>
																</div>
														</article>
												</div><!-- #c381 -->
												<div id="c379" class="__v1 fb_para box-parallax op7">
														<div class="box">
																<img src="<?php echo esc_url( theme_quests_source_uri( 'images/home/servide01.jpg' ) ); ?>" alt="">
																<div></div>
														</div>
														<div class="box">
																<img src="<?php echo esc_url( theme_quests_source_uri( 'images/home/service02.jpg' ) ); ?>" alt="">
																<div></div>
														</div>
												</div><!-- #c379 -->
												<div id="c380" class="__v2 fb_para box-parallax op7">
														<div class="box">
																<img src="<?php echo esc_url( theme_quests_source_uri( 'images/home/service03.jpg' ) ); ?>" alt="">
																<div></div>
														</div>
														<div class="box">
																<img src="<?php echo esc_url( theme_quests_source_uri( 'images/home/service04.jpg' ) ); ?>" alt="">
																<div></div>
														</div>
												</div><!-- #c380 -->

										</div><!-- #c382 -->
										<div id="c360" class="clearfix difference ml0">
												<article>
														<h2><em><?php theme_quests_text( 'quests_service_plan_heading', 'PLAN' ); ?></em></h2>
														<div></div>
												</article>
										</div><!-- #c360 -->
										<div id="c377" class="clearfix ">
												<div><?php theme_quests_text( 'quests_service_plan_time', '文字時間7：00～22：00' ); ?></div>
										</div><!-- #c377 -->
										<div id="c372" class="clearfix ">
												<article>
														<h3><?php theme_quests_text( 'quests_service_price_heading', '文字一覧' ); ?></h3>
														<div></div>
												</article>
										</div><!-- #c372 -->
										<div id="c370" class="tbl_normal ">
												<article>
														<?php
														theme_quests_rich(
															'quests_service_price_table',
															'<table>
                                                                <tr>
                                                                        <td id="c370_cell_1_1" class="">
                                                                                <div><span style="font-size:0.9em;">１チケット（7:00〜22:00）
                                                                                                / １文字</span></div>
                                                                        </td>
                                                                        <td id="c370_cell_2_1" class="">
                                                                                <div>0,000円</div>
                                                                        </td>
                                                                </tr>
                                                                <tr>
                                                                        <td id="c370_cell_1_2" class="">
                                                                                <div>１Txt（9文字）</div>
                                                                        </td>
                                                                        <td id="c370_cell_2_2" class="">
                                                                                <div><span
                                                                                              style="font-size:0.9em;">00,000円</span>
                                                                                </div>
                                                                        </td>
                                                                </tr>
                                                                <tr>
                                                                        <td id="c370_cell_1_3" class="">
                                                                                <div>文字同行（文字費・文字・文字費別）</div>
                                                                        </td>
                                                                        <td id="c370_cell_2_3" class="">
                                                                                <div>文字列</div>
                                                                        </td>
                                                                </tr>
                                                        </table>'
														);
														?>
												</article>
										</div><!-- #c370 -->
										<div id="c375" class="clearfix ">
												<div><?php theme_quests_text( 'quests_service_price_note', '※表示文字は税込です' ); ?></div>
										</div><!-- #c375 -->
										<div id="c373" class="clearfix ">
												<article>
														<h3><?php theme_quests_text( 'quests_service_area_heading', '対応文字列' ); ?></h3>
														<div></div>
												</article>
										</div><!-- #c373 -->
										<div id="c374" class="tbl_normal ">
												<article>
														<?php
														theme_quests_rich(
															'quests_service_area_table',
															'<table>
                                                                <tr>
                                                                        <td id="c374_cell_1_1" class="">
                                                                                <div>文字都</div>
                                                                        </td>
                                                                        <td id="c374_cell_2_1" class="">
                                                                                <div>文字</div>
                                                                        </td>
                                                                </tr>
                                                                <tr>
                                                                        <td id="c374_cell_1_2" class="">
                                                                                <div>文字文字</div>
                                                                        </td>
                                                                        <td id="c374_cell_2_2" class="">
                                                                                <div>文字</div>
                                                                        </td>
                                                                </tr>
                                                                <tr>
                                                                        <td id="c374_cell_1_3" class="">
                                                                                <div>文字県</div>
                                                                        </td>
                                                                        <td id="c374_cell_2_3" class="">
                                                                                <div>文字</div>
                                                                        </td>
                                                                </tr>
                                                                <tr>
                                                                        <td id="c374_cell_1_4" class="">
                                                                                <div>文字県</div>
                                                                        </td>
                                                                        <td id="c374_cell_2_4" class="">
                                                                                <div>文字</div>
                                                                        </td>
                                                                </tr>
                                                        </table>'
														);
														?>
												</article>
										</div><!-- #c374 -->
										<div id="c349" class="clearfix em-inline">
												<article>
														<h2><em><?php theme_quests_text( 'quests_service_flow_kicker', 'Flow' ); ?></em><?php theme_quests_text( 'quests_service_flow_heading', '文字までの流れ' ); ?></h2>
														<div></div>
												</article>
										</div><!-- #c349 -->
										<div id="c376" class="fb_flow01">
												<div class="box">
														<div>
																<h3><?php theme_quests_text( 'quests_service_flow_1', '文字文字文字30分' ); ?></h3>
														</div>
												</div>
												<div class="box">
														<div>
																<h3><?php theme_quests_text( 'quests_service_flow_2', 'テキストのご購入' ); ?></h3>
														</div>
												</div>
												<div class="box">
														<div>
																<h3><?php theme_quests_text( 'quests_service_flow_3', '次回ご文字の日程を選択' ); ?></h3>
														</div>
												</div>
												<div class="box">
														<div>
																<h3><?php theme_quests_text( 'quests_service_flow_4_heading', 'テキストの選択' ); ?></h3>
																<?php theme_quests_lines( 'quests_service_flow_4_body', "テキスト何枚（何時間）、もしくは１TXT（９文字）かを選択\n※１日８文字までもしくは１Txtが選択できます" ); ?><br>
														</div>
												</div>
												<div class="box">
														<div>
																<h3><?php theme_quests_text( 'quests_service_flow_5', 'ご文字を希望のテキストを選択する' ); ?></h3>
														</div>
												</div>
												<div class="box">
														<div>
																<h3><?php theme_quests_text( 'quests_service_flow_6_heading', 'ご文字完了' ); ?></h3><?php theme_quests_lines( 'quests_service_flow_6_body', '※文字・テキストは４８時間前まで' ); ?><br>
														</div>
												</div>
										</div><!-- #c376 -->
										<div id="c357" class="clearfix it_bnr">
												<a class="itext imgC" href="#" title="">
														<img src="<?php echo esc_url( theme_quests_source_uri( 'images/home/mv01.jpg' ) ); ?>" alt="" class="imgC">
												</a>
												<div><span style='font-size:2em;'><?php theme_quests_lines( 'quests_service_cta_heading', "Let's sample layout\ntogether!" ); ?></span><br />
														<p class="tar" style='font-size:;'><i
																	class="las la-arrow-right"></i><?php theme_quests_text( 'quests_service_cta_label', 'Contact' ); ?></p>
												</div>
										</div><!-- #c357 -->
								</section>

								<!-- #col_main -->
						</div>
						<aside id="col_side1">

								<!-- #col_side1 -->
						</aside>
						<!-- #main -->
				</div>
				<div id="side">
						<aside id="col_side2">

								<!-- #col_side2 -->
						</aside>
						<!-- #side -->
				</div>
				<!-- #contents -->
		</div>
		<!-- #contents_wrap -->
</div>
