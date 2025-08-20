<!-- Hero Section -->
<section class="section section-hero py-0"> 
    <!-- Hero Top Content -->
    <div class="hero-top">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="hero-card">
                    <?php $banner_text = get_sub_field('top_heading')?>
                        <?php if (!empty($banner_text)) : ?>
                            <?php echo wp_kses_post(wpautop($banner_text)); ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Hero Slider -->
    <div class="hero-bottom fade">
        <div class="container">
            <div class="swiper hero-swiper negative-end">
                <div class="swiper-wrapper">
                <?php
                $banner_images = get_sub_field('banner_images');

                if (!empty($banner_images) && is_array($banner_images)) :
                    foreach ($banner_images as $row) :
                        $image = isset($row['banner_image']) ? $row['banner_image'] : null;
                        $banner_link = isset($row['banner_link']) ? trim($row['banner_link']) : null;

                        if (!empty($image) && isset($image['url'])) :
                            $image_url   = $image['url'];
                            $image_alt   = isset($image['alt']) ? $image['alt'] : 'Hero Slide';
                            $image_title = isset($image['title']) ? $image['title'] : '';
                ?>
                            <div class="swiper-slide">
                                <div class="hero-img">
                                    <?php if (!empty($banner_link)) :
                                        $site_url = get_site_url();
                                        $is_external = (strpos($banner_link, $site_url) !== 0 && strpos($banner_link, '/') !== 0);
                                        ?>
                                        <a href="<?php echo esc_url($banner_link); ?>" 
                                        <?php echo $is_external ? 'target="_blank" rel="noopener noreferrer"' : ''; ?>>
                                            <img 
                                                src="<?php echo esc_url($image_url); ?>" 
                                                alt="<?php echo esc_attr($image_alt); ?>" 
                                                loading="lazy"
                                            >
                                        </a>
                                    <?php else : ?>
                                        <img 
                                            src="<?php echo esc_url($image_url); ?>" 
                                            alt="<?php echo esc_attr($image_alt); ?>" 
                                            loading="lazy"
                                        >
                                    <?php endif; ?>
                                </div>
                            </div>
                <?php
                        endif;
                    endforeach;
                endif;
                ?>


                </div>

                <!-- Slider Navigation Controls -->
                <div class="swiper-controls position-absolute bottom-0">
                    <div class="swiper-btn-prev"></div>
                    <div class="swiper-pagination"></div>
                    <div class="swiper-btn-next"></div>
                </div>
            </div>
        </div>
    </div>
</section>