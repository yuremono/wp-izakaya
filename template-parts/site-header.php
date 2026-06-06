<?php
/**
 * Site header.
 *
 * @package Kanoo
 */

declare(strict_types=1);

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<header id="global_header">
						<div id="header" class="h ">
								<div class="h_inner ">
										<div class="h_logo ">
												<a class="h_logolink" href="<?php echo esc_url( home_url( '/' ) ); ?>">
														<img class="h_logoimg" src="<?php echo esc_url( theme_source_uri( 'images/home/logo.png' ) ); ?>"
															srcset="<?php echo esc_url( theme_source_uri( 'images/home/logo.png' ) ); ?> 1x, <?php echo esc_url( theme_source_uri( 'images/home/logo2x.png' ) ); ?> 2x"
															alt="ロゴ">
												</a>
										</div>
										<button class="h_menu menu_toggle" aria-expanded="false" aria-controls="nav">
												<!--<span class="bar1"></span>-->
												<span class="bar2"></span>
												<!--<span class="bar3"></span>-->
												<span class="bar2 tate"></span>
												<span class="dot1"></span>
												<span class="dot2"></span>
												<span class="dot3"></span>
										</button>
										<div class="h_items ">
												<a class="h_btn h_tel" href="tel:048-788-5390"><i
															class="fa-solid fa-phone"></i>048-788-5390</a>
												<a class="h_btn h_contact" href="#"><i
															class="fa-solid fa-envelope"></i>お問い合わせ</a>
										</div>
										<nav class="h_nav " id="nav">
												<ul>
														<li><a href="<?php echo esc_url( home_url( '/' ) ); ?>">ホーム</a></li>
														<li><a href="<?php echo esc_url( home_url( '/genshu/' ) ); ?>">焼酎の原酒</a></li>
														<li><a href="<?php echo esc_url( home_url( '/shochu/' ) ); ?>">本格焼酎</a></li>
														<li><a href="<?php echo esc_url( home_url( '/other/' ) ); ?>">その他のお酒</a></li>
														<li><a href="<?php echo esc_url( home_url( '/otsumami/' ) ); ?>">おつまみ</a></li>
														<li><a href="<?php echo esc_url( home_url( '/insta/' ) ); ?>">お知らせ</a></li>
														<li><a href="<?php echo esc_url( home_url( '/info/' ) ); ?>">店舗案内</a></li>
												</ul>
												<div class="focus_trap menu_toggle" tabindex="0"></div>
										</nav>
								</div>
						</div>
						<!-- #global_header -->
				</header>
