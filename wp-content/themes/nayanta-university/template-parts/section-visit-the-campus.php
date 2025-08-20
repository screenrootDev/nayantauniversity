            <!-- Campus Visit Section -->
            <section class="section fade pb-0">
                <div class="container">
                    <div class="row gy-4">
                        <?php 
                        $heading = get_sub_field('visit_the_campus_heading');
                        if (!empty($heading)) : 
                        ?>
                            <div class="col-12">
                                <div class="section-heading">
                                    <?php echo wp_kses_post($heading); ?> 
                                </div>
                            </div>
                        <?php endif; ?>
                        
                        <div class="col-12">
                            <div class="card card-2">
                                <div class="row gx-0">
                                    <!-- Google Maps -->
                                    <div class="col-12 col-lg-auto">
                                        <div class="card-img">
                                            <?php 
                                            $iframe_url = get_sub_field('iframe_url');
                                            if (!empty($iframe_url)) : 
                                            ?>
                                                <iframe 
                                                    class="position-absolute" 
                                                    src="<?php echo esc_url($iframe_url); ?>" 
                                                    width="100%" 
                                                    height="100%" 
                                                    style="border:0;" 
                                                    allowfullscreen="" 
                                                    loading="lazy" 
                                                    referrerpolicy="no-referrer-when-downgrade"
                                                ></iframe>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    
                                    <!-- Campus Information -->
                                    <div class="col-12 col-lg">
                                        <div class="card-body">
                                            <?php 
                                            $campus_title = get_sub_field('visit_the_campus_title');
                                            if (!empty($campus_title)) : 
                                            ?>
                                                <div class="card-title h2 mb-36"><?php echo esc_html($campus_title); ?></div>
                                            <?php endif; ?>
                                            
                                            <div class="card-text">
                                                <?php 
                                                $campus_description = get_sub_field('visit_the_campus_description');
                                                if (!empty($campus_description)) : 
                                                    echo wp_kses_post($campus_description);
                                                endif; 
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>