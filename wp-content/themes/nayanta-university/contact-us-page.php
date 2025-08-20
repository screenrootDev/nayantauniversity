<?php

/**
 * Template Name: ContactUsPage
 */

get_header();

// Step 1: Query contact-us-page post type
$args = array(
    'post_type'      => 'contact-us-page',
    'orderby'        => 'ID',
    'order'          => 'ASC',
    'posts_per_page' => 1,
    'post_status'    => 'publish',
);

$landing_query = new WP_Query($args);

// Step 2: Loop through found posts
if ($landing_query->have_posts()) :
    while ($landing_query->have_posts()) : $landing_query->the_post();

        $post_id = get_the_ID();

        // Step 3: Check for flexible content rows
        if (have_rows('page_sections', $post_id)) :
            while (have_rows('page_sections', $post_id)) : the_row();

                // Step 4: Output layout and include matching template
                $layout = get_row_layout();

                if ($layout === 'connect_with_nayanta') {
                    get_template_part('template-parts/section', 'connect-with-nayanta');
                } else if ($layout === 'nayanta_application_journey') {
                    get_template_part('template-parts/section', 'nayanta-application-journey');
                } else if ($layout === 'nayanta_universitys_founding_faculty') {
                    get_template_part('template-parts/section', 'nayanta-universitys-founding-faculty');
                } else if ($layout === 'visit_the_campus') {
                    get_template_part('template-parts/section', 'visit-the-campus');
                } else if ($layout === 'gallery') {
                    get_template_part('template-parts/section', 'gallery');
                }
            endwhile;
        else :
            echo '<p>No sections found inside page_sections for post ID: ' . $post_id . '</p>';
        endif;

    endwhile;
    wp_reset_postdata();
else :
    echo '<p>No landing page posts found.</p>';
endif;

get_footer();