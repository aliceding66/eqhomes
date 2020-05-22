<?php
/**
 * Template Name: Favourites
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

        <div class="col-md-9 rightcolumn col-md-push-3">

            <?php
            //echo $_COOKIE["favourites"];
            $numfaves = 0;
            if (isset($_COOKIE["favourites"])) {
                //echo "THERES STILL A COOKIE";
                $faves = array(0 => '');
                if (strpos($_COOKIE["favourites"], ',') !== FALSE) {
                    $faves = explode(",", $_COOKIE["favourites"]);
                    $numfaves = count($faves);
                }
                if (trim($_COOKIE["favourites"]) != "" && (strpos($_COOKIE["favourites"], ',') == FALSE)) {
                    $faves = array(0 => $_COOKIE["favourites"]);
                    $numfaves = 1;
                }
                //echo "FAVES";
                //print_r($faves);
                $args = array(
                    'post_type' => array('home', 'movein'),
                    'post__in' => $faves
                );
                global $wp_query;
                $my_query = new WP_Query($args);

                $posts = $my_query->get_posts();
                ?>
                <h3><strong>My &nbsp;</strong>Favourites (<?php echo $numfaves; ?>)<small>faves</small></h3>

                <div class="row">
                    <div class="col-xs-12 sort">
                        <span>Sort:</span>
                        <select id="sort">
                            <option value="">Select here to sort</option>
                            <option value="priceDESC">Price High to Low</option>
                            <option value="priceASC">Price Low to High</option>
                            <option value="sqftDESC">Square Feet High to Low</option>
                            <option value="sqftASC">Square Feet Low to High</option>
                            <option value="bedDESC">Bedrooms High to Low</option>
                            <option value="bedASC">Bedrooms Low to High</option>
                            <option value="bathDESC">Bathrooms High to Low</option>
                            <option value="bathASC">Bathrooms Low to High</option>
                        </select>
                    </div>
                </div>
                <div class="propertyList">
                    <?php
                    foreach ($posts as $post) {
                        $product_type = wp_get_post_terms($post->ID, 'eq_products', array("fields" => "names"));
                        $bedrooms = wp_get_post_terms($post->ID, 'bedrooms', array("fields" => "names"));
                        $bathrooms = wp_get_post_terms($post->ID, 'bathrooms', array("fields" => "names"));


                        $term_list = wp_get_post_terms($post->ID, 'eq_communities', array("fields" => "names"));

                        $term_list = implode(', ', $term_list);
                        $find = ',';
                        $replace = ' & ';
                        $result = preg_replace(strrev("/$find/"), strrev($replace), strrev($term_list), 1);
                        $communities = strrev($result);

                        //$cms = get_post_meta($post->ID, "_eqh_home_community", true);
                        $cms = wp_get_post_terms($post->ID, 'eq_communities', array("fields" => "slugs"));
                       	//print_r( "<pre>".var_export($cms)."</pre>");
						
                        //$current_cm = get_term_by('id', $cms[0], 'eq_communities')->slug;
                        $current_cm = $cms[0];

                        $current_cm_id = get_page_by_slug($current_cm, OBJECT, $post_type = 'community')->ID;
						
						
						$eq_lasso_crm_id =  get_post_meta($current_cm_id, "_eqh_lasso_crm_id", true);
						
                        ?>




                        <div class="row propertySingle">
                            <h3 class="columnheader black"><?php echo $communities; ?>
                                <?php echo gk_social_buttons(get_the_permalink() . $current_cm . '/floorplan'); ?>
                            </h3>

                            <div class="col-xs-12 favourite">
                                <div class="col-lg-4">
                                    <?php $image = get_field("listing_feature_image"); //var_dump($image)      ?>
                                    <img src="<?php echo $image['sizes']['listing']; ?>" class="img-responsive col-xs-12">

                                </div>
                                <div class="col-xs-12 col-md-4 col-lg-5 details">
                                    <h3><?php echo the_title() ?>

                                    </h3>

                                    <?php
                                    $posttype = get_post_type($post->ID);
                                    if ($posttype == "movein") {
                                        ?>
                                        Home Type: <strong><?php echo implode(', ', $product_type); ?></strong><br>
                                        <strong><?php echo get_post_meta($post->ID, "_eqh_unit_lot", true); ?></strong>: <strong><?php echo get_post_meta($post->ID, "_eqh_identifier", true); ?></strong><br>
                                        Bedrooms: <strong><?php
                                            $beds = (wp_get_post_terms($post->ID, 'bedrooms', array("fields" => "names")));
                                            echo $beds[0];
                                            ?></strong><br>
                                        Bathrooms: <strong><?php
                                            $baths = (wp_get_post_terms($post->ID, 'bathrooms', array("fields" => "names")));
                                            echo $baths[0];
                                            ?></strong><br>
                                        Now: <strong>$<?php echo number_format(get_post_meta($post->ID, "_eqh_startprice", true), 0, ".", ",") ?></strong><br>
                                        Price: <strong>$<?php echo number_format(get_post_meta($post->ID, "_eqh_endprice", true), 0, ".", ",") ?></strong><br>
                                        **Total Savings: <strong><?php echo get_post_meta($post->ID, "_eqh_total_savings", true) ?></strong><br>



                                    <?php } else { ?>
                                        Home Type: <strong> <?php echo $product_type[0]; ?></strong><br>
                                        Bedrooms: <strong> <?php echo $bedrooms[0]; ?></strong><br>
                                        Bathrooms: <strong> <?php echo $bathrooms[0]; ?></strong><br>


                                        <?php
                                                    $start_price = get_post_meta($post->ID, "_eqh_startprice", true);

                                                    if ($start_price == "00") {
                                                        ?>
                                                        <strong>Price:&nbsp;</strong>Coming Soon<br>
                                                        <?php
                                                    } else {
                                                        ?>

                                            Price: <strong> $<?php echo number_format(get_post_meta($post->ID, "_eqh_startprice", true), 0, ".", ",") ?></strong><br>

            <?php } ?>          

                                        Square Footage: <strong><?php echo number_format(get_post_meta($post->ID, "_eqh_startsize", true), 0, ".", ",") ?></strong><br>
        <?php } ?>
                                    <input type="hidden" class="sortPrice" value="<?php echo (int) trim(get_post_meta($post->ID, "_eqh_startprice", true)); ?>">
                                    <input type="hidden" class="sortFootage" value="<?php echo (int) trim(get_post_meta($post->ID, "_eqh_startsize", true)); ?>">
                                    <input type="hidden" class="sortBedroom" value="<?php echo $bedrooms[0]; ?>">
                                    <input type="hidden" class="sortBathroom" value="<?php echo $bathrooms[0]; ?>">
                                </div>
                                <div class="col-xs-12 col-md-6 col-lg-3">
                                    <ul class="">
                                        <li><a href="#" onclick="deleteFave('<?php echo $post->ID ?>');" class="addtofave">Remove Favourites</a></li>

                                        <li><a href="#" onclick="jQuery('#myModalLabel').html('Book a Tour : &nbsp;<?php echo $post->post_title; ?>');
                                        				jQuery('#t-community-lasso-id').val('<?php echo $eq_lasso_crm_id; ?>');
                                                        jQuery('#t-movein').val('<?php echo $post->post_title; ?>');
                                                        jQuery('#t-movein-id').val('<?php echo $current_cm_id; ?>');" data-toggle="modal" data-target="#bookATour">Book a Tour</a></li>
                                            <?php
                                            $posttype = get_post_type($post->ID);
                                            if ($posttype == "movein") {
                                                ?>
                                            <li><a href="<?php echo get_field("info_sheet", $post->ID); ?>" target="_blank">Info Sheet</a></li>
                                        <?php } else { ?>
                                            <li><a href="<?php echo the_permalink() . $current_cm . '/floorplan' ?>" class="">Floor Plan</a></li>
        <?php } ?>




                                    </ul>
                                </div>

                            </div>
                        </div>


    <?php }// end for each     ?>

                </div>
                <?php
            } else {
                ?>
                <h3><strong>You have no &nbsp;</strong>Favourites</h3>

                <?php
            }
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

<!-- Modal -->
<div class="modal fade" id="bookATour" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <img src="<?php echo get_template_directory_uri(); ?>/images/eqhomeslogo.png" alt=""/>
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h2 class="modal-title" id="myModalLabel"></h2>
            </div>
            <div class="modal-body">

                <form name="tour-form" id="tour-form" action="#" method="post">
                    <div id='tour-alert' style='color:red'></div>
                    
                    <!-- lasso elements -->
                    <input type="hidden" name="domainAccountId" id="domainAccountId" value="LAS-382183-01" />
                    <input type="hidden" name="guid" id="guid" value="" />
                    <!-- lasso elements ends -->                    
                    
                    <input type="hidden" name="t-community-lasso-id" id="t-community-lasso-id"/>  
                    
                    <input type='hidden' name="t-movein" id="t-movein" />
                    <input type='hidden' name="t-movein-id" id="t-movein-id" />
                    <div class="col-sm-5 label required">*First Name:</div>
                    <div class="col-sm-7"><input class="form-control" name="t-first_name" type="text" id="t-first_name" /></div>

                    <div class="col-sm-5 label required">*Last Name:</div>
                    <div class="col-sm-7"><input class="form-control" name="t-last_name" type="text" id="t-last_name"/></div>

                    <div class="col-sm-5 label">Address:</div>
                    <div class="col-sm-7"><input class="form-control" name="t-address" type="text" id="t-address"  /></div>

                    <div class="col-sm-5 label">City:</div>
                    <div class="col-sm-7"><input class="form-control" name="t-city" type="text" id="t-city"  /></div>

                    <div class="col-sm-5 label">Prov/State:</div>
                    <div class="col-sm-7"><input class="form-control" name="t-province" type="text" id="t-province" /></div>

                    <div class="col-sm-5 label required">*Postal Code:</div>
                    <div class="col-sm-7"><input class="form-control" name="t-postal" type="text" id="t-postal"/></div>

                    <div class="col-sm-5 label required">*Phone:</div>
                    <div class="col-sm-7"><input class="form-control" name="t-phone" type="text" id="t-phone" /></div>

                    <div class="col-sm-5 label required">*Email:</div>
                    <div class="col-sm-7"><input class="form-control" name="t-email" type="text" id="t-email"/></div>

                    <div class="col-sm-5 label">Comments:</div>
                    <div class="col-sm-7"><textarea class="form-control" name="t-comments" type="textarea" id="t-comments"></textarea></div>

<?php wp_nonce_field('book-tour-nonce', 'booktour'); ?>
                    <div> <button type="button" onclick="jQuery('#myModalLabel').html('');" class="btn btn-default" data-dismiss="modal">Close</button><button type="submit" class="btn btn-primary pull-right">Submit</button></div>

                </form>



            </div>
            <div class="modal-footer">

                <!--<button type="button" class="btn btn-primary">Save changes</button>-->
            </div>
        </div>
    </div>
</div>

<script>
    jQuery(document).ready(function () {
        getActive("btn-favourite");
        //jQuery(".commbtn").addClass("active");
        //jQuery(".commbtnmobile").addClass("active");
    });


</script>
<?php get_footer(); ?>
