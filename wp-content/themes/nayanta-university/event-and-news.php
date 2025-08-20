<?php
/**
 * Template Name: EventAndNews
 */

get_header();
?>

 <!-- Breadcrumb Navigation -->
 <nav aria-label="breadcrumb" class="breadcrumb-nav">
                <div class="container-fluid">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="<?php echo esc_url(get_site_url()); ?>"><?php esc_html_e('home', 'nayanta'); ?></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page"><?php esc_html_e('events and news', 'nayanta'); ?></li>
                    </ol>
                </div>
            </nav>


 <section class="section-inner-hero pb-50">
     <div class="container">
        <div class="section-heading events-and-news">
        <h2 class="big"><?php echo get_the_title(); ?></h2>
        </div>
        <div class="row align-items-center">
        <?php
        $terms = get_terms([
            'taxonomy' => 'events-and-news-category',
            'hide_empty' => false,
        ]);
        ?>

        <div class="col-md-9">
            <div class="tabs-wrapper tabs-links">
            <?php
              // Step 1: Get first query parameter key from URL
              $active_tab_slug = '';
              if (!empty($_SERVER['QUERY_STRING'])) {
                  parse_str($_SERVER['QUERY_STRING'], $query_array);
                  $active_tab_slug = key($query_array); // e.g., 'events' or 'news'
              }
              ?>

              <ul>
                  <?php if (!empty($terms) && !is_wp_error($terms)) : ?>
                      <?php foreach ($terms as $index => $term) : ?>
                          <?php
                          // Step 2: Determine active class based on URL
                          $is_active = $term->slug === $active_tab_slug || ($index === 0 && empty($active_tab_slug));
                          ?>
                          <li class="<?php echo $is_active ? 'active' : ''; ?>">
                              <button tab-id="<?php echo esc_attr($term->slug); ?>" data-text="<?php echo esc_attr($term->slug); ?>">
                                  <?php echo esc_html($term->name); ?>
                              </button>
                          </li>
                      <?php endforeach; ?>
                  <?php endif; ?>
              </ul>

            </div>
        </div>

            <div class="col-md-3 ms-auto">
                <div class="sort">
                    <label for="sort">Sort</label>
                    <select id="sort" class="select-form-control">
                        <option value="latest">Latest</option>
                        <option value="oldest">Oldest</option>
                        <option value="asc">A-Z</option>
                        <option value="desc">Z-A</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="tabs-content-wrapper">
            <div class="tabs-list">
                <div class="tab-content-item active" tab-content-id="events">
                    <div class="cards-wrapper" id="events-news-wrapper">
                        <?php
                        $args = [
                            'post_type'      => 'events-and-news',
                            'posts_per_page' => 4,
                            'paged'          => $paged,
                            'meta_key'       => 'event_date',
                            'orderby'        => 'meta_value',
                            'order'          => 'DESC',
                            'meta_type'      => 'DATE',
                        ];

                       // Set $event_type based on the same logic
                        $event_type = $active_tab_slug;

                        // Fallback to first term if URL param doesn't match any term
                        if (empty($event_type) && !empty($terms) && !is_wp_error($terms)) {
                            $event_type = $terms[0]->slug;
                        }

                        // Build WP_Query args
                        if (!empty($event_type)) {
                            $args['tax_query'] = [
                                [
                                    'taxonomy' => 'events-and-news-category',
                                    'field'    => 'slug',
                                    'terms'    => $event_type,
                                ],
                            ];
                        }
                        $query = new WP_Query($args);
                        $post_count = $query->found_posts;
                        if ($query->have_posts()) :
                            while ($query->have_posts()) : $query->the_post();
                                $event_date = get_field('event_date');
                                $event_location = get_field('event_location');
                                $event_mode = get_field('event_mode');
                                $location_icon = get_field('location_icon');
                                $event_description = get_field('event_description');
                        ?>
                            <div class="card card-classroom">
                            <?php
                            $event_image = get_field('event_image');
                            if (!empty($event_image)) : ?>
                                <div class="card-img">
                                    <img src="<?php echo esc_url($event_image['url']); ?>"
                                        alt="<?php echo esc_attr($event_image['alt']); ?>" />
                                </div>
                            <?php endif; ?>

                                <div class="card-body-wrap">
                                    <div class="card-body">
                                        <div class="card-title"><?php the_title(); ?></div>
                                        <div class="card-text">
                                            <p><?php echo esc_html($event_description); ?></p>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <ul class="tag-icon-wrap">
                                            <?php if ($event_date) : ?>
                                                <li>
                                                    <i class="icon-calendar"></i>
                                                    <span><?php echo date('F j, Y', strtotime($event_date)); ?></span>
                                                </li>
                                            <?php else: ?>
                                                <li>
                                                    <i class="icon-calendar"></i>
                                                    <span><?php echo esc_html('ongoing'); ?></span>
                                                </li>
                                            <?php endif; ?>
                                            <?php if ($event_location) : ?>
                                                <li>
                                                    <i class="<?php echo esc_html($location_icon); ?>"></i>
                                                    <span><?php echo esc_html($event_location); ?></span>
                                                </li>
                                            <?php endif; ?>
                                        </ul>
                                        <?php
                                        $read_more_link = get_field('read_more'); // ACF Link field (type: Link)
                                        if (!empty($read_more_link) && isset($read_more_link['url'])) :
                                        ?>
                                            <div class="link-wrap">
                                                <a href="<?php echo esc_url($read_more_link['url']); ?>"
                                                target="<?php echo esc_attr($read_more_link['target'] ?? '_self'); ?>"
                                                class="arrow-link right">
                                                    <?php echo esc_html($read_more_link['title'] ?? 'Read More'); ?>
                                                </a>
                                            </div>
                                        <?php endif; ?>

                                    </div>
                                </div>
                            </div>
                        <?php
                            endwhile;
                            wp_reset_postdata();
                        endif;
                        ?>
                    </div>
                    <div class="show-more-wrapper mt-24 mb-24" style="display: <?php echo ($post_count > 4) ? 'block' : 'none'; ?>;">
                        <button type="button" class="btn btn-outline-black">
                            <div class="spinner-wrap" style="display:none">
                                <div class="spinner-border spinner-border-sm" role="status"></div>
                            </div>
                            <span>show more</span>
                        </button>
                    </div>
                
            </div>
        </div>
    </div>
</section>
<style>
    .cards-wrapper:has(.spinner-border){
        display: flex;
        min-height: 400px;
        align-items: center;
        justify-content: center;
    }
</style>
<script>
    
jQuery(document).ready(function ($) {
  let currentPage = 1;
  let postType = $('.tabs-wrapper li.active button').attr('tab-id') || 'events-and-news';
  let sort = $('#sort').val();
  let [orderBy, order] = getSortParams(sort);

  function getSortParams(sortValue) {
    switch (sortValue) {
      case 'latest':
        return ['date', 'DESC'];
      case 'oldest':
        return ['date', 'ASC'];
      case 'asc':
        return ['title', 'ASC'];
      case 'desc':
        return ['title', 'DESC'];
      default:
        return ['date', 'DESC'];
    }
  }

  function fetchEvents(page = 1, append = false) {
    $.ajax({
      url: nayantaData.ajax_url,
      type: 'POST',
      data: {
        action: 'nayanta_load_events_ajax',
        nonce: nayantaData.nonce,
        post_type: postType,
        order: order,
        orderby: orderBy,
        page: page,
      },
      beforeSend: function () {
        if (!append) {
          $('.cards-wrapper').html(`<div class="d-flex justify-content-center py-5">
          <div class="spinner-border" role="status"></div>
        </div>`);
        }
      },
      success: function (response) {
        if (response.success) {
          const html = response.data.html;
          const morePages = response.data.more_pages;

          if (append) {
            $('.cards-wrapper').append(html);
          } else {
            $('.cards-wrapper').html(html);
          }

          currentPage = response.data.current_page;

          if (morePages) {
            $('.show-more-wrapper').show();
          } else {
            $('.show-more-wrapper').hide();
          }
        } else {
          $('.cards-wrapper').html('<p>No posts found.</p>');
        }
      },
      complete: function(){
        $('.show-more-wrapper').find('button span').show();
        $('.show-more-wrapper').find('button .spinner-wrap').hide();
      },
      error: function (xhr) {
        $('.cards-wrapper').html('<p>Error: ' + xhr.statusText + '</p>');
      }
    });
  }

  // Initial load
  //fetchEvents();

  // Tab click
  $('.tabs-wrapper button').on('click', function () {
    $('.show-more-wrapper').hide();
    $('.tabs-wrapper li').removeClass('active');
    $(this).closest('li').addClass('active');

    postType = $(this).attr('tab-id');
    sort = $('#sort').val();
    [orderBy, order] = getSortParams(sort);
    currentPage = 1;

    fetchEvents(currentPage, false);
  });

  // Sort change
  $('#sort').on('change', function () {
    $('.show-more-wrapper').hide();
    sort = $(this).val();
    [orderBy, order] = getSortParams(sort);
    currentPage = 1;

    fetchEvents(currentPage, false);
  });

  // Load more click
  $('.show-more-wrapper button').on('click', function () {
    $(this).find('span').hide();
    $(this).find('.spinner-wrap').show();
    currentPage += 1;
    fetchEvents(currentPage, true);
  });
});
</script>
<?php
get_footer();




