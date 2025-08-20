<?php
/**
 * Template Name: PrivacyPolicyPage
 *
 * Template for displaying the Privacy Policy page content including
 * breadcrumb navigation, main content, and contact section.
 *
 * @package Nayanta_University
 */

// Security check - prevent direct file access
if (!defined('ABSPATH')) {
    exit;
}

// Include the header template
get_header();

try {
    // Query arguments to fetch privacy policy content
    $args = array(
        'post_type'      => 'privacy-policy-page',
        'orderby'        => 'ID',
        'order'          => 'ASC',
        'posts_per_page' => 1,
        'post_status'    => 'publish',
    );
    
    // Create a new query instance
    $privacy_query = new WP_Query($args);
    
    // Check if posts exist
    if ($privacy_query->have_posts()) :
        while ($privacy_query->have_posts()) : $privacy_query->the_post();
            
            // Get the current post ID
            $post_id = get_the_ID();
            
            // Proceed only if we have a valid post ID
            if ($post_id) {
                // Get banner content
                $banner_text   = get_post_meta($post_id, 'banner_text', true);
                $banner_images = get_post_meta($post_id, 'banner_images', true);
                
                // Get section headings
                $our_team_heading = get_field('our_team_heading', $post_id);
                $building_leaders_heading = get_field('building_leaders_heading', $post_id);
                
                // Ensure banner_images is a valid array
                if (!empty($banner_images) && is_array($banner_images)) {
                    $banner_images = array_values(array_filter($banner_images)); // Get only values & remove empty
                }
            }
            ?>
            
            <!-- Breadcrumb Navigation -->
            <nav aria-label="breadcrumb" class="breadcrumb-nav">
                <div class="container-fluid">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="<?php echo esc_url(get_site_url()); ?>">home</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">privacy policy</li>
                    </ol>
                </div>
            </nav>
            
            <?php 
            // Main Privacy Policy Content Section
            $privacy_policy_content = get_field('privacy_policy_content', $post_id); 
            
            if (!empty($privacy_policy_content)) : 
            ?>
                <section class="section section-inner-hero section-static pb-0 fade">
                    <div class="container">
                        <?php echo wpautop($privacy_policy_content); ?>
                    </div>
                </section>
            <?php endif; ?>
            
            <!-- Contact Section -->
            <section class="section section-contact fade">
                <div class="container">
                    <div class="card card-big">
                        <div class="card-body p-0">
                            <?php 
                            // Contact Section Title
                            $contact_us_title = get_field('contact_us_title', $post_id); 
                            
                            if (!empty($contact_us_title)) : 
                            ?>
                                <div class="card-title h2 text-same-color">
                                    <?php echo wpautop($contact_us_title); ?>
                                </div>
                            <?php endif; ?>
                            
                            <?php 
                            // Contact Section Description
                            $contact_us_description = get_field('contact_us_description', $post_id); 
                            
                            if (!empty($contact_us_description)) : 
                            ?>
                                <div class="card-text fs-14">
                                    <?php echo wpautop($contact_us_description); ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </section>
            
        <?php 
        endwhile;
    endif;
    
    // Reset WordPress post data
    wp_reset_postdata();
    
} catch (\Exception $ex) {
    // Display error message
    echo 'Error in privacy policy page: ' . esc_html($ex->getMessage());
}
?>

<?php get_footer(); ?>