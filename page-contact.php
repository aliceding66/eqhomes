<?php
/**
 * Template Name: Contact Us
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package EQ HOMES
 */
get_header();
$office_query = new WP_Query(array('post_type' => array('office')));
$community_query = new WP_Query(array('post_type' => array('community')));

$my_query = new WP_Query();
$my_query ->posts=array_merge($office_query->posts,$community_query->posts);
$my_query->post_count=count($my_query->posts);
?>
<div class="container" id="contact-page">
    <div class="row">
        <div class="col-xs-12">
            <h3 class="page-title pull-left">eQ HOMES <strong>Contact Information</strong></h3>
            <img class="legend" src="<?php echo get_template_directory_uri(); ?>/images/legend.png"/>
            
        </div>
    </div>
    <p></p>
</div>
<?php while ($my_query->have_posts()) : $my_query->the_post(); ?>
<?php get_template_part('content', 'contact-community'); ?>
<?php endwhile; ?>
<?php get_footer(); ?>