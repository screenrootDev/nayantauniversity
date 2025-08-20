<!-- Explore Beyond Section -->
<section class="section section-leaders fade">
    <div class="container">
        <div class="row gy-4">
            <!-- Explore Section Heading -->
            <?php 
            $explore_classroom_heading = get_sub_field('explore_classroom_heading'); 
            if (!empty($explore_classroom_heading)) : 
            ?>
                <div class="col-12">
                    <div class="section-heading">
                        <?php echo wp_kses_post(wpautop($explore_classroom_heading)); ?>
                    </div>
                </div>
            <?php endif; ?>

            <!-- Explore Cards Slider -->
            <div class="col-12">
                <div class="swiper classroom-swiper overflow-visible">
                    <div class="swiper-wrapper">
                        <?php
                        // Get classroom cards from ACF
                        $explore_classroom_cards = get_sub_field('explore_classroom_content');
                        if (!empty($explore_classroom_cards) && is_array($explore_classroom_cards)) :
                            foreach ($explore_classroom_cards as $data) :
                                $title = isset($data['card_title']) ? $data['card_title'] : '';
                                $image = isset($data['card_image']) ? $data['card_image'] : null;
                                $description = isset($data['card_subtitle']) ? $data['card_subtitle'] : '';
                                $read_more = isset($data['read_more']) ? $data['read_more'] : '';

                                if (!empty($title) && !empty($image) && !empty($description) && isset($image['url'])) :
                        ?>
                                    <div class="swiper-slide">
                                        <div class="card card-classroom">
                                            <div class="card-img">
                                                <img 
                                                    src="<?php echo esc_url($image['url']); ?>" 
                                                    alt="<?php echo esc_attr($title); ?>"  
                                                    loading="lazy"
                                                >
                                            </div>
                                            <div class="card-body-wrap">
                                                <div class="card-body">
                                                    <div class="card-title"><?php echo esc_html($title); ?></div>
                                                    <div class="card-text">
                                                        <p><?php echo esc_html($description); ?></p>
                                                    </div>
                                                </div>
                                                <div class="card-footer">
                                                    <ul class="tag-icon-wrap"></ul>
                                                    <?php if (!empty($read_more)) : ?>
                                                        <div class="link-wrap">
                                                            <a href="<?php echo esc_url($read_more['url']); ?>" target="<?php echo esc_attr($read_more['target'] ?? '_self'); ?>" rel="noopener noreferrer" class="arrow-link right">
                                                            <?php echo esc_html($read_more['title'] ?? 'Learn More'); ?>
                                                            </a>
                                                        </div>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                        <?php
                                endif;
                            endforeach;
                        endif;
                        ?>
                    </div>

                    <!-- Explore Slider Controls -->
                    <div class="btn-wrap">
                        <div class="swiper-controls">
                            <div class="swiper-btn-prev"></div>
                            <div class="swiper-pagination"></div>
                            <div class="swiper-btn-next"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>