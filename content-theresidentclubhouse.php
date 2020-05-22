<?php
/**
 * @package EQ HOMES
 
<H1 style="color:#EE0E11;">WARINING!!!! 21</H1>
*/
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <header class="entry-header">
        <?php the_title('<h3 class="entry-title">', '</h3>'); ?>

        <div class="entry-meta">
            <?php eq_homes_posted_on(); ?>
        </div><!-- .entry-meta -->
    </header><!-- .entry-header -->
    <br>
    <div class="news">
        <?php if (has_post_thumbnail()) : ?>
            <?php the_post_thumbnail('gallery-thumb', array('class' => 'news-thumb')); ?> 
        <?php else : ?>
        <?php endif; ?>
        <?php the_content(); ?>
        <?php
        wp_link_pages(array(
            'before' => '<div class="page-links">' . __('Pages:', 'eq_homes'),
            'after' => '</div>',
        ));
        ?>
    </div><!-- .entry-content -->

   <!--<footer class="entry-footer">
        <?php
        /* translators: used between list items, there is a space after the comma */
        $category_list = get_the_category_list(__(', ', 'eq_homes'));

        /* translators: used between list items, there is a space after the comma */
        $tag_list = get_the_tag_list('', __(', ', 'eq_homes'));

        if (!eq_homes_categorized_blog()) {
            // This blog only has 1 category so we just need to worry about tags in the meta text
            if ('' != $tag_list) {
                $meta_text = __('This entry was tagged %2$s. Bookmark the <a href="%3$s" rel="bookmark">permalink</a>.', 'eq_homes');
            } else {
                $meta_text = __('Bookmark the <a href="%3$s" rel="bookmark">permalink</a>.', 'eq_homes');
            }
        } else {
            // But this blog has loads of categories so we should probably display them here
            if ('' != $tag_list) {
                $meta_text = __('This entry was posted in %1$s and tagged %2$s. Bookmark the <a href="%3$s" rel="bookmark">permalink</a>.', 'eq_homes');
            } else {
                $meta_text = __('This entry was posted in %1$s. Bookmark the <a href="%3$s" rel="bookmark">permalink</a>.', 'eq_homes');
            }
        } // end check for categories on this blog

        printf(
                $meta_text, $category_list, $tag_list, get_permalink()
        );
        ?>-->
        
        
 			<!-- Wrapper for slides -->
                        <div class="main-slider">
                            <div id="community-slider" class="carousel slide" data-ride="carousel">
                                <!-- Indicators -->
                                <ol class="carousel-indicators">

                                    <?php
                                    while (have_rows('slideshow')) : the_row();
                                        // echo "Content is: ";
                                        // display a sub field value
                                        // the_sub_field('image');
                                        $image = get_sub_field('image');
                                        $video = get_sub_field('video_url');
                                        if ($image or $video):
                                            ?>

                                            <li data-target="#community-slider" data-slide-to="<?php echo $count; ?>" class="<?php echo $active; ?>"></li>

                                            <?php
                                            $count +=1;
                                            $active = "";
                                        endif;
                                        //Temp stop fernbank on 1st slide
                                        if ($current_community === "fernbank-crossing") {
                                            //break;
                                        }

                                    endwhile;
                                    ?>



                                </ol>



                                <div class="carousel-inner">

                                    <?php
                                    $count = 0;
                                    $active = "active";
                                    while (have_rows('slideshow')) : the_row();
                                        // echo "Content is: ";
                                        // display a sub field value
                                        // the_sub_field('image');
                                        $image = get_sub_field('image');
                                        $video = get_sub_field('video_url');

                                        if ($image or $video):
                                            ?>
                                            <?php if ($video): ?>
                                                <div class="item">
                                                    <?php //echo do_shortcode('[fve]' . $video . '[/fve]'); ?> 

                                                    <a class="youtube" href="<?php echo $video; ?>"><img src="<?php the_sub_field('image'); ?>"></a>
                                                  <!--<iframe width="100%" height="504px" src="http://www.youtube.com/watch?v=HcPTMZZxoVY" frameborder="0" allowfullscreen=""></iframe>-->

                                                </div>
                                            <?php else: ?>


                                                <div class="item <?php echo $active; ?>">
                                                    <a href="<?php the_sub_field('link'); ?>"><img src="<?php the_sub_field('image'); ?>"></a>
                                                </div>

                                            <?php endif; ?>
                                            <?php
                                            $count +=1;
                                            $active = "";
                                        endif;

                                        //Temp stop fernbank on 1st slide
                                        if ($current_community === "fernbank-crossing") {
                                            //break;
                                        }
                                    endwhile;
                                    ?>


                                </div>
                            </div>



                        </div><!-- End Main Slider-->
                                

        <?php edit_post_link(__('Edit', 'eq_homes'), '<div class="edit">', '</div>'); ?>
    </footer><!-- .entry-footer -->
</article><!-- #post-## -->
