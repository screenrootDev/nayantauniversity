<?php
if (!defined('ABSPATH')) {
    exit;
}

get_header();
?>
<style>
.searchpage{
   min-height:calc(100vh - 404px);
}
</style>
<section class="section section-inner-hero searchpage">
    <div class="container">
        <div class="row gy-4">
            <div class="col-12">
                <h1>
                    <?php 
                    printf(
                        /* translators: %s: search term */
                        esc_html__('Search Results for: %s', 'nayanta'),
                        '<span>' . get_search_query() . '</span>'
                    );
                    ?>
                </h1>
            </div>
        </div>
        <div class="row gy-4">
            <?php
            if (have_posts()) :
                while (have_posts()) :
                    the_post();
                    ?>
                    <div class="col-md-12">
                        <article id="post-<?php the_ID(); ?>" <?php post_class('card h-100'); ?>>
                            <?php if (has_post_thumbnail()) : ?>
                                <div class="card-img-top">
                                    <?php the_post_thumbnail('medium'); ?>
                                </div>
                            <?php endif; ?>
                            
                            <div class="card-body">
                                <h5 class="card-title">
                                    <a href="<?php the_permalink(); ?>">
                                        <?php the_title(); ?>
                                    </a>
                                </h5>
                                <div class="card-text">
                                    <?php the_excerpt(); ?>
                                </div>
                            </div>
                        </article>
                    </div>
                    <?php
                endwhile;

                the_posts_pagination(array(
                    'mid_size' => 2,
                    'prev_text' => __('Previous', 'nayanta'),
                    'next_text' => __('Next', 'nayanta'),
                ));

            else :
                ?>
                <div class="col-12">
                    <h5><?php esc_html_e('Sorry, no results found.', 'nayanta'); ?></h5>
                </div>
                <?php
            endif;
            ?>
        </div>
    </div>
</section>

<!-- <section class="section" >
    <div class="container">
        
    </div>
</section> -->

<?php get_footer(); ?>
