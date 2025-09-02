<?php

/**
 * Template Name: Admissions
 */

get_header();

// Step 1: Query landing-page post type
$args = array(
    'post_type'      => 'admissions-page',
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

                if ($layout === 'admissions_page_banner') {
                    get_template_part('template-parts/section', 'admissions-page-banner');
                } else if ($layout === 'admissions_your_guide_to_admissions_section') {
                    get_template_part('template-parts/section', 'admissions-your-guide-to-admissions');
                } else if ($layout === 'admissions_page_faqs') {
                    get_template_part('template-parts/section', 'admissions-page-faqs');
                } else if ($layout === 'meet_the_team_block') {
                    get_template_part('template-parts/meet_the_team_block');
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
