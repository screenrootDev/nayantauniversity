            <!-- Leadership Section -->
            <section class="section fade pb-0">
                <div class="container">
                    <div class="row gy-4">
                        <?php
                        // Leadership heading
                        $leadership_heading = get_sub_field('leadership_heading');
                        if (!empty($leadership_heading)) :
                        ?>
                            <div class="col-12">
                                <div class="section-heading">
                                    <?php echo wpautop($leadership_heading); ?>
                                </div>
                            </div>
                        <?php endif; ?>

                        <!-- Leadership Cards -->
                        <div class="col-12">
                            <div class="team-card-wrapper swiper founder-swiper overflow-visible">
                                <div class="row gx-0 g-lg-4 swiper-wrapper">
                                    <?php
                                    $leadership_section_cards = get_sub_field('leadership_section_cards');
                                    if (!empty($leadership_section_cards) && is_array($leadership_section_cards)) :
                                        $i = 0;
                                        foreach ($leadership_section_cards as $leader) :
                                            $designation = $leader['designation'] ?? '';
                                            $title = $leader['title'] ?? '';
                                            $image = $leader['image'] ?? '';
                                            $profile_information = $leader['description'] ?? '';
                                            $multiple_designation = $leader['multiple_designation'] ?? array();
                                            $social_media_links = $leader['social_links'] ?? array();
                                            $qualification = $leader['qualification'] ?? '';

                                            // Only display if we have the required fields
                                            if (!empty($title) && !empty($image)) :
                                    ?>
                                                <div class="col-12 col-md-4 col-lg-3 fade swiper-slide">
                                                    <div class="card team-card" <?php echo !empty($profile_information) ? 'data-fancybox data-src="#leadership-' . $i . '"' : ''; ?>>
                                                        <div class="card-img">
                                                            <img src="<?php echo esc_url($image['url']); ?>"
                                                                alt="<?php echo esc_attr($title); ?>"
                                                                loading="lazy">
                                                        </div>
                                                        <div class="card-img-overlay">
                                                            <div class="card-title"><?php echo esc_html($title); ?></div>
                                                            <div class="card-text ">
                                                                <?php
                                                                if (!empty($designation)) {
                                                                    echo wpautop($designation);
                                                                }
                                                                ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Fancybox Modal for Leadership Profile Details -->
                                                <?php if (!empty($profile_information)) : ?>
                                                    <div id="leadership-<?php echo $i; ?>" class="team-fancybox" style="display:none; max-width:1026px; width: 100%;" data-bs-backdrop="static" data-bs-keyboard="false">
                                                        <div class="fancy-wrapper">
                                                            <div class="row g-4">
                                                                <div class="col-12 col-md-auto">
                                                                    <div class="team-img position-relative">
                                                                        <img src="<?php echo esc_url($image['url']); ?>"
                                                                            alt="<?php echo esc_attr($title); ?>"
                                                                            loading="lazy">
                                                                    </div>
                                                                </div>
                                                                <div class="col-12 col-md">
                                                                    <div class="team-content scroll-y">
                                                                        <div class="row gx-3 pb-16">
                                                                            <div class="col-auto">
                                                                                <h1 class="h4 mb-0"><?php echo esc_html($title); ?></h1>
                                                                            </div>

                                                                            <!-- Social Media Links -->
                                                                            <div class="col align-self-baseline">
                                                                                <ul class="team-social-media">
                                                                                    <?php
                                                                                    if (!empty($social_media_links) && is_array($social_media_links)) :
                                                                                        foreach ($social_media_links as $social_media) :
                                                                                            $social_link = $social_media['social_link'] ?? '';
                                                                                            $social_icon = isset($social_media['social_icon']) ? $social_media['social_icon']['url'] ?? '' : '';

                                                                                            if (!empty($social_link) && !empty($social_icon)) :
                                                                                    ?>
                                                                                                <li>
                                                                                                    <a href="<?php echo esc_url($social_link); ?>" target="_blank" rel="noopener noreferrer">
                                                                                                        <img src="<?php echo esc_url($social_icon); ?>" alt="Social Icon" loading="lazy">
                                                                                                    </a>
                                                                                                </li>
                                                                                    <?php
                                                                                            endif;
                                                                                        endforeach;
                                                                                    endif;
                                                                                    ?>
                                                                                </ul>
                                                                            </div>
                                                                        </div>

                                                                        <!-- Multiple Designations and Qualifications -->
                                                                        <div class="small-text">
                                                                            <ul class="text-list">
                                                                                <?php
                                                                                if (!empty($multiple_designation) && is_array($multiple_designation)) :
                                                                                    foreach ($multiple_designation as $designation_item) :
                                                                                        $multi_designation = isset($designation_item['multi_designation']) ?
                                                                                            wpautop($designation_item['multi_designation']) : '';

                                                                                        if (!empty($multi_designation)) :
                                                                                            // Remove only <ul> and <li> tags
                                                                                            $multi_designation = strip_tags($multi_designation, '<li><strong><em><b><i>');
                                                                                            echo wpautop($multi_designation);
                                                                                        endif;
                                                                                    endforeach;
                                                                                endif;
                                                                                ?>
                                                                            </ul>
                                                                            <?php
                                                                            if (!empty($qualification)) {
                                                                                echo wpautop($qualification);
                                                                            }
                                                                            ?>
                                                                        </div>

                                                                        <!-- Profile Information -->
                                                                        <?php echo wpautop($profile_information); ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php endif; ?>
                                    <?php
                                                $i++;
                                            endif;
                                        endforeach;
                                    endif;
                                    ?>
                                </div>
                                <div class="swiper-controls">
                                    <div class="swiper-btn-prev"></div>
                                    <div class="swiper-pagination"></div>
                                    <div class="swiper-btn-next"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>