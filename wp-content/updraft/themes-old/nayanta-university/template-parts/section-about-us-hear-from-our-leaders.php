            <!-- Visionaries Section -->
            <section class="section fade">
                <div class="container">
                    <div class="row gy-4">
                        <?php 
                        // Leaders section heading
                        $our_leaders_heading = get_sub_field('our_leaders_section_heading'); 
                        if (!empty($our_leaders_heading)) : 
                        ?>
                            <div class="col-12">
                                <div class="section-heading">
                                    <?php echo wpautop($our_leaders_heading); ?>
                                </div>
                            </div>
                        <?php endif; ?>
                        
                        <!-- Leaders Slider -->
                        <div class="col-12">
                            <div class="swiper visionaries-swiper overflow-visible">
                                <div class="swiper-wrapper">
                                    <?php
                                    $our_leaders_cards = get_sub_field('our_leaders_section_cards');
                                    if (!empty($our_leaders_cards) && is_array($our_leaders_cards)) :
                                        foreach ($our_leaders_cards as $leader) :
                                            $title = $leader['title'] ?? '';
                                            $image = $leader['card_image'] ?? '';
                                            $yt_link = $leader['yt_link'] ?? '';
                                            
                                            // Only display if we have the required fields
                                            if (!empty($title) && !empty($image)) :
                                    ?>
                                                <div class="swiper-slide">
                                                    <div class="card card-5">
                                                        <div class="card-img">
                                                            <img src="<?php echo esc_url($image['url']); ?>" 
                                                                 alt="<?php echo esc_attr($title); ?>"  
                                                                 loading="lazy">
                                                        </div>
                                                        <div class="card-body">
                                                            <div class="row gx-0">
                                                                <div class="col align-self-center">
                                                                    <div class="card-title"><?php echo esc_html($title); ?></div>
                                                                </div>
                                                                <?php if (!empty($yt_link)) : ?>
                                                                    <div class="col-auto">
                                                                        <a href="<?php echo esc_url($yt_link); ?>" target="_blank" class="play-btn">
                                                                            <i class="icon-play"></i>
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
                                
                                <!-- Slider Controls -->
                                <div class="swiper-controls">
                                    <div class="swiper-btn-prev"></div>
                                    <div class="swiper-pagination"></div>
                                    <div class="swiper-btn-next"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>