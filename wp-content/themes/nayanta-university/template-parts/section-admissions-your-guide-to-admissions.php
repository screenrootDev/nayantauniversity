<!-- Admissions Guide Section -->
<section class="section section-admissions fade pb-0">
    <div class="container">
        <div class="row gy-4">

            <!-- Section Heading -->
            <div class="col-12 fade">
                <?php
                $section_heading = get_sub_field('your_guide_to_admissions_section_heading');
                if (!empty($section_heading)) : ?>
                    <div class="section-heading">
                        <?php echo wp_kses_post(wpautop($section_heading)); ?>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Tabs Navigation -->
            <div class="col-12">
                <div class="tabs-wrapper tabs-links">
                    <ul>
                        <li class="active">
                            <button tab-id="tab-undergraduate" data-text="undergraduate">
                                <?php esc_html_e('undergraduate', 'nayanta'); ?>
                            </button>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Tabs Content -->
            <div class="col-12">
                <div class="tabs-content-wrapper">
                    <div class="tabs-list">
                        <div class="tab-content-item active" tab-content-id="tab-undergraduate">

                            <?php
                            // Prepare content from flexible field into an array (once)
                            $tab_contents = [];
                            if (have_rows('your_guide_to_admissions_section_content')) {
                                while (have_rows('your_guide_to_admissions_section_content')) {
                                    the_row();
                                    $category = get_sub_field('your_guide_to_admissions_section_category');
                                    $content = get_sub_field('data');

                                    if (!empty($category) && !empty($content)) {
                                        $tab_contents[] = [
                                            'category' => $category,
                                            'content' => $content,
                                            'tab_id' => 'tab-' . sanitize_title_with_dashes($category),
                                        ];
                                    }
                                }
                            }
                            ?>

                            <!-- Desktop Version -->
                            <div class="row gx-0 d-none d-md-flex">
                                <div class="col-12 col-md-auto">
                                    <div class="tabs-wrapper tabs-left tabs-links">
                                        <ul>
                                            <?php foreach ($tab_contents as $index => $item): ?>
                                                <li class="<?php echo ($index === 0) ? 'active' : ''; ?>">
                                                    <button tab-id="<?php echo esc_attr($item['tab_id']); ?>" data-text="<?php echo esc_attr($item['category']); ?>">
                                                        <?php echo esc_html($item['category']); ?>
                                                    </button>
                                                </li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </div>
                                </div>

                                <div class="col-12 col-md">
                                    <div class="tabs-left-content-wrapper h-100">
                                        <?php foreach ($tab_contents as $index => $item): ?>
                                            <div class="tab-content-item scroll-y <?php echo ($index === 0) ? 'active' : ''; ?>" tab-content-id="<?php echo esc_attr($item['tab_id']); ?>">
                                                <?php echo wp_kses_post($item['content']); ?>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>
                            <!-- End Desktop Version -->

                            <!-- Mobile Version -->
                            <div class="accordion-wrapper d-md-none">
                                <ul>
                                    <?php foreach ($tab_contents as $index => $item): ?>
                                        <li class="<?php echo ($index === 0) ? 'active' : ''; ?>">
                                            <button type="button"><?php echo esc_html($item['category']); ?></button>
                                            <div class="accordion-content" style="<?php echo ($index === 0) ? 'display: block;' : 'display: none;'; ?>">
                                                <?php echo wp_kses_post($item['content']); ?>
                                            </div>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                            <!-- End Mobile Version -->

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>


<!-- FAQ Visibility Toggle Script -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Get all tabs with show more buttons
        document.querySelectorAll('.tab-content-item').forEach(function(tab) {
            const btn = tab.querySelector('.btn-showMore');
            const extraFaqs = tab.querySelectorAll('.extra-faq');

            // Skip if button doesn't exist
            if (!btn) return;

            // Hide extra FAQs on load
            extraFaqs.forEach(faq => faq.style.display = 'none');

            // Toggle visibility on button click
            btn.addEventListener('click', function() {
                const expanded = btn.classList.toggle('expanded');

                if (expanded) {
                    extraFaqs.forEach(faq => faq.style.display = 'list-item');
                    btn.textContent = '<?php esc_html_e('show less', 'nayanta'); ?>';
                } else {
                    extraFaqs.forEach(faq => faq.style.display = 'none');
                    btn.textContent = '<?php esc_html_e('show more', 'nayanta'); ?>';
                }
            });
        });
    });
</script>