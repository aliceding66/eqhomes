<?php
/**
 * @package EQ HOMES
 */
$comms = get_post_meta($post->ID, "_eqh_home_community", true);
$c = get_term_by('id', $comms[0], 'eq_communities')->name;
if(trim($c=="Equinelle")){$c="eQuinelle"; }
?>

<?php
/*
<h3><?php echo $c ?> | <?php echo $post->post_title ?></h3>
*/

//print_r( $post);

$postheading = "";

if(strlen( $post->post_content) > 4){
	$postheading =  $post->post_content . " | ";
}

?>

<h3><?php echo $postheading; ?> <?php echo $post->post_title; ?></h3>

<?php
$iframeCode = get_field('external_link', $post->ID);




if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
	
?>	
<h4>Click To See Our Virtual Tour of <?php echo $post->post_title; ?></h4>
<a href="<?php echo $iframeCode; ?>" target="_blank"><img class="img-responsive" src="<?php echo the_post_thumbnail_url(); ?>" /></a>
<?php		
} 

?>



