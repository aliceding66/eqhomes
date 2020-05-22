<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package EQ HOMES
 */
get_header();
?>
<div class="main-slider">
    <div class="row">
        <div class="col-xs-12">
            <div id="homepage-carousel" class="carousel slide" data-ride="carousel">
                <!-- Indicators -->
                <ol class="carousel-indicators">
                    <?php
// check if the repeater field has rows of data
						if (have_rows('slideshow', 'option')):
							// loop through the rows of data
							$count = 0;
							$active = "active";
							while (have_rows('slideshow', 'option')) : the_row();
							// echo "Content is: ";
							// display a sub field value
							//the_sub_field('image');
								$image = get_sub_field('image');
								if ($image):
									?>
									<li data-target="#homepage-carousel" data-slide-to="<?php echo $count; ?>" class="<?php echo $active; ?>"></li>
									<?php
									$count +=1;
									$active = "";
								endif;
//break;//show only first slide
							endwhile;
						else :
						// no rows found
						endif;
                    ?>
                </ol>
                <!-- Wrapper for slides -->
                <div class="carousel-inner">

                    <?php
// check if the repeater field has rows of data
                    if (have_rows('slideshow', 'option')):
                        // loop through the rows of data
                        $count = 0;
                        $active = " active";
                        while (have_rows('slideshow', 'option')) : the_row();
                            // echo "Content is: ";
                            // display a sub field value
                            //the_sub_field('image');
                            $image = get_sub_field('image');
                            if ($image):
                                ?>

                                <div class="item <?php echo $active; ?>">
                                    <a href="<?php the_sub_field('link'); ?>"><img src="<?php the_sub_field('image'); ?>" alt="" class="img-responsive col-xs-12"></a>
                                </div>


                                <?php
                                $count +=1;
                                $active = "";
                            endif;
//break;//show only first slide
                        endwhile;
                    else :
                    // no rows found
                    endif;
                    ?>
<!-- dummy slider -->
				<!--<div class="item active">
						<a href="https://www.eqhomes.ca/pathways/">
							<img src="https://www.eqhomes.ca/wp-content/uploads/2019/07/pathway-home.png" alt="" class="img-responsive col-xs-12"></a>
					</div> -->
				<!--<div class="item">
						<a href="https://www.eqhomes.ca/our-story/">
							<img src="https://www.eqhomes.ca/wp-content/uploads/2019/06/eQHO-COR-W-WM-10253-WHY-eQ-HOMES.png" alt="" class="img-responsive col-xs-12"></a>
					</div> -->
<!--End  dummy slider -->
                </div>

                <!-- Controls -->
                <a class="left carousel-control" href="#homepage-carousel" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left"></span>
                </a>
                <a class="right carousel-control" href="#homepage-carousel" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right"></span>
                </a>
            </div>
        </div>
    </div>
</div>


<?php /*

<div class="container homemodules">
    <div class="row">
        <div class="col-md-4 col-sm-6 hidden-xs">
            <div class="homemodule smallmap hm">
                <?php echo do_shortcode("[post_locator post_type='community' page='home']"); ?>
            </div>
            <div class="modulecontent">
                <h4><?php the_field('title_where_to_live', 'option'); ?></h4>
                <?php echo wp_trim_words(get_field('description_where_to_live', 'option'), 20, "..."); ?>
            </div>
        </div>
        <div class="col-md-4 col-sm-6">
            <div class="homemodule search hm">
                <?php echo do_shortcode("[search_bar page='homepage']"); ?>
            </div>
            <div class="modulecontent">
                <h4><?php the_field('title_find_a_home', 'option'); ?></h4> 
                <?php echo wp_trim_words(get_field('description_find_a_home', 'option'), 20, "..."); ?>

            </div>
        </div>
        <div class="col-md-4 col-xs-12">
            <div class="homemodule">
                <?php
                // echo the_field('overide','option');
                $uniquefeature = get_field("feature_a_single_home", 'option');
                //echo "BBB: ".$uniquefeature;
                remove_all_filters('posts_orderby'); // posts order by plugin conflict resolution to get random posts the normal way

                if (get_field('overide', 'option') == 1) {
                    ?>

                    <a href="<?php the_field('feature_url', 'option'); ?>">
                        <?php $image = get_field("featured_image", 'option'); //var_dump($image)       ?>
                        <img src="<?php echo $image; ?>" class="img-responsive" style="width:100%;height:100%">
                    </a>
                </div>
                <div class="modulecontent">
                    <h4><?php the_field('title_featured_home', 'option'); ?>&nbsp;<?php echo $featured_home; ?></h4>
                    <?php //echo wp_trim_words(get_the_content(), 20, "...");  ?>
                    <?php the_field('description_featured_home', 'option'); ?>
                </div>

                <?php
            } elseif ($uniquefeature) {
                //echo "BANGLADESH";
                $post = $uniquefeature;
                setup_postdata($post);
                $featured_home = $post->post_title;
                ?>
                <a href="<?php the_permalink() ?>">
                    <?php $image = get_field("listing_feature_image"); //var_dump($image)       ?>
                    <img src="<?php echo $image['sizes']['listing']; ?>" class="img-responsive" style="width:100%;height:100%">
                </a>
            </div>
            <div class="modulecontent">
                <h4><?php the_field('title_featured_home', 'option'); ?>:&nbsp;<?php echo $featured_home; ?></h4>

                <?php echo wp_trim_words(get_the_content(), 20, "..."); ?>

            </div>
            <?php
            wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly 
        } else {



            $my_query = new WP_Query(array(
                'orderby' => 'rand',
                'post_type' => array('home'),
                'posts_per_page' => 1,
                'ignore_sticky_posts' => 1,
                'meta_query' => array(
                    array(
                        'key' => '_eqh_isfeatured',
                        'meta_value' => 'on',
                    ),
                )
            ));

            while ($my_query->have_posts()) : $my_query->the_post();
                $featured_home = $post->post_title;
                ?>
                <a href="<?php the_permalink() ?>">
                    <?php $image = get_field("listing_feature_image"); //var_dump($image)       ?>
                    <img src="<?php echo $image['sizes']['listing']; ?>" class="img-responsive" style="width:100%;height:100%">
                </a>
            </div>
            <div class="modulecontent">
                <h4><?php the_field('title_featured_home', 'option'); ?>:&nbsp;<?php echo $featured_home; ?></h4>
                <?php //echo wp_trim_words(get_the_content(), 20, "...");  ?>
                <?php the_field('description_featured_home', 'option'); ?>
            </div>
            <?php
        endwhile;

        wp_reset_query();
    }
    ?>

</div>

</div>
</div>

<?php */ ?>

<div class="container narrow">
    <div class="row">
        <div class="col-md-4">

            <h4><strong>Enduring Quality</strong></h4>
            <p style="text-align:center"><!--<img src="<?php echo get_template_directory_uri(); ?>/library/images/welcome.png">--></p>

        </div>
        <div class="col-md-8">
            <?php the_field('description_welcome', 'option'); ?>
        </div>


    </div>
</div>

<div class="container narrow">
    <div class="row">
        <hr>
    </div>
</div>

<div class="container homemodules">
    <div class="row">
		<div class="col-md-4 col-xs-12">
            <div class="homemodule">      
                    <a href="https://www.eqhomes.ca/eq-better-basements-new/">
                         <img src="https://www.eqhomes.ca/wp-content/uploads/2019/02/eq-home-page2.jpg" class="img-responsive" style="width:100%;height:100%">
                    </a>
			</div>
			<div class="modulecontent">
				<h4>eQ Better Basements&nbsp;</h4>
				 <p>At eQ Homes, we go above and beyond the standard to build basements that are drier, healthier and an integral part of your living space. This higher level of quality – which we call eQ Better Basements – offers you more value and richer quality of life.</p>
<!-- 				<a class="eqhomelink" href="https://www.eqhomes.ca/wp-content/uploads/2019/02/EQHO-COR-P-HAND-X-SECTION-STNDRDS-wMARGN-1FEB2019-F.pdf" target="_blank">DOWNLOAD PDF</a> -->
				<a class="eqhomelink" href="https://www.eqhomes.ca/eq-better-basements-new/" target="_blank">LEARN MORE</a>
			</div>
		</div>		
		<div class="col-md-4 col-xs-12">
            <div class="homemodule">      
                    <a href="https://www.eqhomes.ca/wp-content/uploads/2019/07/EQHO-CORP-Redesign-STANDARDS-MAY2019-F.pdf" target="_blank">
                         <img src="https://www.eqhomes.ca/wp-content/uploads/2019/02/eq-home-page1.jpg" class="img-responsive" style="width:100%;height:100%">
                    </a>
			</div>
			<div class="modulecontent">
				<h4>Building To A Higher Standard&nbsp;</h4>
				 <p>You take pride in your home. You value quality over
quantity, and dedicate time and care to the
things you cherish in life.
At eQ Homes, those values are at the foundation
of everything we do. That means going above
and beyond by offering you exceptional customer
experience, and a home built to a higher standard.
Discover how eQ Homes enriches lives.</p>
				<a class="eqhomelink" href="https://www.eqhomes.ca/wp-content/uploads/2019/07/EQHO-CORP-Redesign-STANDARDS-MAY2019-F.pdf" target="_blank">DOWNLOAD PDF</a>
			</div>
		</div>		
		 <div class="col-md-4 col-xs-12">
            <div class="homemodule">      
                    <a href="https://www.eqhomes.ca/smart-home/">
                         <img src="https://www.eqhomes.ca/wp-content/uploads/2019/06/thumbnail_smart-phone-image.png" class="img-responsive" style="width:100%;height:100%">
                    </a>
			</div>
			<div class="modulecontent">
				<h4>eQ Smarthome&nbsp;</h4>
				 <p>We’re enriching the lives of our homeowners by being the first Ottawa area builder to incorporate high-quality “Smarthome” technology in every home we build.</p>			
			</div>
		</div>
	</div>
</div>

<?php get_footer(); ?>
