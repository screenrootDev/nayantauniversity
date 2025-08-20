<section class="section fade">
                <div class="container">
                    <div class="row gy-4">
                    <?php 
                        $undergraduate_programme_our_partners_heading = get_sub_field('undergraduate_programme_our_partners_heading');
                        if (!empty($undergraduate_programme_our_partners_heading)) : ?>
                            <div class="col-12">
                                <div class="section-heading">
                                    <?php echo wpautop($undergraduate_programme_our_partners_heading); ?>
                                </div>
                            </div>
                    <?php endif; ?>
                        <div class="col-12">
                            <div class="bg-gray-50">
                                <div class="swiper partner-swiper py-4">
                                <?php
                                $our_partner = get_sub_field('our_partner');

                                if (!empty($our_partner) && is_array($our_partner)) : ?>
                                    <div class="swiper-wrapper">
                                        <?php foreach ($our_partner as $index => $partner) :
                                            $partner_image = $partner['our_partner_image'] ?? '';
                                            if (!empty($partner_image)) : ?>
                                                <div class="swiper-slide">
                                                    <img src="<?php echo esc_url($partner_image['url']); ?>" alt="<?php echo esc_url($partner_image['alt']); ?>" title="<?php echo esc_url($partner_image['title']); ?>">
                                                </div>
                                            <?php endif;
                                        endforeach; ?>
                                    </div>
                                <?php endif; ?>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>