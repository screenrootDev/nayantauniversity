<!-- Undergraduate Programme Section -->
<section class="section section-leaders fade">
    <div class="container">
        <div class="row gy-4">
            <?php 
            // Get section heading
            $top_heading = get_sub_field('eligibility_criteria_heading'); 
            if (!empty($top_heading)) : 
            ?>
                <div class="col-12">
                    <div class="section-heading">
                        <?php echo wpautop($top_heading); ?>
                    </div>
                </div>
            <?php endif; ?>

            <?php
            // Get programme categories
            $field = get_sub_field_object('eligibility_criteria_category');
            
            if ($field && !empty($field['choices'])) : 
            ?>
                <!-- Programme Category Tabs -->
                <div class="col-12">
                    <div class="tabs-wrapper tabs-links">
                        <ul>
                            <?php 
                            $index = 1;
                            foreach ($field['choices'] as $value => $label) : 
                            ?>
                                <li class="<?php echo $index === 1 ? 'active' : ''; ?>">
                                    <button tab-id="programme-tab-<?php echo $index; ?>" data-text="<?php echo esc_attr($label); ?>">
                                        <?php echo esc_html($label); ?>
                                    </button>
                                </li>
                            <?php 
                                $index++; 
                            endforeach; 
                            ?>
                        </ul>
                    </div>
                </div>

                <!-- Programme Tab Content -->
                <div class="col-12">
                    <div class="tabs-content-wrapper">
                        <div class="tabs-list">
                            <?php 
                            $index = 1;
                            foreach ($field['choices'] as $value => $label) : 
                            ?>
                                <div class="tab-content-item <?php echo $index === 1 ? 'active' : ''; ?>" tab-content-id="programme-tab-<?php echo $index; ?>">
                                    <?php 
                                    // Loop through repeater field
                                    if (have_rows('undergraduate_programme_content')) : 
                                        while (have_rows('undergraduate_programme_content')) : the_row();
                                            $content_title = get_sub_field('title');
                                            $content_description = get_sub_field('description');
                                            $content_image = get_sub_field('image');
                                            $content_category = get_sub_field('eligibility_criteria_category');

                                            // Normalize values (in case of int/string mismatch)
                                            if ((string) $content_category === (string) $value) : 
                                    ?>
                                                <div class="card card-2">
                                                    <div class="row gx-0">
                                                        <?php if (!empty($content_image)) : ?>
                                                            <div class="col-12 col-lg-auto">
                                                                <div class="card-img">
                                                                    <img src="<?php echo esc_url($content_image['url']); ?>" 
                                                                         alt="<?php echo esc_attr($content_title); ?>" 
                                                                         loading="lazy">
                                                                </div>
                                                            </div>
                                                        <?php endif; ?>
                                                        <div class="col-12 col-lg">
                                                            <div class="card-body">
                                                                <div class="card-title"><?php echo esc_html($content_title); ?></div>
                                                                <div class="card-text">
                                                                    <?php echo wpautop($content_description); ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                    <?php 
                                            endif;
                                        endwhile;
                                    else :
                                        echo '<p>No programme content found.</p>';
                                    endif;
                                    ?>
                                </div>
                            <?php 
                                $index++; 
                            endforeach; 
                            ?>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>
