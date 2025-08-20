<?php
/**
 * Template Name: AboutUs
 */

get_header();

// Step 1: Query landing-page post type
$args = array(
    'post_type'      => 'about-us-page',
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

                if ($layout === 'about_us_page_banner_section') {
                    get_template_part('template-parts/section', 'about-us-banner');
                }  else if($layout === 'about_us_experience_nayanta_section'){
                    get_template_part('template-parts/section', 'about-us-experience-nayanta');
                }  else if($layout === 'about_us_our_founding_team'){
                    get_template_part('template-parts/section', 'about-us-our-founding-team');
                }  else if($layout === 'about_us_page_leadership_section'){
                    get_template_part('template-parts/section', 'about-us-page-leadership');
                }  else if($layout === 'about_us_hear_from_our_leaders_section'){
                    get_template_part('template-parts/section', 'about-us-hear-from-our-leaders');
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
