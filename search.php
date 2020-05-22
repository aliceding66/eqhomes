<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package EQ HOMES
 */

get_header(); ?>

	<div class="container">
		<div class="row">

		<?php if ( have_posts() ) : ?>

			<div class="col-xs-12">
				<h3 class="page-title"><?php printf( __( 'Search Results for: %s', 'eq_homes' ), '<span>' . get_search_query() . '</span>' ); ?></h3>
			</div><!-- .page-header -->

			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>

				<?php
				/**
				 * Run the loop for the search to output the results.
				 * If you want to overload this in a child theme then include a file
				 * called content-search.php and that will be used instead.
				 */
				get_template_part( 'content', 'search' );
				?>

			<?php endwhile; ?>

			<?php eq_homes_paging_nav(); ?>

		<?php else : ?>

			<?php get_template_part( 'content', 'none' ); ?>

		<?php endif; ?>

		</div><!-- #main -->
	</div><!-- #primary -->


<?php get_footer(); ?>
