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
        <link href='https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic,700italic' rel='stylesheet' type='text/css'>
        <link rel="profile" href="https://gmpg.org/xfn/11">
        <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
<link href="https://fonts.googleapis.com/css?family=Raleway:100,200,300,400,500,600,700" rel="stylesheet">
		
        <?php wp_head(); ?>

        <script src="<?php echo get_template_directory_uri(); ?>/js/modernizr-latest.js" type="text/javascript"></script>
        <script src="<?php echo get_template_directory_uri(); ?>/js/css3-mediaqueries.min.js" type="text/javascript"></script>
        
        <script type="text/javascript">
            var register_thank_you_modal = 1 ;
        </script>
        
        <style>
			/*.btn-jointheteam {
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
			}*/			
			
			.btn-jointheteam {
			  background-color:#0077bb;
				color:#fff;
			  width: 128px;
			  height: 24px;
			  display: inline-block;
			  padding: 0px 3px 0px;
			  line-height: 24px;
			  position: relative;
			  text-align: center;
			  cursor: pointer;
				font-size: 13px;
			}
			.btn-jointheteam:hover,
			.btn-jointheteam.active {
				background-color:#fff;
				color:#000;
			}
			
			.btn-broker {
				background-color:#0077bb;
				color:#fff;
			  width: 128px;
			  height: 24px;
			  display: inline-block;
			  padding: 0px 3px 0px;
			  line-height: 24px;
			  position: relative;
			  text-align: center;
			  cursor: pointer;
				font-size: 13px;
			}
			.btn-broker:hover,
			.btn-broker.active {
			/* background: url('<?php// echo get_template_directory_uri(); ?>/images/eqsprite.png') no-repeat -39px -87px; */
				background-color:#fff;
				color:#000;
			}
			.btn-gallery {
/* 				background: url(../images/eqsprite.png) no-repeat -39px -38px; */
				background: none;
				background-color:#0077bb;
				color:#fff;
				width: 128px;
				height: 24px;
				display: inline-block;
				padding: 0 3px;
				line-height: 24px;
				position: relative;
				text-align: center;
				cursor: pointer;
				font-size: 13px;
			}
						.btn-gallery.active, .btn-gallery:hover {
/* 				background: url(../images/eqsprite.png) no-repeat -39px -87px; */
				background:none;
				background-color:#fff;
				color:#000;
			}
			.btn-contact {
/* 				background: url(../images/eqsprite.png) no-repeat -186px -38px; */
				background:none;
				background-color:#0077bb;
				color:#fff;
				width: 101px;
				height: 24px;
				display: inline-block;
				padding: 0 3px;
				line-height: 24px;
				position: relative;
				text-align: center;
				cursor: pointer;
				font-size: 13px;
			}
			.btn-contact.active, .btn-contact:hover {
				/*background: url(../images/eqsprite.png) no-repeat -186px -87px; */
				background:none;
				background-color:#fff;
				color:#000;
			}
			.btn-broker {
				background-color:#0077bb;
				color:#fff;
				/*background: url(https://www.eqhomes.ca/wp-content/themes/eq_homes/images/eqsprite.png) no-repeat -39px -38px;*/
				width: 128px;
				height: 24px;
				display: inline-block;
				padding: 0px 3px 0px;
				line-height: 24px;
				position: relative;
				text-align: center;
				cursor: pointer;
				font-size: 13px;
			}
			.btn-broker:hover, .btn-broker.active {
				background-color:#fff;
				color:#000;
 			   /*background: url(https://www.eqhomes.ca/wp-content/themes/eq_homes/images/eqsprite.png) no-repeat -39px -87px;*/
			}
			.button, button, 
			input[type="submit"],
			input[type="reset"],
			input[type="button"]{
				background-color: #0077bb!important;
				border: 0 none;
				border-radius: 3px 3px 3px 3px;
				color: #FFFFFF;
				cursor: pointer;
				display: inline-block;
				font: 16px/24px "gibson_lightregular",Arial,Helvetica,sans-serif;
				padding: 4px 18px 4px;
				text-decoration: none;
			}
			
			
					
		</style>
       
        
        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
          <script type='text/javascript' src="https://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
          <script type='text/javascript' src="https://cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.js"></script>
        <![endif]-->
        
		         
        

			<!-- Facebook Pixel Code -->
			<script>

			!function(f,b,e,v,n,t,s)


			{if(f.fbq)return;n=f.fbq=function(){n.callMethod?


			n.callMethod.apply(n,arguments):n.queue.push(arguments)};


			if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';


			n.queue=[];t=b.createElement(e);t.async=!0;


			t.src=v;s=b.getElementsByTagName(e)[0];


			s.parentNode.insertBefore(t,s)}(window,document,'script', 'https://connect.facebook.net/en_US/fbevents.js');


			fbq('init', '528365277535552');

			fbq('track', 'Lead');

			</script>
			<noscript>
			<img height="1" width="1" src="https://www.facebook.com/tr?id=528365277535552&ev=PageView&noscript=1" />
			</noscript>
			<!-- End Facebook Pixel Code -->	
    
    	     <meta name="p:domain_verify" content="2cd13e13a6d4e4613efdb352ca04a799"/>	 

   

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
					<!--<a class="navbar-brand" href="<?php //echo esc_url(home_url('/')); ?>" rel="home"><img src="<?php //echo get_template_directory_uri(); ?>/images/eqhomeslogo.png" alt=""/></a> -->
						<?php if(is_home()){?>
<a class="navbar-brand home_logo" href="<?php echo esc_url(home_url('/')); ?>" rel="home">
								<picture>
									<source media="(min-width: 650px)" srcset="<?php echo get_template_directory_uri(); ?>/images/home_logo.svg">
									<img src="<?php echo get_template_directory_uri(); ?>/images/logo-large_gray-small-01-01.svg" alt=""/>
								</picture>
							</a>
						<?php } else {?>
 							<a class="navbar-brand home_logo_subpage" href="<?php echo esc_url(home_url('/')); ?>" rel="home">
								<picture>
									<source media="(min-width: 650px)" srcset="<?php echo get_template_directory_uri(); ?>/images/home_logo.svg">
									<img src="<?php echo get_template_directory_uri(); ?>/images/logo-large_gray-small-01-01.svg" alt=""/>
								</picture>								
							</a> 
						<?php } ?>
                    </div>					
                    <div class="top-nav visible-lg">
<!--                        	<a href="<?php// echo esc_url(home_url('/')); ?>smarthome"  target="_blank"><span class="btn-jointheteam">EQ SMARTHOMES</span></a> -->
                        <a href="<?php echo esc_url(home_url('/')); ?>join-the-team"><span class="btn-jointheteam">JOIN THE TEAM</span></a>
<!--                         <a href="<?php // echo esc_url(home_url('/')); ?>virtualtours"><span class="btn-virtualtour">VIRTUAL TOURS</span></a> -->
                        <a href="<?php echo esc_url(home_url('/')); ?>model-homes/"><span class="btn-gallery">MODEL HOMES</span></a>
                        <a href="<?php echo esc_url(home_url('/')); ?>contact"><span class="btn-contact">CONTACT US</span></a>
                        <a href="<?php echo esc_url(home_url('/')); ?>brokerportal" target="_blank"><span class="btn-broker">BROKER PORTAL</span></a>
<!--                         <span class="btn-favourite" id="btn-favourite">MY FAVOURITES</span> -->
<!--                         <span class="badge badge-important"><?php echo $numfaves; ?></span> -->
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
