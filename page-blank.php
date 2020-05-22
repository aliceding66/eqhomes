<?php
/**
 * Template Name: Blank Page
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package EQ HOMES
 */
get_header();
?>

<div class="container">
    <div class="row">



        <?php while (have_posts()) : the_post(); ?>

            <?php get_template_part('content', 'page'); ?>



        <?php endwhile; // end of the loop. ?>


    </div>
</div>

<?php //get_sidebar(); ?>
<?php get_footer(); ?>
