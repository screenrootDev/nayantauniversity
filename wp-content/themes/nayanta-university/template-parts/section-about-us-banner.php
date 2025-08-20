          <!-- Breadcrumb Navigation -->
            <nav aria-label="breadcrumb" class="breadcrumb-nav">
                <div class="container-fluid">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="<?php echo esc_url(get_site_url()); ?>">home</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">about us</li>
                    </ol>
                </div>
            </nav>
          <!-- Hero Section -->
            <section class="section section-inner-hero fade pb-0">
                <div class="container">
                    <div class="row gy-4">
                        <?php 
                        // Top heading
                        $about_us_top_heading = get_sub_field( 'about_us_top_heading'); 
                        if (!empty($about_us_top_heading)) : 
                        ?>
                            <div class="col-12">
                                <div class="section-heading">
                                    <?php echo wpautop($about_us_top_heading); ?>
                                </div>
                            </div>
                        <?php endif; ?>
                        
                        <?php 
                        // Banner image
                        $about_us_banner_image = get_sub_field('about_us_banner_image'); 
                        if (!empty($about_us_banner_image)) : 
                            $image_url = $about_us_banner_image['url'];
                            $image_alt = $about_us_banner_image['alt'] ?: 'About Us Banner';
                            $image_title = $about_us_banner_image['title'] ?? '';
                        ?>
                            <div class="col-12">
                                <div class="inner-hero negative-end">
                                    <img 
                                        src="<?php echo esc_url($image_url); ?>" 
                                        alt="<?php echo esc_attr($image_alt); ?>" 
                                        loading="lazy"
                                    >
                                </div>
                            </div>
                        <?php endif; ?>

                        <!-- Banner Below Content Cards -->
                        <div class="col-12">
                            <div class="row g-4">
                                <?php
                                $about_us_banner_below_content = get_sub_field('about_us_banner_below_content');
                                if (!empty($about_us_banner_below_content) && is_array($about_us_banner_below_content)) :
                                    $count = 1;
                                    foreach ($about_us_banner_below_content as $item) :
                                        $description = $item['description'] ?? '';
                                        $title = $item['title'] ?? '';
                                        $icon_image = $item['icon_image'] ?? '';

                                        if (!empty($description) && !empty($title) && !empty($icon_image)) :
                                            // Determine the class based on count
                                            $column_class = ($count === 3 || $count === 5) ? 'col-12 fade' : 'col-12 col-md-6 fade';
                                            $column_card_class = ($count === 3 || $count === 5) ? 'card card-3 card-overly-effect' : 'card card-3';
                                ?>
                                            <div class="<?php echo esc_attr($column_class); ?>">
                                                <div class="<?php echo esc_attr($column_card_class); ?>">
                                                    <div class="row">
                                                        <div class="col-auto">
                                                            <div class="card-icon">
                                                                <img src="<?php echo esc_url($icon_image['url']); ?>" 
                                                                     alt="<?php echo esc_attr($title); ?>" 
                                                                     loading="lazy">
                                                            </div>
                                                        </div>
                                                        <div class="col">
                                                            <div class="card-body">
                                                                <div class="card-title"><?php echo esc_html($title); ?></div>
                                                                <?php echo wpautop($description); ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                <?php
                                            $count++;
                                        endif;
                                    endforeach;
                                endif;
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </section>