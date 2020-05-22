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

$the_link = get_permalink($post->ID);
$target = "_self";
$use_the_external_link = get_post_meta($post->ID, "_eqh_use_external_link", true);
$status=get_post_meta($post->ID, "_eqh_status", true);
if ($use_the_external_link) {
    $the_link = get_post_meta($post->ID, "_eqh_external_link", true);
    $target = "_blank";
}
if (get_post_meta($post->ID, "_eqh_status", true) == "sell_off") {
    $the_link = "#";
    $target = "_self";
    $status="SOLD OUT";
}
?>


<div class="container">
    <div class="row">
        <div class="col-md-3 col-sm-4 commlogo-wrap"><a href="<?php echo $the_link; ?>" target="<?php echo $target; ?>" ><?php the_post_thumbnail('full', array('class' => 'commlogo')); ?></a></div>

        <div class="col-md-6 col-sm-8 comm-copy"><strong><?php the_title('<h5 style="display:inline-block;font-weight:bold;">', '</h5>'); ?>&nbsp;|&nbsp;
                <?php echo get_post_meta($post->ID, "_eqh_town", true) . "<br>"; ?><img src="<?php echo get_template_directory_uri(); ?>/images/marker_<?php echo get_post_meta($post->ID, "_eqh_status", true); ?>.png"/>
                <?php echo strtoupper($string = str_replace("_", " ", $status)); ?><br><?php echo get_post_meta($post->ID, "_eqh_hometypes", true); ?></strong>
            <?php the_content(); ?></div>

        <div class="col-md-3 col-sm-12">
            <h5><strong>Sales Office</strong></h5>
            <?php echo get_post_meta($post->ID, "_eqh_address", true) . "<br>"; ?>
            <?php echo get_post_meta($post->ID, "_eqh_city", true) . " , " . get_post_meta($post->ID, "_eqh_province", true) . " , " . get_post_meta($post->ID, "_eqh_address2", true) . "<br>"; ?>
            <strong>Tel: </strong><a href="tel:+1<?php echo get_post_meta($post->ID, "_eqh_phone", true) . "<br>"; ?>4166237521"><?php echo get_post_meta($post->ID, "_eqh_phone", true) . "<br>"; ?>
            <?php if (get_post_meta($post->ID, "_eqh_tollfreephone", true) != "") { ?>
                <strong>Toll Free: </strong><?php echo get_post_meta($post->ID, "_eqh_tollfreephone", true) . "<br>"; ?>    
            <?php } ?>
            <strong>Email: </strong><a href="mailto:<?php echo get_post_meta($post->ID, "_eqh_email", true) ?>"><?php echo get_post_meta($post->ID, "_eqh_email", true) . "</a><br><br>"; ?>
<?php
if (get_post_meta($post->ID, "_eqh_status", true) == "sell_off") {

}else{
?>
                <a class="btn btn-success pull-left" type="button" href="<?php echo $the_link; ?>" target="<?php echo $target; ?>">Learn More</a>
                <?php
                if (!$use_the_external_link) {
                    ?>
                    <a class="btn btn-success pull-right gmap" type="button" href="<?php the_permalink(); ?>contact/">Google Map</a>
                <?php } ?>
                    
<?php }; ?>
        </div>

    </div>
    <hr/>
</div>
