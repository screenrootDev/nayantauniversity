<?php
/**
 * Footer Template for Nayanta University Theme
 *
 * This file contains the footer section of the theme, including logo,
 * contact information, social media links, copyright information,
 * cookie consent, and enquiry form.
 *
 * @package Nayanta_University
 */
?>

<!-- Main Footer Section -->
<footer class="footer-main fade">
    <div class="container-fluid">
        <!-- Footer Top Section with Logo and Contact Information -->
        <div class="footer-top">
            <div class="row gy-4">
                <!-- Footer Logo Section -->
                <div class="col-12 col-md-4">
                    <div class="footer-logo">
                        <?php
                        // Get footer logo from theme options
                        $footer_logo = get_field('footer_logo', 'option'); 
                        if (!empty($footer_logo) && isset($footer_logo['url'])) :
                        ?>
                            <img src="<?php echo esc_url($footer_logo['url']); ?>" 
                                 alt="<?php esc_attr_e('Nayanta University', 'nayanta'); ?>" 
                                 loading="lazy" 
                            >
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Get in Touch Section -->
                <div class="col-12 col-md">
                    <div class="footer-links">
                        <div class="footer-title"><?php esc_html_e('get in touch', 'nayanta'); ?></div>
                        <?php  $get_in_touch_text = get_field('get_in_touch_text', 'option');  ?>

                        <p class="fs-14 mb-20 fw-light"><?php esc_html_e($get_in_touch_text, 'nayanta'); ?></p>
                        <?php
                        // Get contact information from theme options
                        $get_in_touch = get_field('get_in_touch', 'option'); 
                        if (!empty($get_in_touch) && is_array($get_in_touch)) :
                        ?>
                        <ul>
                        <?php foreach ($get_in_touch as $content) :
                            $email = isset($content['email']) ? $content['email'] : '';
                            $icon_class = isset($content['icon_class']) ? $content['icon_class'] : '';
                            $email_content = isset($content['email_content']) ? $content['email_content'] : '';

                            if (!empty($icon_class)) :
                                if ($icon_class === 'icon-mail' && !empty($email)) : ?>
                                    <li>
                                        <span>
                                            <i class="<?php echo esc_attr($icon_class); ?>"></i>
                                            <a href="mailto:<?php echo esc_attr($email); ?>" target="_blank">
                                                <?php echo esc_html($email); ?>
                                            </a>
                                        </span>
                                        <?php if (!empty($email_content)) : ?>
                                            <span><?php echo esc_html($email_content); ?></span>
                                        <?php endif; ?>
                                    </li>
                                <?php else : ?>
                                    <li>
                                        <span>
                                            <i class="<?php echo esc_attr($icon_class); ?>"></i>
                                            <a href="tel:<?php echo esc_attr($email); ?>" target="_blank">
                                            <?php echo esc_attr($email); ?>
                                            </a>
                                        </span>
                                    </li>
                                <?php endif;
                            endif;
                        endforeach; ?>
                        </ul>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Social Media Section -->
                <div class="col-12 col-md-auto">
                    <div class="footer-links">
                        <div class="footer-title mt-26"><a href="/contact-us/" class="title-link"><?php esc_html_e('connect with us', 'nayanta'); ?></a></div>
                        <ul class="nav-social-media">
                            <?php
                            // Get social media links from theme options
                            $socials = get_field('connect_with_us', 'option'); 
                            if (!empty($socials) && is_array($socials)) {
                                foreach ($socials as $social) {
                                    $icon = isset($social['social_icon']) ? $social['social_icon'] : '';
                                    $link = isset($social['social_links']) ? $social['social_links'] : '';
                                    
                                    if (!empty($icon)) {
                                        echo '<li><a href="' . esc_url($link) . '" target="_blank" rel="noopener noreferrer"><i class="' . esc_attr($icon) . '"></i></a></li>';
                                    }
                                }
                            }
                            ?>
                        </ul>
                        
                        <!-- Enquire Button -->
                        <div class="enquire-btn">
                            <a href="javascript:void(0)" class="btn btn-secondary w-100" data-fancybox="" data-src="#enquire">
                                <?php esc_html_e('enquire', 'nayanta'); ?>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer Bottom Section with Copyright and Design Info -->
        <div class="footer-bottom">
            <div class="row gy-2">
                <!-- Copyright Links -->
                <div class="col-12 col-md">
                    <?php
                    $copyright_links = get_field('copyright_links', 'option');
                    if (!empty($copyright_links)) {
                        echo wp_kses_post(wpautop($copyright_links));
                    }
                    ?>
                </div>
                
                <!-- Design By Section -->
                <div class="col-12 col-md-auto">
                    <div class="design-by">
                        <i class="icon-sr-logo me-2"></i>
                        <span>
                            <?php 
                            $design_by = get_field('design_by', 'option');
                            if (!empty($design_by)) {
                                // Remove only <p> and </p> tags for formatting
                                $design_by = str_replace(['<p>', '</p>'], '', $design_by);
                                echo wp_kses_post($design_by);
                            }
                            ?>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

<!-- Cookie Consent Section -->
<section class="cookies-box d-none" id="cookieConsent">
    <div class="container-fluid">
        <div class="cookies-inner">
            <div class="cookie-left">
                <h6 class="fw-bold mb-0"><?php esc_html_e('cookies policy', 'nayanta'); ?></h6>
                <p class="fs-14">
                    <?php esc_html_e("we care about your data, and we'd use cookies only to improve your experience. by using this website, you accept our cookies policy", 'nayanta'); ?>
                </p>
            </div>
            <div class="cookie-right btn-wrap">
                <a href="javascript:void(0)" id="rejectCookies" class="btn btn-outline-black">
                    <?php esc_html_e('reject all', 'nayanta'); ?>
                </a>
                <a href="javascript:void(0)" id="acceptCookies" class="btn btn-secondary">
                    <?php esc_html_e('accept', 'nayanta'); ?>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Enquiry Form Modal -->
<div id="enquire" style="display:none; max-width:720px; width: 100%;">
    <div class="fancy-wrapper">
        <div class="">
            <h2 class="mb-20"><?php esc_html_e('Enquire', 'nayanta'); ?></h2>
            <div class="form-card position-relative h-100" style="background-color: #f3f3f3;">
                <div class="ratio ratio-1x1">
                    <div class="npf_wgts" data-height="100%" data-w="08c8cfe5d387ae55d96ffc18266ddf5c"></div>
                </div>
            </div>
            <?php
            // External form widget script
            // Using wp_add_inline_script would be better, but directly including for compatibility
            ?>
            <script type="text/javascript">
                (function() {
                    var s = document.createElement("script");
                    s.type = "text/javascript";
                    s.async = true;
                    s.src = "https://widgets.in6.nopaperforms.com/emwgts.js";
                    document.body.appendChild(s);
                })();
            </script>
        </div>
    </div>
</div>

<!-- Footer Scripts -->
<script>
    document.addEventListener('DOMContentLoaded', () => {
        // Initialize FancyBox for modal windows
        if (typeof Fancybox !== 'undefined') {
        Fancybox.bind("[data-fancybox]", {
            click: false,         // disables closing when clicking outside
            backdropClick: false, // optional fallback for older versions
            dragToClose: false,   // disables swipe-to-close on mobile
            keyboard: {
                Escape: "close", // you can remove or change this if you don't want ESC to close
            },
        });
    }
        
        // Hero Swiper Initialization
        if (document.querySelector('.hero-swiper') && typeof Swiper !== 'undefined') {
            const heroSwiper = new Swiper(".hero-swiper", {
                speed: 500,
                loop: true,
                autoplay: {
                    delay: 5000,
                },
                pagination: {
                    el: ".hero-swiper .swiper-pagination",
                    clickable: true,
                    dynamicBullets: true,
                },
                navigation: {
                    nextEl: ".hero-swiper .swiper-btn-next",
                    prevEl: ".hero-swiper .swiper-btn-prev",
                },
            });
        }
        
        // Programmer Swiper Initialization
        if (document.querySelector('.programmer-swiper') && typeof Swiper !== 'undefined') {
            const programmerSwiper = new Swiper(".programmer-swiper", {
                slidesPerView: 1.07,
                freeMode: true,
                spaceBetween: 24,
                breakpoints: {
                    320: {
                        slidesPerView: 1,
                        spaceBetween: 8,
                    },
                    768: {
                        slidesPerView: 1,
                    },
                    992: {
                        // Default settings apply here
                    }
                }
            });
        }

        // Leaders Swiper Initialization
        if (document.querySelector('.leaders-swiper') && typeof Swiper !== 'undefined') {
            const leadersSwiper = new Swiper(".leaders-swiper", {
                pagination: {
                    el: document.querySelector(".section-leaders .swiper-pagination"),
                    clickable: true,
                    dynamicBullets: true,
                },
                navigation: {
                    nextEl: ".section-leaders .swiper-btn-next",
                    prevEl: ".section-leaders .swiper-btn-prev",
                },
            });
        }

        // Classroom Swiper Initialization
        if (document.querySelector('.classroom-swiper') && typeof Swiper !== 'undefined') {
            const classroomSwiper = new Swiper(".classroom-swiper", {
                slidesPerView: 2,
                spaceBetween: 8,
                pagination: {
                    el: ".classroom-swiper .swiper-pagination",
                    clickable: true,
                    dynamicBullets: true,
                },
                navigation: {
                    nextEl: ".classroom-swiper .swiper-btn-next",
                    prevEl: ".classroom-swiper .swiper-btn-prev",
                },
                breakpoints: {
                    320: {
                        slidesPerView: 1,
                    },
                    768: {
                        slidesPerView: 1.4,
                    },
                    991: {
                        // Default settings apply here
                    }
                }
            });
        }
    });
    
 
    

</script>

<!-- WordPress Footer Hook -->
<?php wp_footer(); ?>
</body>
</html>
