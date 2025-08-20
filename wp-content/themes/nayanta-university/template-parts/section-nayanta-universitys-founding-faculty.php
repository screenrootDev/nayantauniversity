            <!-- Faculty Information Section -->
            <section class="section fade">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="card card-2">
                                <div class="row gx-0">
                                    <!-- Faculty Image -->
                                    <?php 
                                    $faculty_image = get_sub_field('nayanta_universitys_founding_faculty_image');
                                    if (!empty($faculty_image) && isset($faculty_image['url'])) : 
                                    ?>
                                        <div class="col-12 col-lg-auto">
                                            <div class="card-img">
                                                <img 
                                                    src="<?php echo esc_url($faculty_image['url']); ?>" 
                                                    alt="<?php echo esc_attr(get_field('nayanta_universitys_founding_faculty_title', $post_id)); ?>" 
                                                    loading="lazy"
                                                >
                                            </div>
                                        </div>
                                    <?php endif; ?>

                                    <!-- Faculty Information -->
                                    <div class="col-12 col-lg">
                                        <div class="card-body">
                                            <?php 
                                            $faculty_title = get_sub_field('nayanta_universitys_founding_faculty_title');
                                            if (!empty($faculty_title)) : 
                                            ?>
                                                <div class="card-title h2 mb-0">
                                                    <?php echo esc_html($faculty_title); ?>
                                                </div>
                                            <?php endif; ?>
                                            
                                            <?php 
                                            $faculty_description = get_sub_field('nayanta_universitys_founding_faculty_description');
                                            if (!empty($faculty_description)) : 
                                                echo wp_kses_post(wpautop($faculty_description));
                                            endif; 
                                            ?>

                                            <!-- Action Buttons -->
                                            <div class="btn-wrap mt-40">
                                                <?php 
                                                $join_us_link = get_sub_field('join_us');
                                                if (!empty($join_us_link) && isset($join_us_link['url'])) : 
                                                ?>
                                                    <a 
                                                        href="<?php echo esc_url($join_us_link['url']); ?>" 
                                                        target="<?php echo esc_attr(isset($join_us_link['target']) ? $join_us_link['target'] : '_self'); ?>" 
                                                        class="btn btn-secondary"
                                                    >
                                                        <?php echo esc_html(isset($join_us_link['title']) ? $join_us_link['title'] : esc_html__('Join Us', 'nayanta')); ?>
                                                    </a>
                                                <?php endif; ?>

                                                <?php 
                                                $learn_more_link = get_sub_field('learn_more');
                                                if (!empty($learn_more_link) && isset($learn_more_link['url'])) : 
                                                ?>
                                                    <a 
                                                        href="<?php echo esc_url($learn_more_link['url']); ?>" 
                                                        target="<?php echo esc_attr(isset($learn_more_link['target']) ? $learn_more_link['target'] : '_self'); ?>" 
                                                        class="btn btn-outline-white"
                                                    >
                                                        <?php echo esc_html(isset($learn_more_link['title']) ? $learn_more_link['title'] : esc_html__('Learn More', 'nayanta')); ?>
                                                    </a>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div> 
                            </div> 
                        </div>
                    </div>
                </div>
            </section>