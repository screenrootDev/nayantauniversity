<section class="section fade">
    <div class="container">
        <div class="row gy-4">
            <?php
            $experience_sections = get_sub_field('faculty_and_non_academic');

            // Step 1: Get first query parameter key from URL
            $active_tab_slug = '';
            if (!empty($_SERVER['QUERY_STRING'])) {
                parse_str($_SERVER['QUERY_STRING'], $query_array);
                $active_tab_slug = key($query_array); // e.g., 'faculty' or 'non-academic'
            }
            ?>

            <?php if (!empty($experience_sections) && is_array($experience_sections)) : ?>
                <div class="col-12">
                    <div class="tabs-wrapper tabs-links">
                        <ul>
                            <?php
                            foreach ($experience_sections as $index => $section) :
                                $category = $section['career_category'] ?? '';
                                if (!empty($category)) :
                                    $is_active = $category === $active_tab_slug || ($index === 0 && empty($active_tab_slug));
                            ?>
                                    <li class="<?php echo $is_active ? 'active' : ''; ?>">
                                        <button tab-id="sector-tab-<?php echo $index + 1; ?>" data-text="<?php echo esc_attr($category); ?>">
                                            <?php echo esc_html($category); ?>
                                        </button>
                                    </li>
                            <?php
                                endif;
                            endforeach;
                            ?>
                        </ul>
                    </div>
                </div>

                <div class="col-12">
                    <div class="tabs-content-wrapper">
                        <div class="tabs-list">
                            <?php
                            foreach ($experience_sections as $index => $section) :
                                $category = $section['career_category'] ?? '';
                                $is_active_content = $category === $active_tab_slug || ($index === 0 && empty($active_tab_slug));

                                // Extract values safely
                                $title = $section['title'] ?? '';
                                $faculty_openings = $section['faculty_openings'] ?? [];
                                $faculty_heading = $section['faculty_heading'] ?? '';
                                $faculty_opening_right = $section['faculty_opening_right'] ?? [];
                                $support = $section['support_at_nayanta'] ?? [];
                                $faculty_bottom_text = $section['faculty_bottom_text'] ?? '';
                                $bottom_link = $section['bottom_link'] ?? [];
                                $current_opening = $section['current_opening'] ?? [];
                                $non_academic_email = $section['non_academic_email'] ?? '';
                                $support_at_nayanta_heading = $section['support_at_nayanta_heading'] ?? '';
                                $current_openings_heading = $section['current_openings_heading'] ?? '';
                            ?>
                                <div class="tab-content-item <?php echo $is_active_content ? 'active' : ''; ?>" tab-content-id="sector-tab-<?php echo $index + 1; ?>">
                                    <div class="h4"><?php echo wp_kses_post(wpautop($title)); ?></div>

                                    <div class="row gy-5 pt-25">
                                        <?php if ($category === 'faculty'): ?>

                                            <?php if (!empty($faculty_openings)): ?>
                                                <div class="col-12">
                                                    <div class="section-heading pb-16">
                                                        <h2><?php echo esc_html($faculty_heading); ?></h2>
                                                    </div>
                                                    <div class="faculty-open-box">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <ul>
                                                                    <?php foreach ($faculty_openings as $opening) :
                                                                        $faculty_opening = $opening['faculty_opening'] ?? [];
                                                                    ?>
                                                                        <li>
                                                                            <a href="<?php echo esc_url($faculty_opening['url'] ?? '#'); ?>"
                                                                                target="<?php echo esc_attr($faculty_opening['target'] ?? '_self'); ?>">
                                                                                <?php echo esc_html($faculty_opening['title'] ?? ''); ?>
                                                                            </a>
                                                                        </li>
                                                                    <?php endforeach; ?>
                                                                </ul>
                                                            </div>
                                                            <div class="col-md-6 sitemap-right">
                                                                <ul>
                                                                    <?php foreach ($faculty_opening_right as $opening) :
                                                                        $faculty_opening = $opening['faculty_opening'] ?? [];
                                                                    ?>
                                                                        <li>
                                                                            <a href="<?php echo esc_url($faculty_opening['url'] ?? '#'); ?>"
                                                                                target="<?php echo esc_attr($faculty_opening['target'] ?? '_self'); ?>">
                                                                                <?php echo esc_html($faculty_opening['title'] ?? ''); ?>
                                                                            </a>
                                                                        </li>
                                                                    <?php endforeach; ?>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endif; ?>

                                            <?php if (!empty($support)): ?>
                                                <div class="col-12">
                                                    <div class="section-heading pb-16">
                                                        <h2><?php echo esc_html($support_at_nayanta_heading); ?></h2>
                                                    </div>
                                                    <div class="card-wrapper-2">
                                                        <div class="row g-3">
                                                            <?php foreach ($support as $opening) :
                                                                $image_data = $opening['image_icon'] ?? [];
                                                                $support_text = $opening['support_text'] ?? '';
                                                            ?>
                                                                <div class="col-12 col-md-6 col-lg-4 fade">
                                                                    <div class="card card-3">
                                                                        <div class="card-icon">
                                                                            <img src="<?php echo esc_url($image_data['url'] ?? ''); ?>" alt="<?php echo esc_attr($image_data['alt'] ?? ''); ?>" loading="lazy">
                                                                        </div>
                                                                        <div class="card-body">
                                                                            <div class="card-title"><?php echo wpautop($support_text); ?></div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            <?php endforeach; ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endif; ?>

                                            <?php if (!empty($faculty_bottom_text)): ?>
                                                <div class="col-12 fade">
                                                    <div class="card card-quote">
                                                        <div class="card-body">
                                                            <div class="card-text">
                                                                <?php echo wpautop($faculty_bottom_text); ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php if (!empty($bottom_link) && isset($bottom_link['url'])): ?>
                                                        <a href="<?php echo esc_url($bottom_link['url']); ?>"
                                                            target="<?php echo esc_attr($bottom_link['target'] ?? '_self'); ?>"
                                                            class="btn btn-secondary">
                                                            <?php echo esc_html($bottom_link['title'] ?? 'Learn More'); ?>
                                                        </a>
                                                    <?php endif; ?>
                                                </div>
                                            <?php endif; ?>

                                        <?php elseif ($category === 'non-academic'): ?>
                                            <div class="col-12">
                                                <div class="section-heading pb-16">
                                                    <h2><?php echo esc_html($current_openings_heading); ?></h2>
                                                </div>
                                                <div class="row g-4">
                                                    <?php
                                                    $counter = 0;
                                                    foreach ($current_opening as $opening) :
                                                        $opening_title = $opening['opening_title'] ?? '';
                                                        $opening_description = $opening['opening_description'] ?? '';
                                                        $deadline = $opening['deadline'] ?? '';
                                                        $onsite = $opening['onsite'] ?? '';
                                                        $long_description = $opening['long_description'] ?? '';
                                                        $apply_now = $opening['apply_now'] ?? [];
                                                        $modal_tags = $opening['modal_tags'] ?? [];

                                                        $popupid = $long_description ? '#careerPop' . $counter : 'javascript:void(0);';
                                                        $data_fancybox = $long_description ? 'data-fancybox' : '';
                                                        $is_hidden = $counter >= 4 ? 'd-none' : '';
                                                    ?>
                                                        <div class="col-12 col-md-6 opening-card <?php echo $is_hidden; ?>" data-index="<?php echo $counter; ?>">
                                                            <a href="<?php echo $popupid; ?>" class="card card-classroom fx-link" <?php echo $data_fancybox; ?>>
                                                                <div class="card-body-wrap">
                                                                    <div class="card-body">
                                                                        <div class="card-title"><?php echo esc_html($opening_title); ?></div>
                                                                        <div class="card-text">
                                                                            <p><?php echo esc_html($opening_description); ?></p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card-footer">
                                                                        <ul class="tag-icon-wrap">
                                                                            <?php if ($deadline) : ?>
                                                                                <li><i class="icon-calendar"></i><span>deadline: <?php echo esc_html($deadline); ?></span></li>
                                                                            <?php endif; ?>
                                                                            <?php if ($onsite): ?>
                                                                                <li><i class="icon-map-pin"></i><span><?php echo esc_html($onsite); ?></span></li>
                                                                            <?php endif; ?>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </a>
                                                        </div>

                                                        <div id="careerPop<?php echo $counter; ?>" class="career-pop" style="display:none; max-width:1026px; width: 100%;">
                                                            <div class="fancy-wrapper">
                                                                <div class="team-content scroll-y">
                                                                    <div class="row g-3">
                                                                        <div class="col-12 col-md">
                                                                            <h1 class="h4 mb-16"><?php echo esc_html($opening_title); ?></h1>
                                                                            <?php if (!empty($modal_tags)): ?>
                                                                                <ul class="tag-list-ul">
                                                                                    <?php foreach ($modal_tags as $tag) :
                                                                                        $icon = $tag['modal_text_icon'] ?? '';
                                                                                        $text = $tag['modal_text'] ?? '';
                                                                                    ?>
                                                                                        <li><i class="<?php echo esc_html($icon); ?>"></i><?php echo esc_html($text); ?></li>
                                                                                    <?php endforeach; ?>
                                                                                </ul>
                                                                            <?php endif; ?>
                                                                        </div>
                                                                        <?php if (!empty($apply_now['url'])): ?>
                                                                            <div class="col-12 col-md-auto align-self-end">
                                                                                <a href="<?php echo esc_url($apply_now['url']); ?>" target="<?php echo esc_attr($apply_now['target'] ?? '_self'); ?>" class="btn btn-secondary w-100"><?php echo esc_html($apply_now['title'] ?? 'Apply'); ?></a>
                                                                            </div>
                                                                        <?php endif; ?>
                                                                    </div>

                                                                    <div class="border-bottom border-primary-light my-4"></div>
                                                                    <?php echo wpautop($long_description); ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <?php $counter++;
                                                    endforeach; ?>

                                                    <?php if (count($current_opening) > 4) : ?>
                                                        <div class="col-12">
                                                            <a href="javascript:void(0)" class="btn btn-outline-black" id="show-more-btn">Show more</a>
                                                        </div>
                                                    <?php endif; ?>

                                                    <div class="col-12">
                                                        <?php echo wpautop($non_academic_email); ?>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

        </div>
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const showMoreBtn = document.getElementById('show-more-btn');
        let visible = 4;
        const cards = document.querySelectorAll('.opening-card');

        showMoreBtn?.addEventListener('click', function() {
            let shown = 0;
            for (let i = visible; i < cards.length && shown < 4; i++) {
                cards[i].classList.remove('d-none');
                shown++;
            }
            visible += shown;

            if (visible >= cards.length) {
                showMoreBtn.style.display = 'none';
            }
        });
    });
</script>