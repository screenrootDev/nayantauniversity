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



              <!-- Founding Team Section -->
              <section class="section section-inner-hero fade faculty-section">
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

                          <!-- Founder Profiles -->
                          <div class="col-12">
                              <div class="team-card-wrapper ">
                                  <div class="row gx-0 g-lg-4">
                                      <?php
                                        $faculty_cards = get_sub_field('faculty_cards');
                                        if (!empty($faculty_cards) && is_array($faculty_cards)) :
                                            $i = 0;
                                            foreach ($faculty_cards as $profile) :
                                                $faculty_designation = $profile['faculty_designation'] ?? '';
                                                $faculty_title = $profile['faculty_title'] ?? '';
                                                $faculty_image = $profile['faculty_image'] ?? '';
                                                $profile_information = $profile['profile_information'] ?? '';
                                                $multiple_designation = $profile['multiple_designation'] ?? array();
                                                $social_media_links = $profile['social_media_links'] ?? array();
                                                $qualification = $profile['qualification'] ?? '';

                                                // Only display if we have the required fields
                                                if (!empty($faculty_title) && !empty($faculty_image)) :
                                        ?>
                                                  <div class="col-12 col-md-4 col-lg-3 fade team-card-item">
                                                      <div class="card team-card" <?php echo !empty($profile_information) ? 'data-fancybox data-src="#team-' . $i . '"' : ''; ?>>
                                                          <div class="card-img">
                                                              <img src="<?php echo esc_url($faculty_image['url']); ?>"
                                                                  alt="<?php echo esc_attr($faculty_title); ?>"
                                                                  loading="lazy">
                                                          </div>
                                                          <div class="card-img-overlay">
                                                              <div class="card-faculty_title"><?php echo esc_html($faculty_title); ?></div>
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

                                                  <!-- Fancybox Modal for Profile Details -->
                                                  <?php if (!empty($profile_information)) : ?>
                                                      <div id="team-<?php echo $i; ?>" class="team-fancybox" style="display:none; max-width:1026px; width: 100%;" data-bs-backdrop="static" data-bs-keyboard="false">
                                                          <div class="fancy-wrapper">
                                                              <div class="row g-4">
                                                                  <div class="col-12 col-md-auto">
                                                                      <div class="team-img position-relative">
                                                                          <img src="<?php echo esc_url($faculty_image['url']); ?>"
                                                                              alt="<?php echo esc_attr($faculty_title); ?>"
                                                                              loading="lazy">
                                                                      </div>
                                                                  </div>
                                                                  <div class="col-12 col-md">
                                                                      <div class="team-content scroll-y">
                                                                          <div class="row gx-3 pb-16">
                                                                              <div class="col-auto">
                                                                                  <h1 class="h4 mb-0"><?php echo esc_html($faculty_title); ?></h1>
                                                                              </div>

                                                                              <!-- Social Media Links -->
                                                                              <div class="col align-self-baseline">
                                                                                  <ul class="team-social-media">
                                                                                      <?php
                                                                                        if (!empty($social_media_links) && is_array($social_media_links)) :
                                                                                            foreach ($social_media_links as $social_media) :
                                                                                                $social_link = $social_media['social_links'] ?? '';
                                                                                                $social_icon = isset($social_media['social_icons']) ? $social_media['social_icons']['url'] ?? '' : '';

                                                                                                if (!empty($social_link) && !empty($social_icon)) :
                                                                                        ?>
                                                                                                  <li>
                                                                                                      <a href="<?php echo esc_url($social_link); ?>" target="_blank" rel="noopener noreferrer">
                                                                                                          <img src="<?php echo esc_url($social_icon); ?>" alt="Social Icon" loading="lazy">
                                                                                                      </a>
                                                                                                  </li>
                                                                                      <?php
                                                                                                endif;
                                                                                            endforeach;
                                                                                        endif;
                                                                                        ?>
                                                                                  </ul>
                                                                              </div>
                                                                          </div>

                                                                          <!-- Multiple Designations and Qualifications -->
                                                                          <div class="small-text">
                                                                              <ul class="text-list">
                                                                                  <?php
                                                                                    if (!empty($multiple_designation) && is_array($multiple_designation)) :
                                                                                        foreach ($multiple_designation as $designation_item) :
                                                                                            $multi_designation = isset($designation_item['multi_designation']) ? trim($designation_item['multi_designation']) : '';

                                                                                            if (!empty($multi_designation)) :
                                                                                                echo '<li>' . wp_kses_post($multi_designation) . '</li>';
                                                                                            endif;
                                                                                        endforeach;
                                                                                    endif;
                                                                                    ?>
                                                                              </ul>
                                                                              <div class="qualification-txt">
                                                                                  <?php
                                                                                    if (!empty($qualification)) {
                                                                                        echo wpautop($qualification);
                                                                                    }
                                                                                    ?>
                                                                              </div>
                                                                          </div>

                                                                          <!-- Profile Information -->
                                                                          <div class="mt-36">
                                                                              <?php echo wpautop($profile_information); ?>
                                                                          </div>
                                                                      </div>
                                                                  </div>
                                                              </div>
                                                          </div>
                                                      </div>
                                                  <?php endif; ?>
                                      <?php
                                                    $i++;
                                                endif;
                                            endforeach;
                                        endif;
                                        ?>
                                  </div>
                                  <div class="text-center mt-24">
                                      <button id="showMoreBtn" class="btn btn-primary ">Show More</button>
                                  </div>

                              </div>
                          </div>
                      </div>
                  </div>
              </section>


              <script>
                  document.addEventListener('DOMContentLoaded', function() {
                      const cards = document.querySelectorAll('.team-card-item');
                      const showMoreBtn = document.getElementById('showMoreBtn');
                      const increment = 4;

                      // Determine initial visible count based on screen width
                      let visibleCount = window.innerWidth < 768 ? 4 : 12;

                      function updateVisibility() {
                          cards.forEach((card, index) => {
                              card.style.display = index < visibleCount ? 'block' : 'none';
                          });

                          if (visibleCount >= cards.length) {
                              showMoreBtn.style.display = 'none';
                          } else {
                              showMoreBtn.style.display = 'inline-block';
                          }
                      }

                      // Initial display
                      updateVisibility();

                      // Show more on click
                      showMoreBtn.addEventListener('click', function() {
                          visibleCount += increment;
                          updateVisibility();
                      });

                      // Optional: if user resizes screen, re-evaluate initial state
                      //   window.addEventListener('resize', function() {
                      //       // Optional debounce
                      //       clearTimeout(window.resizeTimer);
                      //       window.resizeTimer = setTimeout(function() {
                      //           visibleCount = window.innerWidth < 768 ? 4 : 12;
                      //           updateVisibility();
                      //       }, 250);
                      //   });
                  });
              </script>