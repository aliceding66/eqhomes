<?php
/**
 * Template Name: Blog Page Template
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

                    <?php if (get_post_meta($post->ID, "_eqh_use_banner_overlay", true) == "on"): ?>
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
                <?php get_template_part('content', 'page'); ?>

		<?php endwhile; ?>

		<?php $query = new WP_Query( 'category_name=blog&posts_per_page=10' ); ?>
 		<?php if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post(); ?>
            

		<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

                                	<div class="post-header">

                                    		<h2 class="blog-head"><a href="<?php the_permalink(); ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>

                                        </div><!--.post-header-->

                                        <div class="entry clear">

                                        	<div class="feature"> <?php if ( function_exists( 'add_theme_support' ) ) the_post_thumbnail(); ?></div>

                                            	<?php the_content(); ?>
						<hr>

                                            </div><!--. entry-->

                                        </div><!-- .post-->
                                
		<?php endwhile; ?>
		<nav class="navigation index">

                	<div class="alignleft"><?php next_posts_link( 'Older Entries' ); ?></div>

                        <div class="alignright"><?php previous_posts_link( 'Newer Entries' ); ?></div>

                </nav><!--.navigation-->
		<?php endif; ?>

	</div>
        
    </div>

</div>
<script>
    jQuery(function() {
        jQuery(".m-why-eq-homes").removeClass("active");
        jQuery(".m-why-eq-homes").addClass("active");
    })

</script>

<?php //get_sidebar();  ?>
<?php get_footer(); ?>