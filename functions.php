<?php

if (is_user_logged_in()) {
    show_admin_bar(true);
}


add_filter('widget_text', 'do_shortcode');

add_filter('excerpt_length', 'my_excerpt_length');

function my_excerpt_length($len) {
    return 40;
}

add_theme_support('post-thumbnails');

function no_generator() {
    return '';
}

add_filter('the_generator', 'no_generator');

function explain_less_login_issues() {
    return '<strong>ERROR</strong>: Entered credentials are incorrect.';
}

add_filter('login_errors', 'explain_less_login_issues');
/**
 * EQ HOMES functions and definitions
 *
 * @package EQ HOMES
 */
/**
 * Set the content width based on the theme's design and stylesheet.
 */
require_once('inc/wp_bootstrap_navwalker.php');

if (!isset($content_width)) {
    $content_width = 640; /* pixels */
}

if (!function_exists('eq_homes_setup')) :

    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     */
    function eq_homes_setup() {

        /*
         * Make theme available for translation.
         * Translations can be filed in the /languages/ directory.
         * If you're building a theme based on EQ HOMES, use a find and replace
         * to change 'eq_homes' to the name of your theme in all the template files
         */
        load_theme_textdomain('eq_homes', get_template_directory() . '/languages');

        // Add default posts and comments RSS feed links to head.
        add_theme_support('automatic-feed-links');

        /*
         * Enable support for Post Thumbnails on posts and pages.
         *
         * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
         */
        //add_theme_support( 'post-thumbnails' );
        // This theme uses wp_nav_menu() in one location.
        register_nav_menus(array(
            'primary' => __('Primary Menu', 'eq_homes'),
            'communities' => __('Community Menu', 'eq_homes'),
            'common' => __('Common Menu', 'eq_homes'),
            'why_eq_homes' => __('Why EQ Menu', 'eq_homes'),
            'decor_center' => __('Decor Center Menu', 'eq_homes'),
            'customer_care' => __('Customer Care Menu', 'eq_homes'),
        ));

        // Enable support for Post Formats.
        add_theme_support('post-formats', array('aside', 'image', 'video', 'quote', 'link','audio','status'));

        // Setup the WordPress core custom background feature.
        add_theme_support('custom-background', apply_filters('eq_homes_custom_background_args', array(
            'default-color' => 'ffffff',
            'default-image' => '',
        )));

        // Enable support for HTML5 markup.
        add_theme_support('html5', array(
            'comment-list',
            'search-form',
            'comment-form',
            'gallery',
            'caption',
        ));
    }

endif; // eq_homes_setup
add_action('after_setup_theme', 'eq_homes_setup');

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function eq_homes_widgets_init() {
    register_sidebar(array(
        'name' => __('Sidebar', 'eq_homes'),
        'id' => 'sidebar-1',
        'description' => '',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h1 class="widget-title">',
        'after_title' => '</h1>',
    ));
}

add_action('widgets_init', 'eq_homes_widgets_init');

/**
 * Enqueue scripts and styles.
 */
function eq_homes_scripts() {
    wp_enqueue_style( 'eq_style', get_stylesheet_uri(). '?'.time()  );
    wp_enqueue_style('eq_homes-style', get_template_directory_uri() . '/css/style.min.css');
    wp_enqueue_style('gallery-style', get_template_directory_uri() . '/css/blueimp-gallery.min.css');

    wp_enqueue_script('jquery', get_template_directory_uri() . '/js/jquery.js', array(), null, true);
    wp_enqueue_script('blue-imp', get_template_directory_uri() . '/js/jquery.blueimp-gallery.min.js', array('jquery'), null, false);
    wp_enqueue_script('image-gallery', get_template_directory_uri() . '/js/bootstrap-image-gallery.js', array('blue-imp'), null, false);
    wp_enqueue_script('eq_homes-script', get_template_directory_uri() . '/js/main.min.js', array('jquery'), null, true);
    wp_enqueue_script('moment', get_template_directory_uri() . '/js/moment.js', array('eq_homes-script'), null, true);
    wp_enqueue_script('datepicker', get_template_directory_uri() . '/js/bootstrap-datetimepicker.min.js', array('moment'), null, true);

    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
    $site_parameters = array(
        'community_page' => get_site_url() . '/community',
        'favourite_page' => get_site_url() . '/favourites'
    );
    wp_localize_script('eq_homes-script', 'js_object', $site_parameters);
}

add_action('wp_enqueue_scripts', 'eq_homes_scripts');


/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

function get_page_by_slug($page_slug, $output = OBJECT, $post_type = 'page') {
    global $wpdb;
    $page = $wpdb->get_var($wpdb->prepare("SELECT ID FROM $wpdb->posts WHERE post_name = %s AND post_type= %s AND post_status = 'publish'", $page_slug, $post_type));
    if ($page)
        return get_post($page, $output);
    return null;
}

function my_search_form($form) {
    $form = '<form role="search" method="get" id="searchform" class="searchform" action="' . home_url('/') . '" >
    <div><label class="screen-reader-text" for="s">' . __('Search for:') . '</label>
    <input type="text" value="' . get_search_query() . '" name="s" id="s" />
    <input type="submit" id="searchsubmit" value="' . esc_attr__('Search') . '" />
    </div>
    </form>';

    $form = '<form role="search" id="search" method="get" action="' . home_url('/') . '" >
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search Site" value="' . get_search_query() . '" name="s" id="s" />
                            <div class="input-group-btn">
                                <button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-search"></span></button>
                            </div>
                        </div>
                    </form>';
    return'';
    return $form;
}

add_filter('get_search_form', 'my_search_form');

/**
 * Register our sidebars and widgetized areas.
 *
 */
function community_widget_init() {

    register_sidebar(array(
        'name' => 'Community Widget',
        'id' => 'hometop-row',
        'before_widget' => '<div class="hometop-row row">',
        'after_widget' => '</div>',
        'before_title' => '<h2>',
        'after_title' => '</h2>',
    ));

    register_sidebar(array(
        'name' => 'Village Walk',
        'id' => 'vilagewalk-row',
        'before_widget' => '<div class="vilagewalk-row row">',
        'after_widget' => '</div>',
        'before_title' => '<h2>',
        'after_title' => '</h2>',
    ));

    register_sidebar(array(
        'name' => 'Home Share',
        'id' => 'home-share',
        'before_widget' => '<div class="homeshare">',
        'after_widget' => '</div>',
        'before_title' => '',
        'after_title' => '',
    ));
}

add_action('widgets_init', 'community_widget_init');

function gk_social_buttons($permalink) {
    //global $post;
    //$permalink = get_permalink($post->ID);
    //$title = get_the_title();
    //if(!is_feed() && !is_home() && !is_page()) {
    $content = '<div class="gk-social-buttons">

        <a class="icon-twitter" href="http://twitter.com/share?text=' . $title . '&url=' . $permalink . '"
            onclick="window.open(this.href, \'twitter-share\', \'width=550,height=235\');return false;">
            <span>Twitter</span>
        </a>

        <a class="icon-fb" href="https://www.facebook.com/sharer/sharer.php?u=' . $permalink . '"
             onclick="window.open(this.href, \'facebook-share\',\'width=580,height=296\');return false;">
            <span>Facebook</span>
        </a>

        <a class="icon-gplus" href="https://plus.google.com/share?url=' . $permalink . '"
           onclick="window.open(this.href, \'google-plus-share\', \'width=490,height=530\');return false;">
            <span>Google+</span>
        </a>


        <a class="icon-mail" href="mailto:recipient?cc=recipient&bcc=recipient&subject=Visit+EQ+HOMES&body=' . $permalink . '" >
            <span>Email</span>
        </a>
    </div>';
    // }
    return $content;
}


	function eqCommunityDropDownList(){

		$args = array(
			'post_type' => 'community',
			'posts_per_page' => 50
			// Several more arguments could go here. Last one without a comma.
		);

		// Query the posts:
		$obituary_query = new WP_Query($args);


			// Loop through the communiites:
			while ($obituary_query->have_posts()) : $obituary_query->the_post();
				$eq_current_post_id =  get_the_ID();

				$eq_lasso_crm_id =  get_post_meta($eq_current_post_id, "_eqh_lasso_crm_id", true);


				// check if community is using external link
				// if yes then don't show in drop down
				$use_external_link = get_post_meta($eq_current_post_id, "_eqh_use_external_link", true);

				//echo " use_external_link = " . $use_external_link . "";

				$current_community_eqh_status = get_post_meta($eq_current_post_id, "_eqh_status", true);

				//echo " use_external_link = " . $current_community_eqh_status . "";

				// display community in dropdown if community is now_selling and coming_soon
				if($current_community_eqh_status == "now_selling" || $current_community_eqh_status == "coming_soon"){
					// make drop down

					if($eq_current_post_id != 475){
						echo '<option value="' . get_the_title() . '||' . $eq_current_post_id . '||' . $eq_lasso_crm_id . '">' . get_the_title() . '</option>';
					}

				}


			endwhile;


		// Reset Post Data
		wp_reset_postdata();


	}


function determine_locale_temp(){
return ;
}
//add_filter('the_content', 'gk_social_buttons');
