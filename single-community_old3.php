<?php
/**
 * The Template for displaying all single posts.
 *
 * @package EQ HOMES
 */
get_header();


global $wp_the_query;
$current_fp = get_query_var('communitypage');
$current_community = get_query_var('community');
//echo $current_community;
?>


<?php
while (have_posts()) : the_post();

    if (get_post_meta($post->ID, "_eqh_status", true) == "sell_off") {
        die();
    }
    $use_external_link = get_post_meta($post->ID, "_eqh_use_external_link", true);
    if ($use_external_link) {
		$newURL = get_post_meta($post->ID, "_eqh_external_link", true);
?>
		<script>
			// similar behavior as an HTTP redirect
				window.location.replace("<?php echo $newURL; ?>");
		</script>
		
<?php	
		
        die();
    }

    $current_community_name = $post->post_title;
    // echo "CCM: ".$current_community_name;
    //$gps = get_post_meta($post->ID, "_eqh_location", true);
    //echo $gps['latitude']."<br>"; 
    //echo $gps['longitude'];
    ?>

    <div class="container singlepage">
        <div class="row">

            <div class="col-md-9 rightcolumn col-md-push-3">
                <?php the_post_thumbnail('full', array('class' => 'commlogo hidden-md hidden-lg')); ?>
                <br class="hidden-md hidden-lg">

                <ul id="mobileNavCommunity" class="navcommunity hidden-md hidden-lg">

                    <li class="columnheader <?php
                    if ($current_fp == '') {
                        echo ' active';
                    }
                    ?>"><a href="<?php echo get_permalink(); ?>">WELCOME</a></li>

                    <?php if (get_field('show_siteplan')): ?>
                        <li class="<?php
                        if ($current_fp == 'siteplan') {
                            echo ' active';
                        }
                        ?>"><a href="<?php echo get_permalink() ?>siteplan/">SITE PLAN</a></li>
                        <?php endif; ?>
                    <!--removed floorplans -->

                    <?php if (get_field('show_floorplans')): ?>
                        <li class="<?php
                        if ($current_fp == 'floorplans') {
                            echo 'commfloorplans active';
                        }
                        ?>"><a href="<?php echo get_permalink() ?>floorplans/">FLOOR PLANS</a></li>
                        <?php endif; ?>


                    <?php if (get_field('show_amenities')): ?>
                        <li class="<?php
                        if ($current_fp == 'amenities') {
                            echo ' active';
                        }
                        ?>"><a href="<?php echo get_permalink() ?>amenities/">AREA AMENITIES</a></li>
                        <?php endif; ?>

                    <?php if (get_field('show_news')): ?>
                        <li class="<?php
                        if ($current_fp == 'news') {
                            echo ' active';
                        }
                        ?>"><a href="<?php echo get_permalink() ?>news/">NEWS</a></li>
                        <?php endif; ?>


                    <?php if (get_field('show_videos')): ?>
                        <li class="<?php
                        if ($current_fp == 'videos') {
                            echo ' active';
                        }
                        ?>"><a href="<?php echo get_permalink() ?>videos/">VIDEOS</a></li>
                        <?php endif; ?>


                    <?php if (get_field('show_reason')): ?>
                        <li class="<?php
                        if ($current_fp == 'why') {
                            echo ' active';
                        }
                        ?>"><a href="<?php echo get_permalink() ?>why/">WHY&nbsp;<?php echo strtoupper($post->post_title); ?></a></li>
                        <?php endif; ?>


                    <?php if (get_field('show_contact')): ?>
                        <li class="<?php
                        if ($current_fp == 'contact') {
                            echo ' active';
                        }
                        ?>"><a href="<?php echo get_permalink() ?>contact/">CONTACT US</a></li>
                        <?php endif; ?>

                    <?php if (get_field('show_residents_club')): ?>
                        <li class="<?php
                        if ($current_fp == 'residents_club') {
                            echo ' active';
                        }
                        ?>"><a href="<?php echo get_permalink() ?>residents_club/">RESIDENTS CLUB</a></li>
                        <?php endif; ?>
                    <?php if (get_field('show_the_resident_clubhouse')): ?>
                        <li class="<?php
                        if ($current_fp == 'the_resident_clubhouse') {
                            echo ' active';
                        }
                        ?>"><a href="<?php echo get_permalink() ?>the_resident_clubhouse/">THE RESIDENT CLUB</a></li>
                        <?php endif; ?>

                    <?php if (get_field('show_bonus')): ?>
                        <li class="<?php
                        if ($current_fp == 'bonus') {
                            echo ' active';
                        }
                        ?>"><a href="<?php echo get_permalink() ?>bonus/">BONUSES</a></li>
                        <?php endif; ?>
                </ul>

                <?php if ($current_fp == '') { ?>
                    <?php
// check if the repeater field has rows of data
                    if (have_rows('slideshow')):
                        // loop through the rows of data
                        $count = 0;
                        $active = "active";
                        ?> 
                        <!-- Wrapper for slides -->
                        <div class="main-slider">
                            <div id="community-slider" class="carousel slide" data-ride="carousel">
                                <!-- Indicators -->
                                <ol class="carousel-indicators">

                                    <?php
                                    while (have_rows('slideshow')) : the_row();
                                        // echo "Content is: ";
                                        // display a sub field value
                                        // the_sub_field('image');
                                        $image = get_sub_field('image');
                                        $video = get_sub_field('video_url');
                                        if ($image or $video):
                                            ?>

                                            <li data-target="#community-slider" data-slide-to="<?php echo $count; ?>" class="<?php echo $active; ?>"></li>

                                            <?php
                                            $count +=1;
                                            $active = "";
                                        endif;
                                        //Temp stop fernbank on 1st slide
                                        if ($current_community === "fernbank-crossing") {
                                            //break;
                                        }

                                    endwhile;
                                    ?>



                                </ol>



                                <div class="carousel-inner">

                                    <?php
                                    $count = 0;
                                    $active = "active";
                                    while (have_rows('slideshow')) : the_row();
                                        // echo "Content is: ";
                                        // display a sub field value
                                        // the_sub_field('image');
                                        $image = get_sub_field('image');
                                        $video = get_sub_field('video_url');

                                        if ($image or $video):
                                            ?>
                                            <?php if ($video): ?>
                                                <div class="item">
                                                    <?php //echo do_shortcode('[fve]' . $video . '[/fve]'); ?> 

                                                    <a class="youtube" href="<?php echo $video; ?>"><img src="<?php the_sub_field('image'); ?>"></a>
                                                  <!--<iframe width="100%" height="504px" src="http://www.youtube.com/watch?v=HcPTMZZxoVY" frameborder="0" allowfullscreen=""></iframe>-->

                                                </div>
                                            <?php else: ?>


                                                <div class="item <?php echo $active; ?>">
                                                    <a href="<?php the_sub_field('link'); ?>"><img src="<?php the_sub_field('image'); ?>"></a>
                                                </div>

                                            <?php endif; ?>
                                            <?php
                                            $count +=1;
                                            $active = "";
                                        endif;

                                        //Temp stop fernbank on 1st slide
                                        if ($current_community === "fernbank-crossing") {
                                            //break;
                                        }
                                    endwhile;
                                    ?>


                                </div>
                            </div>



                        </div><!-- End Main Slider-->

                        <?php
                    endif;
                    ?>
                    <!--HEADER WIDGET TO INGECT BOOTSTRAP CODE-->
                    <?php if ($current_community === "equinelle"): ?>
                        <?php dynamic_sidebar('hometop-row'); ?>
                    <?php endif; ?>
                    <!--HEADER WIDGET TO INGECT BOOTSTRAP CODE-->  




                    <?php if (get_field('show_2columns')): ?>
                        <div class="">
                            <div class="col-sm-4 no_padding">
                                <img src="<?php the_field('copy_image') ?>" alt=""/>
                                <!--HEADER WIDGET TO INGECT BOOTSTRAP CODE-->
                                <?php if ($current_community === "village-walk" || $current_community === "canal-east"): ?>
                                    <?php echo do_shortcode('[book_appointment cc=' . $current_community . ' ci=' . $post->ID . ']'); ?>
                                    <?php //dynamic_sidebar('vilagewalk-row'); ?>
                                <?php endif; ?>
                                <!--HEADER WIDGET TO INGECT BOOTSTRAP CODE--> 
                            </div>
                            <div class="col-sm-8">
                                <h3 class="page-title"><?php echo get_post_meta($post->ID, "_eqh_headline", true); ?></h3>

                                <?php the_content(); ?>
                            </div>
                        </div>
                        <br>
                        <br style="clear:both">
                    <?php else : ?>
                        <div class="content">
                            <h3 class="page-title"><?php echo get_post_meta($post->ID, "_eqh_headline", true); ?></h3>

                            <?php the_content(); ?>
                        </div>
                        <br><br>
                    <?php endif; ?>

                    <?php
// check if the repeater field has rows of data
                    if (get_field('show_featured')):
                        ?>
                        <!-- Feature images-->
                        <div class="row featured">
                            <?php
                            // loop through the rows of data
                            while (have_rows('featured_image')) : the_row();
                                // echo "Content is: ";
                                // display a sub field value
                                // the_sub_field('image');
                                $image = get_sub_field('image');
                                if ($image):
                                    ?>
                                    <div class="col-xs-4"><a href="<?php the_sub_field('link'); ?>"><img src="<?php the_sub_field('image'); ?>"></a></div>
                                    <?php
                                endif;
                            endwhile;
                            ?>
                        </div>     
                        <?php
                    endif;
                    ?>




                    <!-- End Feature images-->

                    <div>
                        <?php edit_post_link(__('Edit', 'eq_homes'), '<div class="edit">', '</div>'); ?>
                    </div>


                <?php } ?>

                <?php if ($current_fp == 'siteplan') { ?>

                    <h3>Overall Site Plan</h3>
                    <div class="siteplanlinks">

                        <?php
// check if the repeater field has rows of data
                        if (have_rows('siteplan')):
                            $count = 0;
                            $active = "active";
                            // loop through the rows of data
                            while (have_rows('siteplan')) : the_row();

                                // display a sub field value
                                //the_sub_field('title');

                                $image = get_sub_field('image');
                                if ($image):
                                    ?>
                                    <a class="proplink <?php echo $active; ?> btn" rel="<?php echo $count + 1 ?>" href="#"><?php echo strtoupper(the_sub_field('title')); ?><span class="cursor"></span></a><span>&nbsp;&nbsp;</span>
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
                    <br>
                    <div class="row floorplans">

                        <div class="col-xs-12 no-padding" id="floorplans">
                            <?php
                            if (have_rows('siteplan')):
                                while (have_rows('siteplan')) : the_row();
                                    $image = get_sub_field('image');
                                    if ($image):
                                        ?>
                                        <img class="img-responsive siteplanimg" src="<?php the_sub_field('image'); ?>" alt=""/>
                                        <?php
                                    endif;
                                endwhile;
                            else :
                            // no rows found
                            endif;
                            ?>
                        </div>



                    </div>
                    <div class="siteplanlinks"><a class="btn" href="<?php echo the_field('siteplanpdf'); ?>" target='_blank'>OVERALL SITEPLAN PDF</a></div>

                <?php } ?>

                <?php if ($current_fp == 'news') { ?>

                                                                                                                                                                                                                                                                                                                                                   <!-- <h3><?php the_title(); ?>&nbsp; - NEWS</h3>-->

                    <?php
                    $my_query = new WP_Query(array(
                        'post_type' => array('post'),
                        'posts_per_page' => -1,
                        //'orderby' => 'rand',
                        'ignore_sticky_posts' => 1,
                        'tax_query' => array(
                            'relation' => 'AND',
                            array(
                                'taxonomy' => 'eq_communities',
                                'field' => 'slug',
                                'operator' => 'IN',
                                'terms' => $post->post_name,
                            ),
                        ),
                    ));
                    ?>
                    <?php while ($my_query->have_posts()) : $my_query->the_post();
                        ?>
                        <div class="news">
                            <?php
                            if (has_post_thumbnail()) :

                                $large_image_url = wp_get_attachment_image_src(get_post_thumbnail_id(), 'large');
                                echo '<a href="' . $large_image_url[0] . '" title="' . the_title_attribute('echo=0') . '" data-gallery>';
                                the_post_thumbnail('blog-feature', array('class' => 'news-thumb pull-left'));
                                echo '</a>';
                                ?>

                            <?php else : ?>
                            <?php endif; ?> 

                            <h3><?php the_title(); ?></h3>



                            <?php the_content(); ?>

                            <a href="<?php the_permalink(); ?>"><button type="button" class="btn btn-primary">learn more</button></a>
                            <br style="clear:both">
                        </div>
                        <?php
                    endwhile;
                    wp_reset_query();
                    ?>

                <?php } ?>

                <!--RESIDENTS CLUB -->

                <?php if ($current_fp == 'residents_club') { ?>

                                                                                                                                                                                                                                                                                                                                                   
                      <!--<h3><?php the_title(); ?>&nbsp; - NEWS</h3>-->

                    <?php
                    $my_query = new WP_Query(array(
                        'post_type' => array('residentsclub'),
                        'posts_per_page' => -1,
                        //'orderby' => 'rand',
                        'ignore_sticky_posts' => 1,
                        'tax_query' => array(
                            'relation' => 'AND',
                            array(
                                'taxonomy' => 'eq_communities',
                                'field' => 'slug',
                                'operator' => 'IN',
                                'terms' => $post->post_name,
                            ),
                        ),
                    ));
                    ?>
                    <?php while ($my_query->have_posts()) : $my_query->the_post();
                        ?>
                        <div class="news">
                            <?php
                            if (has_post_thumbnail()) :

                                $large_image_url = wp_get_attachment_image_src(get_post_thumbnail_id(), 'large');
                                echo '<a href="' . $large_image_url[0] . '" title="' . the_title_attribute('echo=0') . '" data-gallery>';
                                the_post_thumbnail('blog-feature', array('class' => 'news-thumb pull-left'));
                                echo '</a>';
                                ?>

                            <?php else : ?>
                            <?php endif; ?> 

                            <h3><?php the_title(); ?></h3>



                            <?php the_excerpt(); ?>

                            <a href="<?php the_permalink(); ?>"><button type="button" class="btn btn-primary">learn more</button></a>
                            <br style="clear:both">
                        </div>
                        <?php
                    endwhile;
                    wp_reset_query();
                    ?>

                <?php } ?>
                
                <!--THE RESIDENT CLUBHOUSE NEW ADDITION TO WEBSITE 	-->
                
                 <!--<h1>ROBY I AM HERE ><?PHP //echo $current_fp; ?></h1>-->
                
                
                

                <?php if ($current_fp == 'the_resident_clubhouse') { ?>
                
                <?php
					$countTheResidentClubhosue = 0;
				
				?>
				
                      <!--<h3><?php the_title(); ?> THE RESIDENT CLUBHOUSE</h3>-->
					<?php if (get_field("resident_clubhouse_monthly_newsletter")) { ?>
                        <div class='col-md-12'><a class="btn btn-black pull-right" type="button" href="<?php echo get_field("resident_clubhouse_monthly_newsletter"); ?>" target="_blank">Download Monthly Newsletter PDF</a></div>
                        <br style="clear:both">
                    <?php }?>

                    <?php
					
					
                    $my_query = new WP_Query(array(
                        'post_type' => array('theresidentclubhouse'),
                        'posts_per_page' => -1,
                        'order'   => 'ASC',
                        'ignore_sticky_posts' => 1,
						
						// this displays only in selectted community
                        'tax_query' => array(
                            'relation' => 'AND',
                            array(
                                'taxonomy' => 'eq_communities',
                                'field' => 'slug',
                                'operator' => 'IN',
                                'terms' => $post->post_name,
                            ),
                        ),
						
						
                    ));
					
					
                    ?>
                    <?php while ($my_query->have_posts()) : $my_query->the_post();
                        ?>
                        <!--<H1 style="color:#EE0E11;">WARINING!!!! 25</H1>-->


<?php                         
                   if($countTheResidentClubhosue == 0 ){   
				   		// We are displayin title and contetns before slider for the very first result
						// for rest we are displyaing slider first then title and discription text
?>				   
                        <div class="news" style="border-bottom: none;">
                            <?php
                            if (has_post_thumbnail()) :

                                $large_image_url = wp_get_attachment_image_src(get_post_thumbnail_id(), 'large');
                                echo '<a href="' . $large_image_url[0] . '" title="' . the_title_attribute('echo=0') . '" data-gallery>';
                                the_post_thumbnail('blog-feature', array('class' => 'news-thumb pull-left'));
                                echo '</a>';
                                ?>

                            <?php else : ?>
                            <?php endif; ?> 

                            <h3><?php the_title(); ?></h3>



                            <?php the_content(); ?>

						<?php
						/*
                            <a href="<?php the_permalink(); ?>"><button type="button" class="btn btn-primary">learn more</button></a>
                        */
						?>    
                            
                            <br style="clear:both">
                            


                            
                        </div>
<?php                         
                    }
                        
?> 

						
<!-- Wrapper for slides -->
                        <div class="main-slider">
                        	
                            <div id="community-slider" class="carousel slide" data-ride="carousel">
                                <!-- Indicators -->
                                <ol class="carousel-indicators">

                                    <?php
                                    while (have_rows('slideshow')) : the_row();
                                        // echo "Content is: ";
                                        // display a sub field value
                                        // the_sub_field('image');
                                        $image = get_sub_field('image');
                                        $video = get_sub_field('video_url');
                                        if ($image or $video):
                                            ?>

                                            <li data-target="#community-slider" data-slide-to="<?php echo $count; ?>" class="<?php echo $active; ?>"></li>

                                            <?php
                                            $count +=1;
                                            $active = "";
                                        endif;
                                        //Temp stop fernbank on 1st slide
                                        if ($current_community === "fernbank-crossing") {
                                            //break;
                                        }

                                    endwhile;
                                    ?>



                                </ol>



                                <div class="carousel-inner">

                                    <?php
                                    $count = 0;
                                    $active = "active";
                                    while (have_rows('slideshow')) : the_row();
                                        // echo "Content is: ";
                                        // display a sub field value
                                        // the_sub_field('image');
                                        $image = get_sub_field('image');
                                        $video = get_sub_field('video_url');

                                        if ($image or $video):
                                            ?>
                                            <?php if ($video): ?>
                                                <div class="item">
                                                    <?php //echo do_shortcode('[fve]' . $video . '[/fve]'); ?> 

                                                    <a class="youtube" href="<?php echo $video; ?>"><img src="<?php the_sub_field('image'); ?>"></a>
                                                  <!--<iframe width="100%" height="504px" src="http://www.youtube.com/watch?v=HcPTMZZxoVY" frameborder="0" allowfullscreen=""></iframe>-->

                                                </div>
                                            <?php else: ?>


                                                <div class="item <?php echo $active; ?>">
                                                    <a href="<?php the_sub_field('link'); ?>"><img src="<?php the_sub_field('image'); ?>"></a>
                                                </div>

                                            <?php endif; ?>
                                            <?php
                                            $count +=1;
                                            $active = "";
                                        endif;

                                        //Temp stop fernbank on 1st slide
                                        if ($current_community === "fernbank-crossing") {
                                            //break;
                                        }
                                    endwhile;
                                    ?>


                                </div>
                            </div>



                        </div>
<!-- End Main Slider-->


<?php                         
                   if($countTheResidentClubhosue > 0 ){   
				   		// for rest we are displyaing slider first then title and discription text
?>				   
                        <div class="news">
                            <?php
                            if (has_post_thumbnail()) :

                                $large_image_url = wp_get_attachment_image_src(get_post_thumbnail_id(), 'large');
                                echo '<a href="' . $large_image_url[0] . '" title="' . the_title_attribute('echo=0') . '" data-gallery>';
                                the_post_thumbnail('blog-feature', array('class' => 'news-thumb pull-left'));
                                echo '</a>';
                                ?>

                            <?php else : ?>
                            <?php endif; ?> 

                            <h3><?php the_title(); ?></h3>



                            <?php the_content(); ?>

						<?php
						/*
                            <a href="<?php the_permalink(); ?>"><button type="button" class="btn btn-primary">learn more</button></a>
                        */
						?>    
                            
                            <br style="clear:both">
                            


                            
                        </div>
<?php                         
                    }else{
						
					}
                        
?>                        
                        <br style="clear:both">
                        <?php
						
						$countTheResidentClubhosue++;
                    endwhile;
                    wp_reset_query();
                    ?>

                <?php } ?>                
                
                
                <!--REASONS -->
                <?php if ($current_fp == 'why') { ?>
                                            <div class="col-xs-12 nopadding"><img class="reason-banner" src="<?php echo get_field('reason_why_banner', $post->ID) ?>" /></div>                                                                                                                                                                                                             <!-- <h3><?php the_title(); ?>&nbsp; - NEWS</h3>-->
                    <br style="clear:both">&nbsp;
                    <?php
                    $my_query = new WP_Query(array(
                        'post_type' => array('reasons'),
                        'posts_per_page' => -1,
                        //'orderby' => 'rand',
                        'ignore_sticky_posts' => 1,
                        'tax_query' => array(
                            'relation' => 'AND',
                            array(
                                'taxonomy' => 'eq_communities',
                                'field' => 'slug',
                                'operator' => 'IN',
                                'terms' => $post->post_name,
                            ),
                        ),
                    ));
                    ?>
                    <?php while ($my_query->have_posts()) : $my_query->the_post();
                        ?>
                        <div class="reasons">
                            <h3><?php the_title(); ?></h3>
                            <?php
                            if (has_post_thumbnail()) :

                                $large_image_url = wp_get_attachment_image_src(get_post_thumbnail_id(), 'large');
                                echo '<a href="' . $large_image_url[0] . '" title="' . the_title_attribute('echo=0') . '" data-gallery>';
                                the_post_thumbnail('blog-feature', array('class' => 'news-thumb pull-left'));
                                echo '</a>';
                                ?>

                            <?php else : ?>
                            <?php endif; ?> 
                            <strong><?php echo nl2br(get_post_meta($post->ID, "_eqh_intro", true)) . "<br>"; ?></strong>
                            <?php the_content(); ?>

                        </div>
                        <br style='clear:both'> 
                        <?php
                    endwhile;
                    wp_reset_query();
                    ?>

                <?php } ?>


                <?php if ($current_fp == 'videos') { ?>

                    <h3>VIDEOS</h3>
                    <?php
                    $my_query = new WP_Query(array(
                        'post_type' => array('video'),
                        'posts_per_page' => -1,
                        //'orderby' => 'rand',
                        'ignore_sticky_posts' => 1,
                        'tax_query' => array(
                            'relation' => 'AND',
                            array(
                                'taxonomy' => 'eq_communities',
                                'field' => 'slug',
                                'operator' => 'IN',
                                'terms' => $post->post_name,
                            ),
                        ),
                    ));
                    ?>
                    <?php while ($my_query->have_posts()) : $my_query->the_post();
                        ?>
                        <div class="news">
                            <h3><?php the_title(); ?></h3>
                            <?php the_content(); ?>
                            <br style="clear:both">
                            <?php // $embed_code = wp_oembed_get(get_post_meta($post->ID, "_eqh_video", true), array('width'=>'','height'=>'315'));echo $embed_code;  ?>
                            <?php echo do_shortcode('[fve]' . get_post_meta($post->ID, "_eqh_video", true) . '[/fve]'); ?>
                           <!-- <iframe width="100%" height="315" src="<?php echo get_post_meta($post->ID, "_eqh_video", true); ?>" frameborder="0" allowfullscreen></iframe>-->

                        </div>
                        <?php
                    endwhile;
                    wp_reset_query();
                    ?>

                <?php } ?>


                <?php if ($current_fp == 'floorplans') { ?>

                    <?php
                    $rangeMin = isset($_REQUEST['rangeMin']) ? $_REQUEST['rangeMin'] : 0;
                    $rangeMax = isset($_REQUEST['rangeMax']) ? $_REQUEST['rangeMax'] : 1000000;
                    $range2Min = isset($_REQUEST['range2Min']) ? $_REQUEST['range2Min'] : 0;
                    $range2Max = isset($_REQUEST['range2Max']) ? $_REQUEST['range2Max'] : 5000;

                    $types = get_terms('eq_products', array("hide_empty" => 0));
                    $types_slugs = wp_list_pluck($types, 'slug');


                    $tbeds = get_terms('bedrooms', array("hide_empty" => 0));
                    $tbeds_slugs = wp_list_pluck($tbeds, 'slug');

                    $tbaths = get_terms('bathrooms', array("hide_empty" => 0));
                    $tbaths_slugs = wp_list_pluck($tbaths, 'slug');


                    // echo "TYPE: ".isset($_REQUEST['eqtype'])."<br>";
                    // echo "BEDS: ".isset($_REQUEST['bedrooms'])."<br>";
                    // echo "BATHS: ".isset($_REQUEST['bathrooms'])."<br>";

                    //$eqtype = isset($_REQUEST['eqtype']) && ($_REQUEST['eqtype'] != "") ? $_REQUEST['eqtype'] : $types_slugs;
                    $bedrooms = isset($_REQUEST['bedrooms']) && ($_REQUEST['bedrooms'] != "") ? $_REQUEST['bedrooms'] : $tbeds_slugs;
                    $bathrooms = isset($_REQUEST['bathrooms']) && ($_REQUEST['bathrooms'] != "") ? $_REQUEST['bathrooms'] : $tbaths_slugs;



                    $my_query = new WP_Query(array(
                        'post_type' => array('home'),
                        'posts_per_page' => -1,
                        'order' => 'ASC',
                        'tax_query' => array(
                            'relation' => 'AND',
                            array(
                                'taxonomy' => 'eq_communities',
                                'field' => 'slug',
                                'operator' => 'IN',
                                'terms' => $post->post_name,
                            ), /*
                            array(
                                'taxonomy' => 'eq_products',
                                'field' => 'slug',
                                'operator' => 'IN',
                                'terms' => $eqtype,
                            ), */
                            array(
                                'taxonomy' => 'bedrooms',
                                'field' => 'slug',
                                'operator' => 'IN',
                                'terms' => $bedrooms,
                            ),
                            array(
                                'taxonomy' => 'bathrooms',
                                'field' => 'slug',
                                'operator' => 'IN',
                                'terms' => $bathrooms,
                            ),
                        ),
                        'meta_query' => array(
                            array(
                                'key' => '_eqh_startprice',
                                'value' => array((int) $rangeMin, (int) $rangeMax),
                                'type' => 'numeric',
                                'compare' => 'BETWEEN',
                            ),
                            array(
                                'key' => '_eqh_startsize',
                                'value' => array((int) $range2Min, (int) $range2Max),
                                'type' => 'numeric',
                                'compare' => 'BETWEEN',
                            ),
                        )
                    ));

                    $term_list = wp_get_post_terms($post->ID, 'eq_products', array("fields" => "names"));
                    $term_list = implode(', ', $term_list);
                    $find = ',';
                    $replace = ' & ';
                    $result = preg_replace(strrev("/$find/"), strrev($replace), strrev($term_list), 1);
                    $products = strrev($result);
                    ?>

                    <?php
                    $lots = get_terms('lotsize', array("hide_empty" => 0));
                    $lot_slugs = wp_list_pluck($lots, 'slug');
                    $listingsposts = array();
                    foreach ($lots as $term) {
                        $str = $term->name;
                        $listingsposts[$str] = array();
                    }

                    //echo $term->name;
                    ?>
                    <div class="row">
                        <div class="col-xs-12">
                            <h3 class=""><strong>Collection of &nbsp;</strong><?php echo $products; ?></h3>
                            <?php echo get_post_meta($post->ID, "_eqh_floorplans", true); ?>  <br>  
                        </div>
                        <div class="col-xs-12 sort">
                            <span>Sort:</span>
                            <select id="sort">
                                <option value="">Select here to sort</option>
                                <option value="">Sort By Collection</option>
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
                    <h3 class="columnheader black hidefirst"><?php echo $post->post_title; ?></h3>

                    <div class="row propertyList communityList">



                        <?php //var_dump($lot_slugs);           ?>



                        <?php while ($my_query->have_posts()) : $my_query->the_post(); ?>

                            <?php
                            $comms = get_post_meta($post->ID, "_eqh_home_community", true);
                            $lots = wp_get_post_terms($post->ID, 'lotsize', array("fields" => "slugs"));
                            $post->permalink = get_the_permalink();
                            $ptype = wp_get_post_terms($post->ID, 'eq_products', array("fields" => "names"));

                            /*
                              echo '<pre>';
                              var_dump($ptype);
                              echo '</pre>';
                             */
                            for ($t = 0; $t < count($lots); $t++) {
                                $c = get_term_by('slug', $lots[$t], 'lotsize')->name;
                                $slug = get_term_by('slug', $lots[$t], 'lotsize')->slug;
                                //echo "--SLUG: ">$slug;
                                if (in_array($slug, $lot_slugs)) {
                                    $listingsposts[$c][] = $post;
                                }
                            }
                            ?>

                            <?php
                        endwhile;
                        wp_reset_query();
                        ?>

                        <?php
                        if (count($listingsposts) > 0):
                            foreach ($listingsposts as $key => $value) {
                                if (count($value) > 0) {
                                    ?>

                                    <h3 class="columnheader black"><?php echo $current_community_name . " - " . $key; ?></h3>
                                    <div class="row">
                                        <?php
                                        for ($m = 0; $m < count($value); $m++) {

                                            $post = $value[$m];
                                            $community = wp_get_post_terms($post->ID, 'eq_communities', array("fields" => "names"));
                                            $product_type = wp_get_post_terms($post->ID, 'eq_products', array("fields" => "names"));
                                            $bedrooms = wp_get_post_terms($post->ID, 'bedrooms', array("fields" => "names"));
                                            $bathrooms = wp_get_post_terms($post->ID, 'bathrooms', array("fields" => "names"));
                                            ?>
                                            <!-- property -->                   
                                            <div class="col-lg-4 col-sm-6 col-xs-12 plisting propertySingle">
                                                <div class="property">
                                                    <h4><?php echo $post->post_title; ?><?php edit_post_link(__('Edit', 'eq_homes'), '<div class="edit">', '</div>'); ?></h4>

                                                    <a href="<?php echo the_permalink() . $current_community . '/floorplan' ?>">
                                                        <?php $image = get_field("listing_feature_image"); ?>
                                                        <img src="<?php echo $image['sizes']['listing']; ?>" class="thumbnail img-responsive col-xs-12">
                                                    </a>
                                                    <p>
                                                        <?php
                                                        $is_starting_from = get_post_meta($post->ID, "_eqh_is_starting", true);
                                                        $prefix = "";
                                                        if ($is_starting_from) {
                                                            $prefix = "Starting from ";
                                                        }
                                                        ?>
                                                        Home Type:&nbsp;<strong><?php echo $product_type[0]; //implode(', ', $product_type);$bedrooms[0];                     ?></strong><br>
                                                        Bedrooms:&nbsp;<strong><?php echo $bedrooms[0]; ?></strong><br>
                                                        Bathrooms:&nbsp;<strong><?php echo $bathrooms[0]; ?></strong><br>


                                                        <?php
                                                        $start_price = get_post_meta($post->ID, "_eqh_startprice", true);

                                                        if ($start_price == "00") {
                                                            ?>
                                                            <strong>Price:&nbsp;</strong>Coming Soon<br>
                                                            <?php
                                                        } else {
                                                            ?>

                                                            Price:&nbsp;<strong><?php echo $prefix; ?>$<?php echo number_format(get_post_meta($post->ID, "_eqh_startprice", true), 0, ".", ",") ?></strong><br>

                                                        <?php } ?>
                                                        Square Footage:&nbsp;<strong><?php echo number_format(get_post_meta($post->ID, "_eqh_startsize", true), 0, ".", ",") ?></strong><br>
                                                        <input type="hidden" class="sortPrice" value="<?php echo (int) trim(get_post_meta($post->ID, "_eqh_startprice", true)); ?>">
                                                        <input type="hidden" class="sortFootage" value="<?php echo (int) trim(get_post_meta($post->ID, "_eqh_startsize", true)); ?>">
                                                        <input type="hidden" class="sortBedroom" value="<?php echo $bedrooms[0]; ?>">
                                                        <input type="hidden" class="sortBathroom" value="<?php echo $bathrooms[0]; ?>">
                                                    </p>
                                                </div>
                                                <div class="plinks">
                                                    <a href="<?php echo the_permalink() . $current_community . '/floorplan' ?>" class="pull-left">Floor Plan </a>
                                                    <a href="#" onclick="addToFave('<?php echo $post->ID ?>');" class="pull-right addtofave">Add to Favourites</a>
                                                    <span>|</span>
                                                </div>
                                            </div>
                                            <!-- /property --> 



                                        <?php } ?>
                                    </div>

                                    <?php
                                }
                            } endif;
                        wp_reset_query();
                        ?>

                    </div>
                <?php } ?>

                <?php if ($current_fp == 'amenities') { ?>

                    <div class='col-md-6'><h3 class="nopadding nomargin">Amenities</h3></div>
                    <div class='col-md-6'><a class="btn btn-black pull-right" type="button" href="<?php echo get_field("download"); ?>" target="_blank">Download Overall Site Plan PDF</a></div>
                    <div class="hspace" style="clear:both">&nbsp;</div>
                    <div class="row  amenities">

                        <div class="col-xs-12">
                            <?php $image = get_field("picture"); ?>
                            <img src="<?php echo $image; ?>" class="amenityimg img-responsive col-xs-12">
                            <br style="clear:both">
                            <div class="hspace">&nbsp;</div>
                            <?php echo nl2br(get_post_meta($post->ID, "_eqh_amenities", true)) . "<br><br>"; ?>
                        </div>
                    </div>

                <?php } ?>
                <?php if ($current_fp == 'contact') { ?>

                    <h3>Contact &nbsp; <?php the_title() ?></h3>
                    <div class="communitylocation" style='clear:both'>
                        <?php
                        global $wp_query;
                        echo do_shortcode("[post_locator post_type='community' page='single' id='" . $wp_query->post->ID . "']");
                        ?> 




                        <!-- -->                        

                    </div>

                    <!-- MOVE CONTACT INFO AROUND JUST IN THIS PAGE-->
                    <div class="row">
                        <div class="col-md-4"><strong>Sales Office</strong><br>
                            <?php echo get_post_meta($post->ID, "_eqh_address", true) . "<br>"; ?>
                            <?php echo get_post_meta($post->ID, "_eqh_city", true) . " , " . get_post_meta($post->ID, "_eqh_province", true) . " , " . get_post_meta($post->ID, "_eqh_address2", true) . "<br>"; ?></div>
                        <div class="col-md-4">
                            <div>
                                <strong>Tel: </strong><?php echo get_post_meta($post->ID, "_eqh_phone", true) . "<br>"; ?>
                                <?php if (get_post_meta($post->ID, "_eqh_tollfreephone", true) != "") { ?>
                                    <strong>Toll Free: </strong><?php echo get_post_meta($post->ID, "_eqh_tollfreephone", true) . "<br>"; ?>    
                                <?php } ?>
                                <strong>Email: </strong><a href="mailto:<?php echo get_post_meta($post->ID, "_eqh_email", true) ?>"><?php echo get_post_meta($post->ID, "_eqh_email", true) . "</a><br>"; ?>
                            </div>
                        </div>
                        <div class="col-md-4"><strong>Sales Office Hours</strong> <div><?php echo nl2br(get_post_meta($post->ID, "_eqh_hours", true)) . "<br>"; ?>


                            </div> </div>


                    </div><br/><br/>

                <?php } ?>

                <?php if ($current_fp == 'bonus') { ?>

                    <div class="row">
                        <div class="col-xs-12">
                            <img class="img-responsive" src="<?php the_field('bonus_banner', 'option'); ?>"/>
                            <br>
                        </div>

                        <div class="col-xs-12">
                            <?php the_field('bonus_headline', 'option'); ?>
                        </div>
                        <div class="col-xs-12">


                            <?php
                            $my_query = new WP_Query(array(
                                'post_type' => array('bonus'),
                                'posts_per_page' => -1,
                                //'orderby' => 'rand',
                                'ignore_sticky_posts' => 1,
                                'tax_query' => array(
                                    'relation' => 'AND',
                                    array(
                                        'taxonomy' => 'eq_communities',
                                        'field' => 'slug',
                                        'operator' => 'IN',
                                        'terms' => $post->post_name,
                                    ),
                                ),
                            ));
                            ?>
                            <?php while ($my_query->have_posts()) : $my_query->the_post();
                                ?>
                                <div class="col-md-4 center bonus">
                                    <h3 class="blue"><?php the_field('blue_headline', $post->ID); ?></h3>
                                    <h3 class="blue"><?php the_field('blue_subheadline', $post->ID); ?></h3>

                                    <?php
// check if the repeater field has rows of data
                                    if (have_rows('bonuses')):

                                        // loop through the rows of data
                                        while (have_rows('bonuses')) : the_row();

                                            // display a sub field value
                                            $title = get_sub_field('title');
                                            $headline = get_sub_field('headline');
                                            echo '<h3 class="nomargin nopadding">' . $title . '</h3>';
                                            echo '<p>' . $headline . '</p>';
                                        endwhile;

                                    else :

                                    // no rows found

                                    endif;
                                    ?>
                                </div>
                                <?php
                            endwhile;
                            wp_reset_query();
                            ?>  




                        </div>
                        <div class="col-xs-12 disclaimer">
                            <?php the_field('bonus_description', 'option'); ?>
                        </div>

                    </div>

                <?php } ?>




            </div>




            <div class="col-md-3 leftcolumn col-md-pull-9">

                <?php the_post_thumbnail('full', array('class' => 'commlogo hidden-xs hidden-sm')); ?>



                <ul class="navcommunity">
                    <?php get_search_form(); ?>
                    <?php if (get_field('true_false')): ?>

                    <?php endif; ?>

                    <li class="hidden-xs hidden-sm columnheader <?php
                    if ($current_fp == '') {
                        echo ' active';
                    }
                    ?>"><a href="<?php echo get_permalink(); ?>">WELCOME</a></li>

                    <?php if (get_field('show_siteplan')): ?>
                        <li class="hidden-xs hidden-sm <?php
                        if ($current_fp == 'siteplan') {
                            echo ' active';
                        }
                        ?>"><a href="<?php echo get_permalink() ?>siteplan/">SITE PLAN</a></li>
                        <?php endif; ?>

                    <?php if (get_field('show_floorplans')): ?>
                        <li class="hidden-xs hidden-sm <?php
                        if ($current_fp == 'floorplans') {
                            echo 'commfloorplans active';
                        }
                        ?>"><a href="<?php echo get_permalink() ?>floorplans/">FLOOR PLANS</a><?php
                            if ($current_fp == 'floorplans') {
                                echo do_shortcode("[search_bar page='community']");
                            }
                            ?></li>
                        <?php endif; ?>

                    <?php if (get_field('show_amenities')): ?>
                        <li class="hidden-xs hidden-sm <?php
                        if ($current_fp == 'amenities') {
                            echo ' active';
                        }
                        ?>"><a href="<?php echo get_permalink() ?>amenities/">AREA AMENITIES</a></li>
                        <?php endif; ?>

                    <?php if (get_field('show_news')): ?>
                        <li class="hidden-xs hidden-sm <?php
                        if ($current_fp == 'news') {
                            echo ' active';
                        }
                        ?>"><a href="<?php echo get_permalink() ?>news/">NEWS</a></li>
                        <?php endif; ?>


                    <?php if (get_field('show_videos')): ?>
                        <li class="hidden-xs hidden-sm <?php
                        if ($current_fp == 'videos') {
                            echo ' active';
                        }
                        ?>"><a href="<?php echo get_permalink() ?>videos/">VIDEOS</a></li>
                        <?php endif; ?>



                    <?php if (get_field('show_contact')): ?>
                        <li class="hidden-xs hidden-sm <?php
                        if ($current_fp == 'contact') {
                            echo ' active';
                        }
                        ?>"><a href="<?php echo get_permalink() ?>contact/">CONTACT US</a></li>
                        <?php endif; ?>

                    <?php if (get_field('show_reason')): ?>
                        <li class="hidden-xs hidden-sm <?php
                        if ($current_fp == 'why') {
                            echo ' active';
                        }
                        ?>"><a href="<?php echo get_permalink() ?>why/">WHY&nbsp;<?php echo strtoupper($post->post_title); ?></a></li>
                        <?php endif; ?>

                    <?php if (get_field('show_residents_club')): ?>
                        <li class="hidden-xs hidden-sm <?php
                        if ($current_fp == 'residents_club') {
                            echo ' active';
                        }
                        ?>"><a href="<?php echo get_permalink() ?>residents_club/">RESIDENTS CLUB</a></li>
                    	<?php endif; ?>
                        
                    <?php if (get_field('show_the_resident_clubhouse')): ?>
                        <li class="hidden-xs hidden-sm <?php
                        if ($current_fp == 'the_resident_clubhouse') {
                            echo ' active';
                        }
                        ?>"><a href="<?php echo get_permalink() ?>the_resident_clubhouse/">THE RESIDENT CLUB</a></li>
                    	<?php endif; ?>                    
                    
                        <?php if (get_field('show_bonus')): ?>
                        <li class="hidden-xs hidden-sm <?php
                    if ($current_fp == 'bonus') {
                        echo ' active';
                    }
                            ?>"><a href="<?php echo get_permalink() ?>bonus/">BONUSES</a></li>
                        <?php endif; ?>








                </ul>


                <?php //wp_nav_menu(array('theme_location' => 'communities','menu_class' => 'navcommunity', ));                   ?>

                <?php if (get_field('show_contact')and $current_fp != 'contact'): ?>


                    <h3 class="columnheader black">Sales Office Hours</h3>
                    <div><?php echo nl2br(get_post_meta($post->ID, "_eqh_hours", true)) . "<br>"; ?></div>


                    <h3 class="columnheader black">Contact Information</h3>
                    <div>
                        <strong>Tel: </strong><?php echo get_post_meta($post->ID, "_eqh_phone", true) . "<br>"; ?>
                        <?php if (get_post_meta($post->ID, "_eqh_tollfreephone", true) != "") { ?>
                            <strong>Toll Free: </strong><?php echo get_post_meta($post->ID, "_eqh_tollfreephone", true) . "<br>"; ?>    
                        <?php } ?>
                        <strong>Email: </strong><a href="mailto:<?php echo get_post_meta($post->ID, "_eqh_email", true) ?>"><?php echo get_post_meta($post->ID, "_eqh_email", true) . "</a><br>"; ?>
                    </div>

                    <?php if ($current_fp != 'contact') { ?>

                        <h3 class="columnheader black">Location Map</h3>
                        <div><?php echo get_post_meta($post->ID, "_eqh_address", true) . "<br>"; ?>
                            <?php echo get_post_meta($post->ID, "_eqh_city", true) . " , " . get_post_meta($post->ID, "_eqh_province", true) . " , " . get_post_meta($post->ID, "_eqh_address2", true) . "<br>"; ?>
                            <div class="communitymap">
                                <?php
                                global $wp_query;
                                echo do_shortcode("[post_locator post_type='community' page='single' id='" . $wp_query->post->ID . "']");
                                ?> 
                            </div>
                        </div>
                        <br>
                    <?php } ?>

                <?php endif; ?>


                <?php if (get_field('show_register')): ?>
                    <h3 class="columnheader black">Register</h3>
                    <div>
                        <div style="color:red" id="side-contact-alert"></div>
                        <form method="post" id="side-contact-form" name="side-contact-form">

                            <!-- lasso elements -->
                            <input type="hidden" name="domainAccountId" id="domainAccountId" value="LAS-382183-01" />
                            <input type="hidden" name="guid" id="guid" value="" />
                            <!-- lasso elements ends -->
                    
                    
							<?php
								$eq_lasso_crm_id =  get_post_meta($post->ID, "_eqh_lasso_crm_id", true);
							?>
                    
                            <input type="hidden" name="r-community" id="r-community" value="<?php echo $current_community; ?>"/>
                            <input type="hidden" name="r-community-id" id="r-community-id" value="<?php echo $post->ID; ?>"/>
                            <input type="hidden" name="r-community-lasso-id" id="r-community-lasso-id" value="<?php echo $eq_lasso_crm_id; ?>"/>
                            
                            <label for="r-name">*First Name</label>
                            <input type="text" name="r-name" id="r-name" placeholder="Your first name" class="form-control required">
                            <label for="r-lname">*Last Name</label>
                            <input type="text" name="r-lname" id="r-lname" placeholder="Your last name" class="form-control required">
                            <label for="r-name">*Email</label>
                            <input type="text" name="r-email" id="r-email" placeholder="Your email" class="form-control required">
                            <label for="r-name">*Phone</label>
                            <input type="tel" name="r-phone" id="r-phone" placeholder="Your Telephone" class="form-control required">
                            <label for="r-zip">*Postal Code</label>
                            <input type="text" name="r-zip" id="r-zip" placeholder="Your Postal Code" class="form-control required">
                            <label for="r-message">Message</label>
                            <textarea rows="3" name="r-message" id="r-message" placeholder="Message" class="form-control"></textarea>
                            <?php wp_nonce_field('register-nonce', 'registerme'); ?>
                            <button type="submit" class="btn btn-primary pull-right">Send</button>
                        </form>
                        <p class="consent">By submitting this form, you are agreeing to receive communications from eQ Homes . We do not share information with third parties. Information on our Privacy Policy can be found here.</p>
                    </div>

                <?php endif; ?>



                <br>
            </div>


        </div>
    </div>
<?php endwhile; // end of the loop.                    ?>

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
<script>
    jQuery(document).ready(function () {
        jQuery(".commbtn").addClass("active");
        jQuery(".commbtnmobile").addClass("active");
    });


</script>
<?php get_footer(); ?>