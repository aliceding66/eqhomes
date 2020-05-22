<?php
/**
 * @package EQ HOMES
 */
?>

<div class="container">
    <div class="row">


        <div class="col-xs-12">
            <header class="entry-header">
                <?php the_title(sprintf('<h3 class="entry-title"><a href="%s" rel="bookmark">', esc_url(get_permalink())), '</a></h3>'); ?>

                <?php if ('post' == get_post_type()) : ?>
                    <div class="entry-meta">
                        <?php eq_homes_posted_on(); ?>
                    </div><!-- .entry-meta -->
                <?php endif; ?>
            </header><!-- .entry-header -->

            <?php if (is_search()) : // Only display Excerpts for Search ?>
                <div class="entry-summary">
                    <?php the_excerpt(); ?>
                </div><!-- .entry-summary -->
            <?php else : ?>
                <div class="entry-content">
                    <?php the_content(__('Continue reading <span class="meta-nav">&rarr;</span>', 'eq_homes')); ?>
                    <?php
                    wp_link_pages(array(
                        'before' => '<div class="page-links">' . __('Pages:', 'eq_homes'),
                        'after' => '</div>',
                    ));
                    ?>
                </div><!-- .entry-content -->
            <?php endif; ?>

            <footer class="entry-footer">
                <?php if ('post' == get_post_type()) : // Hide category and tag text for pages on Search ?>
                    <?php
                    /* translators: used between list items, there is a space after the comma */
                    $categories_list = get_the_category_list(__(', ', 'eq_homes'));
                    if ($categories_list && eq_homes_categorized_blog()) :
                        ?>
                        <span class="cat-links">
                            <?php printf(__('Posted in %1$s', 'eq_homes'), $categories_list); ?>
                        </span>
                    <?php endif; // End if categories ?>

                    <?php
                    /* translators: used between list items, there is a space after the comma */
                    $tags_list = get_the_tag_list('', __(', ', 'eq_homes'));
                    if ($tags_list) :
                        ?>
                        <span class="tags-links">
                            <?php printf(__('Tagged %1$s', 'eq_homes'), $tags_list); ?>
                        </span>
                    <?php endif; // End if $tags_list ?>
                <?php endif; // End if 'post' == get_post_type() ?>

                <?php if (!post_password_required() && ( comments_open() || '0' != get_comments_number() )) : ?>
                    <span class="comments-link"><?php comments_popup_link(__('Leave a comment', 'eq_homes'), __('1 Comment', 'eq_homes'), __('% Comments', 'eq_homes')); ?></span>
                <?php endif; ?>

                <?php edit_post_link(__('Edit', 'eq_homes'), '<div class="edit">', '</div>'); ?>
            </footer><!-- .entry-footer -->
        </div>

    </div>

</div>
