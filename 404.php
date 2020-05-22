<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package EQ HOMES
 */
get_header();
?>

<div class="container">
    <div class="row">

        <div class="col-xs-12">

            <h3 class="page-title"><?php _e('Oops! That page can&rsquo;t be found.', 'eq_homes'); ?></h3>


            <div class="page-content">
                <p><?php _e('It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'eq_homes'); ?></p>

                <?php get_search_form(); ?>

                <div class="navcommunity">
                    <?php echo do_shortcode("[search_bar page='search']"); ?>
                </div>

            </div><!-- .page-content -->
        </div><!-- .error-404 -->

    </div><!-- #main -->
</div><!-- #primary -->

<?php get_footer(); ?>