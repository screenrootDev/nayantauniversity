<section class="section bg-gray-50 fade" id="programmeCourses">
    <div class="container">
        <div class="row gy-4">

            <?php
            $courses_heading = get_sub_field('programme_courses_heading');
            if (!empty($courses_heading)) : ?>
                <div class="col-12">
                    <div class="section-heading">
                        <?php echo wpautop($courses_heading); ?>
                    </div>
                </div>
            <?php endif; ?>

            <?php
            $programme_courses = get_sub_field('programme_course');
            if (!empty($programme_courses) && is_array($programme_courses)) : ?>
                <div class="col-12">
                    <div class="row gy-3 gy-lg-5 gx-4 card-text-wrapper">
                        <?php
                        $counter = 0;
                        foreach ($programme_courses as $course) :
                            $title = $course['courses_name'] ?? '';
                            $image = $course['courses_image'] ?? '';
                            if ($title && !empty($image)) :
                                $counter++;
                                $extra_class = ($counter > 4) ? ' card-text-hide' : '';
                        ?>
                                <div class="col-12 col-md-4 col-lg-3" <?php echo esc_attr($extra_class); ?>>
                                    <div class="card-icon-text">
                                        <div class="card-img">
                                            <img
                                                src="<?php echo esc_url($image['url']); ?>"
                                                alt="<?php echo esc_attr($image['alt']); ?>"
                                                loading="lazy">
                                        </div>
                                        <div class="card-text">
                                            <?php echo wpautop($title); ?>
                                        </div>
                                    </div>
                                </div>
                        <?php
                            endif;
                        endforeach;
                        ?>

                    </div>
                </div>

                <!-- Mobile Show More Button -->
                <div class="col-12 d-md-none">
                    <button type="button" class="btn btn-secondary" id="showMoreCartText">show more</button>
                </div>
            <?php endif; ?>

            <?php
            $courses_banner = get_sub_field('programme_courses_banner_image');
            if (!empty($courses_banner)) :
                $image_url = $courses_banner['url'];
                $image_alt = $courses_banner['alt'] ?? 'Banner Image';
                $image_title = $courses_banner['title'] ?? '';
            ?>
                <div class="col-12 mt-30">
                    <div class="img-wrap">
                        <img
                            src="<?php echo esc_url($image_url); ?>"
                            class="w-100"
                            alt="<?php echo esc_attr($image_alt); ?>"
                            loading="lazy">
                    </div>
                </div>
            <?php endif; ?>


        </div>
    </div>
</section>