<?php
/**
 * Default page template.
 *
 * @package ta-tours
 */

defined( 'ABSPATH' ) || exit;

get_header();

while ( have_posts() ) :
	the_post();
	get_template_part( 'template-parts/page-header' );
	?>
	<div class="ta-section">
		<div class="ta-container ta-prose">
			<?php the_content(); ?>
		</div>
	</div>
	<?php
endwhile;

get_footer();
