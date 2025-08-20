<!-- Hero Section -->
<section class="section section-hero py-0">
    <div class="hero-top">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="hero-card">
                        <?php 
                        // Display banner text from ACF field
                        $banner_text = get_sub_field('banner_text'); 
                        if (!empty($banner_text)) : ?>
                            <?php echo wpautop($banner_text); ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="hero-bottom">
        <div class="container">
            <div class="landing-wrapper negative-end">
                <div class="row gx-0 flex-md-row-reverse">
                    <!-- Form Section -->
                    <div class="col-12 col-lg-6">
                        <div class="form-card position-relative h-100" style="background-color: #f3f3f3;">
                            <div class="ratio ratio-4x3">
                                <div class="npf_wgts" data-height="100%" data-w="08c8cfe5d387ae55d96ffc18266ddf5c"></div>
                            </div>
                        </div>
                        <!-- NoPaperForms Widget Script -->
                        <script type="text/javascript"> 
                            var s = document.createElement("script"); 
                            s.type="text/javascript"; 
                            s.async = true; 
                            s.src="https://widgets.in6.nopaperforms.com/emwgts.js"; 
                            document.body.appendChild(s); 
                        </script>
                    </div>
                    <!-- Banner Slider -->
                    <div class="col-12 col-lg-6">
                        <?php 
                        // Fetch the banner images from ACF field
                        $banner_images = get_sub_field('banner_images'); 
                        if (!empty($banner_images) && is_array($banner_images)) : ?>
                            <div class="swiper hero-swiper h-100">
                                <div class="swiper-wrapper">
                                    <?php foreach ($banner_images as $row) : 
                                        $image = $row['banner_image']; 
                                        if (!empty($image)) : ?>
                                            <div class="swiper-slide">
                                                <div class="ratio ratio-4x3">
                                                    <img src="<?php echo esc_url($image['url']); ?>" 
                                                         alt="<?php echo esc_attr($image['alt'] ?? 'Hero Slide'); ?>" 
                                                         loading="lazy">
                                                </div>
                                            </div>
                                    <?php endif; endforeach; ?>
                                </div>
                                <!-- Slider Controls -->
                                <div class="swiper-controls position-absolute bottom-0">
                                    <div class="swiper-btn-prev"></div>
                                    <div class="swiper-pagination"></div>
                                    <div class="swiper-btn-next"></div>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
