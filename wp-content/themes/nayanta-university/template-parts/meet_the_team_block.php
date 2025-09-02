        <!-- Teams Section -->
        <section class="section section-teams pb-0 fade">
            <div class="container">
                <div class="row gy-4">
                    <?php
                    $title = get_sub_field('title');
                    $description = get_sub_field('description');
                    ?>

                    <?php if (!empty($title) || !empty($description)) : ?>
                        <div class="col-12">
                            <div class="section-heading">
                                <?php if (!empty($title)) : ?>
                                    <h2 class="h1"><?php echo wpautop($title); ?></h2>
                                <?php endif; ?>

                                <?php if (!empty($description)) : ?>
                                    <div class="text">
                                        <?php echo wpautop($description); ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endif; ?>


                    <!-- Team Members Slider -->
                    <div class="col-12">
                        <div class="swiper-tabs-wrapper tabs-content-wrapper">
                            <div class="tabs-list">
                                <div class="tab-content-item active" tab-content-id="slider-tab-1">
                                    <div class="swiper team-swiper overflow-visible">
                                        <div class="swiper-wrapper">
                                            <?php
                                            $our_team_cards = get_sub_field('our_team_content');
                                            if (!empty($our_team_cards) && is_array($our_team_cards)) :
                                                foreach ($our_team_cards as $member) :
                                                    $image = $member['team_image'];
                                                    $name = $member['team_name'];
                                                    $designation = $member['team_designation'];
                                                    $linkedin = $member['linkedin_url']; // <-- This is your link field

                                                    if ($image && $name && $designation) :
                                            ?>
                                                        <div class="swiper-slide">
                                                            <div class="card team-card">

                                                                <?php if (!empty($linkedin) && isset($linkedin['url'])) : ?>
                                                                    <div class="card-link position-absolute top-0 end-0 p-2 z-3">
                                                                        <a href="<?php echo esc_url($linkedin['url']); ?>"
                                                                            target="<?php echo esc_attr($linkedin['target'] ?: '_blank'); ?>"
                                                                            class="">
                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" viewBox="0 0 21 21" fill="none">
                                                                                <path d="M20.0732 18.2046C20.0732 19.7391 18.8299 20.9824 17.2955 20.9824H2.85102C1.31713 20.9824 0.0732422 19.7391 0.0732422 18.2046V3.7602C0.0732422 2.22576 1.31713 0.982422 2.85102 0.982422H17.2955C18.8299 0.982422 20.0732 2.22576 20.0732 3.7602V18.2046Z" fill="#0078D4" />
                                                                                <path opacity="0.05" d="M13.4066 18.2042V12.5937C13.4066 11.6553 12.9516 11.0948 12.1889 11.0948C11.7361 11.0948 11.4033 11.3498 11.2005 11.8525C11.1911 11.8881 11.1777 12.0331 11.1833 12.4714L11.1844 18.2042H7.29552V7.64865H11.1844V8.2381C11.7522 7.84643 12.4483 7.64865 13.2611 7.64865C15.7872 7.64865 17.295 9.36699 17.295 12.2453L17.2955 18.2042H13.4066ZM2.85107 18.2042V7.64865H4.77163C3.65885 7.64865 2.85107 6.83088 2.85107 5.70365C2.85107 4.57754 3.67219 3.75977 4.8033 3.75977C5.92107 3.75977 6.71719 4.55477 6.73996 5.69254C6.73996 6.8281 5.9183 7.64865 4.78719 7.64865H6.73996V18.2042H2.85107Z" fill="black" />
                                                                                <path opacity="0.07" d="M13.6845 17.927V12.5942C13.6845 11.4981 13.1117 10.8175 12.1889 10.8175C11.4695 10.8175 11.1139 11.3242 10.9428 11.7492C10.8972 11.8598 10.9033 12.2986 10.9056 12.4859L10.9067 17.927H7.57335V7.92697H10.9067V8.83697C11.3484 8.37975 12.0595 7.92697 13.2611 7.92697C15.6128 7.92697 17.0172 9.54142 17.0172 12.2459L17.0178 17.927H13.6845ZM3.12891 17.927V7.92697H6.46224V17.927H3.12891ZM4.77168 7.37142C3.82002 7.37142 3.12891 6.67031 3.12891 5.7042C3.12891 4.73864 3.83335 4.03809 4.80335 4.03809C5.76113 4.03809 6.4428 4.72086 6.46224 5.69864C6.46224 6.67031 5.75779 7.37142 4.78724 7.37142H4.77168Z" fill="black" />
                                                                                <path d="M3.40674 8.20432H6.18452V17.6488H3.40674V8.20432ZM4.78729 7.09321H4.77174C3.94285 7.09321 3.40674 6.47543 3.40674 5.70376C3.40674 4.91543 3.95952 4.31543 4.8034 4.31543C5.6484 4.31543 6.16896 4.91543 6.18452 5.70376C6.18452 6.47487 5.6484 7.09321 4.78729 7.09321ZM16.7401 17.6488H13.9623V12.5938C13.9623 11.3727 13.2817 10.5393 12.189 10.5393C11.3551 10.5393 10.904 11.1015 10.6851 11.6449C10.6051 11.8393 10.629 12.3771 10.629 12.6488V17.6488H7.85118V8.20432H10.629V9.65765C11.0295 9.03765 11.6567 8.20432 13.2612 8.20432C15.249 8.20432 16.7395 9.45432 16.7395 12.2454L16.7401 17.6488Z" fill="white" />
                                                                            </svg>
                                                                        </a>
                                                                    </div>
                                                                <?php endif; ?>

                                                                <div class="card-img">
                                                                    <img src="<?php echo esc_url($image['url']); ?>"
                                                                        alt="<?php echo esc_attr($name); ?>"
                                                                        loading="lazy">
                                                                </div>

                                                                <div class="card-img-overlay">
                                                                    <div class="card-title"><?php echo esc_html($name); ?></div>
                                                                    <div class="card-text">
                                                                        <?php echo wp_kses_post($designation); ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                            <?php
                                                    endif;
                                                endforeach;
                                            endif;
                                            ?>


                                        </div>
                                        <!-- Slider Controls -->
                                        <div class="btn-wrap">
                                            <div class="swiper-controls">
                                                <div class="swiper-btn-prev"></div>
                                                <div class="swiper-pagination"></div>
                                                <div class="swiper-btn-next"></div>
                                            </div>

                                            <?php
                                            $linkedin_url = get_sub_field('linkedin_url');
                                            if (!empty($linkedin_url) && isset($linkedin_url['url'])) :
                                            ?>
                                                <a href="<?php echo esc_url($linkedin_url['url']); ?>"
                                                    target="<?php echo esc_attr($linkedin_url['target'] ?? '_self'); ?>"
                                                    class="btn btn-secondary">
                                                    <?php echo esc_html($linkedin_url['title'] ?? 'Learn More'); ?>
                                                </a>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>