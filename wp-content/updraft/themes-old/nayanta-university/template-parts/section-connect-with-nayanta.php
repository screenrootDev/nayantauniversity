
            <!-- Breadcrumb Navigation -->
            <nav aria-label="breadcrumb" class="breadcrumb-nav">
                <div class="container-fluid">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="<?php echo esc_url(get_site_url()); ?>"><?php esc_html_e('home', 'nayanta'); ?></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page"><?php esc_html_e('contact us', 'nayanta'); ?></li>
                    </ol>
                </div>
            </nav>

            <!-- Connect with Nayanta Section -->
            <section class="section section-leaders section-inner-hero pb-0 fade">
                <div class="container">
                    <?php 
                    $connect_with_nayanta_heading = get_sub_field('connect_with_nayanta_heading');
                    if (!empty($connect_with_nayanta_heading)) : 
                    ?>
                        <div class="section-heading">
                            <?php echo wp_kses_post(wpautop($connect_with_nayanta_heading)); ?>
                        </div>
                    <?php endif; ?>
                </div>
                
                <?php 
                $connect_with_nayanta_image = get_sub_field('connect_with_nayanta_image');
                if (!empty($connect_with_nayanta_image) && isset($connect_with_nayanta_image['url'])) : 
                ?>
                    <div class="section-bg mt-24">
                        <img 
                            src="<?php echo esc_url($connect_with_nayanta_image['url']); ?>" 
                            alt="<?php echo esc_attr(isset($connect_with_nayanta_image['alt']) ? $connect_with_nayanta_image['alt'] : ''); ?>" 
                            loading="lazy" 
                            class="w-100"
                        >
                    </div>
                <?php endif; ?>
                
                <!-- Contact Cards Section -->
                <div class="content-swiper-wrapper">
                    <div class="container">
                        <div class="row g-4">
                            <?php 
                            if (have_rows('connect_with_nayanta_cards',)) : 
                                while (have_rows('connect_with_nayanta_cards')) : the_row(); 
                            ?>
                                <div class="col-12 col-lg-6">
                                    <div class="card card-3">
                                        <!-- Card Icon/Image -->
                                        <div class="card-icon mb-24">
                                            <?php 
                                            $card_image = get_sub_field('connect_with_nayanta_cards_image');
                                            if (!empty($card_image) && isset($card_image['url'])) : 
                                            ?>
                                                <img 
                                                    src="<?php echo esc_url($card_image['url']); ?>" 
                                                    alt="<?php echo esc_attr(isset($card_image['alt']) ? $card_image['alt'] : esc_html__('Card Image', 'nayanta')); ?>" 
                                                    loading="lazy"
                                                >
                                            <?php endif; ?>
                                        </div>
                                        
                                        <!-- Card Body -->
                                        <div class="card-body">
                                            <?php 
                                            $card_title = get_sub_field('connect_with_nayanta_cards_title');
                                            if (!empty($card_title)) : 
                                            ?>
                                                <div class="card-title h4 mb-24"><?php echo esc_html($card_title); ?></div>
                                            <?php endif; ?>

                                            <!-- Email List -->
                                            <?php 
                                            if (have_rows('email_repeater')) : 
                                            ?>
                                                <ul class="card-info-wrap">
                                                    <?php 
                                                    while (have_rows('email_repeater')) : the_row(); 
                                                        $email_title = get_sub_field('email_title');
                                                        $email_content = get_sub_field('email_content');
                                                    ?>
                                                        <li>
                                                            <i class="icon-mail"></i>
                                                            <div class="card-inner-wrap">
                                                                <?php if (!empty($email_title)) : ?>
                                                                    <div class="card-info-title"><?php echo esc_html($email_title); ?></div>
                                                                <?php endif; ?>

                                                                <?php if (!empty($email_content)) : ?>
                                                                    <div class="card-info-text">
                                                                        <?php 
                                                                        if (filter_var($email_content, FILTER_VALIDATE_EMAIL)) {
                                                                            // It's an email, make it a mailto link
                                                                            echo '<a href="mailto:' . esc_attr($email_content) . '" target="_blank">' . esc_html($email_content) . '</a>';
                                                                        } else {
                                                                            // Just text
                                                                            echo wp_kses_post(wpautop($email_content));
                                                                        }
                                                                        ?>
                                                                    </div>
                                                                <?php endif; ?>
                                                            </div>
                                                        </li>
                                                    <?php endwhile; ?>
                                                </ul>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            <?php 
                                endwhile; 
                            endif; 
                            ?>
                        </div>
                    </div>
                </div>
            </section>
