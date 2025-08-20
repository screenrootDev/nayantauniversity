<section class="section fade">
        <div class="container">
            <div class="row gy-4">
            <?php 
            $undergraduate_programme_snapshot_section_heading = get_sub_field('undergraduate_programme_snapshot_section_heading');
            if (!empty($undergraduate_programme_snapshot_section_heading)) : ?>
                <div class="col-12">
                    <div class="section-heading">
                        <?php echo wpautop($undergraduate_programme_snapshot_section_heading); ?>
                    </div>
                </div>
            <?php endif; ?>
            <?php 
                $image = get_sub_field('undergraduate_programme_snapshot_section_image'); 
                if ($image) : 
                    $image_url = $image['url'];
                    $image_alt = $image['alt'] ?: 'Logo';
                    $image_title = $image['title'] ?? '';
                ?>
                    <div class="col-12">
                        <div class="scroll-img scroll-x bg-gray-50 card-gray">
                            <img 
                                src="<?php echo esc_url($image_url); ?>" 
                                class="w-100" 
                                alt="<?php echo esc_attr($image_alt); ?>" 
                                loading="lazy"
                            >
                        </div>
                    </div>
                <?php endif; ?>

                
            </div>
        </div>
    </section>