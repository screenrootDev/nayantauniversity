        <!-- Gallery Section -->
        <section class="section section-gallery  fade">
            <div class="container">
                <div class="row gy-4">
                    <?php
                    $heading = get_sub_field('heading'); ?>
                    <?php if (!empty($heading)) : ?>
                        <div class="col-12 mt-0">
                            <div class="section-heading">
                                <?php echo wpautop($heading); ?>
                            </div>
                        </div>
                    <?php endif; ?>

                    <!-- Team Members Slider -->
                    <div class="col-12">
                        <div class="swiper-tabs-wrapper tabs-content-wrapper">
                            <div class="tabs-list">
                                <div class="tab-content-item active" tab-content-id="slider-tab-1">
                                    <div class="swiper gallery-swiper overflow-visible">

                                        <div class="swiper-wrapper">
                                            <?php
                                            $gallery_items = get_sub_field('gallery_items');
                                            foreach ($gallery_items as $index => $item):
                                                $img = $item['gallery_image'];
                                                if (!empty($img)): ?>
                                                    <div class="swiper-slide">
                                                        <div class="square-img overflow-hidden">
                                                            <img
                                                                src="<?php echo esc_url($img['url']); ?>"
                                                                alt=""
                                                                class="img-fluid w-100 h-100 object-cover open-modal-image"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#galleryModal"
                                                                data-index="<?php echo $index; ?>">
                                                        </div>
                                                    </div>
                                            <?php endif;
                                            endforeach; ?>
                                        </div>

                                        <!-- Slider Controls -->
                                        <div class="btn-wrap">
                                            <div class="swiper-controls">
                                                <div class="swiper-btn-prev"></div>
                                                <div class="swiper-pagination"></div>
                                                <div class="swiper-btn-next"></div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <!-- Bootstrap Modal with Swiper -->
                    <div class="modal fade mt-0" id="galleryModal" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-xl">
                            <div class="modal-content bg-transparent border-0  text-white">

                                <div class="modal-body  p-0">
                                    <div class="modal-header border-0  p-0 justify-content-end rounded-0 position-relative">
                                        <button type="button" class="btn-close btn-close-white p-0 right-0  " data-bs-dismiss="modal" aria-label="Close">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 48 48" fill="none">
                                                <rect y="-3.05176e-05" width="48" height="48" fill="#F1F5F4" fill-opacity="0.8" />
                                                <path d="M34 14L14 34" stroke="#121212" stroke-linecap="round" stroke-linejoin="round" />
                                                <path d="M14 14L34 34" stroke="#121212" stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                        </button>
                                    </div>
                                    <!-- Swiper inside modal -->
                                    <div class="swiper popup-swiper">
                                        <div class="swiper-wrapper">
                                            <?php foreach ($gallery_items as $item):
                                                $img = $item['gallery_image'];
                                                if (!empty($img)): ?>
                                                    <div class="swiper-slide text-center">
                                                        <div>
                                                            <img src="<?php echo esc_url($img['url']); ?>" class="w-100 h-100 object-fit-cover" alt="">
                                                        </div>
                                                    </div>
                                            <?php endif;
                                            endforeach; ?>

                                        </div>



                                        <!-- Slider Controls -->
                                        <div class="btn-wrap">
                                            <div class="swiper-controls">
                                                <div class="swiper-btn-prev"></div>
                                                <div class="swiper-pagination"></div>
                                                <div class="swiper-btn-next"></div>
                                            </div>
                                        </div>

                                    </div>




                                </div>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </section>