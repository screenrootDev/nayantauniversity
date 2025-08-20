<section class="section section-leaders  fade">
                <div class="container">
                    <div class="row gy-4">
                        <?php 
                        $experience_industry_top_heading = get_sub_field('experience_industry_top_heading');
                        if (!empty($experience_industry_top_heading)) : ?>
                            <div class="col-12">
                                <div class="section-heading">
                                    <?php echo wpautop($experience_industry_top_heading); ?>
                                </div>
                            </div>
                        <?php endif; ?>

                        <?php 
                        $experience_sections = get_sub_field('experience_industry_section_content');
                        if (!empty($experience_sections) && is_array($experience_sections)) : 
                            // First build the Tabs
                        ?>
                            <div class="col-12">
                                <div class="tabs-wrapper tabs-links">
                                    <ul>
                                        <?php 
                                        $tab_count = 1;
                                        foreach ($experience_sections as $section) :
                                            $category = $section['experience_industry_category'] ?? '';
                                            if (!empty($category)) :
                                        ?>
                                            <li class="<?php echo $tab_count === 1 ? 'active' : ''; ?>">
                                                <button tab-id="sector-tab-<?php echo $tab_count; ?>" data-text="<?php echo esc_attr($category); ?>">
                                                    <?php echo esc_html($category); ?>
                                                </button>
                                            </li>
                                        <?php 
                                            $tab_count++;
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
                            $tab_content_count = 1;
                            foreach ($experience_sections as $section) :
                                $title = $section['experience_industry_title'] ?? '';
                                $description = $section['experience_industry_description'] ?? '';
                                $image = $section['experience_industry_image'] ?? '';
                                $category = $section['experience_industry_category'] ?? '';
                            ?>
                                <div class="tab-content-item <?php echo $tab_content_count === 1 ? 'active' : ''; ?>" tab-content-id="sector-tab-<?php echo $tab_content_count; ?>">
                                    <div class="card card-2">
                                        <div class="row gx-0">
                                            <?php if (!empty($image)) : ?>
                                            <div class="col-12 col-lg-auto">
                                                <div class="card-img">
                                                    <img 
                                                        src="<?php echo esc_url($image['url']); ?>" 
                                                        alt="<?php echo esc_attr($title); ?>" 
                                                        loading="lazy"
                                                    >
                                                </div>
                                            </div>
                                            <?php endif; ?>
                                            <div class="col-12 col-lg">
                                                <div class="card-body">
                                                    <?php if (!empty($title)) : ?>
                                                        <div class="card-title h2"><?php echo esc_html($title); ?></div>
                                                    <?php endif; ?>
                                                    <?php if (!empty($description)) : ?>
                                                        <div class="card-text">
                                                            <?php echo wpautop($description); ?>
                                                        </div>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php 
                            $tab_content_count++;
                            endforeach; 
                            ?>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
  </section>