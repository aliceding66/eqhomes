<?php
/**
 * Template Name: Joint Our Team
 *
 * This is the template that displays Join Our Team page and all the jobs postings from custom career-opportunities post
 *
 * @package EQ HOMES
 */
get_header();
?>

<div class="container">
    <div class="row ">
		<div class="col-xs-12">
		
		
        <?php 
			// Display Joint Our Team page
		
			while (have_posts()) : the_post(); 
		?>

            <?php 
			
			the_content();
			//get_template_part('content', 'page'); ?>


        <?php endwhile; // end of the loop. 
		
			wp_reset_query();
		?>


		<?php
			// Custom post contents
		
			// query to get all custom career-opportunities posts
			// orderby menu_order in ascending order
            $my_query = new WP_Query(array(
                'post_type' => array('career-opportunities'),
                'posts_per_page' => -1,
                'orderby' => 'menu_order',
                'order'=>'DESC',
                'ignore_sticky_posts' => 1

                
            ));

        ?>

        <?php while ($my_query->have_posts()) : $my_query->the_post();?>
            <div class="news ">
                <h2><?php the_title(); ?></h2>
                <h3><?php echo get_field("sub_title"); // custom filed sub_title ?></h3>
        
                <?php the_content(); ?>
                
        <?php 
			// check if there is a pdf file for job details
			if (get_field("upload_pdf")) { 
		?>
            	<div class='col-md-12'><a class="btn btn-black pull-right" type="button" href="<?php echo get_field("upload_pdf"); ?>" target="_blank">Download Job Details PDF</a></div>
            	<br style="clear:both">
        <?php 
			}
		?>
                                    
            </div>
        <?php
               
            endwhile;
            wp_reset_query();
        ?>    
        </div>
    </div>
</div>

<?php //get_sidebar(); ?>
<?php get_footer(); ?>
