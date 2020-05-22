<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package EQ HOMES
 */
?>


<div class="col-xs-12">
    <?php if (get_field("headline")): ?>
        <h1><?php the_field("headline"); ?></h1>
    <?php endif; ?> 


    <div class="entry-content">
        <?php the_content(); ?>
        <?php
        wp_link_pages(array(
            'before' => '<div class="page-links">' . __('Pages:', 'eq_homes'),
            'after' => '</div>',
        ));
        ?>
    </div><!-- .entry-content -->

    <?php edit_post_link(__('Edit', 'eq_homes'), '<div class="edit">', '</div>'); ?>
</div>
