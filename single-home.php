<?php
/**
 * The Template for displaying all single posts.
 *
 * @package EQ HOMES
 */
get_header();


global $wp_the_query;
$current_fp = get_query_var('view');
//echo $current_fp;

$current_cm = get_query_var('comm');


if (strlen($current_cm) > 0) {

} else {
    $cms = get_post_meta($post->ID, "_eqh_home_community", true);
    $current_cm = get_term_by('id', $cms[0], 'eq_communities')->slug;
}

//echo "CCM: ".$current_cm;


$my_post = get_page_by_slug(sanitize_title($current_cm), OBJECT, 'community');


$term_list = wp_get_post_terms($my_post->ID, 'eq_products', array("fields" => "names"));
$term_list = implode(', ', $term_list);
$find = ',';
$replace = ' & ';
$result = preg_replace(strrev("/$find/"), strrev($replace), strrev($term_list), 1);
$products = strrev($result);

if(strlen($products) < 2){
	$products = '<h3 class="">&nbsp;</h3>';
}else{
	$products =  '<h3 class=""><strong>Collection of &nbsp;</strong>' . $products . '</h3>';
}


?>
<div class="container">
    <div class="row">

        <div class="col-md-9 rightcolumn col-md-push-3">
            <div class="row">
                <div class="col-md-3"><span><br><?php echo get_the_post_thumbnail($my_post->ID, 'full', array("class" => "img-responsive")); ?></span></div>
                <div class="col-md-9 hidden-sm hidden-xs">
                	<h3 class=""><?php echo $products; ?></h3>
					<?php
					/*
                    	<h3 class=""><strong>Collection of &nbsp;</strong><?php echo $products; ?></h3>

					*/
                    ?>
                    <?php echo $my_post->post_content; ?>
                </div>
            </div>

            <?php while (have_posts()) : the_post(); ?>
                <?php
                $lot = get_post_meta($post->ID, "_eqh_lot", true) != "" ? " | " . get_post_meta($post->ID, "_eqh_lot", true) . "` Lot" : "";
                $start_size = get_post_meta($post->ID, "_eqh_startsize", true) != "" ? " | " . number_format(get_post_meta($post->ID, "_eqh_startsize", true), 0, ".", ",") : "";
                $end_size = get_post_meta($post->ID, "_eqh_endsize", true) != "" ? " - " . number_format(get_post_meta($post->ID, "_eqh_endsize", true), 0, ".", ",") : "";
                $size = $start_size != "" ? $start_size : "";
                if ($size != "") {
                    $size.=$end_size . " - sq.ft.";
                }
                ?>
                <div class="row"><h3 class="columnheader black 111"><?php echo strtoupper(get_the_title()) . "" . $lot . "" . $size ?>
                        <?php echo gk_social_buttons("http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']); ?>
                        <?php edit_post_link(__('Edit', 'eq_homes'), '<div class="edit">', '</div>'); ?>

                    </h3>

                </div>
                <br>
                <?php
// check if the repeater field has rows of data
                if (have_rows('rendering')):
                    // loop through the rows of data
                    while (have_rows('rendering')) : the_row();
                        // echo "Content is: ";
                        // display a sub field value
                        // the_sub_field('image');
                        $image = get_sub_field('image');
                        if ($image):
                            ?>
                            <?php
                        endif;
                    endwhile;
                else :
                // no rows found
                endif;
                ?>
                <div class="row singlehome">
                    <div class="col-lg-6 col-md-8" id="bigPic">
                        <?php
// check if the repeater field has rows of data
                        if (have_rows('rendering')):
                            // loop through the rows of data
                            while (have_rows('rendering')) : the_row();
                                $image = get_sub_field('image');
                                if ($image):;
                                    ?>
                                    <img class="img-responsive col-xs-12" src="<?php the_sub_field('image'); ?>" alt=""/>

                                    <?php
                                endif;
                            endwhile;
                        else :
                        // no rows found
                        endif;
                        ?>
                    </div>

                    <div class="col-lg-2 col-md-4">
                        ELEVATION<br><br class="hidden-lg">
                        <ul id="listingthumbs"><span class="caret"></span>
                            <?php
// check if the repeater field has rows of data
                            if (have_rows('rendering')):
                                // loop through the rows of data
                                $count = 0;
                                $active = "active";
                                $letters = array("A", "B", "C", "D");
                                while (have_rows('rendering')) : the_row();
                                    // echo "Content is: ";
                                    // display a sub field value
                                    // the_sub_field('image');
                                    $image = get_sub_field('image');
                                    if ($image):
                                        ?>
                                        <li class="<?php echo $count + 1 ?>" rel="<?php echo $count + 1; ?>"><?php echo get_sub_field('title')//echo $letters[$count]; ?><span class="imagepointer-wrapper"><span class="imagepointer"></span></span></li>
                                        <?php
                                        $count +=1;
                                        $active = "";
                                    endif;

                                endwhile;
                            else :
                            // no rows found
                            endif;
                            ?>
                        </ul>
                    </div>

                    <?php


                    $product_type = wp_get_post_terms($post->ID, 'eq_products', array("fields" => "names"));
                    $bedrooms = wp_get_post_terms($post->ID, 'bedrooms', array("fields" => "names"));
                    $bathrooms = wp_get_post_terms($post->ID, 'bathrooms', array("fields" => "names"));

					if($post->ID == "3614" || $post->ID == "3619" || $post->ID == "3627" || $post->ID == "3634" || $post->ID == "3640"){
						$product_type[0] = "Bungalows";
					}

                    ?>

                    <div class="col-lg-4 col-md-12 details"><p>Home Type: <strong><?php echo $product_type[0]; ?></strong><br>
                            Bedrooms: <strong><?php
                                $beds = (wp_get_post_terms($post->ID, 'bedrooms', array("fields" => "names")));
                                echo $beds[0];
                                ?></strong><br>
                            Bathrooms: <strong><?php
                                $baths = (wp_get_post_terms($post->ID, 'bathrooms', array("fields" => "names")));
                                echo $baths[0];
                                ?></strong><br>
                            <?php
                            $is_starting_from = get_post_meta($post->ID, "_eqh_is_starting", true);
                            $prefix = "";
                            if ($is_starting_from) {
                                $prefix = "Starting from ";
                            }
                            ?>

                            <?php
                            $start_price = get_post_meta($post->ID, "_eqh_startprice", true);

                            if ($start_price == "00") {
                                ?>
                                <strong>Price:&nbsp;</strong>Coming Soon<br>
                                <?php
                            } else {
                                ?>

                                Price: <strong><?php echo $prefix; ?>$<?php echo number_format(get_post_meta($post->ID, "_eqh_startprice", true), 0, ".", ",") ?></strong><br>

                            <?php } ?>


                            Square Footage: <strong><?php echo number_format(get_post_meta($post->ID, "_eqh_startsize", true), 0, ".", ",") ?></strong><br></p>
                        <div class="plinks">

                            <a href="#" onclick="addToFave('<?php echo $post->ID ?>');" class="pull-right addtofave">Add to Favourites</a>

                        </div>
                    </div>

                </div>
                <div class="row propertylinks">

                    <div class="col-lg-7 right col-lg-push-5">
                       <?php

						$iframeCode = get_field('external_link', $post->ID);

						if($iframeCode){
							?>
								 <a class="btn btn-primary" type="button" href="<?php echo $iframeCode; ?>" target="_blank">VR Tour</a>

							<?php
						}
						?>


                        <a class="btn btn-primary <?php
                            if ($current_fp == '' || $current_fp == 'floorplan') {
                                echo ' active';
                            }
                            ?>" type="button" href="<?php echo the_permalink() . $current_cm . '/floorplan' ?>">Floor Plan</a>

                        <?php
// check if the repeater field has rows of data
                        if (have_rows('rendering')):
                            // loop through the rows of data
                            while (have_rows('rendering')) : the_row();
                                // echo "Content is: ";
                                // display a sub field value
                                // the_sub_field('image');
                                $image = get_sub_field('image');
                                if ($image):
                                    ?>
                                    <?php
                                endif;
                            endwhile;
                        else :
                        // no rows found
                        endif;
                        ?>

                        <?php
                        $images = get_field('album');

                        if ($images):
                            ?>
                            <a class="btn btn-primary<?php
                    if ($current_fp == 'gallery') {
                        echo ' active';
                    }
                            ?>" type="button" href="<?php echo the_permalink() . $current_cm . '/gallery' ?>">Photo Gallery</a>
                           <?php endif; ?>



                        <?php $download_link = get_field('floorplan_download'); ?>


                        <a class="btn btn-primary" type="button" href="<?php echo $download_link; ?>" target="_blank">Download Floorplan PDF</a>
                    </div>

                    <?php
                    $active = $current_fp == "" || $current_fp == "floorplan" ? " active" : "";
                    ?>
                    <?php if ($current_fp == '' || $current_fp == 'floorplan') { ?>
                        <div class="col-lg-5 left col-lg-pull-7">

                            <?php
                            if (have_rows('plan')):

                                $count = 0;
                                $active = "active";
                                while (have_rows('plan')) : the_row();
                                    // echo "Content is: ";
                                    // display a sub field value
                                    // the_sub_field('image')
                                    // ;
                                    $image = get_sub_field('image');
                                    if ($image):
                                        ?>
                                        <a class="proplink <?php echo $active; ?>" rel="<?php echo $count + 1 ?>" href="#"><?php echo strtoupper(the_sub_field('plan_title')); ?><span class="is-active"></span></a><span>&nbsp;|&nbsp;</span>
                                        <?php
                                        $count +=1;
                                        $active = "";
                                    endif;
                                endwhile;
                            else :
                            // no rows found
                            endif;
                            ?>

                        </div>
                    <?php } ?>
                </div>
                <?php if ($current_fp == '' || $current_fp == 'floorplan') { ?>
                    <br>
                    <div class="row floorplans">

                        <div class="col-xs-12" id="floorplans">
                            <?php
                            if (have_rows('plan')):
                                while (have_rows('plan')) : the_row();
                                    $image = get_sub_field('image');
                                    if ($image):
                                        ?>
                                        <img class="img-responsive col-xs-12 floorplansimg2" src="<?php the_sub_field('image'); ?>" alt=""/>
                                        <?php
                                    endif;
                                endwhile;
                            else :
                            // no rows found
                            endif;
                            ?>
                        </div>



                    </div>

                <?php } else { ?>

                    <?php
                    $images = get_field('album');

                    if ($images):
                        ?>
                        <div class="row">

                            <div class="col-xs-12" id="gallery">
                                <?php foreach ($images as $image): ?>

                                    <img class="img-responsive" src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>"/>
                                <?php endforeach; ?>
                            </div>



                        </div>
                    <?php endif; ?>


                    <div class="row bottompad">

                        <div class="col-xs-12" style="text-align:center">
                            <?php
                            $images = get_field('album');

                            if ($images):
                                $count = 0;
                                $active = "active";
                                ?>
                                <ul  class="galthumbs">
                                    <?php foreach ($images as $image): ?>

                                        <li> <img class="img-responsive gallink" rel="<?php echo $count + 1 ?>" src="<?php echo $image['sizes']['gallery-thumb']; ?>" alt="<?php echo $image['alt']; ?>"/></li>
                                        <?php
                                        $count+=1;
                                    endforeach;
                                    ?>
                                </ul>
                            <?php endif; ?>


                        </div>



                    </div>



                <?php } ?>

            <?php endwhile; // end of the loop.     ?>

        </div>

        <div class="col-md-3 leftcolumn col-md-pull-9">


            <?php get_search_form(); ?>
            <h3 class="columnheader green">SEARCH</h3>

            <div class="homesearch">
                <?php echo do_shortcode("[search_bar page='homes']"); ?>
            </div>



        </div>


    </div>
</div>


<script>
    jQuery(document).ready(function () {
        //getActiveClass("btn-homes");
        jQuery(".btn-homes").addClass("active");
        //jQuery(".commbtnmobile").addClass("active");
    });


</script>
<?php get_footer(); ?>
