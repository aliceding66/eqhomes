<?php
/**
 * The template part for displaying a message that posts cannot be found.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package EQ HOMES
 */
?>

<div class="container">
    <div class="row">


        <div class="col-xs-12">
            <h1 class="page-title"><?php _e('Nothing Found', 'eq_homes'); ?></h1>
            <?php if (is_home() && current_user_can('publish_posts')) : ?>

                <p><?php printf(__('Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'eq_homes'), esc_url(admin_url('post-new.php'))); ?></p>

            <?php elseif (is_search()) : ?>

                <p><?php _e('Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'eq_homes'); ?></p>
                <?php get_search_form(); ?>
                <div class="navcommunity">
                <?php echo do_shortcode("[search_bar page='search']");?>
                </div>
            <?php else : ?>

                <p><?php _e('It seems we can&rsquo;t find what you&rsquo;re looking for. ', 'eq_homes'); //Perhaps searching can help.  ?></p>
                <?php //get_search_form(); ?>

            <?php endif; ?>
        </div>


    </div>

</div>
