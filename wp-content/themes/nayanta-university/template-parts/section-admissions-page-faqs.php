            <!-- FAQs Section -->
            <section class="section fade">
                <div class="container">
                    <div class="row gy-4">
                        <!-- FAQs Heading -->
                        <?php 
                        $admissions_page_faqs_heading = get_sub_field('admissions_page_faqs_heading');
                        if (!empty($admissions_page_faqs_heading)) : 
                        ?>
                            <div class="col-12">
                                <div class="section-heading">
                                    <?php echo wp_kses_post(wpautop($admissions_page_faqs_heading)); ?>
                                </div>
                            </div>
                        <?php endif; ?>
                        
                        <!-- FAQs Tabs Navigation -->
                        <div class="col-12">
                            <div class="tabs-wrapper tabs-links">
                                <ul class="tabs-buttons">
                                    <?php
                                    $tab_index = 0;
                                    if (have_rows('faqs_categories')) :
                                        while (have_rows('faqs_categories')) : the_row();
                                            $category = get_sub_field('admissions_page_faqs_category');
                                            if (!empty($category)) :
                                                $tab_id = 'tab-' . $tab_index;
                                    ?>
                                                <li class="<?php echo ($tab_index == 0) ? 'active' : ''; ?>">
                                                    <button tab-id="<?php echo esc_attr($tab_id); ?>" data-text="<?php echo esc_attr($category); ?>">
                                                        <?php echo esc_html($category); ?>
                                                    </button>
                                                </li>
                                    <?php
                                                $tab_index++;
                                            endif;
                                        endwhile;
                                    endif;
                                    ?>
                                </ul>
                            </div>
                        </div>
                        
                        <!-- FAQs Tabs Content -->
                        <div class="col-12">
                            <div class="tabs-content-wrapper tabs-faqs-wrapper bg-light-1">
                                <?php
                                $tab_index = 0;
                                if (have_rows('faqs_categories')) :
                                    while (have_rows('faqs_categories')) : the_row();
                                        $category = get_sub_field('admissions_page_faqs_category');
                                        if (!empty($category)) :
                                            $tab_id = 'tab-' . $tab_index;
                                ?>
                                            <div class="tab-content-item <?php echo ($tab_index == 0) ? 'active' : ''; ?>" tab-content-id="<?php echo esc_attr($tab_id); ?>">
                                                <div class="faqs-wrapper">
                                                    <ul>
                                                        <?php
                                                        $faq_count = 0;
                                                        if (have_rows('faqs')) :
                                                            while (have_rows('faqs')) : the_row();
                                                                $faq_title = get_sub_field('faq_title');
                                                                $faq_description = get_sub_field('faq_description');
                                                                
                                                                if (!empty($faq_title) && !empty($faq_description)) :
                                                                    $extra_class = ($faq_count >= 5) ? 'extra-faq hidden' : '';
                                                        ?>
                                                                    <li class="<?php echo esc_attr($extra_class); ?>">
                                                                        <button type="button"><?php echo esc_html($faq_title); ?></button>
                                                                        <div class="faq-content">
                                                                            <?php echo wp_kses_post(wpautop($faq_description)); ?>
                                                                        </div>
                                                                    </li>
                                                        <?php
                                                                    $faq_count++;
                                                                endif;
                                                            endwhile;
                                                        endif;
                                                        ?>
                                                    </ul>
                                                </div>
                                                <?php if ($faq_count > 5) : ?>
                                                    <button type="button" class="btn btn-secondary btn-showMore mt-24" data-tab="<?php echo esc_attr($tab_id); ?>">
                                                        <?php esc_html_e('show more', 'nayanta'); ?>
                                                    </button>
                                                <?php endif; ?>
                                            </div>
                                <?php
                                            $tab_index++;
                                        endif;
                                    endwhile;
                                endif;
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </section>