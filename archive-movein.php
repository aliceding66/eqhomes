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

		<div class="col-xs-12">
			<div class="pagebanner">
				<img class="img-responsive col-xs-12" src="https://www.eqhomes.ca/wp-content/uploads/2019/01/fireplace.jpg" alt="Designer Finished Home"/>
				<h3 class="title"><strong>Designer</strong>&nbsp;Finished Homes</h3>
			</div>
			<p>&nbsp;</p>
			<p>Own a new home styled by our award-winning Design Team. Every Designer Finished Home includes show-stopping features and finishes expertly selected for their timeless beauty.</p>

			<?php /*
			<p>You’ve dreamed of a new home for months if not years. Now you’re ready to move and you don’t want to wait another day longer to make that dream a reality.</p>

<p>eQ Homes knows that feeling. That’s why we’re offering you our Designer Finished Homes for your consideration. Our award-winning Interior Design Team (the best in the business!) has hand-selected all of the show-stopping features and finishes in these unique Homes. They are all top-of-the-line interior appointments, all chosen for their timeless beauty, and all designed to enrich your life.</p>

Selecting a Designer Finished Home makes your life easier, and makes the whole buying process simpler and less-time consuming. Best of all, you get to see everything the new home has BEFORE you move in. So don’t put off your dreams until tomorrow – the perfect Designer Finished Home is waiting for you to move in today!
</p>
*/ ?>

		</div>




    </div>
</div>

<?php /*
<div class="container">
    <div class="row">
        <?php
        $moveinpage = get_field('linked_page', 'option');

        $my_query = new WP_Query('page_id=' . $moveinpage->ID);
        ?>
        <?php while ($my_query->have_posts()) : $my_query->the_post(); ?>

            <div class="col-xs-12">
                <div class="pagebanner">
                    <img class="img-responsive col-xs-12" src="<?php echo get_field("page_banner"); ?>" alt=""/>
                    <h3 class="title"><strong><?php echo get_post_meta($post->ID, "_eqh_bold", true) ?></strong>&nbsp;<?php echo get_post_meta($post->ID, "_eqh_normal", true) ?></h3>
                    <?php //the_title( '<h3 class="title">', '</h3>' ); ?>
                </div>

            </div>

            <?php
        endwhile; // end of the loop.
        wp_reset_query();
        ?>


    </div>
</div>
*/ ?>

<?php if (have_posts()) : ?>
    <div class="container">
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
        while (have_posts()) : the_post();

            $comms = get_post_meta($post->ID, "_eqh_home_community", true);
            $post->permalink = get_the_permalink();


            $terms = get_the_terms($post->ID, 'eq_communities');
//echo($terms[0]->slug).'<br><br>';
            $post->permalink = get_the_permalink();
            if (in_array($terms[0]->slug, $community_slugs)) {
                $listingsposts[$terms[0]->name][] = $post;
            }


            //$slug = get_term_by('id', $comms[0], 'eq_communities')->slug;
            //$listingsposts[$slug][] = $post;
            ?>



        <?php endwhile; ?>




    <?php else : ?>

        <?php get_template_part('content', 'none'); ?>

    <?php endif; ?>


    <?php
    if (count($listingsposts) > 0):
        foreach ($listingsposts as $key => $value) {
            if (count($value) > 0) {


                $community_title_slug = get_term_by('name', $key, 'eq_communities')->slug;
                //$my_post = get_page_by_title($community_title_slug, OBJECT, 'community');
                $my_post = get_page_by_slug(sanitize_title($community_title_slug), OBJECT, 'community');
                $term_list = wp_get_post_terms($my_post->ID, 'eq_products', array("fields" => "names"));
                $term_list = implode(', ', $term_list);
                $find = ',';
                $replace = ' & ';
                $result = preg_replace(strrev("/$find/"), strrev($replace), strrev($term_list), 1);
                $products = strrev($result);

				$eq_lasso_crm_id =  get_post_meta($my_post->ID, "_eqh_lasso_crm_id", true);
                ?>

                <div class="col-xs-12 moveheading" id="<?php if ($key=='Greystone Village'){echo'greystone';} ?>"">
                    <div class="col-xs-4 col-md-2"><?php echo get_the_post_thumbnail($my_post->ID, 'full', array('class' => 'img-responsive')); ?></div>
                    <div class="col-xs-8 col-md-6 info">
                        <?php echo $key; ?>&nbsp;| &nbsp;<?php echo get_post_meta($my_post->ID, "_eqh_town", true); ?><br>
                        <?php echo get_post_meta($my_post->ID, "_eqh_hometypes", true); ?><?php //echo $products; ?>
                    </div>
                    <div class="col-xs-12 col-md-4 contact">
                        Tel:&nbsp;<a href="tel:+1<?php echo get_post_meta($my_post->ID, "_eqh_phone", true); ?>"><?php echo get_post_meta($my_post->ID, "_eqh_phone", true); ?></a><br>
                        <?php if (get_post_meta($my_post->ID, "_eqh_tollfreephone", true) != "") { ?>
                            Toll Free:&nbsp;<a href="tel:+<?php echo get_post_meta($my_post->ID, "_eqh_tollfreephone", true); ?>"><?php echo get_post_meta($my_post->ID, "_eqh_tollfreephone", true); ?></a><br>
                        <?php } ?>
                        Email:&nbsp; <a href="mailto:<?php echo get_post_meta($my_post->ID, "_eqh_email", true) ?>"><?php echo get_post_meta($my_post->ID, "_eqh_email", true) . "</a>"; ?>

						<?php

							$currentCommunityEmail = get_post_meta($my_post->ID, "_eqh_email", true);
						?>

                    </div>
                </div>



                <div class="row">
                    <?php
                    for ($m = 0; $m < count($value); $m++) {

                        $post = $value[$m];
                        ?>

                        <div class="col-xs-12 movein">
                            <div class="col-md-6">
                                <div class="col-xs-12 col-md-6">
                                    <?php $image = get_field("listing_feature_image", $post->ID); //var_dump($image)     ?>
                                    <img src="<?php echo $image['sizes']['listing']; ?>" class="img-responsive col-xs-12">
                <!--      <a href="<?php echo $post->permalink . sanitize_title($key) . '/floorplan' ?>"> <img src="<?php echo $image['sizes']['listing']; ?>" class="img-responsive col-xs-12"></a>
                                    -->
                                </div>
                                <div class="col-xs-12 col-md-6 info">
                                    <?php
                                    $product_type = wp_get_post_terms($post->ID, 'eq_products', array("fields" => "names"));
                                    $bedrooms = wp_get_post_terms($post->ID, 'bedrooms', array("fields" => "names"));
                                    $bathrooms = wp_get_post_terms($post->ID, 'bathrooms', array("fields" => "names"));
                                    ?>

                                    <h3 id="<?php if ($post->post_title=='Jatoba at Fernbank Crossing'){echo 'greystone-tag';}?>"><?php echo $post->post_title; ?></h3>


                                    <strong><?php echo get_post_meta($post->ID, "_eqh_unit_lot", true); ?></strong>: <strong><?php echo get_post_meta($post->ID, "_eqh_identifier", true); ?></strong><br>
                                    Square Footage: <strong><?php echo number_format(get_post_meta($post->ID, "_eqh_startsize", true), 0, ".", ",") ?></strong><br>
                                    Home Type: <strong><?php echo implode(', ', $product_type); ?></strong><br>
                                    Bedrooms: <strong><?php
                                        $beds = (wp_get_post_terms($post->ID, 'bedrooms', array("fields" => "names")));
                                        echo $beds[0];
                                        ?></strong><br>
                                    Bathrooms: <strong><?php
                                        $baths = (wp_get_post_terms($post->ID, 'bathrooms', array("fields" => "names")));
                                        echo $baths[0];
                                        ?></strong><br>
                                    <?php
                                    $is_saving = get_post_meta($post->ID, "_eqh_is_saving", true);
                                    if ($is_saving) {
                                        ?>
                                        <span style="text-decoration: line-through;">Price: <strong>$<?php echo number_format(get_post_meta($post->ID, "_eqh_endprice", true), 0, ".", ",") ?></strong></span><br>
                                        <?php
                                    }
                                    ?>

                                    <?php
										if(get_post_meta($post->ID, "_eqh_startprice", true) > 100){
									?>
                                    	Now: <strong>$<?php echo number_format(get_post_meta($post->ID, "_eqh_startprice", true), 0, ".", ",") ?></strong><br>

                                    <?php

										}
									?>


                                    <?php
                                    $is_saving = get_post_meta($post->ID, "_eqh_is_saving", true);
                                    if ($is_saving) {
                                        ?>
                                        **Total Savings: <strong><?php echo get_post_meta($post->ID, "_eqh_total_savings", true) ?></strong><br>
                                        <?php
                                    }
                                    ?>

                                    <ul class="hidden-lg hidden-md">
                                        <li><a class="btn btn-success" type="button" href="<?php echo get_field("info_sheet", $post->ID); ?>" target="_blank">Info Sheet</a></li>
                                        <?php /*
										<li><a class="btn btn-success" type="button" href="#" onclick="jQuery('#myModalLabel').html('Book a Tour : &nbsp;<?php echo $post->post_title; ?>');
                                                jQuery('#t-community-lasso-id').val('<?php echo $eq_lasso_crm_id; ?>');
                                                jQuery('#t-movein').val('<?php echo $post->post_title; ?>');
                                                jQuery('#t-lot').val('<?php echo get_post_meta($post->ID, "_eqh_unit_lot", true) . " : ". get_post_meta($post->ID, "_eqh_identifier", true); ?>');
                                                jQuery('#t-movein-id').val('<?php echo $my_post->ID; ?>');" data-toggle="modal" data-target="#bookATour">Book a Tour</a></li>


                                        <li><a class="btn btn-success addtofave" type="button" href="#" onclick="addToFave('<?php echo $post->ID ?>');">Add to Favourites</a></li>
                                        */ ?>

										<li><a class="btn btn-success addtofave" type="button" href="mailto:<?php echo $currentCommunityEmail; ?>?subject=Designer Finished Home - <?php echo get_post_meta($post->ID, "_eqh_unit_lot", true); ?> : <?php echo get_post_meta($post->ID, "_eqh_identifier", true); ?>" onclick="addToFave('<?php echo $post->ID ?>');">Inquire</a></li>

                                         <?php
											// display only if there is MLS url
											$mlsURL = get_field("mls_listing", $post->ID);

											if(strlen($mlsURL) > 5){
										?>
												 <li><a class="btn btn-success" type="button" href="<?php echo $mlsURL; ?>" target="_blank">MLS Listing</a></li>
										<?php

											}

											$albumArray = get_field("album", $post->ID);

										//print_r($albumArray);

										if($albumArray){
											$imageCount = 0;

											foreach ($albumArray as $image):

												if($imageCount == 0){
											?>
												<li><a class="btn btn-success" type="button" href="<?php echo $image['sizes']['medium_large']; ?>" title="" data-gallery="set<?php echo $post->ID; ?>">Gallery</a></li>
											<?php
												}else{
											?>
												<a href="<?php echo $image['sizes']['medium_large']; ?>" title="" data-gallery="set<?php echo $post->ID; ?>" style="display:none">Gallery</a>

											<?php
												}
												$imageCount++;
											endforeach;
										}

										?>


                                    </ul>
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-4 desc">
                                <strong>CLOSING DATE</strong>: <strong><?php echo get_post_meta($post->ID, "_eqh_closing_date", true); ?></strong><br>
                                <?php echo nl2br($post->post_content); ?>
                            </div>
                            <div class="col-xs-4 col-md-2">
                                <ul class="visible-lg visible-md movein-nav">
                                    <li><a class="btn btn-success" type="button" href="<?php echo get_field("info_sheet", $post->ID); ?>" target="_blank">DESIGNER<br>DREAM BOOK</a></li>
									<?php /*
                                    <li><a class="btn btn-success" type="button" href="#" onclick="jQuery('#myModalLabel').html('Book a Tour : &nbsp;<?php echo $post->post_title; ?>');
                                    		jQuery('#t-community-lasso-id').val('<?php echo $eq_lasso_crm_id; ?>');
                                            jQuery('#t-movein').val('<?php echo $post->post_title; ?>');
                                            jQuery('#t-lot').val('<?php echo get_post_meta($post->ID, "_eqh_unit_lot", true) . " : ". get_post_meta($post->ID, "_eqh_identifier", true); ?>');
                                            jQuery('#t-movein-id').val('<?php echo $my_post->ID; ?>');" data-toggle="modal" data-target="#bookATour">Book a Tour</a></li>

                                    <li><a class="btn btn-success addtofave" type="button" href="#" onclick="addToFave('<?php echo $post->ID ?>');">Add to Favourites</a></li>
									*/ ?>

									<li><a class="btn btn-success addtofave" type="button" href="mailto:<?php echo $currentCommunityEmail; ?>?subject=Designer Finished Home - <?php echo get_post_meta($post->ID, "_eqh_unit_lot", true); ?> : <?php echo get_post_meta($post->ID, "_eqh_identifier", true); ?>" onclick="addToFave('<?php echo $post->ID ?>');">Inquire</a></li>

                                    <?php
										// display only if there is MLS url
										$mlsURL = get_field("mls_listing", $post->ID);

										if(strlen($mlsURL) > 5){
									?>
                                    		 <li><a class="btn btn-success" type="button" href="<?php echo $mlsURL; ?>" target="_blank">MLS Listing</a></li>
                                    <?php

										}


										$albumArray = get_field("album", $post->ID);

										//print_r($albumArray);

										if($albumArray){
											$imageCount = 0;

											foreach ($albumArray as $image):

												if($imageCount == 0){
											?>
												<li><a class="btn btn-success" type="button" href="<?php echo $image['sizes']['medium_large']; ?>" title="" data-gallery="set<?php echo $post->ID; ?>">Gallery</a></li>
											<?php
												}else{
											?>
												<a href="<?php echo $image['sizes']['medium_large']; ?>" title="" data-gallery="set<?php echo $post->ID; ?>" style="display:none">Gallery</a>

											<?php
												}
												$imageCount++;
											endforeach;
										}


									?>








                                </ul>
                            </div>
                        </div>

                        <?php
                    }
                    ?>
                </div>

                <?php
            }
        } endif;
    ?>

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
                    <input type='hidden' name="t-lot" id="t-lot" />
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






<!-- The Bootstrap Image Gallery lightbox, should be a child element of the document body -->
<div id="blueimp-gallery" class="blueimp-gallery" data-use-bootstrap-modal="false">
    <!-- The container for the modal slides -->
    <div class="slides"></div>
    <!-- Controls for the borderless lightbox -->
    <h3 class="title"></h3>
    <a class="prev">‹</a>
    <a class="next">›</a>
    <a class="close">×</a>
    <a class="play-pause"></a>
    <ol class="indicator"></ol>
    <!-- The modal dialog, which will be used to wrap the lightbox content -->
    <div class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" aria-hidden="true">&times;</button>
                    <h4 class="modal-title"></h4>
                </div>
                <div class="modal-body next"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left prev">
                        <i class="glyphicon glyphicon-chevron-left"></i>
                        Previous
                    </button>
                    <button type="button" class="btn btn-primary next">
                        Next
                        <i class="glyphicon glyphicon-chevron-right"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<p style="font-size: 10px; text-align: center;">All finishes, products and colours are pre-selected in eQ Designer Finished Homes and cannot be modified. See agent for details. E.&.O.E</p>

<script>
    jQuery(document).ready(function () {
        //getActive("btn-gallery");
        jQuery(".btn-movein").addClass("active");
        //jQuery(".commbtnmobile").addClass("active");
    });


</script>
<?php get_footer(); ?>
