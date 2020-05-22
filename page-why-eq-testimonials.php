<?php
/**
 * Template Name: Why EQ Homes - Testimonials
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

            <?php $image = get_field('page_banner'); ?>

            <div class="col-xs-12">
                <div class="pagebanner">
                    <img class="img-responsive col-xs-12" src="<?php echo $image; ?>" alt="<?php echo the_title(); ?>"/>
                    <?php if(get_post_meta($post->ID, "_eqh_use_banner_overlay", true)=="on"):?>
                    <h3 class="title"><strong><?php echo get_post_meta($post->ID, "_eqh_bold", true) ?></strong>&nbsp;<?php echo get_post_meta($post->ID, "_eqh_normal", true) ?></h3>
                    <?php endif; ?>
                </div>

            </div>

            <div class="col-md-3">
                &nbsp;
                <?php
                $navname = $post->post_name;

                wp_nav_menu(array(
                    'theme_location' => 'why_eq_homes',
                    'menu' => 'why_eq_homes',
                    'container' => 'div',
                    'container_class' => 'navpage',
                    'container_id' => '', 'menu_class' => '',));
                ?></div>
            <div class="col-md-9">
                <h1>Video Testimonials</h1>
                <?php
                $my_query = new WP_Query(array(
                    'post_type' => array('testimonial'),
                    'posts_per_page' => -1,
                    'ignore_sticky_posts' => 1,
                ));
                ?>
                <?php while ($my_query->have_posts()) : $my_query->the_post();
                    ?>
                    <div class="col-sm-6">

                        <a class="youtube" href="<?php echo get_post_meta($post->ID, "_eqh_video", true); ?>">
                            <?php
                            $thumbnail = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full');
                            ?>
                            <img src="<?php echo $thumbnail['0']; ?>" /> 
                        </a>
                    </div>
                    <?php
                endwhile;
                wp_reset_query();
                ?>

            </div>

        <?php endwhile; // end of the loop.   ?>


    </div>

</div>
<script>
    jQuery(function() {
        jQuery(".m-why-eq-homes").removeClass("active");
        jQuery(".m-why-eq-homes").addClass("active");
    })

</script>
<?php //get_sidebar();   ?>
<?php get_footer(); ?>