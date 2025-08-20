          <!-- Breadcrumb Navigation -->
            <nav aria-label="breadcrumb" class="breadcrumb-nav">
                <div class="container-fluid">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="<?php echo esc_url(get_site_url()); ?>">home</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">undergraduate programme</li>
                    </ol>
                </div>
            </nav>
        <!--Banner-->
        <section class="section section-inner-hero pb-0">
        <div class="container">
            <div class="row gy-4">
                <div class="col-12 fade">
                <?php $undergraduate_programme_banner_section_heading = get_sub_field('undergraduate_programme_banner_section_heading'); ?>
                <?php if (!empty($undergraduate_programme_banner_section_heading)) : ?>
                    <div class="section-heading">
                        <?php echo wpautop(text: $undergraduate_programme_banner_section_heading); ?>
                    </div>
                <?php endif; ?>
                </div>
                <div class="col-12 fade">
                <?php 
                    $image = get_sub_field('undergraduate_programme_banner_section_image'); 
                    if ($image) : 
                        $image_url = $image['url'];
                        $image_alt = $image['alt'] ?: 'Logo';
                        $image_title = $image['title'] ?? '';
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
     <!--Banner-->