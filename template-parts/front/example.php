<?php
/**
 * Example front-page section.
 *
 * @package Theme
 */

declare(strict_types=1);

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<section class="ExampleSection">
	<h2><?php theme_text( 'example_heading', 'Example heading' ); ?></h2>
	<div class="ExampleSection_body">
		<?php theme_rich( 'example_body', '<p>Replace this example section after copying the theme.</p>' ); ?>
	</div>
</section>
