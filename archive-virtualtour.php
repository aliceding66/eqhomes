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
        <h1><span class="agreen">eQ</span>&nbsp;<span class="blue">HOMES</span>&nbsp;Virtual Tours</h1>
        <p>Your new home might not be built yet but that doesn’t mean you can’t “walk” through it! Our virtual tours let you explore every major room in the three different models below, each fully furnished and decorated, to provide you with a realistic impression of the living environment you’ll soon enjoy as an eQ Homes homeowner!</p>
    </div>
</div>


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


            for ($t = 0; $t < count($comms); $t++) {
                $c = get_term_by('id', $comms[$t], 'eq_communities')->name;
                $slug = get_term_by('id', $comms[$t], 'eq_communities')->slug;
                //echo "--SLUG: ">$slug;
                if (in_array($slug, $community_slugs)) {
                    $listingsposts[$c][] = $post;
                }
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
                ?>





                <div class="row">
                    <?php
                    for ($m = 0; $m < count($value); $m++) {

                        $post = $value[$m];
						
						$cms = wp_get_post_terms($post->ID, 'eq_communities', array("fields" => "slugs"));
                       	//print_r( "<pre>".var_export($cms)."</pre>");
						
                        //$current_cm = get_term_by('id', $cms[0], 'eq_communities')->slug;
                        $current_cm = $cms[0];						
						$current_cm_id = get_page_by_slug($current_cm, OBJECT, $post_type = 'community')->ID;
						
						$eq_lasso_crm_id =  get_post_meta($current_cm_id, "_eqh_lasso_crm_id", true);
						
                        ?>

                       
                                <div class="col-xs-12 col-sm-6 col-md-4 vtour">
                                    <a class="youtube" href="<?php echo get_post_meta($post->ID, "_eqh_video", true); ?>">
                                    <?php the_post_thumbnail();     ?>
                                    </a>
                                        <br>
                                    <br><strong><?php echo $post->post_title;   ?>
                                    	<?php /*
                                    		<a href="#" onclick="jQuery('#myModalLabel').html('Book a Tour : &nbsp;<?php echo $post->post_title; ?>');
                                           	jQuery('#t-community-lasso-id').val('<?php echo $eq_lasso_crm_id; ?>');
                                            jQuery('#t-movein').val('<?php echo $post->post_title; ?>');
                                            jQuery('#t-movein-id').val('<?php echo $my_post->ID; ?>');" data-toggle="modal" data-target="#bookATour">
                                            	
                                                <button class="pull-right btn btn-info">Inquire About This Model</button>
                                            
                                            </a>
                                            */
										?>	
                                            </strong>
                                        <?php 
                                    //$the_home=get_post_meta($post->ID, "_eqh_home_community", true);
                                    
                                    $the_home=get_field('home', $post->ID);
                                    //print_r ($the_home->ID);
                                    
                                    
                                    ?>
                                    <p><?php echo number_format(get_post_meta($the_home->ID, "_eqh_startsize", true), 0, ".", ",") ?> sq.ft.</p>
                                    
                                    <?php 
                                    //$the_home=get_post_meta($post->ID, "_eqh_home_community", true);
                                    
                                    //$the_home=get_field_object('home', $post->ID);
                                    //print_r ($the_home);
                                    
                                    
                                    ?>
                                    
                               </div>
                                
                           

                        <?php
                    }
                    ?>
                </div>

                <div class="col-xs-12 no-padding">
                   
                        <p>These models are available in:</p>
			<a href="<?php echo get_permalink( $my_post->ID ); ?>">
                        	<?php echo get_the_post_thumbnail($my_post->ID, 'full', array('class' => '')); ?>
			</a>
                        <hr>
                        <br><br><br>
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
                    <div> <button type="button" onclick="jQuery('#myModa
    lLabel').html('');" class="btn btn-default" data-dismiss="modal">Close</button><button type="submit" class="btn btn-primary pull-right">Submit</button></div>

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
        //getActive("btn-gallery");
        jQuery(".btn-virtualtour").addClass("active");
    //jQuery(".commbtnmobile").addClass("active");
    });


</script>
<?php get_footer(); ?>
