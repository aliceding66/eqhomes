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
        <div class="col-md-3 col-sm-4 commlogo-wrap"><a href="#<?php //the_permalink(); ?>"><?php the_post_thumbnail('full', array('class' => 'commlogo')); ?></a></div>

        <div class="col-md-6 col-sm-8 comm-copy contact-map-wrapper">
            <div class="contact-map" id="<?php echo $post->post_name; ?>"></div>
        </div>

        <div class="col-md-3 col-sm-12">
            <h5><strong>Sales Office</strong></h5>
            <?php if (get_post_meta($post->ID, "_eqh_hours", true)):
                echo nl2br(get_post_meta($post->ID, "_eqh_hours", true)) . "<br><br>";
            endif;
            ?>
            <?php echo get_post_meta($post->ID, "_eqh_address", true) . "<br>"; ?>
            <?php
            $address2 = "";
            if (get_post_meta($post->ID, "_eqh_address2", true) != "") {
                $address2 = ", " . get_post_meta($post->ID, "_eqh_address2", true);
            }
            ?>
            <?php echo get_post_meta($post->ID, "_eqh_city", true) . " , " . get_post_meta($post->ID, "_eqh_province", true) . $address2 . "<br>"; ?>
            <strong>Tel: </strong><a href="tel:+1<?php echo get_post_meta($post->ID, "_eqh_phone", true); ?>"><?php echo get_post_meta($post->ID, "_eqh_phone", true); ?></a><br>
            <?php 
				if (get_post_meta($post->ID, "_eqh_tollfreephone", true) != "") { ?>
                	<strong>Toll Free: </strong><a href="tel:+<?php echo get_post_meta($post->ID, "_eqh_tollfreephone", true); ?>"><?php echo get_post_meta($post->ID, "_eqh_tollfreephone", true); ?></a><br>    
				<?php } ?>
            <strong>Email: </strong><a href="mailto:<?php echo get_post_meta($post->ID, "_eqh_email", true) ?>"><?php echo get_post_meta($post->ID, "_eqh_email", true) . "</a><br><br>"; ?>


        </div>

    </div>
    <hr/>
</div>
