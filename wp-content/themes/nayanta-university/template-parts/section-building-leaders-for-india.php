   
            <!-- Leaders Section -->
            <section class="section section-leaders pb-0 fade">
                <div class="container">
                    <?php $building_leaders_heading = get_sub_field('building_leaders_for_india_top_title'); ?>
                    <?php if (!empty($building_leaders_heading)) : ?>
                        <div class="section-heading">
                            <?php echo wpautop($building_leaders_heading); ?>
                        </div>
                    <?php endif; ?>
                </div>
                
                <?php 
                // Leaders background image
                $building_leaders_image = get_sub_field('building_leaders_for_india_image');
                if ($building_leaders_image) : 
                ?>
                    <div class="section-bg mt-24">
                        <img src="<?php echo esc_url($building_leaders_image['url']); ?>" 
                             alt="<?php echo esc_attr($building_leaders_image['alt']); ?>" 
                             class="w-100" 
                             loading="lazy">
                    </div>
                <?php endif; ?>

                <!-- Leaders Content Slider -->
                <div class="content-swiper-wrapper">
                    <div class="container">
                        <div class="swiper-card-wrap">
                            <div class="swiper leaders-swiper">
                                <div class="swiper-wrapper">
                                    <?php
                                    $highlights = get_sub_field('building_leaders_for_india_content');
                                    if (!empty($highlights) && is_array($highlights)) :
                                        foreach ($highlights as $highlight) :
                                            $title = $highlight['building_leaders_for_india_title'];
                                            $description = $highlight['building_leaders_for_india_description'];
                                            if ($title && $description) :
                                    ?>
                                            <div class="swiper-slide">
                                                <div class="card-title"><?php echo esc_html($title); ?></div>
                                                <div class="card-text">
                                                    <p><?php echo esc_html($description); ?></p>
                                                </div>
                                            </div>
                                    <?php
                                            endif;
                                        endforeach;
                                    endif;
                                    ?>
                                </div>
                            </div>
                        </div>
                        <!-- Slider Controls -->
                        <div class="btn-wrap">
                            <div class="swiper-controls">
                                <div class="swiper-btn-prev"></div>
                                <div class="swiper-pagination"></div>
                                <div class="swiper-btn-next"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>