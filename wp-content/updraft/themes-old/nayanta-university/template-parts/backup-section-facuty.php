            <!-- Breadcrumb Navigation -->
            <nav aria-label="breadcrumb" class="breadcrumb-nav">
                <div class="container-fluid">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="<?php echo esc_url(get_site_url()); ?>">home</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">faculty</li>
                    </ol>
                </div>
            </nav>

            <!-- Faculty Section -->
            <section class="section section-inner-hero pb-0  ">
                <div class="container">
                    <div class="row gy-4">
                        <?php
                        // Faculty section heading
                        $faculty_section_heading = get_sub_field('faculty_section_heading');
                        if (!empty($faculty_section_heading)) :
                        ?>
                            <div class="col-12 fade">
                                <div class="section-heading">
                                    <?php echo wpautop($faculty_section_heading); ?>
                                </div>
                            </div>
                        <?php endif; ?>

                        <!-- Faculty Cards Slider -->
                        <div class="col-12">
                            <div class="team-card-wrapper swiper founder-swiper overflow-visible">
                                <div class="row gx-0 g-lg-4 swiper-wrapper">
                                    <?php
                                    // Faculty member cards
                                    $faculty_cards = get_sub_field('faculty_cards');
                                    if (!empty($faculty_cards) && is_array($faculty_cards)) :
                                        foreach ($faculty_cards as $member) :
                                            $faculty_title = $member['faculty_title'] ?? '';
                                            $faculty_designation = $member['faculty_designation'] ?? '';
                                            $faculty_image = $member['faculty_image'] ?? '';

                                            // Only display if we have the required fields
                                            if (!empty($faculty_title) && !empty($faculty_image)) :
                                    ?>
                                                <div class="col-12 col-md-4 col-lg-3 fade swiper-slide">
                                                    <div class="card team-card" style="cursor:auto;">
                                                        <div class="card-img">
                                                            <img src="<?php echo esc_url($faculty_image['url']); ?>"
                                                                alt="<?php echo esc_attr($faculty_title); ?>"
                                                                loading="lazy">
                                                        </div>
                                                        <div class="card-img-overlay">
                                                            <div class="card-title"><?php echo esc_html($faculty_title); ?></div>
                                                            <div class="card-text">
                                                                <?php
                                                                if (!empty($faculty_designation)) {
                                                                    echo wpautop($faculty_designation);
                                                                }
                                                                ?>
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

            <script>
                document.addEventListener('DOMContentLoaded', () => {
                    let mm = gsap.matchMedia();

                    const FounderItemsElement = document.querySelectorAll('.founder-swiper');

                    // For founder swiper
                    FounderItemsElement.forEach((item, idx) => {
                        const founderSwiper = new Swiper(item, {
                            init: false,
                            virtual: {
                                enabled: true,
                                addSlidesAfter: 3,
                                addSlidesBefore: 3
                            },
                            pagination: {
                                el: item.querySelector(".swiper-pagination"),
                                clickable: true,
                                dynamicBullets: true,
                            },
                            navigation: {
                                nextEl: item.querySelector(".swiper-btn-next"),
                                prevEl: item.querySelector(".swiper-btn-prev"),
                            },
                            breakpoints: {
                                320: {
                                    spaceBetween: 8,
                                },
                                768: {
                                    slidesPerView: 2,
                                    spaceBetween: 8,
                                },
                                992: {

                                }
                            }
                        });

                        mm.add("(max-width: 992px)", () => {
                            founderSwiper.init();
                        })
                    })



                    // For visionaries swiper
                    const visionariesSwiper = new Swiper(".visionaries-swiper", {
                        slidesPerView: 2,
                        spaceBetween: 24,
                        pagination: {
                            el: document.querySelector(".visionaries-swiper .swiper-pagination"),
                            clickable: true,
                            dynamicBullets: true,
                        },
                        navigation: {
                            nextEl: ".visionaries-swiper .swiper-btn-next",
                            prevEl: ".visionaries-swiper .swiper-btn-prev",
                        },
                        breakpoints: {
                            320: {
                                slidesPerView: 1,
                            },
                            768: {

                            }
                        }
                    });
                })
            </script>