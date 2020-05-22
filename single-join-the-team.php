<?php
/**
 * The Template for displaying all single posts.
 *
 * @package EQ HOMES
 */
get_header();
?>

<style>
	.join-the-team .news{
		border-bottom: none;
	}
	
</style>
<div id="primary" class="content-area container">
    <main id="main" class="site-main join-the-team" role="main">

        <?php while (have_posts()) : the_post(); ?>

            <?php get_template_part('content', 'single'); ?>


        <?php endwhile; // end of the loop. ?>

    </main><!-- #main -->
</div><!-- #primary -->

<script>
        jQuery(document).ready(function () {
        //getActive("btn-gallery");
        jQuery(".btn-jointheteam").addClass("active");
    //jQuery(".commbtnmobile").addClass("active");
    });


</script>

<?php //get_sidebar(); ?>
<?php get_footer(); ?>