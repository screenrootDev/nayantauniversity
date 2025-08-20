<section class="section fade ">
                <div class="container">
                    <div class="row gy-4">
                    <?php 
                        $customise_your_path_heading = get_sub_field('customise_your_path_heading');
                        if (!empty($customise_your_path_heading)) : ?>
                            <div class="col-12">
                                <div class="section-heading">
                                    <?php echo wpautop($customise_your_path_heading); ?>
                                </div>
                            </div>
                    <?php endif; ?>
                        <div class="col-12">
                            <div class="row row-scroll g-4 mob-row-scroll">
                            <?php $customise_your_path_content = get_sub_field('customise_your_path_content');
                            if (!empty($customise_your_path_content) && is_array($customise_your_path_content)) : ?>
                            <?php foreach ($customise_your_path_content as $content) : 
                            $top_title = $content['top_title'] ?? '';
                            $sub_title = $content['sub_title'] ?? '';
                            $list = $content['list'] ?? '';
                            if ($top_title && $sub_title && $list ) : ?>
                            
                                <div class="col-12 col-md-6">
                                    <div class="card card-list bg-primary text-white">
                                        <div class="card-body">
                                            <div class="card-title"> <?php echo esc_html($top_title); ?></div>
                                            <div class="card-text"><?php echo esc_html($sub_title); ?></div>
                                            <?php
                                            if (!empty($list) && is_array($list)) : ?>
                                                <ul>
                                                    <?php foreach ($list as $item) : 
                                                        $point = $item['list_points'] ?? '';
                                                        $list_url = $item['list_url'] ?? '';
                                                        if (!empty($point)) : ?>
                                                            <li><a href="<?php echo esc_html($list_url); ?>" class="text-white text-decoration-none"><?php echo esc_html($point); ?></a></li>
                                                        <?php endif;
                                                    endforeach; ?>
                                                </ul>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            <?php endif;
                            endforeach;
                             endif;
                              ?>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="bg-gray-50 card-gray">
                                <div class="faqs-wrapper">
                                <?php 
                                    $customise_your_path_faqs = get_sub_field('customise_your_path_faqs');

                                    if (!empty($customise_your_path_faqs) && is_array($customise_your_path_faqs)) : ?>
                                        <ul>
                                            <?php foreach ($customise_your_path_faqs as $index => $faq) : 
                                                $question = $faq['question'] ?? '';
                                                $answer = $faq['answer'] ?? '';
                                                if (!empty($question) && !empty($answer)) : ?>
                                                    <li class="<?php echo $index === 0 ? 'active' : ''; ?>">
                                                        <button type="button"><?php echo esc_html($question); ?></button>
                                                        <div class="faq-content" <?php echo $index === 0 ? 'style="display: block;"' : ''; ?>>
                                                            <?php echo wpautop($answer); ?>
                                                        </div>
                                                    </li>
                                                <?php endif;
                                            endforeach; ?>
                                        </ul>
                                    <?php endif; ?>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>