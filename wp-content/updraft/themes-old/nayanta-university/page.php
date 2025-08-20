<?php
// Include the header
get_header();

// Check if current URL contains 'thankyou'
$is_thankyou = strpos($_SERVER['REQUEST_URI'], '/thankyou') !== false;

// Define classes based on the condition
$section_class = $is_thankyou ? 'section section-thankyou' : 'section section-inner-hero';
$container_class = $is_thankyou ? 'container text-white pt-15' : 'container';
?>

<section class="<?php echo esc_attr($section_class); ?>">
    <div class="<?php echo esc_attr($container_class); ?>">
        <div class="row gy-4">
            <div class="col-12">
                <?php the_content(); ?>
            </div>
        </div>
    </div>
</section>

<?php
// Include the footer
get_footer();
?>
