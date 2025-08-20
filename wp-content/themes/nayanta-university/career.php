<?php
/**
 * Template Name: Career
 */

get_header();

// Step 1: Query landing-page post type
$args = array(
    'post_type'      => 'career',
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

                if ($layout === 'career_banner') {
                    get_template_part('template-parts/section', 'career-page-banner');
                } else if($layout === 'faculty_and_non_academic_section'){
                    get_template_part('template-parts/section', 'faculty-and-non-academic');
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
