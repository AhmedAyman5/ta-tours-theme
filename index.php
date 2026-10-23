<?php
/**
 * Fallback template.
 *
 * @package ta-tours
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>
<div class="ta-section">
	<div class="ta-container ta-prose">
		<?php if ( have_posts() ) : ?>
			<?php
			while ( have_posts() ) :
				the_post();
				?>
				<article <?php post_class( 'ta-entry' ); ?>>
					<h2 class="ta-entry__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
					<?php the_excerpt(); ?>
				</article>
			<?php endwhile; ?>

			<?php the_posts_pagination(); ?>
		<?php else : ?>
			<p><?php echo esc_html( ta_t( 'no_content' ) ); ?></p>
		<?php endif; ?>
	</div>
</div>
<?php
get_footer();
