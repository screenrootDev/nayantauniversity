            <!-- Experience Nayanta Section -->
            <section class="section section-experience fade pb-0">
                <div class="container">
                    <div class="row gy-4">
                        <?php 
                        // Experience section heading
                        $experience_section_heading = get_sub_field( 'about_us_experience_nayanta_section_top_heading'); 
                        if (!empty($experience_section_heading)) : 
                        ?>
                            <div class="col-12">
                                <div class="section-heading">
                                    <?php echo wpautop($experience_section_heading); ?>
                                </div>
                            </div>
                        <?php endif; ?>
                        
                        <!-- Experience Content Cards -->
                        <div class="col-12">
                            <div class="card card-big">
                                <div class="row g-5">
                                    <?php
                                    $experience_content = get_sub_field('about_us_experience_nayanta_section_content');
                                    if (!empty($experience_content) && is_array($experience_content)) :
                                        foreach ($experience_content as $item) :
                                            $description = $item['description'] ?? '';
                                            $title = $item['title'] ?? '';
                                            
                                            if (!empty($description) && !empty($title)) :
                                    ?>
                                                <div class="col-12 col-md-6">
                                                    <div class="card card-3 bg-transparent p-0">
                                                        <div class="card-body">
                                                            <div class="card-title"><?php echo esc_html($title); ?></div>
                                                            <div class="card-text fw-medium">
                                                                <p><?php echo esc_html($description); ?></p>
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
                            </div>
                        </div>
                    </div>
                </div>
            </section>