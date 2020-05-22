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
<div class="container">
    <div class="row">

        <div class="col-md-9 rightcolumn col-md-push-3">




            <h3><strong> Quick Links</strong> to Product</h3>
            <table class="table quicklinks">
                <tbody>
                    <tr>
                        <?php
                        $list_terms = "";
                        $listingsposts = array();
                        /*
                          $terms = get_terms("eq_products", array(
                          'orderby' => 'count',
                          'hide_empty' => 0
                          ));
                          $list_terms = "";
                          //echo "<pre>" . var_dump($terms) . "</pre>";
                          if (!empty($terms) && !is_wp_error($terms)) {

                          foreach ($terms as $term) {
                          $term_taxonomy_id = $term->term_id;
                          $images_raw = get_option('taxonomy_image_plugin');
                          if (array_key_exists($term_taxonomy_id, $images_raw)) {
                          $image = wp_get_attachment_image($images_raw[$term_taxonomy_id], 'full');
                          }
                          $list_terms.="<li><a href='#' onClick='quicksearch(\"" . $term->slug . "\");return false;'>" . $term->name . "</a></li>";
                          echo "<td width=\"20%\"><a href='#' onClick='quicksearch(\"" . $term->slug . "\");return false;'>" . $image . "<br>" . $term->name . "</a></td>";
                          }
                          } */

                        $terms = apply_filters('taxonomy-images-get-terms', '', array(
                            'taxonomy' => 'eq_products',
                        ));
                        if (!empty($terms)) {
                            //print "\n" . '<div class="row">';
                            foreach ((array) $terms as $term) {
                                //print "\n" . '<div class="four columns">';
                                //print "\n\t" . '<a href="' . wp_get_attachment_url( $term->image_id ) . '" rel="lightbox unique-woo-feature">' . wp_get_attachment_image( $term->image_id, 'unique-woo-feature' ) . '</a>';
                                // print "\n\t" . '<h5>' . esc_html( $term->name ) . '</h5>';
                                //print "\n\t" . '<p>' . esc_html( $term->description ) . '</p>';
                                //print "\n" . '</div>';
                                $image = wp_get_attachment_image($term->image_id, 'full');
                                $list_terms.="<li><a href='#' onClick='quicksearch(\"" . $term->slug . "\");return false;'>" . $term->name . "</a></li>";
                                echo "<td width=\"20%\"><a href='#' onClick='quicksearch(\"" . $term->slug . "\");return false;'>" . $image . "<br>" . $term->name . "</a></td>";
                            }
                            //print "\n" . '</div>';
                        }
                        ?>

                    </tr>
                </tbody>
            </table>





            <ul class="navcommunity hidden-lg">
                <?php echo $list_terms; ?>   
            </ul>


            <?php
            $search_result_type = isset($_REQUEST['eqtype']) ? $_REQUEST['eqtype'] : "";
            $term = get_term_by('slug', $search_result_type, 'eq_products');
            if ($term) {
                $search_result_type_name = $term->name;
            } else {
                $search_result_type_name = '';
            }
            ?>
            <h3><strong>Search</strong> Results:<?php echo $search_result_type_name; ?></h3>



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
                <?php while (have_posts()) : the_post(); ?>

                    <?php
                    $thecommunities = isset($_REQUEST['eqcommunitycheck']) ? $_REQUEST['eqcommunitycheck'] : $community_slugs;

                    $cat_slugs = $thecommunities;
                    //var_dump($cat_IDs);

                    $comms = get_post_meta($post->ID, "_eqh_home_community", true);
                    $post->permalink = get_the_permalink();


                    for ($t = 0; $t < count($comms); $t++) {
                        $c = get_term_by('id', $comms[$t], 'eq_communities')->name;
                        $slug = get_term_by('id', $comms[$t], 'eq_communities')->slug;
                        //echo "--SLUG: ">$slug;
                        if (in_array($slug, $cat_slugs)) {
                            $listingsposts[$c][] = $post;
                        }
                    }
                    ?>





                <?php endwhile; // end of the loop.         ?>

            <?php else : ?>

                <?php get_template_part('content', 'none'); ?>

            <?php endif; ?>



            <?php
            if (count($listingsposts) > 0):
                foreach ($listingsposts as $key => $value) {
                    if (count($value) > 0) {
                        ?>

                        <h3 class="columnheader black"><?php echo $key; ?></h3>
                        <div class="row">
                            <?php
                            for ($m = 0; $m < count($value); $m++) {

                                $post = $value[$m];
                                $community = wp_get_post_terms($post->ID, 'eq_communities', array("fields" => "names"));
                                $product_type = wp_get_post_terms($post->ID, 'eq_products', array("fields" => "names"));
                                $bedrooms = wp_get_post_terms($post->ID, 'bedrooms', array("fields" => "names"));
                                $bathrooms = wp_get_post_terms($post->ID, 'bathrooms', array("fields" => "names"));
                                if (get_field('is_landscape', -1000)) {
                                    ?>


                                    <!-- property --> 
                                    <div class="col-xs-12 plisting">

                                        <div class="property  townie">
                                            <h4><?php echo $post->post_title; ?><?php edit_post_link(__('Edit', 'eq_homes'), '<div class="edit">', '</div>'); ?></h4>
                                            <div class="col-md-8 removepad">
                                                <a href="<?php echo $post->permalink . sanitize_title($key) . '/floorplan' ?>">
                                                    <?php $image = get_field("listing_feature_image"); //var_dump($image)      ?>
                                                    <img src="<?php echo $image['sizes']['listing']; ?>" alt="" class="img-responsive col-xs-12 townie">
                                                </a>
                                            </div>
                                            <div class="col-md-4 removepad">

                                                <p>

                                                    Home Type:&nbsp;<strong><?php echo $product_type[0]; ?></strong><br>
                                                    Bedrooms:&nbsp;<strong><?php echo $bedrooms[0]; ?></strong><br>
                                                    Bathrooms:&nbsp;<strong><?php echo $bathrooms[0]; ?></strong><br>
                                                    Price:&nbsp;<strong>$<?php echo number_format(get_post_meta($post->ID, "_eqh_startprice", true), 0, ".", ",") ?></strong><br>
                                                    Square Footage:&nbsp;<strong><?php echo number_format(get_post_meta($post->ID, "_eqh_startsize", true), 0, ".", ",") ?></strong><br>
                                                </p>
                                                <div class="plinks townie">
                                                    <a href="<?php echo $post->permalink . sanitize_title($key) . '/floorplan' ?>" class="pull-left">Floor Plan </a>
                                                    <a href="#" onclick="addToFave('<?php echo $post->ID ?>');" class="pull-right addtofave">Add to Favourites</a>
                                                    <span>|</span>
                                                </div>
                                            </div>
                                            <span class="clearfix"></span>
                                        </div>
                                    </div>    
                                    <!-- /property --> 
                                <?php } else { ?>
                                    <!-- property -->                   
                                    <div class="col-lg-4 col-sm-6 col-xs-12 plisting">
                                        <div class="property">
                                            <h4><?php echo $post->post_title; ?><?php edit_post_link(__('Edit', 'eq_homes'), '<div class="edit">', '</div>'); ?></h4>
                                            <a href="<?php echo $post->permalink . sanitize_title($key) . '/floorplan' ?>">
                                                <?php $image = get_field("listing_feature_image"); //var_dump($image)      ?>
                                                <img src="<?php echo $image['sizes']['listing']; ?>" class="thumbnail img-responsive">
                                            </a>
                                            <p>

                                                Home Type:&nbsp;<strong><?php echo $product_type[0]; ?></strong><br>
                                                Bedrooms:&nbsp;<strong><?php echo $bedrooms[0]; ?></strong><br>
                                                Bathrooms:&nbsp;<strong><?php echo $bathrooms[0]; ?></strong><br>
                                                Price:&nbsp;<strong>$<?php echo number_format(get_post_meta($post->ID, "_eqh_startprice", true), 0, ".", ",") ?></strong><br>
                                                Square Footage:&nbsp;<strong><?php echo number_format(get_post_meta($post->ID, "_eqh_startsize", true), 0, ".", ",") ?></strong><br>
                                            </p>
                                        </div>
                                        <div class="plinks">
                                            <a href="<?php echo $post->permalink . sanitize_title($key) . '/floorplan' ?>" class="pull-left">Floor Plan </a>
                                            <a href="#" onclick="addToFave('<?php echo $post->ID ?>');" class="pull-right addtofave">Add to Favourites</a>
                                            <span>|</span>
                                        </div>
                                    </div>
                                    <!-- /property --> 

                                <?php } ?>



                            <?php } ?>


                        </div>

                        <?php
                    }
                } endif;
            ?>
        </div>

        <div class="col-md-3 leftcolumn col-md-pull-9">



            <h3 class="columnheader green">SEARCH</h3>

            <div class="homesearch">
                <?php echo do_shortcode("[search_bar page='homes']"); ?>   
            </div>



        </div>


    </div>
</div>


<script>
    jQuery(document).ready(function() {
        //jQuery(".commbtn").addClass("active");
        //jQuery(".commbtnmobile").addClass("active");
    });


</script>
<?php get_footer(); ?>
