
            <!-- Application Form Section -->
            <section class="section fade pb-0">
                <div class="container">
                    <?php 
                    $heading = get_sub_field('nayanta_application_journey_title');
                    if (!empty($heading)) : 
                    ?>
                        <div class="section-heading mb-32">
                            <?php echo wp_kses_post($heading); ?> 
                        </div>
                    <?php endif; ?>
                    
                    <div class="landing-wrapper negative-end">
                        <div class="row gx-0 flex-md-row-reverse">
                            <!-- Application Form -->
                            <div class="col-12 col-lg-6">
                                <div class="form-card position-relative h-100" style="background-color: #f3f3f3;">
                                    <div class="ratio ratio-4x3">
                                        <div class="npf_wgts" data-height="100%" data-w="08c8cfe5d387ae55d96ffc18266ddf5c"></div>
                                    </div>
                                </div>
                                
                                <!-- External Form Widget Script -->
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
                            
                            <!-- Application Image -->
                            <?php 
                            $application_image = get_sub_field('nayanta_application_journey_image');
                            if (!empty($application_image) && isset($application_image['url'])) : 
                            ?>
                                <div class="col-12 col-lg-6">
                                    <div class="ratio ratio-4x3">
                                        <img 
                                            src="<?php echo esc_url($application_image['url']); ?>" 
                                            alt="<?php echo esc_attr(isset($application_image['alt']) ? $application_image['alt'] : ''); ?>"
                                            loading="lazy"
                                        >
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </section>