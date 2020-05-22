<?php
/**
 * @package EQ HOMES
 */
$term_list = wp_get_post_terms($post->ID, 'eq_products', array("fields" => "names"));
$term_list = implode(', ', $term_list);
$find = ',';
$replace = ' & ';
$result = preg_replace(strrev("/$find/"), strrev($replace), strrev($term_list), 1);
$products = strrev($result) . " Homes";
?>

<div class="container">
    <div class="row">
        <div class="col-md-3 col-sm-4 commlogo-wrap"><?php the_post_thumbnail('full', array('class' => 'commlogo')); ?></div>
       
        <div class="col-md-6 col-sm-8 comm-copy"><strong><?php the_title('<h5 style="display:inline-block;font-weight:bold;">', '</h5>'); ?>&nbsp;|&nbsp;
            <?php echo get_post_meta($post->ID, "_eqh_town", true) . "<br>"; ?>
            <?php echo $products; ?></strong>
            <?php the_content(); ?></div>
        
        <div class="col-md-3 col-sm-12">
            <h5><strong>Sales Office</strong></h5>
        <?php echo get_post_meta($post->ID, "_eqh_address", true) . "<br>"; ?>
        <?php echo get_post_meta($post->ID, "_eqh_city", true) ." , ".get_post_meta($post->ID, "_eqh_province", true)." , ". get_post_meta($post->ID, "_eqh_address2", true)."<br>"; ?>
        <strong>Tel: </strong><?php echo get_post_meta($post->ID, "_eqh_phone", true) . "<br>"; ?>
        <?php if(get_post_meta($post->ID, "_eqh_tollfreephone", true)!=""){?>
        <strong>Toll Free: </strong><?php echo get_post_meta($post->ID, "_eqh_tollfreephone", true) . "<br>"; ?>    
       <?php } ?>
        <strong>Email: </strong><a href="mailto:<?php echo get_post_meta($post->ID, "_eqh_email", true)?>"><?php echo get_post_meta($post->ID, "_eqh_email", true) . "</a><br><br>"; ?>
       
        <a class="btn btn-success pull-left" type="button" href="<?php the_permalink(); ?>">Learn More</a>
        <a class="btn btn-success pull-right gmap" type="button" href="<?php the_permalink(); ?>">Google Map</a>
        </div>
       
    </div>
     <hr/>
</div>
