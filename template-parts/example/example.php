<?php
/**
 * Example fixed-page section.
 *
 * @package Theme
 */

declare(strict_types=1);

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<section class="ExampleSection">
	<h1><?php theme_text( 'example_heading', 'Example page' ); ?></h1>
	<?php theme_image( 'example_image', '', 'Example image', 'ExampleSection_image' ); ?>
	<div class="ExampleSection_body">
		<?php theme_rich( 'example_body', '<p>Replace this section with the page-specific markup.</p>' ); ?>
	</div>
</section>
