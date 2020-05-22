<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package EQ HOMES
 */
//setcookie("favourites", "", time()-3600);unset($_COOKIE['favourites']);

//flush_rewrite_rules( $hard );

$numfaves = 0;
//var_dump($_COOKIE['favourites']); exit;
if (isset($_COOKIE["favourites"])) {

    if (strpos($_COOKIE["favourites"], ',') !== FALSE) {
        $faves = explode(",", $_COOKIE["favourites"]);
        $numfaves = count($faves);
    }
    if (trim($_COOKIE["favourites"]) != "" && (strpos($_COOKIE["favourites"], ',') == FALSE)) {
        $numfaves = 1;
    }
}
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
    <head>
        <meta charset="<?php bloginfo('charset'); ?>">
        <link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/favicon.ico" />
        <meta name="viewport" content="width=device-width, initial-scale=1,user-scalable = no">
        <meta name="p:domain_verify" content="2cd13e13a6d4e4613efdb352ca04a799"/>
        <title><?php wp_title(); ?></title>
        <link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic,700italic' rel='stylesheet' type='text/css'>
        <link rel="profile" href="http://gmpg.org/xfn/11">
        <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">

        <?php wp_head(); ?>

        <script src="<?php echo get_template_directory_uri(); ?>/js/modernizr-latest.js" type="text/javascript"></script>
        <script src="<?php echo get_template_directory_uri(); ?>/js/css3-mediaqueries.min.js" type="text/javascript"></script>
        
        
        
        <style>
			.btn-jointheteam {
			  background: url('<?php echo get_template_directory_uri(); ?>/images/eqsprite.png') no-repeat -39px -38px;
			  width: 128px;
			  height: 24px;
			  display: inline-block;
			  padding: 0px 3px 0px;
			  line-height: 24px;
			  position: relative;
			  text-align: center;
			  cursor: pointer;
			}
			.btn-jointheteam:hover,
			.btn-jointheteam.active {
			  background: url('<?php echo get_template_directory_uri(); ?>/images/eqsprite.png') no-repeat -39px -87px;
			}
			
			.btn-broker {
			  background: url('<?php echo get_template_directory_uri(); ?>/images/eqsprite.png') no-repeat -39px -38px;
			  width: 128px;
			  height: 24px;
			  display: inline-block;
			  padding: 0px 3px 0px;
			  line-height: 24px;
			  position: relative;
			  text-align: center;
			  cursor: pointer;
			}
			.btn-broker:hover,
			.btn-broker.active {
			  background: url('<?php echo get_template_directory_uri(); ?>/images/eqsprite.png') no-repeat -39px -87px;
			}			
					
		</style>
       
        
        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
          <script type='text/javascript' src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
          <script type='text/javascript' src="//cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.js"></script>
        <![endif]-->
        
		         
        <meta name="p:domain_verify" content="2cd13e13a6d4e4613efdb352ca04a799”/>
        
		      

    </head>

    <body <?php body_class(); ?>>

        <div class="top">
            <header class="container" id="head">

                <nav class="navbar navbar-default" role="navigation">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" 
                                data-target="#main-nav">
                            <span class="sr-only">Toggle navigation</span>
                            <strong>MENU</strong>
                        </button>
                        <a class="navbar-brand" href="<?php echo esc_url(home_url('/')); ?>" rel="home"><img src="<?php echo get_template_directory_uri(); ?>/images/eqhomeslogo.png" alt=""/></a>
                    </div>
                    <div class="top-nav visible-lg">
                        <a href="<?php echo esc_url(home_url('/')); ?>join-the-team"><span class="btn-jointheteam">JOIN THE TEAM</span></a>
                        <a href="<?php echo esc_url(home_url('/')); ?>virtualtours"><span class="btn-virtualtour">VIRTUAL TOURS</span></a>
                        <a href="<?php echo esc_url(home_url('/')); ?>gallery"><span class="btn-gallery">PHOTO GALLERY</span></a>
                        <a href="<?php echo esc_url(home_url('/')); ?>contact"><span class="btn-contact">CONTACT US</span></a>
                        <a href="<?php echo esc_url(home_url('/')); ?>broker" target="_blank"><span class="btn-broker">BROKER PORTAL</span></a>
                        <span class="btn-favourite" id="btn-favourite">MY FAVOURITES</span>
                        <span class="badge badge-important"><?php echo $numfaves; ?></span>
                    </div>

                    <?php
                    wp_nav_menu(array(
                        'theme_location' => 'primary',
                        'depth' => 2,
                        'container' => 'nav',
                        'container_id' => 'main-nav',
                        'container_class' => 'collapse navbar-collapse nav-body',
                        'menu_class' => 'nav navbar-nav navbar-right',
                        'fallback_cb' => 'wp_bootstrap_navwalker::fallback',
                        'walker' => new wp_bootstrap_navwalker())
                    );
                    ?>



<br class="hidden-lg" style="clear:both">
                </nav>
                
            </header>
        </div>

        <div class="comm visible-lg">
            <ul class="communities well">

                <?php
                query_posts(array(
                    'post_type' => 'community',
                    'showposts' => 10
                ));
                ?>
                <?php
                $dropdownmenu = "";
                while (have_posts()) : the_post();
                    
                if(get_post_meta($post->ID, "_eqh_status", true)=="sell_off"){
                    continue 1;
                }
                
                    $term_list = wp_get_post_terms($post->ID, 'eq_products', array("fields" => "names"));
                    $term_list = implode(', ', $term_list);
                    $find = ',';
                    $replace = '<br> & ';
                    $result = preg_replace(strrev("/$find/"), strrev($replace), strrev($term_list), 1);
                    $products = strrev($result) . " Homes";

                    //overrrride to original functionality
                    $products = get_post_meta($post->ID, "_eqh_hometypes", true);
                    $menu_link = get_permalink($post->ID);
                    $use_external_link = get_post_meta($post->ID, "_eqh_use_external_link", true);
                    //print_r($use_external_link);
                    $target = "_self";
                    $menuclass = "";

                    if ($use_external_link) {
                        $menu_link = get_post_meta($post->ID, "_eqh_external_link", true);
                        $target = "_blank";
                         //  $menuclass = "csoon"; move to here
                        $dropdownmenu.='<li><a href="' . get_post_meta($post->ID, "_eqh_external_link", true) . ' " target="' . $target . '">' . $post->post_title . '</a></li>';
                    } else {
                        $dropdownmenu.='<li><a href="' . get_permalink($post->ID) . '" target="' . $target . '">' . $post->post_title . '</a></li>';
                    }
					
					// move to here
					$community_status = get_post_meta($post->ID, "_eqh_status", true);
					if ($community_status == "coming_soon") {
						   $menuclass = "csoon";
					}	
					
										
                    ?>


                    <li class="<?php echo $menuclass; ?>"><a href="<?php echo $menu_link; ?>" target="<?php echo $target; ?>">
                            <div style="width:128px;height:72px;text-align:center;vertical-align:middle;">
                                <img src="<?php echo get_post_meta($post->ID, "_eqh_logo", true) ?>" style="max-width:100px;max-height:60px;width:100%;height:auto" alt="<?php echo $post->post_title ?>">
                            </div>
                            <span><?php echo get_post_meta($post->ID, "_eqh_town", true) ?></span>

                            <?php if ($use_external_link) { ?>
                                <p style="padding-left:5px;padding-right:5px;height:90px !important;">
                                    <strong><?php echo $products; ?></strong>
                                    
                                </p>


                            <?php } else { ?>
                                <p style="padding-left:5px;padding-right:5px;height:90px !important;">
                                    <strong><?php echo $products; ?></strong>
                                    <br><i><?php echo get_post_meta($post->ID, "_eqh_pricetag", true) ?></i><br>
                                    
                                    <?php $thenum=number_format(get_post_meta($post->ID, "_eqh_startprice", true), 0, ".", ","); 
                                    if($thenum>0){
                                    
                                    ?>
                                    <strong>$<?php echo number_format(get_post_meta($post->ID, "_eqh_startprice", true), 0, ".", ","); ?>'s</strong>
                                    
                                    <?php }?>
                                </p>

                            <?php }
                            ?>

                        </a>
                    </li>

                    <?php
                endwhile;
                wp_reset_query();
                ?>


                <!--<li><a href="#"><img src="http://placehold.it/100x60">
                        <span>LOCATION</span>
                        <p><strong>Product Type</strong><br><strong>Price Point</strong></p></a>
                </li>-->



            </ul>

        </div>

        <ul class="comm-mobile dropdown-menu">
            <li><a href='<?php echo esc_url(home_url('/')); ?>community'>Community Locations</a></li>
            <?php echo $dropdownmenu; ?>
        </ul>
        <div id="sitewidth" class="container"></div>

