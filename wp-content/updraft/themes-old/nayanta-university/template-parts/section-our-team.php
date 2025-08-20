        <!-- Teams Section -->
            <section class="section section-teams pb-0 fade">
                <div class="container">
                    <div class="row gy-4">
                    <?php
                       $our_team_top_heading = get_sub_field('our_team_top_heading');?>
                        <?php if (!empty($our_team_top_heading)) : ?>
                            <div class="col-12">
                                <div class="section-heading">
                                    <?php echo wpautop($our_team_top_heading); ?>
                                </div>
                            </div>
                        <?php endif; ?>
                        
                        <!-- Team Members Slider -->
                        <div class="col-12">
                            <div class="swiper-tabs-wrapper tabs-content-wrapper">
                                <div class="tabs-list">
                                    <div class="tab-content-item active" tab-content-id="slider-tab-1">
                                        <div class="swiper team-swiper overflow-visible">
                                            <div class="swiper-wrapper">
                                                <?php
                                                $our_team_cards = get_sub_field('our_team_content');
                                                if (!empty($our_team_cards) && is_array($our_team_cards)) :
                                                    foreach ($our_team_cards as $member) :
                                                        $image = $member['team_image'];
                                                        $name = $member['team_name'];
                                                        $designation = $member['team_designation'];
                                                        if ($image && $name && $designation) :
                                                ?>
                                                        <div class="swiper-slide">
                                                            <div class="card team-card">
                                                                <div class="card-img">
                                                                    <img src="<?php echo esc_url($image['url']); ?>" 
                                                                         alt="<?php echo esc_attr($name); ?>" 
                                                                         loading="lazy">
                                                                </div>
                                                                <div class="card-img-overlay">
                                                                    <div class="card-title"><?php echo esc_html($name); ?></div>
                                                                    <?php echo wp_kses_post($designation); ?> 
                                                                </div>
                                                            </div>
                                                        </div>
                                                <?php
                                                        endif;
                                                    endforeach;
                                                endif;
                                                ?>
                                            </div>
                                            <!-- Slider Controls -->
                                            <div class="btn-wrap">
                                            <div class="swiper-controls">
                                                <div class="swiper-btn-prev"></div>
                                                <div class="swiper-pagination"></div>
                                                <div class="swiper-btn-next"></div>
                                            </div>
            
                                            <?php
                                        $learn_more_link = get_sub_field('learn_more_link');
                                        if (!empty($learn_more_link) && isset($learn_more_link['url'])) : 
                                            ?>
                                        <a href="<?php echo esc_url($learn_more_link['url']); ?>" 
                                        target="<?php echo esc_attr($learn_more_link['target'] ?? '_self'); ?>" 
                                        class="btn btn-secondary">
                                        <?php echo esc_html($learn_more_link['title'] ?? 'Learn More'); ?>
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