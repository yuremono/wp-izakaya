<?php
/**
 * Site footer.
 *
 * @package Kanoo
 */

declare(strict_types=1);

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<footer id="global_footer">
						<div id="footer" class="f">
								<div class="f_main"
									style="background-image: url(<?php echo esc_url( theme_source_uri( 'images/home/bg02.jpg' ) ); ?>);background-color: var(--mc);">
										<div class="f_info">
												<h2 class="f_name">焼酎BAR鹿尾</h2>
												<div class="form_01">
														<dl>
																<dt>所在地</dt>
																<dd>〒362-0075<br>埼玉県上尾柏座1-10-3-86　2号室</dd>
														</dl>
														<dl>
																<dt>TEL</dt>
																<dd>048-788-5390</dd>
														</dl>
														<dl>
																<dt>営業時間</dt>
																<dd>火～土曜日17:00～2:00<br>日曜日15:00～0:00</dd>
														</dl>
														<dl>
																<dt>定休日</dt>
																<dd>月曜日</dd>
														</dl>
												</div>
										</div>
										<div class="f_map"><iframe
														src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3228.8165076784535!2d139.5853233!3d35.9759113!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x6018c58beb3cd877%3A0xdd13460d55202704!2z44CSMzYyLTAwNzUg5Z-8546J55yM5LiK5bC-5biC5p-P5bqn77yR5LiB55uu77yR77yQ4oiS77yT4oiS77yY77yW!5e0!3m2!1sja!2sjp!4v1693370012149!5m2!1sja!2sjp"
														width="100%" height="400" style="border:0;" allowfullscreen=""
														loading="lazy"
														referrerpolicy="no-referrer-when-downgrade"></iframe></div>
								</div>
								<nav class="f_nav">
										<ul>
												<li><a href="<?php echo esc_url( home_url( '/' ) ); ?>">ホーム</a></li>
												<li><a href="<?php echo esc_url( home_url( '/genshu/' ) ); ?>">焼酎の原酒</a></li>
												<li><a href="<?php echo esc_url( home_url( '/shochu/' ) ); ?>">本格焼酎</a></li>
												<li><a href="<?php echo esc_url( home_url( '/other/' ) ); ?>">その他のお酒</a></li>
												<li><a href="<?php echo esc_url( home_url( '/otsumami/' ) ); ?>">おつまみ</a></li>
												<li><a href="<?php echo esc_url( home_url( '/insta/' ) ); ?>">お知らせ</a></li>
												<li><a href="<?php echo esc_url( home_url( '/info/' ) ); ?>">店舗案内</a></li>
										</ul>
								</nav>
								<div class="f_copy ">2023-焼酎BAR鹿尾</div>
						</div>
						<!-- #global_footer -->
				</footer>
