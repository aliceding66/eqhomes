<?php
/**
 * Template Name: Model Homes
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package EQ HOMES
 */
get_header();
$office_query = new WP_Query(array('post_type' => array('office')));
$community_query = new WP_Query(array('post_type' => array('community')));

$my_query = new WP_Query();
$my_query ->posts=array_merge($office_query->posts,$community_query->posts);
$my_query->post_count=count($my_query->posts);
?>
<div class="container" id="contact-page">
    <div class="row">
        <div class="col-xs-12">
            <h3 class="page-title"><strong>Model Homes</strong></h3><br/>
            <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi.</p>
        </div>
    </div>    
</div>

<?php get_footer(); ?>