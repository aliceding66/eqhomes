<?php
/**
 * The template for displaying Archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package EQ HOMES
 */
get_header();
?>
<div class="container-fluid map">
    <?php echo do_shortcode("[post_locator post_type='community' page='community']"); ?>    
</div>
<?php if (have_posts()) : ?>

    <div class="container">
        <div class="row"><h3 class="page-title">eQ HOMES <strong>Communities</strong></h3></div>
    </div>



    <?php /* Start the Loop */ ?>
    <?php while (have_posts()) : the_post(); ?>

         <?php get_template_part('content', 'community'); ?>

    <?php endwhile; ?>

    <?php eq_homes_paging_nav(); ?>

<?php else : ?>

    <?php get_template_part('content', 'none'); ?>

<?php endif; ?>


<?php get_footer(); ?>
