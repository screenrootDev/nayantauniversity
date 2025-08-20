            <!-- Programmer Section -->
            <section class="section section-programmer fade pb-0">
                <div class="container">
                    <div class="row gy-4">
                        <?php 
                        $build_a_legacy_heading = get_sub_field('build_a_legacy_heading');
                        if (!empty($build_a_legacy_heading)) : 
                        ?>
                           <div class="col-12">
                                <div class="section-heading">
                                    <?php echo wpautop($build_a_legacy_heading); ?>
                                </div>
                           </div>
                        <?php endif; ?>
                        
                        <!-- Legacy Cards Slider -->
                        <div class="col-12">
                            <div class="swiper programmer-swiper overflow-visible cursor-none">
                                <div class="swiper-wrapper">
                                    <?php
                                    $build_a_legacy_cards = get_sub_field('build_a_legacy_cards');
                                    if (!empty($build_a_legacy_cards) && is_array($build_a_legacy_cards)) :
                                        foreach ($build_a_legacy_cards as $data) :
                                            $title = $data['title'];
                                            $image = $data['image'];
                                            $description = $data['description'];
                                            if ($title && $description && $image) :
                                    ?>
                                            <div class="swiper-slide">
                                                <div class="card programmer-card">
                                                    <div class="row gx-2 gx-md-4">
                                                        <div class="col-6">
                                                            <div class="card-img">
                                                                <img src="<?php echo esc_url($image['url']); ?>" 
                                                                     alt="<?php echo esc_attr($title); ?>" 
                                                                     loading="lazy">
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="card-body">
                                                                <div class="card-title"><?php echo esc_html($title); ?></div>
                                                                <div class="card-text">
                                                                    <p><?php echo esc_html($description); ?></p>
                                                                </div>
                                                            </div>
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
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Cursor Navigation Elements -->
                <div class="section-cursor">
                    <div class="arrow-prev"></div>
                    <div class="text">drag</div>
                    <div class="arrow-next"></div>
                </div>
            </section>