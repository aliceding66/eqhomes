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
$images = get_field('album', $post->ID);
$thumblist = "";
$imagelist = "";

if ($images):
    ?>

    <?php
    $count = 1;
    $active = " active";
    $links = "";
    foreach ($images as $image):
        $theimage = $image['url'];
        $thecaption = $image['caption'];
        $thumblist.='<li class="' . $active . '" rel="' . $count . '">' . $count . '</li>';
        $imagelist.='<div><img class="" src="' . $theimage . '" alt="' . $thecaption . '"/></div>';
        $links.='<a href="' . $image['sizes']['gallery-feature'] . '" title="' . $thecaption . '" data-gallery>
        <img src="' . $image['sizes']['thumbnail'] . '" alt="' . $thecaption . '">
    </a>';
        $count++;
        $active = "";
        ?>

    <?php endforeach; ?>

<?php endif; ?>

<!--<div class="row">
    <div class="col-xs-12 gallerythumbs">
        <span class="prev pull-left"><a onclick="prevGalleryImage()">Previous</a></span>
        <ul>
<?php echo $thumblist ?>        
        </ul>
        <span class="next pull-right"><a onclick="showNextGalleryImage()">Next</a></span>
        <span class="details"><h4></h4></span>
        <div class="pointer hidden-xs"></div>
        
    </div>
    <div class="col-xs-12 gallerydisplay">
<?php echo $imagelist ?>
    </div>
</div>-->

<div id="links">
    <?php echo $links; ?>
</div>

<!-- The Bootstrap Image Gallery lightbox, should be a child element of the document body -->
<div id="blueimp-gallery" class="blueimp-gallery" data-use-bootstrap-modal="false">
    <!-- The container for the modal slides -->
    <div class="slides"></div>
    <!-- Controls for the borderless lightbox -->
    <h3 class="title"></h3>
    <a class="prev">‹</a>
    <a class="next">›</a>
    <a class="close">×</a>
    <a class="play-pause"></a>
    <ol class="indicator"></ol>
    <!-- The modal dialog, which will be used to wrap the lightbox content -->
    <div class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" aria-hidden="true">&times;</button>
                    <h4 class="modal-title"></h4>
                </div>
                <div class="modal-body next"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left prev">
                        <i class="glyphicon glyphicon-chevron-left"></i>
                        Previous
                    </button>
                    <button type="button" class="btn btn-primary next">
                        Next
                        <i class="glyphicon glyphicon-chevron-right"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>