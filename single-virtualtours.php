<?php
/**
 * The template for displaying Archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package EQ HOMES
 */
get_header();

$my_query = new WP_Query(array(
                        'post_type' => array('virtualtours'),
                        'posts_per_page' => -1,
                    ));
?>
<?php if (have_posts()) : ?>

    <?php
    $communities = get_terms('eq_communities', array("hide_empty" => 0));
    $community_slugs = wp_list_pluck($communities, 'slug');
    $listingsposts = array();
    foreach ($communities as $term) {
        $str = $term->name;
        $listingsposts[$str] = array();
    }

    //echo $term->name;
    ?>



    <?php
    while ($my_query->have_posts()) : $my_query->the_post();

        $comms = get_post_meta($post->ID, "_eqh_home_community", true);
        $post->permalink = get_the_permalink();


        for ($t = 0; $t < count($comms); $t++) {
            $c = get_term_by('id', $comms[$t], 'eq_communities')->name;
            $slug = get_term_by('id', $comms[$t], 'eq_communities')->slug;
            //echo "--SLUG: ">$slug;
            if (in_array($slug, $community_slugs)) {
                $listingsposts[$c][] = $post;
            }
        }
        ?>

        

    <?php endwhile; ?>




<?php else : ?>

    <?php get_template_part('content', 'none'); ?>

<?php endif; 
wp_reset_query();
?>
<div class="container">
    <div class="row">
        <div class="col-md-3 leftcolumn gallerymenu">
            <h2 class="columnheader black">Virtual Tours</h2>
            <?php
            if (count($listingsposts) > 0):
                foreach ($listingsposts as $key => $value) {
                    if (count($value) > 0) {
                        ?>

                            
                            <?php
                            
                            for ($m = 0; $m < count($value); $m++) {

                                $post = $value[$m];
								
								if($m == 0){
									?>
										
									<h3><?php 
									if(trim($key=="Equinelle")){$key="eQuinelle"; }
										echo   $post->post_content; //$key;//strtoupper($key); ?></h3>
									<ul>
										
										
									<?php
									}
								
                                ?>
             
                                <li class="<?php echo $post->post_name; ?>">
                                    <a href="<?php echo $post->permalink ?>"><?php echo $post->post_title; ?></a>
                                </li>



                            <?php 
                            
                            } ?>
                                
                        </ul>

                        <?php
                    }
                } endif;
            ?>
        </div>

        <div class="col-md-9 rightcolumn gallery">
            <?php $post = $wp_query->post; ?>
            <?php get_template_part('content', 'virtualtours'); ?>

        </div>   

    </div><!-- #main -->
</div><!-- #primary -->

<script>
    jQuery(document).ready(function () {
        jQuery(".btn-virtualtour").addClass("active");
        jQuery(".<?php echo $post->post_name; ?>").addClass("active");
		
    });


</script>
<?php get_footer(); ?>
