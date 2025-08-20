   
   <!-- Breadcrumb Navigation -->
            <nav aria-label="breadcrumb" class="breadcrumb-nav">
                <div class="container-fluid">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="<?php echo esc_url(get_site_url()); ?>"><?php esc_html_e('home', 'nayanta'); ?></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page"><?php esc_html_e('careers', 'nayanta'); ?></li>
                    </ol>
                </div>
            </nav>

            <!-- Banner Section -->
            <section class="section section-inner-hero pb-0">
                <div class="container">
                    <div class="row gy-4">
                        <!-- Banner Heading -->
                        <div class="col-12 fade">
                            <?php 
                            $career_heading = get_sub_field('career_heading');
                            if (!empty($career_heading)) : 
                            ?>
                                <div class="section-heading">
                                    <?php echo wp_kses_post(wpautop($career_heading)); ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        
                        <!-- Banner Image -->
                        <div class="col-12 fade">
                            <?php 
                            $image = get_sub_field('career_banner_image');
                            if (!empty($image) && isset($image['url'])) : 
                                $image_url = $image['url'];
                                $image_alt = isset($image['alt']) ? $image['alt'] : esc_html__('Admissions Banner', 'nayanta');
                                $image_title = isset($image['title']) ? $image['title'] : '';
                            ?>
                                <div class="inner-hero negative-end">
                                    <img 
                                        src="<?php echo esc_url($image_url); ?>" 
                                        alt="<?php echo esc_attr($image_alt); ?>" 
                                        loading="lazy"
                                    >
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </section>

 