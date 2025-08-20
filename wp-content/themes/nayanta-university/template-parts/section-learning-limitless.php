            <!-- Learning Section -->
            <section class="section pb-0 fade">
                <div class="container">
                    <div class="row gy-4">
                        <?php 
                        $heading = get_sub_field('learning_limitless_top_heading');
                        if (!empty($heading)) : 
                        ?>
                           <div class="col-12">
                                <div class="section-heading">
                                    <?php echo wpautop($heading); ?>
                                </div>
                           </div>
                        <?php endif; ?>
                        
                        <!-- Learning Tabs -->
                        <div class="col-12">
                            <div class="tabs-wrapper tabs-links">
                                <ul>
                                    <li class="active">
                                        <button tab-id="tab-1" data-text="undergraduate">undergraduate</button>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        
                        <!-- Learning Tab Content -->
                        <div class="col-12">
                            <div class="tabs-content-wrapper">
                                <div class="tabs-list">
                                    <div class="tab-content-item active" tab-content-id="tab-1">
                                        <?php 
                                        $text = get_sub_field('learning_limitless_text');
                                        if (!empty($text)) : 
                                        ?>
                                            <p class="fw-bold"><?php echo esc_html($text); ?></p>
                                        <?php endif; ?>
                                        
                                        <!-- Counter Items -->
                                        <div class="counter-wrapper pt-25">
                                            <div class="row gy-4 gx-5">
                                                <?php
                                                $content = get_sub_field('content');
                                                if (!empty($content) && is_array($content)) :
                                                    foreach ($content as $data) :
                                                        $title = $data['title'];
                                                        $subtitle = $data['subtitle'];
                                                        $description = $data['description'];
                                                        if ($title && $description && $subtitle) :
                                                ?>
                                                        <div class="col-12 col-md-6 col-lg-4">
                                                            <div class="card-counter">
                                                                <div class="card-number"><?php echo esc_html($title); ?></div>
                                                                <div class="card-title"><?php echo esc_html($subtitle); ?></div>
                                                                <div class="card-text"><?php echo esc_html($description); ?></div>
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
                        </div>
                          <!-- Learning CTA -->
                        <?php
                        $learn_more_link = get_sub_field('explore_the_programme');
                        if (!empty($learn_more_link) && isset($learn_more_link['url'])) : 
                            ?>
                            <div class="col-12 pt-25">
                            <a href="<?php echo esc_url($learn_more_link['url']); ?>" 
                                target="<?php echo esc_attr($learn_more_link['target'] ?? '_self'); ?>" 
                                class="btn btn-secondary">
                            <?php echo esc_html($learn_more_link['title'] ?? 'Learn More'); ?>
                            </a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </section>