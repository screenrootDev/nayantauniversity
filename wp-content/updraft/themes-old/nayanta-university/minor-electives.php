<?php
/**
 * Template Name: MinorElectives
 */

get_header();

// Step 1: Get one post of type 'minor-electives'
$args = [
    'post_type'      => 'minor-electives',
    'orderby'        => 'ID',
    'order'          => 'ASC',
    'posts_per_page' => 1,
    'post_status'    => 'publish',
];

$landing_query = new WP_Query($args);

if ($landing_query->have_posts()) :
    while ($landing_query->have_posts()) : $landing_query->the_post();
        $post_id = get_the_ID();
        ?>

        <nav aria-label="breadcrumb" class="breadcrumb-nav">
            <div class="container-fluid">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">minor electives</li>
                </ol>
            </div>
        </nav>

        <section class="section section-admissions section-inner-hero">
            <div class="container">
                <div class="row gy-4">
                    <div class="col-12">
                        <?php if ($heading = get_field('minor_electives_heading')) : ?>
                            <div class="section-heading"><?php echo wpautop($heading); ?></div>
                        <?php endif; ?>
                    </div>

                    <div class="col-12">
                        <div class="tabs-content-wrapper">
                            <div class="tabs-list">
                                <div class="tab-content-item active" tab-content-id="tab-undergraduate">

                                    <?php
                                    // Get requested tab from URL
                                    $requested_tab_slug = '';
                                    if (!empty($_SERVER['QUERY_STRING'])) {
                                        $requested_tab_slug = sanitize_title_with_dashes($_SERVER['QUERY_STRING']);
                                    }

                                    // Collect all tabs
                                    $tab_contents = [];
                                    $default_index = 0;
                                    $active_index = 0;

                                    if (have_rows('minor_electives_content')) {
                                        $i = 0;
                                        while (have_rows('minor_electives_content')) {
                                            the_row();
                                            $category = get_sub_field('minor_electives_category');
                                            $content = get_sub_field('minor_electives_content');

                                            if ($category && $content) {
                                                $slug = sanitize_title_with_dashes($category);
                                                if ($slug === $requested_tab_slug) {
                                                    $active_index = $i;
                                                }

                                                $tab_contents[] = [
                                                    'category' => $category,
                                                    'content'  => $content,
                                                    'tab_id'   => 'tab-' . $slug,
                                                    'slug'     => $slug,
                                                ];
                                                $i++;
                                            }
                                        }
                                    }

                                    if (empty($tab_contents)) {
                                        echo '<p>No electives found.</p>';
                                    } else {
                                        ?>

                                        <!-- Desktop Tabs -->
                                        <div class="row gx-0 d-none d-md-flex">
                                            <div class="col-12 col-md-auto">
                                                <div class="tabs-wrapper tabs-left tabs-links">
                                                    <ul>
                                                        <?php foreach ($tab_contents as $i => $item): ?>
                                                            <li class="<?php echo ($i === $active_index) ? 'active' : ''; ?>">
                                                                <button tab-id="<?php echo esc_attr($item['tab_id']); ?>">
                                                                    <?php echo wp_kses_post($item['category']); ?>
                                                                </button>
                                                            </li>
                                                        <?php endforeach; ?>
                                                    </ul>
                                                </div>
                                            </div>

                                            <div class="col-12 col-md">
                                                <div class="tabs-left-content-wrapper h-100">
                                                    <?php foreach ($tab_contents as $i => $item): ?>
                                                        <div class="tab-content-item scroll-y <?php echo ($i === $active_index) ? 'active' : ''; ?>" tab-content-id="<?php echo esc_attr($item['tab_id']); ?>">
                                                            <?php echo wp_kses_post($item['content']); ?>
                                                        </div>
                                                    <?php endforeach; ?>
                                                </div>

                                                <?php
                                                $link = get_field('link');
                                                if (!empty($link['url'])) :
                                                    ?>
                                                    <div>
                                                        <a href="<?php echo esc_url($link['url']); ?>" target="<?php echo esc_attr($link['target'] ?? '_self'); ?>" class="btn btn-secondary">
                                                            <?php echo esc_html($link['title'] ?? 'Learn More'); ?>
                                                        </a>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>

                                        <!-- Mobile Accordion -->
                                        <div class="accordion-wrapper d-md-none">
                                            <ul>
                                                <?php foreach ($tab_contents as $i => $item): ?>
                                                    <li class="<?php echo ($i === $active_index) ? 'active' : ''; ?>">
                                                        <button type="button"><?php echo esc_html($item['category']); ?></button>
                                                        <div class="accordion-content" style="<?php echo ($i === $active_index) ? 'display:block;' : 'display:none;'; ?>">
                                                            <?php echo wp_kses_post($item['content']); ?>
                                                        </div>
                                                    </li>
                                                <?php endforeach; ?>
                                            </ul>
                                            <?php
                                                $link = get_field('link');
                                                if (!empty($link['url'])) :
                                                    ?>
                                                    <div>
                                                        <a href="<?php echo esc_url($link['url']); ?>" target="<?php echo esc_attr($link['target'] ?? '_self'); ?>" class="btn btn-secondary">
                                                            <?php echo esc_html($link['title'] ?? 'Learn More'); ?>
                                                        </a>
                                                    </div>
                                                <?php endif; ?>
                                        </div>

                                        <?php
                                    }
                                    ?>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <?php
    endwhile;
    wp_reset_postdata();
endif;

get_footer();
