<?php
/**
 * Example page content skeleton.
 *
 * @package Theme
 */

declare(strict_types=1);

if ( ! defined( 'ABSPATH' ) ) {
		exit;
}
?>
<div id="contents_wrap">
		<div id="contents" class="clearfix ">
				<div id="main" class="clearfix">
						<div id="col_main">
								<section>
										<?php get_template_part( 'template-parts/example/example' ); ?>
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
