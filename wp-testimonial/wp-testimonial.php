<?php
/*
 * Plugin Name:       WP Testimonial
 * Plugin URI:        https://wordpress.org/plugins/wp-testimonial/
 * Description:       Handle the basics with this plugin.
 * Version:           1.0.0
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Engr Sojon Mia
 * Author URI:        https://www.sojonmiawebdeveloper.com/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Update URI:        https://github.com/csesojonmia23
 * Text Domain:       wpstest
 */

/*==================================
*Enqueue the JavaScript and CSS files
*/
function wpstest_enqueue_scripts_and_styles() {
     // owl.carousel.min.css
     wp_enqueue_style('owl-carousel-min-css', 'https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.min.css', array(), '1.0.0', 'all');
     // owl.theme.min.css
     wp_enqueue_style('owl-theme-min-css', 'https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.theme.min.css', array(), '1.0.0', 'all');
     // owl.theme.min.css
     wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css', array(), '1.0.0', 'all');
     // Plugin CSS
     wp_enqueue_style('wpst-sojon-testimonial-css', plugins_url('/css/wpstest-style.css', __FILE__));

     // Enqueue jQuery
     wp_enqueue_script('jquery-min-js', 'https://code.jquery.com/jquery-1.12.0.min.js', array(), '1.0.0', true);
     // owl.carousel.min
     wp_enqueue_script('owl-carousel-min-js', 'https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.min.js', array(), '1.0.0', true);
     // Active jQuery
     wp_enqueue_script('wpst-sojon-testimonial-js', plugins_url('/js/wpstest-script.js', __FILE__), array('jquery'), '1.0.0', true);
 }
 add_action('wp_enqueue_scripts', 'wpstest_enqueue_scripts_and_styles');

/*==================================
*Testimonial Custom post
*/
 if ( ! function_exists('wpstest_custom_testimonial') ) {

    // Register Custom Post Type
    function wpstest_custom_testimonial() {
        $labels = array(
            'name'                  => _x( 'Testimonials', 'Post Type General Name', 'wpstest' ),
            'singular_name'         => _x( 'Testimonial', 'Post Type Singular Name', 'wpstest' ),
            'menu_name'             => __( 'Testimonial', 'wpstest' ),
            'name_admin_bar'        => __( 'Testimonial', 'wpstest' ),
            'archives'              => __( 'Item Archives', 'wpstest' ),
            'attributes'            => __( 'Item Attributes', 'wpstest' ),
            'parent_item_colon'     => __( 'Parent Item:', 'wpstest' ),
            'all_items'             => __( 'All Items', 'wpstest' ),
            'add_new_item'          => __( 'Add New Item', 'wpstest' ),
            'add_new'               => __( 'Add New', 'wpstest' ),
            'new_item'              => __( 'New Item', 'wpstest' ),
            'edit_item'             => __( 'Edit Item', 'wpstest' ),
            'update_item'           => __( 'Update Item', 'wpstest' ),
            'view_item'             => __( 'View Item', 'wpstest' ),
            'view_items'            => __( 'View Items', 'wpstest' ),
            'search_items'          => __( 'Search Item', 'wpstest' ),
            'not_found'             => __( 'Not found', 'wpstest' ),
            'not_found_in_trash'    => __( 'Not found in Trash', 'wpstest' ),
            'featured_image'        => __( 'Featured Image', 'wpstest' ),
            'set_featured_image'    => __( 'Set featured image', 'wpstest' ),
            'remove_featured_image' => __( 'Remove featured image', 'wpstest' ),
            'use_featured_image'    => __( 'Use as featured image', 'wpstest' ),
            'insert_into_item'      => __( 'Insert into item', 'wpstest' ),
            'uploaded_to_this_item' => __( 'Uploaded to this item', 'wpstest' ),
            'items_list'            => __( 'Items list', 'wpstest' ),
            'items_list_navigation' => __( 'Items list navigation', 'wpstest' ),
            'filter_items_list'     => __( 'Filter items list', 'wpstest' ),
        );
        $args = array(
            'menu_icon'             => 'dashicons-testimonial',
            'label'                 => __( 'Testimonial', 'wpstest' ),
            'description'           => __( 'This is custom post testimonial', 'wpstest' ),
            'labels'                => $labels,
            'supports'              => array( 'title', 'editor', 'thumbnail' ),
            'hierarchical'          => false,
            'public'                => true,
            'show_ui'               => true,
            'show_in_menu'          => true,
            'show_in_admin_bar'     => true,
            'show_in_nav_menus'     => true,
            'can_export'            => true,
            'has_archive'           => true,
            'exclude_from_search'   => false,
            'publicly_queryable'    => true,
            'capability_type'       => 'page',
        );
        register_post_type( 'testimonial', $args );
    }
    add_action( 'init', 'wpstest_custom_testimonial', 0 );
    }
/*==================================
*Testimonial Meta box
*/
function wpstest_testimonial_meta_box(){
    // Client name
    add_meta_box(
        'testimonial_name_meta_box', // Unique ID
        'Testimonial Client Name',          // Box title
        'custom_testimonial_name_meta_callback', // Callback function
        'testimonial',               // Post type
        'normal',                    // Context (normal, side, advanced)
        'default'                    // Priority (default, high)
    );
    //  Client Designation
    add_meta_box(
        'testimonial_designation_meta_box', // Unique ID
        'Client Designation',              // Box title
        'custom_testimonial_designation_meta_callback', // Callback function
        'testimonial',                     // Post type
        'normal',                          // Context (normal, side, advanced)
        'default'                          // Priority (default, high)
    );
    //  Star Review
    add_meta_box(
        'testimonial_star_review_meta_box', // Unique ID
        '5-Star Review',                    // Box title
        'custom_testimonial_star_review_meta_callback', // Callback function
        'testimonial',                       // Post type
        'normal',                            // Context (normal, side, advanced)
        'default'                            // Priority (default, high)
    );
}
add_action('add_meta_boxes', 'wpstest_testimonial_meta_box');
//  callback for testimonal client name
function custom_testimonial_name_meta_callback($post) {
    // Get the current value of the testimonial name field
    $testimonial_name = get_post_meta($post->ID, '_testimonial_name', true);

    // Output the HTML for the testimonial Client name field
    ?>
    <label for="testimonial_name">Client Name:</label>
    <input type="text" id="testimonial_name" name="testimonial_name" value="<?php echo esc_attr($testimonial_name); ?>" style="width: 50%;" />
    <?php
}
//  Callback for Client Designation
function custom_testimonial_designation_meta_callback($post) {
    // Get the current value of the client designation field
    $testimonial_designation = get_post_meta($post->ID, '_testimonial_designation', true);

    // Output the HTML for the client designation field
    ?>
    <label for="testimonial_designation">Client Designation:</label>
    <input type="text" id="testimonial_designation" name="testimonial_designation" value="<?php echo esc_attr($testimonial_designation); ?>" style="width: 50%;" />
    <?php
}
//  Callback for Star Review
function custom_testimonial_star_review_meta_callback($post) {
    // Get the current value of the star review field
    $star_review = get_post_meta($post->ID, '_star_review', true);

    // Output the HTML for the star review field
    ?>
    <label for="star_review">5-Star Review:</label>
    <select id="star_review" name="star_review">
        <option value="1" <?php selected($star_review, '1'); ?>>1 Star</option>
        <option value="2" <?php selected($star_review, '2'); ?>>2 Stars</option>
        <option value="3" <?php selected($star_review, '3'); ?>>3 Stars</option>
        <option value="4" <?php selected($star_review, '4'); ?>>4 Stars</option>
        <option value="5" <?php selected($star_review, '5'); ?>>5 Stars</option>
    </select>
    <?php
}
/*==================================
*Testimonial Save Metabox Callback Funtion
*/
function wpstest_save_testimonial_meta($post_id){
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    // Testimonial Client Name
    if (isset($_POST['testimonial_name'])) {
        update_post_meta($post_id, '_testimonial_name', sanitize_text_field($_POST['testimonial_name']));
    }
    //  Client Designation
    if (isset($_POST['testimonial_designation'])) {
        update_post_meta($post_id, '_testimonial_designation', sanitize_text_field($_POST['testimonial_designation']));
    }
    //  Star Review
    if (isset($_POST['star_review'])) {
        update_post_meta($post_id, '_star_review', sanitize_text_field($_POST['star_review']));
    }
}
add_action('save_post', 'wpstest_save_testimonial_meta');

/*==================================
*Testimonial HTML Content
*/
function wpstest_testimonial_loop(){
    ?>
        <div id="testimonial-slider" class="owl-carousel">
    <?php
    // WP_Query arguments
    $args = array(
        'post_type'              => array( 'testimonial' ),
    );

    // The Query
    $wpstest_custom_testimonial_query = new WP_Query( $args );

    // The Loop
    if ( $wpstest_custom_testimonial_query->have_posts() ) {
        while ( $wpstest_custom_testimonial_query->have_posts() ) {
            $wpstest_custom_testimonial_query->the_post();
            // do something
            ?>
                <div class="testimonial">
                    <div class="pic">
                      <?php echo the_post_thumbnail('testimonial'); ?>
                    </div>
                    <h3 class="title"><?php the_title(); ?></h3>
                    <p class="description"><?php the_excerpt(); ?></p>
                    <div class="testimonial-content">
                        <div class="testimonial-profile">
                            <h3 class="name"><?php echo get_post_meta(get_the_ID(), '_testimonial_name', true); ?></h3>
                            <span class="post"><?php echo get_post_meta(get_the_ID(), '_testimonial_designation', true); ?></span>
                        </div>
                        <ul class="rating">
                            <?php
                            $star_review = get_post_meta(get_the_ID(), '_star_review', true);
                            if($star_review==1){
                                ?>
                                <li class="fa fa-star"></li>
                                <?php
                            }
                            if($star_review==2){
                                ?>
                                <li class="fa fa-star"></li><li class="fa fa-star"></li>
                                <?php
                            }
                            if($star_review==3){
                                ?>
                                <li class="fa fa-star"></li><li class="fa fa-star"></li><li class="fa fa-star"></li>
                                <?php
                            }
                            if($star_review==4){
                                ?>
                                <li class="fa fa-star"></li><li class="fa fa-star"></li><li class="fa fa-star"></li><li class="fa fa-star"></li>
                                <?php
                            }
                            if($star_review==5){
                                ?>
                                <li class="fa fa-star"></li><li class="fa fa-star"></li><li class="fa fa-star"></li><li class="fa fa-star"></li><li class="fa fa-star"></li>
                                <?php
                            }
                            ?>
                        </ul>
                    </div>
                </div>
            <?php
        }
    } else {
        // no posts found
    }

    // Restore original Post Data
    wp_reset_postdata();
    ?>
        </div>
    <?php
}
/*==================================
*Add Testimonial Shortcode
*/
add_action('init', 'wpstest_testimonial_shortcode');
function wpstest_testimonial_shortcode(){
    add_shortcode('WPSTEST-TESTIMONIAL', 'wpstest_testimonial_loop');
}
/*=======================================
*Create a sub-menu page under the Testimonial menu
*/
function wpstest_testimonial_setting_submenu() {
    add_submenu_page(
        'edit.php?post_type=testimonial', // Parent menu slug
        'Testimonial Setting',              // Page title
        'Setting',                          // Menu title
        'manage_options',                   // Capability required to access
        'testimonial-setting',              // Menu slug (unique identifier)
        'display_testimonial_setting_page'  // Callback function to display page content
    );
}
add_action( 'admin_menu', 'wpstest_testimonial_setting_submenu' );
 // Callback function to display the content of the Testimonial Setting page
 function display_testimonial_setting_page() {
    ?>
    <div class="wpstest_wrap">
        <div class="testimonial_section_styling common_styling">
            <h3 id="title"><?php print esc_attr('Testimonial Setting');?></h3>
            <p id="description"><?php print esc_attr('This is the content of the Testimonial Setting page.');?></p>
            <form action="options.php" method="post">
            <?php wp_nonce_field('update-options'); ?>
            <!-- Shortcode -->
            <label for="" name=""><?php print esc_attr('Shortcode: ');?></label>
            <p>[WPSTEST-TESTIMONIAL]</p>
            <!-- Primary Color -->
            <label for="wpstest-primary-color" name="wpstest-primary-color"><?php print esc_attr('Primary Color: ');?></label>
            <input type="color" name="wpstest-primary-color" id="" value="<?php print get_option('wpstest-primary-color');?>">
            <br><br><br>
            <!-- Secondary Color -->
            <label for="wpstest-secondary-color" name="wpstest-secondary-color"><?php print esc_attr('Secondary Color: ');?></label>
            <input type="color" name="wpstest-secondary-color" id="" value="<?php print get_option('wpstest-secondary-color');?>">
            <!-- Submit Button -->
            <br><br><br>
            <input type="hidden" name="action" value="update">
            <input type="hidden" name="page_options" value="wpstest-primary-color, wpstest-secondary-color">
            <input type="submit" name="submit" class="button button-primary" value="<?php _e('Save Changes', 'wplpc') ?>">

            </form>
        </div>
        
        <div class="author_info common_styling">
            <h3 id="title"><?php print esc_attr('Author Information');?></h3>
            <img src="<?php echo plugins_url( 'img/author_img.png', __FILE__ );?>" alt="author_img" class="myimg">
            <p class="sojon_id"><?php print esc_attr('Engr Sojon Mia, a Computer Engineer, offers expert WordPress theme and plugin development services. With a deep understanding of web technology, I create custom themes to enhance site aesthetics and plugins to add functionality. Providing tailored solutions, I optimize websites for improved performance and user experience, catering to diverse client needs.');?></p>
            <h3 class="contact"><?php print esc_attr('Contact Me');?></h3>
            <p class="sojon_id"><b><?php print esc_attr('Gmail:');?> </b><?php print esc_attr('sojonmiawebdev@gmail.com');?></p>
            <p class="sojon_id"><b><?php print esc_attr('WhatsApp:');?> </b><?php print esc_attr('+88 01708926923');?></p>
            <p class="sojon_id"><b><?php print esc_attr('LinkdedIn:');?></b> <a href="https://www.linkedin.com/in/csesojonmia23/" target="_blank"><?php print esc_attr('www.linkedin.com/in/csesojonmia23');?></a></p>
            <p class="sojon_id"><b><?php print esc_attr('Portfolio:');?></b> <a href="https://www.sojonmiawebdeveloper.com/" target="_blank"><?php print esc_attr('www.sojonmiawebdeveloper.com');?></a></p>
            <p class="sojon_id"><b><?php print esc_attr('gitHub:');?></b> <a href="https://github.com/csesojonmia23" target="_blank"><?php print esc_attr('https://github.com/csesojonmia23');?></a></p>
        </div>
    </div>
    <?php
}
// Applying CSS
function wpstest_color_css(){
    ?>
        <style>
             .testimonial .title{
                color: <?php print get_option("wpstest-primary-color"); ?>;
            }
            .testimonial .post{
            color: <?php print get_option("wpstest-primary-color"); ?>;
            }
            .testimonial .rating{
            background: <?php print get_option("wpstest-primary-color"); ?>;
            }
            .owl-theme .owl-controls .owl-buttons div:hover{
            background: <?php print get_option("wpstest-primary-color"); ?>;
            border-color: <?php print get_option("wpstest-primary-color"); ?>;
            }
            .testimonial:hover .testimonial-content{ border-color: <?php print get_option("wpstest-secondary-color"); ?>; }
            .testimonial .testimonial-content:after{
            background: <?php print get_option("wpstest-secondary-color"); ?>;
            }
            .testimonial .name{
            color: <?php print get_option("wpstest-secondary-color"); ?>;
            }
        </style>
    <?php
}
add_action('wp_head', 'wpstest_color_css');
// Enqueue CSS file for styling plugin page
function wpstest_admin_enqueue_register(){
    wp_enqueue_style( 'wpstest_admin_enqueue', plugins_url( 'css/wpstest_admin.css', __FILE__ ), false, "1.0.0");
}
add_action('admin_enqueue_scripts', 'wpstest_admin_enqueue_register');

/*=====================================
* Plugin Redirect Feature
*/
register_activation_hook( __FILE__, 'wpstest_plugin_activation' );
function wpstest_plugin_activation(){
    add_option('wpstest_plugin_do_activation_redirect', true);
  }

add_action( 'admin_init', 'wpst_plugin_redirect');
function wpst_plugin_redirect(){
    if(get_option('wpstest_plugin_do_activation_redirect', false)){
      delete_option('wpstest_plugin_do_activation_redirect');
      if(!isset($_GET['active-multi'])){
        wp_safe_redirect(admin_url('edit.php?post_type=testimonial&page=testimonial-setting'));
        exit;
      }
    }
  }
?>