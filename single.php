<?php
/**
 * The Template for displaying all single posts.
 *
 * @package EQ HOMES
 */
get_header();
?>

<div id="primary" class="content-area container">
    <main id="main" class="site-main" role="main">

        <?php while (have_posts()) : the_post(); ?>

            <?php get_template_part('content', 'single'); ?>

            <?php //eq_homes_post_nav(); ?>



        <?php endwhile; // end of the loop. ?>

    </main><!-- #main -->
</div><!-- #primary -->

<?php //get_sidebar(); ?>
<?php get_footer(); ?>