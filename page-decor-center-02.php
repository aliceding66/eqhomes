<?php
/**
 * Template Name: Decor Center
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
<span id="contact-page"></span>
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
                    'theme_location' => 'decor_center',
                    'menu' => 'decor_center',
                    'container' => 'div',
                    'container_class' => 'navpage',
                    'container_id' => '', 'menu_class' => '',));
                ?></div>
            <div class="col-md-9">
                <?php get_template_part('content', 'page'); ?>
                <br style="clear:both">
                <?php if (get_field('display_location')): ?>
                    <div class="col-md-8">
                        <?php
                        if ($navname === "decor-centre") {
                            echo do_shortcode("[office_locator page='decor' id='decor-centre-location']");
                        }
                        ?>
                    </div>
                    <div class="col-md-4">
                        <?php
// The Query 
                        $office = get_field('office');
                        if ($office):
// override $post
                            $post = $office;
                            setup_postdata($post);
                            ?>
                            <?php echo get_post_meta($post->ID, "_eqh_address", true) . "<br>"; ?>
                            <?php echo get_post_meta($post->ID, "_eqh_city", true) . " , " . get_post_meta($post->ID, "_eqh_province", true) . " , " . get_post_meta($post->ID, "_eqh_address2", true) . "<br>"; ?>
						<strong>Tel: </strong><a href="tel:+1<?php echo get_post_meta($post->ID, "_eqh_phone", true); ?>"><?php echo get_post_meta($post->ID, "_eqh_phone", true); ?></a><br>
                            <?php if (get_post_meta($post->ID, "_eqh_tollfreephone", true) != "") { ?>
						<strong>Toll Free: </strong><a href="tel:+<?php echo get_post_meta($post->ID, "_eqh_tollfreephone", true); ?>"><?php echo get_post_meta($post->ID, "_eqh_tollfreephone", true); ?></a><br>    
                            <?php } ?>
                            <strong>Email: </strong><a href="mailto:<?php echo get_post_meta($post->ID, "_eqh_email", true) ?>"><?php echo get_post_meta($post->ID, "_eqh_email", true) . "</a><br><br>"; ?>
                                <strong>Hours of Operation</strong>
                                <div><?php echo nl2br(get_post_meta($post->ID, "_eqh_hours", true)) . "<br>"; ?></div>
                                <?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly  ?>
                            <?php endif; ?>
                        <?php endif; ?>
                </div>


            </div>

        <?php endwhile; // end of the loop.     ?>


    </div>

</div>
<script>
    jQuery(function(){
        jQuery(".m-decor-center").removeClass("active");
        jQuery(".m-decor-center").addClass("active");
    })
    
</script>
<?php //get_sidebar();    ?>
<?php get_footer(); ?>
