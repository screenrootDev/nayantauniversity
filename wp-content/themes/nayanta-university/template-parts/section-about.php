            <!-- About Section -->
            <section class="section section-about pb-0 fade">
                <div class="container">
                    <div class="row gy-4 gy-md-5">
                        <div class="col-12">
                            <?php 
                            // Display university logo if available
                            $logo = get_sub_field('about_image'); 
                            if ($logo) : 
                            ?>
                                <div class="brand-logo-icon mb-8">
                                    <img src="<?php echo esc_url($logo['url']); ?>" 
                                         class="w-100" 
                                         alt="<?php echo esc_attr($logo['alt'] ?: 'Logo'); ?>" 
                                         title="Nayanta University" 
                                         loading="lazy">
                                </div>
                            <?php endif; ?>
                            
                            <!-- Main content text -->
                            <div class="content big-content">
                                <?php 
                                $banner_below_text = get_sub_field('about_title');
                                if (!empty($banner_below_text)) : 
                                ?>
                                    <?php echo wpautop($banner_below_text); ?>
                                <?php endif; ?>
                            </div>
                        </div>
                        
                        <!-- Icon and Text Section -->
                        <div class="col-12 mt-24">
                            <div class="row gx-5">
                                <?php
                                $icon_and_text = get_sub_field('icon_and_text');
                                if (!empty($icon_and_text) && is_array($icon_and_text)) :
                                    foreach ($icon_and_text as $item) :
                                        $icon = $item['icon'];
                                        $name = $item['icon_title'];
                                        if ($icon && $name) :
                                ?>
                                        <div class="col-auto">
                                            <div class="card-img-text">
                                                <div class="card-icon">
                                                    <i class="<?php echo esc_attr($icon); ?>"></i>
                                                </div>
                                                <?php echo wpautop($name); ?>
                                            </div>
                                        </div>
                                <?php
                                        endif;
                                    endforeach;
                                endif;
                                ?>
                            </div>
                        </div>
                        <?php
                        $learn_more_link = get_sub_field('cta');
                        if (!empty($learn_more_link) && isset($learn_more_link['url'])) : 
                            ?>
                            <div class="btn-wrap">
                        <a href="<?php echo esc_url($learn_more_link['url']); ?>" 
                        target="<?php echo esc_attr($learn_more_link['target'] ?? '_self'); ?>" 
                        class="btn btn-secondary">
                        <?php echo esc_html($learn_more_link['title'] ?? 'Learn More'); ?>
                        </a>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </section>