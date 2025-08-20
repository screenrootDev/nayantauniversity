<?php

/**
 * Nayanta University Theme Functions
 *
 * This file contains core functionality for the Nayanta University theme
 * including script loading, security configurations, and image processing.
 *
 * @package Nayanta_University
 */

// Security check - prevent direct file access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Enqueue theme styles and scripts
 * 
 * Loads the necessary CSS and JavaScript files for the theme
 * and passes data to JavaScript if needed.
 */
function nayanta_enqueue_scripts()
{
    // Enqueue the main stylesheet (style.css) with a version number for cache busting
    wp_enqueue_style(
        'nayanta-font-style',
        get_template_directory_uri() . '/assets/fonts/fonts.css',
        array(),
        '1.0.0'
    );

    wp_enqueue_style(
        'nayanta-style',
        get_stylesheet_uri(),
        array(),
        '1.0.0'
    );

    // Enqueue theme JavaScript with jQuery dependency
    wp_enqueue_script(
        'app-js',
        get_template_directory_uri() . '/assets/js/app.js',
        array('jquery'),
        '1.0.0',
        true
    );

    wp_enqueue_script(
        'custom-js',
        get_template_directory_uri() . '/assets/js/custom.js',
        array('jquery'),
        '1.0.0',
        true
    );

    // Pass site URL data to JavaScript for use in AJAX or other functionality
    wp_localize_script(
        'app-js',
        'nayantaData',
        array(
            'siteUrl' => esc_url(home_url('/')),
        )
    );
    wp_localize_script(
        'custom-js',
        'nayantaData',
        array(
            'siteUrl' => esc_url(home_url('/')),
            'ajax_url' => admin_url('admin-ajax.php'),
            'nonce'    => wp_create_nonce('event_nonce'), // ✅ FIXED HERE
        ),
    );
}
// Hook into WordPress to enqueue scripts and styles
add_action('wp_enqueue_scripts', 'nayanta_enqueue_scripts');

/**
 * Restrict REST API access to logged-in users
 * 
 * Adds a security layer by requiring authentication for REST API access
 * 
 * @param mixed $access Current REST API authentication check result
 * @return mixed Modified access result
 */
function nayanta_restrict_rest_api($access)
{
    if (!is_user_logged_in()) {
        return new WP_Error(
            'rest_forbidden',
            __('You cannot view the REST API without being authenticated.', 'nayanta'),
            array('status' => 403)
        );
    }
    return $access;
}
add_filter('rest_authentication_errors', 'nayanta_restrict_rest_api');

/**
 * Bypass WordPress check for large image sizes
 * 
 * Allows uploading images larger than the default threshold
 */
add_filter('big_image_size_threshold', '__return_false');

/**
 * Set GD Library as the default image editor
 * 
 * Ensures consistent image processing by prioritizing GD over other editors
 * 
 * @param array $editors Array of available image editors
 * @return array Modified array with GD editor first
 */
function nayanta_image_editor_default_to_gd($editors)
{
    $gd_editor = 'WP_Image_Editor_GD';

    // Remove GD from current position (if it exists)
    $editors = array_diff($editors, array($gd_editor));

    // Add GD to the beginning of the array
    array_unshift($editors, $gd_editor);

    return $editors;
}
add_filter('wp_image_editors', 'nayanta_image_editor_default_to_gd');

// Remove WordPress version and theme info
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'wp_resource_hints', 2);
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'wp_shortlink_wp_head');
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);

// Optional: remove theme stylesheet name from HTML
add_filter('style_loader_tag', 'remove_theme_info', 10, 4);
function remove_theme_info($html, $handle, $href, $media)
{
    $html = preg_replace('/id=["\'].*?["\']/', '', $html);
    return $html;
}


// Disable WordPress REST API for non-authenticated users
add_filter('rest_endpoints', function ($endpoints) {
    if (isset($endpoints['/wp/v2/themes'])) {
        unset($endpoints['/wp/v2/themes']);
    }
    return $endpoints;
});

/**
 * Add X-Robots-Tag header for SEO control
 * 
 * Adds header to tell search engines how to handle the site
 */
function nayanta_add_xrobots_tag()
{
    // Only add the header on frontend pages
    if (!is_admin()) {
        header('X-Robots-Tag: index, follow', true);
    }
}
add_action('send_headers', 'nayanta_add_xrobots_tag');

/**
 * Disable WordPress XML-RPC functionality
 * 
 * Improves security by disabling the XML-RPC API which can be
 * a vector for brute force attacks
 */
add_filter('xmlrpc_enabled', '__return_false');

//Redirecting the custom post type preview into page url
add_filter('preview_post_link', 'custom_preview_redirect', 10, 2);

function custom_preview_redirect($preview_link, $post)
{
    if (!is_object($post) || empty($post->post_type)) {
        return $preview_link;
    }

    switch ($post->post_type) {
        case 'landing-page':
            return home_url('/landing-page');
        case 'undergraduate-progra': // fixed typo from 'undergraduate-progra'
            return home_url('/undergraduate-programme');
        case 'privacy-policy-page':
            return home_url('/privacy-policy');
        case 'faculty-page':
            return home_url('/faculty');
        case 'contact-us-page':
            return home_url('/contact-us');
        case 'about-us-page':
            return home_url('/about-us');
        case 'admissions-page':
            return home_url('/admissions');
        case 'major-electives':
            return home_url('/major-electives');
        case 'minor-electives':
            return home_url('/minor-electives');
        default:
            return $preview_link;
    }
}

function nayanta_load_events_ajax()
{
    // Security check
    if (!isset($_POST['nonce']) || !wp_verify_nonce($_POST['nonce'], 'event_nonce')) {
        wp_send_json_error('Invalid nonce');
        wp_die();
    }

    $event_type = sanitize_text_field($_POST['post_type']);
    $order      = sanitize_text_field($_POST['order']);
    $paged      = isset($_POST['page']) ? intval($_POST['page']) : 1;

    // Default to 'DESC' and 'event_date' if values not provided
    $order      = !empty($order) ? $order : 'DESC';

    $args = [
        'post_type'      => 'events-and-news',
        'posts_per_page' => 4,
        'paged'          => $paged,
        'meta_key'       => 'event_date',
        'orderby'        => 'meta_value',
        'order'          => $order,
        'meta_type'      => 'DATE',
    ];

    if (!empty($event_type)) {
        $args['tax_query'] = [
            [
                'taxonomy' => 'events-and-news-category',
                'field'    => 'slug',
                'terms'    => $event_type,
            ],
        ];
    }


    $query = new WP_Query($args);

    ob_start();
    if ($query->have_posts()) :
        while ($query->have_posts()) : $query->the_post();
            $event_date = get_field('event_date');
            $event_location = get_field('event_location');
            $event_mode = get_field('event_mode');
            $location_icon = get_field('location_icon');
            $event_description = get_field('event_description');
?>
            <div class="card card-classroom">
                <?php
                $event_image = get_field('event_image');
                if (!empty($event_image)) : ?>
                    <div class="card-img">
                        <img src="<?php echo esc_url($event_image['url']); ?>"
                            alt="<?php echo esc_attr($event_image['alt']); ?>" />
                    </div>
                <?php endif; ?>

                <div class="card-body-wrap">
                    <div class="card-body">
                        <div class="card-title"><?php the_title(); ?></div>
                        <div class="card-text">
                            <p><?php echo esc_html($event_description); ?></p>
                        </div>
                    </div>
                    <div class="card-footer">
                        <ul class="tag-icon-wrap">
                            <?php if ($event_date) : ?>
                                <li>
                                    <i class="icon-calendar"></i>
                                    <span><?php echo date('F j, Y', strtotime($event_date)); ?></span>
                                </li>
                            <?php else: ?>
                                <li>
                                    <i class="icon-calendar"></i>
                                    <span><?php echo esc_html('ongoing'); ?></span>
                                </li>
                            <?php endif; ?>
                            <?php if ($event_location) : ?>
                                <li>
                                    <i class="<?php echo esc_html($location_icon); ?>"></i>
                                    <span><?php echo esc_html($event_location); ?></span>
                                </li>
                            <?php endif; ?>
                        </ul>
                        <?php
                        $read_more_link = get_field('read_more'); // ACF Link field (type: Link)
                        if (!empty($read_more_link) && isset($read_more_link['url'])) :
                        ?>
                            <div class="link-wrap">
                                <a href="<?php echo esc_url($read_more_link['url']); ?>"
                                    target="<?php echo esc_attr($read_more_link['target'] ?? '_self'); ?>"
                                    class="arrow-link right">
                                    <?php echo esc_html($read_more_link['title'] ?? 'Read More'); ?>
                                </a>
                            </div>
                        <?php endif; ?>

                    </div>
                </div>
            </div>
<?php
        endwhile;
        wp_reset_postdata();
    else :
        echo '<p>No events found.</p>';
    endif;

    $html_output = ob_get_clean();

    // Check if more pages exist
    $more_pages = $query->max_num_pages > $paged;

    wp_send_json_success([
        'html'       => $html_output,
        'more_pages' => $more_pages,
        'current_page' => $paged,
    ]);
    wp_die();
}


add_action('wp_ajax_nayanta_load_events_ajax', 'nayanta_load_events_ajax');
add_action('wp_ajax_nopriv_nayanta_load_events_ajax', 'nayanta_load_events_ajax');

define('FS_METHOD', 'direct');

add_action('admin_init', function () {
    $user_id = get_current_user_id();

    if ($user_id == 8) {
        $allowed_post_id = 1029; // The About Us page ID
        $allowed_post_type = 'career'; // Your custom post type

        // 1. Block creating new posts of any type
        if (isset($_GET['post_type']) && $_GET['post_type'] !== $allowed_post_type && strpos($_SERVER['REQUEST_URI'], 'post-new.php') !== false) {
            wp_die('You do not have permission to create new content.');
        }

        // 2. Allow only the About Us page to be edited
        if (isset($_GET['post']) && isset($_GET['action']) && $_GET['action'] === 'edit') {
            $post_id = intval($_GET['post']);
            if ($post_id !== $allowed_post_id) {
                wp_die('You are not allowed to edit this content.');
            }
        }

        // 3. Block theme settings page
        if (isset($_GET['page']) && $_GET['page'] === 'theme-settings') {
            wp_die('Access to theme settings is restricted.');
        }
    }
});

// Hide all other menus except About Us
add_action('admin_menu', function () {
    if (get_current_user_id() == 8) {
        global $menu, $submenu;

        // Allow only custom post type menu
        foreach ($menu as $index => $item) {
            if ($item[2] !== 'edit.php?post_type=career') {
                unset($menu[$index]);
            }
        }

        // Show only the About Us edit link
        if (isset($submenu['edit.php?post_type=career'])) {
            foreach ($submenu['edit.php?post_type=career'] as $index => $sub_item) {
                if (strpos($sub_item[2], 'post=173') === false) {
                    unset($submenu['edit.php?post_type=career'][$index]);
                }
            }
        }
    }
}, 999);
