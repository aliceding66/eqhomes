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
?>
<div class="container">
	<div class="accordion row community-model">
		<div class="col-md-4 col-sm-4 commlogo-wrap">
			<a href="#<?php the_permalink(); ?>"><?php the_post_thumbnail('full', array('class' => 'commlogo')); ?></a>	
		</div>
		<div class="col-md-7 col-sm-7">			
			<div class="col-12">
				<h3><?php echo $post->post_title; ?></h3>				
			</div>
			<div class="col-sm-6">
				<h5>Sales Office</h5>
				<?php echo get_post_meta($post->ID, "_eqh_address", true) . "<br>"; ?>            	
				<?php $address2 = "";
					if (get_post_meta($post->ID, "_eqh_address2", true) != "") {
						$address2 = ", " . get_post_meta($post->ID, "_eqh_address2", true);
					}
            	?>
            	<?php 
					echo get_post_meta($post->ID, "_eqh_city", true) . " , " . get_post_meta($post->ID, "_eqh_province", true) . $address2 . "<br>"; 
				?>
            <strong>Tel: </strong><a href="tel:+1<?php echo get_post_meta($post->ID, "_eqh_phone", true); ?>"><?php echo get_post_meta($post->ID, "_eqh_phone", true); ?></a><br>
            <?php 
				if (get_post_meta($post->ID, "_eqh_tollfreephone", true) != "") { ?>
                	<strong>Toll Free: </strong><a href="tel:+<?php echo get_post_meta($post->ID, "_eqh_tollfreephone", true); ?>"><?php echo get_post_meta($post->ID, "_eqh_tollfreephone", true); ?></a><br>    
				<?php } ?>
            	<strong>Email: </strong><a href="mailto:<?php echo get_post_meta($post->ID, "_eqh_email", true) ?>"><?php echo get_post_meta($post->ID, "_eqh_email", true) . "</a><br><br>"; ?>
			</div>
			<div class="col-sm-6">
				<h5>Sales Hours</h5>
				 <?php 
					if (get_post_meta($post->ID, "_eqh_hours", true)):
                		echo nl2br(get_post_meta($post->ID, "_eqh_hours", true)) . "<br><br>";
            		endif;
				?>
			</div>				
		</div>		
		<div class="col-md-1 col-sm-1">
			<h3 class="accordion" style="font-size: 50px;"> + </h3>				
		</div>
	</div>
	<div class="panel">
	  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
	</div>
</div>
<hr/>