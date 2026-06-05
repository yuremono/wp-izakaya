<?php
/**
 * Quests page header.
 *
 * @package Theme
 */

declare( strict_types=1 );

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<header id="global_header">
<div id="header" class="h">
		<div class="h_inner">
			<a class="h_logo  h_logotext sawa" href="#" style="color: var(--tx);background-color: var(--un);">
				Page<br>Logo
			</a>
			<!-- <a class="h_logo   " href="#" style="">
				<img class="h_logoimg" src="<?php echo esc_url( theme_quests_source_uri( 'images/home/logo.png' ) ); ?>" alt="ロゴ">
			</a> -->
			<button class="h_menu menu_toggle dots" aria-expanded="false" aria-controls="nav">
				<span class="bar2"></span><span class="bar2 tate"></span><span class="dot1"></span><span class="dot2"></span><span class="dot3"></span>
			</button>
			<div class="h_items ">
				<a class="btn LINE" style="background: #05c554;border-radius: 1vmin" href="#"><img class="h_logoimg" src="<?php echo esc_url( theme_quests_source_uri( 'images/home/line-logo.png' ) ); ?>" alt="">CONTACT</a>
			</div>
			<nav class="h_nav " id="nav">
				<ul>
					<!-- <li><a href="#">home</a></li> -->
					<li><a href="#">Staff</a></li>
					<li><a href="#">Service</a></li>
					<li><a href="#">Recruit</a></li>
					<li><a href="#">Instagram</a></li>
					<li><a href="#">Contact</a></li>
				</ul>
				<div class="focus_trap menu_toggle" tabindex="0"></div>
			</nav>
		</div>
	</div>
	<!-- #global_header --></header>
