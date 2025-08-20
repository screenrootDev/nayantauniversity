<?php
/**
 * Template Name: UndergraduateProgrammePage
 */

get_header();

// Step 1: Query landing-page post type
$args = array(
    'post_type'      => 'undergraduate-progra',
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

                if ($layout === 'undergraduate_programme_banner') {
                    get_template_part('template-parts/section', 'undergraduate-programme-banner');
                }  else if($layout === 'undergraduate_programme_overview_section'){
                    get_template_part('template-parts/section', 'undergraduate-programme-overview');
                }  else if($layout === 'undergraduate_programme_snapshot_section'){
                    get_template_part('template-parts/section', 'undergraduate-programme-snapshot');
                }  else if($layout === 'undergraduate_programme_page_programme_courses'){
                    get_template_part('template-parts/section', 'undergraduate-programme-page-programme-courses');
                }  else if($layout === 'undergraduate_programme_experience_industry_section'){
                    get_template_part('template-parts/section', 'undergraduate-programme-experience-industry');
                }  else if($layout === 'undergraduate_programme_customise_your_path'){
                    get_template_part('template-parts/section', 'undergraduate-programme-customise-your-path');
                }  else if($layout === 'programme_and_credit_structure'){
                    get_template_part('template-parts/section', 'programme-and-credit-structure');
                }  else if($layout === 'undergraduate_programme_our_partners'){
                    get_template_part('template-parts/section', 'undergraduate-programme-our-partners');
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
