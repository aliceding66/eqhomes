<?php
/**
 * Template Name: Quick Move Ins
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


        <?php while (have_posts()) : the_post(); ?>

            <div class="col-xs-12">
                <div class="pagebanner">
                    <img class="img-responsive col-xs-12" src="<?php echo get_template_directory_uri(); ?>/temp/pagebanner.jpg" alt=""/>
                    <h3 class="title"><strong>Quick </strong> Move-In</h3>
                        <?php //the_title( '<h3 class="title">', '</h3>' ); ?>
                </div>

            </div>

        <?php endwhile; // end of the loop. ?>


    </div>
</div>

<div class="container">
    <div class="col-xs-12 moveheading">
        <div class="col-xs-4 col-md-2"><img class="img-responsive" src="<?php echo get_template_directory_uri(); ?>/library/images/eqlogo.png" alt=""/></div>
        <div class="col-xs-8 col-md-6 info">
            <strong>eQuinelle  |  Kemptville</strong><br>
            <strong>Towns, Semis, Bungalows & Two Storey Homes</strong>
        </div>
        <div class="col-xs-12 col-md-4 contact">
            <strong>Tel: </strong> 613-258-6488<br>
            <strong>Toll Free: </strong> 1-866-258-6488<br>
            <strong>Email: </strong> sales@equinelle.ca
        </div>
    </div>
</div>
<?php for($b=0;$b<6;$b++){ ?>
<div class="container">
    <div class="row">
    <div class="col-xs-12 movein">
        <div class="col-md-5">
            <div class="col-xs-12 col-md-6">
            <img class="img-responsive col-xs-12" src="<?php echo get_template_directory_uri(); ?>/temp/listing-detail.jpg" alt=""/>
            </div>
            <div class="col-xs-12 col-md-6 info">
                <h3>The Trevino</h3>
                Home Type: <strong> Bungalow</strong><br>
                Bedrooms: <strong> 2</strong><br>
                Bathrooms: <strong> 2.5</strong><br>
                Price: <strong> $000,000</strong><br>
                Square Footage: <strong> 1,240</strong><br>
             <ul class="hidden-lg hidden-md">
                <li><a class="btn btn-success" type="button" href="#">Info Sheet</a></li>
                <li><a class="btn btn-success" type="button" href="#">Book a Tour</a></li>
            </ul>
            </div>
        </div>
        <div class="col-xs-12 col-md-5 desc">
            <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.
Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore</p>
        </div>
        <div class="col-xs-4 col-md-2">
            <ul class="visible-lg visible-md">
                <li><a class="btn btn-success" type="button" href="#">Info Sheet</a></li>
                <li><a class="btn btn-success" type="button" href="#">Book a Tour</a></li>
            </ul>
        </div>
    </div></div>
</div>
<?php }//get_sidebar(); ?>
<?php get_footer(); ?>
